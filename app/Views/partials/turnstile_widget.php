<?php
/**
 * Renders a Turnstile widget, or nothing at all when keys aren't configured.
 *
 *   <?= view('partials/turnstile_widget', ['action' => 'waitlist']) ?>
 *
 * Place it INSIDE the <form>. Turnstile injects a hidden
 * `cf-turnstile-response` input into this div, and these are ordinary form
 * POSTs, so the token submits with the rest of the fields automatically —
 * no JS wiring needed.
 *
 * `action` is a label Cloudflare shows in its own analytics so you can tell
 * which form a challenge came from. Keep them distinct per form.
 *
 * The api.js script itself is emitted once by layouts/main.php, not here —
 * Cloudflare warns against loading it twice, and a per-widget include can't
 * reliably dedupe itself across multiple renders.
 */

$turnstile = new \App\Libraries\Turnstile();

if (! $turnstile->isConfigured()) {
    return;
}
?>
<div class="cf-turnstile"
     data-sitekey="<?= esc($turnstile->siteKey(), 'attr') ?>"
     data-action="<?= esc($action ?? 'default', 'attr') ?>"
     data-theme="dark"></div>
