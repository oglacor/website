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
Remote**, or just `git pull` in that directory over SSH. Add `composer install` only when
`composer.lock` changed, and re-run migrations when a migration was added.

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
cPanel → *Domains* → `bluerabbit.io` → set the document root to:
```
/home/<cpanel-user>/apps/website/public
```
If cPanel won't let you edit the *primary* domain's document root (some builds only allow
it for addon/alias domains), the fallback is still not an upload — symlink or move
server-side instead:
```
rmdir ~/public_html && ln -s ~/apps/website/public ~/public_html
```
Some hosts disable symlink following (`Options -FollowSymLinks`); if that 403s, move the
clone so that `public/` *is* `public_html` and keep the app root one level up.

**2.4 Reissue SSL for the apex.**
cPanel → *SSL/TLS Status* → tick `bluerabbit.io` and `www.bluerabbit.io` → *Run AutoSSL*.
Wait for both to go green before testing — the forced-HTTPS rule in `public/.htaccess`
will otherwise redirect into a cert error.

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
```

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
