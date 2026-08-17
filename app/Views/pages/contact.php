<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Contact</span>
  <h1>Let's talk.</h1>
  <p>Questions about the relaunch, enterprise plans, or anything else — drop us a note and we'll get back to you.</p>
</div>

<section class="auth-shell" style="padding-top:0;">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel" style="max-width:560px;">
      <?php if (session()->getFlashdata('contact_success')): ?>
        <div class="form-alert success"><?= esc(session()->getFlashdata('contact_success')) ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('contact_error')): ?>
        <div class="form-alert error"><?= esc(session()->getFlashdata('contact_error')) ?></div>
      <?php endif; ?>

      <form action="<?= site_url('contact') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="<?= esc(old('name')) ?>" placeholder="Jane Smith" required>
        </div>
        <div class="form-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="you@company.com" required>
        </div>
        <div class="form-field">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" value="<?= esc(old('subject')) ?>" placeholder="Enterprise plan question">
        </div>
        <div class="form-field">
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="How can we help?" required><?= esc(old('message')) ?></textarea>
        </div>
        <?= view('partials/turnstile_widget', ['action' => 'contact']) ?>
        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
      </form>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
