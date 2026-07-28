<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">From the Blog</span>
  <h1>Notes on Gamification &amp; Product</h1>
  <p>Design thinking, product updates, and engineering notes from the BLUERABBIT team.</p>
</div>

<div class="wrap" style="padding-bottom:100px;">
  <?php if (empty($posts)): ?>
    <div class="empty-state panel">No posts published yet &mdash; check back soon.</div>
  <?php else: ?>
    <div class="blog-grid">
      <?php foreach ($posts as $post): ?>
        <a href="<?= site_url('blog/' . $post['slug']) ?>" class="blog-card panel">
          <div class="thumb"></div>
          <div class="body">
            <div class="meta"><?= esc($post['category'] ?? 'Update') ?> &middot; <?= esc(date('M j, Y', strtotime($post['published_at']))) ?></div>
            <h4><?= esc($post['title']) ?></h4>
            <p><?= esc($post['excerpt']) ?></p>
            <span class="read-more">Read More &rarr;</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <div style="margin-top:40px;">
      <?= $pager->links() ?>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
