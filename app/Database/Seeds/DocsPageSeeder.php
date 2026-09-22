<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Upserts by slug (update if it exists, insert if it doesn't) so re-running
 * this after an edit actually refreshes content instead of silently
 * skipping — unlike BlogPostSeeder, which is insert-only.
 *
 * Last synced to the CI4 app (blue) on 2026-09-21, against blue@6e5a454.
 * See claude-notes/CI4-DOCS-SYNC-2026-09-20.md for the brief that drove it.
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
            // 2026-09-21 sync: no slugs retired. random-encounters was
            // rewritten in place and kept its slug.
        ])->delete();

        $pages = [
            // ---------------------------------------------------------
            // User docs — for players
            // ---------------------------------------------------------
            [
                'title'      => 'Product & Platform Overview',
                'slug'       => 'product-platform-overview',
                'section'    => 'user',
                'sort_order' => 0,
                'body'       => <<<'HTML'
<p>BLUERABBIT wraps your learning content in a real game engine: a Journey Map of milestones, a reward system built on XP, BLOO and (when it's switched on) EP, achievements, and Guilds. You place two things on that map: <strong>Milestones</strong> (content that gives players knowledge) and <strong>Challenges</strong> (quizzes that test it). Milestones are built from 28 reusable Step types in six groups: dialogue, video, open text, puzzles, uploads, SCORM packages, branching choices, profile questions and more.</p>

<p>Three things set it apart from a course platform with badges bolted on:</p>
<ul>
  <li><strong>The Garden</strong> — a second canvas beside the Journey where players grow Skills, ask for and give help, endorse each other, and take on Tasks and Missions.</li>
  <li><strong>Encounters</strong> — cards dealt onto the Journey. Pick one and you're held in its milestone until you finish it, making choices that cost BLOO and energy.</li>
  <li><strong>Profile Tests</strong> — a personality or working-style profile built from questions slipped into ordinary milestones as steps. Each player's reading lands in their Journal.</li>
</ul>

<p>See the <a href="/product">Product</a> page for the full breakdown, or <a href="/solutions">Solutions</a> for how corporate L&amp;D, onboarding, and bootcamp teams each use the platform differently.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/getting-started">Getting Started</a> — your first login</li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — what you'll actually be doing</li>
  <li><a href="/docs/the-garden-overview">The Garden</a> — the social side of an adventure</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Getting Started',
                'slug'       => 'getting-started',
                'section'    => 'user',
                'sort_order' => 1,
                'body'       => <<<'HTML'
<p>Whether your organization invited you or you're setting one up yourself, here's what happens the first time you sign in to BLUERABBIT.</p>

<h2>1. Sign In or Create Your Account</h2>
<p>On the BLUERABBIT login page, sign in with your <strong>Nickname or Email</strong> and your password. New here? Choose <strong>Sign Up</strong>, enter a nickname, your email, a password and your language, then press <strong>Register New Player</strong>. The Sign Up tab only appears when your platform has registration open. If you don't see it, your organization adds people itself.</p>
<p>Before you log in or sign up you may be asked to complete a quick Cloudflare check that you're human. It's there to keep automated sign-ups and password guessing out.</p>
<p>If your organization runs BLUERABBIT for you, an admin or Game Master may already have created your account and enrolled you. Use <strong>Forgot password?</strong> on the login page to have a reset link emailed to you, and choose your own password.</p>
<p>Starting your own organization? New accounts start on the <strong>Basic</strong> plan: free, with up to 90 players and 3 Adventures across your whole account and 50MB of file storage. Upgrade to Pro whenever you need more room. See <a href="/docs/setting-up-your-organization">Setting Up Your Organization</a> for the full setup, and <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for the plans.</p>

<h2>2. Join an Adventure</h2>
<p>An <strong>Adventure</strong> is a single learning journey: an onboarding program, a training course, a live bootcamp. You join one when a Game Master enrolls you, or when you open an enrollment link they've shared while you're signed in. Your Adventures are listed under <strong>My Adventures</strong>.</p>
<p>Inside each Adventure you hold one role:</p>
<ul>
  <li><strong>Player</strong> — you play the Adventure. Most people are players.</li>
  <li><strong>GM</strong> (Game Master) — runs the Adventure: builds its content, manages its players, sends its emails.</li>
  <li><strong>NPC</strong> — a read-only supervisor. An NPC sees everything a GM sees and plays the Adventure like any other player, but can't change anything, with one exception: appointing a guild's leader.</li>
  <li><strong>Owner</strong> — the account the Adventure belongs to, with full control over it.</li>
</ul>
<p>Roles are per Adventure, so you can be a player in one and a GM in another. <strong>Admin</strong> and <strong>God</strong> are something else: they're account-wide access levels that a platform admin sets in User Management, not roles inside an Adventure. See <a href="/docs/user-management-and-access-levels">User Management and Access Levels</a>.</p>

<h2>3. Choose Where You Start</h2>
<p>Many Adventures have two play areas: the <strong>Journey</strong>, the map of milestones, and the <strong>Garden</strong>, your people and your skills. If yours has both, the first time you arrive you're asked <em>Where should we start you?</em> Pick one and that's where BLUERABBIT takes you when you come in. You can change it whenever you like with the <strong>Start on:</strong> switch at the top of the menu's Adventure Navigation section. See <a href="/docs/finding-your-way-around">Finding Your Way Around</a>.</p>

<h2>4. Your First Look at the Journey Map</h2>
<p>The <strong>Journey Map</strong> lays out every milestone in the program. Each node shows whether it's locked, available or finished, depending on what you've already done. Your level, XP, BLOO and, if the Adventure uses Energy, EP are in your profile panel: click your picture in the top-right corner.</p>
<p>Not sure what those mean yet? Start with <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a>. It's the fastest way to understand how progress works here.</p>

<h2>Where to Go Next</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the menu, your starting point and guided tours</li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — reading node states and Tabis</li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — what you'll actually be doing</li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a> — the social and competitive layer</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Finding Your Way Around',
                'slug'       => 'finding-your-way-around',
                'section'    => 'user',
                'sort_order' => 2,
                'body'       => <<<'HTML'
<p>Every adventure puts the same frame around its content: a few controls in the top corners of the screen, a menu, and a taskbar along the bottom. Learn them once and you can find your way around any adventure you join.</p>

<h2>Where You Start: the Journey or the Garden</h2>
<p>If your adventure has a <a href="/docs/the-garden-overview">Garden</a> as well as a <a href="/docs/journey-map-guide">Journey</a>, you choose which one you land on when you come in. The first time you open the Journey it asks once — <strong>Where should we start you?</strong> — with two options: <strong>The Journey</strong> (the map, your milestones and what is unlocked next) or <strong>The Garden</strong> (your people, your skills and what they need from you). Close it without choosing and you stay on the Journey; it will ask again on a later visit.</p>
<p>You can change your mind whenever you like. Open the menu and look at the top of the <strong>Adventure Navigation</strong> section: the <strong>Start on: Garden / Journey</strong> switch flips your choice and saves it on the spot, without taking you anywhere. Press <strong>Start on:</strong> itself to reopen the full dialog, which also has a link to go there now.</p>
<p>Your starting point is remembered separately for each adventure. It applies the first time you come in during a session; after that, the menu's Journey and Garden entries take you wherever you ask. An adventure without a Garden has nothing to choose, so you always start on the Journey.</p>

<h2>Map or List</h2>
<p>The Journey has two views, switched with the <strong>Map / List</strong> control — at the bottom-left of the map, and at the top of the page in List view. The map is the designed layout you pan and zoom around; the list is a table of every milestone grouped under its chapter, with its level, rewards and status on one row. Whichever you used last is the one you get next time in that adventure. Both are covered in <a href="/docs/journey-map-guide">The Journey Map</a>.</p>

<h2>The Corners of the Screen</h2>
<p>Top left:</p>
<ul>
  <li><strong>Menu</strong> — opens the adventure menu, the same one the OPTIONS button opens.</li>
  <li><strong>The adventure's name</strong> — takes you back to the Journey from anywhere. On a phone it shrinks to an icon.</li>
</ul>
<p>Top right:</p>
<ul>
  <li><strong>Back to where you left off</strong> — the torch. It appears while you have a milestone in progress and drops you back into the step you were on.</li>
  <li><strong>?</strong> — starts the guided tour for the screen you're on. It only appears where there is a tour (see below).</li>
  <li><strong>Email Support</strong> — opens a new email to your adventure's support address. Your GM can set one for the adventure; otherwise it goes to the platform's default.</li>
  <li><strong>My Guild</strong> — your guild's page. It's only there if you're in a guild.</li>
  <li><strong>Profile</strong> — your picture. It opens your profile panel: your level and rank, your XP toward the next level, your BLOO balance against everything you've earned (it can dip below zero — see <a href="/docs/xp-bloo-ep-explained">XP, BLOO &amp; EP</a>), your EP if the adventure uses Energy, and your Garden stats if it has a Garden. The panel also links to your account settings and holds the <strong>Log out</strong> button.</li>
</ul>

<h2>The Menu and the Taskbar</h2>
<p>The bar along the bottom of the screen holds the yellow <strong>OPTIONS</strong> button. Press it — or <strong>Menu</strong> in the top-left corner — and the menu opens; the button then reads <strong>CLOSE</strong>. Some adventures switch the bottom bar off to give the content the whole screen; there, the <strong>Menu</strong> button in the top-left corner is your way in.</p>
<p>The menu's <strong>Adventure Navigation</strong> section lists every part of the adventure you can visit: the Journey, your Journal, Achievements, the Item Shop and Backpack, Guilds, the Garden and Tasks, the Leaderboard, Magic Code, the Wall, Posts, Resources, Secrets and Clues, the Schedule and Speakers, and My Requests. You only see the ones your adventure actually uses, and your organization may have renamed some of them. <strong>Adventures</strong> takes you back to your list of adventures, unless your platform sends everyone straight to one. GMs also see <strong>Admin Tools</strong> and <strong>Add Mechanics</strong> sections.</p>
<p>While the menu is open, a row of <strong>quick links</strong> appears just above the taskbar. Which ones you get depends on the adventure, but they can include:</p>
<ul>
  <li><strong>Journey</strong> — back to the map or list.</li>
  <li><strong>Magic Code</strong> — opens <strong>Redeem a code</strong>, for codes from your guide, a poster, a QR code or an event.</li>
  <li><strong>Item Shop</strong>.</li>
  <li><strong>Deadline extension request</strong> — a short form (which module, the date you need until, and why) that goes to your GM. Follow it up under <strong>My Requests</strong>.</li>
  <li><strong>Cooper</strong> — the adventure's AI assistant. Your GM may have given it a different name and face.</li>
  <li>Up to three <strong>custom links</strong> your GM added — often your organization's own support channel. They open in a new tab; hover one to see what it is.</li>
</ul>
<p>More on the support options in <a href="/docs/getting-help-support-and-chat">Getting Help</a>.</p>

<h2>Guided Tours</h2>
<p>Many screens come with a short guided tour — the Journey, milestones and challenges, the Garden, Tasks, the Item Shop, the Leaderboard, the Wall, your Journal and your list of adventures among them. A tour starts by itself the first time you open its screen. Once you've started or skipped it, it won't start on its own again: the Journey's tour is remembered once for each adventure, and every other tour once for your account.</p>
<p>To replay a tour, press the <strong>?</strong> in the top-right corner. It appears on any screen that has a tour, and nowhere else.</p>

<h2>Posts and Resources</h2>
<p>Two menu entries are for reading rather than playing. <strong>Posts</strong> are articles and notices from your GM; <strong>Resources</strong> are reference material — articles, and files or links to download. Open one and it reads like a page, with a <strong>Download</strong> button when there's a file behind it. They don't sit on the Journey and don't count toward your progress.</p>
<p>Some are held back the way milestones are: until you reach a level, until a date, or unless you're on a particular path. Those either stay out of the list until then or tell you why when you open them.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — reading the map, chapters and milestone states</li>
  <li><a href="/docs/the-garden-overview">The Garden</a> — the other half of the adventure</li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a> — requests, Cooper and support</li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account</a> — what's behind the profile panel</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Understanding XP, BLOO & EP',
                'slug'       => 'xp-bloo-ep-explained',
                'section'    => 'user',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>BLUERABBIT tracks your progress with three separate numbers. They look similar at a glance but do very different jobs. Your adventure may call them something else — a Game Master can rename all three — but the mechanics underneath stay the same.</p>

<h2>XP — Experience Points</h2>
<p>XP measures progress. You earn it from milestones, challenges, achievements and <a href="/docs/garden-tasks">Garden Tasks</a>, and it sets your <strong>Level</strong>. Levels follow a fixed curve: level 2 at 1,000 XP, level 3 at 3,000, level 4 at 6,000, with each level needing 1,000 more XP than the step before it.</p>
<p>Levelling up can open milestones that need a certain level, and can award you a <strong>rank</strong> automatically if your adventure has a rank ladder.</p>
<p><strong>XP can go down.</strong> Some encounter choices cost XP instead of paying it, and if you lose enough you drop a level. It's the strongest setback the game has, so it's worth reading an encounter's options carefully.</p>

<h2>BLOO — Your Spendable Currency</h2>
<p>BLOO goes up and down. You earn it from milestones, challenges, achievements and Garden Tasks, and some encounter choices pay it out. You spend it:</p>
<ul>
  <li>in the <a href="/docs/item-shop-and-backpack">Item Shop</a>,</li>
  <li>on extra attempts at a challenge that charges for them,</li>
  <li>on the choices you make inside an <a href="/docs/encounters-the-card-draw">encounter</a>.</li>
</ul>

<h2>Going Into Debt</h2>
<p>BLOO can drop <strong>below zero</strong>, but only one way: choosing an encounter option that costs more than you have. The option tells you before you pick it ("This puts you 180 under"), so it's always your call.</p>
<p>Debt is a setback, not a loophole. The Item Shop never sells on credit: it won't sell you anything you can't afford, and while you're below zero that means everything. Paid challenge attempts work the same way. Earn your way back above zero through milestones and Garden Tasks. Your Game Master may also have set up a message that appears the moment you go into debt.</p>

<h2>EP — Energy Points</h2>
<p>Energy is its own switch. If your adventure doesn't use Energy Points you won't see EP anywhere — and there are no encounters either, because energy is what they run on.</p>
<p>When it's on, you earn EP from milestones, challenges and achievements that pay it, and most reliably from Garden Tasks that pay energy. You spend it on the choices you make inside an encounter.</p>
<p>Energy has a ceiling that rises with your level: 120 at level 1, 160 at level 2, 220 at level 3, and more from there. Anything you earn above the ceiling is lost, so there's no point hoarding it.</p>
<p><strong>EP never goes below zero.</strong> An encounter option you don't have the energy for is greyed out and marked "Not enough energy". Every encounter is meant to offer at least one option that costs no energy, so running dry is a setback, not a game over. If you ever find nothing you can pick, the step says so and sends you to recover in the Garden.</p>

<h2>How They Work Together</h2>
<p>A typical loop: finish a milestone → earn XP (progress), BLOO (money) and maybe some EP → spend BLOO in the shop, or keep a cushion for the next encounter → when an encounter drains your energy, work a Garden Task to top it back up. None of the three substitutes for another. "Am I progressing?", "What can I afford?" and "Can I act right now?" stay three separate questions on purpose.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/encounters-the-card-draw">Encounters — The Card Draw</a></li>
  <li><a href="/docs/item-shop-and-backpack">Item Shop &amp; Backpack</a></li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a></li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Journey Map',
                'slug'       => 'journey-map-guide',
                'section'    => 'user',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<p>The Journey is the visual heart of every adventure: a map of milestones laid out by whoever built it — a path, a skill tree, a town to explore. The layout itself is usually part of the story.</p>

<h2>Moving Around</h2>
<p>Drag to pan. Zoom with the mouse wheel, a two-finger pinch, or the <strong>−</strong> and <strong>+</strong> buttons at the bottom-left, which show your zoom level as a live percentage, from 30% up to 200%. The round button beside them recentres the map.</p>
<p>Click a milestone to see its preview — what it's about and what it pays — and start it from there.</p>

<h2>Map or List</h2>
<p>The <strong>Map / List</strong> switch sits next to the zoom. The list shows the whole journey as one table: every milestone under its chapter heading, with its level, rewards and status on a single row, and each chapter's progress on its heading — required milestones, with optional ones (tagged <em>Side quest</em>) counted separately. A chapter you haven't unlocked yet shows only its heading and what to finish to open it, so the list never shows more than the map would.</p>
<p>Whichever view you used last is the one you get next time in that adventure. On your first visit, the platform's default view decides.</p>

<h2>Depth</h2>
<p>The map is built in layers. As you pan and zoom, artwork in the background drifts more slowly than the milestones and anything in the foreground moves a little faster, which gives the map real depth. Only the main layer — where the milestones and chapters sit — responds to clicks; everything in front of or behind it is scenery.</p>

<h2>Milestone States</h2>
<p>Every milestone is in exactly one state for you at any moment. The map and the list word them slightly differently:</p>
<ul>
  <li><strong>Available</strong> — open and ready to start.</li>
  <li><strong>Finished</strong> — you've completed it. You can still open it to review.</li>
  <li><strong>Locked</strong> — you haven't met what it needs yet (another milestone, an achievement, an item you have to carry, or another condition your GM set), or your GM has locked it for now.</li>
  <li><strong>Needs a higher level</strong> — shown as "Available at level N" on the map and "Level N" in the list.</li>
  <li><strong>Not open yet</strong> — its start date is still ahead ("Available on…" on the map, "Opens…" in the list).</li>
  <li><strong>Closed</strong> — its deadline has passed ("Deadline missed" on the map, "Closed…" in the list).</li>
  <li><strong>Another path</strong> — it belongs to a path you're not on, so it's greyed out.</li>
</ul>
<p>Your GM can also hide milestones outside their dates entirely, in which case they don't appear at all until they open.</p>

<h2>Tabis — Chapters</h2>
<p>Milestones can be grouped into <strong>Tabis</strong>: chapters that sit on the map as a single tile. Click one to open it. Inside are its milestones, under a progress bar toward the chapter's badge (or toward finishing the stage, if it has no badge) that counts the required milestones you've finished out of the total.</p>
<p>A Tabi can be locked behind other Tabis. A locked one is greyed out; open it anyway and it lists the chapters you need to finish first. Some artwork and buttons on the map belong to a chapter, and stay grey and unclickable until that chapter opens.</p>

<h2>Evolving Tabis</h2>
<p>A chapter's artwork can change as <em>you</em> progress — a market stall that becomes a shop and then a department store as you level up, finish milestones or earn Blooms. It's drawn from your own progress, so the person next to you may see a different picture in the same spot. Open the chapter to see its scene full size, with a <strong>Next:</strong> line saying what grows it next. Some scenes also fade the longer you've been away.</p>

<h2>What Else Is on the Map</h2>
<p>Your GM can place live panels and shortcuts anywhere on the map. The panels show your own information:</p>
<ul>
  <li><strong>Status</strong> — your picture, level, and your XP and BLOO bars (plus EP, if the adventure uses Energy). Click it to open your profile panel.</li>
  <li><strong>Journey progress</strong> — how far through the whole journey you are.</li>
  <li><strong>Leaderboard</strong> and <strong>Guild leaderboard</strong> — the top players or guilds.</li>
  <li><strong>Tasks</strong> — tasks you can do, the ones available right now first.</li>
  <li><strong>Messages</strong> — opens your direct messages.</li>
  <li><strong>Ways to help</strong> — open help requests from other players, plus any you've asked yourself.</li>
  <li><strong>Achievements</strong> and <strong>Backpack</strong> — what you've earned and what you're carrying, with a link to the rest.</li>
  <li><strong>Task hexagons</strong> — a single task drawn like a milestone. Click one to open the task and finish it without leaving the map.</li>
  <li><strong>Shortcut buttons</strong> to the Item Shop, your Journal, Achievements or the magic code box.</li>
  <li>Text, pictures and decoration — some of which link somewhere, opening in a new tab.</li>
</ul>

<h2>When the Journey Sends You Somewhere Else</h2>
<p>Now and then, opening the Journey takes you somewhere first:</p>
<ul>
  <li>If you're in the middle of an <a href="/docs/encounters-the-card-draw">encounter</a>, you go straight back to it until it's finished. If a fresh hand of cards has just been dealt, you see the cards over the map first.</li>
  <li>If your GM has set a milestone to open automatically and you can play it, you're taken into it.</li>
  <li>If you chose the Garden as your starting point, your first visit in a session lands you there (see <a href="/docs/finding-your-way-around">Finding Your Way Around</a>).</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — what happens inside a milestone</li>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the menu, taskbar and tours</li>
  <li><a href="/docs/encounters-the-card-draw">Encounters</a> — the card draw on the map</li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a></li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a> — what's behind a task hexagon</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Completing Milestones & Steps',
                'slug'       => 'completing-milestones-and-steps',
                'section'    => 'user',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<p>A <strong>Milestone</strong> is the core content unit in BLUERABBIT: one node on the Journey Map. Each Milestone is built from smaller pieces called <strong>Steps</strong>, which you play through in order.</p>

<h2>Milestones and Challenges</h2>
<ul>
  <li><strong>Milestone</strong> — content that gives you something: a briefing, a video, a hands-on exercise, a written submission. Most of what you play is Milestones.</li>
  <li><strong>Challenge</strong> — a quiz that tests what you already know. Each attempt shows a set of questions drawn from a bank, and you need a set number right to pass. See <em>Taking a Challenge</em> below.</li>
</ul>

<h2>Moving Through the Steps</h2>
<p>A Milestone opens as a whole, but you play it one Step at a time with <strong>Back</strong> and <strong>Next</strong>, and dots down the side show how far through you are. Some Steps just deliver something and let you move on; others need a correct answer or a response before Next unlocks. If you leave partway through, the Milestone picks up at the step you were on.</p>
<p>Steps can carry their own XP, BLOO, EP, item or achievement rewards on top of whatever the Milestone itself pays.</p>
<p>Some Milestones have no steps at all. You'll see a message and a text box: write your response and press <strong>Submit Answer!</strong></p>

<h2>Six Kinds of Step</h2>
<p>There are 28 Step types, in six groups you'll notice as you play:</p>
<ul>
  <li><strong>Deliver</strong> — a character speaking, a video, an audio clip, or an item you find on your path (<strong>Grab the item and continue</strong>). Read, watch, listen, continue.</li>
  <li><strong>Validate</strong> — multiple choice, a keyphrase, a cryptex lock, a jigsaw puzzle, picking the right item from your backpack, a SCORM package, or an interactive case study. You have to get it right to advance.</li>
  <li><strong>Collect</strong> — open text, a survey question, a rating scale, a poll, or an image or video upload. There's no wrong answer; you just respond. Some survey questions let you tick several answers up to a limit, shown above the options as <em>Choose up to 3</em>. Once you reach it, the other boxes lock until you untick one.</li>
  <li><strong>Profile</strong> — statements to agree or disagree with, or questions whose answers each lean toward a trait. There are no right answers here either: your answers build a profile of you, and a Profile Result step shows you the reading. See <a href="/docs/your-profile-results">Your Profile Results</a>.</li>
  <li><strong>Flow</strong> — a branch choice that permanently sets your path, buttons that jump you to another part of the Milestone, and encounter choices: options with a price in BLOO and energy. See <a href="/docs/encounters-the-card-draw">Encounters</a>.</li>
  <li><strong>Special</strong> — system messages, the win and fail screens, and the steps that set your nickname or avatar.</li>
</ul>
<p>Not every Step is required. On survey-style steps an optional one lets you press Next without answering. Steps that check an answer always wait for one.</p>

<h2>Attempt Limits</h2>
<p>Some Steps give you a fixed number of tries. When one does, you'll see how many attempts you have left. Run out without getting it right and the Milestone is failed: you're taken to its fail screen (see below). Once your attempts are spent, even a correct answer won't be accepted, so read the question twice before your last try.</p>

<h2>Backpack Steps: Pick the Right Item</h2>
<p>A step marked <em>You need an item to continue</em> shows your own backpack as a rack. Scroll it past the sight in the middle and press <strong>Use</strong> on whatever sits under it. The step doesn't tell you which item it wants (working that out is the puzzle), and a wrong pick counts as a miss. If your backpack is empty, the step says so and, if the adventure has an Item Shop, links you to it. Gift cards don't appear on the rack.</p>

<h2>How a Milestone Ends</h2>
<p>Every Milestone ends on a win screen or a fail screen, even if your Game Master didn't write one.</p>
<ul>
  <li><strong>Win</strong> — the last step's <strong>Continue</strong> button takes you to the win screen. Press <strong>Finish</strong> to complete the Milestone. The completion screen shows what you earned, with a <strong>Back to the journey!</strong> button.</li>
  <li><strong>Fail</strong> — you reach the fail screen when you run out of attempts on a step. Its button (<strong>Start over</strong> on the standard screen) clears your answers for that Milestone and reloads it from the first step, so your retry is a genuinely fresh run. Your progress everywhere else, and anything you've already earned, stays yours. An encounter choice you already paid for isn't charged again.</li>
</ul>

<h2>Taking a Challenge</h2>
<p>A Challenge page lists its conditions: attempts used, how many correct answers you need, and any time limit. Press <strong>Start!</strong> to begin an attempt. The panel under it says whether this one is a free attempt or what it costs in BLOO, and if you can't afford it, it won't start.</p>
<p>Answer the questions, then press <strong>Submit answers!</strong> and confirm. If there's a time limit, a <em>Time's up!</em> screen covers the questions when the clock runs out, and clicking it grades what you've answered.</p>
<p>The attempt ends on a panel with your score (for example <em>3 of 5 right — 60%</em>) and how many you needed. Its only button is <strong>Review my answers</strong>, pass or fail. Behind it are your graded questions, each marked right or wrong. The ones you got right come with your Game Master's explanation of why; the ones you got wrong don't, so a retry isn't handed the answers. A bar along the bottom offers <strong>Back to the journey</strong>, plus <strong>Try again</strong> if you didn't pass. A Challenge can cap how many attempts you get, and attempts beyond the free ones can cost BLOO.</p>

<h2>Milestones That Open by Themselves</h2>
<p>Your Game Master can mark a Milestone to load first, such as a briefing you should see before anything else. When you open the adventure you're taken straight into it, but only if you can actually play it yet. Once you've finished it, it stops. An encounter you're in the middle of, or a hand of encounter cards waiting for you to pick, always comes first.</p>

<h2>AI-Assisted Feedback</h2>
<p>On Open Text steps, if your Game Master has switched it on, pressing <strong>Check Answer</strong> has your response checked against what the question asks (and any private criteria your Game Master wrote) before you continue. If it's sent back, you get feedback to revise against, which is useful for practising a skill rather than just being graded once. After it's accepted you can still reopen your answer with <strong>Edit Content</strong>.</p>

<h2>Quick-Complete via QR Code</h2>
<p>Some Milestones carry a scannable QR code that completes them directly, bypassing the normal prerequisite chain entirely. You'll typically see this at in-person events or bootcamp sessions: scan, done, move to the next station. You need to be logged in and enrolled in the adventure. Each cohort of an adventure has its own code, so a scan always counts in the one you're in, and scanning the same code again doesn't pay out twice.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — where Milestones live</li>
  <li><a href="/docs/encounters-the-card-draw">Encounters</a> — the card draw and the choices inside it</li>
  <li><a href="/docs/item-shop-and-backpack">Item Shop &amp; Backpack</a> — where backpack-step items come from</li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> — every Step type in detail</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Encounters — The Card Draw',
                'slug'       => 'encounters-the-card-draw',
                'section'    => 'user',
                'sort_order' => 6,
                'body'       => <<<'HTML'
<p>Some adventures don't just wait for you to choose what to play next. The world acts on you: you open the Journey and something has happened. A supplier doubled their price, a client wants a meeting tomorrow, the fridge died two hours before service. These are <strong>encounters</strong>, and they arrive as a card draw.</p>
<p>Encounters only exist in adventures that use Energy Points. If yours doesn't, nothing on this page will happen to you.</p>

<h2>The Draw</h2>
<p>When something is due, the next time you open the Journey the screen flashes and a hand of face-down cards is dealt, usually eight. The heading reads <em>"Something just happened."</em> The line under it hints at what's in the hand: <em>"None of them are good"</em> if every card is a crisis, <em>"Not all of them are bad"</em> if there's an opportunity in there somewhere.</p>
<p>Pick one. It flips over to show what you drew:</p>
<ul>
  <li><strong>Crisis</strong> — something went wrong and needs dealing with.</li>
  <li><strong>Opportunity</strong> — a chance you can take, usually at a price.</li>
</ul>
<p>The hand is fixed the moment it appears. Reloading the page shows the same cards again, so there's no reshuffling until you like the look of one. The cards you didn't pick go back into the deck untouched and may come round another time.</p>

<h2>Locked In Until You Finish</h2>
<p>Every card leads to a milestone, and turning it over takes you straight there. As the draw screen warns: <em>"Whatever you turn over, you will face it before the journey opens again."</em> Until you finish that milestone, opening the Journey brings you back to it.</p>
<p>Only the Journey is locked. The Garden, your Tasks and the Item Shop stay open the whole time, which matters, because that's where you recover what an encounter costs. And the milestone always opens for you, even if a setback has dropped you below the level it would normally need.</p>

<h2>The Choice</h2>
<p>Inside the milestone, the story plays out like any other until you reach the decision: an <strong>Encounter Choice</strong> step. It shows what you have ("You have 1320 BLOO and 45 Energy") and lists your options, each with its price up front:</p>
<ul>
  <li><strong>-200 BLOO</strong> or <strong>+900 BLOO</strong> — what the option costs, or what it pays.</li>
  <li><strong>-20 Energy</strong> or <strong>No energy</strong> — the energy it takes.</li>
</ul>
<p>A choice can do more than move money. It can also add or take away XP (that part isn't shown on the option itself), grant you an achievement that opens a follow-up milestone, or trigger a message about what happened next.</p>
<p>Once you pick, the step shows <em>"You decided"</em> with your choice, and that's final. You're only ever charged once for an encounter, even if you fail the milestone and play it again.</p>

<h2>When You Can't Afford It</h2>
<p><strong>Energy is a hard limit.</strong> An option that needs more energy than you have is greyed out and marked <em>"Not enough energy"</em>. Encounters are designed to always include at least one option that costs no energy. If you ever find nothing you can pick, the step says <em>"You are out of energy"</em> and offers a <strong>Go and recover</strong> button that takes you to your Tasks. Complete a Task that pays energy, come back, and the encounter will still be waiting.</p>
<p><strong>Money isn't.</strong> An option that costs more BLOO than you have is still available, marked with how far under it would put you ("This puts you 180 under"). Choosing it puts you in debt. <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a> explains what that means. In short, the Item Shop won't sell to you until you've earned your way back.</p>

<h2>How Often They Happen</h2>
<p>Your Game Master decides. Encounters come in groups, and each group has its own rules for when you're ready for it (reaching a certain level, say, or finishing a particular chapter) and how often it comes round. Some come round every few days. Some only happen on particular days of the week, and if you don't visit on that day, that one passes you by.</p>
<p>You only ever face one hand at a time, and a new one can't arrive until you've finished the encounter you picked. Most encounters happen to each player once; a few recurring pressures can come round again.</p>

<h2>Keeping Track</h2>
<p>In the Garden, the <strong>Business</strong> panel in the dock shows your coins (BLOO), your energy against its ceiling, and how many crises and opportunities are still out there for you. When you're in debt it tells you how far under you are, and the dock button shows a <strong>!</strong>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a></li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a></li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a></li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Achievements & Guilds',
                'slug'       => 'achievements-and-guilds',
                'section'    => 'user',
                'sort_order' => 7,
                'body'       => <<<'HTML'
<h2>Your Achievements Page</h2>
<p>The Achievements page (your adventure may call it something else) opens with a <strong>showcase</strong> of two cells:</p>
<ul>
  <li><strong>Most recent</strong> — the latest badge or rank you earned, and when.</li>
  <li><strong>Certificate</strong> — your certificate once you've earned it, with a <strong>View &amp; print</strong> button. While it's still locked, the cell lists exactly what's missing, for example "Reach level 9 — you're at level 5".</li>
</ul>
<p>Below that, <strong>All achievements</strong> lists everything in three groups — <strong>Badges</strong>, <strong>Paths</strong> and <strong>Ranks</strong> — with a search box. Anything you've earned shows the date; anything you haven't shows as <strong>Locked</strong>. Click one you've earned to open its detail: when you earned it and, if the Game Master wrote one, its secret message. Some adventures hide achievements until you've earned them, in which case you only see your own.</p>

<h2>Three Kinds</h2>
<ul>
  <li><strong>Badge</strong> — recognition for something you did. Many carry XP or BLOO of their own.</li>
  <li><strong>Path</strong> — the branch of the journey you're on. A path can decide which milestones and shop items you see, and you can only ever hold one path from each branch.</li>
  <li><strong>Rank</strong> — a title that comes with your level. Reach the level a rank needs and it's awarded automatically.</li>
</ul>

<h2>How You Earn Them</h2>
<ul>
  <li><strong>Automatically</strong> — many achievements are awarded the moment your progress meets their conditions: reaching a level, finishing a chapter, earning enough Blooms.</li>
  <li><strong>By finishing a milestone</strong> that awards one.</li>
  <li><strong>Through a choice</strong> you make in an <a href="/docs/encounters-the-card-draw">encounter</a>.</li>
  <li><strong>With a magic code</strong> — type it into the taskbar's Magic Code link, scan its QR code, or open the magic link your Game Master shared.</li>
  <li><strong>From your Game Master</strong>, by hand.</li>
</ul>
<p>However it arrives, you get the same celebration panel. If someone else's action earned it for you (a Game Master grading your work, say), the panel is waiting for you on your next page.</p>

<h2>The Badge on Your Certificate</h2>
<p>Once you hold a certificate, its showcase cell has a <strong>Badge shown on it</strong> picker. Choose any badge or rank you hold, or leave it on <strong>My current rank</strong>. Paths aren't offered: a path is where you are, not something you won.</p>

<h2>Guilds</h2>
<p>Guilds are squads that play together inside an adventure. If yours uses them, you'll be placed in one automatically when you join, assigned by your Game Master, or given an enrollment link that puts you in when you open it.</p>

<h3>Your Guild Page</h3>
<p>The Guilds page shows <strong>My Guild</strong>: its members, level, total XP and BLOO, and its current position. If the adventure has a leaderboard, every guild is ranked below it — the top five as cards, the rest in a table with each guild's XP, member count and average.</p>
<p>A guild's XP and BLOO are simply its members' balances added up, live. <strong>Only players count.</strong> GMs and NPCs who sit in a guild add nothing to its totals, member count or average, and neither does anyone who has left the adventure. A guild's <strong>level</strong> comes from its members' <em>average</em> XP, on the same curve players use, so a big guild can't out-level a small one on headcount alone.</p>

<h3>Rosters and Leaders</h3>
<p>A guild's roster lists each member with their level, XP and BLOO. Players never see anyone's email address on it. A guild can also have a <strong>leader</strong>, appointed by the Game Master, and the roster marks them with a Leader badge. For now it's a title, not a set of extra powers.</p>

<h3>Guild Chat on the Wall</h3>
<p>The Wall has one <strong>Guilds</strong> tab. If you're in a single guild, the tab carries your guild's name and opens straight into its feed. If you're in more than one, it opens a searchable picker; choose a guild and the post button becomes <strong>Post to</strong> that guild.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/certificates-and-secrets-and-clues">Certificates, Secrets &amp; Clues</a></li>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a></li>
  <li><a href="/docs/encounters-the-card-draw">Encounters — The Card Draw</a></li>
  <li><a href="/docs/item-shop-and-backpack">Item Shop &amp; Backpack</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Item Shop & Backpack',
                'slug'       => 'item-shop-and-backpack',
                'section'    => 'user',
                'sort_order' => 8,
                'body'       => <<<'HTML'
<p>The Item Shop is where BLOO gets spent. Everything you buy, or pick up along the journey, lands in your Backpack. Both share a tab bar with the Tabis page, where chapter collages are pieced together.</p>

<h2>Item Types</h2>
<ul>
  <li><strong>Consumable</strong> — used once, whenever you decide, from your Backpack. What it's for is up to your Game Master; the description says.</li>
  <li><strong>Key</strong> — held, not spent. Some milestones stay locked until you carry a particular key, and having it in your Backpack is enough.</li>
  <li><strong>Reward</strong> — a keepsake. Rewards aren't sold; they come from milestones and from items you find along the way.</li>
  <li><strong>Tabi Piece</strong> — one piece of a Tabi's collage. Collect them and the picture fills in on the Tabis page.</li>
  <li><strong>Gift Card</strong> — a real gift card, emailed to you, bought with BLOO. Only in adventures where the Game Master has connected a gift-card account.</li>
</ul>

<h2>Buying</h2>
<p>Each card shows the item's level, its price and how many are left (or ∞). The button tells you whether you can buy it:</p>
<ul>
  <li><strong>Buy</strong> — go ahead.</li>
  <li><strong>Requires Level N</strong> — you'll need to level up first.</li>
  <li><strong>Max owned</strong> — you already hold as many as one player may.</li>
  <li><strong>Sold Out</strong> — there's no stock left.</li>
</ul>
<p>Not every item is offered to everyone: some only appear for players on a particular path.</p>
<p>Pressing <strong>Buy</strong> asks you to confirm the price first ("Buy Health Potion for 50 BLOO?"). Confirm, and a celebration panel opens saying the item was added to your Backpack, with a button to go straight there.</p>
<p><strong>Gift cards</strong> work the same way, with two differences. The confirmation warns you that a real gift card will be sent to your account email, and that the purchase can't be undone. Afterwards, the panel tells you a second email is on its way from the rewards partner with the card itself, and that it can take a few minutes to arrive.</p>
<p>The shop never sells on credit. If you can't afford something you'll see <em>"Not enough funds"</em>, and that holds even when an encounter has already left you below zero. Two players can't both grab the last one in stock, either: whoever's purchase lands second is told there are none left.</p>

<h2>Your Backpack</h2>
<p>Everything you own, grouped into Consumables, Key Items, Tabi pieces (under each Tabi's name) and Rewards, with a count of how many of each you hold.</p>
<p>Items reach your Backpack in three ways: you buy them, a milestone awards one when you finish it, or you pick one up on a Find Item step. Your Game Master can also buy an item for you, paid from your own BLOO.</p>
<p><strong>Consumables</strong> have a <strong>Use</strong> button. It asks you to confirm, then marks the item as redeemed and it leaves your Backpack. Nothing is ever used automatically. If you use one by mistake, ask your Game Master: only staff can return a used item to your Backpack.</p>
<p>Keys, Tabi pieces and Rewards have no button. You hold them; you don't spend them.</p>

<h2>The Tabis Page</h2>
<p>Each Tabi with collectible pieces has its own board. Pieces you hold are shown in full colour and the rest stay greyed out, so you can see the shape of what's missing. Click a piece to see who collected it and when.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a></li>
  <li><a href="/docs/encounters-the-card-draw">Encounters — The Card Draw</a></li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a></li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Certificates & Secrets and Clues',
                'slug'       => 'certificates-and-secrets-and-clues',
                'section'    => 'user',
                'sort_order' => 9,
                'body'       => <<<'HTML'
<p>Beyond badges and ranks, an Adventure can give you two more things to keep: <strong>certificates</strong> you can print, and <strong>secrets</strong> — bits of story your GM hid inside the milestones you finish.</p>

<h2>Certificates</h2>
<p>A certificate is a printable document your Adventure awards you. An Adventure can carry several — one for finishing the programme, one for reaching a level, one for your whole guild — and each one unlocks on its own terms. Some are open from the start. Others unlock only once you meet everything your GM set for them.</p>

<h3>Where to Find Them</h3>
<p>Certificates live on your <strong>Achievements</strong> page:</p>
<ul>
  <li>The <strong>Certificate</strong> panel at the top shows the first certificate you hold, with a <strong>View &amp; print</strong> button. If you don't hold one yet, it shows the next locked one and what it still needs.</li>
  <li>The <strong>Certificates</strong> panel below the achievement grid lists every certificate you can earn. Earned ones have <strong>View &amp; print</strong>. Locked ones show a padlock and a list of what's missing.</li>
</ul>
<p>A locked certificate tells you exactly what's left, and where you stand when it can work that out: <em>"Reach level 9 — you're at level 5"</em>, or <em>"Complete 12 milestones — you've completed 7"</em>. Every line on that list has to be met before the certificate opens. The hint is written by the same rule that decides the unlock, so the two can't disagree.</p>
<p>Your GM can also choose to keep locked certificates out of sight until you've unlocked them. In that case you'll only see the ones you've already earned.</p>

<h3>Guild Certificates</h3>
<p>Some certificates go to your guild rather than to you. A guild certificate reads "Awarded to the team" and carries your guild's name. It prints the guild's combined numbers and member count, worked out from its current members when you open it. The guild's level is the members' average. You'll only be offered a guild certificate if you're in a guild.</p>

<h3>The Badge on Your Certificate</h3>
<p>Some certificates print a badge next to your name, and by default it's your current rank. Once you hold a certificate, you can pick a different one: use <strong>Badge shown on it</strong> in the Certificate panel of your Achievements page. It lists the badges and ranks you hold (paths aren't offered). Choose <strong>My current rank</strong> to go back. Levelling up never overrides a badge you picked.</p>

<h3>Printing</h3>
<p>Open a certificate and press <strong>Print or save as PDF</strong>. It uses a fixed, print-safe layout (US Letter, landscape), and only the certificate itself goes to paper, not the app around it. Depending on how your GM set it up, it can show a logo, a headline, your name, your badge, a personal paragraph, a few numbers (level, XP, BLOO, energy), the Adventure's name and dates, and a signature. If you hold more than one, switch between them from the bar above the document.</p>

<h2>Secrets and Clues</h2>
<p>Some milestones carry a hidden "success message" — a bit of story or narrative payoff your GM wrote for finishing that milestone, written specifically to be a) hidden until then and b) worth savoring once. Every one you've unlocked gets collected on your <strong>Secrets and Clues</strong> page — a personal scrapbook of the story content you've earned, separate from the milestones themselves and worth a look if you want the narrative in one place rather than scattered across the Journey Map.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a></li>
  <li><a href="/docs/my-work-journal-and-history">The Journal (My Work)</a></li>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Your Profile Results',
                'slug'       => 'your-profile-results',
                'section'    => 'user',
                'sort_order' => 10,
                'body'       => <<<'HTML'
<p>Some Adventures measure more than what you've learned. They ask questions that build a picture of how you like to play, learn or work. That picture is your <strong>profile</strong>, and it fills in as you answer.</p>

<h2>What a Profile Is</h2>
<p>A profile is a scale made of several <strong>traits</strong>. The well-known HEXAD player-type profile, for example, measures Achiever, Socialiser, Philanthropist, Free Spirit, Player and Disruptor. Each answer you give adds points to one or more traits. Your <strong>headline</strong> is the top-scoring trait that's allowed to be a headline.</p>

<h2>Answering the Questions</h2>
<p>Profile questions are ordinary steps inside milestones, and they come in two shapes:</p>
<ul>
  <li><strong>Pick an answer</strong> — a question with several options. Sometimes you can pick more than one.</li>
  <li><strong>Agree or disagree</strong> — a statement with a row of numbered buttons between two labels, such as "Strongly disagree" and "Strongly agree". Pick one and press <strong>Submit</strong>.</li>
</ul>
<p>They might sit in a milestone of their own. They might also be woven into story milestones, so you answer them without noticing they're part of a profile. There are no right or wrong answers, so answer honestly. Each answer counts the moment you submit it, and your reading builds up as you go.</p>

<h2>Your Result</h2>
<p>When you reach a <strong>Profile Result</strong> step, you see your sheet for that profile:</p>
<ul>
  <li><strong>"You are most…"</strong> — your headline trait, what share of your points it holds, and what it means.</li>
  <li><strong>A chart</strong> with every trait in the profile, including any you scored nothing on, so the shape is yours and comparable with anyone else's.</li>
  <li><strong>The numbers behind it</strong> — traits measured, how many answers it rests on, and points in play.</li>
  <li><strong>Your full mix</strong> — every trait ranked, with its score, its share and a description.</li>
</ul>
<p>Some traits are marked <strong>Measured only</strong>. They're scored and charted but never announced as your headline (the HEXAD treats Player and Disruptor this way). You can score highest on one and still get a different headline, and the sheet says so. If none of a profile's traits can be a headline, you get your full mix with no single headline. If you reach the result before answering anything, it tells you nothing has been measured yet.</p>
<p>A trait can also come with an achievement, awarded when that trait is your headline.</p>

<h2>What You Won't See</h2>
<p>Your sheet never shows your answers back, and nothing shows how much each answer was worth. That stays on the server, so nobody can work the test to get the result they want.</p>

<h2>Finding It Again</h2>
<p>Your readings live in your <a href="/docs/my-work-journal-and-history">Journal</a>, on the <strong>Profiles</strong> tab, with one sheet per profile. The tab appears as soon as the Adventure measures something, even before you've answered. A reading belongs to the Adventure that measured it, so it isn't shown on My Account.</p>

<h2>Taking It Again</h2>
<p>Retakes are up to your GM, and they're off unless your GM switches them on for that profile. When they're allowed, your sheet has a <strong>Take it again</strong> button, but only if all the questions you answered for that profile sit in one milestone. Pressing it clears your answers and your current result for that profile, then takes you back to the milestone to answer again. It can't be undone. An achievement you already earned from your old headline stays.</p>

<h2>Who Can See Your Reading</h2>
<p>Other players can't. Your GM and the Adventure's other staff can: they can open your Journal, including its Profiles tab, and the Stats page shows how the group came out, including who got which headline.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/my-work-journal-and-history">The Journal (My Work)</a></li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a></li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Journal (My Work): Your Progress & History',
                'slug'       => 'my-work-journal-and-history',
                'section'    => 'user',
                'sort_order' => 11,
                'body'       => <<<'HTML'
<p>The Journal is your full record inside one Adventure: how far you've come, what you've handed in, how your quizzes went, your skills and your profile results. It's called <strong>Journal</strong> in the menu and the page itself is headed <strong>My Work</strong>. Your organization can rename it, so it may carry a different name for you.</p>

<h2>Journey Progress</h2>
<p>A <strong>Journey Progress</strong> panel sits above the tabs, so it stays in view whichever tab is open. It shows your overall percentage, a progress bar and "X of Y milestones". It's the same number as the Journey Map's progress widget, and the same one any "complete N% of the journey" unlock checks. It rounds down, so it never says 100% while a milestone is left.</p>

<h2>The Tabs</h2>
<p>Each section is its own tab. The open tab is kept in the page address, so refreshing or sharing the link brings you back to the same one.</p>
<ul>
  <li><strong>Skills</strong> and <strong>Skill History</strong> — only when the Adventure has a skill catalogue. When it does, Skills opens first.</li>
  <li><strong>Overview</strong> — opens first when there are no skills.</li>
  <li><strong>Quests</strong></li>
  <li><strong>Challenges</strong></li>
  <li><strong>Profiles</strong> — only when the Adventure measures a profile.</li>
</ul>

<h2>Skills</h2>
<p>A spider chart of your skills, each in its own colour, all on one scale and always in the same order. With fewer than three skills it draws bars instead. Beside it are four quick facts: your skill points (next to the average for active players), how many skills you've started, your strongest skill, and how many points came from other players through gifts and endorsements.</p>
<p>Click a skill to see what it means, your level out of its maximum, where its points came from, and the three most recent. <strong>See all</strong> opens Skill History filtered to that skill. Below the chart, every skill is listed, ranked, with its description. See <a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a> for how skills are earned.</p>

<h2>Skill History</h2>
<p>Every skill point you've received, with where it came from. At the top, <strong>Who has recognised you</strong> shows everyone who chose to give you a point. Below that is a table (When, Skill, Points, How, From) you can search, filter by skill or by source, and sort by date or points.</p>

<h2>Overview</h2>
<p>Your personal stats dashboard for this Adventure:</p>
<ul>
  <li>Your rank badge, level, and leaderboard position ("#4 of 120 players"), plus how many days since your last login, last milestone and last activity.</li>
  <li>An <strong>Engagement</strong> gauge scored out of 100: On Fire, Active, Moderate, Cooling Off or Dormant. It weighs how recently you were active, how many milestones you've finished in the last 30 days, how much of the Adventure you've completed, your level against the top level, and your Item Shop activity.</li>
  <li>Your currencies, an XP-over-time chart, and a chart of which kinds of milestones you've completed.</li>
  <li>Progress bars for every milestone (Complete, In Progress or Locked) and every Tabi.</li>
  <li>Your achievements, earned and still locked, your guild's rank and totals, and any SCORM completions.</li>
</ul>

<h2>Quests</h2>
<p>The milestones you've handed in. The tab still uses the app's older word for them. Each row shows the milestone's level and rewards, with a <strong>View</strong> button, and an <strong>Edit</strong> button while it hasn't been graded yet. Once it's graded, it's marked <strong>Graded</strong>.</p>

<h2>Challenges</h2>
<p>Every quiz attempt you've made: pass or fail, your grade and the date. Click an attempt to see each question, the answer you picked, and whether it was right. It's a good way to learn from a quiz you didn't ace the first time.</p>

<h2>Profiles</h2>
<p>If the Adventure measures a profile, this tab holds your sheet for each one, building up as you answer. See <a href="/docs/your-profile-results">Your Profile Results</a>.</p>

<h2>Who Else Can See It</h2>
<p>Your GM can open any player's Journal to check how they're getting on. There's no self-service reset any more. If you need to run a milestone again from scratch, ask your GM: an administrator can clear your record of that one milestone.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/your-profile-results">Your Profile Results</a></li>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a></li>
  <li><a href="/docs/certificates-and-secrets-and-clues">Certificates &amp; Secrets and Clues</a></li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Your Account: Profile, Security & Privacy',
                'slug'       => 'your-account-profile-and-privacy',
                'section'    => 'user',
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>Everything about you as a person, separate from any one Adventure, lives on <strong>My Account</strong>. Open it from your profile panel (click your picture in the top-right corner, then the pencil icon), or from <strong>My Account</strong> in the menu on your Adventures page.</p>
<p>The page has five sections, listed down the left side (across the top on a narrow screen): <strong>Profile</strong>, <strong>Security</strong>, <strong>Billing</strong>, <strong>Transactions</strong> and <strong>Danger Zone</strong>.</p>

<h2>Profile</h2>
<p>Upload a profile picture, edit your first and last name, choose your interface language (U.S. English or Español), and fill in the optional Company Name, Website URL and LinkedIn URL fields and a short bio. Your nickname is shown but can't be changed here. Your email is shown too, and its <strong>Change</strong> button takes you to Security, because changing it needs a confirmation. Changes save as you make them, and there's a <strong>Save</strong> button at the bottom as well.</p>
<p>You'll also see a <strong>Player Level</strong> that's different from any single Adventure's level: it's the average across every Adventure you're enrolled in.</p>
<p>Looking for your personality-test results? They live inside the Adventure that measured them, on your Journal's Profiles tab. See <a href="/docs/your-profile-results">Your Profile Results</a>.</p>

<h2>Security</h2>
<ul>
  <li><strong>Password</strong> — enter your current password, then the new one twice (at least 8 characters), and press <strong>Update Password</strong>.</li>
  <li><strong>Email Address</strong> — enter the new address and your current password, then press <strong>Send Confirmation Link</strong>. The link goes to the <em>new</em> address. Nothing changes until you click it, and it's valid for an hour.</li>
</ul>

<h2>Billing</h2>
<p>If you pay for a plan, the <strong>Subscription</strong> panel shows your plan and its status (for example Active, Free trial or Payment overdue), when it renews or ends, and a <strong>Manage billing</strong> button that opens the billing portal. If your last payment failed, a banner here asks you to update your payment method.</p>
<p>No subscription? The panel names the plan your account is actually on, such as Basic, with a <strong>View plans &amp; upgrade</strong> button that opens Subscription &amp; Billing.</p>
<p>Underneath is <strong>Your storage</strong>: a meter showing how much of your plan's file storage you've used and how much is left. It counts the files you upload (pictures, video, audio, your submission uploads and any SCORM packages you add) across every Adventure. If you're ever over your allowance, for example after moving to a smaller plan, you keep everything you've stored but can't upload more until you delete files or upgrade. Administrators have no storage limit.</p>
<p><strong>Billing History</strong> lists every payment with its date, amount and status, with <strong>View</strong> and <strong>PDF</strong> links to the invoice itself. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for what each plan includes.</p>

<h2>Transactions</h2>
<p>Your in-game purchase and spending history across every Adventure you've played: the date, the Adventure, the item or kind of transaction, and the amount. This is BLOO and items, not real money. Real payments are under Billing.</p>

<h2>Staying Signed In</h2>
<p>Sessions last <strong>30 days</strong>. Log in once and you'll stay signed in for a month of ordinary use, rather than being logged out after a couple of hours.</p>
<p>This is deliberate: most people work through an Adventure across weeks, not in one sitting. If you're on a shared or public computer, log out when you're done (the power icon in your profile panel). The long session is a convenience for your own device.</p>

<h2>Danger Zone</h2>
<p><strong>Anonimizer</strong> — only there if your platform has turned it on. Its button reads <strong>Anonimize Me</strong> and asks you to confirm twice. It replaces your name, picture and email with random values while keeping your stats and history under that now-anonymous identity, so an Adventure's reporting stays intact. You lose access to the account once you log out. It's a one-way privacy action, not a "hide my profile" switch.</p>
<p><strong>Delete Account</strong> — enter your current password, type <code>DELETE</code> and press <strong>Delete My Account</strong>. Your account is deactivated immediately and you're signed out for good. Your historical activity (transactions, achievements, guild membership) is kept for Adventure reporting rather than erased. If you have an active subscription, cancel it from Billing first.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/your-profile-results">Your Profile Results</a></li>
  <li><a href="/docs/my-work-journal-and-history">My Work: Your Journal &amp; Progress History</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Getting Help: Requests, Cooper & Guided Tours',
                'slug'       => 'getting-help-support-and-chat',
                'section'    => 'user',
                'sort_order' => 13,
                'body'       => <<<'HTML'
<p>Stuck, short of time, or not sure where to look? There are several ways to get help inside an Adventure. Which ones you see depends on how your Game Master has set it up.</p>

<h2>Asking for a Deadline Extension</h2>
<p>The speech-bubble button in the taskbar at the bottom of the screen (hover it and it reads <em>Deadline extension request</em>) opens a short form for asking your Adventure's admins for more time on a module:</p>
<ul>
  <li><strong>Which module</strong> — the milestone or module you need more time for.</li>
  <li><strong>Extension needed until</strong> — the date you're asking for. It can't be in the past.</li>
  <li><strong>Why do you need more time</strong> — a sentence or two is plenty.</li>
</ul>
<p>All three are required. Press <strong>Send request</strong> and the date you picked is added to the top of your message, so whoever reads it sees it straight away.</p>

<h2>My Requests</h2>
<p><strong>My Requests</strong>, in the menu's Adventure Navigation section, lists every request you've sent in this Adventure with its status: <strong>Pending</strong>, <strong>Read</strong>, <strong>Resolved</strong> or <strong>Dismissed</strong>. Filter the list by All, Pending, Resolved or Dismissed. If an admin writes back, their note appears under your request as <strong>Admin response</strong>. <strong>New Request</strong> opens the same form as the taskbar button.</p>

<h2>Cooper, the In-App Assistant</h2>
<p>If your Adventure has <strong>Cooper</strong> switched on, a button in the taskbar opens a chat panel. Cooper runs inside BLUERABBIT and can see where you are in this Adventure, so it's good for questions like "What can I do right now?", "How am I doing so far?" or "I'm stuck, where should I look?" (the chat offers those as starting points). It will guide you, but it won't hand you answers.</p>
<p>Your Adventure may give the assistant a different name, picture and personality, a character from its story for example. It's the same assistant underneath, and the same rules apply however it talks. If you don't see the button, the assistant isn't on for this Adventure.</p>

<h2>Emailing Support</h2>
<p>The <strong>Email Support</strong> button (a warning sign) in the top-right corner of the screen opens a new email in your mail app, addressed to your Adventure's support address. Your Game Master can set that address; if they haven't, it goes to your platform's default support address.</p>

<h2>Your Organization's Own Links</h2>
<p>Your Game Master can add up to three custom buttons to the taskbar, each with its own label, icon and colour. They open in a new tab and often point at your organization's own help channel, an intranet page or a booking link. Hover a button to see its label.</p>

<h2>Asking Other Players</h2>
<p>If the Adventure has a Garden, you can also ask the people around you: post a help request tagged with the skill you need, and anyone who holds it can answer. See <a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a>.</p>

<h2>Guided Tours</h2>
<p>Many screens have a short guided tour, among them the Journey map, milestones, the Garden, Tasks, the Item Shop, the Wall, the Leaderboard and your Journal. A tour starts on its own the first time you open that screen. Once you've started or skipped it, it waits for you: press the <strong>?</strong> button (<em>Start Tutorial</em>) in the top-right corner to run it again. The <strong>?</strong> only appears on screens that have a tour.</p>
<p>Tours are remembered for you, not per Adventure, so you won't sit through the same one in every Adventure you join. The Journey map's tour is the exception: it's remembered per Adventure.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a></li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a></li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Garden — An Overview',
                'slug'       => 'the-garden-overview',
                'section'    => 'user',
                'sort_order' => 14,
                'body'       => <<<'HTML'
<p>BLUERABBIT has two play areas, not one. The <a href="/docs/journey-map-guide">Journey</a> is your <em>individual</em> progression: milestones, XP, levels, achievements. The <strong>Garden</strong> is your <em>relational</em> progression: a living picture of who you actually work with, and how well you keep those relationships going.</p>
<p>Where the Journey answers "how am I growing?", the Garden answers "who am I growing with?"</p>
<p>If your adventure has the Garden switched on, it has its own entry in the menu. You can also choose to start each visit in the Garden rather than on the Journey. See <a href="/docs/finding-your-way-around">Finding Your Way Around</a>.</p>

<h2>What You See</h2>
<p>Everyone enrolled in your adventure appears as a hexagon with their photo (or initials): other players, NPCs and your Game Masters, arranged in rings around you at the centre. Each adventure has its own Garden, just as it has its own Journey.</p>
<p>Three things about each hexagon are worked out from what actually happens between you:</p>
<ul>
  <li><strong>Distance is how often you interact.</strong> The people you deal with most sit closest to you. Everyone else fills the outer rings.</li>
  <li><strong>Colour is what they're best at.</strong> A person's hexagon takes the colour of their <em>master skill</em>, whichever skill they've earned the most in. People who share a master skill share a colour, so clusters of expertise show up at a glance. Someone with no skills yet shows in a neutral blue.</li>
  <li><strong>Brightness is how recently you were in touch.</strong> Someone you interacted with today is in full colour. The longer it's been, the more their hexagon drains of colour: a little after a day, more after a week, more again after a month. After <strong>60 days</strong> without contact they're fully grey, exactly like someone you've never interacted with. They stay on the map and you can still click them. Any real contact brings them straight back.</li>
</ul>
<p>Your own hexagon at the centre has a gold border and never fades.</p>

<h2>Connections</h2>
<p>Everything above is derived from your activity. <strong>Connections</strong> are the one thing on the map you <em>state</em>: a way of saying "this person matters to me", whether or not you've spoken lately.</p>
<ul>
  <li>Click someone and choose <strong>Connect</strong>. They get a request, which they can <strong>Accept</strong> or <strong>Dismiss</strong>. Until then you'll see <em>Request sent</em>, with a <strong>Cancel</strong> button.</li>
  <li>If you both ask each other, you're connected straight away.</li>
  <li>Either of you can <strong>Disconnect</strong> at any time.</li>
</ul>
<p>A connection is pulled to the centre of your Garden, ahead of everyone else, and gets a gold halo around its hexagon. The halo doesn't stop the fading: a connection you haven't spoken to in months greys out like anyone else. The halo says they matter to you. It doesn't mean you're in touch.</p>
<p>The <strong>Connections</strong> panel lists requests waiting on you (under <em>Waiting on you</em>) and everyone you're connected to.</p>

<h2>The Backdrop</h2>
<p>The Garden's background gets richer as your skills grow. It compares your total Blooms with the average for players in your adventure who have earned any, and shows one of five states:</p>
<ul>
  <li><strong>Dormant</strong>: nothing earned yet.</li>
  <li><strong>First signs</strong>: under a quarter of the average.</li>
  <li><strong>Growing</strong>: a quarter to half of the average.</li>
  <li><strong>Healthy</strong>: half the average, up to the average.</li>
  <li><strong>Full bloom</strong>: at or above the average.</li>
</ul>
<p>This is independent of how many people you know. A Garden can be bright but empty (strong skills, few relationships) or full but dull (lots of relationships, few skills). Your current state is written out in the Garden section of your profile box, which opens when you click your picture in the corner of the screen.</p>

<h2>Moving Around</h2>
<p>Drag the canvas to pan. The zoom control shows the current percentage, with <strong>−</strong> and <strong>+</strong> buttons and a <strong>⦾</strong> button that recentres on you. The mouse wheel zooms around your pointer, and you can pinch on a touch screen.</p>
<p>Click anyone to open their drawer: their skills, recent wall posts, any open help requests, and buttons to message them, connect, endorse them or gift a Bloom. Click your own hexagon to open yours, with your Blooms left to give, a box to ask for help, and your own requests.</p>

<h2>The Dock and Its Panels</h2>
<p>The canvas is deliberately mostly empty. Everything else sits in a dock at the bottom right:</p>
<ul>
  <li><strong>Business</strong>: your balance, your energy against its cap, and how many encounters are still out there. The button shows a <strong>!</strong> if your balance has gone below zero. See <a href="/docs/encounters-the-card-draw">Encounters</a>.</li>
  <li><strong>Tasks</strong>: things that improve you.</li>
  <li><strong>Missions</strong>: things you do with other people.</li>
  <li><strong>Help</strong>: ask for help, and see ways to help others.</li>
  <li><strong>Connections</strong>: requests and the people you're connected to.</li>
  <li><strong>Rewards</strong>: Blooms waiting for you to claim.</li>
  <li><strong>Messages</strong>: your direct messages.</li>
</ul>
<p>Business, Tasks, Missions, Help and Connections open as floating panels. Drag a panel by its header to move it, and press <strong>−</strong> to minimise it back to the dock. Your layout is remembered for each adventure on the browser you're using. Rewards, Messages and any help request you open appear as windows on top of everything else. Badges on the dock buttons show counts, such as unread messages and rewards to claim.</p>

<h2>Tasks and Missions</h2>
<p>Two of those panels are the Garden's core mechanics, and they do opposite jobs:</p>
<ul>
  <li><strong><a href="/docs/garden-tasks">Tasks</a> improve you.</strong> Build a habit, practise something, do the work, and your own skills and level grow.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a> improve your Garden.</strong> Reach out to other people, and the relationships around you get healthier.</li>
</ul>
<p>The way to remember it: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>

<h2>Rewards You Claim</h2>
<p>Some Blooms land the moment they're earned: endorsements, gifts, asking for help, and Task rewards. Others wait in <strong>Rewards</strong> until you collect them: a finished Mission, help of yours that someone approved, and Blooms your Game Master awarded to a group. Open Rewards and press <strong>Claim</strong>. Nothing is added to your skills until you do.</p>

<h2>How the Journey Feeds the Garden</h2>
<p>The two halves aren't separate games. Milestones and achievements can award <a href="/docs/skills-and-blooms-explained">Blooms</a> in a skill, and skills are what the Garden runs on. They set your colour, they're what people recognise you for, and they're what help requests are tagged with.</p>
<p>Look for the <strong>?</strong> help button for a short guided tour of the Garden.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a>: the currency underneath all of it</li>
  <li><a href="/docs/giving-blooms-endorsements-and-gifts">Giving Blooms</a>: the two ways to recognise someone</li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a>: asking for help and giving it</li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a>: growing yourself</li>
  <li><a href="/docs/garden-missions">Garden Missions</a>: growing the Garden</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Skills & Blooms Explained',
                'slug'       => 'skills-and-blooms-explained',
                'section'    => 'user',
                'sort_order' => 15,
                'body'       => <<<'HTML'
<p>Skills and Blooms are the two ideas the whole Garden rests on. They're simpler than they first look, because they're really the same thing seen from two directions.</p>

<h2>Skills</h2>
<p>Every adventure has its own catalogue of skills, set up by your Game Master. A skill can be a broad competency ("Communication and Listening", "Problem Solving") or a narrow capability ("Mentor"). Each has its own colour, and many have an icon or image and a short description. Hover a skill chip in the Garden to read what it means.</p>
<p>You hold a <strong>level</strong> in each skill, and that level is simply a count: <strong>one Bloom in a skill is one level in it</strong>. No weighting, no decay, no formula. Twenty Blooms in Resilience is level 20 in Resilience. Each skill has a maximum level set by your Game Master, and Blooms past it don't raise it any further.</p>
<p>Your highest skill is your <strong>master skill</strong>, and it sets your hexagon's colour in the Garden. If two skills are tied at the top, the app picks one consistently.</p>

<h2>Blooms</h2>
<p>Blooms are recognition made countable. A Bloom is always awarded <em>in a specific skill</em>, which is why receiving them builds a real picture of what you're known for rather than one meaningless score.</p>
<p>Blooms reach you in several ways:</p>
<ul>
  <li><strong>Endorsements</strong> from other players: 2 Blooms in the skill they choose. See <a href="/docs/giving-blooms-endorsements-and-gifts">Giving Blooms</a>.</li>
  <li><strong>Gifts</strong> from other players: 1 Bloom each.</li>
  <li><strong>Asking for help</strong>: 1 Bloom in the skill you ask about, once per skill every 24 hours. See <a href="/docs/help-requests-and-messages">Help Requests</a>.</li>
  <li><strong>Helping someone</strong>: 2 Blooms in the request's skill when the person you helped approves your reply.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a></strong>: whatever your Game Master set for that Mission.</li>
  <li><strong><a href="/docs/garden-tasks">Tasks</a></strong>: a Task can pay Blooms in one skill.</li>
  <li><strong>The Journey</strong>: a milestone or achievement can award a Bloom in a skill when you complete or earn it.</li>
  <li><strong>Your Game Master</strong>: a direct award for something the system can't see by itself, or an award to a whole group at once.</li>
</ul>

<h2>Instant or Claimed</h2>
<p>Most Blooms land the moment they're earned. Three kinds wait for you instead: Mission rewards, approved help, and group awards from your Game Master. They arrive in <strong>Rewards</strong> in the Garden dock, each with a button such as <strong>Claim 2 Blooms</strong>. Your skill level only goes up when you press it.</p>

<h2>Seeing Your Skills</h2>
<ul>
  <li><strong>Your Journal</strong> opens on a <strong>Skills</strong> tab when your adventure has a skill catalogue: a chart with each skill in its own colour, a card per skill showing where its points came from, and every skill's description. The <strong>Skill History</strong> tab lists every Bloom you've ever received: when, what it was for, and who gave it. See <a href="/docs/my-work-journal-and-history">My Work: Your Journal</a>.</li>
  <li><strong>Your profile box</strong> has a Garden section: Blooms earned, where that stands against the adventure (see <a href="/docs/the-garden-overview">The Backdrop</a>), your strongest skill, your connections and your Blooms left to give.</li>
  <li><strong>Anyone's drawer</strong> in the Garden shows the skills they hold and their level in each.</li>
</ul>
<p>Every grant is recorded permanently with its source. Nothing about your skill levels is guesswork.</p>

<h2>What Blooms Can Unlock</h2>
<p>Your Game Master can use Blooms as a requirement elsewhere in the adventure: an achievement that's granted once you reach a level in a skill, a Task that completes when you do, or a chapter of the Journey whose artwork grows with your Blooms.</p>

<h2>Why It's Built This Way</h2>
<p>Because it's the honest version. A generic points score tells you someone is active. A skill level tells you what they're actually good at, who thought so, and when. It also makes the Garden's colours mean something real rather than being a palette.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/the-garden-overview">The Garden: An Overview</a></li>
  <li><a href="/docs/giving-blooms-endorsements-and-gifts">Giving Blooms: Endorsements and Gifts</a></li>
  <li><a href="/docs/my-work-journal-and-history">My Work: Your Journal</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Giving Blooms — Endorsements and Gifts',
                'slug'       => 'giving-blooms-endorsements-and-gifts',
                'section'    => 'user',
                'sort_order' => 16,
                'body'       => <<<'HTML'
<p>There are two ways to recognise another player, and they're deliberately different. Click anyone in the Garden to open their drawer, and you'll find both.</p>

<h2>Award Blooms (Endorsement)</h2>
<p>Pick a skill from the list and press <strong>Award Blooms</strong>. This is your everyday recognition: "Maria genuinely helped me with this."</p>
<ul>
  <li>Worth <strong>2 Blooms</strong> in the skill you choose, straight away</li>
  <li>You can endorse <strong>the same person for the same skill once every 24 hours</strong>. Try again sooner and you'll see "You've already endorsed them for this skill today".</li>
  <li>There's no overall limit. You're not spending anything.</li>
  <li>You can't endorse yourself.</li>
</ul>
<p>The 24 hours are per person <em>and</em> per skill. You can endorse the same colleague for a different skill on the same day, and endorse as many different people as you like.</p>

<h2>Gift a Bloom</h2>
<p>Gifts are the scarce version, and scarcity is the point.</p>
<ul>
  <li>You start with <strong>20 Blooms to give</strong> in each adventure.</li>
  <li>Each gift is worth <strong>1 Bloom</strong> in the skill you choose, and lands straight away.</li>
  <li>They go <strong>one at a time</strong>. Press <strong>Gift 1 Bloom</strong> and there's no way to send a batch.</li>
  <li>Every gift asks you to confirm first, because it can't be undone.</li>
  <li>You can't gift to yourself.</li>
</ul>
<p>Your remaining balance shows next to <em>Gift a Bloom</em> in anyone's drawer, in your own drawer under <em>Blooms to give</em>, and in your profile box. When you run out, the button is replaced by "You're out of Blooms to give right now."</p>
<p>The Gift button is amber and the endorsement button is green, so you never mistake a limited gift for an unlimited endorsement.</p>

<h2>Running Out</h2>
<p>Twenty is meant to make you think about who deserves one. Because they're finite, a gifted Bloom carries weight an endorsement doesn't: you gave something up to send it.</p>
<p><strong>Gift Blooms don't refill on their own.</strong> Nothing tops them up on a timer or for completing anything. Your Game Master can reset your balance, and that's the only way to get more today.</p>

<h2>What Else They Count For</h2>
<p>Both are real contact with that person, so their hexagon comes back to full colour in your Garden. Your Game Master may also run a <a href="/docs/garden-missions">Mission</a> that counts endorsements or gifts. If a Mission asks you to gift, those gifts still come out of your own 20.</p>
<p>Every endorsement and gift you receive is listed in your Journal's <strong>Skill History</strong>, with who sent it.</p>

<h2>Which Should You Use?</h2>
<p>Endorse freely. It's the low-effort way to keep recognition flowing, and the 24-hour rule already stops it becoming noise. Save gifts for the moments that genuinely stood out.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a></li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a></li>
  <li><a href="/docs/garden-missions">Garden Missions</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Help Requests and Messages',
                'slug'       => 'help-requests-and-messages',
                'section'    => 'user',
                'sort_order' => 17,
                'body'       => <<<'HTML'
<p>The Garden isn't only about recognising work that already happened. It's built to get people talking in the first place.</p>

<h2>Asking for Help</h2>
<p>You can ask from three places:</p>
<ul>
  <li>the <strong>Help</strong> panel in the Garden dock (<em>Stuck on something?</em> then <strong>Ask for help — +1 Bloom</strong>)</li>
  <li>your own drawer, opened by clicking your hexagon (<strong>Post request</strong>)</li>
  <li>the <strong>Help Board</strong> page (<strong>Post request — +1 Bloom</strong>)</li>
</ul>
<p>Every request is <strong>tagged with a skill</strong>. That's required, and it's what lets the right people find it instead of it disappearing into a general feed.</p>
<p>Asking pays <strong>1 Bloom</strong> in that skill, <strong>once per skill every 24 hours</strong>. You can post more requests in the same skill whenever you need to. They just don't pay again until the 24 hours are up, and the confirmation tells you so.</p>

<h2>Choosing Who Helped</h2>
<p>Your open requests appear in the Help panel under <em>You asked for</em>, showing either "Waiting for an answer" or how many people have offered to help. Click one to open the conversation.</p>
<ul>
  <li><strong>Several people can reply</strong>, and you can approve every reply that helped. Press <strong>This helped</strong> on each one.</li>
  <li>Each person you approve earns <strong>2 Blooms</strong> in the request's skill, which they collect from their Rewards.</li>
  <li><strong>Your first approval closes the request to new replies.</strong> You then have 24 hours to approve any other replies that were already posted. A banner shows when that window ends.</li>
  <li>After 24 hours, any reply you didn't approve closes on its own, marked "Another player already helped solve this", with no reward.</li>
  <li>You can close an open request yourself at any time: <strong>Close</strong> in your drawer, or <strong>Close without a reply</strong> on the Help Board.</li>
</ul>

<h2>Answering Someone Else</h2>
<p>The Help panel's <strong>Ways to help</strong> list shows other people's open requests, with the ones in skills you hold first. Press <strong>Help</strong> on a card to open it, write your answer and press <strong>Offer to help</strong>. You'll also find a person's open requests under <em>Needs help</em> in their drawer.</p>
<ul>
  <li>You get one reply per request, and you can't reply to your own.</li>
  <li>Your reply shows "Waiting for review" until the asker decides.</li>
  <li>If they approve it, it's marked "Approved — earned Blooms" and a reward appears in your <strong>Rewards</strong>: press <strong>Claim</strong> to collect your 2 Blooms.</li>
</ul>
<p>Offering help is real contact with that person, so their hexagon returns to full colour. It also counts toward any <a href="/docs/garden-missions">Mission</a> that asks you to help someone, as soon as you post it.</p>

<h2>The Help Board</h2>
<p>Follow <strong>Open the Help Board</strong> from the Help panel for the full page: your own requests with their replies, and every open request in the adventure. Some cards carry a "Matches one of your top skills" badge.</p>

<h2>Direct Messages</h2>
<p>You can message anyone in your adventure one-to-one, from <strong>Messages</strong> in the dock or the <strong>Message</strong> button in their drawer. Conversations are private between the two of you, belong to the adventure you're both in, and are the same conversations you see in the Wall's Messages tab.</p>
<p>Unread messages show a badge on the dock button.</p>
<p>Your Game Master may also place a <em>Ways to help</em> list or a Messages button on the Journey map, so you can do both without leaving it.</p>

<h2>What Counts as Contact</h2>
<p>These refresh someone's hexagon in your Garden: messages in either direction, a reply to a help request, approving a reply, endorsements, gifts, a connection being accepted, and a Game Master awarding you skill points directly.</p>
<p>A wall post doesn't count as contact with anyone in particular, and neither does posting a help request. Nothing keeps a relationship bright without actually interacting with the person, which is intentional.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/the-garden-overview">The Garden: An Overview</a></li>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a></li>
  <li><a href="/docs/garden-missions">Garden Missions</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Garden Tasks',
                'slug'       => 'garden-tasks',
                'section'    => 'user',
                'sort_order' => 18,
                'body'       => <<<'HTML'
<p><strong>Tasks are how you improve yourself.</strong> They're the Garden's mechanic for getting better at something: build a habit, practise a skill, do the thing you said you'd do. They pay out in your own progression: XP, BLOO, energy and skill levels.</p>
<p>That's the whole difference between the Garden's two mechanics:</p>
<ul>
  <li><strong>Tasks improve you.</strong> You get better, you level up, your skills grow.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a> improve your Garden.</strong> You reach out to other people, and the relationships around you get healthier.</li>
</ul>
<p>The shortest version: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>

<h2>What a Task Looks Like</h2>
<p>Your Game Master writes Tasks. Each has instructions, its rewards, and a badge showing how often you can do it:</p>
<ul>
  <li><strong>One time</strong>: do it once, and it's done.</li>
  <li><strong>Unlimited</strong>: repeat it as often as you like.</li>
  <li><strong>Every …</strong> (for example, <em>Every 1d</em> for once a day): repeatable, with a wait between goes. A countdown ring on the card shows exactly when it's back.</li>
</ul>

<h2>How a Task Completes</h2>
<p>Some Tasks you complete yourself. Others notice what you did and complete on their own:</p>
<ul>
  <li><strong>Press Complete</strong>: the honour system. You did the thing, you say so.</li>
  <li><strong>Scan a QR code</strong>: proof you were physically somewhere. The card may show the code, or it may say "Find the QR code and scan it to complete this task", because the code is only displayed somewhere you have to go. These Tasks repeat, and after the wait you scan again to do it again. If your Game Master replaces a code, older photos of it stop working.</li>
  <li><strong>Finish any milestone</strong>: completes the next time you finish anything on the Journey.</li>
  <li><strong>Finish one particular milestone</strong>: tied to one piece of content.</li>
  <li><strong>Log in each day</strong>: the habit mechanic. It completes on your first visit of the day.</li>
  <li><strong>Meet a set of requirements</strong>: "Completes itself the moment you meet the requirements". For example, reach a level, or finish three milestones within seven days. See <a href="/docs/conditions-when-things-unlock">Conditions</a>.</li>
</ul>

<h2>Tasks on a Clock</h2>
<p>Some Tasks give you a set time to finish. They show a button such as <strong>Start — 5d to finish</strong>. The clock is yours, starting when <em>you</em> press Start, so someone who reaches the Task a week after you still gets the full time.</p>
<ul>
  <li>You can't complete it until you've pressed Start. Pressing it again doesn't restart the clock.</li>
  <li>While it runs, the card counts down the time left to finish.</li>
  <li>On a Task that completes when you meet requirements, only progress made <em>after</em> you pressed Start counts.</li>
  <li>If time runs out, nothing is paid. Depending on the Task, you can start again, or it was a single attempt and the card says <strong>Missed</strong>.</li>
</ul>

<h2>What You Get</h2>
<p>A Task can pay any mix of:</p>
<ul>
  <li><strong>XP</strong> and <strong>BLOO</strong>, the same <a href="/docs/xp-bloo-ep-explained">Journey currencies</a> everything else pays</li>
  <li><strong>Energy</strong>, which is how you win back what you spend in <a href="/docs/encounters-the-card-draw">encounters</a></li>
  <li><strong>Blooms in one skill</strong>, which is what ties Tasks to the Garden: doing the work raises the skill you're known for, and that's what colours your hexagon</li>
</ul>
<p>When a Task pays out, a panel shows exactly what you earned. Task rewards land straight away, with nothing to claim.</p>

<h2>Where to Find Them</h2>
<ul>
  <li>The <strong>Tasks</strong> panel in the Garden dock shows a few at a time, with the ones you can do now first, and a <strong>View all</strong> link to the full Tasks page.</li>
  <li>The Tasks page also has its own entry in the menu when your adventure uses Tasks.</li>
  <li>On the Journey map, your Game Master may place a Tasks list, or draw a single Task as a hexagon. Click the hexagon to open the same card. It shows whether the Task is ready, waiting, on the clock or done.</li>
</ul>
<p>Your organization may use a different name for Tasks. They work the same way.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/garden-missions">Garden Missions</a>: the other half, growing the Garden rather than yourself</li>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a>: what the rewards actually mean</li>
  <li><a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Garden Missions',
                'slug'       => 'garden-missions',
                'section'    => 'user',
                'sort_order' => 19,
                'body'       => <<<'HTML'
<p><strong>Missions are how you improve your Garden.</strong> Where a <a href="/docs/garden-tasks">Task</a> makes <em>you</em> better, a Mission makes the <em>relationships around you</em> better. It's a nudge to reach out, connect, and do the social things you might otherwise put off. Missions pay out in <a href="/docs/skills-and-blooms-explained">Blooms</a>.</p>
<p>The shortest version: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>
<p>Missions are separate from the Journey. Finishing a milestone never completes one. Only real interaction with real people does.</p>

<h2>Who Sets Them</h2>
<p>Your Game Master writes Missions, and you only see the ones meant for you. A Mission can be for everyone in the adventure, for particular guilds, for named players, for anyone holding a particular achievement, or for players on a particular branch of the story. Two people in the same adventure can see different Missions.</p>

<h2>What a Mission Asks of You</h2>
<p>Some Missions you simply do and then press <strong>Mark done</strong>. Most count what you actually do, and complete on their own when you reach the target. The card says what counts, for example "Message 3 times to complete this automatically", and shows your progress (1/3).</p>
<p>What a Mission can count:</p>
<ul>
  <li><strong>Message</strong>: direct messages you send</li>
  <li><strong>Help</strong>: help you offer on someone's request</li>
  <li><strong>Endorse</strong>: endorsements you give</li>
  <li><strong>Ask for help</strong>: help requests you post</li>
  <li><strong>Get a request solved</strong>: as the app counts it today, this goes up when someone marks your reply as one that helped</li>
  <li><strong>Gift a Bloom</strong>: gifts you give, which still come out of your own 20</li>
  <li><strong>Post on the Wall</strong>: posts you make on the Wall</li>
  <li><strong>Make a connection</strong>: connection requests you accept</li>
</ul>
<p>A few things worth knowing about the counting:</p>
<ul>
  <li>It starts when the Mission is live for you. What you did before doesn't count.</li>
  <li>It counts each action, not each person. Three messages to the same colleague count as three.</li>
  <li>Each Mission completes once.</li>
</ul>

<h2>Tracking and Rewards</h2>
<p>The <strong>Missions</strong> panel in the Garden dock shows the Missions you haven't finished first, with a <strong>View all</strong> link to the full Missions page.</p>
<p>When you finish one, its card says "Complete — check your notifications to claim it!" and a reward appears in <strong>Rewards</strong> in the dock. Press <strong>Claim</strong> and the Blooms land, in the skill your Game Master chose. The card then reads "Completed and claimed". Missions pay Blooms, never XP or BLOO.</p>

<h2>What Isn't a Mission</h2>
<ul>
  <li><strong>Anything you can do alone.</strong> Practising, showing up, finishing content: that's a Task.</li>
  <li><strong>Anything on the Journey.</strong> Milestones and challenges never count toward a Mission.</li>
  <li><strong>Getting back in touch.</strong> There's no Mission that counts reconnecting with someone you've drifted from. The fading on the canvas is your prompt for that, and any real contact brings their hexagon straight back.</li>
</ul>

<h2>Finding Someone to Help</h2>
<p>The <strong>Help</strong> panel's <em>Ways to help</em> list is where the need is. It shows open requests from other players, with the ones in skills you hold first, so the people it points you toward are people you're well placed to help.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/garden-tasks">Garden Tasks</a>: the other half, growing yourself rather than the Garden</li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a>: where the need a Mission points at comes from</li>
  <li><a href="/docs/giving-blooms-endorsements-and-gifts">Giving Blooms</a></li>
</ul>
HTML,
            ],
            // ---------------------------------------------------------
            // Setup docs — for Game Masters and org admins. Titles ending in
            // ' (Enterprise)' are split into their own group on the /docs hub
            // by Docs::index().
            // ---------------------------------------------------------
            [
                'title'      => 'Setting Up Your Organization',
                'slug'       => 'setting-up-your-organization',
                'section'    => 'setup',
                'sort_order' => 1,
                'body'       => <<<'HTML'
<p>This is the setup flow for the person who will run Adventures: the account owner, facilitator or L&amp;D lead. If you were invited to play in an Adventure someone else runs, see <a href="/docs/getting-started">Getting Started</a> instead.</p>

<h2>1. Create Your Account and Pick a Plan</h2>
<p>Sign up at the app, and your account starts on <strong>Basic</strong>: free, no credit card. The three plans differ in how much room they give you:</p>
<ul>
  <li><strong>Basic</strong>: free. Up to 90 players across your account, 3 Adventures, 50MB of storage.</li>
  <li><strong>Pro</strong>: $8/mo or $80/yr, with a 30-day free trial. Up to 250 players across your account, 20 Adventures, 200MB of storage.</li>
  <li><strong>Enterprise</strong>: no player, Adventure or storage limits, and it's set up with our team. See <a href="/contact">Contact</a>.</li>
</ul>
<p>You can upgrade at any time from <strong>Subscription &amp; Billing</strong> inside the app. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for how that works, or the <a href="/pricing">Pricing</a> page for the side-by-side comparison.</p>

<h2>2. Create Your First Adventure</h2>
<p>From <strong>My Adventures</strong>, choose <strong>New Adventure</strong> to start from a blank canvas, or <strong>From a Template</strong> to start from a ready-made program. Nothing is final on the first pass; everything is editable later. The full walkthrough is <a href="/docs/building-your-first-adventure">Building Your First Adventure</a>.</p>
<p>Whether an account can create Adventures at all is a platform setting. On most platforms it's on. If you don't see those buttons, ask your platform administrator.</p>

<h2>3. Bring in Your Co-Facilitators</h2>
<p>Running an Adventure alone is hard work. Add other people as <strong>GMs</strong> (game masters, who build and run the Adventure) or <strong>NPCs</strong> (read-only supervisors who see everything a GM sees but change nothing). Roles are set per Adventure. See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</p>

<h2>4. When You Need an Organization</h2>
<p>An <strong>Organization</strong> groups one client's Adventures and people together. It's an Enterprise feature, and a platform administrator creates it for you rather than a sign-up step. If you're running one or a few Adventures, you don't need one. If you're coordinating several programs, departments or cohorts under one relationship, see <a href="/docs/organizations-managing-multiple-adventures">Organizations</a>.</p>

<h2>Where to Go Next</h2>
<ul>
  <li><a href="/docs/building-your-first-adventure">Building Your First Adventure</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
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
<p>The shortest route from nothing to a journey players can open. Each step links to the page that covers it in depth.</p>

<h2>1. Start From Scratch or From a Template</h2>
<p>On <strong>My Adventures</strong>, <strong>New Adventure</strong> gives you an empty adventure to build from zero. <strong>From a Template</strong> opens the <strong>Template Library</strong>: the published templates on your platform, each card showing who made it, how many milestones, achievements, items and chapters it holds, and how many adventures already use it. Press <strong>Use this template</strong> to create your adventure from one.</p>
<p>An adventure made from a template isn't a copy. It gets its own players, guilds and progress, while the milestones, achievements and items stay shared with the template — so improving the template improves every adventure built from it. If you want an independent copy you can change freely, use <strong>Duplicate</strong> on Manage Adventures instead. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</p>
<p>Whether you see either button depends on your platform's settings; if one is missing, ask your platform admin.</p>

<h2>2. Set the Basics</h2>
<p>Open <strong>Adventure Settings</strong> from the menu's Admin Tools. On <strong>General</strong>, give the adventure its name, dates, image and colour. Then go to <strong>Features</strong> and switch on what you plan to use — Challenges, the Item Shop, Guilds, Tasks, the Garden and the rest. A lot of what follows, from map widgets to menu entries, only appears for features that are on. Every tab is described in <a href="/docs/complete-adventure-settings-reference">The Complete Adventure Settings Reference</a>.</p>

<h2>3. Create Milestones and Challenges</h2>
<p><strong>Add Mechanics</strong> in the menu has <strong>New Milestone</strong> and <strong>New Challenge</strong>. Make a <strong>Milestone</strong> when you're giving players knowledge and a <strong>Challenge</strong> when you're testing it. A milestone is built from Steps — dialogue, video, questions, uploads and more — in the order players meet them. See <a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a> and <a href="/docs/challenges-concept">Challenges</a>.</p>

<h2>4. Set Rewards and Unlock Rules</h2>
<p>On a milestone's <strong>Mechanics</strong> tab, set which Tabi it belongs to, its level, what it pays in XP and BLOO (and EP, if the adventure uses Energy), and a start date and deadline if it has them. Tick <strong>Optional</strong> for an extra that shouldn't count toward finishing its chapter.</p>
<p>The <strong>Advanced</strong> tab holds the extras: a Skill reward for the Garden, an Item Reward, an Achievement Reward, and <strong>Conditions</strong> — other milestones, achievements, a key item or thresholds a player must meet before it unlocks. Conditions become available once the milestone has been saved. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a> and <a href="/docs/conditions-when-things-unlock">Conditions</a>.</p>

<h2>5. Group Milestones Into Chapters</h2>
<p>A <strong>Tabi</strong> is a chapter: one tile on the map that opens onto its milestones, with its own progress bar and its own unlock rule. Build them in the <a href="/docs/tabi-editor">Tabi editor</a> — the name and artwork, which Tabis must be finished first, and which milestones it holds. A Tabi can also carry artwork that evolves as each player progresses; see <a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a>.</p>

<h2>6. Lay Out the Map</h2>
<p>Open <strong>Journey Builder</strong> from Admin Tools. Drag milestones and Tabis to where they belong — new ones all start in the same spot, so at first they may sit on top of each other. The palette along the top adds everything else: graphics, text, live widgets such as a leaderboard or a Tasks panel, single task hexagons and shortcut buttons, each at a depth of your choosing. Positions save when you let go. See <a href="/docs/journey-builder-design-palette">The Journey Builder: Designing the Map</a>.</p>

<h2>7. Check It, Then Invite People</h2>
<p><strong>View journey</strong> in the Journey Builder opens the live map in a new tab. Only milestones with the <strong>Publish</strong> status appear on it; drafts stay out of sight until you publish them. When it looks right, move on to <a href="/docs/enrolling-players-and-roles">enrolling players</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
  <li><a href="/docs/journey-builder-design-palette">The Journey Builder: Designing the Map</a></li>
  <li><a href="/docs/tabi-editor">The Tabi Editor</a></li>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Enrolling Players & Assigning Roles',
                'slug'       => 'enrolling-players-and-roles',
                'section'    => 'setup',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>Everyone in an Adventure holds one role in it, and there are three ways to bring people in: add them yourself, import a CSV, or share the enrollment link. For the day-to-day tools once they're in, see <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>.</p>

<h2>Roles Inside an Adventure</h2>
<ul>
  <li><strong>Player</strong> — the default. Plays the Journey, and the Garden if the Adventure has one.</li>
  <li><strong>GM (Game Master)</strong> — runs the Adventure: edits its content, manages its players, grades, and sends its emails.</li>
  <li><strong>NPC</strong> — a read-only supervisor. An NPC sees everything a GM sees, including Stats, the roster, Player Records, player requests and sent emails, and plays the Adventure like a player, earning and spending like everyone else. An NPC can't change anything: no content edits, no adding or removing people, no email. The one exception is appointing a guild's leader. Use it for someone who needs to watch progress closely without being able to touch it, such as a line manager or a client lead.</li>
  <li><strong>Owner</strong> — the account the Adventure belongs to. The owner has full control and can't be removed or switched to another role.</li>
</ul>
<p>An NPC isn't a character in the story. Characters who speak in your milestones are Speakers; see <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>.</p>

<h2>Admin and God Are Account-Wide</h2>
<p>Admin and God aren't roles inside an Adventure. They're access levels on the account itself, set by a platform admin in User Management, and they apply across the whole platform: an admin can manage every Adventure, Sys Config and user accounts, and only a God can grant or revoke God. See <a href="/docs/user-management-and-access-levels">User Management and Access Levels</a>.</p>

<h2>Adding Players Yourself</h2>
<p>The tools live in two places, and both offer the same thing: the <strong>Players</strong> section of Adventure Settings (Add Players and Add Single Player), and <strong>Admin Tools → Manage Players → Add Players</strong>.</p>

<h3>One at a time, by search</h3>
<p>Type a name, nickname or email into the search box. Several words narrow the results: "ana lopez" finds people matching both words, rather than every Ana and every Lopez. Each result has its own button: <strong>Add</strong> for someone new to this Adventure, <strong>Add back</strong> for someone you removed earlier, or a role badge if they're already in. You can keep adding without reloading the page.</p>
<p>Not on the platform yet? Choose <strong>Can't find them? Create a new account</strong>, enter their email (required) and, optionally, a nickname, name and password, then press <strong>Create and add</strong>. Leave the password blank and one is generated.</p>

<h3>In bulk, from a CSV file</h3>
<ol>
  <li>Choose your file and press <strong>Check file</strong>.</li>
  <li>Review <strong>What will be imported</strong>: how each column was matched, shown before anything is written.</li>
  <li>Press <strong>Start import</strong> and watch the console: rows done, created, enrolled, already in and failed, with an estimate of the time remaining.</li>
  <li>When it finishes, <strong>Download report (incl. generated passwords)</strong> gives you the outcome for every row.</li>
</ol>
<p>Columns are matched <strong>by header name</strong>, so order doesn't matter and every column except <strong>Email</strong> is optional. It recognises Email, Nickname, First Name, Last Name, Name, Password, Language and Guild, plus every field you've set up in the Player Meta Manager. A blank password is generated, a nickname that's already taken gets a suffix, and the <strong>Guild</strong> column puts each person into the guild with that name, creating the guild if it doesn't exist yet.</p>
<p>The file is read in your browser and sent a few rows at a time, so a roster of a thousand people or more imports in one pass without timing out. Keep the tab open until it finishes. It's also safe to repeat: someone already enrolled is reported as <em>already in</em>, never duplicated, and when the run ends the importer checks the roster again and retries anyone who didn't land.</p>

<h3>Into guilds that already exist</h3>
<p>To fill guilds you've already created, use <strong>Assign players to a guild</strong> on the Guilds tab of Manage Content. Pick a guild, choose a CSV with one column of email addresses, and press <strong>Assign from file</strong>. Everyone matched moves into that guild, which replaces any guild they were in before. A guild that reaches its capacity turns the rest away, and running the same file twice changes nothing the second time.</p>

<h2>Letting People Enroll Themselves</h2>
<p>Every Adventure has an <strong>Enrollment Link</strong>, shown in the General section of Adventure Settings and under the Adventure's name on Manage Adventures. Anyone who opens it while signed in is enrolled on the spot and offered a <strong>Start the journey!</strong> button (someone who isn't signed in is sent to the login page first). Treat the link like a key: it works whatever the Adventure's Privacy setting says, so share it only with the people you mean to invite.</p>
<p>Two things stop it:</p>
<ul>
  <li><strong>Templates.</strong> A template can't be joined this way. Players join one of its cohorts instead; see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</li>
  <li><strong>Max Players per Adventure</strong>, in the Features section of Adventure Settings. If you set it, the link refuses newcomers once that many people are enrolled. It's your own limit for this one Adventure, it's checked only by the link, and adding people yourself isn't blocked by it.</li>
</ul>

<h2>Changing Roles and Removing People</h2>
<p>Switch roles on the <strong>Players</strong> section of Adventure Settings: each row has a Player / GM / NPC switch. Making someone a GM asks for a second click to confirm, and the GM option only appears when your platform allows more than one Game Master. The owner's row can't be changed.</p>
<p>Removing someone is a two-click confirm: press <strong>Remove</strong>, then press it again. It doesn't delete their progress. They move to the Inactive list on Manage Players, and <strong>Activate</strong> brings them back with everything intact. A GM can't be removed directly; switch them to Player first.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
  <li><a href="/docs/user-management-and-access-levels">User Management and Access Levels</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Adventure Templates & Scaling Cohorts',
                'slug'       => 'adventure-templates-and-cohorts',
                'section'    => 'setup',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<p>If you run the same program again and again (a monthly new-hire class, a bootcamp that restarts every term, the same training for several departments), build it once as a <strong>template</strong> and run each group as a <strong>cohort</strong> of it. The content lives on the template and every cohort reads it live. Each cohort keeps its own players, guilds and progress.</p>

<h2>Templates</h2>
<p>A template is an ordinary Adventure whose <strong>Adventure Type</strong> is set to <em>Template</em> in the General section of Adventure Settings. Only platform admins see that field. You build milestones, challenges, achievements, items and Tabis on the template exactly as you would anywhere else. Players can't join a template directly (its enrollment link turns them away); they join one of its cohorts.</p>

<h2>Starting a Cohort</h2>
<p>On <strong>My Adventures</strong>, choose <strong>From a Template</strong> to open the <strong>Template Library</strong>. Each card shows who built the template, how many milestones, achievements, items and chapters it holds, and how many Adventures already use it. Press <strong>Use this template</strong> and a new cohort is created, named after the template with <em>[new child]</em> on the end, with you as its owner; continue from the confirmation to its Journey. The cohort has its own name and dates: an admin, or a GM of the cohort, changes them from <strong>Edit</strong> on Manage Adventures.</p>
<p>The Template Library is always available to admins. Everyone else sees it when the platform allows creating Adventures from a template.</p>

<h2>What the Template Shares, Live</h2>
<p>A cohort doesn't get a copy of the content. It reads the template's, so there is only ever one version:</p>
<ul>
  <li>milestones and their steps, challenges and their questions</li>
  <li>achievements, including the rank ladder</li>
  <li>items, Tabis and the layout of the Journey map</li>
  <li>posts and resources</li>
  <li>skills, encounters, consequences, profile tests and branch groups</li>
  <li>the feature switches, quick links and images in Adventure Settings</li>
</ul>
<p><strong>Editing the template changes every running cohort immediately.</strong> Fix a typo, add a milestone or rebalance a reward on the template and every cohort has the change on its next page load. That's the point of the model, and also the thing to be careful with: there is no "only for new cohorts" edit. Make content changes on the template itself, not from inside a cohort.</p>

<h2>What Each Cohort Keeps for Itself</h2>
<ul>
  <li><strong>Its players</strong> and their roles.</li>
  <li><strong>All progress</strong>: XP, BLOO, completions, submissions, challenge attempts, purchases, achievements held and Blooms. A milestone completed in one cohort credits that cohort only.</li>
  <li><strong>Guilds</strong> and their members.</li>
  <li><strong>Garden missions and tasks</strong> (see below).</li>
  <li><strong>Item stock</strong>: an item with a stock of 2 sells two in each cohort.</li>
</ul>
<p>Three things start from the template and can be set per cohort:</p>
<ul>
  <li><strong>Cooper Context</strong> is copied into the cohort when it's created. After that each cohort has its own, so update it in the cohort's Adventure Settings.</li>
  <li><strong>Cooper's Character</strong> follows the template unless the cohort sets its own.</li>
  <li><strong>The Claude API key</strong> follows the template unless the cohort saves its own (see below).</li>
</ul>

<h2>Missions and Tasks Come Along Automatically</h2>
<p>A new cohort starts with copies of the template's Garden missions and tasks. For a cohort created before that happened, or after you've added more to the template, open <strong>Admin Tools → Missions &amp; Tasks</strong> inside the cohort. It lists the template's missions and tasks with their state in this cohort (<em>Here</em>, <em>Not copied yet</em> or <em>Trigger missing</em>) and one button per kind: <strong>Copy the N missing</strong>, or <strong>Restore the triggers</strong> for tasks that arrived without the milestone that completes them. It's safe to run again; nothing already in the cohort is copied twice.</p>
<p>A mission aimed at a guild arrives as a <strong>draft</strong>, because the template's guild means nothing in the cohort. It needs an audience from the cohort before it goes live.</p>

<h2>Guilds</h2>
<p>Guilds aren't copied into a new cohort, because they're about the people in it. Two ways to set them up:</p>
<ul>
  <li><strong>Import players with a Guild column</strong> into the cohort (Manage Players → Add Players). Each guild named in the file is created in the cohort as it goes.</li>
  <li><strong>Copy them with the Duplicator.</strong> Open it on the template, tick the guilds (and any missions aimed at them), choose the cohort under <strong>Duplicate into</strong>, and confirm. Copied guilds arrive empty, with no members, no XP and a new join code. A mission aimed at a guild copied in the same run is re-pointed at the copy; one left with no audience arrives as a draft rather than going out to everyone.</li>
</ul>

<h2>QR Codes and Magic Links</h2>
<p>Achievements live on the template, but their QR codes and magic links are made per cohort, so a printed code credits the cohort it was made for. To get a cohort's QR code, open the achievement from inside that cohort; the editor tells you which Adventure the code redeems into. Milestone QR codes carry the cohort too. A typed magic code works in every cohort and credits whichever Adventure the player redeems it in. See <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes — Live &amp; Hybrid Event Checkpoints</a>.</p>

<h2>The A.I. Key</h2>
<p>Save your Claude API key once, on the template's A.I. tab, and every cohort uses it. A cohort's A.I. tab says when it's using the template's key; save a key there only if that cohort should use a different one. <strong>Test Key</strong> makes one real call and tells you whose key answered. Cooper uses the same key when an Adventure has one, so its conversations in every cohort are billed to it too. See <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>.</p>

<h2>Running a Cohort Day to Day</h2>
<p>Inside a cohort, the Admin Tools menu is deliberately short, because everything in it is about this cohort's people: <strong>Players</strong>, <strong>Achievements</strong>, <strong>Manage Players</strong>, <strong>Player Records</strong>, <strong>Missions &amp; Tasks</strong> and the <strong>Player Meta Manager</strong>. <strong>Template Settings</strong>, in the Adventure Navigation section, opens the template's Adventure Settings.</p>

<h2>An Independent Copy Instead</h2>
<p>If you want a copy that <em>doesn't</em> follow the template, say a one-off variant you're going to change heavily, use <strong>Duplicate</strong> on Manage Adventures. You get a full, independent Adventure with its own milestones, achievements, items, guilds and Tabis, every reference between them remapped, and no player data. Editing the copy never touches the original, and editing the original never touches the copy. Duplicate the template itself rather than one of its cohorts: a cohort's content lives on the template, so a copy made from the cohort would come out without it.</p>

<h2>Which to Use</h2>
<ul>
  <li><strong>A template and cohorts</strong> for anything that repeats with the same content: one place to improve it, and every group benefits at once.</li>
  <li><strong>Duplicate</strong> when the new Adventure is going to go its own way and shouldn't change when the original does.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
  <li><a href="/docs/building-your-first-adventure">Building Your First Adventure</a></li>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
  <li><a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Billing & Plans',
                'slug'       => 'billing-and-plans',
                'section'    => 'setup',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<p>Billing lives entirely inside the app. This website never takes payment; it only points you to the app.</p>

<h2>Plans at a Glance</h2>
<ul>
  <li><strong>Basic</strong>: free. Up to 90 players across your account, 3 Adventures, 50MB of storage.</li>
  <li><strong>Pro</strong>: $8/mo or $80/yr (two months free on annual). Up to 250 players across your account, 20 Adventures, 200MB of storage.</li>
  <li><strong>Enterprise</strong>: no player, Adventure or storage limits. Sales-assisted: <a href="/contact">contact us</a> to talk it through.</li>
</ul>
<p>Moving from Basic to Pro raises all three caps; Enterprise removes them. See the <a href="/pricing">Pricing</a> page for the full comparison.</p>

<h2>Storage</h2>
<p>Storage is the one limit the app enforces today. It counts every file an account uploads, across every Adventure: images, video and audio in the Media Manager (badges, backgrounds, profile pictures, pictures in rich text, submissions) plus SCORM packages. CSV imports and the QR codes the app generates don't count.</p>
<ul>
  <li><strong>It's counted per uploader.</strong> A player's own submission images come out of that player's allowance, not the GM's, so a class can't fill up its facilitator's space.</li>
  <li><strong>You can see where you stand.</strong> A storage meter appears at the top of the Media Manager and on the Billing panel of My Account.</li>
  <li><strong>Nothing is ever deleted.</strong> If an account is over its allowance (after a downgrade, say), it keeps every file but can't upload more until it's back under. Deleting a file frees its space straight away.</li>
</ul>

<h2>Upgrading and Your Pro Trial</h2>
<p>Plans are on the <strong>Subscription &amp; Billing</strong> page in the app. Each plan card has a <strong>Monthly</strong> / <strong>Yearly</strong> switch and a <strong>Subscribe</strong> button that takes you to a secure Stripe checkout. Your current plan is marked <strong>Your current plan</strong>.</p>
<p>First-time Pro subscribers get a <strong>30-day free trial</strong>. There's no charge until it ends, and the page shows the date it does. You'll also get an email about three days before the trial converts into its first real charge, so nothing converts silently.</p>

<h2>Managing Your Subscription</h2>
<p>The <strong>Manage billing</strong> button on Subscription &amp; Billing opens Stripe's billing portal, where you change or cancel your plan and update your card. The page also shows your subscription's status: <em>Free trial</em>, <em>Active</em>, <em>Payment overdue</em> or <em>Cancelled</em>. Changing plans doesn't touch your existing Adventures or player data.</p>
<p>Not sure which plan an account is on? The Billing panel of <strong>My Account</strong> names it.</p>

<h2>Billing History</h2>
<p>The Billing panel of My Account carries a <strong>Billing History</strong> table: every payment with its date, amount and status, plus links to view the invoice or download it as a PDF. Those are Stripe's own hosted invoices, so they're the real documents your finance team needs.</p>
<p>This is separate from the <strong>Transactions</strong> panel, which is in-game BLOO and item purchases inside Adventures. One is real money, the other isn't, and they're deliberately kept apart.</p>
<p>History is recorded from the point the feature went live, so older payments may not be listed. <a href="/contact">Ask us</a> if you need an older invoice.</p>

<h2>When a Payment Fails</h2>
<p>If a card is declined, <strong>we email you</strong> rather than leaving you to discover it, and Subscription &amp; Billing shows the subscription as <em>Payment overdue</em> until it's sorted. Refunds issued by our team appear in your Billing History automatically.</p>

<h2>Questions About Billing</h2>
<p>Something not adding up, or need an invoice for procurement? <a href="/contact">Reach out</a> and we'll sort it out directly.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a></li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a></li>
  <li><a href="/docs/how-to-add-a-scorm-package">How to Add a SCORM Package</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Journey Builder: Designing the Map',
                'slug'       => 'journey-builder-design-palette',
                'section'    => 'setup',
                'sort_order' => 6,
                'body'       => <<<'HTML'
<p>The Journey Builder is where you design the map itself. Your milestones and Tabis are already on it once you've made them; the builder is where you arrange them and add everything else players will see — artwork, labels, live panels, shortcuts — at the depth you want. Open it from <strong>Journey Builder</strong> in the menu's Admin Tools. In an adventure made from a template, the map belongs to the template, so design it there.</p>

<h2>The Palette</h2>
<p>The toolbar along the top is a palette of things to place. Everything you add lands on the canvas ready to drag, resize and arrange.</p>
<ul>
  <li><strong>Add Graphic</strong> — drops an empty frame; use its <strong>Set image</strong> button to choose the picture. Fill in the optional <strong>Link URL</strong> first and players can click the graphic to open that link in a new tab.</li>
  <li><strong>Add Text</strong> — real words on the map, with an optional link. Text stays sharp at any zoom and can be edited later, so use it rather than pictures of words.</li>
  <li><strong>Add Task</strong> — pick one of the adventure's tasks by name and it lands as a hexagon bound to that task. Only there when Tasks is switched on.</li>
  <li><strong>Add Widget</strong> — a live panel that shows each player their own information.</li>
  <li><strong>Active Tabis</strong> — tick which Tabis appear on the map as chapters.</li>
  <li><strong>Nav Links</strong> — a button that takes players to another part of the adventure.</li>
  <li><strong>Working layer</strong> and <strong>Layers</strong> — for working with depth, below.</li>
  <li><strong>View journey</strong> — opens the live map in a new tab.</li>
</ul>
<p>The widget and link menus only offer what the adventure has switched on in Adventure Settings, so you can't place a shortcut into a feature players can't use.</p>

<h2>Widgets</h2>
<p>A widget reads whoever is looking at it, so two players see different numbers in the same spot.</p>
<ul>
  <li><strong>Status</strong> — the player's picture, level, and XP and BLOO bars (plus EP when Energy is on). Clicking it opens their profile panel.</li>
  <li><strong>Journey progress</strong> — how far through the whole journey they are.</li>
  <li><strong>Leaderboard</strong> (needs Leaderboard) and <strong>Guild leaderboard</strong> (needs Guilds).</li>
  <li><strong>Tasks</strong> (needs Tasks) — the tasks they can do, available ones first.</li>
  <li><strong>Messages</strong> — a button that opens the player's direct messages.</li>
  <li><strong>Ways to help</strong> (needs The Garden) — open help requests, plus the player's own.</li>
  <li><strong>Achievements</strong> (needs Achievements) and <strong>Backpack</strong> (needs Backpack) — badges earned and items carried.</li>
</ul>
<p>Widgets are drawn at their real size in the builder, filled with stand-in data. Drag the corner handle to size one: unlike a graphic, which keeps its image's proportions, a widget takes whatever height you give it. The widgets that show a list also have a length, named after what they count:</p>
<ul>
  <li>Leaderboard — <strong>Players shown</strong>, 5 by default</li>
  <li>Guild leaderboard — <strong>Guilds shown</strong>, 5</li>
  <li>Tasks — <strong>Tasks shown</strong>, 3</li>
  <li>Ways to help — <strong>Requests shown</strong>, 3</li>
  <li>Achievements — <strong>Badges shown</strong>, 12</li>
  <li>Backpack — <strong>Items shown</strong>, 12</li>
</ul>
<p>Any number up to 50 works; clear the field to go back to the default. The Achievements and Backpack panels say how many more there are beyond what fits. A tall Achievements panel beside a short Tasks list is exactly what this is for.</p>

<h2>Task Hexagons</h2>
<p>A task hexagon is one task drawn like a milestone. Where the Tasks widget lists several tasks in one panel, hexagons let you lay a routine out as a map: one per task, placed where it happens in the story. Players click one to open the task and complete it without leaving the Journey. The hexagon keeps its shape when you resize it, and its bar has a <strong>Task</strong> picker if you want to point it at a different task. If its task is deleted, the hexagon stays on the map drawn as unavailable, so you can find it and remove it.</p>

<h2>Text</h2>
<p>A text object has its words, an optional link, a font and a size. The three fonts are <strong>Normal</strong>, <strong>Normal Condensed</strong> and <strong>Special</strong>. Size is in pixels, from 8 to 200; leave it blank for the default of 28. Enter starts a new line, and the text saves when you click away (or press Ctrl+Enter, Cmd+Enter on a Mac). Resizing a text object sets where it wraps; its height is whatever the words need.</p>

<h2>Nav Links</h2>
<p>Put a button to the <strong>Item Shop</strong>, <strong>Magic Code</strong> (which opens the code box), <strong>Achievements</strong> or the player's <strong>Journal</strong> right where it belongs in the story, instead of leaving players to find it in the menu. The first three are offered only when those features are on, and each uses your platform's own name for that section.</p>

<h2>Arranging Things</h2>
<p>Hover over an object and its control bar appears above it.</p>
<ul>
  <li><strong>Move</strong> — drag the object. Positions save when you let go; there's no Save button.</li>
  <li><strong>Size</strong> — drag the corner handle. Milestones keep their hexagon shape as they grow; Tabis also resize from their right and bottom edges.</li>
  <li><strong>Rotate</strong> — graphics, text, widgets, nav links and task hexagons have a rotate handle to drag.</li>
  <li><strong>Stacking</strong> — <strong>Bring forward</strong> and <strong>Send back</strong> decide what draws on top. The number between them is the object's position within its depth, counting from 1.</li>
  <li><strong>Type</strong> — on a placed graphic, widget, nav link or task hexagon, the dropdown switches it to another of those kinds without losing its place.</li>
  <li><strong>Duplicate</strong> and <strong>Remove</strong>.</li>
  <li><strong>Locked with Tabi</strong> — tie an object to a Tabi and, while that Tabi is still locked for a player, the object shows greyed out and can't be clicked. Useful for a signpost or shortcut that belongs to a chapter. The picker appears once the adventure has Tabis.</li>
</ul>

<h2>Depth</h2>
<p>Everything on the map sits at one of four depths, and each moves at its own speed when a player pans or zooms — that's what gives the map its parallax:</p>
<ul>
  <li><strong>Deep</strong> (Deep background) — moves the slowest.</li>
  <li><strong>Back</strong> (Background).</li>
  <li><strong>Base</strong> — moves with the map. The only depth players can click.</li>
  <li><strong>Front</strong> (Foreground) — moves slightly faster than the map, for things nearer than the milestones.</li>
</ul>
<p>Behind all four, the grid backdrop drifts slowest of all.</p>
<p>Graphics, text, widgets, nav links and task hexagons have a <strong>Depth</strong> row in their bar: press Deep, Back, Base or Front to move the object there, and it lands at the bottom of that depth's stack. Anything a player needs to click — a linked graphic or text, a widget, a nav link, a task hexagon — has to stay on Base, because the other depths are decoration only.</p>
<ul>
  <li><strong>A milestone is always on Base</strong>, whatever you do. It has no depth buttons.</li>
  <li><strong>A Tabi that holds milestones is always on Base</strong>, because its milestones can only be reached through it; its bar shows the lock and how many milestones it holds instead of depth buttons. A Tabi with no milestones is scenery and can go at any depth.</li>
  <li>If you file a milestone into a Tabi that's sitting at another depth — from the Tabi editor, Manage Content or the milestone's own builder — the Tabi snaps back to Base, and a message tells you it moved.</li>
</ul>
<p>The builder itself doesn't pan or zoom — it scrolls — so all four depths line up exactly as they will at the player's starting view. Open <strong>View journey</strong> to see them move.</p>

<h2>Blur</h2>
<p>Beside its depth, each graphic, text, widget, nav link and task hexagon has a <strong>Blur</strong> field, in pixels from 0 (sharp) to 40. A little blur on something in the background sells distance. Milestones and Tabis don't take blur.</p>

<h2>Working Layer</h2>
<p><strong>Working layer</strong> lets you edit one depth at a time. Choose <strong>Deep background</strong>, <strong>Background</strong>, <strong>Base</strong> or <strong>Foreground</strong> and everything at the other depths stays visible but ghosted, and stops taking clicks — so you can work over a busy canvas without grabbing the wrong thing. <strong>Everything</strong> puts it back.</p>

<h2>The Layers Panel</h2>
<p><strong>Layers</strong> opens a side panel listing everything on the journey, front to back, grouped by depth — Foreground, Base, Background, Deep background — with a count for each and a note saying which one players can click. Its job is finding what the canvas makes hard to reach: something ghosted, buried under three other objects, or scrolled off the edge. Click a row to find it on the canvas, and use its depth buttons to move it. Milestones, and Tabis that hold milestones, show as locked to Base, and any blur is listed next to the object's type.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/tabi-editor">The Tabi Editor</a> — chapters, their milestones and their pieces</li>
  <li><a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a> — artwork that grows inside a Tabi</li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — what players see</li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a> — what's behind a task hexagon</li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Tabi Editor',
                'slug'       => 'tabi-editor',
                'section'    => 'setup',
                'sort_order' => 7,
                'body'       => <<<'HTML'
<p>A <strong>Tabi</strong> is a chapter of the journey. It's either a tile on the map that opens onto a group of milestones, or a collectable picture players assemble from pieces — never both. The Tabi editor is where you set up every part of one.</p>

<h2>Opening It</h2>
<p>Go to <strong>Manage Content</strong> and open the <strong>Tabis</strong> tab. <strong>Add Tabi</strong> creates a new one, and each row's <strong>Edit Tabi</strong> opens the editor. The row also has <strong>Prerequisites</strong>, <strong>Evolving Scene</strong> (straight to the Scene Builder) and <strong>Trash</strong>. When the adventure has no Tabis yet, the Journey Builder's Active Tabis menu and the empty journey both link to creating one.</p>
<p>A brand-new Tabi shows only its settings: prerequisites, milestones, pieces and the scene all attach to a Tabi that exists, so give it a name and press <strong>Create Tabi</strong> first. After that the editor's tabs are <strong>Settings</strong>, <strong>Prerequisites</strong>, <strong>Milestones</strong>, <strong>Pieces</strong> and <strong>Scene</strong>, and <strong>Update Tabi</strong> saves the settings.</p>

<h2>Settings</h2>
<ul>
  <li><strong>Name</strong>.</li>
  <li><strong>Background</strong> — the artwork behind the Tabi on the map.</li>
  <li><strong>Colour</strong>.</li>
  <li><strong>Level</strong> — where the Tabi sits in the journey's order. It sorts chapters; it doesn't gate them.</li>
  <li><strong>Chapter on the journey map</strong> — <strong>Yes — a chapter</strong> draws it on the map and groups its milestones under it; <strong>No — collected from pieces</strong> makes it a collectable Tabi instead. The Journey Builder's Active Tabis menu flips the same switch.</li>
  <li><strong>Status</strong> — Published or Draft.</li>
</ul>
<p>Position and size aren't typed in here. Drag the Tabi into place in the <a href="/docs/journey-builder-design-palette">Journey Builder</a>, and drag its edges there (or its frame in the Scene Builder) to size it. The editor shows where it currently sits.</p>

<h2>Prerequisites</h2>
<p>Tick other Tabis and this one stays locked until every ticked Tabi is finished; leave them all unticked and it's open from the start. Press <strong>Save prerequisites</strong> — this section saves on its own. A player who opens a locked chapter sees which chapters to finish first, and the List view names them under the chapter's heading.</p>
<p>Prerequisites here are between Tabis. For anything finer — a level, an achievement, a particular milestone — gate the milestones themselves with <a href="/docs/conditions-when-things-unlock">Conditions</a>.</p>

<h2>Milestones</h2>
<p>This tab lists what's filed under the Tabi, with each milestone's level, type and status, and a <strong>Remove</strong> button to take one out. <strong>Add an existing milestone</strong> offers any milestone that isn't in a Tabi yet; <strong>New milestone</strong> and <strong>New challenge</strong> start fresh ones. You can also choose the Tabi from the <strong>Tabi</strong> dropdown on a milestone's own Mechanics tab.</p>
<p>A player finishes the Tabi by finishing its milestones. What counts:</p>
<ul>
  <li>Milestones, challenges and profile tests that aren't marked <strong>Optional</strong>. Optional ones are extras and don't count.</li>
  <li>Published, locked and hidden ones all count — so a milestone you've locked keeps the chapter unfinished until you unlock it. Drafts don't count.</li>
</ul>
<p>Filed milestones appear inside the Tabi's tile, not loose on the map. That's why a Tabi that holds milestones always stays on the Base depth, where players can click it: file a milestone into a Tabi sitting in the background and the Tabi moves back to Base, with a message saying so. For the same reason, don't file milestones into a Tabi set to <em>No — collected from pieces</em> — it has no tile on the map to open them from.</p>

<h2>The Chapter's Badge</h2>
<p>When a player opens a chapter, it starts with a progress bar: the milestones they've finished out of the chapter's total. To point that bar at a badge, create an achievement with a <strong>Complete This Tabi</strong> condition for this Tabi. The bar then reads <em>Working towards</em> with the achievement's name and artwork, and <em>Stage complete</em> when they get there, while the achievement itself is awarded by its condition. Without one, the bar reads <em>Progress towards this stage</em>. See <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>

<h2>Pieces</h2>
<p>A collectable Tabi is built from <strong>pieces</strong>: items of the <strong>Tabi Piece</strong> type that point at this Tabi. <strong>New piece</strong> opens the item editor — set the type to Tabi Piece and choose this Tabi. Pieces can be sold in the Item Shop, where each is labelled as part of its Tabi, or handed out as rewards. Once there are pieces, <strong>Arrange pieces</strong> opens the piece editor, where you drag, resize, rotate and stack them into the finished picture. Players see their collection on the <strong>Tabis</strong> page of the Item Shop section, and can click a piece they've collected to examine it. See <a href="/docs/item-shop-building-an-economy">Building an Item Shop Economy</a>.</p>

<h2>Scene</h2>
<p>The <strong>Scene</strong> tab holds the Tabi's evolving artwork — the table of what grows, and when — with <strong>Open Scene Builder</strong> to place the art inside the Tabi's frame. That's covered in <a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a></li>
  <li><a href="/docs/journey-builder-design-palette">The Journey Builder: Designing the Map</a></li>
  <li><a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Evolving Tabis & the Scene Builder',
                'slug'       => 'evolving-tabis-scene-builder',
                'section'    => 'setup',
                'sort_order' => 8,
                'body'       => <<<'HTML'
<p>A Tabi can carry artwork that changes as the player looking at it progresses: a lemonade stand at level 1, a food truck at level 3, a restaurant at level 5. Two players open the same chapter and see different pictures, each drawn from their own progress. This page covers authoring it.</p>

<h2>The Idea: a Table</h2>
<p>A scene is a table.</p>
<ul>
  <li><strong>Each row</strong> is one thing that evolves — "The building" — and the one condition it grows with, such as player level.</li>
  <li><strong>Each step along the row</strong> is one value of that condition plus the artwork for it: Level 1 → a stand, Level 5 → a restaurant.</li>
</ul>
<p>For each row, the player sees the artwork of the highest step they've reached. A step with no value set is always shown, which makes it the starting picture every new player sees. Rows are independent of each other, so an add-on — a sign that appears once a player has 10 Blooms — is simply a row with one step.</p>

<h2>What a Row Can Grow With</h2>
<ul>
  <li>Player level</li>
  <li>Player XP</li>
  <li>This Tabi's completion %</li>
  <li>Whole journey completion %</li>
  <li>Milestones completed</li>
  <li>Achievements earned</li>
  <li>Tabis completed</li>
  <li>Items bought</li>
  <li>Guild level</li>
  <li>Guild members</li>
  <li>Blooms earned (all Skills)</li>
  <li>Blooms in one Skill — you pick the Skill once, on the row</li>
  <li>Blooms received from peers</li>
  <li>Blooms given to others</li>
  <li>A milestone is finished — each step names its own milestone</li>
  <li>A Tabi is finished — each step names its own Tabi</li>
</ul>
<p>The guild conditions depend on teammates too, so a whole guild can watch one scene grow together. The two peer conditions count only the Blooms players chose to give each other — gifts and endorsements — not Blooms paid out by the adventure or awarded by staff. See <a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms</a>.</p>

<h2>Growing Gradually</h2>
<p>On a numeric row, every step except the last has a <strong>Grow gradually</strong> checkbox. Tick it and the artwork fills in between that step's value and the next one, instead of appearing all at once: with steps at level 3 and level 5, a level-4 player sees it half drawn. Choose which way it fills — Up, Down, Left or Right.</p>

<h2>Building the Table</h2>
<p>Open the Tabi in the <a href="/docs/tabi-editor">Tabi editor</a> and go to its <strong>Scene</strong> tab, or press <strong>Evolving Scene</strong> on the Tabi's row in Manage Content. A scene is created the first time you open the Scene Builder; there's nothing to set up beforehand. Then:</p>
<ol>
  <li>Add a row: name what evolves ("The building") and choose what it grows with.</li>
  <li>Fill in each step's value — a number, or the milestone or Tabi it waits for — and press <strong>Set art</strong> to choose its artwork.</li>
  <li>Press <strong>Next step</strong> to add the following step to the row.</li>
</ol>
<p>Rows and steps save as you change them. <strong>Remove row</strong> deletes a whole row, and each step has its own remove button. In the Scene Builder, <strong>Edit the table</strong> opens the same table over the canvas.</p>

<h2>The Scene Builder</h2>
<p>The Scene Builder is where you place the artwork. Its canvas is the journey itself: the rest of the map — other Tabis, graphics, widgets and milestones — is drawn as fixed placeholders at their real positions, so you design against what will actually surround the scene. None of it can be changed from here; only this Tabi is yours to edit.</p>
<ul>
  <li><strong>The frame is the Tabi.</strong> All of a scene's artwork lives inside the Tabi's frame and is clipped to it, exactly as it is on the map and in the chapter's panel.</li>
  <li><strong>Drag the label above the frame</strong> to move the Tabi on the journey, and <strong>drag an edge</strong> to resize it. Both change the real Tabi. Resizing doesn't move or scale the artwork; whatever falls past the new edge is clipped.</li>
  <li><strong>Click a piece of artwork</strong> to select it, then drag it, resize it, or turn it with its rotate handle. The selection bar holds <strong>Artwork</strong> (swap the image), <strong>Send back</strong> and <strong>Bring forward</strong> with its layer number, <strong>Edit row</strong> and <strong>Remove</strong>.</li>
  <li>The toolbar has <strong>Edit the table</strong>, <strong>Find this Tabi</strong>, toggles for <strong>Journey</strong> (the placeholders), <strong>Tabi image</strong> and <strong>Ghost inactive</strong>, and <strong>Back to Tabis</strong>.</li>
</ul>
<p>Artwork whose image can't be found shows a placeholder instead of vanishing, so you can select it and choose new artwork.</p>

<h2>Preview as a Player</h2>
<p>Your own account has probably reached none of your later steps, which would leave you placing art you can't see. The <strong>Preview as a player</strong> panel lets you set a pretend player's level, XP, this Tabi's %, journey %, guild level, guild members and milestones completed; with <strong>Ghost inactive</strong> on, the canvas ghosts whatever that player wouldn't see. The panel can be dragged out of the way by its header.</p>

<h2>Scene Settings</h2>
<p>Two settings in the same panel apply to the whole scene:</p>
<ul>
  <li><strong>Show on the journey map</strong> — <strong>No</strong> by default, which means the scene only appears inside the chapter's panel when a player opens it. Set it to <strong>Yes</strong> to draw the scene over the Tabi on the map as well.</li>
  <li><strong>Whole-scene mood</strong> — <strong>None</strong>, or <strong>Fade when the player is away</strong>, which desaturates the whole scene the longer it's been since the player's last visit.</li>
</ul>

<h2>What Players See</h2>
<p>When a player opens the chapter, the scene is shown full size, with a <strong>Next:</strong> line underneath naming what grows it next — "Reach level 5", for example. The scene stays hidden while the chapter is locked, so it can't give away what's inside. On the map, if you've turned it on, the scene sits over the Tabi's tile at the Tabi's depth. Staff see a scene as far as their own account has reached, not fully grown, so use the preview to check the later steps.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/tabi-editor">The Tabi Editor</a></li>
  <li><a href="/docs/journey-builder-design-palette">The Journey Builder: Designing the Map</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions</a> — the same rules, used to unlock things</li>
  <li><a href="/docs/setting-up-your-skills-catalog">Setting Up Your Skills Catalog</a> — for rows that grow with Blooms</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Designing Milestones — Rewards & Unlock Rules',
                'slug'       => 'designing-milestones-rewards-and-unlocks',
                'section'    => 'setup',
                'sort_order' => 9,
                'body'       => <<<'HTML'
<p>A <strong>Milestone</strong> is the unit of design in BLUERABBIT: the thing you're actually placing on the Journey Map. Before you touch a single Step, decide what you're building and what it takes to unlock and complete it.</p>
<p><em>Examples in this guide are drawn from a single running example. See <a href="/docs/meet-launch-week-example-adventure">Meet "Launch Week"</a> for the adventure referenced throughout.</em></p>

<h2>First Decision: Give Knowledge, or Test It</h2>
<p>There are two things you can put on the map, and the choice is that simple:</p>
<ul>
  <li><strong>Milestone</strong> — you're <em>providing</em> knowledge. Content, exercises, submissions, media, hands-on activities. You build it out of Steps, and there are 28 Step types to pick from, so a Milestone can be almost anything.</li>
  <li><strong>Challenge</strong> — you're <em>testing</em> knowledge. A question bank, a subset shown per attempt, a pass threshold, and a limited number of retries. See <a href="/docs/challenges-concept">Challenges — Concept</a>.</li>
</ul>
<p>If you're not sure, ask whether a player could plausibly fail. If yes, it's a Challenge. If they just need to go through it, it's a Milestone.</p>

<h2>The Basics</h2>
<p>The builder's <strong>Basic</strong> tab holds the Milestone's Name, Color, Icon and <strong>Main Image</strong> (required), which is the badge that represents it on the map. It also holds <strong>Autoload?</strong>.</p>

<h2>Autoload: "Do This First"</h2>
<p>Set <strong>Autoload?</strong> to Yes and a player who opens the adventure is taken straight into this Milestone instead of landing on the map. Use it for an onboarding briefing, a debrief that has come due, or the follow-up an encounter set up. The priority is fixed:</p>
<ol>
  <li>An encounter the player is in the middle of always comes first.</li>
  <li>A freshly dealt hand of encounter cards comes next, so the draw isn't lost.</li>
  <li>Only then does an autoload Milestone take over.</li>
</ol>
<p>Autoload never traps anyone. A Milestone the player can't play yet (level too low, requirements unmet, outside its dates) is skipped, and once they finish it, it stops firing. Game Masters and admins are never redirected. If several autoload Milestones are open to a player, the first one in journey order wins.</p>

<h2>Mechanics</h2>
<ul>
  <li><strong>Tabi</strong> — the chapter it belongs to. See <a href="/docs/tabi-editor">The Tabi Editor</a>.</li>
  <li><strong>Level</strong> — the minimum player level to open it.</li>
  <li><strong>XP, BLOO and EP</strong> — what it pays on completion. The EP field only appears when the adventure's Energy Points feature is on.</li>
  <li><strong>Start Date</strong> and <strong>Deadline</strong> — date-gate it on either end, in the adventure's own time zone. Before the start date it isn't open yet; after the deadline it has expired. The <strong>Hide milestones</strong> option in Adventure Settings decides whether players still see it outside that window.</li>
  <li><strong>Optional</strong> — "Doesn't count toward Tabi unlock". A side activity that never holds up its chapter and doesn't count toward a player's journey progress.</li>
  <li><strong>Validate</strong> — "Require validation before awarding". Adds Validate and Invalidate buttons for each submission on the Milestone's Review page. See <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>.</li>
</ul>

<h2>Setting the Unlock Requirements</h2>
<p>Everything that gates a Milestone beyond its level and dates lives in one place: the <strong>Conditions</strong> drawer on the <strong>Advanced</strong> tab. It slides in from the right and holds:</p>
<ul>
  <li><strong>Requires these milestones completed</strong></li>
  <li><strong>Requires these achievements</strong></li>
  <li><strong>Requires this key item</strong> — the player must be carrying it</li>
  <li><strong>Threshold conditions</strong> — numbers such as level, XP or journey completion %. These are the same conditions achievements and Tabi scenes use. Leave a box blank to skip it.</li>
</ul>
<p>The drawer saves on its own with <strong>Save Conditions</strong>, and it stays disabled until the Milestone has been saved once. A player has to meet everything you set; an empty drawer means "available from day one", so nothing is locked unless you lock it. See <a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a> for how thresholds work across the app.</p>

<h2>Rewards: XP, BLOO, and Beyond</h2>
<p>XP, BLOO and EP are set on the Mechanics tab. The Advanced tab adds three more, each optional:</p>
<ul>
  <li><strong>Item Reward</strong> — opens a drawer of item cards. Pick one to hand it over on completion, or click it again to clear.</li>
  <li><strong>Achievement Reward</strong> — the same, for an achievement.</li>
  <li><strong>Skill Reward (Garden)</strong> — adds one Bloom (one level) in the chosen Skill on completion, which feeds the player's Garden. It needs a Skill catalogue first; see <a href="/docs/setting-up-your-skills-catalog">Setting Up Your Skills Catalog</a>.</li>
</ul>
<p>The two reward drawers are saved when you press <strong>Update Milestone</strong>. Individual Steps can pay out on their own too. Keep the XP curve roughly consistent across Milestones of similar effort, or levelling will feel arbitrary to players comparing notes.</p>

<h2>Content: What Players Read</h2>
<ul>
  <li><strong>Short Description</strong> — the preview players read when they click the Milestone on the map.</li>
  <li><strong>Instructions</strong> — the play page doesn't show this field. The A.I. check on Open Text steps reads it as background, so it's a good place to say what the Milestone is about.</li>
  <li><strong>Success Message</strong> — the text of the win screen, and what the player finds on their <a href="/docs/certificates-and-secrets-and-clues">Secrets &amp; Clues</a> page once they've finished. On a Milestone with no steps, it's also what the page shows above the answer box.</li>
  <li><strong>Failure Message</strong> — the text of the fail screen a player sees when they run out of attempts.</li>
</ul>
<p>Leave either message blank and standard wording is used.</p>

<h2>Paths</h2>
<p>If your Adventure uses paths or ranks, the builder's bottom bar has a path menu. A Milestone can be left on <strong>All paths</strong> or restricted to a single one, so players on the Engineering track never see the Sales content. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</p>

<h2>Grading and When Rewards Land</h2>
<p>Grading is set once per adventure, not per Milestone. It lives in the Resource Mechanics panel on the General tab of Adventure Settings:</p>
<ul>
  <li><strong>Grade scale type</strong> — None, Percentage, or GPA (letters).</li>
  <li><strong>Assign Resources</strong> — <strong>Before Grading</strong> (rewards land when the player completes the Milestone) or <strong>After Grading</strong> (they land once a Game Master grades it, and the BLOO is scaled by the grade, so 25 BLOO at 60% pays 15). After Grading needs a grade scale; the settings won't save without one.</li>
</ul>
<p>After Grading applies to Challenges too. A passed Challenge pays its XP and EP, and its BLOO is scaled by the score of the attempt that passed. Challenges also add their own layer on top (questions per attempt, answers to win, a time limit, attempt caps and costs); see <a href="/docs/challenges-concept">Challenges — Concept</a>.</p>

<h2>Status, and What Counts Toward a Chapter</h2>
<p>The status menu in the builder's bottom bar offers four options:</p>
<ul>
  <li><strong>Publish</strong> — live on the Journey.</li>
  <li><strong>Draft</strong> — for while you're building. It isn't on the Journey and doesn't count toward anything.</li>
  <li><strong>Locked</strong> — visible on the map, but players can't open it. Use it when you've paused something: a speaker who didn't turn up, questions being rewritten.</li>
  <li><strong>Trash</strong> — removed. Restore it from Manage Content's Journey tab.</li>
</ul>
<p>Locked Milestones still count toward their Tabi's completion and toward every player's journey progress. So does Hidden content, which the Manage Content dashboard counts alongside Locked. A locked Milestone is work you've paused, not work you've removed, so a chapter holding one stays open until the Milestone is either finished or moved to Draft. Only drafts, trashed Milestones and anything marked Optional are left out of the count.</p>

<h2>Reuse</h2>
<p><strong>Duplicate</strong> in the bottom bar copies a Milestone with all of its Steps (or a Challenge with all of its questions) into the same adventure or a different one, so a well-built Milestone becomes a template you reuse rather than rebuild.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a> — the actual authoring flow, start to finish.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/random-encounters">Random Encounters</a> — the other thing that can pull a player into a Milestone</li>
  <li><a href="/docs/complete-adventure-settings-reference">Complete Adventure Settings Reference</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'How to Build a Milestone, Step by Step',
                'slug'       => 'how-to-build-a-milestone-step-by-step',
                'section'    => 'setup',
                'sort_order' => 10,
                'body'       => <<<'HTML'
<p>The end-to-end flow for getting one piece of content from an idea to a node players can actually reach on the map.</p>

<h2>1. Decide What You're Making</h2>
<p>Provide knowledge, or test it. Providing it means a <strong>Milestone</strong>; testing it means a <strong>Challenge</strong>. Everything below is the Milestone route. See <a href="/docs/how-to-build-a-challenge">How to Build a Challenge</a> for the other one.</p>

<h2>2. Create the Milestone and Save It</h2>
<p>Open <strong>New Milestone</strong> from the menu, or from the button on Manage Content's Journey tab. On the <strong>Basic</strong> tab give it a Name, Color, Icon and Main Image, then press <strong>Create Milestone</strong> in the bottom bar.</p>
<p>Save before going any further. The Steps tab reads "Save the milestone first" until the Milestone exists, and the Conditions drawer stays disabled, because every Step and every condition attaches to a Milestone that already has an ID.</p>

<h2>3. Build the Steps the Player Will Follow</h2>
<p>This is the real work, and where the design happens. A Milestone is a sequence of Steps, and each Step has a <strong>type</strong> that decides what the player does at that moment: read a character's dialogue, watch a video, answer a question correctly, upload something, pick a path. There are 28 types in six groups, and picking the right one is most of what makes a Milestone good rather than flat.</p>
<ol>
  <li><strong>Add Step.</strong> A new step appears at the end of the list and the <strong>Edit Step</strong> window opens over the builder.</li>
  <li><strong>Choose the Step Type.</strong> The menu is grouped Deliver, Validate, Collect, Profile, Flow and Special, and the editor changes to show only the settings that type needs: a Multiple Choice step asks for options and correct answers, a Video step asks for a file, a Cryptex step asks for accepted answers and a wheel count. The Profile group only appears once the adventure has a published profile.</li>
  <li><strong>Fill it in</strong> — the admin-only Label (so you can find it later), whether the step is Required, the type's own settings, an optional Background, and any Step Rewards it should pay out on its own.</li>
  <li><strong>Update Step</strong> to save it, or <strong>Cancel</strong>. The <strong>?</strong> button in the editor's header runs a short guided tour of it.</li>
</ol>
<p>Each row in the step list has Duplicate, Edit and Delete buttons, and rows can be dragged to reorder at any time.</p>

<h3>Dialogue: Pick a Speaker From the Cast</h3>
<p>A Dialogue step's <strong>Who is speaking</strong> menu lists the adventure's speakers. Pick one and the name and portrait come from the cast, so a character looks the same on every line and a new portrait updates all of them at once. Choose <strong>Custom — set a name and portrait below</strong> for a one-off character. See <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>.</p>

<h3>Profile Questions in Bulk</h3>
<p>When the adventure has a profile, the Steps tab also offers <strong>Paste a question set</strong>. Write the questions in a text editor, paste them in, press <strong>Check it</strong>, then <strong>Add these questions</strong>. They're added after the steps already there; nothing is replaced. See <a href="/docs/profile-tests">Profile Tests</a>.</p>

<p>Full detail on every type is in <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a>, and there's a one-screen lookup in the <a href="/docs/step-type-quick-reference">Step Type Quick Reference</a>.</p>
<p><em>A note on pacing:</em> alternate the groups. A run of four Deliver steps reads like a slide deck; a run of four Validate steps reads like an exam. Deliver, then ask; deliver, then ask.</p>

<h2>4. Write the Endings</h2>
<p>Every Milestone already ends on a win screen, and has a fail screen for players who run out of attempts, so you don't need to add either as a Step. Their text comes from the <strong>Success Message</strong> and <strong>Failure Message</strong> on the Content tab, with standard wording if you leave them blank. Add a Win Screen or Fail Screen step only when you want a custom ending: it replaces the standard one wherever it sits in the list.</p>

<h2>5. Set the Requirements and Rewards</h2>
<p>Level, dates and the XP/BLOO/EP payout are on the Mechanics tab. The Advanced tab has the <strong>Conditions</strong> drawer (prerequisite milestones, achievements, a key item, number thresholds) and the <strong>Item Reward</strong>, <strong>Achievement Reward</strong> and <strong>Skill Reward</strong> choices. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a>.</p>

<h2>6. Update the Milestone</h2>
<p>Press <strong>Update Milestone</strong>. The Conditions drawer saves itself with its own button; everything else, including the two reward drawers, is saved here.</p>

<h2>7. Play It, Then Check the Results</h2>
<p>Once the Milestone is saved, the builder's header carries two links, each opening in a new tab:</p>
<ul>
  <li><strong>View Milestone</strong> — the play page, exactly as players see it. As a Game Master you can open it whatever its gating says, and a staff bar on the page lets you skip to any step or go back to the editor.</li>
  <li><strong>Review Milestone</strong> — every player's submission for this Milestone, where you grade, validate, leave feedback the player can see, and export or import grades as CSV. See <a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>.</li>
</ul>

<h2>8. Put It on the Map</h2>
<p>Two ways, and most Adventures use both:</p>
<ul>
  <li><strong>Group it into a Tabi</strong> — pick one in the Mechanics tab's <strong>Tabi</strong> menu. A Tabi is a chapter on the Journey Map that holds a set of Milestones, and it can carry its own prerequisites so a whole region unlocks at once. See <a href="/docs/tabi-editor">The Tabi Editor</a>.</li>
  <li><strong>Use the Journey Builder</strong> — drag the Milestone into the exact position you want on the canvas, and resize it if it deserves more visual weight than its neighbours. Milestones always sit on the Base layer, the one players can click. See <a href="/docs/journey-builder-design-palette">The Journey Builder</a>.</li>
</ul>

<h2>9. Repeat</h2>
<p>Add as many Milestones as the program needs, grouped into as many Tabis as the shape of the content calls for. Build one end-to-end first and play it yourself before mass-producing the rest: pacing problems are much cheaper to find in the first Milestone than in the twelfth.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones — Rewards &amp; Unlock Rules</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit</a> — duplicating Milestones between adventures</li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Full Step Library — Choosing the Right Step for the Moment',
                'slug'       => 'full-step-library-choosing-the-right-step',
                'section'    => 'setup',
                'sort_order' => 11,
                'body'       => <<<'HTML'
<p>Steps are the moment-to-moment content inside a Milestone: the thing a player is actually looking at. A Milestone can chain as many as you like, in order, and each one can carry its own reward on top of whatever the Milestone pays out.</p>
<p>There are <strong>28 Step types</strong>, and the builder's <strong>Step Type</strong> menu groups them into six groups by what they ask of the player. That grouping is the useful way to think about pacing, so it's how this page is organised.</p>

<h2>What Every Step Has</h2>
<p>Whatever type you pick, each Step shares the same frame:</p>
<ul>
  <li><strong>Label</strong> — admin reference only. Players never see it; you'll be grateful for it at Step 14.</li>
  <li><strong>Required?</strong> — "Yes — must complete to advance" or "No — optional step". A required step has to be done before the Milestone counts as complete. On Collect and Profile steps an optional one also lets the player press Next without answering; steps that check an answer, Open Text and the Flow choices always wait for a response.</li>
  <li><strong>Background</strong> — a background image for the scene.</li>
  <li><strong>Step Rewards</strong> — XP, BLOO, EP, an Item Reward and/or an Achievement Reward, granted on completion.</li>
  <li><strong>Mistake Message</strong> and <strong>Maximum attempts</strong> — on the six types that can be answered wrongly: Multiple Choice, Keyphrase, Cryptex, Puzzle, Require Backpack Item and SCORM Package. See Attempt Limits below.</li>
</ul>

<h2>Every Milestone Ends on a Win or a Fail</h2>
<p>You never have to author an ending. The last step's <strong>Continue</strong> button takes the player to a win screen, and <strong>Finish</strong> there completes the Milestone. A player who runs out of attempts lands on a fail screen, and its button clears their answers for that Milestone so they start it again from the top; rewards they've already earned stay theirs. The two screens use the Milestone's Success Message and Failure Message, or standard wording if those are blank. The Win Screen and Fail Screen step types (under Special) replace them when you want something custom.</p>

<h2>Attempt Limits</h2>
<p><strong>Maximum attempts</strong> sits with the Mistake Message. Leave it at 0 for unlimited tries. Any other number, and running out fails the whole Milestone: the player is sent to its fail screen and starts over. The limit is enforced by the server, so once it's spent even a correct answer is refused.</p>
<p>For now, set it only on <strong>Keyphrase</strong> and <strong>Require Backpack Item</strong>. Those two show the player an "attempts left" counter and hand them to the fail screen when they run out.</p>

<h2>Deliver — Auto-Complete on View</h2>
<p>Content the player receives. Nothing to get right; they read, watch, or listen and continue.</p>
<ul>
  <li><strong>Dialogue</strong> — a character speaks. Set the <strong>Character Position</strong> (no one, just describing the scene; on the left; or on the right) and <strong>Who is speaking</strong>: a speaker from the adventure's cast, or <strong>Custom</strong> with a Character Name and Character Image (best at 9:16). Naming a speaker means the name and portrait follow the cast; see <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>. The workhorse of narrative pacing.</li>
  <li><strong>Video</strong> — plays a video file you upload. Watch time is tracked per player, and Manage Content grows a Videos tab once the adventure has a video step. See <a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a>.</li>
  <li><strong>Audio</strong> — plays an audio file in a player widget. Good for language work, podcast-style briefings, or anything voice-led.</li>
  <li><strong>Find Item</strong> — the player is handed the item you choose, which lands in their Backpack when they press <strong>Grab the item and continue</strong>. A reward beat with no test attached, and the natural setup for a later <em>Require Backpack Item</em> step.</li>
</ul>

<h2>Validate — The Player Must Answer Correctly</h2>
<p>The Next button stays locked until they get it right. Each of these can carry a Mistake Message for wrong attempts.</p>
<ul>
  <li><strong>Multiple Choice</strong> — a question, an optional question image, and your options. Tick the box beside each correct answer, and choose whether players may select more than one. The fastest comprehension check there is.</li>
  <li><strong>Keyphrase</strong> — the player types a word or phrase. You supply a comma-separated list of accepted answers (any match passes) and decide whether case matters. Excellent for in-person events: put the phrase on a slide, a poster, or a physical prop.</li>
  <li><strong>Cryptex</strong> — the same accepted-answers idea rendered as a rotating combination lock, with a wheel count you set (up to 20). Same mechanic as a Keyphrase, completely different feel. Reach for it when the answer <em>should</em> feel like cracking something open.</li>
  <li><strong>Puzzle</strong> — a jigsaw built from an image you upload, cut into a grid you choose (2–8 columns by 2–8 rows). The player drags pieces into place and clicks to rotate them. Low information density, high engagement: a change of pace, not a knowledge check.</li>
  <li><strong>Require Backpack Item</strong> — a Prompt, the Required Item, and whether to consume it on use. The player sees their own backpack as a scrolling rack and presses <strong>Use</strong> on whatever sits under the sight. Nothing on the page says which item you want, so it's a real puzzle rather than a confirmation, and a wrong pick is a miss. An empty backpack gets a pointer to the Item Shop, if the adventure has one. This is what turns the Item Shop and Find Item steps into a real progression mechanic rather than decoration.</li>
  <li><strong>SCORM Package</strong> — upload a SCORM 1.2 .zip (SCORM 1.2 only) and it runs inside the Step, tracking completion and resuming where the player left off. Use it to fold in content you already built in another authoring tool instead of rebuilding it. The same panel can replace the package or reset every player's progress on it. See <a href="/docs/scorm-packages-concept">SCORM Packages</a>.</li>
  <li><strong>Case Study (HTML)</strong> — embeds a self-contained interactive HTML activity by its Launch URL. You set the Total Questions and the Pass Score; the activity reports its own result back and the Step completes when the player clears the bar. Every attempt is kept, pass or fail, with per-question detail you can read on Manage Content's Case Studies tab. This is the escape hatch for bespoke, custom-built exercises.</li>
</ul>

<h2>Collect — The Player Submits, With No Right or Wrong</h2>
<p>You're gathering something, not grading it. Use these for reflection, feedback, evidence, and opinion.</p>
<ul>
  <li><strong>Open Text</strong> — free writing to the prompt in the step's Content, with an optional minimum word count. Tick <strong>Check the player's answer with A.I. before they continue</strong> and the answer is checked before the player moves on, giving them instant feedback to revise against. Two settings shape the check:
    <ul>
      <li><strong>A.I. Strictness</strong> — Lenient (only reject blank or unrelated answers), Standard (a genuine, on-topic attempt passes) or Strict (every part of the prompt must be engaged with).</li>
      <li><strong>A.I. Reviewer Context</strong> — private: players never see it, and the A.I. is told never to quote it back. Say what a good answer to this question must include. It's optional; without it the A.I. judges whether the answer is a genuine attempt at the prompt.</li>
    </ul>
    Both settings are also used when you ask the A.I. for a second opinion on the finished submission, even if the player-side check is off. The check needs an Anthropic API key on the adventure's A.I. tab (a cohort uses its template's key). If a check can't run, the answer is let through and staff are told why. See <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>.</li>
  <li><strong>Survey Choice</strong> — a question with options and no correct answer. Choose whether players can pick more than one. With multiple answers on, <strong>Most answers a player can pick</strong> caps how many they tick (0 means no limit): the player sees "Choose up to 3" and the remaining boxes lock at the limit.</li>
  <li><strong>Rating Scale</strong> — a numeric scale with a minimum and maximum you set, plus a label for each end ("Strongly Disagree" to "Strongly Agree"). The tool for pulse checks and confidence self-ratings.</li>
  <li><strong>Poll</strong> — a question whose results render as live percentage bars the moment the player votes. Use it when seeing what everyone else said is the point.</li>
  <li><strong>Upload Image</strong> — the player submits a photo or screenshot, with a maximum file size you set. Use it for anything you need to <em>see</em> to assess.</li>
  <li><strong>Upload Video</strong> — the same, for video. Pitches, demonstrations, language practice, physical technique.</li>
</ul>

<h2>Profile — Weighted Toward a Trait</h2>
<p>This group appears in the Step Type menu once the adventure has a published profile (built under Manage Content, Profiles). All three ask which <strong>Profile</strong> the step belongs to, so one Milestone can carry questions for more than one, mixed in with story steps. Players never see the weights. See <a href="/docs/profile-tests">Profile Tests</a>.</p>
<ul>
  <li><strong>Weighted Options</strong> — a question whose options each carry a weight per trait, in a table with one column per trait (leave a cell at 0 for a trait an answer says nothing about). You choose whether the player can pick more than one; every picked option adds its own weights.</li>
  <li><strong>Agree / Disagree Scale</strong> — a statement the player rates, which scores toward one trait. Set the lowest and highest value (1 and 7 by default) and a label for each end. Write the statement so agreeing means <em>more</em> of the trait: the score is added as given.</li>
  <li><strong>Profile Result</strong> — shows the player their sheet for that profile: the dominant trait, the chart, and what every trait means. It never shows their answers back to them. Place it wherever the reading belongs, including a later Milestone; it reads everything the player has answered for that profile anywhere in the adventure.</li>
</ul>

<h2>Flow — Routing &amp; Branching</h2>
<ul>
  <li><strong>Branch Choice</strong> — the player picks one of the paths in a branch group, and that choice is permanent and mutually exclusive: taking one closes the others. This is how you build "choose your track" moments. Branch groups themselves are set up on the achievement's Settings tab, then referenced here. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</li>
  <li><strong>Jump to Step</strong> — buttons you draw, each with a Label, an optional image, and a <strong>Jump to</strong> destination among this Milestone's other steps. The player sees them as "Choose one option", and picking one takes them straight there. Add the other steps first so there's somewhere to jump to. A button whose destination you later delete simply goes to the next step.</li>
  <li><strong>Encounter Choice</strong> — listed as "Encounter Choice (costs money + energy)". A situation in the step's Content, then priced options. Each option has a label and description, what it <strong>Costs</strong> and <strong>Pays</strong> in BLOO, its <strong>Energy</strong> cost, an <strong>XP</strong> change (which can be negative, and can cost a level), plus <strong>Then grant</strong> (an achievement, which is how a follow-up Milestone gets unlocked) and <strong>Then say</strong> (a <a href="/docs/consequences">Consequence</a> message). BLOO can go below zero, which is the setback. Energy can't, so an option the player can't afford the energy for is disabled: always leave one option that costs 0 energy, or a player with an empty tank is stuck. See <a href="/docs/random-encounters">Random Encounters</a>.</li>
</ul>

<h2>Special</h2>
<ul>
  <li><strong>System Message</strong> — narrator text in the system voice, with no character attached. For instructions, transitions, and anything that isn't a person speaking. It never shows a character, even though the editor offers the character settings here too; use Dialogue for a person.</li>
  <li><strong>Win Screen</strong> — a custom success ending, showing this step's Content. It replaces the standard win screen wherever it sits in the list.</li>
  <li><strong>Fail Screen</strong> — a custom fail ending, shown when a player runs out of attempts. It replaces the standard fail screen; its button clears the player's answers and starts the Milestone over.</li>
  <li><strong>Choose Nickname</strong> — prompts the player for a nickname and saves it to their account. Nicknames are letters, numbers, dots, hyphens and underscores, and must not already be taken. Almost always in the first Milestone of an Adventure.</li>
  <li><strong>Choose Avatar</strong> — you define the avatars: <strong>Add avatar</strong> for each one and choose its image. The player picks one of them. Same placement logic as Choose Nickname.</li>
</ul>

<h2>Pacing: The Only Rule That Matters</h2>
<p>Alternate the groups. Deliver something, then ask for something. A run of Deliver steps reads like a slide deck; a run of Validate steps reads like an exam. The Milestones players remember alternate every two or three Steps.</p>

<h2>Per-Step Rewards</h2>
<p>Any Step can hand out its own XP, BLOO, EP, item, or achievement, independent of the Milestone's overall reward. Use small per-Step rewards to keep a long Milestone feeling alive along the way, and save the bigger payout for completion.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/step-type-quick-reference">Step Type Quick Reference</a> — all 28 on one screen</li>
  <li><a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a></li>
  <li><a href="/docs/profile-tests">Profile Tests</a></li>
  <li><a href="/docs/random-encounters">Random Encounters</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Step Type Quick Reference',
                'slug'       => 'step-type-quick-reference',
                'section'    => 'setup',
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>A fast lookup for all 28 Step types available inside a Milestone, grouped the way the builder's Step Type menu groups them. See <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> for the fuller explanation of each.</p>

<h2>Deliver — auto-completes on view</h2>
<ul>
  <li><strong>Dialogue</strong> — a character speaks; a speaker from the cast or a custom name and portrait; left/right/no one.</li>
  <li><strong>Video</strong> — plays a video file; watch time tracked per player.</li>
  <li><strong>Audio</strong> — plays an audio clip in a player widget.</li>
  <li><strong>Find Item</strong> — hands the player an item into their Backpack.</li>
</ul>

<h2>Validate — must be answered correctly to advance</h2>
<ul>
  <li><strong>Multiple Choice</strong> — question, optional image, one or many correct options.</li>
  <li><strong>Keyphrase</strong> — type a phrase; list of accepted answers, optional case sensitivity; attempt limit supported.</li>
  <li><strong>Cryptex</strong> — the same as Keyphrase, as a combination lock with a set wheel count (up to 20).</li>
  <li><strong>Puzzle</strong> — jigsaw from an uploaded image, on a grid you choose (2–8 by 2–8).</li>
  <li><strong>Require Backpack Item</strong> — the player picks the right item off a rack of their own backpack; optionally consumes it; attempt limit supported.</li>
  <li><strong>SCORM Package</strong> — runs an uploaded SCORM 1.2 package with completion tracking and resume.</li>
  <li><strong>Case Study (HTML)</strong> — embeds an external interactive activity; set pass score and question count; every attempt kept.</li>
</ul>

<h2>Collect — a submission, with no right or wrong</h2>
<ul>
  <li><strong>Open Text</strong> — free writing; minimum word count; optional A.I. check with a strictness (lenient/standard/strict) and private reviewer context.</li>
  <li><strong>Survey Choice</strong> — a question with options; allow multiple, and optionally cap how many ("Choose up to N").</li>
  <li><strong>Rating Scale</strong> — numeric scale with min/max values and a label at each end.</li>
  <li><strong>Poll</strong> — a question whose aggregate results appear as percentage bars after voting.</li>
  <li><strong>Upload Image</strong> — image submission with a maximum file size.</li>
  <li><strong>Upload Video</strong> — video submission with a maximum file size.</li>
</ul>

<h2>Profile — weighted toward a trait (shown once the adventure has a profile)</h2>
<ul>
  <li><strong>Weighted Options</strong> — options that each add weight to one or more traits.</li>
  <li><strong>Agree / Disagree Scale</strong> — a statement rated on a scale, scoring toward one trait.</li>
  <li><strong>Profile Result</strong> — shows the player's profile sheet; never their answers.</li>
</ul>

<h2>Flow — routing &amp; branching</h2>
<ul>
  <li><strong>Branch Choice</strong> — a permanent, mutually exclusive pick between the paths in a branch group.</li>
  <li><strong>Jump to Step</strong> — buttons you draw, each sending the player to another step.</li>
  <li><strong>Encounter Choice</strong> — priced options spending BLOO and energy; BLOO can go into debt, energy can't; leave one option at 0 energy.</li>
</ul>

<h2>Special</h2>
<ul>
  <li><strong>System Message</strong> — narrator text with no character attached.</li>
  <li><strong>Win Screen</strong> — a custom success ending, replacing the standard one.</li>
  <li><strong>Fail Screen</strong> — a custom fail ending for a player who runs out of attempts.</li>
  <li><strong>Choose Nickname</strong> — prompts for the player's nickname and saves it.</li>
  <li><strong>Choose Avatar</strong> — the player picks from the avatars you define.</li>
</ul>

<h2>On Every Step</h2>
<p>Any Step can be marked optional, can carry a background image, and can pay out its own XP/BLOO/EP/item/achievement on top of the Milestone's overall reward. Multiple Choice, Keyphrase, Cryptex, Puzzle, Require Backpack Item and SCORM Package can also carry a Mistake Message and a Maximum attempts setting (use the limit on Keyphrase and Require Backpack Item). Every Milestone ends on a win screen, and on a fail screen for a player who runs out of attempts, whether or not you add those steps.</p>
HTML,
            ],
            [
                'title'      => 'Speakers & the Dialogue Cast',
                'slug'       => 'speakers-and-dialogue-cast',
                'section'    => 'setup',
                'sort_order' => 13,
                'body'       => <<<'HTML'
<p>A recurring character shouldn't have to be retyped on every line. Forty lines of the same mentor used to mean forty chances to spell her name differently or pick last week's portrait, and changing that portrait meant editing all forty. <strong>Speakers</strong> fix that: a Dialogue step names a speaker from the adventure's cast, and the name and portrait are read from the cast every time the line is shown.</p>

<h2>Naming a Speaker on a Dialogue Step</h2>
<p>In the Edit Step window for a Dialogue step, the <strong>Who is speaking</strong> menu lists the adventure's published speakers:</p>
<ul>
  <li><strong>Pick a speaker</strong> and a preview shows their name and portrait ("Name and portrait come from the Speakers page"). The step's own Character Name and Character Image fields are hidden, because they're no longer used.</li>
  <li><strong>Custom — set a name and portrait below</strong> keeps the old behaviour: type a name and choose an image for this line only. Use it for a one-off character who never speaks again.</li>
</ul>
<p><strong>Character Position</strong> (on the left, on the right, or no one) still belongs to the step, so the same speaker can stand on either side of the scene. If the adventure has no cast yet, the menu says so and links to <strong>Add a speaker</strong>.</p>
<p>Only Dialogue steps show a speaker. System Message steps are narrator text and never display a character.</p>

<h2>Change It Once, Every Line Follows</h2>
<p>The step stores a reference to the speaker, not a copy. Rename a speaker or swap their portrait and every line they speak updates at once, across every Milestone, without touching a single step.</p>

<h2>The Speakers Tab in Manage Content</h2>
<p>Manage Content has a <strong>Speakers</strong> tab for the cast. Its header counts how many are in the cast and how many have dialogue, and <strong>New Speaker</strong> opens the full speaker editor. Each row shows:</p>
<ul>
  <li>the speaker's portrait, with their first and last name editable right in the row (a rename saves as you make it, and every line follows)</li>
  <li>a Draft badge if they aren't published, and their company if one is set</li>
  <li>how many lines they speak (the number of steps that name them), or "No lines yet"</li>
  <li><strong>Edit</strong> for everything else about the speaker, <strong>View</strong> for their public speaker page, and <strong>Trash</strong></li>
</ul>
<p>The toolbar searches the cast, filters to <strong>With dialogue</strong> or <strong>Not used yet</strong> or by status, and sorts by name or by lines of dialogue.</p>
<p><strong>Trashing a speaker doesn't silence them.</strong> Lines that already name them keep speaking; the speaker just stops being offered on new steps. The Trash button's tooltip tells you how many lines that affects, and trashed speakers sit in their own Trashed section with Restore and Delete Forever.</p>

<h2>What a Speaker Holds</h2>
<p>The speaker editor has a <strong>Speaker Picture</strong> (required), First Name and Last Name, Company, Website, LinkedIn and a Speaker Bio, plus an optional <strong>Connect to Player</strong> link to a user account. Dialogue only uses the name and picture; the company, links and bio appear on the speaker's own page.</p>

<h2>Speakers Also Run the Event Schedule</h2>
<p>The same cast is the speaker list for your <a href="/docs/event-schedule-concept">event schedule</a>. When you build a session you tick which speakers are on it, the schedule shows who's speaking at each session, and each speaker's page lists the sessions they're in. When the adventure's Speakers feature is on, players also get a Speakers page in the menu. So one speaker record can narrate your story and headline your live session. See <a href="/docs/how-to-build-an-event-schedule">How to Build an Event Schedule</a>.</p>

<h2>Templates, Cohorts and Duplicating</h2>
<p>Speakers belong to the template adventure, so every cohort shares the same cast and a portrait changed on the template changes it everywhere. When you duplicate a Milestone within the same adventure family, its lines keep their speakers. Duplicate it into an unrelated adventure and the speaker links are cleared, because that adventure has its own cast; re-pick the speakers there.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> — the Dialogue step in context</li>
  <li><a href="/docs/how-to-build-an-event-schedule">How to Build an Event Schedule</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Challenges — Concept',
                'slug'       => 'challenges-concept',
                'section'    => 'setup',
                'sort_order' => 14,
                'body'       => <<<'HTML'
<p>A <strong>Challenge</strong> is the other thing you can place on the Journey Map alongside a Milestone. Where a Milestone <em>provides</em> knowledge, a Challenge <em>tests</em> it.</p>

<h2>There's a Right Answer</h2>
<p>A Challenge is a quiz. You build a bank of questions, and each attempt shows a subset drawn from that bank. <strong>Questions to display</strong> sets how many appear per attempt and <strong>Answers to win</strong> sets how many correct answers count as a pass. A question can have more than one correct option; it only counts as right when the player picks exactly those. Add a <strong>Time Limit</strong> (in seconds) if you want it to feel like a real test rather than an untimed review: when the clock runs out, a <em>Time's up!</em> screen covers the questions, and clicking it grades the attempt.</p>

<h2>Attempts &amp; Retries</h2>
<p>Three settings decide how often a player can try:</p>
<ul>
  <li><strong>Max Chances</strong> — the total number of attempts (0 means unlimited). Once it's reached, the Challenge shows <em>Max Attempts Reached</em>.</li>
  <li><strong>Free Attempts</strong> — how many attempts cost nothing.</li>
  <li><strong>Attempt Cost</strong> — the BLOO charged for each attempt after the free ones. A player who can't afford the next attempt can't start it.</li>
</ul>
<p>Together they're what makes a Challenge a real assessment rather than something a player can brute-force by retrying indefinitely for free.</p>

<h2>Enforced by the Server, Not the Browser</h2>
<p>Every rule around an attempt is checked on the server when it matters. The cost, the attempt cap, the player's level, the requirements and the deadline are all checked when an attempt starts, so nothing a player changes in their browser makes a paid attempt free or opens a closed Challenge. Answers are only accepted into the player's own open attempt, for questions that belong to this Challenge. Each attempt is graded once, so a failed attempt can't be re-answered into a pass. And the answer key never leaves the server: nothing the player's browser receives says which options are correct.</p>

<h2>How an Attempt Ends: the Review Pass</h2>
<p>There's no results screen to dismiss. When an attempt is graded, a panel headed <em>Challenge complete</em> or <em>Not this time</em> shows the score (for example <em>3 of 5 right — 60%</em>) and how many were needed. Its only button is <strong>Review my answers</strong>, pass or fail. Behind it is the player's own graded attempt: every question marked right or wrong, with only their own picks marked and any unanswered question shown as wrong.</p>
<p>A bar along the bottom shows the score and offers <strong>Back to the journey</strong>, plus <strong>Try again</strong> after a fail.</p>

<h2>Per-Question Explanations</h2>
<p>Each question has an optional <strong>Explanation</strong>, shown during the review and <strong>only for questions the player got right</strong>. Handing the reasoning to someone who got it wrong would hand them the answer, and there's a retry. Write why the answer is right, the idea you want them to take away, not "well done": the score already says that. Left blank, nothing shows.</p>

<h2>Rewards and Grading</h2>
<p>A passed Challenge pays its XP, BLOO and EP, plus any Item, Achievement or Skill reward you set. If the adventure assigns resources After Grading, a Challenge's BLOO is scaled by the score of the attempt that passed. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a> for the grading settings.</p>

<h2>Challenge or Milestone?</h2>
<p>If a player could plausibly fail and be sent back to try again, build a Challenge. If they just need to go through the content, even content that asks them questions along the way, build a Milestone. A Milestone can absolutely contain Multiple Choice, Keyphrase and other Validate steps that must be answered correctly; the difference is that those gate a single Step, while a Challenge grades the whole thing and can be failed as a unit.</p>

<h2>In Launch Week</h2>
<p>The Week One company-policy quiz is a Challenge: five questions per attempt, four correct to pass, two free attempts, a small BLOO cost for a third. Each question's explanation names the policy it comes from, so the review pass doubles as a study guide. The end-of-Week-One "How was your first week?" check-in is <em>not</em> a Challenge. It's a Milestone built from Rating Scale and Open Text steps, because there's nothing there to get right.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-a-challenge">How to Build a Challenge</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Build a Challenge',
                'slug'       => 'how-to-build-a-challenge',
                'section'    => 'setup',
                'sort_order' => 15,
                'body'       => <<<'HTML'
<p>Step-by-step. See <a href="/docs/challenges-concept">Challenges — Concept</a> if you haven't decided whether you want a Challenge or a Milestone, and <a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone</a> for the other route.</p>

<ol>
  <li><strong>Create it.</strong> Open <strong>New Challenge</strong> from the menu (it appears when the adventure's Challenges feature is on). On the General tab give it a Name, Color, Icon and Main Image, then press <strong>Create Challenge</strong> in the bottom bar. The Questions tab reads "Please save the challenge before adding questions" until you do.</li>
  <li><strong>Write your question bank.</strong> On the Questions tab, <strong>Add Question</strong> opens a question with its <strong>Question Text</strong>, optional <strong>Media</strong>, an <strong>Explanation</strong>, and its <strong>Answer Options</strong>. Add each option with <strong>Add Option</strong>, switch <strong>Correct</strong> on for the right one (or ones), and give it an image if you like. Each question also has Remove and Duplicate.</li>
  <li><strong>Write the explanations.</strong> The Explanation is shown on review, and only to a player who got that question right. Say why the answer is right, not "well done". Blank is fine.</li>
  <li><strong>Set the Challenge Mechanics</strong> on the Mechanics tab: <strong>Questions to display</strong>, <strong>Answers to win</strong>, <strong>Time Limit</strong> in seconds (blank for none), <strong>Max Chances</strong> (0 for unlimited), <strong>Free Attempts</strong>, and the <strong>Attempt Cost</strong> in BLOO for each attempt after those. The same tab carries the Tabi, Level, XP/BLOO/EP reward, Start Date and Deadline, just as a Milestone does.</li>
  <li><strong>Write the Content.</strong> The <strong>Short Description</strong> is the preview players read when they click the Challenge on the map. The <strong>Success Message</strong> lands on the player's Secrets &amp; Clues page once they pass.</li>
  <li><strong>Set requirements and extra rewards</strong> on the Advanced tab: the <strong>Conditions</strong> drawer for prerequisites, and the Skill, Item and Achievement rewards. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a>; they work the same way here.</li>
  <li><strong>Pick a status and save.</strong> Choose Publish, Draft or Locked in the bottom bar and press <strong>Update Challenge</strong>.</li>
  <li><strong>Place it on the Journey Map</strong>, into a Tabi, or positioned directly in the Journey Builder.</li>
</ol>

<h2>What the Player Gets</h2>
<p>A player presses <strong>Start!</strong> (the panel beside it says whether the attempt is free or what it costs), answers, and presses <strong>Submit answers!</strong>. The attempt ends on a review pass rather than a results screen: a score panel whose only button is <strong>Review my answers</strong>, the graded questions with your explanations on the ones they got right, and a bottom bar with <strong>Back to the journey</strong> and, after a fail, <strong>Try again</strong>. Costs, the attempt cap and grading are enforced by the server, and the answer key is never sent to the player's browser.</p>

<h2>Sizing the Question Bank</h2>
<p>Write more questions than you show. A bank of fifteen with five shown per attempt means a retry is a genuinely different test, which is what makes limited retries fair rather than a memory exercise. Leave <strong>Questions to display</strong> blank (or set it higher than the bank) and every question is shown. An <strong>Answers to win</strong> higher than the number shown is treated as "all of them".</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/challenges-concept">Challenges — Concept</a></li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit</a> — copying a Challenge, questions and all, into another adventure</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Profile Tests — Profiles, Traits & Weighted Questions',
                'slug'       => 'profile-tests',
                'section'    => 'setup',
                'sort_order' => 16,
                'body'       => <<<'HTML'
<p>A Profile Test measures something about a player rather than testing what they know: a player type, a working style, a team role. You define the scale once and weight ordinary questions toward its traits. Each player then gets a character sheet that fills in as they answer. The official Marczewski HEXAD is built in and installs in one click.</p>

<h2>Switching It On</h2>
<p>Turn on <strong>Profile Tests</strong> on the Features tab of Adventure Settings. That adds a <strong>Profiles</strong> tab to Manage Content and a Profiles section to Stats.</p>

<h2>The Pieces</h2>
<ul>
  <li><strong>A profile</strong> — the scale, such as "Marczewski HEXAD" or "Team Role Profile". It belongs to the Adventure, not to one milestone. A long test and a short re-test can score against the same profile and stay comparable.</li>
  <li><strong>Traits</strong> — what the profile measures. Each one is either allowed to be a player's headline or measured only.</li>
  <li><strong>Questions</strong> — ordinary steps in any milestone, each weighted toward one or more traits.</li>
  <li><strong>The Profile Result step</strong> — shows the player their sheet, wherever you place it.</li>
</ul>

<h2>Creating a Profile</h2>
<p>On Manage Content → Profiles, press <strong>New Profile</strong>:</p>
<ul>
  <li><strong>Profile name</strong> — what the scale is called.</li>
  <li><strong>Draw the result as</strong> — Polar area (like the Hexad), Radar / spider, or Horizontal bars.</li>
  <li><strong>Status</strong> — Published or Draft. Only a published profile can be picked by a question.</li>
  <li><strong>Can a player take it again?</strong> — No (the default) or Yes. See Retakes below.</li>
  <li><strong>Description</strong> — a sentence or two, shown above the result.</li>
</ul>
<p>Press <strong>Create profile</strong>, then add its traits. Give it at least two: the Profiles list flags a profile with fewer.</p>

<h2>Traits</h2>
<ul>
  <li><strong>Name</strong> and <strong>Colour</strong> — the colour is the trait's slice of the chart and its bar.</li>
  <li><strong>What it means</strong> — shown when this trait is the player's headline, and in their full breakdown. Player tokens work here.</li>
  <li><strong>Icon</strong> or <strong>Badge image</strong> — optional artwork for the headline. A badge image is used instead of the icon when both are set.</li>
  <li><strong>Can this trait win?</strong> — "Yes — it can be the headline result" or "No — measure it only". A measure-only trait is scored and charted but never announced as the player's type, and the sheet says so. That's how the real HEXAD treats Player and Disruptor.</li>
  <li><strong>Award this achievement when it wins</strong> — optional. Point it at a path achievement and a result becomes something the <a href="/docs/conditions-when-things-unlock">Conditions</a> engine can gate content on.</li>
  <li><strong>Order</strong> — where the trait sits on the chart. The breakdown under the chart always ranks high to low.</li>
  <li><strong>Weight key</strong> — set once when the trait is created and never changeable afterwards, because every question's weights point at it. Leave it blank to derive it from the name. Renaming the trait later is fine.</li>
</ul>

<h2>Writing the Questions</h2>
<p>There's no separate test builder. Once the Adventure has a published profile with traits, every milestone's step picker gains a <strong>Profile</strong> group with three step types:</p>
<ul>
  <li><strong>Weighted Options</strong> — a question with several answers. The editor shows one column per trait. Give each answer a weight toward the traits it says something about, and leave the rest at 0. You can let players pick more than one answer, in which case each pick adds its own weights.</li>
  <li><strong>Agree / Disagree Scale</strong> — one statement, answered on a numbered scale (1 to 7 unless you change it) between two labels such as "Strongly disagree" and "Strongly agree". The value picked goes to the one trait you choose. Write every statement so that agreeing means <em>more</em> of the trait: the score is added as given, so a reversed statement scores backwards.</li>
  <li><strong>Profile Result — show the sheet</strong> — no question, just the player's character sheet for the profile you choose.</li>
</ul>
<p>Each of these steps names its own <strong>Profile</strong>, so one milestone can carry questions for more than one scale and each is scored separately. Because questions are just steps, you can give a test a milestone of its own. You can also scatter the questions through story milestones, so players answer them without noticing they're being profiled.</p>

<h2>How a Reading Is Scored</h2>
<p>A player's reading is rescored every time they answer one of the profile's questions. It counts every answer they've given for that profile anywhere in the Adventure. A half-finished test is therefore a real, partial reading, and the sheet says how many answers stand behind it.</p>
<p>The headline is the highest-scoring trait that's allowed to win. If a measure-only trait comes out on top, the player gets the best of the eligible ones instead. If no trait in the profile can win, the sheet shows the player's full mix with no headline.</p>
<p><strong>Weights are never shown to players.</strong> They stay on the server: the browser only says which option was picked, and the sheet never shows answers back. A player can't read the weights to steer their result, and can't forge a better one.</p>

<h2>Placing the Result</h2>
<p>Put a Profile Result step wherever the reading belongs: right after the questions, at the end of a later milestone, or in a milestone of its own. It reads everything the player has answered for that profile anywhere in the Adventure, so it works even when the questions are spread across the journey. A player who reaches it before answering anything is told nothing has been measured yet, rather than shown an empty chart.</p>
<p>Players can always find their reading again on their Journal's <strong>Profiles</strong> tab, which appears as soon as the Adventure has a published profile.</p>

<h2>Pasting a Question Set</h2>
<p>Opening the step drawer twenty times for twenty questions is slow. Once the Adventure has a profile, a saved milestone's Steps section has <strong>Paste a question set</strong>. Write the questions in any text editor, one per line, with the trait after a <code>|</code>:</p>
<ul>
  <li>An agree/disagree statement is one line: <code>I like overcoming obstacles | Achiever</code></li>
  <li>A weighted-options question is the question on one line, followed by each answer on its own line starting with <code>-</code>, for example <code>- A way nobody has tried | Disruptor, Free Spirit</code></li>
  <li>Name traits however you see them (<code>Free Spirit</code> or <code>freespirit</code>), separate several with commas, and add <code>x2</code> to make an answer count double.</li>
</ul>
<p>Choose which profile <strong>These questions measure</strong>, press <strong>Check it</strong> to preview (this writes nothing), then press <strong>Add these questions</strong>. Nothing is added unless every line parses. Problems come back as a list that quotes the lines to fix. New questions are always added, never replaced, and they land before any Profile Result, win or fail step already in the milestone. Agree/disagree statements come in on a 1–7 scale from "Strongly disagree" to "Strongly agree".</p>

<h2>The Official HEXAD in One Click</h2>
<p>On Manage Content → Profiles, <strong>Add the official HEXAD</strong> creates the Marczewski HEXAD profile with its six traits and their descriptions: Achiever, Player, Socialiser, Philanthropist, Disruptor and Free Spirit. As in the original, Player and Disruptor are measured only, and retakes start off. It's safe to press twice: anything already there is left exactly as it is, and only missing pieces are filled in.</p>
<p>The button creates the scale, not the questions. To add those, open the milestone that should carry them, expand <strong>Paste a question set</strong> and press <strong>Use the official HEXAD questions</strong>. That fills the box with the 24 agree/disagree statements, four per type, interleaved so no type comes up four times in a row. You can edit them, trim them or split them across milestones before adding.</p>

<h2>Retakes</h2>
<p>Retakes are off by default, because a reading a player can redo at will is one they can steer. Set <strong>Can a player take it again?</strong> to Yes and players get a <strong>Take it again</strong> button on their own sheet. It only appears when every question they answered for that profile sits in one milestone. There's no sensible way to re-run questions spread across several story milestones, so in that case no button appears. A retake clears that player's answers and result for the profile and sends them back to the milestone. An achievement they already earned from the old headline stays.</p>

<h2>Seeing How the Cohort Came Out</h2>
<p>The <strong>Profiles</strong> section of <a href="/docs/stats-dashboard-guide">Stats</a> lists each profile with its traits and questions, how many players have a reading, their average number of answers, and the most common headline. Click a profile for the cohort view:</p>
<ul>
  <li>How many readings there are, and how many players haven't started.</li>
  <li><strong>Cohort average per trait</strong> — the shape of the group. Bars are relative to the highest average: a profile's point total depends on how many questions you wrote, so only the differences between traits mean anything.</li>
  <li><strong>What they came out as</strong> — each headline trait with its count and share, and the players who got it, each showing how many answers their reading rests on.</li>
</ul>
<p>Only enrolled players count, so staff rehearsing a test don't move the numbers. You can also open any player's Journal to see their full sheet, and the Players roster gains a player-type column once anyone has a reading.</p>

<h2>Good to Know</h2>
<ul>
  <li>Profiles are authored on the template and shared by every cohort. Each cohort's readings are its own.</li>
  <li>Deleting a profile deletes its traits. Questions weighted toward it stay in their milestones but stop scoring, and saved results are kept but stop showing a chart. The confirmation tells you how many of each.</li>
  <li>Deleting a trait means any weights set against it stop counting.</li>
  <li>The Profiles list shows each profile's questions ("10 questions in 1 milestone") and how many readings have been taken. You can filter it to profiles being measured or ones with no questions yet.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions: When Things Unlock</a></li>
  <li><a href="/docs/your-profile-results">Your Profile Results</a> — the player's side</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Posts & Resources',
                'slug'       => 'posts-and-resources',
                'section'    => 'setup',
                'sort_order' => 17,
                'body'       => <<<'HTML'
<p><strong>Posts</strong> and <strong>Resources</strong> are the adventure's reading material. They aren't played like milestones and they don't sit on the Journey: players open them from the menu, read them, and move on. A Post is an article or a notice; a Resource is reference material — an article, or a file or link to download.</p>
<p>They appear in the menu when the adventure has the <strong>Blog</strong> and <strong>Lore / Resources</strong> features switched on, under the names Posts and Resources unless your platform has renamed them. Create them from Add Mechanics with <strong>New Post</strong> and <strong>New Resource</strong>.</p>

<h2>Writing a Post</h2>
<ul>
  <li><strong>Post Headline</strong>, and a <strong>Secondary Headline</strong> shown under it.</li>
  <li><strong>Post Image</strong> — required.</li>
  <li><strong>Level</strong> — the level a player needs to reach.</li>
  <li><strong>Display Style</strong> — how the post presents (below).</li>
  <li><strong>Start Date</strong> — optional; the post isn't available before it.</li>
  <li><strong>Available for</strong> — <strong>All paths</strong>, or a single path.</li>
  <li><strong>Content</strong> — the article itself, in the rich-text editor. Player tokens work here, so a post can greet each reader by name; see <a href="/docs/personalising-text-with-player-tokens">Personalising Text</a>.</li>
  <li>Status: <strong>Publish</strong>, <strong>Draft</strong> or <strong>Trash</strong>.</li>
</ul>

<h2>The Four Display Styles</h2>
<ul>
  <li><strong>Text on Right</strong> — the default. Image on the left, words on the right.</li>
  <li><strong>Text on Left</strong> — the same two panes, words first.</li>
  <li><strong>News Highlight</strong> — one full-width image with the headline laid over its foot.</li>
  <li><strong>Headline</strong> — no image at all, by design: the style for a short notice.</li>
</ul>
<p>On a narrow screen the two-pane styles stack. A post with no image shows in the Headline style whatever you picked.</p>

<h2>Writing a Resource</h2>
<ul>
  <li><strong>Resource Name</strong>.</li>
  <li><strong>Style</strong> — <strong>Resource</strong> (the default) or <strong>Article</strong>.</li>
  <li><strong>Level</strong>.</li>
  <li><strong>File or Link</strong> — paste a URL, or press <strong>Select file</strong> to pick one from the media library.</li>
  <li><strong>Content</strong>.</li>
  <li><strong>Image</strong> — one of twelve ready-made book covers, or your own.</li>
  <li><strong>Color</strong> — the accent on its card.</li>
  <li><strong>Available for</strong> — all paths, or one.</li>
</ul>
<p>Saving a resource publishes it straight away; there's no draft state. To take one down, trash it from its card or from Manage Content.</p>

<h2>How a Resource Becomes a Download</h2>
<p>A resource with the <strong>Resource</strong> style and a <strong>File or Link</strong> is a download: its card's button reads <strong>Download</strong> and opens the file or link in a new tab, and its reading page carries a Download button above the content. With no file or link — or with the <strong>Article</strong> style — it's an article, and <strong>Read</strong> opens the reading page. The Resources page shows them as a grid of cards, each with the start of its content.</p>

<h2>The Reading View</h2>
<p>Posts and resources open on the same kind of page: the image and headline in the chosen style, the level and path as badges, the date it was posted, then the content. A <strong>Back to Posts</strong> (or Resources) link returns to the list. GMs also get <strong>Edit</strong> and <strong>All Posts</strong> buttons at the foot of the page. Manage Content's Journey tab lists posts and resources alongside milestones, each labelled with its type and with a View link.</p>

<h2>Who Can Read What</h2>
<p>Posts and resources are gated the way milestones are:</p>
<ul>
  <li><strong>Level</strong> — the list only shows what a player's level has reached. Opened directly before then, the page says <em>You need to be Level N to open this post.</em></li>
  <li><strong>Start date</strong> (Posts) — before it, the page says the post isn't available yet and gives the date. If the adventure hides milestones by date (any option other than <strong>Never</strong> in its time settings), future posts are also left out of the list until then.</li>
  <li><strong>Path</strong> — a post or resource set to one path doesn't appear for players on another, and they can't open it at all.</li>
</ul>
<p>A gated page always offers a way back to its list. Staff can open any post or resource directly, to check it.</p>

<h2>What They Don't Do</h2>
<p>Posts and resources carry no rewards and don't count toward journey or chapter completion. They don't appear on the Journey map or inside Tabis. If you need players to read something and earn for it, put it inside a milestone instead — a Dialogue or System Message step, for example.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/personalising-text-with-player-tokens">Personalising Text With Player Tokens</a></li>
  <li><a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a> — how paths work</li>
  <li><a href="/docs/announcements-keeping-an-adventure-alive">Announcements</a> — other ways to keep players informed</li>
  <li><a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a> — the Posts and Resources backgrounds</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Conditions — When Things Unlock',
                'slug'       => 'conditions-when-things-unlock',
                'section'    => 'setup',
                'sort_order' => 18,
                'body'       => <<<'HTML'
<p>A <strong>condition</strong> is a rule about a player's progress: "reach level 5", "finish the Week 1 Tabi", "complete 3 milestones within 7 days". BLUERABBIT has one conditions engine, and the same rules drive several different things. Learn to write them in one place and you can write them anywhere.</p>

<h2>Where Conditions Are Used</h2>
<ul>
  <li><strong>Achievements</strong> — the achievement editor's Conditions tab, <strong>Auto-Grant Conditions</strong>. The achievement is awarded the moment a player meets them.</li>
  <li><strong>Milestones</strong> — the milestone builder's <strong>Conditions</strong> drawer. Its <strong>Threshold conditions</strong> sit alongside the required milestones, achievements and key item, and a player who doesn't meet them sees the milestone as locked.</li>
  <li><strong>Certificates</strong> — each certificate unlocks by its own conditions, and a locked one tells the player what's still missing.</li>
  <li><strong>Garden Tasks</strong> — a task whose trigger is <strong>The player meets a set of conditions</strong> completes itself when they're met.</li>
  <li><strong>Encounter groups</strong> — <strong>When the player is ready</strong> decides when a group can deal a hand.</li>
  <li><strong>Evolving Tabi scenes</strong> — each row of a scene measures one condition, and its stages are the thresholds along it.</li>
</ul>

<h2>All Must Be Met</h2>
<p>When something carries several conditions, <strong>every one</strong> has to be true. There's no "either/or": if you need two routes to the same outcome, build two things (two achievements, two encounter groups) with one rule set each.</p>
<p>Conditions only ever ask "has the player reached at least this much?" There's no "at or below". To react to a player falling under a line, like running out of energy or going into debt, use <a href="/docs/consequences">Consequences</a>. That's also why BLOO and EP balances aren't condition types: a condition grants something permanent, and a balance can be spent a minute later.</p>

<h2>When There Are No Conditions</h2>
<p>It depends on the thing, and the difference is deliberate:</p>
<ul>
  <li><strong>Open.</strong> A milestone, a certificate or an encounter group with no conditions is available from the start.</li>
  <li><strong>Never automatic.</strong> An achievement with no Auto-Grant Conditions is only ever awarded some other way (by hand, by a milestone, a magic code or an encounter choice). A condition-triggered task with no conditions never fires.</li>
</ul>

<h2>The Condition Types</h2>
<p>There are 17, listed here by the label you'll see in the picker:</p>
<ul>
  <li><strong>Level</strong> — the player's level.</li>
  <li><strong>XP</strong> — their XP total.</li>
  <li><strong>Journey Completion %</strong> — the share of the journey's required milestones they've finished. Optional milestones don't count toward it.</li>
  <li><strong>Milestones Completed</strong> — how many milestones they've finished, optional ones included.</li>
  <li><strong>Tabis Completed</strong> — how many Tabis they've finished.</li>
  <li><strong>Tabi Progress % (pick a Tabi)</strong> — how far through one particular Tabi they are.</li>
  <li><strong>Complete This Milestone</strong> — one particular milestone is finished.</li>
  <li><strong>Complete This Tabi</strong> — one particular Tabi is finished.</li>
  <li><strong>Item Shop Transactions</strong> — how many entries are on the player's transaction record. Despite the name, that's more than shop purchases: items received from milestones and Find Item steps, paid challenge attempts and encounter charges all count.</li>
  <li><strong>Items Consumed</strong> — how many consumables they've used.</li>
  <li><strong>Achievements Earned</strong> — how many achievements they hold.</li>
  <li><strong>Guild Level</strong> — their guild's level, which comes from its members' average XP.</li>
  <li><strong>Guild Members</strong> — how many players are in their guild. Staff in a guild don't count.</li>
  <li><strong>Blooms Earned (all Skills)</strong> — their total Blooms.</li>
  <li><strong>Blooms in One Skill (pick a Skill)</strong> — their Blooms in one skill.</li>
  <li><strong>Blooms Received from Peers</strong> — Blooms other players endorsed or gifted them. Grants from staff don't count.</li>
  <li><strong>Blooms Given to Others</strong> — Blooms they've endorsed or gifted to other players.</li>
</ul>
<p>The two guild types read the whole team's progress rather than one player's, which is the point of them: a team moves a scene stage or unlocks a badge together.</p>

<h2>Time Windows</h2>
<p>Counters, and checks on one particular thing, can carry a rolling window: the <strong>within N days (optional)</strong> box on the condition row. "Milestones Completed, 3, within 7 days" counts only the last seven days, measured back from right now, continuously. Leave it blank to count the player's whole history.</p>
<p>The window is offered on Milestones Completed, Tabis Completed, Item Shop Transactions, Items Consumed, Achievements Earned, Blooms Received from Peers, Blooms Given to Others, Complete This Milestone and Complete This Tabi. It isn't offered on readings of the present moment (level, XP, percentages, guild standing, Blooms totals), because "your level in the last five days" isn't a question.</p>
<p>Timed Garden Tasks add a second kind of clock. A task with a countdown counts only what the player has done since they started it, so "complete 3 milestones" on a five-day task means three in <em>their</em> five days.</p>

<h2>Writing Conditions</h2>
<p>Achievements, certificates, tasks and encounter groups all use the same row editor. Add a condition row, pick a type from <strong>Select a condition...</strong>, then fill in what that type needs: a milestone, Tabi or Skill picker for the types that name one, a threshold, and the optional window. Remove a row with its trash button, and save.</p>
<p>The milestone Conditions drawer is simpler: one number box per type, with no pickers and no windows. The types that need a picker aren't offered there. Leave a box blank to skip it.</p>
<p>Evolving Tabi scenes have their own row-and-stage editor, built on the same engine; see <a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a>.</p>

<h2>When Conditions Are Checked</h2>
<p>Every time a player's progress is recalculated. That happens on their own page loads and whenever anything changes their numbers, including someone else's action, such as a GM validating their work. If that earns them an achievement while they're not looking, the celebration waits for their next page.</p>

<h2>Design Tips</h2>
<ul>
  <li><strong>Let rules do what rules can see.</strong> Anything the engine can measure should auto-grant, so you're not hand-awarding what a condition could.</li>
  <li><strong>Use windows for momentum.</strong> "3 milestones this week" rewards a rhythm; "3 milestones ever" only rewards arriving.</li>
  <li><strong>Make gates visible.</strong> Putting a rule on an achievement and requiring that achievement shows the player what they earned and why the next part opened.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a></li>
  <li><a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a></li>
  <li><a href="/docs/certificates-authoring">Certificates, for GMs</a></li>
  <li><a href="/docs/random-encounters">Random Encounters</a></li>
  <li><a href="/docs/consequences">Consequences</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Branching & Prerequisites — Building Non-Linear Adventures',
                'slug'       => 'branching-and-prerequisites-non-linear-adventures',
                'section'    => 'setup',
                'sort_order' => 19,
                'body'       => <<<'HTML'
<p>Not every Adventure needs to be a straight line. BLUERABBIT gives you three related tools for building forks and gates: a milestone's <strong>Conditions</strong> drawer, which decides when it opens; <strong>paths</strong>, which decide who it's for; and the <strong>Branch Choice</strong> step, which lets a player pick their path.</p>

<h2>The Conditions Drawer: What Must Come First</h2>
<p>Open a saved milestone in the builder and click <strong>Conditions</strong>. Everything that gates the milestone lives in that one drawer:</p>
<ul>
  <li><strong>Requires these milestones completed</strong> — tick the milestones a player must finish first.</li>
  <li><strong>Requires these achievements</strong> — tick the achievements they must hold.</li>
  <li><strong>Requires this key item</strong> — a Key item they must be carrying.</li>
  <li><strong>Threshold conditions</strong> — numbers: Level, XP, Journey Completion %, Milestones Completed, Tabis Completed, Item Shop Transactions, Items Consumed, Achievements Earned, Guild Level, Guild Members, and the three Blooms totals. Leave a box blank to skip it.</li>
</ul>
<p>Every rule you set must be met, and until it is the player sees the milestone as locked. You can stack as many as you like — this is the tool for "you can't get here without having done that", whether "that" is content, an item, recognition or raw progress. The drawer has its own <strong>Save Conditions</strong> button and saves separately from Update Milestone.</p>

<h2>Conditions Beyond Milestones</h2>
<p>Those thresholds are one face of a single conditions engine. The same engine decides when achievements auto-grant, when certificates unlock, when a condition-triggered Garden Task completes, when an encounter group is ready, and how an evolving Tabi scene grows. It's the general tool for "unlock this when X is true", wherever X is something a player's progress can show.</p>
<p>The drawer offers only plain numbers. For rules that name one particular Tabi or Skill, or that count over a time window ("3 milestones within 7 days"), put the rule on an achievement's Auto-Grant Conditions and require that achievement here. The achievement then doubles as a visible marker of the gate. The full list of types and how they combine is in <a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a>.</p>

<h2>Paths: Who a Milestone Is For</h2>
<p>A <strong>Path</strong> is a type of achievement. Set a milestone's path in the builder's bottom bar, next to its status: <strong>All paths</strong>, or one specific path. A player who doesn't hold that path sees the milestone as unavailable. Shop items and badges can be limited to a path the same way, with their <strong>Available For</strong> setting.</p>

<h2>The Branch Choice Step</h2>
<p>A <strong>Branch Choice</strong> step asks the player to pick one of the paths in a branch: "pick your role", "pick your specialization". The choice is <em>permanent and mutually exclusive</em>. Taking one path closes the others for good, which is what makes it feel like a real decision rather than a menu. From that point on, everything limited to a path is filtered by what they chose.</p>
<p>Branches are defined on the achievement, then referenced by the step. Give each Path achievement a <strong>Branch</strong> in the achievement editor (create one on the spot with <strong>New Branch</strong>), then add the Branch Choice step that points at it.</p>
<p>The rule holds everywhere, not just in the step: a player can never hold two achievements from the same branch, whether the second would have come from a GM's grant, a magic code, a milestone reward, a condition or an encounter choice.</p>

<h2>Designing a Believable Fork</h2>
<p>The best branches are ones where both paths feel intentional, not like one is the "real" content and the other a stub. If you don't have time to build both sides of a fork fully, it's usually better to cut it to a single path than ship a branch that's obviously thinner on one side. Players notice.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones, Rewards &amp; Unlocks</a></li>
  <li><a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a></li>
  <li><a href="/docs/tabi-editor">The Tabi Editor</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Achievements, Paths & Ranks — Designing Your Reward Ladder',
                'slug'       => 'achievements-paths-and-ranks-reward-ladder',
                'section'    => 'setup',
                'sort_order' => 20,
                'body'       => <<<'HTML'
<p>Achievements are how you recognize progress beyond raw XP: a visible marker of what someone has actually done. As a GM you're designing three distinct tools here, not one.</p>

<h2>Three Tools, Three Jobs</h2>
<ul>
  <li><strong>Badge</strong> — a one-off recognition. "Finished onboarding", "Perfect score on the compliance quiz". Awarded once; doesn't imply anything came before or after it.</li>
  <li><strong>Path</strong> — a branch of the journey. Paths decide which milestones, items and badges a player sees, and a player holds only one path from each branch (see <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>).</li>
  <li><strong>Rank</strong> — a title tied to level. Use ranks when progress itself is the reward (Bronze/Silver/Gold, Associate/Senior/Lead): something that visibly upgrades as a player advances.</li>
</ul>
<p>Create them from Manage Content → Achievements → <strong>New Achievement</strong>. The editor has four tabs: <strong>Settings</strong>, <strong>Codes</strong>, <strong>Players</strong> and <strong>Conditions</strong>. Unique codes, awarding players and conditions all need the achievement saved first.</p>

<h2>Settings</h2>
<ul>
  <li><strong>Name</strong>, <strong>Type</strong> (Badge, Rank or Path), <strong>Achievement Badge</strong> (the image, required) and <strong>Color</strong>.</li>
  <li><strong>Skill Reward (Garden)</strong> — a Bloom in one of your skills, paid when it's earned.</li>
  <li><strong>Rewards</strong> — XP and BLOO (and EP, if the adventure uses energy), on badges and paths.</li>
  <li><strong>Branch</strong> — on paths: which branch this path belongs to.</li>
  <li><strong>Available for</strong> — on badges: all paths, or only players on one path.</li>
  <li><strong>Deadline</strong> — on badges. Unique codes stop working after it.</li>
  <li><strong>Secret Message</strong> — shown only to players who have earned it, when they open it on their Achievements page. Redeeming a magic code shows it in the celebration too.</li>
</ul>

<h2>Ways an Achievement Is Awarded</h2>
<ul>
  <li><strong>Auto-Grant Conditions</strong> (Conditions tab) — awarded the moment a player's progress satisfies every condition. The celebration explains why ("You reached Level 5!"). Leave it empty for an achievement that's only awarded some other way. See <a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a>.</li>
  <li><strong>A milestone's Achievement Reward</strong> — the drawer in the milestone builder. Offers badges and paths.</li>
  <li><strong>An encounter choice</strong> — an Encounter Choice option's <strong>Then grant</strong>.</li>
  <li><strong>A Branch Choice step</strong> — for paths.</li>
  <li><strong>The rank ladder</strong> — for ranks, by level (below).</li>
  <li><strong>Magic codes</strong> — the Codes tab (below).</li>
  <li><strong>By hand</strong> — the Players tab (below).</li>
</ul>
<p>Most achievements should fire automatically: set the rule once and forget it. Reserve manual grants for genuinely human moments, like a standout contribution or something that happened in a live session, that no rule can detect.</p>

<h2>Branches Hold on Every Path In</h2>
<p>A player can never hold two achievements from the same branch, and that's enforced on every way an achievement can arrive: manual grants, Assign all, CSV uploads, magic codes, milestone rewards, QR completions, Auto-Grant Conditions and encounter choices. A refused single grant tells you "Player already has an achievement from this branch"; bulk grants skip those players and tell you how many were skipped.</p>

<h2>Magic Codes and QR Codes</h2>
<p>The Codes tab gives you two kinds of code:</p>
<ul>
  <li><strong>Magic Code</strong> — one code anyone in the adventure can use. Each player can redeem it once. Type your own or press <strong>Generate</strong>; the <strong>Magic Link</strong> beside it redeems the code in one click.</li>
  <li><strong>Unique Codes</strong> — press <strong>Create Code</strong> for each one-time code you need. Each can be redeemed once, by one player. The Available, Redeemed and Expired tabs show where every code stands, including who redeemed it and when, and <strong>Show all links</strong> lists every available code's link in one block, ready to paste into a mail merge or a print run.</li>
</ul>
<p>Once saved, the Settings tab also shows the achievement's <strong>QR Code</strong>. It's specific to the adventure you opened the achievement from: every cohort built from a template gets its own QR, so open the achievement from that cohort to print the right one. The magic code itself works in any cohort of the template.</p>
<p>Players redeem a code through the taskbar's <strong>Magic Code</strong> quick link, by scanning the QR, or by opening a magic link. Redeeming opens the celebration panel with the badge and its secret message.</p>

<h2>Awarding by Hand</h2>
<p>The Players tab lists everyone enrolled in the adventure you opened it from. Click a player to award the achievement or take it away, or use <strong>Assign all</strong> / <strong>Remove all</strong>. <strong>Bulk Upload Players</strong> takes a CSV with a single column of email addresses.</p>
<p>To see and manage who holds what across a whole cohort, use <strong>Player Records</strong> (linked from the Players tab as <strong>Open in Player Records</strong>): filter, then remove one, a selection, or everything matching. Removing an achievement also takes away the XP, BLOO and Bloom it paid. If its Auto-Grant Conditions are still met, the engine will award it again the next time that player's progress is recalculated, so change the conditions first if you mean it to stay gone.</p>

<h2>Designing a Rank Ladder</h2>
<p>Ranks don't use Auto-Grant Conditions. They're awarded by the adventure's <strong>rank ladder</strong>, set in Adventure Settings on the <strong>Ranks</strong> tab: each row pairs a <strong>Level</strong> with a Rank achievement. Create the Rank achievements first; the ladder only lists published ones. A rank's own Conditions tab says which level currently awards it, with a link to <strong>Edit the rank ladder</strong>.</p>
<p>When a player reaches a level, they receive every rank at or below it and a level-up message showing the new rank's badge; the highest becomes their current rank. You can still grant a rank by hand, but not to a player below its level: the grant is refused, and bulk grants skip those players. Removing a rank is always allowed.</p>
<p>Decide the tier count up front. Three to five works for most programs; beyond that the distinctions stop feeling meaningful. Space the levels so players can always see the next rung.</p>

<h2>Badge &amp; Color Design Tips</h2>
<p>Badges render small in grids, so simple, high-contrast images read best. Reuse your Adventure's accent colours across achievements so the whole reward system feels like one visual language rather than a grab-bag of clip art.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a></li>
  <li><a href="/docs/certificates-authoring">Certificates, for GMs</a></li>
  <li><a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Authoring Certificates',
                'slug'       => 'certificates-authoring',
                'section'    => 'setup',
                'sort_order' => 21,
                'body'       => <<<'HTML'
<p>A certificate is the printable thing a player takes away from an Adventure. It's content the Adventure carries, like milestones and achievements, and an Adventure can carry as many as you like: one for finishing, one for reaching a level, one for a guild. Each has its own wording and numbers, and each unlocks on its own conditions.</p>
<p>You'll find them on the <strong>Certificates</strong> tab of Manage Content.</p>

<h2>Creating a Certificate</h2>
<p>Press <strong>New certificate</strong>. The editor has four sections:</p>
<ul>
  <li><strong>Settings</strong>
    <ul>
      <li><strong>Name</strong> — internal, and what the player sees on their shelf.</li>
      <li><strong>Headline</strong> — the large line printed across the document. Left empty, it reads "Certificate of participation".</li>
      <li><strong>Awarded to</strong> — The player, or Their guild.</li>
      <li><strong>Status</strong> — Published or Draft.</li>
      <li><strong>Order</strong> — lowest first, where an Adventure has several.</li>
    </ul>
  </li>
  <li><strong>Numbers to print</strong> — any of Level, XP, BLOO and Energy (Energy only prints when the Adventure has Energy Points (EP) switched on). Also <strong>Show the player's badge</strong>.</li>
  <li><strong>Content</strong> — the paragraph under the recipient's name. Tokens work here, such as <code>{{ player.first }}</code>, <code>{{ progress.level }}</code>, <code>{{ guild.name }}</code> or <code>{{ adventure.title }}</code>, so one certificate can speak to everybody. See <a href="/docs/personalising-text-with-player-tokens">Player Tokens</a>.</li>
  <li><strong>Branding</strong> — a <strong>Logo</strong> and a <strong>Signature</strong> (printed bottom-right), both per certificate. Left empty, a guild certificate falls back to the guild's own logo, and a player certificate prints without one.</li>
</ul>
<p>Press <strong>Create certificate</strong>. The <strong>Unlocks</strong> section appears once the certificate exists.</p>

<h2>When It Unlocks</h2>
<p>A certificate with no conditions is <strong>open from the start</strong>: every player can print it right away. Add conditions and it stays locked until the player meets <strong>all</strong> of them. There's no separate "available immediately" switch; the condition list is the only answer. Clear the list and save, and a gated certificate becomes open again.</p>
<p>Certificates use the same Conditions engine as achievements and tasks: level, XP, journey percentage, milestones or Tabis completed, a specific milestone or Tabi, purchases, items used, achievements held, guild level and size, and Blooms. Counters can look at a rolling time window. See <a href="/docs/conditions-when-things-unlock">Conditions: When Things Unlock</a> for the full list.</p>
<p>Players see a locked certificate on their Achievements page with what's missing and, where it can tell, where they stand: <em>"Reach level 9 — you're at level 5"</em>. That sentence comes from the same engine that evaluates the rule, so the hint and the gate can't disagree. The certificate page itself refuses to open a certificate a player hasn't unlocked, so sharing the link doesn't get around the conditions.</p>

<h2>Guild Certificates</h2>
<p>Set <strong>Awarded to</strong> to Their guild and the certificate is made out to the team. It reads "Awarded to the team" with the guild's name, and prints the guild's numbers plus its member count. Those numbers are <strong>worked out live from the members</strong> when the certificate is opened: totals for XP, BLOO and energy, and the members' average for level, so one strong member can't speak for everyone. Players who aren't in a guild aren't shown guild certificates at all, rather than seeing one locked forever.</p>
<p>Conditions are checked for the player opening the certificate. The guild conditions ("Your guild reaches level 5", "Your guild reaches 8 members") are the natural fit here.</p>

<h2>The Display Badge</h2>
<p>With <strong>Show the player's badge</strong> ticked, the certificate prints the badge the player has chosen to be represented by, or their current rank if they haven't chosen. Players pick it with <strong>Badge shown on it</strong> on their Achievements page, from the badges and ranks they hold (paths are left out). It's stored separately from their rank, so levelling up never overrides their choice.</p>

<h2>Print Layout</h2>
<p>You don't design the layout. Every certificate uses the same fixed, print-safe design, sized for US Letter landscape, and only the document itself reaches paper. From top to bottom: the logo, headline, recipient, badge, your paragraph, the chosen numbers, then the Adventure's name and dates beside the signature. The dates are the Adventure's Start and End dates from the General tab of Adventure Settings. Players press <strong>Print or save as PDF</strong>.</p>
<p>Certificates used to be set up from a Certificate Settings panel in Adventure Settings. That panel is gone: each certificate now carries its own logo and signature.</p>

<h2>Managing Certificates</h2>
<p>The Certificates tab lists Published, Drafts and Trash, showing who each certificate is for, which numbers it prints, and whether it's open from the start or how many conditions gate it. You can search, filter to player or guild certificates, and sort by name. Each row has:</p>
<ul>
  <li><strong>Edit</strong></li>
  <li><strong>Preview</strong> — opens the printable page. Staff can preview a certificate they haven't unlocked themselves.</li>
  <li><strong>Unpublish</strong> / <strong>Publish</strong>, and <strong>Trash</strong></li>
  <li>In Trash: <strong>Restore</strong>, or <strong>Delete for good</strong>, which removes its conditions too.</li>
</ul>

<h2>Hiding Locked Certificates</h2>
<p>By default, players see every certificate on their Achievements page, with locked ones dimmed and a list of what's still missing. <strong>Hide Certificates</strong>, on the Features tab of Adventure Settings, keeps locked certificates off players' Achievements pages until they're unlocked. Staff always see all of them. At the moment this only takes effect when <strong>Hide Achievements</strong> is also switched on.</p>

<h2>Templates and Cohorts</h2>
<p>Certificates are authored on the template and shared live with every cohort. What they measure — a player's level, a guild's members — is always read from the cohort the player is in.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/conditions-when-things-unlock">Conditions: When Things Unlock</a></li>
  <li><a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a></li>
  <li><a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a></li>
  <li><a href="/docs/certificates-and-secrets-and-clues">Certificates &amp; Secrets and Clues</a> — the player's side</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Guilds — Designing Team Play',
                'slug'       => 'guilds-designing-team-play',
                'section'    => 'setup',
                'sort_order' => 22,
                'body'       => <<<'HTML'
<h2>Should This Adventure Use Guilds?</h2>
<p>Guilds add a team layer on top of individual progress. They're good for cohort-based programs (a bootcamp class, a department-wide rollout) where a bit of friendly competition or shared accountability helps. For a purely self-paced, individual course they're often unnecessary overhead; skip them if there's no real team behind the players. Turn them on with the <strong>Guilds</strong> feature in Adventure Settings.</p>

<h2>Creating Guilds &amp; Setting Capacity</h2>
<p>Create guilds from Manage Content → Guilds → <strong>New Guild</strong>. Each has a <strong>Guild Name</strong>, a <strong>Guild Logo</strong> (required), a <strong>Color</strong>, an optional <strong>Group</strong> and a <strong>Capacity</strong> (0 means no limit). Distinct names, colours and logos make them readable on the leaderboard, and a capacity keeps group sizes even.</p>
<p>The <strong>Group</strong> sorts a long list into piles, and Manage Guilds can filter by it. It also matters for enrollment links: a player already in a guild can't use a link to join a second guild in the same group.</p>

<h2>Putting Players in Guilds</h2>
<ul>
  <li><strong>Automatically on joining</strong> — set <strong>Assign guilds on login</strong> to Yes (Adventure Settings → Core Mechanics). A new player is placed in whichever published guild has the fewest members and still has room.</li>
  <li><strong>From the player CSV</strong> — the enrollment import's Guild column creates or joins a guild by name as players come in. See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</li>
  <li><strong>Into guilds that already exist, by CSV</strong> — on Manage Guilds, <strong>Assign players to a guild</strong>: pick the guild, upload a CSV with one column of email addresses, and press <strong>Assign from file</strong>. Everyone matched is moved into that guild, replacing any guild they were in. Anyone already in it is left alone, so running the same file twice is safe, and a full guild stops accepting people once it reaches capacity.</li>
  <li><strong>One at a time</strong> — the guild editor's <strong>Assign Players</strong> tab.</li>
  <li><strong>By link</strong> — once a guild is saved, its editor shows an <strong>Enrollment Link</strong>. A player who opens it joins that guild.</li>
</ul>

<h2>Guild Leaders</h2>
<p>Each guild can have a leader, chosen from its members in the <strong>Leader</strong> column on Manage Guilds (or set back to <strong>No leader</strong>). The roster marks the leader with a badge. It's a title for now, with no extra powers attached.</p>
<p>Appointing a leader is the one guild change an NPC can make. Everything else on Manage Guilds is view-only for them.</p>

<h2>Open Rosters</h2>
<p>Guilds are public within an adventure: a roster shows who's in a guild and how they're doing — each member's name, level, XP and BLOO, with the leader marked. Staff also see each member's email address; players never do.</p>

<h2>Standings: Totals, Levels and Who Counts</h2>
<p>A guild's XP and BLOO are its members' balances added up, live. That's what the guild leaderboard on the Guilds page ranks on (when the Leaderboard feature is on) — a sum, not an average — so a highly active member can meaningfully carry a quieter group. The top five show as cards and the rest as a table with each guild's XP, member count and average.</p>
<p>A guild's <strong>level</strong> comes from its members' <em>average</em> XP, on the same curve players use, so a 40-person guild can't out-level a 6-person one on headcount alone.</p>
<p><strong>Only players count.</strong> A GM or NPC sitting in a guild adds nothing to its totals, member count, average or level, and neither does anyone who has left the adventure. That matters beyond the leaderboard, because <strong>Guild Level</strong> and <strong>Guild Members</strong> are condition types: a GM in a guild can't hold back a scene stage or a badge for the whole team.</p>

<h2>Managing Guilds at Scale</h2>
<p>An import with a Guild column can create hundreds of guilds. On Manage Guilds, tick the ones you want (or tick the select-all box) and use <strong>Move to draft</strong> or <strong>Move to trash</strong> rather than working row by row. Drafts and trashed guilds are listed below the main table, with Publish, Restore and <strong>Delete Forever</strong>. Deleting a guild for good releases its members, so they can be assigned to another guild afterwards.</p>

<h2>Guilds Everywhere Else</h2>
<ul>
  <li><strong>The Wall</strong> has one Guilds tab. A player in a single guild goes straight into its feed; anyone in several guilds, and staff, get a searchable picker. See <a href="/docs/announcements-keeping-an-adventure-alive">Announcements</a>.</li>
  <li><strong>Conditions</strong> can use Guild Level and Guild Members, so a whole team can unlock a badge or grow an evolving Tabi scene together.</li>
  <li><strong>Certificates</strong> can be issued to a guild. See <a href="/docs/certificates-authoring">Certificates, for GMs</a>.</li>
</ul>

<h2>Running a Guild Leaderboard Moment</h2>
<p>Guild standings are most motivating when they're actually visible, not just theoretically trackable. Call them out in a live session, screen-share the leaderboard at a kickoff, or post an <a href="/docs/announcements-keeping-an-adventure-alive">announcement</a> when the standings shift. A leaderboard nobody looks at doesn't do anything.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds (player view)</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Item Shop — Building an In-Adventure Economy',
                'slug'       => 'item-shop-building-an-economy',
                'section'    => 'setup',
                'sort_order' => 23,
                'body'       => <<<'HTML'
<p>The Item Shop turns BLOO from a score into an economy: a reason to keep earning it beyond the number going up. As the GM, you decide what's for sale. Turn it on with the <strong>Item Shop</strong> feature in Adventure Settings (it covers the shop, the backpack and item rewards); with it off, players see "The item shop is now closed!".</p>
<p>Create items from Manage Content → Items → <strong>New Item</strong>, or from the <strong>Add new item</strong> button at the bottom of the shop.</p>

<h2>The Five Item Types</h2>
<ul>
  <li><strong>Consumable</strong> — used once and gone. The player presses <strong>Use</strong> in their backpack, which marks it redeemed; what it actually does is yours to honour (a hint, an extension, a coffee with the CEO). Design these as small conveniences, not power that trivializes your content. You'll see every use on the Transactions tab.</li>
  <li><strong>Key</strong> — held, never spent. A milestone's Conditions drawer can require a key item (<strong>Requires this key item</strong>), which makes a Key your soft-lock tool: instead of a hard prerequisite, make the way in something players earn or buy.</li>
  <li><strong>Reward</strong> — a keepsake with no functional effect. Rewards aren't sold: hand them out as a milestone's Item Reward or through a Find Item step. Cosmetic items are underrated for motivation; not everything needs a mechanical purpose.</li>
  <li><strong>Tabi Piece</strong> — one piece of a Tabi's collage. Choose the Tabi under Tabi Settings; players who collect the pieces fill in that Tabi's board on the Tabis page. See <a href="/docs/tabi-editor">The Tabi Editor</a> for laying out the collage.</li>
  <li><strong>Gift Card</strong> — a real gift card, emailed to the player when they buy it. The type only appears once the adventure's Tremendous tab is set up (see below).</li>
</ul>

<h2>Item Settings</h2>
<p>Which fields appear depends on the type:</p>
<ul>
  <li><strong>Cost</strong> (in BLOO) and <strong>Min. Level</strong> — for everything sold: consumables, keys, Tabi pieces and gift cards.</li>
  <li><strong>Stock</strong> — how many the shop can sell, for consumables, Tabi pieces and gift cards. For a Tabi piece, blank means unlimited. For consumables and gift cards, <strong>set a number</strong>: despite the "Unlimited" placeholder, a blank stock saves as 0 and the item shows as Sold Out. Enter 99999 or more and the shop shows it as unlimited (∞).</li>
  <li><strong>Max per Player</strong> — for consumables and gift cards; leave it at 0 for no limit. Keys, Rewards and Tabi pieces are always one per player.</li>
  <li><strong>Display in Shop</strong> — Visible or Hidden, for consumables, Tabi pieces and gift cards. A hidden item is kept out of the shop, for things you only want handed out by a Find Item step or by you.</li>
  <li><strong>Group</strong> — a colour category for consumables and gift cards, shown as a badge in the shop. When an item is in a group, its Max per Player counts everything the player holds from that group, so you can cap "any two potions" rather than two of each.</li>
  <li><strong>Available For</strong> — all paths, or only players on one path.</li>
  <li><strong>Description</strong> — what the item is for. Player tokens work here.</li>
</ul>

<h2>What the Shop Enforces</h2>
<p>Every purchase is checked on the server: the level, the stock, the per-player (or per-group) limit, and whether the player can afford it. <strong>The shop never sells on credit.</strong> Encounters can push a player's BLOO below zero, but the shop still refuses anything they can't afford, so debt stays a setback rather than a loophole.</p>
<p>Stock and caps are race-safe. Two players buying the last unit at the same moment can't both get it, and a double-click can't buy past a cap: the purchase that lands second is told there are none left. Refunding a purchase frees its stock again.</p>

<h2>Buying on a Player's Behalf</h2>
<p>For a player who can't work the shop themselves, use <strong>Assign</strong> on the item's row in Manage Items, then pick the player. It's a real purchase at the normal price, paid from the player's own BLOO, with the same stock and per-player limits — a free grant would distort your economy. The one thing it skips is the level requirement.</p>

<h2>Transactions</h2>
<p>The <strong>Transactions</strong> tab beside the shop (staff only) lists every item a player has bought or been given in the adventure, with quick filters for new and used items and a running total spent. Gift cards are listed separately, under Gift Card Orders. Each row has:</p>
<ul>
  <li><strong>Use</strong> — mark the item used for the player.</li>
  <li><strong>Return</strong> — undo a use and put the item back in their backpack. Only staff can do this; players can't un-use their own items.</li>
  <li><strong>Delete</strong> — take the purchase off their record, which gives the BLOO back.</li>
</ul>
<p>Player Records shows the same purchases per cohort, with filters, bulk removal and a way to restore removed ones.</p>

<h2>Gift Cards</h2>
<p>Gift cards are sent through Tremendous. Connect an account on the adventure's Tremendous tab first — <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a> walks through it. Then, on the item:</p>
<ul>
  <li><strong>Card Value</strong> — in the currency set on the Tremendous tab. <strong>Cost</strong> is still what the player pays in BLOO.</li>
  <li><strong>Label (optional)</strong> — e.g. "Amazon Gift Card".</li>
  <li><strong>Card Source</strong> — <strong>Adventure default campaign (recommended)</strong>, <strong>A different campaign, just for this item</strong>, or <strong>Specific brands from the catalogue</strong>. A campaign decides which brands the player can choose from, and you curate it in your Tremendous dashboard.</li>
</ul>
<p>The card goes to the player's account email. Before any BLOO is spent, a card that can't be sent (no campaign, no email on file) is refused, and if the send fails nothing is deducted. Every send is listed under <strong>Gift Card Orders</strong> in Manage Items.</p>

<h2>Pricing With BLOO</h2>
<p>Price items relative to how much BLOO a typical player has actually earned by the point they'd realistically want the item. A shop full of things nobody can afford yet reads as broken, not aspirational. Use Min. Level to hold the big-ticket items back until later.</p>

<h2>Tuning Your Economy</h2>
<p>Watch how fast BLOO accumulates versus how fast the shop drains it; the Stats page drills into item purchases. If nobody's buying, prices are probably too high for the earn rate, or the items aren't compelling. If everyone empties the shop immediately, add a higher-tier item or two so BLOO stays meaningful later in the Adventure. If you run encounters, remember they spend BLOO too, and a player in debt is a player who can't shop.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/item-shop-and-backpack">Item Shop &amp; Backpack (player view)</a></li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a></li>
  <li><a href="/docs/random-encounters">Random Encounters</a></li>
  <li><a href="/docs/stats-dashboard-guide">The Stats Dashboard</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Random Encounters — Card Draws, Crises & Opportunities',
                'slug'       => 'random-encounters',
                'section'    => 'setup',
                'sort_order' => 24,
                'body'       => <<<'HTML'
<p>An encounter is the world acting on a player who was expecting an ordinary session: the fridge dies two hours before service, a big client calls with an offer. Each encounter is a <strong>card</strong>, either a crisis or an opportunity, and each card points at a milestone. When it's time, the player is dealt a hand of face-down cards on the Journey and turns one over. That locks them into the card's milestone until they finish it, and inside it an <strong>Encounter Choice</strong> step makes them decide what to do, with the price of every option shown up front.</p>
<p>Encounters are an optional layer. A straightforward adventure without any is a completely valid, often clearer, design. Reach for them when you want the program to push back.</p>

<h2>Turning Encounters On</h2>
<p>Encounters run on energy, so they only happen when the adventure's <strong>Energy Points (EP)</strong> feature is on (Adventure Settings → Features). Switch it off and no hands are dealt, and the Random Encounters panel disappears from Stats. Staff — GMs, NPCs and admins — are never dealt a hand.</p>

<h2>How the Pieces Fit</h2>
<ol>
  <li><strong>The milestone.</strong> Build the milestone the encounter will load: the situation as ordinary steps, and an <strong>Encounter Choice</strong> step for the decision. Give each encounter a milestone of its own, open to all paths.</li>
  <li><strong>The card.</strong> Manage Content → Encounters → <strong>New Encounter</strong>, pointed at that milestone.</li>
  <li><strong>The group.</strong> Put the card in a group. The group decides when a hand is dealt and how often.</li>
</ol>

<h2>Groups Decide When</h2>
<p>Groups sit at the top of the Encounters tab. <strong>Add group</strong> opens the form:</p>
<ul>
  <li><strong>Name</strong> — e.g. "Weekly Curveballs".</li>
  <li><strong>Mood</strong> — the colour of the flash and card backs when this group deals.</li>
  <li><strong>Cards per hand</strong> — how many cards are dealt (8 by default). One is a deliberately harder feeling: no choice of which crisis, just the crisis.</li>
  <li><strong>Order</strong> — which group deals when two are ready at once. Lowest first.</li>
  <li><strong>How often</strong> — <strong>Whenever it still has cards</strong>; <strong>Every so often</strong> (every N hours or days); or <strong>On certain days of the week</strong>.</li>
  <li><strong>Status</strong> — Published or Draft.</li>
  <li><strong>When the player is ready</strong> — the group's <a href="/docs/conditions-when-things-unlock">conditions</a>. Every rule must be true before the group can deal at all. Leave it empty and it's available from the start.</li>
</ul>
<p>Conditions and schedule answer different questions. The conditions say the player is <em>ready</em> for this kind of thing (level 5, the Week 2 Tabi finished); the schedule says how often it then happens.</p>
<ul>
  <li><strong>Every so often</strong> waits at least that long after the group last came round for that player, then fires on their next visit. It accumulates: a player who was away comes back to it waiting.</li>
  <li><strong>On certain days of the week</strong> fires once on each chosen day, by the adventure's time zone. It doesn't accumulate: miss the day, miss the encounter, which is what makes a scheduled beat feel like an event.</li>
</ul>
<p>Conditions live on the group, not the card, on purpose. A card with its own gate would turn the draw into a milestone that auto-loads at a set point; the randomness only means something when the group is gated and the card inside it is chance. So make one group per distinct rule set.</p>
<p><strong>One hand at a time.</strong> If several groups are ready, only the lowest Order deals; the rest wait. And no new hand arrives until the player has finished the encounter they picked, which paces the whole thing without a timer.</p>
<p>Cards left <strong>Uncategorised</strong> have no conditions and no schedule, so they're always available. They deal a hand of eight, in red if the hand holds any crisis and green otherwise, and only when no authored group is ready. A <strong>Draft</strong> group parks its cards: nothing in it is dealt. Deleting a group moves its cards back to Uncategorised; it never deletes them.</p>

<h2>Cards: Crises and Opportunities</h2>
<p><strong>New Encounter</strong> opens the card editor:</p>
<ul>
  <li><strong>Name</strong> — staff-facing. The player sees the teaser, then the milestone.</li>
  <li><strong>Kind</strong> — Crisis or Opportunity. Not everything is chaos: opportunities keep the engine from reading as pure punishment.</li>
  <li><strong>The milestone this loads</strong> — where the player is locked until they resolve it. An encounter with no milestone never fires.</li>
  <li><strong>Draw weight</strong> — higher comes up more often. <strong>0</strong> keeps it out of random draws entirely: staff-fired only.</li>
  <li><strong>Can happen more than once</strong> — off by default, because a fridge dies once. Turn it on for recurring pressures like a slow week.</li>
  <li><strong>Not before</strong> / <strong>Not after</strong> — a date window, by the adventure's time zone. Use it instead of scheduling ("the supplier price hike arrives in week 6"), and to retire a card without unpublishing it.</li>
  <li><strong>The Card</strong> — the <strong>Teaser</strong> (one line; the full situation belongs in the milestone), a <strong>Card image</strong> and a <strong>Colour</strong>.</li>
</ul>
<p>Assign a card to a group from the <strong>Group</strong> dropdown on its row in Manage Content. Each row also edits art, name, kind, colour and weight in place, and calls out anything that would stop it working: "No milestone — cannot fire", "staff-fired only", a date window that hasn't opened or has passed, and how many players have already faced it. The header sums it up: how many cards can be dealt right now, how many are scheduled, and how many cannot fire.</p>

<h2>The Draw and the Lock</h2>
<p>A hand is dealt on the player's next Journey visit. The cards are a weighted sample of the group's eligible cards, with no duplicates, and the hand is saved the moment it's dealt, so reloading shows the same cards rather than a reshuffle. The player turns one over; the others go back in the pool untouched.</p>
<p>Picking a card sends the player into its milestone, and from then until they finish it, opening the Journey takes them back there. Only the Journey is locked: the Garden, Tasks and the Item Shop stay open, which is what makes recovering from a setback possible. The lock also opens that one milestone even if its own gating (a level requirement, say) would normally keep the player out, so a setback that costs a level can't strand anyone.</p>
<p>An unresolved encounter takes priority over everything else on the Journey, a freshly dealt hand comes next, and only then does an autoload milestone run.</p>

<h2>The Encounter Choice Step</h2>
<p>Add an <strong>Encounter Choice</strong> step to the milestone (it's in the Flow group) and use <strong>Add Option</strong> for each choice. Every option has:</p>
<ul>
  <li>A label ("Call a technician") and a short description ("Cheaper, but it is a patch, not a fix.").</li>
  <li><strong>Costs</strong> — BLOO it takes. <strong>Pays</strong> — BLOO it gives.</li>
  <li><strong>Energy</strong> — EP it takes.</li>
  <li><strong>XP</strong> — signed: positive pays XP, negative takes it away, and losing enough costs a level.</li>
  <li><strong>Then grant</strong> — an achievement to award. Require that achievement on a follow-up milestone and you've built a consequence chain: "the tech patched it for 200, but you still need a new fridge".</li>
  <li><strong>Then say</strong> — a <a href="/docs/consequences">consequence</a> message that lands right after the choice.</li>
</ul>
<p>The player sees what they have, and every option's BLOO and energy price, before choosing. The XP change isn't shown on the option, so mention it in the description if you want the player to weigh it. Prices are charged on the server from your settings, and only once per encounter, even if the player fails the milestone and plays it again.</p>
<p><strong>The economy rule: BLOO can go negative, energy can't.</strong></p>
<ul>
  <li>An option costing more BLOO than the player has is still available, marked "This puts you N under". Taking it puts them in debt. Debt is reachable only through a choice you authored; the Item Shop still refuses anything a player can't afford.</li>
  <li>An option needing more energy than the player has is disabled and refused.</li>
</ul>
<p><strong>Every encounter needs at least one option that costs 0 energy.</strong> Without one, a player with an empty tank is stuck in a locked milestone. The editor warns you, but it's your job to include it. As a backstop, if nothing is affordable the step tells the player they're out of energy and offers <strong>Go and recover</strong>, a link to their Tasks.</p>
<p>That's why encounters and the Garden belong together. Garden Tasks can pay <strong>Reward Energy</strong>, and they're how a player earns back what encounters spend. If your encounters charge energy, give players a task or two that restores it. See <a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a>.</p>

<h2>Running a Deck</h2>
<ul>
  <li><strong>Send to a player</strong> fires a card at one player right now, bypassing the draw. It's the only way a weight-0 card is ever used, and it's built for live sessions where the whole room should hit the same beat. It asks for the player's ID, and it's refused if that player is already facing an encounter.</li>
  <li><strong>Show again</strong> appears on a card players have already faced. A card that can't happen more than once is never dealt again to someone who's seen it, so after a rehearsal the deck can go quiet with nothing on screen to say why. Show again clears that history so the card can be dealt again.</li>
  <li><strong>Reset deck</strong>, in the header whenever anything has been faced, does the same for every card. Hands already dealt stay on the table.</li>
</ul>
<p>On the Stats page, the <strong>Random Encounters</strong> panel reports each encounter split by choice: how many players took each option, and what it cost them in total and per player. Only currently enrolled players are counted, so a GM testing a card doesn't move the numbers. See <a href="/docs/stats-dashboard-guide">The Stats Dashboard</a>.</p>

<h2>Designing Good Encounters</h2>
<ul>
  <li><strong>Mix crises and opportunities.</strong> A deck of pure bad news reads as punishment.</li>
  <li><strong>Make the trade-off the drama.</strong> Show every price and let players choose the expensive option anyway.</li>
  <li><strong>Pair every energy cost with a way back.</strong> Encounters spend energy; Garden Tasks restore it.</li>
  <li><strong>Add a debt message.</strong> A consequence that fires when BLOO falls below zero tells the player what just happened and what to do about it.</li>
  <li><strong>Use them sparingly.</strong> Too many and they stop feeling like events and start feeling like interruptions.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/consequences">Consequences</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a></li>
  <li><a href="/docs/encounters-the-card-draw">Encounters — The Card Draw (player view)</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Consequences — Messages When Something Happens',
                'slug'       => 'consequences',
                'section'    => 'setup',
                'sort_order' => 25,
                'body'       => <<<'HTML'
<p>A consequence is a message that lands on a player when something happens to them: "You've gone into debt", "You're halfway there", "The tech got there in time. The fridge lives, for now." It's how the game reacts out loud. A consequence only delivers a message; it never changes anyone's balance.</p>

<h2>Two Kinds</h2>
<ul>
  <li><strong>When a state is crossed</strong> — it watches one number and fires by itself the moment a player crosses the line you set.</li>
  <li><strong>After a specific choice</strong> — it fires when a player picks an <a href="/docs/random-encounters">Encounter Choice</a> option whose <strong>Then say</strong> names it.</li>
</ul>

<h2>Creating One</h2>
<p>Manage Content → Consequences → <strong>New Consequence</strong> opens the form:</p>
<ul>
  <li><strong>Title</strong> and <strong>Message</strong> — what the player reads.</li>
  <li><strong>Fires</strong> — When a state is crossed, or After a specific choice.</li>
  <li><strong>Tone</strong> — Danger, Warning, Information or Good news. It sets how the message looks.</li>
  <li><strong>Watching</strong>, <strong>When it</strong> and <strong>This number</strong> — for state consequences only: the number to watch, <strong>is at or below</strong> or <strong>is at or above</strong>, and the line.</li>
  <li><strong>Icon</strong> and <strong>Colour</strong> — typed names, e.g. <code>warning</code> and <code>amber</code>.</li>
  <li><strong>Only once per player</strong> — on by default.</li>
</ul>
<p>A state consequence can watch: <strong>Coins (BLOO)</strong>, <strong>Energy (EP)</strong>, <strong>Level</strong>, <strong>XP</strong>, <strong>Journey completion %</strong>, <strong>Milestones completed</strong>, <strong>Tabis completed</strong>, <strong>Total Blooms</strong> or <strong>Guild level</strong>.</p>
<p>Press <strong>Save consequence</strong>. The list reads each one back in a line ("Coins (BLOO) is at or below -1"), and you can filter it by kind.</p>

<h2>How Often It Fires</h2>
<ul>
  <li><strong>Only once per player</strong> on: a state consequence fires at most once for each player, ever.</li>
  <li>Off: it repeats while the state stays true, but at most once a day, so it can't loop. That suits reminders like "you're still in debt".</li>
  <li>A choice consequence fires every time the choice is made. The once setting doesn't apply to it.</li>
</ul>

<h2>How It Reaches the Player</h2>
<p>State consequences are checked every time a player's progress is recalculated: on their own page loads, and whenever anything changes their numbers, including someone else's action, such as a GM grading their work. The message is held for them and shown on their next page load, in the same panel as rewards, styled by its tone. It's removed once shown, so a refresh can't replay it.</p>
<p>A choice consequence appears straight away, as part of the result of the choice.</p>

<h2>Recipes</h2>
<ul>
  <li><strong>Debt alert</strong> — When a state is crossed · Coins (BLOO) · is at or below · <strong>-1</strong>. Use -1 rather than 0, or it fires for a player who has simply spent down to exactly nothing.</li>
  <li><strong>Encouragement</strong> — Journey completion % · is at or above · 50, with a Good news tone.</li>
  <li><strong>A choice's outcome</strong> — After a specific choice, then pick it in the option's <strong>Then say</strong>. This is where the story of what happened next goes: "Patched, not fixed."</li>
</ul>

<h2>Consequences vs Conditions</h2>
<p>They look alike but answer opposite questions. A <a href="/docs/conditions-when-things-unlock">condition</a> asks "has the player climbed high enough?" and grants something permanent: an achievement, a certificate, a scene stage. A consequence can also ask "has the player fallen below?", and it's momentary, which is why it can watch spendable numbers like BLOO and energy that conditions can't.</p>

<h2>Gotchas</h2>
<ul>
  <li>Deleting a consequence also forgets who has already seen it.</li>
  <li>Consequences are authored once, on the template, and fire separately for every player in every cohort.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/random-encounters">Random Encounters</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Customizing Currencies, Ranks & Rewards',
                'slug'       => 'customizing-currencies-ranks-and-rewards',
                'section'    => 'setup',
                'sort_order' => 26,
                'body'       => <<<'HTML'
<p>The companion how-to for <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a>. This is where you change what the three currencies are called, whether energy exists at all, and what happens as players level up.</p>

<h2>Renaming XP, BLOO &amp; EP</h2>
<p>In Adventure Settings, the <strong>Core Mechanics</strong> panel (on the General tab) gives each currency a long and a short label: <strong>XP Long Label</strong> / <strong>XP Short Label</strong>, <strong>Currency Long Label</strong> / <strong>Currency Short Label</strong>, and <strong>Energy Long Label</strong> / <strong>Energy Short Label</strong>. The defaults are Experience Points / XP, Bloo coins / BLOO, and Energy Points / EP.</p>
<p>Relabel XP as "Skill Points" / "SP" to fit a corporate training theme, or BLOO as "Guild Coin" for a more game-like Adventure. The mechanics underneath never change, only what players see them called. The <strong>Nickname</strong> field on the same panel renames what a player is called across the Adventure — "Explorer", "Recruit", whatever fits your theme. Write it in the singular.</p>

<h2>Turning Energy On or Off</h2>
<p>Energy is its own switch: the <strong>Energy Points (EP)</strong> feature in Adventure Settings → Features. It covers the whole energy economy — EP rewards on milestones, challenges and achievements, the energy bar, EP on the certificate, and <a href="/docs/random-encounters">random encounters</a>. Switch it off and EP disappears from every screen, and no encounters are dealt.</p>
<p>If you leave it on, give players a way to earn energy back: Garden Tasks can pay <strong>Reward Energy</strong>, and that's what encounters spend.</p>

<h2>Adventure Ranks</h2>
<p>Ranks turn a raw level number into a title: Level 5 becomes "Bronze Explorer", Level 15 becomes "Guild Master", each with its own badge. They're set on the rank ladder, Adventure Settings → <strong>Ranks</strong> tab → <strong>Adventure Ranks</strong>:</p>
<ol>
  <li>Create the ranks first, as achievements with the type <strong>Rank</strong>. If none exist yet, the tab offers <strong>Create the first rank</strong>.</li>
  <li>For each rung, add a row with a <strong>Level</strong> and the Rank achievement it awards. <strong>Add Rank</strong> adds another row.</li>
</ol>
<p>The ladder is level-based and nothing else: a Rank achievement doesn't use Auto-Grant Conditions. When a player reaches a rung's level they receive that rank (and any lower ones they'd skipped) with a level-up message showing its badge, and the highest becomes their current rank. A GM can grant a rank by hand, but not to a player below its level. More on designing the ladder in <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>

<h2>A Practical Approach</h2>
<p>Don't rename everything on day one. Start with the default XP/BLOO/EP labels, run a small pilot group through the Adventure, and only rename things once you've confirmed the mechanics feel right. Renaming is cheap and reversible; re-tuning reward math after players are mid-Adventure is a much bigger disruption.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a></li>
  <li><a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a></li>
  <li><a href="/docs/complete-adventure-settings-reference">Complete Adventure Settings Reference</a></li>
  <li><a href="/docs/item-shop-building-an-economy">The Item Shop — Building an Economy</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'QR Codes — Live & Hybrid Event Checkpoints',
                'slug'       => 'qr-codes-live-and-hybrid-events',
                'section'    => 'setup',
                'sort_order' => 27,
                'body'       => <<<'HTML'
<p>A QR code is how something that happens in a room counts inside an Adventure. A player scans a printed or projected code with their phone, and the Adventure records it. BLUERABBIT has three kinds of QR code, and each does a different job: an achievement code awards a badge, a task code completes a repeatable task, and a milestone code completes a milestone outright.</p>

<h2>Achievement QR Codes: Scan to Earn a Badge</h2>
<p>Every achievement has a magic code, and once the achievement is saved its <strong>QR Code</strong> appears in the achievement's settings, next to the badge. Scanning it redeems the code and awards the achievement on the spot, with the same celebration as any other reward. It's the right tool for a one-time check-in: "attended orientation", "visited the lab", "met the founder".</p>
<ul>
  <li>When the adventure has Magic Codes switched on, players can also type the code into the <strong>Redeem a code</strong> panel instead of scanning. Put it on the slide under the QR code for anyone whose camera won't cooperate.</li>
  <li>A player who already holds the achievement is told so, and nothing is awarded twice. Branches still hold: nobody can earn two achievements from the same branch.</li>
  <li>An earned achievement can be one of a milestone's conditions, so the badge scanned at the door can be what opens the next piece of content.</li>
</ul>
<p>For one-time unique codes and handing out links in bulk, see <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>

<h2>Task QR Codes: Repeatable Check-Ins</h2>
<p>A task can be set up so that scanning its QR code is the only way to complete it. That suits anything a player does again and again in a physical place: a gym visit, a daily stand-up, each morning of a workshop. In the task editor on Manage Content's <strong>Tasks</strong> tab, set <strong>Completes when…</strong> to "The player marks it done (button or QR scan)", <strong>Recurrence</strong> to "Timed (cooldown between completions)" with a cooldown, and <strong>Reset via</strong> to "Scanning a QR code". Once the task is saved, its code appears in the editor, ready to print or display.</p>
<ul>
  <li><strong>Hide it from the app.</strong> Untick "Show the QR code to players in the app" and the player's task card says "Find the QR code and scan it to complete this task" instead of showing the image, so they have to go where the printed code is. You still see the code in the editor.</li>
  <li><strong>Regenerate it if a photo leaks.</strong> "Regenerate (invalidates the old code)" issues a new code, and the old one stops working at once. Reprint and replace every posted copy.</li>
  <li><strong>The cooldown holds.</strong> A scan before the cooldown is up shows "Not ready yet" with a countdown, so scanning the same poster twice doesn't pay twice.</li>
</ul>
<p>See <a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a> for everything else a task can do, and <a href="/docs/garden-tasks">Garden Tasks</a> for the player's side.</p>

<h2>Milestone QR Codes: Quick-Complete</h2>
<p>A milestone can also be completed by a scan. It completes the milestone outright for the player who scans it and pays its XP and BLOO, plus any item or achievement reward, skipping level requirements, conditions, start dates and deadlines. It's the one completion path in BLUERABBIT deliberately built to skip the rest of the system. The milestone has to be published, a second scan only says it's already completed, and the completion screen offers <strong>Back to the journey</strong>.</p>
<p>Because it skips everything, it's not the tool for anything you actually want gated. Reserve it for milestones where "being physically present and scanning" is the whole point.</p>
<p>The milestone builder doesn't currently display a milestone's QR code, so for a check-in you're printing now, use an achievement or task code.</p>

<h2>One Code Per Cohort</h2>
<p>A QR code belongs to the adventure it was made in, so each cohort of a template has its own. An achievement lives on the template, but its QR code is made per cohort: open the achievement from inside the cohort you're printing for, and the editor tells you which adventure the code redeems into. Tasks belong to each cohort too. A cohort's copy of a QR task starts without a code, so open it on that cohort's Tasks tab and save it to issue one. Printing one cohort's code for another sends every scan to the wrong adventure.</p>

<h2>Before the Event</h2>
<ul>
  <li><strong>Get everyone enrolled and logged in first.</strong> A phone that isn't logged in goes to the login page when it scans, and after signing in the player lands on their adventures rather than back on the code, so they have to scan again. Sessions last 30 days, so logging in once the day before is enough.</li>
  <li><strong>Test every code</strong> with a player account before you print it.</li>
  <li><strong>Put the code where the moment happens:</strong> on the door, at the station, on the last slide of the session.</li>
</ul>

<h2>Good Use Cases</h2>
<ul>
  <li>An in-person orientation day, where "you showed up and scanned in" should count on its own: an achievement code at the door.</li>
  <li>A scavenger hunt where physical locations map to badges, each with its own code.</li>
  <li>A recurring check-in, like the gym or a daily stand-up: a timed task with its code hidden from the app.</li>
  <li>A live session on the <a href="/docs/event-schedule-concept">Event Schedule</a>: the schedule tells players where to be, and a code in the room records that they were there.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a></li>
  <li><a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a></li>
  <li><a href="/docs/event-schedule-concept">The Event Schedule — Concept</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Event Schedule: Sessions & Speakers — Concept',
                'slug'       => 'event-schedule-concept',
                'section'    => 'setup',
                'sort_order' => 28,
                'body'       => <<<'HTML'
<p>Not every part of an Adventure needs to be a milestone. The <strong>Schedule</strong> is a separate, informational layer for anything tied to a time and a place (live sessions, workshops, who's speaking), sitting alongside the Journey Map rather than gating progress on it.</p>

<h2>Sessions</h2>
<p>A session is a scheduled block (a workshop, a live Q&amp;A, an orientation walkthrough) with a title, a start and end time, a description and, for in-person or hybrid programs, a room. Players see sessions grouped by day, and clicking one opens its details in a window over the schedule: the date and time, the room, who's speaking and the full description.</p>
<p>Sessions don't unlock, block or reward anything on their own. Two optional settings make them more than a list:</p>
<ul>
  <li><strong>Attach a milestone or challenge</strong>, and the session's details carry a button that opens it.</li>
  <li><strong>Limit who sees it</strong> to players on one path (or holding one rank), or to one guild. Anyone outside it doesn't see the session at all, so the Engineering track never sees the Sales workshop.</li>
</ul>
<p>An adventure setting decides whether players see every day's sessions or only today's.</p>

<h2>Speakers</h2>
<p>A speaker is a person with a picture, a name, a company, links and a short bio. Attach speakers to sessions and players can open a speaker's page to read about them and see every session they're in. With the Speakers feature on, players also get a Speakers page listing everyone.</p>
<p>Speakers are also the adventure's <strong>cast</strong>. A Dialogue step can name a speaker as the character talking, and the name and portrait are read from the speaker every time the line appears. So the facilitator who runs your live session can be the same character who guides players through the milestones, and changing their portrait once updates every line they speak. Manage Content has a <strong>Speakers</strong> tab listing the cast, with how many dialogue lines each one has. See <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>.</p>

<h2>In Launch Week</h2>
<p>The in-person orientation day gets three sessions on the schedule (a welcome talk, a benefits walkthrough and a team-lunch block), each with a room listed, so the schedule doubles as the day's agenda. The CEO who gives the welcome talk is a speaker, and she's the same character who welcomes new hires in the first milestone's dialogue.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/how-to-build-an-event-schedule">How to Build an Event Schedule</a></li>
  <li><a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a></li>
  <li><a href="/docs/qr-codes-live-and-hybrid-events">QR Codes — Live &amp; Hybrid Event Checkpoints</a></li>
  <li><a href="/docs/meet-launch-week-example-adventure">Meet "Launch Week"</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'How to Build an Event Schedule',
                'slug'       => 'how-to-build-an-event-schedule',
                'section'    => 'setup',
                'sort_order' => 29,
                'body'       => <<<'HTML'
<p>Step by step. See <a href="/docs/event-schedule-concept">The Event Schedule — Concept</a> for what sessions and speakers are for.</p>

<ol>
  <li><strong>Switch the features on.</strong> In the adventure's settings, turn on <strong>Schedule</strong> under Features, and <strong>Speakers</strong> too if you want players to have a Speakers page. The Schedule then appears in your players' menu, and <strong>New Session</strong> and <strong>New Speaker</strong> appear under Add Mechanics in yours.</li>
  <li><strong>Add your speakers first.</strong> Open Manage Content's <strong>Speakers</strong> tab and press <strong>New Speaker</strong>. Give the speaker a picture and a first and last name, and add a company, website, LinkedIn and a short bio if you have them. <strong>Connect to Player</strong> optionally links the speaker to a staff member's account, and fills in the name, picture, bio and links from that account's profile wherever the profile has them. Press <strong>Create Speaker</strong>. Add each person once and reuse them in every session and dialogue line they appear in.</li>
  <li><strong>Create a session.</strong> Choose <strong>New Session</strong> and give it a title, a <strong>Session Start</strong> and a <strong>Session End</strong> (both required), a description, and a room under <strong>Room Information</strong> if it's in person.</li>
  <li><strong>Tick its speakers.</strong> The Speakers list appears once the adventure has at least one.</li>
  <li><strong>Link it and limit it, if you want to.</strong> <strong>Attach to Quest</strong> links a milestone or challenge, which players can then open from the session's details. <strong>Available for</strong> limits the session to one path or rank, and <strong>Guild</strong> limits it to one guild. Each of these appears only when the adventure has paths or guilds to pick from.</li>
  <li><strong>Publish it.</strong> Leave the status on Publish (or Draft to keep it out of sight) and press <strong>Create Session</strong>. Repeat for every session.</li>
  <li><strong>Check the Schedule.</strong> Sessions appear grouped by day; click one to open its details. As a GM you'll see an edit button on each session, and an <strong>Edit</strong> button inside its details.</li>
</ol>

<h2>Good to Know</h2>
<ul>
  <li><strong>It's content, not mechanics.</strong> A session pays no XP or BLOO and gates nothing. If attendance should count, put a QR code in the room (see <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>).</li>
  <li><strong>On the day itself</strong>, set <strong>Schedule</strong> to "Just today" under Time Mechanics in the adventure's settings, and players see only today's sessions. "Show all days" brings back the full calendar.</li>
  <li><strong>A limited session is hidden from everyone outside it, staff included.</strong> To check a path- or guild-only session, look at the Schedule from an account that qualifies.</li>
  <li><strong>To remove a session</strong>, open it, set its status to Trash and press <strong>Update Session</strong>.</li>
  <li><strong>Renaming a speaker</strong> on the Speakers tab updates every dialogue line they speak. Trashing one stops them being offered for new lines, but the lines they already have keep their name and portrait.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/event-schedule-concept">The Event Schedule — Concept</a></li>
  <li><a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a></li>
  <li><a href="/docs/qr-codes-live-and-hybrid-events">QR Codes — Live &amp; Hybrid Event Checkpoints</a></li>
  <li><a href="/docs/complete-adventure-settings-reference">The Complete Adventure Settings Reference</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'SCORM Packages — Concept',
                'slug'       => 'scorm-packages-concept',
                'section'    => 'setup',
                'sort_order' => 30,
                'body'       => <<<'HTML'
<p>If you already have e-learning content built in another authoring tool, you don't have to rebuild it inside BLUERABBIT from scratch. The <strong>SCORM Package</strong> step type runs it inside a milestone.</p>

<h2>What SCORM Is</h2>
<p>SCORM is a long-standing e-learning packaging standard. Most authoring tools (Articulate, Captivate and similar) can export a course as a SCORM package: a single <code>.zip</code> file. BLUERABBIT supports <strong>SCORM 1.2</strong>. A SCORM step plays the package in a frame inside the step and listens for it to report that it's finished.</p>

<h2>What You Get</h2>
<ul>
  <li><strong>Completion tracking.</strong> When the package reports itself completed or passed, the step completes and the player's Next button unlocks. No manual grading, and no separate spreadsheet of who finished the external course. It slots into the milestone and the Journey Map like any other step, rewards included.</li>
  <li><strong>Resume.</strong> What the package saves about a player's place is kept, so someone who leaves partway can pick up where they left off.</li>
  <li><strong>A clean slate when you need one.</strong> The step editor can clear every player's saved progress in the package.</li>
</ul>

<h2>What It Doesn't Track</h2>
<p>BLUERABBIT records whether the package finished, not how well. A score the package reports isn't stored, and a package that reports "failed" leaves the step open until the player gets through it. If the grade matters, follow the package with a <a href="/docs/challenges-concept">Challenge</a> that tests the same material.</p>

<h2>Storage</h2>
<p>A package counts toward the storage allowance of the account that uploads it: the size of the <code>.zip</code>, not the unpacked size. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a>.</p>

<h2>When to Reach for It</h2>
<p>Use SCORM when strong content already exists and rebuilding it natively would be pure duplicated effort: a compliance course, a vendor-provided training module. For anything you're building fresh, native steps (Dialogue, Open Text, Multiple Choice and the rest) are usually a better fit, and give you BLUERABBIT's own reward and branching tools directly.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/how-to-add-a-scorm-package">How to Add a SCORM Package</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'How to Add a SCORM Package',
                'slug'       => 'how-to-add-a-scorm-package',
                'section'    => 'setup',
                'sort_order' => 31,
                'body'       => <<<'HTML'
<p>Step by step. See <a href="/docs/scorm-packages-concept">SCORM Packages — Concept</a> for when a package is the right call.</p>

<ol>
  <li>Export your course from its authoring tool as a <strong>SCORM 1.2</strong> package (a single <code>.zip</code> file). Check the export settings: BLUERABBIT supports 1.2 only, and a package exported to a later SCORM version won't be able to report completion here.</li>
  <li>Open the milestone, add a step, and set its <strong>Step Type</strong> to <strong>SCORM Package</strong> (in the Validate group).</li>
  <li>Choose the <code>.zip</code> and press <strong>Upload</strong>. The package is unpacked and checked straight away. Once it's installed, the panel shows a check mark with the package's launch address, and the button becomes <strong>Replace</strong>.</li>
  <li>Set the step's rewards (XP, BLOO, EP, an item or an achievement) as you would on any other step, then press <strong>Update Step</strong>.</li>
  <li>Play through the step yourself before players reach it. Packages vary in how reliably they report completion, so one real click-through to the end is worth it. Do it again after every replacement.</li>
</ol>

<h2>If the Upload Is Refused</h2>
<ul>
  <li><strong>"imsmanifest.xml not found in zip"</strong>: the manifest has to sit at the top level of the <code>.zip</code>. If you zipped a folder, zip its contents instead, or re-export straight from the authoring tool.</li>
  <li><strong>"Could not determine the launch file from imsmanifest.xml"</strong>: the manifest doesn't point at a starting page. Re-export the package.</li>
  <li><strong>"That package is … The limit is …"</strong>: every package also has a size ceiling set by your platform admin, 100MB unless they've changed it.</li>
  <li><strong>"Not enough storage"</strong>: the package would take your account past its storage allowance, and the message says how much room is left. Your storage meter is in the Media Manager and on My Account's Billing panel. Free space by deleting files you no longer need, or upgrade (see <a href="/docs/billing-and-plans">Billing &amp; Plans</a>).</li>
</ul>

<h2>Storage</h2>
<p>A package counts toward the storage allowance of the account that uploads it, at the size of the <code>.zip</code> rather than the unpacked size. Replacing a package you uploaded only needs room for the difference, and deleting the step releases its space.</p>

<h2>Good to Know</h2>
<ul>
  <li><strong>One starting point.</strong> BLUERABBIT launches the first item listed in the package's manifest, so a course exported as several separate SCOs plays only the first one, or doesn't install at all. Export it as a single SCO.</li>
  <li><strong>Completed or passed.</strong> The step completes when the package reports either. Scores aren't recorded.</li>
  <li><strong>No learner name.</strong> The package isn't told the player's name, so a course that greets the learner by name will show a blank there.</li>
  <li><strong>"Reset all players' progress"</strong> clears everyone's saved place in the package. Players who already completed the step keep that completion. It asks you to confirm, and it can't be undone.</li>
  <li><strong>Templates.</strong> A SCORM step on a template is shared by every cohort, like the rest of its content: one upload serves them all, a replacement reaches them all at once, and a reset clears saved progress in every cohort.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/scorm-packages-concept">SCORM Packages — Concept</a></li>
  <li><a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Announcements — Keeping an Adventure Alive Between Sessions',
                'slug'       => 'announcements-keeping-an-adventure-alive',
                'section'    => 'setup',
                'sort_order' => 32,
                'body'       => <<<'HTML'
<h2>The Wall</h2>
<p>The <strong>Wall</strong> is your Adventure's shared message board. It's in the menu when the Adventure's <em>Wall / Social</em> feature is on, and it has four channels:</p>
<ul>
  <li><strong>Public</strong> — everyone enrolled reads and posts here. This is where announcements for the whole cohort belong.</li>
  <li><strong>Guilds</strong> — one tab for every guild channel. It opens a searchable picker; choose a guild and the post button becomes <em>Post to</em> that guild. A player in exactly one guild goes straight into its channel. Players only see guilds they belong to; staff see them all.</li>
  <li><strong>System</strong> — the staff channel, seen only by GMs, NPCs and admins.</li>
  <li><strong>Messages</strong> — private one-to-one conversations. Players can also start one from someone's Garden profile.</li>
</ul>
<p><strong>Watch out for PA Post.</strong> On the Public tab, staff see two buttons: <strong>Post</strong> and <strong>PA Post</strong>. PA Post publishes to System, which players can't see. For anything players need to read, press <strong>Post</strong>.</p>
<p>GMs and admins can remove any post with its trash button, and the feed refreshes by itself while it's open. Every post also counts for a Garden mission that asks players to post on the Wall.</p>
<p>The activity logs that used to sit on the Wall have a page of their own; the Wall's <strong>Activity</strong> tab takes you there. See <a href="/docs/activity-logs">Activity Logs</a>.</p>

<h2>What Belongs in an Announcement</h2>
<p>Good candidates: a new Tabi or chapter just opened for everyone, a guild leaderboard shift worth calling out, a reminder that a deadline is approaching, a shout-out to a player's achievement. Anything genuinely relevant to the whole cohort. A one-to-one message belongs in Messages instead.</p>

<h2>Keeping Momentum Between Sessions</h2>
<p>Self-paced Adventures lose momentum fastest in the gap between live sessions or milestones. A short post timed to land a few days after a deadline, or right as a new chapter opens, does more for completion rates than almost any content change: it's a nudge, not a rebuild.</p>
<p>A Wall post waits for players until they next log in. For people who aren't coming back on their own, send an <a href="/docs/email-campaigns-to-players-concept">email campaign</a> as well.</p>

<h2>A Simple Cadence That Works</h2>
<p>For a multi-week program: one announcement at kickoff, one at the midpoint calling out standings, and one heading into the final stretch. Add ad hoc ones for anything time-sensitive, but a predictable, light cadence beats either silence or noise.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/email-campaigns-to-players-concept">Email Campaigns to Your Players</a></li>
  <li><a href="/docs/activity-logs">Activity Logs</a></li>
  <li><a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a></li>
  <li><a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Email Campaigns to Your Players — Concept',
                'slug'       => 'email-campaigns-to-players-concept',
                'section'    => 'setup',
                'sort_order' => 33,
                'body'       => <<<'HTML'
<p><strong>Not to be confused with:</strong> this is about emailing people already enrolled in one of your Adventures. It's a separate system from bluerabbit.io's own waitlist emails on the marketing site. Different audience, different tool, so don't mix the two up when someone asks "did the email go out?"</p>

<h2>What a Campaign Is</h2>
<p>A campaign is a one-time email to some or all of the people enrolled in an Adventure, written once and personalised for each recipient with merge tags. You write and send it from <strong>Admin Tools → Email Notifications</strong>. Email has to be set up for the platform first: until a platform admin connects an email service in Sys Config, the page says <em>Email isn't configured yet</em>.</p>

<h2>Who Receives It</h2>
<p>Either <strong>All enrolled players</strong>, meaning everyone enrolled in the Adventure who has an email address (GMs and NPCs included), or <strong>Selected players</strong>, picked by hand from a searchable grid of avatar cards. There's no audience based on activity, such as "hasn't logged in lately", and no guild audience. For those, hand-pick the people.</p>

<h2>Merge Tags</h2>
<ul>
  <li><code>{{name}}</code> — the recipient's name</li>
  <li><code>{{adventure_name}}</code> — the Adventure's title</li>
  <li><code>{{site_name}}</code> — the platform's name</li>
</ul>
<p>They work in the message, not the subject line. These three are the only ones: the tokens you use in step content, like <code>{{ player.nickname }}</code>, don't apply to email. See <a href="/docs/personalising-text-with-player-tokens">Personalising Text with Player Tokens</a>.</p>

<h2>Delivery You Can Trust</h2>
<p>Pressing Send locks in the exact recipient list, then delivers it from your browser <strong>ten at a time</strong> with a live progress bar. What's still pending is worked out from what has actually been sent, so nothing is lost if the tab closes or the connection drops. The campaign waits under <strong>Unfinished Campaigns</strong> with a <strong>Resume Sending</strong> button that picks up exactly where it stopped, and nobody receives it twice.</p>
<p>A message that fails on a temporary error is retried automatically. Anything that still fails can go again with <strong>Retry failed</strong>, which never re-sends to people who already got it. Every campaign is listed under <strong>Past Campaigns</strong> with how many were delivered and how many failed, and the <strong>Send Log</strong> shows each email's status.</p>

<h2>Good Use Cases</h2>
<ul>
  <li>Nudging players who've gone quiet: pick them from the grid. The Last Login column on the Players page tells you who they are.</li>
  <li>Announcing a new Tabi or chapter that just opened.</li>
  <li>A deadline reminder a few days before a milestone closes.</li>
  <li>A wrap-up or congratulations message at the end of the Adventure.</li>
</ul>

<h2>Who Can Send</h2>
<p>GMs and admins. An NPC sees the page view-only: the campaign history and send log, but no Compose.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a>.</p>
HTML,
            ],
            [
                'title'      => 'How to Send an Email Campaign',
                'slug'       => 'how-to-send-an-email-campaign',
                'section'    => 'setup',
                'sort_order' => 34,
                'body'       => <<<'HTML'
<ol>
  <li>Open <strong>Admin Tools → Email Notifications</strong>. The header shows how many eligible recipients the Adventure has.</li>
  <li>Write a <strong>Subject</strong> and your <strong>Message</strong>. Personalise the message with <code>{{name}}</code>, <code>{{adventure_name}}</code> and <code>{{site_name}}</code>.</li>
  <li>Choose <strong>Recipients</strong>: <em>All enrolled players</em>, or <em>Selected players</em>. For a selection, search by name or email and click cards to select them; <strong>Select all shown</strong> and <strong>Clear</strong> help with large groups. Your selection holds as you page through.</li>
  <li>Press <strong>Preview</strong>. The email opens in a new tab in the platform's email template, with your own name in place of <code>{{name}}</code>. There's no test send, so this is your one real look before it goes out.</li>
  <li>Press <strong>Send</strong> and confirm. Keep the tab open while the progress bar runs; it counts how many have been processed, sent and failed.</li>
  <li>If the tab closed or the connection dropped, come back and press <strong>Resume Sending</strong> under Unfinished Campaigns. If anything failed, press <strong>Retry failed</strong>.</li>
</ol>
<p>In Launch Week, two campaigns go out: a kickoff welcome the Sunday before Monday's start, and a Week Two nudge on Wednesday of Week One, sent to a hand-picked set of players who haven't made their Path choice yet.</p>
HTML,
            ],
            [
                'title'      => 'Personalising Text with Player Tokens',
                'slug'       => 'personalising-text-with-player-tokens',
                'section'    => 'setup',
                'sort_order' => 35,
                'body'       => <<<'HTML'
<p>You can drop a player's own details straight into the text you write, so a dialogue step reads "Nice work, Sam — you're level 6" rather than something generic. These are called <strong>tokens</strong>.</p>

<h2>The Syntax</h2>
<p>Write the token in double curly braces:</p>
<ul>
  <li><code>{{ player.nickname }}</code> inserts the player's nickname</li>
  <li><code>{{ player.nickname | Explorer }}</code> inserts "Explorer" instead if that player has no nickname set</li>
</ul>
<p>Spaces inside the braces are optional: <code>{{player.nickname}}</code> works the same. <strong>Always use the fallback form</strong> for anything a player might not have filled in. A sentence that reads "Welcome back, !" is worse than one that says "Welcome back, Explorer!"</p>

<h2>Inserting a Token From the Editor</h2>
<p>You don't have to remember the names. Every rich-text editor (the text box with a formatting toolbar) has an <strong>Insert player data</strong> button, the person icon in the toolbar. It opens a menu grouped into:</p>
<ul>
  <li><strong>Player</strong></li>
  <li><strong>Progress</strong></li>
  <li><strong>Guild</strong></li>
  <li><strong>Adventure</strong></li>
  <li><strong>Profile fields</strong>: this adventure's own custom profile fields. The group only appears once the adventure has some.</li>
</ul>
<p>Pick an entry and the token is inserted where your cursor is. The menu lists what the adventure offers, not what you personally have filled in, so you'll see the guild and profile-field tokens even if you have no guild or profile data yourself.</p>
<p>The menu inserts the plain token. Add the <code>| fallback</code> part yourself where a player might not have a value. In a plain text box with no toolbar, type the token by hand.</p>

<h2>What You Can Reference</h2>
<p>Tokens are grouped into five families:</p>
<ul>
  <li><strong><code>player.*</code></strong>: the player's own profile. The menu offers <code>nickname</code>, <code>first</code>, <code>last</code>, <code>display_name</code>, <code>email</code>, <code>company</code>, <code>website</code>, <code>linkedin</code>, <code>country</code> and <code>bio</code>.</li>
  <li><strong><code>progress.*</code></strong>: live numbers for this adventure: <code>level</code>, <code>xp</code>, <code>bloo</code>, <code>ep</code>, <code>tnl</code> (XP to next level), <code>gpa</code>, <code>spent</code> (BLOO spent), <code>completed</code> and <code>total</code> (milestones), and <code>percent</code>.</li>
  <li><strong><code>guild.*</code></strong>: their guild's <code>name</code>, <code>code</code>, <code>members</code>, <code>capacity</code> and <code>xp</code>.</li>
  <li><strong><code>meta.*</code></strong>: any custom profile field you've set up for the adventure (see <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>). Add a field and it's immediately usable in your text, with no development work.</li>
  <li><strong><code>adventure.*</code></strong>: the adventure's own <code>title</code> and <code>id</code>.</li>
</ul>
<p>Sensitive fields (passwords, secret codes, payment identifiers, API keys) are deliberately excluded and can never be shown by a token, however you spell it.</p>

<h2>Where Tokens Work</h2>
<ul>
  <li>Step content, across every step type: dialogue, open text, puzzles, branch choices and the rest</li>
  <li>A milestone's win and fail messages, including where they appear in Secrets and Clues</li>
  <li><a href="/docs/posts-and-resources">Posts and Resources</a></li>
  <li>Item descriptions, in the Item Shop, the Backpack and the Tabis page</li>
  <li>Achievement descriptions</li>
  <li><a href="/docs/certificates-authoring">Certificate</a> text</li>
  <li>Trait descriptions on <a href="/docs/profile-tests">profile test</a> results</li>
</ul>
<p>Task instructions and Mission text don't expand tokens. Email campaigns use their own merge tags instead. See <a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a>.</p>

<h2>Worked Examples</h2>
<ul>
  <li><code>Welcome back, {{ player.nickname | Explorer }}.</code></li>
  <li><code>You're level {{ progress.level }} with {{ progress.tnl }} XP to the next one.</code></li>
  <li><code>{{ guild.name | Your guild }} has {{ guild.members }} members.</code></li>
  <li><code>You've finished {{ progress.completed }} of {{ progress.total }} milestones ({{ progress.percent }}%).</code></li>
</ul>

<h2>If You Migrated From the WordPress Version</h2>
<p>The old <code>[player_data field="..."]</code> shortcode still works, so existing content keeps working and you don't have to rewrite anything. New content should use the <code>{{ }}</code> form, which reaches progress, guild, meta and adventure values the old shortcode never could.</p>
<p>If you previously saw the literal text <code>[player_data field="player_nickname"]</code> appearing to players instead of their name, that's fixed. Those steps now show the real value.</p>

<h2>A Note on Safety</h2>
<p>Token values are escaped automatically when they're inserted. A player whose nickname contains stray characters or markup can't break your page layout or inject anything into it, so you can use tokens freely without worrying about what someone typed into their profile.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Setting Up Your Skills Catalog',
                'slug'       => 'setting-up-your-skills-catalog',
                'section'    => 'setup',
                'sort_order' => 36,
                'body'       => <<<'HTML'
<p>Skills are yours to define, per adventure. Everything in the <a href="/docs/the-garden-overview">Garden</a> runs off this catalogue: hexagon colours, help request tags, endorsements, gifts, Task and Mission rewards. It's worth setting up deliberately before players arrive.</p>
<p>You'll find it on the <strong>Skills</strong> tab of Manage Content. Press <strong>New Skill</strong> to add one.</p>

<h2>One Catalogue for a Template and Its Cohorts</h2>
<p>The skill catalogue belongs to the template adventure, and every cohort made from it shares it. Editing the Skills tab from a cohort edits the template's catalogue, so the change shows in every cohort at once. Players' levels are separate: each cohort keeps its own. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a>.</p>

<h2>What Each Skill Carries</h2>
<p>Each row shows the skill's name and badges for what matters at a glance: <em>Max</em> level, <em>Endorsable</em>, <em>Draft</em> if it isn't published, and how many Tasks pay Blooms into it. Everything else is behind <strong>Quick Edit</strong>. Press <strong>Save</strong> when you're done.</p>
<ul>
  <li><strong>Name</strong>: what players see. Use their language, not internal jargon.</li>
  <li><strong>Colour</strong>: chosen from the colour picker. It becomes the hexagon colour of every player whose master skill this is, colours the skill across the Garden and the player's Journal, and is the fallback colour for a Task hexagon on the Journey that teaches this skill. Pick visibly distinct colours; that's what makes clusters readable.</li>
  <li><strong>Icon</strong>: chosen from the icon picker, shown on the skill's chip. Leave it on none for a plain name chip.</li>
  <li><strong>Image</strong>: optional artwork, shown wherever the skill has room for one. The icon and colour carry it everywhere else.</li>
  <li><strong>Max level</strong>: the ceiling, 40 by default. Use 40 for a proficiency people build over time, and 1 for a skill that works as an unlock gate.</li>
  <li><strong>Status</strong>: Published or Draft.</li>
  <li><strong>Endorsable</strong>: "Peers can award Blooms in it". This is saved and shown as a badge, but it doesn't currently stop players endorsing or gifting in that skill, so don't rely on it to protect a gate skill.</li>
  <li><strong>Description</strong>: what the skill actually means. It appears as a tooltip on skill chips in the Garden and on the player's Skills tab in their Journal, so players genuinely read it.</li>
</ul>
<p>The toolbar above the list searches by name, filters to Published or Drafts, and sorts by default order, name, or how many Tasks use each skill.</p>

<h2>Designing a Good Catalogue</h2>
<p><strong>Write real descriptions.</strong> A skill called "Resilience" with no explanation means whatever each player assumes. A sentence of definition makes endorsements consistent across your whole roster.</p>
<p><strong>Keep it to competencies people can recognise in each other.</strong> If a player can't tell whether a colleague showed it, they won't endorse it, and the skill stays empty.</p>
<p><strong>Give distinct colours.</strong> Twelve skills in twelve shades of blue produce a Garden nobody can read.</p>
<p><strong>Be careful with gate skills.</strong> Any published skill can be endorsed and gifted today, and asking for help earns a Bloom in the skill asked about. A skill with a max level of 1 can be reached through those routes as well as through the Journey.</p>

<h2>Renaming Rather Than Deleting</h2>
<p>If you're reworking a catalogue that's already in use, <strong>rename existing skills instead of deleting and recreating them</strong>. Every Bloom ever awarded is tied to the skill it was given in. Rename it and that history follows the new name. Delete it and the points players earned are left pointing at a skill that no longer exists.</p>

<h2>Wiring Skills Into the Adventure</h2>
<ul>
  <li><strong>Milestones and achievements</strong> can award a Bloom in a skill on completion. Set it alongside their other rewards. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a> and <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</li>
  <li><strong>Tasks</strong> can pay any number of Blooms into one skill, and <strong>Missions</strong> pay their reward into the skill you choose. See <a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a>.</li>
  <li><strong>Conditions</strong> can test Blooms: a player's total, their level in one skill, Blooms received from peers, or Blooms given. That's how a skill can unlock an achievement, complete a Task, or grow an evolving Tabi's artwork. See <a href="/docs/conditions-when-things-unlock">Conditions</a>.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a></li>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Running the Garden as a GM',
                'slug'       => 'running-the-garden-as-a-gm',
                'section'    => 'setup',
                'sort_order' => 37,
                'body'       => <<<'HTML'
<p>Once your <a href="/docs/setting-up-your-skills-catalog">skills catalogue</a> exists, the Garden largely runs itself: players endorse, gift, ask for help, answer each other and connect. This page covers the levers you hold.</p>
<p>The Garden and Tasks are each a feature you switch on per adventure, as <em>The Garden</em> and <em>Tasks</em> in the Features list of Adventure Settings. See <a href="/docs/complete-adventure-settings-reference">the settings reference</a>. Everything here is authored by GMs and admins. NPCs can see it but not change it.</p>

<h2>Tasks or Missions?</h2>
<p>The two mechanics aren't interchangeable, and picking the wrong one is the most common way a Garden goes flat:</p>
<ul>
  <li>Author a <strong>Task</strong> when you want a player to <em>improve themselves</em>: build a habit, practise something, show up, do the work. Tasks pay XP, BLOO, energy, and Blooms into a skill.</li>
  <li>Author a <strong>Mission</strong> when you want a player to <em>improve their Garden</em>: reach out, connect, help somebody. Missions pay Blooms.</li>
</ul>
<p>Helping themselves is a Task; helping others is a Mission. If you find yourself writing a Mission a player could complete alone, it should have been a Task.</p>

<h2>Authoring Tasks</h2>
<p>Tasks live on the <strong>Tasks</strong> tab of Manage Content. Press <strong>New Task</strong>, or <strong>Edit</strong> on an existing one, and the form opens in a side drawer.</p>
<ul>
  <li><strong>Basics</strong>: title, status (Published or Draft), instructions, and a look: a colour, an icon and an optional image. These are what the Task looks like as a hexagon on the Journey. Leave the colour blank and it follows the skill the Task teaches.</li>
  <li><strong>Trigger</strong> (<em>Completes when…</em>): the player marks it done (a button, or a QR scan), finishes any milestone, finishes one specific milestone, logs in each day, or meets a set of conditions. Condition Tasks use the same condition rows as achievements, and a counter can carry a "within N days" window. See <a href="/docs/conditions-when-things-unlock">Conditions</a>.</li>
  <li><strong>Time limit</strong>: a countdown that starts when each player presses Start, 0 for none. Choose what happens if they run out: "They can start over", or "One shot — it's gone". A missed attempt never pays.</li>
  <li><strong>Recurrence</strong>: once ever, unlimited, or timed with a cooldown in seconds, minutes, hours or days. A condition Task can't be unlimited: saving one sets it to once, so use timed if it should repeat.</li>
  <li><strong>Reset via</strong>: on a timed Task the player marks done, choose <em>Scanning a QR code</em> instead of <em>Cooldown timer only</em>, for example for a check-in station. Players then complete it by scanning, and scan again after each cooldown. Untick "Show the QR code to players in the app" so they have to find the printed one. The code and its link appear in the drawer for you to print. If a photo of it gets shared, press <strong>Regenerate</strong> and the old code stops working immediately. See <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>.</li>
  <li><strong>Rewards</strong>, each optional: XP, BLOO, Energy (how players win back what <a href="/docs/random-encounters">encounters</a> cost them; it can't be negative), and Blooms in one skill.</li>
</ul>
<p>To put a Task on the Journey map, place a Tasks widget or a single Task hexagon from the Journey Builder. See <a href="/docs/journey-builder-design-palette">the Journey Builder palette</a>.</p>

<h2>Authoring Missions</h2>
<p>Missions live on the <strong>Missions</strong> tab of Manage Content. Press <strong>New Mission</strong>, or <strong>Edit</strong> on an existing one. The form has four parts.</p>
<h3>Basics</h3>
<p>Title, status (Published or Draft) and instructions. Only published Missions reach players.</p>
<h3>Who sees this mission?</h3>
<p>Pick one audience, then choose one or more entries within it:</p>
<ul>
  <li><strong>Global</strong>: everyone in the adventure</li>
  <li><strong>Guild</strong>: one or more guilds</li>
  <li><strong>Individual</strong>: one or more named players</li>
  <li><strong>Achievement</strong>: anyone who holds it</li>
  <li><strong>Branch</strong>: anyone on that path</li>
</ul>
<p>A player who joins the audience later, by joining the guild or earning the achievement, sees the Mission from then on.</p>
<h3>How is it completed?</h3>
<p>Either <strong>The player marks it done</strong> (they press Mark done; it's the honour system), or <strong>Auto-tracked from real interactions</strong>, with a target count and one of these rules:</p>
<ul>
  <li><strong>Send a message</strong>: each direct message the player sends</li>
  <li><strong>Help someone</strong>: each help request they reply to, counted when they post the reply, approved or not</li>
  <li><strong>Endorse someone</strong>: each endorsement they give</li>
  <li><strong>Ask for help</strong>: each help request they post</li>
  <li><strong>Get one of your requests solved</strong>: note that as built, this counts for the helper whose reply is approved, not for the player who asked. Until that changes it rewards having your help approved.</li>
  <li><strong>Gift a Bloom</strong>: each Bloom they gift, which comes out of their own 20</li>
  <li><strong>Post on the Wall</strong>: each post they make on the Wall</li>
  <li><strong>Make a connection</strong>: each connection request they accept. The person who accepts is the one credited.</li>
</ul>
<p>How the counting works:</p>
<ul>
  <li>It counts from the moment the Mission is published and the player is in its audience. Nothing done before counts.</li>
  <li>It counts actions, not people. A rule can't be limited to one skill or one person. If you want "help 5 players who need Leadership help", say so in the instructions, knowing that any five replies will count.</li>
  <li>Each Mission completes once per player.</li>
</ul>
<p>There's no rule for reconnecting with someone a player has drifted from. The fading on the canvas does that job.</p>
<h3>Reward</h3>
<p>Choose a skill and how many Blooms to award (2 by default). With <em>No skill reward</em> the Mission pays nothing, since a Bloom is always a level in some skill. Rewards are claimed: when a player completes a Mission, it appears in their Rewards and the Blooms land when they press Claim.</p>

<h3>A practical starting set</h3>
<p>One low-target <em>Ask for help</em> Mission to seed the Help Board, one <em>Help someone</em> Mission so those requests get answered, and one <em>Make a connection</em> Mission once the cohort has settled. Endorsement and gift Missions work well for recognition drives; remember a gift Mission draws on each player's limited 20. Missions that ask for more social effort than your cohort's size supports will just sit there uncompleted.</p>

<h2>Tasks and Missions in Cohorts</h2>
<p>Tasks and Missions belong to each cohort, not to the template. Editing them in one cohort changes only that cohort.</p>
<ul>
  <li>A new cohort starts with copies of the template's Tasks and Missions automatically.</li>
  <li>For anything added to the template later, open the cohort's <strong>Admin Tools</strong> and choose <strong>Missions &amp; Tasks</strong>. It lists the template's Missions and Tasks, each marked <em>Here</em> or <em>Not copied yet</em>, with a <strong>Copy the N missing</strong> button for each kind. It copies only what's missing, matched by title, and doesn't update ones the cohort already has. If a copied Task has lost its milestone trigger, the page marks it <em>Trigger missing</em> and offers <strong>Restore the triggers</strong>.</li>
  <li>Guild and named-player audiences don't carry into a cohort, because its guilds and players are its own. Achievement and branch audiences do. A Mission left with no audience arrives as a <strong>Draft</strong>, so it never turns into a Global one by accident. Set its audience and publish it.</li>
</ul>
<p>See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a>.</p>

<h2>Awarding Blooms to a Group</h2>
<p>From the Missions tab, press <strong>Award Blooms directly</strong> to open the <strong>Award Blooms</strong> page:</p>
<ol>
  <li>Choose a <strong>Skill</strong> and an <strong>Amount</strong>, and write a <strong>Note</strong>. Players see the note, for example "Great teamwork in today's workshop".</li>
  <li>Choose the audience: <strong>Guild(s)</strong>, <strong>Named player(s)</strong>, or <strong>A player-meta field</strong> plus the value to match exactly (for example a country field and "Mexico"). See <a href="/docs/managing-your-player-roster">Player Meta</a>.</li>
  <li>Press <strong>Preview audience</strong> to see how many players match.</li>
  <li>Press <strong>Send</strong> and confirm. It can't be undone.</li>
</ol>
<p>Each matched player gets the award in their Rewards, with your note, and the Blooms land when they claim it. The page lists recent awards: what, to how many players, and who sent them.</p>

<h2>Granting Skills Directly</h2>
<p>For one player, open their drawer in the Garden. Under <strong>GM: Award skill points</strong>, pick a skill and an amount and press <strong>Grant</strong>. Use this for things the system can't see: excellent work in a workshop, leadership during a live event, something that happened off-platform.</p>
<p>A direct grant lands straight away and isn't limited to once a day. It's recorded with you as the giver, so it appears in the player's Skill History like any other Bloom.</p>

<h2>Gift Bloom Balances</h2>
<p>Every player starts with 20 Blooms to give in each adventure, set up automatically the first time their balance is needed. There's no roster setup step.</p>
<p>In a player's drawer, <strong>GM: Reset gift Blooms</strong> sets their balance to the number you enter when you press <strong>Set balance</strong>. It sets the number rather than adding to it. This is the <em>only</em> way gift Blooms are replenished: there's no automatic refill. If you're running a long adventure, plan a periodic top-up, or tell players their 20 are meant to last.</p>

<h2>What to Watch</h2>
<ul>
  <li><strong>A grey Garden</strong> means people aren't interacting at all. That usually means the adventure needs to give them a reason to, not that the Garden is broken.</li>
  <li><strong>One colour dominating</strong> means your catalogue is too narrow, or one skill is far easier to earn than the rest.</li>
  <li><strong>An empty Help Board</strong> usually means nobody has been shown it. Seed it with an <em>Ask for help</em> Mission.</li>
  <li><strong>Endorsements clustering inside guilds</strong> is normal early on. A Global <em>Make a connection</em> or <em>Send a message</em> Mission helps break cliques open.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/setting-up-your-skills-catalog">Setting Up Your Skills Catalog</a></li>
  <li><a href="/docs/garden-missions">Garden Missions</a> (what players see)</li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Grading & AI-Assisted Feedback — Reviewing Player Submissions',
                'slug'       => 'grading-and-ai-assisted-feedback',
                'section'    => 'setup',
                'sort_order' => 38,
                'body'       => <<<'HTML'
<h2>What Needs Grading, and What Doesn't</h2>
<p>Most Step types need nothing from you. Content steps complete on their own, answer-checked steps mark themselves against the answers you set, and survey-style steps collect responses with no right or wrong. Challenges grade themselves too. A Game Master's actual review time goes on <strong>Open Text</strong> steps and the written submissions they produce.</p>

<h2>How a Grade Decides Rewards</h2>
<p>Three settings decide what grading does:</p>
<ul>
  <li><strong>Validate</strong> on the milestone ("Require validation before awarding") — the milestone's rewards wait until you validate the submission.</li>
  <li><strong>Grade scale type</strong>, in Adventure Settings (Resource Mechanics) — None, Percentage or GPA (letters). With None you validate or invalidate. With a scale you also give a grade.</li>
  <li><strong>Assign Resources</strong>, on the same panel — Before Grading or After Grading. After Grading holds a milestone's rewards until it has a grade above zero, then pays its BLOO in proportion to the grade: a 75 pays 75% of the BLOO.</li>
</ul>

<h2>Setting the Bar Before They Submit</h2>
<p>An Open Text step can require a minimum word count (<strong>Min Words</strong>), so a one-line answer simply can't be sent. The player is told how many words they need and how many they wrote. You never see the half-effort version, and the player gets the feedback immediately rather than waiting for you to bounce it back.</p>

<h2>Turning On AI-Assisted Feedback</h2>
<p>With a Claude API key on the Adventure (see <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading</a>), every Open Text step has three A.I. settings:</p>
<ul>
  <li><strong>Check the player's answer with A.I. before they continue</strong> — the instant check. When it's on, the answer goes to Claude when the player submits it. If it falls short, the player sees why and revises before moving on.</li>
  <li><strong>A.I. Strictness</strong> — Lenient (only reject blank or unrelated answers), Standard (a genuine, on-topic attempt passes) or Strict (every part of the prompt must be engaged with).</li>
  <li><strong>A.I. Reviewer Context</strong> — your private rubric. Say what a good answer to <em>this question</em> must include: key ideas, facts, what to reject. Players never see it, and the A.I. is told never to quote it back. The milestone's own content is sent automatically, so write only what's specific to the question. It's optional: without it, the A.I. judges whether the answer is a genuine attempt at the prompt, not whether it's right.</li>
</ul>
<p><strong>One rubric, two readers.</strong> The same strictness and reviewer context drive the player's instant check and your second opinion on the review screen, so what a player is held to and what the reviewer is told can't drift apart. Both are used even when the instant check is off, so you can still ask for a second opinion on a finished submission. On the review screen, when a submission covers several Open Text questions, the strictest one sets the bar.</p>
<p><strong>The check never strands a player.</strong> If it can't run — no key, a rejected key, an unreadable reply — the answer passes. That also means a broken key looks exactly like a pass. Staff who play the milestone see an amber note under their answer saying why the check was skipped, and the skip is written to the <a href="/docs/activity-logs">activity log</a>. Players never see either. Press <strong>Test Key</strong> after saving a key to be sure.</p>

<h2>Your Review Screen</h2>
<p>Open it from the milestone's <strong>Review</strong> link on Manage Content → Journey, or from <strong>Review Milestone</strong> in the milestone builder. Each submission is a card with the player's name and email, when it was published and last modified, and the full answer, plus:</p>
<ul>
  <li>A <strong>Grade</strong> field (0–100), when the Adventure uses a grade scale. On a milestone with Validate on, a grade above zero also validates the submission.</li>
  <li>On a milestone with Validate on, one button showing the action available: <strong>Validate</strong> or <strong>Invalidate</strong>. Validating keeps any grade already given. With nothing graded yet, it records 100, and invalidating records 0.</li>
  <li><strong>Validate with A.I.</strong>, when the Adventure has a key.</li>
  <li><strong>GM Feedback (visible to player)</strong> — a written note for the player. See below.</li>
</ul>
<p>For a Challenge, the review screen lists attempts instead: status, grade, correct answers and date.</p>
<p>Work through submissions per milestone rather than per player. It's easier to stay consistent when you're comparing several answers to the same prompt back to back.</p>

<h2>A Second Opinion From the A.I.</h2>
<p><strong>Validate with A.I.</strong> sends one submission to Claude with the milestone's content, each question's prompt and your reviewer context, at the step's strictness. The verdict panel says whether it looks like a genuine, complete answer and why. It also shows a suggested grade on your Adventure's scale and a suggested comment for the player. You decide what happens:</p>
<ul>
  <li><strong>Validate with this feedback</strong></li>
  <li><strong>Invalidate with this feedback</strong></li>
  <li><strong>Add the feedback without validating</strong></li>
</ul>
<p>All three are offered whatever the verdict: the A.I. is a second opinion, not the decision. If the player edits their answer after the check, applying the verdict is refused and you're asked to run the check again, so a grade the A.I. never gave can't be written. Every verdict is saved, and a later Validate All reuses it rather than paying for it twice.</p>

<h2>Written Feedback</h2>
<p>Type in <strong>GM Feedback (visible to player)</strong> and it saves when you click away. A.I. feedback you accept lands in the same box. The player sees it as "Feedback from your Game Master" when they reopen the milestone after it's been graded or validated. <strong>At the moment, that note only appears on milestones submitted as a single written answer, with no steps.</strong> On step-based milestones the feedback is saved, and travels in the review CSV, but isn't shown to the player yet.</p>

<h2>Who Can Grade</h2>
<p>GMs and admins. An NPC can open the review screen and read every submission and verdict, but can't grade, validate or run the A.I.</p>

<p><strong>Where to go next:</strong> <a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>, once you're grading at cohort scale.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a></li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a></li>
  <li><a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones — Rewards &amp; Unlock Rules</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Reviewing & Grading Submissions in Bulk',
                'slug'       => 'reviewing-and-grading-submissions-in-bulk',
                'section'    => 'setup',
                'sort_order' => 39,
                'body'       => <<<'HTML'
<p>For grading at real scale — a full cohort's worth of answers on one milestone — the review screen has two tools beyond grading one card at a time: <strong>Validate All with A.I.</strong>, and a CSV round-trip for grading in a spreadsheet. The basics of the review screen are in <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>.</p>

<h2>Validate All with A.I.</h2>
<p>On a milestone with Validate on, in an Adventure with a Claude key, the review screen has an <strong>A.I. Review</strong> panel showing how many submissions the A.I. has decided so far. <strong>Validate All with A.I.</strong> shows you a plan before anything is spent:</p>
<ul>
  <li><strong>The counts</strong> — submissions, already reviewed, to judge, already judged (free), and nothing written.</li>
  <li><strong>What it will judge against</strong> — the milestone's content, then each question's prompt, strictness and reviewer context. A question with no reviewer context is flagged, because without one the A.I. only judges whether an answer is a genuine attempt, not whether it's right. This is the moment to catch that, not afterwards.</li>
  <li><strong>Validate at or above</strong> — the A.I. grade (70 by default) at which a submission is validated. Below it, the submission is invalidated.</li>
  <li>An option to leave alone any submissions that already have a comment from a human. Untick it and the A.I.'s comment replaces theirs.</li>
  <li><strong>The cost</strong> — an estimate for the submissions it hasn't judged before, either measured on this milestone or estimated from the prompt that will be sent. Ones it has judged before are reused and cost nothing.</li>
</ul>
<p>Press <strong>Review N submission(s)</strong> and a console reports each one as it goes: validated, invalidated, skipped, or left for a human. It ends with a tally and the approximate cost.</p>

<h3>Stopping, Resuming, and One Run at a Time</h3>
<ul>
  <li><strong>Cancel stops the work</strong>, not just the window, and everything decided so far is saved.</li>
  <li><strong>Resuming is automatic.</strong> Run it again and anything already reviewed is skipped. A verdict that was bought but not applied is reused rather than paid for again. Each verdict is tied to the exact answer it judged, so an answer the player has since edited gets judged afresh.</li>
  <li><strong>One run per milestone.</strong> If another GM is already running one, you're told who. Starting again in a second tab of your own takes the run over.</li>
</ul>

<h3>Nothing Applied on Doubt</h3>
<p>An API error, an unreadable reply, or a submission with nothing written is recorded and left for a human, never quietly validated. A temporary error, such as a rate limit, is retried up to three times. Three failures in a row stop the run. An error that would repeat for every submission, like a rejected key, stops it straight away.</p>

<h3>How the A.I.'s Grade Is Written</h3>
<ul>
  <li><strong>No grade scale</strong> — only the validate or invalidate decision is recorded. The A.I.'s number is never stored as a score, so it can't shrink anyone's BLOO.</li>
  <li><strong>Percentage</strong> — the A.I.'s grade is stored as given.</li>
  <li><strong>GPA (letters)</strong> — the grade drops to the letter breakpoint at or below it, so an 82 records as a B.</li>
</ul>

<h2>The Cohort Summary</h2>
<p>Once the A.I. has judged anything on a milestone, the A.I. Review panel shows how it graded the cohort. It refreshes when a run finishes:</p>
<ul>
  <li>Decided (out of the total), validated, invalidated, the average grade, and <strong>overruled by a human</strong>.</li>
  <li><strong>What it gave them</strong> — a spread across Weak (0–49), Borderline (50–69), Solid (70–84) and Strong (85–100).</li>
  <li>How many couldn't be judged, and how many were judged but not acted on yet.</li>
  <li>The strictness it ran at, the cost so far in dollars and tokens, and when it last ran.</li>
</ul>
<p><strong>Overruled is the number worth watching.</strong> It counts the times a person changed the decision after the A.I. made it. Everything else is the A.I. reporting its own tally back to you. A run that graded sensibly and a run that graded nonsense look the same from its side. If the overruled count keeps climbing, the step's strictness or reviewer context is set wrong, not the submissions.</p>

<h2>The CSV Round-Trip</h2>
<p><strong>Download CSV</strong>, in the Milestone Data panel, exports every submission with the columns <code>player_id</code>, <code>quest_id</code>, <code>adventure_id</code>, <code>player_name</code>, <code>email</code>, <code>grade</code>, <code>validation_status</code>, <code>comment</code> and <code>entry</code>. <strong>That file is the import template.</strong> Grade and comment in your spreadsheet tool, then choose the file and press <strong>Upload Reviewed CSV</strong>. Only <code>grade</code>, <code>validation_status</code> and <code>comment</code> are read; everything else in the file is ignored.</p>
<ul>
  <li><strong>A blank cell leaves that value alone.</strong> A blank comment never wipes an existing one.</li>
  <li><strong>Untouched rows don't count.</strong> A row where nothing actually changes isn't applied, and the result tells you how many entries were updated and how many rows were skipped.</li>
  <li><strong>grade</strong> takes a number from 0 to 100, or a letter (A, A-, B+, B, B-, C+, C, D, F). It's ignored if the Adventure has no grade scale. On a Validate milestone, a grade above zero validates and a zero invalidates.</li>
  <li><strong>validation_status</strong> validates only on the exact word <code>valid</code>. Anything else in the cell — <code>invalid</code>, a typo — invalidates. It overrides whatever the grade implied on the same row, and it keeps an existing grade rather than resetting it.</li>
  <li>A row whose <code>quest_id</code> or <code>adventure_id</code> points at a different milestone is skipped rather than applied here.</li>
</ul>

<h2>Other Tools on the Review Screen</h2>
<ul>
  <li><strong>Create Images Zip</strong>, then <strong>Download Zip</strong> — every uploaded image from the milestone's submissions in one archive.</li>
  <li><strong>Pending Validation Reminders (CSV)</strong> — a plain list of the email addresses of players who've submitted but aren't validated yet, one per line, for a nudge from your own mail tool.</li>
</ul>

<h2>Grading Scale</h2>
<p>The scale comes from <a href="/docs/complete-adventure-settings-reference">Resource Mechanics</a> in Adventure Settings: None, Percentage, or GPA (letters). Whichever you choose, it applies across the review screen, the A.I. and the CSV.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a></li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a></li>
  <li><a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Setting Up AI Grading & Gift Card Rewards',
                'slug'       => 'setting-up-ai-grading-and-gift-cards',
                'section'    => 'setup',
                'sort_order' => 40,
                'body'       => <<<'HTML'
<p>How the A.I. reads and grades answers is covered in <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>. This page is the settings walkthrough for connecting both integrations: a Claude API key for A.I. grading, and a Tremendous account for real gift cards.</p>

<h2>Connecting Your Claude API Key</h2>
<p>Open Adventure Settings and go to the <strong>A.I.</strong> tab (A.I. Content Validation):</p>
<ol>
  <li>Go to <code>console.anthropic.com</code> and sign in, or create an account.</li>
  <li>Open Settings → API Keys, click "Create Key", give it a name and copy it. You won't be able to see it again, so copy it right away. It starts with <code>sk-ant-</code>.</li>
  <li>Paste it into the <strong>Claude API Key</strong> field and press <strong>Save Key</strong>.</li>
  <li>Press <strong>Test Key</strong>.</li>
</ol>
<p>The key is <strong>stored encrypted</strong> and used server-side only. The page never shows it back: the field only says whether a key is configured. Leaving the field blank changes nothing, typing a new key replaces the old one, and <strong>Remove Key</strong> deletes it.</p>
<p>Validation runs on Claude Haiku, and the app's own guide puts a typical validation at under a cent. For bulk runs, Validate All shows you an estimate before it spends anything and a running total afterwards.</p>

<h2>Test Key</h2>
<p><strong>Test Key</strong> makes one real round trip to Claude, the same way every check does. It reports which key it used (this Adventure's or its template's) and either how quickly Claude answered or exactly what came back instead. Every A.I. check fails open, so a rejected key looks just like every answer passing. That's why testing after you save is worth the click. Each test is written to the activity log.</p>

<h2>Cohorts Use Their Template's Key</h2>
<p>A cohort with no key of its own uses its template's, and the A.I. tab says so. Save a key on the template once and every cohort's checks, reviews and Cooper use it. Save a key on a cohort only when you want to override the template's.</p>

<h2>Where the Key Is Used</h2>
<ul>
  <li>The instant check on Open Text steps that have <strong>Check the player's answer with A.I. before they continue</strong> switched on. It runs with or without a reviewer context: the toggle alone decides.</li>
  <li><strong>Validate with A.I.</strong> and <strong>Validate All with A.I.</strong> on the review screen, which only appear once the Adventure has a key.</li>
  <li><strong>Cooper</strong> in this Adventure. An Adventure's key takes priority over the platform's Cooper key, so if Cooper starts failing in an Adventure, test this key first.</li>
</ul>

<h2>Setting Up Gift Card Rewards (Tremendous)</h2>
<p>The <strong>Tremendous</strong> tab of Adventure Settings connects a Tremendous.com account, so buying a Gift Card item in the Item Shop sends a real gift card to the player's email:</p>
<ol>
  <li>Paste your Tremendous <strong>API Key</strong>. It's stored encrypted, and leaving it blank on a later save keeps the saved one.</li>
  <li>Choose the <strong>Mode</strong>: Sandbox (testing) or Production (real cards). Sandbox and production are separate Tremendous accounts with separate campaigns. Switch mode, save, then reload the lists below.</li>
  <li>Pick the <strong>Currency</strong>: EUR, USD or GBP.</li>
  <li>Pick a <strong>Default Campaign</strong> from the dropdown. This is how you control which cards players can get: build a campaign in your Tremendous dashboard, choose the brands and countries it covers there, then select it here.</li>
  <li>Pick the <strong>Funding Source</strong> — which Tremendous account the cards are actually charged to.</li>
  <li>Press <strong>Save Settings</strong>.</li>
</ol>
<p>Both dropdowns load from your own Tremendous account after the page opens. Use <strong>Reload</strong> beside each to fetch them again. A saved value your account no longer returns stays visible in the list rather than being silently swapped out.</p>
<p>Unlike the Claude key, the Tremendous connection belongs to each Adventure: a cohort doesn't use its template's. Set it up on every cohort that sells gift cards.</p>

<h2>Choosing Which Card an Item Sends</h2>
<p>A Gift Card item has a <strong>Card Value</strong> (in the Adventure's currency), an optional label, and a <strong>Card Source</strong>:</p>
<ul>
  <li><strong>Adventure default campaign (recommended)</strong> — uses the campaign set on the Tremendous tab. If there isn't one, the item form warns you that the item can't send anything.</li>
  <li><strong>A different campaign, just for this item</strong> — pick another of your campaigns.</li>
  <li><strong>Specific brands from the catalogue</strong> — search the catalogue by brand, currency and country. Use this only when the item is meant to be one card and nothing else.</li>
</ul>

<h2>Checked Before Any BLOO Is Spent</h2>
<p>A gift-card purchase is checked before anything is charged. If the Adventure isn't connected, the item has no card source, or the player has no email on file, the purchase is refused with a message saying what's missing. A send that Tremendous rejects spends no BLOO and records no purchase. Each player can redeem a given gift-card item once.</p>

<h2>The Order Log</h2>
<p>Manage Content → Items has a <strong>Gift Card Orders</strong> button. It opens every gift-card order for the Adventure — date, player, item, amount, status, mode and the Tremendous reference — with a search box and filters for All, Sent, Pending, Failed and Duplicate Blocked. A failed order shows Tremendous's own reason, so you can fix the setting that caused it.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a></li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a></li>
  <li><a href="/docs/item-shop-building-an-economy">Item Shop — Building an Economy</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Reading the Stats Dashboard',
                'slug'       => 'stats-dashboard-guide',
                'section'    => 'setup',
                'sort_order' => 41,
                'body'       => <<<'HTML'
<p>Stats is where you see how a whole cohort is doing: who's active, where people stall, what they earn and buy, and how long they actually spend. Open it from <strong>Stats</strong> in the Admin Tools menu (NPCs find it under Surveillance). GMs, NPCs and admins see the full dashboard. Only players are counted, so staff testing the Adventure don't skew the numbers.</p>

<h2>Adventure Dashboard</h2>
<p>Four headline figures: Total Players, Active in the last 7 days, average XP against the XP available, and overall Completion.</p>

<h2>Time in App</h2>
<p>How long players really spend, measured from a heartbeat the app sends while a player has an Adventure open. It only counts while the tab is in front, and one late ping can't add more than a short slice, so a laptop left asleep doesn't inflate anything. You get <strong>Avg. Session Length</strong> and <strong>Avg. Total Time / Player</strong>. Until there's data, the panel says it's collecting.</p>
<p>Underneath is a separate, clearly labelled <strong>estimate</strong> for the last 90 days, worked out from the gaps between logged actions. It undercounts reading and idle time, so it's never blended into the real figures. It's there for time before the heartbeat existed.</p>

<h2>Milestone Funnel</h2>
<p>A chart of enrolled players against completions per milestone, eight milestones at a time. It's usually the fastest way to spot a confusing or too-difficult milestone. <strong>See the full funnel</strong> opens <strong>Milestone Funnel Details</strong>, its own page: the whole funnel at once, scrollable, and narrowed with the <strong>View</strong> filter to All Milestones, a single Tabi or a single level. It also shows how many are enrolled and what share have logged in and been active in the last 7 days.</p>

<h2>Activity and Engagement</h2>
<ul>
  <li><strong>XP Distribution</strong> — how XP is spread across the cohort.</li>
  <li><strong>Daily Active Users</strong> — the last 30 days by default. Set a date range and press Apply, or reset it.</li>
  <li><strong>Tabi Completion Rate</strong> — how far the cohort is through each chapter.</li>
  <li><strong>Engagement Overview</strong> — the cohort's average engagement score out of 100, and how many players are On Fire, Active, Moderate, Cooling Off, Dormant or have Never Logged In.</li>
  <li><strong>Engagement Breakdown</strong> — the average of each part of that score: Recency, Frequency (milestones in the last 30 days), Completion, Progression (level against the top level) and Economy (Item Shop activity).</li>
</ul>

<h2>Engagement by Segment</h2>
<p>The <strong>Workforce Engagement</strong> panel splits the cohort by any Player Meta field you've marked <strong>Segment</strong> in the Player Meta Manager: department, region, whatever your roster carries. Pick the field from the dropdown to see each group's size, average engagement score and average completion. It also says what share of players have data for that field. See <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a> for setting fields up.</p>

<h2>Drill-Downs</h2>
<p>Each of these is a searchable, sortable table with a page size. Click a row to open the detail:</p>
<ul>
  <li><strong>Achievements</strong> — how many players have each one and what share that is. The detail lists who has it and who doesn't.</li>
  <li><strong>Random Encounters</strong> — shown when Energy Points (EP) is switched on. For each encounter: its kind (Crisis or Opportunity), how many faced it, how many resolved it, and the average cost. The detail, <strong>What they chose</strong>, splits the cohort by option, with how many picked each, the BLOO and energy it cost them, and who is still facing it. See <a href="/docs/random-encounters">Random Encounters</a>.</li>
  <li><strong>Profiles</strong> — shown when Profile Tests is switched on. For each profile: traits, questions, how many players have a reading, their average answers, and the most common headline. The detail shows the cohort average per trait and what people came out as. See <a href="/docs/profile-tests">Profile Tests</a>.</li>
  <li><strong>Item Purchases</strong> — purchases and total BLOO spent per item. The detail lists each purchase by player, date and amount.</li>
</ul>

<h2>Players</h2>
<p>The full roster, searchable across everyone rather than just the page you're on, and sortable by XP, BLOO, completion and last active. Click a player to load their personal dashboard in the panel below: the same Overview they see in their own Journal, with their engagement, charts, milestone and Tabi progress, achievements and guild.</p>

<h2>Cooper</h2>
<p>At the bottom, a view of how the in-app assistant is being used across <strong>every Adventure you manage</strong>, not just this one. It shows questions asked, conversations, players reached, questions per conversation and the share of enrolled players who've asked something. Charts show the last 30 days and the busiest hours, and a table breaks it down per Adventure. It shows counts only, never what anyone asked. If Cooper isn't switched on for this Adventure, the section says so rather than showing zeroes.</p>

<h2>Where Other Reports Live</h2>
<ul>
  <li><a href="/docs/activity-logs">Activity Logs</a> — the searchable audit table, which now has its own page (it used to sit on the Wall).</li>
  <li><a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a> — every case-study attempt, and who watched which video.</li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a> — how the A.I. graded a milestone.</li>
</ul>

<h2>Using This to Improve Your Adventure</h2>
<p>The dashboard works best as a feedback loop, not just a report. Find the milestone with the biggest drop-off, revisit its difficulty or clarity, then watch the funnel for the next cohort. Small changes to unlock requirements or step difficulty often move the numbers more than a full content rewrite.</p>
HTML,
            ],
            [
                'title'      => 'Case Study & Video Reporting',
                'slug'       => 'case-study-and-video-reporting',
                'section'    => 'setup',
                'sort_order' => 42,
                'body'       => <<<'HTML'
<p>Two step types produce more than a done-or-not-done: interactive case studies and videos. Each has its own report under Manage Content, so you can read what players actually wrote in a case study and see who really watched a video.</p>

<h2>Case Studies</h2>
<p>A <strong>Case Studies</strong> tab appears in Manage Content once the Adventure has a case-study step. It lists every case-study step with its milestone, how many players have tried it, how many attempts there are, and how many passed. You can filter to ones that have been attempted or that nobody has tried yet, and sort by name, players or attempts. <strong>Read entries</strong> opens the step's report.</p>

<h3>Every Attempt Is Kept</h3>
<p>The <strong>Case Study Entries</strong> page keeps every attempt: the passes, the ones that didn't pass, and the ones people walked away from. Each attempt shows:</p>
<ul>
  <li>The player and their email.</li>
  <li><strong>Try</strong> — which attempt this was for them.</li>
  <li><strong>Result</strong> — Passed, Did not pass, In progress, or Left unfinished (a run nobody has touched for six hours).</li>
  <li><strong>Score</strong>, <strong>Correct</strong> (for example 7/10) and <strong>Last activity</strong>.</li>
</ul>
<p>Switch between case studies with the picker at the top. Find a player by name or email, sort by player, try, result, score or last activity, and choose how many to show per page. Press <strong>Read</strong> on any attempt to see it question by question: each answer the player gave, marked Correct or Incorrect, with free-text notes shown as notes rather than marked. An unanswered question says "No answer given".</p>

<h3>Exporting</h3>
<p><strong>Export CSV</strong> downloads the attempts on the selected case study straight from the database, not just the page you're looking at. The columns are Player, Email, Try, Result, Score, Correct, Questions, Last activity and Answers. Answers holds every answer in one cell, each marked correct or incorrect where it was scored.</p>

<h2>Videos</h2>
<p>A <strong>Videos</strong> tab appears once the Adventure has a video step. For each video it shows how many people watched, the average time watched, the video's length, and how much of it the average watcher got through. <strong>Who watched</strong> opens the <strong>Who Watched</strong> page for that video. There's a picker to switch videos and a search by name or email, and for each player it shows:</p>
<ul>
  <li><strong>Watched</strong> — their total watching time.</li>
  <li><strong>Of the video</strong> — as a share of its length. It caps at 100%, so someone who rewatched doesn't read as an error.</li>
  <li><strong>Sittings</strong> — how many separate times they watched.</li>
  <li><strong>Last watched</strong></li>
</ul>
<p>Every column sorts. Time is counted only while the video is actually playing and the tab is in front, so it measures watching rather than leaving a video open. It's analytics only: watch time never changes whether a video step counts as done.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Activity Logs',
                'slug'       => 'activity-logs',
                'section'    => 'setup',
                'sort_order' => 43,
                'body'       => <<<'HTML'
<p>Every Adventure keeps an activity log: a running record of what players and staff do inside it. It's the place to answer "did they actually do that?", "who changed this?" and "when did it happen?". It has its own page, reached from the <strong>Activity</strong> tab on the Wall. The Wall is for conversation, so the audit table no longer sits among its channels.</p>

<h2>Two Views</h2>
<ul>
  <li><strong>My activity</strong> — your own actions in this Adventure. Every player can open this one.</li>
  <li><strong>Everyone</strong> — the whole Adventure's log, with a Player column. Only staff (GMs, NPCs and admins) see this tab.</li>
</ul>
<p>Your own view shows your most recent 500 entries, and the Everyone view the Adventure's most recent 1,000.</p>

<h2>What Gets Logged</h2>
<p>Most of what happens in an Adventure leaves an entry, for example:</p>
<ul>
  <li><strong>Player activity</strong> — entering the Adventure, completing steps and milestones (including by QR code), challenge attempts, purchases and item pickups, achievements earned and magic codes tried (right or wrong), level-ups, encounter draws, profile readings and retakes, and Garden actions such as endorsements, gifts and help requests.</li>
  <li><strong>Staff activity</strong> — edits to milestones, steps, achievements, certificates, Tabis and other content; grades, validations and A.I. reviews; enrolments and role or status changes; imports and exports; A.I. key tests; and milestone resets.</li>
  <li><strong>Skipped A.I. checks</strong> — when an Open Text check couldn't run (no key, a rejected key), the log says so and why. It's often the first place to look when A.I. validation seems not to be working.</li>
</ul>
<p>The list of actions grows as features start logging new things, so the filter is built from whatever is actually in the log.</p>

<h2>Searching and Filtering</h2>
<p>Each entry shows an icon, the player (on the Everyone view), the <strong>Action</strong>, the <strong>Type</strong>, the <strong>Detail</strong>, and <strong>When</strong>. Type is the kind of thing the action touched, shown by its internal name, so a milestone appears as <code>quest</code>. Above the table:</p>
<ul>
  <li><strong>Search</strong> matches the player's name, the action, the type and the detail.</li>
  <li><strong>All actions</strong> is an exact filter by action, listing every action in the log with how many entries it has. Use it when free text is too loose.</li>
  <li><strong>Page size</strong> — 25, 50, 100 or 250 per page, with a jump menu for long logs.</li>
</ul>

<h2>Good to Know</h2>
<ul>
  <li>Resetting a player's milestone doesn't erase their history: the log is kept, and the reset itself is written into it.</li>
  <li>The Stats page's time-in-app estimate is worked out from this log.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Reports &amp; Bulk Actions</a></li>
  <li><a href="/docs/announcements-keeping-an-adventure-alive">Announcements &amp; the Wall</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Complete Adventure Settings Reference',
                'slug'       => 'complete-adventure-settings-reference',
                'section'    => 'setup',
                'sort_order' => 44,
                'body'       => <<<'HTML'
<p>Adventure Settings is where an Adventure's own configuration lives. Open it from <strong>Admin Tools → Adventure Settings</strong>; inside a cohort, <strong>Template Settings</strong> opens the template's. Its sections are listed in a rail down the left side of the page (on a narrow window they become a row of tabs across the top); click one to jump to it. Most settings are saved together with <strong>Update Adventure</strong> in the bar at the bottom, next to the Publish / Draft / Trash status. A few tools act on their own buttons: the A.I. key, Tremendous, Reset and the player tools.</p>
<p>This page walks every section. Some have their own guides: <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>, <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>, <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a> and <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a>.</p>

<h2>General</h2>
<p><strong>General Settings</strong></p>
<ul>
  <li><strong>Adventure Name</strong> and, once the Adventure exists, its <strong>Enrollment Link</strong>.</li>
  <li><strong>Start Date</strong> and <strong>End Date</strong> — when the Adventure runs. Certificates print them, and Cooper knows when the Adventure ends.</li>
  <li><strong>Image</strong> and <strong>Highlight Color</strong>.</li>
  <li><strong>Adventure Type</strong> (Normal or Template) and <strong>Owner</strong> — admins only. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</li>
  <li><strong>Privacy</strong> (Public or Invite Only) — shown only when the platform allows public Adventures. It doesn't switch off the enrollment link.</li>
</ul>
<p><strong>Core Mechanics</strong></p>
<ul>
  <li>Long and short labels for XP, the currency and Energy. See <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>.</li>
  <li><strong>Nickname</strong> — what players are called in this Adventure, written in the singular ("Explorer", "Recruit").</li>
  <li><strong>Assign guilds on login</strong> — when it's on, a player you add one at a time is placed automatically in the guild with the fewest members that still has room. A CSV import uses its Guild column instead, and the enrollment link doesn't assign a guild.</li>
</ul>
<p><strong>Time Mechanics</strong></p>
<ul>
  <li><strong>Time zone</strong> — the Adventure's time zone, with its current time shown so you can check you picked the right one.</li>
  <li><strong>Hide milestones</strong> — Never, Before Start Date, After Deadline, or Before and After.</li>
  <li><strong>Schedule</strong> — Show all days, or Just today.</li>
</ul>
<p><strong>Resource Mechanics</strong></p>
<ul>
  <li><strong>Grade scale type</strong> — None, Percentage, or GPA (letters).</li>
  <li><strong>Assign Resources</strong> — whether a milestone's rewards land Before Grading or After Grading. After Grading stops players collecting a reward by submitting anything at all.</li>
</ul>

<h2>Cooper</h2>
<p><strong>Cooper Context</strong> is the Adventure's knowledge base for Cooper, the in-app assistant. <strong>Players never see it.</strong> Use it for everything Cooper can't work out from the Adventure itself: what the program is for, who the players are, house rules, dates, who to contact, and the words your organization actually uses. Cooper reads it on every conversation and treats it as authoritative. Write for the assistant, not for the player, and don't put answers, codes or solutions here. Cooper reads the first 20,000 characters (after formatting is stripped), so keep it within that. This field used to be the Adventure Intro; the welcome screen it fed is gone.</p>
<p><strong>Cooper's Character</strong> gives the assistant a different name, face and voice for this Adventure:</p>
<ul>
  <li><strong>Name</strong> (up to 40 characters) — shown in the chat and on its button.</li>
  <li><strong>Picture</strong> — shown at the top of the chat; square works best.</li>
  <li><strong>Button icon</strong> — for the taskbar button. Blank uses the picture.</li>
  <li><strong>Greeting</strong> (up to 500 characters) — the first thing it says.</li>
  <li><strong>Personality</strong> (up to 2,000 characters) — how the character talks. It changes the voice, never the rules: the assistant still won't give answers away.</li>
</ul>
<p>Anything you leave blank uses the platform default from Sys Config. A cohort uses its template's character unless it sets its own.</p>

<h2>Reset</h2>
<p>Shown once the Adventure exists. Both act on every player at once:</p>
<ul>
  <li><strong>Reset Prev Level</strong> — forgets the last level each player was congratulated on, so the next time each player opens the Journey, the level-up moment runs again and any ranks at or below their level are awarded. It acts immediately, with no confirmation.</li>
  <li><strong>Reset Guilds</strong> — after a confirmation, removes every player from every guild in this Adventure. The guilds themselves stay, empty.</li>
</ul>

<h2>Ranks</h2>
<p><strong>Adventure Ranks</strong> is the rank ladder: a table of levels, each tied to an achievement. When a player reaches the level, they're shown a special message and given that achievement as their rank. Add rows with <strong>Add Rank</strong>; if the Adventure has no rank achievements yet, <strong>Create the first rank</strong> starts one. See <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>

<h2>Players</h2>
<p>The <strong>Enrolled Players</strong> table (searchable, filterable by role, 25 to all per page) with each person's Player / GM / NPC switch, a link to their journal and a two-click <strong>Remove</strong>, followed by <strong>Add Players</strong> (the CSV import) and <strong>Add Single Player</strong> (search). See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</p>

<h2>Features</h2>
<p>One table of switches and values, with <strong>All On</strong> and <strong>All Off</strong> buttons. It opens with five Adventure settings:</p>
<ul>
  <li><strong>Zoom Level</strong> — how far in or out the Journey map starts, from 10% to 140%.</li>
  <li><strong>Hide Achievements</strong> — keep achievements hidden on the badges page until a player earns them.</li>
  <li><strong>Hide Certificates</strong> — hide certificates on the Achievements page until they're unlocked. Off shows them dimmed, with what's still missing.</li>
  <li><strong>Purchase Permissions</strong> — set it to <em>Only Players</em> to take the Item Shop's Buy button away from GMs and NPCs.</li>
  <li><strong>Custom Support Email</strong> — where the Email Support button in the header sends players. Blank uses the platform's default support address.</li>
</ul>
<p>Then the Adventure's features. A standard installation has twenty (a platform admin can rename them or add more):</p>
<ul>
  <li>Switches for <strong>Energy Points (EP)</strong> (the whole energy economy: EP rewards, the energy bar and random encounters), <strong>Item Shop</strong> (the shop, the backpack and item rewards), <strong>Backpack</strong>, <strong>Guilds</strong>, <strong>Challenges</strong>, <strong>Achievements</strong>, <strong>Magic Codes</strong>, <strong>Leaderboard</strong>, <strong>Blog</strong> (Posts), <strong>Lore / Resources</strong>, <strong>Wall / Social</strong>, <strong>Schedule</strong>, <strong>Speakers</strong>, <strong>The Garden</strong>, <strong>Tasks</strong>, <strong>Profile Tests</strong>, <strong>Tremendous Gift Card Rewards</strong> and <strong>Cooper (A.I. Guide)</strong>.</li>
  <li>Two numbers: <strong>Leaderboard Player Limit</strong> (how many players the Leaderboard shows; blank means 10) and <strong>Max Players per Adventure</strong>, an optional seat limit checked when someone joins through the enrollment link (0 or blank means no limit). That one is your own limit for this Adventure, separate from your plan.</li>
</ul>
<p>Switching a feature off takes it out of the menu and the screens it drives; switching Energy Points (EP) off removes EP everywhere. In a cohort, features are read from the template, so set them there.</p>
<p><strong>Map or List?</strong> There's no per-Adventure setting for which Journey view players get. A player's first visit opens whichever view the platform's <strong>Default Journey View</strong> names (a Sys Config setting); after that, each player's own last choice sticks.</p>

<h2>A.I.</h2>
<p><strong>A.I. Content Validation</strong> holds the Adventure's Claude API key, which enables A.I. checks on Open Text steps. The key is stored encrypted and never shown back to you: the field only says whether one is set. Type a new one and press <strong>Save Key</strong> to replace it; leaving the field blank changes nothing. <strong>Test Key</strong> makes one real call and reports whose key answered, and <strong>Remove Key</strong> clears it. A cohort with no key of its own uses its template's, and the tab says so. See <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>.</p>

<h2>Tremendous</h2>
<p>Connects a Tremendous.com account so Gift Card items send real gift cards: API key, Sandbox or Production mode, currency, default campaign and funding source. See <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>.</p>

<h2>Quick Links</h2>
<p><strong>Classic navigation</strong>, at the top, keeps the top bar and the OPTIONS taskbar players know. Switch it off to give the content the whole screen, with the menu, profile and help controls in the top corners instead.</p>
<p>Below it are the taskbar's shortcut buttons. Switch the built-ins on or off: <strong>Journey</strong>, <strong>Magic Code</strong> (offered when Achievements are on), <strong>Item Shop</strong> (offered when the Item Shop is on), <strong>Feedback</strong> (the deadline extension request form) and <strong>Cooper Support</strong>. Then add up to three <strong>Custom Links</strong>, each with a label, URL, icon and colour, opening in a new tab. See <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a>.</p>

<h2>Images</h2>
<p>Background images for the Adventure as a whole (Default Background) and for the Journey, Item Shop, Backpack, Guilds, Schedule, Blog, Lore, Wall, Leaderboard and My Work screens. Any you don't set are marked <em>System Default</em> or <em>Using Default</em> and fall back to the platform's.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
  <li><a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a></li>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Managing Your Player Roster',
                'slug'       => 'managing-your-player-roster',
                'section'    => 'setup',
                'sort_order' => 45,
                'body'       => <<<'HTML'
<p>Companion to <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>. This covers the day-to-day tools for a roster once people are in. They live on a few screens under Admin Tools.</p>

<h2>Manage Players</h2>
<p><strong>Admin Tools → Manage Players</strong> is the working list of the Adventure's players, in three tabs:</p>
<ul>
  <li><strong>Active</strong> — everyone currently playing, searchable by name, nickname or email, 30 to 500 per page.</li>
  <li><strong>Inactive</strong> — people you've removed. Their progress is kept and comes back if you press <strong>Activate</strong>.</li>
  <li><strong>Add Players</strong> — the CSV import and the one-at-a-time search (see <a href="/docs/enrolling-players-and-roles">Enrolling Players</a>).</li>
</ul>
<p>Every row has two buttons: <strong>Journal</strong> opens that player's Journal in a new tab, and <strong>Records</strong> opens their entries in Player Records (below). The header links to Player Records for the whole Adventure. NPCs see this page view-only.</p>

<h2>Removing a Player</h2>
<p>Press <strong>Remove</strong> and the button changes to <em>Remove?</em>. Press it again to confirm; nothing happens on the first click. The player moves straight to Inactive. <strong>Activate</strong> uses the same two-click confirm, and so does Remove on the Players section of Adventure Settings.</p>

<h2>Changing Roles</h2>
<p>Roles are switched on the <strong>Players</strong> section of Adventure Settings, where each row has a Player / GM / NPC switch. Making someone a GM asks for a second click, and the GM option only appears when your platform allows more than one Game Master. The owner's row can't be changed, and a GM has to be switched back to Player before they can be removed.</p>

<h2>The Players Spreadsheet</h2>
<p><strong>Admin Tools → Players</strong> shows the whole roster as one sortable table: level, XP, BLOO, GPA (when the Adventure grades), last login, your Player Meta fields, and a column for each milestone and achievement. It lists players only until you press <strong>Show GMs &amp; NPCs</strong>. <strong>Export CSV</strong> downloads it, with email addresses included even though they aren't shown on screen.</p>

<h2>Player Meta: Your Own Profile Fields</h2>
<p>Player Meta is a catalogue of fields <em>you</em> define for this Adventure: department, region, job title, grade, homeroom, whatever your program needs. Nothing is fixed, and another Adventure's fields never appear in yours. Manage it on <strong>Admin Tools → Player Meta Manager</strong>.</p>
<ul>
  <li><strong>Add Field</strong> — give it a label and a type: Text, Choice list or Number. For a choice list, enter one option per line, or press <strong>Fill from existing data</strong> to build the list from what's already stored.</li>
  <li><strong>Offer as a Stats segmentation dimension</strong> — lets you break engagement down by this field on the Stats page. Choice lists chart best.</li>
  <li><strong>Show on the leaderboard</strong> — prints the field beside every player's name, where their whole cohort sees it. It's a separate switch on purpose: grouping people in a staff report isn't the same decision as publishing it. At most two fields are shown.</li>
  <li><strong>Status</strong> — Live, or Draft to hide the field from the roster.</li>
</ul>
<p>A field's key is fixed when you create it, so you can rename its label safely: imports and Stats keep matching it. The first four live fields appear as columns in the manager's player list. Click a player to edit all of their values.</p>
<p><strong>The CSV round-trips.</strong> <strong>Export All (CSV)</strong> downloads every player with every field. Edit it and upload it under <strong>Bulk Update via CSV</strong>: <strong>Preview</strong> shows how each column was matched and which player each row belongs to (rows are matched by email), then <strong>Commit Import</strong> applies it. The same file also works as a player import, which matches columns by a field's key or label.</p>

<h2>Player Records</h2>
<p><strong>Admin Tools → Player Records</strong> is where you manage what players have earned and done in this Adventure, in four tabs:</p>
<ul>
  <li><strong>Achievements</strong> — who holds each one, with <strong>Remove from all</strong>, plus an <strong>Award</strong> control to give an achievement to one player.</li>
  <li><strong>Transactions</strong> — purchases and spends. A removed transaction can be restored: switch the view to <em>Removed transactions</em>.</li>
  <li><strong>Milestone Submissions</strong> — removing one is the full milestone reset for that player, so only administrators can do it. GMs get links to review instead.</li>
  <li><strong>Challenge Attempts</strong>.</li>
</ul>
<p>Every tab filters by player, by what the record is about, by status and by search. Remove one row, a selection, or everything matching the filter; each asks for a second click, and the players affected have their totals recalculated. NPCs see the page read-only. In a cohort it shows only that cohort's own records, never the template's.</p>
<p>In an achievement's own editor, the Players tab is a true toggle: click someone who holds it to take it back, or someone who doesn't to award it.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
  <li><a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Customizing Your Taskbar & Adventure Branding',
                'slug'       => 'customizing-taskbar-and-branding',
                'section'    => 'setup',
                'sort_order' => 46,
                'body'       => <<<'HTML'
<p>Two tabs in <strong>Adventure Settings</strong> control what an adventure's frame offers and how it looks: <strong>Quick Links</strong>, the taskbar shortcuts, and <strong>Images</strong>, the backgrounds. Neither changes how anything plays.</p>

<h2>How Players Use the Taskbar</h2>
<p>The bar along the bottom of every adventure screen holds the <strong>OPTIONS</strong> button. Pressing it — or the <strong>Menu</strong> button in the top-left corner, which opens the same menu — brings up the adventure menu, and a row of quick-link buttons appears just above the bar; OPTIONS then reads <strong>CLOSE</strong>. The quick links are what you configure here. <a href="/docs/finding-your-way-around">Finding Your Way Around</a> covers the whole frame from the player's side.</p>

<h2>Classic Navigation</h2>
<p>The <strong>Navigation</strong> section at the top of the Quick Links tab has one switch, <strong>Classic navigation</strong>. On (the default), players get the frame described above: the top bar and the OPTIONS taskbar they already know. Switch it off to give the whole screen to the content: the bar and taskbar go, and the menu, profile and help controls sit in the top corners instead. Pick whichever suits your adventure; it's a matter of taste, not function.</p>

<h2>Built-In Quick Links</h2>
<p>The <strong>Quick Links</strong> tab lists five built-in buttons, each with an on/off toggle. All five start switched on, and a link you switch off doesn't show for anyone.</p>
<ul>
  <li><strong>Journey</strong> — back to the map or list.</li>
  <li><strong>Magic Code</strong> — opens the <em>Redeem a code</em> box. Its toggle only appears when <strong>Achievements</strong> is switched on, and the button only shows when <strong>Magic Codes</strong> is on as well.</li>
  <li><strong>Item Shop</strong> — needs the <strong>Item Shop</strong> feature.</li>
  <li><strong>Feedback</strong> — opens the <strong>Deadline extension request</strong> form: which module, the date the player needs until, and why. Requests arrive in Player Requests (see <a href="/docs/managing-player-support-requests">Managing Player Support Requests</a>), and players follow theirs under My Requests.</li>
  <li><strong>Cooper Support</strong> — opens Cooper, the in-app AI assistant. It only appears where Cooper is available for the adventure. Cooper can wear a character of your own — a name, picture, button icon, greeting and personality, set on the adventure's Cooper tab — and the button then shows that icon, with "Ask" and the character's name as its tooltip. See <a href="/docs/getting-help-support-and-chat">Getting Help</a>.</li>
</ul>

<h2>Custom Links</h2>
<p>Below the built-ins you can add up to <strong>three custom buttons</strong>. Each has:</p>
<ul>
  <li>an on/off toggle;</li>
  <li><strong>Label</strong> — shown when a player hovers over the button, since the button itself is an icon;</li>
  <li><strong>URL</strong> — opens in a new tab;</li>
  <li><strong>Icon</strong> — an image from the media library. Without one, the button shows a plain link icon;</li>
  <li><strong>Color</strong> — the button's background.</li>
</ul>
<p>A custom button only appears when it's switched on <em>and</em> has a URL. Typical uses: your organization's own support channel, an intranet page, a booking link.</p>

<h2>Support Email</h2>
<p>The <strong>Email Support</strong> button in the top-right corner writes to the adventure's <strong>Custom Support Email</strong> (on the Features tab) when you've set one, and to the platform's default support address otherwise.</p>

<h2>Images</h2>
<p>The <strong>Images</strong> tab sets a background for each section of the adventure. A tile you haven't set shows the image the platform uses instead.</p>
<ul>
  <li><strong>Default Background</strong> — every page that doesn't have its own below.</li>
  <li><strong>Journey Background</strong> — the map, and also the Journey Builder and Scene Builder, so you design against the real backdrop.</li>
  <li><strong>Item shop</strong>, <strong>Backpack</strong>, <strong>Guilds</strong>, <strong>Schedule</strong>, <strong>Wall</strong> and <strong>Leaderboard</strong> backgrounds.</li>
  <li><strong>Blog Background</strong> (Posts) and <strong>Lore Background</strong> (Resources).</li>
  <li><strong>My Work Background</strong> — the player's Journal.</li>
</ul>
<p>A background can also be a video: pick an MP4, WebM or Ogg file and it plays on a loop behind the page.</p>

<h2>Names and Labels</h2>
<p>What sections are called — Journey, Item Shop, Posts, Tasks and the rest — is set once for the whole platform, in Sys Config's Custom Labels, not per adventure; see <a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a>. The names of XP, BLOO and EP <em>are</em> per adventure; see <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>.</p>

<h2>Templates and Cohorts</h2>
<p>An adventure created from a template takes its quick links, images and support email from the template — its menu's <strong>Template Settings</strong> opens the template's own settings. To theme a set of cohorts, set it up once on the template. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the frame from the player's side</li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a> — Cooper and the support options</li>
  <li><a href="/docs/managing-player-support-requests">Managing Player Support Requests</a></li>
  <li><a href="/docs/complete-adventure-settings-reference">The Complete Adventure Settings Reference</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'GM Toolkit: Duplicator, Player Records & Resets',
                'slug'       => 'gm-toolkit-duplicator-reports-and-bulk-actions',
                'section'    => 'setup',
                'sort_order' => 47,
                'body'       => <<<'HTML'
<p>The tools a GM reaches for once an Adventure is built: copying content, copying whole Adventures, fixing one player's run of a milestone, managing records, and finding things fast.</p>

<h2>Duplicator</h2>
<p><strong>Admin Tools → Duplicator</strong> copies content from this Adventure into another one, or into itself. It lists milestones with all their steps, challenges with their questions, posts, resources, achievements, Tabis, items, encounters, speakers, tasks, guilds and missions. Tick what you want (each section has <strong>All</strong> and <strong>None</strong>, and the header counts what's selected), choose the target under <strong>Duplicate into</strong> in the bar at the bottom, and press <strong>Duplicate Selected</strong>. A confirmation names the destination and counts what's going before anything copies.</p>
<p>Copies are independent: new ids, no player data, and nothing in the source changes. A few things are adjusted on the way:</p>
<ul>
  <li><strong>Guilds</strong> arrive empty. Members and XP aren't copied, and each guild gets a new join code.</li>
  <li><strong>Missions</strong> keep achievement and path audiences. A guild audience follows only if that guild is copied in the same run, named players are dropped, and a mission left with no audience arrives as a draft instead of going out to everyone.</li>
  <li><strong>Tasks</strong> get a new QR code. A task completed by a specific milestone keeps that trigger when the target can play the milestone, as a cohort of the same template can.</li>
  <li><strong>Encounters</strong> copied into another Adventure arrive without their milestone, group and conditions, ready to attach there.</li>
</ul>
<p>The Duplicator is a one-time copy, which is different from a template and its cohorts: those share content live. To bring guilds and missions into a cohort, open the Duplicator on the template and pick the cohort as the target. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</p>

<h2>Duplicating a Whole Adventure</h2>
<p>On <strong>Manage Adventures</strong>, <strong>Duplicate</strong> makes a full, independent copy of an Adventure: its own milestones, achievements, items, guilds and Tabis, with every reference between them remapped and no player data. A dialog confirms before it runs, and the copy opens in Adventure Settings, named after the original with <em>(Copy)</em> on the end. Editing it never touches the original. To copy a program run as a template, duplicate the template, not a cohort: the content lives on the template.</p>

<h2>Resetting One Player's Milestone</h2>
<p>When one player needs to run a milestone again (a challenge with its attempts used up, a SCORM package stuck mid-run, a case study that won't allow a retake), an administrator can reset that milestone for that player alone. Open the player's Journal (the <strong>Journal</strong> button on Manage Players) and press <strong>Reset</strong> next to the milestone. Milestones the player has started without handing anything in have their own list, <strong>Started, not submitted</strong>, with the same button.</p>
<p>Before anything happens, <strong>Reset milestone</strong> lists exactly what will be removed, with counts, taken from the same list the reset then runs. Press <strong>Reset it</strong> to go ahead. There's no undo. The activity log is kept and records the reset, uploaded files stay on disk, and a task the milestone happened to trigger, or an achievement earned through a condition rather than as the milestone's own reward, is left alone.</p>
<p>This is for administrators, not GMs, because it deletes part of a player's record. Removing a submission in Player Records runs the same reset.</p>

<h2>Player Records</h2>
<p><strong>Admin Tools → Player Records</strong> manages what players hold in this Adventure: achievements (with Award and Remove from all), transactions (removable and restorable), milestone submissions and challenge attempts. Every tab filters by player, subject, status and search, and removes one row, a selection or everything matching. See <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>.</p>

<h2>Finding Things in Manage Content</h2>
<p>Every tab of Manage Content has the same header and toolbar: a search box plus whichever filters make sense for that tab. Type buttons appear only for types the Adventure actually has (item types; badge, rank or path; encounter kinds; task triggers; and so on), and guilds filter by group instead. Every filter combines with the others. Items and guilds you've set to draft have their own Drafts list. The Requests tab keeps its own status filters, and the Dashboard tab, first in the row, shows what the Adventure holds and whether it's running.</p>

<h2>The Milestone Funnel</h2>
<p>From the Stats page, <strong>See the full funnel</strong> opens the Milestone Funnel: a drop-off chart you can narrow to one Tabi or one level, beside how many players are enrolled, what share have logged in, and what share were active in the last 7 days. It's the fastest way to spot the one milestone that's quietly losing everyone. See <a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
  <li><a href="/docs/activity-logs">Activity Logs</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Managing Player Support Requests',
                'slug'       => 'managing-player-support-requests',
                'section'    => 'setup',
                'sort_order' => 48,
                'body'       => <<<'HTML'
<p>The GM side of the requests players send from the taskbar (see <a href="/docs/getting-help-support-and-chat">Getting Help</a>). They land in <strong>Admin Tools → Player Requests</strong>, which is also the Requests tab of Manage Content.</p>
<p>Most requests are deadline extensions now, because that's what the player's form asks for. Each one names the module, opens with the date the player is asking for (<em>Extension requested until:</em> followed by the date) and gives their reason.</p>

<h2>Reading the Queue</h2>
<p>Each request is a card: the player's picture, name and email, the subject, when it was sent, its status and the full message. Use the search box to find a player or a module, and the status buttons to narrow the list: <strong>All</strong>, <strong>Pending</strong>, <strong>Read</strong>, <strong>Resolved</strong> and <strong>Dismissed</strong>, each with its count. The list shows the 200 most recent requests; the counts are always the true totals.</p>

<h2>Acting on a Request</h2>
<ul>
  <li><strong>Mark Read</strong> — you've seen it and you're on it.</li>
  <li><strong>Resolve</strong> — dealt with.</li>
  <li><strong>Dismiss</strong> — you won't be acting on it.</li>
  <li><strong>Reopen</strong> — puts a resolved or dismissed request back to Pending.</li>
</ul>
<p>Before you press one, you can type an <strong>Admin note</strong> in the box on the card. It's saved with the status change, and the player sees it on their My Requests page as the admin response. Tell them yes, no, or what happens next.</p>
<p>A request is only a message. Resolving it doesn't change any dates by itself; granting the extension is up to you.</p>

<h2>A Rhythm That Works</h2>
<p>Nothing is emailed when a request arrives or changes, so check the queue regularly. Treat it like any support queue: skim what's new, act on it, then mark it Resolved or Dismissed with a note, so Pending stays a true "still needs attention" list rather than a graveyard of old tickets.</p>
<p>NPCs can read every request but can't change a status or write a note.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Meet "Launch Week" — Our Running Example Adventure',
                'slug'       => 'meet-launch-week-example-adventure',
                'section'    => 'setup',
                'sort_order' => 49,
                'body'       => <<<'HTML'
<p>Several pages in this manual reference the same fictional adventure, so examples stay consistent instead of jumping between unrelated scenarios each time.</p>

<h2>The Brief</h2>
<p><strong>Launch Week</strong> is a two-week new-hire onboarding Adventure for a mid-sized company: forty new hires across three departments, starting the same Monday, with an in-person orientation day midway through Week One.</p>

<h2>What It Uses</h2>
<ul>
  <li>Two Tabis, "Week One: Company Basics" and "Week Two: Department Deep-Dive", with Week Two locked until Week One is finished</li>
  <li>A mix of Milestones and two Challenges</li>
  <li>Choose Nickname, Dialogue, Video, Open Text, Upload Image, Multiple Choice, Rating Scale and Branch Choice steps</li>
  <li>The CEO set up once as a speaker, so she's the same character in the dialogue and on the orientation-day schedule</li>
  <li>A short working-style profile test, its questions spread through Week One's milestones</li>
  <li>A three-tier Rank ladder (New Hire → Onboarded → Launch-Ready) and a small Item Shop</li>
  <li>Three department Guilds with a shared leaderboard</li>
  <li>A Branch Choice into Engineering / Sales / Operations tracks</li>
  <li>An event schedule for orientation day, and a QR code at the door that awards an "Attended Orientation" badge</li>
  <li>A "Launch-Ready" certificate that unlocks when its conditions are met</li>
  <li>Announcements at kickoff and at the Week Two handoff</li>
</ul>

<p>The full build, in order, is documented in <a href="/docs/worked-example-two-week-onboarding-adventure">Worked Example — Building a Two-Week Onboarding Adventure End to End</a>. Other pages in this manual reference Launch Week in passing to illustrate a specific feature in context.</p>
HTML,
            ],
            [
                'title'      => 'Worked Example — Building a Two-Week Onboarding Adventure End to End',
                'slug'       => 'worked-example-two-week-onboarding-adventure',
                'section'    => 'setup',
                'sort_order' => 50,
                'body'       => <<<'HTML'
<p>Everything above in one build. This walks through designing "Launch Week", a two-week new-hire onboarding Adventure for a mid-sized company, touching nearly every feature covered in this guide in the order a Game Master would actually reach for them.</p>

<h2>The Brief</h2>
<p>Forty new hires across three departments, starting the same Monday. Goal: get everyone through company basics, department-specific training, and one in-person orientation day, with enough structure that HR can see who's on track without babysitting anyone.</p>

<h2>Day 1 — The Map &amp; the First Milestones</h2>
<p>Start from a blank Adventure rather than a template; this program is specific enough to build fresh. Lay out the Journey Map in two Tabis, "Week One: Company Basics" and "Week Two: Department Deep-Dive", and give Week Two a prerequisite so it stays locked until Week One is finished (see <a href="/docs/tabi-editor">The Tabi Editor</a>). Add a welcome Milestone first ("Welcome to the Company"): pure delivered content, zero friction on day one.</p>

<h2>Building the Steps</h2>
<p>Inside the welcome Milestone: a <strong>Choose Nickname</strong> step, a <strong>Dialogue</strong> step introducing the CEO, and a <strong>Video</strong> step touring the office. The CEO is set up once as a speaker, so every line she speaks, here and later in the program, carries the same name and portrait, and she appears on the orientation-day schedule as well (see <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>). The second Milestone, "Tell Us About You", uses an <strong>Open Text</strong> step with a 50-word minimum plus an <strong>Upload Image</strong> step for a profile photo. A short <strong>Challenge</strong> on company policy follows: a real question bank with a pass threshold, not a Milestone.</p>

<h2>A Profile Test, Woven In</h2>
<p>HR wants to know how each new hire likes to work, without handing them a questionnaire on day one. So the GM switches on Profile Tests in the adventure's Features, creates a "Working Style" profile with four traits on Manage Content's <strong>Profiles</strong> tab, and spreads its questions through Week One: three <strong>Agree / Disagree Scale</strong> steps inside "Tell Us About You", and three more in the end-of-week check-in. Nothing marks them as a test; they read as part of getting to know the company. A <strong>Profile Result</strong> step at the end of the check-in shows each new hire their reading, and it stays in their Journal's Profiles tab afterwards. See <a href="/docs/profile-tests">Profile Tests</a>.</p>

<h2>Rewards, Ranks &amp; the Shop</h2>
<p>Every Milestone pays XP and a little BLOO. Three Ranks on the adventure's rank ladder (New Hire → Onboarded → Launch-Ready) are each awarded automatically at a level threshold. The Item Shop carries a handful of <strong>Consumable</strong> perks that HR honours in person, like a coffee with the CEO or first pick of the desk plants, which a new hire marks as used from their Backpack. The end-of-week check-in also hands out a <strong>Reward</strong> item, a cosmetic company-swag badge. Nothing that trivializes the actual content.</p>

<h2>Guilds by Department</h2>
<p>All forty new hires come in through the player CSV import, whose Guild column puts each person straight into their department's guild: three guilds, with capacity roughly even (see <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>). A department-level leaderboard turns "finish onboarding" into a bit of friendly competition without pitting individuals against each other.</p>

<h2>The Branch: Choose Your Track</h2>
<p>Week Two opens with a <strong>Branch Choice</strong> step: Engineering, Sales, or Operations. The choice is permanent, and every Milestone from that point on is gated to the matching track, so nobody wades through training content irrelevant to their actual role.</p>

<h2>The In-Person Checkpoint (QR Code)</h2>
<p>Wednesday of Week One is an in-person orientation day. Its three sessions (a welcome talk, a benefits walkthrough and a team lunch) go on the <a href="/docs/event-schedule-concept">Event Schedule</a> with their rooms, so the schedule doubles as the day's agenda. Attendance is an "Attended Orientation" achievement whose QR code is printed at the door: scan on the way in, badge earned, no submission required. The GM asks everyone to log in on their phone the day before, because a scan from a logged-out phone has to be repeated after signing in. See <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>.</p>

<h2>Keeping It Alive Week Two</h2>
<p>The GM posts an <a href="/docs/announcements-keeping-an-adventure-alive">announcement</a> on the Wall the day Week Two opens, and a second one midway through calling out the department leaderboard standings. Open Text steps in Week Two check each answer with A.I. before the new hire continues, so HR is reviewing already-revised answers instead of first drafts (see <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>).</p>

<h2>The Finish Line: A Certificate</h2>
<p>Onboarding should end with something a new hire can keep. A "Launch-Ready" certificate, created on Manage Content's <strong>Certificates</strong> tab, carries the company logo and the Head of People's signature, and it unlocks on two conditions: <strong>Complete This Tabi</strong> set to Week One, and <strong>Level</strong> set to the level that awards the Launch-Ready rank. Until both are met it sits locked on each new hire's Achievements page, listing exactly what's still missing ("Reach level 6 — you're at level 4"). Once they are, it opens, ready to print. See <a href="/docs/certificates-authoring">Certificates for GMs</a> and <a href="/docs/conditions-when-things-unlock">Conditions</a>.</p>

<h2>What Shipped</h2>
<p>Two Tabis, roughly a dozen Milestones plus two Challenges, around a dozen different Step types, a rank ladder, three guilds, a small shop, one branch, a profile test spread across Week One, an orientation-day schedule with one QR check-in, a certificate gated by conditions, and two announcements: built and published before the Monday start date, ready to hand off to HR without a single line of code.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/meet-launch-week-example-adventure">Meet "Launch Week"</a></li>
  <li><a href="/docs/certificates-authoring">Certificates for GMs</a></li>
  <li><a href="/docs/profile-tests">Profile Tests</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/qr-codes-live-and-hybrid-events">QR Codes — Live &amp; Hybrid Event Checkpoints</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Organizations: Managing Multiple Adventures at Scale (Enterprise)',
                'slug'       => 'organizations-managing-multiple-adventures',
                'section'    => 'setup',
                'sort_order' => 51,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> An Organization groups one client's Adventures and people under a single name. It's built for a customer running several programs, departments or cohorts who wants them filed together rather than as unrelated Adventures.</p>

<h2>How Organizations Fit Together</h2>
<ul>
  <li><strong>An Adventure belongs to exactly one Organization.</strong> The app refuses to attach an Adventure that's already in another one.</li>
  <li><strong>People reach an Organization through its Adventures.</strong> A person can be part of two Organizations (two clients, one Adventure each) without anything being shared between them.</li>
  <li><strong>Cohorts follow their template.</strong> A cohort built from a template that sits in an Organization is filed under that same Organization.</li>
</ul>

<h2>Creating an Organization</h2>
<p>Organizations are created by a platform administrator, from <strong>Sys Config &gt; Organizations &gt; New Organization</strong> (admins also get a New Organization link in the menu). The same list has an <strong>Edit</strong> button for each existing Organization. An Organization can be managed by platform administrators and by its owner.</p>

<h2>General</h2>
<p>The Organization's name, logo, brand colour and an About text. Save with <strong>Save Organization</strong>.</p>

<h2>Players</h2>
<p>Add people to the Organization by email: type it into <strong>Add Players to the org</strong> and choose <strong>Find Player</strong>. Each person's role in the Organization is recorded as <strong>Player</strong>, <strong>GM</strong> or <strong>NPC</strong>, and a search box filters the list. What someone can do inside a particular Adventure still comes from that Adventure's own roster (see <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>).</p>

<h2>Adventures</h2>
<p>Search for an Adventure and attach it to the Organization, or remove one. The search only offers Adventures that aren't in any Organization yet, so there's no way to steal another client's Adventure by accident. Each attached Adventure is listed with its enrollment link.</p>

<h2>On the Roadmap</h2>
<p>These are planned but <strong>not available yet</strong>, so don't plan a rollout around them:</p>
<ul>
  <li><strong>Cross-Adventure Stats</strong>: one analytics view across every Adventure in the Organization. Until it lands, use each Adventure's own <a href="/docs/stats-dashboard-guide">Stats page</a>.</li>
  <li><strong>Bulk adding people</strong>, either from an existing Adventure's roster or by CSV, at the Organization level. For now, add people through each Adventure's own CSV import (see <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>).</li>
  <li>Removing a person from an Organization, and deleting an Organization.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a></li>
  <li><a href="/docs/user-management-and-access-levels">User Management &amp; Access Levels</a></li>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Platform Settings & White-Label Branding (Enterprise)',
                'slug'       => 'platform-settings-and-white-label-branding',
                'section'    => 'setup',
                'sort_order' => 52,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> Beyond each Adventure's own settings there's a platform-wide console, <strong>Sys Config</strong>, that shapes how BLUERABBIT looks and behaves across every Adventure on your platform. Only platform administrators (the God and Admin access levels) can open it; a GM running one Adventure never sees it.</p>

<p>Sys Config is one long page with a sticky row of section buttons along the top. Here's what each section is for.</p>

<h2>General and Profile</h2>
<p>Platform defaults and rules: whether registration is open, restricting sign-up to one email domain, the default Adventure new accounts land in, the default support email, whether accounts may create Adventures (from scratch and from a template), whether an Adventure may have several GMs, public Adventures, the default theme, and the <strong>Default Journey View</strong> (whether a player's first visit opens the Journey as a Map or a List). Profile holds the default language and whether players see the <strong>Anonymize Me</strong> privacy button.</p>

<h2>Custom Labels: White-Labeling Your Instance</h2>
<p>Rename every player-facing section platform-wide: Journey, Item Shop, Backpack, Tabis, Guilds, Garden, Tasks, Journal, Leaderboard, Posts, Resources, Secrets and Clues, Schedule, Speakers, Wall, Achievements and the Magic Code button. The new names are used across the menus and pages. Combined with per-Adventure currency names (see <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>), this is how BLUERABBIT ends up speaking your organization's vocabulary instead of ours.</p>

<h2>Images: Platform-Wide Branding</h2>
<p>The main logo, the login screen's logo and background, the favicon, the default background, and a default background for each section (Journey, Item Shop, Backpack, Guilds, Schedule, Posts, Resources, Wall, Leaderboard, Journal). Every Adventure uses these unless it sets its own (see <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Adventure Branding</a>).</p>

<h2>Features and Plans</h2>
<p><strong>Features</strong> manages the catalogue of features available to plans. <strong>Plans</strong> lists every plan with how many accounts are on it, each plan's storage allowance, and the default plan each kind of account gets. See <a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a>.</p>

<h2>Email</h2>
<p>The email service, the sender name and address, and the logo and colours used in the app's emails.</p>

<h2>Security and SSO</h2>
<p>Human verification on login, registration and password reset, upload size limits, SVG handling, and login rate limits, plus Single Sign-On with Microsoft Entra ID. These have their own page: <a href="/docs/security-and-single-sign-on">Security &amp; Single Sign-On</a>.</p>

<h2>Cooper</h2>
<p>The master switch for Cooper, the in-app AI assistant, across every Adventure, the platform's API key, and the model Cooper runs on. <strong>Character</strong> sets the platform default for who Cooper is: a name, a picture, a button icon, a greeting and a personality. Each Adventure can override the character on its own Cooper tab. A personality changes the voice, never the rules: whatever it's called, the assistant still won't hand out answers.</p>

<h2>Billing</h2>
<p>The Stripe connection behind Subscription &amp; Billing (see <a href="/docs/billing-and-plans">Billing &amp; Plans</a>).</p>

<h2>Organizations</h2>
<p>The list of Organizations on the platform, with <strong>New Organization</strong> and an Edit button for each. See <a href="/docs/organizations-managing-multiple-adventures">Organizations</a>.</p>

<h2>Stored Settings</h2>
<p>A housekeeping report. It lists settings stored in the database that no screen uses any more (usually left behind by a retired feature), with where each one lives and why it's there. On a clean platform it simply says everything matches.</p>

<h2>Who Can Access This</h2>
<p>Sys Config is restricted to platform administrators on purpose. If you're an Enterprise customer and don't have access yet, that's a setup step for your account, not something missing from the product. Access levels are managed in <a href="/docs/user-management-and-access-levels">User Management</a>.</p>
HTML,
            ],
            [
                'title'      => 'How Plan Tiers Actually Differ (Enterprise)',
                'slug'       => 'understanding-plans-basic-pro-enterprise',
                'section'    => 'setup',
                'sort_order' => 53,
                'body'       => <<<'HTML'
<p>Prices and billing mechanics are covered in <a href="/docs/billing-and-plans">Billing &amp; Plans</a>. This page is about what actually changes as you move up a tier.</p>

<h2>Basic to Pro: More Room</h2>
<p>The step up is about capacity, and it's the same three numbers on every plan:</p>
<ul>
  <li><strong>Basic</strong>: up to 90 players across your account, 3 Adventures, 50MB of storage. Free.</li>
  <li><strong>Pro</strong>: up to 250 players across your account, 20 Adventures, 200MB of storage. $8/mo or $80/yr, with a 30-day trial.</li>
  <li><strong>Enterprise</strong>: no player, Adventure or storage limits.</li>
</ul>
<p>Pro raises all three caps; Enterprise removes them. If you're outgrowing Basic, Pro is a self-serve upgrade from Subscription &amp; Billing in the app. No sales conversation is needed.</p>
<p>Storage is the limit the app enforces today, per account. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for exactly what counts toward it.</p>

<h2>Pro to Enterprise: Less About Feature Toggles, More About Scale</h2>
<p>Enterprise isn't a long checklist of features locked away from Pro customers. It's built around running <strong>many Adventures as one managed relationship</strong>, and the setup work that comes with that at real scale:</p>
<ul>
  <li><a href="/docs/organizations-managing-multiple-adventures">Organizations</a> to file a client's Adventures and people together</li>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform-wide branding and Custom Labels</a>, so the whole platform speaks your vocabulary</li>
  <li><a href="/docs/security-and-single-sign-on">Single Sign-On</a> with Microsoft Entra ID, set up with our team</li>
  <li>Player Meta fields for HR and roster data, used to segment Stats (see <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>)</li>
</ul>
<p>Enterprise is <strong>sales-assisted rather than self-serve</strong>. There's no Subscribe button for it, because onboarding usually means setting up Organizations, importing rosters and configuring branding together with our team. <a href="/contact">Reach out</a> if that's where you're headed.</p>

<h2>What This Means for You Right Now</h2>
<p>If you're running a handful of Adventures, Basic or Pro covers you. The moment you're coordinating many Adventures under one paying relationship (multiple departments, cohorts or locations), that's the real signal to talk to us about Enterprise, not any single feature you're missing.</p>
HTML,
            ],
            [
                'title'      => 'User Management & Access Levels (Enterprise)',
                'slug'       => 'user-management-and-access-levels',
                'section'    => 'setup',
                'sort_order' => 54,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> <strong>User Management</strong> is the platform administrator's view of every account on the platform: who they are, what they can do, what they're paying for, and which Adventures they're in. Only God and Admin accounts can open it.</p>

<h2>Access Levels vs Adventure Roles</h2>
<p>These are two different things, and mixing them up is the most common source of "I gave them access and nothing happened":</p>
<ul>
  <li><strong>An access level</strong> is account-wide and set here. It decides what someone can do on the platform as a whole.</li>
  <li><strong>An Adventure role</strong> (player, GM or NPC) is per Adventure, set on that Adventure's Manage Players screen. It decides what someone can do inside that one Adventure. See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</li>
</ul>
<p>The access levels are:</p>
<ul>
  <li><strong>God</strong>: full platform-wide access, including Sys Config and this page.</li>
  <li><strong>Admin</strong>: the same platform-wide powers as God.</li>
  <li><strong>Staff</strong>: no platform-wide powers, but can be chosen as an Adventure's owner.</li>
  <li><strong>Player</strong>: the standard account. Everything it can reach comes from the Adventures it's enrolled in.</li>
</ul>
<p>There is also a legacy <strong>NPC</strong> tier with no platform-wide powers, kept for older accounts.</p>

<h2>Finding Accounts</h2>
<p>The list is paged and searchable by email, nickname, name or account number. Filter by access level (each chip shows a live count), status and plan, plus a billing filter: has a Stripe customer, a subscription state (active, trialing, past due, canceled) or never subscribed. Sorting and paging keep your filters. <strong>Export CSV</strong> downloads exactly what the current filters show.</p>

<h2>Editing an Account</h2>
<p>Click an account to open its drawer. From there you can:</p>
<ul>
  <li>Change the account's <strong>access level</strong> and <strong>status</strong> (active or suspended).</li>
  <li>Override its <strong>plan</strong>, and see its storage meter.</li>
  <li><strong>Set a password</strong> directly.</li>
  <li>See every subscription the account has had, and its Stripe invoice history with links to each invoice.</li>
  <li>See its role and standing in each Adventure, with a link to that Adventure's own Manage Players screen, and its recent in-game transactions.</li>
</ul>

<h2>Changes Take Effect Immediately</h2>
<p>A promotion or a suspension applies on the person's <strong>next page load</strong>. They don't need to log out and back in, and a suspended account's open session ends on its next click.</p>

<h2>Safety Rails</h2>
<ul>
  <li>Only a God can grant or remove God.</li>
  <li>Nobody can change their own access level or status, so you can't lock yourself out of the screen that would undo it. Ask another administrator.</li>
  <li>The last active God or Admin can't be demoted or suspended by anyone.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a></li>
  <li><a href="/docs/security-and-single-sign-on">Security &amp; Single Sign-On</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Security & Single Sign-On (Enterprise)',
                'slug'       => 'security-and-single-sign-on',
                'section'    => 'setup',
                'sort_order' => 55,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> Platform administrators control how people sign in and what can be uploaded, from the <strong>Security</strong> and <strong>SSO</strong> sections of Sys Config.</p>

<h2>Human Verification (Cloudflare Turnstile)</h2>
<p>Login, registration and password reset are protected by Cloudflare Turnstile, a lightweight check that tells people from bots, usually without asking anyone to solve a puzzle. It's switched on for the hosted platform. On your own platform, it's configured with a site key and a secret key on the Security tab; the secret is stored encrypted and never shown back.</p>

<h2>Rate Limits</h2>
<p>Repeated failed logins, password-reset requests and registrations are slowed down. Login attempts are counted <strong>per account</strong>, so one person guessing at a password can't lock out an entire office sharing one internet connection, with a looser per-connection limit alongside to catch mass attacks. A successful login clears its own count. Each limit can be tuned, or set to 0 to switch it off.</p>

<h2>Upload Limits and SVG Handling</h2>
<p>Three per-file ceilings, because one number can't suit all three kinds of file:</p>
<ul>
  <li>images, audio and CSV files (10MB by default)</li>
  <li>video (50MB by default)</li>
  <li>SCORM packages (100MB by default)</li>
</ul>
<p>These sit alongside each account's plan storage allowance (see <a href="/docs/billing-and-plans">Billing &amp; Plans</a>). SVG images are cleaned as they're uploaded: anything that could run code is stripped, a normal design-tool export comes through unchanged, and the uploader is told if something was removed. SVG uploads can also be switched off entirely.</p>

<h2>Single Sign-On with Microsoft Entra ID</h2>
<p>BLUERABBIT supports <strong>SAML Single Sign-On with Microsoft Entra ID</strong> (formerly Azure AD), so your people sign in with their work account instead of a separate password. It's <strong>available on request</strong> for Enterprise and set up per platform together with our team. It's off until then, and while it's off none of the sign-on endpoints exist.</p>
<p>Once it's on:</p>
<ul>
  <li><strong>The login page shows a sign-in button</strong> for your organization (you choose its label).</li>
  <li><strong>Accounts are created on first sign-in</strong> from the name and email Entra sends, and land in the default Adventure you pick.</li>
  <li><strong>Accounts are matched on the work identity, not the email address.</strong> An existing account with the same email is linked rather than duplicated; an account already linked to a different identity is refused, never guessed.</li>
  <li><strong>Suspended accounts stay out.</strong> Suspending someone in User Management blocks their sign-on too, and doesn't create them a fresh account.</li>
</ul>

<h3>Enforcing SSO</h3>
<p>You can require Single Sign-On, which hides the password form for everyone. Enforcement only takes effect once the Entra details are actually filled in, so switching it on early can't lock anyone out. <strong>God and Admin accounts are the break-glass</strong>: they can always sign in with a password, so an outage at the identity provider never leaves the platform without an administrator.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/user-management-and-access-levels">User Management &amp; Access Levels</a></li>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a></li>
</ul>
HTML,
            ],
            // ---------------------------------------------------------
            // Developer docs — gated to site admins/collaborators
            // ---------------------------------------------------------
            [
                'title'      => 'Self-Hosting & Deployment',
                'slug'       => 'self-hosting-and-deployment',
                'section'    => 'developer',
                'sort_order' => 1,
                'body'       => <<<'HTML'
<p>How a BLUERABBIT instance is installed, how schema changes reach a server, and the rule that keeps environments from drifting. This describes the CI4 app (the <code>blue</code> repository); its own <code>CLAUDE.md</code> is the authority if the two ever disagree.</p>

<h2>The Rule: Structure Travels, Content Doesn't</h2>
<p>Only the <strong>schema</strong> (tables, columns, indexes) is kept in step between environments. <strong>Content</strong> (Adventures, milestones, steps, achievements, skills, encounters, tasks, items, profiles, players) belongs to the environment it was made in and stays there. A local test Adventure is a local test Adventure forever.</p>
<ul>
  <li>Don't build sync tooling, export/import pipelines or "push content to live" features.</li>
  <li>If a report on live data is needed, download the live database and work on that snapshot.</li>
</ul>

<h2>Fresh Install: <code>/install</code></h2>
<p>A new clone builds its own database through the web installer:</p>
<ol>
  <li>Clone the repository, point the web server's document root at <code>public/</code>, and run <code>composer install</code>.</li>
  <li>Open the site. Every page redirects to <code>/install</code> until the platform has its first account.</li>
  <li>If the database already connects, the installer skips straight to creating the owner account. If the server is reachable but the database is missing, it creates the database where the MySQL account is allowed to, and otherwise tells you where to create it.</li>
  <li>It builds the full schema and creates the owner account as <strong>God</strong> (only a God can grant God, so an installer that made an Admin would leave nobody able to make the next one).</li>
</ol>
<p>The installer <strong>merges</strong> the few <code>.env</code> keys it needs rather than replacing the file, and reuses an existing <code>encryption.key</code>. Never regenerate that key on a database that already holds secrets: every stored API key (email, Stripe, Turnstile, SSO, gift cards, Cooper) would be orphaned, silently. If <code>.env</code> isn't writable, the installer shows the file for you to paste and stops there.</p>
<p>"Installed" means the players table has a row, not merely that tables exist, so running the migrations by hand still leaves the installer available to create the first account. Once an account exists, <code>/install</code> redirects to the login page.</p>
<p>The installer deliberately doesn't configure Turnstile, SSO or email. Those are set afterwards in Sys Config.</p>

<h2>Getting a Schema Change Live</h2>
<p>From the project root on the server (the folder that contains <code>public/</code>):</p>
<ol>
  <li><code>php tools/migrate.php</code>: a dry run that reports what's pending and writes nothing.</li>
  <li><code>php tools/migrate.php --apply</code>: applies the structure changes.</li>
</ol>
<p>That's the whole answer. Only if a feature ships optional starting content is there a third step: a per-Adventure seeder the operator runs deliberately, for example <code>php tools/seed-&lt;thing&gt;.php --adventure=N --apply</code>.</p>
<p>Every <code>tools/</code> script prints the database name and host it connected to before it does anything. Read it before an <code>--apply</code> on production. Credentials come from the server's own <code>.env</code>, which is never part of a deploy. <code>tools/</code> sits outside <code>public/</code>, so none of these scripts can be reached by URL.</p>

<h2>A Push Is Not a Deploy</h2>
<p>Pushing to <code>main</code> puts code on GitHub and on <strong>no server</strong>. Automatic deploys are parked, and the deploy workflow only runs on demand. Getting a change live is: bring the code onto the server, then run the two migrate commands above. Never report work as "deployed" because it was pushed.</p>

<h2>Files Git Doesn't Own</h2>
<p><code>.env</code>, <code>writable/</code> and the upload folders (media, QR codes, SCORM) are all gitignored, so updating the code never touches what users uploaded or the server's credentials. Keep it that way.</p>

<h2>Production Checklist</h2>
<ul>
  <li>Carry the <code>encryption.key</code> across when moving a database between servers.</li>
  <li>Set <code>CI_ENVIRONMENT</code> to <code>production</code>, force HTTPS, and mark cookies secure.</li>
  <li>Firewall the origin so only Cloudflare can reach it.</li>
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
