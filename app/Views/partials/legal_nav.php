<?php
/*
 * The hero at the top of every legal page: the strip of three documents (the
 * one being read marked) and the strip of languages (the one being read
 * marked). Each is a <div role="navigation">, not a <nav>: the global nav{}
 * rule in site.css styles every <nav> as the header.
 * Expects $heading, $which; $lang (default 'en'). The words come from
 * app/Language/{lang}/Legal.php; each language's own name is written in that
 * language, from its own file.
 */
use App\Libraries\Legal;

$lang ??= 'en';
?>
<div class="page-hero wrap" lang="<?= esc(Legal::LANGUAGES[$lang], 'attr') ?>">
  <span class="eyebrow"><?= esc(lang('Legal.eyebrow', [], $lang)) ?></span>
  <h1><?= esc($heading) ?></h1>
  <div class="legal-nav" role="navigation" aria-label="<?= esc(lang('Legal.documents', [], $lang), 'attr') ?>">
    <?php foreach (Legal::PAGES as $slug): ?>
      <a href="<?= Legal::url($slug, $lang) ?>"<?= $slug === $which ? ' class="active" aria-current="page"' : '' ?>><?= esc(lang('Legal.' . $slug, [], $lang)) ?></a>
    <?php endforeach; ?>
  </div>
  <div class="legal-langs" role="navigation" aria-label="<?= esc(lang('Legal.languages', [], $lang), 'attr') ?>">
    <span class="legal-langs-label"><?= esc(lang('Legal.languages', [], $lang)) ?></span>
    <?php foreach (Legal::LANGUAGES as $code => $tag): ?>
      <a href="<?= Legal::url($which, $code) ?>" hreflang="<?= esc($tag, 'attr') ?>" lang="<?= esc($tag, 'attr') ?>"<?= $code === $lang ? ' class="active" aria-current="true"' : '' ?>><?= esc(lang('Legal.lang_name', [], $code)) ?></a>
    <?php endforeach; ?>
  </div>
</div>
