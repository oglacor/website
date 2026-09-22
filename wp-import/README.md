# Legacy WordPress blog import

Everything needed to move the old bluerabbit.io blog into `blog_posts`.
Generated 2026-08-25 from `789556_home_br.sql`.

## Files here

| File | What it is |
|---|---|
| `789556_home_br.sql` | Full dump of the old WP database. **Keep this, but never commit it** (gitignored): it holds the old users table with password hashes, commenter emails and IPs, and `wp_options`. It's the only copy of the legacy content, so archive it somewhere private. |
| `wp-posts.json` | 61 published posts, cleaned and ready to import. Edit this if you want to tweak content before seeding. |
| `files.txt` | The 147 media files the posts actually reference, as `YYYY/MM/filename`. |
| `copy-uploads.ps1` | Copies just those 147 files out of the old uploads folder into `public/assets/uploads/` (Windows). |
| `copy-uploads.sh` | The same, for the Linux server. |

The seeder lives at `app/Database/Seeds/WpBlogImportSeeder.php`.

## Run it

**1. Copy the media** from the old site's `wp-content/uploads` folder.

On the server (the old site is still in `~/public_html`, or in `~/wp-old` once DEPLOY.md step
2.2 has moved it):

```bash
cd ~/public_html/website        # the app root, wherever it lives
bash wp-import/copy-uploads.sh ~/wp-old/wp-content/uploads
```

On Windows:

```powershell
cd C:\xampp\htdocs\website\wp-import
.\copy-uploads.ps1 -Source "PATH\TO\OLD\wp-content\uploads"
```

Both report `Copied: N of 147` and write any they couldn't find to `missing.txt`. The files
land in `public/assets/uploads/YYYY/MM/`, which git doesn't ignore, so a local copy will show
up as untracked files. Copy on each environment rather than committing them, unless you
decide otherwise.

**2. Import the posts:**

```
php spark db:seed WpBlogImportSeeder
```

Expected output: `61 inserted, 0 updated. blog_posts now holds 64 rows.`
(64 = 61 imported + the 3 original `BlogPostSeeder` samples.)

**3. Check:** browse `/blog` — newest post should be *The Game Master Framework - Reloaded!*
dated 11 July 2022, oldest *The 3 ingredients for a gamified classroom*, 4 November 2016.

The seeder upserts by slug, so it is safe to re-run after editing `wp-posts.json`. A re-run
overwrites those 61 posts completely, **including any edits made since in `/admin/blog`**, so
once you start editing imported posts in the admin, stop re-running it.

## Where the content came from

The Divi 5 alpha rebuild left `post_content` as pure layout JSON — 51 of 65 posts had no
prose in them at all. The real article text was recovered from
`sx_Gsl_postmeta._et_pb_divi_4_content` (the pre-Divi-5 shortcode content), with
`post_content` used directly for the 14 classic-editor posts and revisions filling three
more. Divi shortcode wrappers were stripped, `[caption]`/`[embed]` converted to HTML.

Recovery: 56 posts over 800 characters, 3 between 300–800, 2 genuinely short originals
("A sweet Milestone", "New Logo!"). No post is empty.

## Image paths

`wp-posts.json` stores every image as `/website/public/assets/uploads/YYYY/MM/file.png`, the
localhost path it was generated on. **The seeder rewrites that prefix at run time** to wherever
this environment's `base_url('assets/')` lives:

- Body images become `/website/public/assets/...` on localhost and `/assets/...` on bluerabbit.io.
- `featured_image` becomes `assets/uploads/...`, relative, which is the same convention
  `/admin/blog` uses for its own uploads.

So the same JSON works everywhere, with no manual SQL. If `app.baseURL` changes later (a
vhost, a new domain), re-run the seeder, keeping in mind the admin-edits caveat above.

Two images were deliberately left pointing at their original external hosts, because they
are third-party and not yours to rehost: one on `gamified.uk` and one Medium CDN avatar.

## Before deleting the old site and database

Everything text-based is already extracted — `wp-posts.json` plus the SQL dump cover it.
The one thing **not** yet captured is the actual image files. Don't delete the old
`wp-content/uploads` folder until `copy-uploads.ps1` reports `Missing: 0`.

Also worth knowing what was left behind on purpose: the 2 drafts and 2 pending posts, all
50 WP pages, comments, and the old users table. If you ever want any of those, they are in
`789556_home_br.sql` — which is why that file should be archived somewhere safe rather
than deleted along with the database.
