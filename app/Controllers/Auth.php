<?php

namespace App\Controllers;

use App\Libraries\Turnstile;
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
}
