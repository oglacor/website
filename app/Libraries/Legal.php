<?php

namespace App\Libraries;

use App\Models\SiteSettingModel;
use IntlDateFormatter;

/**
 * The Terms, the Privacy Policy and the Refund Policy shown at /terms,
 * /privacy and /refunds (added 2026-10-30, for the public launch), and their
 * translations at /{code}/terms etc. (added 2026-11-15).
 *
 * Since 2026-11-15 (the app's batch LG1) these pages exist ONLY here: the
 * app (`blue` repo) answers its own /terms, /privacy and /refunds with a 301
 * to these addresses (its Sys Config -> Legal holds them, default
 * https://bluerabbit.io/terms etc.), and still records VERSION when people
 * agree at sign-up and checkout. When the Terms change in substance, bump
 * VERSION here AND in `blue`'s App\Libraries\Legal::VERSION.
 *
 * The English pages are app/Views/pages/{terms,privacy,refunds}.php. The
 * translations are app/Views/pages/legal/{code}/*.php inside the wrapper
 * app/Views/pages/legal/page.php, with their few interface words in
 * app/Language/{code}/Legal.php. Every translation was made by an AI
 * (Claude, 2026-11-15) and has NOT been reviewed by a lawyer or a native
 * speaker; each page says so to its reader. The English is the reference.
 *
 * The business the pages name comes from Admin -> Settings -> Legal; a blank
 * field prints a neutral fallback, so the pages work before it is filled in.
 */
class Legal
{
    /** Same value as `blue`'s App\Libraries\Legal::VERSION. */
    public const VERSION = '2026-10-30';

    /** The three documents, in the order of the tab strip. */
    public const PAGES = ['terms', 'privacy', 'refunds'];

    /**
     * Every language the legal pages are published in: the address code =>
     * the HTML lang tag. 'en' is the original at /terms; the others live at
     * /{code}/terms. Routes.php builds its routes from this list, so a new
     * language is a row here, its app/Language/{code}/Legal.php and its
     * three views in app/Views/pages/legal/{code}/.
     */
    public const LANGUAGES = [
        'en'    => 'en',
        'de'    => 'de',
        'es'    => 'es-MX',
        'fr'    => 'fr',
        'it'    => 'it',
        'ja'    => 'ja',
        'ko'    => 'ko',
        'pt-br' => 'pt-BR',
        'ru'    => 'ru',
        'tr'    => 'tr',
        'zh-cn' => 'zh-CN',
    ];

    /** The translated languages only (everything but the English original). */
    public static function translations(): array
    {
        return array_values(array_diff(array_keys(self::LANGUAGES), ['en']));
    }

    /**
     * The language code for whatever a link asked for, or null. Accepts this
     * site's codes and the app's locale names, so the app can send its
     * player's language as it stores it: es_MX, pt_BR, zh_CN, ko_KR, ja ...
     */
    public static function languageFor(?string $asked): ?string
    {
        $asked = strtolower(str_replace('_', '-', trim((string) $asked)));
        if ($asked === '') {
            return null;
        }
        if (isset(self::LANGUAGES[$asked])) {
            return $asked;
        }
        $primary = explode('-', $asked)[0];
        foreach (array_keys(self::LANGUAGES) as $code) {
            if (explode('-', $code)[0] === $primary) {
                return $code;
            }
        }

        return null;
    }

    /** The address of one document in one language. */
    public static function url(string $page, string $lang = 'en'): string
    {
        return site_url($lang === 'en' ? $page : $lang . '/' . $page);
    }

    /** hreflang => address of one document in every language, for <link rel="alternate">. */
    public static function alternates(string $page): array
    {
        $links = [];
        foreach (self::LANGUAGES as $code => $tag) {
            $links[$tag] = self::url($page, $code);
        }
        $links['x-default'] = self::url($page);

        return $links;
    }

    public static function details(string $lang = 'en'): array
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
            'updated'      => self::date(self::VERSION, $lang),
        ];
    }

    /** VERSION as a date the reader's language writes ("30 October 2026", "2026年10月30日"). */
    private static function date(string $ymd, string $lang): string
    {
        $time = strtotime($ymd);
        if ($lang === 'en' || ! class_exists(IntlDateFormatter::class)) {
            return date('j F Y', $time);
        }
        $formatter = new IntlDateFormatter(self::LANGUAGES[$lang] ?? $lang, IntlDateFormatter::LONG, IntlDateFormatter::NONE, null);
        $out       = $formatter->format($time);

        return $out === false ? date('Y-m-d', $time) : $out;
    }

    /** A mailto link to the legal contact, or the contact page when none is set. */
    public static function contactLink(array $legal): string
    {
        if ($legal['email'] !== '') {
            return self::emailLink($legal);
        }

        return '<a href="' . site_url('contact') . '">our contact page</a>';
    }

    /** The mailto link alone ('' when no address is set): the translations word their own fallback. */
    public static function emailLink(array $legal): string
    {
        if ($legal['email'] === '') {
            return '';
        }

        return '<a href="mailto:' . esc($legal['email'], 'attr') . '">' . esc($legal['email']) . '</a>';
    }
}
