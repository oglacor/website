<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DocsPageSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $pages = [
            [
                'title'      => 'Using the Platform',
                'slug'       => 'using-the-platform',
                'section'    => 'user',
                'sort_order' => 1,
                'body'       => "As a player, you enroll into an Adventure and progress through its Journey Map — a visual layout of quests grouped into chapters called Tabis. Each quest unlocks based on your level, prerequisite completions, items you hold, or a start date.\n\nThree currencies track your progress: XP (experience, drives your Level), BLOO (spendable currency for the Item Shop), and EP (Energy Points, needed for Random Encounters and Objectives). Complete quests, earn achievements, and join a Guild to compete on the leaderboard alongside your team.",
            ],
            [
                'title'      => 'Onboarding & Billing',
                'slug'       => 'onboarding-and-billing',
                'section'    => 'setup',
                'sort_order' => 1,
                'body'       => "Setting up an organization starts with creating your account and choosing a plan — Basic is free (200 players, 3 Adventures), Pro unlocks unlimited players and Adventures for $8/mo ($80/yr) with a 30-day free trial.\n\nBilling is handled entirely inside the BLUERABBIT app via Stripe — this marketing site never processes payment. Once you're in, build your first Adventure from scratch or start from a template, then bulk-enroll your team and assign roles (player, GM, admin).",
            ],
            [
                'title'      => 'Product & Platform Overview',
                'slug'       => 'product-platform-overview',
                'section'    => 'user',
                'sort_order' => 2,
                'body'       => "BLUERABBIT wraps your learning content in a real game engine: a Journey Map of quests, a three-currency reward system (XP/BLOO/EP), achievements, and Guilds. Quests come in five types — Quest, Challenge, Survey, Mission, and Social — each built from reusable Steps like dialogue, open text, puzzles, and SCORM packages.\n\nSee the /product page for the full breakdown, or /solutions for how corporate L&D, onboarding, and bootcamp teams each use the platform differently.",
            ],
            [
                'title'      => 'Architecture Overview',
                'slug'       => 'architecture-overview',
                'section'    => 'developer',
                'sort_order' => 1,
                'body'       => "This site is a standalone CodeIgniter 4 app — its own database, its own session-based auth (users table + AuthFilter), completely separate from the main BLUERABBIT app's auth. Views use extend()/section() templating against app/Views/layouts/main.php, with a nested admin layout (layouts/admin.php) for the gated /admin/* screens.\n\nContent that changes often — blog posts, docs pages — lives in the database and is managed through /admin/blog and /admin/docs rather than hardcoded views, so non-developers can update it without a deploy.",
            ],
            [
                'title'      => 'Routes & API Reference',
                'slug'       => 'routes-and-api-reference',
                'section'    => 'developer',
                'sort_order' => 2,
                'body'       => "All routes are declared flat in app/Config/Routes.php. Public: /, /product, /solutions, /pricing, /contact, /blog, /docs. Auth: /login, /get-started, /logout (Auth controller). Gated groups use the 'auth' filter (any logged-in user, e.g. /account) or 'auth:admin' (admin role required, e.g. /admin/*, /docs/developer).\n\nThere's no public JSON API yet — every admin action (blog CRUD, docs CRUD, waitlist campaigns, settings) is a normal server-rendered form POST, consistent with the no-JS-framework approach for the rest of the site.",
            ],
        ];

        foreach ($pages as $page) {
            $exists = $this->db->table('docs_pages')->where('slug', $page['slug'])->get()->getRow();
            if ($exists) {
                continue;
            }

            $page['status']     = 'published';
            $page['created_at'] = $now;
            $page['updated_at'] = $now;
            $this->db->table('docs_pages')->insert($page);
        }
    }
}
