# Deploy runbook — moving the site from new.bluerabbit.io to bluerabbit.io

Target setup: cPanel shared hosting. The apex currently serves the old WordPress/Divi
site; the CI4 rebuild is already installed and working under the `new.` subdomain.

The whole point of this runbook: **no file dragging.** The install already exists on the
server, so the cutover is a document-root repoint plus a config change. Files never move
over the wire, and the database is untouched.

---

## Part 1 — one-time: make deploys a `git pull` instead of an upload

Do this first, even though it isn't strictly required for the cutover. It's what makes
every future push cheap.

1. cPanel → **Git™ Version Control** → *Create*.
2. Tick *Clone a Repository*.
   - **Clone URL:** `https://github.com/oglacor/website.git`
     (if the repo is private, cPanel shows an SSH key on that screen first — add it to
     GitHub under *Settings → Deploy keys* and clone with the `git@github.com:` URL)
   - **Repository Path:** `/home/<cpanel-user>/apps/website` — deliberately **not**
     inside `public_html`. The CI4 app root must never be web-reachable; only `public/`
     is.
3. Over SSH/Terminal, in that directory:
   ```
   composer install --no-dev --optimize-autoloader
   ```
   `vendor/` is gitignored, so it is not in the clone. If the host has no composer and no
   SSH, this is the one thing you upload by hand — once.
4. Create `.env` on the server (see Part 3). It is gitignored, so it lives only here and
   survives every pull.
5. `chmod -R 775 writable/` (or 755 if the host runs PHP as your user).

From then on a deploy is: `git push` locally → cPanel Git Version Control → **Update from
Remote**, or just `git pull` in that directory over SSH.

### Every deploy — a pull alone is usually NOT enough

Git only moves files. Anything that lives in the database has its own step, and skipping it
produces errors that look like broken code but aren't. Run this after every pull:

```bash
cd ~/public_html/website
git pull

php spark migrate          # if any app/Database/Migrations/ file is new
php spark db:seed DocsPageSeeder   # if docs content changed (upserts by slug, safe to re-run)
composer install --no-dev -o       # only if composer.lock changed
php spark cache:clear
```

Not sure what's outstanding? `php spark migrate:status` lists every migration and whether it
has run.

**This has already bitten once.** The `password_resets` table was added on 2026-08-17; the
code deployed, the migration didn't, and the reset page died with
`Table 'bluerabb_br_website.password_resets' doesn't exist`. The code was fine — the table
simply wasn't there yet. If you see a "table doesn't exist" error after a deploy, run
`php spark migrate` before debugging anything else.

If `php spark` complains about the PHP version, cPanel's default `php` CLI is often older
than the 8.1+ this framework needs. Check `php -v`, and call the EasyApache binary directly
if so: `/opt/cpanel/ea-php82/root/usr/bin/php spark migrate`.

---

## Part 2 — the cutover

**2.1 Back up WordPress before anything else.**
cPanel → *Backup* → *Download a Full Account Backup* (or JetBackup, if the host uses it).
Also grab the WP database separately via phpMyAdmin export. Do not skip this — it's the
only rollback.

**2.2 Get the old site out of the docroot without deleting it.**
cPanel → *Terminal* (or SSH):
```
mv ~/public_html ~/wp-old
mkdir ~/public_html
```
Server-side move, instant, nothing transferred. `~/wp-old` is your rollback.

**2.3 Point the apex at the CI4 `public/` folder.**

*Preferred:* cPanel → *Domains* → `bluerabbit.io` → *Manage* → set **Document Root** to
`public_html/website/public`. In cPanel v92+/Jupiter this is editable for the primary
domain too, not just subdomains — check before assuming otherwise. If the host has
greyed it out, a support ticket gets it changed in WHM in under a minute. This is the
correct fix: nothing outside `public/` is ever web-reachable.

*Fallback, if the docroot is genuinely locked to `public_html`:* rewrite into the repo
instead. Create `public_html/.htaccess` (outside the repo, one-time manual file):
```apache
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/website/public/
RewriteRule ^(.*)$ website/public/$1 [L]
```
This works, but it leaves the whole repo reachable at `bluerabbit.io/website/...` —
`app/`, `writable/`, `.env`. The repo-root `.htaccess` (committed) closes that back off;
it refuses everything except `public/`. Both files are required for this layout — the
outer one routes, the inner one protects.

After wiring it up, confirm the boundary actually holds:
```
curl -I https://bluerabbit.io/website/.env         # expect 403
curl -I https://bluerabbit.io/website/app/         # expect 403
curl -I https://bluerabbit.io/website/writable/    # expect 403
```
If any of those return 200, stop and fix it before the site goes public — `.env` holds
the DB password and the Resend key.

