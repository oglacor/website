<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Imports the legacy WordPress blog into `blog_posts`.
 *
 * Source: wp-import/wp-posts.json — generated from the old `789556_home_br` WP dump.
 * Post bodies were recovered from `sx_Gsl_postmeta._et_pb_divi_4_content` (the pre-Divi-5
 * shortcode content), because the Divi 5 alpha rebuild left `post_content` as layout JSON
 * with no prose in it.
 *
 * Idempotent: upserts by slug, so it is safe to re-run after editing the JSON. A re-run
 * overwrites these posts completely, including any edits made since in /admin/blog.
 *
 * Media paths: wp-posts.json was generated on localhost, so every image points at
 * /website/public/assets/uploads/... The seeder rewrites that prefix to wherever this
 * environment's base_url('assets/') actually lives (/assets/ on bluerabbit.io), so the same
 * JSON works everywhere. If app.baseURL changes later, re-run the seeder.
 *
 * Deliberately uses the query builder rather than BlogPostModel — the model has
 * $useTimestamps = true, which would stamp created_at/updated_at with the import date and
 * destroy the original publish dates.
 *
 *   php spark db:seed WpBlogImportSeeder
 */
class WpBlogImportSeeder extends Seeder
{
    public function run()
    {
        $path = ROOTPATH . 'wp-import/wp-posts.json';

        if (! is_file($path)) {
            throw new \RuntimeException("Import file not found: {$path}");
        }

        $rows = json_decode(file_get_contents($path), true);

        if (! is_array($rows)) {
            throw new \RuntimeException('Could not decode wp-posts.json: ' . json_last_error_msg());
        }

        // Body HTML is rendered as-is, so its image src needs this environment's real path.
        // featured_image follows Admin\BlogController's convention instead: relative to the
        // site root ('assets/uploads/...'), resolved through base_url() at render time.
        helper('url');
        $legacyPrefix = '/website/public/assets/';
        $assetsPath   = rtrim((string) parse_url(base_url('assets/'), PHP_URL_PATH), '/') . '/';

        $table    = $this->db->table('blog_posts');
        $inserted = 0;
        $updated  = 0;
        $skipped  = [];

        foreach ($rows as $row) {
            $slug = trim((string) ($row['slug'] ?? ''));

            if ($slug === '' || ! preg_match('/^[A-Za-z0-9_-]+$/', $slug)) {
                $skipped[] = $row['title'] ?? '(untitled)';
                continue;
            }

            $featured = $row['featured_image'];
            if ($featured !== null && str_starts_with($featured, $legacyPrefix)) {
                $featured = 'assets/' . substr($featured, strlen($legacyPrefix));
            }

            $data = [
                'title'           => $row['title'],
                'slug'            => $slug,
                'excerpt'         => $row['excerpt'] !== null ? mb_substr($row['excerpt'], 0, 500) : null,
                'body'            => str_replace($legacyPrefix, $assetsPath, $row['body']),
                'category'        => $row['category'],
                'featured_image'  => $featured,
                'status'          => $row['status'],
                'seo_title'       => $row['seo_title'],
                'seo_description' => $row['seo_description'] !== null ? mb_substr($row['seo_description'], 0, 500) : null,
                'published_at'    => $row['published_at'],
                'updated_at'      => $row['published_at'],
            ];

            $existing = $this->db->table('blog_posts')
                ->select('id')
                ->where('slug', $slug)
                ->get()
                ->getRowArray();

            if ($existing) {
                $table->where('id', $existing['id'])->update($data);
                $updated++;
            } else {
                // created_at only on insert, so a re-run never rewrites it
                $data['created_at'] = $row['published_at'];
                $table->insert($data);
                $inserted++;
            }
        }

        $total = $this->db->table('blog_posts')->countAllResults();

        echo "WpBlogImportSeeder: {$inserted} inserted, {$updated} updated. blog_posts now holds {$total} rows.\n";

        if ($skipped !== []) {
            echo 'Skipped (invalid slug): ' . implode(', ', $skipped) . "\n";
        }
    }
}
