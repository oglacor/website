<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="auth-shell">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel">
      <span class="eyebrow">Account</span>
      <h1>Reset Your Password</h1>
      <p class="sub">Enter the email address on your bluerabbit.io site account and we'll send you a link to choose a new password.</p>

      <?php if (session()->getFlashdata('auth_success')): ?>
        <div class="form-alert success"><?= esc(session()->getFlashdata('auth_success')) ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('auth_error')): ?>
        <div class="form-alert error"><?= esc(session()->getFlashdata('auth_error')) ?></div>
      <?php endif; ?>

      <form action="<?= site_url('forgot-password') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="you@company.com" required autofocus>
        </div>
        <?= view('partials/turnstile_widget', ['action' => 'forgot-password']) ?>
        <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
      </form>

      <p class="form-note">The link expires in <?= \App\Models\PasswordResetModel::TTL_MINUTES ?> minutes and works once.</p>
      <p class="form-note">Remembered it? <a href="<?= site_url('login') ?>">Back to log in</a></p>
      <p class="form-note">Looking for the BLUERABBIT app rather than this site? Passwords there are separate &mdash; reset them at <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>.</p>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
