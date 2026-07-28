# CLAUDE.md — bluerabbit.io website

This file is your entry point. Full context, decisions, and rationale live in
`WEBSITE_PROJECT_BRIEF.md` — read it before starting substantial work. Current build state
lives in `claude-notes/BUILD-STATUS.md` — read it every session, update it as you finish
things. This file is the condensed operating manual.

## What this repo is

The public bluerabbit.io — marketing site, blog, docs. A standalone CodeIgniter 4 app with
its own database and its own auth. It is **not** the BLUERABBIT product app.

Two sibling folders exist purely as read-only reference — do not edit anything in them:
- `C:\xampp\htdocs\bluerabbit\wp-content\themes\bluerabbit` — live WP app (brand assets,
  actual product behavior)
- `C:\xampp\htdocs\blue\blue` — CI4 migration of the app (pull real plan/pricing/feature
  data from here, especially `BLUERABBIT_PROJECT_BRIEF.md` and the Stripe/plan tables)

## Hard rules — do not violate these

1. **Auth for this site must be its own system. Never share or reuse the main app's auth,
   session, or user table.** Bernardo has said this explicitly and repeatedly — treat it as
   a hard constraint, not a suggestion.
2. **Don't edit the sibling `bluerabbit` or `blue/blue` folders.** Read-only reference only.
3. **Pricing page never checks out on this site.** It links to account creation; billing
   happens inside the app. Don't build a Stripe checkout flow here.
4. **`/docs/developer` is gated to admins/collaborators; everything else under `/docs` is
   public.** Don't flip that default.
5. Model `$createdField`/`$updatedField` — use `''` to disable, **never** `false`. (See the
   bug writeup in the brief if you want the why.)
6. When browsing locally without a vhost, `.env`'s `app.baseURL` must include `/public/`
   (`http://localhost/website/public/`). If a vhost gets added later pointing straight at
   `public/`, drop the `/public/` suffix at that point — but don't change it speculatively.
7. You have real internet access on this machine — use normal `composer install` /
   `composer require`. Any mention of offline path-repositories or mirrored packages refers
   to how the first build slice was tested in a sandboxed cloud environment without
   Packagist access; it does not apply here and shouldn't be replicated.
8. Never name a model method `get()` or `set()` — those are reserved by CI4's base `Model`
   class (query-builder methods) and a signature mismatch is a fatal `ErrorException` at
   call time, not a lint error. Hit this with `SiteSettingModel`; use `getSetting()`/
   `setSetting()` or similar instead.
9. If a model's `$validationRules` uses an `is_unique[table.field,id,{id}]` placeholder,
   the placeholder field (`id`) must **also** have its own entry in `$validationRules`
   (e.g. `'id' => 'permit_empty|is_natural'`) — in this CI4 version (4.7.4), just having
   `id` present in the `$data` passed to `validate()` isn't enough and throws a
   `LogicException` on update. Add the `id` rule from the start on any new model that uses
   this pattern.

## Conventions established so far — follow these, don't reinvent

- **Views**: `$this->extend('layouts/main')` / `$this->section('content')` /
  `$this->endSection()`. Shared layout is `app/Views/layouts/main.php`. New top-level pages
  go in `app/Views/pages/`, feature-specific views get their own subfolder (see
  `app/Views/blog/`).
- **Styling**: everything in `public/assets/css/site.css`, CSS custom properties for
  tokens. The `.panel` class is the reusable angular-HUD-card look — use it for any new
  card/panel UI rather than one-off styles.
- **Rabbit mark**: `view('partials/rabbit_icon', ['fill' => '#1cc2eb', 'size' => 30])` —
  don't inline the SVG elsewhere.
- **Models**: `returnType = 'array'`, `$allowedFields` explicit, validation rules on the
  model itself (see `WaitlistSignupModel` for the pattern — required + custom messages).
- **Migrations**: timestamped filenames (`YYYY-MM-DD-NNNNNN_Description.php`), one table
  per migration, forge-based (see the two existing migrations for the pattern).
- **Routes**: flat in `app/Config/Routes.php` for now; the commented-out block at the
  bottom shows the intended shape for auth-gated and admin route groups once auth exists —
  uncomment and build against that rather than inventing a different structure.
- **Copy/voice**: "comeback / relaunch / on steroids" framing — faster, more powerful,
  fully AI-integrated. Keep new page copy consistent with the homepage's tone unless told
  otherwise.

## Recommended order of work

See "Priorities" in `WEBSITE_PROJECT_BRIEF.md` — auth first, then admin blog CRUD, then
real content pages, then pricing, then Resend, then docs CMS. Don't jump ahead to the CRM
phase (`/admin/customers`) — it's explicitly deferred.

## Verifying your own work

There's no test suite covering the custom code yet (`tests/` is still just the stock CI4
scaffold). At minimum, before considering something done:
- `php spark serve` and hit the relevant route(s) directly — check for actual 200s, not
  just "no fatal error"
- For anything touching the DB, re-run `php spark migrate --all` on a clean database to
  confirm migrations run cleanly, not just against your already-migrated dev DB
- For UI changes, a real look at the rendered page (screenshot or manual check) — CSS
  class typos and layout breaks don't throw PHP errors, so "no error" isn't "it works"
- Update `claude-notes/BUILD-STATUS.md` when you finish or partially finish something, so
  the next session (human or AI) knows the real state without re-deriving it
