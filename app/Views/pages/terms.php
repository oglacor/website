<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/*
 * NEEDS LEGAL REVIEW BEFORE THIS IS RELIED ON (planned for January 2027).
 *
 * A copy of the app's Terms (`blue` repo, app/Views/legal/terms.php), the
 * version people agree to at sign-up and checkout. Keep the two saying the
 * same thing and bump App\Libraries\Legal::VERSION in both repos together.
 * Only the links differ: account pages point into the app at PLAY_APP_URL.
 */
$who  = esc($legal['name']);
$mail = \App\Libraries\Legal::contactLink($legal);
?>

<?= view('partials/legal_nav', ['heading' => $heading, 'which' => $which, 'legal' => $legal]) ?>

<div class="blog-post wrap">
  <div class="meta">Version <?= esc($legal['version']) ?> &middot; Last updated <?= esc($legal['updated']) ?><?= $legal['name_set'] ? ' &middot; ' . $who : '' ?></div>
  <div class="content">

    <p>These terms are the agreement between you and <?= $who ?> ("we", "us") for using BLUERABBIT, the platform at <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> for building and playing gamified learning adventures. By creating an account or using BLUERABBIT you accept them. If you use BLUERABBIT for an organisation, you accept them for it too.</p>

    <h2>1. Your account</h2>
    <ul>
      <li>Give us true details and keep your password to yourself. Everything done with your account is your responsibility.</li>
      <li>You must be at least 16, or the age of digital consent where you live if that is higher. A teacher, trainer or organisation that enrols younger players is responsible for having the consent the law requires.</li>
      <li>One person per account. Accounts that a Game Master or an organisation creates for players are covered by that organisation's agreement with us.</li>
    </ul>

    <h2>2. Plans</h2>
    <p>Basic is free. BLUERABBIT Pro is a paid subscription, by the month or by the year, at the price shown when you subscribe, including any tax we have to charge. Payments are handled by Stripe; we never see or store your card number.</p>

    <h2>3. The free trial</h2>
    <p>Your first Pro subscription starts with a 30-day free trial. We ask for a card when the trial starts. When the trial ends, the card is charged for the plan you chose, monthly or yearly, unless you cancel before then. We email you a few days before the trial ends.</p>

    <h2>4. Renewal and cancelling</h2>
    <p>Pro renews automatically at the end of every month or year until you cancel it. You can cancel at any time from <a href="<?= PLAY_APP_URL ?>/subscription"><em>Subscription &rarr; Manage billing</em></a> in the app. Cancelling stops the next renewal: you keep Pro until the end of the period you have already paid for, then your account returns to Basic. Your adventures and data stay; features that need Pro stop.</p>

    <h2>5. Refunds</h2>
    <ul>
      <li>The month in progress is never refunded once its payment has been taken.</li>
      <li>A yearly plan can be refunded for its unused months: the amount you paid, less the monthly price for each month that has started since that payment (the current month included), and never less than zero. For example, with Pro at $80 a year and $8 a month, a yearly renewal you meant to cancel and tell us about in its first month is refunded $72. Refunding a yearly plan ends it at once.</li>
      <li>A monthly plan is not refunded; cancelling it stops the next renewal.</li>
      <li>To ask for a refund, write to <?= $mail ?> from your account's email address. Refunds go back to the card you paid with.</li>
    </ul>
    <p>The <a href="<?= site_url('refunds') ?>">Refund Policy</a> explains this with more examples. Where the law where you live gives you more rights than this section, you have them.</p>

    <h2>6. Price changes</h2>
    <p>We may change Pro's price. A change never affects a period you have already paid for, and we tell you at least 30 days before your first renewal at the new price, so you can cancel first.</p>

    <h2>7. Your content</h2>
    <p>What you create or upload (adventures, milestones, images, answers, messages) stays yours. You give us the permission we need to store it, show it to the people you share it with and run the service, and nothing more. You are responsible for having the rights to what you upload, and for what you publish to your players.</p>

    <h2>8. Using BLUERABBIT fairly</h2>
    <p>Do not use BLUERABBIT to break the law, harass or harm anyone, upload malware, attack or overload the service, read data that is not yours, or get around a limit of your plan. Do not resell BLUERABBIT without our written agreement. We may remove content or suspend an account that does, and we will tell you why unless the law or the safety of others stops us.</p>

    <h2>9. A.I. features</h2>
    <p>Some features (the Cooper assistant and A.I. review of answers, when an adventure switches them on) send the text involved to Anthropic, our A.I. provider, to produce a reply. A.I. output can be wrong: a Game Master stays responsible for decisions made with it.</p>

    <h2>10. The service</h2>
    <p>We work to keep BLUERABBIT available and your data safe, and we improve it all the time, which sometimes means changing or retiring a feature. If we retire something a paid plan depends on, we tell you first. We are not responsible for losses caused by events outside our reasonable control.</p>

    <h2>11. Ending the agreement</h2>
    <p>You can stop using BLUERABBIT and delete your account at any time from <a href="<?= PLAY_APP_URL ?>/my-account"><em>My Account &rarr; Your data</em></a> in the app, after cancelling any subscription. We may end or suspend an account that seriously or repeatedly breaks these terms. What happens to your data when an account is deleted is in the <a href="<?= site_url('privacy') ?>">Privacy Policy</a>.</p>

    <h2>12. Liability</h2>
    <p>BLUERABBIT is provided as it is. As far as the law allows, we are not liable for indirect or consequential losses, and our total liability to you is limited to what you paid us in the 12 months before the claim. Nothing here limits liability that the law does not allow to be limited.</p>

    <h2>13. Changes to these terms</h2>
    <p>When we change these terms in a way that matters, we publish the new version here with a new date and tell account holders before it takes effect. If you keep using BLUERABBIT after that, the new version applies; if you do not agree, cancel and delete your account.</p>

    <h2>14. Law and contact</h2>
    <p><?= $legal['jurisdiction'] !== '' ? 'These terms are governed by the laws of ' . esc($legal['jurisdiction']) . '.' : 'These terms are governed by the laws of the place where we are established.' ?>
       Questions: <?= $mail ?><?= $legal['address'] !== '' ? ', or by post to ' . esc($legal['address']) : '' ?>.</p>

  </div>
</div>

<?= $this->endSection() ?>
