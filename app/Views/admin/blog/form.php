<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1><?= $post['id'] ?? null ? 'Edit Post' : 'New Post' ?></h1>
</div>

<?php if (! empty($errors)): ?>
  <div class="form-alert error">
    <?php foreach ($errors as $error): ?><div><?= esc($error) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<form class="panel" style="padding:32px;" action="<?= ($post['id'] ?? null) ? site_url('admin/blog/' . $post['id']) : site_url('admin/blog') ?>" method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <div class="two-col" style="align-items:start; gap:24px;">
    <div>
      <div class="form-field">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?= esc($post['title'] ?? '') ?>" required>
      </div>
      <div class="form-field">
        <label for="slug">Slug (leave blank to auto-generate)</label>
        <input type="text" id="slug" name="slug" value="<?= esc($post['slug'] ?? '') ?>" placeholder="my-post-title">
      </div>
      <div class="form-field">
        <label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" style="min-height:70px;"><?= esc($post['excerpt'] ?? '') ?></textarea>
      </div>
      <div class="form-field">
        <label for="body">Body</label>
        <textarea id="body" name="body" style="min-height:320px;" required><?= esc($post['body'] ?? '') ?></textarea>
      </div>
    </div>
    <div>
      <div class="form-field">
        <label for="status">Status</label>
        <select id="status" name="status">
          <option value="draft" <?= ($post['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
          <option value="published" <?= ($post['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
        </select>
      </div>
      <div class="form-field">
        <label for="category">Category</label>
        <input type="text" id="category" name="category" value="<?= esc($post['category'] ?? '') ?>" placeholder="Product Updates">
      </div>
      <div class="form-field">
        <label for="featured_image">Featured Image</label>
        <?php if (! empty($post['featured_image'])): ?>
          <p class="form-note" style="margin:0 0 8px;">Current: <?= esc($post['featured_image']) ?></p>
        <?php endif; ?>
        <input type="file" id="featured_image" name="featured_image" accept="image/*">
      </div>
      <div class="form-field">
        <label for="seo_title">SEO Title</label>
        <input type="text" id="seo_title" name="seo_title" value="<?= esc($post['seo_title'] ?? '') ?>">
      </div>
      <div class="form-field">
        <label for="seo_description">SEO Description</label>
        <textarea id="seo_description" name="seo_description" style="min-height:70px;"><?= esc($post['seo_description'] ?? '') ?></textarea>
      </div>
    </div>
  </div>
  <div class="action-row" style="margin-top:10px;">
    <button type="submit" class="btn btn-primary"><?= ($post['id'] ?? null) ? 'Save Changes' : 'Create Post' ?></button>
    <a href="<?= site_url('admin/blog') ?>" class="btn btn-ghost">Cancel</a>
  </div>
</form>

<?= $this->endSection() ?>
