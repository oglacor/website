# Build status — 2026-07-27 (overnight build session)

**Live on Bernardo's machine now** at `C:\xampp\htdocs\website`, running via
`http://localhost/website/public/` (no vhost). All migrations run, seeded, confirmed
working end-to-end via HTTP-level testing against a real database (see "How this was
tested" below).

See `WEBSITE_PROJECT_BRIEF.md` for full context/decisions and `CLAUDE.md` for the
operating rules — this file is just the state snapshot. Going live / moving the install
from `new.bluerabbit.io` to the apex is its own runbook: `claude-notes/DEPLOY.md`.

## Follow-up session (same day) — docs content, real brand assets, error pages, email templates

- **Full how-to documentation written** — replaced the 3 short stub docs pages with 13 real
  pages: 7 in `user` (Getting Started, XP/BLOO/EP, Journey Map, Quests & Steps, Achievements
  & Guilds, Item Shop & Backpack, Product Overview) and 6 in `setup` (Setting Up Your Org,
  Building Your First Adventure, Enrolling Players & Roles, Adventure Templates & Cohorts,
  Billing & Plans, Stats Dashboard). All content pulled from the same `blue/blue` research as
  the product/solutions pages — no invented mechanics.
- **`docs_pages.body` is now trusted admin-authored HTML** (headings, lists, links), same
  pattern as `blog_posts.body` — `docs/show.php` no longer runs it through `nl2br(esc())`.
  `DocsPageSeeder` is now upsert-by-slug so re-running it after an edit actually refreshes
  content instead of skipping.
- **Real brand assets wired in** — Bernardo pasted the logo files inline in chat, which this
  environment has no way to save to disk directly, but they turned out to match files already
  in the read-only `blue/blue` sibling project almost exactly (including the true two-tone
  vector `rabbit-logo.svg`), so those were copied in instead: `public/assets/img/rabbit-logo.svg`,
  `logo-wordmark.png` (full-res wordmark), `logo-wordmark-email.png` (480px, ~9KB, resized
  specifically for email — the full-res one is 140KB, over Gmail's ~102KB clip threshold), and
  `favicon-32/180/512.png` (rasterized directly from the SVG polygon data at high res then
  cropped to a tight bounding box — the source PNG's own bounding box was unreliable, spanning
  almost the full 6001px canvas width for reasons unclear, so don't reuse that auto-crop
  approach on other assets without checking the result). Favicon + Open Graph/Twitter meta
  tags wired into `layouts/main.php` and all three error views.
- **404/400/500 error pages restyled** to match the site (dark HUD theme, rabbit mark, real
  copy) — `app/Views/errors/html/error_404.php`, `error_400.php`, `production.php`. Note:
  CI4's `ExceptionHandler` only serves these HTML views when the request's `Accept` header
  contains `text/html` — a bare `curl` (default `Accept: */*`) gets a JSON debug response
  instead, which looks like a bug but isn't. Real browsers always send `text/html`.
- **Branded HTML email template** — `app/Views/emails/layout.php`, a table-based template
  (dark header with the wordmark logo, white body, footer with Site/Docs/Contact links and an
  unsubscribe link). `ResendMailer::send()` now wraps every email in this template
  automatically — callers just pass the inner body HTML, same as before.
- **Real unsubscribe flow** — `GET /unsubscribe?email=...` (query string, not a path segment
  — see bug note below), sets `waitlist_signups.status = 'unsubscribed'`. Linked from every
  email footer.
- **One more real bug found:** a `/unsubscribe/{email}` path-segment route fails even with
  `rawurlencode()` — CI4's router decodes the URI *before* running `checkDisallowedChars()`,
  and `@` isn't in `Config\App::$permittedURIChars`, so it 400s regardless of encoding. Fixed
  by moving the email to a query string instead (`?email=...`), which isn't subject to that
  check. If you ever need an unusual character in a URL, it's a query string, not a path
  segment.

**Still not done:** client logos (waiting on Bernardo — 6 points he's working through),
Enterprise plan specifics, case studies/testimonials, legal pages (Privacy/Terms still link to
`#`), About/company page, more blog posts (waiting on a DB export from the live
bluerabbit.io/blog to pull real posts from). Hexad player types explicitly skipped per
Bernardo — deprioritized, "lost a bit of its fervor."

## Follow-up — real 2026 brand assets replace the guessed-from-sibling-project ones

The logos pulled from `blue/blue` in the previous entry were **stale** — Bernardo updated
the brand this year and `blue/blue`'s assets hadn't caught up. He uploaded the real current
kit directly into `public/assets/img/`: `cooper.png` / `cooper-black.png` / `cooper-white.png`
/ `cooper-white.svg` (icon only, 3 color variants — note **`cooper.svg`, the non-white SVG
variant, was never actually added** despite being mentioned, only `cooper-white.svg`
exists), `favicon.png` / `favicon.svg`, `logo-full.png` / `logo-full-black.png` /
`logo-full-white.png` / `logo-full-for-dark-bg.png` / `logo-full-for-dark-bg.svg` /
`logo-full.svg` (full wordmark + icon), `name.png` / `name-black.png` / `name-white.png`
(wordmark text only, no icon — not currently used anywhere), `Google-Email-image.png`
(unused — likely meant for a Gmail/BIMI sender-logo setup, which is a separate DNS-level
feature, out of scope here).

- **Nav + footer logo** now `<img>` tags pointing at `logo-full-for-dark-bg.svg` (vector,
  white lettering — reads correctly against the site's dark header). Replaced the old
  hand-traced inline-SVG `partials/rabbit_icon.php` + separate `<span>BLUE<b>RABBIT</b></span>`
  text markup entirely — that partial is now deleted, not just unused.
- **Every other icon-only spot** (homepage/product hero visual, all three error pages) now
  uses `cooper-white.svg` instead of the old recolorable inline partial. This trades away the
  old per-context recoloring (cyan/yellow/red per error type) for consistency with the real
  asset — the error type is still conveyed by the eyebrow/heading text, so this reads fine.
- **Favicon** now genuinely Bernardo's `favicon.svg`/`favicon.png` (previously a
  favicon I'd rasterized myself from the stale SVG's polygon data — deleted, along with the
  old `rabbit-logo.svg`, `logo-wordmark.png`, `logo-wordmark-email.png`).
- **Email header logo** regenerated from the *real* `logo-full-for-dark-bg.png` — resized to
  480px/9KB (`logo-full-for-dark-bg-email.png`) for the same Gmail-clip-threshold reason as
  before. `ResendMailer` updated to point at it.
- **Important open question, not resolved:** the real `logo-full.svg`/`logo-full-for-dark-bg.svg`
  use a refreshed blue palette — `#3798f3` / `#0c3ea9` / `#2a77dd` — which does **not** match
  `site.css`'s `--cyan: #1cc2eb` and related tokens (sourced from the *old*
  `bluerabbit\wp-content\themes\bluerabbit\css\_variables.scss`, per the original brief,
  which is itself now stale). The whole site's buttons/panels/borders/accents still run on
  the old palette. Did not touch this — recoloring the entire design system is a bigger call
  than a logo swap and needs Bernardo's decision on whether/how far to carry the 2026 refresh
  before doing it.

## Done, tested, and working

Everything from the priority list in the brief is now built:

- **Auth system** — own, fully separate from the main BLUERABBIT app. `users` table
  (`UserModel`), session-based login/register/logout (`Auth` controller), an `AuthFilter`
  registered as the `auth` filter alias (`auth` = any logged-in user, `auth:admin` = admin
  role required). Protects `/account`, `/admin/*`, `/docs/developer`.
- **Admin blog CRUD** (`/admin/blog`) — list/create/edit/delete/publish, featured-image
  upload to `public/assets/uploads/blog/`. Replaces the old seeder-only workflow.
- **Docs CMS** (`/admin/docs`) — same CRUD pattern, backs both the public `/docs` hub
  (`user`/`setup` sections) and the admin-gated `/docs/developer` section (`developer`
  section). Seeded with 5 real starter pages.
- **Real content** for `/product` and `/solutions` — pulled from `blue/blue`'s
  `BLUERABBIT_PROJECT_BRIEF.md` and the live WP theme (XP/BLOO/EP mechanics, quest/step
  types, achievements, guilds, journey map/Tabis, adventure templates, event scheduling).
  No invented features — see the research notes in this session's transcript for exact
  sourcing if anything needs re-verification.
- **Pricing page** (`/pricing`) — real plan data pulled from `blue/blue`'s
  `BillingController`/`BillingModel` docblocks and the live WP `page-my-account.php`
  comparison: Basic (free, 200 players/3 adventures/50MB), Pro ($8/mo or $80/yr, 30-day
  trial, unlimited players/adventures), Enterprise (contact sales). **Caveat carried
  through from research:** Stripe price IDs aren't actually configured in `blue/blue`'s dev
  DB yet — the $8/$80 numbers come from code comments, not live Stripe config. Confirm
  they're still current before this goes live. No checkout on this site — CTAs link to
  `/get-started`.
- **Contact form** (`/contact`) — real POST handler, stores to `contact_messages` table
  with validation + CSRF + flash success/error.
- **Resend integration** — `ResendMailer` library (raw HTTP call to Resend's API, no SDK
  dependency), API key + from-address configurable at `/admin/settings` (stored in
  `site_settings` table, not hardcoded). Waitlist signups get a best-effort welcome email
  if configured; `/admin/waitlist` has a campaign-send form that emails everyone with
  `status = 'subscribed'` and stamps `notified_at`. Signup still succeeds if Resend isn't
  configured — sending is best-effort, never blocking.
- **`/account`** — basic profile view for any logged-in user (name/email/role, read-only).
- **Admin dashboard** (`/admin`) — post/docs/signup/new-message counts, links into each
  admin section.
- Everything from the previous session still stands: homepage, blog (public), waitlist
  capture, nav/footer, brand system in `site.css`.

## Seeded accounts / data

- **Admin login:** `admin@bluerabbit.io` / `ChangeMe123!` (seeded by `AdminUserSeeder`,
  idempotent — skips if the email already exists). **Change this password before the site
  is ever exposed outside localhost.**
- `php spark db:seed DatabaseSeeder` now runs all seeders (Admin user, blog posts, docs
  pages) in one call. Note: `BlogPostSeeder` isn't idempotent — re-running it against a DB
  that already has those posts will throw a duplicate-slug error. That's pre-existing
  behavior from the first build session, not something touched this session.

## Three real bugs found + fixed this session (worth knowing the root cause)

1. **`.env`'s `app.baseURL` had regressed** to `http://localhost/website/` (missing
   `/public/`) even though the `env` template and the previous session's notes said it was
   fixed. Re-fixed in the live `.env`. If this happens again, it's likely `.env` getting
   recreated from a stale copy rather than edited in place — worth checking `env` vs `.env`
   diff first.
2. **`SiteSettingModel::get()`/`set()` collided with CodeIgniter's own `Model::get()`/
   `Model::set()`** (the query-builder methods every model inherits). Declaring your own
   `set($key, $value)` with an incompatible signature is a fatal `ErrorException` at
   runtime, not a lint-time error — CI4 doesn't warn until the method is actually called.
   **Fixed** by renaming to `getSetting()`/`setSetting()`. If you add another key-value
   settings-style model, don't name accessor methods `get`/`set` — those are reserved by
   the base `Model` class.
3. **`is_unique[table.field,id,{id}]` placeholder rules throw a `LogicException`** in this
   CI4 version (4.7.4) unless the placeholder field (`id`) *also* has its own entry in
   `$validationRules` (e.g. `'id' => 'permit_empty|is_natural'`) — merely having `id` present
   in the `$data` array passed to `validate()` isn't enough anymore. This was a **latent bug
   in the original `BlogPostModel`** from the first build session — it never triggered
   before because no admin edit UI existed yet to exercise the update path. Fixed in
   `BlogPostModel`, `DocsPageModel`, and `UserModel` (all three use this placeholder
   pattern). If you add a new model with an `is_unique[...,id,{id}]` rule, add the `id` rule
   entry from the start.

## How this was tested

No browser/screenshot tool was available in this session, so verification was done at the
HTTP level rather than visually — worth a manual look before calling this fully done:

- Ran the full migration chain from a completely empty database (a throwaway
  `bluerabbit_site_cleantest` DB, dropped after) to confirm a fresh clone would actually set
  up cleanly, not just apply against the already-migrated dev DB.
- Exercised every route with `curl`: all public pages (200s), all gated routes redirect
  when logged out (302) and 403 when logged in as a non-admin, checked flash-message
  content renders correctly (esc()'d apostrophes etc.), and confirmed zero PHP
  warnings/notices leaked into any response body.
- Registered a real user, logged in as admin and as a regular user, created/edited/deleted
  a blog post and a docs page through the actual admin forms (not direct DB inserts) and
  verified the rows landed correctly, confirmed public pages reflect the changes and 404
  after delete.
- Submitted the contact form, waitlist form, and settings form and verified DB rows.
- Tested error paths: wrong password, duplicate email registration, campaign send with no
  Resend key configured — all render their intended error state instead of crashing.
- Did **not** visually check rendered CSS/layout in an actual browser — recommend Bernardo
  do a quick pass on `/pricing`, `/product`, `/solutions`, and the admin screens before
  calling this launch-ready. Structural HTML checks (right number of cards/panels
  rendered) passed, but that's not the same as an eyeball check.

## Not built yet / explicitly deferred

1. **Real client logos** for the homepage trust bar — still generic labels, waiting on
   Bernardo to provide the actual list.
2. **CRM phase** (`/admin/customers`) — explicitly out of scope, not started.
3. Password reset / forgot-password flow for the site's own auth — wasn't in the original
   priority list, flagging in case it's wanted before this goes live with real users.
4. ~~Docs page content is only 5 seeded starter pages~~ — resolved, see follow-up below.
   49 pages now cover the real product in depth.

## Follow-up — full Player/GM/Enterprise documentation (49 docs pages total)

Docs content went from 34 pages (mostly conceptual/GM-design-focused, written from
`BLUERABBIT_PROJECT_BRIEF.md`) to 49, adding 15 pages written from a fresh, targeted audit
of the **live WordPress app** (`bluerabbit\wp-content\themes\bluerabbit`) and the CI4 port
(`blue\blue`) specifically hunting for gaps — real player account features and the
Config/Enterprise surface neither prior research pass had covered. Same mechanism as
before: `app/Database/Seeds/DocsPageSeeder.php`, upsert-by-slug, applied via
`php spark db:seed DocsPageSeeder`.

**New player pages (user section, now 11 total):** Your Account (Profile/Hexad quiz/
Anonymize-Me privacy tool), My Work (personal journal — Overview/Milestones/My Answers/
Challenges/Achievements/Reset tabs), Getting Help (support requests + the Cooper AI chat
widget), Certificates & Secrets and Clues.

**New GM pages (setup section, now 35 non-Enterprise + 3 Enterprise = 38 total):**
Complete Adventure Settings Reference, Customizing Currencies/Ranks/Rewards, Managing Your
Player Roster (incl. CSV bulk import + Player Meta Manager), Setting Up AI Grading & Gift
Card Rewards (the actual Claude API key + Tremendous walkthroughs — the earlier "Grading &
AI-Assisted Feedback" page was conceptual, this is the settings-screen how-to), Customizing
Your Taskbar & Branding, Reviewing & Grading Submissions in Bulk (CSV round-trip), GM
Toolkit (Duplicator/PDF Report/Milestone Funnel/Bulk Create), Managing Player Support
Requests.

**New Enterprise pages (3, visually split out on the `/docs` hub into their own purple-
accented section rather than buried in the GM grid):** Organizations (multi-Adventure
account management — General/Players/Adventures/Stats tabs, cross-Adventure analytics),
Platform Settings & White-Label Branding (Custom Labels, platform-wide branding, Sponsors
directory), How Plan Tiers Actually Differ.

**Deliberate honesty call on Enterprise positioning:** the CI4 research found that
plan-tier feature gating (Basic vs. Pro vs. Enterprise) is **not actually enforced** in the
running CI4 app as of this writing — every feature value is identical across plans in the
live `blue` dev DB except `max_players` for God Mode. Rather than invent a feature-matrix
that doesn't exist, the "How Plan Tiers Actually Differ" page frames Enterprise honestly as
a **sales-assisted, Organizations-centric tier** (multi-Adventure account management +
custom Player Meta/HR fields + optional white-labeling), not a checklist of exclusive
toggles. Worth knowing if a future session is tempted to write a Basic/Pro/Enterprise
feature-comparison table — the code doesn't back one up yet.

**The `docs_pages.section` schema decision, flagged as open in the first GM-manual
handoff, was resolved without a migration:** Enterprise pages stay in `section = 'setup'`
(no new column value), split out purely at the view layer — `Docs::index()` filters
`setupDocs` by whether the title ends in the literal string `(Enterprise)` and passes a
separate `enterpriseDocs` array to the view. Cheap, no schema change, easy to extend by
just suffixing a title. If this convention feels too fragile as Enterprise content grows
further, revisit widening `section`'s `in_list` validation instead.

**Verified:** `php -l` clean on the seeder and the two edited controller/view files; every
one of the 49 pages hits 200 with zero PHP warnings; a direct DB-level regex check
confirmed every internal `/docs/...` cross-link across all 49 pages' bodies resolves to a
real slug (no broken links); the hub's new 3-way card split (11 cyan / 35 green / 3 purple)
verified by exact count.

## Follow-up — real BLUERABBIT accounts live at play.bluerabbit.io, not here

Important clarification from Bernardo: **this site's own auth (`users` table, `/login`,
`/admin`) is only ever for admins/collaborators managing the blog/docs CMS.** Real
player/GM BLUERABBIT accounts are a completely separate system, live at
`https://play.bluerabbit.io` (the CI4 port being deployed there now). Every public-facing
"Log In" / "Get Started" CTA on this site was, until now, wrongly pointing at this site's
own local auth — fixed:

- Added a single constant, `PLAY_APP_URL` (`app/Config/Constants.php`), rather than
  hardcoding `https://play.bluerabbit.io` in six-plus places. If the real app ever moves to
  a different URL, that's the only line to change.
- Nav "Log In" (logged-out state), footer "Log In"/"Get Started"/"Open CI4 Beta" (renamed
  to "Get Started"), and all three pricing-page CTAs ("Get Started Free," "Start Free
  Trial," "Create Your Account") now point to `PLAY_APP_URL` instead of this site's
  `/login`/`/get-started`.
- The one remaining visible pointer to this site's *own* `/login` — a "Log In" prompt on
  the public docs page inviting a logged-out visitor to unlock the gated Architecture & API
  section — was removed entirely per Bernardo's explicit request ("remove any login links
  from visibility, I'll type in a manual url"). The admin still reaches it by typing
  `/login` or `/admin` directly; `AuthFilter` still correctly redirects an unauthenticated
  `/admin` visit to the local `/login` (verified — this must stay local, it's the actual
  auth gate for the CMS, not a user-facing CTA).
- Deliberately left untouched: `Auth.php`'s internal redirects, `AuthFilter.php`'s gate
  redirect, and the mutual login↔register cross-links on the `auth/login.php` /
  `auth/register.php` pages themselves — all of that is internal navigation within the
  local admin-auth system, not a public marketing CTA, so it correctly keeps pointing at
  this site's own routes.
- Also deleted `app/Views/pages/docs.php` — discovered while auditing every `/login`
  reference that this was dead code, orphaned since `Pages::docs()` was replaced by the
  dedicated `Docs` controller earlier in the build; nothing referenced it anymore.

**Not yet decided:** whether `/get-started`'s local registration form (still fully
functional, just unlinked) should eventually be removed outright, or whether it's worth
keeping around for some other purpose (e.g., adding a second admin/collaborator account
without DB access). Left as-is for now since Bernardo only confirmed removing it from
visibility, not deleting the capability.

---

## 2026-08-14 — Privacy policy, Garden docs, and the past week's app features

**Privacy policy** — new `app/Views/pages/privacy.php`, `Pages::privacy()`, `/privacy` route,
and the footer's dead `href="#"` swapped for the real link. Written against what this site
actually collects (waitlist email + source; contact name/email/subject/message; site account
name/email/password hash; `ci_session`; server logs) and the processors it actually uses
(Resend, Cloudflare, the host, jsDelivr for admin-only TinyMCE). Explicitly states there is no
analytics or tracking, because there genuinely isn't any. **Carries a NEEDS LEGAL REVIEW block
at the top of the file** — the legal entity name, address, jurisdiction, and concrete retention
windows are unconfirmed placeholders. The footer's **Terms** link is still `href="#"` — not in
scope for this pass, still dead.

**Docs — the Garden (7 new pages).** The website had zero Garden coverage. Sourced from the CI4
app's own `GARDEN_PROJECT_BRIEF.md` and its dated `CLAUDE.md` entries, which are written as
verified-live build notes, then cross-checked against the real routes/controllers.
- user: `the-garden-overview`, `skills-and-blooms-explained`,
  `giving-blooms-endorsements-and-gifts`, `help-requests-and-messages`, `garden-missions`
- setup: `setting-up-your-skills-catalog`, `running-the-garden-as-a-gm`

**Docs — the rest of the week's app changes.**
- New `personalising-text-with-player-tokens` (setup) — the `{{ player.* }}` / `progress.*` /
  `guild.*` / `meta.*` / `adventure.*` token system that replaced WP's `[player_data]` shortcode.
  Legacy shortcodes still resolve, so migration is not forced — documented as such.
- `billing-and-plans` — added Billing History, past-due banner, failed-payment and
  trial-ending emails, refund reflection. Notes honestly that history predating the feature
  may be missing (the backfill command was never built — needs real Stripe keys).
- `your-account-profile-and-privacy` — added the 30-day session length.

**Marketing** — `pages/product.php` gained a Garden section between Journey Map and
Quests & Steps, leading on the withering mechanic. Section `alt` classes on the two following
sections were flipped to preserve the page's strict plain/alt alternation.

### Accuracy discipline used here
Only shipped behaviour was documented. Verified directly in the CI4 source rather than assumed:
endorsements grant **2** points with a 24h cooldown scoped per *(giver, recipient, skill)*
(`GardenController.php:296`), gifts grant **1** from a finite 20-per-adventure allowance, and DMs
are real (`MessageController`), not just designed. Things deliberately written as unresolved
rather than glossed: **gift-Bloom replenishment has no automatic rule yet** (GM manual top-up is
the only path), and `gift_bloom` is not yet an authorable Mission rule type.

**Deliberately NOT documented — needs Bernardo's confirmation.** Cloudflare Turnstile was built
complete on 2026-08-09 but shipped **inert pending real keys**, which Bernardo was obtaining the
next day. Whether it is live now is unknown from the code alone, so no doc claims players will
see a login challenge. Confirm and add if it's on.

### Verified
`php -l` clean on all six changed PHP files. `php spark db:seed DocsPageSeeder` ran clean
(it upserts by slug, so it is safe to re-run). All 15 affected routes return 200 over real HTTP
via `php spark serve`, with rendered-content assertions rather than status codes alone (privacy
body text present, footer link resolving, product page's Garden copy present, all three new doc
titles listed on the `/docs` hub). Zero new errors in `writable/logs/` — the single CRITICAL in
today's log is a pre-existing cache-permission entry from 03:00, unrelated.

**To deploy:** `git pull` on the server, then `php spark db:seed DocsPageSeeder` — the docs live
in the database, so a pull alone will not update them.

## 2026-08-14 — GDPR cookie consent panel

New `app/Views/partials/cookie_notice.php`, rendered from `layouts/main.php` just before
`</body>`. `layouts/admin.php` extends `layouts/main`, so this covers every page on the site
including admin — no second include needed.

**Built as real consent, not a notice bar, because analytics is coming.** Bernardo confirmed
analytics is planned "soon". An explain-only bar is fine for a site with nothing but essential
cookies, but becomes non-compliant the moment a tracking script ships, so the gating mechanism
is in place from day one rather than retrofitted under pressure later.

What makes it GDPR-shaped, deliberately:
- **Nothing non-essential runs before an explicit choice.** No implied consent — ignoring,
  scrolling past, or dismissing all count as "no". `has()` returns true only on an explicit yes.
- **Accept and Reject are equally prominent** — same size, same weight, side by side. A quiet
  Reject next to a loud Accept is a dark pattern regulators name specifically. There's a comment
  on the CSS rule saying so, because this is exactly the kind of thing a later "make the CTA pop"
  tweak breaks without realising.
- **Withdrawal is as easy as consent** — a "Cookie Settings" button in the footer reopens the
  panel on any page.
- **Consent expires.** The cookie is versioned (`v`) and timestamped, set for 12 months. Bump
  `CONSENT_VERSION` to force everyone to re-decide after a material change.
- **Revoking cleans up.** Withdrawing analytics consent deletes `_ga`/`_gid`/`_gat` on both host
  and dot-domain. Nothing sets these yet — it exists so the cleanup is already correct on the day
  analytics is switched on.

**THE ONE THING TO GET RIGHT WHEN ADDING ANALYTICS.** Do not put the tag in the layout. Use:
`brConsent.onGranted('analytics', function () { /* inject tag */ })` — it fires immediately if
consent already exists, otherwise queues until it's given. A tag loaded outside that callback
defeats the whole mechanism and puts the site in breach on ship day. This is documented in a
header comment in the partial itself, where whoever adds the tag will actually be looking.

Privacy policy gained a matching **Cookies** section (essential vs analytics, the "we do not
currently run analytics" statement, and how to change your mind).

### Verified
`php -l` clean on all three touched PHP files; `node --check` clean on the extracted script.
Logic exercised against a DOM/cookie stub rather than assumed, since there's no browser here —
12 assertions covering: panel opens only with no stored decision, `has()` false before any choice,
queued callbacks do **not** run on reject, do run on accept, late registration fires immediately,
withdrawal flips it back, `_ga` cleanup fires, and the cookie carries `path=/`, `SameSite=Lax`,
a 12-month expiry, `Secure` on https and correctly **omits** `Secure` on http so local dev works.
All five public routes still 200 with the panel, both buttons, and the footer link present in
the rendered HTML.

**Not covered:** real browser interaction (click physics, focus order, mobile layout) — same
no-browser limitation flagged throughout this file. Worth one manual look before it matters.

## 2026-08-17 — Cloudflare Turnstile (this site's own, built from scratch)

**Turnstile had never been on this site.** The 2026-08-09 Turnstile work lives in the CI4
product app (`C:\xampp\htdocs\blue`) — a different codebase. Nothing was shared or reused;
this is a fresh implementation for the marketing site.

- `app/Config/Turnstile.php` — `siteKey`/`secretKey` populated from `.env`, never hardcoded.
- `app/Libraries/Turnstile.php` — plain cURL to Cloudflare's siteverify, matching
  `ResendMailer`'s no-HTTP-client-dependency convention.
- `app/Views/partials/turnstile_widget.php` — renders the widget div, or nothing when unconfigured.
- Wired into all four public POST forms, each with its own `data-action` so Cloudflare's
  analytics can tell them apart: **waitlist, contact, login, register**.

**api.js is emitted once from `layouts/main.php`, not per widget** — Cloudflare warns against
double-loading it, and a `static` guard inside a view partial can't reliably dedupe across
renders (first attempt did that; it was replaced before shipping).

**Failure behaviour is deliberately asymmetric**, documented in the library docblock:
unconfigured → inert/pass; Cloudflare unreachable → pass + CRITICAL log; real negative verdict
(missing, forged, expired, replayed token) → **reject**. Letting a Cloudflare outage take down
the waitlist and contact forms was judged worse than the narrow bypass window. That trade lives
in one place and every caller just consumes a bool.

### The keys — ACTION NEEDED
Bernardo supplied `0x4AAAAAABg4oQP79arMKbIf` as **both** site key and secret. Verified against
Cloudflare directly — that value as a secret returns `{"error-codes":["invalid-input-secret"]}`.
It is a site key only. **The real secret is still outstanding**, and deploying with the
duplicate would reject every submission on all four forms simultaneously. Local `.env` is
therefore left BLANK (inert) rather than half-configured, so localhost keeps working.

### Verified
`php -l` clean on all 11 touched/new files. Exercised live over real HTTP in both states:
- **Inert** (no keys): all pages 200, zero widget divs, zero api.js tags, forms still submit.
- **Configured** (Cloudflare's published dummy keys): exactly 1 widget div and exactly 1 api.js
  tag per page, correct site key rendered, and the right `data-action` on each of the four forms.
- **Round trip, always-PASS secret** (`1x0000…AA`): waitlist POST succeeded and the row genuinely
  landed in `waitlist_signups`.
- **Round trip, always-FAIL secret** (`2x0000…AA`): waitlist POST correctly blocked, **no row
  inserted**. Contact form likewise blocked.
- **Missing token entirely**: correctly blocked without even calling Cloudflare.
- Test rows deleted afterwards; `.env` restored to blank.

**Not verified:** the `invalid-input-secret` CRITICAL branch didn't fire under the always-fail
key (Cloudflare returns `invalid-input-response` for that one), so that specific log line is
reasoned-through rather than observed — though the underlying Cloudflare response was confirmed
by hand, which is what the branch keys off. Also untested: real browser interaction with the
widget itself, same standing no-browser limitation as elsewhere in this file.

### Separately noticed, NOT fixed — flagged for a decision
**The CSRF filter is commented out globally** in `app/Config/Filters.php` (~line 78), so every
public POST on this live site is currently forgeable cross-site, even though the forms all
render `csrf_field()`. This is the same gap the CI4 app found and fixed in its own overnight
audit. Out of scope for a Turnstile pass, but it is a real live-site issue and wants its own
piece of work.

## 2026-08-17 — CSRF enabled, and a real RCE found and closed

Bernardo asked for the CSRF filter, "configured to protect us from injections... AND ANY
VULNERABLE FIELD". Worth recording plainly for the next session: **CSRF does not protect
against injection.** They are separate attacks with separate fixes. CSRF stops a third-party
site making an already-logged-in browser submit a request; injection is untrusted input
reaching an interpreter. Both were addressed, but as two pieces of work, not one.

### CSRF
Enabled `csrf` + `invalidchars` (before) and `secureheaders` (after) in `Config\Filters::$globals`
— all three were stock CI4 commented-out defaults, so every state-changing POST on a live site
was forgeable. Every form in `app/Views` already rendered `csrf_field()` and the TinyMCE
uploader already posted the token, so **not one form needed changing**.

`Config\Security::$regenerate` flipped `true` → `false`, and this is load-bearing, not cosmetic.
With per-request rotation the TinyMCE uploader — which reads the token out of the form's hidden
input — works for the *first* image and 403s on every one after, because the DOM still holds the
spent token. Multiple tabs and back-button resubmits break identically. `false` gives one token
per `$expires` window (2h), which is a standard supported CI4 mode.

### The actual security hole: arbitrary file upload → RCE in `Admin\UploadController`
Found while auditing "any vulnerable field". The old code checked
`str_starts_with($file->getClientMimeType(), 'image/')` and saved under `getRandomName()`:

1. `getClientMimeType()` is the browser's own Content-Type header — attacker sets `image/png`.
2. `getRandomName()` takes its extension from `guessExtension()`, which uses the **real**
   finfo-detected type. PHP source detects as `text/x-php`, which is in CI4's own
   `mimes['php']` list (`vendor/.../app/Config/Mimes.php:115`), so `guessExtensionFromType()`
   *keeps* the proposed `.php`.
3. Result landed in web-served `public/assets/uploads/content/` as `.php`. **Remote code
   execution**, gated only by admin auth — which is precisely why the missing CSRF filter
   mattered so much: one CSRF against a logged-in admin was a path to code execution.

Fixed by trusting nothing from the request: real `getMimeType()` checked against an explicit
allowlist, `getimagesize()` confirming it parses as a real image, a 5MB cap, and **the stored
extension chosen from our own map** rather than from anything uploaded. Filename is
`bin2hex(random_bytes(16))` — no user input reaches it. SVG deliberately excluded (XML that can
carry `<script>` = stored XSS from our own origin).

Added `public/assets/uploads/.htaccess` as a second layer — disables the PHP engine, strips
executable handlers by name (`php_flag` doesn't work under PHP-FPM/CGI, which is how cPanel runs
PHP) and denies serving those extensions outright. Do not delete it because the folder only
holds images today; that is the assumption it exists to protect against.

### Injection audit — findings
- **SQL injection: not present.** No raw `query()`/`simpleQuery()` anywhere in `app/`. Everything
  goes through Model/Query Builder, which parameterises. The only `$this->db->` calls are seeders
  with literal values.
- **XSS:** the three unescaped outputs (`blog/show.php`, `docs/show.php`, `emails/layout.php`)
  are all admin-authored HTML, deliberate and already documented. No *visitor*-supplied value is
  rendered unescaped anywhere — contact messages are only counted on the dashboard, never
  displayed, so there is no stored-XSS path from the public forms today. **If a contact-message
  viewer is ever built, it must `esc()`** — that is the moment this becomes a real hole.
- Mass assignment already mitigated: every model declares `$allowedFields` explicitly.

### Verified live over HTTP
All pages still 200. POST with no token → **403**. POST with a valid token → 303 + row genuinely
inserted. **Same token reused across 3 sequential POSTs → all 303**, proving `regenerate=false`
works and TinyMCE multi-upload won't break. Security headers confirmed present on GET
(`X-Frame-Options`, `nosniff`, `Referrer-Policy`, ...) — note they don't appear on `HEAD`, so
`curl -I` misleadingly shows nothing. Upload: logged in as a real admin and **ran the actual
exploit** — PHP payload with spoofed `Content-Type: image/png` → rejected, nothing written to
disk; a genuine 1x1 PNG → accepted and stored as `<random>.png`. Test rows and the uploaded test
file removed afterwards.

**Still not done:** the admin password is still `ChangeMe123!` and `/login` is public. The CSRF
fix makes an admin session harder to abuse; it does nothing about a guessable password that is
published in this repo.

## 2026-08-17 — Password recovery UI

Forgot-password / reset flow, this site's own accounts only (the app's are separate).

- Migration `2026-08-17-000001_CreatePasswordResets` — new `password_resets` table. A separate
  table, not columns on `users`, so issuing/expiring/auditing a reset never touches the account
  row and tokens can be revoked wholesale.
- `PasswordResetModel` — `issueFor()` / `findValid()` / `consume()` / `revokeAllFor()`.
  Named that way on purpose: `get()`/`set()` are reserved by CI4's base Model (rule 8).
- `Auth::forgotForm/forgot/resetForm/reset`, routes, and `auth/forgot.php` + `auth/reset.php`.
- Login page gained a "Forgot your password?" link **and** an `auth_success` flash block — it
  only rendered `auth_error` before, so the post-reset confirmation had nowhere to display.

### Security decisions
- **Only the SHA-256 of the token is stored.** The raw token exists solely in the emailed link.
  A dumped/backed-up/replicated table cannot reset anyone's password.
- **No user enumeration.** Every outcome — unknown address, malformed address, disabled account,
  real account — returns the identical success message. Verified live: real vs unknown email
  produce byte-identical responses while only the real one creates a token row.
- **Disabled accounts get the message but no email**, so a reset isn't a way back into an
  account someone deliberately closed.
- Single-use (`used_at`) and 60-minute expiry, both enforced inside `findValid()` rather than in
  the controller so no caller can skip one. Requesting a new link revokes outstanding ones.
- Validation failures (short password, mismatch) **do not** burn the token — verified.
- Turnstile on the forgot form; CSRF applies automatically via the global filter.
- Reset email passes `includeUnsubscribe: false` — a security email must not carry a waitlist
  unsubscribe link, which would silently drop the person off the list.
- Logs CRITICAL if a reset is requested while Resend is unconfigured, since the user would
  otherwise see success while no email could possibly send.

### A real bug caught in testing, worth remembering
The first implementation ended with `session()->destroy()` then
`redirect()->with('auth_success', ...)`. **The flash never renders** — `with()` writes into the
session that was just torn down. Proven, not assumed: swapped `destroy()` back in and the
confirmation disappeared; swapped the fix in and it returned. Now uses
`session()->remove([...])` + `regenerate(true)`, which signs this browser out while leaving a
live session to carry the message.

Related correction to an over-claim in the first draft: this signs out **this browser only**.
With file-based sessions another device stays logged in until its own session expires. Real
revocation would need per-user session tracking or an AuthFilter check against a
password-changed timestamp. Neither exists; the UI no longer claims otherwise.

### Testing gotchas that cost time here — read before debugging this flow
1. **`curl -L` follows the redirect to `app.baseURL`'s host**, i.e. `localhost` (XAMPP:80), not
   the `spark serve` port. The session cookie doesn't travel, so flashes look broken when they
   aren't. Follow redirects manually against the test port.
2. **MySQL `NOW()` and PHP `date()` are not the same clock here** — MySQL runs local, CI4 sets
   PHP to UTC. The app is internally consistent (PHP time on both write and compare), but any
   token seeded by hand with `NOW()` will look expired. Seed with `gmdate()`.

### Verified
`php -l` clean on all eight touched/new files. Full flow live over HTTP: forgot form 200;
enumeration-identical responses with only one token created; valid link renders the form, bogus
link redirects away; mismatched-confirm and too-short both rejected **without** consuming the
token; valid reset changes the password, old password stops working, token marked used, reusing
the link redirects away; login with the new password succeeds and reaches `/account`; the
confirmation renders on the login page; `/account` 302s after reset. `php spark migrate --all`
run against a **freshly created empty database** — all seven migrations clean — plus a
`migrate:rollback` to confirm `down()` works. Scratch DB dropped, `.env` restored, test user and
all its token rows deleted.
