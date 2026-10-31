<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/*
 * NEEDS LEGAL REVIEW BEFORE THIS IS RELIED ON (planned for January 2027).
 *
 * One policy for both places that hold personal data (rewritten 2026-10-30):
 *   - Part 1, the app at play.bluerabbit.io: the same facts as the app's own
 *     /privacy (`blue` repo, app/Views/legal/privacy.php), which describes
 *     what that code actually keeps. Change both together.
 *   - Part 2, this website: written against this repo's code on 2026-08-14
 *     (waitlist, contact form, site accounts, cookie notice). If the site
 *     starts collecting something new, this part changes with it.
 * The business named comes from Admin -> Settings -> Legal.
 */
$who  = esc($legal['name']);
$mail = \App\Libraries\Legal::contactLink($legal);
?>

<?= view('partials/legal_nav', ['heading' => $heading, 'which' => $which, 'legal' => $legal]) ?>

<div class="blog-post wrap">
  <div class="meta">Version <?= esc($legal['version']) ?> &middot; Last updated <?= esc($legal['updated']) ?><?= $legal['name_set'] ? ' &middot; ' . $who : '' ?></div>
  <div class="content">

    <p><?= $legal['name_set'] ? $who : 'The operator of BLUERABBIT' ?> runs BLUERABBIT and is responsible for the personal data it holds about you. This policy covers two places:</p>
    <ul>
      <li><strong>The BLUERABBIT app</strong> at <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, where adventures, player accounts and subscriptions live (Part 1).</li>
      <li><strong>This website</strong>, bluerabbit.io: the marketing pages, blog, documentation, waitlist and contact form (Part 2).</li>
    </ul>
    <p>They are separate systems with separate accounts: a site account here is not an app account there, and neither one can sign you into the other. Organisations that run BLUERABBIT on their own address under a separate agreement with us are covered by that agreement.</p>

    <h2>Part 1: The BLUERABBIT app</h2>

    <h3>What we keep</h3>
    <ul>
      <li><strong>Your account:</strong> email address, nickname, the name you give, and a password stored only as a one-way hash. Optional profile details (picture, bio, company, links) if you add them.</li>
      <li><strong>What you do in adventures:</strong> progress, XP, levels, achievements and items, your answers and uploads, messages, wall posts and help requests, and the activity that makes up your history.</li>
      <li><strong>Payments:</strong> your plan, subscription status and invoices. Stripe holds your card; we keep only a reference to your Stripe customer.</li>
      <li><strong>Security:</strong> a sign-in log (each sign-in, failure, lock-out and password reset, with the internet address and browser it came from) and the confirmation of your email address.</li>
      <li><strong>Cookies:</strong> only what the service needs: a session cookie that keeps you signed in, and one that protects your forms from forgery. Cloudflare and its Turnstile check, which keep out automated sign-ups, can set their own security cookies. We do not use advertising cookies.</li>
    </ul>

    <h3>Why we keep it</h3>
    <ul>
      <li>To run the service you signed up for: your account, your adventures, your plan (our contract with you).</li>
      <li>To keep accounts and the service safe: the sign-in log, lock-outs, abuse checks (our legitimate interest in security).</li>
      <li>To meet legal duties, such as keeping invoices for as long as tax law asks.</li>
      <li>To email you about your account: confirmations, password resets, trial and payment notices. Adventure emails can be switched off from the link in them.</li>
    </ul>
    <p>We do not sell your data, and we do not use it for advertising.</p>

    <h3>Who sees it</h3>
    <ul>
      <li><strong>In an adventure</strong>, the Game Masters and staff who run it see your progress and the work you hand in. Other players see your name, level, XP and achievements on leaderboards and guild rosters, never your email address.</li>
      <li><strong>Companies that work for us</strong>, each only for its part: Stripe (payments), Resend (sending email), Cloudflare (delivering the site and keeping attacks out), Anthropic (the A.I. features, when an adventure switches them on), and our hosting provider. They process your data on our instructions.</li>
      <li><strong>Authorities</strong>, only where the law requires it.</li>
    </ul>

    <h3>How long we keep it</h3>
    <ul>
      <li>Your account and what you made: until you delete your account.</li>
      <li>The sign-in log: 12 months, then it is deleted automatically.</li>
      <li>Invoices and payment records: as long as tax and accounting law requires.</li>
      <li>After you delete your account, your scores can remain in an adventure's statistics and leaderboards under an anonymous name, so other players' results stay correct. Nothing in them identifies you.</li>
    </ul>

    <h3>Your rights in the app</h3>
    <ul>
      <li><strong>See and take your data:</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>My Account &rarr; Your data &rarr; Download</em></a> gives you everything we hold about you as one file.</li>
      <li><strong>Delete your account:</strong> <em>My Account &rarr; Your data &rarr; Delete my account</em> removes your identity everywhere, deletes your conversations and uploads, and ends every session. Cancel a running subscription first.</li>
      <li><strong>Correct it:</strong> edit your profile at any time.</li>
      <li><strong>Object, restrict or ask a question:</strong> write to <?= $mail ?>.</li>
    </ul>

    <h2>Part 2: This website</h2>

    <h3>What we collect</h3>
    <p>Only what the page you are using actually needs. In full, that is:</p>
    <ul>
      <li><strong>Waitlist signups</strong> — your email address, and which page you signed up from. Nothing else.</li>
      <li><strong>Contact form</strong> — your name, email address, subject, and the message you write.</li>
      <li><strong>Site accounts</strong> — if you register an account on this site, your name, email address, and a securely hashed version of your password. We never store your password itself and cannot read it.</li>
      <li><strong>Session cookie</strong> — a single cookie that keeps you logged in while you use the site.</li>
      <li><strong>Server logs</strong> — standard web request records (IP address, browser user agent, page requested, timestamp), kept for security and debugging.</li>
    </ul>

    <h3>What we do not do</h3>
    <p>Worth stating plainly, because it is unusual enough to be worth checking:</p>
    <ul>
      <li>No analytics or tracking scripts. There is no Google Analytics, no tag manager, no session recording, no heatmaps.</li>
      <li>No advertising cookies, no retargeting pixels, no third-party trackers of any kind.</li>
      <li>No selling, renting, or trading your personal information. Not to anyone, for any price.</li>
      <li>No profiling or automated decision-making about you.</li>
    </ul>

    <h3>Cookies</h3>
    <ul>
      <li><strong>Essential (always on).</strong> A session cookie that keeps you signed in, a security token that protects our forms from being submitted by other sites on your behalf, a cookie recording your choice below, and a cookie set by Cloudflare that distinguishes real visitors from bots. These are strictly necessary for the site to function, so they don't require consent and can't be switched off — but they carry no advertising data and are not used to profile you.</li>
      <li><strong>Analytics (your choice).</strong> Anonymous statistics about which pages are read. <strong>We do not currently run analytics of any kind.</strong> If we introduce it, it will only ever load for people who have actively agreed — your choice is recorded in advance and honoured automatically.</li>
    </ul>
    <p><strong>Changing your mind.</strong> Use the <em>Cookie Settings</em> link in the footer of any page to review or change your choice at any time. Withdrawing is exactly as easy as agreeing was, and takes effect immediately. We also ask again after twelve months rather than treating an old answer as permanent. Declining analytics costs you nothing — every part of this site works identically either way.</p>

    <h3>Why we use it</h3>
    <ul>
      <li><strong>To reply to you</strong> — contact form submissions exist so a human can answer your question.</li>
      <li><strong>To tell you about BLUERABBIT</strong> — if you joined the waitlist, we email you about availability and launch news. That is the entire reason the list exists.</li>
      <li><strong>To run your account</strong> — authenticating you and keeping you signed in.</li>
      <li><strong>To keep the site working and secure</strong> — logs, abuse prevention, and debugging.</li>
    </ul>
    <p>Where the law requires a legal basis (for example the UK/EU GDPR), we rely on your consent for waitlist emails, and on our legitimate interest in answering enquiries, operating the site, and keeping it secure for everything else.</p>

    <h3>Who else touches your data</h3>
    <ul>
      <li><strong>Resend</strong> — delivers our transactional and waitlist emails. Receives your email address and the message content.</li>
      <li><strong>Cloudflare</strong> — sits in front of the site for security, DDoS protection, and performance. Processes request metadata including your IP address.</li>
      <li><strong>Our hosting provider</strong> — stores the site and its database.</li>
      <li><strong>jsDelivr</strong> — serves the rich text editor library, but only on signed-in administrator pages. Ordinary visitors never load it.</li>
    </ul>

    <h3>How long we keep it</h3>
    <ul>
      <li><strong>Waitlist emails</strong> — until you unsubscribe or ask us to remove you.</li>
      <li><strong>Contact messages</strong> — until the enquiry is resolved and no longer needed for our records.</li>
      <li><strong>Site accounts</strong> — for as long as the account exists. Delete the account and the record goes with it.</li>
      <li><strong>Server logs</strong> — a short rolling window, then discarded.</li>
    </ul>

    <h3>Your choices on this website</h3>
    <p>To unsubscribe from waitlist emails, use the unsubscribe link at the bottom of any email we send you — it works immediately and needs no reply from us. To see, correct, delete or take a copy of anything else we hold here, write to <?= $mail ?>. We do not charge for any of this, and we will not make you justify the request.</p>

    <h2>For both</h2>

    <h3>Your rights</h3>
    <p>You can ask us to show you what we hold about you, correct it, delete it, or send you a copy in a portable format. You can also object to how we are using it, or withdraw consent you have given. If you are in the UK or EU and you think we have got something wrong, you have the right to complain to your national data protection authority.</p>

    <h3>Security</h3>
    <p>Both sites are served over HTTPS. Passwords are stored using a one-way hash, never in readable form. The app locks an account after repeated failed sign-ins and keeps a log of sign-ins; administrative areas of both sites require authentication. We take reasonable measures to protect your information, though no site can promise perfect security.</p>

    <h3>Children</h3>
    <p>BLUERABBIT is not meant for children below the age of digital consent where they live, unless a school, trainer or organisation that has the consent the law requires enrols them. This website is aimed at organisations and professionals; if you believe a child has submitted information here, contact us and we will delete it.</p>

    <h3>International transfers</h3>
    <p>Some of the companies that work for us are outside your country, including in the United States. Where the law asks for it, transfers are covered by standard contractual safeguards.</p>

    <h3>Changes to this policy</h3>
    <p>When this policy changes in a way that matters, we publish the new version here with a new date and tell account holders.</p>

    <h3>Contact</h3>
    <p>Questions about this policy, or about data we hold: <?= $mail ?><?= $legal['address'] !== '' ? ', or by post to ' . esc($legal['address']) : '' ?>.</p>

  </div>
</div>

<?= $this->endSection() ?>
