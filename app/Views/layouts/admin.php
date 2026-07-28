<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="admin-shell">
  <aside class="admin-sidebar">
    <h5>Admin — <?= esc($adminUserName ?? '') ?></h5>
    <a href="<?= site_url('admin') ?>" class="<?= ($activeAdminNav ?? '') === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
    <a href="<?= site_url('admin/blog') ?>" class="<?= ($activeAdminNav ?? '') === 'blog' ? 'active' : '' ?>">Blog</a>
    <a href="<?= site_url('admin/docs') ?>" class="<?= ($activeAdminNav ?? '') === 'docs' ? 'active' : '' ?>">Docs</a>
    <a href="<?= site_url('admin/waitlist') ?>" class="<?= ($activeAdminNav ?? '') === 'waitlist' ? 'active' : '' ?>">Waitlist</a>
    <a href="<?= site_url('admin/settings') ?>" class="<?= ($activeAdminNav ?? '') === 'settings' ? 'active' : '' ?>">Settings</a>
    <a href="<?= site_url('/') ?>" style="margin-top:20px; border-top:1px solid var(--border); padding-top:20px;">&larr; Back to site</a>
  </aside>
  <div class="admin-main">
    <?php if (session()->getFlashdata('admin_success')): ?>
      <div class="form-alert success"><?= esc(session()->getFlashdata('admin_success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('admin_error')): ?>
      <div class="form-alert error"><?= esc(session()->getFlashdata('admin_error')) ?></div>
    <?php endif; ?>
    <?= $this->renderSection('admin_content') ?>
  </div>
</div>

<?= $this->endSection() ?>
