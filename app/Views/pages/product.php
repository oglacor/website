<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Product</span>
  <h1>A full game engine under your content.</h1>
  <p>Not badges bolted onto a course — BLUERABBIT wraps your learning content, milestones, and challenges in a real progression system: currencies, a visual journey map, a social Garden, encounters with real stakes, achievements, and guilds.</p>
</div>

<div class="content-section" style="padding-top:0;">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Three Currencies</span>
      <h2>XP, BLOO &amp; EP — tuned per adventure</h2>
      <p>Every Adventure can relabel these to fit its own theme — the mechanics stay the same underneath.</p>
    </div>
    <div class="term-grid">
      <div class="term-card panel cyan">
        <div class="k">XP</div>
        <h4>Experience Points</h4>
        <p>Earned from milestones, challenges, tasks, and achievements. Levels follow a fixed curve, and leveling up can unlock content and award ranks automatically. It can go down, too — a bad call in an encounter can cost a level.</p>
      </div>
      <div class="term-card panel yellow">
        <div class="k">BLOO</div>
        <h4>In-Adventure Currency</h4>
        <p>Spend it in the Item Shop on consumables, keys, collectible Tabi pieces, or real gift cards — and on the choices you make in an encounter. It can dip into debt, but the shop never sells on credit.</p>
      </div>
      <div class="term-card panel purple">
        <div class="k">EP</div>
        <h4>Energy Points</h4>
        <p>Its own switch per adventure. Spent on the choices inside encounters and won back through Garden Tasks. The ceiling rises with level, and it never drops below zero — there's always a free option.</p>
      </div>
    </div>
  </div>
</div>

<div class="content-section alt">
  <div class="wrap two-col">
    <div>
      <span class="eyebrow">Journey Map</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">A map players actually want to explore</h2>
      <p style="color:var(--muted); font-size:15px; margin-bottom:20px;">A visual, zoomable canvas — or a list, if you'd rather — where every milestone is a node: available, finished, locked, or waiting on a level or a date. Milestones group into "Tabis," chapters that unlock behind their own prerequisites and can carry artwork that evolves as each player progresses, so the map tells every player their own story.</p>
      <p style="color:var(--muted); font-size:15px;">Four depth layers give it real parallax as players pan. Drop-in widgets keep it alive: a status HUD, journey progress, leaderboards, tasks, messages, help requests, achievements, and the backpack — each one showing every player their own numbers.</p>
    </div>
    <div class="hero-visual" style="aspect-ratio:1/1;">
      <div class="hex-ring"></div>
      <div class="core"><img src="<?= base_url('assets/img/cooper-white.svg') ?>" alt=""></div>
    </div>
  </div>
</div>

<div class="content-section">
  <div class="wrap two-col">
    <div class="hero-visual" style="aspect-ratio:1/1;">
      <div class="hex-ring"></div>
      <div class="core"><img src="<?= base_url('assets/img/cooper-white.svg') ?>" alt=""></div>
    </div>
    <div>
      <span class="eyebrow">The Garden</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Progression isn't only individual</h2>
      <p style="color:var(--muted); font-size:15px; margin-bottom:20px;">The Journey tracks how a player grows. The <strong>Garden</strong> tracks who they grow with — a second play area where every colleague in the adventure appears as a living node, coloured by what they're best at.</p>
      <p style="color:var(--muted); font-size:15px; margin-bottom:20px;">Here's the part that makes it work: <strong>neglected relationships visibly wither.</strong> Someone you spoke to today shows in full colour. Leave a connection alone and it drains away to grey. Nobody has to be told their network is going stale — they can see it.</p>
      <p style="color:var(--muted); font-size:15px;">Players recognise each other with Blooms tied to specific skills, ask for and give help, connect with the people who matter to them, and take on Missions that push them to reach out. It turns soft skills into something you can actually observe happening — and measure.</p>
    </div>
  </div>
</div>

