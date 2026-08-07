<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-hero wrap">
  <span class="eyebrow">Documentation</span>
  <h1>Docs</h1>
  <p>Everything below is open to everyone. The architecture &amp; API reference is gated to site admins and collaborators.</p>
</div>

<div class="wrap" style="padding-bottom:100px;">
  <div class="content-section" style="padding-top:0;">
    <div class="section-head">
      <span class="eyebrow">For Players</span>
      <h2>Using the Platform</h2>
      <p>How to enroll, progress through an Adventure, and understand the reward systems as a player.</p>
    </div>
    <?php if (empty($userDocs)): ?>
      <div class="empty-state panel">Player docs are being written — check back soon.</div>
    <?php else: ?>
      <div class="feature-grid">
        <?php foreach ($userDocs as $doc): ?>
          <a href="<?= site_url('docs/' . $doc['slug']) ?>" class="feature-card panel cyan">
            <div class="feature-icon">&#9636;</div>
            <h3><?= esc($doc['title']) ?></h3>
            <p><?= esc(mb_strimwidth(strip_tags($doc['body']), 0, 130, '…')) ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="content-section alt">
    <div class="section-head">
      <span class="eyebrow">For Game Masters &amp; Org Admins</span>
      <h2>Building &amp; Running Adventures</h2>
      <p>Setting up your organization and billing, then a full Game Master manual — designing quests, steps, rewards, guilds, the item shop, branching, roster management, AI grading, and more — plus a worked example that builds a real Adventure end to end.</p>
    </div>
    <?php if (empty($setupDocs)): ?>
      <div class="empty-state panel">Setup docs are being written — check back soon.</div>
    <?php else: ?>
      <div class="feature-grid">
        <?php foreach ($setupDocs as $doc): ?>
          <a href="<?= site_url('docs/' . $doc['slug']) ?>" class="feature-card panel green">
            <div class="feature-icon">&#9670;</div>
            <h3><?= esc($doc['title']) ?></h3>
            <p><?= esc(mb_strimwidth(strip_tags($doc['body']), 0, 130, '…')) ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if (! empty($enterpriseDocs)): ?>
    <div class="content-section" style="padding-bottom:0;">
      <div class="section-head">
        <span class="eyebrow">Scaling Up</span>
        <h2>Enterprise &amp; Organizations</h2>
        <p>Running more than one Adventure under one account — multi-Adventure Organizations, platform-wide branding, and how the plan tiers actually differ in practice.</p>
      </div>
      <div class="feature-grid">
        <?php foreach ($enterpriseDocs as $doc): ?>
          <a href="<?= site_url('docs/' . $doc['slug']) ?>" class="feature-card panel purple">
            <div class="feature-icon">&#9672;</div>
            <h3><?= esc(str_replace(' (Enterprise)', '', $doc['title'])) ?></h3>
            <p><?= esc(mb_strimwidth(strip_tags($doc['body']), 0, 130, '…')) ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="split" style="margin-top:60px;">
    <div class="split-card panel">
      <span class="tag tag-locked">Admin Only</span>
      <h3>Architecture &amp; API</h3>
      <p>Full technical reference for the CI4 core — routes, models, and the data layer.</p>
      <?php if (session()->get('user_role') === 'admin'): ?>
        <a href="<?= site_url('docs/developer') ?>" class="btn btn-primary btn-sm">Open Developer Docs &rarr;</a>
      <?php else: ?>
        <a href="<?= site_url('login') ?>" class="btn btn-ghost btn-sm">Log In &rarr;</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
