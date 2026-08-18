<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Upserts by slug (update if it exists, insert if it doesn't) so re-running
 * this after an edit actually refreshes content instead of silently
 * skipping — unlike BlogPostSeeder, which is insert-only.
 */
class DocsPageSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Superseded by the more detailed breakdown below — remove if present
        // from an earlier seed run.
        $this->db->table('docs_pages')->whereIn('slug', [
            'using-the-platform', 'onboarding-and-billing',
            // Retired 2026-08-17 — Quests became Milestones, and the Blocker /
            // Survey / Social content types no longer exist in the product.
            // These slugs are superseded by the renamed pages below; deleting
            // them here stops stale copies lingering after a re-seed.
            'completing-quests-and-steps',
            'designing-quests-types-rewards-and-unlocks',
            'random-encounters-and-blockers',
            'challenges-and-surveys-concept',
            'how-to-build-a-challenge-or-survey',
        ])->delete();

        $pages = [
            // ---------------------------------------------------------
            // User docs — end-user how-to
            // ---------------------------------------------------------
            [
                'title'      => 'Product & Platform Overview',
                'slug'       => 'product-platform-overview',
                'section'    => 'user',
                'sort_order' => 0,
                'body'       => <<<'HTML'
<p>BLUERABBIT wraps your learning content in a real game engine: a Journey Map of milestones, a three-currency reward system (XP/BLOO/EP), achievements, and Guilds. You place two things on that map — <strong>Milestones</strong> (content that gives players knowledge) and <strong>Challenges</strong> (quizzes that test it) — and build them out of 23 reusable Step types: dialogue, video, open text, puzzles, uploads, SCORM packages and more.</p>
<p>See the <a href="/product">Product</a> page for the full breakdown, or <a href="/solutions">Solutions</a> for how corporate L&amp;D, onboarding, and bootcamp teams each use the platform differently.</p>
HTML,
            ],
            [
                'title'      => 'Getting Started',
                'slug'       => 'getting-started',
                'section'    => 'user',
                'sort_order' => 1,
                'body'       => <<<'HTML'
<p>Whether you were invited by your organization or you're setting one up yourself, here's what happens the first time you log into BLUERABBIT.</p>

<h2>1. Create Your Account</h2>
<p>Head to <strong>Get Started</strong> and sign up with your name, email, and a password. If your organization already exists, ask an admin to enroll you — you'll get an invite email instead of needing to create an org from scratch.</p>
<p>Starting your own organization? You'll land on the <strong>Basic</strong> plan automatically — 200 players and 3 Adventures, free, no credit card required. Upgrade to Pro whenever you need more room.</p>

<h2>2. Join an Adventure</h2>
<p>An <strong>Adventure</strong> is a single learning journey — an onboarding program, a training course, a live bootcamp. Once you're enrolled, you'll see it on your dashboard along with your assigned role: <code>player</code>, <code>gm</code> (game master/facilitator), <code>admin</code>, or <code>npc</code>.</p>

<h2>3. Your First Look at the Journey Map</h2>
<p>Open an Adventure and you'll land on the <strong>Journey Map</strong> — a visual layout of every milestone in the program. Nodes are locked, available, or finished depending on what you've already done. A HUD widget in the corner tracks your XP, BLOO, and EP as you go.</p>
<p>Not sure what those three mean yet? Start with <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a> — it's the fastest way to understand how progress works here.</p>

<h2>Where to Go Next</h2>
<ul>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — reading node states and Tabis</li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — what you'll actually be doing</li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a> — the social/competitive layer</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Understanding XP, BLOO & EP',
                'slug'       => 'xp-bloo-ep-explained',
                'section'    => 'user',
                'sort_order' => 2,
                'body'       => <<<'HTML'
<p>BLUERABBIT tracks your progress with three separate currencies. They look similar at a glance but do very different jobs — organizations can relabel all three to fit their own theme, but the mechanics underneath stay the same.</p>

<h2>XP — Experience Points</h2>
<p>XP only ever goes up. You earn it from completing milestones, steps, and achievements, and it drives your <strong>Level</strong> against a threshold table your organization sets. Leveling up can unlock new content on the Journey Map and can trigger achievements automatically — it's your clean, at-a-glance answer to "how am I doing?"</p>

<h2>BLOO — Your Spendable Currency</h2>
<p>BLOO is the opposite of XP: it goes up and down. You earn it as a milestone or achievement reward, then spend it in the <strong>Item Shop</strong> on consumables, keys, and rewards — or use it to unlock a milestone early instead of waiting on a prerequisite. Think of it as your answer to "what can I do right now?"</p>

<h2>EP — Energy Points</h2>
<p>EP gates <strong>Random Encounters</strong> (pop-up quiz or challenge events) and <strong>Objectives</strong>. Everyone starts with 100, and the cap scales up with your level. If you run out, you'll see a prompt to recharge before you can continue — usually via the lightning-bolt icon in the top corner of the map.</p>

<h2>How They Work Together</h2>
<p>A typical loop looks like: complete a milestone → earn XP (progress) and BLOO (currency) → spend some BLOO in the shop or save it to unlock something early → keep an eye on EP so you don't get locked out of an Encounter mid-session. None of the three substitutes for another — that separation is deliberate, so "am I progressing" and "what can I afford" never get muddled into one number.</p>
HTML,
            ],
            [
                'title'      => 'The Journey Map',
                'slug'       => 'journey-map-guide',
                'section'    => 'user',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>The Journey Map is the visual heart of every Adventure — a zoomable, pannable canvas where every milestone shows up as a milestone node.</p>

<h2>Reading the Map</h2>
<p>Pan and zoom to explore. Each node represents one milestone, positioned deliberately by whoever built the Adventure — the layout itself is often part of the story (a path, a skill tree, a level progression).</p>

<h2>Tabis — Map Chapters</h2>
<p>Nodes are grouped under <strong>Tabis</strong> — decorative chapter layers that can be locked behind their own prerequisites, independent of individual milestone unlock rules. A Tabi might represent "Week 1," "Module 3," or a themed act in the story. When a Tabi is locked, everything inside it is hidden or greyed out until you meet its requirement.</p>

<h2>Node States</h2>
<p>Every milestone resolves to exactly one status at any given moment:</p>
<ul>
  <li><strong>Finished</strong> — you've completed it.</li>
  <li><strong>Available</strong> — unlocked and ready to start.</li>
  <li><strong>Locked</strong> — you haven't met the requirement yet (level, prerequisite milestone, item, or achievement).</li>
  <li><strong>Blocked</strong> — locked by something outside the normal unlock chain (often a facilitator gate).</li>
  <li><strong>Future</strong> — visible, but not open yet (usually date-gated).</li>
  <li><strong>Expired</strong> — the window to complete it has closed.</li>
</ul>

<h2>Map Widgets</h2>
<p>Two live widgets are common on the map: a <strong>player status HUD</strong> showing your current XP/BLOO/EP, and a <strong>leaderboard</strong> ranking players or guilds in real time. Purely decorative "journey assets" are sometimes scattered around too, just to sell the theme.</p>
HTML,
            ],
            [
                'title'      => 'Completing Milestones & Steps',
                'slug'       => 'completing-milestones-and-steps',
                'section'    => 'user',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<p>A <strong>Milestone</strong> is the core content unit in BLUERABBIT — one node on the Journey Map. Each Milestone is built from smaller pieces called <strong>Steps</strong>, which you play through in order.</p>

<h2>Milestones and Challenges</h2>
<ul>
  <li><strong>Milestone</strong> — content that gives you something: a briefing, a video, a hands-on exercise, a written submission. Most of what you play is Milestones.</li>
  <li><strong>Challenge</strong> — a quiz that tests what you already know. It draws from a question bank, shows a subset per attempt, and needs a set number correct to pass.</li>
</ul>

<h2>Steps Are Where the Content Lives</h2>
<p>A Milestone unlocks as a whole, but you play it one Step at a time. Some Steps just deliver something and let you move on; others need a correct answer, or a submission, before the Next button unlocks. Steps can carry their own XP/BLOO/EP/item/achievement rewards on top of whatever the Milestone itself pays.</p>
<p>There are over twenty Step types, grouped into four families you'll notice as you play:</p>
<ul>
  <li><strong>Deliver</strong> — dialogue with a character, video, audio, or picking up an item. Read, watch, listen, continue.</li>
  <li><strong>Validate</strong> — multiple choice, a keyphrase, a cryptex lock, a jigsaw puzzle, an item you have to be carrying, a SCORM package, or an interactive case study. You have to get it right to advance.</li>
  <li><strong>Collect</strong> — open text, a rating scale, a poll, a choice question, or an image/video upload. There's no wrong answer; you just have to respond.</li>
  <li><strong>Flow &amp; special</strong> — branch choices that permanently set your path, plus system messages, win/fail screens, and the nickname/avatar setup steps.</li>
</ul>
<p>The full list, with what each one does, is in <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a>.</p>

<h2>Optional Steps</h2>
<p>Not every Step is required. Optional ones can be skipped without holding up your progress — they're usually bonus context or a deeper dive.</p>

<h2>AI-Assisted Feedback</h2>
<p>On Open Text steps, if your organization has enabled it, your answer gets checked against the Game Master's criteria and you get instant feedback to revise against before moving on — useful for practising a skill rather than just being graded once.</p>

<h2>Quick-Complete via QR Code</h2>
<p>Some Milestones carry a scannable QR code that completes them directly, bypassing the normal prerequisite chain entirely. You'll typically see this at in-person events or bootcamp sessions — scan, done, move to the next station.</p>
HTML,
            ],
            [
                'title'      => 'Achievements & Guilds',
                'slug'       => 'achievements-and-guilds',
                'section'    => 'user',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<h2>Earning Achievements</h2>
<p>Achievements come in three types — <strong>Achievement</strong> (a one-off milestone), <strong>Path</strong> (part of a themed series), and <strong>Rank</strong> (a status tier, shown with extra decorative framing on your profile). They're displayed as hexagonal badges and can carry their own XP/BLOO rewards. Most are awarded automatically when you hit a trigger — leveling up, finishing a milestone chain — though a facilitator can also grant one manually.</p>

<h2>Joining a Guild</h2>
<p>Guilds are team structures inside an Adventure — think of them as squads or cohorts competing (or collaborating) together. If your organization uses guilds, you'll be assigned one on enrollment or given the option to pick one.</p>

<h2>Guild Level & Leaderboard</h2>
<p>Each Guild has its own XP and BLOO pools, separate from any individual member's — everyone's contributions add up to a computed <strong>Guild Level</strong>. Guilds also show up on the leaderboard with a live rank position, so progress is visible at both the individual and team level.</p>
HTML,
            ],
            [
                'title'      => 'Item Shop & Backpack',
                'slug'       => 'item-shop-and-backpack',
                'section'    => 'user',
                'sort_order' => 6,
                'body'       => <<<'HTML'
<h2>Item Types</h2>
<p>Items in BLUERABBIT fall into three categories:</p>
<ul>
  <li><strong>Consumable</strong> — used once, then gone (a hint, an extra attempt, an EP recharge).</li>
  <li><strong>Key</strong> — unlocks something specific, like a gated milestone.</li>
  <li><strong>Reward</strong> — a keepsake with no functional unlock, just for collecting.</li>
</ul>

<h2>Buying From the Shop</h2>
<p>Items are priced in BLOO and can be level-gated — some won't even show up in the shop until you've hit a certain Level. Spend the BLOO you've earned from milestones and achievements here, or hold onto it if you're saving for something specific.</p>

<h2>Your Backpack</h2>
<p>Anything you buy or find through a milestone lands in your Backpack. From there you can use a Key item on the milestone it unlocks, or a Consumable whenever you need it — nothing gets used automatically without your say-so.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // Setup docs — onboarding & billing for org admins
            // ---------------------------------------------------------
            [
                'title'      => 'Setting Up Your Organization',
                'slug'       => 'setting-up-your-organization',
                'section'    => 'setup',
                'sort_order' => 1,
                'body'       => <<<'HTML'
<p>This is the admin-side setup flow — for enrolling as a player into an org that already exists, see <a href="/docs/getting-started">Getting Started</a> instead.</p>

<h2>1. Choose a Plan</h2>
<p><strong>Basic</strong> is free — 200 players, 3 Adventures, 50MB of storage — and needs no credit card. <strong>Pro</strong> ($8/mo or $80/yr) removes the player and Adventure caps and comes with a 30-day free trial. Need more than that, or a dedicated onboarding process? <strong>Enterprise</strong> is sales-assisted — see <a href="/contact">Contact</a>. Full breakdown on the <a href="/pricing">Pricing</a> page.</p>

<h2>2. Create Your Organization</h2>
<p>After signing up, you'll be walked through naming your organization and creating your first Adventure — you can start from a blank canvas or a template. Don't worry about getting it perfect on the first pass; everything here is editable later.</p>

<h2>3. Invite Collaborators</h2>
<p>Add other admins or GMs (game masters/facilitators) so you're not running everything solo. Roles determine what someone can edit versus just view — see <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a> for the full breakdown.</p>

<h2>Where to Go Next</h2>
<ul>
  <li><a href="/docs/building-your-first-adventure">Building Your First Adventure</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Building Your First Adventure',
                'slug'       => 'building-your-first-adventure',
                'section'    => 'setup',
                'sort_order' => 2,
                'body'       => <<<'HTML'
<h2>Start From Scratch or a Template</h2>
<p>A blank Adventure gives you a clean Journey Map to design from zero. Starting from a template pre-populates milestones, steps, and rewards you can edit rather than build from nothing — useful if you're repeating a similar program (see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a> for how this really pays off at scale).</p>

<h2>Add Milestones to the Journey Map</h2>
<p>Place nodes on the map and decide what each one is: a <strong>Milestone</strong> if you're giving players knowledge, or a <strong>Challenge</strong> if you're testing it (see <a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> for what each means from the player's side). Group related nodes under a Tabi if you want a chaptered structure with its own unlock gate.</p>

<h2>Configure Step Types</h2>
<p>Inside each milestone, build out the Steps players will actually work through — dialogue, open text, multiple-choice, puzzles, SCORM packages, and more. Steps run in order, and each can carry its own reward independent of the milestone's overall reward.</p>

<h2>Set Rewards & Unlock Rules</h2>
<p>Decide what a milestone pays out in XP, BLOO, and (optionally) items or achievements, then set what has to be true for it to unlock — a minimum level, a prerequisite milestone, an item in the player's Backpack, or a start date.</p>

<h2>Publish the Adventure</h2>
<p>Once you're happy with the map, publish it and move on to <a href="/docs/enrolling-players-and-roles">enrolling players</a>.</p>
HTML,
            ],
            [
                'title'      => 'Enrolling Players & Assigning Roles',
                'slug'       => 'enrolling-players-and-roles',
                'section'    => 'setup',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<h2>The Four Roles</h2>
<ul>
  <li><strong>Player</strong> — the default. Progresses through the Journey Map like any participant.</li>
  <li><strong>GM (Game Master)</strong> — a facilitator. Can grant achievements manually, unblock milestones, and monitor progress without full admin access.</li>
  <li><strong>Admin</strong> — full edit access to the Adventure: milestones, steps, rewards, settings.</li>
  <li><strong>NPC</strong> — a non-player role, used for characters or accounts that appear in the story but don't progress themselves.</li>
</ul>

<h2>Bulk-Enrolling Players</h2>
<p>Rather than adding people one at a time, bulk-enroll a list of players into an Adventure — ideal for a new-hire cohort or a training class starting all at once. Assign a default role and, if you're using them, a starting Guild for the whole batch.</p>

<h2>Managing Access</h2>
<p>Roles can be changed after enrollment — promote a player to GM if they end up helping facilitate, or adjust access as your team changes. Removing someone from an Adventure doesn't delete their historical progress.</p>
HTML,
            ],
            [
                'title'      => 'Adventure Templates & Scaling Cohorts',
                'slug'       => 'adventure-templates-and-cohorts',
                'section'    => 'setup',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<h2>What's a Template Adventure?</h2>
<p>Any Adventure can be marked as a template. A template isn't meant to be run directly — it exists so you can spin off <strong>child Adventures</strong> that inherit its milestones, steps, and rewards, ready to run for a specific group.</p>

<h2>Spinning Off a Child Adventure</h2>
<p>Create a child from a template and you get an independent copy of the Journey Map, editable without touching the original — update the template later and future children can pick up those changes, while already-running cohorts stay as they were.</p>

<h2>When to Use This</h2>
<p>This is built for anything that repeats: a new-hire onboarding class every month, a recurring bootcamp cohort, a training program run separately per department. Build the content once, then launch a fresh, isolated instance every time you need one — instead of rebuilding or copy-pasting an Adventure by hand.</p>
HTML,
            ],
            [
                'title'      => 'Billing & Plans',
                'slug'       => 'billing-and-plans',
                'section'    => 'setup',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<p>Billing lives entirely inside the app — this marketing site never processes payment, it only points you toward account creation.</p>

<h2>Plans at a Glance</h2>
<ul>
  <li><strong>Basic</strong> — free. 200 players, 3 Adventures, 50MB storage.</li>
  <li><strong>Pro</strong> — $8/mo or $80/yr (two months free on annual). Unlimited players and Adventures.</li>
  <li><strong>Enterprise</strong> — custom limits, dedicated onboarding, sales-assisted. <a href="/contact">Contact us</a> to talk through it.</li>
</ul>
<p>See the full comparison on the <a href="/pricing">Pricing</a> page.</p>

<h2>Starting Your Pro Trial</h2>
<p>First-time Pro subscribers get a 30-day free trial — no charge until it ends, and you can cancel any time during the trial from inside the app without being billed.</p>

<h2>Managing Your Subscription</h2>
<p>Upgrades, downgrades, and invoices are all handled from your account's billing screen inside the app. Changing plans doesn't affect your existing Adventures or player data either way.</p>

<h2>Billing History</h2>
<p>The Billing tab of My Account now carries a full <strong>Billing History</strong> table — every payment with its date, amount, and status, plus links to view the invoice or download it as a PDF. Those go to Stripe's own hosted invoice pages, so they're the real documents your finance team needs, not a summary we've re-typed.</p>
<p>This sits separately from the in-game Transactions tab further down the same screen. One is real money; the other is BLOO and item purchases inside an Adventure. They're deliberately not merged.</p>
<p>If your account has been billing for a while, note that history is recorded from the point this feature went live — payments from before then may not be listed. <a href="/contact">Ask us</a> if you need an older invoice and we'll retrieve it.</p>

<h2>When Something Goes Wrong With a Payment</h2>
<p>If a card is declined, <strong>we email you</strong> rather than leaving you to discover it. Your billing screen also shows a clear past-due banner while the account is in that state, so the problem is visible the moment you log in.</p>
<p>You'll also get a heads-up email roughly three days before a free trial converts into its first real charge — no silent conversions.</p>
<p>Refunds issued by our team appear in your Billing History automatically.</p>

<h2>Questions About Billing</h2>
<p>Something not adding up, or need an invoice for procurement? <a href="/contact">Reach out</a> and we'll sort it out directly.</p>
HTML,
            ],
            [
                'title'      => 'Reading the Stats Dashboard',
                'slug'       => 'stats-dashboard-guide',
                'section'    => 'setup',
                'sort_order' => 6,
                'body'       => <<<'HTML'
<h2>Funnel View</h2>
<p>See how players move through your Adventure step by step — where most people start, and exactly which milestone tends to lose them. This is usually the fastest way to spot a confusing or too-difficult step.</p>

<h2>Engagement Metrics</h2>
<p>Track login frequency, average session length, and active-player counts over time. Useful for telling the difference between "everyone finished it once and left" and "people keep coming back."</p>

<h2>Completion Analytics</h2>
<p>Per-milestone and overall completion rates, broken down by cohort or guild if you're using them — helpful for comparing how different groups are progressing through the same content.</p>

<h2>Using This to Improve Your Adventure</h2>
<p>The dashboard is most useful as a feedback loop, not just a report: find the milestone with the biggest drop-off, revisit its difficulty or clarity, republish, and watch the funnel next time. Small adjustments to unlock requirements or step difficulty often move the numbers more than a full content rewrite.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // Setup docs, continued — the Game Master manual. Deep dives
            // on every feature a GM reaches for when actually building an
            // Adventure, picking up where "Building Your First Adventure"
            // leaves off. Written 2026-07-28 at Bernardo's request: full
            // documentation from the GM's chair, not the dev's.
            // ---------------------------------------------------------
            [
                'title'      => 'Designing Milestones — Rewards & Unlock Rules',
                'slug'       => 'designing-milestones-rewards-and-unlocks',
                'section'    => 'setup',
                'sort_order' => 7,
                'body'       => <<<'HTML'
<p>A <strong>Milestone</strong> is the unit of design in BLUERABBIT — the thing you're actually placing on the Journey Map. Before you touch a single Step, decide what you're building and what it takes to unlock and complete it.</p>
<p><em>Examples in this guide are drawn from a single running example — see <a href="/docs/meet-launch-week-example-adventure">Meet "Launch Week"</a> for the adventure referenced throughout.</em></p>

<h2>First Decision: Give Knowledge, or Test It</h2>
<p>There are two things you can put on the map, and the choice is that simple:</p>
<ul>
  <li><strong>Milestone</strong> — you're <em>providing</em> knowledge. Content, exercises, submissions, media, hands-on activities. You build it out of Steps, and there are over twenty Step types to pick from, so a Milestone can be almost anything.</li>
  <li><strong>Challenge</strong> — you're <em>testing</em> knowledge. A question bank, a subset shown per attempt, a pass threshold, and a limited number of retries. See <a href="/docs/challenges-concept">Challenges — Concept</a>.</li>
</ul>
<p>If you're not sure, ask whether a player could plausibly fail. If yes, it's a Challenge. If they just need to go through it, it's a Milestone.</p>

<h2>The Basics</h2>
<p>Every Milestone gets a name, a colour, an icon, and a main image — the badge that represents it on the map. You can also mark a Milestone as <strong>autoload</strong>, which pulls the player straight into it when they arrive in the Adventure instead of waiting for them to find and click it.</p>

<h2>Setting the Unlock Requirements</h2>
<p>A Milestone can require any combination of: a minimum player level, one or more prerequisite Milestones already completed, possession of a specific item, an earned achievement, and a window of availability (a start date and/or a deadline). An empty requirement set means "available from day one" — nothing is locked unless you lock it.</p>

<h2>Rewards: XP, BLOO, and Beyond</h2>
<p>Set what a Milestone pays out on completion — XP, BLOO, and optionally an item or an achievement. A Milestone can hand out all of these at once, and individual Steps inside it can pay out on their own too. Keep the XP curve roughly consistent across Milestones of similar effort, or levelling will feel arbitrary to players comparing notes.</p>

<h2>Deadlines, Start Dates & Paying to Skip the Wait</h2>
<p>A Milestone can be date-gated on both ends — not visible until a start date, expired after a deadline. You can also set a BLOO cost that lets a player buy their way past a deadline or unlock cost early, if you want urgency to be a soft rather than hard wall.</p>

<h2>Paths</h2>
<p>If your Adventure uses paths or ranks, a Milestone can be assigned to <strong>all paths</strong> or restricted to a single one, so players on the Engineering track never see the Sales content. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</p>

<h2>Grading Modes</h2>
<p>Milestones can grade as simple completion, a percentage, or letter grades, depending on what fits your program. Challenges add their own layer on top: how many questions get shown per attempt, how many correct answers count as a win, a time limit, and whether extra attempts beyond the free allotment cost BLOO.</p>

<h2>Status & Reuse</h2>
<p>A Milestone is <strong>published</strong>, <strong>draft</strong>, <strong>locked</strong>, or <strong>trashed</strong> — draft while you're building, locked when you want it visible but not yet playable. Any Milestone can also be duplicated, either into the same Adventure or into a different one, so a well-built Milestone becomes a template you reuse rather than rebuild.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a> — the actual authoring flow, start to finish.</p>
HTML,
            ],
            [
                'title'      => 'How to Build a Milestone, Step by Step',
                'slug'       => 'how-to-build-a-milestone-step-by-step',
                'section'    => 'setup',
                'sort_order' => 8,
                'body'       => <<<'HTML'
<p>The end-to-end flow for getting one piece of content from an idea to a node players can actually reach on the map.</p>

<h2>1. Decide What You're Making</h2>
<p>Provide knowledge, or test it. Providing it means a <strong>Milestone</strong>; testing it means a <strong>Challenge</strong>. Everything below is the Milestone route — see <a href="/docs/how-to-build-a-challenge">How to Build a Challenge</a> for the other one.</p>

<h2>2. Create the Milestone and Save It</h2>
<p>Give it a name, a colour, an icon, and a main image. Save it before going any further — the Steps section only opens once the Milestone exists, because every Step is attached to a Milestone that already has an ID.</p>

<h2>3. Build the Steps the Player Will Follow</h2>
<p>This is the real work, and where the design happens. A Milestone is a sequence of Steps, and each Step has a <strong>type</strong> that decides what the player does at that moment — read a character's dialogue, watch a video, answer a question correctly, upload something, pick a path. There are over twenty types across four groups, and picking the right one is most of what makes a Milestone good rather than flat.</p>
<ol>
  <li><strong>Add a Step.</strong> It appears in the list with a default type.</li>
  <li><strong>Choose the type.</strong> The editor changes to show only the settings that type actually needs — a Multiple Choice step asks for options and correct answers, a Video step asks for a file, a Cryptex step asks for accepted answers and a wheel count.</li>
  <li><strong>Fill it in</strong> — including the admin-only Label (so you can find it later), whether the Step is required, an optional background image, and any XP/BLOO/EP/item/achievement it should pay out on its own.</li>
  <li><strong>Update the Step</strong>, then add the next one. Steps can be dragged to reorder at any time.</li>
</ol>
<p>Full detail on every type is in <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a>, and there's a one-screen lookup in the <a href="/docs/step-type-quick-reference">Step Type Quick Reference</a>.</p>
<p><em>A note on pacing:</em> alternate the groups. A run of four Deliver steps reads like a slide deck; a run of four Validate steps reads like an exam. Deliver, then ask; deliver, then ask.</p>

<h2>4. Set the Requirements and Rewards</h2>
<p>Now that the content exists, decide what it takes to reach it (level, prerequisites, item, achievement, dates) and what it pays out. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a>.</p>

<h2>5. Update the Milestone</h2>
<p>Save. At this point the Milestone is complete as a piece of content — it just isn't anywhere useful yet.</p>

<h2>6. Put It on the Map</h2>
<p>Two ways, and most Adventures use both:</p>
<ul>
  <li><strong>Group it into a Tabi</strong> — a Tabi is a visual region on the Journey Map that holds a set of Milestones. Tabis are how you chunk an Adventure into "Week One", "Fundamentals", "Advanced Track", and they can carry their own prerequisites, so a whole region unlocks at once.</li>
  <li><strong>Use the Journey Builder</strong> — drag the Milestone into the exact position you want on the canvas, and resize it if it deserves more visual weight than its neighbours.</li>
</ul>

<h2>7. Repeat</h2>
<p>Add as many Milestones as the program needs, grouped into as many Tabis as the shape of the content calls for. Build one end-to-end first and play it yourself before mass-producing the rest — pacing problems are much cheaper to find in the first Milestone than in the twelfth.</p>
HTML,
            ],
            [
                'title'      => 'The Full Step Library — Choosing the Right Step for the Moment',
                'slug'       => 'full-step-library-choosing-the-right-step',
                'section'    => 'setup',
                'sort_order' => 9,
                'body'       => <<<'HTML'
<p>Steps are the moment-to-moment content inside a Milestone — the thing a player is actually looking at. A Milestone can chain as many as you like, in order, and each one can carry its own reward on top of whatever the Milestone pays out.</p>
<p>There are <strong>23 Step types</strong>, and the builder groups them by what they ask of the player. That grouping is the useful way to think about pacing, so it's how this page is organised.</p>

<h2>What Every Step Has</h2>
<p>Whatever type you pick, each Step shares the same frame:</p>
<ul>
  <li><strong>Label</strong> — admin reference only. Players never see it; you'll be grateful for it at Step 14.</li>
  <li><strong>Required</strong> — must be completed to advance, or optional and skippable.</li>
  <li><strong>Background</strong> — a background image for the scene.</li>
  <li><strong>Step Rewards</strong> — XP, BLOO, EP, an item, and/or an achievement, granted on completion.</li>
  <li><strong>Mistake Message</strong> — on the types that can be answered wrongly, the message shown when they are.</li>
</ul>

<h2>Deliver — Auto-Complete on View</h2>
<p>Content the player receives. Nothing to get right; they read, watch, or listen and continue.</p>
<ul>
  <li><strong>Dialogue</strong> — a character speaks. Set the character's name and portrait and place them on the left or right (or nobody at all, if you're just describing the scene). The workhorse of narrative pacing.</li>
  <li><strong>Video</strong> — plays a video file, with optional text above it.</li>
  <li><strong>Audio</strong> — plays an audio clip in a player widget. Good for language work, podcast-style briefings, or anything voice-led.</li>
  <li><strong>Find Item</strong> — the player is handed an item, which lands in their Backpack. A reward beat with no test attached — and the natural setup for a later <em>Require Backpack Item</em> step.</li>
</ul>

<h2>Validate — The Player Must Answer Correctly</h2>
<p>The Next button stays locked until they get it right. Each of these can carry a Mistake Message for wrong attempts.</p>
<ul>
  <li><strong>Multiple Choice</strong> — a question, an optional question image, and your options. Mark one correct answer or several, and choose whether players may select more than one. The fastest comprehension check there is.</li>
  <li><strong>Keyphrase</strong> — the player types a word or phrase. You supply a comma-separated list of accepted answers (any match passes) and decide whether case matters. Excellent for in-person events: put the phrase on a slide, a poster, or a physical prop.</li>
  <li><strong>Cryptex</strong> — the same accepted-answers idea rendered as a rotating combination lock, with a wheel count you set (up to 20). Same mechanic as a Keyphrase, completely different feel — reach for it when the answer <em>should</em> feel like cracking something open.</li>
  <li><strong>Puzzle</strong> — a jigsaw built from an image you upload, cut into a grid you choose (2–8 columns by 2–8 rows). The player drags and rotates the pieces into place. Low information density, high engagement — a change of pace, not a knowledge check.</li>
  <li><strong>Require Backpack Item</strong> — a gate that only opens if the player is carrying a specific item, with the option to consume it on use. This is what turns the Item Shop and Find Item steps into a real progression mechanic rather than decoration.</li>
  <li><strong>SCORM Package</strong> — upload a SCORM 1.2 package and it runs inside the Step, tracking completion and resuming where the player left off. Use it to fold in content you already built in another authoring tool instead of rebuilding it. You can reset every player's progress on the package from the same panel.</li>
  <li><strong>Case Study (HTML)</strong> — embeds a self-contained interactive HTML activity by URL. You set the total number of questions and the score needed to pass; the activity reports its own result back and the Step completes when the player clears the bar. This is the escape hatch for bespoke, custom-built exercises.</li>
</ul>

<h2>Collect — The Player Submits, With No Right or Wrong</h2>
<p>You're gathering something, not grading it. Use these for reflection, feedback, evidence, and opinion.</p>
<ul>
  <li><strong>Open Text</strong> — free writing, with an optional minimum word count. Can be validated by AI against criteria you write in plain language ("must name at least two causes of the French Revolution"), which gives the player instant feedback to revise against before they submit. See <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>.</li>
  <li><strong>Survey Choice</strong> — a question with options and no correct answer. Choose whether players can pick more than one, and whether they see the aggregate results after answering.</li>
  <li><strong>Rating Scale</strong> — a numeric scale with a minimum and maximum you set, plus a label for each end ("Strongly Disagree" to "Strongly Agree"). The tool for pulse checks and confidence self-ratings.</li>
  <li><strong>Poll</strong> — a question whose results render as live percentage bars the moment the player votes. Use it when seeing what everyone else said is the point.</li>
  <li><strong>Upload Image</strong> — the player submits a photo or screenshot, with a maximum file size you set. Use it for anything you need to <em>see</em> to assess.</li>
  <li><strong>Upload Video</strong> — the same, for video. Pitches, demonstrations, language practice, physical technique.</li>
</ul>

<h2>Flow — Routing</h2>
<ul>
  <li><strong>Branch Choice</strong> — the player picks one of the paths in a branch group, and that choice is permanent and mutually exclusive: taking one closes the others. This is how you build "choose your track" moments. Branch groups themselves are set up on the achievement, then referenced here. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</li>
</ul>

<h2>Special</h2>
<ul>
  <li><strong>System Message</strong> — narrator text in the system voice, with no character attached. For instructions, transitions, and anything that isn't a person speaking.</li>
  <li><strong>Win Screen</strong> — the success beat at the end of a Milestone.</li>
  <li><strong>Fail Screen</strong> — the failure beat; ends the Milestone as failed.</li>
  <li><strong>Choose Nickname</strong> — prompts the player for their name and sets it. Almost always in the first Milestone of an Adventure.</li>
  <li><strong>Choose Avatar</strong> — the player picks from the avatar images you provide. Same placement logic as Choose Nickname.</li>
</ul>

<h2>Pacing: The Only Rule That Matters</h2>
<p>Alternate the groups. Deliver something, then ask for something. A run of Deliver steps reads like a slide deck; a run of Validate steps reads like an exam. The Milestones players remember alternate every two or three Steps.</p>

<h2>Per-Step Rewards</h2>
<p>Any Step can hand out its own XP, BLOO, EP, item, or achievement, independent of the Milestone's overall reward. Use small per-Step rewards to keep a long Milestone feeling alive along the way, and save the bigger payout for completion.</p>

<h2>Making a Step Optional</h2>
<p>Mark a Step as not required and players can skip it without blocking their progress — useful for bonus content, an optional deep-dive, or anything that enriches the experience without gating it.</p>
HTML,
            ],
            [
                'title'      => 'Achievements, Paths & Ranks — Designing Your Reward Ladder',
                'slug'       => 'achievements-paths-and-ranks-reward-ladder',
                'section'    => 'setup',
                'sort_order' => 10,
                'body'       => <<<'HTML'
<p>Achievements are how you recognize progress beyond raw XP — a badge on a profile, a visible marker of what someone has actually done. As a GM, you're designing three distinct tools here, not one.</p>

<h2>Three Tools, Three Jobs</h2>
<ul>
  <li><strong>Achievement</strong> — a one-off milestone. "Finished onboarding," "Perfect score on the compliance quiz." Awarded once, doesn't imply anything came before or after it.</li>
  <li><strong>Path</strong> — part of a themed series. Use paths when you want players collecting a set — "completed 3 of 5 modules in the Leadership track."</li>
  <li><strong>Rank</strong> — a status tier, shown with extra framing on a player's profile. Use ranks when progress itself is the reward — Bronze/Silver/Gold, Associate/Senior/Lead — something that visibly upgrades as a player advances.</li>
</ul>

<h2>Automatic Triggers vs Manual Grants</h2>
<p>Most achievements should fire automatically — on a level-up, a milestone chain completing, or a specific milestone finishing. Set the trigger once and forget it. You can also grant one manually, which is worth reserving for genuinely human moments: recognizing a standout contribution, a live event, something a rule can't detect.</p>

<h2>Designing a Rank Ladder</h2>
<p>If you're using ranks, decide the tier count up front — three to five works well for most programs, more than that and the distinctions stop feeling meaningful. Tie each tier to a real, visible threshold (a level, a set of completed milestones) so players can always see the next rung and what it takes to reach it.</p>

<h2>Badge &amp; Color Design Tips</h2>
<p>Achievements render as hexagonal badges, so simple, high-contrast icon designs read best at small sizes. Reuse your Adventure's accent color for the badge border to keep the whole reward system feeling like one coherent visual language rather than a grab-bag of clip art.</p>

<p><strong>Where to go next:</strong> <a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a>, if part of your reward design is social or team-based.</p>
HTML,
            ],
            [
                'title'      => 'Guilds — Designing Team Play',
                'slug'       => 'guilds-designing-team-play',
                'section'    => 'setup',
                'sort_order' => 11,
                'body'       => <<<'HTML'
<h2>Should This Adventure Use Guilds?</h2>
<p>Guilds add a team layer on top of individual progress — good for cohort-based programs (a bootcamp class, a department-wide rollout) where a bit of friendly competition or shared accountability helps. For a purely self-paced, individual course, they're often unnecessary overhead — skip them if there's no real "team" behind the players.</p>

<h2>Creating Guilds &amp; Setting Capacity</h2>
<p>Set up guilds with a name, color, and logo so they read as distinct on the leaderboard, and a capacity if you want to keep group sizes even. Uneven guild sizes skew any XP/BLOO comparison between them, so capacity matters more than it looks like it should.</p>

<h2>Guild XP/BLOO Pools</h2>
<p>Each guild accumulates its own XP and BLOO total from every member's contributions, separate from any individual's personal balance. This is what powers the guild leaderboard — a team's score is a sum, not an average, so a highly active member can meaningfully carry a smaller or quieter group.</p>

<h2>Assigning Players — Manual or Bulk</h2>
<p>Assign guild membership at enrollment (see <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>), either one at a time or as part of a bulk-enrollment batch — the same batch you use to bring in a whole cohort at once is the natural place to also set their starting guild.</p>

<h2>Running a Guild Leaderboard Moment</h2>
<p>Guild standings are most motivating when they're actually visible, not just theoretically trackable — call them out in a live session, screen-share the leaderboard at a kickoff, or post an <a href="/docs/announcements-keeping-an-adventure-alive">announcement</a> when the standings shift. A leaderboard nobody looks at doesn't do anything.</p>
HTML,
            ],
            [
                'title'      => 'The Item Shop — Building an In-Adventure Economy',
                'slug'       => 'item-shop-building-an-economy',
                'section'    => 'setup',
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>The Item Shop turns BLOO from a score into an economy — a reason to keep earning it beyond the number going up. As the GM, you're the one who decides what's actually for sale.</p>

<h2>The Three Item Types, Revisited for GMs</h2>
<ul>
  <li><strong>Consumable</strong> — used once and gone. Hints, extra Challenge attempts, EP recharges. Design these as small conveniences, not power that trivializes your content.</li>
  <li><strong>Key</strong> — unlocks something specific, usually a gated milestone. This is your soft-lock design tool: instead of a hard prerequisite, make a milestone purchasable.</li>
  <li><strong>Reward</strong> — a keepsake with no functional effect, just for collecting. Cosmetic items are underrated for player motivation — not everything needs a mechanical purpose.</li>
</ul>

<h2>Pricing With BLOO</h2>
<p>Price items relative to how much BLOO a typical player has actually earned by the point they'd realistically want the item — a shop full of things nobody can afford yet reads as broken, not aspirational.</p>

<h2>Level-Gating &amp; Secret Items</h2>
<p>Items can require a minimum level to appear in the shop at all, and can carry a "secret" badge state — hidden until discovered, which is a good fit for anything meant to feel like an easter egg rather than a storefront listing.</p>

<h2>Keys as Soft Puzzle Locks</h2>
<p>Because a Key item can gate a milestone the same way a prerequisite does, you can design a moment where players have to earn or buy their way to a Key, then actively use it from their Backpack — a small extra bit of friction and ceremony compared to a milestone that just silently unlocks.</p>

<h2>Tuning Your Economy</h2>
<p>Watch how fast BLOO accumulates versus how fast the shop drains it. If nobody's buying anything, prices are probably too high relative to earn rate, or the items on offer aren't compelling; if everyone maxes out the shop immediately, consider adding a higher-tier item or two so BLOO stays meaningful later in the Adventure too.</p>
HTML,
            ],
            [
                'title'      => 'Branching & Prerequisites — Building Non-Linear Adventures',
                'slug'       => 'branching-and-prerequisites-non-linear-adventures',
                'section'    => 'setup',
                'sort_order' => 13,
                'body'       => <<<'HTML'
<p>Not every Adventure needs to be a straight line. BLUERABBIT gives you two related but distinct tools for building forks: prerequisite rules that gate a milestone, and branch steps that redirect a player mid-milestone.</p>

<h2>Prerequisite Rules: Milestone, Item, or Achievement</h2>
<p>Any milestone's unlock condition can point at a prerequisite milestone, a required item, or a required achievement — and you can stack more than one. This is the tool for "you can't get here without having done that," whether "that" is content, currency, or recognition.</p>

<h2>The Branch Choice Step</h2>
<p>A <strong>Branch Choice</strong> step asks the player to pick one of the paths in a branch group — "pick your role," "pick your specialization." The choice is <em>permanent and mutually exclusive</em>: taking one path closes the others for good, which is what makes it feel like a real decision rather than a menu. From that point on, everything gated to a path is filtered by what they chose.</p>
<p>Branch groups are defined on the achievement, then referenced by the Step. Set the group up first, then add the Step that points at it.</p>

<h2>Locking a Milestone Until a Branch Is Chosen</h2>
<p>A milestone can be set to stay locked until the player has made a specific branch choice earlier in the Adventure — useful when later content genuinely only makes sense in the context of the path taken, rather than being available to everyone regardless of their earlier choices.</p>

<h2>Designing a Believable Fork</h2>
<p>The best branches are ones where both paths feel intentional, not like one is the "real" content and the other a stub. If you don't have time to build both sides of a fork fully, it's usually better to cut it to a single path than ship a branch that's obviously thinner on one side — players notice.</p>
HTML,
            ],
            [
                'title'      => 'Random Encounters — Keeping Players on Their Toes',
                'slug'       => 'random-encounters',
                'section'    => 'setup',
                'sort_order' => 14,
                'body'       => <<<'HTML'
<h2>Random Encounters — Pop-Up Moments</h2>
<p>An Encounter is a quiz or challenge that can interrupt a player's session unprompted — a pop-up moment rather than something sitting on the map waiting to be clicked. Use these sparingly for a spike of surprise and engagement; too many and they start to feel like an interruption rather than a delight.</p>

<h2>Spending EP on Encounters</h2>
<p>Encounters are gated by Energy Points — a player needs EP available to trigger or respond to one. This is the main reason EP exists as its own currency: it naturally rate-limits how often a player is pulled into an unplanned moment, no matter how the Encounter itself is configured.</p>

<h2>When to Reach for One</h2>
<p>Use an Encounter when you want a moment of unpredictability inside an otherwise planned path. It's an optional layer — a straightforward Adventure without any Encounters is a completely valid, often clearer, design.</p>
HTML,
            ],
            [
                'title'      => 'QR Codes — Live & Hybrid Event Checkpoints',
                'slug'       => 'qr-codes-live-and-hybrid-events',
                'section'    => 'setup',
                'sort_order' => 15,
                'body'       => <<<'HTML'
<h2>What a Milestone QR Code Actually Does</h2>
<p>Every milestone can generate a unique, scannable QR code. Scanning it completes that milestone directly for the player who scans it — bypassing every other unlock rule the milestone would normally check. It's the one mechanic in BLUERABBIT explicitly designed to skip the rest of the system.</p>

<h2>Generating and Printing Codes</h2>
<p>Generate the code from the milestone itself once it's built, then print or display it wherever the checkpoint physically lives — a station at a bootcamp, a poster at an office onboarding day, a slide at the end of a live session.</p>

<h2>Good Use Cases</h2>
<ul>
  <li>An in-person orientation day, where "you showed up and scanned in" should count as completion on its own.</li>
  <li>A scavenger-hunt-style Adventure where physical locations map to Journey Map milestones.</li>
  <li>A live event wrap-up milestone that's meant to be quick and ceremonial, not another writing assignment.</li>
</ul>

<h2>What It Skips (and Why That's OK Sometimes)</h2>
<p>Because a QR scan ignores level requirements, prerequisites, and deadlines, it's not the right tool for anything you actually want gated. Reserve it for milestones where "being physically present and scanning" is itself the entire point — a deliberate shortcut, not a workaround for content you didn't have time to build unlock rules for.</p>
HTML,
            ],
            [
                'title'      => 'Grading & AI-Assisted Feedback — Reviewing Player Submissions',
                'slug'       => 'grading-and-ai-assisted-feedback',
                'section'    => 'setup',
                'sort_order' => 16,
                'body'       => <<<'HTML'
<h2>What Needs Grading, and What Doesn't</h2>
<p>Most Step types need nothing from you. Deliver steps complete on their own. Validate steps mark themselves against the answers you set. Collect steps gather responses without a right or wrong. The place a Game Master's actual review time goes is <strong>Open Text</strong> steps and the written submissions they produce.</p>

<h2>Setting the Bar Before They Submit</h2>
<p>An Open Text step can require a minimum word count, so a one-line answer simply can't be sent. You never see the half-effort version, and the player gets the feedback immediately rather than waiting for you to bounce it back.</p>

<h2>Turning On AI-Assisted Feedback</h2>
<p>If your Adventure has an AI API key configured, an Open Text step can be validated automatically against criteria you write in plain language — "the answer must name at least two causes of the French Revolution", say. The player gets that feedback and can revise before submitting to you. It doesn't replace your judgment on the final grade; it means what reaches you has usually already had one round of self-correction.</p>
<p>You can also set how strictly the AI reads the criteria, which is worth tuning on a real cohort's answers rather than guessing up front.</p>

<h2>Your Review Queue</h2>
<p>Submissions land against the Milestone, carrying the player's text and, if you're using graded Milestones, a grade you assign — completion, percentage, or letter, matching whatever grading mode you set when you designed it. Work through submissions per-Milestone rather than per-player if you're grading a cohort — it's easier to stay consistent when you're comparing several answers to the same prompt back to back.</p>

<p><strong>Where to go next:</strong> <a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>, once you're grading at cohort scale.</p>
HTML,
            ],
            [
                'title'      => 'Announcements — Keeping an Adventure Alive Between Sessions',
                'slug'       => 'announcements-keeping-an-adventure-alive',
                'section'    => 'setup',
                'sort_order' => 17,
                'body'       => <<<'HTML'
<h2>Posting to the Adventure Wall</h2>
<p>Announcements post to a shared wall inside the Adventure — visible to everyone enrolled, independent of where any individual player currently is on the Journey Map. It's the one channel that reaches players who haven't logged in recently, the moment they come back.</p>

<h2>What Belongs in an Announcement</h2>
<p>Good candidates: a new Tabi or chapter just unlocked for everyone, a guild leaderboard shift worth calling out, a reminder that a deadline is approaching, a shout-out to a specific player's achievement. Anything that's genuinely relevant to the whole cohort, not a one-to-one message — that belongs elsewhere.</p>

<h2>Keeping Momentum Between Sessions</h2>
<p>Self-paced Adventures lose momentum fastest in the gap between live sessions or milestones. A short announcement timed to land a few days after a deadline, or right as a new chapter opens, does more for completion rates than almost any content change — it's a nudge, not a rebuild.</p>

<h2>A Simple Cadence That Works</h2>
<p>For a multi-week program: one announcement at kickoff, one at the midpoint calling out standings, and one heading into the final stretch. Add ad hoc ones for anything time-sensitive, but a predictable light cadence beats either silence or noise.</p>
HTML,
            ],
            [
                'title'      => 'Worked Example — Building a Two-Week Onboarding Adventure End to End',
                'slug'       => 'worked-example-two-week-onboarding-adventure',
                'section'    => 'setup',
                'sort_order' => 18,
                'body'       => <<<'HTML'
<p>Everything above in one build. This walks through designing "Launch Week" — a two-week new-hire onboarding Adventure for a mid-sized company — touching nearly every feature covered in this guide, in the order a Game Master would actually reach for them.</p>

<h2>The Brief</h2>
<p>Forty new hires across three departments, starting the same Monday. Goal: get everyone through company basics, department-specific training, and one in-person orientation day, with enough structure that HR can see who's on track without babysitting anyone.</p>

<h2>Day 1 — The Map &amp; the First Milestones</h2>
<p>Start from a blank Adventure rather than a template — this program is specific enough to build fresh. Lay out the Journey Map in two Tabis: "Week One: Company Basics" and "Week Two: Department Deep-Dive," with Week Two locked until Week One's core Milestones are finished. Add a welcome Milestone first ("Welcome to the Company") — pure delivered content, zero friction on day one.</p>

<h2>Building the Steps</h2>
<p>Inside the welcome Milestone: a <strong>Choose Nickname</strong> step, a <strong>Dialogue</strong> step introducing the CEO character, and a <strong>Video</strong> step touring the office. The next Milestone, "Tell Us About You," uses an <strong>Open Text</strong> step with a 50-word minimum plus an <strong>Upload Image</strong> step for a profile photo. A short <strong>Challenge</strong> on company policy follows — a real question bank with a pass threshold, not a Milestone.</p>

<h2>Rewards, Ranks &amp; the Shop</h2>
<p>Every Milestone pays XP and a little BLOO. Three <strong>Rank</strong> achievements track overall progress — New Hire → Onboarded → Launch-Ready — each triggering automatically at a level threshold. The Item Shop carries a handful of <strong>Consumable</strong> items (an extra Challenge attempt) and one <strong>Reward</strong> item (a cosmetic company-swag badge) — nothing that trivializes the actual content.</p>

<h2>Guilds for the Cohort</h2>
<p>All forty new hires get bulk-enrolled with guild assignment by department — three guilds, capacity roughly even. A department-level leaderboard turns "finish onboarding" into a bit of friendly competition without pitting individuals against each other.</p>

<h2>The Branch: Choose Your Track</h2>
<p>Week Two opens with a <strong>Branch Choice</strong> step — Engineering, Sales, or Operations. The choice is permanent, and every Milestone from that point on is gated to the matching track, so nobody wades through training content irrelevant to their actual role.</p>

<h2>The In-Person Checkpoint (QR Code)</h2>
<p>Wednesday of Week One is an in-person orientation day. The "Attended Orientation" Milestone exists purely as a QR code checkpoint at the door — scan on the way in, Milestone complete, no submission required. It's the one deliberate bypass in the whole design, and it's the right call here.</p>

<h2>Keeping It Alive Week Two</h2>
<p>An announcement posts the moment Week One's Tabi fully unlocks Week Two for the cohort, and a second one midway through calls out the department leaderboard standings. Open Text steps in Week Two get AI-assisted feedback turned on, so HR is reviewing already-revised answers instead of first drafts.</p>

<h2>What Shipped</h2>
<p>Two Tabis, roughly a dozen Milestones plus two Challenges, a dozen different Step types, a rank ladder, three guilds, a small shop, one branch, one QR checkpoint, and two announcements — built and published before the Monday start date, ready to hand off to HR without a single line of code.</p>
HTML,
            ],
            [
                'title'      => 'Step Type Quick Reference',
                'slug'       => 'step-type-quick-reference',
                'section'    => 'setup',
                'sort_order' => 19,
                'body'       => <<<'HTML'
<p>A fast lookup for all 23 Step types available inside a Milestone. See <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> for the fuller explanation of each.</p>

<h2>Deliver — auto-completes on view</h2>
<ul>
  <li><strong>Dialogue</strong> — a character speaks; name, portrait, left/right placement.</li>
  <li><strong>Video</strong> — plays a video file.</li>
  <li><strong>Audio</strong> — plays an audio clip in a player widget.</li>
  <li><strong>Find Item</strong> — hands the player an item into their Backpack.</li>
</ul>

<h2>Validate — must be answered correctly to advance</h2>
<ul>
  <li><strong>Multiple Choice</strong> — question, optional image, one or many correct options.</li>
  <li><strong>Keyphrase</strong> — type a phrase; list of accepted answers, optional case sensitivity.</li>
  <li><strong>Cryptex</strong> — the same as Keyphrase, as a combination lock with a set wheel count.</li>
  <li><strong>Puzzle</strong> — jigsaw from an uploaded image, on a grid you choose (2–8 by 2–8).</li>
  <li><strong>Require Backpack Item</strong> — only opens if the player carries a given item; optionally consumes it.</li>
  <li><strong>SCORM Package</strong> — runs an uploaded SCORM 1.2 package with completion tracking and resume.</li>
  <li><strong>Case Study (HTML)</strong> — embeds an external interactive activity; set pass score and question count.</li>
</ul>

<h2>Collect — a submission, with no right or wrong</h2>
<ul>
  <li><strong>Open Text</strong> — free writing; minimum word count and optional AI validation.</li>
  <li><strong>Survey Choice</strong> — a question with options; allow multiple, optionally show results.</li>
  <li><strong>Rating Scale</strong> — numeric scale with min/max values and a label at each end.</li>
  <li><strong>Poll</strong> — a question whose aggregate results appear as bars after voting.</li>
  <li><strong>Upload Image</strong> — image submission with a maximum file size.</li>
  <li><strong>Upload Video</strong> — video submission with a maximum file size.</li>
</ul>

<h2>Flow — routing</h2>
<ul>
  <li><strong>Branch Choice</strong> — a permanent, mutually exclusive pick between the paths in a branch group.</li>
</ul>

<h2>Special</h2>
<ul>
  <li><strong>System Message</strong> — narrator text with no character attached.</li>
  <li><strong>Win Screen</strong> — the success beat.</li>
  <li><strong>Fail Screen</strong> — the failure beat; ends the Milestone as failed.</li>
  <li><strong>Choose Nickname</strong> — prompts for the player's name and sets it.</li>
  <li><strong>Choose Avatar</strong> — the player picks from the avatars you provide.</li>
</ul>

<p>Any Step can be marked optional (players may skip it), can carry a background image, and can pay out its own XP/BLOO/EP/item/achievement on top of the Milestone's overall reward. Validate types can also carry a Mistake Message shown on a wrong answer.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // Setup docs, phase 2 (2026-07-28, same day) — a running
            // example adventure threaded through the manual, plus the
            // remaining feature areas: Challenges as their own
            // deep dive, the event Schedule, SCORM, and email campaigns
            // to enrolled players (distinct from this website's own
            // waitlist/Resend module — different system entirely).
            // Concept + how-to pairing per Bernardo's follow-up.
            // ---------------------------------------------------------
            [
                'title'      => 'Meet "Launch Week" — Our Running Example Adventure',
                'slug'       => 'meet-launch-week-example-adventure',
                'section'    => 'setup',
                'sort_order' => 20,
                'body'       => <<<'HTML'
<p>Several pages in this manual reference the same fictional adventure so examples stay consistent instead of jumping between unrelated scenarios each time.</p>

<h2>The Brief</h2>
<p><strong>Launch Week</strong> is a two-week new-hire onboarding Adventure for a mid-sized company: forty new hires across three departments, starting the same Monday, wrapped up with an in-person orientation day midway through Week One.</p>

<h2>What It Uses</h2>
<ul>
  <li>Two Tabis — "Week One: Company Basics" and "Week Two: Department Deep-Dive"</li>
  <li>A mix of Milestones and two Challenges</li>
  <li>Choose Nickname, Dialogue, Video, Open Text, Upload Image, Multiple Choice and Branch Choice steps</li>
  <li>A three-tier Rank ladder (New Hire → Onboarded → Launch-Ready) and a small Item Shop</li>
  <li>Three department Guilds with a shared leaderboard</li>
  <li>A Branch Choice into Engineering / Sales / Operations tracks</li>
  <li>A QR-code checkpoint at the in-person orientation day</li>
  <li>Announcements at kickoff and at the Week Two handoff</li>
</ul>

<p>The full build, in order, is documented in <a href="/docs/worked-example-two-week-onboarding-adventure">Worked Example — Building a Two-Week Onboarding Adventure End to End</a>. Other pages in this manual reference Launch Week in passing to illustrate a specific feature in context.</p>
HTML,
            ],
            [
                'title'      => 'Challenges — Concept',
                'slug'       => 'challenges-concept',
                'section'    => 'setup',
                'sort_order' => 21,
                'body'       => <<<'HTML'
<p>A <strong>Challenge</strong> is the other thing you can place on the Journey Map alongside a Milestone. Where a Milestone <em>provides</em> knowledge, a Challenge <em>tests</em> it.</p>

<h2>There's a Right Answer</h2>
<p>A Challenge is a quiz. You build a bank of questions, and each attempt shows a subset drawn from that bank — set how many questions appear per attempt and how many correct answers count as a pass. Add an optional time limit if you want it to feel like a real test rather than an untimed review.</p>

<h2>Attempts &amp; Retries</h2>
<p>Challenges can include a number of free attempts, with additional attempts costing BLOO beyond that — useful when you want a real assessment (limited retries) rather than something a player can brute-force by retrying indefinitely for free.</p>

<h2>Challenge or Milestone?</h2>
<p>If a player could plausibly fail and be sent back to try again, build a Challenge. If they just need to go through the content — even content that asks them questions along the way — build a Milestone. A Milestone can absolutely contain Multiple Choice, Keyphrase and other Validate steps that must be answered correctly; the difference is that those gate a single Step, while a Challenge grades the whole thing and can be failed as a unit.</p>

<h2>In Launch Week</h2>
<p>The Week One company-policy quiz is a Challenge — five questions per attempt, four correct to pass, two free attempts, a small BLOO cost for a third. The end-of-Week-One "How was your first week?" check-in is <em>not</em> a Challenge: it's a Milestone built from Rating Scale and Open Text steps, because there's nothing there to get right.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-a-challenge">How to Build a Challenge</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Build a Challenge',
                'slug'       => 'how-to-build-a-challenge',
                'section'    => 'setup',
                'sort_order' => 22,
                'body'       => <<<'HTML'
<p>Step-by-step — see <a href="/docs/challenges-concept">Challenges — Concept</a> if you haven't decided whether you want a Challenge or a Milestone, and <a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone</a> for the other route.</p>

<ol>
  <li>Create a new Challenge and give it a name, colour, icon and main image, then save it — the question builder opens once it exists.</li>
  <li>Write your question bank. Each question needs its answer options, with the correct one (or ones) marked, and can carry an image.</li>
  <li>Set how many questions to show per attempt, and how many correct answers count as a pass.</li>
  <li>Optionally set a time limit for the whole attempt.</li>
  <li>Set the number of free attempts, then a BLOO cost for any attempt beyond that.</li>
  <li>Set the unlock requirements and the XP/BLOO reward for passing, then publish.</li>
  <li>Place it on the Journey Map — into a Tabi, or positioned directly in the Journey Builder.</li>
</ol>

<h2>Sizing the Question Bank</h2>
<p>Write more questions than you show. A bank of fifteen with five shown per attempt means a retry is a genuinely different test, which is what makes limited retries fair rather than a memory exercise.</p>
HTML,
            ],
            [
                'title'      => 'The Event Schedule: Sessions, Speakers & Sponsors — Concept',
                'slug'       => 'event-schedule-concept',
                'section'    => 'setup',
                'sort_order' => 23,
                'body'       => <<<'HTML'
<p>Not every part of an Adventure needs to be a milestone. The Schedule is a separate, purely informational layer for anything time-and-place based — live sessions, who's speaking, who's sponsoring — sitting alongside the Journey Map rather than gating progress on it.</p>

<h2>Sessions</h2>
<p>A session is a scheduled block — a workshop, a live Q&amp;A, an orientation walkthrough — with a title, a time, and (for in-person or hybrid programs) a room or location. Sessions don't unlock or block anything on their own; they're there so players know what's happening and when.</p>

<h2>Speakers</h2>
<p>Attach speaker profiles to sessions — name, title, a short bio, a photo. Useful for anything with outside facilitators or leadership guest spots, so players know who they're about to hear from.</p>

<h2>Sponsors</h2>
<p>A simple sponsor listing — logo and name, typically shown alongside the schedule. Mostly relevant for bootcamp or conference-style Adventures with outside sponsorship involved.</p>

<h2>In Launch Week</h2>
<p>The in-person orientation day gets three sessions on the schedule — a welcome talk, a benefits walkthrough, and a team-lunch block — each with a room listed, so the schedule doubles as the day's printed agenda.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-an-event-schedule">How to Build an Event Schedule</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Build an Event Schedule',
                'slug'       => 'how-to-build-an-event-schedule',
                'section'    => 'setup',
                'sort_order' => 24,
                'body'       => <<<'HTML'
<ol>
  <li>From your Adventure, open the <strong>Schedule</strong> section.</li>
  <li>Add a session: title, start/end time, and a room or location if it's in-person or hybrid.</li>
  <li>Attach a speaker if the session has one — add their name, title, short bio, and photo once, then reuse them across multiple sessions if they're speaking more than once.</li>
  <li>Add any sponsors you want listed alongside the schedule — logo and name is enough.</li>
  <li>Publish the schedule. It's visible to enrolled players independent of where they are on the Journey Map — nothing here needs to be "unlocked."</li>
</ol>
<p>The Schedule is content, not mechanics — it doesn't reward XP/BLOO or gate anything on its own. Pair it with a QR-code milestone (see <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>) if you want attendance at a specific session to actually count toward progress.</p>
HTML,
            ],
            [
                'title'      => 'SCORM Packages — Concept',
                'slug'       => 'scorm-packages-concept',
                'section'    => 'setup',
                'sort_order' => 25,
                'body'       => <<<'HTML'
<p>If you already have e-learning content built in another authoring tool, you don't have to rebuild it inside BLUERABBIT from scratch — the SCORM step type embeds it directly.</p>

<h2>What SCORM Is</h2>
<p>SCORM is a long-standing e-learning packaging standard — most authoring tools (Articulate, Captivate, and similar) can export a course as a SCORM package. A SCORM step embeds that package in an iframe and tracks its completion the same way a native step would.</p>

<h2>What You Get</h2>
<p>Completion tracking happens automatically once the package reports itself finished — no manual grading step, no separate spreadsheet of who finished the external course. It slots into the milestone and Journey Map exactly like any other step, rewards included.</p>

<h2>When to Reach for It</h2>
<p>Use SCORM when strong existing content already exists and rebuilding it natively would be pure duplicated effort — a compliance course, a vendor-provided training module. For anything you're building fresh, a native step (Open, Multiple-choice, Dialogue) is usually a better fit and gives you BLUERABBIT's own reward and branching tools directly.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-add-a-scorm-package">How to Add a SCORM Package</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Add a SCORM Package',
                'slug'       => 'how-to-add-a-scorm-package',
                'section'    => 'setup',
                'sort_order' => 26,
                'body'       => <<<'HTML'
<ol>
  <li>Export your course from its authoring tool as a SCORM 1.2 or SCORM 2004 package (a single <code>.zip</code> file).</li>
  <li>Add a new step inside a milestone and set its type to <strong>SCORM</strong>.</li>
  <li>Upload the exported <code>.zip</code> — it's extracted and embedded automatically.</li>
  <li>Set the step's reward (XP/BLOO/EP/item) the same as you would any other step.</li>
  <li>Preview the step yourself before publishing — SCORM packages can vary in how reliably they report completion, so a manual click-through once is worth it.</li>
</ol>
HTML,
            ],
            [
                'title'      => 'Email Campaigns to Your Players — Concept',
                'slug'       => 'email-campaigns-to-players-concept',
                'section'    => 'setup',
                'sort_order' => 27,
                'body'       => <<<'HTML'
<p><strong>Not to be confused with:</strong> this is about emailing players already enrolled in one of your Adventures. It's a separate system from bluerabbit.io's own public waitlist signup emails on the marketing site — different audience, different tool, don't mix the two up when someone asks "did the email go out?"</p>

<h2>What a Campaign Is</h2>
<p>A campaign is a one-time or triggered email sent to some or all of the players enrolled in an Adventure — built from a template with variables like the player's name and the Adventure's title filled in automatically per recipient.</p>

<h2>Good Use Cases</h2>
<ul>
  <li>Re-engaging players who haven't logged in for a while.</li>
  <li>Announcing a new Tabi or chapter that just unlocked.</li>
  <li>A deadline reminder a few days before a milestone expires.</li>
  <li>A wrap-up/congratulations message when someone finishes the whole Adventure.</li>
</ul>

<h2>Delivery &amp; Retries</h2>
<p>Sends are logged per-recipient, and failed sends can be retried rather than silently dropped — worth checking after a large send to a full cohort, since bounces and typo'd addresses happen at any real scale.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Send an Email Campaign',
                'slug'       => 'how-to-send-an-email-campaign',
                'section'    => 'setup',
                'sort_order' => 28,
                'body'       => <<<'HTML'
<ol>
  <li>From your Adventure, open <strong>Campaigns</strong> and start a new one.</li>
  <li>Choose your audience — everyone enrolled, a specific Guild, or players who haven't logged in recently.</li>
  <li>Write the email using template variables like <code>{{player_name}}</code> and <code>{{adventure_title}}</code> so each recipient gets a personalized copy from one draft.</li>
  <li>Send a test to yourself first — always worth one real look before it goes to a full cohort.</li>
  <li>Send, then check the delivery log afterward for any failures worth retrying.</li>
</ol>
<p>In Launch Week, two campaigns go out: a kickoff welcome the Sunday before Monday's start, and a Week Two nudge to anyone who hasn't opened the Path-choice step yet by Wednesday of Week One.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // User docs — Player account, journal & support (new)
            // ---------------------------------------------------------
            [
                'title'      => 'Your Account: Profile, Player Type & Privacy',
                'slug'       => 'your-account-profile-and-privacy',
                'section'    => 'user',
                'sort_order' => 7,
                'body'       => <<<'HTML'
<p>Everything about you as a person — separate from any one Adventure — lives under <strong>My Account</strong>, reachable from your avatar in the header.</p>

<h2>Profile</h2>
<p>Upload a profile picture, edit your first/last name and email, and write a short bio. Your username/nickname is shown but not editable here. You can also set your interface Language and add optional Company Name, Website, and LinkedIn fields — useful if your organization uses BLUERABBIT for professional networking-style cohorts, not just training.</p>
<p>You'll also see a <strong>Player Level</strong> here that's different from any single Adventure's level — it's an average across every Adventure you're enrolled in, a rough sense of your overall experience on the platform.</p>

<h2>Player Type (Hexad Quiz)</h2>
<p>A short personality-style quiz (based on the Hexad player-type model) sorts you into a dominant type — Free Spirit, Achiever, Philanthropist, Socialiser, Player, or Disruptor — each with a short description of what motivates that type. Take it once from your Profile tab; retake it any time with "Test Again" if you want an updated read. It's informational, not something that gates content — think of it as understanding your own play style, not a requirement.</p>

<h2>Staying Signed In</h2>
<p>Sessions last <strong>30 days</strong>. Log in once and you'll stay signed in for a month of ordinary use, rather than being kicked out after a couple of hours.</p>
<p>This is deliberate: most people work through an Adventure across weeks, not in one sitting, and being asked to log in again every time you came back was friction with no security benefit. If you're on a shared or public computer, log out explicitly when you're done — the long session is convenience for your own device.</p>

<h2>Privacy: Anonymize Me</h2>
<p>If you want out, the <strong>Anonymize Me</strong> tool (in the Account tab, double-confirmed before it runs) scrambles your name, photo, and email to random values while keeping your stats and history intact under that now-anonymous identity. It logs you out permanently — this isn't a "hide my profile" toggle, it's a one-way action for anyone who wants their personal data removed while leaving the underlying Adventure data (like completion stats) alone. If your organization doesn't offer this option, it's been turned off by your GM or organization admin.</p>
HTML,
            ],
            [
                'title'      => 'My Work: Your Personal Journal & Progress History',
                'slug'       => 'my-work-journal-and-history',
                'section'    => 'user',
                'sort_order' => 8,
                'body'       => <<<'HTML'
<p><strong>My Work</strong> is your full record inside one Adventure — everything you've done, answered, and earned, in one place. Your GM can also view this for any of their players (read-only) if they need to check in on someone's progress.</p>

<h2>Overview</h2>
<p>Your XP/BLOO/EP at a glance, plus an <strong>Engagement</strong> gauge that scores how active you've been recently — On Fire, Active, Moderate, Cooling Off, or Dormant — based on how recently you logged in and completed something. You'll also see your rank badge, leaderboard position, and simple charts of your XP over time and what kinds of milestones you've completed most.</p>

<h2>Milestones</h2>
<p>Every milestone in the Adventure, with a plain-language reason for its current state if it's not available yet — which prerequisite you're missing, what level you need, or when it opens.</p>

<h2>My Answers</h2>
<p>Every open-text answer you've ever submitted, together with its grade if it's been reviewed. Useful for revisiting your own work, or checking whether something you submitted a while ago has been graded yet.</p>

<h2>Challenges</h2>
<p>A full history of every quiz you've attempted — pass/fail, your percentage, and a question-by-question breakdown of exactly which answer you picked and whether it was correct. Good for actually learning from a quiz you didn't ace the first time.</p>

<h2>Achievements</h2>
<p>Everything you've earned so far, next to everything still available — a checklist view of the Adventure's full achievement set.</p>

<h2>Reset (Demo Adventures Only)</h2>
<p>If you're in an Adventure your GM has flagged as a demo, you'll see a self-service Reset option here to wipe your own progress and start over — not available on real, live Adventures.</p>
HTML,
            ],
            [
                'title'      => 'Getting Help: Support Requests & Live Chat',
                'slug'       => 'getting-help-support-and-chat',
                'section'    => 'user',
                'sort_order' => 9,
                'body'       => <<<'HTML'
<p>Stuck, or found something that looks broken? Two separate ways to get help, depending on what you need.</p>

<h2>Contact Admin (My Requests)</h2>
<p>The "Contact Admin" form (in the footer, on most pages) sends a subject and message straight to your Adventure's GM as a trackable request — not a live chat, more like a support ticket. Check <strong>My Requests</strong> to see everything you've sent and its status: Pending, Resolved, or Dismissed. Good for anything specific to your Adventure — a grading question, a technical issue, a request to be moved to a different Guild.</p>

<h2>Cooper — Live AI Chat</h2>
<p>Some Adventures have <strong>Cooper</strong>, an AI chat assistant, available as a button in the taskbar. It opens a chat panel for quick questions without waiting on a human reply — handy for "how do I..." questions you'd rather not write a full support ticket for. Not every Adventure has this enabled; if you don't see the button, your GM hasn't turned it on for this one.</p>

<h2>Guided Tours</h2>
<p>The first time you visit the Journey Map, a Milestone, or a Challenge, a short guided walkthrough may pop up automatically to orient you. If you skipped it and want it back, look for a "Start Tutorial" option in the header on those pages.</p>
HTML,
            ],
            [
                'title'      => 'Certificates & Secrets and Clues',
                'slug'       => 'certificates-and-secrets-and-clues',
                'section'    => 'user',
                'sort_order' => 10,
                'body'       => <<<'HTML'
<h2>Certificate of Participation</h2>
<p>If your GM has enabled it, you can generate a printable certificate showing your name, level, rank badge, and XP/BLOO/EP stats, styled with the Adventure's dates and your GM's signature. You can choose to show or hide your rank and stats before printing or exporting it — useful for something you actually want to share (like completing a training program) versus a quick personal keepsake.</p>

<h2>Secrets and Clues</h2>
<p>Some milestones carry a hidden "success message" — a bit of story or narrative payoff your GM wrote for finishing that milestone, written specifically to be a) hidden until then and b) worth savoring once. Every one you've unlocked gets collected on your <strong>Secrets and Clues</strong> page — a personal scrapbook of the story content you've earned, separate from the milestones themselves and worth a look if you want the narrative in one place rather than scattered across the Journey Map.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // Setup docs — the full Adventure Settings reference (new)
            // ---------------------------------------------------------
            [
                'title'      => 'The Complete Adventure Settings Reference',
                'slug'       => 'complete-adventure-settings-reference',
                'section'    => 'setup',
                'sort_order' => 29,
                'body'       => <<<'HTML'
<p>Your Adventure's settings screen is genuinely large — this page walks the tabs that don't get their own dedicated doc elsewhere. See <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>, <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>, <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>, and <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a> for the rest.</p>

<h2>General</h2>
<p>Name, enrollment link, badge image, and highlight color for the Adventure. Privacy is either Public (anyone with the link can join) or Invite-only. If you're an admin, you'll also see an Adventure Type field — Normal, or Template if this Adventure exists purely to spin off child Adventures from (see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>).</p>

<h2>Time Mechanics</h2>
<p>Set the Adventure's time zone from a searchable list (with a live clock so you can confirm you picked the right one), then decide how locked milestones behave: never hide them, hide until their start date, hide after their deadline passes, or both. You can also choose whether the schedule view shows the full calendar or just today's sessions.</p>

<h2>Resource Mechanics</h2>
<p>Pick a grading scale — none, straight percentage, or letter grades (A/A-/B+... down to F) — and decide when XP/BLOO/EP rewards actually land: immediately on submission, or held until a GM grades the answer. The "hold until graded" option is worth using for anything you don't want players to game by submitting garbage just to collect the reward instantly.</p>

<h2>Adventure Intro</h2>
<p>A rich-text welcome message shown the first time a player logs in — your chance to set the tone before they see the Journey Map at all.</p>

<h2>Certificate Settings</h2>
<p>If you're offering a <a href="/docs/certificates-and-secrets-and-clues">Certificate of Participation</a>, set the start/end dates it should display, upload a logo, and upload a signature image players will see on their generated certificate.</p>

<h2>Reset Settings (Existing Adventures Only)</h2>
<p>A set of double-confirmed admin utility buttons: reset every player's "seen the intro" flag, reset everyone back a level, or reset all Guilds. These affect every enrolled player at once — use them for genuine resets (like reusing an Adventure for a new cohort), not casually.</p>
HTML,
            ],
            [
                'title'      => 'Customizing Currencies, Ranks & Rewards',
                'slug'       => 'customizing-currencies-ranks-and-rewards',
                'section'    => 'setup',
                'sort_order' => 30,
                'body'       => <<<'HTML'
<p>The companion how-to for <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a> — this is where you actually change what those three currencies are called, and what happens as players level up.</p>

<h2>Renaming XP, BLOO & EP</h2>
<p>In your Adventure's Core Mechanics settings, each currency has both a Long label and a Short label you can rename independently — for example, relabeling XP as "Skill Points" (long) / "SP" (short) to fit a corporate training theme, or BLOO as "Guild Coin" for a more game-like Adventure. The mechanics underneath never change, only what players see them called. You can also rename what a "Player" is called across the Adventure — "Explorer," "Recruit," whatever fits your theme.</p>

<h2>Adventure Ranks</h2>
<p>Build a table of rank thresholds — each one triggered by a condition (most often "reaches Level N") and tied to an Achievement that gets auto-awarded the moment a player crosses it. This is how you turn a raw level number into something that feels like a real title or milestone — Level 5 becomes "Bronze Explorer," Level 15 becomes "Guild Master," each with its own badge.</p>

<h2>A Practical Approach</h2>
<p>Don't rename everything on day one. Start with the default XP/BLOO/EP labels, run a small pilot group through the Adventure, and only rename things once you've confirmed the mechanics feel right — renaming is cheap and reversible, but re-tuning reward math after players are mid-Adventure is a much bigger disruption.</p>
HTML,
            ],
            [
                'title'      => 'Managing Your Player Roster',
                'slug'       => 'managing-your-player-roster',
                'section'    => 'setup',
                'sort_order' => 31,
                'body'       => <<<'HTML'
<p>Companion to <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a> — this covers the day-to-day tools for managing a roster once people are already in.</p>

<h2>The Enrolled Players Tab</h2>
<p>A searchable, filterable table of everyone in the Adventure — filter by role (Player/GM/NPC), switch someone's role inline without re-inviting them, remove a player entirely, or trigger a password reset for them directly (see below).</p>

<h2>Adding Players</h2>
<p>Add people one at a time, or bulk-import via CSV. The CSV import expects an Email column (the only required one) plus optional Nickname, Password, First/Last Name, Language, and a Guild column — if the Guild named in a row doesn't exist yet, it's created automatically rather than failing the import. Nine additional workforce-metadata columns (see Player Meta below) can ride along in the same file.</p>

<h2>Resetting a Player's Password</h2>
<p>If your organization allows it, GMs (and NPCs, who have the same read access as a GM) can reset any enrolled player's password directly from this tab — you'll be asked to re-enter your own password first, as a safeguard against someone walking up to an unlocked session and resetting accounts. If you don't see this option, your organization has this feature turned off; ask your platform admin.</p>

<h2>Player Meta Manager</h2>
<p>For organizations tracking workforce data alongside gameplay — Department, Region, Job Title, Business Pillar, Cluster, whatever fields matter to you — the Player Meta Manager lets you bulk-edit these per player via CSV upload-with-preview, or edit rows inline. Export the full list back out as CSV any time, which is also the easiest way to build a segmented report outside the platform (in a spreadsheet tool, for instance).</p>
HTML,
            ],
            [
                'title'      => 'Setting Up AI Grading & Gift Card Rewards',
                'slug'       => 'setting-up-ai-grading-and-gift-cards',
                'section'    => 'setup',
                'sort_order' => 32,
                'body'       => <<<'HTML'
<p>The concept of AI-assisted grading is covered in <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a> — this page is the actual settings walkthrough for turning both integrations on.</p>

<h2>Connecting Your Claude API Key</h2>
<p>Open your Adventure's A.I. Content Validation tab. If your plan includes this feature, you'll see a password-masked field for your Claude API key:</p>
<ol>
  <li>Go to <code>console.anthropic.com</code> and sign in (or create an account).</li>
  <li>Navigate to Settings → API Keys.</li>
  <li>Create a new key and copy it — you won't be able to see it again after you leave that page, so copy it immediately.</li>
  <li>Paste it into the Claude API Key field in your Adventure settings and save.</li>
</ol>
<p>Once connected, open-text steps can be validated automatically — typically well under a cent per validation, so cost isn't a real concern even at scale. Leaving the field blank on a re-save keeps your existing key rather than clearing it, so you don't need to re-enter it every time you touch other settings on the same tab.</p>

<h2>Setting Up Gift Card Rewards (Tremendous)</h2>
<p>If your plan includes it, the Tremendous tab lets you connect a Tremendous.com account so Item Shop purchases can trigger a real, emailed gift card instead of just an in-Adventure item:</p>
<ol>
  <li>Paste your Tremendous API key into the field provided, then use "Test Connection" to confirm it's valid before going further.</li>
  <li>Choose Sandbox mode while you're testing — it behaves identically but doesn't send real money or real gift cards. Switch to Production only when you're ready to reward players for real.</li>
  <li>Set your currency (EUR/USD/GBP), funding source, and optionally a Campaign ID if Tremendous requires one for your account.</li>
</ol>
<p>Every gift-card send is logged with its status (sent, pending, failed, duplicate blocked), so you can always audit what actually went out.</p>
HTML,
            ],
            [
                'title'      => 'Customizing Your Taskbar & Adventure Branding',
                'slug'       => 'customizing-taskbar-and-branding',
                'section'    => 'setup',
                'sort_order' => 33,
                'body'       => <<<'HTML'
<h2>Quick Links (Taskbar)</h2>
<p>The taskbar shortcut buttons players see are configurable per Adventure. Toggle the built-ins on or off — Journey, Magic Code entry, Item Shop, Feedback, and the Cooper AI chat widget (which needs its own support-chat "slug" configured to work) — and add up to three fully custom buttons of your own, each with a label, a URL, an icon, and a color. Good for linking out to an external resource, a company intranet page, or a scheduling link without making players hunt for it.</p>

<h2>Images</h2>
<p>Override the background image for any major section of your Adventure independently — Journey, Item Shop, Backpack, Guilds, Schedule, Blog, Lore, Wall, and Leaderboard all accept their own background. Anything you don't override falls back to the platform's default for that section, so you can re-theme just the parts that matter to you (like the Journey Map) and leave the rest alone.</p>

<h2>A Note on Theming</h2>
<p>None of this changes layout or functionality — it's purely visual. If you're running the same Adventure for multiple cohorts via a Template (see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>), branding set on a child Adventure doesn't affect the template or other children, so you can theme each cohort differently if you want to.</p>
HTML,
            ],
            [
                'title'      => 'Reviewing & Grading Submissions in Bulk',
                'slug'       => 'reviewing-and-grading-submissions-in-bulk',
                'section'    => 'setup',
                'sort_order' => 34,
                'body'       => <<<'HTML'
<p>For grading at real scale — a full cohort's worth of open-text answers on one milestone — the review screen has a few tools worth knowing beyond grading one submission at a time.</p>

<h2>The CSV Round-Trip</h2>
<p>Download every submission for a milestone as a CSV, grade and comment on them offline in whatever spreadsheet tool you prefer, then re-upload the file to apply everything at once. Much faster than clicking through submissions one by one when you've got dozens or hundreds to get through.</p>

<h2>Pending Validation Reminders</h2>
<p>Export a CSV of exactly which players still have ungraded submissions waiting — built specifically to feed into an <a href="/docs/email-campaigns-to-players-concept">email campaign</a> nudging graders (or players) about what's outstanding.</p>

<h2>Grading Scale</h2>
<p>Depending on what you set in <a href="/docs/complete-adventure-settings-reference">Resource Mechanics</a>, you'll grade on a straight percentage or on letter grades (A through F). Whichever you choose, it's applied consistently across the review screen.</p>

<h2>Manual "Validate with A.I."</h2>
<p>Even on a milestone with AI grading already enabled, you can trigger a manual AI validation on any individual submission as a spot-check — separate from the automatic validation that ran when the player submitted it. Useful for a second opinion on a borderline case before you commit to a grade.</p>
HTML,
            ],
            [
                'title'      => 'GM Toolkit: Duplicator, Reports & Bulk Actions',
                'slug'       => 'gm-toolkit-duplicator-reports-and-bulk-actions',
                'section'    => 'setup',
                'sort_order' => 35,
                'body'       => <<<'HTML'
<h2>Duplicator</h2>
<p>Copy milestones, achievements, Tabis, items, encounters, and speakers from one Adventure into another — or into the same one. Pick what to copy from a checklist, choose the target Adventure, and confirm a summary before anything actually copies. This is the fast path for reusing content without starting from a blank Journey Map every time, and it's different from the Template/child-Adventure model (see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>) — Duplicator is a one-time copy, Templates stay linked for ongoing cohort spin-offs.</p>

<h2>Adventure Report (PDF)</h2>
<p>A printable, cover-paged report distinct from the <a href="/docs/stats-dashboard-guide">Stats Dashboard</a> — it walks through every milestone with a completion chart and the full text of every player's submitted answer for that milestone. Good for a shareable end-of-program summary, not for day-to-day monitoring.</p>

<h2>Milestone Funnel</h2>
<p>A drop-off funnel chart reachable from the Stats page, filterable by Tabi or by Level, showing where players are actually stalling out — alongside context stats like how many are enrolled, have logged in, and were active in the last 7 days. The fastest way to spot one specific milestone that's quietly losing everyone.</p>

<h2>Bulk Create (Admin Only)</h2>
<p>For platform admins: mass-generate a batch of near-identical achievements at once — shared prefix name, badge, and rewards, just varied per recipient — useful for something like stamping out dozens of "completion certificate" achievements across a large cohort in one action instead of building each by hand.</p>
HTML,
            ],
            [
                'title'      => 'Managing Player Support Requests',
                'slug'       => 'managing-player-support-requests',
                'section'    => 'setup',
                'sort_order' => 36,
                'body'       => <<<'HTML'
<p>The GM-side counterpart to players' <a href="/docs/getting-help-support-and-chat">Contact Admin requests</a>. Every message a player sends lands in your Adventure's Player Requests inbox — searchable, and filterable by status: All, Pending, Read, Resolved, or Dismissed.</p>
<p>Treat this like any support queue: triage first (skim what's new), respond or resolve directly with the player through whatever channel makes sense (in person, email, or a quick fix to their progress if that's what they're asking about), then mark it Resolved or Dismissed so your Pending list stays a true "still needs attention" list rather than a graveyard of old tickets.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // Setup docs — Enterprise: Organizations & platform settings
            // ---------------------------------------------------------
            [
                'title'      => 'Organizations: Managing Multiple Adventures at Scale (Enterprise)',
                'slug'       => 'organizations-managing-multiple-adventures',
                'section'    => 'setup',
                'sort_order' => 37,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> An Organization groups several Adventures under one account — built for a customer running more than one cohort, program, or department, who wants one place to see and manage all of it rather than jumping between separate Adventures.</p>

<h2>Setting Up Your Organization</h2>
<p>General settings cover your Organization's name, logo, brand color, and an About section. From there, everything else in this doc happens under three more tabs.</p>

<h2>Players</h2>
<p>A live search-and-add tool for building your Organization's player roster, plus CSV bulk import for larger lists. The fastest option if you're consolidating an existing Adventure into your Organization is <strong>Bulk Add from Adventure</strong> — it copies an entire Adventure's roster (players, GMs, NPCs, and the owner) into the Organization in one action, rather than re-adding everyone by hand.</p>

<h2>Adventures</h2>
<p>Search for and attach existing Adventures to your Organization, complete with their enrollment links — this is how multiple separately-built Adventures end up under one umbrella view.</p>

<h2>Stats — Cross-Adventure Analytics</h2>
<p>This is the real payoff of Organizations: analytics that span every attached Adventure at once, not just one at a time. Unique players and Adventure counts org-wide; a breakdown table you can segment by any Player Meta field (Business Pillar, Country, whatever you've configured — see <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>); an overall Engagement gauge and a five-factor Engagement breakdown; per-Adventure engagement and progress comparisons side by side; a date-ranged Daily Active Users chart; and a workforce demographics view. If you're reporting up to leadership on a multi-department rollout, this is the view built for that conversation.</p>
HTML,
            ],
            [
                'title'      => 'Platform Settings & White-Label Branding (Enterprise)',
                'slug'       => 'platform-settings-and-white-label-branding',
                'section'    => 'setup',
                'sort_order' => 38,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> Beyond a single Adventure's settings, there's a platform-wide settings console for organizations that want to shape how BLUERABBIT looks and behaves across every Adventure they run — reachable only to platform admins, not regular GMs.</p>

<h2>Custom Labels — White-Labeling Your Instance</h2>
<p>Rename every player-facing section platform-wide, not just per Adventure: Journey, Item Shop, Backpack, Guilds, Leaderboard, Blog, Resources, Achievements, and more can all be relabeled to match your organization's own vocabulary. Combined with per-Adventure currency renaming (see <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>), this is how an Enterprise customer makes BLUERABBIT feel like part of their own brand rather than a generic third-party tool.</p>

<h2>Platform-Wide Branding</h2>
<p>Set default logos, background images, and a favicon that apply across every Adventure unless a specific Adventure overrides them (see <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a> for per-Adventure overrides). Set once at the platform level, inherited everywhere.</p>

<h2>Sponsors Directory</h2>
<p>A global directory of sponsor logos and levels, available to attach to the Event Schedule (see <a href="/docs/event-schedule-concept">The Event Schedule</a>) across any Adventure — useful if the same set of sponsors backs multiple programs you run.</p>

<h2>Who Can Access This</h2>
<p>This console is intentionally restricted to platform admins — a regular GM managing one Adventure won't see it, and shouldn't need to. If you're an Enterprise customer and don't have access yet, that's a setup step for your account, not something missing from the product.</p>
HTML,
            ],
            [
                'title'      => 'How Plan Tiers Actually Differ (Enterprise)',
                'slug'       => 'understanding-plans-basic-pro-enterprise',
                'section'    => 'setup',
                'sort_order' => 39,
                'body'       => <<<'HTML'
<p>Pricing and plan limits are covered in <a href="/docs/billing-and-plans">Billing &amp; Plans</a>. This page is about what actually changes in practice as you move up tiers.</p>

<h2>Basic → Pro: The Clear Line</h2>
<p>This one's simple and enforced: Basic caps you at 200 players and 3 Adventures; Pro removes both caps entirely. If you're bumping into either limit, Pro is a self-serve upgrade — no sales conversation required, just a subscription.</p>

<h2>Pro → Enterprise: Less About Feature Toggles, More About Scale</h2>
<p>Be honest with yourself about what you actually need here. Enterprise isn't a long checklist of exclusive features locked away from Pro customers — it's built around running <strong>multiple Adventures as one managed account</strong> via <a href="/docs/organizations-managing-multiple-adventures">Organizations</a>, plus the setup work that comes with that at real scale: custom Player Meta fields for HR/roster data, cross-Adventure reporting, and (if you want it) <a href="/docs/platform-settings-and-white-label-branding">white-label branding</a> across everything you run.</p>
<p>Practically, Enterprise is <strong>sales-assisted rather than self-serve</strong> — there's no "Subscribe" button on the pricing page for it, because onboarding an Enterprise account usually involves setting up Organizations, importing rosters, and configuring branding together with our team rather than flipping a switch. <a href="/contact">Reach out</a> if you think this is where you're headed.</p>

<h2>What This Means For You Right Now</h2>
<p>If you're running one Adventure, Basic or Pro covers you completely. The moment you're coordinating more than one Adventure under a single paying relationship — multiple departments, multiple cohorts, multiple locations — that's the actual signal to talk to us about Enterprise, not a specific feature you're missing.</p>
HTML,
            ],
            // ---------------------------------------------------------
            // The Garden — relational progression. Added 2026-08-14 from the
            // CI4 app's own verified build notes (GARDEN_PROJECT_BRIEF.md +
            // the dated CLAUDE.md entries), documenting only what has actually
            // shipped. Anything still undecided is called out as such rather
            // than described as if it works.
            // ---------------------------------------------------------
            [
                'title'      => 'The Garden — An Overview',
                'slug'       => 'the-garden-overview',
                'section'    => 'user',
                'sort_order' => 11,
                'body'       => <<<'HTML'
<p>BLUERABBIT has two play areas, not one. The <a href="/docs/journey-map-guide">Journey</a> is your <em>individual</em> progression — milestones, XP, levels, achievements. The <strong>Garden</strong> is your <em>relational</em> progression: a living picture of who you actually work with, and how much you nourish those relationships.</p>
<p>Where the Journey answers "how am I growing?", the Garden answers "who am I growing with?"</p>

<h2>What You See</h2>
<p>Your Garden shows everyone in your Adventure as a hexagonal node — guildmates, other members, NPCs, and your Game Masters — arranged around you at the centre. Each Adventure has its own Garden, exactly like it has its own Journey Map.</p>
<p>Two things make the picture meaningful:</p>
<ul>
  <li><strong>Colour tells you what someone is best at.</strong> A person's node takes the colour of their <em>master skill</em> — whichever skill they've earned the most in. People who share a master skill share a colour, so clusters of expertise become visible at a glance.</li>
  <li><strong>Nodes wither when you neglect them.</strong> Someone you interacted with today shows in full colour. The longer it's been since you had any contact, the more their node drains of colour, until eventually it's fully grey. This isn't decoration — it's the entire point. Relationships that aren't maintained visibly fade.</li>
</ul>
<p>Your own node at the centre never fades.</p>

<h2>The Panels</h2>
<p>The Garden screen is deliberately mostly empty canvas. Everything else lives in small buttons along the bottom-right — Tasks, Missions, Help, Rewards, and Messages. Click one and its panel opens.</p>
<p>Two of those are the Garden's core mechanics, and they do opposite jobs:</p>
<ul>
  <li><strong><a href="/docs/garden-tasks">Tasks</a> improve you.</strong> Build a habit, practise something, do the work — and your own Skills and levels grow.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a> improve your Garden.</strong> Reach out to other people, and the relationships around you get healthier.</li>
</ul>
<p>Or, the way to remember it: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>
<p>Panels are yours to arrange: drag any panel by its header to move it, and minimise it back to the dock when you're done. The layout is remembered per Adventure, so it'll be exactly where you left it next time. If you're brand new, everything starts minimised so you get the full view first.</p>

<h2>How The Journey Feeds The Garden</h2>
<p>The two halves aren't separate games. Completing milestones and earning achievements can grant <a href="/docs/skills-and-blooms-explained">Skills</a>, and Skills are what the Garden runs on — they set your colour, they're what people recognise you for, and they're what help requests get tagged with.</p>

<h2>Where To Go Next</h2>
<ul>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a> — the currency underneath all of it</li>
  <li><a href="/docs/giving-blooms-endorsements-and-gifts">Giving Blooms</a> — the two ways to recognise someone</li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a> — asking for and giving help</li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a> — growing yourself</li>
  <li><a href="/docs/garden-missions">Garden Missions</a> — growing the Garden</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Skills & Blooms Explained',
                'slug'       => 'skills-and-blooms-explained',
                'section'    => 'user',
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>Skills and Blooms are the two ideas the whole Garden rests on. They're simpler than they first look, because they're really the same thing seen from two directions.</p>

<h2>Skills</h2>
<p>Every Adventure has its own catalogue of Skills, set up by your Game Master. A Skill can be a broad competency ("Communication and Listening", "Problem Solving") or a narrow capability gate ("Mentor"). Each one has its own colour and icon, and most carry a short description — hover a skill chip on someone's profile to read it.</p>
<p>You hold a <strong>level</strong> in each Skill. That level is simply a count: <strong>one Bloom received in a Skill equals one level in it</strong>. No weighting, no decay, no complicated formula. Twenty Blooms in Resilience means level 20 in Resilience.</p>
<p>Your highest Skill is your <strong>master skill</strong>, and it sets your node's colour in the Garden. If two Skills are tied at the top, you choose which one represents you from your own profile drawer.</p>

<h2>Blooms</h2>
<p>Blooms are recognition made countable. A Bloom is never abstract — it's always awarded <em>in a specific Skill</em>, which is why receiving them builds a real picture of what you're known for rather than a single meaningless score.</p>
<p>Blooms reach you from several directions:</p>
<ul>
  <li><strong>From other players</strong> — endorsements and gifts (see <a href="/docs/giving-blooms-endorsements-and-gifts">Giving Blooms</a>)</li>
  <li><strong>From the Journey</strong> — milestones and achievements can be configured to award Skills on completion</li>
  <li><strong>From Garden Missions</strong> — relational goals pay out in Blooms</li>
  <li><strong>From your Game Master</strong> — direct grants, for recognising things the system can't see by itself</li>
</ul>
<p>Every single grant is recorded permanently, with its source and who sent it. Nothing about your Skill level is guesswork.</p>

<h2>Why It's Built This Way</h2>
<p>Because it's the honest version. A generic "points" score tells you someone is active. A Skill level tells you what they're actually good at, who thought so, and when — and it makes the Garden's colours mean something real rather than being a palette.</p>
HTML,
            ],
            [
                'title'      => 'Giving Blooms — Endorsements and Gifts',
                'slug'       => 'giving-blooms-endorsements-and-gifts',
                'section'    => 'user',
                'sort_order' => 13,
                'body'       => <<<'HTML'
<p>There are two distinct ways to recognise another player, and they're deliberately different from each other. Click anyone's node in the Garden to open their drawer, and you'll find both.</p>

<h2>Award Blooms (Endorsement)</h2>
<p>Pick a Skill, award the Blooms. This is your everyday recognition — "Maria genuinely helped me with this."</p>
<ul>
  <li>Worth <strong>2 points</strong> in the Skill you choose</li>
  <li>You can endorse <strong>the same person for the same Skill once every 24 hours</strong></li>
  <li>Beyond that limit there's no overall cap — you're not spending a finite resource</li>
</ul>
<p>The cooldown is per person <em>per Skill</em>. You can endorse the same colleague for a different Skill on the same day, and you can endorse as many different people as you like.</p>

<h2>Gift a Bloom</h2>
<p>Gifts are the scarce version, and scarcity is the point.</p>
<ul>
  <li>You start with <strong>20 Blooms to give</strong>, per Adventure</li>
  <li>Each gift is worth <strong>1 point</strong> in a Skill you choose</li>
  <li>They go <strong>one at a time</strong> — there's no way to hand over a batch</li>
  <li>Every gift asks you to confirm first, because it can't be undone</li>
  <li>You can't gift to yourself</li>
</ul>
<p>Your remaining balance shows on your own profile drawer and next to the Gift button. When you run out, the button is replaced by a plain note that you're out for now.</p>
<p>The Gift controls carry an amber accent throughout, specifically so you never confuse a limited gift with an unlimited endorsement at a glance.</p>

<h2>Running Out</h2>
<p>Twenty is intended to make you think about who deserves one. Because they're finite, a gifted Bloom carries weight an endorsement doesn't — you gave up something to send it.</p>
<p><strong>How gift Blooms are replenished is still being decided.</strong> Right now there's no automatic refill on a timer or from completing anything. Your Game Master can reset or top up your balance manually, and that's the only route today. When a refill rule is settled, this page will say so.</p>

<h2>Which Should You Use?</h2>
<p>Endorse freely — it's the low-friction way to keep recognition flowing, and the 24-hour cooldown already stops it becoming noise. Save gifts for the moments that genuinely stood out.</p>
HTML,
            ],
            [
                'title'      => 'Help Requests and Messages',
                'slug'       => 'help-requests-and-messages',
                'section'    => 'user',
                'sort_order' => 14,
                'body'       => <<<'HTML'
<p>The Garden isn't only about recognising work that already happened — it's built to get people talking in the first place.</p>

<h2>Asking For Help</h2>
<p>Post a help request and say what you're stuck on. Every request is <strong>tagged with a Skill</strong> — that's required, not optional, and it's what lets the right people find it instead of it disappearing into a general feed.</p>
<p>Requests are visible on the Help board, where anyone in your Adventure can read and reply. When someone's answer actually solves it, mark the request solved. That closes the thread and records who helped.</p>

<h2>Answering Someone Else</h2>
<p>The Help board is the fastest way to be useful to people you haven't met yet. Browse open requests, find one tagged with a Skill you hold, and reply.</p>
<p>Helping is recorded as a real interaction, which means it counts toward <a href="/docs/garden-missions">Garden Missions</a> and refreshes your connection with that person — their node returns to full colour in your Garden. And the person you helped can endorse you for it.</p>

<h2>Direct Messages</h2>
<p>You can message anyone in your Adventure one-to-one, from the Messages panel in the dock or from their profile drawer. Conversations are private between the two of you and scoped to the Adventure you're both in.</p>
<p>Unread messages show a badge on the dock button so you're not hunting for them.</p>

<h2>Everything Counts As Contact</h2>
<p>Messages, help given, endorsements, gifts, and wall posts are all logged as interactions. This is what drives the withering described in <a href="/docs/the-garden-overview">The Garden Overview</a> — any real contact with someone brings their node back to life. There's no way to "keep a relationship warm" without actually interacting, which is intentional.</p>
HTML,
            ],
            [
                'title'      => 'Garden Tasks',
                'slug'       => 'garden-tasks',
                'section'    => 'user',
                'sort_order' => 15,
                'body'       => <<<'HTML'
<p><strong>Tasks are how you improve yourself.</strong> They're the Garden's mechanic for getting better at something — build a habit, practise a skill, do the thing you said you'd do — and they pay out in your own progression: XP, BLOO, and Skill levels.</p>
<p>That's the whole difference between the two mechanics in the Garden:</p>
<ul>
  <li><strong>Tasks improve you.</strong> You get better, you level up, your Skills grow.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a> improve your Garden.</strong> You reach out to other people, and the relationships around you get healthier.</li>
</ul>
<p>The shortest version: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>

<h2>What a Task Looks Like</h2>
<p>Your Game Master writes Tasks and assigns them. Each one has instructions, a reward, and a rule about how often you can do it:</p>
<ul>
  <li><strong>Once</strong> — a one-off. Do it, claim it, done.</li>
  <li><strong>Unlimited</strong> — repeat it as often as you like.</li>
  <li><strong>Timed</strong> — repeatable, but with a cooldown between attempts. A countdown ring on the card shows exactly how long until it comes back.</li>
</ul>

<h2>How a Task Completes</h2>
<p>Some Tasks you complete yourself; others notice you did something and complete on their own:</p>
<ul>
  <li><strong>Mark it done</strong> — the honour-system version. You did the thing, you say so.</li>
  <li><strong>Scan a QR code</strong> — proof you were physically somewhere. Sometimes the code is hidden from the app on purpose, so you have to actually find the printed one.</li>
  <li><strong>Finish any Milestone</strong> — completes automatically the next time you finish anything on the Journey.</li>
  <li><strong>Finish a specific Milestone</strong> — tied to one particular piece of content.</li>
  <li><strong>Log in today</strong> — the habit mechanic. Show up, it fires, once a day.</li>
</ul>

<h2>What You Get</h2>
<p>A Task can pay XP and BLOO — the same <a href="/docs/xp-bloo-ep-explained">Journey currencies</a> everything else pays — and, separately, <a href="/docs/skills-and-blooms-explained">Blooms into one specific Skill</a>. That last part is what connects Tasks to the Garden: doing the work raises the Skill level you're actually known for, which is what colours your node.</p>

<h2>Where To Find Them</h2>
<p>Tasks live in their own panel in the Garden dock, showing what's available right now, and on their own full page if you'd rather see everything at once.</p>

<h2>Where To Go Next</h2>
<ul>
  <li><a href="/docs/garden-missions">Garden Missions</a> — the other half: growing the Garden rather than yourself</li>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a> — what the rewards actually mean</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Garden Missions',
                'slug'       => 'garden-missions',
                'section'    => 'user',
                'sort_order' => 16,
                'body'       => <<<'HTML'
<p><strong>Missions are how you improve your Garden.</strong> Where a <a href="/docs/garden-tasks">Task</a> makes <em>you</em> better, a Mission makes the <em>relationships around you</em> better — it's a nudge to reach out, connect, and do the social things you might otherwise put off. Missions pay out in <a href="/docs/skills-and-blooms-explained">Blooms</a>.</p>
<p>The shortest version: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>
<p>Missions are separate from Journey milestones — nothing on the map completes one. Only real interaction with real people does.</p>

<h2>What a Mission Asks Of You</h2>
<p>A Mission sets a target over a window of time. The wording is your Game Master's, but every Mission is one of three things:</p>
<ul>
  <li><strong>Help people who need it</strong> — often scoped to a Skill, because that's what makes it findable: <em>"help 5 other players who need Leadership help."</em> You already hold the Skill; the Mission points you at the people asking for it.</li>
  <li><strong>Build new connections</strong> — reach people you've never interacted with. <em>"Bring ten new players into your network."</em></li>
  <li><strong>Reconnect</strong> — go back to people you've drifted from. <em>"Improve 5 connections."</em> This one pairs directly with the withering: the Garden shows you a faded node, and the Mission gives you a concrete reason to do something about it.</li>
</ul>

<h2>Where Missions Come From</h2>
<p>The most important ones come from other players. When someone posts a help request in a particular Skill, that need is what a Mission is made of — real demand from a real person, matched to people who can actually meet it. Missions aren't busywork invented by the system; they're the Garden telling you where you're needed.</p>

<h2>What Isn't a Mission</h2>
<p><strong>Endorsing and gifting Blooms are never Missions.</strong> They're things you do because you mean them, not chores you get paid for — and your gift Blooms are a limited, personal thing. Nothing in the Garden will ever ask you to spend them to complete something.</p>

<h2>Tracking and Rewards</h2>
<p>Open the Missions panel from the dock to see what's active and how far along you are. Progress is measured against your real interaction history — you don't tick anything off manually, it counts what you actually did.</p>
<p>Completing a Mission awards Blooms, and can award them in a specific Skill your Game Master chooses.</p>

<h2>Finding Someone To Help</h2>
<p>Help-matching works off live supply and demand rather than a fixed list: open help requests tagged with Skills you actually hold. That means the people the Garden points you toward are people you're genuinely positioned to help.</p>

<h2>Where To Go Next</h2>
<ul>
  <li><a href="/docs/garden-tasks">Garden Tasks</a> — the other half: growing yourself rather than the Garden</li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a> — where the demand a Mission points at comes from</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Setting Up Your Skills Catalog',
                'slug'       => 'setting-up-your-skills-catalog',
                'section'    => 'setup',
                'sort_order' => 40,
                'body'       => <<<'HTML'
<p>Skills are per-Adventure and entirely yours to define. Everything in the <a href="/docs/the-garden-overview">Garden</a> — node colours, help request tags, endorsements, Mission rewards — runs off this catalogue, so it's worth setting up deliberately before players arrive.</p>
<p>You'll find it on the <strong>Manage Skills</strong> tab of your Adventure.</p>

<h2>What Each Skill Carries</h2>
<ul>
  <li><strong>Name</strong> — what players see. Use their language, not internal jargon.</li>
  <li><strong>Description</strong> — a short explanation of what the Skill actually means. This surfaces as a tooltip on skill chips in the Garden, so it's genuinely read by players, not just admin reference.</li>
  <li><strong>Colour</strong> — drives the node colour of every player whose master skill this is. Pick visibly distinct colours; this is what makes clusters legible.</li>
  <li><strong>Icon</strong> — the visual shorthand.</li>
  <li><strong>Max level</strong> — the ceiling. A broad competency might use 40; a binary capability gate uses 1.</li>
  <li><strong>Endorsable</strong> — whether players can award Blooms in this Skill to each other. Turn this <em>off</em> for gate Skills you want earned only through the Journey.</li>
</ul>

<h2>Designing a Good Catalogue</h2>
<p><strong>Write real descriptions.</strong> A Skill called "Resilience" with no explanation means whatever each player assumes. A sentence of definition makes endorsements consistent across your whole roster.</p>
<p><strong>Keep it to competencies people can recognise in each other.</strong> If a player can't tell whether a colleague demonstrated it, they won't endorse it, and the Skill stays dead.</p>
<p><strong>Use the endorsable flag properly.</strong> Broad competencies should be endorsable — that's the Garden working. Gate Skills like "Mentor", which unlock capabilities, should not be, or players can hand each other the keys.</p>
<p><strong>Give distinct colours.</strong> Twelve Skills in twelve shades of blue produces a Garden nobody can read.</p>

<h2>Renaming Rather Than Deleting</h2>
<p>If you're reworking a catalogue that's already in use, <strong>rename existing Skills instead of deleting and recreating them</strong>. Every Bloom ever awarded is tied to the Skill it was granted in — rename it and that history follows into the new name; delete it and you orphan real recognition players earned.</p>

<h2>Wiring Skills Into the Journey</h2>
<p>Milestones and achievements can both award Skills on completion — set the Skill reward when authoring them, alongside the existing XP, item, and achievement rewards. This is what connects individual progression to relational progression, and it's worth doing for your milestone content at minimum. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a>.</p>
HTML,
            ],
            [
                'title'      => 'Personalising Text with Player Tokens',
                'slug'       => 'personalising-text-with-player-tokens',
                'section'    => 'setup',
                'sort_order' => 42,
                'body'       => <<<'HTML'
<p>You can drop a player's own details straight into the text you author, so a dialogue step reads "Nice work, Sam — you're level 6" rather than something generic. These are called <strong>tokens</strong>.</p>

<h2>The Syntax</h2>
<p>Write the token in double curly braces:</p>
<ul>
  <li><code>{{ player.nickname }}</code> — inserts the player's nickname</li>
  <li><code>{{ player.nickname | Explorer }}</code> — inserts "Explorer" instead if that player has no nickname set</li>
</ul>
<p>Spaces inside the braces are optional — <code>{{player.nickname}}</code> works identically. <strong>Always use the fallback form</strong> for anything a player might not have filled in; a sentence that reads "Welcome back, !" is worse than one that says "Welcome back, Explorer!"</p>

<h2>What You Can Reference</h2>
<p>Tokens are grouped into five families:</p>
<ul>
  <li><strong><code>player.*</code></strong> — the player's own profile: nickname, name, email, and the rest of their details.</li>
  <li><strong><code>progress.*</code></strong> — live numbers for this Adventure: <code>level</code>, <code>xp</code>, <code>bloo</code>, <code>ep</code>, <code>tnl</code> (XP to next level), <code>gpa</code>, <code>completed</code>, <code>total</code>, and <code>percent</code>.</li>
  <li><strong><code>guild.*</code></strong> — their guild's <code>name</code>, <code>code</code>, <code>members</code>, <code>capacity</code>, and <code>xp</code>.</li>
  <li><strong><code>meta.*</code></strong> — any custom profile field you've configured for the Adventure. Add a field and it's immediately usable in your text, with no development work.</li>
  <li><strong><code>adventure.*</code></strong> — the Adventure's own <code>title</code> and <code>id</code>.</li>
</ul>
<p>Sensitive fields — passwords, secret codes, payment identifiers, API keys — are deliberately excluded and can never be rendered by a token, no matter how you spell it.</p>

<h2>Where Tokens Work</h2>
<ul>
  <li>Step content, across every step type — dialogue, open text, puzzles, branch choices, and the rest</li>
  <li>Item descriptions, in the Item Shop and in a player's backpack</li>
  <li>Challenge success messages</li>
</ul>

<h2>Worked Examples</h2>
<ul>
  <li><code>Welcome back, {{ player.nickname | Explorer }}.</code></li>
  <li><code>You're level {{ progress.level }} with {{ progress.tnl }} XP to the next one.</code></li>
  <li><code>{{ guild.name | Your guild }} has {{ guild.members }} members.</code></li>
  <li><code>You've finished {{ progress.completed }} of {{ progress.total }} milestones ({{ progress.percent }}%).</code></li>
</ul>

<h2>If You Migrated From the WordPress Version</h2>
<p>The old <code>[player_data field="..."]</code> shortcode still resolves, so existing content keeps working — you don't have to rewrite anything to migrate. New content should use the <code>{{ }}</code> form, which reaches progress, guild, meta, and adventure values the old shortcode never could.</p>
<p>If you previously saw the literal text <code>[player_data field="player_nickname"]</code> appearing to players instead of their name, that's fixed — those steps now render the real value.</p>

<h2>A Note on Safety</h2>
<p>Token values are escaped automatically when they're inserted. A player whose nickname contains stray characters or markup can't break your page layout or inject anything into it — you can use tokens freely in any text without worrying about what someone typed into their profile.</p>
HTML,
            ],
            [
                'title'      => 'Running the Garden as a GM',
                'slug'       => 'running-the-garden-as-a-gm',
                'section'    => 'setup',
                'sort_order' => 41,
                'body'       => <<<'HTML'
<p>Once your <a href="/docs/setting-up-your-skills-catalog">Skills catalogue</a> exists, the Garden largely runs itself — players endorse, gift, ask for help, and answer each other. This page covers the levers you hold.</p>

<h2>Tasks or Missions?</h2>
<p>The two mechanics are not interchangeable, and picking the wrong one is the most common way a Garden goes flat:</p>
<ul>
  <li>Author a <strong>Task</strong> when you want a player to <em>improve themselves</em> — build a habit, practise something, show up, do the work. Tasks pay XP, BLOO, and Blooms into a Skill.</li>
  <li>Author a <strong>Mission</strong> when you want a player to <em>improve their Garden</em> — reach out, connect, help somebody. Missions pay Blooms.</li>
</ul>
<p>Helping themselves is a Task; helping others is a Mission. If you find yourself writing a Mission that a player could complete alone, it should have been a Task.</p>

<h2>Authoring Garden Missions</h2>
<p>A Mission is a relational goal with a target count and a time window, paid in Blooms and optionally into a specific Skill. Progress evaluates against players' real interaction history automatically, so you're not marking anything off by hand.</p>

<h3>The three kinds worth writing</h3>
<ul>
  <li><strong>Help given</strong> — "help 5 players who need Leadership help." The strongest Mission type, because the demand is real: it points players at help requests other players actually posted.</li>
  <li><strong>Connections created</strong> — "bring ten new people into your network." Use this to break open a cohort that's only talking to people it already knows.</li>
  <li><strong>Reconnection</strong> — "improve 5 connections." Pairs with the withering; only worth running once there's genuine drift to correct, which usually means a few weeks in.</li>
</ul>

<h3>Do not author endorsement or gifting Missions</h3>
<p>The builder currently offers <em>"Endorse someone"</em> as an auto-tracked rule. <strong>Don't use it.</strong> Endorsing and gifting should happen because a player means it, not because a Mission is paying them to — and gift Blooms are a limited personal balance, so a Mission that spends them turns a gesture into a transaction. This is a deliberate product decision, not a limitation: gifting isn't offered as a rule type for exactly the same reason.</p>

<h3>A practical starting set</h3>
<p>One low-target help-given Mission to teach the mechanic and seed the Help board, one connections Mission once the cohort has settled, and one reconnection Mission a few weeks in. Missions that ask for more social effort than your cohort's size supports will just sit there uncompleted.</p>

<h2>Gift Bloom Balances</h2>
<p>Every player starts with 20 giftable Blooms per Adventure, created automatically the first time they open their Garden — there's no roster setup step.</p>
<p>From a player's drawer you can <strong>reset or top up their balance</strong> to any amount. This is currently the <em>only</em> way gift Blooms are replenished — there's no automatic refill rule yet, by design, because the right rule hasn't been settled. If you're running a long Adventure, plan on a periodic manual top-up, or brief players that their 20 are meant to last.</p>

<h2>Granting Skills Directly</h2>
<p>You can award Skill points to any player directly from their drawer. Use this for things the system genuinely can't observe — excellent work in a workshop, leadership during a live event, contributions that happened off-platform.</p>
<p>Direct grants are recorded with you as the source, exactly like any other grant, so the audit trail stays honest.</p>

<h2>What To Watch</h2>
<ul>
  <li><strong>A grey Garden</strong> means people aren't interacting at all — usually a sign the Adventure needs a reason for them to, not that the Garden is broken.</li>
  <li><strong>One colour dominating</strong> means your catalogue is too narrow, or one Skill is far easier to earn than the rest.</li>
  <li><strong>An empty Help board</strong> usually means nobody's been shown it. Seed it with a Mission.</li>
  <li><strong>Endorsements clustering inside guilds</strong> is normal early on. Connection and re-engagement Missions are the tool for breaking cliques open.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/setting-up-your-skills-catalog">Setting Up Your Skills Catalog</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit</a></li>
</ul>
HTML,
            ],
        ];

        foreach ($pages as $page) {
            $existing = $this->db->table('docs_pages')->where('slug', $page['slug'])->get()->getRow();

            $page['status']     = 'published';
            $page['updated_at'] = $now;

            if ($existing) {
                $this->db->table('docs_pages')->where('slug', $page['slug'])->update($page);
            } else {
                $page['created_at'] = $now;
                $this->db->table('docs_pages')->insert($page);
            }
        }
    }
}
