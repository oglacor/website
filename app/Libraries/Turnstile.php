<?php

namespace App\Libraries;

use Config\Services;

/**
 * Cloudflare Turnstile verification.
 *
 * Plain cURL, matching ResendMailer — this project has no HTTP client
 * dependency and shouldn't grow one for a single POST.
 *
 * FAILURE BEHAVIOUR, deliberately asymmetric:
 *   - Not configured        -> inert, verification passes. A fresh clone works.
 *   - Cloudflare unreachable-> passes, logs CRITICAL. An outage at Cloudflare
 *                              must not take down the waitlist and contact
 *                              forms. This is a real (narrow) bypass window and
 *                              is a deliberate availability-over-strictness
 *                              call, not an oversight.
 *   - Real negative verdict -> FAILS. A token that is missing, forged, expired
 *                              or already spent is rejected outright.
 *
 * If that trade is ever revisited, change it here — every caller just gets a
 * bool and will follow.
 */
class Turnstile
{
    protected \Config\Turnstile $config;

    public function __construct()
    {
        $this->config = config('Turnstile');
    }

    /**
     * Both keys must be present. One without the other is a misconfiguration,
     * not a half-enabled state — treat it as off rather than rendering a widget
     * whose response can never be checked.
     */
    public function isConfigured(): bool
    {
        return $this->config->siteKey !== '' && $this->config->secretKey !== '';
    }

    public function siteKey(): string
    {
        return $this->config->siteKey;
    }

    /**
     * @param string|null $token The posted `cf-turnstile-response` value.
     * @param string|null $ip    Remote IP, optional but recommended.
     */
    public function verify(?string $token, ?string $ip = null): bool
    {
        if (! $this->isConfigured()) {
            return true;
        }

        $token = (string) $token;

        // No token at all means the widget never solved — reject without
        // troubling Cloudflare.
        if ($token === '') {
            return false;
        }

        $payload = [
            'secret'   => $this->config->secretKey,
            'response' => $token,
        ];

        if ($ip !== null && $ip !== '') {
            $payload['remoteip'] = $ip;
        }

        $ch = curl_init($this->config->verifyUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->config->timeout,
        ]);

        $raw   = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($raw === false) {
            log_message('critical', 'Turnstile unreachable, allowing submission through: ' . $error);

            return true;
        }

        $decoded = json_decode((string) $raw, true);

        if (! is_array($decoded)) {
            log_message('critical', 'Turnstile returned an unreadable response, allowing through: ' . $raw);

            return true;
        }

        if (! empty($decoded['success'])) {
            return true;
        }

        $codes = implode(', ', (array) ($decoded['error-codes'] ?? []));

        // invalid-input-secret is the single most likely misconfiguration and
        // is otherwise indistinguishable from "a human failed the challenge",
        // so call it out explicitly rather than burying it.
        if (str_contains($codes, 'invalid-input-secret')) {
            log_message('critical', 'Turnstile REJECTED because the secret key is wrong. Check turnstile.secretKey in .env — it must be the SECRET, not the site key.');
        } else {
            log_message('warning', 'Turnstile verification failed: ' . $codes);
        }

        return false;
    }
}
