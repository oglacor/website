# bluerabbit.io — Website Rebuild — Complete Project Brief
*For use as context in Claude Code for overnight/unattended work.*

---

## What Is This Project?

This repo is the **public-facing bluerabbit.io** — marketing site, blog, and documentation
for BLUERABBIT, a gamification platform. It is a **from-scratch CodeIgniter 4 build**,
started 2026-07-27, replacing the old WordPress/Divi bluerabbit.io.

**This is NOT the BLUERABBIT app.** Bernardo has two sibling local projects that this repo
only *reads from as reference* — never edits:

| Folder | What it is |
|---|---|
| `C:\xampp\htdocs\bluerabbit\wp-content\themes\bluerabbit` | The **live BLUERABBIT app**, a WordPress theme. Source of truth for product features, brand colors/assets. Has its own `CLAUDE.md`. |
| `C:\xampp\htdocs\blue\blue` | The **CI4 migration of the app** — the "open version" new users will test, includes Stripe. Has its own `CLAUDE.md` and `BLUERABBIT_PROJECT_BRIEF.md`. This is where real plan/pricing data should be pulled from for the pricing page. |
| `C:\xampp\htdocs\website` (**this repo**) | The public website: marketing pages, blog, docs, waitlist. Its own independent CI4 app, own database, own auth. |

Bernardo is actively rebuilding the app itself (both siblings above) separately in Claude
Code. Work in *this* repo should stay scoped to the website — don't reach into the sibling
folders to change anything, only read them for brand/content/data reference.

---

## Tech Stack

- **CodeIgniter 4** (`^4.7`), PHP 8.2+
- MySQL via XAMPP (root / no password locally, matching the `blue/blue` convention)
- No frontend framework/build step — plain CSS in `public/assets/css/site.css`, vanilla PHP
  views using CI4's `extend()`/`section()` templating
- No JS framework — keep it vanilla unless a specific feature genuinely needs more

---

## Brand & Design System

Colors and identity were extracted directly from the live app's
`bluerabbit\wp-content\themes\bluerabbit\css\_variables.scss` — treat that file as the
source of truth if a color question ever comes up.

```
Background:   #04161e      Surface:      #030f18 / #0b3d4f
Cyan (brand): #1cc2eb      Cyan text:    #90f3fe
Yellow:       #f7cb15      Purple:       #9f40e2
Green:        #24da98      Red:          #e24040
```

- Fonts: `Rajdhani` (condensed, HUD/headings) + `Inter` (body) via Google Fonts. These are
  **stand-ins** for the live app's licensed `proxima-nova` / `proxima-nova-extra-condensed`
  — swap them in if/when Bernardo licenses those fonts for this site.
- Visual language: dark HUD aesthetic, angular clipped-corner panels (see `.panel` class —
  uses `clip-path` + a gradient-border pseudo-element trick), thin cyan glow borders,
  low-poly origami rabbit mark.
- The rabbit mark is a reusable view partial: `app/Views/partials/rabbit_icon.php`, takes
  `$fill` and `$size` params. Don't duplicate the SVG inline elsewhere — use the partial.
- All shared tokens/components live in `public/assets/css/site.css` as CSS custom
  properties (`:root { --cyan: ... }`) — extend that file rather than inventing new colors.

---

## Confirmed Product Decisions

- **Auth is its own, fully separate system.** Never share or mix bluerabbit.io's auth with
  the main BLUERABBIT app's auth. Direct quote from Bernardo: *"Own system. Don't mix.
  Ever."* This is non-negotiable — don't try to unify them for convenience.
- **Docs are public by default.** End-user how-to, onboarding & billing guide, and
  marketing/product overview are all open, no login. Only `/docs/developer` (architecture,
  API reference, setup) is gated — restricted to site admins/collaborators.
- **Blog is a custom CI4 module**, not WordPress, not a third-party CMS. Bernardo needs
  full content-editing control and doesn't want to run a second WordPress instance just
  for blogging.
- **Marketing/waitlist module:** Resend API key (configured by admin), captures signups to
  the DB, sends campaign emails to opted-in signups. Not built yet — see Priorities below.
- **Pricing page mirrors the CI4 app's real Stripe plans.** It does NOT check out on the
  marketing site — it links users to create an account, and they choose/upgrade plans from
  inside the app itself. Pull actual plan names/prices/features from `blue/blue` (see its
  `br_plans` / `br_plan_features` / `br_features` tables and Stripe config) rather than
  inventing numbers.
- **Trust bar / client logos:** currently generic use-case labels (Corporate L&D, Employee
  Onboarding, etc.) — Bernardo is compiling a list of real client logos to swap in. Leave
  the generic labels in place until that list arrives; don't invent placeholder logos.
- **Relaunch positioning / voice:** the site is framed as a "comeback" — as if a new
  company acquired and relaunched BLUERABBIT (not literally true, just the framing).
  Tone: faster, more powerful, fully AI-integrated, "on steroids." The waitlist signup
  must stay prominent — in the hero, not buried lower on the page. Keep this voice
  consistent in any new copy (Product/Solutions/Contact pages, etc.) unless Bernardo says
  otherwise.
- **Long-term vision:** this site eventually becomes Bernardo's full Customer Management
  (CRM) — waitlist → customer lifecycle tracking — not just a brochure site. The
  `/admin/customers` route is reserved in the sitemap for this; don't build it yet, but
  don't design the data model in a way that would block it later (e.g., keep
  `waitlist_signups` as a clean append-only table you could later join against a future
  `customers` table).

---

## Sitemap

