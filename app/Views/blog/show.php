<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="blog-post wrap">
  <div class="meta"><?= esc($post['category'] ?? 'Update') ?> &middot; <?= esc(date('F j, Y', strtotime($post['published_at']))) ?></div>
  <h1><?= esc($post['title']) ?></h1>
  <div class="content">
    <?= $post['body'] /* trusted admin-authored HTML; sanitize on input in the admin CMS */ ?>
  </div>
  <div class="cta-row" style="justify-content:flex-start; margin-top:40px;">
    <a href="<?= site_url('blog') ?>" class="btn btn-ghost">&larr; Back to Blog</a>
  </div>
</div>

<?= $this->endSection() ?>
