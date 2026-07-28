<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1>Blog Posts</h1>
  <a href="<?= site_url('admin/blog/new') ?>" class="btn btn-primary btn-sm">+ New Post</a>
</div>

<div class="panel table-wrap">
  <table class="data-table">
    <thead>
      <tr><th>Title</th><th>Category</th><th>Status</th><th>Published</th><th></th></tr>
    </thead>
    <tbody>
      <?php if (empty($posts)): ?>
        <tr><td colspan="5">No posts yet — <a href="<?= site_url('admin/blog/new') ?>" style="color:var(--cyan-text);">create the first one</a>.</td></tr>
      <?php endif; ?>
      <?php foreach ($posts as $post): ?>
        <tr>
          <td><?= esc($post['title']) ?></td>
          <td><?= esc($post['category'] ?? '—') ?></td>
          <td><span class="status-pill <?= esc($post['status']) ?>"><?= esc($post['status']) ?></span></td>
          <td><?= $post['published_at'] ? esc(date('M j, Y', strtotime($post['published_at']))) : '—' ?></td>
          <td class="action-row">
            <a href="<?= site_url('admin/blog/' . $post['id'] . '/edit') ?>" class="btn btn-ghost icon-btn">Edit</a>
            <form action="<?= site_url('admin/blog/' . $post['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Delete this post?');">
              <?= csrf_field() ?>
              <button type="submit" class="btn btn-danger icon-btn">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
