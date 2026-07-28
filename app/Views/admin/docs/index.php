<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1>Docs Pages</h1>
  <a href="<?= site_url('admin/docs/new') ?>" class="btn btn-primary btn-sm">+ New Doc Page</a>
</div>

<div class="panel table-wrap">
  <table class="data-table">
    <thead>
      <tr><th>Title</th><th>Section</th><th>Status</th><th></th></tr>
    </thead>
    <tbody>
      <?php if (empty($docs)): ?>
        <tr><td colspan="4">No doc pages yet — <a href="<?= site_url('admin/docs/new') ?>" style="color:var(--cyan-text);">create the first one</a>.</td></tr>
      <?php endif; ?>
      <?php foreach ($docs as $doc): ?>
        <tr>
          <td><?= esc($doc['title']) ?></td>
          <td><?= esc(ucfirst($doc['section'])) ?></td>
          <td><span class="status-pill <?= esc($doc['status']) ?>"><?= esc($doc['status']) ?></span></td>
          <td class="action-row">
            <a href="<?= site_url('admin/docs/' . $doc['id'] . '/edit') ?>" class="btn btn-ghost icon-btn">Edit</a>
            <form action="<?= site_url('admin/docs/' . $doc['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Delete this doc page?');">
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
