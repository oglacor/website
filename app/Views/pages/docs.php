<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Documentation</span>
  <h1>Docs</h1>
  <p>Everything below is open to everyone. The architecture &amp; API reference is gated to site admins and collaborators.</p>
</div>

<div class="wrap" style="padding-bottom:100px;">
  <div class="feature-grid">
    <div class="feature-card panel cyan">
      <div class="feature-icon">&#9636;</div>
      <h3>Using the Platform</h3>
      <p>How to enroll, progress through adventures, and understand XP/BLOO/EP as a player.</p>
    </div>
    <div class="feature-card panel green">
      <div class="feature-icon">&#9670;</div>
      <h3>Onboarding &amp; Billing</h3>
      <p>Setting up your organization, enrolling a team, and how Stripe billing works on the open core.</p>
    </div>
    <div class="feature-card panel yellow">
      <div class="feature-icon">&#9889;</div>
      <h3>Product Overview</h3>
      <p>A guided tour of the platform's mechanics for anyone evaluating BLUERABBIT.</p>
    </div>
    <div class="feature-card panel purple">
      <div class="feature-icon">&#128274;</div>
      <h3>Architecture &amp; API <span style="font-size:11px; color:var(--muted-2); text-transform:none; font-weight:600;">(admin login required)</span></h3>
      <p>Full technical reference for the CI4 core — routes, models, and the data layer. Log in to view.</p>
      <a href="<?= site_url('login') ?>" class="btn btn-ghost btn-sm" style="margin-top:14px;">Log In &rarr;</a>
    </div>
  </div>
  <p style="color:var(--muted-2); font-size:13px; margin-top:40px;">
    Full write-ups for each section are being drafted next — this page will fill in as content lands.
  </p>
</div>

<?= $this->endSection() ?>
