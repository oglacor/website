<?php

namespace App\Controllers\Admin;

use App\Libraries\ResendMailer;
use App\Models\WaitlistSignupModel;

class WaitlistController extends AdminBaseController
{
    public function index(): string
    {
        $model = new WaitlistSignupModel();

        return view('admin/waitlist/index', $this->adminData('waitlist', [
            'title'   => 'Waitlist — BLUERABBIT Admin',
            'signups' => $model->orderBy('created_at', 'DESC')->findAll(),
        ]));
    }

    public function send()
    {
        $subject = (string) $this->request->getPost('subject');
        $body    = (string) $this->request->getPost('body');

        if ($subject === '' || $body === '') {
            return redirect()->to(site_url('admin/waitlist'))->with('admin_error', 'Subject and message are both required.');
        }

        $model   = new WaitlistSignupModel();
        $mailer  = new ResendMailer();

        if (! $mailer->isConfigured()) {
            return redirect()->to(site_url('admin/waitlist'))->with('admin_error', 'Resend isn\'t configured yet — set the API key in Admin → Settings first.');
        }

        $recipients = $model->where('status', 'subscribed')->findAll();
        $sent       = 0;
        $failed     = 0;

        foreach ($recipients as $signup) {
            $result = $mailer->send($signup['email'], $subject, nl2br(esc($body)));

            if ($result['success']) {
                $model->update($signup['id'], ['notified_at' => date('Y-m-d H:i:s')]);
                $sent++;
            } else {
                $failed++;
            }
        }

        return redirect()->to(site_url('admin/waitlist'))
            ->with('admin_success', "Campaign sent: {$sent} delivered" . ($failed ? ", {$failed} failed" : '') . '.');
    }
}