**Public**
- `/` — Home (hero waitlist, features, how-it-works, docs/what's-coming split, blog preview)
- `/product` — Platform overview (journey map, XP/BLOO/EP, achievements, guilds, steps) — **built, real content sourced from `blue/blue`**
- `/solutions` — Use cases: corporate L&D, onboarding, bootcamps — **built, real content sourced from `blue/blue`**
- `/pricing` — Mirrors CI4 app's Stripe plans, links to account creation — **built, real plan data (see caveat on Stripe price IDs not yet live in `blue/blue`'s dev DB — confirm $8/$80 numbers before launch)**
- `/blog`, `/blog/{slug}` — Blog index + post detail — **built, working**
- `/waitlist` (POST) — Waitlist signup handler — **built, working, sends a Resend welcome email if configured**
- `/login`, `/get-started`, `/logout` — Own auth system (`Auth` controller, `users` table) — **built, working**
- `/contact` (GET + POST) — **built, working — stores to `contact_messages`**
- `/docs` — Docs hub (end-user, onboarding/billing — public) — **built, DB-driven via `docs_pages`**

**Gated — site admins/collaborators only**
- `/docs/developer` — Architecture, API/routes, setup — **built, gated by `auth:admin` filter**

**Authenticated (any logged-in user)**
- `/account` — Profile (read-only) — **built**

**Admin**
- `/admin` — Dashboard — **built**
- `/admin/blog` — Blog CMS (create/edit/delete/publish, image upload) — **built**
- `/admin/waitlist` — Signup list + Resend campaign send — **built**
- `/admin/docs` — Docs CMS — **built**
- `/admin/settings` — Resend API key + from-address config — **built**
- `/admin/customers` — *(future CRM phase)* — **out of scope for now, not started**

---

## Current Build Status (as of 2026-07-27, first build session)

**Done, tested, and working:**
- CI4 skeleton, shared layout (`app/Views/layouts/main.php`) with nav/footer
- Homepage fully built and matches the approved design concept
- Blog: `blog_posts` migration + `BlogPostModel` + public controller/views, 3 seeded posts
  via `BlogPostSeeder`, pagination working
- Waitlist: `waitlist_signups` migration + `WaitlistSignupModel` + `/waitlist` POST with
  validation, CSRF, and flash-message success/error UI
- Docs page shell (public, correctly marks the dev section as admin-gated)
- Placeholder pages for Product/Solutions/Pricing/Contact/Login/Get Started so the nav is
  fully wired and nothing 404s

**Not built yet — see Priorities below for order.**

---

## Two Real Bugs Hit During the First Build (both fixed — worth knowing the root cause)

1. **`WaitlistSignupModel` had `$updatedField = false`** to disable the updated_at column.
   CI4's `BaseModel::setUpdatedField()` checks `$this->updatedField !== ''` — `false !== ''`
   is `true`, so the check passes and it does `$row[$this->updatedField] = $date`, i.e.
   `$row[false] = $date`, which PHP casts to `$row[0]`. That integer key then blows up
   `BaseBuilder::setBind()` deep in the insert path with a `TypeError`. **Fix:** always use
   `''` (empty string), never `false`, to disable `$createdField`/`$updatedField` on a model.
   If you see "Argument #1 ($key) must be of type string, int given" from any model insert,
   check this first.

2. **`.env`'s `app.baseURL` didn't match the actual browsing URL.** This repo has no vhost
   set up — Bernardo browses `http://localhost/website/public/` directly. The shipped
   `.env`/`env` template had `app.baseURL = 'http://localhost/website/'` (missing
   `/public/`), which made every `base_url()`/`site_url()`-generated asset link resolve one
   directory too high — CSS/assets 404'd, page loaded unstyled. **Fixed** in both `env` and
   his live `.env`. If a vhost pointing straight at `public/` gets set up later, drop the
   `/public/` back out of `baseURL` at that point.

---

## Local Dev Setup

- XAMPP, Windows, folder is `C:\xampp\htdocs\website`
- No vhost currently — browse via `http://localhost/website/public/`
- MySQL: `root` / no password, database `bluerabbit_site`
- `composer install`, then `copy env .env`, create the `bluerabbit_site` database, then
  `php spark migrate --all && php spark db:seed BlogPostSeeder`
- **You (Claude Code) have real internet access on this machine** — just use normal
  `composer install`/`composer require`. Ignore any mention elsewhere of offline
  path-repository workarounds — those were specific to the cloud sandbox that built the
  first slice of this app and do not apply here.

---

## Priorities For Ongoing Work

Everything below was built in the 2026-07-27 overnight session — see
`claude-notes/BUILD-STATUS.md` for full detail, testing notes, and bugs found/fixed along
the way. What's left:

1. **Real client logos** — swap into the homepage trust bar once Bernardo provides them.
2. **Visual QA pass** — the overnight build was verified at the HTTP level (routes, forms,
   access control, DB state) but not visually in a browser — no screenshot tool was
   available in that session. Worth a manual look at `/pricing`, `/product`, `/solutions`,
   and the admin screens before calling this launch-ready.
3. **Confirm the $8/mo, $80/yr Pro pricing** is still accurate — those numbers came from
   code comments in `blue/blue`, not live Stripe config (no price IDs are actually set in
   its dev DB yet).
4. **Write real docs content** — the CMS at `/admin/docs` exists and is seeded with 5
   starter pages, but comprehensive end-user/onboarding documentation still needs writing.
5. **Change the seeded admin password** (`admin@bluerabbit.io` / `ChangeMe123!`) before
   this site is ever exposed outside localhost.
6. **CRM phase** (`/admin/customers`) — explicitly out of scope until everything above is
   solid. Don't start this unprompted.

When picking up work, check `claude-notes/BUILD-STATUS.md` for the latest snapshot — keep
that file updated as you complete things, the same way this brief should be updated when
decisions change.
