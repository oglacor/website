<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Relaunching Soon</span>
      <h1>BLUERABBIT is making a <span class="accent">comeback</span> &mdash; on steroids.</h1>
      <p class="lede">Rebuilt faster and more powerful than ever. New features, new capabilities, full A.I. integration, and new tools built to drive engagement to infinity. Get on the list before we flip the switch.</p>

      <?php if (session()->getFlashdata('waitlist_success')): ?>
        <div class="hero-waitlist" id="waitlist-hero">
          <div class="label"><span class="blip"></span> You're On The List</div>
          <p class="success"><?= esc(session()->getFlashdata('waitlist_success')) ?></p>
        </div>
      <?php else: ?>
        <div class="hero-waitlist" id="waitlist-hero">
          <div class="label"><span class="blip"></span> Get On The Waitlist</div>
          <form action="<?= site_url('waitlist') ?>" method="post">
            <?= csrf_field() ?>
            <input type="email" name="email" placeholder="you@company.com" value="<?= esc(old('email')) ?>" required>
            <button type="submit" class="btn btn-primary">Notify Me</button>
          </form>
          <?php if (session()->getFlashdata('waitlist_error')): ?>
            <p class="error"><?= esc(session()->getFlashdata('waitlist_error')) ?></p>
          <?php endif; ?>
          <p class="fine">Early access, launch pricing, and first look at the new build. No spam &mdash; unsubscribe anytime.</p>
        </div>
      <?php endif; ?>

      <div class="hero-pills">
        <span class="hero-pill">&#9889; 10x Faster Core</span>
        <span class="hero-pill">&#9670; Full A.I. Integration</span>
        <span class="hero-pill">&#9635; Infinite Engagement Tools</span>
      </div>

      <a href="<?= site_url('docs') ?>" class="btn btn-ghost btn-sm">Explore the Docs &rarr;</a>
    </div>
    <div class="hero-visual">
      <div class="hex-ring"></div>
      <div class="core"><?= view('partials/rabbit_icon', ['fill' => '#90f3fe', 'size' => 220]) ?></div>
      <div class="hero-badge badge-1"><span class="dot" style="background:#1cc2eb;"></span> A.I. Content Engine</div>
      <div class="hero-badge badge-2"><span class="dot" style="background:#24da98;"></span> Rebuilt From The Core</div>
      <div class="hero-badge badge-3"><span class="dot" style="background:#f7cb15;"></span> Engagement &times; Infinity</div>
    </div>
  </div>
</section>

<div class="marquee-section">
  <div class="wrap">
    <p>Built for L&amp;D teams, onboarding programs &amp; bootcamps</p>
    <div class="marquee-row">
      <span>Corporate L&amp;D</span><span>Employee Onboarding</span><span>Bootcamps</span><span>Loyalty Programs</span><span>Education</span>
    </div>
  </div>
</div>

<section id="product">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Product</span>
      <h2>Everything a learning journey needs</h2>
      <p>Every mechanic maps to a real BLUERABBIT system &mdash; this isn't a badges-bolted-on gamification layer, it's a full game engine underneath your content.</p>
    </div>
    <div class="feature-grid">
      <div class="feature-card panel cyan">
        <div class="feature-icon">&#9672;</div>
        <h3>Journey Map</h3>
        <p>A visual, explorable map of milestones &mdash; locked, available, and finished states drive players forward naturally.</p>
      </div>
      <div class="feature-card panel yellow">
        <div class="feature-icon">&#9889;</div>
        <h3>XP &middot; BLOO &middot; EP</h3>
        <p>Three-currency reward architecture: progression XP, spendable currency, and energy &mdash; tuned per adventure.</p>
      </div>
      <div class="feature-card panel purple">
        <div class="feature-icon">&#9670;</div>
        <h3>Achievements &amp; Guilds</h3>
        <p>Ranks, paths, and team guilds with leaderboards &mdash; real social structure, not just a certificate at the end.</p>
      </div>
      <div class="feature-card panel green">
        <div class="feature-icon">&#9635;</div>
        <h3>Quests, Challenges &amp; Steps</h3>
        <p>20+ step types &mdash; dialogue, puzzles, SCORM, branching choices, quizzes &mdash; built from reusable step primitives.</p>
      </div>
      <div class="feature-card panel cyan">
        <div class="feature-icon">&#9636;</div>
        <h3>Stats Dashboard</h3>
        <p>Funnel views, engagement, and completion analytics so admins actually know what's working.</p>
      </div>
      <div class="feature-card panel yellow">
        <div class="feature-icon">&#10022;</div>
        <h3>AI-Assisted Grading</h3>
        <p>Open-text steps can be validated by Claude &mdash; instant, consistent feedback at scale.</p>
      </div>
    </div>
  </div>
