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
        $this->db->table('docs_pages')->whereIn('slug', ['using-the-platform', 'onboarding-and-billing'])->delete();

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
<p>BLUERABBIT wraps your learning content in a real game engine: a Journey Map of quests, a three-currency reward system (XP/BLOO/EP), achievements, and Guilds. Quests come in five types — Quest, Challenge, Survey, Mission, and Social — each built from reusable Steps like dialogue, open text, puzzles, and SCORM packages.</p>
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
<p>Open an Adventure and you'll land on the <strong>Journey Map</strong> — a visual layout of every quest in the program. Nodes are locked, available, or finished depending on what you've already done. A HUD widget in the corner tracks your XP, BLOO, and EP as you go.</p>
<p>Not sure what those three mean yet? Start with <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a> — it's the fastest way to understand how progress works here.</p>

<h2>Where to Go Next</h2>
<ul>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — reading node states and Tabis</li>
  <li><a href="/docs/completing-quests-and-steps">Completing Quests &amp; Steps</a> — what you'll actually be doing</li>
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
<p>XP only ever goes up. You earn it from completing quests, steps, and achievements, and it drives your <strong>Level</strong> against a threshold table your organization sets. Leveling up can unlock new content on the Journey Map and can trigger achievements automatically — it's your clean, at-a-glance answer to "how am I doing?"</p>

<h2>BLOO — Your Spendable Currency</h2>
<p>BLOO is the opposite of XP: it goes up and down. You earn it as a quest or achievement reward, then spend it in the <strong>Item Shop</strong> on consumables, keys, and rewards — or use it to unlock a milestone early instead of waiting on a prerequisite. Think of it as your answer to "what can I do right now?"</p>

<h2>EP — Energy Points</h2>
<p>EP gates <strong>Random Encounters</strong> (pop-up quiz or challenge events) and <strong>Objectives</strong>. Everyone starts with 100, and the cap scales up with your level. If you run out, you'll see a prompt to recharge before you can continue — usually via the lightning-bolt icon in the top corner of the map.</p>

