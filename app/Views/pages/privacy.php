<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/*
 * NEEDS LEGAL REVIEW BEFORE THIS IS RELIED ON.
 *
 * The factual parts — what this site actually collects, which processors it
 * actually uses, what it does not do — were written against the real code and
 * are accurate as of the date below. The legal framing around them is a
 * good-faith draft, not advice.
 *
 * Confirm before publishing:
 *   - the registered legal entity name and address (marked below)
 *   - governing law / jurisdiction
 *   - the concrete retention windows (currently described honestly as
 *     "until you ask us to delete it", which is true but auditors prefer numbers)
 *   - whether a dedicated privacy@ inbox should exist, or /contact is enough
 */
?>

<div class="page-hero wrap">
  <span class="eyebrow">Legal</span>
  <h1>Privacy Policy</h1>
  <p>What this website collects, why, and what you can ask us to do about it.</p>
</div>

<div class="blog-post wrap">
  <div class="meta">Last updated 14 August 2026</div>
  <div class="content">

    <h2>Which site this covers</h2>
    <p>This policy covers <strong>bluerabbit.io</strong> — the marketing site, blog, documentation, waitlist, and contact form you are reading right now.</p>
    <p>It does <strong>not</strong> cover the BLUERABBIT product application at <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, where adventures, player accounts, and gameplay data live. That is a separate application with its own accounts, its own login, and its own database — a site account here is not a product account there, and neither one can log you into the other. If you are a player or a Game Master looking for how your gameplay data is handled, that is governed separately inside the app.</p>

    <h2>What we collect</h2>
    <p>Only what the page you are using actually needs. In full, that is:</p>
    <ul>
      <li><strong>Waitlist signups</strong> — your email address, and which page you signed up from. Nothing else.</li>
      <li><strong>Contact form</strong> — your name, email address, subject, and the message you write.</li>
      <li><strong>Site accounts</strong> — if you register an account on this site, your name, email address, and a securely hashed version of your password. We never store your password itself and cannot read it.</li>
      <li><strong>Session cookie</strong> — a single cookie that keeps you logged in while you use the site.</li>
      <li><strong>Server logs</strong> — standard web request records (IP address, browser user agent, page requested, timestamp), kept for security and debugging.</li>
    </ul>

    <h2>What we do not do</h2>
    <p>Worth stating plainly, because it is unusual enough to be worth checking:</p>
    <ul>
      <li>No analytics or tracking scripts. There is no Google Analytics, no tag manager, no session recording, no heatmaps.</li>
      <li>No advertising cookies, no retargeting pixels, no third-party trackers of any kind.</li>
      <li>No selling, renting, or trading your personal information. Not to anyone, for any price.</li>
      <li>No profiling or automated decision-making about you.</li>
    </ul>
    <h2>Cookies</h2>
    <p>We keep this short because there genuinely isn't much to say.</p>
    <ul>
      <li><strong>Essential (always on).</strong> A session cookie that keeps you signed in, a cookie recording your choice below, and a security cookie set by Cloudflare that distinguishes real visitors from bots. These are strictly necessary for the site to function, so they don't require consent and can't be switched off — but they carry no advertising data and are not used to profile you.</li>
      <li><strong>Analytics (your choice).</strong> Anonymous statistics about which pages are read. <strong>We do not currently run analytics of any kind.</strong> If we introduce it, it will only ever load for people who have actively agreed — your choice is recorded in advance and honoured automatically.</li>
    </ul>
    <p>We use no advertising cookies, no retargeting pixels, and no third-party trackers.</p>
    <p><strong>Changing your mind.</strong> Use the <em>Cookie Settings</em> link in the footer of any page to review or change your choice at any time. Withdrawing is exactly as easy as agreeing was, and takes effect immediately. We also ask again after twelve months rather than treating an old answer as permanent.</p>
    <p>Declining analytics costs you nothing — every part of this site works identically either way.</p>

    <h2>Why we use it</h2>
    <ul>
      <li><strong>To reply to you</strong> — contact form submissions exist so a human can answer your question.</li>
      <li><strong>To tell you about the relaunch</strong> — if you joined the waitlist, we email you about availability and launch news. That is the entire reason the list exists.</li>
      <li><strong>To run your account</strong> — authenticating you and keeping you signed in.</li>
      <li><strong>To keep the site working and secure</strong> — logs, abuse prevention, and debugging.</li>
    </ul>
    <p>Where the law requires a legal basis (for example the UK/EU GDPR), we rely on your consent for waitlist emails, and on our legitimate interest in answering enquiries, operating the site, and keeping it secure for everything else.</p>

    <h2>Who else touches your data</h2>
    <p>We use a small number of service providers to run this site. They process data on our behalf and are not permitted to use it for their own purposes:</p>
    <ul>
      <li><strong>Resend</strong> — delivers our transactional and waitlist emails. Receives your email address and the message content.</li>
      <li><strong>Cloudflare</strong> — sits in front of the site for security, DDoS protection, and performance. Processes request metadata including your IP address.</li>
      <li><strong>Our hosting provider</strong> — stores the site and its database.</li>
      <li><strong>jsDelivr</strong> — serves the rich text editor library, but only on signed-in administrator pages. Ordinary visitors never load it.</li>
    </ul>

    <h2>How long we keep it</h2>
    <ul>
      <li><strong>Waitlist emails</strong> — until you unsubscribe or ask us to remove you.</li>
      <li><strong>Contact messages</strong> — until the enquiry is resolved and no longer needed for our records.</li>
      <li><strong>Site accounts</strong> — for as long as the account exists. Delete the account and the record goes with it.</li>
      <li><strong>Server logs</strong> — a short rolling window, then discarded.</li>
    </ul>

    <h2>Your choices and rights</h2>
    <p>You can ask us to show you what we hold about you, correct it, delete it, or send you a copy in a portable format. You can also object to how we are using it, or withdraw consent you have given.</p>
    <p>To unsubscribe from waitlist emails, use the unsubscribe link at the bottom of any email we send you — it works immediately and needs no reply from us. For anything else, <a href="<?= site_url('contact') ?>">get in touch</a> and we will action it. We do not charge for any of this, and we will not make you justify the request.</p>
    <p>If you are in the UK or EU and you think we have got something wrong, you have the right to complain to your national data protection authority.</p>

    <h2>Security</h2>
    <p>The site is served over HTTPS. Passwords are stored using a one-way hash, never in readable form. Administrative areas require authentication, and the developer documentation section is restricted further. We take reasonable measures to protect your information, though no site can promise perfect security.</p>

    <h2>Children</h2>
    <p>This website is aimed at organisations and professionals, not children, and we do not knowingly collect information from children through it. If you believe a child has submitted information here, contact us and we will delete it.</p>

    <h2>International transfers</h2>
    <p>Our service providers may process data outside your country, including in the United States. Where that happens, we rely on the safeguards those providers have in place for international transfers.</p>

    <h2>Changes to this policy</h2>
    <p>If we change this policy we will update the date at the top of this page. Material changes affecting how we use information you have already given us will be communicated directly where we can reasonably do so.</p>

    <h2>Contact</h2>
    <p>Questions about this policy, or about data we hold, go to <a href="<?= site_url('contact') ?>">our contact page</a>.</p>
    <!-- CONFIRM: registered legal entity name + address belong here before this page is relied on. -->

  </div>
</div>

<?= $this->endSection() ?>
