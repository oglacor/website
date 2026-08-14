<?php
/*
 * Cookie consent panel.
 *
 * GDPR/ePrivacy shape, deliberately:
 *   - Nothing non-essential runs until an explicit choice is made. There is no
 *     implied consent: scrolling, dismissing, or ignoring the panel all count
 *     as "not consented", not as agreement.
 *   - Accept and Reject are equally prominent. Regulators treat a quiet Reject
 *     next to a loud Accept as a dark pattern; see the CSS note in site.css.
 *   - The choice is withdrawable at any time from the footer's Cookie Settings
 *     link, which reopens this panel.
 *   - The stored decision carries a version and a timestamp, and the cookie
 *     expires after 12 months so consent is re-sought rather than assumed
 *     indefinitely. Bump CONSENT_VERSION to force everyone to re-decide after a
 *     material change to what the site sets.
 *
 * ADDING ANALYTICS LATER — read this first.
 * Do NOT drop a tracking snippet straight into the layout. Gate it:
 *
 *     <script>
 *     brConsent.onGranted('analytics', function () {
 *         // inject the analytics tag here — only runs with consent,
 *         // and fires immediately if consent was already given earlier.
 *     });
 *     </script>
 *
 * Anything loaded outside that callback defeats the entire mechanism and puts
 * the site in breach the moment it ships. The privacy policy's cookie table
 * needs updating at the same time.
 */
?>
<div class="cookie-panel panel" id="cookie-panel" role="dialog" aria-live="polite"
     aria-labelledby="cookie-panel-title" aria-describedby="cookie-panel-desc">
  <h4 id="cookie-panel-title">Cookies on this site</h4>
  <p id="cookie-panel-desc">We'd rather explain than just ask. Here's everything this site stores on your device:</p>

  <ul class="cookie-list">
    <li>
      <strong>Essential — always on</strong>
      A session cookie that keeps you signed in, and a security cookie set by Cloudflare to
      tell real visitors from bots. The site cannot work without these, so they aren't
      optional and never carry advertising data.
    </li>
    <li>
      <strong>Analytics — your choice</strong>
      Anonymous statistics about which pages get read, so we know what's useful and what
      isn't. We don't currently run any analytics at all; if we turn it on, your choice here
      is what decides whether it applies to you. Nothing loads unless you say yes.
    </li>
  </ul>

  <p>We don't use advertising or tracking cookies, and we never sell your data. Full detail
     is in our <a href="<?= site_url('privacy') ?>">Privacy Policy</a>.</p>

  <div class="cookie-actions">
    <button type="button" class="btn btn-ghost" data-cookie-choice="reject">Essential only</button>
    <button type="button" class="btn btn-primary" data-cookie-choice="accept">Accept all</button>
  </div>
</div>

<script>
(function (w, d) {
  'use strict';

  var NAME = 'br_consent';
  var VERSION = 1;
  var MONTHS = 12;

  function readCookie() {
    var match = d.cookie.match(new RegExp('(?:^|; )' + NAME + '=([^;]*)'));
    if (!match) { return null; }
    try {
      var parsed = JSON.parse(decodeURIComponent(match[1]));
      // A stored decision from an older policy version is not a decision
      // about the current one — re-ask rather than assuming it carries over.
      return (parsed && parsed.v === VERSION) ? parsed : null;
    } catch (e) {
      return null;
    }
  }

  function writeCookie(analytics) {
    var value = { v: VERSION, analytics: !!analytics, ts: new Date().toISOString() };
    var expires = new Date();
    expires.setMonth(expires.getMonth() + MONTHS);
    d.cookie = NAME + '=' + encodeURIComponent(JSON.stringify(value)) +
               ';path=/;expires=' + expires.toUTCString() +
               ';SameSite=Lax' + (w.location.protocol === 'https:' ? ';Secure' : '');
    return value;
  }

  var panel   = d.getElementById('cookie-panel');
  var pending = [];

  function flush(category) {
    pending = pending.filter(function (entry) {
      if (entry.category !== category) { return true; }
      try { entry.fn(); } catch (e) { /* a broken callback must not break the page */ }
      return false;
    });
  }

  var api = {
    // True only on an explicit yes. Absence of a decision is a no, never a maybe.
    has: function (category) {
      var stored = readCookie();
      return !!(stored && stored[category] === true);
    },
    // Runs fn now if already consented, or the moment consent is given.
    // This is the only supported way to load a non-essential script.
    onGranted: function (category, fn) {
      if (api.has(category)) { try { fn(); } catch (e) {} return; }
      pending.push({ category: category, fn: fn });
    },
    set: function (analytics) {
      var value = writeCookie(analytics);
      if (panel) { panel.classList.remove('is-open'); }
      if (analytics) { flush('analytics'); }
      w.dispatchEvent(new CustomEvent('brconsentchange', { detail: value }));
      return value;
    },
    // Withdrawal path — reopens the panel so a previous yes can become a no.
    open: function () {
      if (panel) { panel.classList.add('is-open'); }
    }
  };

  w.brConsent = api;

  if (panel) {
    panel.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-cookie-choice]');
      if (btn) { api.set(btn.getAttribute('data-cookie-choice') === 'accept'); }
    });

    // Only surface the panel when there is genuinely no current decision.
    if (readCookie() === null) { panel.classList.add('is-open'); }
  }

  d.addEventListener('click', function (e) {
    if (e.target.closest('[data-cookie-settings]')) {
      e.preventDefault();
      api.open();
    }
  });

  // Revoking analytics consent should not leave previously-set analytics
  // cookies lying around. Nothing sets these yet; this is here so the cleanup
  // exists on the day analytics is switched on.
  w.addEventListener('brconsentchange', function (e) {
    if (e.detail && e.detail.analytics === false) {
      ['_ga', '_gid', '_gat'].forEach(function (name) {
        d.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT';
        d.cookie = name + '=;path=/;domain=.' + w.location.hostname +
                   ';expires=Thu, 01 Jan 1970 00:00:00 GMT';
      });
    }
  });
}(window, document));
</script>
