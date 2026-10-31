<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/*
 * NEEDS LEGAL REVIEW BEFORE THIS IS RELIED ON (planned for January 2027).
 *
 * A copy of the app's Refund Policy (`blue` repo, app/Views/legal/refunds.php):
 * the rule Bernardo set on 2026-10-30. The month in progress is never
 * refunded; unused months of a yearly plan can be. The Terms carry the same
 * rule in section 5. Change all of them together.
 */
$mail = $legal['email'] !== ''
    ? \App\Libraries\Legal::contactLink($legal)
    : 'us through <a href="' . site_url('contact') . '">our contact page</a>';
?>

<?= view('partials/legal_nav', ['heading' => $heading, 'which' => $which, 'legal' => $legal]) ?>

<div class="blog-post wrap">
  <div class="meta">Version <?= esc($legal['version']) ?> &middot; Last updated <?= esc($legal['updated']) ?><?= $legal['name_set'] ? ' &middot; ' . esc($legal['name']) : '' ?></div>
  <div class="content">

    <p>BLUERABBIT Pro is sold by the month or by the year. This page explains what happens when you cancel, and when you can get money back.</p>

    <h2>The short version</h2>
    <ul>
      <li><strong>Your first 30 days are free.</strong> We ask for a card when you start the trial, and charge it only when the trial ends. Cancel before then and you pay nothing.</li>
      <li><strong>The month you are in is never refunded.</strong> Once a payment has been taken, that month is yours to use until it ends.</li>
      <li><strong>Unused months of a yearly plan can be refunded.</strong> You get back what you paid, less the monthly price for every month that has started.</li>
      <li><strong>A monthly plan is not refunded.</strong> Cancel it and it simply stops at the end of the month you already paid for.</li>
    </ul>

    <h2>Yearly plans, worked out</h2>
    <p>The refund is the yearly amount you paid, minus the monthly price for each month that has started since that payment, the current month included. It is never less than zero.</p>
    <p>With Pro at $80 a year and $8 a month:</p>
    <ul>
      <li>Your trial ends, the yearly charge of $80 goes through because you forgot to cancel, and you write to us that same month: <strong>you get $72 back</strong> ($80 &minus; one month at $8).</li>
      <li>You ask in the third month: <strong>$56 back</strong> ($80 &minus; three months at $8).</li>
      <li>You ask in the tenth month or later: nothing is left to refund.</li>
    </ul>
    <p>A refund of a yearly plan also ends that plan straight away, and your account returns to the free plan.</p>

    <h2>How to cancel</h2>
    <p>Sign in to the app, open <a href="<?= PLAY_APP_URL ?>/subscription">Subscription</a> and choose <em>Manage billing</em>. Cancelling stops the next renewal; you keep Pro until the end of the period you have paid for. Nobody has to approve it, and you can do it at any time.</p>

    <h2>How to ask for a refund</h2>
    <p>Write to <?= $mail ?> from the email address on your account, and say which plan you want refunded. We work out the amount as above and send it back to the card you paid with. Banks usually take 5 to 10 days to show it.</p>
    <p>If something went wrong on our side, such as being charged twice or not being able to use the service, tell us: we put it right, whatever the rule above says.</p>

    <p>This policy is part of our <a href="<?= site_url('terms') ?>">Terms of Service</a>. Where the law where you live gives you more, you have more.</p>

  </div>
</div>

<?= $this->endSection() ?>
