<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($title ?? 'BLUERABBIT') ?></title>
<meta name="description" content="<?= esc($metaDescription ?? "BLUERABBIT is a gamification platform for corporate L&D, onboarding, and bootcamps.") ?>">
<link rel="icon" href="data:,">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
<?= $this->renderSection('head') ?>
</head>
<body>

<header>
  <nav>
    <a href="<?= site_url('/') ?>" class="logo">
      <?= view('partials/rabbit_icon', ['fill' => '#1cc2eb']) ?>
      <span>BLUE<b>RABBIT</b></span>
    </a>
    <div class="nav-links">
      <a href="<?= site_url('product') ?>" class="<?= ($activeNav ?? '') === 'product' ? 'active' : '' ?>">Product</a>
      <a href="<?= site_url('solutions') ?>" class="<?= ($activeNav ?? '') === 'solutions' ? 'active' : '' ?>">Solutions</a>
      <a href="<?= site_url('pricing') ?>" class="<?= ($activeNav ?? '') === 'pricing' ? 'active' : '' ?>">Pricing</a>
      <a href="<?= site_url('blog') ?>" class="<?= ($activeNav ?? '') === 'blog' ? 'active' : '' ?>">Blog</a>
      <a href="<?= site_url('docs') ?>" class="<?= ($activeNav ?? '') === 'docs' ? 'active' : '' ?>">Docs</a>
    </div>
    <div class="nav-cta">
      <?php if (session()->get('user_id')): ?>
        <?php if (session()->get('user_role') === 'admin'): ?>
          <a href="<?= site_url('admin') ?>" class="btn btn-ghost btn-sm">Admin</a>
        <?php else: ?>
          <a href="<?= site_url('account') ?>" class="btn btn-ghost btn-sm">Account</a>
        <?php endif; ?>
        <a href="<?= site_url('logout') ?>" class="btn btn-primary btn-sm">Log Out</a>
      <?php else: ?>
        <a href="<?= site_url('login') ?>" class="btn btn-ghost btn-sm">Log In</a>
        <a href="<?= site_url('/') ?>#waitlist-hero" class="btn btn-primary btn-sm">Join Waitlist</a>
      <?php endif; ?>
    </div>
  </nav>
</header>

<?= $this->renderSection('content') ?>

<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="logo">
          <?= view('partials/rabbit_icon', ['fill' => '#1cc2eb', 'size' => 26]) ?>
          <span>BLUE<b>RABBIT</b></span>
        </div>
        <p>A gamification platform for teams who'd rather build a journey than a slide deck.</p>
      </div>
      <div class="footer-col">
        <h5>Product</h5>
        <a href="<?= site_url('product') ?>">Overview</a>
        <a href="<?= site_url('solutions') ?>">How It Works</a>
        <a href="<?= site_url('pricing') ?>">Pricing</a>
        <a href="<?= site_url('get-started') ?>">Open CI4 Beta</a>
      </div>
      <div class="footer-col">
        <h5>Resources</h5>
        <a href="<?= site_url('blog') ?>">Blog</a>
        <a href="<?= site_url('docs') ?>">Documentation</a>
        <a href="<?= site_url('/') ?>#waitlist-hero">Waitlist</a>
        <a href="<?= site_url('contact') ?>">Contact</a>
      </div>
      <div class="footer-col">
        <h5>Company</h5>
        <a href="<?= site_url('login') ?>">Log In</a>
        <a href="<?= site_url('get-started') ?>">Get Started</a>
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> BLUERABBIT. All rights reserved.</span>
      <span>Built on CodeIgniter 4 &middot; Seattle, WA</span>
    </div>
  </div>
</footer>

</body>
</html>
