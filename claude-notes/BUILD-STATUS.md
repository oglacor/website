# Build status — 2026-07-27 (overnight build session)

**Live on Bernardo's machine now** at `C:\xampp\htdocs\website`, running via
`http://localhost/website/public/` (no vhost). All migrations run, seeded, confirmed
working end-to-end via HTTP-level testing against a real database (see "How this was
tested" below).

See `WEBSITE_PROJECT_BRIEF.md` for full context/decisions and `CLAUDE.md` for the
operating rules — this file is just the state snapshot.

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
4. Docs page content is only 5 seeded starter pages — real, comprehensive documentation
   still needs writing (the CMS to write it in now exists at `/admin/docs`).
