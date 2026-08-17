<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Cloudflare Turnstile.
 *
 * Both values are populated from `.env` (`turnstile.siteKey` /
 * `turnstile.secretKey`) and MUST NOT be hardcoded here. `.env` is gitignored;
 * this file is not. The site key is public by nature — it ships in the page
 * HTML — but it still lives in .env so that dev, staging and production can
 * differ without a code change.
 *
 * With either value blank the whole feature is INERT: no widget renders and no
 * verification runs. That is deliberate, so a fresh clone or a local dev box
 * works without needing keys, rather than silently blocking every form.
 */
class Turnstile extends BaseConfig
{
    public string $siteKey = '';

    public string $secretKey = '';

    /**
     * Cloudflare's verification endpoint.
     */
    public string $verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    /**
     * Seconds to wait on Cloudflare before giving up.
     */
    public int $timeout = 5;
}
