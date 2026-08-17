<?php

namespace App\Controllers;

use App\Libraries\Turnstile;
use App\Models\ContactMessageModel;

class Pages extends BaseController
{
    public function product(): string
    {
        return view('pages/product', [
            'title'     => 'Product — BLUERABBIT',
            'activeNav' => 'product',
        ]);
    }

    public function solutions(): string
    {
        return view('pages/solutions', [
            'title'     => 'Solutions — BLUERABBIT',
            'activeNav' => 'solutions',
        ]);
    }

    public function pricing(): string
    {
        return view('pages/pricing', [
            'title'     => 'Pricing — BLUERABBIT',
            'activeNav' => 'pricing',
        ]);
    }

    public function privacy(): string
    {
        return view('pages/privacy', [
            'title'     => 'Privacy Policy — BLUERABBIT',
            'activeNav' => '',
        ]);
    }

    public function contact(): string
    {
        return view('pages/contact', [
            'title'     => 'Contact — BLUERABBIT',
            'activeNav' => 'contact',
        ]);
    }

    public function contactSubmit()
    {
        $model = new ContactMessageModel();

        if (! (new Turnstile())->verify(
            $this->request->getPost('cf-turnstile-response'),
            $this->request->getIPAddress()
        )) {
            return redirect()->to(site_url('contact'))
                ->withInput()
                ->with('contact_error', "We couldn't verify that you're human — please try again.");
        }

        $data = [
            'name'    => (string) $this->request->getPost('name'),
            'email'   => (string) $this->request->getPost('email'),
            'subject' => (string) $this->request->getPost('subject'),
            'message' => (string) $this->request->getPost('message'),
        ];

        if (! $model->validate($data)) {
            return redirect()->to(site_url('contact'))
                ->withInput()
                ->with('contact_error', implode(' ', $model->errors()));
        }

        $model->insert($data);

        return redirect()->to(site_url('contact'))
            ->with('contact_success', "Thanks, {$data['name']} — we'll get back to you shortly.");
    }
}