<h2>How They Work Together</h2>
<p>A typical loop looks like: complete a quest → earn XP (progress) and BLOO (currency) → spend some BLOO in the shop or save it to unlock something early → keep an eye on EP so you don't get locked out of an Encounter mid-session. None of the three substitutes for another — that separation is deliberate, so "am I progressing" and "what can I afford" never get muddled into one number.</p>
HTML,
            ],
            [
                'title'      => 'The Journey Map',
                'slug'       => 'journey-map-guide',
                'section'    => 'user',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>The Journey Map is the visual heart of every Adventure — a zoomable, pannable canvas where every quest shows up as a milestone node.</p>

<h2>Reading the Map</h2>
<p>Pan and zoom to explore. Each node represents one quest, positioned deliberately by whoever built the Adventure — the layout itself is often part of the story (a path, a skill tree, a level progression).</p>

<h2>Tabis — Map Chapters</h2>
<p>Nodes are grouped under <strong>Tabis</strong> — decorative chapter layers that can be locked behind their own prerequisites, independent of individual quest unlock rules. A Tabi might represent "Week 1," "Module 3," or a themed act in the story. When a Tabi is locked, everything inside it is hidden or greyed out until you meet its requirement.</p>

<h2>Node States</h2>
<p>Every quest resolves to exactly one status at any given moment:</p>
<ul>
  <li><strong>Finished</strong> — you've completed it.</li>
  <li><strong>Available</strong> — unlocked and ready to start.</li>
  <li><strong>Locked</strong> — you haven't met the requirement yet (level, prerequisite quest, item, or achievement).</li>
  <li><strong>Blocked</strong> — locked by something outside the normal unlock chain (often a facilitator gate).</li>
  <li><strong>Future</strong> — visible, but not open yet (usually date-gated).</li>
  <li><strong>Expired</strong> — the window to complete it has closed.</li>
</ul>

<h2>Map Widgets</h2>
<p>Two live widgets are common on the map: a <strong>player status HUD</strong> showing your current XP/BLOO/EP, and a <strong>leaderboard</strong> ranking players or guilds in real time. Purely decorative "journey assets" are sometimes scattered around too, just to sell the theme.</p>
HTML,
            ],
            [
                'title'      => 'Completing Quests & Steps',
                'slug'       => 'completing-quests-and-steps',
                'section'    => 'user',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<p>Quests are the core content unit in BLUERABBIT. Each one is built from smaller pieces called Steps, completed in order.</p>

<h2>The Five Quest Types</h2>
<ul>
  <li><strong>Quest</strong> — open text submission.</li>
  <li><strong>Challenge</strong> — a quiz-style test.</li>
  <li><strong>Survey</strong> — feedback collection, usually no right/wrong answer.</li>
  <li><strong>Mission</strong> — a read-only briefing, no submission required.</li>
  <li><strong>Social</strong> — an external action, like sharing something to a social platform.</li>
</ul>

<h2>Step Types You'll Encounter</h2>
<p>Quests unlock as a whole, but you work through them one Step at a time. Steps can carry their own XP/BLOO/EP/item/achievement rewards independent of the parent quest. Common types:</p>
<ul>
  <li><strong>Dialogue</strong> — a character speaking to you.</li>
  <li><strong>Open text</strong> — free-form writing, sometimes AI-reviewed for instant feedback.</li>
  <li><strong>Multiple-choice</strong> — pick the right answer(s).</li>
  <li><strong>Puzzle</strong> — a drag-and-drop image puzzle.</li>
  <li><strong>SCORM</strong> — an embedded SCORM package with completion tracking.</li>
  <li><strong>Keyphrase</strong> — type a specific keyword to proceed.</li>
  <li><strong>Branch-choice / Path-choice</strong> — your answer changes what comes next.</li>
  <li><strong>Find-item</strong> — locate and use an item from your Backpack.</li>
  <li><strong>Cryptex</strong> — a code-based unlock, like a combination lock.</li>
  <li><strong>Audio / Upload-image / Upload-video</strong> — media-based responses.</li>
  <li><strong>Gallery</strong> — display-only, nothing to complete.</li>
</ul>

<h2>AI-Assisted Feedback</h2>
<p>On Open Text steps, if your organization has enabled it, your answer gets reviewed for instant feedback you can revise against before moving on — useful for practicing a skill rather than just being graded once.</p>

<h2>Quick-Complete via QR Code</h2>
<p>Some quests carry a scannable QR code that completes them directly, bypassing the normal prerequisite chain entirely. You'll typically see this at in-person events or bootcamp sessions — scan, done, move to the next station.</p>
HTML,
            ],
            [
                'title'      => 'Achievements & Guilds',
                'slug'       => 'achievements-and-guilds',
                'section'    => 'user',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<h2>Earning Achievements</h2>
<p>Achievements come in three types — <strong>Achievement</strong> (a one-off milestone), <strong>Path</strong> (part of a themed series), and <strong>Rank</strong> (a status tier, shown with extra decorative framing on your profile). They're displayed as hexagonal badges and can carry their own XP/BLOO rewards. Most are awarded automatically when you hit a trigger — leveling up, finishing a quest chain — though a facilitator can also grant one manually.</p>

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
  <li><strong>Key</strong> — unlocks something specific, like a gated quest.</li>
  <li><strong>Reward</strong> — a keepsake with no functional unlock, just for collecting.</li>
</ul>

<h2>Buying From the Shop</h2>
<p>Items are priced in BLOO and can be level-gated — some won't even show up in the shop until you've hit a certain Level. Spend the BLOO you've earned from quests and achievements here, or hold onto it if you're saving for something specific.</p>

<h2>Your Backpack</h2>
<p>Anything you buy or find through a quest lands in your Backpack. From there you can use a Key item on the quest it unlocks, or a Consumable whenever you need it — nothing gets used automatically without your say-so.</p>
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
<p>A blank Adventure gives you a clean Journey Map to design from zero. Starting from a template pre-populates quests, steps, and rewards you can edit rather than build from nothing — useful if you're repeating a similar program (see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a> for how this really pays off at scale).</p>

<h2>Add Quests to the Journey Map</h2>
<p>Place quest nodes on the map and choose a type for each — Quest, Challenge, Survey, Mission, or Social (see <a href="/docs/completing-quests-and-steps">Completing Quests &amp; Steps</a> for what each one means from the player's side). Group related quests under a Tabi if you want a chaptered structure with its own unlock gate.</p>

<h2>Configure Step Types</h2>
<p>Inside each quest, build out the Steps players will actually work through — dialogue, open text, multiple-choice, puzzles, SCORM packages, and more. Steps run in order, and each can carry its own reward independent of the quest's overall reward.</p>

<h2>Set Rewards & Unlock Rules</h2>
<p>Decide what a quest pays out in XP, BLOO, and (optionally) items or achievements, then set what has to be true for it to unlock — a minimum level, a prerequisite quest, an item in the player's Backpack, or a start date.</p>

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
  <li><strong>GM (Game Master)</strong> — a facilitator. Can grant achievements manually, unblock quests, and monitor progress without full admin access.</li>
  <li><strong>Admin</strong> — full edit access to the Adventure: quests, steps, rewards, settings.</li>
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
<p>Any Adventure can be marked as a template. A template isn't meant to be run directly — it exists so you can spin off <strong>child Adventures</strong> that inherit its quests, steps, and rewards, ready to run for a specific group.</p>

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
<p>See how players move through your Adventure step by step — where most people start, and exactly which quest tends to lose them. This is usually the fastest way to spot a confusing or too-difficult step.</p>

<h2>Engagement Metrics</h2>
<p>Track login frequency, average session length, and active-player counts over time. Useful for telling the difference between "everyone finished it once and left" and "people keep coming back."</p>

<h2>Completion Analytics</h2>
<p>Per-quest and overall completion rates, broken down by cohort or guild if you're using them — helpful for comparing how different groups are progressing through the same content.</p>

<h2>Using This to Improve Your Adventure</h2>
<p>The dashboard is most useful as a feedback loop, not just a report: find the quest with the biggest drop-off, revisit its difficulty or clarity, republish, and watch the funnel next time. Small adjustments to unlock requirements or step difficulty often move the numbers more than a full content rewrite.</p>
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
                'title'      => 'Designing Quests: Types, Rewards & Unlock Rules',
                'slug'       => 'designing-quests-types-rewards-and-unlocks',
                'section'    => 'setup',
                'sort_order' => 7,
                'body'       => <<<'HTML'
<p>A quest is the unit of design in BLUERABBIT — the thing you're actually placing on the Journey Map. Before you touch a single Step, decide what kind of quest you're building and what it takes to unlock and complete it.</p>
<p><em>Examples in this guide are drawn from a single running example — see <a href="/docs/meet-launch-week-example-adventure">Meet "Launch Week"</a> for the adventure referenced throughout.</em></p>

<h2>The Five Quest Types, and When to Use Each</h2>
<ul>
  <li><strong>Quest</strong> — open text submission. Use it when you want a real answer in the player's own words: a reflection, a plan, a written exercise.</li>
  <li><strong>Challenge</strong> — a timed or untimed quiz. Use it to test recall or comprehension with a right answer, and set a pass threshold.</li>
  <li><strong>Survey</strong> — questions with no right answer. Use it for feedback, pulse checks, or "tell us about yourself" onboarding questions — results aggregate, they don't get graded.</li>
  <li><strong>Mission</strong> — read-only. No submission at all, just content to absorb before the map lets you move on. The lightest-weight quest type there is.</li>
  <li><strong>Social</strong> — an external action, like sharing something publicly. Use sparingly; it's the one quest type that depends on something happening outside the platform.</li>
</ul>

<h2>Setting the Unlock Requirements</h2>
<p>Every quest can require any combination of: a minimum player level, one or more prerequisite quests already completed, possession of a specific item, an earned achievement, and a window of availability (a start date and/or a deadline). Nothing is unlocked by default except what you explicitly leave open — an empty requirement set means "available from day one."</p>

<h2>Rewards: XP, BLOO, and Beyond</h2>
<p>Set what a quest pays out on completion — XP, BLOO, and optionally a badge image shown on the milestone, an item, or an achievement. A quest can hand out all of these at once. Keep the XP curve roughly consistent across quests of similar effort, or leveling will feel arbitrary to players comparing notes.</p>

<h2>Deadlines, Start Dates & Paying to Skip the Wait</h2>
<p>A quest can be date-gated on both ends — not visible until a start date, expired after a deadline. You can also set a BLOO cost that lets a player buy their way past a deadline or unlock cost early, if you want urgency to be a soft rather than hard wall.</p>

<h2>Grading Modes</h2>
<p>Quests can grade as simple completion, a percentage, or letter grades, depending on what fits your program. Challenges add their own layer on top: how many questions get shown per attempt, how many correct answers count as a win, a time limit, and whether extra attempts beyond the free allotment cost BLOO.</p>

<p><strong>Where to go next:</strong> <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> — once the quest shell exists, this is what you actually fill it with.</p>
HTML,
            ],
            [
                'title'      => 'The Full Step Library — Choosing the Right Step for the Moment',
                'slug'       => 'full-step-library-choosing-the-right-step',
                'section'    => 'setup',
                'sort_order' => 8,
                'body'       => <<<'HTML'
<p>Steps are the moment-to-moment content inside a quest — the thing a player is actually looking at. A quest can chain as many as you like, in order, and each one can carry its own reward on top of whatever the quest pays out.</p>

<h2>Content vs. Interaction Steps</h2>
<p>Some step types exist purely to deliver content (dialogue, gallery, audio); others require the player to do something before they can advance (open text, multiple-choice, puzzle). A well-paced quest usually alternates the two — a beat of story or explanation, then a beat that asks something of the player.</p>

<h2>The Full List</h2>
<ul>
  <li><strong>Dialogue</strong> — a character speaks. Set a name, portrait, and background to give it a voice; players just read and advance.</li>
  <li><strong>Open</strong> — free text entry. Set a minimum word/link/image count if you want a real answer, not a one-liner. Pairs well with AI-assisted feedback (see <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>).</li>
  <li><strong>Multiple-choice</strong> — pick an answer. The fastest way to check comprehension without writing a full Challenge quest.</li>
  <li><strong>Puzzle</strong> — a drag-and-drop image puzzle. Good for a change of pace mid-adventure; low information density, high engagement.</li>
  <li><strong>SCORM</strong> — embeds an existing SCORM package and tracks its completion. Use this to fold in content you already built in another authoring tool instead of rebuilding it.</li>
  <li><strong>Keyphrase</strong> — the player types a specific word or phrase to proceed. Great for in-person events: reveal the phrase on a slide or a physical prop.</li>
  <li><strong>Branch-choice</strong> — the player's pick sends them down a different path. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</li>
  <li><strong>Path-choice</strong> — similar idea, framed as choosing a track (e.g. "Engineering" vs. "Sales") rather than a single fork.</li>
  <li><strong>Find-item</strong> — the player picks up a virtual item, often as a reward beat with no real "test."</li>
  <li><strong>Cryptex</strong> — a code-based combination lock. Pairs naturally with a puzzle or scavenger-hunt framing.</li>
  <li><strong>Audio</strong> — plays a clip; the player confirms they listened before advancing.</li>
  <li><strong>Upload-image / Upload-video</strong> — the player submits media instead of text. Use for anything you need to see or hear to grade, not just read.</li>
  <li><strong>Gallery</strong> — display-only, nothing to complete. Useful for a recap or a "here's what everyone submitted" moment.</li>
</ul>

<h2>Branching From a Step</h2>
<p>Steps can carry their own buttons that jump the player to a different step or quest, hand them an item, or require one before continuing — this is what makes non-linear pacing possible below the quest level, not just between quests.</p>

<h2>Per-Step Rewards</h2>
<p>Any step can hand out its own XP, BLOO, EP, item, or achievement, independent of the quest's overall reward. Use small per-step rewards to keep a long quest feeling alive along the way, and save the bigger payout for the quest's completion.</p>

<h2>Making a Step Optional</h2>
<p>Mark a step as not required and players can skip it without blocking their progress — useful for bonus content, an optional deep-dive, or anything that enriches the experience without gating it.</p>
HTML,
            ],
            [
                'title'      => 'Achievements, Paths & Ranks — Designing Your Reward Ladder',
                'slug'       => 'achievements-paths-and-ranks-reward-ladder',
                'section'    => 'setup',
                'sort_order' => 9,
                'body'       => <<<'HTML'
<p>Achievements are how you recognize progress beyond raw XP — a badge on a profile, a visible marker of what someone has actually done. As a GM, you're designing three distinct tools here, not one.</p>

<h2>Three Tools, Three Jobs</h2>
<ul>
  <li><strong>Achievement</strong> — a one-off milestone. "Finished onboarding," "Perfect score on the compliance quiz." Awarded once, doesn't imply anything came before or after it.</li>
  <li><strong>Path</strong> — part of a themed series. Use paths when you want players collecting a set — "completed 3 of 5 modules in the Leadership track."</li>
  <li><strong>Rank</strong> — a status tier, shown with extra framing on a player's profile. Use ranks when progress itself is the reward — Bronze/Silver/Gold, Associate/Senior/Lead — something that visibly upgrades as a player advances.</li>
</ul>

<h2>Automatic Triggers vs Manual Grants</h2>
<p>Most achievements should fire automatically — on a level-up, a quest chain completing, or a specific quest finishing. Set the trigger once and forget it. You can also grant one manually, which is worth reserving for genuinely human moments: recognizing a standout contribution, a live event, something a rule can't detect.</p>

<h2>Designing a Rank Ladder</h2>
<p>If you're using ranks, decide the tier count up front — three to five works well for most programs, more than that and the distinctions stop feeling meaningful. Tie each tier to a real, visible threshold (a level, a set of completed quests) so players can always see the next rung and what it takes to reach it.</p>

<h2>Badge &amp; Color Design Tips</h2>
<p>Achievements render as hexagonal badges, so simple, high-contrast icon designs read best at small sizes. Reuse your Adventure's accent color for the badge border to keep the whole reward system feeling like one coherent visual language rather than a grab-bag of clip art.</p>

<p><strong>Where to go next:</strong> <a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a>, if part of your reward design is social or team-based.</p>
HTML,
            ],
            [
                'title'      => 'Guilds — Designing Team Play',
                'slug'       => 'guilds-designing-team-play',
                'section'    => 'setup',
                'sort_order' => 10,
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
                'sort_order' => 11,
                'body'       => <<<'HTML'
<p>The Item Shop turns BLOO from a score into an economy — a reason to keep earning it beyond the number going up. As the GM, you're the one who decides what's actually for sale.</p>

<h2>The Three Item Types, Revisited for GMs</h2>
<ul>
  <li><strong>Consumable</strong> — used once and gone. Hints, extra Challenge attempts, EP recharges. Design these as small conveniences, not power that trivializes your content.</li>
  <li><strong>Key</strong> — unlocks something specific, usually a gated quest. This is your soft-lock design tool: instead of a hard prerequisite, make a milestone purchasable.</li>
  <li><strong>Reward</strong> — a keepsake with no functional effect, just for collecting. Cosmetic items are underrated for player motivation — not everything needs a mechanical purpose.</li>
</ul>

<h2>Pricing With BLOO</h2>
<p>Price items relative to how much BLOO a typical player has actually earned by the point they'd realistically want the item — a shop full of things nobody can afford yet reads as broken, not aspirational.</p>

<h2>Level-Gating &amp; Secret Items</h2>
<p>Items can require a minimum level to appear in the shop at all, and can carry a "secret" badge state — hidden until discovered, which is a good fit for anything meant to feel like an easter egg rather than a storefront listing.</p>

<h2>Keys as Soft Puzzle Locks</h2>
<p>Because a Key item can gate a quest the same way a prerequisite does, you can design a moment where players have to earn or buy their way to a Key, then actively use it from their Backpack — a small extra bit of friction and ceremony compared to a milestone that just silently unlocks.</p>

<h2>Tuning Your Economy</h2>
<p>Watch how fast BLOO accumulates versus how fast the shop drains it. If nobody's buying anything, prices are probably too high relative to earn rate, or the items on offer aren't compelling; if everyone maxes out the shop immediately, consider adding a higher-tier item or two so BLOO stays meaningful later in the Adventure too.</p>
HTML,
            ],
            [
                'title'      => 'Branching & Prerequisites — Building Non-Linear Adventures',
                'slug'       => 'branching-and-prerequisites-non-linear-adventures',
                'section'    => 'setup',
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>Not every Adventure needs to be a straight line. BLUERABBIT gives you two related but distinct tools for building forks: prerequisite rules that gate a quest, and branch steps that redirect a player mid-quest.</p>

<h2>Prerequisite Rules: Quest, Item, or Achievement</h2>
<p>Any quest's unlock condition can point at a prerequisite quest, a required item, or a required achievement — and you can stack more than one. This is the tool for "you can't get here without having done that," whether "that" is content, currency, or recognition.</p>

<h2>Branch-Choice vs Path-Choice Steps</h2>
<p>A <strong>branch-choice</strong> step is a single fork — the player's answer sends them to one of several specific next steps or quests. A <strong>path-choice</strong> step is the same idea framed as choosing an entire track up front — "pick your role," "pick your specialization" — that then colors which quests they see from that point on. Use branch-choice for a one-off narrative fork; use path-choice when the whole rest of the Adventure should feel tailored to the pick.</p>

<h2>Locking a Quest Until a Branch Is Chosen</h2>
<p>A quest can be set to stay locked until the player has made a specific branch choice earlier in the Adventure — useful when later content genuinely only makes sense in the context of the path taken, rather than being available to everyone regardless of their earlier choices.</p>

<h2>Designing a Believable Fork</h2>
<p>The best branches are ones where both paths feel intentional, not like one is the "real" content and the other a stub. If you don't have time to build both sides of a fork fully, it's usually better to cut it to a single path than ship a branch that's obviously thinner on one side — players notice.</p>
HTML,
            ],
            [
                'title'      => 'Random Encounters & Blockers — Keeping Players on Their Toes',
                'slug'       => 'random-encounters-and-blockers',
                'section'    => 'setup',
                'sort_order' => 13,
                'body'       => <<<'HTML'
<h2>Random Encounters — Pop-Up Moments</h2>
<p>An Encounter is a quiz or challenge that can interrupt a player's session unprompted — a pop-up moment rather than something sitting on the map waiting to be clicked. Use these sparingly for a spike of surprise and engagement; too many and they start to feel like an interruption rather than a delight.</p>

<h2>Spending EP on Encounters</h2>
<p>Encounters are gated by Energy Points — a player needs EP available to trigger or respond to one. This is the main reason EP exists as its own currency: it naturally rate-limits how often a player is pulled into an unplanned moment, no matter how the Encounter itself is configured.</p>

<h2>Blockers — Pay-to-Pass Gates</h2>
<p>A Blocker sits on a pathway and requires BLOO to get past, independent of the normal prerequisite chain. Where a locked quest says "you haven't earned this yet," a Blocker says "you can buy your way past this if you'd rather not wait" — a softer, currency-based obstacle instead of a hard requirement.</p>

<h2>When to Reach for Each</h2>
<p>Use an Encounter when you want a moment of unpredictability inside an otherwise planned path. Use a Blocker when you want a real economic decision — spend now, or do the thing that earns it instead. Both are optional layers; a straightforward Adventure with neither is a completely valid, often clearer, design.</p>
HTML,
            ],
            [
                'title'      => 'QR Codes — Live & Hybrid Event Checkpoints',
                'slug'       => 'qr-codes-live-and-hybrid-events',
                'section'    => 'setup',
                'sort_order' => 14,
                'body'       => <<<'HTML'
<h2>What a Quest QR Code Actually Does</h2>
<p>Every quest can generate a unique, scannable QR code. Scanning it completes that quest directly for the player who scans it — bypassing every other unlock rule the quest would normally check. It's the one mechanic in BLUERABBIT explicitly designed to skip the rest of the system.</p>

<h2>Generating and Printing Codes</h2>
<p>Generate the code from the quest itself once it's built, then print or display it wherever the checkpoint physically lives — a station at a bootcamp, a poster at an office onboarding day, a slide at the end of a live session.</p>

<h2>Good Use Cases</h2>
<ul>
  <li>An in-person orientation day, where "you showed up and scanned in" should count as completion on its own.</li>
  <li>A scavenger-hunt-style Adventure where physical locations map to Journey Map milestones.</li>
  <li>A live event wrap-up quest that's meant to be quick and ceremonial, not another writing assignment.</li>
</ul>

<h2>What It Skips (and Why That's OK Sometimes)</h2>
<p>Because a QR scan ignores level requirements, prerequisites, and deadlines, it's not the right tool for anything you actually want gated. Reserve it for quests where "being physically present and scanning" is itself the entire point — a deliberate shortcut, not a workaround for content you didn't have time to build unlock rules for.</p>
HTML,
            ],
            [
                'title'      => 'Grading & AI-Assisted Feedback — Reviewing Player Submissions',
                'slug'       => 'grading-and-ai-assisted-feedback',
                'section'    => 'setup',
                'sort_order' => 15,
                'body'       => <<<'HTML'
<h2>What Needs Grading, and What Doesn't</h2>
<p>Missions and Dialogue steps need nothing from you — they complete on their own. Surveys aggregate without a right answer. Challenges self-grade against the answers you set. The place a GM's actual review time goes is Quests and Open text steps — real written submissions from real players.</p>

<h2>Setting Submission Requirements</h2>
<p>Before grading anything, set the bar at the quest level: a minimum word count, and optionally a minimum number of links or images if you want players to cite sources or show work rather than write a one-line answer. Submissions below the bar simply can't be sent — you never see the half-effort version.</p>

<h2>Turning On AI-Assisted Feedback</h2>
<p>If your Adventure has an AI API key configured, Open text steps can get an automatic first pass of feedback before a player even submits to you — they can revise and resubmit against that feedback on their own. This doesn't replace your judgment on the final grade; it just means what reaches you has usually already had one round of self-correction.</p>

<h2>Your Review Queue</h2>
<p>Submissions land against the quest, carrying the player's text and, if you're using graded quests, a grade you assign — completion, percentage, or letter, matching whatever grading mode you set when you designed the quest. Work through submissions per-quest rather than per-player if you're grading a cohort — it's easier to stay consistent when you're comparing several answers to the same prompt back to back.</p>
HTML,
            ],
            [
                'title'      => 'Announcements — Keeping an Adventure Alive Between Sessions',
                'slug'       => 'announcements-keeping-an-adventure-alive',
                'section'    => 'setup',
                'sort_order' => 16,
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
                'sort_order' => 17,
                'body'       => <<<'HTML'
<p>Everything above in one build. This walks through designing "Launch Week" — a two-week new-hire onboarding Adventure for a mid-sized company — touching nearly every feature covered in this guide, in the order a GM would actually reach for them.</p>

<h2>The Brief</h2>
<p>Forty new hires across three departments, starting the same Monday. Goal: get everyone through company basics, department-specific training, and one in-person orientation day, with enough structure that HR can see who's on track without babysitting anyone.</p>

<h2>Day 1 — The Map &amp; the First Quests</h2>
<p>Start from a blank Adventure rather than a template — this program is specific enough to build fresh. Lay out the Journey Map in two Tabis: "Week One: Company Basics" and "Week Two: Department Deep-Dive," with Week Two locked until Week One's core quests are finished. Add a <strong>Mission</strong> quest first ("Welcome to the Company") — pure read-only content, zero friction on day one.</p>

<h2>Building the Steps</h2>
<p>Inside the welcome Mission: a <strong>Dialogue</strong> step introducing the CEO character, then a <strong>Gallery</strong> step showing the office and team photos. The next quest, a <strong>Quest</strong>-type ("Tell Us About You"), uses an <strong>Open</strong> text step with a 50-word minimum, plus an <strong>Upload-image</strong> step for a profile photo. A short <strong>Challenge</strong> quest on company policy follows, built from <strong>Multiple-choice</strong> steps with a pass threshold of 80%.</p>

<h2>Rewards, Ranks &amp; the Shop</h2>
<p>Every quest pays XP and a little BLOO. Three <strong>Rank</strong> achievements track overall progress — New Hire → Onboarded → Launch-Ready — each triggering automatically at a level threshold. The Item Shop carries a handful of <strong>Consumable</strong> items (an extra Challenge attempt) and one <strong>Reward</strong> item (a cosmetic company-swag badge) — nothing that trivializes the actual content.</p>

<h2>Guilds for the Cohort</h2>
<p>All forty new hires get bulk-enrolled with guild assignment by department — three guilds, capacity roughly even. A department-level leaderboard turns "finish onboarding" into a bit of friendly competition without pitting individuals against each other.</p>

<h2>The Branch: Choose Your Track</h2>
<p>Week Two opens with a <strong>Path-choice</strong> step — Engineering, Sales, or Operations — and every quest from that point on is prerequisite-gated to the matching track, so nobody wades through training content irrelevant to their actual role.</p>

<h2>The In-Person Checkpoint (QR Code)</h2>
<p>Wednesday of Week One is an in-person orientation day. The "Attended Orientation" quest exists purely as a QR code checkpoint at the door — scan on the way in, quest complete, no submission required. It's the one deliberate bypass in the whole design, and it's the right call here.</p>

<h2>Keeping It Alive Week Two</h2>
<p>An announcement posts the moment Week One's Tabi fully unlocks Week Two for the cohort, and a second one midway through calls out the department leaderboard standings. Open-text submissions in Week Two get AI-assisted feedback turned on, so HR is reviewing already-revised answers instead of first drafts.</p>

<h2>What Shipped</h2>
<p>Two Tabis, roughly a dozen quests, every quest type used at least once, a rank ladder, three guilds, a small shop, one branch, one QR checkpoint, and two announcements — built and published before the Monday start date, ready to hand off to HR without a single line of code.</p>
HTML,
            ],
            [
                'title'      => 'Step Type Quick Reference',
                'slug'       => 'step-type-quick-reference',
                'section'    => 'setup',
                'sort_order' => 18,
                'body'       => <<<'HTML'
<p>A fast lookup for every step type available inside a quest. See <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> for the fuller explanation of each.</p>

<ul>
  <li><strong>Dialogue</strong> — character speaks; read and advance. No submission.</li>
  <li><strong>Open</strong> — free text; supports word/link/image minimums and AI-assisted feedback.</li>
  <li><strong>Multiple-choice</strong> — pick an answer; fastest comprehension check.</li>
  <li><strong>Puzzle</strong> — drag-and-drop image puzzle; pacing/engagement beat.</li>
  <li><strong>SCORM</strong> — embeds an existing SCORM package; tracks completion.</li>
  <li><strong>Keyphrase</strong> — type a specific word/phrase; good for live events.</li>
  <li><strong>Branch-choice</strong> — one-off fork to a different step or quest.</li>
  <li><strong>Path-choice</strong> — choose a whole track for the rest of the Adventure.</li>
  <li><strong>Find-item</strong> — player picks up a virtual item; usually a reward beat.</li>
  <li><strong>Cryptex</strong> — code-based combination lock.</li>
  <li><strong>Audio</strong> — plays a clip; player confirms listening.</li>
  <li><strong>Upload-image / Upload-video</strong> — media submission instead of text.</li>
  <li><strong>Gallery</strong> — display-only; nothing to complete.</li>
</ul>

<p>Any step can be marked optional (players may skip it), and any step can carry its own XP/BLOO/EP/item/achievement reward on top of the quest's overall payout.</p>
HTML,
            ],

            // ---------------------------------------------------------
            // Setup docs, phase 2 (2026-07-28, same day) — a running
            // example adventure threaded through the manual, plus the
            // remaining feature areas: Challenges/Surveys as their own
            // deep dive, the event Schedule, SCORM, and email campaigns
            // to enrolled players (distinct from this website's own
            // waitlist/Resend module — different system entirely).
            // Concept + how-to pairing per Bernardo's follow-up.
            // ---------------------------------------------------------
            [
                'title'      => 'Meet "Launch Week" — Our Running Example Adventure',
                'slug'       => 'meet-launch-week-example-adventure',
                'section'    => 'setup',
                'sort_order' => 19,
                'body'       => <<<'HTML'
<p>Several pages in this manual reference the same fictional adventure so examples stay consistent instead of jumping between unrelated scenarios each time.</p>

<h2>The Brief</h2>
<p><strong>Launch Week</strong> is a two-week new-hire onboarding Adventure for a mid-sized company: forty new hires across three departments, starting the same Monday, wrapped up with an in-person orientation day midway through Week One.</p>

<h2>What It Uses</h2>
<ul>
  <li>Two Tabis — "Week One: Company Basics" and "Week Two: Department Deep-Dive"</li>
  <li>Mission, Quest, and Challenge quests; Dialogue, Gallery, Open, Upload-image, and Multiple-choice steps</li>
  <li>A three-tier Rank ladder (New Hire → Onboarded → Launch-Ready) and a small Item Shop</li>
  <li>Three department Guilds with a shared leaderboard</li>
  <li>A Path-choice branch into Engineering / Sales / Operations tracks</li>
  <li>A QR-code checkpoint at the in-person orientation day</li>
  <li>Announcements at kickoff and at the Week Two handoff</li>
</ul>

<p>The full build, in order, is documented in <a href="/docs/worked-example-two-week-onboarding-adventure">Worked Example — Building a Two-Week Onboarding Adventure End to End</a>. Other pages in this manual reference Launch Week in passing to illustrate a specific feature in context.</p>
HTML,
            ],
            [
                'title'      => 'Challenges & Surveys — Concept',
                'slug'       => 'challenges-and-surveys-concept',
                'section'    => 'setup',
                'sort_order' => 20,
                'body'       => <<<'HTML'
<p>Challenge and Survey are both quest types built from question-and-answer content, but they do opposite jobs — one grades, one just listens.</p>

<h2>Challenge: There's a Right Answer</h2>
<p>A Challenge is a quiz. You build a bank of questions, and each attempt shows a subset drawn from that bank — set how many questions appear per attempt and how many correct answers count as a pass. Add an optional time limit if you want it to feel like a real test rather than an untimed review.</p>

<h2>Survey: There Isn't</h2>
<p>A Survey asks questions with no correct answer — feedback, a pulse check, a "tell us about yourself" intake form. Responses aggregate into results rather than getting graded, and nobody passes or fails a Survey.</p>

<h2>Attempts &amp; Retries</h2>
<p>Challenges can include a number of free attempts, with additional attempts costing BLOO beyond that — useful when you want a real assessment (limited retries) rather than something a player can brute-force by retrying indefinitely for free.</p>

<h2>In Launch Week</h2>
<p>The Week One company-policy quiz is a Challenge — five questions per attempt, four correct to pass, two free attempts, a small BLOO cost for a third. The end-of-Week-One "How was your first week?" check-in is a Survey — same question format on the surface, completely different purpose underneath.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-a-challenge-or-survey">How to Build a Challenge or Survey</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Build a Challenge or Survey',
                'slug'       => 'how-to-build-a-challenge-or-survey',
                'section'    => 'setup',
                'sort_order' => 21,
                'body'       => <<<'HTML'
<p>Step-by-step, once you know which one you need — see <a href="/docs/challenges-and-surveys-concept">Challenges &amp; Surveys — Concept</a> if you haven't decided yet.</p>

<h2>Building a Challenge</h2>
<ol>
  <li>Create a new quest and set its type to <strong>Challenge</strong>.</li>
  <li>Write your question bank — each question needs its answer options and the correct one(s) marked.</li>
  <li>Set how many questions to show per attempt, and how many correct answers count as a pass.</li>
  <li>Optionally set a time limit for the whole attempt.</li>
  <li>Set free attempts, then a BLOO cost for any attempt beyond that.</li>
  <li>Set the XP/BLOO reward for passing, and publish.</li>
</ol>

<h2>Building a Survey</h2>
<ol>
  <li>Create a new quest and set its type to <strong>Survey</strong>.</li>
  <li>Add your questions and their answer options — there's no "correct" option to mark.</li>
  <li>Decide whether completing it earns a reward (most Surveys do, to encourage honest participation) — Surveys are usually low-stakes, so a small flat reward works better than a large one.</li>
  <li>Publish. Results aggregate automatically as responses come in — check them from the quest's results view rather than reading submissions one by one.</li>
</ol>
HTML,
            ],
            [
                'title'      => 'The Event Schedule: Sessions, Speakers & Sponsors — Concept',
                'slug'       => 'event-schedule-concept',
                'section'    => 'setup',
                'sort_order' => 22,
                'body'       => <<<'HTML'
<p>Not every part of an Adventure needs to be a quest. The Schedule is a separate, purely informational layer for anything time-and-place based — live sessions, who's speaking, who's sponsoring — sitting alongside the Journey Map rather than gating progress on it.</p>

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
                'sort_order' => 23,
                'body'       => <<<'HTML'
<ol>
  <li>From your Adventure, open the <strong>Schedule</strong> section.</li>
  <li>Add a session: title, start/end time, and a room or location if it's in-person or hybrid.</li>
  <li>Attach a speaker if the session has one — add their name, title, short bio, and photo once, then reuse them across multiple sessions if they're speaking more than once.</li>
  <li>Add any sponsors you want listed alongside the schedule — logo and name is enough.</li>
  <li>Publish the schedule. It's visible to enrolled players independent of where they are on the Journey Map — nothing here needs to be "unlocked."</li>
</ol>
<p>The Schedule is content, not mechanics — it doesn't reward XP/BLOO or gate anything on its own. Pair it with a QR-code quest (see <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>) if you want attendance at a specific session to actually count toward progress.</p>
HTML,
            ],
            [
                'title'      => 'SCORM Packages — Concept',
                'slug'       => 'scorm-packages-concept',
                'section'    => 'setup',
                'sort_order' => 24,
                'body'       => <<<'HTML'
<p>If you already have e-learning content built in another authoring tool, you don't have to rebuild it inside BLUERABBIT from scratch — the SCORM step type embeds it directly.</p>

<h2>What SCORM Is</h2>
<p>SCORM is a long-standing e-learning packaging standard — most authoring tools (Articulate, Captivate, and similar) can export a course as a SCORM package. A SCORM step embeds that package in an iframe and tracks its completion the same way a native step would.</p>

<h2>What You Get</h2>
<p>Completion tracking happens automatically once the package reports itself finished — no manual grading step, no separate spreadsheet of who finished the external course. It slots into the quest and Journey Map exactly like any other step, rewards included.</p>

<h2>When to Reach for It</h2>
<p>Use SCORM when strong existing content already exists and rebuilding it natively would be pure duplicated effort — a compliance course, a vendor-provided training module. For anything you're building fresh, a native step (Open, Multiple-choice, Dialogue) is usually a better fit and gives you BLUERABBIT's own reward and branching tools directly.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-add-a-scorm-package">How to Add a SCORM Package</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Add a SCORM Package',
                'slug'       => 'how-to-add-a-scorm-package',
                'section'    => 'setup',
                'sort_order' => 25,
                'body'       => <<<'HTML'
<ol>
  <li>Export your course from its authoring tool as a SCORM 1.2 or SCORM 2004 package (a single <code>.zip</code> file).</li>
  <li>Add a new step inside a quest and set its type to <strong>SCORM</strong>.</li>
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
                'sort_order' => 26,
                'body'       => <<<'HTML'
<p><strong>Not to be confused with:</strong> this is about emailing players already enrolled in one of your Adventures. It's a separate system from bluerabbit.io's own public waitlist signup emails on the marketing site — different audience, different tool, don't mix the two up when someone asks "did the email go out?"</p>

<h2>What a Campaign Is</h2>
<p>A campaign is a one-time or triggered email sent to some or all of the players enrolled in an Adventure — built from a template with variables like the player's name and the Adventure's title filled in automatically per recipient.</p>

<h2>Good Use Cases</h2>
<ul>
  <li>Re-engaging players who haven't logged in for a while.</li>
  <li>Announcing a new Tabi or chapter that just unlocked.</li>
  <li>A deadline reminder a few days before a quest expires.</li>
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
                'sort_order' => 27,
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