</section>

<section id="solutions" style="padding-top:0;">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">How It Works</span>
      <h2>From idea to a live adventure in three steps</h2>
    </div>
    <div class="steps">
      <div class="step panel">
        <span class="num">01</span>
        <h3>Design the journey</h3>
        <p>Build quests, steps, and rewards in the builder &mdash; or start from a template adventure.</p>
      </div>
      <div class="step panel">
        <span class="num">02</span>
        <h3>Enroll your people</h3>
        <p>Bulk-enroll players, assign guilds and roles, and set who sees what.</p>
      </div>
      <div class="step panel">
        <span class="num">03</span>
        <h3>Watch it run itself</h3>
        <p>Players progress, level up, and compete &mdash; you just watch the stats dashboard.</p>
      </div>
    </div>
  </div>
</section>

<section id="docs">
  <div class="wrap">
    <div class="split">
      <div class="split-card panel">
        <span class="tag tag-open">Public</span>
        <h3>Documentation</h3>
        <p>End-user guides, onboarding, and product docs are open to everyone. Architecture &amp; API reference is gated &mdash; site admins and collaborators only.</p>
        <ul class="doc-list">
          <li>Using the platform <span class="k">USER</span></li>
          <li>Onboarding &amp; billing (Stripe) <span class="k">SETUP</span></li>
          <li>Product &amp; platform overview <span class="k">USER</span></li>
          <li>Architecture &amp; API reference <span class="k">ADMIN</span></li>
        </ul>
        <a href="<?= site_url('docs') ?>" class="btn btn-ghost btn-sm">Browse Docs &rarr;</a>
      </div>
      <div class="split-card panel">
        <span class="tag tag-open">Open Beta</span>
        <h3>What's Coming</h3>
        <p>The rebuild isn't a coat of paint &mdash; it's a new core. Here's what changes when we flip the switch.</p>
        <ul class="doc-list">
          <li>Full A.I.-integrated content &amp; grading <span class="k">NEW</span></li>
          <li>Rebuilt engagement engine, tuned for scale <span class="k">NEW</span></li>
          <li>Stripe billing on the open CI4 core <span class="k">NEW</span></li>
          <li>10x faster journey &amp; stats rendering <span class="k">NEW</span></li>
        </ul>
        <a href="#waitlist-hero" class="btn btn-primary btn-sm">Get On The Waitlist &uarr;</a>
      </div>
    </div>
  </div>
</section>

<section id="blog">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">From the Blog</span>
      <h2>Notes on gamification &amp; product</h2>
    </div>
    <?php if (empty($posts)): ?>
      <div class="empty-state panel">No posts published yet &mdash; check back soon.</div>
    <?php else: ?>
      <div class="blog-grid">
        <?php foreach ($posts as $post): ?>
          <a href="<?= site_url('blog/' . $post['slug']) ?>" class="blog-card panel">
            <div class="thumb"></div>
            <div class="body">
              <div class="meta"><?= esc($post['category'] ?? 'Update') ?> &middot; <?= esc(date('M Y', strtotime($post['published_at']))) ?></div>
              <h4><?= esc($post['title']) ?></h4>
              <p><?= esc($post['excerpt']) ?></p>
              <span class="read-more">Read More &rarr;</span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="cta-band">
  <div class="wrap">
    <h2>The comeback starts with you.</h2>
    <p>Be first in line when BLUERABBIT relaunches &mdash; faster, smarter, and built to drive engagement to infinity.</p>
    <div class="cta-row">
      <a href="#waitlist-hero" class="btn btn-primary">Get On The Waitlist</a>
      <a href="<?= site_url('docs') ?>" class="btn btn-ghost">Read the Docs</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
