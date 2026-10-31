<?php

namespace App\Libraries;

use App\Models\SiteSettingModel;

/**
 * The Terms, the Privacy Policy and the Refund Policy shown at /terms,
 * /privacy and /refunds (added 2026-10-30, for the public launch).
 *
 * The Terms and the Refund Policy are copies of the app's own pages (the
 * `blue` repo, app/Views/legal/), which is where people agree to them at
 * sign-up and checkout. The two copies must say the same thing: change one,
 * change the other, and bump VERSION in both (`blue`'s App\Libraries\Legal).
 * The Privacy Policy here covers the app and this website together.
 *
 * The business the pages name comes from Admin -> Settings -> Legal; a blank
 * field prints a neutral fallback, so the pages work before it is filled in.
 */
class Legal
{
    /** Same value as `blue`'s App\Libraries\Legal::VERSION. */
    public const VERSION = '2026-10-30';

    public static function details(): array
    {
        $settings = new SiteSettingModel();
        $get      = static fn(string $key): string => trim((string) $settings->getSetting($key, ''));

        return [
            'name'         => $get('legal_entity_name') ?: 'the operator of BLUERABBIT',
            'name_set'     => $get('legal_entity_name') !== '',
            'address'      => $get('legal_entity_address'),
            'email'        => $get('legal_contact_email'),
            'jurisdiction' => $get('legal_jurisdiction'),
            'version'      => self::VERSION,
            'updated'      => date('j F Y', strtotime(self::VERSION)),
        ];
    }

    /** A mailto link to the legal contact, or the contact page when none is set. */
    public static function contactLink(array $legal): string
    {
        if ($legal['email'] !== '') {
            return '<a href="mailto:' . esc($legal['email'], 'attr') . '">' . esc($legal['email']) . '</a>';
        }

        return '<a href="' . site_url('contact') . '">our contact page</a>';
    }
}
