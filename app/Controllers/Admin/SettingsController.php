<?php

namespace App\Controllers\Admin;

use App\Models\SiteSettingModel;

class SettingsController extends AdminBaseController
{
    public function index(): string
    {
        $settings = new SiteSettingModel();

        return view('admin/settings/index', $this->adminData('settings', [
            'title'             => 'Settings — BLUERABBIT Admin',
            'resendApiKey'      => $settings->getSetting('resend_api_key', ''),
            'resendFromAddress' => $settings->getSetting('resend_from_address', 'BLUERABBIT <onboarding@resend.dev>'),
        ]));
    }

    public function save()
    {
        $settings = new SiteSettingModel();
        $settings->setSetting('resend_api_key', (string) $this->request->getPost('resend_api_key'));
        $settings->setSetting('resend_from_address', (string) $this->request->getPost('resend_from_address'));

        return redirect()->to(site_url('admin/settings'))->with('admin_success', 'Settings saved.');
    }
}
