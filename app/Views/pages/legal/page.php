<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/*
 * A translated legal page: the hero (partials/legal_nav), the machine-
 * translation notice, the version line, then the document itself from
 * pages/legal/{lang}/{which}.php.
 *
 * MACHINE TRANSLATIONS, NOT REVIEWED. Every translation was made by an AI
 * (Claude, 2026-11-15) from the English pages (pages/terms.php, privacy.php,
 * refunds.php, version 2026-10-30), reusing the app's own translated words.
 * No lawyer and no native speaker has reviewed them. Gauden approved
 * publishing them before review on 2026-11-15; the legal and native review is
 * still to follow. The notice below tells the reader they are unreviewed A.I.
 * translations and links the English, the reference text. Remove the notice
 * for a language only once its review is done, and record that review in
 * claude-notes/BUILD-STATUS.md.
 *
 * Expects $heading, $which, $lang, $htmlLang, $legal, $emailLink.
 */
?>

<div lang="<?= esc($htmlLang, 'attr') ?>">
<?= view('partials/legal_nav', ['heading' => $heading, 'which' => $which, 'lang' => $lang]) ?>

<div class="blog-post wrap">
  <div class="legal-notice" role="note">
    <strong><?= esc(lang('Legal.notice_title', [], $lang)) ?></strong>
    <?= esc(lang('Legal.notice', [], $lang)) ?>
    <a href="<?= \App\Libraries\Legal::url($which) ?>" hreflang="en" lang="en"><?= esc(lang('Legal.notice_link', [], $lang)) ?></a>
  </div>
  <div class="meta"><?= esc(lang('Legal.version', ['version' => $legal['version']], $lang)) ?> &middot; <?= esc(lang('Legal.updated', ['date' => $legal['updated']], $lang)) ?><?= $legal['name_set'] ? ' &middot; ' . esc($legal['name']) : '' ?></div>
  <div class="content">
<?= $this->include('pages/legal/' . $lang . '/' . $which) ?>
  </div>
</div>
</div>

<?= $this->endSection() ?>
