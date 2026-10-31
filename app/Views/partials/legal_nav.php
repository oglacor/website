<?php
/*
 * The hero and the strip of three documents at the top of /terms, /privacy
 * and /refunds, the one being read marked. A <div role="navigation">, not a
 * <nav>: the global nav{} rule in site.css styles every <nav> as the header.
 * Expects $heading, $which, $legal (App\Libraries\Legal::details()).
 */
$legalPages = ['terms' => 'Terms of Service', 'privacy' => 'Privacy Policy', 'refunds' => 'Refund Policy'];
?>
<div class="page-hero wrap">
  <span class="eyebrow">Legal</span>
  <h1><?= esc($heading) ?></h1>
  <div class="legal-nav" role="navigation" aria-label="Legal documents">
    <?php foreach ($legalPages as $slug => $label): ?>
      <a href="<?= site_url($slug) ?>"<?= $slug === $which ? ' class="active" aria-current="page"' : '' ?>><?= esc($label) ?></a>
    <?php endforeach; ?>
  </div>
</div>
