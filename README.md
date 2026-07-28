# bluerabbit.io — website rebuild

CodeIgniter 4 rebuild of bluerabbit.io: marketing site, blog, and docs. Built by Claude
in a cloud sandbox and handed off here — see `claude-notes/BUILD-STATUS.md` for exactly
what's done and what's next.

## Setup (XAMPP)

1. **Install dependencies** — this folder ships without `vendor/` (too big to transfer).
   From this directory:
   ```
   composer install
   ```
2. **Create the `.env` file**:
   ```
   copy env .env
   ```
   The defaults already match your usual XAMPP/MySQL conventions (root, no password),
   assuming this folder is `C:\xampp\htdocs\website`. Adjust `app.baseURL` if you set up
   a dedicated vhost instead of using the raw `htdocs` path.
3. **Create the database**: `bluerabbit_site` (matches the default in `.env`).
4. **Run migrations + seed sample blog posts**:
   ```
   php spark migrate --all
   php spark db:seed BlogPostSeeder
   ```
5. Visit `http://localhost/website/` (or your vhost).

## What's here

- Homepage, product/solutions/pricing/contact/login/get-started placeholders, and a
  working public blog (`/blog`, `/blog/{slug}`) reading from a real `blog_posts` table.
- The homepage waitlist form is fully wired — posts to `/waitlist`, validates, stores to
  `waitlist_signups`, and shows a success/error state back in the hero.
- All styling lives in `public/assets/css/site.css`, pulling the exact HUD palette from
  the live app's `_variables.scss`.

## What's not built yet

See `claude-notes/BUILD-STATUS.md` for the current state and the prioritized next slice
(admin blog CRUD, auth + gated `/docs/developer`, Resend waitlist emails, product/pricing
page content).

## Framework docs

This is a stock CodeIgniter 4 app — the [user guide](https://codeigniter.com/user_guide/)
covers routing, views, models, and migrations if you want to extend anything directly.
