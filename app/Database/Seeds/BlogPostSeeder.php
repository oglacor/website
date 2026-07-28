<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $posts = [
            [
                'title'        => 'Why Dual-Metric Rewards Beat a Single Points System',
                'slug'         => 'dual-metric-rewards',
                'excerpt'      => 'How XP and BLOO play different psychological roles - and why that separation matters.',
                'body'         => "<p>Most gamified platforms make the same mistake: one currency, doing two jobs. Progression and spending pull in different directions, and when you conflate them, both suffer.</p><p>BLUERABBIT splits the two on purpose. XP is your progression signal - it only goes up, and it's what levels you. BLOO is spendable currency - it goes up and down, and it's what you trade for items, unlocks, and shortcuts. Keeping them separate means players always have a clean answer to \"how am I doing\" (XP) and a separate, guilt-free answer to \"what can I do right now\" (BLOO).</p>",
                'category'     => 'Design',
                'status'       => 'published',
                'published_at' => $now,
            ],
            [
                'title'        => 'Inside the Journey Map Builder',
                'slug'         => 'inside-the-journey-map-builder',
                'excerpt'      => 'A look at how milestones resolve status in real time as players progress.',
                'body'         => "<p>Every adventure in BLUERABBIT is a graph of milestones, and every player sees a different resolved view of that graph depending on their level, completions, and unlocked items.</p><p>Under the hood, one function - <code>getPlayerProgress()</code> - walks every quest for the adventure and resolves it to a single status: finished, available, locked, blocked, future, or expired. That's the function driving the map you actually explore.</p>",
                'category'     => 'Product',
                'status'       => 'published',
                'published_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'title'        => 'Migrating a WordPress App to CodeIgniter 4',
                'slug'         => 'migrating-wordpress-to-codeigniter-4',
                'excerpt'      => "What we learned rebuilding BLUERABBIT's core on a cleaner, portable stack.",
                'body'         => "<p>The original BLUERABBIT app is a WordPress theme - pages are WordPress pages, and every action runs through <code>wp_ajax_*</code> hooks. It works, but it ties the whole platform to WordPress internals it never actually needed.</p><p>The rebuild maps each of those pieces onto CodeIgniter 4 equivalents: singleton classes become Models and Services, AJAX actions become Controllers with JSON responses, and <code>\$wpdb</code> queries become CI4's query builder. The result is a portable core - the same one this new site is built on.</p>",
                'category'     => 'Engineering',
                'status'       => 'published',
                'published_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
        ];

        foreach ($posts as $post) {
            $post['created_at'] = $now;
            $post['updated_at'] = $now;
            $this->db->table('blog_posts')->insert($post);
        }
    }
}
