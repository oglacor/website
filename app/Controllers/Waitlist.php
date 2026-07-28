<?php

namespace App\Controllers;

use App\Models\WaitlistSignupModel;

class Waitlist extends BaseController
{
    /**
     * Handles the hero waitlist form POST. Stores the signup; the actual
     * Resend "welcome" email send is a follow-up piece (needs the admin
     * settings screen for the API key first) - see project notes.
     */
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

        return redirect()->to(site_url('/') . '#waitlist-hero')
            ->with('waitlist_success', "You're on the list — we'll email you the moment early access opens.");
    }
}
