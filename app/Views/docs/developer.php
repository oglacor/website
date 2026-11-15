<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Admin Only</span>
  <h1>Developer Docs</h1>
  <p>Start with <a href="<?= site_url('docs/developer/start-here') ?>" style="color:var(--cyan-text);">Start Here</a>: what this site is, how to run and deploy it, how its docs map to the app, and what is still open for launch.</p>
</div>

<div class="wrap" style="padding-bottom:100px;">
  <?php if (empty($docs)): ?>
    <div class="empty-state panel">No developer docs published yet — add some from <a href="<?= site_url('admin/docs') ?>" style="color:var(--cyan-text);">Admin &rarr; Docs</a>.</div>
  <?php else: ?>
    <div class="feature-grid">
      <?php foreach ($docs as $doc): ?>
        <a href="<?= site_url('docs/developer/' . $doc['slug']) ?>" class="feature-card panel purple">
          <div class="feature-icon">&#128274;</div>
          <h3><?= esc($doc['title']) ?></h3>
          <p><?= esc(mb_strimwidth(strip_tags($doc['body']), 0, 130, '…')) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
