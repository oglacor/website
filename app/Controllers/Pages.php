<?php

namespace App\Controllers;

use App\Libraries\Legal;
use App\Libraries\Turnstile;
use App\Models\ContactMessageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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

    public function terms(string $lang = 'en')
    {
        return $this->legalPage('terms', $lang);
    }

    public function privacy(string $lang = 'en')
    {
        return $this->legalPage('privacy', $lang);
    }

    public function refunds(string $lang = 'en')
    {
        return $this->legalPage('refunds', $lang);
    }

    /**
     * One legal document in one language. English is the original view
     * (pages/terms.php ...); a translation is pages/legal/page.php around
     * pages/legal/{code}/{which}.php. /terms?lang=es_MX (the app's locale
     * names work too) sends the reader on to /es/terms.
     */
    private function legalPage(string $which, string $lang)
    {
        if (! isset(Legal::LANGUAGES[$lang])) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($lang === 'en') {
            $asked = Legal::languageFor($this->request->getGet('lang'));
            if ($asked !== null && $asked !== 'en') {
                return redirect()->to(Legal::url($which, $asked));
            }
        }

        $legal   = Legal::details($lang);
        $heading = lang('Legal.' . $which, [], $lang);
        $data    = [
            'title'      => $heading . ' — BLUERABBIT',
            'activeNav'  => '',
            'heading'    => $heading,
            'which'      => $which,
            'lang'       => $lang,
            'htmlLang'   => Legal::LANGUAGES[$lang],
            'legal'      => $legal,
            'emailLink'  => Legal::emailLink($legal),
            'alternates' => Legal::alternates($which),
        ];

        return view($lang === 'en' ? 'pages/' . $which : 'pages/legal/page', $data);
    }

    public function aiAtWork(): string
    {
        return view('pages/ai_at_work', [
            'title'           => 'AI at Work: Straight Answers — BLUERABBIT',
            'metaDescription' => 'Straight, sourced answers to the questions people ask about using AI at work: accuracy, how it works, jobs, agents and how to use it well.',
            'activeNav'       => '',
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
