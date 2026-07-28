<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1>Dashboard</h1>
</div>

<div class="term-grid" style="grid-template-columns:repeat(4,1fr);">
  <div class="term-card panel">
    <div class="k"><?= (int) $stats['posts'] ?></div>
    <h4>Blog Posts</h4>
    <p><a href="<?= site_url('admin/blog') ?>" style="color:var(--cyan-text);">Manage &rarr;</a></p>
  </div>
  <div class="term-card panel">
    <div class="k"><?= (int) $stats['docs'] ?></div>
    <h4>Docs Pages</h4>
    <p><a href="<?= site_url('admin/docs') ?>" style="color:var(--cyan-text);">Manage &rarr;</a></p>
  </div>
  <div class="term-card panel">
    <div class="k"><?= (int) $stats['signups'] ?></div>
    <h4>Waitlist Signups</h4>
    <p><a href="<?= site_url('admin/waitlist') ?>" style="color:var(--cyan-text);">View &rarr;</a></p>
  </div>
  <div class="term-card panel">
    <div class="k"><?= (int) $stats['newMessages'] ?></div>
    <h4>New Contact Messages</h4>
    <p><a href="<?= site_url('admin/settings') ?>" style="color:var(--cyan-text);">Settings &rarr;</a></p>
  </div>
</div>

<?= $this->endSection() ?>
