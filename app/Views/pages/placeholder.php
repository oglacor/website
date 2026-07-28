<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow"><?= esc($eyebrow ?? '') ?></span>
  <h1><?= esc($heading ?? '') ?></h1>
  <p><?= esc($body ?? '') ?></p>
</div>

<div class="wrap" style="padding-bottom:100px;">
  <div class="cta-row" style="justify-content:flex-start;">
    <a href="<?= site_url('/') ?>#waitlist-hero" class="btn btn-primary">Join the Waitlist</a>
    <a href="<?= site_url('/') ?>" class="btn btn-ghost">Back Home</a>
  </div>
</div>

<?= $this->endSection() ?>