**2.4 SSL, with Cloudflare in front.**

Cloudflare's SSL/TLS mode must be **Full (strict)**. On *Flexible*, Cloudflare talks to
the origin over plain HTTP, the origin sees no HTTPS, and the forced-HTTPS rule in
`public/.htaccess` redirects forever — the classic infinite redirect loop. (The rule
already checks `X-Forwarded-Proto`, which Cloudflare sets, so *Full* works; but *Flexible*
is still wrong and should be changed regardless.)

Full (strict) needs a valid cert on the origin. Either:
- cPanel → *SSL/TLS Status* → run **AutoSSL** for `bluerabbit.io` + `www`. Let's Encrypt
  validation can fail while the record is proxied — set the DNS record to *DNS only*
  (grey cloud) in Cloudflare, issue, then re-enable the proxy; or
- generate a **Cloudflare Origin Certificate** (15-year, Cloudflare-signed) and install it
  in cPanel → *SSL/TLS* → *Install an SSL Certificate*. Simpler when the domain stays
  proxied permanently.

Either way, wait until the origin actually serves HTTPS before testing.

**2.5 Update `.env`** — see Part 3. This is the only code-side change the move requires;
nothing in the app hardcodes the hostname.

**2.6 Verify** before touching the subdomain:
- `https://bluerabbit.io/` → 200, correct assets (a broken `baseURL` shows as unstyled HTML)
- `http://bluerabbit.io/` → 301 to https
- `https://www.bluerabbit.io/` → 301 to apex
- `/blog`, `/docs`, a single blog post, `/pricing`
- `/admin` login, and a waitlist signup end-to-end (Resend send)
- `writable/logs/` clean

**2.7 Only then, remove the subdomain.**
cPanel → *Domains* → delete `new.bluerabbit.io`. Deleting the subdomain does not touch the
files, since the docroot now belongs to the apex.

---

## Part 3 — production `.env`

Server-side only; never committed.

```ini
CI_ENVIRONMENT = production

app.baseURL = 'https://bluerabbit.io/'
app.forceGlobalSecureRequests = true

cookie.secure = true
cookie.domain = ''

database.default.hostname = localhost
database.default.database = <cpanel_db>
database.default.username = <cpanel_dbuser>
database.default.password = <password>
database.default.DBDriver = MySQLi
database.default.port = 3306

resend.apiKey = <key>

# Cloudflare Turnstile. BOTH must be set or the feature stays inert (no widget,
# no verification) — which is the safe default, not a silent failure.
# The site key is public and ships in page HTML. The secret is NOT and is a
# DIFFERENT value; grab it from Turnstile > your widget > Settings.
turnstile.siteKey   = 0x4AAAAAABg4oQP79arMKbIf
turnstile.secretKey = <the SECRET key — NOT the site key>
```

**Verify Turnstile after setting it**, because a wrong secret rejects every
submission on the site — waitlist, contact, login and register all at once:
```
curl -s -X POST https://challenges.cloudflare.com/turnstile/v0/siteverify \
     -d "secret=<your secret>" -d "response=test"
```
`invalid-input-response` means the secret is **good** (it reached Cloudflare and
only the dummy token was rejected). `invalid-input-secret` means the secret is
**wrong** — fix it before going further. A wrong secret also logs a CRITICAL line
naming the problem in `writable/logs/`.

Then, in the app root on the server:
```
php spark key:generate     # writes encryption.key
php spark migrate --all
php spark cache:clear
```

**Do not forget:** change the seeded admin password (`admin@bluerabbit.io` /
`ChangeMe123!`) the moment the site is reachable publicly. See BUILD-STATUS.md.

---

## Notes / gotchas

- `public/.htaccess` was fixed for this move: stock CI4 only canonicalises `www` when
  HTTPS is *off* and redirects back to `http://`, which is wrong for a live apex. It now
  forces HTTPS (bypassed on `localhost` so XAMPP dev is unaffected) and canonicalises
  `www` protocol-preservingly.
- Old WordPress URLs will 404 on the new site. If any had traffic or backlinks, add 301s
  to `public/.htaccess` — pull the URL list from the WP export before deleting `~/wp-old`.
- `CI_ENVIRONMENT = production` turns off the debug toolbar and detailed errors. If a page
  500s silently after cutover, read `writable/logs/`, don't flip back to development on a
  public site.
- Nothing here touches the main app's auth, session, or user table — this site keeps its
  own, per the hard rule in CLAUDE.md.
