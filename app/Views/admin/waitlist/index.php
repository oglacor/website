<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1>Waitlist</h1>
  <span class="status-pill active"><?= count($signups) ?> total</span>
</div>

<div class="two-col" style="align-items:start; gap:24px; grid-template-columns:1fr 1.4fr;">
  <form class="panel" style="padding:28px;" action="<?= site_url('admin/waitlist/send') ?>" method="post">
    <?= csrf_field() ?>
    <div class="eyebrow" style="margin-bottom:16px;">Send Campaign</div>
    <div class="form-field">
      <label for="subject">Subject</label>
      <input type="text" id="subject" name="subject" placeholder="Early access is open" required>
    </div>
    <div class="form-field">
      <label for="body">Message</label>
      <textarea id="body" name="body" style="min-height:160px;" placeholder="Plain text — line breaks become paragraphs." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-block" onclick="return confirm('Send this to every subscribed signup?');">Send to All Subscribed</button>
    <p class="form-note">Requires a Resend API key — set it in <a href="<?= site_url('admin/settings') ?>">Settings</a> first.</p>
  </form>

  <div class="panel table-wrap">
    <table class="data-table">
      <thead><tr><th>Email</th><th>Source</th><th>Status</th><th>Notified</th><th>Signed Up</th></tr></thead>
      <tbody>
        <?php if (empty($signups)): ?>
          <tr><td colspan="5">No signups yet.</td></tr>
        <?php endif; ?>
        <?php foreach ($signups as $signup): ?>
          <tr>
            <td><?= esc($signup['email']) ?></td>
            <td><?= esc($signup['source'] ?? '—') ?></td>
            <td><span class="status-pill active"><?= esc($signup['status']) ?></span></td>
            <td><?= $signup['notified_at'] ? esc(date('M j, Y', strtotime($signup['notified_at']))) : '—' ?></td>
            <td><?= esc(date('M j, Y', strtotime($signup['created_at']))) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
