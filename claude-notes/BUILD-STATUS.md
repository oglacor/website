# Build status — 2026-07-27 (overnight build session)

**Live on Bernardo's machine now** at `C:\xampp\htdocs\website`, running via
`http://localhost/website/public/` (no vhost). All migrations run, seeded, confirmed
working end-to-end via HTTP-level testing against a real database (see "How this was
tested" below).

See `WEBSITE_PROJECT_BRIEF.md` for full context/decisions and `CLAUDE.md` for the
operating rules — this file is just the state snapshot.

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
