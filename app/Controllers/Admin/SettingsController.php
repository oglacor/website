<?php

namespace App\Controllers\Admin;

use App\Models\SiteSettingModel;

class SettingsController extends AdminBaseController
{
    /** The business /terms, /privacy and /refunds name (App\Libraries\Legal). */
    private const LEGAL_KEYS = ['legal_entity_name', 'legal_entity_address', 'legal_contact_email', 'legal_jurisdiction'];

    public function index(): string
    {
        $settings = new SiteSettingModel();

        $legal = [];
        foreach (self::LEGAL_KEYS as $key) {
            $legal[$key] = $settings->getSetting($key, '');
        }

        return view('admin/settings/index', $this->adminData('settings', [
            'title'             => 'Settings — BLUERABBIT Admin',
            'resendApiKey'      => $settings->getSetting('resend_api_key', ''),
            'resendFromAddress' => $settings->getSetting('resend_from_address', 'BLUERABBIT <onboarding@resend.dev>'),
            'legal'             => $legal,
        ]));
    }

    public function save()
    {
        $settings = new SiteSettingModel();
        $settings->setSetting('resend_api_key', (string) $this->request->getPost('resend_api_key'));
        $settings->setSetting('resend_from_address', (string) $this->request->getPost('resend_from_address'));
        foreach (self::LEGAL_KEYS as $key) {
            $settings->setSetting($key, trim((string) $this->request->getPost($key)));
        }

        return redirect()->to(site_url('admin/settings'))->with('admin_success', 'Settings saved.');
    }
}
