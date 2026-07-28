<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="auth-shell">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel" style="text-align:center;">
      <span class="eyebrow">Waitlist</span>
      <h1>You're unsubscribed.</h1>
      <p class="sub"><?= esc($email) ?> won't receive any more BLUERABBIT waitlist emails. Changed your mind? You can always rejoin from the homepage.</p>
      <a href="<?= site_url('/') ?>" class="btn btn-primary btn-block" style="margin-top:10px;">Back to Home</a>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
