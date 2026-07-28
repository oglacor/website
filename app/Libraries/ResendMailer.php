<?php

namespace App\Libraries;

use App\Models\SiteSettingModel;
use Config\Services;

/**
 * Thin wrapper around the Resend HTTP API — no SDK dependency, just their
 * documented REST endpoint. API key is stored in site_settings (configurable
 * from /admin/settings) rather than hardcoded in .env, so Bernardo can set it
 * without redeploying.
 */
class ResendMailer
{
    protected string $apiKey;
    protected string $fromAddress;

    public function __construct()
    {
        $settings          = new SiteSettingModel();
        $this->apiKey      = $settings->getSetting('resend_api_key', '') ?? '';
        $this->fromAddress = $settings->getSetting('resend_from_address', 'BLUERABBIT <onboarding@resend.dev>') ?? 'BLUERABBIT <onboarding@resend.dev>';
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * @param string $bodyHtml Trusted HTML for the email body — gets wrapped in the
     *                         branded header/footer template (logo, unsubscribe link).
     */
    public function send(string $to, string $subject, string $bodyHtml, bool $includeUnsubscribe = true): array
    {
        if (! $this->isConfigured()) {
            return ['success' => false, 'error' => 'Resend API key not configured yet — set it in Admin → Settings.'];
        }

        $html = view('emails/layout', [
            'subject'        => $subject,
            'bodyHtml'       => $bodyHtml,
            'logoUrl'        => base_url('assets/img/logo-full-for-dark-bg-email.png'),
            'siteUrl'        => site_url('/'),
            'docsUrl'        => site_url('docs'),
            'contactUrl'     => site_url('contact'),
            'unsubscribeUrl' => $includeUnsubscribe ? site_url('unsubscribe') . '?email=' . rawurlencode($to) : '',
        ]);

        try {
            $response = Services::curlrequest()->request('POST', 'https://api.resend.com/emails', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'json'        => [
                    'from'    => $this->fromAddress,
                    'to'      => [$to],
                    'subject' => $subject,
                    'html'    => $html,
                ],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            $code = $response->getStatusCode();
            $body = json_decode((string) $response->getBody(), true) ?? [];

            if ($code >= 200 && $code < 300) {
                return ['success' => true, 'id' => $body['id'] ?? null];
            }

            return ['success' => false, 'error' => $body['message'] ?? ('Resend API error (HTTP ' . $code . ')')];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
