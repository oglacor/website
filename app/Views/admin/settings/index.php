<?= $this->extend('layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="admin-head">
  <h1>Settings</h1>
</div>

<form class="panel" style="padding:32px; max-width:560px;" action="<?= site_url('admin/settings') ?>" method="post">
  <?= csrf_field() ?>
  <div class="eyebrow" style="margin-bottom:18px;">Resend (Email)</div>
  <div class="form-field">
    <label for="resend_api_key">Resend API Key</label>
    <input type="text" id="resend_api_key" name="resend_api_key" value="<?= esc($resendApiKey ?? '') ?>" placeholder="re_xxxxxxxxxxxx">
  </div>
  <div class="form-field">
    <label for="resend_from_address">From Address</label>
    <input type="text" id="resend_from_address" name="resend_from_address" value="<?= esc($resendFromAddress ?? '') ?>" placeholder="BLUERABBIT &lt;hello@bluerabbit.io&gt;">
  </div>
  <p class="form-note">Used for the waitlist welcome email and admin campaign sends. Leave the API key blank to disable sending — signups are still captured either way.</p>
  <button type="submit" class="btn btn-primary" style="margin-top:10px;">Save Settings</button>
</form>

<?= $this->endSection() ?>
