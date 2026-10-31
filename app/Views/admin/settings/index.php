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

  <div class="eyebrow" style="margin:28px 0 18px;">Legal</div>
  <div class="form-field">
    <label for="legal_entity_name">Company Name</label>
    <input type="text" id="legal_entity_name" name="legal_entity_name" value="<?= esc($legal['legal_entity_name'] ?? '') ?>" placeholder="BlueRabbit LLC">
  </div>
  <div class="form-field">
    <label for="legal_entity_address">Registered Address</label>
    <input type="text" id="legal_entity_address" name="legal_entity_address" value="<?= esc($legal['legal_entity_address'] ?? '') ?>">
  </div>
  <div class="form-field">
    <label for="legal_contact_email">Legal / Privacy Email</label>
    <input type="email" id="legal_contact_email" name="legal_contact_email" value="<?= esc($legal['legal_contact_email'] ?? '') ?>" placeholder="privacy@bluerabbit.io">
  </div>
  <div class="form-field">
    <label for="legal_jurisdiction">Governing Law</label>
    <input type="text" id="legal_jurisdiction" name="legal_jurisdiction" value="<?= esc($legal['legal_jurisdiction'] ?? '') ?>" placeholder="the State of Washington, USA">
  </div>
  <p class="form-note">Named on /terms, /privacy and /refunds. Use the same values as the app's Sys Config &rarr; Legal. Blank fields print a neutral wording; a blank email points people to the contact page.</p>
  <button type="submit" class="btn btn-primary" style="margin-top:10px;">Save Settings</button>
</form>

<?= $this->endSection() ?>