<div class="content-section alt">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Milestones &amp; Steps</span>
      <h2>Two content types, 28 step types</h2>
      <p>Milestones are the core content unit — unlocked by level, dates, prerequisites, items, achievements, or any condition you can measure. Each one is built from Steps, played in order.</p>
    </div>
    <div class="feature-grid">
      <div class="feature-card panel cyan">
        <div class="feature-icon">&#9670;</div>
        <h3>Milestones &amp; Challenges</h3>
        <p>Milestones give players knowledge — content, exercises, submissions, media. Challenges test it, with a question bank, a pass threshold, and limited retries enforced on the server.</p>
      </div>
      <div class="feature-card panel yellow">
        <div class="feature-icon">&#9635;</div>
        <h3>Step Library</h3>
        <p>28 types across six groups: deliver (dialogue, video, audio), validate (multiple choice, keyphrase, cryptex, puzzle, SCORM, case studies), collect (open text, surveys, ratings, polls, uploads), profile (weighted questions and result sheets), flow (branching, jumps, and encounter choices), and special (win and fail screens, nickname, avatar).</p>
      </div>
      <div class="feature-card panel purple">
        <div class="feature-icon">&#10022;</div>
        <h3>AI-Assisted Grading</h3>
        <p>Open-text steps can be checked by Claude against your private rubric, at the strictness you set — instant feedback players revise against, plus Validate All for a whole cohort with the cost shown up front.</p>
      </div>
      <div class="feature-card panel green">
        <div class="feature-icon">&#9889;</div>
        <h3>QR Check-Ins</h3>
        <p>Achievements and tasks carry scannable QR codes — a badge scanned at the door, a repeatable check-in at every station, with codes you can hide from the app or regenerate. Built for in-person events and bootcamps.</p>
      </div>
      <div class="feature-card panel cyan">
        <div class="feature-icon">&#9672;</div>
        <h3>Achievements &amp; Certificates</h3>
        <p>Badges, Paths, and Ranks — awarded automatically when players meet their conditions or reach a level, by magic code or QR, or by hand. Plus printable certificates that unlock on their own terms.</p>
      </div>
      <div class="feature-card panel yellow">
        <div class="feature-icon">&#9636;</div>
        <h3>Guilds</h3>
        <p>Team structures with combined XP and BLOO, a Guild Level from their members' average, appointed leaders, and a live leaderboard.</p>
      </div>
    </div>
  </div>
</div>

<div class="content-section">
  <div class="wrap two-col">
    <div>
      <span class="eyebrow">Random Encounters</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">The world pushes back</h2>
      <p style="color:var(--muted); font-size:15px;">Encounters are card draws. When the moment comes, a player is dealt a hand of face-down crises and opportunities on the Journey, turns one over, and stays locked into it until it's resolved. Every choice carries a price in BLOO, energy, or even XP, shown up front — and a bad call can put them in debt. Real stakes, inside a training program.</p>
    </div>
    <div>
      <span class="eyebrow">Profile Tests</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Know who you're training</h2>
      <p style="color:var(--muted); font-size:15px;">Measure a player type, a working style, or a team role by weaving weighted questions into ordinary milestones — nobody has to sit a questionnaire. Each player gets a character sheet in their Journal, and you get the cohort's shape on the Stats page. The official HEXAD installs in one click.</p>
    </div>
  </div>
</div>

<div class="content-section alt">
  <div class="wrap two-col">
    <div>
      <span class="eyebrow">Items &amp; Backpack</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Five item types, one real economy</h2>
      <p style="color:var(--muted); font-size:15px;">Consumables, keys, rewards, collectible Tabi pieces, and real gift cards — priced in BLOO, gated by level, found in milestones or bought in the Item Shop, then stored in each player's Backpack. Stock and limits are enforced on the server, so the economy holds up at scale.</p>
    </div>
    <div>
      <span class="eyebrow">Stats Dashboard</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Know what's actually working</h2>
      <p style="color:var(--muted); font-size:15px;">Funnel views, engagement by any segment you track, real time-in-app, encounter choices, and profile results — so admins can see where players stall out, and fix it before it becomes a pattern.</p>
    </div>
  </div>
</div>

<div class="cta-band">
  <div class="wrap">
    <h2>See it running on your content.</h2>
    <p>Join the waitlist to be first in line when the rebuilt core opens up.</p>
    <div class="cta-row">
      <a href="<?= site_url('/') ?>#waitlist-hero-anchor" class="btn btn-primary">Get On The Waitlist</a>
      <a href="<?= site_url('solutions') ?>" class="btn btn-ghost">See Use Cases</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
