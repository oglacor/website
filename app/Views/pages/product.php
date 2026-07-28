<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Product</span>
  <h1>A full game engine under your content.</h1>
  <p>Not badges bolted onto a course — BLUERABBIT wraps your learning content, quests, and challenges in a real progression system: currencies, a visual journey map, achievements, and guilds.</p>
</div>

<div class="content-section" style="padding-top:0;">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Three Currencies</span>
      <h2>XP, BLOO &amp; EP — tuned per adventure</h2>
      <p>Every organization ("Adventure") can relabel these to fit its own theme — the mechanics stay the same underneath.</p>
    </div>
    <div class="term-grid">
      <div class="term-card panel cyan">
        <div class="k">XP</div>
        <h4>Experience Points</h4>
        <p>Earned from quests, steps, and achievements. Drives Level against a per-adventure XP threshold table — leveling up can unlock new content and trigger achievements automatically.</p>
      </div>
      <div class="term-card panel yellow">
        <div class="k">BLOO</div>
        <h4>In-Adventure Currency</h4>
        <p>Earned as quest and achievement rewards. Spend it in the Item Shop on consumables, keys, and rewards — or to unlock a milestone early.</p>
      </div>
      <div class="term-card panel purple">
        <div class="k">EP</div>
        <h4>Energy Points</h4>
        <p>Gates Random Encounters and Objectives. Starts at 100 and its cap scales with level — run out, and you'll need to recharge before continuing.</p>
      </div>
    </div>
  </div>
</div>

<div class="content-section alt">
  <div class="wrap two-col">
    <div>
      <span class="eyebrow">Journey Map</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">A map players actually want to explore</h2>
      <p style="color:var(--muted); font-size:15px; margin-bottom:20px;">A visual, zoomable canvas where every quest appears as a milestone node — locked, available, or finished. Nodes group under "Tabis," decorative chapter layers that unlock behind their own prerequisites, so the map itself tells a story as players progress.</p>
      <p style="color:var(--muted); font-size:15px;">Drop-in widgets keep the map alive: a player status HUD for XP/BLOO/EP, a live leaderboard, and purely decorative journey assets to sell the theme.</p>
    </div>
    <div class="hero-visual" style="aspect-ratio:1/1;">
      <div class="hex-ring"></div>
      <div class="core"><?= view('partials/rabbit_icon', ['fill' => '#90f3fe', 'size' => 180]) ?></div>
    </div>
  </div>
</div>

<div class="content-section">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Quests &amp; Steps</span>
      <h2>Five quest types, a dozen step primitives</h2>
      <p>Quests are the core content unit — unlocked by level, prerequisites, items, achievements, or a start date. Each one is built from Steps, completed in order.</p>
    </div>
    <div class="feature-grid">
      <div class="feature-card panel cyan">
        <div class="feature-icon">&#9670;</div>
        <h3>Quest Types</h3>
        <p>Open-text submission, quiz-style Challenges, Surveys, read-only Missions, and Social actions like sharing to an external platform.</p>
      </div>
      <div class="feature-card panel yellow">
        <div class="feature-icon">&#9635;</div>
        <h3>Step Library</h3>
        <p>Dialogue, open text (optionally AI-graded), multiple-choice, drag-and-drop puzzles, SCORM packages, keyphrase entry, branching paths, and more.</p>
      </div>
      <div class="feature-card panel purple">
        <div class="feature-icon">&#10022;</div>
        <h3>AI-Assisted Grading</h3>
        <p>Open-text steps can be validated by Claude — instant, consistent feedback the player can revise against, at any scale.</p>
      </div>
      <div class="feature-card panel green">
        <div class="feature-icon">&#9889;</div>
        <h3>QR Quick-Complete</h3>
        <p>Quests can carry a scannable QR code that bypasses prerequisites and completes them directly — built for in-person events and bootcamps.</p>
      </div>
      <div class="feature-card panel cyan">
        <div class="feature-icon">&#9672;</div>
        <h3>Achievements</h3>
        <p>Three types — Achievement, Path, and Rank — displayed as hexagonal badges, awarded automatically on level-up or manually by admins.</p>
      </div>
      <div class="feature-card panel yellow">
        <div class="feature-icon">&#9636;</div>
        <h3>Guilds</h3>
        <p>Team structures with their own XP and BLOO pools, a computed Guild Level, and a live leaderboard rank.</p>
      </div>
    </div>
  </div>
</div>

<div class="content-section alt">
  <div class="wrap two-col">
    <div>
      <span class="eyebrow">Items &amp; Backpack</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Consumables, keys, and rewards</h2>
      <p style="color:var(--muted); font-size:15px;">Items are priced in BLOO and gated by player level — found in quests or bought in the Item Shop, then stored in each player's Backpack. It's a real economy layered on top of the learning content, not a cosmetic afterthought.</p>
    </div>
    <div>
      <span class="eyebrow">Stats Dashboard</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Know what's actually working</h2>
      <p style="color:var(--muted); font-size:15px;">Funnel views, engagement, and completion analytics so admins can see where players stall out — and fix it before it becomes a pattern.</p>
    </div>
  </div>
</div>

<div class="cta-band">
  <div class="wrap">
    <h2>See it running on your content.</h2>
    <p>Join the waitlist to be first in line when the rebuilt core opens up.</p>
    <div class="cta-row">
      <a href="<?= site_url('/') ?>#waitlist-hero" class="btn btn-primary">Get On The Waitlist</a>
      <a href="<?= site_url('solutions') ?>" class="btn btn-ghost">See Use Cases</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
