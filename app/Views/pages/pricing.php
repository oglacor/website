<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Pricing</span>
  <h1>Start free. Scale when you're ready.</h1>
  <p>The plans differ in how much room you get: players, Adventures and storage. Nothing checks out on this site. Create an account and choose your plan inside the BLUERABBIT app.</p>
</div>

<div class="wrap" style="padding-bottom:40px;">
  <div class="pricing-grid">
    <div class="price-card panel">
      <div class="plan-name">Basic</div>
      <div class="plan-price">$0</div>
      <div class="plan-note">Free, forever</div>
      <ul>
        <li>Up to 90 players</li>
        <li>Up to 3 Adventures</li>
        <li>50MB of storage</li>
      </ul>
      <a href="<?= PLAY_APP_URL ?>" class="btn btn-ghost btn-block">Get Started Free</a>
    </div>

    <div class="price-card panel featured">
      <div class="plan-name">Pro</div>
      <div class="plan-price">$8<small>/mo</small></div>
      <div class="plan-note">or $80/yr (2 months free) &middot; 30-day free trial</div>
      <ul>
        <li>Up to 250 players</li>
        <li>Up to 20 Adventures</li>
        <li>200MB of storage</li>
      </ul>
      <a href="<?= PLAY_APP_URL ?>" class="btn btn-primary btn-block">Start Free Trial</a>
    </div>

    <div class="price-card panel">
      <div class="plan-name">Enterprise</div>
      <div class="plan-price">Contact Us</div>
      <div class="plan-note">Sales-assisted onboarding</div>
      <ul>
        <li>No player, Adventure or storage limits</li>
        <li>Organizations for multi-Adventure programs</li>
        <li>Single Sign-On with Microsoft Entra ID</li>
        <li>Platform-wide branding &amp; custom labels</li>
        <li>Dedicated onboarding &amp; priority support</li>
      </ul>
      <a href="<?= site_url('contact') ?>" class="btn btn-ghost btn-block">Talk To Sales</a>
    </div>
  </div>

  <p class="pricing-caveat">Player limits count everyone across all the Adventures on your account. Plan billing (monthly or annual, upgrades, invoices) is handled entirely inside the BLUERABBIT app via Stripe; this page links you to account creation and never processes payment itself. Pricing is subject to change, and the app always shows the current price before you subscribe.</p>
</div>

<div class="cta-band">
  <div class="wrap">
    <h2>Start free. Upgrade when you need to.</h2>
    <p>No credit card required for Basic. Pro comes with a 30-day trial.</p>
    <div class="cta-row">
      <a href="<?= PLAY_APP_URL ?>" class="btn btn-primary">Create Your Account</a>
      <a href="<?= site_url('product') ?>" class="btn btn-ghost">See What's Included</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
