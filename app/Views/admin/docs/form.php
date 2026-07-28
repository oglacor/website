<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1><?= $doc['id'] ?? null ? 'Edit Doc Page' : 'New Doc Page' ?></h1>
</div>

<?php if (! empty($errors)): ?>
  <div class="form-alert error">
    <?php foreach ($errors as $error): ?><div><?= esc($error) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<form class="panel" style="padding:32px;" action="<?= ($doc['id'] ?? null) ? site_url('admin/docs/' . $doc['id']) : site_url('admin/docs') ?>" method="post">
  <?= csrf_field() ?>
  <div class="two-col" style="align-items:start; gap:24px;">
    <div>
      <div class="form-field">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?= esc($doc['title'] ?? '') ?>" required>
      </div>
      <div class="form-field">
        <label for="slug">Slug (leave blank to auto-generate)</label>
        <input type="text" id="slug" name="slug" value="<?= esc($doc['slug'] ?? '') ?>" placeholder="getting-started">
      </div>
      <div class="form-field">
        <label for="body">Body (HTML supported — h2/h3, p, ul/ol, strong, code)</label>
        <textarea id="body" name="body" style="min-height:340px;" required><?= esc($doc['body'] ?? '') ?></textarea>
      </div>
    </div>
    <div>
      <div class="form-field">
        <label for="section">Section</label>
        <select id="section" name="section">
          <option value="user" <?= ($doc['section'] ?? 'user') === 'user' ? 'selected' : '' ?>>End-User (public)</option>
          <option value="setup" <?= ($doc['section'] ?? '') === 'setup' ? 'selected' : '' ?>>Onboarding &amp; Billing (public)</option>
          <option value="developer" <?= ($doc['section'] ?? '') === 'developer' ? 'selected' : '' ?>>Developer (admin-gated)</option>
        </select>
      </div>
      <div class="form-field">
        <label for="status">Status</label>
        <select id="status" name="status">
          <option value="draft" <?= ($doc['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
          <option value="published" <?= ($doc['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
        </select>
      </div>
      <div class="form-field">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" value="<?= esc($doc['sort_order'] ?? 0) ?>">
      </div>
    </div>
  </div>
  <div class="action-row" style="margin-top:10px;">
    <button type="submit" class="btn btn-primary"><?= ($doc['id'] ?? null) ? 'Save Changes' : 'Create Page' ?></button>
    <a href="<?= site_url('admin/docs') ?>" class="btn btn-ghost">Cancel</a>
  </div>
</form>

<?= $this->endSection() ?>
