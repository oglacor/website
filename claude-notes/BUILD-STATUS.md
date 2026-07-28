# Build status — 2026-07-27

## Done, tested, and working

- CI4 skeleton (appstarter base) with routing, layout, and shared nav/footer.
- **Homepage** — full HUD-styled hero with the "comeback, on steroids" relaunch copy,
  prominent waitlist form, feature grid, how-it-works, docs/what's-coming split, and a
  blog preview pulling real published posts from the database.
- **Blog** — `blog_posts` table (migration + model), public index with pagination,
  post detail page, 3 seeded sample posts (`BlogPostSeeder`).
- **Waitlist** — `waitlist_signups` table, `/waitlist` POST endpoint with validation
  (valid email, no duplicates), CSRF-protected, flash-message success/error state
  rendered back in the hero.
- **Docs page** — public index listing end-user/onboarding/product-overview sections,
  with the architecture/API section clearly marked admin-login-required (not built yet,
  see below).
- Placeholder pages for Product, Solutions, Pricing, Contact, Login, Get Started — real
  content still needs to be written, but the nav/IA is fully wired so nothing 404s.
- Visually verified against the approved concept mockup (Playwright screenshots of home,
  blog index, and a post — all matched).

## A real bug found + fixed during testing

`WaitlistSignupModel` had `$updatedField = false` to disable the updated-at column. CI4
checks `$updatedField !== ''`, so `false` doesn't disable it — it evaluates truthy and
the framework does `$row[false] = $date`, which PHP casts to `$row[0]`, corrupting the
insert with an integer array key. Fixed by setting `$updatedField = ''` (empty string)
instead. Worth knowing if you ever see a similar "Argument must be of type string, int
given" error from a model elsewhere — same root cause.

## Not built yet (prioritized)

1. **Auth** — no login system yet. Needed before the gated `/docs/developer` section and
   any admin screens are real. Open question from earlier: should this share auth with
   the main BLUERABBIT app, or be its own system? Assumed separate/lightweight for now.
2. **Admin blog CRUD** — posts currently only exist via the seeder. Needs an authenticated
   `/admin/blog` screen (create/edit/publish, image upload) before you can actually run
   this as a blog day-to-day.
3. **Resend waitlist emails** — signups are captured in the DB but nothing sends yet.
   Needs an admin settings screen for the API key, plus a send/campaign flow.
4. **Real content** for Product, Solutions, Pricing, Contact — currently placeholders.
5. **Docs CMS** — same pattern as blog CMS, for the public + gated doc sections.
6. **CRM phase** — `/admin/customers` is reserved in the sitemap but out of scope for now.

## Local testing note (you can ignore this — it's about my sandbox, not your setup)

I built and tested this in a cloud sandbox that can't reach Packagist/GitHub archive
downloads, so I mirrored `codeigniter4/framework` (tag v4.7.4), `laminas/laminas-escaper`,
and `psr/log` via direct git clone and wired them in with Composer path repositories to
install offline. That workaround is NOT part of what's shipped here — `composer.json` is
back to a normal `codeigniter4/framework: ^4.7` requirement, so your `composer install`
will pull the real packages from Packagist like any other project. Local testing also
used SQLite (`writable/database/`) since there was no MySQL server in the sandbox; the
shipped `.env` template targets MySQL to match your XAMPP setup.
