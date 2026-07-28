<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="auth-shell">
  <div class="wrap" style="display:flex; justify-content:center;">
    <div class="auth-card panel">
      <span class="eyebrow">Account</span>
      <h1>Welcome, <?= esc(explode(' ', $user['name'])[0]) ?></h1>
      <p class="sub">Your bluerabbit.io site profile.</p>

      <?php if (session()->getFlashdata('auth_success')): ?>
        <div class="form-alert success"><?= esc(session()->getFlashdata('auth_success')) ?></div>
      <?php endif; ?>

      <div class="form-field">
        <label>Name</label>
        <input type="text" value="<?= esc($user['name']) ?>" disabled>
      </div>
      <div class="form-field">
        <label>Email</label>
        <input type="text" value="<?= esc($user['email']) ?>" disabled>
      </div>
      <div class="form-field">
        <label>Role</label>
        <input type="text" value="<?= esc(ucfirst($user['role'])) ?>" disabled>
      </div>

      <p class="form-note">Plan billing and product features live inside the BLUERABBIT app itself — this account only covers bluerabbit.io (docs, waitlist, blog).</p>
      <a href="<?= site_url('logout') ?>" class="btn btn-ghost btn-block" style="margin-top:10px;">Log Out</a>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
