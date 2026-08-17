<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="auth-shell">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel">
      <span class="eyebrow">Account</span>
      <h1>Choose a New Password</h1>
      <p class="sub">Pick something you don't use anywhere else. Minimum 8 characters.</p>

      <?php if (session()->getFlashdata('auth_error')): ?>
        <div class="form-alert error"><?= esc(session()->getFlashdata('auth_error')) ?></div>
      <?php endif; ?>

      <form action="<?= site_url('reset-password') ?>" method="post">
        <?= csrf_field() ?>
        <?php /* The token rides in a hidden field so it isn't re-exposed in the
                 URL of the POST, and is re-validated server-side regardless. */ ?>
        <input type="hidden" name="token" value="<?= esc($token, 'attr') ?>">
        <div class="form-field">
          <label for="password">New password</label>
          <input type="password" id="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" minlength="8" required autofocus autocomplete="new-password">
        </div>
        <div class="form-field">
          <label for="password_confirm">Confirm new password</label>
          <input type="password" id="password_confirm" name="password_confirm" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" minlength="8" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update Password</button>
      </form>

      <p class="form-note">This reset link stops working once you've used it.</p>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
