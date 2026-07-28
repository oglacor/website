<?php

namespace App\Controllers;

use App\Libraries\ResendMailer;
use App\Models\WaitlistSignupModel;

class Waitlist extends BaseController
{
    public function store()
    {
        $model = new WaitlistSignupModel();

        $email = $this->request->getPost('email');

        if (! $model->validate(['email' => $email])) {
            return redirect()->to(site_url('/') . '#waitlist-hero')
                ->withInput()
                ->with('waitlist_error', $model->errors()['email'] ?? 'That email address doesn\'t look right.');
        }

        $model->insert([
            'email'  => $email,
            'source' => 'homepage_hero',
            'status' => 'subscribed',
        ]);

        // Best-effort welcome email — signup succeeds regardless of whether
        // Resend is configured yet (see /admin/settings).
        $mailer = new ResendMailer();
        if ($mailer->isConfigured()) {
            $mailer->send(
                $email,
                "You're on the BLUERABBIT waitlist",
                '<p>Thanks for joining — we\'ll email you the moment early access opens. In the meantime, keep an eye on <a href="' . site_url('blog') . '">the blog</a> for updates.</p>'
            );
        }

        return redirect()->to(site_url('/') . '#waitlist-hero')
            ->with('waitlist_success', "You're on the list — we'll email you the moment early access opens.");
    }

    public function unsubscribe(): string
    {
        $email  = (string) $this->request->getGet('email');
        $model  = new WaitlistSignupModel();
        $signup = $email !== '' ? $model->findByEmail($email) : null;

        if ($signup && $signup['status'] !== 'unsubscribed') {
            $model->update($signup['id'], ['status' => 'unsubscribed']);
        }

        return view('pages/unsubscribed', [
            'title'     => 'Unsubscribed — BLUERABBIT',
            'activeNav' => '',
            'email'     => $email,
        ]);
    }
}
