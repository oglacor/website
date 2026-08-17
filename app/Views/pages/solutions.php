<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Solutions</span>
  <h1>Built for teams who run people through a journey.</h1>
  <p>Corporate L&amp;D, employee onboarding, and cohort-based bootcamps — the same journey engine adapts to each without a rebuild.</p>
</div>

<div class="content-section" style="padding-top:0;">
  <div class="wrap">
    <div class="usecase-grid">
      <div class="usecase-card panel cyan">
        <span class="eyebrow">Corporate L&amp;D</span>
        <h3>Training That Doesn't Feel Like Training</h3>
        <p>Turn a slide-deck curriculum into a journey map with real milestones, badges, and a leaderboard your team actually checks.</p>
        <ul>
          <li>Quizzes, surveys &amp; SCORM in one flow</li>
          <li>Completion analytics per team</li>
          <li>Guilds for department-level competition</li>
        </ul>
      </div>
      <div class="usecase-card panel green">
        <span class="eyebrow">Employee Onboarding</span>
        <h3>A 90-Day Plan That Runs Itself</h3>
        <p>Build one onboarding template, then spin off a fresh cohort for every new hire class — each one inherits the same content and updates centrally.</p>
        <ul>
          <li>Adventure templates &amp; child adventures</li>
          <li>Level-gated milestones (week 1 vs. week 12)</li>
          <li>Stats dashboard for HR/People Ops</li>
        </ul>
      </div>
      <div class="usecase-card panel purple">
        <span class="eyebrow">Bootcamps &amp; Events</span>
        <h3>Cohort-Based, Live, or Both</h3>
        <p>QR quick-complete quests fit in-person sessions perfectly, while the built-in schedule system (sessions, speakers, sponsors) handles the event side.</p>
        <ul>
          <li>QR-code quest completion</li>
          <li>Session/speaker/sponsor scheduling</li>
          <li>Real-time leaderboard for live cohorts</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="content-section alt">
  <div class="wrap two-col">
    <div>
      <span class="eyebrow">Scale Without Rebuilding</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">One template, many cohorts</h2>
      <p style="color:var(--muted); font-size:15px;">An Adventure can be marked as a template — every child Adventure spun off from it inherits the quests, steps, and rewards, so a new onboarding class or training round takes minutes to launch, not weeks to rebuild.</p>
    </div>
    <div>
      <span class="eyebrow">Events, Not Just Async Learning</span>
      <h2 style="font-family:var(--condensed); font-weight:700; text-transform:uppercase; font-size:30px; margin:14px 0 18px; letter-spacing:.5px;">Live conference gamification</h2>
      <p style="color:var(--muted); font-size:15px;">Sessions, speakers, and sponsors are first-class objects alongside the LMS-style features — the same platform that runs a 12-week onboarding program can run a two-day live event.</p>
    </div>
  </div>
</div>

<div class="marquee-section">
  <div class="wrap">
    <p>Trusted across use cases like these</p>
    <div class="marquee-row">
      <span>Corporate L&amp;D</span><span>Employee Onboarding</span><span>Bootcamps</span><span>Loyalty Programs</span><span>Education</span>
    </div>
  </div>
</div>

<div class="cta-band">
  <div class="wrap">
    <h2>Bring your own content — we'll gamify the delivery.</h2>
    <p>Join the waitlist to get early access when the rebuilt core opens up.</p>
    <div class="cta-row">
      <a href="<?= site_url('/') ?>#waitlist-hero-anchor" class="btn btn-primary">Get On The Waitlist</a>
      <a href="<?= site_url('contact') ?>" class="btn btn-ghost">Talk To Us</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
