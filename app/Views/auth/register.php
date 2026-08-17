<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="auth-shell">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel">
      <span class="eyebrow">Open Beta</span>
      <h1>Get Started</h1>
      <p class="sub">Create your bluerabbit.io account. Plan upgrades and billing happen inside the app once you're in.</p>

      <?php if (session()->getFlashdata('auth_error')): ?>
        <div class="form-alert error"><?= esc(session()->getFlashdata('auth_error')) ?></div>
      <?php endif; ?>

      <form action="<?= site_url('get-started') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="<?= esc(old('name')) ?>" placeholder="Jane Smith" required autofocus>
        </div>
        <div class="form-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="you@company.com" required>
        </div>
        <div class="form-field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="At least 8 characters" minlength="8" required>
        </div>
        <?= view('partials/turnstile_widget', ['action' => 'register']) ?>
        <button type="submit" class="btn btn-primary btn-block">Create Account</button>
      </form>

      <p class="form-note">Already have an account? <a href="<?= site_url('login') ?>">Log in</a></p>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
