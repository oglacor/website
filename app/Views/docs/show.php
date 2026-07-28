<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="blog-post wrap">
  <a href="<?= esc($backUrl) ?>" class="form-note" style="display:inline-block; margin-bottom:20px;">&larr; Back to docs</a>
  <div class="meta"><?= esc(ucfirst($doc['section'])) ?> Docs</div>
  <h1><?= esc($doc['title']) ?></h1>
  <div class="content">
    <?= $doc['body'] /* trusted admin-authored HTML, same pattern as blog posts */ ?>
  </div>
</div>

<?= $this->endSection() ?>
