<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bad Request — BLUERABBIT</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
<link rel="icon" type="image/svg+xml" href="<?= base_url('assets/img/favicon.svg') ?>">
<link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
</head>
<body>

<header>
  <nav>
    <a href="<?= site_url('/') ?>" class="logo">
      <img src="<?= base_url('assets/img/logo-full-for-dark-bg.svg') ?>" alt="BLUERABBIT">
    </a>
  </nav>
</header>

<section class="hero" style="padding:120px 0; text-align:center;">
  <div class="wrap" style="max-width:640px;">
    <div class="hero-visual" style="aspect-ratio:1/1; max-width:220px; margin:0 auto 40px;">
      <div class="hex-ring"></div>
      <div class="core"><img src="<?= base_url('assets/img/cooper-white.svg') ?>" alt=""></div>
    </div>
    <span class="eyebrow">Error 400</span>
    <h1 style="font-size:38px;">That request didn't check out.</h1>
    <p class="lede" style="margin:0 auto 34px;">
      <?php if (ENVIRONMENT !== 'production') : ?>
        <?= nl2br(esc($message)) ?>
      <?php else : ?>
        Something about that request wasn't right — often a stale form or an expired session. Try again from the previous page.
      <?php endif; ?>
    </p>
    <div class="cta-row" style="justify-content:center;">
      <a href="<?= site_url('/') ?>" class="btn btn-primary">Back to Home</a>
    </div>
  </div>
</section>

</body>
</html>
