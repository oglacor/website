<?php

namespace App\Controllers;

use App\Libraries\ResendMailer;
use App\Libraries\Turnstile;
use App\Models\PasswordResetModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function loginForm(): string
    {
        if (session()->get('user_id')) {
            return redirect()->to(site_url('account'));
        }

        return view('auth/login', [
            'title'     => 'Log In — BLUERABBIT',
            'activeNav' => 'login',
        ]);
    }

    public function login()
    {
        $email    = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        if (! (new Turnstile())->verify(
            $this->request->getPost('cf-turnstile-response'),
            $this->request->getIPAddress()
        )) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('auth_error', "We couldn't verify that you're human — please try again.");
        }

        $model = new UserModel();
        $user  = $model->findByEmail($email);

        if (! $user || ! password_verify($password, $user['password_hash'])) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('auth_error', 'That email and password combination doesn\'t match.');
        }

        if ($user['status'] !== 'active') {
            return redirect()->to(site_url('login'))
                ->with('auth_error', 'This account has been disabled.');
        }

        session()->set([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
        ]);
        session()->regenerate();

        return redirect()->to($user['role'] === 'admin' ? site_url('admin') : site_url('account'))
            ->with('auth_success', 'Welcome back, ' . $user['name'] . '.');
    }

    public function registerForm(): string
    {
        if (session()->get('user_id')) {
            return redirect()->to(site_url('account'));
        }

        return view('auth/register', [
            'title'     => 'Get Started — BLUERABBIT',
            'activeNav' => 'get-started',
        ]);
    }

    public function register()
    {
        $name     = (string) $this->request->getPost('name');
        $email    = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        if (! (new Turnstile())->verify(
            $this->request->getPost('cf-turnstile-response'),
            $this->request->getIPAddress()
        )) {
            return redirect()->to(site_url('get-started'))
                ->withInput()
                ->with('auth_error', "We couldn't verify that you're human — please try again.");
        }

        if (strlen($password) < 8) {
            return redirect()->to(site_url('get-started'))
                ->withInput()
                ->with('auth_error', 'Password must be at least 8 characters.');
        }

        $model  = new UserModel();
        $userId = $model->registerUser($name, $email, $password);

        if ($userId === false) {
            return redirect()->to(site_url('get-started'))
                ->withInput()
                ->with('auth_error', implode(' ', $model->errors()));
        }

        session()->set([
            'user_id'    => $userId,
            'user_name'  => $name,
            'user_email' => $email,
            'user_role'  => 'user',
        ]);
        session()->regenerate();

        return redirect()->to(site_url('account'))
            ->with('auth_success', 'Welcome to BLUERABBIT, ' . $name . '.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('/'))->with('auth_success', 'You\'ve been logged out.');
    }

    // ---------------------------------------------------------------
    // Password recovery
    //
    // The governing rule throughout: this flow must never reveal whether an
    // email address has an account. Every path below returns the same message
    // and does the same visible work regardless, because "no account with that
    // email" is exactly the oracle an attacker wants for building a user list.
    // ---------------------------------------------------------------

    public function forgotForm(): string
    {
        return view('auth/forgot', [
            'title'     => 'Reset Your Password — BLUERABBIT',
            'activeNav' => '',
        ]);
    }

    public function forgot()
    {
        $email = trim((string) $this->request->getPost('email'));

        if (! (new Turnstile())->verify(
            $this->request->getPost('cf-turnstile-response'),
            $this->request->getIPAddress()
        )) {
            return redirect()->to(site_url('forgot-password'))
                ->withInput()
                ->with('auth_error', "We couldn't verify that you're human — please try again.");
        }

        // Deliberately identical for every outcome below.
        $sameAnswer = redirect()->to(site_url('forgot-password'))
            ->with('auth_success', 'If an account exists for that address, we\'ve sent a reset link. Check your inbox, including spam.');

        if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $sameAnswer;
        }

        $users = new UserModel();
        $user  = $users->findByEmail($email);

        // Disabled accounts get the same answer but no email — a reset link
        // shouldn't be a way back into an account someone deliberately closed.
        if (! $user || $user['status'] !== 'active') {
            return $sameAnswer;
        }

        $token = (new PasswordResetModel())->issueFor((int) $user['id']);
        $link  = site_url('reset-password') . '?token=' . $token;

        $mailer = new ResendMailer();

        if ($mailer->isConfigured()) {
            $mailer->send(
                $user['email'],
                'Reset your BLUERABBIT password',
                '<p>Hi ' . esc($user['name']) . ',</p>'
                . '<p>Someone asked to reset the password on your bluerabbit.io account. Click below to choose a new one:</p>'
                . '<p><a href="' . esc($link) . '">Reset my password</a></p>'
                . '<p>This link expires in ' . PasswordResetModel::TTL_MINUTES . ' minutes and can only be used once.</p>'
                . '<p>If this wasn\'t you, you can ignore this email — your password stays exactly as it is.</p>',
                // Never attach an unsubscribe link to a security email: it is
                // transactional, not marketing, and unsubscribing here would
                // silently remove the person from the waitlist instead.
                false
            );
        } else {
            // Without this the request would look successful to the user while
            // no email could possibly arrive.
            log_message('critical', 'Password reset requested but Resend is not configured — no email sent. Set the API key in Admin > Settings.');
        }

        return $sameAnswer;
    }

    public function resetForm()
    {
        $token = (string) $this->request->getGet('token');

        if ((new PasswordResetModel())->findValid($token) === null) {
            return redirect()->to(site_url('forgot-password'))
                ->with('auth_error', 'That reset link has expired or already been used. Request a new one below.');
        }

        return view('auth/reset', [
            'title'     => 'Choose a New Password — BLUERABBIT',
            'activeNav' => '',
            'token'     => $token,
        ]);
    }

    public function reset()
    {
        $token    = (string) $this->request->getPost('token');
        $password = (string) $this->request->getPost('password');
        $confirm  = (string) $this->request->getPost('password_confirm');

        $resets = new PasswordResetModel();
        $row    = $resets->findValid($token);

        // Re-checked here, not just in resetForm(), because this endpoint is
        // reachable directly and the token may have expired or been spent
        // between rendering the form and submitting it.
        if ($row === null) {
            return redirect()->to(site_url('forgot-password'))
                ->with('auth_error', 'That reset link has expired or already been used. Request a new one below.');
        }

        $back = redirect()->to(site_url('reset-password') . '?token=' . $token);

        if (strlen($password) < 8) {
            return $back->with('auth_error', 'Password must be at least 8 characters.');
        }

        if ($password !== $confirm) {
            return $back->with('auth_error', 'Those two passwords don\'t match.');
        }

        (new UserModel())->updatePassword((int) $row['user_id'], $password);

        // Spend this token, and revoke any others outstanding for the account.
        $resets->consume((int) $row['id']);
        $resets->revokeAllFor((int) $row['user_id']);

        // Sign this browser out so the reset lands on a clean login.
        //
        // NOT session()->destroy(): that tears down the session immediately,
        // and the flash message set on the redirect below is written into the
        // session — so destroying it first silently swallows the confirmation.
        // Removing the identity keys and rotating the ID achieves the sign-out
        // while leaving a live session to carry the flash.
        //
        // Worth being precise about the limit: this only signs out THIS
        // browser. With file-based sessions, another device already logged in
        // as this user keeps its own session until it expires. Genuinely
        // revoking those needs per-user session tracking, or an AuthFilter
        // check against a password-changed timestamp — neither exists here.
        session()->remove(['user_id', 'user_name', 'user_email', 'user_role']);
        session()->regenerate(true);

        return redirect()->to(site_url('login'))
            ->with('auth_success', 'Password updated. You can log in with it now.');
    }
}
