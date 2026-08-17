<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="auth-shell">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel">
      <span class="eyebrow">Account</span>
      <h1>Log In</h1>
      <p class="sub">Your own bluerabbit.io site account — separate from the main BLUERABBIT app.</p>

      <?php if (session()->getFlashdata('auth_error')): ?>
        <div class="form-alert error"><?= esc(session()->getFlashdata('auth_error')) ?></div>
      <?php endif; ?>

      <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="you@company.com" required autofocus>
        </div>
        <div class="form-field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
        </div>
        <?= view('partials/turnstile_widget', ['action' => 'login']) ?>
        <button type="submit" class="btn btn-primary btn-block">Log In</button>
      </form>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
