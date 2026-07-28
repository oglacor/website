<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Documentation</span>
  <h1>Docs</h1>
  <p>Everything below is open to everyone. The architecture &amp; API reference is gated to site admins and collaborators.</p>
</div>

<div class="wrap" style="padding-bottom:100px;">
  <div class="content-section" style="padding-top:0;">
    <div class="section-head">
      <span class="eyebrow">Using The Platform</span>
      <h2>End-User &amp; Onboarding</h2>
    </div>
    <?php if (empty($userDocs) && empty($setupDocs)): ?>
      <div class="empty-state panel">Docs content is being written — check back soon.</div>
    <?php else: ?>
      <div class="feature-grid">
        <?php foreach (array_merge($userDocs, $setupDocs) as $doc): ?>
          <a href="<?= site_url('docs/' . $doc['slug']) ?>" class="feature-card panel cyan">
            <div class="feature-icon">&#9636;</div>
            <h3><?= esc($doc['title']) ?></h3>
            <p><?= esc(mb_strimwidth(strip_tags($doc['body']), 0, 130, '…')) ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="split" style="margin-top:20px;">
    <div class="split-card panel">
      <span class="tag tag-locked">Admin Only</span>
      <h3>Architecture &amp; API</h3>
      <p>Full technical reference for the CI4 core — routes, models, and the data layer.</p>
      <?php if (session()->get('user_role') === 'admin'): ?>
        <a href="<?= site_url('docs/developer') ?>" class="btn btn-primary btn-sm">Open Developer Docs &rarr;</a>
      <?php else: ?>
        <a href="<?= site_url('login') ?>" class="btn btn-ghost btn-sm">Log In &rarr;</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
