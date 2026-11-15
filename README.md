# bluerabbit.io — the public website

CodeIgniter 4 site for bluerabbit.io: marketing pages, blog, documentation, the legal pages in
eleven languages, and the waitlist. It is not the BLUERABBIT app (that is play.bluerabbit.io, a
separate repository with separate accounts).

## Start here

**Developers: read `/docs/developer/start-here` on the running site** (an admin account on this
site is needed; its text is also in `app/Database/Seeds/DocsPageSeeder.php`, slug `start-here`).
It covers what the site is, how it is built, running it locally, how the docs map to the app,
deploying, and what is still open for launch.

Then: `CLAUDE.md` (the rules), `WEBSITE_PROJECT_BRIEF.md` (the decisions), `claude-notes/BUILD-STATUS.md`
(what was built and verified, newest at the end), `claude-notes/DEPLOY.md` (the server runbook),
`claude-notes/LEGAL-TRANSLATIONS.md` (the translated legal pages and their review).

## Setup (XAMPP)

1. `composer install` (this repo ships without `vendor/`).
2. `copy env .env`. Browsing without a virtual host, `app.baseURL` must be
   `http://localhost/website/public/` (with `/public/`), or styles and links resolve one folder too high.
3. Create the database `bluerabbit_site` (MySQL, root with no password by default in `.env`).
4. `php spark migrate --all`, then `php spark db:seed DatabaseSeeder` (the admin account, sample
   blog posts and every documentation page).
5. Visit `http://localhost/website/public/`.

Turnstile and email stay off until their keys are set (`.env` for Turnstile, Admin > Settings for
Resend), which is the safe default for a local copy.

## What's here

- Home (waitlist in the hero), product, solutions, pricing (links into the app; nothing is sold
  here), contact, the AI-at-work FAQ.
- Blog (`/blog`), written in `/admin/blog`.
- Documentation (`/docs`): the player and Game Master manual and the Enterprise pages, public; the
  developer section (`/docs/developer`), admins only. Source: `DocsPageSeeder.php`.
- Legal pages (`/terms`, `/privacy`, `/refunds`) and their translations (`/{code}/terms` ...).
- This site's own sign-in and admin (`/login`, `/admin`): blog, docs, waitlist campaigns, settings.

## Framework docs

A stock CodeIgniter 4 app: the [user guide](https://codeigniter.com/user_guide/) covers routing,
views, models and migrations.
