<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Pricing</span>
  <h1>Plans that mirror the live app.</h1>
  <p>Pricing here always matches what's actually configured in the BLUERABBIT app's billing — nothing checks out on this site. Create an account and choose your plan from inside the app.</p>
</div>

<div class="wrap" style="padding-bottom:40px;">
  <div class="pricing-grid">
    <div class="price-card panel">
      <div class="plan-name">Basic</div>
      <div class="plan-price">$0</div>
      <div class="plan-note">Free, forever</div>
      <ul>
        <li>Up to 200 players</li>
        <li>Up to 3 Adventures</li>
        <li>50MB of storage</li>
      </ul>
      <a href="<?= site_url('get-started') ?>" class="btn btn-ghost btn-block">Get Started Free</a>
    </div>

    <div class="price-card panel featured">
      <div class="plan-name">Pro</div>
      <div class="plan-price">$8<small>/mo</small></div>
      <div class="plan-note">or $80/yr (2 months free) &middot; 30-day free trial</div>
      <ul>
        <li>Unlimited players per Adventure</li>
        <li>Unlimited Adventures</li>
        <li>Everything in Basic</li>
      </ul>
      <a href="<?= site_url('get-started') ?>" class="btn btn-primary btn-block">Start Free Trial</a>
    </div>

    <div class="price-card panel">
      <div class="plan-name">Enterprise</div>
      <div class="plan-price">Contact Us</div>
      <div class="plan-note">Sales-assisted onboarding</div>
      <ul>
        <li>Custom player &amp; storage limits</li>
        <li>Dedicated onboarding</li>
        <li>Priority support</li>
      </ul>
      <a href="<?= site_url('contact') ?>" class="btn btn-ghost btn-block">Talk To Sales</a>
    </div>
  </div>

  <p class="pricing-caveat">Plan billing (monthly/annual, upgrades, invoices) is handled entirely inside the BLUERABBIT app via Stripe — this page links you to account creation, it never processes payment itself. Pricing is subject to change; the app is always the source of truth.</p>
</div>

<div class="cta-band">
  <div class="wrap">
    <h2>Start free. Upgrade when you need to.</h2>
    <p>No credit card required for Basic — Pro comes with a 30-day trial.</p>
    <div class="cta-row">
      <a href="<?= site_url('get-started') ?>" class="btn btn-primary">Create Your Account</a>
      <a href="<?= site_url('product') ?>" class="btn btn-ghost">See What's Included</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
