<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Upserts by slug (update if it exists, insert if it doesn't) so re-running
 * this after an edit actually refreshes content instead of silently
 * skipping — unlike BlogPostSeeder, which is insert-only.
 *
 * Last synced to the CI4 app (blue) on 2026-11-15, against blue@463a356
 * (previous syncs: 2026-10-27, blue@dbb5c05, a hash the app's 2026-10-30
 * history rewrite removed, by date blue@0dfb3a8; 2026-09-21, blue@6e5a454).
 * See claude-notes/BUILD-STATUS.md for what changed in each pass, and
 * /docs/developer/keeping-the-docs-in-sync for how a sync is done.
 *
 * A page this seeder owns is overwritten here on every run: an edit made in
 * /admin/docs to one of these slugs does not survive the next seed.
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
            // 2026-10-27 and 2026-11-15 syncs: no slugs retired. The two
            // developer pages from the first build (architecture-overview,
            // routes-and-api-reference) are now owned and rewritten here.
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
<p>BLUERABBIT wraps your learning content in a real game engine: a Journey Map of milestones, a reward system built on XP, BLOO and (when it's switched on) EP, achievements, and Guilds. Those are the default names: your Game Master can rename all three currencies, so your adventure may call them something else. You place two things on that map: <strong>Milestones</strong> (content that gives players knowledge) and <strong>Challenges</strong> (quizzes that test it). Milestones are built from 31 reusable Step types in six groups: dialogue, video, slides, picture galleries, open text, puzzles, uploads, SCORM packages, branching choices, choice boards, profile questions and more.</p>

<p>Three things set it apart from a course platform with badges bolted on:</p>
<ul>
  <li><strong>The Garden</strong> — a second canvas beside the Journey where players grow Skills, ask for and give help, endorse each other, and take on Tasks and Missions.</li>
  <li><strong>Encounters</strong> — cards dealt onto the Journey. Pick one and you're held in its milestone until you finish it, making choices that cost BLOO and energy.</li>
  <li><strong>Profile Tests</strong> — a personality or working-style profile built from questions slipped into ordinary milestones as steps. Each player's reading lands in their Journal.</li>
</ul>

<p>Around the game sit the things that keep you moving: <strong>Cooper</strong>, an assistant that knows where you are in the adventure; a <strong>Library</strong> of study notes written from the course's own material, when your Game Master builds one; a <strong>notifications</strong> bell for marks, replies and emails; two ways to lay out the screen, <strong>Classic</strong> and <strong>New</strong>; and the whole interface in 11 languages.</p>

<p>See the <a href="/product">Product</a> page for the full breakdown, or <a href="/solutions">Solutions</a> for how corporate L&amp;D, onboarding, and bootcamp teams each use the platform differently.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/getting-started">Getting Started</a> — your first login</li>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the two views, the menu and the corners of the screen</li>
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
<p>On the BLUERABBIT sign-in page, enter your <strong>Email or nickname</strong> and your password, then press <strong>Log In</strong>. New here? Choose <strong>Sign Up</strong> and fill in a nickname, your email, a password and your language. Passwords are 12 to 50 characters long. Tick the box to agree to the Terms of Service and the Privacy Policy, then press <strong>Create my account</strong>. The Sign Up tab only appears when your platform has registration open. If you don't see it, your organization adds people itself.</p>
<p>Choose your nickname with care: it's what you sign in with, so it can't be changed later. The name other players see is your <strong>display name</strong>, which you can change whenever you like on <a href="/docs/your-account-profile-and-privacy">My Account</a>.</p>
<p>The language you pick sets the language of BLUERABBIT's buttons, menus and messages. You can change it later on My Account. See <a href="/docs/choosing-your-language">Choosing Your Language</a>.</p>

<h3>Confirming Your Email</h3>
<p>If you signed up yourself, BLUERABBIT emails you a link before you can sign in. Open it and press <strong>Confirm my email</strong>: the button is there so that a mail filter that opens links on its own can't confirm an address for you. The link works for 24 hours. If it has run out, or never arrived, use <strong>Didn't get the confirmation email?</strong> on the sign-in page to have a new one sent. Accounts your organization creates for you don't need this step.</p>

<h3>Security Checks</h3>
<p>Before you sign in, sign up, reset a password or confirm your email, you may be asked to complete a quick Cloudflare check that you're human. It's there to keep automated sign-ups and password guessing out.</p>
<p>After 5 failed sign-ins for the same account from your network within 15 minutes, signing in to that account is locked there for 15 minutes. The message tells you how long is left. Resetting your password gets you in straight away.</p>

<h3>If Someone Set Up Your Account for You</h3>
<p>If your organization runs BLUERABBIT for you, an admin or Game Master may already have created your account and enrolled you. Use <strong>Forgot your password?</strong> on the sign-in page to have a reset link emailed to you, and choose your own password.</p>
<p>Starting your own organization? New accounts start on the <strong>Basic</strong> plan: free, with up to 90 players and 3 Adventures across your whole account and 50MB of file storage. Upgrade to Pro whenever you need more room. See <a href="/docs/setting-up-your-organization">Setting Up Your Organization</a> for the full setup, and <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for the plans.</p>

<h2>2. Or Just Press Play Now</h2>
<p>BLUERABBIT runs an open demo at play.bluerabbit.io: its sign-in page has a <strong>Play now</strong> button above the form that drops you straight into the demo adventure on a guest account, with no sign-up. Guests can play, but some things are kept for real accounts. See <a href="/docs/playing-as-a-guest">Playing as a Guest</a>.</p>

<h2>3. Join an Adventure</h2>
<p>An <strong>Adventure</strong> is a single learning journey: an onboarding program, a training course, a live bootcamp. You join one when a Game Master enrolls you, or when you open an enrollment link they've shared. If you open an enrollment link, a magic link or a QR code while you're signed out, BLUERABBIT keeps it while you sign in or sign up, then takes you straight to it.</p>
<p>Your Adventures are listed under <strong>My Adventures</strong> — shown as a fanned-out hand of cards, one per Adventure, each in its own colour and artwork. Flip through with the scroll wheel, a drag or swipe, or the arrow keys (press <strong>/</strong> to search by name). Click the front card and it opens a dossier: your level, progress, XP/BLOO/EP, leaderboard place, and a button to <strong>Play</strong> or <strong>Enrol</strong>. If you're an owner, GM or admin on that Adventure, the dossier also gives you <strong>Manage</strong>, <strong>Settings</strong>, <strong>Copy enrolment link</strong> and <strong>Trash</strong>, so you can jump straight into running it without leaving the screen.</p>
<p>Inside each Adventure you hold one role:</p>
<ul>
  <li><strong>Player</strong> — you play the Adventure. Most people are players.</li>
  <li><strong>GM</strong> (Game Master) — runs the Adventure: builds its content, manages its players, sends its emails.</li>
  <li><strong>NPC</strong> — a read-only supervisor. An NPC sees everything a GM sees and plays the Adventure like any other player, but can't change anything, with one exception: appointing a guild's leader.</li>
  <li><strong>Owner</strong> — the account the Adventure belongs to, with full control over it.</li>
</ul>
<p>Roles are per Adventure, so you can be a player in one and a GM in another. <strong>Admin</strong> and <strong>God</strong> are something else: they're account-wide access levels that a platform admin sets in User Management, not roles inside an Adventure. See <a href="/docs/user-management-and-access-levels">User Management and Access Levels</a>.</p>

<h2>4. Choose Where You Start</h2>
<p>Many Adventures have two play areas: the <strong>Journey</strong>, the map of milestones, and the <strong>Garden</strong>, your people and your skills. If yours has both, the first time you arrive you're asked <em>Where should we start you?</em> Pick one and that's where BLUERABBIT takes you when you come in. You can change it whenever you like with <strong>Starting point</strong> in the menu. See <a href="/docs/finding-your-way-around">Finding Your Way Around</a>.</p>

<h2>5. Your First Look Around</h2>
<p>The <strong>Journey Map</strong> lays out every milestone in the program. Each node shows whether it's locked, available or finished, depending on what you've already done. Your level, XP, BLOO and, if the Adventure uses Energy, EP are in your profile panel: click your picture in the top-right corner.</p>
<p>BLUERABBIT has two ways of framing the screen. In the <strong>New</strong> view, the yellow <strong>Options</strong> button at the top left opens a menu with everything in the Adventure. In the <strong>Classic</strong> view, a top bar and a taskbar along the bottom do the same job. Your Game Master picks which one you start with, and you can switch at any time. Both are explained in <a href="/docs/finding-your-way-around">Finding Your Way Around</a>.</p>
<p>Not sure what XP, BLOO and EP mean yet? Start with <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a>. It's the fastest way to understand how progress works here.</p>

<h2>Where to Go Next</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the two views, the menu, your starting point and guided tours</li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — reading node states and Tabis</li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — what you'll actually be doing</li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a> — the social and competitive layer</li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account</a> — your name, password, language and data</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Playing as a Guest (Play Now)',
                'slug'       => 'playing-as-a-guest',
                'section'    => 'user',
                'sort_order' => 2,
                'body'       => <<<'HTML'
<p>BLUERABBIT runs an open demo at play.bluerabbit.io that anyone can play without signing up. Its sign-in page has a <strong>Play now</strong> button above the form, with the line <em>No sign-up. You get a guest account in this browser.</em></p>

<h2>Starting</h2>
<p>Press <strong>Play now</strong>. You may be asked to complete a quick Cloudflare check that you're human first. BLUERABBIT then makes a guest account with a made-up name (something like "Swift Comet 48"), enrolls it in the demo adventure as a player, puts it in a guild if the adventure has guilds, and takes you straight onto the journey.</p>

<h2>Your Guest Account Lives in This Browser</h2>
<p>A guest account has no email address and no password you know. The only thing that keeps you signed in is this browser, for up to 30 days. That means:</p>
<ul>
  <li>Come back in the same browser and you carry on where you left off.</li>
  <li>Open the demo in another browser or a private window, or clear your cookies, and <strong>Play now</strong> gives you a new guest with a fresh start.</li>
  <li>If you log out, you can't get back into that guest account.</li>
</ul>
<p>Your progress stays with the guest account. To play under your own name, sign up for an account of your own; it starts fresh.</p>

<h2>What Guests Can Do</h2>
<p>Almost everything that's about playing: milestones and challenges, earning XP, BLOO and achievements, the Item Shop and your Backpack, choosing a display name on a step that asks for one, picking one of the pictures a Choose Avatar step offers (though not uploading your own there), uploading a picture on an upload step, reading the Wall, looking around the Garden and working through Tasks and Missions.</p>

<h2>What's Kept for Real Accounts</h2>
<p>A guest account isn't really yours, and nobody behind it can be reached, so some things are switched off:</p>
<ul>
  <li><strong>Your account</strong> — there's no My Account page, so no password, email, picture, language or menu-style settings, and no Delete my account.</li>
  <li><strong>Reaching other people</strong> — no direct messages or connections, no endorsing or gifting Blooms, no asking for or offering help, and no posting on the Wall (<em>Guest accounts can read the wall but not post to it</em>).</li>
  <li><strong>Messaging the Game Master</strong> — the feedback form and My Requests aren't offered.</li>
  <li><strong>Cooper</strong> — the assistant isn't offered to guests at all.</li>
  <li><strong>Other adventures</strong> — a guest plays the demo only: no joining other adventures and no creating your own.</li>
</ul>
<p>Most of these simply aren't shown to a guest. Where a button for one is still on screen, pressing it tells you why: <em>Guest accounts can play, but not do this.</em></p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/getting-started">Getting Started</a> — signing up for an account of your own</li>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the menu and the corners of the screen</li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Finding Your Way Around',
                'slug'       => 'finding-your-way-around',
                'section'    => 'user',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>Every adventure puts the same frame around its content: a few controls at the top of the screen and a menu that reaches every part of the adventure. That frame comes in two versions, the <strong>New</strong> view and the <strong>Classic</strong> view. Learn the one you use once and you can find your way around any adventure you join.</p>

<h2>Two Views: New and Classic</h2>
<ul>
  <li><strong>New</strong> — buttons in the corners of the screen and a full-screen menu that opens like a game's pause screen. Nothing sits along the bottom, so the content gets the whole screen.</li>
  <li><strong>Classic</strong> — a top bar, a taskbar along the bottom with the yellow <strong>OPTIONS</strong> button, and a menu that opens above it.</li>
</ul>
<p>Your Game Master decides which view players start with in each adventure. You can pick your own instead, and your choice then follows you everywhere (see <em>Switching Views</em> below). Everything in the adventure is reachable from both.</p>

<h2>The New View: the Corners of the Screen</h2>
<p>Top left:</p>
<ul>
  <li><strong>Options</strong> — the yellow button. It opens the menu. <strong>Ctrl+K</strong> (<strong>Cmd+K</strong> on a Mac) does the same.</li>
  <li><strong>The Journey</strong> — a button carrying your adventure's name for its journey. It takes you back there from anywhere.</li>
  <li><strong>The adventure's name</strong>. Between adventures, on pages such as My Adventures and My Account, an <strong>Adventures</strong> button takes you back to your hand of adventure cards instead.</li>
</ul>
<p>Top right:</p>
<ul>
  <li><strong>Cooper</strong> — the assistant's picture, if your adventure has it switched on. Your Game Master may have given it a different name and face.</li>
  <li><strong>Feedback</strong> — the speech bubble. It opens the form for sending your Game Master a message, if your adventure uses it. See <a href="/docs/getting-help-support-and-chat">Getting Help</a>.</li>
  <li><strong>?</strong> — starts the guided tour for the screen you're on. It only appears where there is a tour (see below).</li>
  <li><strong>Email Support</strong> — the warning sign. It opens a new email to your adventure's support address. Your GM can set one for the adventure; otherwise it goes to the platform's default.</li>
  <li><strong>My Guild</strong> — your guild's page. It's only there if you're in a guild.</li>
  <li><strong>Profile</strong> — your picture. It opens your profile panel: your level, your XP toward the next level, your progress through the journey, your BLOO balance against everything you've earned (it can dip below zero — see <a href="/docs/xp-bloo-ep-explained">XP, BLOO &amp; EP</a>), your EP if the adventure uses Energy, and your Garden stats if it has a Garden. The panel also links to My Adventures and your account settings, and holds the <strong>Log out</strong> button.</li>
</ul>

<h2>The New View's Menu</h2>
<p><strong>Options</strong> opens the menu over the page like a pause screen. Across the top you'll find your picture, ringed by how much of the journey you've done, with your name, level and rank, your XP toward the next level and your journey progress. If the adventure has Cooper, its card sits beside them: press <strong>Ask</strong> to open the chat. Any links your Game Master added come next, as a row of buttons that each open in a new tab.</p>
<p>Below that, every part of the adventure you can visit is a button, in five blocks:</p>
<ul>
  <li><strong>Where you're going and what you hold</strong> — the Journey map, the Milestone list, your Journal, Achievements, Magic Code, Secrets and clues, the Item shop, your Backpack, your Rank card (once you hold a rank) and the Schedule.</li>
  <li><strong>The others</strong> — Guilds, the Leaderboard, Posts, Resources and Speakers.</li>
  <li><strong>The Garden</strong> — the Wall, the Garden, Tasks, Missions, the Help board, My skills and Starting point.</li>
  <li><strong>Help</strong> — My requests, Message the game master and Report a problem.</li>
  <li><strong>You</strong> — My adventures (when you play more than one), My account, Menu style and Log out.</li>
</ul>
<p>You only see the parts your adventure actually uses, and your organization may have renamed some of them. Along the bottom of the menu sit your wallet (your BLOO, and your energy against its ceiling when the adventure uses Energy), a button back to the Journey, and <strong>Continue</strong>, which takes you to your next open milestone. When there's nothing new ahead, Continue says so instead: <em>View older milestones</em> if some are still open behind you, <em>Up to date</em>, or <em>Journey complete</em>.</p>
<p>The notifications bell and <strong>Close</strong> sit at the top right of the menu. The arrow keys move between buttons, <strong>Enter</strong> opens one and <strong>Esc</strong> closes the menu. Game Masters, NPCs and administrators see the menu as a list of groups instead, with their staff tools below a line.</p>

<h2>The Classic View: Top Bar, Taskbar and Menu</h2>
<p>The <strong>top bar</strong> has the menu button at the left, then the adventure's name, which takes you back to the journey map. On the right are <strong>Tutorial</strong> (the guided tour, where there is one), <strong>Report a bug</strong> (a new email to your adventure's support address), the notifications bell, <strong>My Guild</strong> if you're in a guild, and your picture, which opens the same profile panel as in the New view.</p>
<p>The <strong>taskbar</strong> along the bottom holds the yellow <strong>OPTIONS</strong> button. Press it, or the menu button in the top bar, and the menu opens; the button then reads <strong>CLOSE</strong>. While the menu is open, a row of quick links appears just above the taskbar. Your Game Master chooses which ones, and they can include:</p>
<ul>
  <li><strong>Journey</strong> — back to the map.</li>
  <li><strong>Magic Code</strong> — opens <strong>Redeem a code</strong>, for codes from your guide, a poster, a QR code or an event.</li>
  <li><strong>Item Shop</strong>.</li>
  <li><strong>Feedback</strong> — the speech bubble, the same form as in the New view.</li>
  <li><strong>Cooper</strong> — the adventure's assistant.</li>
  <li>Up to three <strong>custom links</strong> your GM added — often your organization's own support channel. They open in a new tab; hover one to see what it is.</li>
</ul>
<p>The menu's <strong>Adventure Navigation</strong> section lists the parts of the adventure you can visit: Achievements, the Backpack, Guilds, the Item Shop, the Journey, your Journal, the Leaderboard, Magic Code, Posts, Resources, Secrets and clues, the Schedule, Speakers, the Wall and My Requests, and, when your adventure has a Garden, the Garden, Tasks, Missions, the Help board, My skills and Starting point. You only see the ones your adventure uses. <strong>Adventures</strong> takes you back to your list of adventures, unless your platform sends everyone straight to one. GMs also see <strong>Admin Tools</strong> and <strong>Add Mechanics</strong> sections.</p>

<h2>Switching Views</h2>
<p>There are two ways to choose:</p>
<ul>
  <li>In the New view, open the menu and use <strong>Menu style</strong>, a two-way switch in the last block. Pick Classic and the page reloads in the Classic view.</li>
  <li>In either view, open My Account and use <strong>Menu</strong> on the Profile section: <em>Whatever each adventure starts with</em>, <em>Classic: top bar, taskbar and menu</em> or <em>New: the pause-screen menu</em>.</li>
</ul>
<p>Your choice belongs to you, not to one adventure: it goes with you to every adventure and to the pages between them, like My Adventures. Choose <em>Whatever each adventure starts with</em> on My Account to hand the decision back to each adventure. Guest accounts can't change it.</p>

<h2>Where You Start: the Journey or the Garden</h2>
<p>If your adventure has a <a href="/docs/the-garden-overview">Garden</a> as well as a <a href="/docs/journey-map-guide">Journey</a>, you choose which one you land on when you come in. The first time you open the Journey it asks once — <strong>Where should we start you?</strong> — with two options: <strong>The Journey</strong> (the map, your milestones and what is unlocked next) or <strong>The Garden</strong> (your people, your skills and what they need from you). Close it without choosing and you stay on the Journey; it will ask again on a later visit.</p>
<p>You can change your mind whenever you like: <strong>Starting point</strong>, in the menu of either view, reopens the same dialog and says where you come in now.</p>
<p>Your starting point is remembered separately for each adventure. It applies the first time you come in during a session; after that, the Journey and Garden buttons take you wherever you ask. An adventure without a Garden has nothing to choose, so you always start on the Journey.</p>

<h2>Map or List</h2>
<p>The Journey has two views, switched with the <strong>Map / List</strong> control — at the bottom-left of the map, and at the top of the page in List view. In the New view's menu, <strong>Journey map</strong> and <strong>Milestone list</strong> take you to each one directly. The map is the designed layout you pan and zoom around; the list is a table of every milestone grouped under its chapter, with its level, rewards and status on one row. Whichever you used last is the one you get next time in that adventure. Both are covered in <a href="/docs/journey-map-guide">The Journey Map</a>.</p>

<h2>Notifications</h2>
<p>The bell counts what needs your attention: a Game Master's mark on your work, a hand-in sent back to you, a reply to one of your requests, an email sent to you. In the New view it sits at the top of the menu, and the <strong>Options</strong> button shows the count while the menu is closed. In the Classic view it's in the top bar. See <a href="/docs/notifications">Notifications</a>.</p>

<h2>Guided Tours</h2>
<p>Many screens come with a short guided tour — the Journey, milestones and challenges, the Garden, Tasks, the Item Shop, the Leaderboard, the Wall, your Journal and your list of adventures among them. A tour waits until you ask for it: press the <strong>?</strong> in the top-right corner (<strong>Tutorial</strong> in the Classic top bar). The button appears on any screen that has a tour, and nowhere else.</p>
<p>Your Game Master can set an adventure to start its tours automatically. Then each tour starts by itself the first time you open its screen, and once you've seen it, it won't start on its own again. A tour also steps aside while a card is open on screen, such as a new rank or an item you just bought, and comes back when you close it.</p>

<h2>Posts and Resources</h2>
<p>Two menu entries are for reading rather than playing. <strong>Posts</strong> are articles and notices from your GM; <strong>Resources</strong> are reference material — articles, and files or links to download. Open one and it reads like a page, with a <strong>Download</strong> button when there's a file behind it. They don't sit on the Journey and don't count toward your progress. If your Game Master has built study notes, the Resources page becomes the Library: see <a href="/docs/the-library-study-notes">The Library</a>.</p>
<p>Some are held back the way milestones are: until you reach a level, until a date, or unless you're on a particular path. A post gated by level shows up in the list as locked, with the level you need, instead of being left out entirely — so you always know there's more ahead. The others either stay out of the list until then or tell you why when you open them.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — reading the map, chapters and milestone states</li>
  <li><a href="/docs/notifications">Notifications</a> — what the bell counts</li>
  <li><a href="/docs/the-garden-overview">The Garden</a> — the other half of the adventure</li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a> — requests, Cooper and support</li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account</a> — what's behind the profile panel</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Notifications: The Bell & What It Counts',
                'slug'       => 'notifications',
                'section'    => 'user',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<p>BLUERABBIT keeps a running list of what has happened to you and what you've done, and a bell that counts only what needs your attention. It's on in every adventure.</p>

<h2>Where the Bell Is</h2>
<ul>
  <li><strong>New view</strong> — at the top of the menu, beside Close. While the menu is closed, the yellow <strong>Options</strong> button carries the same count, so you can see something is waiting without opening anything.</li>
  <li><strong>Classic view</strong> — in the top bar, beside Report a bug.</li>
</ul>
<p>Press the bell to open a short panel with the latest items. Opening it clears the count. <strong>See all</strong> takes you to the full Notifications page.</p>

<h2>What Raises the Count</h2>
<p>Only things BLUERABBIT sends you that need you to look:</p>
<ul>
  <li><strong>A mark on your work</strong> — <em>Marked 75%</em> or <em>Validated</em>, with the milestone and what the mark paid you in your adventure's own currencies ("+300 XP · +50 BLOO").</li>
  <li><strong>A hand-in sent back</strong> — <em>Sent back</em>, with your Game Master's note. Open it to hand it in again.</li>
  <li><strong>A reply to one of your requests</strong> — <em>Reply to your request</em>, with the answer, or <em>Your request was closed</em>.</li>
  <li><strong>An email sent to you</strong> — <em>Email sent to you</em>, with its subject.</li>
</ul>

<h2>What's Listed Quietly</h2>
<p>Your own activity is listed too, but it never adds to the count: you were there when it happened. That includes milestones you finished and challenges you passed (with what they paid, or <em>Waiting for a mark</em>), items you bought and achievements you earned. A celebration you already saw isn't repeated as a notification, so an item may simply point you back to something you've already seen.</p>

<h2>The Notifications Page</h2>
<p>The full page lists everything, newest first, 25 to a page with <strong>Newer</strong> and <strong>Older</strong>. Two filters narrow it down:</p>
<ul>
  <li><strong>Adventure</strong> — one of your adventures, or <strong>All adventures</strong>.</li>
  <li><strong>Show</strong> — <strong>Everything</strong>, <strong>Needs your attention</strong> or <strong>My activity</strong>.</li>
</ul>
<p>Inside an adventure, the bell shows that adventure's items. Emails sent to you are listed in every adventure, because an email isn't tied to one. Between adventures, on pages like My Adventures, the bell shows everything. Opening the page marks as read what it lists that needed your attention. Most items link to what they're about, such as the milestone that was marked or your requests.</p>

<h2>Notifications and Emails</h2>
<p>The bell doesn't replace email. A Game Master's campaign or an automatic reminder still arrives in your inbox, and it's also listed on the bell so you have one place to look. An adventure's automatic emails can be turned off on <a href="/docs/your-account-profile-and-privacy">My Account</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the two views and where everything sits</li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a> — sending requests and reading the replies</li>
  <li><a href="/docs/my-work-journal-and-history">The Journal (My Work)</a> — your marks and your activity log</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Understanding XP, BLOO & EP',
                'slug'       => 'xp-bloo-ep-explained',
                'section'    => 'user',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<p>BLUERABBIT tracks your progress with three separate numbers. They look similar at a glance but do very different jobs. XP, BLOO and EP are the default names: a Game Master can rename all three, so your adventure may call them something else, but the mechanics underneath stay the same.</p>

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
<p>Your balance is in your profile panel (with everything you've earned beside it), in the New view's menu, and in the Wallet on your Backpack page.</p>

<h2>Going Into Debt</h2>
<p>BLOO can drop <strong>below zero</strong>, but only one way: choosing an encounter option that costs more than you have. The option tells you before you pick it ("This puts you 180 under"), so it's always your call.</p>
<p>Debt is a setback, not a loophole. The Item Shop never sells on credit: it won't sell you anything you can't afford, and while you're below zero that means everything. Paid challenge attempts work the same way. Earn your way back above zero through milestones and Garden Tasks. Your Game Master may also have set up a message that appears the moment you go into debt.</p>

<h2>EP — Energy Points</h2>
<p>Energy is its own switch. If your adventure doesn't use Energy Points you won't see EP anywhere — and there are no encounters either, because energy is what they run on.</p>
<p>When it's on, you earn EP from milestones, challenges and achievements that pay it, and most reliably from Garden Tasks that pay energy. You spend it on the choices you make inside an encounter.</p>
<p>Energy has a ceiling that rises with your level: 120 at level 1, 160 at level 2, 220 at level 3, and more from there. Anything you earn above the ceiling is lost, so there's no point hoarding it. When the daily check-in or a task you complete yourself would take you past the ceiling, its celebration counts only the energy you actually kept: at 115 of 120, a task worth 10 shows <em>+5</em>.</p>
<p><strong>EP never goes below zero.</strong> An encounter option you don't have the energy for is greyed out and marked "Not enough" followed by the adventure's name for energy (for example "Not enough EP"). Every encounter is meant to offer at least one option that costs no energy, so running dry is a setback, not a game over. If you ever find nothing you can pick, the step says so and sends you to recover in the Garden.</p>

<h2>When Rewards Arrive</h2>
<ul>
  <li><strong>A milestone</strong> pays when you finish it. Some adventures pay only once a Game Master has marked your work: then nothing arrives until the mark does, and the BLOO you get follows the mark (a 75% mark pays three quarters of the milestone's BLOO). A milestone that has to be validated first says <em>Handed in</em> on its result card, and its rewards arrive once a Game Master validates it.</li>
  <li><strong>A challenge</strong> pays when you pass it. A later attempt that goes worse never takes it back: your best attempt is the one that counts.</li>
  <li><strong>Milestones and challenges pay once.</strong> Finish a milestone or pass a challenge again and the result card says its rewards were paid the first time. Repeatable Garden Tasks are the exception: they pay every time you do them.</li>
</ul>
<p>Whatever you earn is celebrated with the amounts, on the page where it happens or, if it happened while you were elsewhere, on your next page. When a Game Master's mark pays you later, the <a href="/docs/notifications">notifications</a> bell tells you, with what it paid.</p>

<h2>How They Work Together</h2>
<p>A typical loop: finish a milestone → earn XP (progress), BLOO (money) and maybe some EP → spend BLOO in the shop, or keep a cushion for the next encounter → when an encounter drains your energy, work a Garden Task to top it back up. None of the three substitutes for another. "Am I progressing?", "What can I afford?" and "Can I act right now?" stay three separate questions on purpose.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/encounters-the-card-draw">Encounters — The Card Draw</a></li>
  <li><a href="/docs/item-shop-and-backpack">Item Shop &amp; Backpack</a></li>
  <li><a href="/docs/garden-tasks">Garden Tasks</a></li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds</a></li>
  <li><a href="/docs/notifications">Notifications</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Journey Map',
                'slug'       => 'journey-map-guide',
                'section'    => 'user',
                'sort_order' => 6,
                'body'       => <<<'HTML'
<p>The Journey is the visual heart of every adventure: a map of milestones laid out by whoever built it — a path, a skill tree, a town to explore. The layout itself is usually part of the story.</p>

<h2>Moving Around</h2>
<p>Drag to pan. Zoom with the mouse wheel, a two-finger pinch, or the <strong>−</strong> and <strong>+</strong> buttons at the bottom-left, which show your zoom level as a live percentage, from 30% up to 200%. The round button beside them recentres the map.</p>
<p>Click a milestone to see its preview — what it's about and what it pays — and start it from there.</p>

<h2>Map or List</h2>
<p>The <strong>Map / List</strong> switch sits next to the zoom. In the New view's menu, <strong>Journey map</strong> and <strong>Milestone list</strong> open each one directly. The list shows the whole journey as one table: every milestone under its chapter heading, with its level, rewards and status on a single row, and each chapter's progress on its heading — required milestones, with optional ones (tagged <em>Side quest</em>) counted separately. A chapter you haven't unlocked yet shows only its heading and what to finish to open it, so the list never shows more than the map would.</p>
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
  <li><strong>Has a price</strong> — your GM has put a price on opening it. The map shows the price in BLOO; buy it from the milestone or the <strong>Unlock</strong> button in its chapter's window, and confirm before anything is spent.</li>
  <li><strong>Closed</strong> — its deadline has passed ("Deadline missed" on the map, "Closed…" in the list). If your GM has set a price for missed deadlines, the map shows <em>Unlock for</em> and the amount, and <strong>Purchase this deadline</strong> on the milestone reopens it for that many BLOO.</li>
  <li><strong>Another path</strong> — it belongs to a path you're not on, so it's greyed out.</li>
</ul>
<p>Your GM can also hide milestones outside their dates entirely, in which case they don't appear at all until they open. Dates and deadlines follow the adventure's own time zone, which your Game Master sets.</p>

<h2>Tabis — Chapters</h2>
<p>Milestones can be grouped into <strong>Tabis</strong>: chapters that sit on the map as a single tile. Click one to open it. Inside are its milestones, under a progress bar toward the chapter's badge (or toward finishing the stage, if it has no badge) that counts the required milestones you've finished out of the total. Optional side quests are counted on their own line.</p>
<p>A Tabi can be locked. The most common reason is other Tabis: a locked one is greyed out, and if you open it anyway it says <em>Complete these tabis first to unlock this one</em>, listing each chapter still to finish and what's left in it. A Tabi can also wait for things your GM sets on the chapter itself, such as a particular milestone, an achievement, a key item you have to carry, or a level. Some artwork and buttons on the map belong to a chapter, and stay grey and unclickable until that chapter opens.</p>
<p>Your GM can switch a Tabi off while it isn't ready. A switched-off chapter disappears completely: it isn't on the map, it isn't in the list, and the menu's <strong>Continue</strong> never points you into it.</p>

<h2>Evolving Tabis</h2>
<p>A chapter's artwork can change as <em>you</em> progress — a market stall that becomes a shop and then a department store as you level up, finish milestones or earn Blooms. It's drawn from your own progress, so the person next to you may see a different picture in the same spot. Open the chapter to see its scene full size, with a <strong>Next:</strong> line saying what grows it next. Some scenes also fade the longer you've been away.</p>

<h2>What Else Is on the Map</h2>
<p>Your GM can place live panels and shortcuts anywhere on the map. The panels show your own information:</p>
<ul>
  <li><strong>Status</strong> — your picture, level, and your XP and BLOO bars (plus EP, if the adventure uses Energy). Click it to open your profile panel.</li>
  <li><strong>Journey progress</strong> — how far through the whole journey you are.</li>
  <li><strong>Leaderboard</strong> — the top players, in the same order as the Leaderboard page, with medals for the first three. Your own row is highlighted, and if you're further down than the panel shows, your place is pinned at the bottom so you can always find yourself (when your GM shows players their own place).</li>
  <li><strong>Guild leaderboard</strong> — the top guilds by level, ranked on their members' average the way the Guilds page ranks them, with your guild highlighted or pinned the same way.</li>
  <li><strong>Tasks</strong> — tasks you can do, the ones available right now first.</li>
  <li><strong>Messages</strong> — opens your direct messages, when your adventure lets players message each other.</li>
  <li><strong>Help</strong> — open help requests from other players, plus any you've asked yourself.</li>
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
  <li>If a Game Master shares a link with you (in an email, an announcement, or a post), opening it can glide your map straight to a specific landmark, Tabi or milestone instead of you having to find it yourself. Your zoom level stays as it was, and the camera eases smoothly into place.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — what happens inside a milestone</li>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — the two views, the menu and tours</li>
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
                'sort_order' => 7,
                'body'       => <<<'HTML'
<p>A <strong>Milestone</strong> is the core content unit in BLUERABBIT: one node on the Journey Map. Each Milestone is built from smaller pieces called <strong>Steps</strong>, which you play through in order.</p>

<h2>Milestones and Challenges</h2>
<ul>
  <li><strong>Milestone</strong> — content that gives you something: a briefing, a video, a hands-on exercise, a written submission. Most of what you play is Milestones.</li>
  <li><strong>Challenge</strong> — a quiz that tests what you already know. Each attempt shows a set of questions drawn from a bank, and you need a set number right to pass. See <a href="/docs/taking-a-challenge">Taking a Challenge</a>.</li>
</ul>

<h2>Moving Through the Steps</h2>
<p>A Milestone opens as a whole, but you play it one Step at a time. The <strong>step bar</strong> along the bottom of the screen holds <strong>Previous</strong> on the left, <strong>Continue</strong> on the right and, in between, where you are (<em>Step 3 of 8</em>) with a segment for every step. Click a segment to jump back to a step you've already been through.</p>
<p>Some Steps just deliver something and let you move on; others need a correct answer or a response first. While a step is waiting for you, Continue shows a padlock and the bar says what unlocks it, such as <em>Answer correctly to unlock Continue</em> or <em>Send your answer to unlock Continue</em>. If you leave partway through, the Milestone picks up at the step you were on.</p>
<p>Steps can carry their own XP, BLOO, EP, item or achievement rewards on top of whatever the Milestone itself pays.</p>
<p>Some Milestones have no steps at all. You'll see a message and a text box: write your response and press <strong>Submit Answer!</strong></p>

<h2>Six Kinds of Step</h2>
<p>There are 31 Step types, in six groups you'll notice as you play:</p>
<ul>
  <li><strong>Deliver</strong> — a character speaking, a video, an audio clip, a gallery of up to seven pictures (click one to see it full size), a slide deck you page through, or an item you find on your path (<strong>Grab the item and continue</strong>). Read, watch, listen, continue. A slide deck needs to be read to its last slide before Continue opens.</li>
  <li><strong>Validate</strong> — multiple choice, a keyphrase, a cryptex lock, a jigsaw puzzle, picking the right item from your backpack, a SCORM package, or an interactive case study. You have to get it right to advance.</li>
  <li><strong>Collect</strong> — open text, a survey question, a rating scale, a poll, or an image or video upload. There's no wrong answer; you just respond. Some survey questions let you tick several answers up to a limit, shown above the options as <em>Choose up to 3</em>. Once you reach it, the other boxes lock until you untick one.</li>
  <li><strong>Profile</strong> — statements to agree or disagree with, or questions whose answers each lean toward a trait. There are no right answers here either: your answers build a profile of you, and a Profile Result step shows you the reading. See <a href="/docs/your-profile-results">Your Profile Results</a>.</li>
  <li><strong>Flow</strong> — a branch choice that permanently sets your path, buttons that jump you to another part of the Milestone, a choice board, and encounter choices: options with a price in BLOO and energy. See <a href="/docs/encounters-the-card-draw">Encounters</a>.</li>
  <li><strong>Special</strong> — system messages, the win and fail screens, and the steps where you choose your display name or your avatar.</li>
</ul>
<p>Not every Step is required. On survey-style steps an optional one lets you press Continue without answering. Steps that check an answer always wait for one.</p>

<h2>Puzzles and Locks</h2>
<ul>
  <li><strong>Jigsaw</strong> — drag pieces together: the ones that belong side by side click into place. Fix a corner in its corner of the frame. Some puzzles also turn their pieces; tap a piece to turn it. When it's done, <strong>Open the picture</strong> shows it full size.</li>
  <li><strong>Cryptex</strong> — turn each wheel by dragging, scrolling or with the arrow keys until the word is right, then press <strong>Unlock</strong>.</li>
  <li><strong>Keyphrase</strong> — type the answer and submit it.</li>
</ul>

<h2>Answering, and Tries</h2>
<p>Picking options or typing costs nothing: an answer only counts when you press the step's button to send it. If you send nothing, the step tells you (<em>Choose an answer first.</em>, <em>Choose 2 options first.</em>, <em>Type your answer first.</em>) and nothing is spent. A multiple-choice question with more than one right answer says how many to pick.</p>
<p>Some Steps give you a fixed number of tries, and say so from the start: <em>You have 3 tries</em>, then <em>2 tries left</em>, then a red <em>Last try</em>. This applies to multiple choice, keyphrase, cryptex and backpack steps. Run out without getting it right and this attempt at the Milestone is over: the step says so and takes you to its fail screen, where you can start again (see below). You're never left stuck on a step you can't answer.</p>

<h2>Read It Again</h2>
<p>When a question asks about something you read a few steps back, you don't have to leave it to check. Multiple choice, keyphrase, cryptex and open text steps have a <strong>Read it again</strong> button under the question. It opens a panel over the question with the words of the steps before it, the speakers' names and faces included. Close it with <strong>Back to the question</strong>: your pick, your typing and your tries left are just as you left them. After a wrong answer the button lights up, as a hint.</p>
<p>If what came before was a video, audio clip, gallery or slide deck, the panel offers <strong>Watch it again</strong>, <strong>Listen again</strong>, <strong>See the pictures again</strong> or <strong>See the slides again</strong>, which takes you back to that step; a <strong>Back to the question</strong> button at the top of the screen brings you straight back.</p>

<h2>Backpack Steps: Pick the Right Item</h2>
<p>A backpack step shows your own backpack as a rack. Scroll it past the sight in the middle and press <strong>Use</strong> on whatever sits under it. The step doesn't tell you which item it wants (working that out is the puzzle), and a wrong pick counts as a miss. If your backpack is empty, the step says so and points you to the shop. Gift cards don't appear on the rack.</p>

<h2>Choices: Branches and Choice Boards</h2>
<p>A <strong>Branch Choice</strong> shows the paths you can take as cards. Picking one is permanent and can't be undone, and it decides which milestones and shop items you see from then on. Some branches are <strong>One per guild</strong>: once someone in your guild takes a path, it's closed to the rest of the guild, and its card says who took it (<em>Taken by Ana</em>). If your Game Master has already given you a path in that branch, the step shows it as yours.</p>
<p>A <strong>Choice Board</strong> offers several activities as face-down cards and asks you to complete some of them, for example two of four. Tap a card to see what's ahead, then <strong>Walk this way</strong> to play that choice. When you finish it you come back to the board, which counts your progress (<em>1 of 2 choices completed</em>). Once you've done enough, the rest close and Continue opens. A choice that plays an online video may say <em>May not play on your network</em>, so you can pick another.</p>

<h2>Open Text and Your Name</h2>
<p>Each Open Text step keeps its own answer, so a milestone can ask several written questions in a row. Some ask for a minimum number of words. Write your answer and press <strong>Check Answer</strong>; it's marked <em>Submitted!</em> once it's sent, and <strong>Edit Content</strong> reopens it.</p>
<p>A <strong>Choose Display Name</strong> step asks what we should call you. Type a name and press <strong>Save my name</strong>: it becomes the name other players see. It never changes the nickname you sign in with.</p>

<h2>How a Milestone Ends</h2>
<p>Every Milestone ends on a win screen or a fail screen, even if your Game Master didn't write one.</p>
<ul>
  <li><strong>Win</strong> — the last step's <strong>Continue</strong> takes you to the win screen. Press <strong>Finish</strong> and a result card lands, with your rewards counting up. A button names the next open milestone ahead of you, beside <strong>Back to the journey</strong>. If the milestone has to be validated first, the card says <em>Handed in</em> and its rewards arrive once a Game Master validates it; if you'd finished it before, it says its rewards were paid the first time. Anything else you earned, such as an achievement or an item, opens in a celebration panel when you close the card.</li>
  <li><strong>Fail</strong> — you reach the fail screen when you run out of tries on a step, or when a step sends you there. Its button turns over a red card: <em>Attempt 1 is over and its answers were cleared. Try again starts attempt 2.</em> <strong>Try again</strong> reloads the Milestone from the first step as a genuinely fresh run, with your tries back; <strong>Back to the journey</strong> leaves it for later. Your progress everywhere else, and anything you've already earned, stays yours. An encounter choice you already paid for isn't charged again.</li>
</ul>
<p>Every run at a milestone is an attempt. From your second one on, the step bar shows <em>Attempt 2</em> beside the step count, and the result cards name the attempt. Leaving and coming back doesn't start a new attempt: an attempt ends only on a win or a fail.</p>

<h2>Milestones That Open by Themselves</h2>
<p>Your Game Master can mark a Milestone to load first, such as a briefing you should see before anything else. When you open the adventure you're taken straight into it, but only if you can actually play it yet. Once you've finished it, it stops. An encounter you're in the middle of, or a hand of encounter cards waiting for you to pick, always comes first.</p>

<h2>AI-Assisted Feedback</h2>
<p>On Open Text steps, if your Game Master has switched it on, pressing <strong>Check Answer</strong> has your response checked against what the question asks (and any private criteria your Game Master wrote) before you continue. If it's sent back, you get feedback to revise against, which is useful for practising a skill rather than just being graded once. After it's accepted you can still reopen your answer with <strong>Edit Content</strong>.</p>

<h2>Reading Your Answers Back</h2>
<p>Every answer you give is kept. Your Journal's <strong>My Answers</strong> tab, and the <strong>Your answer</strong> link on a secret you unlocked, open a milestone's read-back: each step that asked you something, the question, and what you answered. See <a href="/docs/my-work-journal-and-history">The Journal</a>.</p>

<h2>Quick-Complete via QR Code</h2>
<p>Some Milestones carry a scannable QR code that completes them directly, bypassing the normal prerequisite chain entirely. You'll typically see this at in-person events or bootcamp sessions: scan, done, move to the next station. You need to be logged in and enrolled in the adventure; if you scan while signed out, BLUERABBIT keeps the code while you sign in and then records it. A scan always counts in the adventure you're playing (a cohort shares its template's milestone codes), and scanning the same code again doesn't pay out twice.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/journey-map-guide">The Journey Map</a> — where Milestones live</li>
  <li><a href="/docs/taking-a-challenge">Taking a Challenge</a> — question kinds, submitting and your result</li>
  <li><a href="/docs/encounters-the-card-draw">Encounters</a> — the card draw and the choices inside it</li>
  <li><a href="/docs/item-shop-and-backpack">Item Shop &amp; Backpack</a> — where backpack-step items come from</li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> — every Step type in detail</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Taking a Challenge',
                'slug'       => 'taking-a-challenge',
                'section'    => 'user',
                'sort_order' => 8,
                'body'       => <<<'HTML'
<p>A <strong>Challenge</strong> is the quiz on your Journey: it tests what you already know rather than teaching you something new. Each attempt deals a set of questions from a bank, and you need a set number right to pass. This page walks through one from the first look to your result.</p>

<h2>Before You Start</h2>
<p>A Challenge page opens on its <strong>Conditions</strong>:</p>
<ul>
  <li><strong>Used</strong> — how many attempts you've used, out of the limit (or ∞ when there is none).</li>
  <li><strong>N of M correct answers to win</strong> — the pass mark.</li>
  <li><strong>The time limit</strong> in seconds, or <em>No time limit</em>.</li>
  <li><strong>What it pays</strong> — its XP and BLOO, and EP if the adventure uses Energy, under your adventure's own names for them.</li>
</ul>
<p>Under them is the big button. When you can play, it says <strong>Start!</strong>, with a note saying whether this is a <em>Free attempt</em> or what the <em>Attempt cost</em> is in BLOO. When you can't, it says why instead: <em>Available at Level N</em>, <em>Max Attempts Reached</em>, <em>Requirements not met!</em>, or the date its deadline passed.</p>
<p>Press <strong>Start!</strong> and a <em>Get Ready!</em> card warns you that refreshing the page before you finish loses the attempt (a bought attempt is spent too). If the attempt costs more BLOO than you have, it won't start and the card tells you so. Press <strong>Start the challenge</strong> to begin.</p>

<h2>Kinds of Question</h2>
<p>Each question says what it wants, and every one is all or nothing: a question only counts as right when all of it is right.</p>
<ul>
  <li><strong>Choice</strong> — pick the right answer. When more than one answer is right, the question says how many to choose.</li>
  <li><strong>Order</strong> — put the items in the right order, first at the top. Drag them by the handle or use the arrows.</li>
  <li><strong>Match</strong> — drag each answer onto its match, or tap an answer and then its place.</li>
  <li><strong>Group</strong> — drop every item into its group, or tap an item and then its group.</li>
  <li><strong>Gaps</strong> — drag a word into each blank in a sentence, or tap a word and then its blank.</li>
  <li><strong>Hotspot</strong> — find a number of spots on a picture and tap each one to mark it. A counter shows how many you've marked; tap a mark to take it back, or <strong>Clear</strong> them all.</li>
</ul>
<p>A question can also come with a picture, a video or an audio clip. The answers are shuffled for every player, so the right one is never simply first.</p>

<h2>The Clock</h2>
<p>On a timed Challenge a bar counts down as you answer. When it runs out, a <em>Time's up!</em> screen covers the questions; click it and what you've answered so far is handed in.</p>

<h2>Submitting</h2>
<p>The <strong>Submit answers</strong> button fills up as you answer: it sits beside the questions, at the end of the list, and in a bar along the bottom on a phone. Pressing it opens one full-screen check before anything is final: how many you've answered, a numbered dot for every question (press one to go back to it), a warning for any question left blank (it counts as wrong), and a reminder that your answers lock once you submit. Choose <strong>Submit answers</strong> to hand it in, or <strong>Keep answering</strong> to go back.</p>

<h2>Your Result</h2>
<p>A sealed card spins while your answers are graded, then lands:</p>
<ul>
  <li><strong>Gold</strong> when you pass: <em>Challenge conquered</em>, your score against the pass mark, and the rewards counting up. A button names the next open milestone ahead of you; with nothing open ahead, <strong>Back to the journey</strong>. If you'd passed this Challenge before, the card says its rewards were paid the first time.</li>
  <li><strong>Red</strong> when you don't: <em>Challenge failed</em>, your score, and how many attempts you have left, with <strong>Try again</strong> while you have any.</li>
</ul>
<p>Either way, the card's main button is <strong>Review my answers</strong>. Behind it are your graded questions, each marked right or wrong. The ones you got right come with your Game Master's explanation of why; the ones you got wrong don't, so a retry isn't handed the answers. Anything else the attempt earned, such as an achievement or an item, opens in a celebration panel after the card.</p>
<p>A Challenge pays once, the first time you pass it, and a later attempt that goes worse never takes that back. A Challenge can cap how many attempts you get, and attempts beyond the free ones can cost BLOO. You can't buy an attempt while your BLOO is below zero.</p>

<h2>Looking Back</h2>
<p>Every attempt you've made is listed on your Journal's <strong>Challenges</strong> tab: pass or fail, your grade and the date. Click one to see each question, the answer you gave, and whether it was right. It's a good way to learn from a quiz you didn't ace the first time. See <a href="/docs/my-work-journal-and-history">The Journal</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — the other kind of node on the Journey</li>
  <li><a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a> — what a Challenge pays, and what an attempt costs</li>
  <li><a href="/docs/my-work-journal-and-history">The Journal (My Work)</a> — every attempt, question by question</li>
  <li><a href="/docs/challenges-concept">Challenges — Concept</a> — how Game Masters design them</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Encounters — The Card Draw',
                'slug'       => 'encounters-the-card-draw',
                'section'    => 'user',
                'sort_order' => 9,
                'body'       => <<<'HTML'
<p>Some adventures don't just wait for you to choose what to play next. The world acts on you: you open the Journey and something has happened. A supplier doubled their price, a client wants a meeting tomorrow, the fridge died two hours before service. These are <strong>encounters</strong>, and they arrive as a card draw.</p>
<p>Encounters only exist in adventures that use Energy Points. If yours doesn't, nothing on this page will happen to you.</p>

<h2>The Draw</h2>
<p>When something is due, the next time you open the Journey the screen flashes and a hand of face-down cards is dealt, usually eight. The heading reads <em>"Something just happened."</em> The line under it hints at what's in the hand: <em>"Turn over a card. None of them are good."</em> if every card is a crisis, <em>"Turn over a card. Not all of them are bad."</em> if there's an opportunity in there somewhere.</p>
<p>Pick one. It flips over to show what you drew:</p>
<ul>
  <li><strong>Crisis</strong> — something went wrong and needs dealing with.</li>
  <li><strong>Opportunity</strong> — a chance you can take, usually at a price.</li>
</ul>
<p>The hand is fixed the moment it appears. Reloading the page shows the same cards again, so there's no reshuffling until you like the look of one. The cards you didn't pick go back into the deck untouched and may come round another time.</p>

<h2>Locked In Until You Finish</h2>
<p>Every card leads to a milestone, and turning it over takes you straight there. As the draw screen warns: <em>"Whatever you turn over, you will face it before the journey opens again."</em> Until you finish that milestone, opening the Journey brings you back to it.</p>
<p>Only the Journey is locked. The Garden, your Tasks and the Item Shop stay open the whole time, which matters, because that's where you recover what an encounter costs. And the milestone always opens for you, even if a setback has dropped you below the level it would normally need. Once it's resolved, it stays open to you, so you can go back and read it again.</p>

<h2>The Choice</h2>
<p>Inside the milestone, the story plays out like any other until you reach the decision: an <strong>Encounter Choice</strong> step. It shows what you have ("You have 1320 BLOO and 45 Energy") and lists your options, each with its price up front:</p>
<ul>
  <li><strong>-200 BLOO</strong> or <strong>+900 BLOO</strong> — what the option costs, or what it pays.</li>
  <li><strong>-20 Energy</strong> or <strong>No energy</strong> — the energy it takes.</li>
</ul>
<p>A choice can do more than move money. It can also add or take away XP (that part isn't shown on the option itself), grant you an achievement that opens a follow-up milestone, or trigger a message about what happened next.</p>
<p>Once you pick, the step shows <em>"You decided"</em> with your choice, and that's final. You're only ever charged once for an encounter, even if you fail the milestone and play it again.</p>

<h2>When You Can't Afford It</h2>
<p><strong>Energy is a hard limit.</strong> An option that needs more energy than you have is greyed out and marked <em>"Not enough"</em> followed by the adventure's name for energy (for example <em>"Not enough EP"</em>). Encounters are designed to always include at least one option that costs no energy. If you ever find nothing you can pick, the step says <em>"You are out of energy"</em> and offers a <strong>Go and recover</strong> button that takes you to your Tasks. Complete a Task that pays energy, come back, and the encounter will still be waiting.</p>
<p><strong>Money isn't.</strong> An option that costs more BLOO than you have is still available, marked with how far under it would put you ("This puts you 180 under"). Choosing it puts you in debt. <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a> explains what that means. In short, the Item Shop won't sell to you until you've earned your way back.</p>

<h2>How Often They Happen</h2>
<p>Your Game Master decides. Encounters come in groups, and each group has its own rules for when you're ready for it (reaching a certain level, say, or finishing a particular chapter) and how often it comes round. Some come round every few days. Some only happen on particular days of the week, and if you don't visit on that day, that one passes you by.</p>
<p>You only ever face one hand at a time, and a new one can't arrive until you've finished the encounter you picked. Most encounters happen to each player once; a few recurring pressures can come round again.</p>

<h2>Keeping Track</h2>
<p>Your BLOO and your energy against its ceiling are always in your profile panel (click your picture) and, in the New view, in the wallet along the bottom of the menu. When you're in debt, your BLOO shows below zero.</p>
<p><strong>Enterprise only:</strong> on Enterprise plans, a Game Master can also switch on the Garden's <strong>Business</strong> panel. It sits in the Garden's dock and shows your coins (BLOO), your energy against its ceiling, and how many crises and opportunities are still out there for you. When you're in debt it tells you how far under you are, and the dock button shows a <strong>!</strong>.</p>

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
                'sort_order' => 10,
                'body'       => <<<'HTML'
<h2>Your Achievements Page</h2>
<p>The Achievements page (your adventure may call it something else) opens with a <strong>showcase</strong> of two cells:</p>
<ul>
  <li><strong>My last achievement</strong> — the latest badge or rank you earned, and when. Until you earn one, it says your first achievement lands here.</li>
  <li><strong>My certificate</strong> — your certificate once you've earned it, with an <strong>Open</strong> button, and the badge it carries. While it's still locked, the cell lists exactly what's missing, for example "Reach level 9 — you're at level 5". See <a href="/docs/certificates-and-secrets-and-clues">Certificates</a>.</li>
</ul>
<p>Below that, every achievement is listed under a count of how many you hold out of the total, in three groups — <strong>Badges</strong>, <strong>Paths</strong> and <strong>Ranks</strong> — with a search box. Anything you've earned shows the date you earned it; anything you haven't is greyed out. Some adventures hide achievements until you've earned them, in which case you only see your own.</p>
<p>Click one you've earned and it opens as a collectible card — artwork, name and description laid out like a trading card rather than a plain icon. The card also says how rare it is (Common, Uncommon, Rare or Mythic, with the share of players who hold it), when you earned it, and, for a limited one, how many have been claimed. Flip it over to read its secret message, if the Game Master wrote one.</p>

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
  <li><strong>Through a choice</strong> you make in an <a href="/docs/encounters-the-card-draw">encounter</a>, or a path you pick on a Branch Choice step.</li>
  <li><strong>With a magic code</strong> — type it into <strong>Magic Code</strong> (a button in the New view's menu, or a quick link above the Classic taskbar), scan its QR code, or open the magic link your Game Master shared. Codes work however you type them, in capitals or not. If a code doesn't work, the box says why and stays open until you close it.</li>
  <li><strong>From your Game Master</strong>, by hand.</li>
</ul>
<p>However it arrives, you get the same celebration panel: <em>Congratulations!</em>, what you just did (<em>You just earned an achievement</em>, <em>reached a new rank</em>, <em>leveled up</em>), a card for each thing you earned, and <strong>Close</strong>. If someone else's action earned it for you (a Game Master awarding it, or grading your work), the panel is waiting for you on your next page and says so.</p>

<h2>The Badge on Your Certificate</h2>
<p>Once you hold a certificate, its showcase cell says which badge it carries (<em>Showing</em> one, or <em>No achievement chosen yet</em>). Click the cell to choose any badge or rank you hold, or drag one onto it from the grid. <strong>Use my rank instead</strong> goes back to your current rank. Paths aren't offered: a path is where you are, not something you won.</p>

<h2>Guilds</h2>
<p>Guilds are squads that play together inside an adventure. If yours uses them, you'll be placed in one automatically when you join, assigned by your Game Master, or given an invite link that puts you in when you open it.</p>

<h3>Your Guild Page</h3>
<p>The Guilds page shows <strong>My Guild</strong>: its members, level, average XP and its current position. If the adventure has a leaderboard, every guild is ranked below it — the top five as cards with their place medals, the rest in a table with each guild's members, level, average XP, total XP and BLOO. A search box finds a guild by name across the cards and the whole table.</p>
<p>Guilds are ranked on their members' <strong>average</strong>, not their total: first by level, then average XP, then average BLOO, and only then by totals. A guild's level comes from its members' average XP, on the same curve players use, so a big guild can't out-rank a small one on headcount alone.</p>
<p>Only players count. GMs and NPCs who sit in a guild add nothing to its numbers, and neither does anyone who has left the adventure.</p>

<h3>Rosters and Leaders</h3>
<p>Click any guild, on its card or in the table, to open its roster: every member, best first, with their level, XP, BLOO and the achievements they hold. Players never see anyone's email address on it. A guild can also have a <strong>leader</strong>, appointed by the Game Master, and the roster marks them with a Leader badge. For now it's a title, not a set of extra powers.</p>

<h3>Joining With an Invite Link</h3>
<p>A Game Master can share a guild's invite link. Open it while you're enrolled in the adventure and you join that guild, as long as it has room. If you can't join, the page says why: you're already a member, you need to join the adventure first, you already have a guild from the same group, the guild is full, or the link doesn't match a guild.</p>

<h3>One Seat Per Guild</h3>
<p>Some Branch Choice steps are <strong>One per guild</strong>: once someone in your guild takes a path, it's closed to everyone else in the guild, and its card says who took it. Your Game Master can also give each member of a guild their path directly, and then the step shows that path as yours. See <a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a>.</p>

<h3>Guild Chat on the Wall</h3>
<p>The Wall has one <strong>Guilds</strong> tab. If you're in a single guild, the tab carries your guild's name and opens straight into its feed. If you're in more than one, it opens a searchable picker; choose a guild and the post button becomes <strong>Post to</strong> that guild.</p>

<h2>The Leaderboard</h2>
<p>The Leaderboard page ranks players by level, then XP, milestones completed, BLOO earned and BLOO left, and when all of that is equal, whoever got there first. Your own row is marked <em>You</em>. Where the adventure has guilds, the page can also show the guild ranking. Your Game Master chooses which columns players see.</p>

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
                'sort_order' => 11,
                'body'       => <<<'HTML'
<p>The Item Shop is where BLOO gets spent. Everything you buy, or pick up along the journey, lands in your Backpack. Both share a tab bar with the Tabis page, where chapter collages are pieced together, and, if your Game Master has switched it on, a <strong>Transactions</strong> tab listing what you've bought and received. Your adventure may use its own names for the shop and the backpack.</p>

<h2>Item Types</h2>
<ul>
  <li><strong>Consumable</strong> — used once, whenever you decide, from your Backpack. What it's for is up to your Game Master; the description says.</li>
  <li><strong>Key</strong> — held, not spent. Some milestones stay locked until you carry a particular key, and having it in your Backpack is enough.</li>
  <li><strong>Reward</strong> — a keepsake. Rewards aren't sold; they come from milestones and from items you find along the way.</li>
  <li><strong>Tabi Piece</strong> — one piece of a Tabi's collage. Collect them and the picture fills in on the Tabis page.</li>
  <li><strong>Gift Card</strong> (Enterprise only) — a real gift card, emailed to you, bought with BLOO. Only in adventures on an Enterprise plan where the Game Master has connected a gift-card account.</li>
</ul>

<h2>Buying</h2>
<p>Each card shows the item's level, its price and how many are left (or ∞), with a badge for its category or the Tabi it belongs to. The button tells you whether you can buy it:</p>
<ul>
  <li><strong>Buy</strong> — go ahead.</li>
  <li><strong>Requires Level N</strong> — you'll need to level up first.</li>
  <li><strong>Max owned</strong> — you already hold as many as one player may.</li>
  <li><strong>Sold Out</strong> — there's no stock left.</li>
</ul>
<p>Not every item is offered to everyone: some only appear for players on a particular path.</p>
<p>Pressing <strong>Buy</strong> asks you to confirm the price first ("Buy Health Potion for 50 BLOO?"), with <strong>Confirm</strong> and <strong>Cancel</strong>. Confirm, and the item's collectible card turns over, marked <em>Added to your Backpack</em>. If the purchase earned you anything else at the same time, a level or an achievement, the celebration panel follows when you close the card.</p>
<p><strong>Gift cards</strong> work the same way, with two differences. The confirmation warns you that a real gift card will be sent to your account email, and that the purchase can't be undone. Afterwards, you're told a second email is on its way from the rewards partner with the card itself, and that it can take a few minutes to arrive.</p>
<p>The shop never sells on credit. If you can't afford something you'll see <em>"Not enough funds"</em>, and that holds even when an encounter has already left you below zero. Two players can't both grab the last one in stock, either: whoever's purchase lands second is told there are none left.</p>

<h2>Your Backpack</h2>
<p>At the top, the <strong>Wallet</strong> shows your BLOO balance. Below it is everything you own, grouped into Consumables, Key Items, Tabi pieces (under each Tabi's name) and Rewards, with how many of each you hold.</p>
<p>Items reach your Backpack in three ways: you buy them, a milestone awards one when you finish it, or you pick one up on a Find Item step. Your Game Master can also buy an item for you, paid from your own BLOO.</p>
<p><strong>Consumables</strong> have a <strong>Use</strong> button. It asks you to confirm, then a panel tells you the item was redeemed and stays until you close it; the item leaves your Backpack. Nothing is ever used automatically. If you use one by mistake, ask your Game Master: only staff can return a used item to your Backpack.</p>
<p>Keys, Tabi pieces and Rewards have no button. You hold them; you don't spend them.</p>
<p>Click an item for a closer look and it opens as a collectible card, the same treatment achievements get, with how rare it is and how many you hold. An item with a secret message is tagged <em>Secret</em> until you've examined its card.</p>

<h2>The Tabis Page</h2>
<p>Each Tabi with collectible pieces has its own board, with a count of how many you've collected. Pieces you hold are shown in full colour and the rest stay greyed out, so you can see the shape of what's missing. Click a piece you hold to open its card.</p>

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
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>Beyond badges and ranks, an Adventure can give you two more things to keep: <strong>certificates</strong> you can print, and <strong>secrets</strong> — bits of story your GM hid inside the milestones you finish.</p>

<h2>Certificates</h2>
<p>A certificate is a printable document your Adventure awards you. An Adventure can carry several — one for finishing the programme, one for reaching a level, one for your whole guild — and each one unlocks on its own terms. Some are open from the start. Others unlock only once you meet everything your GM set for them.</p>

<h3>Where to Find Them</h3>
<p>Certificates live on your <strong>Achievements</strong> page:</p>
<ul>
  <li>The <strong>My certificate</strong> cell at the top shows the first certificate you hold, with an <strong>Open</strong> button. If you don't hold one yet, it shows the next locked one and what it still needs.</li>
  <li>The <strong>Certificates</strong> panel below the achievements lists every certificate you can earn. Earned ones open when you click them. Locked ones show a padlock and a list of what's missing.</li>
</ul>
<p>A locked certificate tells you exactly what's left, and where you stand when it can work that out: <em>"Reach level 9 — you're at level 5"</em>, or <em>"Complete 12 milestones — you've completed 7"</em>. Every line on that list has to be met before the certificate opens. The hint is written by the same rule that decides the unlock, so the two can't disagree. If you follow a link to a certificate you haven't earned yet, the page says <em>This certificate isn't yours yet</em> and points you back to your Achievements page.</p>
<p>Your GM can also choose to keep locked certificates out of sight until you've unlocked them. In that case you'll only see the ones you've already earned.</p>

<h3>Guild Certificates</h3>
<p>Some certificates go to your guild rather than to you. They're tagged <strong>Guild</strong> on the shelf. A guild certificate reads "Awarded to the team" and carries your guild's name. It prints the guild's combined numbers and member count, worked out from its current members when you open it. The guild's level is the members' average. You'll only be offered a guild certificate if you're in a guild.</p>

<h3>The Badge on Your Certificate</h3>
<p>Some certificates print a badge next to your name, and by default it's your current rank. Once you hold a certificate, you can pick a different one from the <strong>My certificate</strong> cell of your Achievements page: click it to choose from the badges and ranks you hold, or drag one onto it from the grid (paths aren't offered). <strong>Use my rank instead</strong> goes back. Levelling up never overrides a badge you picked.</p>

<h3>Printing</h3>
<p>Open a certificate and press <strong>Print</strong>; to keep a file, choose <em>Save as PDF</em> in your browser's print window. It uses a fixed, print-safe layout (US Letter, landscape), and only the certificate itself goes to paper, not the app around it. Depending on how your GM set it up, it can show a logo, a headline, your name, your badge, a personal paragraph, a few numbers (level, XP, BLOO, energy), the Adventure's name and dates, and a signature. <strong>Show/Hide Achievement</strong> and <strong>Show/Hide Stats</strong> take the badge or the numbers off before you print. If you hold more than one certificate, switch between them from the list above the document.</p>

<h2>Secrets and Clues</h2>
<p>Some milestones carry a hidden "success message" — a bit of story or narrative payoff your GM wrote for finishing that milestone, written specifically to be a) hidden until then and b) worth savoring once. Every one you've unlocked gets collected on your <strong>Secrets and Clues</strong> page — a personal scrapbook of the story content you've earned, separate from the milestones themselves and worth a look if you want the narrative in one place rather than scattered across the Journey Map.</p>
<p>The page counts how many you've found, and each secret shows the date you found it with a link back to your own work: <strong>Your answer</strong> for a milestone, <strong>Your results</strong> for a challenge. Secrets you haven't found yet are counted, not shown: complete more milestones to uncover them.</p>
<p>These stay genuinely hidden until you've earned them — even a Game Master previewing or drafting the milestone doesn't get an early look at the secret.</p>

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
                'sort_order' => 13,
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
                'sort_order' => 14,
                'body'       => <<<'HTML'
<p>The Journal is your full record inside one Adventure: how far you've come, what you've handed in, how your quizzes went, what you've earned, your skills and your profile results. It's called <strong>Journal</strong> in the menu and the page itself is headed <strong>My Work</strong>. Your organization can rename it, so it may carry a different name for you.</p>
<p>A <strong>Download PDF</strong> button at the top gives you a clean, printable copy of your overview, milestones and achievements to keep or share: in the print window, choose <em>Save as PDF</em>.</p>

<h2>The Tabs</h2>
<p>Each section is its own tab, and several carry a count. The open tab is kept in the page address, so refreshing or sharing the link brings you back to the same one.</p>
<ul>
  <li><strong>Skills</strong> and <strong>Skill History</strong> — only when the Adventure has a skill catalogue. When it does, Skills opens first.</li>
  <li><strong>Overview</strong> — opens first when there are no skills.</li>
  <li><strong>Journey Progress</strong> — with your percentage on the tab. Your adventure's name for the journey replaces the word Journey.</li>
  <li><strong>Milestones</strong> — with the required milestones you've done out of the total.</li>
  <li><strong>My Answers</strong></li>
  <li><strong>Challenges</strong> — with how many attempts you've made.</li>
  <li><strong>Case Studies</strong> — only when you've run one.</li>
  <li><strong>Achievements</strong> — with how many you hold out of the total.</li>
  <li><strong>Activity</strong> — with how many entries there are.</li>
  <li><strong>Rubric</strong> — only when your Adventure has set up Graduation Criteria.</li>
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
  <li>A status card: your rank badge and name, your level, your XP and BLOO bars, your leaderboard position ("#4 of 120"), and how many days since your last login and your last milestone.</li>
  <li>An <strong>Engagement</strong> gauge scored out of 100: On Fire, Active, Moderate, Cooling Off or Dormant. It weighs how recently you were active, how many milestones you've finished in the last 30 days, how much of the Adventure you've completed, your level against the top level, and your Item Shop activity.</li>
  <li>Your currencies, an XP-over-time chart, and a chart of which kinds of milestones you've completed.</li>
  <li>Progress for every Tabi, your guild's rank and totals, and any SCORM completions.</li>
</ul>

<h2>Journey Progress</h2>
<p>Your overall percentage, a progress bar and "X of Y milestones". It's the same number as the Journey Map's progress widget and the menu, and the same one any "complete N% of the journey" unlock checks. It counts the required milestones on your own path, leaving out optional side quests and chapters your Game Master has switched off. It rounds down, so it never says 100% while a milestone is left.</p>

<h2>Milestones</h2>
<p>Every milestone on your path, under its Tabi, in one list headed <strong>Milestone Progress</strong>. At the top, two counts: <strong>Required</strong> (done out of the total, and how many of those are open now) and <strong>Optional</strong>. Milestones on paths you're not on aren't listed, because they aren't on your map either.</p>
<p>Each row shows the milestone's XP, BLOO and, when the adventure uses Energy, EP. The numbers light up in their colour once that milestone has paid you; quiet numbers are what finishing it would pay. Every Tabi heading totals what you've earned of what's on offer, and the list ends with an overall total. These are milestone rewards only, so achievements and tasks, which also pay, aren't in them.</p>
<p>Each row has a status: <strong>Complete</strong> (green), <strong>In progress</strong> (blue: started, or handed in and awaiting review) or <strong>Not started</strong>. A line under the title says what you left in it ("5 attempts, best 83%", "3 answers") and whether it's awaiting review or not open yet. The buttons are <strong>Details</strong>, <strong>View</strong> and <strong>Edit</strong> while a hand-in hasn't been graded, or a <strong>Graded</strong> tag once it has.</p>
<p><strong>Details</strong> opens a window with everything you left in that milestone. For a challenge, every attempt, newest first: pick one to see each question, what you picked and whether it was right. For any other milestone: your hand-in (its date, grade and your Game Master's feedback), then your answer to every step that asked for one. A case study lists its runs; a SCORM package shows its status, score and dates. A milestone you haven't touched has nothing to open, and steps you haven't reached are counted, never shown.</p>

<h2>My Answers</h2>
<p>The milestones you've handed in, as <strong>Submitted Work</strong>: each with its level, name, rewards and grade. <strong>View answers</strong> reads back everything you wrote and every answer you gave, step by step. <strong>Edit</strong> stays until it's graded; after that it's marked <strong>Graded</strong>.</p>

<h2>Challenges</h2>
<p>Every quiz attempt you've made, as <strong>Challenge Attempts</strong>: pass or fail, your grade and the date. Click an attempt to open it in the Details window, with each question, the answer you picked, and whether it was right. It's a good way to learn from a quiz you didn't ace the first time. See <a href="/docs/taking-a-challenge">Taking a Challenge</a>.</p>

<h2>Case Studies and Achievements</h2>
<p><strong>Case Studies</strong> lists every run of an interactive case study: how far you got, your score and whether you passed. <strong>Achievements</strong> shows your badges and ranks as a grid; click one you hold to open its collectible card. If the Adventure hides achievements until they're earned, only yours are shown.</p>

<h2>Activity</h2>
<p><strong>My Activity</strong> is your log in this Adventure, newest first: milestones finished, items bought, achievements earned, levels reached and more. Search it, filter it by kind of activity, choose how many rows a page shows, and page through. It's a record, not a to-do list: what needs your attention is on the <a href="/docs/notifications">notifications</a> bell.</p>

<h2>Rubric</h2>
<p>If your Adventure has Graduation Criteria set up, this tab shows exactly where you stand against each one — <strong>met</strong>, <strong>not yet</strong> but still reachable, or <strong>out of reach</strong> — and why. See <a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a> for how a Game Master builds a rubric.</p>

<h2>Profiles</h2>
<p>If the Adventure measures a profile, this tab holds your sheet for each one, building up as you answer. See <a href="/docs/your-profile-results">Your Profile Results</a>.</p>

<h2>Who Else Can See It</h2>
<p>Your GM can open any player's Journal to check how they're getting on. There's no self-service reset. If you need to run a milestone again from scratch, ask your GM: an administrator can clear your record of that one milestone.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/your-profile-results">Your Profile Results</a></li>
  <li><a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms Explained</a></li>
  <li><a href="/docs/taking-a-challenge">Taking a Challenge</a></li>
  <li><a href="/docs/certificates-and-secrets-and-clues">Certificates &amp; Secrets and Clues</a></li>
  <li><a href="/docs/journey-map-guide">The Journey Map</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Library: Study Notes & Glossary',
                'slug'       => 'the-library-study-notes',
                'section'    => 'user',
                'sort_order' => 15,
                'body'       => <<<'HTML'
<p>Some adventures come with study notes: a short, readable summary of each module you've reached, written from the course's own material, plus a glossary of the terms it uses. When your adventure has them, its <strong>Resources</strong> page becomes the <strong>Library</strong>, a place to revise whenever you like. Your adventure may call the page something else.</p>

<h2>The Three Tabs</h2>
<ul>
  <li><strong>Study notes</strong> — one set of notes for every module, slide deck and case study you've reached.</li>
  <li><strong>Glossary</strong> — every term from the notes you can read, in one list.</li>
  <li><strong>Resources</strong> (or your adventure's name for them) — the slide decks and the resources your Game Master shared.</li>
</ul>
<p>Each tab carries a count. If your adventure has no study notes, the page is simply the list of resources it always was.</p>

<h2>Study Notes</h2>
<p>Each set of notes is a card with the milestone it comes from, how many terms it explains, and where that milestone stands for you: <strong>Done</strong>, <strong>Handed in</strong> (waiting for a mark) or <strong>Open now</strong>. Search them with <strong>Search your notes</strong>, and press <strong>Read the notes</strong> to open one.</p>
<p>An open set shows the notes themselves, the glossary terms that go with them, and a button to go to the milestone. If the milestone has a slide deck you're allowed to keep, <strong>Download the deck</strong> is there too. Every set carries the same reminder: the notes were written by A.I. from that step's material and checked by your Game Master, and the material itself is the final word.</p>
<p>You only read notes for what you've reached. Notes for milestones ahead of you stay closed, and the tab just says how many more sets open as you play.</p>

<h2>Glossary</h2>
<p>Every term from the notes you can read, each with its meaning and where it came from (<strong>From:</strong>). Use <strong>Find a term</strong> to search. New terms arrive with each new set of notes.</p>

<h2>Resources and Slide Decks</h2>
<p>The last tab holds the files. When your Game Master lets players download them, <strong>Slide decks</strong> lists the deck of every milestone you have open or done, each with a <strong>Download</strong> button. Below them are the adventure's resources, with a search box, the same as on any Resources page.</p>

<h2>The Library and Cooper</h2>
<p>If your adventure has <a href="/docs/getting-help-support-and-chat">Cooper</a>, the assistant reads the same notes. Ask it where something was covered and it can point you to the module and the notes, within what you've reached.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a> — Posts, Resources and the rest of the menu</li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a> — Cooper and other ways to get unstuck</li>
  <li><a href="/docs/completing-milestones-and-steps">Completing Milestones &amp; Steps</a> — Read it again, inside a milestone</li>
  <li><a href="/docs/library-study-notes-and-glossary">Authoring the Library</a> — for Game Masters: writing the notes and the glossary</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Your Account: Profile, Security & Privacy',
                'slug'       => 'your-account-profile-and-privacy',
                'section'    => 'user',
                'sort_order' => 16,
                'body'       => <<<'HTML'
<p>Everything about you as a person, separate from any one Adventure, lives on <strong>My Account</strong>. Open it from your profile panel (click your picture in the top-right corner, then <strong>Account settings</strong>), or from <strong>My account</strong> in the New view's menu.</p>
<p>The page has six sections, listed as tabs across the top: <strong>Profile</strong>, <strong>Security</strong>, <strong>Emails</strong>, <strong>Billing</strong>, <strong>Transactions</strong> and <strong>Your data</strong>. Guest accounts from an open demo don't have a My Account page: see <a href="/docs/playing-as-a-guest">Playing as a Guest</a>.</p>

<h2>Profile</h2>
<ul>
  <li><strong>Profile Picture</strong> — upload a new one and it replaces the old one.</li>
  <li><strong>First name</strong> and <strong>Last name</strong>.</li>
  <li><strong>Display name</strong> — the name other players see. Change it whenever you like. A Choose Display Name step inside a milestone sets the same name.</li>
  <li><strong>Nickname</strong> — shown but not editable: you sign in with it, so it can't be changed.</li>
  <li><strong>Email</strong> — shown here too. Its <strong>Change</strong> button takes you to Security, because changing it needs a confirmation.</li>
  <li><strong>Player Level</strong> — different from any single Adventure's level: it's the average across every Adventure you're enrolled in.</li>
  <li><strong>Language</strong> — the language BLUERABBIT speaks to you, from 11. The page reloads in the new language as soon as you pick it. See <a href="/docs/choosing-your-language">Choosing Your Language</a>.</li>
  <li><strong>Menu</strong> — <em>Whatever each adventure starts with</em>, <em>Classic: top bar, taskbar and menu</em> or <em>New: the pause-screen menu</em>. Your choice goes with you to every adventure. See <a href="/docs/finding-your-way-around">Finding Your Way Around</a>.</li>
  <li>The optional <strong>Company Name</strong>, <strong>Website URL</strong> and <strong>LinkedIn URL</strong>, and <strong>My Bio</strong>.</li>
</ul>
<p>Changes save as you make them, and there's a <strong>Save</strong> button at the bottom as well.</p>
<p>Looking for your personality-test results? They live inside the Adventure that measured them, on your Journal's Profiles tab. See <a href="/docs/your-profile-results">Your Profile Results</a>.</p>

<h2>Security</h2>
<ul>
  <li><strong>Password</strong> — enter your current password, then the new one twice (12 to 50 characters), and press <strong>Update Password</strong>.</li>
  <li><strong>Email Address</strong> — enter the new address and your current password, then press <strong>Send Confirmation Link</strong>. The link goes to the <em>new</em> address. Nothing changes until you click it, and it's valid for an hour. If you open it too late, the page says the link has expired and your address hasn't changed, and <strong>Send me a new link</strong> sends a fresh one to the same new address.</li>
</ul>
<p>Every sign-in to your account is recorded with the network address and browser it came from, and kept for 12 months, so that misuse can be traced. After 5 failed sign-ins from one network within 15 minutes, signing in to your account is locked there for 15 minutes; resetting your password lifts it straight away.</p>

<h2>Emails</h2>
<p>A switch for every Adventure you're seated in. Some adventures send automatic reminders about your progress, for example when you fall behind, or a note when you earn something. Turning an Adventure's switch off stops that Adventure's automatic emails; a message your Game Master writes to you directly still arrives. If an Adventure sends no automatic reminders yet, the switch is still there, and says it will apply if it starts.</p>

<h2>Billing</h2>
<p>If you pay for a plan, the <strong>Subscription</strong> panel shows your plan and its status (for example Active, Free trial or Payment overdue), when it renews or ends, and a <strong>Manage billing</strong> button that opens the billing portal, where you can update your card or cancel. If your last payment failed, a banner here asks you to update your payment method.</p>
<p>No subscription? The panel names the plan your account is actually on, such as Basic, with a <strong>View plans &amp; upgrade</strong> button that opens Subscription &amp; Billing.</p>
<p>Underneath is <strong>Your storage</strong>: a meter showing how much of your plan's file storage you've used and how much is left. It counts the files you upload (pictures, video, audio, your submission uploads and any SCORM packages you add) across every Adventure. If you're ever over your allowance, for example after moving to a smaller plan, you keep everything you've stored but can't upload more until you delete files or upgrade. Administrators have no storage limit.</p>
<p><strong>Billing History</strong> lists every payment with its date, amount and status, with <strong>View</strong> and <strong>PDF</strong> links to the invoice itself. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for what each plan includes, and the <a href="/refunds">refund rules</a>.</p>

<h2>Transactions</h2>
<p>Your in-game purchase and spending history across every Adventure you've played: the date, the Adventure, the item or kind of transaction (an item bought or used, a challenge attempt), and the amount. This is BLOO and items, not real money. Real payments are under Billing.</p>

<h2>Staying Signed In</h2>
<p>Sessions last <strong>30 days</strong>. Log in once and you'll stay signed in for a month of ordinary use, rather than being logged out after a couple of hours.</p>
<p>This is deliberate: most people work through an Adventure across weeks, not in one sitting. If you're on a shared or public computer, log out when you're done (<strong>Log out</strong> in your profile panel or the menu). The long session is a convenience for your own device.</p>

<h2>Your Data</h2>
<p><strong>Download my data</strong> gives you one file with everything BLUERABBIT holds about you: your profile, every adventure you joined and what you earned in it, the work and answers you handed in, your messages and uploads, the emails sent to you, your billing and your sign-ins. It's a JSON file, readable in any text editor.</p>
<p><strong>Delete my account</strong> can't be undone, so download your data first if you want a copy. To confirm, type your email address and your current password, then press <strong>Delete my account</strong>. What happens is listed on the page before you press it:</p>
<ul>
  <li><strong>Erased:</strong> your name, nickname, email, picture, bio and links, your work profile, your direct messages, wall posts, requests and Cooper chats, the files you uploaded, and the text of your answers and handed-in work.</li>
  <li><strong>Kept, anonymously:</strong> your scores, levels, achievements and completions, under a name like "Player 3f9a1c", so leaderboards and other people's statistics stay correct.</li>
  <li><strong>Kept because the law requires it:</strong> invoices and subscription records.</li>
  <li>You're signed out everywhere and can't sign in to this account again.</li>
</ul>
<p>Some accounts can't be deleted yet, and the page says why in place of the button: an account with a subscription that still renews (cancel it first under Billing, with Manage billing), an account that is a Game Master of an adventure or owns one, and administrator accounts. See the <a href="/privacy">Privacy Policy</a> for what we keep and why.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/your-profile-results">Your Profile Results</a></li>
  <li><a href="/docs/choosing-your-language">Choosing Your Language</a></li>
  <li><a href="/docs/my-work-journal-and-history">The Journal (My Work)</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Choosing Your Language',
                'slug'       => 'choosing-your-language',
                'section'    => 'user',
                'sort_order' => 17,
                'body'       => <<<'HTML'
<p>BLUERABBIT speaks 11 languages. Pick yours and the buttons, menus, messages and guided tours all switch to it, in every adventure you play.</p>

<h2>The Languages</h2>
<p>Each language is listed in its own name, so you can find yours whatever language the page is in now:</p>
<ul>
  <li>English</li>
  <li>简体中文 (Chinese, Simplified)</li>
  <li>Français (French)</li>
  <li>Deutsch (German)</li>
  <li>Italiano (Italian)</li>
  <li>日本語 (Japanese)</li>
  <li>한국어 (Korean)</li>
  <li>Português (Brasil) (Portuguese, Brazil)</li>
  <li>Русский (Russian)</li>
  <li>Español (Spanish)</li>
  <li>Türkçe (Turkish)</li>
</ul>

<h2>Choosing Yours</h2>
<ul>
  <li><strong>When you sign up</strong> — the sign-up form has a <strong>Language</strong> field.</li>
  <li><strong>Any time after</strong> — open <a href="/docs/your-account-profile-and-privacy">My Account</a> and change <strong>Language</strong> in the Profile section. The page reloads in the new language straight away.</li>
</ul>
<p>Your language belongs to your account, not to an adventure: it follows you everywhere. If you've never chosen one, you see the platform's default language.</p>

<h2>What Changes, and What Doesn't</h2>
<p>Everything BLUERABBIT itself says is translated: the menus and buttons, messages and confirmations, the guided tours, the labels on your Journal and the names of days and months in dates.</p>
<p>What people wrote stays as they wrote it:</p>
<ul>
  <li><strong>Your adventure's content</strong> — milestones, steps, posts, items, achievements and everything else your Game Master wrote appear in the language they were written in.</li>
  <li><strong>Names your Game Master chose</strong> — if your adventure has renamed its Journey, its sections or its currencies, those names stay exactly as set. XP, BLOO and EP keep their names unless your Game Master renamed them, and the Garden's Blooms are called Blooms in every language.</li>
  <li><strong>Emails</strong> — BLUERABBIT's own emails, such as confirmation links and password resets, are sent in English. An email your Game Master writes arrives in the words they wrote.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a></li>
  <li><a href="/docs/getting-started">Getting Started</a></li>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a></li>
  <li><a href="/docs/languages-for-your-players">Languages for Your Players</a> — for Game Masters</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Getting Help: Requests, Cooper & Guided Tours',
                'slug'       => 'getting-help-support-and-chat',
                'section'    => 'user',
                'sort_order' => 18,
                'body'       => <<<'HTML'
<p>Stuck, short of time, or not sure where to look? There are several ways to get help inside an Adventure. Which ones you see depends on how your Game Master has set it up.</p>

<h2>Messaging Your Game Master</h2>
<p>Most adventures have a form for sending the team a message: a bug, a question, an idea, a request for more time. Open it with the speech-bubble button (in the top-right corner in the New view, or among the quick links above the Classic taskbar), or with <strong>Message the game master</strong> in the New view's menu.</p>
<p>By default the form is titled <em>Send feedback</em> and asks two things: <strong>What is it about?</strong> and <strong>Tell us more</strong>. Your Game Master can reword it for their adventure, for example as a deadline extension request, and can add a date field ("Extension needed until"), which can't be in the past. Every field it shows is required. Press <strong>Send</strong>; if you've left something out, the form says what before anything is sent.</p>
<p>If your adventure doesn't show the button, the form is switched off there.</p>

<h2>My Requests</h2>
<p><strong>My Requests</strong> (in the menu) lists every request you've sent in this Adventure with its status: <strong>Pending</strong>, <strong>Read</strong>, <strong>Resolved</strong> or <strong>Dismissed</strong>. Filter the list by All, Pending, Resolved or Dismissed. If an admin writes back, their note appears under your request as <strong>Admin response</strong>, and the <a href="/docs/notifications">notifications</a> bell lets you know. <strong>New Request</strong> opens the same form as the button.</p>

<h2>Cooper, the In-App Assistant</h2>
<p>If your Adventure has <strong>Cooper</strong> switched on, its picture sits in the top-right corner in the New view, its card is at the top of the menu (<strong>Ask</strong>), and in the Classic view it's a quick link above the taskbar. Any of them opens a chat panel. The chat offers starting points such as "What can I do right now?", "How am I doing so far?" and "I'm stuck - where should I look?".</p>
<p>Cooper runs inside BLUERABBIT and knows the adventure the way you do. It can see what you've done, what's open to you now and what's on your screen, so it can point you to the right milestone, explain where you stand, tell you what opens the next chapter, or find where something was covered. What you haven't reached yet stays hidden from it too: it can name a milestone ahead and say what opens it, but not what's inside. It will guide you, but it won't hand you answers. In an interactive case study it can coach you through a couple of questions.</p>
<p>Your Adventure may give the assistant a different name, picture and personality, a character from its story for example. It's the same assistant underneath, and the same rules apply however it talks. If you don't see it, the assistant isn't on for this Adventure. On My Adventures, between adventures, it can also answer questions about BLUERABBIT itself, such as how to join an adventure.</p>

<h2>Emailing Support</h2>
<p>The warning-sign button in the top-right corner (<strong>Email Support</strong> in the New view, <strong>Report a bug</strong> in the Classic top bar), and <strong>Report a problem</strong> in the New view's menu, open a new email in your mail app, addressed to your Adventure's support address. Your Game Master can set that address; if they haven't, it goes to your platform's default support address.</p>

<h2>Your Organization's Own Links</h2>
<p>Your Game Master can add up to three custom links, each with its own label, icon and colour. In the New view they're a row of buttons near the top of the menu; in the Classic view they're quick links above the taskbar. They open in a new tab and often point at your organization's own help channel, an intranet page or a booking link.</p>

<h2>Asking Other Players</h2>
<p>If the Adventure has a Garden with help switched on, you can also ask the people around you: post a help request tagged with the skill you need, and anyone who holds it can answer. See <a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a>.</p>

<h2>Guided Tours</h2>
<p>Many screens have a short guided tour, among them the Journey map, milestones, the Garden, Tasks, the Item Shop, the Wall, the Leaderboard and your Journal. Press the <strong>?</strong> button (<em>Start Tutorial</em>) in the top-right corner, or <strong>Tutorial</strong> in the Classic top bar, to run the one for the screen you're on. The button only appears on screens that have a tour.</p>
<p>Tours wait until you ask for them, unless your Game Master has set the adventure to start them automatically: then each one starts the first time you open its screen, and not again once you've seen it.</p>

<h2>Guest Accounts</h2>
<p>If you're playing on a guest account from an open demo, the feedback form, My Requests and Cooper aren't available to you. Email Support still works. See <a href="/docs/playing-as-a-guest">Playing as a Guest</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a></li>
  <li><a href="/docs/notifications">Notifications</a></li>
  <li><a href="/docs/help-requests-and-messages">Help Requests &amp; Messages</a></li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Garden — An Overview',
                'slug'       => 'the-garden-overview',
                'section'    => 'user',
                'sort_order' => 19,
                'body'       => <<<'HTML'
<p>BLUERABBIT has two play areas, not one. The <a href="/docs/journey-map-guide">Journey</a> is your <em>individual</em> progression: milestones, XP, levels, achievements. The <strong>Garden</strong> is your <em>relational</em> progression: a living picture of who you actually work with, and how well you keep those relationships going.</p>
<p>Where the Journey answers "how am I growing?", the Garden answers "who am I growing with?"</p>
<p>If your adventure has the Garden switched on, it has its own button in the menu, with Tasks, Missions, the Help board and My skills beside it, in both views. You can also choose to start each visit in the Garden rather than on the Journey. See <a href="/docs/finding-your-way-around">Finding Your Way Around</a>.</p>

<h2>What You See</h2>
<p>The people enrolled in your adventure appear as hexagons with their photo (or initials): other players, NPCs and your Game Masters, arranged in rings around you at the centre. Each adventure has its own Garden, just as it has its own Journey.</p>
<p>A Garden shows up to 168 people around you, seven full rings; your Game Master can set a different number. In a bigger adventure, the people who matter most to you are the ones shown: your connections and the people you deal with most come first, then the most recently active. Guest players from an open demo come after the adventure's own people.</p>
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
<p>This is independent of how many people you know. A Garden can be bright but empty (strong skills, few relationships) or full but dull (lots of relationships, few skills). Your current state is written out in the Garden section of your profile panel, which opens when you click your picture in the corner of the screen.</p>

<h2>Moving Around</h2>
<p>Drag the canvas to pan. The zoom control shows the current percentage, with <strong>−</strong> and <strong>+</strong> buttons and a <strong>⦾</strong> button that recentres on you. The mouse wheel zooms around your pointer, and you can pinch on a touch screen.</p>
<p>Click anyone to open their drawer: their skills, recent wall posts, any open help requests, and buttons to message them, connect, endorse them or gift a Bloom. Click your own hexagon to open yours, with your Blooms left to give, a box to ask for help, and your own requests.</p>

<h2>The Dock and Its Panels</h2>
<p>The canvas is deliberately mostly empty. Everything else sits in a dock at the bottom right:</p>
<ul>
  <li><strong>Tasks</strong>: things that improve you.</li>
  <li><strong>Skills</strong>: your skill radar at a glance (<em>My Skills</em>), linking through to the full picture in your Journal.</li>
  <li><strong>Missions</strong>: things you do with other people.</li>
  <li><strong>Help</strong>: ask for help, and see ways to help others.</li>
  <li><strong>Connections</strong>: requests and the people you're connected to.</li>
  <li><strong>Rewards</strong>: Blooms waiting for you to claim.</li>
  <li><strong>Messages</strong>: your direct messages, in a bigger, easier-to-navigate window with a clear back button to your conversation list.</li>
  <li><strong>Business</strong> (Enterprise only, when a Game Master switches it on): your balance, your energy against its cap, and how many encounters are still out there. The button shows a <strong>!</strong> if your balance has gone below zero. See <a href="/docs/encounters-the-card-draw">Encounters</a>.</li>
</ul>
<p>Tasks, Missions, Help, Connections and Business open as floating panels, and can't wander off the edge of your screen if you resize your browser window. Drag a panel by its header to move it, and press <strong>−</strong> to minimise it back to the dock. Your layout is remembered for each adventure on the browser you're using. Rewards, Messages and any help request you open appear as windows on top of everything else. Badges on the dock buttons show counts, such as unread messages and rewards to claim.</p>

<h2>What Your Game Master Can Switch Off</h2>
<p>Each of the Garden's tools is a switch, so a Garden can be anything from a quiet map of skills to a busy social space. A tool that's off is gone from the Garden, the menu and the Journey map, not just greyed out:</p>
<ul>
  <li><strong>Talking</strong> — direct messages and connections.</li>
  <li><strong>Help</strong> — help requests, the Help panel and the Help board.</li>
  <li><strong>Recognition</strong> — awarding and gifting Blooms to each other. Blooms you earn from milestones, achievements and Tasks still count.</li>
  <li><strong>Missions</strong>.</li>
  <li><strong>Tasks</strong> have a switch of their own, and can run with or without a Garden.</li>
</ul>
<p>On a guest account from an open demo, talking, help and recognition are always off for you: you can look around the Garden and work your Tasks, but not reach other people. See <a href="/docs/playing-as-a-guest">Playing as a Guest</a>.</p>

<h2>Tasks and Missions</h2>
<p>Two of those panels are the Garden's core mechanics, and they do opposite jobs:</p>
<ul>
  <li><strong><a href="/docs/garden-tasks">Tasks</a> improve you.</strong> Build a habit, practise something, do the work, and your own skills and level grow.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a> improve your Garden.</strong> Reach out to other people, and the relationships around you get healthier.</li>
</ul>
<p>The way to remember it: <em>helping yourself is a Task. Helping someone else is a Mission.</em> Both show as simple one-line rows — click one to open a clear card with exactly what to do on one side and what you'll earn on the other.</p>

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
                'sort_order' => 20,
                'body'       => <<<'HTML'
<p>Skills and Blooms are the two ideas the whole Garden rests on. They're simpler than they first look, because they're really the same thing seen from two directions.</p>

<h2>Skills</h2>
<p>Every adventure has its own catalogue of skills, set up by your Game Master. A skill can be a broad competency ("Communication and Listening", "Problem Solving") or a narrow capability ("Mentor"). Each has its own colour, and many have an icon or image and a short description. Hover a skill chip in the Garden to read what it means.</p>
<p>You hold a <strong>level</strong> in each skill, and that level is simply a count: <strong>one Bloom in a skill is one level in it</strong>. No weighting, no decay, no formula. Twenty Blooms in Resilience is level 20 in Resilience. Each skill has a maximum level set by your Game Master, and Blooms past it don't raise it any further.</p>
<p>Your highest skill is your <strong>master skill</strong>, and it sets your hexagon's colour in the Garden. If two skills are tied at the top, the app picks one consistently.</p>

<h2>Blooms</h2>
<p>Blooms are recognition made countable. A Bloom is always awarded <em>in a specific skill</em>, which is why receiving them builds a real picture of what you're known for rather than one meaningless score. "Blooms" is their name in every language BLUERABBIT speaks.</p>
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
<p>Your Game Master decides which of these an adventure uses. Endorsements and gifts can be switched off, and so can help requests and Missions; Blooms from the Journey and from Tasks keep counting either way.</p>

<h2>Instant or Claimed</h2>
<p>Most Blooms land the moment they're earned. Three kinds wait for you instead: Mission rewards, approved help, and group awards from your Game Master. They arrive in <strong>Rewards</strong> in the Garden dock, each with a button such as <strong>Claim 2 Blooms</strong>. Your skill level only goes up when you press it.</p>

<h2>Seeing Your Skills</h2>
<ul>
  <li><strong>Your Journal</strong> opens on a <strong>Skills</strong> tab when your adventure has a skill catalogue: a chart with each skill in its own colour, a card per skill showing where its points came from, and every skill's description. <strong>My skills</strong> in the menu goes straight there. The <strong>Skill History</strong> tab lists every Bloom you've ever received: when, what it was for, and who gave it. See <a href="/docs/my-work-journal-and-history">My Work: Your Journal</a>.</li>
  <li><strong>Your profile panel</strong> has a Garden section: Blooms earned, where that stands against the adventure (see <a href="/docs/the-garden-overview">The Backdrop</a>), your strongest skill, your connections and your Blooms left to give.</li>
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
                'sort_order' => 21,
                'body'       => <<<'HTML'
<p>There are two ways to recognise another player, and they're deliberately different. Click anyone in the Garden to open their drawer, and you'll find both.</p>
<p>Your Game Master can switch recognition off for an adventure. Then neither button is offered, though the Blooms you earn from milestones, achievements and Tasks still count. Guest accounts from an open demo can't give Blooms at all.</p>

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
<p>Your remaining balance shows next to <em>Gift a Bloom</em> in anyone's drawer, in your own drawer under <em>Blooms to give</em>, and in your profile panel. When you run out, the button is replaced by "You're out of Blooms to give right now."</p>
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
                'sort_order' => 22,
                'body'       => <<<'HTML'
<p>The Garden isn't only about recognising work that already happened. It's built to get people talking in the first place.</p>
<p>Both halves of this page are switches your Game Master controls: help requests can be switched off, and so can direct messages (together with connections). When one is off, it's gone from the Garden, the menu and the Journey map. Guest accounts from an open demo don't get either: a guest can't ask for help, answer someone, or message anyone.</p>

<h2>Asking for Help</h2>
<p>You can ask from three places:</p>
<ul>
  <li>the <strong>Help</strong> panel in the Garden dock (<em>Stuck on something?</em> then <strong>Ask for help — +1 Bloom</strong>)</li>
  <li>your own drawer, opened by clicking your hexagon (<strong>Post request</strong>)</li>
  <li>the <strong>Help Board</strong> page (<strong>Post request — +1 Bloom</strong>), which also has its own button in the menu</li>
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
<p><strong>Ways to help</strong> leads with who's asking and what skill they need, so you can scan the list quickly — click one and it opens as a full card explaining the request on one side and what helping earns you on the other, the same clear layout Tasks and Missions use. Clicking on a teammate opens their drawer with <strong>Message</strong> and <strong>Connect</strong> (or <strong>Accept</strong> / <strong>Connected</strong>) front and centre, followed by their skills, ways to recognise them, what they need help with, and their recent posts.</p>

<h2>The Help Board</h2>
<p>Follow <strong>Open the Help Board</strong> from the Help panel, or use <strong>Help board</strong> in the menu, for the full page: your own requests with their replies, and every open request in the adventure. Some cards carry a "Matches one of your top skills" badge.</p>

<h2>Direct Messages</h2>
<p>You can message anyone in your adventure one-to-one, from <strong>Messages</strong> in the dock or the <strong>Message</strong> button in their drawer. Conversations are private between the two of you, belong to the adventure you're both in, and are the same conversations you see in the Wall's Messages tab.</p>
<p>Unread messages show a badge on the dock button.</p>
<p>Your Game Master may also place a <em>Help</em> panel or a Messages button on the Journey map, so you can do both without leaving it.</p>

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
                'sort_order' => 23,
                'body'       => <<<'HTML'
<p><strong>Tasks are how you improve yourself.</strong> They're the Garden's mechanic for getting better at something: build a habit, practise a skill, do the thing you said you'd do. They pay out in your own progression: XP, BLOO, energy and skill levels.</p>
<p>That's the whole difference between the Garden's two mechanics:</p>
<ul>
  <li><strong>Tasks improve you.</strong> You get better, you level up, your skills grow.</li>
  <li><strong><a href="/docs/garden-missions">Missions</a> improve your Garden.</strong> You reach out to other people, and the relationships around you get healthier.</li>
</ul>
<p>The shortest version: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>
<p>Tasks have a switch of their own, so an adventure can use them with or without a Garden.</p>

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
  <li><strong>Log in each day</strong>: the habit mechanic. It completes on your first visit of the day, and a "day" is the adventure's day, in its own time zone.</li>
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
<p>Task rewards land straight away, with nothing to claim, and every completion is celebrated with exactly what you earned, including the Tasks that complete on their own:</p>
<ul>
  <li>The daily check-in shows its panel the moment you arrive, with what it paid, and your balances on the page already include it.</li>
  <li>A Task completed by finishing a milestone, or by meeting its requirements, is celebrated on your next page, so it doesn't get lost behind the milestone's own result.</li>
  <li>Energy is counted honestly: if you're near your ceiling, the panel shows only the energy you actually kept.</li>
</ul>

<h2>Where to Find Them</h2>
<ul>
  <li>The <strong>Tasks</strong> panel in the Garden dock shows a few at a time, with the ones you can do now first, and a <strong>View all</strong> link to the full Tasks page.</li>
  <li>The Tasks page also has its own button in the menu when your adventure uses Tasks.</li>
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
                'sort_order' => 24,
                'body'       => <<<'HTML'
<p><strong>Missions are how you improve your Garden.</strong> Where a <a href="/docs/garden-tasks">Task</a> makes <em>you</em> better, a Mission makes the <em>relationships around you</em> better. It's a nudge to reach out, connect, and do the social things you might otherwise put off. Missions pay out in <a href="/docs/skills-and-blooms-explained">Blooms</a>.</p>
<p>The shortest version: <em>helping yourself is a Task. Helping someone else is a Mission.</em></p>
<p>Missions are separate from the Journey. Finishing a milestone never completes one. Only real interaction with real people does.</p>

<h2>Who Sets Them</h2>
<p>Your Game Master writes Missions, and you only see the ones meant for you. A Mission can be for everyone in the adventure, for particular guilds, for named players, for anyone holding a particular achievement, or for players on a particular branch of the story. Two people in the same adventure can see different Missions.</p>
<p>Missions are a Garden tool your Game Master can switch off. When they're off, the Missions panel, page and menu button are gone.</p>

<h2>What a Mission Asks of You</h2>
<p>Some Missions you simply do and then press <strong>Mark done</strong>. Most count what you actually do, and complete on their own when you reach the target. The card says what counts, for example "Message 3 times to complete this automatically", and shows your progress (1/3).</p>
<p>What a Mission can count:</p>
<ul>
  <li><strong>Message</strong>: direct messages you send</li>
  <li><strong>Help</strong>: help you offer on someone's request</li>
  <li><strong>Endorse</strong>: endorsements you give</li>
  <li><strong>Ask for help</strong>: help requests you post</li>
  <li><strong>Get a request solved</strong>: goes up when one of your own requests is solved</li>
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
<p>The <strong>Missions</strong> panel in the Garden dock shows the Missions you haven't finished first, with a <strong>View all</strong> link to the full Missions page, which also has its own button in the menu.</p>
<p>When you finish one, its card says "Complete — open Rewards to claim it!" and a reward appears in <strong>Rewards</strong> in the dock. Press <strong>Claim</strong> and the Blooms land, in the skill your Game Master chose. The card then reads "Completed and claimed". Missions pay Blooms, never XP or BLOO.</p>

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
<p>Sign up at the app, and your account starts on <strong>Basic</strong>: free, no credit card. The plans differ in how much room they give you:</p>
<ul>
  <li><strong>Basic</strong>: free. Up to 90 players across your account, 3 Adventures, 50MB of storage.</li>
  <li><strong>Pro</strong>: $8/month or $80/year. Up to 250 players across your account, 20 Adventures, 200MB of storage. It starts with a 30-day free trial; the trial needs a card up front, and the plan renews until you cancel it. Refunds follow the rule on the <a href="/refunds">Refunds</a> page.</li>
  <li><strong>Enterprise</strong>: no player, Adventure or storage limits, and it's set up with our team. See <a href="/contact">Contact</a>.</li>
</ul>
<p>You can upgrade at any time from <strong>Subscription &amp; billing</strong> in the menu, or from the Subscription panel on My Account. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for how that works, or the <a href="/pricing">Pricing</a> page for the side-by-side comparison.</p>

<h2>2. Create Your First Adventure</h2>
<p>From <strong>My Adventures</strong>, choose <strong>New adventure</strong> to start from a blank canvas, or <strong>From a template</strong> to start from a ready-made program. Nothing is final on the first pass; everything is editable later. The full walkthrough is <a href="/docs/building-your-first-adventure">Building Your First Adventure</a>.</p>
<p>Whether an account can create Adventures at all is a platform setting. On most platforms it's on. If you don't see those buttons, ask your platform administrator.</p>

<h2>3. Bring in Your Co-Facilitators</h2>
<p>Running an Adventure alone is hard work. Add other people as <strong>GMs</strong> (game masters, who build and run the Adventure) or <strong>NPCs</strong> (read-only supervisors who see everything a GM sees but change nothing). Roles are set per Adventure, on <strong>Manage Players</strong>. See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</p>

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

<h2>Finding the Builder's Tools</h2>
<p>Everything a Game Master builds with is in the menu, and where it sits depends on which view you're using. Each person picks <strong>Classic</strong> or <strong>New</strong> for themselves (My Account, or Settings in the New menu), and an Adventure can start its players on the classic menu from Adventure Settings → Menu.</p>
<ul>
  <li><strong>New view</strong>: open the menu. The <strong>Game master</strong> group holds <strong>Build</strong> (Manage content, Adventure settings, the Journey builder and the Duplicator), <strong>Watch</strong> and <strong>Run</strong>. The <strong>Add</strong> group makes something new: a Milestone, Challenge, Achievement, Item, Guild, Post, Resource, Session, Speaker or Encounter, each offered once its section is switched on.</li>
  <li><strong>Classic view</strong>: the same tools are in the menu's <strong>Admin Tools</strong> column (Adventure Settings, Journey Builder, Duplicator, Manage Content and the rest) and its <strong>Add Mechanics</strong> column (New Milestone, New Challenge, New Achievement and so on).</li>
</ul>
<p>The steps below name the tool; use whichever menu you have.</p>

<h2>1. Start From Scratch or From a Template</h2>
<p>On <strong>My Adventures</strong>, <strong>New adventure</strong> gives you an empty adventure to build from zero. <strong>From a template</strong> opens the <strong>Template Library</strong>: the published templates on your platform, each card showing who made it, how many milestones, achievements, items and chapters it holds, and how many adventures already use it. Press <strong>Use this template</strong> to create your adventure from one.</p>
<p>An adventure made from a template isn't a copy. It gets its own players, guilds and progress, while the milestones, achievements and items stay shared with the template, so improving the template improves every adventure built from it. If you want an independent copy you can change freely, use <strong>Duplicate</strong> on Manage Adventures instead. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</p>
<p>Whether you see either button depends on your platform's settings; if one is missing, ask your platform admin.</p>

<h2>2. Set the Basics</h2>
<p>Open <strong>Adventure Settings</strong>. It shows one pane at a time, picked from the rail down the side, with a search box over every setting. On <strong>Basics</strong>, give the adventure its name, image, highlight colour, dates and time zone. Then go to <strong>Sections</strong> and switch on what you plan to use: Challenges, the Item Shop, Guilds, Tasks, the Garden and the rest, one card per section with its switch, its name and its background. <strong>Rules &amp; scoring</strong> holds grading, what XP, BLOO and EP are called in this adventure, Energy Points and the ranks. A lot of what follows, from map widgets to menu entries, only appears for sections that are on.</p>
<p>On a saved adventure every control saves the moment you change it, and the bar at the bottom says so. Every pane is described in <a href="/docs/complete-adventure-settings-reference">The Complete Adventure Settings Reference</a>.</p>

<h2>3. Create Milestones and Challenges</h2>
<p>Make a <strong>Milestone</strong> when you're giving players knowledge and a <strong>Challenge</strong> when you're testing it. A milestone is built from Steps (dialogue, video, slides, questions, uploads and more) in the order players meet them; a challenge is a bank of questions. See <a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a> and <a href="/docs/challenges-concept">Challenges</a>.</p>
<p>Every text box in the editors is the same rich-text editor: <strong>Add Media</strong> above it puts a picture from your media library into the text, and <strong>Toolbar Toggle</strong> shows a second row of tools that ends with <strong>Insert player data</strong>, for <a href="/docs/personalising-text-with-player-tokens">player tokens</a>. Every editor ends in the same bar along the bottom of the screen: the status (and, where it applies, who it's for) on one row, then Cancel, Preview or Duplicate, and the Create or Update button.</p>
<p>If you already have your content in a spreadsheet, most managers take a CSV file instead of one record at a time. See <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>4. Set Rewards and Unlock Rules</h2>
<p>On a milestone's <strong>Mechanics</strong> tab, set which Tabi it belongs to, its level, what it pays in XP and BLOO (and EP, if the adventure uses Energy), and a start date and deadline if it has them. Tick <strong>Optional</strong> for an extra that shouldn't count toward finishing its chapter.</p>
<p>The <strong>Advanced</strong> tab holds the extras: a Skill reward for the Garden, an Item Reward, an Achievement Reward, and <strong>Conditions</strong>: other milestones, achievements, a key item or thresholds a player must meet before it unlocks. Conditions become available once the milestone has been saved. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a> and <a href="/docs/conditions-when-things-unlock">Conditions</a>.</p>

<h2>5. Group Milestones Into Chapters</h2>
<p>A <strong>Tabi</strong> is a chapter: one tile on the map that opens onto its milestones, with its own progress bar and its own unlock rules. Build them from Manage Content's <strong>Tabis</strong> tab: the name and artwork, which Tabis must be finished first, and which milestones it holds. A Tabi can also carry artwork that evolves as each player progresses; see <a href="/docs/tabi-editor">The Tabi Editor</a> and <a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a>.</p>

<h2>6. Lay Out the Map</h2>
<p>Open the <strong>Journey Builder</strong>. Drag milestones and Tabis to where they belong; new ones all start in the same spot, so at first they may sit on top of each other. The palette along the top adds everything else: graphics, text, live widgets such as a leaderboard or a Tasks panel, single task hexagons and shortcut buttons, each at a depth of your choosing. Positions save when you let go, and <strong>Map centre</strong> sets where the map opens for players. See <a href="/docs/journey-builder-design-palette">The Journey Builder: Designing the Map</a>.</p>

<h2>7. Check It, Then Invite People</h2>
<p><strong>View journey</strong> in the Journey Builder opens the live map in a new tab. Only milestones with the <strong>Publish</strong> status appear on it; drafts stay out of sight until you publish them. When it looks right, move on to <a href="/docs/enrolling-players-and-roles">enrolling players</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
  <li><a href="/docs/journey-builder-design-palette">The Journey Builder: Designing the Map</a></li>
  <li><a href="/docs/tabi-editor">The Tabi Editor</a></li>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Enrolling Players & Assigning Roles',
                'slug'       => 'enrolling-players-and-roles',
                'section'    => 'setup',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>Everyone in an Adventure holds one role in it, and there are three ways to bring people in: add them yourself, import a CSV, or share the enrollment link. All of it happens on <strong>Manage Players</strong>; the Players pane of Adventure Settings only shows the counts and a button to open it. For the day-to-day tools once people are in, see <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>.</p>

<h2>Roles Inside an Adventure</h2>
<ul>
  <li><strong>Player</strong>: the default. Plays the Journey, and the Garden if the Adventure has one.</li>
  <li><strong>GM (Game Master)</strong>: runs the Adventure: edits its content, manages its players, grades, and sends its emails.</li>
  <li><strong>NPC</strong>: a read-only supervisor. An NPC sees everything a GM sees, including Stats, the roster, Player Records, player requests and sent emails, and plays the Adventure like a player, earning and spending like everyone else. An NPC can't change anything: no content edits, no adding or removing people, no email. The one exception is appointing a guild's leader. Use it for someone who needs to watch progress closely without being able to touch it, such as a line manager or a client lead.</li>
  <li><strong>Owner</strong>: the account the Adventure belongs to. The owner has full control and can't be removed or switched to another role.</li>
</ul>
<p>An NPC isn't a character in the story. Characters who speak in your milestones are Speakers; see <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>.</p>

<h2>Admin and God Are Account-Wide</h2>
<p>Admin and God aren't roles inside an Adventure. They're access levels on the account itself, set by a platform admin in User Management, and they apply across the whole platform: an admin can manage every Adventure, Sys Config and user accounts, and only a God can grant or revoke God. See <a href="/docs/user-management-and-access-levels">User Management and Access Levels</a>.</p>

<h2>Adding Players Yourself</h2>
<p>Open <strong>Manage Players</strong> and its <strong>Add Players</strong> tab. It has two ways in, one person at a time or a whole file.</p>

<h3>One at a time</h3>
<p><strong>Find someone already registered</strong> searches by first name, last name, nickname or email (type at least two characters). Several words narrow the results: "ana lopez" finds people matching both words, rather than every Ana and every Lopez. Each result says whether they're already here and has its own button: <strong>Add</strong> for someone new to this Adventure, <strong>Add back</strong> for someone you removed earlier, or <em>In this adventure</em> if they're already in. You can keep adding without reloading the page, and everyone you add is listed under <strong>Added in this session</strong>.</p>
<p>Not on the platform yet? Under <strong>Create a new account</strong>, enter their email (the only required field) and, optionally, a nickname, first and last name and password, then press <strong>Create and add</strong>. A free nickname is built from the email and a password is generated if you leave them blank; both are shown to you once the account exists.</p>

<h3>In bulk, from a CSV file</h3>
<ol>
  <li>Under <strong>Bulk import from CSV</strong>, choose your file and press <strong>Check file</strong>. <strong>Download CSV Template</strong> gives you a file with this Adventure's columns already in it.</li>
  <li>Review <strong>What will be imported</strong>: how each column was matched, shown before anything is written.</li>
  <li>Press <strong>Start import</strong> and watch the console: rows done, created, enrolled, already in and failed.</li>
  <li>When it finishes, download the report. It's the only place generated passwords are kept, so save it.</li>
</ol>
<p>Columns are matched <strong>by header name</strong>, so order doesn't matter and every column except <strong>Email</strong> is optional. It recognises Email, Nickname, Password, First Name, Last Name, Name (split into first and last), Language and Guild, plus every field you've set up in the Player Meta Manager; <strong>Which columns can the file have?</strong> on the tab lists them with what happens when each is blank. A blank password is generated, a nickname that's already taken gets a number added, and the <strong>Guild</strong> column puts each person into the guild with that name, creating the guild if it doesn't exist yet. Comma, semicolon and tab separated files all work, as do Excel's encodings.</p>
<p>The file is read in your browser and sent a few rows at a time, so a roster of a thousand people or more imports in one pass without timing out. Keep the tab open until it finishes. It's also safe to repeat: someone already enrolled is reported as <em>already in</em>, never duplicated, and when the run ends the importer checks the roster again and retries anyone who didn't land.</p>

<h3>Into guilds that already exist</h3>
<p>To fill guilds you've already created, use <strong>Assign players to a guild</strong> on the Guilds tab of Manage Content, or <strong>Bulk Assign Players (CSV)</strong> inside one guild's editor. Pick the guild, choose a CSV with one column of email addresses, and upload it. Everyone matched moves into that guild, which replaces any guild they were in before. A guild that reaches its capacity turns the rest away, and running the same file twice changes nothing the second time. See <a href="/docs/guilds-designing-team-play">Guilds</a>.</p>

<h2>Letting People Enroll Themselves</h2>
<p>Every Adventure has an <strong>Enrollment Link</strong>, shown on the Basics pane of Adventure Settings and under the Adventure's name on Manage Adventures. Anyone who opens it while signed in is enrolled on the spot and welcomed in. Someone who isn't signed in is sent to the sign-in page first, and the link is kept for them: once they sign in, or sign up, they land enrolled, without having to open the link again. Treat the link like a key: it works whatever the Adventure's Privacy setting says, so share it only with the people you mean to invite.</p>
<p>Three things stop it:</p>
<ul>
  <li><strong>Templates.</strong> A template can't be joined this way ("This adventure is a template"). Players join one of its cohorts instead; see <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</li>
  <li><strong>Max Players per Adventure</strong>, on the Basics pane. If you set it, the link refuses newcomers once that many people are enrolled ("Adventure Full"). It's your own limit for this one Adventure, it's checked only by the link, and adding people yourself isn't blocked by it.</li>
  <li><strong>Someone you removed.</strong> The link doesn't bring them back. They're told they were removed and to ask the Game Master to add them back, which you do with <strong>Activate</strong> on the Inactive tab or <strong>Add back</strong> in the search.</li>
</ul>
<p>If the Adventure has guilds and <strong>Assign guilds on login</strong> is set to Yes (Basics pane, Guilds &amp; schedule), a newcomer is also put into the published guild with the fewest members that still has room. Each guild has an enrollment link of its own too; see <a href="/docs/guilds-designing-team-play">Guilds</a>.</p>

<h2>Changing Roles and Removing People</h2>
<p>Switch roles on the <strong>Active</strong> tab of Manage Players: each row has a Player / GM / NPC switch, and the change asks first ("Make GM?", "Make NPC?"). The GM option only appears when your platform allows more than one Game Master. The owner's row can't be changed.</p>
<p>Removing someone asks first too: press <strong>Remove</strong>, then confirm. It doesn't delete their progress. They move to the <strong>Inactive</strong> tab, and <strong>Activate</strong> brings them back with everything intact. A GM can't be removed directly ("GMs can't be removed"); switch them to Player first. Platform administrators can't be removed from an Adventure.</p>

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
<p>A template is an ordinary Adventure whose <strong>Adventure Type</strong> is set to <em>Template</em> on the Basics pane of Adventure Settings. Only platform admins see that field. You build milestones, challenges, achievements, items and Tabis on the template exactly as you would anywhere else. Players can't join a template directly (its enrollment link turns them away); they join one of its cohorts.</p>

<h2>Starting a Cohort</h2>
<p>On <strong>My Adventures</strong>, choose <strong>From a template</strong> to open the <strong>Template Library</strong>. Each card shows who built the template, how many milestones, achievements, items and chapters it holds, and how many Adventures already use it. Press <strong>Use this template</strong> and a new cohort is created, named after the template with <em>[new child]</em> on the end, with you as its owner; continue from the confirmation to its Journey. The cohort has its own name and dates: an admin, or a GM of the cohort, changes them in its Cohort Settings or from <strong>Edit</strong> on Manage Adventures.</p>
<p>The Template Library is always available to admins. Everyone else sees it when the platform allows creating Adventures from a template.</p>

<h2>What the Template Shares, Live</h2>
<p>A cohort doesn't get a copy of the content. It reads the template's, so there is only ever one version:</p>
<ul>
  <li>milestones and their steps, challenges and their questions</li>
  <li>achievements, including the rank ladder, and the branches they belong to</li>
  <li>items, Tabis and the layout of the Journey map</li>
  <li>certificates, posts and resources, and the Library's study notes and glossary</li>
  <li>skills, encounters, consequences, profile tests and speakers</li>
  <li>which sections are switched on and what they're called, the menu, the quick links and the backgrounds</li>
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
<p>A few things start from the template and can be set per cohort:</p>
<ul>
  <li><strong>Cooper Context</strong> is copied into the cohort when it's created. After that each cohort has its own, so update it in the cohort's settings.</li>
  <li><strong>Cooper's Character</strong> follows the template unless the cohort sets its own.</li>
  <li><strong>The Claude API key</strong> follows the template unless the cohort saves its own (see below).</li>
</ul>

<h2>Missions and Tasks Come Along Automatically</h2>
<p>A new cohort starts with copies of the template's Garden missions and tasks. For a cohort created before that happened, or after you've added more to the template, open <strong>Missions &amp; Tasks</strong> from the cohort's menu. It lists the template's missions and tasks with their state in this cohort and one button per kind: <strong>Copy the N missing</strong>, or <strong>Restore the triggers</strong> for tasks that arrived without the milestone that completes them. It's safe to run again; nothing already in the cohort is copied twice.</p>
<p>A mission aimed at a guild arrives as a <strong>draft</strong>, because the template's guild means nothing in the cohort. It needs an audience from the cohort before it goes live.</p>

<h2>Guilds</h2>
<p>Guilds aren't copied into a new cohort, because they're about the people in it. Two ways to set them up:</p>
<ul>
  <li><strong>Import players with a Guild column</strong> into the cohort (Manage Players → Add Players). Each guild named in the file is created in the cohort as it goes.</li>
  <li><strong>Copy them with the Duplicator.</strong> Open it on the template, tick the guilds (and any missions aimed at them), choose the cohort under <strong>Duplicate into</strong>, and confirm. Copied guilds arrive empty, with no members, no XP and a new join code. A mission aimed at a guild copied in the same run is re-pointed at the copy; one left with no audience arrives as a draft rather than going out to everyone.</li>
</ul>
<p>Guilds can also be uploaded from a CSV on the cohort's Guilds tab; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>Who Holds an Achievement, Per Cohort</h2>
<p>Achievements are edited on the template, but who holds one is the cohort's. A cohort's Manage Content has its own <strong>Achievements</strong> tab for that: open an achievement to see the players in this cohort who hold it, remove one with a two-click Remove, give it to someone with <strong>Add</strong>, or upload a CSV of email addresses. A player on another path of the same branch is shown with the path they're on and a two-click <strong>Move here</strong>. Nothing reloads. <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a> covers the rest.</p>

<h2>QR Codes and Magic Links</h2>
<p>Achievements live on the template, but their QR codes are made per cohort, so a printed code credits the cohort it was made for. To get a cohort's QR code, open the achievement from inside that cohort; the editor tells you which Adventure the code redeems into. A milestone's QR code is simpler still: one printed code serves the template and every cohort, and a scan counts in the cohort the player is playing. A typed magic code works in every cohort and credits whichever Adventure the player redeems it in, but the editor's <strong>Magic Link</strong> and unique-code links point at the template, so in a cohort share the typed code or the cohort's QR instead. See <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes — Live &amp; Hybrid Event Checkpoints</a>.</p>

<h2>The A.I. Key</h2>
<p>Save your Claude API key once, on the template's <strong>Connections</strong> pane, and every cohort uses it. A cohort's Connections pane says when it's using the template's key; save a key there only if that cohort should use a different one. <strong>Test Key</strong> makes one real call and tells you whose key answered. Cooper uses the same key when an Adventure has one, so its conversations in every cohort are billed to it too. See <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>.</p>

<h2>Running a Cohort Day to Day</h2>
<p>A cohort has a full set of staff tools of its own, scoped entirely to its players. In the New view, the menu's <strong>Game master</strong> group for a cohort holds <strong>Build</strong> (Cohort settings, Template settings and Missions &amp; Tasks), <strong>Watch</strong> (Stats, Activity, Player records, Transactions) and <strong>Run</strong> (Players, Manage players, Player requests, Email notifications, Player meta, and Award Blooms when the Garden is on). The Classic menu's Admin Tools column has the same. A GM who only runs one cohort never has to touch the template to do their job. <strong>Template settings</strong> opens the template's Adventure Settings, for someone allowed to edit it.</p>
<p><strong>Cohort Settings</strong> only offers what that cohort actually owns: its name and dates, time zone, grading, what its currencies are called, Cooper, its connections (the A.I. key), its players and its resets. A panel at the top, <strong>From the template</strong>, says what comes from the template instead (the journey and its content, the sections and their names, the ranks, the menu and the backgrounds) with <strong>Open template settings</strong> when you're allowed to change them there.</p>

<h2>An Independent Copy Instead</h2>
<p>If you want a copy that <em>doesn't</em> follow the template, say a one-off variant you're going to change heavily, use <strong>Duplicate</strong> on Manage Adventures. You get a full, independent Adventure with its own milestones and steps, achievements, ranks and branches, items, Tabis and the journey map, encounters, speakers and sessions, certificates with their unlock conditions, and the Library's glossary, every reference between them remapped, and no player data. Duplicating a cohort copies the content it plays, which is its template's, plus the cohort's own guilds and tasks. Editing the copy never touches the original, and editing the original never touches the copy.</p>

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
<p>Billing lives entirely inside the app. This website never takes payment; it only points you to the app. The Terms of Service, the Privacy Policy and the Refund Policy you agree to in the app are published here: <a href="/terms">Terms</a>, <a href="/privacy">Privacy</a> and <a href="/refunds">Refunds</a>.</p>

<h2>Plans at a Glance</h2>
<ul>
  <li><strong>Basic</strong>: free. Up to 90 players across your account, 3 Adventures, 50MB of storage.</li>
  <li><strong>Pro</strong>: $8/mo or $80/yr (two months free on annual), with a 30-day free trial. Up to 250 players across your account, 20 Adventures, 200MB of storage.</li>
  <li><strong>Enterprise</strong>: no player, Adventure or storage limits, plus the features only Enterprise has (Organizations, Prize Draws, gift-card rewards, single sign-on and more). Sales-assisted: <a href="/contact">contact us</a> to talk it through.</li>
</ul>
<p>Moving from Basic to Pro raises all three caps; Enterprise removes them. See the <a href="/pricing">Pricing</a> page for the full comparison, and <a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a> for what Enterprise adds.</p>

<h2>Storage</h2>
<p>Storage counts every file an account uploads, across every Adventure: images, video and audio in the Media Manager (badges, backgrounds, profile pictures, pictures in rich text, submissions) plus SCORM packages. CSV uploads and the QR codes the app generates don't count.</p>
<ul>
  <li><strong>It's counted per uploader.</strong> A player's own submission images come out of that player's allowance, not the GM's, so a class can't fill up its facilitator's space.</li>
  <li><strong>You can see where you stand.</strong> A storage meter appears in the Media Manager and on the Billing tab of My Account.</li>
  <li><strong>Nothing is ever deleted.</strong> If an account is over its allowance (after a downgrade, say), it keeps every file but can't upload more until it's back under; an upload is refused with "Not enough storage". Deleting a file frees its space straight away.</li>
</ul>

<h2>Agreeing to the Terms</h2>
<p>You agree to the Terms of Service and the Privacy Policy when you create your account: the sign-up form has a box for it, and the account isn't created without it. Before you subscribe, the <strong>Subscription &amp; Billing</strong> page shows the trial and refund rules in plain words, with a second box: <em>I agree to the Terms of Service, including the refund policy.</em> Checkout won't open until it's ticked. The app keeps which version of the Terms you agreed to, and when.</p>

<h2>Upgrading and Your Pro Trial</h2>
<p>Plans are on the <strong>Subscription &amp; Billing</strong> page in the app (the <strong>View plans &amp; upgrade</strong> button on the Billing tab of My Account takes you there). Each plan card has a <strong>Monthly</strong> / <strong>Yearly</strong> choice and a <strong>Subscribe</strong> button that takes you to a secure Stripe checkout. Choose monthly or yearly when you subscribe: moving an existing subscription from one to the other isn't something you can do yourself yet. Your current plan is marked <strong>Your current plan</strong>.</p>
<p>First-time Pro subscribers get a <strong>30-day free trial</strong>:</p>
<ul>
  <li><strong>A card is required up front.</strong> Stripe asks for it when the trial starts, whichever interval you pick.</li>
  <li><strong>Nothing is charged during the trial.</strong> The page shows the date it ends, and you get an email about three days before it does, so the first charge never arrives unannounced.</li>
  <li><strong>When the trial ends, the card is charged automatically</strong> unless you cancel before then.</li>
  <li><strong>Pro renews until you cancel it yourself.</strong> Nothing switches it off for you.</li>
</ul>
<p>Someone who has subscribed before goes straight to a paid subscription; the trial is offered once.</p>

<h2>Managing and Cancelling Your Subscription</h2>
<p>The <strong>Manage billing</strong> button (on Subscription &amp; Billing and on the Billing tab of My Account) opens Stripe's billing portal. There you cancel, update your card and billing details, and see your invoices. The page shows your subscription's status: <em>Free trial</em>, <em>Active</em>, <em>Payment overdue</em> or <em>Cancelled</em>, with the date it renews.</p>
<p><strong>Cancelling stops the next renewal; it doesn't cut you off.</strong> You keep Pro until the end of the period you've paid for (the page then says <em>Access ends</em> and the date), nothing more is charged, and the account goes back to Basic when that period ends. Cancelling during the trial means you're never charged. Changing plans doesn't touch your existing Adventures or player data.</p>
<p>Not sure which plan an account is on? The Billing tab of <strong>My Account</strong> names it.</p>

<h2>Refunds</h2>
<p>The full rule is in the <a href="/refunds">Refund Policy</a>. In short:</p>
<ul>
  <li><strong>The month in progress is never refunded</strong>, and neither is a monthly plan's payment.</li>
  <li><strong>Unused months of a yearly plan can be.</strong> You get back what you paid, less the monthly price for every month that has started, the current one included. Forget to cancel a yearly plan after the trial and notice in its first month, and $72 of the $80 comes back.</li>
  <li>Refunds are made by our team: <a href="/contact">ask us</a>. A refund of unused months also ends the subscription straight away, and the account returns to Basic.</li>
</ul>
<p>When money goes back you get an email saying how much, and the invoice in your Billing History is marked <em>Refunded</em> or <em>Partly refunded</em>, with the amount.</p>

<h2>Billing History</h2>
<p>The Billing tab of My Account carries a <strong>Billing History</strong> table: every payment with its date, amount and status, plus links to view the invoice or download it as a PDF. Those are Stripe's own hosted invoices, so they're the real documents your finance team needs.</p>
<p>This is separate from the <strong>Transactions</strong> tab, which is in-game currency and item purchases inside Adventures. One is real money, the other isn't, and they're deliberately kept apart.</p>
<p>History is recorded from the point the feature went live, so older payments may not be listed. <a href="/contact">Ask us</a> if you need an older invoice.</p>

<h2>When a Payment Fails</h2>
<p>If a card is declined, <strong>we email you</strong> rather than leaving you to discover it, the Billing tab of My Account shows a warning asking you to update your payment method, and Subscription &amp; Billing shows the subscription as <em>Payment overdue</em> until it's sorted. Update the card from <strong>Manage billing</strong>.</p>

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
<p>The Journey Builder is where you design the map itself. Your milestones and Tabis are already on it once you've made them; the builder is where you arrange them and add everything else players will see — artwork, labels, live panels, shortcuts — at the depth you want. Open the <strong>Journey builder</strong> from the menu: it's under Build in the Game master group of the New view, and in the Admin Tools column of the Classic view. In an adventure made from a template, the map belongs to the template, so design it there.</p>

<h2>The Palette</h2>
<p>The toolbar along the top is a palette of things to place. Everything you add lands on the canvas ready to drag, resize and arrange.</p>
<ul>
  <li><strong>Add Graphic</strong> — drops an empty frame; use its <strong>Set image</strong> button to choose the picture. Fill in the optional <strong>Link URL</strong> first and players can click the graphic to open that link in a new tab.</li>
  <li><strong>Add Text</strong> — real words on the map, with an optional link. Text stays sharp at any zoom and can be edited later, so use it rather than pictures of words.</li>
  <li><strong>Add Task</strong> — pick one of the adventure's tasks by name and it lands as a hexagon bound to that task. Only there when Tasks is switched on.</li>
  <li><strong>Add Widget</strong> — a live panel that shows each player their own information.</li>
  <li><strong>Add Point</strong> — an invisible marker you can drop anywhere on the map purely as a destination, useful for a spot that doesn't need its own graphic. See "Naming Elements and Gliding to a Place" below.</li>
  <li><strong>Active Tabis</strong> — <strong>Show on the map</strong>: tick which Tabis appear as chapters. See "Switching a Tabi Off" below.</li>
  <li><strong>Nav Links</strong> — a button that takes players to another part of the adventure.</li>
  <li><strong>Working layer</strong> and <strong>Layers</strong> — for working with depth, below.</li>
  <li><strong>Map centre</strong> — lights up a marker you drag to where the map opens for players when they arrive on the journey. Until you move it, the map opens where it always has.</li>
  <li><strong>View journey</strong> — opens the live map in a new tab.</li>
</ul>
<p>The widget and link menus only offer what the adventure has switched on in Adventure Settings → Sections, so you can't place a shortcut into a feature players can't use.</p>

<h2>Widgets</h2>
<p>A widget reads whoever is looking at it, so two players see different numbers in the same spot.</p>
<ul>
  <li><strong>Status</strong> — the player's picture, level, and XP and BLOO bars (plus EP when Energy is on). Clicking it opens their profile panel.</li>
  <li><strong>Journey progress</strong> — how far through the whole journey they are.</li>
  <li><strong>Leaderboard</strong> (needs Leaderboard) and <strong>Guild leaderboard</strong> (needs Guilds). The guild board ranks guilds the way the Guilds page does, on their members' average, and shows each guild's level.</li>
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
<p>Put a button to any of the adventure's player-facing sections right where it belongs in the story, instead of leaving players to find it in the menu — not just the Item Shop, Magic Code and Journal, but any of the 24 sections the platform offers: the Journal, Achievements, Leaderboard, Item Shop, Backpack, Tabis, the Garden, Tasks, Missions, Guilds, Help Board, Wall, Posts, Resources, the Event Schedule, Speakers, Cooper, My Account and more. Each option is offered only when that feature is actually on, and each uses your platform's own name for that section.</p>

<h2>Posts &amp; Resources Feed Widgets</h2>
<p>Two widgets put your news feed right on the map: a <strong>Posts feed</strong> and a <strong>Resources feed</strong>. Point either one at a single post or resource to show it in place, or leave it open to show the newest items as a scrollable list — handy for in-world instructions or announcements players read without leaving the Journey.</p>

<h2>Arranging Things</h2>
<p>Hover over an object and its control bar appears above it. Double-click any element to open it in the Layers panel docked at the side instead, where the map stays fully visible while you work.</p>
<ul>
  <li><strong>Move</strong> — drag the object. Positions save when you let go; there's no Save button.</li>
  <li><strong>Size</strong> — drag the corner handle. Most elements resize freely now, rather than being locked to their original proportions; hold Shift to keep the proportions. Milestones and task hexagons always keep their shape. <strong>Reset Size</strong> on any image returns it to its natural size.</li>
  <li><strong>Rotate</strong> — graphics, text, widgets, nav links and task hexagons have a rotate handle to drag, with a one-click <strong>Reset</strong> back to zero.</li>
  <li><strong>Opacity and colour</strong> — graphics and text can be faded, even down to fully invisible (handy for an invisible clickable "hotspot" over a piece of background art), and text can take its own colour.</li>
  <li><strong>Animation</strong> — give any graphic a slow spin, clockwise or counter-clockwise, as a simple way to draw the eye to something on the map.</li>
  <li><strong>Stacking</strong> — <strong>Bring forward</strong> and <strong>Send back</strong> decide what draws on top. The number between them is the object's position within its depth, counting from 1.</li>
  <li><strong>Type</strong> — on a placed graphic, widget, nav link or task hexagon, the dropdown switches it to another of those kinds without losing its place.</li>
  <li><strong>Duplicate</strong> and <strong>Remove</strong>.</li>
  <li><strong>Locked with Tabi</strong> — tie an object to a Tabi and, while that Tabi is still locked for a player, the object shows greyed out and can't be clicked. Useful for a signpost or shortcut that belongs to a chapter. The picker appears once the adventure has Tabis.</li>
  <li><strong>Shown from level / Hidden from level</strong> — show or hide any element, not just milestones, once a player reaches a given level. Set either or both to make something appear for a window of levels only. If an element has a level rule, a small tag on it says so directly in the builder, so you're never left guessing why a test player can't see something.</li>
</ul>

<h2>Showing or Hiding by Achievement</h2>
<p>Beyond the level rule, any element you place on the map — a graphic, a Tabi, a milestone node — can also be shown only to players holding a specific achievement, or hidden from players holding a different one. Combine it with the level rule freely; both apply together. As a GM or admin, you'll still see a hidden element yourself, dimmed, with a plain-language note explaining why ("Shown from level 2; only to holders of Pilot"). Players never see it at all. This is also the recommended way to build "staff-only" content on the map: give your staff an achievement and gate the content to holders of it, rather than needing a separate staff flag.</p>

<h2>Naming Elements and Gliding to a Place</h2>
<p>Every element you place can now have a real name (shown in pickers and layer lists), instead of just a filename or a snippet of its text. Give your important landmarks a name once, and renaming your content later won't change it.</p>
<p>A <strong>Point</strong> (see the Palette, above) is an invisible marker you can drop anywhere on the map purely as a destination. A <strong>Glide button</strong> — or any graphic or text element — can be set to glide the camera smoothly to any named point, Tabi, milestone, or other element on the map when clicked, instead of opening a link or a post.</p>
<p>Every placed element, Tabi and milestone also has a <strong>Link to this spot</strong> button that copies a direct URL — opening that link (or typing it in) glides a player's map straight to that location when they land on the journey. Handy for pointing players at something specific from an email or announcement. One thing to keep in mind: if the destination is hidden from a player by a level or achievement rule, the glide link simply does nothing for them — give the button or link the same visibility rule as its destination if you want it to always work.</p>

<h2>Depth</h2>
<p>Everything on the map sits at one of four depths, and each moves at its own speed when a player pans or zooms — that's what gives the map its parallax:</p>
<ul>
  <li><strong>Deep</strong> (Deep background) — moves the slowest.</li>
  <li><strong>Back</strong> (Background).</li>
  <li><strong>Base</strong> — moves with the map. The only depth players can click.</li>
  <li><strong>Front</strong> (Foreground) — moves slightly faster than the map, for things nearer than the milestones.</li>
</ul>
<p>Behind all four, the grid backdrop drifts slowest of all.</p>
<p>A fifth option, <strong>Fixed</strong>, pins an element to the screen itself rather than the map — it stays in the same corner or edge as players pan and zoom around, instead of scrolling away. Useful for a decoration, button or link you want always on screen, like a persistent call-to-action.</p>
<p>Graphics, text, widgets, nav links and task hexagons have a <strong>Depth</strong> row in their bar: press Deep, Back, Base or Front to move the object there, and it lands at the bottom of that depth's stack. Anything a player needs to click — a linked graphic or text, a widget, a nav link, a task hexagon — has to stay on Base, because the other depths are decoration only.</p>
<ul>
  <li><strong>A milestone is always on Base</strong>, whatever you do. It has no depth buttons.</li>
  <li><strong>A Tabi that holds milestones is always on Base</strong>, because its milestones can only be reached through it; its bar shows the lock and how many milestones it holds instead of depth buttons. A Tabi with no milestones is scenery and can go at any depth.</li>
  <li>If you file a milestone into a Tabi that's sitting at another depth — from the Tabi editor, Manage Content or the milestone's own builder — the Tabi snaps back to Base, and a message tells you it moved.</li>
</ul>
<p>The builder pans and zooms like the player's map: drag the empty canvas to pan (hold <strong>Space</strong> to pan from over an object), use the wheel, a pinch or the zoom buttons to zoom, and <strong>Back to 100%, on the map centre</strong> returns you to the starting view. The depths don't drift apart while you work, so all four line up exactly as they will at the player's starting view. Open <strong>View journey</strong> to see them move.</p>

<h2>Switching a Tabi Off</h2>
<p>Unticking a Tabi in <strong>Active Tabis</strong> takes it out of the journey for players, everywhere at once: it has no tile on the map, it isn't a stage in the List view, a link to its window opens nothing, the menu's <strong>Continue</strong> never points into it, and its milestones are refused to a player who opens one by its address. Its milestones also leave every player's progress bars and percentages, so a switched-off chapter never leaves players looking at a bar they can't finish. A Tabi that waits for the switched-off one still counts it, so hiding a stage never re-locks the next one. Tick it again and everything is back. You still see a switched-off Tabi in the builder.</p>

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
<p>A <strong>Tabi</strong> is a chapter of the journey. It's a tile on the map that opens onto a group of milestones, a collectable picture players assemble from pieces, or the journey's background art: one of the three, never two. This page covers setting one up, from its settings and unlock rules to the full-page editor where you arrange its frame and pieces.</p>

<h2>The Tabis Tab</h2>
<p>Go to <strong>Manage Content</strong> and open the <strong>Tabis</strong> tab. <strong>Add Tabi</strong> creates a new one. Every Tabi is a numbered row you can edit in place: its name, its picture (the artwork behind it on the map), its colour, its level, its width and height, and two boxes:</p>
<ul>
  <li><strong>Node</strong> draws the Tabi on the journey map as a chapter holding its milestones. It's the same switch as the Journey Builder's Active Tabis menu.</li>
  <li><strong>Background</strong> makes it the journey's background instead (see <a href="/docs/evolving-tabis-scene-builder">Evolving Tabis</a>). A Tabi that holds milestones or pieces can't become one, and the tab says why.</li>
</ul>
<p>Under each row are <strong>Edit Tabi</strong> (its settings page), <strong>Frame and pieces</strong> (the Tabi editor, below), <strong>Evolving scene</strong> (straight to the Scene Builder), <strong>Prerequisites</strong>, <strong>Conditions</strong> and <strong>Trash</strong>. The bar above the list searches by name, filters to chapters, collections or backgrounds, and sorts. When the adventure has no Tabis yet, the Journey Builder's Active Tabis menu and the empty journey both link to creating one. Many Tabis at once can come in from a CSV file; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>Settings</h2>
<p><strong>Edit Tabi</strong> opens its settings page. A brand-new Tabi shows only its settings: prerequisites, milestones, pieces and the scene all attach to a Tabi that exists, so give it a name and press <strong>Create Tabi</strong> first. After that the page has <strong>Settings</strong>, <strong>Prerequisites</strong>, <strong>Milestones</strong>, <strong>Pieces</strong> and <strong>Scene</strong>, and <strong>Update Tabi</strong> saves the settings.</p>
<ul>
  <li><strong>Name</strong>.</li>
  <li><strong>Background</strong>: the artwork behind the Tabi on the journey map.</li>
  <li><strong>Colour</strong>.</li>
  <li><strong>Level</strong>: where the Tabi sits in the journey's order. It sorts chapters; it doesn't gate them.</li>
  <li><strong>What this Tabi is</strong>: <strong>A chapter on the journey map</strong> draws it on the map and groups its milestones under it; <strong>A collectable, built from pieces</strong> makes it a collectable Tabi instead; <strong>The journey background</strong> fills the screen behind the map.</li>
  <li><strong>Name on the journey map</strong>: Shown or Hidden. Hide the label under a chapter when its artwork already says what it is.</li>
  <li><strong>Status</strong>: Published or Draft.</li>
</ul>
<p>Position isn't typed in here. Drag the Tabi into place in the <a href="/docs/journey-builder-design-palette">Journey Builder</a>; its size is set there by dragging an edge, on the Tabis tab, or in the Tabi editor's Frame panel.</p>

<h2>Prerequisites</h2>
<p>Tick other Tabis and this one stays locked until every ticked Tabi is finished; leave them all unticked and it's open from the start. Press <strong>Save prerequisites</strong>: this section saves on its own. The same ticks are under the row's <strong>Prerequisites</strong> on the Tabis tab, where each one saves as you tick it. A player who opens a locked chapter sees which chapters to finish first.</p>

<h2>Conditions: What the Tabi Itself Waits For</h2>
<p>A Tabi can also wait for things other than Tabis. The row's <strong>Conditions</strong> button opens its drawer:</p>
<ul>
  <li><strong>Milestones in this Tabi</strong>: tick to file a milestone in or out. Each tick saves immediately.</li>
  <li><strong>Requires these milestones completed</strong>, <strong>Requires these achievements</strong> and <strong>Requires this key item</strong>: the player must have finished, hold or be carrying each one you tick.</li>
  <li><strong>Threshold conditions</strong>: numbers such as level, journey completion % or milestones completed. Leave a box blank to skip it.</li>
</ul>
<p>Press <strong>Save Conditions</strong>. Until a player meets every rule, the Tabi stays locked for them, on the map and in the List view, and the menu's Continue doesn't lead into it. Staff always pass. For rules on one milestone rather than a whole chapter, gate the milestone itself with <a href="/docs/conditions-when-things-unlock">Conditions</a>.</p>

<h2>Milestones</h2>
<p>This section lists what's filed under the Tabi, with each milestone's level, type and status, and a <strong>Remove</strong> button to take one out. <strong>Add an existing milestone</strong> offers any milestone that isn't in a Tabi yet; <strong>New milestone</strong> and <strong>New challenge</strong> start fresh ones. You can also choose the Tabi from the <strong>Tabi</strong> dropdown on a milestone's own Mechanics tab, or tick it in the Conditions drawer above.</p>
<p>A player finishes the Tabi by finishing its milestones. What counts:</p>
<ul>
  <li>Milestones, challenges and profile tests that aren't marked <strong>Optional</strong>. Optional ones are extras and don't count.</li>
  <li>Published, locked and hidden ones all count, so a milestone you've locked keeps the chapter unfinished until you unlock it. Drafts don't count.</li>
</ul>
<p>Filed milestones appear inside the Tabi's tile, not loose on the map. That's why a Tabi that holds milestones always stays on the Base depth, where players can click it: file a milestone into a Tabi sitting in the background and the Tabi moves back to Base, with a message saying so. For the same reason, don't file milestones into a collectable or background Tabi: it has no tile on the map to open them from.</p>

<h2>The Chapter's Badge</h2>
<p>When a player opens a chapter, it starts with a progress bar: the milestones they've finished out of the chapter's total. To point that bar at a badge, create an achievement with a <strong>Complete This Tabi</strong> condition for this Tabi. The bar then reads <em>Working towards</em> with the achievement's name and artwork, and <em>Stage complete</em> when they get there, while the achievement itself is awarded by its condition. Without one, the bar reads <em>Progress towards this stage</em>. See <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>

<h2>Pieces</h2>
<p>A collectable Tabi is built from <strong>pieces</strong>: items of the <strong>Tabi Piece</strong> type that point at this Tabi. <strong>New piece</strong> opens the item editor: set the type to Tabi Piece and choose this Tabi. Pieces can be sold in the Item Shop, where each is labelled as part of its Tabi, or handed out as rewards. Manage Items lists them too, under their own Tabi Pieces filter, each with a link to its Tabi. Players see their collection on the <strong>Tabis</strong> page of the Item Shop section, and a piece they hold opens its card. See <a href="/docs/item-shop-building-an-economy">Building an Item Shop Economy</a>.</p>

<h2>The Tabi Editor: Frame and Pieces</h2>
<p><strong>Open the Tabi editor</strong> (or <strong>Frame and pieces</strong> on the Tabis tab) opens a full page built on the same pan-and-zoom canvas as the Journey Builder: drag on the art to select, drag outside it or hold Space to pan, and use the wheel to zoom. Changes save as you make them, and the page says "All changes saved".</p>
<ul>
  <li><strong>Pieces</strong>: drag, resize, turn (Shift for 15° steps), mirror, straighten and restack them; align their edges or centres, spread them with even gaps, and snap to the frame and to each other (hold Alt to move freely). <strong>Add a piece</strong> creates a new one in the middle of the Tabi. The <strong>Layers</strong> list shows them front to back, and a piece can be locked so it can't be picked on the art. Undo and redo are Ctrl+Z and Ctrl+Shift+Z.</li>
  <li><strong>Frame</strong>, shown when nothing is selected: the Tabi's <strong>Width</strong> and <strong>Height</strong>, the same box as its node on the journey map and the frame its evolving scene is composed in, with <strong>Match the art</strong> (keep the width, make the height match the picture) and <strong>Square</strong>. Then how the art fills it: <strong>Size</strong> (fit inside, fill and crop, stretch, fit the width, fit the height, or actual size), <strong>Repeat</strong> (no repeat, or tiled several ways) and <strong>Position</strong>, one of nine spots. A Tabi you've never set keeps the old look, a square with the art stretched to it, until you pick a size.</li>
  <li><strong>Preview</strong> shows it as players do: cut to the frame, no handles.</li>
</ul>

<h2>Scene</h2>
<p>The <strong>Scene</strong> section holds the Tabi's evolving artwork (the table of what grows, and when), with <strong>Open Scene Builder</strong> to place the art inside the Tabi's frame. That's covered in <a href="/docs/evolving-tabis-scene-builder">Evolving Tabis &amp; the Scene Builder</a>.</p>

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
  <li>An achievement is held — each step names its own achievement: the pilot's console once they hold one badge, the captain's chair once they hold the next</li>
</ul>
<p>The guild conditions depend on teammates too, so a whole guild can watch one scene grow together. The two peer conditions count only the Blooms players chose to give each other — gifts and endorsements — not Blooms paid out by the adventure or awarded by staff. See <a href="/docs/skills-and-blooms-explained">Skills &amp; Blooms</a>.</p>

<h2>Growing Gradually</h2>
<p>On a numeric row, every step except the last has a <strong>Grow gradually</strong> checkbox. Tick it and the artwork fills in between that step's value and the next one, instead of appearing all at once: with steps at level 3 and level 5, a level-4 player sees it half drawn. Choose which way it fills — Up, Down, Left or Right.</p>

<h2>Building the Table</h2>
<p>Open the Tabi's settings (<strong>Edit Tabi</strong>, see <a href="/docs/tabi-editor">The Tabi Editor</a>) and go to its <strong>Scene</strong> section, or press <strong>Evolving scene</strong> on the Tabi's row in Manage Content. A scene is created the first time you open the Scene Builder; there's nothing to set up beforehand. Then:</p>
<ol>
  <li>Add a row: name what evolves ("The building") and choose what it grows with.</li>
  <li>Fill in each step's value — a number, or the milestone or Tabi it waits for — and press <strong>Set art</strong> to choose its artwork.</li>
  <li>Press <strong>Next step</strong> to add the following step to the row.</li>
</ol>
<p>Rows and steps save as you change them. <strong>Remove row</strong> deletes a whole row, and each step has its own remove button. In the Scene Builder, <strong>Edit the table</strong> opens the same table over the canvas.</p>

<h2>The Scene Builder</h2>
<p>The Scene Builder is where you place the artwork. Its canvas is the journey itself: the rest of the map — other Tabis, graphics, widgets and milestones — is drawn as fixed placeholders at their real positions, so you design against what will actually surround the scene. None of it can be changed from here; only this Tabi is yours to edit. The canvas pans and zooms like the Journey Builder's: drag empty space to pan and use the wheel or a pinch to zoom.</p>
<ul>
  <li><strong>The frame is the Tabi.</strong> All of a scene's artwork lives inside the Tabi's frame and is clipped to it, exactly as it is on the map and in the chapter's panel. The frame's shape, and how the Tabi's own art fills it, are set in the Tabi editor's Frame panel.</li>
  <li><strong>Drag the label above the frame</strong> to move the Tabi on the journey, and <strong>drag an edge</strong> to resize it. Both change the real Tabi. Resizing doesn't move or scale the artwork; whatever falls past the new edge is clipped.</li>
  <li><strong>Click a piece of artwork</strong> to select it, then drag it freely within the frame — it no longer has to stay boxed inside the Tabi's edges, just keep a small grip visible — resize it (even past the frame's edge if you need to), or turn it with its rotate handle. The selection bar holds <strong>Artwork</strong> (swap the image), <strong>Send back</strong> and <strong>Bring forward</strong> with its layer number, <strong>Edit row</strong> and <strong>Remove</strong>.</li>
  <li>The toolbar has <strong>Edit the table</strong>, <strong>Find this Tabi</strong>, toggles for <strong>Journey</strong> (the placeholders), <strong>Tabi image</strong> and <strong>Ghost inactive</strong>, and <strong>Back to Tabis</strong>.</li>
</ul>
<p>Artwork whose image can't be found shows a placeholder instead of vanishing, so you can select it and choose new artwork.</p>

<h2>Preview as a Player</h2>
<p>Your own account has probably reached none of your later steps, which would leave you placing art you can't see. The <strong>Preview as a player</strong> panel lets you set a pretend player's level, XP, this Tabi's %, journey %, guild level, guild members and milestones completed; with <strong>Ghost inactive</strong> on, the canvas ghosts whatever that player wouldn't see. The panel can be dragged out of the way by its header.</p>

<h2>Scene Settings</h2>
<p>Two settings in the same panel apply to the whole scene:</p>
<ul>
  <li><strong>Show on the journey map</strong> — <strong>Yes</strong> for a new scene: it's drawn over the Tabi on the map and inside the chapter's window when a player opens it. Set it to <strong>No</strong> to keep the scene inside the window only. The same switch is on the Tabi's settings page, in its Scene section, as <strong>Show the scene on the journey map</strong>. It only applies to Tabis that are chapters on the map, since those are the ones the map draws at all.</li>
  <li><strong>Whole-scene mood</strong> — <strong>None</strong>, or <strong>Fade when the player is away</strong>, which desaturates the whole scene the longer it's been since the player's last visit.</li>
</ul>

<h2>What Players See</h2>
<p>When a player opens the chapter, the scene is shown full size, with a <strong>Next:</strong> line underneath naming what grows it next — "Reach level 5", for example. The scene stays hidden while the chapter is locked, so it can't give away what's inside. On the map, if you've turned it on, the scene sits over the Tabi's tile at the Tabi's depth. Staff see a scene as far as their own account has reached, not fully grown, so use the preview to check the later steps.</p>

<h2>Background Tabis</h2>
<p>A Tabi doesn't have to be a clickable spot on the map. Set its <strong>What this Tabi is</strong> setting to <strong>The journey background</strong> (or tick <strong>Background</strong> on its row in Manage Content), instead of a chapter or a collectable. A background Tabi has no node on the map at all — instead, its Scene Builder art fills the entire screen behind the journey, scaled to cover and centred, and evolves the same way any Scene Builder art does as the player progresses. It takes no clicks, and it's never locked.</p>
<p>A couple of rules to know: a Tabi can only become a background if it isn't already holding milestones or pieces — clear those out first, or the switch is refused and tells you why. Once it's a background, its scene is always drawn behind the map for as long as the background is shown on the map (the Journey Builder's Active Tabis), and it has no separate "show on the map" setting of its own.</p>
<p>The <strong>An achievement is held</strong> condition suits a background well: give each step its own achievement and the room fills in, piece by piece, as a player earns them.</p>

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
  <li><strong>Milestone</strong> — you're <em>providing</em> knowledge. Content, exercises, submissions, media, hands-on activities. You build it out of Steps, and there are 31 Step types to pick from, so a Milestone can be almost anything.</li>
  <li><strong>Challenge</strong> — you're <em>testing</em> knowledge. A question bank in six kinds of question, a subset shown per attempt, a pass threshold, and a limited number of retries. See <a href="/docs/challenges-concept">Challenges — Concept</a>.</li>
</ul>
<p>If you're not sure, ask whether a player could plausibly fail. If yes, it's a Challenge. If they just need to go through it, it's a Milestone.</p>

<h2>The Basics</h2>
<p>The builder's <strong>Basic</strong> tab holds the Milestone's Name, Color, Icon and <strong>Main Image</strong> (required), which is the badge that represents it on the map. It also holds <strong>Autoload?</strong>. Once the Milestone is saved, its check-in QR code appears beside the Main Image with a <strong>Download QR</strong> button; see <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>.</p>

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
  <li><strong>XP, BLOO and EP</strong> — what it pays on completion, each field named the way this adventure names it. The EP field is always there, but players only see and spend energy when the adventure's <strong>Energy Points (EP)</strong> switch is on (Adventure Settings → Rules &amp; scoring).</li>
  <li><strong>Start Date</strong> and <strong>Deadline</strong> — date-gate it on either end, in the adventure's own time zone. Before the start date it isn't open yet; after the deadline it has expired. <strong>Hide milestones outside the dates</strong> (Adventure Settings → Basics) decides whether players still see it outside that window.</li>
  <li><strong>Unlock cost</strong> and <strong>Deadline cost</strong> — prices in BLOO (named the adventure's way). With an unlock cost, players pay that much to open the milestone; 0 makes it free. With a deadline cost, once the deadline passes players can pay that much to reopen it; 0 means it stays closed. The player confirms before anything is spent.</li>
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
  <li><strong>Quest Context</strong> — private, for GMs and the A.I. review: the background, the goals and what good work looks like across the whole Milestone. It's sent to the A.I. with every Open Text check, so put question-specific rubrics on each Open Text step instead. Players never see it, except on a Milestone with no steps, where it's shown to them as the question.</li>
  <li><strong>Success Message</strong> — the text of the win screen every Milestone ends on, and what the player finds on their <a href="/docs/certificates-and-secrets-and-clues">Secrets &amp; Clues</a> page once they've finished.</li>
  <li><strong>Failure Message</strong> — the text of the fail screen. It's only reached if something in the Milestone can actually fail: a question with limited tries that runs out, or a step that sends the player there.</li>
</ul>
<p>Leave either message blank and standard wording is used.</p>

<h2>Attempts</h2>
<p>A Milestone is played in attempts, like a Challenge. A player's attempt starts when they open it and carries on if they leave and come back; it ends when they finish it or fail it. Failing clears that attempt's answers, and the fail card says so: "Attempt 1 is over and its answers were cleared. Try again starts attempt 2." From the second attempt on, the step bar shows the attempt number beside the step count. There's no limit on how many attempts a player gets; the limits live on individual steps, as <strong>Maximum attempts</strong>. See <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a>.</p>

<h2>Paths</h2>
<p>If your Adventure uses paths or ranks, the builder's bottom bar has a <strong>Visible to path</strong> menu. A Milestone can be left on <strong>All paths</strong> or restricted to a single one, so players on the Engineering track never see the Sales content. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</p>

<h2>Grading and When Rewards Land</h2>
<p>Grading is set once per adventure, not per Milestone. It lives in the <strong>Grading</strong> panel of Adventure Settings → Rules &amp; scoring:</p>
<ul>
  <li><strong>Grade scale</strong> — None, Percentage, or GPA (letters).</li>
  <li><strong>When players get rewards</strong> — <strong>Before Grading</strong> (rewards land when the player completes the Milestone) or <strong>After Grading</strong> (they land once a Game Master marks it above zero, and the BLOO is scaled by the mark, so 25 BLOO at 60% pays 15). After Grading needs a grade scale.</li>
</ul>
<p>After Grading applies to Challenges too. A passed Challenge pays its XP and EP, and its BLOO is scaled by the player's best score on it. Challenges also add their own layer on top (questions per attempt, answers to win, a time limit, attempt caps and costs); see <a href="/docs/challenges-concept">Challenges — Concept</a>.</p>

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
<p><strong>Duplicate</strong> in the bottom bar copies a Milestone with all of its Steps (or a Challenge with all of its questions) into the same adventure or a different one (<strong>Select destination</strong>), so a well-built Milestone becomes a template you reuse rather than rebuild. To create many Milestones at once from a spreadsheet, see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

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
<p>Choose <strong>Milestone</strong> in the menu's Add group (<strong>New Milestone</strong> under Add Mechanics in the Classic view), or use the button on Manage Content's Journey tab. On the <strong>Basic</strong> tab give it a Name, Color, Icon and Main Image, then press <strong>Create Milestone</strong> in the bottom bar.</p>
<p>Save before going any further. The Steps tab reads "Save the milestone first" until the Milestone exists, and the Conditions drawer stays disabled, because every Step and every condition attaches to a Milestone that already exists. A saved Milestone with no steps says so on its Steps tab: until you add one, players who open it find nothing to do.</p>

<h2>3. Build the Steps the Player Will Follow</h2>
<p>This is the real work, and where the design happens. A Milestone is a sequence of Steps, and each Step has a <strong>type</strong> that decides what the player does at that moment: read a character's dialogue, watch a video, page through slides, answer a question correctly, upload something, pick a path. There are 31 types in six groups, and picking the right one is most of what makes a Milestone good rather than flat.</p>
<ol>
  <li><strong>Add Step.</strong> A new step appears at the end of the list and the <strong>Edit Step</strong> window opens over the builder.</li>
  <li><strong>Choose the Step Type.</strong> The menu is grouped Deliver, Validate, Collect, Profile, Flow and Special, and the editor changes to show only the settings that type needs: a Multiple Choice step asks for options and correct answers, a Slides step asks for a PDF, a Cryptex step asks for accepted answers and a wheel count. The Profile group only appears once the adventure has a published profile.</li>
  <li><strong>Fill it in</strong>: the admin-only Label (so you can find it later), whether the step is Required, the type's own settings, an optional Background, and any Step Rewards it should pay out on its own. Text goes in the same rich-text editor every box uses.</li>
  <li><strong>Save Step</strong> to save it, or <strong>Cancel</strong>. The <strong>?</strong> button in the editor's header runs a short guided tour of it.</li>
</ol>
<p>Each row in the step list has Duplicate, Edit and Delete buttons, and rows can be dragged to reorder at any time. A SCORM, case study or video row also links to its own report.</p>

<h3>Dialogue: Pick a Speaker From the Cast</h3>
<p>A Dialogue step's <strong>Who is speaking</strong> menu lists the adventure's speakers. Pick one and the name and portrait come from the cast, so a character looks the same on every line and a new portrait updates all of them at once. Choose <strong>Custom — set a name and portrait below</strong> for a one-off character. See <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>.</p>

<h3>Profile Questions in Bulk</h3>
<p>When the adventure has a profile, the Steps tab also offers <strong>Paste a question set</strong>. Write the questions in a text editor, paste them in, press <strong>Check it</strong>, then <strong>Add these questions</strong>. They're added after the steps already there; nothing is replaced. See <a href="/docs/profile-tests">Profile Tests</a>.</p>

<p>Full detail on every type is in <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a>, and there's a one-screen lookup in the <a href="/docs/step-type-quick-reference">Step Type Quick Reference</a>.</p>
<p><em>A note on pacing:</em> alternate the groups. A run of four Deliver steps reads like a slide deck; a run of four Validate steps reads like an exam. Deliver, then ask; deliver, then ask.</p>

<h2>4. Write the Endings</h2>
<p>Every Milestone already ends on a win screen, and has a fail screen for players who run out of tries, so you don't need to add either as a Step. Their text comes from the <strong>Success Message</strong> and <strong>Failure Message</strong> on the Content tab, with standard wording if you leave them blank. When a player presses <strong>Finish</strong>, the result lands as a gold card with what the Milestone paid counting up (or <em>Handed in</em>, when its rewards wait for a Game Master's mark), and any item or achievement it gave follows once the card closes. A fail lands as a red card with <strong>Try again</strong> and <strong>Back to the journey</strong>. Add a Win Screen or Fail Screen step only when you want a custom ending: it replaces the standard one wherever it sits in the list.</p>

<h2>5. Set the Requirements and Rewards</h2>
<p>Level, dates and the XP/BLOO/EP payout are on the Mechanics tab. The Advanced tab has the <strong>Conditions</strong> drawer (prerequisite milestones, achievements, a key item, number thresholds) and the <strong>Item Reward</strong>, <strong>Achievement Reward</strong> and <strong>Skill Reward</strong> choices. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a>.</p>

<h2>6. Update the Milestone</h2>
<p>Press <strong>Update Milestone</strong>. The Conditions drawer saves itself with its own button; everything else, including the two reward drawers, is saved here. The save answers in a panel that stays until you close it, and if something is missing it lists every reason.</p>

<h2>7. Play It, Then Check the Results</h2>
<p>Once the Milestone is saved, the builder's header carries two links, each opening in a new tab:</p>
<ul>
  <li><strong>View Milestone</strong>: the play page, exactly as players see it. As a Game Master you can open it whatever its gating says, and the top bar carries a staff-only <strong>Jump to a step</strong> menu: skip to any step or ending past its locks, or press <strong>Edit steps</strong> to go back to the editor.</li>
  <li><strong>Review Content</strong>: every player's submission for this Milestone, where you grade, validate, leave feedback the player can see, and export or import grades as CSV. See <a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>.</li>
</ul>

<h2>8. Put It on the Map</h2>
<p>Two ways, and most Adventures use both:</p>
<ul>
  <li><strong>Group it into a Tabi</strong>: pick one in the Mechanics tab's <strong>Tabi</strong> menu. A Tabi is a chapter on the Journey Map that holds a set of Milestones, and it can carry its own prerequisites and conditions so a whole region unlocks at once. See <a href="/docs/tabi-editor">The Tabi Editor</a>.</li>
  <li><strong>Use the Journey Builder</strong>: drag the Milestone into the exact position you want on the canvas, and resize it if it deserves more visual weight than its neighbours. Milestones always sit on the Base layer, the one players can click. See <a href="/docs/journey-builder-design-palette">The Journey Builder</a>.</li>
</ul>

<h2>9. Repeat</h2>
<p>Add as many Milestones as the program needs, grouped into as many Tabis as the shape of the content calls for. Build one end-to-end first and play it yourself before mass-producing the rest: pacing problems are much cheaper to find in the first Milestone than in the twelfth. If the titles and rewards of the rest already sit in a spreadsheet, the Journey tab's <strong>Bulk Upload</strong> creates them in one go; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

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
<p>There are <strong>31 Step types</strong>, and the builder's <strong>Step Type</strong> menu groups them into six groups by what they ask of the player. That grouping is the useful way to think about pacing, so it's how this page is organised.</p>

<h2>What Every Step Has</h2>
<p>Whatever type you pick, each Step shares the same frame:</p>
<ul>
  <li><strong>Label</strong>: admin reference only. Players never see it (the one exception is a Choice Board, below); you'll be grateful for it at Step 14.</li>
  <li><strong>Required?</strong>: "Yes must complete to advance" or "No optional step". A required step has to be done before the Milestone counts as complete. On Collect and Profile steps an optional one also lets the player press Continue without answering; steps that check an answer, Open Text and the Flow choices always wait for a response.</li>
  <li><strong>Background</strong>: a background image for the scene.</li>
  <li><strong>Step Rewards</strong>: XP, BLOO, EP (named the way this adventure names them), an Item Reward and/or an Achievement Reward, granted on completion.</li>
  <li><strong>Mistake Message</strong> and <strong>Maximum attempts</strong>: on the types that can be answered wrongly. See Tries below.</li>
</ul>
<p>A player moves through the steps with the step bar along the bottom of the screen: <strong>Previous</strong>, the step count (and the attempt number from a second attempt on), and <strong>Continue</strong>, which stays locked with a line saying what opens it until the step is done.</p>

<h2>Every Milestone Ends on a Win or a Fail</h2>
<p>You never have to author an ending. The last step's <strong>Continue</strong> takes the player to a win screen, and <strong>Finish</strong> there completes the Milestone: the result lands as a gold card with what it paid counting up. A player who runs out of tries lands on a fail screen, and its red card ends that attempt: their answers for the Milestone are cleared, <strong>Try again</strong> starts the next attempt from the top, and rewards they've already earned stay theirs. The two screens use the Milestone's Success Message and Failure Message, or standard wording if those are blank. The Win Screen and Fail Screen step types (under Special) replace them when you want something custom.</p>

<h2>Tries</h2>
<p><strong>Maximum attempts</strong> sits with the Mistake Message. Leave it at 0 for unlimited tries. Any other number limits the tries on that step, and running out fails the whole Milestone: the player is sent to its fail screen and starts a new attempt, with fresh tries. The limit is enforced by the server, so once it's spent even a correct answer is refused.</p>
<p>It works on <strong>Multiple Choice</strong>, <strong>Keyphrase</strong>, <strong>Cryptex</strong> and <strong>Require Backpack Item</strong>. Each of them tells the player their tries from the first look ("You have 3 tries", then "2 tries left", then a red "Last try"). Only a submitted answer spends one: picking options spends nothing, and an empty answer or the wrong number of picks on a "Choose 2" question is pointed out in the step and not counted. When the last try goes wrong, the step locks, says why, and moves on to the fail screen. The field also shows on Puzzle and SCORM Package, where there's nothing to get wrong, so leave it at 0 there.</p>

<h2>Read It Again</h2>
<p>A question often comes right after the content it asks about. On Multiple Choice, Keyphrase, Cryptex and Open Text steps, <strong>Read it again</strong> opens a panel over the question with the words of the steps before it (the speaker's name and face included), and <strong>Back to the question</strong> returns with the pick, the typed answer and the tries left exactly as they were. It lights up after a wrong answer. A video, audio, gallery or slides step before the question appears as a row with "Watch it again" and the like, which goes back to that step; a chip under the top bar brings the player straight back to the question. Nothing to set up: it follows the order the player actually came through.</p>

<h2>Deliver — Auto-Complete on View</h2>
<p>Content the player receives. Nothing to get right; they read, watch, or listen and continue.</p>
<ul>
  <li><strong>Dialogue</strong>: a character speaks. Set the <strong>Character Position</strong> (no one, just describing the scene; on the left; or on the right) and <strong>Who is speaking</strong>: a speaker from the adventure's cast, or <strong>Custom</strong> with a Character Name and Character Image (best at 9:16). Naming a speaker means the name and portrait follow the cast; see <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>. The workhorse of narrative pacing.</li>
  <li><strong>Video</strong>: plays a video file you upload. Watch time is tracked per player, and Manage Content grows a Videos tab once the adventure has a video step. See <a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a>.</li>
  <li><strong>Audio</strong>: plays an audio file in a player widget. Good for language work, podcast-style briefings, or anything voice-led.</li>
  <li><strong>Gallery</strong>: up to seven pictures that fill the step, cut apart on a slant and laid out by how many there are. Players open any of them full screen and zoom in to search it, which makes it good for a scene to study or a set of exhibits.</li>
  <li><strong>Slides (PDF)</strong>: a deck saved as a PDF (PowerPoint, Keynote, Google Slides and Canva can all export one). Players go through it a slide at a time and can zoom into any slide, and reaching the last slide completes the step. Animations, transitions and embedded video aren't kept.</li>
  <li><strong>Find Item</strong>: the player is handed the item you choose (<strong>Item to grant</strong>), which lands in their Backpack. A reward beat with no test attached, and the natural setup for a later <em>Require Backpack Item</em> step.</li>
</ul>

<h2>Validate — The Player Must Answer Correctly</h2>
<p>Continue stays locked until they get it right. Each of these can carry a Mistake Message for wrong attempts.</p>
<ul>
  <li><strong>Multiple Choice</strong>: a question, an optional question image, and your options. Tick the box beside each correct answer, and choose whether players may select more than one (<strong>Allow multiple answers?</strong>). The fastest comprehension check there is.</li>
  <li><strong>Keyphrase</strong>: the player types a word or phrase. You supply a <strong>Prompt / Question</strong> and a comma-separated list of <strong>Accepted Answers</strong> (any match passes) and decide whether case matters. Excellent for in-person events: put the phrase on a slide, a poster, or a physical prop.</li>
  <li><strong>Cryptex</strong>: the same accepted-answers idea rendered as a combination lock the player turns. Its wheels hold A–Z and 0–9, so spaces, accents and punctuation are ignored ("Da Vinci" needs 7 wheels); set the <strong>Wheel Count</strong> (up to 20) and the editor warns you if no accepted answer fits it. Reach for it when the answer <em>should</em> feel like cracking something open.</li>
  <li><strong>Puzzle</strong>: a jigsaw cut from an image you upload, on a grid of <strong>Columns</strong> and <strong>Rows</strong> you choose. <strong>Turned pieces</strong> starts the pieces rotated so players tap one to turn it, and <strong>Show the picture</strong> keeps a small copy in a corner, like the box lid; each makes it easier or harder. Low information density, high engagement: a change of pace, not a knowledge check.</li>
  <li><strong>Require Backpack Item</strong>: a Prompt, the Required Item, and whether to consume it on use. The player sees their own backpack as a scrolling rack and presses <strong>Use</strong> on whatever sits under the sight. Nothing on the page says which item you want, so it's a real puzzle rather than a confirmation, and a wrong pick is a miss that tells them to check their backpack or visit the Item Shop. An empty backpack gets a pointer to the Item Shop, if the adventure has one. This is what turns the Item Shop and Find Item steps into a real progression mechanic rather than decoration.</li>
  <li><strong>SCORM Package</strong>: upload a SCORM 1.2 .zip and it runs inside the Step. The step is done when the package reports itself completed or passed, a player who leaves partway resumes where they left off, and the score the package reports is kept for the SCORM report. The step bar offers <strong>Full screen</strong>. Use it to fold in content you already built in another authoring tool instead of rebuilding it. The same panel can replace the package. See <a href="/docs/scorm-packages-concept">SCORM Packages</a>.</li>
  <li><strong>Case Study (HTML)</strong>: embeds a self-contained interactive HTML activity by its Launch URL. You set the <strong>Total Questions</strong> and the <strong>Pass Score</strong>; the activity reports its own result back and the Step completes when the player clears the bar, while a run below it on a required step offers Try again. A page with no quiz (a list of course links, a reading) works too: set Required? to No and players get Continue straight away. Every attempt is kept, pass or fail, with per-question detail you can read on Manage Content's Case Studies tab. This is the way in for bespoke, custom-built exercises.</li>
</ul>

<h2>Collect — The Player Submits, With No Right or Wrong</h2>
<p>You're gathering something, not grading it. Use these for reflection, feedback, evidence, and opinion.</p>
<ul>
  <li><strong>Open Text</strong>: free writing to the prompt in the step's Content, with an optional <strong>Min Words</strong>. Players write in a small rich-text box (bold, italic, alignment, links, bullet lists and Add Media for a picture), and the answer is shown back to them formatted, never as raw code. Each Open Text step keeps its own answer, so a Milestone can ask several questions and keep every reply. Set <strong>A.I. Validation</strong> to On and the answer is checked before the player moves on, giving them instant feedback to revise against. Two settings shape the check:
    <ul>
      <li><strong>A.I. Strictness</strong>: Lenient (only reject blank or unrelated answers), Standard (a genuine, on-topic attempt passes) or Strict (every part of the prompt must be engaged with).</li>
      <li><strong>A.I. Reviewer Context</strong>: private: players never see it, and the A.I. is told never to quote it back. Say what a good answer to this question must include. It's optional; without it the A.I. judges whether the answer is a genuine attempt at the prompt. The Milestone's Quest Context goes along with every check too.</li>
    </ul>
    Both settings are also used when you ask the A.I. for a second opinion on the finished submission, even if the player-side check is off. The check needs an Anthropic API key on the adventure's Connections pane (a cohort uses its template's key). If a check can't run, the answer is let through and staff are told why. See <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>.</li>
  <li><strong>Survey Choice</strong>: a question with options and no correct answer. Choose whether players can pick more than one. With multiple answers on, <strong>Most answers a player can pick</strong> caps how many they tick (0 means no limit): the player sees "Choose up to 3" and the remaining boxes lock at the limit. Stats has a Surveys tab that totals every answer.</li>
  <li><strong>Rating Scale</strong>: a numeric scale with a minimum and maximum you set, plus a label for each end ("Strongly Disagree" to "Strongly Agree"). The tool for pulse checks and confidence self-ratings.</li>
  <li><strong>Poll</strong>: a question whose results render as live percentage bars the moment the player votes. Use it when seeing what everyone else said is the point.</li>
  <li><strong>Upload Image</strong>: the player submits a photo or screenshot, with a <strong>Max File Size (MB)</strong> you set. Use it for anything you need to <em>see</em> to assess.</li>
  <li><strong>Upload Video</strong>: the same, for video. Pitches, demonstrations, language practice, physical technique.</li>
</ul>

<h2>Profile — Weighted Toward a Trait</h2>
<p>This group appears in the Step Type menu once the adventure has a published profile (built under Manage Content, Profiles). All three ask which <strong>Profile</strong> the step belongs to, so one Milestone can carry questions for more than one, mixed in with story steps. Players never see the weights. See <a href="/docs/profile-tests">Profile Tests</a>.</p>
<ul>
  <li><strong>Weighted Options</strong>: a question whose options each carry a weight per trait, in a table with one column per trait (leave a cell at 0 for a trait an answer says nothing about). You choose whether the player can pick more than one; every picked option adds its own weights.</li>
  <li><strong>Agree / Disagree Scale</strong>: a statement the player rates, which scores toward one trait. Set the lowest and highest value (1 and 7 by default) and a label for each end. Write the statement so agreeing means <em>more</em> of the trait: the score is added as given.</li>
  <li><strong>Profile Result</strong>: shows the player their sheet for that profile: the dominant trait, the chart, and what every trait means. It never shows their answers back to them. Place it wherever the reading belongs, including a later Milestone; it reads everything the player has answered for that profile anywhere in the adventure.</li>
</ul>

<h2>Flow — Routing &amp; Branching</h2>
<ul>
  <li><strong>Jump to Step</strong>: buttons you draw, each with a Label, an optional image, and a <strong>Jump to</strong> destination among this Milestone's other steps. The player sees them as "Choose one option", and picking one takes them straight there. Add the other steps first so there's somewhere to jump to. A button whose destination you later delete simply goes to the next step.</li>
  <li><strong>Branch Choice</strong>: the player picks one of the paths in a branch, and that choice is permanent and mutually exclusive: taking one closes the others. This is how you build "choose your track" moments. Branches are set up on Manage Content's <strong>Branches</strong> tab (or on the achievement), then picked here. Tick <strong>One per guild</strong> and a path one member of a guild holds is closed to the rest of that guild, so a team fills its roles once each. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</li>
  <li><strong>Choice Board</strong>: listed as "Choice Board (do some of the choices)". The board offers up to six choices as cards, and the Milestone finishes once the player has completed the number you set in <strong>Choices to complete</strong> ("2 of 4"); once they have, the others close. Use it when not every player can or should do every activity. Once a Milestone has a board, every other step gets a <strong>Choice</strong> setting: <strong>All choices (every player)</strong>, for steps everyone plays before or after the board, or the choice it belongs to. End each choice with a Win Screen set to the same choice (or the built-in ending is used), and give a choice's first step a Background and a Label, which become the card's picture and name. The board's panel in the editor lists the choices it found and what each one is missing. A Milestone with a board pays its XP and BLOO once, whichever choices were made, and its steps pay no rewards of their own; set its grading to completion rather than a percentage.</li>
  <li><strong>Encounter Choice</strong>: listed as "Encounter Choice (costs money + energy)". A situation in the step's Content, then priced options, each a numbered card in three blocks. <em>What the player reads</em>: the <strong>Button text</strong> (an option without it isn't saved) and a one-line <strong>Description</strong>, the catch. <em>What it costs and pays</em>: <strong>Costs</strong> and <strong>Pays</strong> in BLOO, <strong>Costs Energy</strong>, and an XP change that can be negative and can cost a level. <em>What happens after</em>: <strong>Then grant an achievement</strong> (which is how a follow-up Milestone gets unlocked) and <strong>Then say a message</strong> (a <a href="/docs/consequences">Consequence</a>). BLOO can go below zero, which is the setback. Energy can't, so an option the player can't afford the energy for is disabled: always leave one option that costs 0 energy, or a player with an empty tank is stuck. See <a href="/docs/random-encounters">Random Encounters</a>.</li>
</ul>

<h2>Special</h2>
<ul>
  <li><strong>System Message</strong>: narrator text in the system voice, with no character attached. For instructions, transitions, and anything that isn't a person speaking. It never shows a character, even though the editor offers the character settings here too; use Dialogue for a person.</li>
  <li><strong>Win Screen</strong>: a custom success ending, showing this step's Content. It replaces the standard win screen wherever it sits in the list.</li>
  <li><strong>Fail Screen</strong>: a custom fail ending, shown when a player runs out of tries. It replaces the standard fail screen; its button clears the player's answers and starts the Milestone over.</li>
  <li><strong>Choose Nickname</strong>: asks the player what to call them (your <strong>Question</strong>, "What should we call you?" if you leave it blank) and saves it as their <em>display name</em>, the name other players see: 2 to 50 characters, with its own Save button, and Continue opens once it's saved. It never changes the nickname they sign in with. Almost always in the first Milestone of an Adventure.</li>
  <li><strong>Choose Avatar</strong>: you define the avatars: <strong>Add avatar</strong> for each one and choose its image. The player picks one of them. Same placement logic as Choose Nickname.</li>
</ul>

<h2>Pacing: The Only Rule That Matters</h2>
<p>Alternate the groups. Deliver something, then ask for something. A run of Deliver steps reads like a slide deck; a run of Validate steps reads like an exam. The Milestones players remember alternate every two or three Steps.</p>

<h2>Per-Step Rewards</h2>
<p>Any Step can hand out its own XP, BLOO, EP, item, or achievement, independent of the Milestone's overall reward (except in a Milestone with a Choice Board, which pays once, as a Milestone). Use small per-Step rewards to keep a long Milestone feeling alive along the way, and save the bigger payout for completion.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/step-type-quick-reference">Step Type Quick Reference</a> — all 31 on one screen</li>
  <li><a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a></li>
  <li><a href="/docs/profile-tests">Profile Tests</a></li>
  <li><a href="/docs/random-encounters">Random Encounters</a></li>
  <li><a href="/docs/library-study-notes-and-glossary">Authoring the Library: Study Notes &amp; Glossary</a> — notes built from your SCORM, slides, case study and video steps</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Step Type Quick Reference',
                'slug'       => 'step-type-quick-reference',
                'section'    => 'setup',
                'sort_order' => 12,
                'body'       => <<<'HTML'
<p>A fast lookup for all 31 Step types available inside a Milestone, grouped the way the builder's Step Type menu groups them. See <a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a> for the fuller explanation of each.</p>

<h2>Deliver — auto-completes on view</h2>
<ul>
  <li><strong>Dialogue</strong> — a character speaks; a speaker from the cast or a custom name and portrait; left/right/no one.</li>
  <li><strong>Video</strong> — plays a video file; watch time tracked per player.</li>
  <li><strong>Audio</strong> — plays an audio clip in a player widget.</li>
  <li><strong>Gallery</strong> — up to 7 pictures that fill the step; players open each full screen and zoom in.</li>
  <li><strong>Slides (PDF)</strong> — a deck as a PDF, one slide at a time with zoom; the last slide completes it.</li>
  <li><strong>Find Item</strong> — hands the player an item into their Backpack.</li>
</ul>

<h2>Validate — must be answered correctly to advance</h2>
<ul>
  <li><strong>Multiple Choice</strong> — question, optional image, one or many correct options; tries and Read it again.</li>
  <li><strong>Keyphrase</strong> — type a phrase; list of accepted answers, optional case sensitivity; tries and Read it again.</li>
  <li><strong>Cryptex</strong> — the same as Keyphrase, as a lock of A–Z/0–9 wheels (up to 20); tries and Read it again.</li>
  <li><strong>Puzzle</strong> — a jigsaw from an uploaded image, on the columns and rows you choose; optionally turned pieces and a picture to copy.</li>
  <li><strong>Require Backpack Item</strong> — the player picks the right item off a rack of their own backpack; optionally consumes it; tries.</li>
  <li><strong>SCORM Package</strong> — runs an uploaded SCORM 1.2 package; done when it reports completed or passed; resume and score kept.</li>
  <li><strong>Case Study (HTML)</strong> — embeds an external interactive activity; set pass score and question count; every attempt kept.</li>
</ul>

<h2>Collect — a submission, with no right or wrong</h2>
<ul>
  <li><strong>Open Text</strong> — free writing in a small rich-text box; minimum word count; its own answer per step; optional A.I. check with a strictness (lenient/standard/strict) and private reviewer context; Read it again.</li>
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
  <li><strong>Jump to Step</strong> — buttons you draw, each sending the player to another step.</li>
  <li><strong>Branch Choice</strong> — a permanent, mutually exclusive pick between the paths in a branch; optionally one per guild.</li>
  <li><strong>Choice Board</strong> — up to 6 choices as cards; the Milestone finishes when the player completes the number you set.</li>
  <li><strong>Encounter Choice</strong> — priced options spending BLOO and energy; BLOO can go into debt, energy can't; leave one option at 0 energy.</li>
</ul>

<h2>Special</h2>
<ul>
  <li><strong>System Message</strong> — narrator text with no character attached.</li>
  <li><strong>Win Screen</strong> — a custom success ending, replacing the standard one.</li>
  <li><strong>Fail Screen</strong> — a custom fail ending for a player who runs out of tries.</li>
  <li><strong>Choose Nickname</strong> — asks what to call the player and saves it as their display name (never their sign-in nickname).</li>
  <li><strong>Choose Avatar</strong> — the player picks from the avatars you define.</li>
</ul>

<h2>On Every Step</h2>
<p>Any Step can be marked optional, can carry a background image, and can pay out its own XP/BLOO/EP/item/achievement on top of the Milestone's overall reward (not in a Milestone with a Choice Board). Multiple Choice, Keyphrase, Cryptex and Require Backpack Item can carry a Mistake Message and a Maximum attempts limit that the player sees as tries; running out sends them to the fail screen and a fresh attempt. Every Milestone ends on a win screen, and on a fail screen for a player who runs out of tries, whether or not you add those steps.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/how-to-build-a-milestone-step-by-step">How to Build a Milestone, Step by Step</a></li>
</ul>
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
<p>Manage Content has a <strong>Speakers</strong> tab for the cast. Its header counts how many are in the cast and how many have dialogue, <strong>New Speaker</strong> opens the full speaker editor, and <strong>Upload Speakers</strong> takes a CSV file to add a whole cast at once (see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>). Each row shows:</p>
<ul>
  <li>the speaker's portrait, with their first and last name editable right in the row (a rename saves as you make it, and every line follows)</li>
  <li>a Draft badge if they aren't published, and their company if one is set</li>
  <li>how many lines they speak (the number of steps that name them), or "No lines yet"</li>
  <li><strong>Edit</strong> for everything else about the speaker, <strong>View</strong> for their public speaker page, and <strong>Trash</strong></li>
</ul>
<p>Click a speaker's picture right in this list (<strong>Change picture</strong>, or <strong>Add a picture</strong> when there's none) to open the Media Manager and swap it directly — no need to go into Edit just to change a photo.</p>
<p>The toolbar searches the cast, filters to <strong>With dialogue</strong> or <strong>Not used yet</strong> or by status, and sorts by name or by lines of dialogue.</p>
<p><strong>Trashing a speaker doesn't silence them.</strong> Lines that already name them keep speaking; the speaker just stops being offered on new steps. The Trash button's tooltip tells you how many lines that affects, and trashed speakers sit in their own Trashed section with Restore and Delete Forever.</p>

<h2>What a Speaker Holds</h2>
<p>The speaker editor has a <strong>Speaker Picture</strong> (required), First Name and Last Name, Company, Website, LinkedIn and a Speaker Bio, plus an optional <strong>Connect to Player</strong> link to a user account. Dialogue only uses the name and picture; the company, links and bio appear on the speaker's own page.</p>

<h2>Speakers Also Run the Event Schedule</h2>
<p>The same cast is the speaker list for your <a href="/docs/event-schedule-concept">event schedule</a>. When you build a session you tick which speakers are on it, the schedule shows who's speaking at each session, and each speaker's page lists the sessions they're in. When the adventure's Speakers section is on (Adventure Settings → Sections), players also get a Speakers page in the menu. So one speaker record can narrate your story and headline your live session. See <a href="/docs/how-to-build-an-event-schedule">How to Build an Event Schedule</a>.</p>

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
<p>A Challenge is a quiz. You build a bank of questions, and each attempt shows a subset drawn from that bank. <strong>Questions to display</strong> sets how many appear per attempt and <strong>Answers to win</strong> sets how many correct answers count as a pass; the page tells players "N of M correct answers to win" before they start. Add a <strong>Time Limit</strong> (in seconds) if you want it to feel like a real test rather than an untimed review: a bar counts down, and when the clock runs out a <em>Time's up!</em> screen covers the questions, and clicking it hands the attempt in.</p>

<h2>Six Kinds of Question</h2>
<p>A question isn't only multiple choice. Each one is one of six kinds, and a Challenge can mix them freely:</p>
<ul>
  <li><strong>Multiple choice</strong>: players pick the right option, or every right option. With several options marked correct, they must pick exactly those.</li>
  <li><strong>Put in order</strong>: players drag the items into the right order.</li>
  <li><strong>Match the pairs</strong>: players drag each answer onto its prompt. Extra answers can fit nowhere, to make guessing harder.</li>
  <li><strong>Sort into groups</strong>: players drop every item into its group.</li>
  <li><strong>Fill the gaps</strong>: players drag words into the blanks of a sentence. Extra words fit no blank.</li>
  <li><strong>Click on the picture</strong>: players mark every area you drew on a picture, and nothing else.</li>
</ul>
<p>Every question is all or nothing: it counts as right only when the whole answer is right. Players get the options, items and answers shuffled, so the right one never sits where you typed it first. Every kind works by mouse, touch and keyboard.</p>

<h2>Attempts &amp; Retries</h2>
<p>Three settings decide how often a player can try:</p>
<ul>
  <li><strong>Max Chances</strong>: the total number of attempts (0 means unlimited). Once it's reached, the Challenge shows <em>Max Attempts Reached</em>.</li>
  <li><strong>Free Attempts</strong>: how many attempts cost nothing.</li>
  <li><strong>Attempt Cost</strong>: the BLOO charged for each attempt after the free ones. A player who can't afford the next attempt can't start it.</li>
</ul>
<p>Together they're what makes a Challenge a real assessment rather than something a player can brute-force by retrying indefinitely for free.</p>

<h2>Enforced by the Server, Not the Browser</h2>
<p>Every rule around an attempt is checked on the server when it matters. The cost, the attempt cap, the player's level, the requirements, the path and the deadline are all checked when an attempt starts, so nothing a player changes in their browser makes a paid attempt free or opens a closed Challenge. Answers are only accepted into the player's own open attempt, for questions that belong to this Challenge. Each attempt is graded once, so a failed attempt can't be re-answered into a pass. And the answer key never leaves the server: nothing the player's browser receives says which options are correct, which order is right, where a word belongs or where the areas on a picture are.</p>
<p>As a GM you can open a Challenge that's locked for players; the page says it's an Admin/GM preview and why players can't start it yet.</p>

<h2>How an Attempt Ends</h2>
<p>Players hand in with <strong>Submit answers</strong>, a button that fills up as they answer. It opens one full-screen check, <em>Ready to hand it in?</em>, with how many they've answered, a pip per question that jumps back to it, and a warning for any question left blank ("it counts as wrong"); <strong>Keep answering</strong> goes back. Then a sealed card spins while the attempt is graded and lands gold (<em>Challenge conquered</em>, with the score against the pass mark and the rewards counting up) or red (<em>Challenge failed</em>, with how many attempts are left). A repeat win says its rewards were paid the first time.</p>
<p>Behind the card is the review: the player's own graded attempt, every question marked right or wrong, only their own answers shown and any unanswered question shown as wrong. A bar along the bottom shows the score (for example <em>3/5 correct · 60%</em>) and offers <strong>Back to the journey</strong>, plus <strong>Try again</strong> after a fail.</p>

<h2>Per-Question Explanations</h2>
<p>Each question has an optional <strong>Explanation</strong>, shown during the review and <strong>only for questions the player got right</strong>. Handing the reasoning to someone who got it wrong would hand them the answer, and there's a retry. Write why the answer is right, the idea you want them to take away, not "well done": the score already says that. Left blank, nothing shows.</p>

<h2>Rewards and Grading</h2>
<p>A passed Challenge pays its XP, BLOO and EP, plus any Item, Achievement or Skill reward you set. If the adventure gives rewards After Grading, a Challenge's BLOO is scaled by the player's best score on it. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a> for the grading settings.</p>

<h2>Challenge or Milestone?</h2>
<p>If a player could plausibly fail and be sent back to try again, build a Challenge. If they just need to go through the content, even content that asks them questions along the way, build a Milestone. A Milestone can absolutely contain Multiple Choice, Keyphrase and other Validate steps that must be answered correctly; the difference is that those gate a single Step, while a Challenge grades the whole thing and can be failed as a unit.</p>

<h2>In Launch Week</h2>
<p>The Week One company-policy quiz is a Challenge: five questions per attempt, four correct to pass, two free attempts, a small BLOO cost for a third. Each question's explanation names the policy it comes from, so the review pass doubles as a study guide. The end-of-Week-One "How was your first week?" check-in is <em>not</em> a Challenge. It's a Milestone built from Rating Scale and Open Text steps, because there's nothing there to get right.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-build-a-challenge">How to Build a Challenge</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/how-to-build-a-challenge">How to Build a Challenge</a></li>
  <li><a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones — Rewards &amp; Unlock Rules</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
</ul>
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
  <li><strong>Create it.</strong> Choose <strong>Challenge</strong> in the menu's Add group (<strong>New Challenge</strong> under Add Mechanics in the Classic view). It appears when the adventure's Challenges section is on. On the General tab give it a Name, Color, Icon and Main Image, then press <strong>Create Challenge</strong> in the bottom bar. The Questions tab reads "Please save the challenge before adding questions" until you do.</li>
  <li><strong>Write your question bank.</strong> The Questions tab lists one row per question, and <strong>Add a question</strong> has a button for each kind: Multiple choice, Put in order, Match the pairs, Sort into groups, Fill the gaps and Click on the picture. Each opens the question in one window (below), and one save writes the whole question.</li>
  <li><strong>Write the explanations.</strong> Every kind has an Explanation, shown on review and only to a player who got that question right. Say why the answer is right, not "well done". Blank is fine.</li>
  <li><strong>Set the Challenge Mechanics</strong> on the Mechanics tab: <strong>Time Limit</strong> in seconds (blank for none), <strong>Questions to display</strong>, <strong>Answers to win</strong>, <strong>Max Chances</strong> (0 for unlimited), <strong>Free Attempts</strong>, and the <strong>Attempt Cost</strong> in BLOO for each attempt after those. The same tab carries the Tabi, Level, XP/BLOO/EP reward, Start Date and Deadline, Optional and Validate, just as a Milestone does, plus a <strong>Deadline cost</strong>: what players can pay in BLOO to reopen the challenge after its deadline (0 keeps it closed). A challenge has no unlock cost.</li>
  <li><strong>Write the Content.</strong> The <strong>Short Description</strong> is the preview players read when they click the Challenge on the map. The <strong>Success Message</strong> lands on the player's Secrets &amp; Clues page once they pass.</li>
  <li><strong>Set requirements and extra rewards</strong> on the Advanced tab: the <strong>Conditions</strong> drawer for prerequisites, and the Skill, Item and Achievement rewards. See <a href="/docs/designing-milestones-rewards-and-unlocks">Designing Milestones</a>; they work the same way here.</li>
  <li><strong>Pick a status and save.</strong> Choose Publish, Draft or Locked (and, if the adventure has paths, who it's <strong>Visible to</strong>) in the bottom bar and press <strong>Update Challenge</strong>.</li>
  <li><strong>Place it on the Journey Map</strong>, into a Tabi, or positioned directly in the Journey Builder.</li>
</ol>
<p>The header's <strong>View Challenge</strong> opens it as players see it, and <strong>Review Challenge answers</strong> opens its report in a new tab: players' attempts and how each question went.</p>

<h2>The Question Window</h2>
<p>Every question has a <strong>Question Text</strong>, optional <strong>Media</strong> (a picture, a video or a sound shown above the question) and an <strong>Explanation</strong>. Then each kind asks for its own answer:</p>
<ul>
  <li><strong>Multiple choice</strong>: add <strong>Answer Options</strong> with <strong>Add Option</strong> and tick <strong>Correct</strong> on every right one. With more than one ticked, players must pick all of them. An option can carry its own picture.</li>
  <li><strong>Put in order</strong>: write the items in the right order; drag a row by its handle to move it. Players get them shuffled.</li>
  <li><strong>Match the pairs</strong>: each pair is a prompt (what players see) and its answer (what they drag onto it). <strong>Extra answers</strong>, optional, match no prompt.</li>
  <li><strong>Sort into groups</strong>: name two or more groups (a group can show a picture as well as its name), then add the items to sort and choose each one's group. Every item belongs to a group.</li>
  <li><strong>Fill the gaps</strong>: write the text and put <code>___</code> where each blank goes ("Water boils at ___ degrees at ___ level."). Give every blank its word; give one blank two words and either is right. Extra words fit no blank and make guessing harder.</li>
  <li><strong>Click on the picture</strong>: choose a picture, then drag on it to draw each area players must find. Drag an area to move it and its corner to resize it. Players must mark every area once, and nothing else.</li>
</ul>
<p>Press <strong>Create question</strong> (or <strong>Update question</strong>). A question that isn't finished still saves, so you can come back to it: its row says <strong>Incomplete</strong> and its window lists why players can't get it right yet. Each row also has <strong>Edit</strong>, <strong>Duplicate</strong> (the copy goes at the end of the list) and <strong>Trash</strong> (players stop getting it; answers already given stay in the reports). Esc or Cancel closes the window.</p>
<p>A bank of multiple-choice questions can also come in from a CSV file: <strong>Bulk Upload</strong> on a saved Challenge's Questions tab. See <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>What the Player Gets</h2>
<p>A player presses <strong>Start!</strong> (the panel beside it says whether the attempt is free or what it costs), answers, and presses <strong>Submit answers</strong>, which asks once more on a full-screen check that counts their answers and flags any blanks. The attempt lands as a card, gold for a pass and red for a fail, then opens the review: the graded questions with your explanations on the ones they got right, and a bottom bar with <strong>Back to the journey</strong> and, after a fail, <strong>Try again</strong>. Costs, the attempt cap and grading are enforced by the server, and the answer key is never sent to the player's browser.</p>

<h2>Sizing the Question Bank</h2>
<p>Write more questions than you show. A bank of fifteen with five shown per attempt means a retry is a genuinely different test, which is what makes limited retries fair rather than a memory exercise. Leave <strong>Questions to display</strong> blank (or set it higher than the bank) and every question is shown. An <strong>Answers to win</strong> higher than the number shown is treated as "all of them".</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/challenges-concept">Challenges — Concept</a></li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit</a> — copying a Challenge, questions and all, into another adventure</li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a></li>
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
<p>Turn on <strong>Profile Tests</strong> on the Sections pane of Adventure Settings. That adds a <strong>Profiles</strong> tab to Manage Content and a Profiles section to Stats.</p>

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
<p>They appear in the menu when the adventure has the <strong>Blog</strong> and <strong>Lore / Resources</strong> sections switched on (Adventure Settings → Sections), under the names Posts and Resources unless you've renamed them. Create them from the menu's Add group (<strong>Post</strong> and <strong>Resource</strong>; <strong>New Post</strong> and <strong>New Resource</strong> under Add Mechanics in the Classic view).</p>

<h2>Writing a Post</h2>
<ul>
  <li><strong>Post Headline</strong>, and a <strong>Secondary Headline</strong> shown under it.</li>
  <li><strong>Post Image</strong> — required.</li>
  <li><strong>Level</strong> — the level a player needs to reach.</li>
  <li><strong>Display Style</strong> — how the post presents (below).</li>
  <li><strong>Start Date</strong> — optional; the post isn't available before it.</li>
  <li><strong>Content</strong> — the article itself, in the rich-text editor. Player tokens work here, so a post can greet each reader by name; see <a href="/docs/personalising-text-with-player-tokens">Personalising Text</a>.</li>
  <li>In the bottom bar: <strong>Visible to path</strong> (<strong>All paths</strong>, or a single path) and the publication status, <strong>Publish</strong>, <strong>Draft</strong> or <strong>Trash</strong>.</li>
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
  <li>In the bottom bar: <strong>Visible to path</strong> (all paths, or one) and the publication status, <strong>Publish</strong>, <strong>Draft</strong> or <strong>Trash</strong>. A draft stays out of the Resources page until you publish it.</li>
</ul>

<h2>How a Resource Becomes a Download</h2>
<p>A resource with the <strong>Resource</strong> style and a <strong>File or Link</strong> is a download: its card's button reads <strong>Download</strong> and opens the file or link in a new tab, and its reading page carries a Download button above the content. With no file or link — or with the <strong>Article</strong> style — it's an article, and <strong>Read</strong> opens the reading page. The Resources page shows them as a grid of cards, each with the start of its content.</p>
<p>When the adventure has study notes in its <a href="/docs/library-study-notes-and-glossary">Library</a>, the Resources page becomes the player's Library, with <strong>Study notes</strong>, <strong>Glossary</strong> and <strong>Resources</strong> tabs. Your resources stay on the Resources tab exactly as described here.</p>

<h2>The Posts Front Page</h2>
<p>Posts have a proper front page now — a news-feed style list of everything published, rather than a bare list — and opening one gives a rebuilt, cleaner article view. A Game Master can also link a graphic or text element placed on the Journey Map directly to a Post: clicking it opens the article in an overlay window right there on the map, without leaving the journey. See <a href="/docs/journey-builder-design-palette">The Journey Builder</a>.</p>

<h2>The Reading View</h2>
<p>Posts and resources open on the same kind of page: the image and headline in the chosen style, the level and path as badges, the date it was posted, then the content. A <strong>Back to Posts</strong> (or Resources) link returns to the list. GMs also get <strong>Edit</strong> and <strong>All Posts</strong> buttons at the foot of the page.</p>

<h2>Managing Them</h2>
<p>Manage Content has a <strong>Blog</strong> tab and a <strong>Lore</strong> tab. Each lists what's published with its style, path and (for posts) start date, a search box, and <strong>Edit</strong> and <strong>Trash</strong> on every row. <strong>Reorder Posts</strong> and <strong>Reorder Resources</strong> set the order players see. Trashed ones sit in their own list below, with Restore and Delete. Both tabs also take a CSV file to add many at once; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>Who Can Read What</h2>
<p>Posts and resources are gated the way milestones are:</p>
<ul>
  <li><strong>Level</strong> — a post gated to a level a player hasn't reached yet is listed as locked, with the level they need, rather than simply left out — so players always know there's more ahead. Opened directly before then, the page says <em>You need to be Level N to open this post.</em></li>
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
  <li><a href="/docs/library-study-notes-and-glossary">Authoring the Library: Study Notes &amp; Glossary</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Authoring the Library: Study Notes & Glossary',
                'slug'       => 'library-study-notes-and-glossary',
                'section'    => 'setup',
                'sort_order' => 18,
                'body'       => <<<'HTML'
<p>The <strong>Library</strong> gives players something to revise from: study notes and a glossary for every module, slide deck, case study and video in the Adventure, written by the A.I. from that material alone, never from its questions or answers. You read and correct every set before players see it. Players find the published notes on their Resources page, and Cooper teaches and quizzes from them.</p>

<h2>What It Builds From</h2>
<p>Every step that carries material is a source: a <strong>SCORM Package</strong>, a <strong>Slides (PDF)</strong> deck, a <strong>Case Study (HTML)</strong> and a <strong>Video</strong>. Each source gets its own set of notes, with its own short glossary of the terms it uses. An Adventure with none of those steps yet has nothing to build; add one as a step and it shows up in the Library.</p>

<h2>The Library Tab</h2>
<p>Open <strong>Manage Content</strong> and its <strong>Library</strong> tab. It lists every source with its kind and where its notes stand: none yet, a draft waiting for you to read it, published, or <strong>Material changed</strong> when the step's material changed after the notes were written. From there:</p>
<ul>
  <li><strong>Build notes</strong> writes a source's notes, and <strong>Build again</strong> rewrites them after the material changes. <strong>Build every missing note</strong> does the whole list in one go.</li>
  <li><strong>Edit</strong> opens a set of notes to read and correct. Notes are plain text: start a line with <code>## </code> for a heading, <code>- </code> for a point or <code>1. </code> for a numbered step, and leave a blank line between paragraphs. The same window holds the set's glossary terms (<strong>Add a term</strong>, or remove one).</li>
  <li><strong>Publish</strong> and <strong>Make draft</strong>. A draft is seen only by staff; published notes are read by players and Cooper.</li>
</ul>
<p>The step editor of each source carries the same thing in small: a <strong>Study notes in the Library</strong> panel saying where its notes stand, with Build notes and a link to read and publish them. When you upload or replace a SCORM package, its notes are written for you as a draft.</p>

<h2>Your Own Notes for the A.I.</h2>
<p>Some material can't be read: a video's soundtrack, a live session, a module that's all pictures. Each set has a box, <strong>Your own notes for the A.I.</strong>, for a transcript or the key points. It's used the next time those notes are built, on top of the material, and players never see it, only the notes written from it. Pasting a video's transcript there is the way to give a video step real study notes.</p>

<h2>Which Key Pays</h2>
<p>Building calls the A.I., so it needs a key: the Adventure's own Claude key on the Connections pane of Adventure Settings (a cohort uses its template's), or, when the Adventure has Cooper switched on, the platform's Cooper key. Without either, the Library says so, and notes can still be written by hand, just not built.</p>

<h2>The Glossary</h2>
<p>Every set of notes has its own glossary, so a term two modules both teach shows up twice, and "MFA" sits apart from "Multi-factor authentication". <strong>Compile the glossary</strong> hands every term to the A.I., which joins the ones that are the same entry into one, with one short meaning made from their own words and nothing added. Terms with no twin stay as they are. Read the joined entries, fix any wording, or <strong>Keep apart</strong> two terms that should stay separate, then publish. Players then read one A-to-Z list, and every set of notes shows the joined meaning.</p>

<h2>What Players See</h2>
<p>Once there are published notes, the Resources page becomes the player's Library, with three tabs: <strong>Study notes</strong>, one card for every module, deck and case study they've reached, with a search box over all of them; <strong>Glossary</strong>, the A-to-Z list with a box to find a term; and <strong>Resources</strong>, the files and articles described in <a href="/docs/posts-and-resources">Posts &amp; Resources</a>. A set of notes opens to a player once its milestone is open to them; until then it simply isn't there, so the Library never hints at what's ahead. A joined glossary entry shows only once the player can read every set of notes it joins.</p>
<p>Players read the notes on the Resources page, so the <strong>Lore / Resources</strong> section has to be switched on (Adventure Settings → Sections). With it off, the Library tab warns you; Cooper still uses the published notes.</p>

<h2>Templates and Cohorts</h2>
<p>The Library belongs to the template, like the steps it's built from: build and publish once, and every cohort's players read the same notes.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/posts-and-resources">Posts &amp; Resources</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/scorm-packages-concept">SCORM Packages — Concept</a></li>
  <li><a href="/docs/the-library-study-notes">The Library: Study Notes &amp; Glossary</a> — what players see</li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a> — the Claude key</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Conditions — When Things Unlock',
                'slug'       => 'conditions-when-things-unlock',
                'section'    => 'setup',
                'sort_order' => 19,
                'body'       => <<<'HTML'
<p>A <strong>condition</strong> is a rule about a player's progress: "reach level 5", "finish the Week 1 Tabi", "complete 3 milestones within 7 days". BLUERABBIT has one conditions engine, and the same rules drive several different things. Learn to write them in one place and you can write them anywhere.</p>

<h2>Where Conditions Are Used</h2>
<ul>
  <li><strong>Achievements</strong> — the achievement editor's Conditions tab, <strong>Auto-Grant Conditions</strong>. The achievement is awarded the moment a player meets them.</li>
  <li><strong>Milestones</strong> — the milestone builder's <strong>Conditions</strong> drawer. Its <strong>Threshold conditions</strong> sit alongside the required milestones, achievements and key item, and a player who doesn't meet them sees the milestone as locked.</li>
  <li><strong>Tabis</strong> — the same drawer, opened from <strong>Conditions</strong> on a Tabi's row in Manage Content, keeps a whole chapter locked. See <a href="/docs/tabi-editor">The Tabi Editor</a>.</li>
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
<p>There are 18, listed here by the label you'll see in the picker:</p>
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
  <li><strong>Meet a Rubric Criterion (pick one)</strong> — one of the adventure's graduation criteria reads "met" for them. Offered on achievements and certificates, once the adventure uses Graduation Criteria; see <a href="/docs/certificates-authoring">Authoring Certificates</a>.</li>
</ul>
<p>The two guild types read the whole team's progress rather than one player's, which is the point of them: a team moves a scene stage or unlocks a badge together.</p>

<h2>Time Windows</h2>
<p>Counters, and checks on one particular thing, can carry a rolling window: the <strong>within N days (optional)</strong> box on the condition row. "Milestones Completed, 3, within 7 days" counts only the last seven days, measured back from right now, continuously. Leave it blank to count the player's whole history.</p>
<p>The window is offered on Milestones Completed, Tabis Completed, Item Shop Transactions, Items Consumed, Achievements Earned, Blooms Received from Peers, Blooms Given to Others, Complete This Milestone and Complete This Tabi. It isn't offered on readings of the present moment (level, XP, percentages, guild standing, Blooms totals), because "your level in the last five days" isn't a question.</p>
<p>Timed Garden Tasks add a second kind of clock. A task with a countdown counts only what the player has done since they started it, so "complete 3 milestones" on a five-day task means three in <em>their</em> five days.</p>

<h2>Writing Conditions</h2>
<p>Achievements, certificates, tasks and encounter groups all use the same row editor. Add a condition row, pick a type from <strong>Select a condition...</strong>, then fill in what that type needs: a milestone, Tabi or Skill picker for the types that name one, a threshold, and the optional window. Remove a row with its trash button, and save. A certificate's rows save with the certificate, from its bottom bar.</p>
<p>The milestone and Tabi Conditions drawer is simpler: tick the milestones, achievements and key item it needs, then one number box per threshold type, with no pickers and no windows. The types that need a picker aren't offered there. Leave a box blank to skip it.</p>
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
                'sort_order' => 20,
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
<p>Those thresholds are one face of a single conditions engine. The same engine decides when achievements auto-grant, when certificates unlock, when a condition-triggered Garden Task completes, when an encounter group is ready, and how an evolving Tabi scene grows. A whole Tabi can carry the same drawer too, from <strong>Conditions</strong> on its row in Manage Content, so a chapter stays shut until a player meets it. It's the general tool for "unlock this when X is true", wherever X is something a player's progress can show.</p>
<p>The drawer offers only plain numbers. For rules that name one particular Tabi or Skill, or that count over a time window ("3 milestones within 7 days"), put the rule on an achievement's Auto-Grant Conditions and require that achievement here. The achievement then doubles as a visible marker of the gate. The full list of types and how they combine is in <a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a>.</p>

<h2>Paths: Who a Milestone Is For</h2>
<p>A <strong>Path</strong> is a type of achievement. Set a milestone's path in the builder's bottom bar, next to its status: <strong>Visible to path</strong>, <strong>All paths</strong> or one specific path. A player who doesn't hold that path can't open the milestone, even by its address. Posts, resources and sessions take a <strong>Visible to path</strong> the same way, and shop items and badges have an <strong>Available for</strong> setting.</p>

<h2>The Branch Choice Step</h2>
<p>A <strong>Branch Choice</strong> step asks the player to pick one of the paths in a branch: "pick your role", "pick your specialization". The choice is <em>permanent and mutually exclusive</em>. Taking one path closes the others for good, which is what makes it feel like a real decision rather than a menu. From that point on, everything limited to a path is filtered by what they chose.</p>
<p>Branches are set up in one place and referenced by the step. Manage Content's <strong>Branches</strong> tab (<strong>Branch Groups</strong>) lists every branch with the achievements in it and the Branch Choice steps that offer it: <strong>New Branch</strong> creates one, <strong>Edit</strong> renames it, <strong>Add</strong> puts a path achievement that isn't in a branch yet into it, <strong>Remove</strong> takes one out, and <strong>Delete</strong> removes an empty branch (it's refused while a Branch Choice step still uses it, and says so). Nothing reloads. You can also give an achievement its <strong>Branch</strong> in the achievement editor, creating one on the spot with <strong>New Branch</strong>, and the Achievements tab shows each achievement's branch and filters by it. Then add the Branch Choice step that points at the branch.</p>
<p>The rule holds everywhere, not just in the step: a player can never hold two achievements from the same branch, whether the second would have come from a GM's grant, a magic code, a milestone reward, a condition or an encounter choice.</p>

<h2>One Per Guild, and Roles a Coach Gives</h2>
<p>When a branch is a set of roles a team should fill once each, tick <strong>One per guild</strong> on its Branch Choice step. A path one member of a guild holds is then closed to the rest of that guild: the card says who took it, and two teammates clicking the same role at the same moment get one winner. A player in no guild chooses freely, and a GM sitting in a guild takes no seat.</p>
<p>A coach can also seat people without waiting for them to choose. The guild editor's <strong>Roles</strong> tab shows every branch with a published path and who in the guild holds each one. Give a path to a member and it's theirs exactly as if they'd chosen it at the Branch Choice step: they see it there as their choice, any other path they held in that branch is taken back, and in a One per guild branch the path is taken from whoever in the guild had it. Each change asks first and says what it takes away. Members without a path are listed under <em>No path yet</em>. See <a href="/docs/guilds-designing-team-play">Guilds — Designing Team Play</a>.</p>

<h2>Designing a Believable Fork</h2>
<p>The best branches are ones where both paths feel intentional, not like one is the "real" content and the other a stub. If you don't have time to build both sides of a fork fully, it's usually better to cut it to a single path than ship a branch that's obviously thinner on one side. Players notice.</p>

<h2>Branching Tabis</h2>
<p>A Tabi tied to one branch of a path now tracks completion correctly for the players who chose it — finishing all of its milestones marks it complete the same way a regular Tabi does. In a Tabi's detail window, players no longer see empty placeholder rows for milestones that belong to a branch they didn't take; those rows simply don't appear for them. As a Game Master, you still see every path's milestones, with the ones outside a player's chosen branch shown faded.</p>

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
                'sort_order' => 21,
                'body'       => <<<'HTML'
<p>Achievements are how you recognize progress beyond raw XP: a visible marker of what someone has actually done. As a GM you're designing three distinct tools here, not one.</p>

<h2>Three Tools, Three Jobs</h2>
<ul>
  <li><strong>Badge</strong> — a one-off recognition. "Finished onboarding", "Perfect score on the compliance quiz". Awarded once; doesn't imply anything came before or after it.</li>
  <li><strong>Path</strong> — a branch of the journey. Paths decide which milestones, items and badges a player sees, and a player holds only one path from each branch (see <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>).</li>
  <li><strong>Rank</strong> — a title tied to level. Use ranks when progress itself is the reward (Bronze/Silver/Gold, Associate/Senior/Lead): something that visibly upgrades as a player advances.</li>
</ul>
<p>Create them from Manage Content → Achievements → <strong>New Achievement</strong>, or from the menu's Add group. The editor has four tabs: <strong>Settings</strong>, <strong>Codes</strong>, <strong>Conditions</strong> and <strong>Players</strong>. Unique codes, awarding players and conditions all need the achievement saved first.</p>

<h2>The Achievements Tab</h2>
<p>Manage Content's <strong>Achievements</strong> tab groups everything by type (badges, paths, ranks) with counts for Published, Drafts and Trashed, buttons to show all, general ones or one path's, a search, and a <strong>Branch</strong> filter. Each row shows the achievement's branch as a pill that links to it on the Branches tab, how many times it's been awarded, and its magic code, which you can edit in place: <strong>Generate a new code</strong>, or <strong>Put the saved code back</strong>. Edit, Duplicate and Trash are on every row, <strong>Reorder Achievements</strong> sets the order players see, and drafts and trashed achievements have tables of their own below. A whole set of achievements can come in from a CSV file with <strong>Upload file</strong>; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>Settings</h2>
<ul>
  <li><strong>Name</strong>, <strong>Type</strong> (Badge, Rank or Path), <strong>Achievement Badge</strong> (the image, required) and <strong>Color</strong>.</li>
  <li><strong>Skill Reward (Garden)</strong> — a Bloom in one of your skills, paid when it's earned.</li>
  <li><strong>Rewards</strong> — XP and BLOO (and EP, if the adventure uses energy), on badges and paths.</li>
  <li><strong>Branch</strong> — on paths: which branch this path belongs to.</li>
  <li><strong>Available for</strong> — on badges: all paths, or only players on one path.</li>
  <li><strong>Max Players</strong> — how many players in the adventure can hold it. Leave it blank for no limit; once that many hold it, a Game Master's grant is refused.</li>
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
<p>A player can never hold two achievements from the same branch, and that's enforced on every way an achievement can arrive: manual grants, Assign all, CSV uploads, magic codes, milestone rewards, QR completions, Auto-Grant Conditions, encounter choices, and a coach's seat on the guild editor's Roles tab. A refused single grant tells you "Player already has an achievement from this branch"; bulk grants skip those players and tell you how many were skipped. Which achievements make up a branch is managed on Manage Content's <strong>Branches</strong> tab; see <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</p>

<h2>Magic Codes and QR Codes</h2>
<p>The Codes tab gives you two kinds of code:</p>
<ul>
  <li><strong>Magic Code</strong> — one code anyone in the adventure can use. Each player can redeem it once. Type your own or press <strong>Generate</strong>; the <strong>Magic Link</strong> beside it redeems the code in one click.</li>
  <li><strong>Unique Codes</strong> — press <strong>Create Code</strong> for each one-time code you need. Each can be redeemed once, by one player. The Available, Redeemed and Expired tabs show where every code stands, including who redeemed it and when, and <strong>Show all links</strong> lists every available code's link in one block, ready to paste into a mail merge or a print run.</li>
</ul>
<p>Once saved, the Settings tab also shows the achievement's <strong>QR Code</strong>. It's specific to the adventure you opened the achievement from: every cohort built from a template gets its own QR, so open the achievement from that cohort to print the right one. The magic code itself works in any cohort of the template. The <strong>Magic Link</strong> and the unique codes' links, though, always point at the template's own adventure, so for a cohort hand out the typed code or the cohort's QR rather than a link.</p>
<p>Players redeem a code through the <strong>Magic Code</strong> shortcut (the taskbar's quick link in the Classic view, the menu in the New view), by scanning the QR, or by opening a magic link. Codes work however they're typed, capitals or not. Redeeming opens the celebration panel with the badge and its secret message. A code that can't be redeemed (a deadline that has passed, a code someone already used, a branch the player already chose from) says why in a panel that stays until the player closes it, and the magic link's page lists every reason. A magic link or QR opened on a phone that isn't signed in is kept through the sign-in: once they sign in, the code runs.</p>

<h2>Awarding by Hand</h2>
<p>The Players tab lists everyone enrolled in the adventure you opened it from. Click a player to award the achievement or take it away, or use <strong>Assign all</strong> / <strong>Remove all</strong>. A player you award it to is told "A Game Master awarded you this achievement" on their next page. <strong>Bulk Upload Players</strong> takes a CSV with a single column of email addresses (<strong>Upload file</strong>), and the tab keeps a record of the last few uploads: how many were assigned, already had it or weren't found, and the result for every address.</p>
<p>In a cohort, who holds an achievement is the cohort's own: its Manage Content has an Achievements tab that opens a drawer per achievement with its holders, Add, Remove and a CSV upload. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a>.</p>
<p>To see and manage who holds what across a whole cohort, use <strong>Player Records</strong> (linked from the Players tab as <strong>Open in Player Records</strong>): filter, then remove one, a selection, or everything matching. Removing an achievement also takes away the XP, BLOO and Bloom it paid, and frees the player's pick if it was a path. If its Auto-Grant Conditions are still met, the engine will award it again the next time that player's progress is recalculated, so change the conditions first if you mean it to stay gone.</p>

<h2>Designing a Rank Ladder</h2>
<p>Ranks don't use Auto-Grant Conditions. They're awarded by the adventure's <strong>rank ladder</strong>, the <strong>Ranks</strong> panel of Adventure Settings → Rules &amp; scoring: each row pairs a <strong>Level</strong> with a Rank achievement. Create the Rank achievements first; the ladder only lists published ones. A rank's own Conditions tab says which level currently awards it, with a link to <strong>Edit the rank ladder</strong>.</p>
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
                'sort_order' => 22,
                'body'       => <<<'HTML'
<p>A certificate is the printable thing a player takes away from an Adventure. It's content the Adventure carries, like milestones and achievements, and an Adventure can carry as many as you like: one for finishing, one for reaching a level, one for a guild, one for a single achievement. Each has its own wording, look and numbers, and each unlocks on its own conditions.</p>
<p>You'll find them on the <strong>Certificates</strong> tab of Manage Content.</p>

<h2>Creating a Certificate</h2>
<p>Press <strong>New certificate</strong>. The editor has four sections, and a live <strong>Preview</strong> of the real certificate, filled in with sample numbers, follows every change before you save.</p>

<h3>Settings</h3>
<ul>
  <li><strong>Headline</strong>: the small line above the title, such as "This company proudly presents the". Leave it empty for none.</li>
  <li><strong>Title</strong>: the certificate's name, printed largest, and what the player sees on their shelf.</li>
  <li><strong>Subtitle</strong>: under the title, in the accent colour.</li>
  <li><strong>Line before the name</strong>: introduces whoever receives it, such as "This certificate is proudly presented to".</li>
  <li><strong>Presented to</strong>: <strong>The player</strong>, or <strong>The player's guild</strong> (see Guild Certificates below).</li>
  <li><strong>Stats to show</strong>: any of Level, XP, BLOO and Energy, printed along the foot in this adventure's own names. Energy is offered only when the adventure uses it.</li>
  <li><strong>Achievement on the certificate</strong>: <strong>None</strong> (the text takes the full width), <strong>The one each player chooses</strong> (see The Display Badge below), or <strong>One achievement this certificate is for</strong>: pick it, and the certificate always carries that achievement and only players who have earned it get the certificate.</li>
  <li><strong>Order</strong>: lowest first, where an Adventure has several.</li>
</ul>

<h3>Design</h3>
<ul>
  <li><strong>Colours</strong>: Background, Text and Accent. The accent colours the headline, the subtitle, the stat numbers and the achievement name. <strong>Draw a line under the name</strong> adds a rule under the recipient.</li>
  <li><strong>Logo</strong> and <strong>Signature</strong>, each with its own alignment (left, centre or right). Together they take at most 35% of the page's height; the text gets the rest. <strong>Signed by</strong> prints a name and their role under the signature. Left empty, a guild certificate falls back to the guild's own logo, and a player certificate prints without one.</li>
  <li><strong>Background image</strong>: <strong>Fill the certificate</strong> or <strong>Show the whole picture</strong>, a <strong>Blend mode</strong> that mixes it with the background colour (Multiply darkens, Screen lightens, Luminosity tints), and <strong>Image filters</strong> (opacity, brightness, contrast, saturation, grayscale, sepia, hue shift and blur). <strong>Reset colours and filters</strong> starts the design over.</li>
</ul>
<p>The preview says so when it has shrunk the text to fit the page.</p>

<h3>Content</h3>
<p>The body of the certificate. <strong>Placeholders</strong> let one wording serve every recipient: <code>{name}</code> (the player or the guild, whichever it's for), <code>{first_name}</code>, <code>{last_name}</code>, <code>{guild_name}</code>, <code>{adventure_title}</code>, <code>{level}</code>, <code>{xp}</code>, <code>{bloo}</code>, <code>{ep}</code>, <code>{members}</code>, <code>{start_date}</code>, <code>{end_date}</code> and <code>{today}</code>. The player tokens work here too, such as <code>{{ player.first }}</code> or <code>{{ progress.level }}</code>; see <a href="/docs/personalising-text-with-player-tokens">Player Tokens</a>.</p>

<h3>Conditions</h3>
<p><strong>When this certificate unlocks</strong> has two choices. <strong>Open — available from the beginning</strong>: every player has it from the moment they start. <strong>Earned — unlocked by meeting conditions</strong>: add conditions with <strong>Add Condition</strong>, and the certificate stays locked until the player meets <strong>all</strong> of them. A certificate for one achievement can stay Open (the achievement alone unlocks it) or add conditions on top.</p>
<p>Press <strong>Create certificate</strong> (or <strong>Update Certificate</strong>) in the bottom bar. One save writes the certificate and its conditions together, with its publication status (Publish, Draft or Trash) beside it.</p>

<h2>When It Unlocks</h2>
<p>Certificates use the same Conditions engine as achievements and tasks: level, XP, journey percentage, milestones or Tabis completed, a specific milestone or Tabi, purchases, items used, achievements held, guild level and size, and Blooms. Counters can look at a rolling time window. See <a href="/docs/conditions-when-things-unlock">Conditions: When Things Unlock</a> for the full list.</p>
<p>Players see a locked certificate on their Achievements page with what's missing and, where it can tell, where they stand: <em>"Reach level 9 — you're at level 5"</em>. That sentence comes from the same engine that evaluates the rule, so the hint and the gate can't disagree. The certificate page itself refuses to open a certificate a player hasn't unlocked, so sharing the link doesn't get around the conditions.</p>

<h2>Requiring Rubric Criteria</h2>
<p>When the adventure uses Graduation Criteria, a condition row can be <strong>Meet Rubric Criteria</strong>, with a tick for each criterion (see <a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a>). A player only qualifies once every ticked criterion reads "met", which lets you build graduated certificates: a "Graduation" certificate needing two lighter criteria, and a tougher "Distinction" certificate needing those plus a third.</p>

<h2>Guild Certificates</h2>
<p>Set <strong>Presented to</strong> to <strong>The player's guild</strong> and the certificate is made out to the team. It carries the guild's name and logo and prints the guild's numbers plus its member count. Those numbers are <strong>worked out live from the members</strong> when the certificate is opened: totals for XP, BLOO and energy, and the members' average for level, so one strong member can't speak for everyone. Players who aren't in a guild aren't shown guild certificates at all, rather than seeing one locked forever.</p>
<p>Conditions are checked for the player opening the certificate. The guild conditions ("Your guild reaches level 5", "Your guild reaches 8 members") are the natural fit here.</p>

<h2>The Display Badge</h2>
<p>With <strong>The one each player chooses</strong>, the certificate prints the badge the player has chosen to be represented by, or their current rank if they haven't chosen. Players pick it on their Achievements page, from the badges and ranks they hold (paths are left out). It's stored separately from their rank, so levelling up never overrides their choice.</p>

<h2>Printing</h2>
<p>Every certificate prints on one page, US Letter landscape, and only the certificate itself reaches paper. Its dates are the Adventure's Start and End dates from the Basics pane of Adventure Settings. On their certificate's page players can show or hide the achievement and the stats, then press <strong>Print</strong>; their browser's print window can also save it as a PDF.</p>

<h2>Managing Certificates</h2>
<p>The Certificates tab lists Published, Drafts and Trash. Each row shows its logo, signature and background as small pictures you can change or remove right there, its name (edit it in place), who it's for, which stats it prints, and what unlocks it: "Earn" an achievement, how many conditions, or open from the start. You can search, filter to player or guild certificates, and sort. Each row has:</p>
<ul>
  <li><strong>Edit</strong></li>
  <li><strong>Preview</strong>: opens the printable page. Staff can preview a certificate they haven't unlocked themselves.</li>
  <li><strong>Make draft</strong> / <strong>Publish</strong>, <strong>Duplicate</strong> and <strong>Trash</strong></li>
  <li>In Trash: <strong>Restore</strong>, or <strong>Delete forever</strong>, which removes its conditions too.</li>
</ul>

<h2>Hiding Locked Certificates</h2>
<p>By default, players see every certificate on their Achievements page, with locked ones dimmed and a list of what's still missing. <strong>Hide Certificates</strong>, in the What players can see panel of Adventure Settings → Rules &amp; scoring, keeps locked certificates off players' Achievements pages until they're unlocked. Staff always see all of them.</p>

<h2>Templates and Cohorts</h2>
<p>Certificates are authored on the template and shared live with every cohort. What they measure, a player's level or a guild's members, is always read from the cohort the player is in. Duplicating a whole Adventure copies its certificates with their conditions.</p>

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
                'sort_order' => 23,
                'body'       => <<<'HTML'
<h2>Should This Adventure Use Guilds?</h2>
<p>Guilds add a team layer on top of individual progress. They're good for cohort-based programs (a bootcamp class, a department-wide rollout) where a bit of friendly competition or shared accountability helps. For a purely self-paced, individual course they're often unnecessary overhead; skip them if there's no real team behind the players. Turn them on with the <strong>Guilds</strong> section in Adventure Settings → Sections.</p>

<h2>Creating Guilds &amp; Setting Capacity</h2>
<p>Create guilds from Manage Content → Guilds → <strong>Add New Guild</strong>, or from the menu's Add group. The guild editor has four tabs: <strong>Settings</strong>, <strong>Members</strong>, <strong>Roles</strong> and <strong>Assign Players</strong>. On Settings each guild has a <strong>Guild Name</strong>, a <strong>Guild Logo</strong> (required), a <strong>Color</strong>, an optional <strong>Group</strong> and a <strong>Capacity</strong> (0 means no limit). Distinct names, colours and logos make them readable on the leaderboard, and a capacity keeps group sizes even: it caps who can join by the invite link or be placed automatically, while a Game Master assigning by hand may still go over.</p>
<p>The <strong>Group</strong> sorts a long list into piles, and Manage Guilds can filter by it. It also matters for invite links: a player already in a guild can't use a link to join a second guild in the same group.</p>
<p>Many guilds at once can come in from a CSV file, with the Upload beside Add New Guild; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>Putting Players in Guilds</h2>
<ul>
  <li><strong>Automatically on joining</strong>: set <strong>Assign guilds on login</strong> to Yes (Adventure Settings → Basics, Guilds &amp; schedule). A new player is placed in whichever published guild has the fewest members and still has room.</li>
  <li><strong>From the player CSV</strong>: the enrollment import's Guild column creates or joins a guild by name as players come in. See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</li>
  <li><strong>Into guilds that already exist, by CSV</strong>: on Manage Guilds, <strong>Assign players to a guild</strong>: pick the guild, upload a CSV with one column of email addresses, and press <strong>Assign from file</strong>. A guild's own editor has the same as <strong>Bulk Assign Players (CSV)</strong>. Everyone matched is moved into that guild, replacing any guild they were in. Anyone already in it is left alone, so running the same file twice is safe, and a full guild stops accepting people once it reaches capacity.</li>
  <li><strong>One at a time</strong>: the guild editor's <strong>Assign Players</strong> tab.</li>
  <li><strong>By link</strong>: once a guild is saved, its editor shows an <strong>Enrollment Link</strong>. A player of the adventure who opens it joins that guild, as long as it has room and they're not already in a guild of the same group; they're told which of those happened.</li>
</ul>

<h2>Guild Leaders</h2>
<p>Each guild can have a leader, chosen from its members in the <strong>Leader</strong> column on Manage Guilds (or set back to <strong>No leader</strong>). The roster marks the leader with a badge. It's a title for now, with no extra powers attached.</p>
<p>Appointing a leader is the one guild change an NPC can make. Everything else on Manage Guilds is view-only for them.</p>

<h2>Roles: Who Holds Which Path</h2>
<p>When a guild is a crew with roles to fill (a facilitator, a scribe, a timekeeper), make the roles the paths of a branch and let the guild's members pick them with a Branch Choice step set to <strong>One per guild</strong>, so each role is taken once per guild. The guild editor's <strong>Roles</strong> tab shows who in the guild holds each path, and lets a coach give a path to a member directly; the step then shows it to them as their choice. See <a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a>.</p>

<h2>Open Rosters</h2>
<p>Guilds are public within an adventure. On the Guilds page, clicking a guild's card or row opens its roster: its players, best first, each with their level, XP, BLOO and the achievements they hold, the leader marked. Staff see more in the same roster: each member's engagement, journey progress, last sign-in and every milestone. Players never see anyone's email address.</p>

<h2>Standings: Averages, Levels and Who Counts</h2>
<p>Guilds are ranked on their members' <em>average</em>, so a 40-person guild can't out-rank a 6-person one on headcount alone. The order is the guild's level first, then average XP, average BLOO, total XP and total BLOO. A guild's <strong>level</strong> comes from its members' average XP, on the same curve players use. On the Guilds page (with the Leaderboard section on) the top five show as cards, each with its place, and the rest as a table, 20 a page, with each guild's members, level, average XP, total XP and BLOO, and a search box. A player's own guild has a card of its own that reads from the same row, so the two never disagree. The guild leaderboard widget on the Journey uses the same ranking.</p>
<p><strong>Only players count.</strong> A GM or NPC sitting in a guild adds nothing to its totals, member count, average or level, and neither does anyone who has left the adventure. That matters beyond the leaderboard, because <strong>Guild Level</strong> and <strong>Guild Members</strong> are condition types: a GM in a guild can't hold back a scene stage or a badge for the whole team.</p>

<h2>Managing Guilds at Scale</h2>
<p>An import with a Guild column can create hundreds of guilds. Manage Guilds lists Published, Drafts and Trash as tables of their own, each with a select-all box and its own bulk bar: tick the ones you want and use <strong>Move to draft</strong> or <strong>Move to trash</strong> (or Publish and Restore) rather than working row by row. Each row also has <strong>Duplicate</strong>. Trashed guilds can be restored, deleted for good one by one, or cleared at once with <strong>Empty trash</strong>. Deleting a guild for good releases its members, so they can be assigned to another guild afterwards.</p>

<h2>Guilds Everywhere Else</h2>
<ul>
  <li><strong>The Wall</strong> has one Guilds tab. A player in a single guild goes straight into its feed; anyone in several guilds, and staff, get a searchable picker. See <a href="/docs/announcements-keeping-an-adventure-alive">Announcements</a>.</li>
  <li><strong>Conditions</strong> can use Guild Level and Guild Members, so a whole team can unlock a badge or grow an evolving Tabi scene together.</li>
  <li><strong>Certificates</strong> can be issued to a guild. See <a href="/docs/certificates-authoring">Certificates, for GMs</a>.</li>
  <li><strong>Sessions</strong> on the Event Schedule can be limited to one guild.</li>
</ul>

<h2>Running a Guild Leaderboard Moment</h2>
<p>Guild standings are most motivating when they're actually visible, not just theoretically trackable. Call them out in a live session, screen-share the leaderboard at a kickoff, or post an <a href="/docs/announcements-keeping-an-adventure-alive">announcement</a> when the standings shift. A leaderboard nobody looks at doesn't do anything.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/conditions-when-things-unlock">Conditions — When Things Unlock</a></li>
  <li><a href="/docs/branching-and-prerequisites-non-linear-adventures">Branching &amp; Prerequisites</a> — One per guild and Roles</li>
  <li><a href="/docs/achievements-and-guilds">Achievements &amp; Guilds (player view)</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Item Shop — Building an In-Adventure Economy',
                'slug'       => 'item-shop-building-an-economy',
                'section'    => 'setup',
                'sort_order' => 24,
                'body'       => <<<'HTML'
<p>The Item Shop turns BLOO from a score into an economy: a reason to keep earning it beyond the number going up. As the GM, you decide what's for sale. Turn it on with the <strong>Item Shop</strong> section in Adventure Settings → Sections (it covers the shop, the backpack and item rewards); with it off, players see "The item shop is now closed!".</p>
<p>Create items from Manage Content → Items → <strong>New Item</strong>, from the menu's Add group, or from the <strong>Add new item</strong> button at the bottom of the shop. A whole catalogue can come in from a CSV file; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>.</p>

<h2>The Item Types</h2>
<ul>
  <li><strong>Consumable</strong>: used once and gone. The player presses <strong>Use</strong> in their backpack, which marks it redeemed; what it actually does is yours to honour (a hint, an extension, a coffee with the CEO). Design these as small conveniences, not power that trivializes your content. You'll see every use on the Transactions page.</li>
  <li><strong>Key</strong>: held, never spent. A milestone's or a Tabi's Conditions drawer can require a key item (<strong>Requires this key item</strong>), which makes a Key your soft-lock tool: instead of a hard prerequisite, make the way in something players earn or buy.</li>
  <li><strong>Reward</strong>: a keepsake with no functional effect. Rewards aren't sold: hand them out as a milestone's Item Reward or through a Find Item step. Cosmetic items are underrated for motivation; not everything needs a mechanical purpose.</li>
  <li><strong>Tabi Piece</strong>: one piece of a Tabi's collage. Choose the Tabi under Tabi Settings; players who collect the pieces fill in that Tabi's board on the Tabis page. <strong>Open the Tabi editor</strong> places it; see <a href="/docs/tabi-editor">The Tabi Editor</a>.</li>
  <li><strong>Gift Card</strong> (Enterprise only): a real gift card, emailed to the player when they buy it. See Gift Cards below.</li>
</ul>

<h2>Item Settings</h2>
<p>Which fields appear depends on the type:</p>
<ul>
  <li><strong>Cost</strong> (in BLOO) and <strong>Level</strong>, the level a player needs to buy it: for everything sold: consumables, keys, Tabi pieces and gift cards.</li>
  <li><strong>Stock</strong>: how many the shop can sell, for consumables, Tabi pieces and gift cards. Leave it blank for unlimited, and the shop shows ∞.</li>
  <li><strong>Max per player</strong>: for consumables and gift cards; leave it at 0 for no limit. Keys, Rewards and Tabi pieces are always one per player.</li>
  <li><strong>Display in shop</strong>: Visible or Hidden, for consumables, Tabi pieces and gift cards. A hidden item is kept out of the shop, for things you only want handed out by a Find Item step or by you.</li>
  <li><strong>Group</strong>: a colour category for consumables and gift cards, shown as a badge in the shop. When an item is in a group, its Max per player counts everything the player holds from that group, so you can cap "any two potions" rather than two of each.</li>
  <li><strong>Available for</strong>: all paths, or only players on one path.</li>
  <li><strong>Description</strong>: what the item is for. Player tokens work here.</li>
</ul>

<h2>What the Shop Enforces</h2>
<p>Every purchase is checked on the server: the level, the stock, the per-player (or per-group) limit, and whether the player can afford it. <strong>The shop never sells on credit.</strong> Encounters can push a player's BLOO below zero, but the shop still refuses anything they can't afford, so debt stays a setback rather than a loophole.</p>
<p>Stock and caps are race-safe. Two players buying the last unit at the same moment can't both get it, and a double-click can't buy past a cap: the purchase that lands second is told there are none left. Refunding a purchase frees its stock again.</p>

<h2>Managing Items</h2>
<p>Manage Content's <strong>Items</strong> tab lists everything by type (keys, rewards, consumables, Tabi pieces and, where they exist, gift cards), with a search, a path filter and a sort. Each Tabi piece links to its Tabi. Drafts and trashed items have their own panels below.</p>

<h2>Buying on a Player's Behalf</h2>
<p>For a player who can't work the shop themselves, use <strong>Assign</strong> on the item's row in Manage Items, then pick the player. It's a real purchase at the normal price, paid from the player's own BLOO, with the same stock and per-player limits; a free grant would distort your economy. The one thing it skips is the level requirement.</p>

<h2>Transactions</h2>
<p>The <strong>Transactions</strong> page (in the menu's Watch column for staff) lists every item a player has bought or been given in the adventure, with quick filters for new and used items, a search, filters by item and by player, and a running total spent. Each row has:</p>
<ul>
  <li><strong>Use</strong>: mark the item used for the player.</li>
  <li><strong>Return</strong>: undo a use and put the item back in their backpack. Only staff can do this; players can't un-use their own items.</li>
  <li><strong>Delete and refund</strong>: take the purchase off their record, which gives the BLOO back. Something the player already had the use of (an item they've used, a gift card already sent) shows a lock instead.</li>
</ul>
<p>Switch on <strong>Show players their transactions</strong> (in the Item Shop's card on Adventure Settings → Sections) and each player gets a Transactions tab on the shop, backpack and Tabis pages listing what they bought and received. Player Records shows the same purchases per cohort, with filters, bulk removal and a way to restore removed ones.</p>

<h2>Gift Cards (Enterprise)</h2>
<p>Gift cards are part of BLUERABBIT Enterprise: they're sent through Tremendous, which is connected on Enterprise platforms only (see <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>, and <a href="/contact">Contact</a> us about Enterprise). Once the adventure's Tremendous connection is set up, the Gift Card type appears, and on the item:</p>
<ul>
  <li><strong>Card Value</strong>: in the currency set on the Tremendous connection. <strong>Cost</strong> is still what the player pays in BLOO.</li>
  <li><strong>Label (optional)</strong>: e.g. "Amazon Gift Card".</li>
  <li><strong>Card Source</strong>: <strong>Adventure default campaign (recommended)</strong>, <strong>A different campaign, just for this item</strong>, or <strong>Specific brands from the catalogue</strong>. A campaign decides which brands the player can choose from, and you curate it in your Tremendous dashboard.</li>
</ul>
<p>The card goes to the player's account email. Before any BLOO is spent, a card that can't be sent (no campaign, no email on file) is refused, and if the send fails nothing is deducted. Every send is listed under <strong>Gift Card Orders</strong> in Manage Items.</p>

<h2>Pricing With BLOO</h2>
<p>Price items relative to how much BLOO a typical player has actually earned by the point they'd realistically want the item. A shop full of things nobody can afford yet reads as broken, not aspirational. Use Level to hold the big-ticket items back until later. BLOO is the default name; if you've renamed it for this adventure, every price shows your name.</p>

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
                'sort_order' => 25,
                'body'       => <<<'HTML'
<p>An encounter is the world acting on a player who was expecting an ordinary session: the fridge dies two hours before service, a big client calls with an offer. Each encounter is a <strong>card</strong>, either a crisis or an opportunity, and each card points at a milestone. When it's time, the player is dealt a hand of face-down cards on the Journey and turns one over. That locks them into the card's milestone until they finish it, and inside it an <strong>Encounter Choice</strong> step makes them decide what to do, with the price of every option shown up front.</p>
<p>Encounters are an optional layer. A straightforward adventure without any is a completely valid, often clearer, design. Reach for them when you want the program to push back.</p>

<h2>Turning Encounters On</h2>
<p>Encounters run on energy, so they only happen when the adventure's <strong>Energy Points (EP)</strong> switch is on (Adventure Settings → Rules &amp; scoring). Switch it off and no hands are dealt, and the Random Encounters panel disappears from Stats. With it on, Manage Content has an <strong>Encounters</strong> tab and the menu's Add group offers <strong>Encounter</strong>. Staff — GMs, NPCs and admins — are never dealt a hand.</p>

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
  <li><strong>Name</strong> — printed on the card's face when it turns over, with the teaser.</li>
  <li><strong>Kind</strong> — Crisis or Opportunity. Not everything is chaos: opportunities keep the engine from reading as pure punishment.</li>
  <li><strong>The milestone this loads</strong> — where the player is locked until they resolve it. An encounter with no milestone never fires.</li>
  <li><strong>Draw weight</strong> — higher comes up more often. <strong>0</strong> keeps it out of random draws entirely: staff-fired only.</li>
  <li><strong>Can happen more than once</strong> — off by default, because a fridge dies once. Turn it on for recurring pressures like a slow week.</li>
  <li><strong>Not before</strong> / <strong>Not after</strong> — a date window, by the adventure's time zone. Use it instead of scheduling ("the supplier price hike arrives in week 6"), and to retire a card without unpublishing it.</li>
  <li><strong>The Card</strong> — the <strong>Teaser</strong> (one line; the full situation belongs in the milestone), a <strong>Card image</strong> and a <strong>Colour</strong>.</li>
</ul>
<p>Assign a card to a group from the <strong>Group</strong> dropdown on its row in Manage Content. Each row also edits art, name, kind, colour and weight in place, and calls out anything that would stop it working: "No milestone — cannot fire", "staff-fired only", a date window that hasn't opened or has passed, and how many players have already faced it. The header sums it up: how many cards can be dealt right now, how many are scheduled, how many are past their window, and how many cannot fire. Trashed cards can be restored or deleted for good.</p>

<h2>Preview a Hand</h2>
<p><strong>Preview</strong> shows you what a draw looks like without anything happening. It's on every group's row (a sample hand from that group), on every card's row (a sample hand that always includes that card) and in the encounter editor's bottom bar, where it uses the form as you have it, unsaved changes and all, so you can see a card before you create it. The real overlay opens with its mood and the group's hand size, and a bar to <strong>Flip all</strong>, <strong>Turn all back</strong>, <strong>Deal again</strong> or close it (Esc works too); click a card to turn it over and back. The preview draws from every card in the group, drafts and weight-0 cards included, and says how many cards the group has and how many could be dealt to a player today. Nothing is recorded: no player is dealt anything and no price is charged.</p>

<h2>The Draw and the Lock</h2>
<p>A hand is dealt on the player's next Journey visit. The cards are a weighted sample of the group's eligible cards, with no duplicates, and the hand is saved the moment it's dealt, so reloading shows the same cards rather than a reshuffle. The player turns one over; the others go back in the pool untouched.</p>
<p>Picking a card sends the player into its milestone, and from then until they finish it, opening the Journey takes them back there. Only the Journey is locked: the Garden, Tasks and the Item Shop stay open, which is what makes recovering from a setback possible. The lock also opens that one milestone even if its own gating (a level requirement, say) would normally keep the player out, so a setback that costs a level can't strand anyone.</p>
<p>An unresolved encounter takes priority over everything else on the Journey, a freshly dealt hand comes next, and only then does an autoload milestone run.</p>

<h2>The Encounter Choice Step</h2>
<p>Add an <strong>Encounter Choice</strong> step to the milestone (it's in the Flow group) and use <strong>Add Option</strong> for each choice. Each option is a numbered card in three blocks, every field explained where you fill it in:</p>
<ul>
  <li><strong>What the player reads</strong>: the <strong>Button text</strong> ("Call a technician"; an option without it isn't saved) and an optional <strong>Description</strong>, one line with the catch ("Cheaper, but it is a patch, not a fix.").</li>
  <li><strong>What it costs and pays</strong>: <strong>Costs</strong> BLOO, <strong>Pays</strong> BLOO, <strong>Costs Energy</strong>, and an XP change, signed: positive pays XP, negative takes it away, and losing enough costs a level. The BLOO and XP fields carry this adventure's names for them. Leave 0 for none.</li>
  <li><strong>What happens after</strong>: <strong>Then grant an achievement</strong> — require that achievement on a follow-up milestone and you've built a consequence chain: "the tech patched it for 200, but you still need a new fridge". <strong>Then say a message</strong> — a <a href="/docs/consequences">consequence</a> set to "After a specific choice", which pops up right after the choice.</li>
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
  <li><strong>Send to a player</strong> fires a card at one player right now, bypassing the draw. It's the only way a weight-0 card is ever used, and it's built for live sessions where the whole room should hit the same beat. It opens a picker of the cohort's players by name, with a search; anyone already facing an encounter is shown as such and can't be sent another.</li>
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
                'sort_order' => 26,
                'body'       => <<<'HTML'
<p>A consequence is a message that lands on a player when something happens to them: "You've gone into debt", "You're halfway there", "The tech got there in time. The fridge lives, for now." It's how the game reacts out loud. A consequence only delivers a message; it never changes anyone's balance.</p>

<h2>Two Kinds</h2>
<ul>
  <li><strong>When a state is crossed</strong> — it watches one number and fires by itself the moment a player crosses the line you set.</li>
  <li><strong>After a specific choice</strong> — it fires when a player picks an <a href="/docs/random-encounters">Encounter Choice</a> option whose <strong>Then say a message</strong> names it.</li>
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
  <li><strong>A choice's outcome</strong> — After a specific choice, then pick it in the option's <strong>Then say a message</strong>. This is where the story of what happened next goes: "Patched, not fixed."</li>
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
                'sort_order' => 27,
                'body'       => <<<'HTML'
<p>The companion how-to for <a href="/docs/xp-bloo-ep-explained">Understanding XP, BLOO &amp; EP</a>. This is where you change what the three currencies are called, whether energy exists at all, and what happens as players level up. All of it is on the <strong>Rules &amp; scoring</strong> pane of Adventure Settings.</p>

<h2>Renaming XP, BLOO &amp; EP</h2>
<p>The <strong>Points &amp; currencies</strong> panel gives each currency a name and a short name: <strong>Experience points</strong> and its <strong>Short name</strong>, <strong>Currency</strong> and its short name, and <strong>Energy points</strong> and its short name. Short names appear next to numbers, long names in sentences. The defaults are Experience Points / XP, Bloo Coins / BLOO, and Energy Points / EP.</p>
<p>Relabel XP as "Skill Points" / "SP" to fit a corporate training theme, or BLOO as "Guild Coin" for a more game-like Adventure. The mechanics underneath never change, only what players see them called: the new names follow wherever the numbers appear, from the editors' reward fields to the shop and certificates. A cohort can give its currencies names of its own in its Cohort Settings.</p>
<p>In the <strong>Ranks</strong> panel, <strong>Title before the first rank</strong> is what a player's rank reads until they earn one: "Explorer", "Recruit", whatever fits your theme. Write it in the singular.</p>

<h2>Turning Energy On or Off</h2>
<p>Energy is its own switch: <strong>Energy Points (EP)</strong>, in the same Points &amp; currencies panel. It covers the whole energy economy: EP rewards on milestones, challenges and achievements, the energy bar, EP on the certificate, and <a href="/docs/random-encounters">random encounters</a>. Switch it off and EP disappears from every screen players see, its names are hidden here, and no encounters are dealt.</p>
<p>If you leave it on, give players a way to earn energy back: Garden Tasks can pay <strong>Reward Energy</strong>, and that's what encounters spend.</p>

<h2>Adventure Ranks</h2>
<p>Ranks turn a raw level number into a title: Level 5 becomes "Bronze Explorer", Level 15 becomes "Guild Master", each with its own badge. A rank is an achievement a player holds as their title, given when they reach the level you set on the rank ladder, the <strong>Ranks</strong> panel:</p>
<ol>
  <li>Create the ranks first, as achievements with the type <strong>Rank</strong>. If none exist yet, the panel offers <strong>Create the first rank</strong>.</li>
  <li>For each rung, fill in a row with a <strong>Level</strong> and the Rank achievement it awards. <strong>Add Rank</strong> adds another row.</li>
</ol>
<p>The ladder is level-based and nothing else: a Rank achievement doesn't use Auto-Grant Conditions. When a player reaches a rung's level they receive that rank (and any lower ones they'd skipped) with a level-up message showing its badge, and the highest becomes their current rank. A GM can grant a rank by hand, but not to a player below its level. Ranks belong to the template, so every cohort shares one ladder. More on designing the ladder in <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>

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
                'sort_order' => 28,
                'body'       => <<<'HTML'
<p>A QR code is how something that happens in a room counts inside an Adventure. A player scans a printed or projected code with their phone, and the Adventure records it. BLUERABBIT has three kinds of QR code, and each does a different job: an achievement code awards a badge, a task code completes a repeatable task, and a milestone code completes a milestone outright.</p>

<h2>Achievement QR Codes: Scan to Earn a Badge</h2>
<p>Every achievement has a magic code, and once the achievement is saved its <strong>QR Code</strong> appears in the achievement's settings, next to the badge. Scanning it redeems the code and awards the achievement on the spot, with the same celebration as any other reward. It's the right tool for a one-time check-in: "attended orientation", "visited the lab", "met the founder".</p>
<ul>
  <li>When the adventure has Magic Codes switched on, players can also type the code into the <strong>Magic Code</strong> box (the menu in the New view, the taskbar in the Classic view) instead of scanning. Put it on the slide under the QR code for anyone whose camera won't cooperate; capitals don't matter.</li>
  <li>A player who already holds the achievement is told so, and nothing is awarded twice. Branches still hold: nobody can earn two achievements from the same branch. Any refusal says why in a panel that stays until the player closes it.</li>
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
<p><strong>Troubleshooting a missing QR code:</strong> if a task's QR code doesn't appear, open Manage Content → Tasks once — that's enough to generate it. A task you've duplicated or copied into a new cohort always gets its own fresh code, so one group's printed code is guaranteed never to work for another group's copy of the same task.</p>

<h2>Milestone QR Codes: Quick-Complete</h2>
<p>A milestone can also be completed by a scan. Once a milestone is saved, its code appears in the milestone builder beside the Main Image, with <strong>Download QR</strong> for a picture you can print or project. Scanning it completes the milestone outright for the player who scans it and pays its XP and BLOO, plus any item or achievement reward, skipping level requirements, conditions, start dates and deadlines. It's the one completion path in BLUERABBIT deliberately built to skip the rest of the system. The milestone has to be published, a second scan only says it's already completed, and the completion screen offers <strong>Back to the journey!</strong>.</p>
<p>Because it skips everything, it's not the tool for anything you actually want gated. Reserve it for milestones where "being physically present and scanning" is the whole point.</p>

<h2>One Code Per Cohort</h2>
<p>A QR code belongs to the adventure it was made in, so each cohort of a template has its own. An achievement lives on the template, but its QR code is made per cohort: open the achievement from inside the cohort you're printing for, and the editor tells you which adventure the code redeems into. A milestone's code is the exception: the one the milestone builder downloads serves the template and all its cohorts, and each scan counts in the cohort the player is playing, so one printed code covers every cohort. Tasks belong to each cohort too. A cohort's copy of a QR task starts without a code, so open it on that cohort's Tasks tab and save it to issue one. Printing one cohort's code for another sends every scan to the wrong adventure.</p>

<h2>Before the Event</h2>
<ul>
  <li><strong>Get everyone enrolled and logged in first.</strong> A phone that isn't logged in goes to the sign-in page when it scans. That's only a detour: an achievement, milestone or task code is kept for an hour, and once the player signs in it runs. A sign-in with <strong>Remember Me</strong> ticked (it is by default) lasts 30 days, so logging in once the day before is enough.</li>
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
                'sort_order' => 29,
                'body'       => <<<'HTML'
<p>Not every part of an Adventure needs to be a milestone. The <strong>Schedule</strong> is a separate, informational layer for anything tied to a time and a place (live sessions, workshops, who's speaking), sitting alongside the Journey Map rather than gating progress on it.</p>

<h2>Sessions</h2>
<p>A session is a scheduled block (a workshop, a live Q&amp;A, an orientation walkthrough) with a title, a start and end time, a description and, for in-person or hybrid programs, a room. Players see sessions grouped by day, and clicking one opens its details in a window over the schedule: the date and time, the room, who's speaking and the full description.</p>
<p>Sessions don't unlock, block or reward anything on their own. Two optional settings make them more than a list:</p>
<ul>
  <li><strong>Attach a milestone or challenge</strong>, and the session's details carry a button that opens it.</li>
  <li><strong>Limit who sees it</strong> to players on one path (or holding one rank), or to one guild. Anyone outside it doesn't see the session at all, so the Engineering track never sees the Sales workshop.</li>
</ul>
<p>An adventure setting, <strong>Schedule days shown</strong>, decides whether players see every day's sessions or only today's. A long program doesn't have to be typed in one session at a time: the Schedule page takes a CSV file of sessions, and the Speakers tab one of speakers (see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>).</p>

<h2>Speakers</h2>
<p>A speaker is a person with a picture, a name, a company, links and a short bio. Attach speakers to sessions and players can open a speaker's page to read about them and see every session they're in. With the Speakers section on, players also get a Speakers page listing everyone.</p>
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
                'sort_order' => 30,
                'body'       => <<<'HTML'
<p>Step by step. See <a href="/docs/event-schedule-concept">The Event Schedule — Concept</a> for what sessions and speakers are for.</p>

<ol>
  <li><strong>Switch the sections on.</strong> In Adventure Settings → Sections, turn on <strong>Schedule</strong>, and <strong>Speakers</strong> too if you want players to have a Speakers page. The Schedule then appears in your players' menu, and <strong>Session</strong> and <strong>Speaker</strong> appear in your menu's Add group (<strong>New Session</strong> and <strong>New Speaker</strong> under Add Mechanics in the Classic view).</li>
  <li><strong>Add your speakers first.</strong> Open Manage Content's <strong>Speakers</strong> tab and press <strong>New Speaker</strong>. Give the speaker a picture and a first and last name, and add a company, website, LinkedIn and a short bio if you have them. <strong>Connect to Player</strong> optionally links the speaker to a staff member's account, and fills in the name, picture, bio and links from that account's profile wherever the profile has them. Press <strong>Create Speaker</strong>. Add each person once and reuse them in every session and dialogue line they appear in.</li>
  <li><strong>Create a session.</strong> Choose <strong>Session</strong> in the Add group and give it a title, a <strong>Session Start</strong> and a <strong>Session End</strong> (both required), a <strong>Session Description</strong>, and a room under <strong>Room Information</strong> if it's in person.</li>
  <li><strong>Tick its speakers.</strong> The Speakers list appears once the adventure has at least one.</li>
  <li><strong>Link it and limit it, if you want to.</strong> <strong>Attach to Quest</strong> links a milestone or challenge, which players can then open from the session's details. In the bottom bar, <strong>Visible to path</strong> limits the session to one path or rank, and <strong>Visible to guild</strong> to one guild. Each of these appears only when the adventure has paths or guilds to pick from.</li>
  <li><strong>Publish it.</strong> Leave the status in the bottom bar on Publish (or Draft to keep it out of sight) and press <strong>Create Session</strong>. Repeat for every session, or upload the whole program at once with <strong>Upload Schedule</strong> on the Schedule page (see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads with CSV</a>).</li>
  <li><strong>Check the Schedule.</strong> Sessions appear grouped by day; click one to open its details. As a GM you'll see an edit button on each session, and an <strong>Edit</strong> button inside its details.</li>
</ol>

<h2>Good to Know</h2>
<ul>
  <li><strong>It's content, not mechanics.</strong> A session pays no XP or BLOO and gates nothing. If attendance should count, put a QR code in the room (see <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>).</li>
  <li><strong>On the day itself</strong>, set <strong>Schedule days shown</strong> to "Just today" (Adventure Settings → Basics, Guilds &amp; schedule), and players see only today's sessions. "Show all days" brings back the full calendar.</li>
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
                'sort_order' => 31,
                'body'       => <<<'HTML'
<p>If you already have e-learning content built in another authoring tool, you don't have to rebuild it inside BLUERABBIT from scratch. The <strong>SCORM Package</strong> step type runs it inside a milestone.</p>

<h2>What SCORM Is</h2>
<p>SCORM is a long-standing e-learning packaging standard. Most authoring tools (Articulate, Captivate and similar) can export a course as a SCORM package: a single <code>.zip</code> file. BLUERABBIT supports <strong>SCORM 1.2</strong>. A SCORM step plays the package in a frame inside the step, with a <strong>Full screen</strong> button in the step bar, and listens for it to report that it's finished.</p>

<h2>What You Get</h2>
<ul>
  <li><strong>Completion tracking.</strong> When the package reports itself completed or passed, the step is done and the player's Continue unlocks. No manual grading, and no separate spreadsheet of who finished the external course. It slots into the milestone and the Journey Map like any other step, rewards included. If the player's finish can't be confirmed (a dropped connection, say), the step keeps trying for a few seconds and then tells them so, with <strong>Check again</strong>, rather than leaving them unsure.</li>
  <li><strong>Resume.</strong> What the package saves about a player's place is kept, so someone who leaves partway can pick up where they left off.</li>
  <li><strong>The score.</strong> A score the package reports is kept, as a percentage, and handed back to the package when the player returns. You'll find it on Manage Content's SCORM tab and in the player's Journal.</li>
  <li><strong>Study notes.</strong> When the adventure can build notes, uploading a package writes draft study notes from it for the <a href="/docs/library-study-notes-and-glossary">Library</a>.</li>
</ul>

<h2>What It Doesn't Decide</h2>
<p>The score is recorded, not enforced: the step is done when the package says completed or passed, whatever the score, and a package that reports "failed" leaves the step open until the player gets through it. If a pass mark matters, set it inside the package so it reports "failed" below it, or follow the package with a <a href="/docs/challenges-concept">Challenge</a> that tests the same material.</p>

<h2>Storage</h2>
<p>A package counts toward the storage allowance of the account that uploads it: the size of the <code>.zip</code>, not the unpacked size. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a>.</p>

<h2>When to Reach for It</h2>
<p>Use SCORM when strong content already exists and rebuilding it natively would be pure duplicated effort: a compliance course, a vendor-provided training module. For anything you're building fresh, native steps (Dialogue, Slides, Open Text, Multiple Choice and the rest) are usually a better fit, and give you BLUERABBIT's own reward and branching tools directly.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/how-to-add-a-scorm-package">How to Add a SCORM Package</a></li>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/library-study-notes-and-glossary">Authoring the Library: Study Notes &amp; Glossary</a></li>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'How to Add a SCORM Package',
                'slug'       => 'how-to-add-a-scorm-package',
                'section'    => 'setup',
                'sort_order' => 32,
                'body'       => <<<'HTML'
<p>Step by step. See <a href="/docs/scorm-packages-concept">SCORM Packages — Concept</a> for when a package is the right call.</p>

<ol>
  <li>Export your course from its authoring tool as a <strong>SCORM 1.2</strong> package (a single <code>.zip</code> file). Check the export settings: BLUERABBIT supports 1.2 only, and a package exported to a later SCORM version won't be able to report completion here.</li>
  <li>Open the milestone, add a step, and set its <strong>Step Type</strong> to <strong>SCORM Package</strong> (in the Validate group).</li>
  <li>Choose the <code>.zip</code> and press <strong>Upload</strong>. A file over the most this server accepts is refused before anything is sent, with its size and the limit. During the upload a progress bar shows the transfer, then "Unpacking the package…", so you can tell a large package is still working rather than wondering if the page has stalled. The package is unpacked and checked straight away. Once it's installed, the panel shows a check mark with the package's launch address, and the button becomes <strong>Replace</strong>. If the adventure can build study notes, a draft set is written from the package for the <a href="/docs/library-study-notes-and-glossary">Library</a>.</li>
  <li>Set the step's rewards (XP, BLOO, EP, an item or an achievement) as you would on any other step, then press <strong>Save Step</strong>. Saving the step again later keeps the package as it is.</li>
  <li>Play through the step yourself before players reach it. Packages vary in how reliably they report completion, so one real click-through to the end is worth it. Do it again after every replacement.</li>
</ol>

<h2>If the Upload Is Refused</h2>
<ul>
  <li><strong>"imsmanifest.xml not found in zip"</strong>: the manifest has to sit at the top level of the <code>.zip</code>. If you zipped a folder, zip its contents instead, or re-export straight from the authoring tool.</li>
  <li><strong>"Could not determine the launch file from imsmanifest.xml"</strong>: the manifest doesn't point at a starting page. Re-export the package.</li>
  <li><strong>"File exceeds the … upload limit for your role"</strong>: every package also has a size ceiling, set by your platform administrator for each role (Game Masters and administrators can have different ones); 100MB unless they've changed it.</li>
  <li><strong>"Not enough storage"</strong>: the package would take your account past its storage allowance, and the message says how much room is left. Your storage meter is in the Media Manager and in the Subscription panel of My Account. Free space by deleting files you no longer need, or upgrade (see <a href="/docs/billing-and-plans">Billing &amp; Plans</a>).</li>
</ul>

<h2>Storage</h2>
<p>A package counts toward the storage allowance of the account that uploads it, at the size of the <code>.zip</code> rather than the unpacked size. Replacing a package you uploaded only needs room for the difference, and deleting the step releases its space.</p>

<h2>Good to Know</h2>
<ul>
  <li><strong>One starting point.</strong> BLUERABBIT launches the first item listed in the package's manifest, so a course exported as several separate SCOs plays only the first one, or doesn't install at all. Export it as a single SCO.</li>
  <li><strong>Completed or passed.</strong> The step completes when the package reports either. The score it reports is kept and shown on Manage Content's SCORM tab and in the player's Journal, but it doesn't decide completion.</li>
  <li><strong>Who finished.</strong> The step's row in the milestone builder links to its <strong>Completions</strong>: who started the package and who finished it.</li>
  <li><strong>No learner name.</strong> The package isn't told the player's name, so a course that greets the learner by name will show a blank there.</li>
  <li><strong>"Reset all players' progress"</strong> clears everyone's saved place in the package. It's offered to platform administrators only, asks you to confirm, and can't be undone.</li>
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
                'sort_order' => 33,
                'body'       => <<<'HTML'
<h2>The Wall</h2>
<p>The <strong>Wall</strong> is your Adventure's shared message board. It's in the menu when the Wall's card is switched on under Sections in Adventure Settings (where you can also rename it and give it a background), and it has four channels:</p>
<ul>
  <li><strong>Public</strong> — everyone enrolled reads and posts here. This is where announcements for the whole cohort belong.</li>
  <li><strong>Guilds</strong> — one tab for every guild channel. It opens a searchable picker; choose a guild and the post button becomes <em>Post to</em> that guild. A player in exactly one guild goes straight into its channel. Players only see guilds they belong to; staff see them all.</li>
  <li><strong>System</strong> — the staff channel, seen only by GMs, NPCs and admins.</li>
  <li><strong>Messages</strong> — private one-to-one conversations. Players can also start one from someone's Garden profile.</li>
</ul>
<p><strong>Watch out for PA Post.</strong> On the Public tab, staff see two buttons: <strong>Post</strong> and <strong>PA Post</strong>. PA Post publishes to System, which players can't see. For anything players need to read, press <strong>Post</strong>.</p>
<p>GMs and admins can remove any post with its trash button, and the feed refreshes by itself while it's open. Every post also counts for a Garden mission that asks players to post on the Wall. Guest players (from a platform's Play now) can read the Wall but not post to it.</p>
<p>The activity logs that used to sit on the Wall have a page of their own; the Wall's <strong>Activity</strong> tab takes you there. See <a href="/docs/activity-logs">Activity Logs</a>.</p>

<h2>What Belongs in an Announcement</h2>
<p>Good candidates: a new Tabi or chapter just opened for everyone, a guild leaderboard shift worth calling out, a reminder that a deadline is approaching, a shout-out to a player's achievement. Anything genuinely relevant to the whole cohort. A one-to-one message belongs in Messages instead.</p>

<h2>Keeping Momentum Between Sessions</h2>
<p>Self-paced Adventures lose momentum fastest in the gap between live sessions or milestones. A short post timed to land a few days after a deadline, or right as a new chapter opens, does more for completion rates than almost any content change: it's a nudge, not a rebuild.</p>
<p>A Wall post waits for players until they next log in. For people who aren't coming back on their own, send an <a href="/docs/email-campaigns-to-players-concept">email campaign</a> as well, or keep an <a href="/docs/automatic-emails-and-audience-rules">automatic email rule</a> that finds whoever has been away for a few days, ready to send with <strong>Run now</strong>.</p>

<h2>A Simple Cadence That Works</h2>
<p>For a multi-week program: one announcement at kickoff, one at the midpoint calling out standings, and one heading into the final stretch. Add ad hoc ones for anything time-sensitive, but a predictable, light cadence beats either silence or noise.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/email-campaigns-to-players-concept">Email Campaigns to Your Players</a></li>
  <li><a href="/docs/automatic-emails-and-audience-rules">Automatic Emails &amp; Audience Rules</a></li>
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
                'sort_order' => 34,
                'body'       => <<<'HTML'
<p><strong>Not to be confused with:</strong> this is about emailing people already enrolled in one of your Adventures. It's a separate system from bluerabbit.io's own waitlist emails on the marketing site. Different audience, different tool, so don't mix the two up when someone asks "did the email go out?"</p>

<h2>What a Campaign Is</h2>
<p>A campaign is a one-time email to some or all of the people enrolled in an Adventure, written once and personalised for each recipient with merge tags. You write and send it from <strong>Email Notifications</strong> in the Game Master menu (Admin Tools in the Classic view), on its <strong>Compose</strong> tab. The page also has an <strong>Automatic</strong> tab for <a href="/docs/automatic-emails-and-audience-rules">rules that send by themselves</a> and a <strong>Send Log</strong>. Email has to be set up for the platform first; until it is, the page says so, though a Dry Run still works.</p>

<h2>Who Receives It</h2>
<p>Choose one of three audiences under <strong>Recipients</strong>:</p>
<ul>
  <li><strong>All enrolled players</strong>: everyone enrolled in the Adventure who has an email address.</li>
  <li><strong>Selected players only</strong>: picked by hand from a searchable grid of avatar cards, or in bulk with <strong>Select from a CSV</strong>: upload a file with email addresses in its first column and everyone in this Adventure it names is selected (it tells you who it couldn't find).</li>
  <li><strong>Players matching rules</strong>: a guild, a profile field, an achievement, an item, a milestone, progress and more, the same rules automatic emails use. Who gets it is worked out when you press Send, and the count shows before you do. <strong>Use as a selection</strong> turns today's matches into a list you can adjust by hand.</li>
</ul>
<p>Email Notifications works from inside a cohort too, and lists that cohort's own players: its campaigns, send log and CSV exports are entirely its own. You don't need to go through the template to reach a cohort's roster.</p>
<p>Want a reusable email that finds the right players and writes itself, ready to send with one press of <strong>Run now</strong>? See <a href="/docs/automatic-emails-and-audience-rules">Automatic Emails &amp; Audience Rules</a>. Need to chase the players who still owe you work on one milestone? The review pages have their own <a href="/docs/reviewing-and-grading-submissions-in-bulk">Remind players</a>.</p>

<h2>Merge Tags</h2>
<p>Click a tag to put it where the cursor is, in the message or the subject, or type it directly:</p>
<ul>
  <li><strong>Player</strong>: <code>{{name}}</code>, <code>{{first_name}}</code>, <code>{{last_name}}</code>, <code>{{email}}</code></li>
  <li><strong>Progress</strong>: <code>{{level}}</code>, <code>{{xp}}</code>, <code>{{bloo}}</code>, <code>{{ep}}</code>, <code>{{completion}}</code>, <code>{{rank}}</code>, <code>{{latest_achievement}}</code>, <code>{{expected_level}}</code>, <code>{{expected_completion}}</code></li>
  <li><strong>Guild</strong>: <code>{{guild_name}}</code>, <code>{{members}}</code>, <code>{{guild_completion}}</code></li>
  <li><strong>Adventure</strong>: <code>{{adventure_title}}</code>, <code>{{adventure_url}}</code> (the link back to the Adventure's map), <code>{{assistant_name}}</code> (your Cooper's name), <code>{{start_date}}</code>, <code>{{end_date}}</code>, <code>{{today}}</code>, <code>{{site_name}}</code></li>
</ul>
<p>The XP, BLOO and EP tags carry your Adventure's own names for them. Write <code>{{tag | fallback text}}</code> to show something else when a value is blank, which is handy for a player who hasn't earned an achievement yet. Misspell a tag and BLUERABBIT tells you before the campaign sends, rather than mailing it out broken. Preview and "View the email" always show a real player's numbers, so you see exactly what a recipient will get. These tags are separate from the <code>{{ player.nickname }}</code>-style tokens used in step content; see <a href="/docs/personalising-text-with-player-tokens">Personalising Text with Player Tokens</a>.</p>

<h2>How It Looks</h2>
<p>Every email from the Adventure uses its <strong>email design</strong> (Adventure Settings → Emails): the colours of the header, message and footer, and what's around the email. Anything you leave unset uses the platform design. <strong>On behalf of</strong> chooses who the campaign appears to come from: the <strong>Adventure owner</strong> or <strong>Me</strong>. Their name goes on the email and replies go to their address.</p>

<h2>Delivery You Can Trust</h2>
<p>Pressing Send opens a live console that prints every address as it goes out, ten at a time. What's still pending is worked out from what has actually been sent, so nothing is lost if the tab closes or the connection drops: you can close the tab and come back, and BLUERABBIT picks up exactly where it stopped, so nobody is ever emailed twice. The campaign also waits in the Send Log with a <strong>Resume Sending</strong> button. If another window is already sending it, the console waits for that one instead of doubling up.</p>
<p><strong>Dry Run</strong> runs the whole send, line by line, without delivering a single email, so you can check your recipient list and content first.</p>
<p>A message that fails on a temporary error is retried automatically. Anything that still fails can go again with <strong>Retry failed</strong>, which never re-sends to people who already got it. The <strong>Send Log</strong> lists every campaign with Target / Sent / Failed / Missing counts, tabs to see exactly who's in each group with the reason for each failure, a CSV export per tab, and "View the email" for any recipient.</p>

<h2>Good Use Cases</h2>
<ul>
  <li>Nudging players who've gone quiet: match them by progress, or pick them from the grid. The Last Login column on the Players page tells you who they are.</li>
  <li>Announcing a new Tabi or chapter that just opened.</li>
  <li>A deadline reminder a few days before a milestone closes.</li>
  <li>A wrap-up or congratulations message at the end of the Adventure.</li>
</ul>

<h2>Who Can Send</h2>
<p>GMs and admins. An NPC sees the page view-only: the campaign history and send log, but no Compose.</p>

<p><strong>Where to go next:</strong> <a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a></li>
  <li><a href="/docs/automatic-emails-and-audience-rules">Automatic Emails &amp; Audience Rules</a></li>
  <li><a href="/docs/personalising-text-with-player-tokens">Personalising Text with Player Tokens</a></li>
  <li><a href="/docs/announcements-keeping-an-adventure-alive">Announcements — Keeping an Adventure Alive</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'How to Send an Email Campaign',
                'slug'       => 'how-to-send-an-email-campaign',
                'section'    => 'setup',
                'sort_order' => 35,
                'body'       => <<<'HTML'
<ol>
  <li>Open <strong>Email Notifications</strong> in the Game Master menu (Admin Tools in the Classic view) and stay on <strong>Compose</strong>. The header shows how many eligible recipients the Adventure has.</li>
  <li>Choose who it's sent <strong>on behalf of</strong>: the Adventure owner, or you. Their name goes on the email and replies go to their address.</li>
  <li>Write a <strong>Subject</strong> and your <strong>Message</strong>. Personalise either with the merge tags: click one to put it where the cursor is.</li>
  <li>Choose <strong>Recipients</strong>: <em>All enrolled players</em>, <em>Selected players only</em>, or <em>Players matching rules</em>. For a selection, search by name or email and click cards to select them; <strong>Select all shown</strong> and <strong>Clear</strong> help with large groups, your selection holds as you page through, and <strong>Select from a CSV</strong> picks everyone whose address is in a file. For rules, add them and check the count of who matches right now.</li>
  <li>Press <strong>Preview</strong>. The email opens in a new tab in the Adventure's email design, filled in with a real player's details. There's no test send, so this is your one real look before it goes out.</li>
  <li>Not sure yet? Press <strong>Dry Run</strong> first: it runs the whole send without emailing anyone, so you can double-check the recipient list and content.</li>
  <li>Press <strong>Send email</strong> and confirm. Keep the tab open while the live console runs; it prints each address as it's processed, sent or failed. Leaving asks first, and stops the send until you resume it.</li>
  <li>If the tab closed or the connection dropped, open the <strong>Send Log</strong> and press <strong>Resume Sending</strong>. If anything failed, the Send Log lists each one with the reason, and <strong>Retry failed</strong> sends them again.</li>
</ol>
<p>In Launch Week, two campaigns go out: a kickoff welcome the Sunday before Monday's start, and a Week Two nudge on Wednesday of Week One, sent to the players who haven't made their Path choice yet (a rule on the Path achievement finds them).</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/email-campaigns-to-players-concept">Email Campaigns to Your Players</a></li>
  <li><a href="/docs/automatic-emails-and-audience-rules">Automatic Emails &amp; Audience Rules</a></li>
  <li><a href="/docs/personalising-text-with-player-tokens">Personalising Text with Player Tokens</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Automatic Emails & Audience Rules',
                'slug'       => 'automatic-emails-and-audience-rules',
                'section'    => 'setup',
                'sort_order' => 36,
                'body'       => <<<'HTML'
<p>Beyond one-off campaigns, you can set up <strong>rules</strong> that find the right players and write their email for you: "remind anyone who hasn't logged in for 5 days," "congratulate anyone who just earned the Pilot achievement," "nudge anyone falling behind pace." They're on the <strong>Automatic</strong> tab of Email Notifications. A rule lives on your Adventure's template, so every cohort you run from it uses the same rule for its own players; the tab's <strong>Where the rules run</strong> lists those cohorts.</p>

<h2>Who a Rule Matches</h2>
<p>Pick from guild membership, a profile field, an achievement or path, an item held, a milestone completed, level, XP, how much of the journey is completed, the last visit, the pace schedule, or how a player compares with their guild. Each condition can be negated ("is not"), and you combine several with "every rule below" or "any rule below". Each condition shows how many players it alone lets through, and the rule shows how many match right now. Staff are left out unless you tick <strong>Include GMs and NPCs</strong>. Who matches is worked out again every day, so people come and go from the list as they progress.</p>
<p>The same rules are also a one-off audience: on Compose, choose <strong>Players matching rules</strong>.</p>

<h2>The Pace Schedule</h2>
<p>Set simple checkpoints like "by the end of week 2, players should be at level 5 and 40% done." Weeks count from the Adventure's start date, and nobody counts as behind until that week has actually passed. The schedule belongs to the template.</p>

<h2>When It Sends: Run Now</h2>
<p><strong>Today, a rule sends when you press Run now.</strong> Sending on a daily schedule isn't switched on for the hosted platform yet, so a rule never goes out on its own: open the Automatic tab when you want it, press <strong>Who gets it today</strong> to see the list, then <strong>Run now</strong>. The email is made for today's matches and sent from your browser, line by line, like any campaign. A rule runs only once a day for each cohort.</p>
<p>Each rule also keeps the settings it will use once scheduled sending is on: the hour it is <strong>checked daily from</strong> (in the Adventure's time zone), <strong>at most once every</strong> N days per player (0 means each player gets it only once, ever), and an optional <strong>First day</strong> and <strong>Last day</strong>. The "once every N days" limit already applies when you run a rule by hand, and a player who matches several rules on the same day gets only <strong>one automatic email</strong>, so nobody's inbox gets flooded.</p>

<h2>Sends Straight Away, or Asks First</h2>
<p>You choose per rule. When you run a rule that <strong>asks first</strong>, it builds today's list and waits under <strong>Waiting for approval</strong>, showing who is on it and the email itself. <strong>Approve &amp; send</strong> sends it; <strong>Turn down</strong> sends nothing. A rule set to <strong>Send by itself</strong> sends as soon as you run it. A new rule always starts in ask-first mode; switch it once you trust what it sends. Each rule can be switched off without deleting it, and deleting one keeps everything it already sent in the Send Log.</p>
<p><strong>What ran here</strong> lists, day by day, what each rule matched, how many were on the list and what happened.</p>

<h2>Players Can Turn These Off</h2>
<p>Every automatic email ends with a link to stop automatic emails, and players can also switch automatic emails on or off per Adventure from <strong>My Account → Emails</strong>. Manage Players marks anyone who has: <em>Stopped automatic emails</em>. This never affects a campaign you send by hand.</p>

<h2>Merge Tags for Rules</h2>
<p><code>{{expected_level}}</code> and <code>{{expected_completion}}</code> (from the pace schedule) and <code>{{guild_completion}}</code> (the player's guildmates' average progress) are especially useful here, alongside the usual set. See <a href="/docs/email-campaigns-to-players-concept">Email Campaigns to Your Players</a> for the full list.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/email-campaigns-to-players-concept">Email Campaigns to Your Players</a></li>
  <li><a href="/docs/how-to-send-an-email-campaign">How to Send an Email Campaign</a></li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a>: the player's opt-out</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Personalising Text with Player Tokens',
                'slug'       => 'personalising-text-with-player-tokens',
                'section'    => 'setup',
                'sort_order' => 37,
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
<p>You don't have to remember the names. Every rich-text editor (the text box with a formatting toolbar) has an <strong>Insert player data</strong> button, the last one in the toolbar. It opens a menu grouped into:</p>
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
<p>Task instructions and Mission text don't expand tokens. Email campaigns use their own merge tags instead. See <a href="/docs/email-campaigns-to-players-concept">Email Campaigns to Your Players</a>.</p>

<h2>Worked Examples</h2>
<ul>
  <li><code>Welcome back, {{ player.nickname | Explorer }}.</code></li>
  <li><code>You're level {{ progress.level }} with {{ progress.tnl }} XP to the next one.</code></li>
  <li><code>{{ guild.name | Your guild }} has {{ guild.members }} members.</code></li>
  <li><code>You've finished {{ progress.completed }} of {{ progress.total }} milestones ({{ progress.percent }}%).</code></li>
</ul>

<h2>Content From the Earlier Version of BLUERABBIT</h2>
<p>The older <code>[player_data field="..."]</code> shortcode still works, so content written for the earlier version of BLUERABBIT keeps working and you don't have to rewrite anything. New content should use the <code>{{ }}</code> form, which reaches progress, guild, meta and adventure values the old shortcode never could.</p>

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
                'sort_order' => 38,
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
  <li><strong>Endorsable</strong>: "Peers can award Blooms in it". Switch it off and players can no longer award or gift Blooms in that skill: the drawer leaves it out, and a try is refused in words. Use it to protect a skill that gates something.</li>
  <li><strong>Description</strong>: what the skill actually means. It appears as a tooltip on skill chips in the Garden and on the player's Skills tab in their Journal, so players genuinely read it.</li>
</ul>
<p>The toolbar above the list searches by name, filters to Published or Drafts, and sorts by default order, name, or how many Tasks use each skill.</p>

<h2>Uploading a Catalogue From a Spreadsheet</h2>
<p>Beside <strong>New Skill</strong> there's a CSV upload for adding many skills at once. <strong>Download the template</strong> gives you the columns in order (name, description, icon, colour, image, max level, endorsable, status) with an example row to replace. A blank cell takes the editor's default (blue, a max level of 40, endorsable, published), an icon must be one the picker offers and a colour a name like <code>teal</code> or a code like <code>#1c8ca6</code>, and each refused row is listed with the reason. Every row is added as a new skill, so upload a catalogue once, then edit it here. See <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>.</p>

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
                'sort_order' => 39,
                'body'       => <<<'HTML'
<p>Once your <a href="/docs/setting-up-your-skills-catalog">skills catalogue</a> exists, the Garden largely runs itself: players endorse, gift, ask for help, answer each other and connect. This page covers the levers you hold.</p>
<p>The Garden and Tasks are each a section you switch on per adventure, with their cards under <strong>Sections</strong> in Adventure Settings. See <a href="/docs/complete-adventure-settings-reference">the settings reference</a>. Everything here is authored by GMs and admins. NPCs can see it but not change it.</p>

<h2>The Garden's Switches</h2>
<p>Open the <strong>Garden</strong> card under Sections to decide what players can do in it. Each tool has its own switch, all on by default, and each is enforced by the server, not just hidden:</p>
<ul>
  <li><strong>People around each player</strong>: the most other players one Garden shows, 168 by default (seven full rings). Friends and the people a player deals with most come first, then the most recently active. Raise it for a big cohort that wants to see everyone; lower it to keep a crowded Garden readable.</li>
  <li><strong>Messages and connections</strong>: players can message each other and send connection requests, in the Garden and on the journey.</li>
  <li><strong>Ask for help</strong>: players can post a help request and answer each other's.</li>
  <li><strong>Use skills on each other</strong>: players can award Blooms in a skill and gift Blooms to someone else. Skills earned from milestones and tasks aren't affected.</li>
  <li><strong>Missions</strong>: the Missions panel and page.</li>
  <li><strong>The Business pane</strong> (<strong>Enterprise only</strong>, off by default): coins, energy, and the crises and opportunities still ahead, for Adventures built around <a href="/docs/random-encounters">random encounters</a>.</li>
</ul>
<p>Switching a tool off removes its panels, buttons and journey widgets. Guest players (from a platform's Play now) never get the tools that reach another person, whatever the switches say.</p>

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
<p>Many Tasks at once? The Tasks tab takes a CSV upload, with a template to download: one row per Task, its columns the drawer's fields in order. Condition Tasks are set in the drawer, not by file. See <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>.</p>

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
  <li><strong>Get one of your requests solved</strong>: counts for the player who asked, when a reply to their request is approved as the one that solved it.</li>
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
  <li>For anything added to the template later, open the cohort's Game Master menu (Admin Tools in the Classic view) and choose <strong>Missions &amp; Tasks</strong>. It lists the template's Missions and Tasks, each marked <em>Here</em> or <em>Not copied yet</em>, with a <strong>Copy the N missing</strong> button for each kind. It copies only what's missing, matched by title, and doesn't update ones the cohort already has. If a copied Task has lost its milestone trigger, the page marks it <em>Trigger missing</em> and offers <strong>Restore the triggers</strong>.</li>
  <li>Guild and named-player audiences don't carry into a cohort, because its guilds and players are its own. Achievement and branch audiences do. A Mission left with no audience arrives as a <strong>Draft</strong>, so it never turns into a Global one by accident. Set its audience and publish it.</li>
</ul>
<p>See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Cohorts</a>.</p>

<h2>Awarding Blooms to a Group</h2>
<p>From the Missions tab, press <strong>Award Blooms directly</strong> (or choose <strong>Award Blooms</strong> in the Game Master menu) to open the <strong>Award Blooms</strong> page:</p>
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
                'sort_order' => 40,
                'body'       => <<<'HTML'
<h2>What Needs Grading, and What Doesn't</h2>
<p>Most Step types need nothing from you. Content steps complete on their own, answer-checked steps mark themselves against the answers you set, and survey-style steps collect responses with no right or wrong. Challenges grade themselves too. A Game Master's actual review time goes on <strong>Open Text</strong> steps and the written submissions they produce.</p>

<h2>How a Grade Decides Rewards</h2>
<p>Three settings decide what grading does:</p>
<ul>
  <li><strong>Validate</strong> on the milestone ("Require validation before awarding"): the milestone's rewards wait until you validate the submission.</li>
  <li><strong>Grade scale</strong>, in Adventure Settings (Rules &amp; scoring → Grading): None, Percentage or GPA (letters). With None you validate or invalidate. With a scale you also give a grade.</li>
  <li><strong>When players get rewards</strong>, on the same panel: Before Grading or After Grading. After Grading holds a milestone's rewards until it has a grade above zero, then pays its BLOO in proportion to the grade: a 75 pays 75% of the BLOO.</li>
</ul>
<p>The same panel decides how a finished milestone nothing marked counts toward a player's average: as full marks, or left out so the average is about marked work only.</p>

<h2>Setting the Bar Before They Submit</h2>
<p>An Open Text step can require a minimum word count (<strong>Min Words</strong>), so a one-line answer simply can't be sent. The player is told how many words they need and how many they wrote. You never see the half-effort version, and the player gets the feedback immediately rather than waiting for you to bounce it back. <strong>Rich Text Editor</strong> decides whether they write in a formatted editor or a plain box.</p>

<h2>Turning On AI-Assisted Feedback</h2>
<p>With a Claude API key on the Adventure (see <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading</a>), every Open Text step has three A.I. settings:</p>
<ul>
  <li><strong>A.I. Validation</strong> (Off or On): the instant check. When it's on, the answer goes to Claude when the player submits it. If it falls short, the player sees why and revises before moving on.</li>
  <li><strong>A.I. Strictness</strong>: Lenient (only reject blank or unrelated answers), Standard (a genuine, on-topic attempt passes) or Strict (every part of the prompt must be engaged with).</li>
  <li><strong>A.I. Reviewer Context</strong>: your private rubric. Say what a good answer to <em>this question</em> must include: key ideas, facts, what to reject. Players never see it, and the A.I. is told never to quote it back. The milestone's own context is sent automatically, so write only what's specific to the question. It's optional: without it, the A.I. judges whether the answer is a genuine attempt at the prompt, not whether it's right.</li>
</ul>
<p><strong>One rubric, two readers.</strong> The same strictness and reviewer context drive the player's instant check and your second opinion on the review screen, so what a player is held to and what the reviewer is told can't drift apart. Both are used even when the instant check is off, so you can still ask for a second opinion on a finished submission. On the review screen, when a submission covers several Open Text questions, the strictest one sets the bar.</p>
<p><strong>The check never strands a player.</strong> If it can't run (no key, a rejected key, an unreadable reply) the answer passes. That also means a broken key looks exactly like a pass. Staff who play the milestone see an amber note under their answer saying why the check was skipped, and the skip is written to the <a href="/docs/activity-logs">activity log</a>. Players never see either. Press <strong>Test Key</strong> after saving a key to be sure.</p>

<h2>Your Review Screen</h2>
<p>The <strong>Milestone Review</strong> opens from the milestone's <strong>Review</strong> link on Manage Content → Journey, from a row of the <strong>Validation</strong> queue (see <a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>), or from <strong>Review Milestone</strong> in the milestone builder. <strong>View Milestone</strong> opens the milestone itself, and the way back takes you to the queue you came from. Each submission is a card with the player's name and email, when it was published and last modified, and the full answer as the player wrote it, plus:</p>
<ul>
  <li>A <strong>Grade</strong>, when the Adventure uses a grade scale: a number from 0 to 100, or a letter (or <em>No grade</em>) on a GPA scale. On a milestone with Validate on, a grade above zero also validates the submission.</li>
  <li>On a milestone with Validate on, one button showing the action available: <strong>Validate</strong> or <strong>Invalidate</strong>. Validating keeps any grade already given. With nothing graded yet, it records 100, and invalidating records 0.</li>
  <li><strong>Validate with A.I.</strong>, beside Validate, when the Adventure has a key.</li>
  <li><strong>Comment for the player</strong>, saved with <strong>Save Comment</strong>. See below.</li>
</ul>
<p>For a Challenge, the review screen lists attempts instead: player, status, grade, correct answers and date.</p>
<p>Work through submissions per milestone rather than per player. It's easier to stay consistent when you're comparing several answers to the same prompt back to back.</p>

<h2>A Second Opinion From the A.I.</h2>
<p><strong>Validate with A.I.</strong> sends one submission to Claude with the milestone's context, each question's prompt and your reviewer context, at the step's strictness. The verdict panel says whether it looks like a genuine, complete answer and why. It also shows a suggested grade on your Adventure's scale and a suggested comment for the player. You decide what happens:</p>
<ul>
  <li><strong>Validate with this feedback</strong></li>
  <li><strong>Invalidate with this feedback</strong></li>
  <li><strong>Add the feedback without validating</strong></li>
</ul>
<p>All three are offered whatever the verdict: the A.I. is a second opinion, not the decision. If the player edits their answer after the check, applying the verdict is refused and you're asked to run the check again, so a grade the A.I. never gave can't be written. Every verdict is saved, and a later Validate All reuses it rather than paying for it twice.</p>

<h2>Written Feedback</h2>
<p>Type in <strong>Comment for the player</strong> and press <strong>Save Comment</strong>; the card says <em>Comment Saved</em>. A.I. feedback you accept lands in the same box. The player sees it as "Feedback from your Game Master" when they read back their finished milestone, and in the milestone's details in their Journal. It travels in the review CSV too.</p>

<h2>The Player Hears About It</h2>
<p>A grade, a validation, or work sent back with Invalidate shows up in the player's notification bell, with what the mark paid, so they know to look without you sending a message. On their next page, the player is also shown what your mark paid them.</p>

<h2>Who Can Grade</h2>
<p>GMs and admins. An NPC can open the review screen and read every submission and verdict, but can't grade, validate, comment or run the A.I.</p>

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
                'sort_order' => 41,
                'body'       => <<<'HTML'
<p>For grading at real scale (a full cohort's worth of answers on one milestone) you have more than one card at a time: the <strong>Validation</strong> queue, <strong>Validate All with A.I.</strong>, a CSV round-trip for grading in a spreadsheet, and reminders for the players who still owe you work. The basics of the Milestone Review are in <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>.</p>

<h2>The Validation Queue</h2>
<p>Manage Content's <strong>Validation</strong> tab is your review queue: <strong>Milestones to validate</strong>, every milestone across the whole Adventure that needs a GM's eyes, with how many are pending. Each row counts its <strong>Submitted</strong>, <strong>Pending</strong> (handed in and waiting for you), <strong>Unanswered</strong>, <strong>Graded</strong> and <strong>Validated</strong> players. Search by name, filter to milestones with something pending, and sort in journey order, by name or by most pending. Opened on a template, the queue covers the template and its cohorts.</p>
<p><strong>Review</strong> on a row opens that milestone's list: every player who answered, with their status and grade and <strong>Validate</strong> or <strong>Invalidate</strong> on the row, quick to work through. A grade above 0 validates the answer; a grade of 0 invalidates it. Each status is explained on the page:</p>
<ul>
  <li><strong>Pending</strong>: handed in and waiting for you.</li>
  <li><strong>Invalidated</strong>: sent back, waiting for the player to hand it in again.</li>
  <li><strong>Validated</strong>: the milestone counts for this player.</li>
  <li><strong>Reviewed before</strong>: invalidated or marked 0 earlier, and handed in again. It doesn't count until it's validated.</li>
</ul>
<p>Search by name or email, filter by status, and choose a page size. <strong>Download CSV</strong> and the A.I. Review panel are there too, and <strong>Every answer</strong> (or a row's link) opens the full Milestone Review. Answers from a cohort you don't run are listed so the numbers add up, but you validate them from that cohort.</p>

<h2>Validate All with A.I.</h2>
<p>On a milestone with Validate on, in an Adventure with a Claude key, the Milestone Review and the milestone's Validation list have an <strong>A.I. Review</strong> panel showing how many submissions the A.I. has reviewed so far. <strong>Validate All with A.I.</strong> shows you a plan before anything is spent:</p>
<ul>
  <li><strong>The counts</strong>: submissions, already reviewed, to judge, already judged (free), and nothing written.</li>
  <li><strong>What it will judge against</strong>: the milestone's context, then each question's prompt, strictness and reviewer context. A question with no reviewer context is flagged, because without one the A.I. only judges whether an answer is a genuine attempt, not whether it's right. This is the moment to catch that, not afterwards.</li>
  <li><strong>Validate at or above</strong>: the A.I. grade (70 by default) at which a submission is validated. Below it, the submission is invalidated.</li>
  <li>An option to leave alone any submissions that already have a comment from a human. Untick it and the A.I.'s comment replaces theirs.</li>
  <li><strong>The cost</strong>: an estimate for the submissions it hasn't judged before, either measured on this milestone or estimated from the prompt that will be sent. Ones it has judged before are reused and cost nothing.</li>
</ul>
<p>Press <strong>Review N submission(s)</strong> and a console reports each one as it goes: validated, invalidated, skipped, or left for a human. It ends with a tally and the approximate cost. On the Validation list, each verdict also redraws its player's row.</p>

<h3>Stopping, Resuming, and One Run at a Time</h3>
<ul>
  <li><strong>Cancel stops the work</strong>, not just the window, and everything decided so far is saved. Leaving the page while it runs asks first.</li>
  <li><strong>Resuming is automatic.</strong> Run it again and anything already reviewed is skipped. A verdict that was bought but not applied is reused rather than paid for again. Each verdict is tied to the exact answer it judged, so an answer the player has since edited gets judged afresh.</li>
  <li><strong>One run per milestone.</strong> If another GM is already running one, you're told who. Starting again in a second tab of your own takes the run over.</li>
</ul>

<h3>Nothing Applied on Doubt</h3>
<p>An API error, an unreadable reply, or a submission with nothing written is recorded and left for a human, never quietly validated. A temporary error, such as a rate limit, is retried up to three times. Three failures in a row stop the run. An error that would repeat for every submission, like a rejected key, stops it straight away.</p>

<h3>How the A.I.'s Grade Is Written</h3>
<ul>
  <li><strong>No grade scale</strong>: only the validate or invalidate decision is recorded. The A.I.'s number is never stored as a score, so it can't shrink anyone's BLOO.</li>
  <li><strong>Percentage</strong>: the A.I.'s grade is stored as given.</li>
  <li><strong>GPA (letters)</strong>: the grade drops to the letter breakpoint at or below it, so an 82 records as a B.</li>
</ul>

<h2>The Cohort Summary</h2>
<p>Once the A.I. has judged anything on a milestone, the A.I. Review panel shows how it graded the cohort. It refreshes when a run finishes:</p>
<ul>
  <li>Decided (out of the total), validated, invalidated, the average grade, and <strong>overruled by a human</strong>.</li>
  <li><strong>What it gave them</strong>: a spread across Weak (0–49), Borderline (50–69), Solid (70–84) and Strong (85–100).</li>
  <li>How many couldn't be judged, and how many were judged but not acted on yet.</li>
  <li>The strictness it ran at, the cost so far in dollars and tokens, and when it last ran.</li>
</ul>
<p><strong>Overruled is the number worth watching.</strong> It counts the times a person changed the decision after the A.I. made it. Everything else is the A.I. reporting its own tally back to you. A run that graded sensibly and a run that graded nonsense look the same from its side. If the overruled count keeps climbing, the step's strictness or reviewer context is set wrong, not the submissions.</p>

<h2>The CSV Round-Trip</h2>
<p><strong>Download CSV</strong>, under <strong>Grade &amp; Review CSV</strong> in the Milestone Data panel (and on the milestone's Validation list), exports every submission with the columns <code>player_id</code>, <code>adventure_id</code>, <code>quest_id</code>, <code>player_name</code>, <code>player_email</code>, <code>submitted</code>, <code>grade</code>, <code>validation_status</code> (<em>Valid</em>, <em>Invalid</em> or blank), <code>comment</code> and <code>content</code> (the answer as plain text). <strong>That file is the import template.</strong> Grade and comment in your spreadsheet tool, then choose the file and press <strong>Upload Reviewed CSV</strong>. Only <code>grade</code>, <code>validation_status</code> and <code>comment</code> are read; everything else in the file is ignored.</p>
<ul>
  <li><strong>A blank cell leaves that value alone.</strong> A blank comment never wipes an existing one.</li>
  <li><strong>Untouched rows don't count.</strong> A row where nothing actually changes isn't applied, and the result tells you how many entries were updated and how many rows were skipped.</li>
  <li><strong>grade</strong> takes a number from 0 to 100, or a letter (A, A-, B+, B, B-, C+, C, D, F). It's ignored if the Adventure has no grade scale. On a Validate milestone, a grade above zero validates and a zero invalidates.</li>
  <li><strong>validation_status</strong> validates only on the exact word <code>valid</code> (any capitalisation). Anything else in the cell, <code>invalid</code> or a typo, invalidates. It overrides whatever the grade implied on the same row, and it keeps an existing grade rather than resetting it.</li>
  <li>A row whose <code>quest_id</code> or <code>adventure_id</code> points at a different milestone is skipped rather than applied here.</li>
</ul>
<p>Every cell is written so a spreadsheet never runs a player's text as a formula. Only those who can edit the Adventure can upload a reviewed file.</p>

<h2>Reminding Players Who Still Owe Work</h2>
<p><strong>Remind players</strong>, on the Milestone Review and the milestone's Validation list, emails the players whose work on that milestone isn't validated yet, and nobody else: <em>Waiting for review</em> (handed in), <em>Sent back</em>, or both. Pick the recipients from the list (search, All or None), choose who it's sent <strong>on behalf of</strong> (replies go to that person), and write a subject and message, with merge tags for the player and the milestone's name and link. Cooper can write a first draft for you in the Adventure's voice. <strong>Preview</strong>, <strong>Dry run</strong> and <strong>Send</strong> work as an <a href="/docs/how-to-send-an-email-campaign">email campaign</a> does, and the send appears in Email Notifications' Send Log. The last message is kept for the milestone, so the next reminder starts from it.</p>
<p>Prefer your own mail tool? <strong>Download pending emails</strong> gives the same players' addresses, one per line.</p>

<h2>Other Tools on the Review Screen</h2>
<ul>
  <li><strong>Create Images Zip</strong>, then <strong>Download Zip</strong>: every uploaded image from the milestone's submissions in one archive.</li>
</ul>

<h2>Grading Scale</h2>
<p>The scale comes from <a href="/docs/complete-adventure-settings-reference">Rules &amp; scoring</a> in Adventure Settings: None, Percentage, or GPA (letters). Whichever you choose, it applies across the review screen, the queue, the A.I. and the CSV.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a></li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a></li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a></li>
  <li><a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Setting Up AI Grading & Gift Card Rewards',
                'slug'       => 'setting-up-ai-grading-and-gift-cards',
                'section'    => 'setup',
                'sort_order' => 42,
                'body'       => <<<'HTML'
<p>How the A.I. reads and grades answers is covered in <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>. This page is the settings walkthrough for the two connections on the <strong>Connections</strong> pane of Adventure Settings: a Claude API key for A.I. grading (every plan), and a Tremendous account for real gift cards (<strong>Enterprise only</strong>).</p>

<h2>Connecting Your Claude API Key</h2>
<p>Open Adventure Settings and go to <strong>Connections → Claude API key</strong>. One key powers every A.I. feature in the Adventure: validation on Open Text steps, A.I. grading, and Cooper. It's used server-side only, and usage bills to whoever owns the key.</p>
<ol>
  <li>Go to <code>console.anthropic.com</code> and sign in, or create an account.</li>
  <li>Open Settings → API Keys, click "Create Key", give it a name and copy it. You won't be able to see it again, so copy it right away. It starts with <code>sk-ant-</code>.</li>
  <li>Paste it into the <strong>API key</strong> box. It's saved as soon as you leave the box.</li>
  <li>Press <strong>Test Key</strong>.</li>
</ol>
<p>The key is <strong>stored encrypted</strong>. The page never shows it back: once a key is saved, the box only says so. Leaving the box blank keeps it, pasting a new key replaces the old one, and <strong>Remove Key</strong> deletes it.</p>
<p><strong>Cooper is on every plan</strong>, Basic included, and works whenever a key is set: your Adventure's own key here, or else the platform's key. For teams BLUERABBIT sets up and runs directly, we add the key for you.</p>
<p>Text validation runs on Claude Haiku at well under a cent per check; Cooper costs roughly a cent per player question. For bulk runs, Validate All shows you an estimate before it spends anything and a running total afterwards.</p>

<h2>Test Key</h2>
<p><strong>Test Key</strong> makes one real round trip to Claude, the same way every check does. It reports which key it used (this Adventure's or its template's) and either how quickly Claude answered or exactly what came back instead. Every A.I. check fails open, so a rejected key looks just like every answer passing. That's why testing after you save is worth the click. Each test is written to the activity log.</p>

<h2>Cohorts Use Their Template's Key</h2>
<p>A cohort with no key of its own uses its template's, and its Connections pane says so. Save a key on the template once and every cohort's checks, reviews and Cooper use it. Save a key on a cohort only when you want to override the template's.</p>

<h2>Where the Key Is Used</h2>
<ul>
  <li>The instant check on Open Text steps that have <strong>A.I. Validation</strong> switched on. It runs with or without a reviewer context: the switch alone decides.</li>
  <li><strong>Validate with A.I.</strong> and <strong>Validate All with A.I.</strong> on the Milestone Review and the Validation queue, which only appear once the Adventure has a key.</li>
  <li><strong>Cooper</strong> in this Adventure, and the drafts Cooper writes for you (reminder emails, study notes). An Adventure's key takes priority over the platform's Cooper key, so if Cooper starts failing in an Adventure, test this key first.</li>
</ul>

<h2>Setting Up Gift Card Rewards (Tremendous)</h2>
<p><strong>Enterprise only.</strong> Gift-card rewards through Tremendous aren't offered on the self-serve platform, on any plan; on an Enterprise platform the <strong>Tremendous gift cards</strong> panel appears under Connections (see <a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a>). It connects a Tremendous.com account, so buying a Gift Card item in the Item Shop sends a real gift card to the player's email:</p>
<ol>
  <li>Paste your Tremendous <strong>API Key</strong>. It's stored encrypted, and leaving it blank on a later save keeps the saved one. <strong>Test Connection</strong> checks it and loads your account's real funding sources.</li>
  <li>Choose the <strong>Mode</strong>: Sandbox (test, no real money moves) or Production (real gift cards). Sandbox and production are separate Tremendous accounts.</li>
  <li>Pick the <strong>Currency</strong>: EUR, USD or GBP.</li>
  <li>Pick the <strong>Funding Source</strong>: which Tremendous account the cards are actually charged to (your balance by default).</li>
  <li>Optionally enter a <strong>Campaign ID</strong>. A campaign decides which brands players can choose from, and you curate it in your Tremendous dashboard. Set one here, or pick products on each gift-card item: Tremendous rejects an order that has neither.</li>
  <li>Add the <strong>Webhook URL</strong> shown on the panel as a webhook in your Tremendous dashboard, and paste the <strong>Webhook Signing Secret</strong> it gives you. Without it, delivery failures and redemptions stay invisible here. Events that arrive without a valid signature are logged but never applied.</li>
</ol>
<p>Once connected, the panel shows your Tremendous balance, and warns you when it's below your largest gift card (purchases are then refused until it's topped up) or when the account is funded in a different currency from the cards.</p>
<p>Unlike the Claude key, the Tremendous connection belongs to each Adventure: a cohort doesn't use its template's. Set it up on every cohort that sells gift cards.</p>

<h2>Choosing Which Card an Item Sends</h2>
<p>A Gift Card item has a <strong>Card Value</strong> (in the Adventure's currency), an optional label, and a <strong>Card Source</strong>:</p>
<ul>
  <li><strong>Adventure default campaign (recommended)</strong>: uses the campaign set under Connections. If there isn't one, the item form warns you that the item can't send anything.</li>
  <li><strong>A different campaign, just for this item</strong>: pick another of your campaigns.</li>
  <li><strong>Specific brands from the catalogue</strong>: search the catalogue by brand, currency and country. Use this only when the item is meant to be one card and nothing else.</li>
</ul>

<h2>Checked Before Any BLOO Is Spent</h2>
<p>A gift-card purchase is checked before anything is charged. If the Adventure isn't connected, the item has no card source, the balance is too low, or the player has no email on file, the purchase is refused with a message saying what's missing. A send that Tremendous rejects spends no BLOO and records no purchase. Each player can redeem a given gift-card item once.</p>

<h2>The Order Log</h2>
<p>Manage Content → Items has a <strong>Gift Card Orders</strong> button. It opens every gift-card order for the Adventure (date, player, item, amount, status, mode and the Tremendous reference) with a search box and filters for All, Sent, Pending, Failed and Duplicate Blocked. A failed order shows Tremendous's own reason, so you can fix the setting that caused it.</p>

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
                'sort_order' => 43,
                'body'       => <<<'HTML'
<p>Stats is where you see how a whole cohort is doing: who's active, where people stall, what they earn, buy and answer, and how long they actually spend. Open it from <strong>Stats</strong> in the Game Master menu (Admin Tools in the Classic view; NPCs find it under Surveillance). GMs, NPCs and admins see the full dashboard. Only players are counted, so staff testing the Adventure don't skew the numbers.</p>

<h2>Finding Your Way Around Stats</h2>
<p>Stats is organized into panes you switch between from a rail down the side: <strong>Overview</strong>, <strong>Engagement</strong>, <strong>Rubric</strong>, <strong>Achievements</strong>, <strong>Encounters</strong>, <strong>Profiles</strong>, <strong>Surveys</strong>, <strong>Item purchases</strong>, <strong>Cooper</strong> and <strong>Players</strong>. Panes for features you haven't turned on don't appear (Rubric needs Graduation Criteria, Encounters needs Energy Points, Profiles needs Profile Tests). A panel that's still fetching its numbers shows a spinner over itself rather than a blank space. <strong>Download PDF</strong>, at the foot of the rail, turns every pane except Players into a clean, print-ready report with a cover page and table of contents; in the print window, choose "Save as PDF".</p>

<h2>Overview</h2>
<p>Five headline figures: <strong>Total Players</strong>, <strong>Active 7d</strong> (enrolled players active in the last 7 days), average XP against the XP available, overall <strong>Completion</strong>, and <strong>Have Logged In</strong>, the share of the roster that has signed in at all.</p>

<h3>Time in App</h3>
<p>How long players really spend, measured from a heartbeat the app sends while a player has an Adventure open. It only counts while the tab is in front, and one late ping can't add more than a short slice, so a laptop left asleep doesn't inflate anything. You get <strong>Avg. Session Length</strong> and <strong>Avg. Total Time / Player</strong>. Until there's data, the panel says it's collecting.</p>
<p>Underneath is a separate, clearly labelled <strong>estimate</strong> for the last 90 days, worked out from the gaps between logged actions. It undercounts reading and idle time, so it's never blended into the real figures. It's there for time before the heartbeat existed.</p>

<h3>Milestone Funnel</h3>
<p>A chart of enrolled players against completions per milestone, eight milestones at a time. It's usually the fastest way to spot a confusing or too-difficult milestone. <strong>Details</strong> opens <strong>Milestone Funnel Details</strong>, its own page: the whole funnel at once, scrollable, and narrowed with the <strong>View</strong> filter to All Milestones, a single Tabi or a single level. It also shows how many are enrolled and what share have logged in and been active in the last 7 days.</p>

<h3>Activity</h3>
<ul>
  <li><strong>XP Distribution</strong>: how XP is spread across the cohort (named after your Adventure's own XP label).</li>
  <li><strong>Daily Active Users</strong>: the last 30 days by default. Set a date range and press Apply, or reset it to the last 30 days.</li>
  <li><strong>Tabi Completion Rate</strong>: how far the cohort is through each chapter.</li>
</ul>

<h2>Engagement</h2>
<ul>
  <li><strong>Engagement Overview</strong>: the cohort's average engagement score out of 100, and how many players are On Fire, Active, Moderate, Cooling Off, Dormant or have Never Logged In.</li>
  <li><strong>Engagement Breakdown</strong>: the average of each part of that score, each explained on the panel: Recency, Frequency (milestones in the last 30 days), Completion, Progression (level against the top level) and Economy (Item Shop activity).</li>
</ul>
<h3>Engagement by Segment</h3>
<p>The <strong>Workforce Engagement</strong> panel splits the cohort by any Player Meta field you've marked for Stats in the Player Meta Manager: department, region, whatever your roster carries. Pick the field under <strong>Break down by</strong> to see each group's size, average engagement score and average completion. It also says what share of players have data for that field. With no field marked yet, the panel says so and links to the Player Meta Manager. See <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a> for setting fields up.</p>
<h3>Profile Leaderboard</h3>
<p>Below it, the same fields rank the groups against each other (department, location, cohort, whatever you set up in Player Meta) rather than a fixed set of categories, with a completion bar under each group's figure, the share of the group that has logged in, and a total row. It opens on whichever field actually has the most groups to compare, so you're not staring at a two-row table.</p>

<h2>The Rubric: Pass/Fail Criteria</h2>
<p>Switch on <strong>Graduation Criteria</strong> (Adventure Settings → Rules &amp; scoring → Grading) to build a rubric: plain-language rules like "70% average across all stages" or "no more than 2 stages below 70%." Each criterion shows as <strong>met</strong>, <strong>at risk</strong>, <strong>out of reach</strong>, or <strong>pending</strong> for every player. Tie criteria to a certificate (a "Graduation" certificate might require two criteria, a "Distinction" certificate three) and players see exactly where they stand in their Journal's Rubric tab, with an "On track for" column on your roster. See <a href="/docs/certificates-authoring">Authoring Certificates</a>.</p>

<h2>Drill-Downs</h2>
<p>Each of these is a searchable, sortable table with a page size. Click a row to open the detail:</p>
<ul>
  <li><strong>Achievements</strong>: how many players have each one and what share that is. The detail lists who has it and who doesn't.</li>
  <li><strong>Encounters</strong>: for each random encounter, its kind (Crisis or Opportunity), how many faced it, how many resolved it, and the average cost. The detail, <strong>What they chose</strong>, splits the cohort by option, with how many picked each, what it cost them, and who is still facing it. See <a href="/docs/random-encounters">Random Encounters</a>.</li>
  <li><strong>Profiles</strong>: for each profile, its traits, questions, how many players have a reading, their average answers, and the most common headline. The detail shows the cohort average per trait and what people came out as. See <a href="/docs/profile-tests">Profile Tests</a>.</li>
  <li><strong>Item purchases</strong>: purchases and total currency spent per item. The detail lists each purchase by player, date and amount.</li>
</ul>

<h2>Surveys</h2>
<p>Every answer to every <strong>Survey Choice</strong>, <strong>Poll</strong> and <strong>Rating Scale</strong> step, totalled per question, in journey order. Quiz questions with a right answer aren't here. Each card shows how many picked each option, as a share of the players who answered, or the average on a rating scale. Where players could choose more than one answer, the card says the percentages can add up to more than 100%. <strong>See who answered</strong> lists the players behind each answer, and who hasn't answered yet. Search filters the cards by question, answer or milestone, and <strong>Download CSV</strong> gives one row per player with a column per question. Each cohort sees its own players' answers.</p>
<p>No survey steps yet? The tab says so and tells you which steps to add.</p>

<h2>Cooper</h2>
<p>First, <strong>Cooper Usage</strong> for this Adventure. Then how the in-app assistant is being used across <strong>every Adventure you manage</strong>: questions asked, conversations, players reached (of how many enrolled), questions per conversation and the share of enrolled players who've asked something, with charts of questions per Adventure, the busiest hours and the last 30 days, and a table per Adventure with the last time it was used. It shows counts only, never what anyone asked, and counts players only. If Cooper isn't switched on for an Adventure, it says so rather than showing zeroes.</p>

<h2>Players</h2>
<p>The full roster in one table: search across everyone, choose 30, 60, 120 or 500 per page, and sort every player by XP, BLOO, completion (of the required milestones open now, or of the whole journey) and last active. Click a player to load their personal dashboard in the panel below: the same Overview they see in their own Journal, with their engagement, charts, milestone and Tabi progress, achievements and guild.</p>

<h2>Challenge and SCORM Reports</h2>
<p>Manage Content also has two dedicated reporting tabs, shown whenever your Adventure actually has that kind of content:</p>
<ul>
  <li><strong>Challenges</strong>: every quiz you've built, with attempts, completions, pass rate and average grade at a glance. Open the full report to see every player's best attempt (or drill into any individual attempt), question by question, plus a breakdown by question across all players. Exportable as CSV.</li>
  <li><strong>SCORM</strong>: every package you've uploaded, with how many players started it, finished it, haven't finished it, or completed the milestone it's attached to. Opens a per-player report, including players who never opened the package at all. Also CSV-exportable.</li>
</ul>
<p>Both tabs' summary tiles re-total themselves as you filter or search: type part of a title and the counts update to match just what's showing.</p>

<h2>Where a Grade Comes From</h2>
<p>A milestone's score follows one clear order: a reviewer's manual grade first, then a challenge's best attempt, then the average of its required scored steps, and finally plain completion. You'll always see which of these produced the number on a player's row.</p>

<h2>Where Other Reports Live</h2>
<ul>
  <li><a href="/docs/activity-logs">Activity Logs</a>: the searchable audit table.</li>
  <li><a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a>: every case-study attempt, and who watched which video.</li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>: the Validation queue, and how the A.I. graded a milestone.</li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>: every CSV the app downloads.</li>
</ul>

<h2>Using This to Improve Your Adventure</h2>
<p>The dashboard works best as a feedback loop, not just a report. Find the milestone with the biggest drop-off, revisit its difficulty or clarity, then watch the funnel for the next cohort. Small changes to unlock requirements or step difficulty often move the numbers more than a full content rewrite.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/case-study-and-video-reporting">Case Study &amp; Video Reporting</a></li>
  <li><a href="/docs/activity-logs">Activity Logs</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Case Study & Video Reporting',
                'slug'       => 'case-study-and-video-reporting',
                'section'    => 'setup',
                'sort_order' => 44,
                'body'       => <<<'HTML'
<p>Two step types produce more than a done-or-not-done: interactive case studies and videos. Each has its own report under Manage Content, so you can read what players actually did in a case study and see who really watched a video.</p>

<h2>Case Studies</h2>
<p>A <strong>Case Studies</strong> tab appears in Manage Content once the Adventure has a case-study step. Its <strong>Case Study Steps</strong> table lists every case-study step with its milestone, how many attempts there are, how many players have tried it and how many passed. Search by name, filter to ones that have been attempted or that nobody has tried yet, and sort by name, players or attempts. <strong>Review Entries</strong> opens the step's report.</p>

<h3>Case Study Entries</h3>
<p>The <strong>Case Study Entries</strong> page opens with the step's totals (attempts, players and passes) and keeps every attempt: the passes, the ones that failed, the ones in progress and the ones people walked away from. Each row shows:</p>
<ul>
  <li>The player and their email.</li>
  <li><strong>Attempt</strong>: which attempt this was for them.</li>
  <li><strong>Status</strong>: Pass, Fail, In progress, or Abandoned.</li>
  <li><strong>Score</strong> and <strong>Date</strong>.</li>
</ul>
<p><strong>Best attempt per player</strong> is ticked when the page opens, so you see one row per person (their graded run with the most right answers); untick it to see every attempt. Find a player by name or email, sort by any column, and choose how many to show per page. Click a row to open the attempt question by question: each answer the player gave, marked right or wrong, with free-text notes shown as notes rather than marked.</p>
<p><strong>Regrade all</strong>, for whoever can edit the Adventure, re-scores every attempt from the answers already stored, without the activity having to report anything again. Use it after you've corrected the case study's answers.</p>

<h3>Exporting</h3>
<p><strong>Download CSV</strong> builds the file from the database, not just the page you're looking at, and tells you how many entries it found while it works. The columns are Player ID, Name, Email, Login, Attempt #, Status, Score %, Correct / Total and Date, then one column per answer. Cells are written so a spreadsheet never runs a player's text as a formula.</p>

<h2>Videos</h2>
<p>A <strong>Videos</strong> tab appears once the Adventure has a video step. Its <strong>Video Steps</strong> table lists every published video step with its milestone, how many players watched and the average share watched. Search, filter to ones watched or not yet, and sort. <strong>Review Stats</strong> opens <strong>Video Watch Stats</strong> for that video: its totals (Players Watched, Avg % Watched and Total Watch Time), a search by name or email, a page size, and for each player:</p>
<ul>
  <li><strong>Times Watched</strong>: how many separate times they watched.</li>
  <li><strong>Total Time</strong>: their total watching time.</li>
  <li><strong>% Watched</strong>: as a share of the video's length. It caps at 100%, so someone who rewatched doesn't read as an error.</li>
  <li><strong>Last Watched</strong></li>
</ul>
<p>Every column sorts, and <strong>Download CSV</strong> exports the list. Time is counted only while the video is actually playing and the tab is in front, so it measures watching rather than leaving a video open. It's analytics only: watch time never changes whether a video step counts as done.</p>

<h2>Who Can See and Export</h2>
<p>Game Masters, the Adventure's owner and administrators can open both reports and download their CSVs. Regrading is for those who can edit the Adventure.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/full-step-library-choosing-the-right-step">The Full Step Library</a></li>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Activity Logs',
                'slug'       => 'activity-logs',
                'section'    => 'setup',
                'sort_order' => 45,
                'body'       => <<<'HTML'
<p>Every Adventure keeps an activity log: a running record of what players and staff do inside it. It's the place to answer "did they actually do that?", "who changed this?" and "when did it happen?". It has its own page, <strong>Adventure Activity</strong>, reached from <strong>Activity</strong> in the Game Master menu (Admin Tools in the Classic view) or from the <strong>Activity</strong> tab on the Wall. The Wall is for conversation, so the audit table doesn't sit among its channels.</p>

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
  <li>Your grades, validations, sent-back work and answers to requests also reach the player as a notification in their bell, so they hear about it without checking.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
  <li><a href="/docs/announcements-keeping-an-adventure-alive">Announcements &amp; the Wall</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The Complete Adventure Settings Reference',
                'slug'       => 'complete-adventure-settings-reference',
                'section'    => 'setup',
                'sort_order' => 46,
                'body'       => <<<'HTML'
<p>Adventure Settings is where an Adventure's own configuration lives. Open it from <strong>Adventure Settings</strong> in the Game Master menu (Admin Tools in the Classic view); inside a cohort, <strong>Cohort Settings</strong> opens the cohort's own and <strong>Template Settings</strong> the template's. Its panes are listed in a rail down the left side of the page (on a narrow window they become a row of tabs across the top); one pane shows at a time. <strong>Find a setting</strong>, above the rail, searches every pane and takes you straight to the row.</p>
<p><strong>Changes save as you make them.</strong> On an Adventure that already exists, every switch and field saves the moment it changes, and the bar at the bottom says so (<em>All changes saved</em>, or <em>Not saved</em> and why). <strong>Update Adventure</strong> still saves everything at once, and the same bar carries the <strong>Publication status</strong>: Publish, Draft or Trash (trashing asks first, because players lose access straight away). A new Adventure saves everything when you press <strong>Create Adventure</strong>.</p>
<p>This page walks every pane. Some have their own guides: <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>, <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>, <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a> and <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a>.</p>

<h2>Basics</h2>
<p><strong>Adventure</strong></p>
<ul>
  <li><strong>Adventure Name</strong> and, once the Adventure exists, its <strong>Enrollment Link</strong>.</li>
  <li><strong>Image</strong> and <strong>Highlight Color</strong>.</li>
  <li><strong>Adventure Type</strong> (Normal or Template) and <strong>Owner</strong>, for admins. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</li>
  <li><strong>Privacy</strong> (Public or Invite Only), shown only when the platform allows public Adventures. It doesn't switch off the enrollment link.</li>
  <li><strong>Max Players per Adventure</strong>: an optional seat limit checked when someone joins through the enrollment link (0 or blank means no limit). That one is your own limit for this Adventure, separate from your plan.</li>
</ul>
<p><strong>Dates &amp; time</strong></p>
<ul>
  <li><strong>Start Date</strong> and <strong>End Date</strong>: when the Adventure runs. Cooper, reports and certificates read them.</li>
  <li><strong>Time zone</strong>: the Adventure's own clock, with its current time shown so you can check you picked the right one. Deadlines, the schedule and dates players see follow it.</li>
  <li><strong>Hide milestones outside the dates</strong>: Never, Before Start Date, After Deadline, or Before and After.</li>
</ul>
<p>A cohort's Basics pane starts with <strong>From the template</strong>, which says what the cohort takes from its template (the journey, the sections and their names, the ranks, the menu and the backgrounds) and links to the template's settings.</p>

<h2>Sections</h2>
<p>One card per section of the Adventure: Achievements, Challenges, Leaderboard, Item Shop, Backpack, Guilds, The Garden, Tasks, Wall, Posts, Resources, Schedule, Speakers, Profile Tests and Magic Codes (Enterprise platforms add the Lottery; see <a href="/docs/prize-draws">Prize Draws</a>). The switch on the card puts the section in the menu or takes it out; open the card to set everything else about that section in one place:</p>
<ul>
  <li><strong>Name</strong>: what players see in the menu and on the page heading. Blank keeps the platform's name.</li>
  <li><strong>Achievements</strong>: Hide Achievements (keep them hidden on the badges page until earned).</li>
  <li><strong>Leaderboard</strong>: how many players it shows (blank means 10), and what players see on it: an explanation of how players are ranked, the level, XP, milestones, BLOO earned and BLOO left columns, each player's own place pinned under the board, and the guild leaderboard. Game Masters always see everything. Fields from Player Meta you mark <em>Show on the leaderboard</em> become extra columns.</li>
  <li><strong>Item Shop</strong>: Purchase Permissions (set <em>Only Players</em> to take the Buy button away from staff) and <strong>Show players their transactions</strong> (a Transactions tab on the shop, backpack and Tabis pages).</li>
  <li><strong>Guilds</strong>: <strong>Assign guilds on login</strong>, which puts each player into a random guild the first time they log in.</li>
  <li><strong>The Garden</strong>: how many people each player's Garden shows, and a switch for each of its tools. See <a href="/docs/running-the-garden-as-a-gm">Running the Garden as a GM</a>.</li>
  <li><strong>Resources</strong>: whether players can download the slide decks of the milestones they have open or done.</li>
  <li><strong>Schedule</strong>: Days shown, every day or just today.</li>
  <li>The section's own background image, where it has one.</li>
</ul>
<p>The currency names, Energy and the rubric live under Rules &amp; scoring; a section's name set here overrides the platform name for this Adventure only.</p>

<h2>Rules &amp; Scoring</h2>
<p><strong>Grading</strong></p>
<ul>
  <li><strong>Grade scale</strong>: None, Percentage, or GPA (letters).</li>
  <li><strong>When players get rewards</strong>: Before Grading (as soon as they submit) or After Grading (only once you've marked it). Needs a grade scale. After Grading stops players collecting a reward by submitting anything at all.</li>
  <li><strong>Grades: finished but unmarked milestones</strong>: count a finished milestone nothing marked as full marks (100%), or leave it out so the average is about marked work only.</li>
  <li><strong>Graduation Criteria</strong>: switch on the rubric. See <a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a>.</li>
</ul>
<p><strong>Points &amp; currencies</strong>: the <strong>Energy Points (EP)</strong> switch (the whole energy economy: EP rewards, the energy bar and random encounters), then a long and a short name for experience points, the currency and energy. Short names appear next to numbers, long names in sentences. See <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>.</p>
<p><strong>Ranks</strong>: the rank ladder, a table of levels each tied to an achievement. When a player reaches the level they're given that achievement as their title. <strong>Title before the first rank</strong> is what players are called until then. Add rows with <strong>Add Rank</strong>; with no rank achievements yet, <strong>Create the first rank</strong> starts one. See <a href="/docs/achievements-paths-and-ranks-reward-ladder">Achievements, Paths &amp; Ranks</a>.</p>
<p><strong>What players can see</strong>: <strong>Hide Certificates</strong> (hidden on the Achievements page until unlocked; off shows them dimmed, with what's still missing).</p>
<p><strong>This app's extras</strong>: a switch that is on for every Adventure you create, and should stay on. It exists for Adventures moved over from the earlier version of BLUERABBIT, which start with it off so their players see exactly what they saw before. <em>What the switch covers</em> lists everything it governs: milestone attempts, "Read it again", the Wall's extra tabs, My Work's Rubric tab, notifications, the extra Manage Content tabs and much more.</p>

<h2>Journey &amp; Look</h2>
<ul>
  <li><strong>Journey</strong>: the <strong>Zoom Level</strong> the map starts at, from 10% to 140%.</li>
  <li><strong>Names</strong>: rename the Journey, the Journal, the Tabis and Secrets and Clues for this Adventure. Blank keeps the platform's name. Every other section is renamed in its own card under Sections.</li>
  <li><strong>Backgrounds</strong>: the Default Background, the Journey Background and the My Work Background. The other sections' backgrounds are in their cards. Any you don't set fall back to the platform's.</li>
</ul>
<p><strong>Map or List?</strong> A player's first visit opens whichever view the platform's <strong>Default Journey View</strong> names; after that, each player's own last choice sticks.</p>

<h2>Menu</h2>
<ul>
  <li><strong>Menu style</strong>: <strong>Players start with the classic menu</strong>. On: the top bar, the taskbar along the bottom and its menu. Off: the pause-screen menu, opened by the yellow Options button in the top corner. It's only a starting point: each player can pick their own in My Account, and their choice wins.</li>
  <li><strong>Options button</strong>: <strong>Highlight the Options button</strong> makes it pulse so players notice it on a busy map: off, until the player first opens the menu, or always.</li>
  <li><strong>Corner buttons</strong>: Cooper's button in the top corner, and its row in the menu's Help.</li>
  <li><strong>Taskbar shortcuts (classic menu)</strong>: Journey, Magic Code and Item Shop buttons above OPTIONS.</li>
  <li><strong>Custom Links</strong>: up to three buttons of your own.</li>
</ul>
<p>See <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a>.</p>

<h2>Help &amp; Cooper</h2>
<p><strong>Cooper</strong>: the switch for Cooper, the A.I. guide players can ask about this Adventure. Cooper is on every plan. It runs on a Claude API key: the Adventure's own (Connections, below), or else the platform's, so it works whenever a key is set.</p>
<p><strong>Cooper Context</strong> is the Adventure's knowledge base for Cooper. <strong>Players never see it.</strong> Use it for everything Cooper can't work out from the Adventure itself: what the program is for, who the players are, house rules, dates, who to contact, and the words your organization actually uses. Cooper reads it on every conversation and treats it as authoritative. Write for the assistant, not for the player, and don't put answers, codes or solutions here. Cooper reads the first 100,000 characters.</p>
<p><strong>Cooper's Character</strong> gives the assistant a different name, face and voice for this Adventure:</p>
<ul>
  <li><strong>Name</strong> (up to 40 characters): shown in the chat and on its button.</li>
  <li><strong>Picture</strong>: shown at the top of the chat; square works best.</li>
  <li><strong>Button icon</strong>: for its button. Blank uses the picture.</li>
  <li><strong>Greeting</strong> (up to 500 characters): the first thing it says.</li>
  <li><strong>Personality</strong> (up to 2,000 characters): how the character talks. It changes the voice, never the rules: the assistant still won't give answers away.</li>
</ul>
<p>Anything you leave blank uses the platform default from Sys Config. A cohort uses its template's character unless it sets its own.</p>
<p><strong>What Cooper knows</strong>: <strong>Open world</strong>, off by default. Off, Cooper answers only from this Adventure's own material (its milestones, case studies, study notes and your context) and says so when something isn't covered. On, it may also explain ideas with general knowledge, and says when it does.</p>
<p><strong>Support</strong>: <strong>Custom Support Email</strong>, where the Email Support button sends players. Blank uses the platform's default support address.</p>
<p><strong>Guided tours</strong>: every page has a short tour, always a click away on the help button. <strong>Start tours automatically</strong> (off by default) opens a page's tour by itself the first time a player visits it.</p>
<p><strong>Analytics</strong>: a <strong>Google Analytics property</strong> for this Adventure's pages. Blank reports to the platform's property.</p>
<p><strong>Feedback form</strong>: the switch for the form players use to message the team, and its wording. See <a href="/docs/managing-player-support-requests">Managing Player Support Requests</a>.</p>

<h2>Emails</h2>
<p><strong>Email design</strong>: how every email from this Adventure looks (reminders and the messages you send): the text, header, message and footer colours, and what's around the email. Anything left unset uses the platform design. <strong>Preview</strong> shows the real email, drawn the way it's sent. A cohort's emails use its template's design.</p>

<h2>Connections</h2>
<p><strong>Claude API key</strong>: one key powers every A.I. feature in this Adventure: validation on Open Text steps, A.I. grading, and Cooper. Paste it and it's saved as soon as you leave the box; it's stored encrypted and never shown back. <strong>Test Key</strong> makes one real call and reports whose key answered, and <strong>Remove Key</strong> clears it. A cohort with no key of its own uses its template's. See <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a>.</p>
<p><strong>Tremendous gift cards</strong> (Enterprise only): connects a Tremendous account so Gift Card items send real gift cards.</p>

<h2>Players</h2>
<p>How many Players, Game Masters and NPCs the Adventure has, and <strong>Open Manage Players</strong>. Adding, importing and removing players, and making someone a Game Master or NPC, all happen on Manage Players. See <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>.</p>

<h2>Danger Zone</h2>
<p><strong>Resets</strong> apply to every player in the Adventure at once, and none can be undone. Each asks for a second click.</p>
<ul>
  <li><strong>Replay level-up messages</strong>: every player sees the level-up message for the level they're on again.</li>
  <li><strong>Empty every guild</strong>: everyone leaves their guild; the guilds stay, empty. With Assign guilds on login on, each player is put into a new random guild the next time they log in.</li>
  <li><strong>Replay the journey tour</strong>, offered when tours start automatically: every player is shown the journey tour again.</li>
</ul>

<h2>Cohorts</h2>
<p>A cohort's settings show only what the cohort reads from itself: Basics, Rules &amp; scoring (grading and the currency names), Help &amp; Cooper, Connections, Players and the Danger zone. Sections, the journey's look, the menu and the email design are its template's, so set them there.</p>

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
                'sort_order' => 47,
                'body'       => <<<'HTML'
<p>Companion to <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>. This covers the day-to-day tools for a roster once people are in. They live on a few screens in the Game Master menu (Admin Tools in the Classic view).</p>

<h2>Manage Players</h2>
<p><strong>Manage Players</strong> is the working list of the Adventure's people, in three tabs:</p>
<ul>
  <li><strong>Active</strong>: everyone enrolled, Game Masters and NPCs included, searchable by name, nickname, email or ID, filterable by role (Players, GMs, NPCs), with a choice of how many per page.</li>
  <li><strong>Inactive</strong>: people you've removed. Their progress is kept and comes back if you press <strong>Activate</strong>.</li>
  <li><strong>Add Players</strong>: the CSV import (with a <strong>Download CSV Template</strong> built for this Adventure and a guide to every column) and <strong>Add Players One by One</strong>. See <a href="/docs/enrolling-players-and-roles">Enrolling Players</a> and <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>.</li>
</ul>
<p>Every row has <strong>Journal</strong>, which opens that player's Journal in a new tab, and <strong>Records</strong>, which opens their entries in Player Records (below). Where the platform lets Game Masters reset passwords, a <strong>Password</strong> button sets a new one. A player who has asked not to get automatic emails from this Adventure is marked <em>Stopped automatic emails</em>; emails you write by hand still reach them. The header links to Player Records for the whole Adventure. NPCs see this page view-only.</p>

<h2>Removing a Player</h2>
<p>Press <strong>Remove</strong> and the button changes to <em>Remove?</em>. Press it again to confirm; nothing happens on the first click. The player moves straight to Inactive. <strong>Activate</strong> uses the same two-click confirm.</p>

<h2>Changing Roles</h2>
<p>Roles are switched on Manage Players, from each person's row: <em>Make GM?</em> and <em>Make NPC?</em> ask for a second click like Remove. The GM option only works when your platform allows more than one Game Master per Adventure. The protections:</p>
<ul>
  <li>The owner's role can't be changed, and the owner can't be removed.</li>
  <li>A Game Master can't be removed: make them a Player first.</li>
  <li>A platform administrator can't be removed from an Adventure.</li>
</ul>
<p>An NPC sees everything a Game Master sees and plays like anyone else, but can't change anything.</p>

<h2>Recalculate All Players</h2>
<p>If scores look stale after a bulk action, <strong>Recalculate all players</strong> (on Manage Players) works out every player's XP, BLOO and level again from their work, marks, achievements and purchases, in small batches. Keep the tab open while it runs. A live console names each player whose level or XP changed, then sums up: how many scores went up or down, who levelled up or dropped a level, any achievements that had been earned but not granted yet, and any player it couldn't process and why. Run it again to retry those. It only ever touches players, never staff.</p>

<h2>The Players Spreadsheet</h2>
<p><strong>Players</strong> shows the whole roster as one wide table across the full screen: name (which opens the Journal), player type (their latest profile reading), level, XP, BLOO, GPA (when the Adventure grades), last login, your Player Meta fields, a column for each milestone and challenge, with their titles running up the columns, and a column for each achievement. A legend above it shows the Tabis in column order with their colours, and the achievements by kind.</p>
<ul>
  <li><strong>Grades in place.</strong> Every challenge and every milestone that needs validation has a Grade column. Work handed in but not marked reads <em>Pending</em>; type a grade (or pick a letter) right there.</li>
  <li><strong>Refresh</strong> recalculates one player, for administrators.</li>
  <li>It lists players only until you press <strong>Show GMs &amp; NPCs</strong>.</li>
  <li><strong>Export CSV</strong> downloads it, with email addresses included even though they aren't shown on screen.</li>
</ul>

<h2>Player Meta: Your Own Profile Fields</h2>
<p>Player Meta is a catalogue of fields <em>you</em> define for this Adventure: department, region, job title, grade, homeroom, whatever your program needs. Nothing is fixed, and another Adventure's fields never appear in yours. Manage it in the <strong>Player Meta Manager</strong>. Its header counts the players, the live fields and how much is filled in, and it has three tabs:</p>
<ul>
  <li><strong>Players</strong>: search the whole roster by name or email. The first four live fields are the columns, with a meter showing how complete each profile is. Open a player to see and change everything recorded about them.</li>
  <li><strong>Fields</strong>: <strong>Add field</strong> gives a field a label and a type: Text, Choice list or Number (for a choice list, one option per line). Each field shows how many people have it filled in and where it's shown. Drag a field by its handle to reorder: the first four live fields are the Players columns.</li>
  <li><strong>Import CSV</strong>: fill in many profiles at once (below).</li>
</ul>
<p>Two switches on each field decide where it appears:</p>
<ul>
  <li><strong>Stats</strong>: lets you break engagement down by this field on the Stats page. Choice lists chart best.</li>
  <li><strong>Leaderboard</strong>: prints the field beside every player's name, where their whole cohort sees it. It's a separate switch on purpose: grouping people in a staff report isn't the same decision as publishing it. At most two fields are shown, the first two in your order.</li>
</ul>
<p>A field is <strong>Live</strong>, or <strong>Draft</strong> to hide it from the roster and the player editor. A field's key is fixed when you create it, so you can rename its label safely: imports and Stats keep matching it. Deleting a field deletes every value recorded against it.</p>
<p><strong>The CSV round-trips.</strong> Start from <strong>Download the roster (CSV)</strong>: its headings are exactly the names the importer looks for. Fill it in, choose the file (or drop it on the page) and press <strong>Preview</strong>: each row is matched by email to someone already in this Adventure, nobody is added or removed, and nothing is written until you press <strong>Commit import</strong>. Columns are matched by heading in any order; Email is required, leave out any column you aren't changing, and a blank cell clears that value. The same fields also work as columns in a player import on Manage Players.</p>

<h2>Player Records</h2>
<p><strong>Player Records</strong> is where you manage what players have earned and done in this Adventure, in four tabs:</p>
<ul>
  <li><strong>Achievements</strong>: who holds each one, with <strong>Remove from all</strong>, plus <strong>Award an achievement…</strong> to give one to a player.</li>
  <li><strong>Transactions</strong>: purchases and spends. A removed transaction can be restored: switch the view to <em>Removed transactions</em>.</li>
  <li><strong>Milestone Submissions</strong>: removing one is the full milestone reset for that player, so only administrators can do it. GMs get links to review instead.</li>
  <li><strong>Challenge Attempts</strong>.</li>
</ul>
<p>Every tab filters by player, by what the record is about, by status and by search. Remove one row, a selection, or everything matching the filter; each asks for a second click, and the players affected have their totals recalculated. NPCs see the page read-only. In a cohort it shows only that cohort's own records, never the template's.</p>
<p>In an achievement's own editor, the Players tab is a true toggle: click someone who holds it to take it back, or someone who doesn't to award it. The player is told a Game Master awarded it on their next page.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a></li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Languages for Your Players',
                'slug'       => 'languages-for-your-players',
                'section'    => 'setup',
                'sort_order' => 48,
                'body'       => <<<'HTML'
<p>BLUERABBIT speaks 11 languages: English, Chinese (Simplified), French, German, Italian, Japanese, Korean, Portuguese (Brazil), Russian, Spanish and Turkish. Each person sees the app in their own language, so one cohort can mix them freely. This page covers who decides which language someone sees, and what is and isn't translated.</p>

<h2>Who Picks the Language</h2>
<ul>
  <li><strong>Each person, for themselves.</strong> The language picker on the sign-up form and in <strong>My Account</strong> lists every language in its own name (Español, Deutsch, 日本語…). Changing it reloads the page in the new language, with the confirmation already in it. Their choice follows them into every Adventure.</li>
  <li><strong>Your roster file.</strong> The player CSV import has a <strong>Language</strong> column (<code>en_US</code>, <code>es_MX</code>, <code>pt_BR</code>…), so a cohort arrives already in the right languages. Blank uses the platform default. See <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>.</li>
  <li><strong>The platform default.</strong> Anyone who hasn't picked a language sees the platform's <strong>Default language</strong> (Sys Config → Profile), which is also the language of the sign-in page. Platform administrators can also set a person's language in Manage Users.</li>
</ul>
<p>There's no language setting per Adventure: the language belongs to the person, not the program.</p>

<h2>What Is Translated</h2>
<p>Everything BLUERABBIT itself says: menus and buttons, the Journey and every step's controls, messages, celebrations and errors, the Garden, the guided tours, dates written with day and month names, and the Game Master's own screens (Manage Content, Adventure Settings, Stats and the rest). Plurals follow each language's own rules.</p>

<h2>What Stays as You Wrote It</h2>
<ul>
  <li><strong>Your content.</strong> Milestone and step text, posts, resources, item and achievement names, certificates and Cooper Context appear exactly as you wrote them. BLUERABBIT doesn't translate what you author.</li>
  <li><strong>Names you set.</strong> A section you've renamed (say, "Base Camp" for the Journey) and your currency names (XP, BLOO and EP, or whatever you've called them) are yours, and show the same in every language. A section you haven't renamed shows its built-in name in each person's language.</li>
  <li><strong>Emails.</strong> The emails BLUERABBIT sends are in English for now; a campaign's message is whatever you write.</li>
</ul>

<h2>Running an Adventure for Several Languages</h2>
<p>Because the frame translates itself and your content doesn't, the simplest setup for a mixed group is content written in the language everyone shares. If your players don't share one, keep one Adventure (or one template) per language: build it once, copy it with <strong>Duplicate</strong> on Manage Adventures, and translate the copy's content (see <a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit</a>). A template's cohorts all share its content, so they share its language too.</p>
<p>Spot a translation that reads wrong in your language? <a href="/contact">Tell us</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/choosing-your-language">Choosing Your Language</a> — what players see</li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a></li>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Customizing Your Taskbar & Adventure Branding',
                'slug'       => 'customizing-taskbar-and-branding',
                'section'    => 'setup',
                'sort_order' => 49,
                'body'       => <<<'HTML'
<p>Three panes of <strong>Adventure Settings</strong> control what an Adventure's frame offers and how it looks: <strong>Menu</strong> (which menu players start with, and its buttons), <strong>Journey &amp; Look</strong> (names and the main backgrounds) and the section cards under <strong>Sections</strong> (each section's own name and background). None of them changes how anything plays.</p>

<h2>Two Views: Classic and New</h2>
<p>BLUERABBIT has two ways of framing an Adventure. Both reach the same pages; only the frame differs.</p>
<ul>
  <li><strong>Classic</strong>: a top bar, and a taskbar along the bottom with the <strong>OPTIONS</strong> button. Pressing it opens the menu, and a row of shortcut buttons appears just above the bar; OPTIONS then reads <strong>CLOSE</strong>.</li>
  <li><strong>New</strong>: the content gets the whole screen. A yellow <strong>Options</strong> button in the top-left corner opens a pause-screen menu (players can also press Ctrl+K, or Cmd+K on a Mac), beside a <strong>Journey</strong> button. The other controls sit in the top-right corner: Feedback, Cooper, the help button, Email Support, the player's guild and profile.</li>
</ul>
<p>Under <strong>Menu → Menu style</strong>, <strong>Players start with the classic menu</strong> picks the one players get. It's only a starting point: each player can switch between Classic and New in My Account (or from the New menu's Settings), and their own choice wins. <a href="/docs/finding-your-way-around">Finding Your Way Around</a> covers both from the player's side.</p>

<h2>The Options Button</h2>
<p>Over a busy map, the one button that opens the whole menu is easy to miss. <strong>Highlight the Options button</strong> makes it pulse: <em>Off</em>, <em>Until the player first opens the menu</em>, or <em>Always</em>.</p>

<h2>Corner Buttons and Shortcuts</h2>
<ul>
  <li><strong>Cooper's button</strong> (Menu → Corner buttons): the button in the top corner that opens Cooper, the in-app AI assistant, and its row in the menu's Help. It only appears where Cooper is available for the Adventure. Cooper can wear a character of your own (a name, picture, button icon, greeting and personality, set under Help &amp; Cooper), and the button then shows that icon, with "Ask" and the character's name as its tooltip. See <a href="/docs/getting-help-support-and-chat">Getting Help</a>.</li>
  <li><strong>Feedback</strong>: the button that opens the form players use to message the team. Its switch and wording are under <strong>Help &amp; Cooper → Feedback form</strong>; see <a href="/docs/managing-player-support-requests">Managing Player Support Requests</a>.</li>
  <li><strong>Taskbar shortcuts (classic menu)</strong>: <strong>Journey</strong> (back to the map), <strong>Magic Code</strong> (opens the code box; shows only where Achievements and Magic Codes are on) and <strong>Item Shop</strong> (shows only where the shop is on). These sit above OPTIONS on the Classic taskbar while the menu is open. In the New view, the Journey button and the menu's own rows do the same job.</li>
</ul>

<h2>Custom Links</h2>
<p>Under <strong>Menu → Custom Links</strong> you can add up to <strong>three buttons of your own</strong>. In the Classic view they sit in the taskbar; in the New view they're a bar of buttons at the top of the Options menu. Each has:</p>
<ul>
  <li>an on/off toggle;</li>
  <li><strong>Label</strong>: the button's name (on the Classic taskbar, shown when a player hovers over the icon);</li>
  <li><strong>URL</strong>: a web address or an email (<code>mailto:</code>) link, opening in a new tab;</li>
  <li><strong>Icon</strong>: an image from the media library. Without one, the button shows a plain link icon;</li>
  <li><strong>Color</strong>: the button's colour.</li>
</ul>
<p>A custom button only appears when it's switched on <em>and</em> has a web or email address. Typical uses: your organization's own support channel, an intranet page, a booking link.</p>

<h2>Support Email</h2>
<p>The <strong>Email Support</strong> button writes to the Adventure's <strong>Custom Support Email</strong> (Help &amp; Cooper → Support) when you've set one, and to the platform's default support address otherwise.</p>

<h2>Backgrounds</h2>
<p>Each section can have a background of its own. A background you haven't set uses the platform's.</p>
<ul>
  <li><strong>Journey &amp; Look → Backgrounds</strong>: the <strong>Default Background</strong> (every page without one of its own), the <strong>Journey Background</strong> (the map, and also the Journey Builder and Scene Builder, so you design against the real backdrop) and the <strong>My Work Background</strong> (the player's Journal).</li>
  <li><strong>In each section's card under Sections</strong>: the Item Shop, Backpack, Guilds, Schedule, Wall, Leaderboard, Posts and Resources backgrounds.</li>
</ul>
<p>A background can also be a video: pick an MP4, WebM or Ogg file and it plays on a loop behind the page.</p>

<h2>Names and Labels</h2>
<p>What sections are called can be set per Adventure. Rename a section in its card under Sections (the Item Shop, Posts, Tasks, the Garden and the rest), and the Journey, the Journal, the Tabis and Secrets and Clues under <strong>Journey &amp; Look → Names</strong>. The new name is used in the menu and on the page heading. A name left blank uses the platform's (Sys Config's Custom Labels; see <a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a>). The names of XP, BLOO and EP are per Adventure too; see <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>.</p>

<h2>Templates and Cohorts</h2>
<p>A cohort takes its menu, names, backgrounds and support email from its template. Its menu's <strong>Template Settings</strong> opens the template's own settings. To theme a set of cohorts, set it up once on the template. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/finding-your-way-around">Finding Your Way Around</a>: the frame from the player's side</li>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a>: Cooper and the support options</li>
  <li><a href="/docs/managing-player-support-requests">Managing Player Support Requests</a></li>
  <li><a href="/docs/complete-adventure-settings-reference">The Complete Adventure Settings Reference</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'GM Toolkit: Duplicator, Player Records & Resets',
                'slug'       => 'gm-toolkit-duplicator-reports-and-bulk-actions',
                'section'    => 'setup',
                'sort_order' => 50,
                'body'       => <<<'HTML'
<p>The tools a GM reaches for once an Adventure is built: copying content, copying whole Adventures, moving a player on, fixing one player's run of a milestone, managing records, and finding things fast.</p>

<h2>Duplicator</h2>
<p><strong>Duplicator</strong> (in the Game Master menu; Admin Tools in the Classic view) copies content from this Adventure into another one, or into itself. Its milestone picker is grouped by Tabi (chapter), with a search box and type filter chips above it, which makes it much faster to find exactly what you want to copy when an Adventure has hundreds of milestones. It lists milestones with all their steps, challenges with their questions, posts, resources, achievements, Tabis, items, encounters, speakers, tasks, guilds and missions. Tick what you want (each section has <strong>All</strong> and <strong>None</strong>, and the header counts what's selected), choose the target under <strong>Duplicate into</strong> in the bar at the bottom, and press <strong>Duplicate Selected</strong>. A confirmation names the destination and counts what's going before anything copies.</p>
<p>Copies are independent: new ids, no player data, and nothing in the source changes. A few things are adjusted on the way:</p>
<ul>
  <li><strong>Guilds</strong> arrive empty. Members and XP aren't copied, and each guild gets a new join code.</li>
  <li><strong>Missions</strong> keep achievement and path audiences. A guild audience follows only if that guild is copied in the same run, named players are dropped, and a mission left with no audience arrives as a draft instead of going out to everyone.</li>
  <li><strong>Tasks</strong> get a new QR code. A task completed by a specific milestone keeps that trigger when the target can play the milestone, as a cohort of the same template can.</li>
  <li><strong>Encounters</strong> copied into another Adventure arrive without their milestone, group and conditions, ready to attach there.</li>
</ul>
<p>The Duplicator is a one-time copy, which is different from a template and its cohorts: those share content live. To bring guilds and missions into a cohort, open the Duplicator on the template and pick the cohort as the target. See <a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a>.</p>
<p>Lots of similar content to create rather than copy? Most managers in Manage Content take a CSV upload; see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>.</p>

<h2>Duplicating a Whole Adventure</h2>
<p>On <strong>Manage Adventures</strong>, <strong>Duplicate</strong> makes a full, independent copy of an Adventure: its milestones and steps, achievements, certificates (with their conditions and the rubric criteria they use), items, guilds, Tabis, journey and the rest, with every reference between them remapped. No one's progress comes with it: the only person in the copy is the GM who made it. A dialog confirms before it runs, and the copy opens in Adventure Settings, named after the original with <em>(Copy)</em> on the end. Editing it never touches the original.</p>
<p>Duplicating a cohort copies what the cohort plays: the content from its template, plus the cohort's own guilds and tasks. A condition that pointed at something not copied becomes one nobody meets, never one that opens by accident.</p>

<h2>Moving a Player On: Clear Stage</h2>
<p>A late arrival, or a player the room has decided should move on, can have a stage marked done without replaying it. Open the player's Journal (the <strong>Journal</strong> button on Manage Players) and, in the list of milestones, press <strong>Clear stage</strong> beside an unfinished stage. The dialog first shows exactly what will be marked done (and, where the stage has a choice the player hasn't made yet, asks you to choose for them). Each milestone is marked done with a grade of 100 and "Cleared by you" in its comment; the player gets its XP, and the next stage opens if this was all it was waiting for. Milestones already done are left as they are, and optional ones aren't touched. Nothing is deleted. Game Masters and administrators can do this; NPCs can't.</p>

<h2>Resetting One Player's Milestone</h2>
<p>When one player needs to run a milestone again (a challenge with its attempts used up, a SCORM package stuck mid-run, a case study that won't allow a retake), an administrator can reset that milestone for that player alone. Open the player's Journal and press <strong>Reset</strong> next to the milestone. Milestones the player has started without handing anything in have their own list, <strong>Started, not submitted</strong>, with the same button.</p>
<p>Before anything happens, <strong>Reset milestone</strong> lists exactly what will be removed, with counts, taken from the same list the reset then runs. Press <strong>Reset it</strong> to go ahead. There's no undo. The activity log is kept and records the reset, uploaded files stay on disk, and a task the milestone happened to trigger, or an achievement earned through a condition rather than as the milestone's own reward, is left alone.</p>
<p>This is for administrators, not GMs, because it deletes part of a player's record. Removing a submission in Player Records runs the same reset.</p>

<h2>Player Records</h2>
<p><strong>Player Records</strong> manages what players hold in this Adventure: achievements (with Award and Remove from all), transactions (removable and restorable), milestone submissions and challenge attempts. Every tab filters by player, subject, status and search, and removes one row, a selection or everything matching. See <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>.</p>

<h2>Finding Things in Manage Content</h2>
<p>Every tab of Manage Content has the same header and toolbar: a search box plus whichever filters make sense for that tab. Type buttons appear only for types the Adventure actually has (item types; badge, rank or path; encounter kinds; task triggers; and so on), and guilds filter by group instead. Every filter combines with the others. Items and guilds you've set to draft have their own Drafts list. The Requests tab keeps its own status filters, and the Dashboard tab, first in the row, shows what the Adventure holds and whether it's running.</p>

<h2>The Milestone Funnel</h2>
<p>On the Stats page's Overview, <strong>Details</strong> beside the Milestone Funnel opens the full funnel: a drop-off chart you can narrow to one Tabi or one level, beside how many players are enrolled, what share have logged in, and what share were active in the last 7 days. It's the fastest way to spot the one milestone that's quietly losing everyone. See <a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/adventure-templates-and-cohorts">Adventure Templates &amp; Scaling Cohorts</a></li>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a></li>
  <li><a href="/docs/activity-logs">Activity Logs</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Bulk Uploads & Exports with CSV',
                'slug'       => 'bulk-uploads-with-csv',
                'section'    => 'setup',
                'sort_order' => 51,
                'body'       => <<<'HTML'
<p>Building forty milestones, sixty questions or a whole catalogue of skills one form at a time is slow. Most managers in Manage Content take a <strong>CSV upload</strong> instead: one row per thing, added in one go. The same idea runs the other way too: rosters, grades and reports come out as CSV files you can open in any spreadsheet. This page lists every upload and every export, and the rules they share.</p>

<h2>Where You Can Upload</h2>
<ul>
  <li><strong>Achievements</strong>: Manage Content → Achievements, in the header.</li>
  <li><strong>Items</strong>: Manage Content → Items, in the header.</li>
  <li><strong>Milestones</strong>: Manage Content → Journey, <strong>Bulk Upload</strong> in the header.</li>
  <li><strong>Challenge questions</strong>: in a challenge's editor, under Questions, once the challenge is saved: a question, its correct answer and up to three decoys per row.</li>
  <li><strong>Speakers</strong>: Manage Content → Speakers.</li>
  <li><strong>Schedule sessions</strong>: on the Schedule page itself, for staff who can edit.</li>
  <li><strong>Guilds</strong>, <strong>Tabis</strong>, <strong>Skills</strong> and <strong>Tasks</strong>: beside each tab's add button.</li>
  <li><strong>Posts</strong> and <strong>Resources</strong>: at the top of each tab's published list.</li>
</ul>
<p>Only those who can edit the Adventure see the uploads; NPCs don't. Content lands where it belongs: milestones, achievements, items, Tabis, skills, speakers, posts and resources on the template, so every cohort gets them; guilds, tasks and schedule sessions on the Adventure you're in, as a cohort keeps its own.</p>

<h2>Before You Pick a File</h2>
<p>Under the header, each upload says exactly what it takes, before you choose anything:</p>
<ul>
  <li><strong>The limits</strong>: CSV only, at most 2 MB and 150 rows (100 for speakers and sessions). The first row is a header and is skipped.</li>
  <li><strong>The columns, in order</strong>, and what each takes: a number and its default when blank, a date like <code>2026-12-31 14:30</code>, a colour name like <code>blue</code> or a code like <code>#1c8ca6</code>, a web address, the id of something in this Adventure. The columns for XP, BLOO and EP carry your Adventure's own names for them.</li>
  <li><strong>What must be filled</strong>, for example a milestone's title, or an achievement's name and badge.</li>
  <li><strong>Download the template</strong> (guilds, Tabis, skills, tasks, posts and resources): the columns as a header row and one example row to replace with your own.</li>
</ul>
<p>A blank cell takes the same default the editor would give it. Choices the editor offers from a list (a status, a type, a Tabi's kind, a task's trigger, an icon) must be one of them; ids must belong to this Adventure. Tabis, posts and resources are always added published.</p>

<h2>The Row-by-Row Report</h2>
<p>After the upload, a report stays on the page until you close it: <em>N added, M refused</em>, then every refused row with its spreadsheet row number and the reason (<em>Row 12: the milestone title is empty</em>). A row whose name was already there is added anyway, and marked so; blank lines are skipped. <strong>Reload to see them</strong> shows what was added.</p>
<ul>
  <li><strong>Every row is added as a new one</strong>, even if one with the same name exists. Fix the refused rows and upload a file with only those: sending the whole file again adds the good rows twice.</li>
  <li><strong>A file over the row limit is refused whole</strong>, so nothing is half-imported. Split it.</li>
  <li><strong>Separators and encodings</strong>: the file must be separated by commas. A file separated by semicolons is refused with how to fix it (save it as "CSV UTF-8" in Excel). Files saved with Windows or Excel encodings are read correctly, accented names included.</li>
  <li>The browser checks the file first: no file, not a .csv, or over 2 MB is refused before anything is sent.</li>
</ul>

<h2>Uploads That Work on People</h2>
<p>These take an email address per row and act on people already enrolled, or enrol them:</p>
<ul>
  <li><strong>The player roster</strong>: Manage Players → Add Players → <strong>Bulk import from CSV</strong>, with a <strong>Download CSV Template</strong> built for this Adventure. Columns: Email (required: an existing account is enrolled, a new one is created), Nickname, Password, First Name, Last Name or a single Name, Language (such as <code>en_US</code> or <code>es_MX</code>), Guild, and one column per Player Meta field. The whole file is read in your browser and imported row by row, with no row limit, and checked against the roster when it finishes. Comma, semicolon and tab separated files all work here. Passwords follow the platform's rule (12 to 50 characters). See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</li>
  <li><strong>Profile data</strong>: the Player Meta Manager's <strong>Import CSV</strong> tab fills in many profiles at once, matched by email, previewed before anything is written. See <a href="/docs/managing-your-player-roster">Managing Your Player Roster</a>.</li>
  <li><strong>Awarding an achievement</strong>: in an achievement's Players tab, <strong>Upload a CSV of email addresses</strong>. Everyone on it who is in this Adventure gets it; anyone who already has it is left as they are. <strong>What each upload did</strong> keeps the last runs, with every address's result: assigned, already had it, not yet the level it needs, already holds a path from this branch, or not found in this Adventure.</li>
  <li><strong>Filling a guild</strong>: Manage Content → Guilds, <strong>Assign players to a guild</strong>. Everyone matched is moved into the guild you pick (a player belongs to one guild at a time); running the same file twice is safe.</li>
  <li><strong>Picking email recipients</strong>: on Email Notifications, <strong>Select from a CSV</strong> selects everyone in this Adventure whose address is in the file's first column.</li>
  <li><strong>Grading</strong>: the Milestone Review's <strong>Upload Reviewed CSV</strong> reads back grades, validation and comments. See <a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a>.</li>
</ul>

<h2>Exports</h2>
<p>Everything you can download as a CSV:</p>
<ul>
  <li>the <strong>Players</strong> spreadsheet (with email addresses), and the Player Meta Manager's roster with every field;</li>
  <li>a milestone's <strong>Grade &amp; Review CSV</strong>, its Validation list, and the pending players' email addresses;</li>
  <li><strong>Case Study Entries</strong> (one column per answer) and <strong>Video Watch Stats</strong>;</li>
  <li>the Challenges and SCORM reports in Manage Content, and the <strong>Surveys</strong> tab of Stats (one row per player, a column per question);</li>
  <li>each tab of an email campaign's <strong>Send Log</strong>;</li>
  <li>for platform administrators, <strong>Manage Users</strong> (what the filters show) and the <strong>sign-in log</strong>.</li>
</ul>
<p><strong>Every export is formula-safe.</strong> A cell that starts with <code>=</code>, <code>+</code>, <code>-</code>, <code>@</code>, a tab or a line break gets an apostrophe in front, so a spreadsheet shows it as text instead of running it. A player who names themselves <code>=HYPERLINK(...)</code> can't plant anything in your spreadsheet. Plain numbers, negative ones included, are left as they are. Files open cleanly in Excel, accents and all.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/managing-your-player-roster">Managing Your Player Roster</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
  <li><a href="/docs/reviewing-and-grading-submissions-in-bulk">Reviewing &amp; Grading Submissions in Bulk</a></li>
  <li><a href="/docs/stats-dashboard-guide">Reading the Stats Dashboard</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Managing Player Support Requests',
                'slug'       => 'managing-player-support-requests',
                'section'    => 'setup',
                'sort_order' => 52,
                'body'       => <<<'HTML'
<p>The GM side of the messages players send with the feedback form (see <a href="/docs/getting-help-support-and-chat">Getting Help</a>). They land in <strong>Player Requests</strong> in the Game Master menu (Admin Tools in the Classic view), which is also the Requests tab of Manage Content.</p>

<h2>The Form Players Use</h2>
<p>Players open the form from the Feedback button in the top corner (the taskbar in the Classic view) or the Help row of the menu, and follow what they sent, and your answer, under <strong>My Requests</strong>. Everything about it is set under <strong>Adventure Settings → Help &amp; Cooper → Feedback form</strong>:</p>
<ul>
  <li><strong>The switch</strong>: off removes the button, the menu row and the My Requests link together, and the form can't be sent. Answers already given stay on the My Requests page.</li>
  <li><strong>Title</strong>: the top of the form, its row in the menu and the button's tooltip. Default: <em>Send feedback</em>.</li>
  <li><strong>What to tell players</strong>: the line under the title. Default: <em>Found a bug, have a question or an idea? Tell the team here. You can follow your message under My Requests.</em></li>
  <li><strong>First field</strong> (default <em>What is it about?</em>) and <strong>Message field</strong> (default <em>Tell us more</em>).</li>
  <li><strong>Date field</strong>: blank by default, which leaves the date out. Give it a label, such as <em>Extension needed until</em>, and the form asks for a date too; the label and the date open the message you receive.</li>
</ul>
<p>Anything left blank uses the default shown in grey. A request needs every field filled in; if something's missing the player is told inside the form, and a sent request is confirmed with a panel pointing them to My Requests. Only people enrolled in the Adventure can send one, and guests can't.</p>
<p>Setting the form up for deadline extensions? Title it "Deadline extension request", ask "Which module" and "Why do you need more time", and set the date field to "Extension needed until".</p>

<h2>Reading the Queue</h2>
<p>The page's title shows the total and how many are pending. Each request is a card: the player's picture, name and email, the subject, when it was sent, its status and the full message. Use the search box to find a player or a subject, and the status buttons to narrow the list: <strong>All</strong>, <strong>Pending</strong>, <strong>Read</strong>, <strong>Resolved</strong> and <strong>Dismissed</strong>, each with its count. Every request is listed, and the counts follow each change you make.</p>

<h2>Acting on a Request</h2>
<ul>
  <li><strong>Mark Read</strong>: you've seen it and you're on it.</li>
  <li><strong>Resolve</strong>: dealt with.</li>
  <li><strong>Dismiss</strong>: you won't be acting on it.</li>
  <li><strong>Reopen</strong>: puts a resolved or dismissed request back to Pending.</li>
</ul>
<p>Before you press one, you can type an <strong>Admin note</strong> in the box on the card. It's saved with the status change, and the player sees it on their My Requests page as the admin response. Tell them yes, no, or what happens next. Your answer also lights up the player's notification bell, so they don't have to keep checking.</p>
<p>A request is only a message. Resolving it doesn't change any dates by itself; granting an extension is up to you.</p>

<h2>A Rhythm That Works</h2>
<p>Nothing tells you when a request arrives, so check the queue regularly. Treat it like any support queue: skim what's new, act on it, then mark it Resolved or Dismissed with a note, so Pending stays a true "still needs attention" list rather than a graveyard of old tickets.</p>
<p>NPCs can read every request but can't change a status or write a note.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/getting-help-support-and-chat">Getting Help</a></li>
  <li><a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Branding</a></li>
  <li><a href="/docs/gm-toolkit-duplicator-reports-and-bulk-actions">GM Toolkit: Duplicator, Player Records &amp; Resets</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Meet "Launch Week" — Our Running Example Adventure',
                'slug'       => 'meet-launch-week-example-adventure',
                'section'    => 'setup',
                'sort_order' => 53,
                'body'       => <<<'HTML'
<p>Several pages in this manual reference the same fictional adventure, so examples stay consistent instead of jumping between unrelated scenarios each time.</p>

<h2>The Brief</h2>
<p><strong>Launch Week</strong> is a two-week new-hire onboarding Adventure for a mid-sized company: forty new hires across three departments, starting the same Monday, with an in-person orientation day midway through Week One.</p>

<h2>What It Uses</h2>
<ul>
  <li>Two Tabis, "Week One: Company Basics" and "Week Two: Department Deep-Dive", with Week Two locked until Week One is finished</li>
  <li>A mix of Milestones and two Challenges</li>
  <li>Choose Display Name, Dialogue, Video, Open Text, Upload Image, Multiple Choice, Rating Scale and Branch Choice steps</li>
  <li>The CEO set up once as a speaker, so she's the same character in the dialogue and on the orientation-day schedule</li>
  <li>A short working-style profile test, its questions spread through Week One's milestones</li>
  <li>A three-tier Rank ladder (New Hire → Onboarded → Launch-Ready) and a small Item Shop</li>
  <li>Three department Guilds with a shared leaderboard</li>
  <li>A Branch Choice into Engineering / Sales / Operations tracks</li>
  <li>An event schedule for orientation day, and a QR code at the door that awards an "Attended Orientation" badge</li>
  <li>A "Launch-Ready" certificate that unlocks when its conditions are met</li>
  <li>Announcements at kickoff and at the Week Two handoff, plus two email campaigns and a pace schedule behind an email rule for anyone falling behind</li>
  <li>A roster loaded from one CSV file, with each new hire's department as a Player Meta field the Stats page can break results down by</li>
</ul>

<p>The full build, in order, is documented in <a href="/docs/worked-example-two-week-onboarding-adventure">Worked Example — Building a Two-Week Onboarding Adventure End to End</a>. Other pages in this manual reference Launch Week in passing to illustrate a specific feature in context.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/worked-example-two-week-onboarding-adventure">Worked Example — Building a Two-Week Onboarding Adventure End to End</a></li>
  <li><a href="/docs/building-your-first-adventure">Building Your First Adventure</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Worked Example — Building a Two-Week Onboarding Adventure End to End',
                'slug'       => 'worked-example-two-week-onboarding-adventure',
                'section'    => 'setup',
                'sort_order' => 54,
                'body'       => <<<'HTML'
<p>Everything above in one build. This walks through designing "Launch Week", a two-week new-hire onboarding Adventure for a mid-sized company, touching nearly every feature covered in this guide in the order a Game Master would actually reach for them.</p>

<h2>The Brief</h2>
<p>Forty new hires across three departments, starting the same Monday. Goal: get everyone through company basics, department-specific training, and one in-person orientation day, with enough structure that HR can see who's on track without babysitting anyone.</p>

<h2>Day 1 — The Map &amp; the First Milestones</h2>
<p>Start from a blank Adventure rather than a template; this program is specific enough to build fresh. Lay out the Journey Map in two Tabis, "Week One: Company Basics" and "Week Two: Department Deep-Dive", and give Week Two a prerequisite so it stays locked until Week One is finished (see <a href="/docs/tabi-editor">The Tabi Editor</a>). Add a welcome Milestone first ("Welcome to the Company"): pure delivered content, zero friction on day one.</p>

<h2>Building the Steps</h2>
<p>Inside the welcome Milestone: a <strong>Choose Display Name</strong> step, a <strong>Dialogue</strong> step introducing the CEO, and a <strong>Video</strong> step touring the office. The CEO is set up once as a speaker, so every line she speaks, here and later in the program, carries the same name and portrait, and she appears on the orientation-day schedule as well (see <a href="/docs/speakers-and-dialogue-cast">Speakers &amp; the Dialogue Cast</a>). The second Milestone, "Tell Us About You", uses an <strong>Open Text</strong> step with a 50-word minimum plus an <strong>Upload Image</strong> step for a profile photo. A short <strong>Challenge</strong> on company policy follows: a real question bank with a pass threshold, not a Milestone.</p>

<h2>A Profile Test, Woven In</h2>
<p>HR wants to know how each new hire likes to work, without handing them a questionnaire on day one. So the GM switches on the Profile Tests card under Sections in Adventure Settings, creates a "Working Style" profile with four traits on Manage Content's <strong>Profiles</strong> tab, and spreads its questions through Week One: three <strong>Agree / Disagree Scale</strong> steps inside "Tell Us About You", and three more in the end-of-week check-in. Nothing marks them as a test; they read as part of getting to know the company. A <strong>Profile Result</strong> step at the end of the check-in shows each new hire their reading, and it stays in their Journal's Profiles tab afterwards. See <a href="/docs/profile-tests">Profile Tests</a>.</p>

<h2>Rewards, Ranks &amp; the Shop</h2>
<p>Every Milestone pays XP and a little BLOO. Three Ranks on the adventure's rank ladder (New Hire → Onboarded → Launch-Ready) are each awarded automatically at a level threshold. The Item Shop carries a handful of <strong>Consumable</strong> perks that HR honours in person, like a coffee with the CEO or first pick of the desk plants, which a new hire marks as used from their Backpack. The end-of-week check-in also hands out a <strong>Reward</strong> item, a cosmetic company-swag badge. Nothing that trivializes the actual content.</p>

<h2>Guilds by Department</h2>
<p>All forty new hires come in through one CSV file on Manage Players, whose Guild column puts each person straight into their department's guild: three guilds, with capacity roughly even (see <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a> and <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>). Before importing, the GM adds a "Department" choice-list field in the Player Meta Manager and marks it for Stats, so the same file fills it in and HR can break engagement down by department on the Stats page. A department-level leaderboard turns "finish onboarding" into a bit of friendly competition without pitting individuals against each other.</p>

<h2>The Branch: Choose Your Track</h2>
<p>Week Two opens with a <strong>Branch Choice</strong> step: Engineering, Sales, or Operations. The choice is permanent, and every Milestone from that point on is gated to the matching track, so nobody wades through training content irrelevant to their actual role.</p>

<h2>The In-Person Checkpoint (QR Code)</h2>
<p>Wednesday of Week One is an in-person orientation day. Its three sessions (a welcome talk, a benefits walkthrough and a team lunch) go on the <a href="/docs/event-schedule-concept">Event Schedule</a> with their rooms, so the schedule doubles as the day's agenda. Attendance is an "Attended Orientation" achievement whose QR code is printed at the door: scan on the way in, badge earned, no submission required. The GM asks everyone to log in on their phone the day before, because a scan from a logged-out phone has to be repeated after signing in. See <a href="/docs/qr-codes-live-and-hybrid-events">QR Codes</a>.</p>

<h2>Keeping It Alive Week Two</h2>
<p>The GM posts an <a href="/docs/announcements-keeping-an-adventure-alive">announcement</a> on the Wall the day Week Two opens, and a second one midway through calling out the department leaderboard standings. Two <a href="/docs/how-to-send-an-email-campaign">email campaigns</a> go out as well: a kickoff welcome the Sunday before, and a Week Two nudge to the new hires who haven't chosen their track yet. A pace schedule ("by the end of week 1, level 3 and 50% of the journey") sits behind one <a href="/docs/automatic-emails-and-audience-rules">automatic email rule</a> that finds anyone who falls behind; the GM runs it with <strong>Run now</strong> and approves each send. Open Text steps in Week Two have A.I. Validation on, so each answer is checked before the new hire continues and HR is reviewing already-revised answers instead of first drafts (see <a href="/docs/grading-and-ai-assisted-feedback">Grading &amp; AI-Assisted Feedback</a>).</p>

<h2>The Finish Line: A Certificate</h2>
<p>Onboarding should end with something a new hire can keep. A "Launch-Ready" certificate, created on Manage Content's <strong>Certificates</strong> tab, carries the company logo and the Head of People's signature, and it unlocks on two conditions: <strong>Complete This Tabi</strong> set to Week One, and <strong>Level</strong> set to the level that awards the Launch-Ready rank. Until both are met it sits locked on each new hire's Achievements page, listing exactly what's still missing ("Reach level 6 — you're at level 4"). Once they are, it opens, ready to print. See <a href="/docs/certificates-authoring">Certificates for GMs</a> and <a href="/docs/conditions-when-things-unlock">Conditions</a>.</p>

<h2>What Shipped</h2>
<p>Two Tabis, roughly a dozen Milestones plus two Challenges, around a dozen different Step types, a rank ladder, three guilds, a small shop, one branch, a profile test spread across Week One, an orientation-day schedule with one QR check-in, a certificate gated by conditions, two announcements, two email campaigns and one email rule for anyone falling behind: built and published before the Monday start date, ready to hand off to HR without a single line of code.</p>

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
                'sort_order' => 55,
                'body'       => <<<'HTML'
<p><strong>Enterprise only.</strong> An Organization groups one client's Adventures and people under a single name. It's built for a customer running several programs, departments or cohorts who wants them filed together rather than as unrelated Adventures. Organizations aren't offered on the self-serve platform, on any plan: they come with an Enterprise setup (see <a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a>).</p>

<h2>How Organizations Fit Together</h2>
<ul>
  <li><strong>An Adventure belongs to exactly one Organization.</strong> The app refuses to attach an Adventure that's already in another one.</li>
  <li><strong>People reach an Organization through its Adventures.</strong> A person can be part of two Organizations (two clients, one Adventure each) without anything being shared between them.</li>
  <li><strong>Cohorts follow their template.</strong> A cohort built from a template that sits in an Organization is filed under that same Organization.</li>
</ul>

<h2>Creating and Finding Organizations</h2>
<p>Organizations are created by a platform administrator. <strong>Manage Organizations</strong> (in the administrators' menu) lists every Organization with its people and Adventures, a filter box, and <strong>New Organization</strong>: give it a name and the new Organization opens. The same list is on the <strong>Organizations</strong> tab of Sys Config, with an <strong>Edit</strong> button for each. An Organization can be managed by platform administrators and by its owner.</p>

<h2>General</h2>
<p>The Organization's name, logo, brand colour and an About text. Save with <strong>Save Organization</strong>.</p>

<h2>Players</h2>
<p>Add people to the Organization by email: type it into <strong>Add Players to the org</strong> and choose <strong>Find Player</strong>. Each person's role in the Organization is recorded as <strong>Player</strong>, <strong>GM</strong> or <strong>NPC</strong>, and a search box filters the list. What someone can do inside a particular Adventure still comes from that Adventure's own roster (see <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>).</p>

<h2>Adventures</h2>
<p>Search for an Adventure and attach it to the Organization, or remove one. The search only offers Adventures that aren't in any Organization yet, so there's no way to steal another client's Adventure by accident. Each attached Adventure is listed with its enrollment link and its owner.</p>

<h2>Who Can Change an Organization</h2>
<p>An Organization's owner can see everything in their Organization: its players and its Adventures. Adding a player, attaching an Adventure or removing one is an action only a platform administrator can take. If you're an owner and need a change made, reach out to your BLUERABBIT administrator or support.</p>

<h2>On the Roadmap</h2>
<p>These are planned but <strong>not available yet</strong>, so don't plan a rollout around them:</p>
<ul>
  <li><strong>Cross-Adventure Stats</strong>: one analytics view across every Adventure in the Organization. Until it lands, use each Adventure's own <a href="/docs/stats-dashboard-guide">Stats page</a>.</li>
  <li><strong>Bulk adding people</strong>, either from an existing Adventure's roster or by CSV, at the Organization level. For now, add people through each Adventure's own CSV import (see <a href="/docs/bulk-uploads-with-csv">Bulk Uploads &amp; Exports with CSV</a>).</li>
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
                'title'      => 'Prize Draws (Enterprise)',
                'slug'       => 'prize-draws',
                'section'    => 'setup',
                'sort_order' => 56,
                'body'       => <<<'HTML'
<p><strong>Enterprise only.</strong> Prize Draws turn effort into chances at a real prize. Players collect <strong>tickets</strong> (earned by playing, bought in the shop, or given by staff) and each <strong>lottery</strong> enters the tickets held when it closes, then picks its winners in a way anyone can check afterwards. Prize Draws aren't offered on the self-serve platform, on any plan; see <a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a>.</p>

<h2>Switching It On</h2>
<p>On an Enterprise platform, the <strong>Lottery</strong> card appears under <strong>Sections</strong> in Adventure Settings. Switch it on, give the section the name your players will see (it's "Lottery" until you rename it), and write the <strong>Prize rules, in your words</strong>: who can take part, the key dates, anything legal. Players open those rules from the journey and the Lottery page, with the ways to earn tickets, the lotteries and any awards listed under them automatically.</p>
<p>Everything else is run from <strong>Manage Content → Lottery</strong>, which each cohort has for itself. Game Masters and administrators run it; NPCs can only look.</p>

<h2>Step 1: A Ticket Item</h2>
<p>A lottery enters the tickets of one ticket item, so make one first: a new item of type <strong>Lottery ticket</strong>. Then decide how players get it:</p>
<ul>
  <li><strong>Earned by playing</strong>: <em>One for every required milestone finished</em>, and/or <em>Flawless</em> (one per lottery for challenges passed or case studies with no wrong answers). A milestone whose Item Reward is this ticket pays it too, which is how a side quest pays tickets. One milestone pays once. Tickets arrive as each player's scores update, and are celebrated like any reward.</li>
  <li><strong>Bought</strong>: give the item a cost and it's on sale in the Item Shop. <strong>Tickets per purchase</strong> makes a pack (100 tickets for one charge, each still its own entry). The shop shows the price, the balance and what will be left before the player buys, and a per-player limit counts purchases since the last lottery of that ticket locked. A cost of 0 means it's only earned and given.</li>
  <li><strong>Given</strong>: staff give tickets from the Lottery page (below).</li>
</ul>
<p>Tickets can't be used or handed on like other items; they wait in the player's Wallet, in the Backpack, until a lottery takes them. Spending currency on a ticket counts as spent, for good.</p>

<h2>Step 2: Schedule a Lottery</h2>
<p><strong>New lottery</strong> asks for:</p>
<ul>
  <li>a <strong>Title</strong>, the <strong>Prize, in words</strong> (for example "€10 gift card") and an image;</li>
  <li>which <strong>Ticket</strong> it enters, and how many <strong>Winners</strong>;</li>
  <li>when it <strong>Closes</strong>: tickets dated up to that moment enter (work handed in before it counts even if it's marked later); later ones wait for the next lottery;</li>
  <li>when <strong>players see the result</strong>: at a set time, or as soon as the lottery closes (about a minute later);</li>
  <li>an optional <strong>Prize item</strong>. A gift card is sent through Tremendous, free to the winner; any other item goes into their backpack. Leave it empty to deliver prizes by hand;</li>
  <li><strong>Also email the lock to</strong>: addresses outside your team (a sponsor, an auditor) who receive the lottery's fingerprint when it locks. The Adventure owner always gets it;</li>
  <li><strong>Exclude previous winners</strong>, to spread the best prizes to people who haven't won yet. A left-out player keeps their tickets for the next lottery that will have them.</li>
</ul>
<p>Schedule one for the end of each month the program runs. A lottery that has locked is the record: it can't be edited or deleted.</p>

<h2>How a Lottery Stays Fair</h2>
<ol>
  <li><strong>Lock.</strong> At the close, the list of entered tickets is frozen and its fingerprint is published (and emailed to the addresses you gave). Locking also names a future round of <strong>drand</strong>, a public randomness service. That number doesn't exist yet, for anyone, BLUERABBIT included.</li>
  <li><strong>Run.</strong> Once that round is out, the published rule orders every entrant. More tickets means better odds; nobody can win twice in one lottery. Everyone online at the result time watches it happen.</li>
  <li><strong>Pay.</strong> If a winner can't be paid, the next person in the fixed order moves up. Anyone can re-check the whole lottery from its record page.</li>
</ol>
<p>All of this runs on its own at the times you set. A lottery's record page also has <strong>Run now</strong> (close it now; the result follows about a minute later), <strong>Lock the ticket list</strong> and <strong>Run it now</strong> for when you need to act by hand.</p>

<h2>Giving Tickets and Setting Budgets</h2>
<p>On the Lottery page, staff can <strong>give tickets</strong> to a player, and see recent gifts. A Game Master gives without limit unless budgeted. <strong>Ticket budgets</strong> on Manage Content → Lottery let someone else give tickets too: pick the giver (a player, an NPC or a Game Master), the ticket, how many they may give in total, and optionally only to the players of one organization. The form always says what's left before a gift.</p>
<p><strong>Tickets waiting for a lottery</strong> counts each ticket's tickets earned by playing, bought and given, and how many players hold them. <strong>Issue owed tickets</strong> gives everyone every ticket still owed for work already finished, the same sweep every lottery runs before it locks.</p>

<h2>Automatic Awards and Rounds</h2>
<p>Besides lotteries, prizes can go to the leaderboard: <strong>automatic awards</strong> to the top players, the top guilds or the biggest climb, measured on a round or on the whole board at a date. A guild prize goes to every member of the winning guild or to one contact; the prize is an item (and how many) or just words. <strong>Rounds</strong> split the program into periods; the leaderboard then shows a tab per round, and can mark the paying places with the prize (switches in the Leaderboard card under Sections). A started round's start is fixed, and an ended one is the record.</p>

<h2>Approving and Delivering Prizes</h2>
<p>Winners wait in the <strong>prize queue</strong> until staff act on them:</p>
<ul>
  <li><strong>Approve</strong> sends the prize item (tickets, a backpack item or a gift card); <strong>Approve all</strong> does each place in order.</li>
  <li><strong>Delivered</strong> records a prize handed over in person, with a note.</li>
  <li><strong>Forfeit</strong>, with a reason, or <strong>Replace</strong> for a winner who has left: the next place moves up, to be approved in turn. <strong>Leave out</strong> skips a guild member who has left.</li>
</ul>
<p>A winner is celebrated on their next page in the Adventure.</p>

<h2>Lottery-Day Emails</h2>
<p>For each lottery day you can send an <strong>entries</strong> email (once a ticket list has locked) and a <strong>results</strong> email (once every result is out). Nothing sends by itself: <strong>Preview</strong> it, <strong>Send me a test</strong>, then <strong>Send</strong>, which works through the players in batches and can be resumed. Each goes out once only.</p>

<h2>What Players See</h2>
<p>A <strong>Lottery</strong> page (named as you named the section) with every lottery, its prize, its countdown and its result; a record page per lottery with the winners, their own tickets and a check anyone can run; <strong>My tickets</strong>; their tickets in the Backpack's Wallet; and, if you place them in the Journey Builder, a lottery widget and the rules card on the map.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/item-shop-building-an-economy">The Item Shop — Building an In-Adventure Economy</a></li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading &amp; Gift Card Rewards</a></li>
  <li><a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Platform Settings & White-Label Branding (Enterprise)',
                'slug'       => 'platform-settings-and-white-label-branding',
                'section'    => 'setup',
                'sort_order' => 57,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> Beyond each Adventure's own settings there's a platform-wide console, <strong>Sys Config</strong>, that shapes how BLUERABBIT looks and behaves across every Adventure on your platform. Only platform administrators (the God and Admin access levels) can open it; a GM running one Adventure never sees it. On the self-serve platform our own team holds this console, so platform-wide branding is something you get with an Enterprise setup.</p>

<p>Sys Config is one page with a sticky row of tabs along the top. One tab shows at a time, and a single <strong>Save Settings</strong> saves every tab at once. The header says which features the platform runs: on an Enterprise platform every feature is available. Here's what each tab is for.</p>

<h2>General</h2>
<p>Platform defaults and rules:</p>
<ul>
  <li>whether registration is open, and restricting sign-up to one email domain;</li>
  <li><strong>Sign-ups must confirm their email</strong>: new accounts made with the Sign Up form can't sign in until they click the link emailed to them (see <a href="/docs/security-and-single-sign-on">Security &amp; Single Sign-On</a>);</li>
  <li>the default Adventure new accounts land in, and the default support email;</li>
  <li>whether accounts may create Adventures (from scratch and from a template), whether an Adventure may have several GMs, and whether public Adventures are allowed;</li>
  <li>the default theme, the <strong>Default Journey View</strong> (whether a player's first visit opens the Journey as a Map or a List), and whether GMs and NPCs may reset a player's password;</li>
  <li>the platform's Google Analytics property (an Adventure can report to its own instead);</li>
  <li><strong>Play now</strong>: let visitors play one chosen Adventure without an account. Each visitor gets a guest account that can play but can't message, help or recognise anyone, change their account or create anything. Off unless you turn it on.</li>
</ul>

<h2>Profile</h2>
<p>The <strong>Default language</strong>: the language anyone who hasn't picked their own sees, and the language of the sign-in page. BLUERABBIT speaks 11 languages; see <a href="/docs/languages-for-your-players">Languages for Your Players</a>.</p>

<h2>Legal</h2>
<p>Where your Terms of Service, Privacy Policy and Refund Policy live. Sign-up, checkout and the billing portal link to these addresses. Leave them blank to use BLUERABBIT's own pages.</p>

<h2>Custom Labels: White-Labeling Your Instance</h2>
<p>Rename every player-facing section platform-wide: Journey, Item Shop, Backpack, Tabis, Guilds, Garden, Tasks, Journal (My Work), Leaderboard, Posts, Resources, Secrets and Clues, Schedule, Speakers, Wall, Achievements and the Magic Code button. The new names are used across the menus and page headings. Each Adventure can still rename a section for itself in its own settings; a name left blank there uses yours. Combined with per-Adventure currency names (see <a href="/docs/customizing-currencies-ranks-and-rewards">Customizing Currencies, Ranks &amp; Rewards</a>), this is how BLUERABBIT ends up speaking your organization's vocabulary instead of ours.</p>

<h2>Features and Plans</h2>
<p><strong>Features</strong> manages the catalogue of features and what each plan includes. <strong>Plans</strong> lists every plan with how many accounts are on it, each plan's storage allowance (blank for unlimited) and its Stripe price IDs, plus <strong>Create New Plan</strong>, <strong>Role Default Plans</strong> (the plan an account gets when none is assigned) and <strong>Assign Plan to User</strong>. See <a href="/docs/understanding-plans-basic-pro-enterprise">How Plan Tiers Actually Differ</a>.</p>

<h2>Images: Platform-Wide Branding</h2>
<p>The main logo, the login screen's logo and background, the favicon, the default background, the "no Adventure" image, and a default background for each section (Journey, Item Shop, Backpack, Guilds, Schedule, Posts, Resources, Wall, Leaderboard, My Work). Every Adventure uses these unless it sets its own (see <a href="/docs/customizing-taskbar-and-branding">Customizing Your Taskbar &amp; Adventure Branding</a>).</p>

<h2>Email</h2>
<p>The email service (Resend or SendGrid) and its key, the sender name and address (on a domain verified with that service), the site name, and the sender of password-reset emails. The <strong>email design</strong> here (logo, colours, header and footer) is the platform design every email uses unless an Adventure sets its own on its Emails tab. <strong>Send a test email</strong> checks the settings, saved or not, with one real email, and <strong>Recent sends</strong> lists what went out.</p>

<h2>Security and SSO</h2>
<p>Human verification on every signed-out form, sign-in rate limits, upload limits by role, SVG handling and the sign-in log, plus Single Sign-On with Microsoft Entra ID. These have their own page: <a href="/docs/security-and-single-sign-on">Security &amp; Single Sign-On</a>.</p>

<h2>Cooper</h2>
<p>The master switch for Cooper, the in-app AI assistant, across every Adventure, the model Cooper runs on, and the platform's Anthropic API key, used only where an Adventure has no key of its own. <strong>Character</strong> sets the platform default for who Cooper is: a name, a picture, a button icon, a greeting and a personality. Each Adventure can override the character on its own Help &amp; Cooper tab. A personality changes the voice, never the rules: whatever it's called, the assistant still won't hand out answers.</p>
<p><strong>Documentation index</strong>: Cooper answers questions about BLUERABBIT itself from a local copy of these docs. <strong>Sync documentation now</strong> fetches them again (up to 120 pages, about a minute); run it after the docs change.</p>

<h2>Billing</h2>
<p>The Stripe connection behind Subscription &amp; Billing: the publishable key, the secret key and the webhook signing secret (see <a href="/docs/billing-and-plans">Billing &amp; Plans</a>).</p>

<h2>Organizations</h2>
<p>The list of Organizations on the platform, with <strong>New Organization</strong> and an Edit button for each. See <a href="/docs/organizations-managing-multiple-adventures">Organizations</a>.</p>

<h2>Stored Settings</h2>
<p>A housekeeping report. It lists settings stored in the database that no screen uses any more (usually left behind by a retired feature), with where each one lives and why it's there. On a clean platform it simply says everything matches.</p>

<h2>Who Can Access This</h2>
<p>Sys Config is restricted to platform administrators on purpose. If you're an Enterprise customer and don't have access yet, that's a setup step for your account, not something missing from the product. Access levels are managed in <a href="/docs/user-management-and-access-levels">User Management</a>.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/security-and-single-sign-on">Security &amp; Single Sign-On</a></li>
  <li><a href="/docs/user-management-and-access-levels">User Management &amp; Access Levels</a></li>
  <li><a href="/docs/languages-for-your-players">Languages for Your Players</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'How Plan Tiers Actually Differ (Enterprise)',
                'slug'       => 'understanding-plans-basic-pro-enterprise',
                'section'    => 'setup',
                'sort_order' => 58,
                'body'       => <<<'HTML'
<p>Prices and billing mechanics are covered in <a href="/docs/billing-and-plans">Billing &amp; Plans</a>. This page is about what actually changes as you move up a tier.</p>

<h2>Basic to Pro: More Room</h2>
<p>The step up is about capacity, and it's the same three numbers on every plan:</p>
<ul>
  <li><strong>Basic</strong>: up to 90 players across your account, 3 Adventures, 50MB of storage. Free.</li>
  <li><strong>Pro</strong>: up to 250 players across your account, 20 Adventures, 200MB of storage. $8/mo or $80/yr, with a 30-day free trial (card up front, renews until you cancel).</li>
  <li><strong>Enterprise</strong>: no player, Adventure or storage limits.</li>
</ul>
<p>Pro raises all three caps; Enterprise removes them. If you're outgrowing Basic, Pro is a self-serve upgrade from Subscription &amp; Billing in the app. No sales conversation is needed.</p>
<p>Storage is counted per account. See <a href="/docs/billing-and-plans">Billing &amp; Plans</a> for exactly what counts toward it.</p>
<p>Everything you build with is the same on Basic and Pro: the Journey Builder, every step type, Challenges, the Item Shop, Guilds, the Garden, Stats and its segments, custom player data fields, email campaigns, CSV uploads, every language, and Cooper, the A.I. assistant (it runs on a Claude API key you add to your Adventure; see <a href="/docs/setting-up-ai-grading-and-gift-cards">Setting Up AI Grading</a>). Pro gives you more room for it, not a different product.</p>

<h2>Pro to Enterprise: Scale, and a Few Features Only Enterprise Has</h2>
<p>Enterprise is built around running <strong>many Adventures as one managed relationship</strong>, and the setup work that comes with that at real scale. A handful of features exist only on Enterprise. They are not offered on the self-serve platform, on any plan:</p>
<ul>
  <li><a href="/docs/organizations-managing-multiple-adventures">Organizations</a>, to file a client's Adventures and people together</li>
  <li><a href="/docs/prize-draws">Prize Draws</a>: tickets players earn, buy or are given, and the lotteries they enter</li>
  <li><a href="/docs/setting-up-ai-grading-and-gift-cards">Gift-card rewards</a> sent through Tremendous</li>
  <li><a href="/docs/security-and-single-sign-on">Single Sign-On</a> with Microsoft Entra ID, set up with our team</li>
  <li>The Garden's <strong>Business</strong> pane (coins, energy and the crises and opportunities ahead), for Adventures built around <a href="/docs/random-encounters">random encounters</a></li>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform-wide white-label branding</a>, so the whole platform speaks your vocabulary and wears your look</li>
</ul>
<p>Enterprise is <strong>sales-assisted rather than self-serve</strong>. There's no Subscribe button for it, because onboarding usually means setting up Organizations, importing rosters and configuring branding together with our team. <a href="/contact">Reach out</a> if that's where you're headed.</p>

<h2>What This Means for You Right Now</h2>
<p>If you're running a handful of Adventures, Basic or Pro covers you. The moment you're coordinating many Adventures under one paying relationship (multiple departments, cohorts or locations), or you need one of the Enterprise-only features above, that's the real signal to talk to us about Enterprise.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/billing-and-plans">Billing &amp; Plans</a></li>
  <li><a href="/docs/organizations-managing-multiple-adventures">Organizations: Managing Multiple Adventures at Scale</a></li>
  <li><a href="/docs/prize-draws">Prize Draws</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'User Management & Access Levels (Enterprise)',
                'slug'       => 'user-management-and-access-levels',
                'section'    => 'setup',
                'sort_order' => 59,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> <strong>Manage Users</strong> is the platform administrator's view of every account on the platform: who they are, what they can do, what they're paying for, and which Adventures they're in. Only God and Admin accounts can open it.</p>

<h2>Access Levels vs Adventure Roles</h2>
<p>These are two different things, and mixing them up is the most common source of "I gave them access and nothing happened":</p>
<ul>
  <li><strong>An access level</strong> is account-wide and set here. It decides what someone can do on the platform as a whole.</li>
  <li><strong>An Adventure role</strong> (player, GM or NPC) is per Adventure, set on that Adventure's Manage Players screen. It decides what someone can do inside that one Adventure. See <a href="/docs/enrolling-players-and-roles">Enrolling Players &amp; Assigning Roles</a>.</li>
</ul>
<p>One specific case worth knowing: owning an Organization gives full visibility into it, but membership changes (adding players or Adventures, removing Adventures) are admin-only, regardless of role within the Organization. See <a href="/docs/organizations-managing-multiple-adventures">Organizations: Managing Multiple Adventures</a>.</p>
<p>The access levels are:</p>
<ul>
  <li><strong>God</strong>: full platform-wide access, including Sys Config and this page.</li>
  <li><strong>Admin</strong>: the same platform-wide powers as God.</li>
  <li><strong>Staff</strong>: no platform-wide powers, but can be chosen as an Adventure's owner.</li>
  <li><strong>Player</strong>: the standard account. Everything it can reach comes from the Adventures it's enrolled in.</li>
  <li><strong>Guest</strong>: made by <strong>Play now</strong> when a platform lets visitors play without an account. A guest plays the Adventure but can't reach anyone or change the account. Set one to Player to keep it as a real account.</li>
</ul>
<p>There is also a legacy <strong>NPC</strong> tier with no platform-wide powers, kept for older accounts.</p>

<h2>Finding Accounts</h2>
<p>The list is paged and searchable by name, email, nickname or account number. Filter by access level (each chip shows a live count), status and plan, plus a billing filter: has a Stripe customer, a subscription state (active, trialing, past due, canceled) or never subscribed. Sorting and paging keep your filters. <strong>Export CSV</strong> downloads exactly what the current filters show, in cells a spreadsheet won't run as formulas.</p>

<h2>Editing an Account</h2>
<p>Click an account to open its drawer. From there you can:</p>
<ul>
  <li>Edit the <strong>profile</strong>: nickname, display name, first and last name, email, company, country and language, and the <strong>profile picture</strong> (pick or upload one; the trash button puts back the default avatar). An email changed here takes effect at once, with no confirmation email. Save with <strong>Save profile</strong>.</li>
  <li>Change the account's <strong>access level</strong> and <strong>status</strong> (active or suspended).</li>
  <li>Override its <strong>plan</strong>, and see its storage meter, under <strong>Plan &amp; storage</strong>.</li>
  <li><strong>Set a password</strong> directly. It's shown to you in plain text so you can read it back to them, and never emailed: send it over a channel you trust.</li>
  <li>See its <strong>Billing</strong>: plan, status, interval, trial and period end, whether it cancels at period end, earlier subscriptions and every invoice with any refunded amount.</li>
  <li>See its role and standing in each Adventure, with a link to that Adventure's own Manage Players screen, and its recent in-game transactions.</li>
</ul>

<h2>Cancelling and Refunding a Subscription</h2>
<p>The Billing section has two actions, each with a confirmation:</p>
<ul>
  <li><strong>Cancel at period end</strong>: nothing is refunded. The account keeps its plan until the period it has paid for ends, and it doesn't renew.</li>
  <li><strong>Refund unused months and cancel</strong>: the app works out the refund under the <a href="/refunds">Refund Policy</a> and shows it first. The money goes back to the payment that settled the invoice, the subscription ends at once and the account returns to Basic. The subscriber is emailed the amount. A monthly plan has nothing to refund.</li>
</ul>

<h2>Personal Data: Download and Erase</h2>
<p>The drawer's <strong>Personal data</strong> section answers a data request without a database query:</p>
<ul>
  <li><strong>Download personal data</strong>: everything held about the account in one JSON file: profile, Adventures and scores, work and answers, messages, uploads, emails, billing and sign-ins. Never a password or secret code.</li>
  <li><strong>Erase account</strong>: their name, email, picture and profile, their messages, Wall posts, requests, uploads and the text of their answers are erased, and every session ends. Scores, achievements and completions stay under an anonymous name so leaderboards don't change, and invoices are kept. Type their email address to confirm. This cannot be undone.</li>
</ul>
<p>An erase is refused, with the reason, for an administrator account, a Game Master or owner of an Adventure, an Organization's owner (remove the role or hand the Adventure over first), and an account whose subscription still renews (cancel it first). You can't erase your own account here. Players can download and erase their own data from My Account.</p>

<h2>Changes Take Effect Immediately</h2>
<p>A promotion or a suspension applies on the person's <strong>next page load</strong>. They don't need to log out and back in, and a suspended account's open session ends on its next click. Nothing is deleted when you suspend: their progress, purchases and history all stay.</p>

<h2>Safety Rails</h2>
<ul>
  <li>Only a God can grant or remove God, or change a God-level account.</li>
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
                'sort_order' => 60,
                'body'       => <<<'HTML'
<p><strong>Enterprise.</strong> Platform administrators control how people sign in and what can be uploaded, from the <strong>Security</strong> and <strong>SSO</strong> tabs of Sys Config. Single Sign-On is an Enterprise-only feature; the rest of this page also describes the protections every BLUERABBIT account gets on the self-serve platform.</p>

<h2>Passwords</h2>
<p>A password is <strong>12 to 50 characters</strong>, on every path that sets one: sign-up, a reset, a change in My Account, an administrator or GM setting one, and a CSV import. An older, shorter password still signs in until it's next changed.</p>

<h2>Confirming an Email Address</h2>
<p>With <strong>Sign-ups must confirm their email</strong> on (Sys Config, General; on by default), someone who creates an account with the Sign Up form can't sign in until they open the link emailed to them and press its button. The link lasts 24 hours and can be sent again. Accounts made any other way (guests, single sign-on, added by a Game Master or an administrator, imported) count as confirmed already, and a completed password reset confirms too. Turn it off only on a platform that can't send email.</p>

<h2>Human Verification (Cloudflare Turnstile)</h2>
<p>Every form a signed-out person can send is protected by Cloudflare Turnstile, a lightweight check that tells people from bots, usually without asking anyone to solve a puzzle: sign-in, sign-up, <strong>Play now</strong>, password reset, resending the email confirmation and the stop-emails page. It's switched on for the hosted platform. On your own platform, it's configured with a site key and a secret key on the Security tab; the secret is stored encrypted and never shown back.</p>

<h2>Lockouts and Rate Limits</h2>
<p><strong>Five failed sign-ins for one account from one address lock that address out of that account for 15 minutes.</strong> The same account from anywhere else still works, so one person guessing at a password can't lock a colleague out, and a completed password reset ends the lock.</p>
<p>On top of that, the Security tab's <strong>Rate limits</strong> slow down repeated attempts: sign-in attempts per account (every 10 minutes), sign-in attempts per address (every hour; keep it generous, a large team shares one address), password reset requests per email address (every hour) and sign-ups per address (every hour; adding players by spreadsheet isn't affected). Each limit can be tuned, or set to 0 to switch it off.</p>

<h2>The Sign-In Log</h2>
<p>Every sign-in, failed sign-in, lockout, sign-out, password reset and SSO sign-in is recorded with the address and browser it came from, and kept for 12 months. The Security tab shows the last 30 days' count and downloads the log as a CSV for the last 7 days, 30 days, 90 days or 12 months, in cells a spreadsheet won't run as formulas.</p>

<h2>Uploads by Role</h2>
<p><strong>Uploads by role</strong> sets the largest file and the allowed formats for each role: <strong>Players</strong> (everyone else, NPCs included), <strong>Game Masters</strong> (the GMs of the Adventure a file is for) and <strong>Administrators</strong>. There's a size for each kind of file:</p>
<ul>
  <li>pictures and everything else: badges, backgrounds, avatars, audio, slide decks, Office files, archives and player lists (10MB by default);</li>
  <li>video steps and question attachments (50MB by default);</li>
  <li>SCORM packages, for GMs and administrators only (100MB by default). Players never upload course packages.</li>
</ul>
<p>Tick the formats each role may upload (JPG, PNG, GIF, WebP, SVG, MP4, WebM, OGG, MP3, WAV, PDF), or switch uploading off for a role. The picker then shows each person only what their role may send, and the server checks again. <strong>Upload limit: what sets it</strong> explains which ceiling actually wins on your server, since the web server and any proxy in front of it have limits of their own.</p>
<p>These sit alongside each account's plan storage allowance (see <a href="/docs/billing-and-plans">Billing &amp; Plans</a>). SVG images are cleaned as they're uploaded: anything that could run code is stripped. SVG uploads can also be switched off entirely, for every role.</p>

<h2>Single Sign-On with Microsoft Entra ID</h2>
<p>BLUERABBIT supports <strong>SAML Single Sign-On with Microsoft Entra ID</strong> (formerly Azure AD), so your people sign in with their work account instead of a separate password. It's <strong>Enterprise only</strong>, set up per platform together with our team. It's off until then, and while it's off none of the sign-on endpoints exist.</p>
<p>The SSO tab walks through the setup: <strong>Enable SSO</strong> publishes the service-provider details to hand to your identity team; <strong>Fill in from Entra</strong> takes your tenant and application IDs and fills in the identity provider's values and certificate (several certificates can be held during a key rollover); and the <strong>Sign-in button</strong> can be Microsoft's or your organization's, with your own text, logo and colour. <strong>Recent sign-in events</strong> lists what happened, so a failed sign-in can be traced.</p>
<p>Once it's on:</p>
<ul>
  <li><strong>The login page shows a sign-in button</strong> above the password form.</li>
  <li><strong>Accounts are created on first sign-in</strong> from the name and email Entra sends, and land in the default Adventure you pick.</li>
  <li><strong>Accounts are matched on the work identity, not the email address.</strong> An existing account is tied to its Entra identity only when its email is on one of your <strong>Organization email domains</strong>; <strong>Link existing accounts</strong> does that in advance (preview it first), so people keep their progress. An account on any other domain is never handed to an Entra identity by its email, and an account already linked to a different identity is refused, never guessed.</li>
  <li><strong>Suspended accounts stay out.</strong> Suspending someone in User Management blocks their sign-on too, and doesn't create them a fresh account.</li>
</ul>

<h3>Enforcing SSO</h3>
<p>You can require Single Sign-On, which hides the password form for everyone. Enforcement only takes effect once the Entra details are actually filled in, so switching it on early can't lock anyone out. Once it's enforced, everyone on your organization's domains, administrators included, signs in through Entra. <strong>The break-glass is an administrator account off those domains</strong>: <strong>Who keeps a password</strong> lists them and the address they sign in at, so an outage at the identity provider never leaves the platform without an administrator. Keep exactly one, with a strong password. With no domains saved, every administrator keeps a password.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/user-management-and-access-levels">User Management &amp; Access Levels</a></li>
  <li><a href="/docs/platform-settings-and-white-label-branding">Platform Settings &amp; White-Label Branding</a></li>
  <li><a href="/docs/your-account-profile-and-privacy">Your Account: Profile, Security &amp; Privacy</a></li>
</ul>
HTML,
            ],
            // ---------------------------------------------------------
            // Developer docs — gated to site admins/collaborators
            // ---------------------------------------------------------
            [
                'title'      => 'Start Here: bluerabbit.io for Developers',
                'slug'       => 'start-here',
                'section'    => 'developer',
                'sort_order' => 0,
                'body'       => <<<'HTML'
<p>This page is for the developer helping launch BLUERABBIT to the public. It is the one place to start: what this site is, how to run it, how its documentation maps to the app, how to deploy it, and what is still open before launch. Everything here can be checked from this repository and the running site, without the app's repository.</p>
<p><strong>As of 15 November 2026.</strong> The public documentation matches the BLUERABBIT app at its commit <code>463a356</code> (15 November 2026). Each sync, with what changed and how it was checked, is recorded in <code>claude-notes/BUILD-STATUS.md</code>.</p>

<h2>What This Site Is</h2>
<p>bluerabbit.io is the public website: the marketing pages (home, product, solutions, pricing, contact), the blog, the documentation, the legal pages in eleven languages, and the waitlist. It is its own CodeIgniter 4 application with its own database and its own sign-in.</p>
<ul>
  <li><strong>It is not the BLUERABBIT app.</strong> The app (where adventures, players and subscriptions live) runs at play.bluerabbit.io, from a separate repository, with separate accounts. Every "Log in", "Get started" and pricing button on this site links there through one constant, <code>PLAY_APP_URL</code> in <code>app/Config/Constants.php</code>.</li>
  <li><strong>The two never share sign-in.</strong> Accounts on this site exist only for the people who manage its blog and documentation. Keep it that way: it is a hard rule of this repository.</li>
  <li><strong>Nothing is sold here.</strong> The pricing page links to account creation; billing happens inside the app.</li>
</ul>

<h2>How It Is Built</h2>
<ul>
  <li>CodeIgniter 4.7 on PHP 8.2, MySQL, plain PHP views (<code>extend()</code> / <code>section()</code> on <code>app/Views/layouts/main.php</code>), one stylesheet (<code>public/assets/css/site.css</code>), no JavaScript framework and no build step.</li>
  <li>The blog and the documentation live in the database. Blog posts are written in <code>/admin/blog</code>. The documentation is written in <code>app/Database/Seeds/DocsPageSeeder.php</code> and loaded with <code>php spark db:seed DocsPageSeeder</code>.</li>
  <li>Email goes through Resend, forms are protected by CSRF and Cloudflare Turnstile, and the only cookies are the essential ones (the cookie panel records the visitor's choice; there is no analytics).</li>
</ul>
<p>Details: <a href="/docs/developer/architecture-overview">Website Architecture</a> and <a href="/docs/developer/routes-and-api-reference">Website Routes &amp; Admin</a>.</p>

<h2>Running It Locally</h2>
<ol>
  <li>Clone the repository into your web root (on Windows with XAMPP: <code>C:\xampp\htdocs\website</code>) and run <code>composer install</code>.</li>
  <li>Copy <code>env</code> to <code>.env</code>. Without a virtual host the site is browsed at <code>http://localhost/website/public/</code>, and <code>app.baseURL</code> must say exactly that, <code>/public/</code> included, or every stylesheet and link points one folder too high.</li>
  <li>Create the database <code>bluerabbit_site</code> (MySQL, the credentials in <code>.env</code>).</li>
  <li><code>php spark migrate --all</code>, then <code>php spark db:seed DatabaseSeeder</code>: the admin account, three sample blog posts and every documentation page. The old blog's 61 posts are a separate, optional import (<code>wp-import/README.md</code>).</li>
  <li>Open the site. Turnstile and email stay off until their keys are set, which is the safe default.</li>
</ol>
<p><strong>Reading this section needs an admin account on this site.</strong> The seeder creates one (see <code>AdminUserSeeder</code>; change its password on any server). To give a collaborator their own: register at <code>/get-started</code>, then set <code>role = 'admin'</code> on their row in the <code>users</code> table; the site has no screen for promoting accounts.</p>

<h2>How the Docs Map to the App</h2>
<ul>
  <li><strong>For players</strong> (section <code>user</code>): what a player sees and does in an adventure.</li>
  <li><strong>For Game Masters</strong> (section <code>setup</code>): building and running adventures, the staff screens, billing and the platform settings.</li>
  <li><strong>Enterprise</strong> (a <code>setup</code> page whose title ends "(Enterprise)", grouped on its own on the hub): the features only a corporate server has. See <a href="/docs/developer/app-architecture-editions-and-switches">editions</a>.</li>
  <li><strong>Developer</strong> (this section, admins only): this site, and the app in general terms.</li>
</ul>
<p>The public pages describe what a person gets who signs up at play.bluerabbit.io and creates an adventure: the public edition, with the app's own rules and extras on. The app's own reference (its <code>docs/claude/</code> folder and dated logs) is the authority on how the app works; these pages are written from it and from its code. How to bring them up to date: <a href="/docs/developer/keeping-the-docs-in-sync">Keeping the Docs in Step with the App</a>.</p>
<p><strong>The app reads these docs.</strong> Its Cooper assistant answers questions about BLUERABBIT from its own copy of <code>bluerabbit.io/docs</code>: it follows every <code>/docs/</code> link on the hub (up to 120 pages). After a documentation deploy, an administrator of the app presses <em>Sync documentation now</em> in its Sys Config, Cooper tab.</p>

<h2>The Legal Pages</h2>
<ul>
  <li><code>/terms</code>, <code>/privacy</code> and <code>/refunds</code> are the only copies: the app answers its own <code>/terms</code>, <code>/privacy</code> and <code>/refunds</code> with a permanent redirect to the addresses in its Sys Config, Legal pane (default <code>https://bluerabbit.io/terms</code> and so on). This site must answer at those addresses.</li>
  <li>The app records the Terms version each person agrees to at sign-up and checkout. When the Terms change in substance, bump <code>App\Libraries\Legal::VERSION</code> here and the app's own <code>Legal::VERSION</code> together (both <code>2026-10-30</code>).</li>
  <li>The business named on them (legal name, address, contact email, governing law) comes from <em>Admin &rarr; Settings &rarr; Legal</em>. Blank fields print neutral wording, so the pages work before they are filled in.</li>
  <li><strong>Translations</strong>: German, Spanish, French, Italian, Japanese, Korean, Brazilian Portuguese, Russian, Turkish and Simplified Chinese, at <code>/de/terms</code>, <code>/es/privacy</code> and so on, with a language strip on every legal page. <code>/terms?lang=es_MX</code> (the app's own locale names work) forwards to the translation, so the app can send its player's language. <strong>Every translation was made by an AI and has not been reviewed by a lawyer or a native speaker</strong>; each one says so above its text and links the English, the reference. Gauden approved publishing them before that review (15 November 2026). A lawyer's review of the English is planned for January 2027. Notes for the reviewers, and how to hold a language back: <code>claude-notes/LEGAL-TRANSLATIONS.md</code>.</li>
</ul>

<h2>Deploying</h2>
<p>The server holds a Git checkout of this repository, outside the web root, with the domain's document root on its <code>public/</code> folder. A deploy:</p>
<ol>
  <li>cPanel &rarr; Git Version Control &rarr; this repository &rarr; <strong>Update from Remote</strong> (a pull from GitHub).</li>
  <li>In cPanel's Terminal, from the checkout: <code>php spark migrate</code> when a new migration arrived (<code>php spark migrate:status</code> lists them); <code>php spark db:seed DocsPageSeeder</code> when documentation changed (it upserts by slug, safe to re-run); <code>composer install --no-dev -o</code> only when <code>composer.lock</code> changed; then <code>php spark cache:clear</code>.</li>
  <li>Check the pages you changed, then the app's <em>Sync documentation now</em> if the docs changed.</li>
</ol>
<p>A push to GitHub is not a deploy: nothing reaches a server until someone presses Update from Remote. The full runbook, including moving the site to the apex domain, the production <code>.env</code> and Cloudflare, is <code>claude-notes/DEPLOY.md</code>. The app deploys the same way: <a href="/docs/developer/self-hosting-and-deployment">Self-Hosting &amp; Deployment</a>.</p>

<h2>What Is Open for Launch</h2>
<ol>
  <li><strong>The legal business details</strong> (<em>Admin &rarr; Settings &rarr; Legal</em> on the server) are blank: Gauden fills them in himself.</li>
  <li><strong>The translated legal pages go live with the next deploy.</strong> Gauden approved publishing them before review on 15 November 2026; each page tells its reader it is an unreviewed A.I. translation and links the English. The legal and native review is still to follow.</li>
  <li><strong>The apex domain.</strong> The app's legal links point at <code>bluerabbit.io</code>. If the apex still serves the old site, this site's cutover from its subdomain (<code>claude-notes/DEPLOY.md</code>, Part 2) comes first.</li>
  <li><strong>Waitlist or sign-up.</strong> The header and the product page still ask visitors to join the waitlist, while pricing links straight to the app. When public sign-up opens, those calls to action change.</li>
  <li><strong>The home page's waitlist form and Turnstile.</strong> The form in the hero no longer draws the Turnstile widget (removed in commit <code>bce6e98</code>), but <code>Waitlist::store()</code> still asks Turnstile. Wherever both keys are set, every signup from the home page is refused with "We couldn't verify that you're human". Check the server, then either put <code>view('partials/turnstile_widget', ['action' =&gt; 'waitlist'])</code> back in the form, or decide the waitlist goes without it.</li>
  <li><strong>Server basics</strong>: the seeded admin password changed; <code>CI_ENVIRONMENT = production</code>; both Turnstile keys set and the secret verified (<code>DEPLOY.md</code>, Part 3); the Resend key in <em>Admin &rarr; Settings</em>; HSTS on at Cloudflare.</li>
  <li><strong>Pricing</strong>: the page states Basic 90 players, 3 Adventures, 50MB and Pro 250, 20, 200MB at $8 a month or $80 a year. The app enforces only the storage limit today; the player and Adventure numbers are plan allowances. The Stripe prices are set in the app.</li>
  <li><strong>Client logos</strong> for the home page's trust bar are still generic labels.</li>
  <li><strong>Open questions</strong> from the latest sync (facts to confirm, wording to approve) are listed in <code>claude-notes/BUILD-STATUS.md</code>, entry of 15 November 2026.</li>
</ol>

<h2>Read Next</h2>
<ul>
  <li><a href="/docs/developer/architecture-overview">Website Architecture</a></li>
  <li><a href="/docs/developer/routes-and-api-reference">Website Routes &amp; Admin</a></li>
  <li><a href="/docs/developer/keeping-the-docs-in-sync">Keeping the Docs in Step with the App</a></li>
  <li><a href="/docs/developer/app-architecture-editions-and-switches">The BLUERABBIT App: Architecture, Editions &amp; Switches</a></li>
  <li><a href="/docs/developer/self-hosting-and-deployment">Self-Hosting &amp; Deployment (the app)</a></li>
  <li><a href="/docs/developer/security-model">Security Model: App &amp; Website</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Website Architecture',
                'slug'       => 'architecture-overview',
                'section'    => 'developer',
                'sort_order' => 1,
                'body'       => <<<'HTML'
<p>How bluerabbit.io is put together. It is a standalone CodeIgniter 4 application: its own database, its own sign-in, its own deploy. The BLUERABBIT app is a different application in a different repository; see <a href="/docs/developer/app-architecture-editions-and-switches">The BLUERABBIT App</a>.</p>

<h2>Stack</h2>
<ul>
  <li>CodeIgniter 4.7 (<code>codeigniter4/framework ^4.7</code>), PHP 8.2 or later with <code>intl</code>, MySQL or MariaDB.</li>
  <li>No front-end framework and no build step. All styling is <code>public/assets/css/site.css</code>, built on CSS custom properties (<code>:root</code> tokens); the angular HUD card is the reusable <code>.panel</code> class. JavaScript is small and inline where a page needs it (the cookie panel, Turnstile, the admin's TinyMCE editor).</li>
  <li>Composer brings only the framework (and PHPUnit and friends for development).</li>
</ul>

<h2>Where Things Live</h2>
<ul>
  <li><code>app/Config/Routes.php</code>: every route, flat. See <a href="/docs/developer/routes-and-api-reference">Website Routes &amp; Admin</a>.</li>
  <li><code>app/Controllers/</code>: <code>Home</code>, <code>Pages</code> (product, solutions, pricing, contact, the AI-at-work FAQ and the legal pages), <code>Blog</code>, <code>Docs</code>, <code>Auth</code>, <code>Account</code>, <code>Waitlist</code>, and <code>Admin/*</code> (dashboard, blog, docs, waitlist, settings, image upload).</li>
  <li><code>app/Views/</code>: <code>layouts/main.php</code> (header, footer, cookie panel) and <code>layouts/admin.php</code> on top of it; <code>pages/</code>, <code>blog/</code>, <code>docs/</code>, <code>auth/</code>, <code>admin/</code>, <code>emails/</code> (the branded email frame), <code>errors/</code> (styled 404, 400 and 500 pages) and <code>partials/</code>.</li>
  <li><code>app/Libraries/</code>: <code>Legal</code> (the legal pages' business details, languages and addresses), <code>ResendMailer</code> (email through Resend's HTTP API, no SDK), <code>Turnstile</code> (server-side verification).</li>
  <li><code>app/Language/</code>: <code>en/Validation.php</code>, and <code>{code}/Legal.php</code> for the legal pages' interface words in each of the eleven languages.</li>
  <li><code>app/Database/</code>: seven migrations (one table each) and the seeders.</li>
  <li><code>claude-notes/</code>: the build log (<code>BUILD-STATUS.md</code>), the deploy runbook (<code>DEPLOY.md</code>) and open content questions. <code>CLAUDE.md</code> and <code>WEBSITE_PROJECT_BRIEF.md</code> at the root hold the rules and the decisions behind them.</li>
</ul>

<h2>Database</h2>
<ul>
  <li><code>blog_posts</code>: posts, drafts and published, with featured images under <code>public/assets/uploads/blog/</code>.</li>
  <li><code>docs_pages</code>: every documentation page (title, slug, section <code>user</code>, <code>setup</code> or <code>developer</code>, sort order, HTML body, status).</li>
  <li><code>waitlist_signups</code>: email, source page, subscribed or unsubscribed, when last emailed. Append-only on purpose, so a future customer table can join it.</li>
  <li><code>contact_messages</code>: the contact form.</li>
  <li><code>users</code> and <code>password_resets</code>: this site's own accounts (roles <code>user</code> and <code>admin</code>).</li>
  <li><code>site_settings</code>: key and value pairs set in <em>Admin &rarr; Settings</em>: the Resend key and sender, and the four legal details.</li>
</ul>

<h2>Content</h2>
<ul>
  <li><strong>Blog</strong>: written in <code>/admin/blog</code> with a rich-text editor; the database is the source.</li>
  <li><strong>Documentation</strong>: <code>DocsPageSeeder.php</code> is the source. It upserts by slug, and deletes the slugs it has retired. A page the seeder owns can be edited in <code>/admin/docs</code>, but the next <code>db:seed DocsPageSeeder</code> overwrites that edit, so change the seeder instead. Bodies are trusted HTML written by admins.</li>
  <li><strong>The hub</strong> (<code>/docs</code>) lists the <code>user</code> pages, then the <code>setup</code> pages, and puts every <code>setup</code> page whose title ends "(Enterprise)" in its own group. Sort order decides the order within each.</li>
  <li><strong>Marketing pages</strong> are views in <code>app/Views/pages/</code>, written by hand from the app's real plans and features.</li>
</ul>

<h2>Sign-in</h2>
<p>Session-based, on the <code>users</code> table. <code>AuthFilter</code> is registered as <code>auth</code> (any signed-in account, for <code>/account</code>) and <code>auth:admin</code> (role <code>admin</code>, for <code>/admin/*</code> and <code>/docs/developer</code>). Password recovery sends a one-time link by email; the token travels in the query string. Nothing on the public pages links to this sign-in: admins type <code>/login</code>. It shares nothing with the app's accounts, by rule.</p>

<h2>Email</h2>
<p><code>ResendMailer</code> wraps every message in <code>emails/layout.php</code> (logo, body, footer with an unsubscribe link). The key and the sender address are set in <em>Admin &rarr; Settings</em>, not in code. Sending is best-effort: a waitlist signup succeeds even when no key is set. <code>/admin/waitlist</code> sends a campaign to everyone subscribed.</p>

<h2>The Legal Pages and Their Languages</h2>
<ul>
  <li>English: <code>pages/terms.php</code>, <code>privacy.php</code>, <code>refunds.php</code>. Translations: <code>pages/legal/{code}/*.php</code>, drawn inside <code>pages/legal/page.php</code>, which adds the machine-translation notice and the version line.</li>
  <li><code>App\Libraries\Legal::LANGUAGES</code> lists the languages (address code and HTML language tag); <code>Routes.php</code> builds the translated routes from it. A new language is a row there, its <code>app/Language/{code}/Legal.php</code> and its three views.</li>
  <li>Every legal page shows the three documents and the eleven languages; the layout adds <code>&lt;link rel="alternate" hreflang&gt;</code> for each.</li>
  <li>The privacy policy covers both the app and this site: Part 1 the app, Part 2 this site. If the site starts collecting something new, Part 2 changes with it, in every language.</li>
</ul>

<h2>Conventions That Have Bitten Before</h2>
<ul>
  <li>Disable a model's timestamp field with <code>''</code>, never <code>false</code>.</li>
  <li>Never name a model method <code>get()</code> or <code>set()</code>: the base model owns them.</li>
  <li>An <code>is_unique[table.field,id,{id}]</code> rule needs its own <code>id</code> rule too.</li>
  <li>Generated values (tokens, email addresses) go in the query string, not a path segment: the router decodes the address before checking its characters.</li>
  <li>The global <code>nav{}</code> style hits every <code>&lt;nav&gt;</code>; in-page navigation uses <code>&lt;div role="navigation"&gt;</code>.</li>
  <li>There are no automated tests for the site's own code. Verify on the running site: every touched route answers 200, forms write what they should, and a real browser shows the page right at desktop and phone widths.</li>
</ul>
HTML,
            ],
            [
                'title'      => 'Website Routes & Admin',
                'slug'       => 'routes-and-api-reference',
                'section'    => 'developer',
                'sort_order' => 2,
                'body'       => <<<'HTML'
<p>Every route is declared, flat, in <code>app/Config/Routes.php</code>. There is no JSON API: every action is a server-rendered page or an ordinary form POST, protected by the CSRF filter that runs on every request.</p>

<h2>Public Pages</h2>
<ul>
  <li><code>/</code>: home, with the waitlist form in the hero.</li>
  <li><code>/product</code>, <code>/solutions</code>, <code>/pricing</code>, <code>/contact</code> (GET and POST), <code>/resources/ai-at-work</code>.</li>
  <li><code>/blog</code> and <code>/blog/{slug}</code>.</li>
  <li><code>/docs</code> (the hub) and <code>/docs/{slug}</code> (any <code>user</code> or <code>setup</code> page; a <code>developer</code> slug answers 404 here).</li>
  <li><code>/waitlist</code> (POST) and <code>/unsubscribe?email=</code>.</li>
</ul>

<h2>Legal Pages</h2>
<ul>
  <li><code>/terms</code>, <code>/privacy</code>, <code>/refunds</code>: the English originals.</li>
  <li><code>/{code}/terms</code>, <code>/{code}/privacy</code>, <code>/{code}/refunds</code> for <code>de</code>, <code>es</code>, <code>fr</code>, <code>it</code>, <code>ja</code>, <code>ko</code>, <code>pt-br</code>, <code>ru</code>, <code>tr</code>, <code>zh-cn</code>. Any other code is a 404.</li>
  <li><code>/terms?lang=</code> (and the same on the other two) forwards to the translation. It accepts this site's codes and the app's locale names (<code>es_MX</code>, <code>pt_BR</code>, <code>zh_CN</code>, <code>ko_KR</code>, ...); an unknown language stays on the English. This is the one hook the app needs to send its player's language.</li>
</ul>

<h2>This Site's Own Sign-in</h2>
<ul>
  <li><code>/login</code> (GET, POST), <code>/logout</code>.</li>
  <li><code>/get-started</code> (GET, POST): registers an account with the role <code>user</code>. Not linked from any public page.</li>
  <li><code>/forgot-password</code> and <code>/reset-password?token=</code> (GET, POST).</li>
  <li><code>/account</code>: any signed-in account (filter <code>auth</code>).</li>
</ul>

<h2>Gated to Admins (filter <code>auth:admin</code>)</h2>
<ul>
  <li><code>/docs/developer</code> and <code>/docs/developer/{slug}</code>: this section. Signed out, it redirects to <code>/login</code>; signed in without the admin role, it is refused.</li>
  <li><code>/admin</code>: the dashboard (posts, docs, signups, new messages).</li>
  <li><code>/admin/blog</code>: list, new, edit, publish, delete; <code>/admin/upload-image</code> for the editor's images (the stored type comes from the file's real content, never from its name).</li>
  <li><code>/admin/docs</code>: the same for documentation pages (remember the seeder overwrites the pages it owns).</li>
  <li><code>/admin/waitlist</code>: the list and the campaign send.</li>
  <li><code>/admin/settings</code>: the Resend key and sender, and the Legal details (business name, address, contact email, governing law).</li>
</ul>

<h2>Forms and Their Protection</h2>
<ul>
  <li>Every POST carries a CSRF token (<code>csrf_field()</code> in each form).</li>
  <li>The forms a signed-out visitor can send (waitlist, contact, login, register, forgot password) are checked by Cloudflare Turnstile when both keys are in <code>.env</code>. With neither key the widget is not drawn and nothing is checked: the safe default for a local copy.</li>
</ul>

<h2>Links Into the App</h2>
<p>Every link to the BLUERABBIT app goes through <code>PLAY_APP_URL</code> (<code>app/Config/Constants.php</code>, <code>https://play.bluerabbit.io</code>). If the app moves, that line is the only change. The legal pages also link the app's Subscription and My Account pages under it.</p>
HTML,
            ],
            [
                'title'      => 'Keeping the Docs in Step with the App',
                'slug'       => 'keeping-the-docs-in-sync',
                'section'    => 'developer',
                'sort_order' => 3,
                'body'       => <<<'HTML'
<p>The public documentation describes the BLUERABBIT app, which changes every week. This page is how the two are kept in step: where the pages come from, what they describe, and how a sync is done and checked.</p>

<h2>Where the Pages Come From</h2>
<ul>
  <li><code>app/Database/Seeds/DocsPageSeeder.php</code> holds every page the site ships: title, slug, section, sort order and body. Running <code>php spark db:seed DocsPageSeeder</code> upserts each page by slug (safe to re-run) and deletes the slugs listed as retired at the top of the file.</li>
  <li>A seeded page edited in <code>/admin/docs</code> is overwritten the next time the seeder runs. Change the seeder, or take the page out of it first.</li>
  <li>The seeder's header names the app commit it was last synced to. Each sync also has its own entry in <code>claude-notes/BUILD-STATUS.md</code>: what changed, what was checked, what is still a question.</li>
</ul>

<h2>What the Pages Describe</h2>
<ul>
  <li>What a person gets who signs up on the public server and creates an adventure: the public edition, with the app's own rules and its extras on (see <a href="/docs/developer/app-architecture-editions-and-switches">editions and switches</a>). Behaviour that exists only for adventures imported from the WordPress build is left out.</li>
  <li>Corporate-only features are Enterprise: a whole page gets a title ending "(Enterprise)", which puts it in the hub's Enterprise group; a mention inside another page says plainly that it is an Enterprise feature.</li>
  <li>Only shipped behaviour, checked in the app's code rather than its plans. A sentence that exists only because of a known app bug is listed in <code>claude-notes/BLUE-FINDINGS-FROM-DOCS-SYNC-2026-09-21.md</code> (or the latest sync's entry) and comes out when the fix lands.</li>
  <li>The app's real labels, in English. Currency names (XP, BLOO, EP) are defaults a Game Master can rename, never presented as fixed.</li>
</ul>

<h2>What Never Goes on a Public Page</h2>
<ul>
  <li>Client names or real people (the running example "Launch Week" is fictional and fine).</li>
  <li>The app's internals: file paths, class names, batch or ledger ids, the WordPress build, the import and its tooling.</li>
  <li>Secrets, server names and private subdomains.</li>
</ul>
<p>The developer section (this one) may describe architecture, editions, switches, deployment and security in general terms, still without secrets, server credentials or client data.</p>

<h2>Doing a Sync</h2>
<ol>
  <li>Find the app commits since the last sync point (<code>git log --oneline &lt;last&gt;..origin/main</code> in the app's repository), and read the app's dated log entries for the same period (its <code>docs/claude/log/INDEX.md</code>). Most batches that only port WordPress's behaviour behind the switches change nothing for the public pages.</li>
  <li>For each page, check every claim against the app's code and correct, add or remove. New pages get a slug and a sort order next to their topic.</li>
  <li>Check: <code>php -l</code> on the seeder; seed twice (the second run adds nothing); every page answers 200 with its title; every <code>/docs/</code> link in every body resolves to a published slug; no forbidden word on a public page; one look in a real browser.</li>
  <li>Record the sync in <code>claude-notes/BUILD-STATUS.md</code> with the app commit, update the seeder's header, commit and push.</li>
  <li>Deploy (Update from Remote, then <code>php spark db:seed DocsPageSeeder</code>), then ask an app administrator to press <em>Sync documentation now</em> so Cooper reads the new pages.</li>
</ol>

<h2>Sync History</h2>
<ul>
  <li>21 September 2026: app <code>6e5a454</code>, 59 pages to 76.</li>
  <li>27 October 2026: app <code>dbb5c05</code>, 77 pages. The app's history was rewritten on 30 October 2026, so that hash no longer resolves; by date it sits at the app's <code>0dfb3a8</code>.</li>
  <li>15 November 2026: app <code>463a356</code>. Every public page reviewed; new player pages (guests, notifications, challenges, the Library, languages), new Game Master pages (the Library, languages, CSV bulk tools, Prize Draws for Enterprise), and this developer section rewritten.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/developer/start-here">Start Here</a></li>
  <li><a href="/docs/developer/architecture-overview">Website Architecture</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'The BLUERABBIT App: Architecture, Editions & Switches',
                'slug'       => 'app-architecture-editions-and-switches',
                'section'    => 'developer',
                'sort_order' => 4,
                'body'       => <<<'HTML'
<p>The BLUERABBIT app, in general terms: enough to understand what the public documentation describes, what a server's settings decide, and where the app's own reference lives. The app is a separate repository; its <code>docs/claude/INDEX.md</code> is the authority whenever this page and the app disagree.</p>

<h2>What It Is</h2>
<ul>
  <li>A CodeIgniter 4.7 application on PHP 8.2 and MySQL or MariaDB (tables prefixed <code>br_</code>), served at play.bluerabbit.io and on a few corporate servers. Each server is a full checkout with its own <code>.env</code> and its own database.</li>
  <li>It is the successor of the original BLUERABBIT, a WordPress theme. Adventures can be imported from a WordPress install, and the app can run an imported adventure exactly as the WordPress build did (see the switches below).</li>
  <li>Billing is Stripe (Basic free; Pro monthly or yearly with a 30-day trial that takes a card up front; the refund rule in the Terms). The A.I. features (Cooper, the assistant, and the A.I. review of answers) call Anthropic's Claude with an adventure's own key, or else the platform-wide key in Sys Config. Cooper is on every plan and works wherever a key is set; for clients BLUERABBIT runs directly, Gauden adds the key. Email goes through Resend. Bots are kept out of every signed-out form by Cloudflare Turnstile.</li>
</ul>

<h2>How a Request Is Handled</h2>
<ul>
  <li><strong>Pages</strong> are ordinary routes. A filter refuses every route that is not listed as public until the person is signed in, and a second filter refuses the corporate-only pages on a public server.</li>
  <li><strong>Actions</strong> (saving, grading, buying, answering) go through one AJAX dispatcher with a fixed table of actions. An action a player or a non-player character may use must be on that role's allowed list, and every write checks that the person may edit what they name. Anything not listed is refused.</li>
  <li><strong>Templates and cohorts.</strong> An adventure can be a template with cohorts: the content (milestones, steps, achievements, items, skills, Tabis, encounters, profiles) lives on the template, and each cohort keeps its own players, progress, guilds, tasks and missions.</li>
</ul>

<h2>Editions: Public and Corporate</h2>
<p>One codebase, no branches per client. Each server is <strong>public</strong> or <strong>corporate</strong>, set by one <code>.env</code> line (<code>bluerabbit.edition = corporate</code>; unset means public, so a forgotten line fails closed). A public server refuses the corporate-only features on the server itself, not only in the screens:</p>
<ul>
  <li>Prize Draws (the lottery), Tremendous gift cards, Microsoft Entra single sign-on, Organizations, the Garden's Business pane, and white-label branding.</li>
</ul>
<p>The website presents these as <strong>Enterprise</strong>: the pricing page's Enterprise card and the documentation pages whose title ends "(Enterprise)". Corporate clients with a big enough account run on their own environment; the public product does not share it. The app's Sys Config names the edition a server is running.</p>

<h2>The Per-Adventure Switches</h2>
<p>Two switches decide how an adventure behaves. Each is a setting on the template (a cohort follows its template), with a server-wide default in <code>.env</code> for adventures that have no setting and for the pages outside any adventure.</p>
<ul>
  <li><strong>This app's extras</strong> (Adventure Settings, Rules &amp; scoring): everything this app shows players that the WordPress build never did (tries shown up front, "Read it again", milestone attempts, the Garden's extra tools, My Account's extra tabs, the Library and more). On for every adventure created in the app; an imported adventure starts with it off, so its players see no difference. Server default: <code>bluerabbit.extrasDefault</code> (on unless set).</li>
  <li><strong>WordPress's rules</strong> (administrators only): which way scores, counts, levels, ranks, challenges, codes and enrolment are worked out. Off for the app's own adventures; on for imported ones, so their numbers come out exactly as before. Server default: <code>bluerabbit.wpRulesDefault</code> (off unless set).</li>
</ul>
<p><strong>The public documentation describes extras on and WordPress's rules off</strong>: what someone gets who signs up on the public server and creates an adventure.</p>

<h2>Other Server-Wide Settings Worth Knowing</h2>
<ul>
  <li><strong>The view nobody chose</strong>: the app has two ways to get around, the New view (a pause-screen menu) and the Classic view (top bar and taskbar). A player's own choice wins, then the adventure's setting, then <code>bluerabbit.menuDefault</code> (New unless set).</li>
  <li><strong>Rehearsal mode</strong>: a database that is a copy of real people's data (imported with the rehearsal mark, or any WordPress import without an explicit <code>bluerabbit.rehearsal = off</code>) holds every email, stops the prize draws, gift cards, payments, analytics and A.I., and shows a banner on every page. It exists so a copy can never reach real people. A real server built from an import needs <code>bluerabbit.rehearsal = off</code>; servers the app built itself have no import mark and are unaffected.</li>
  <li><strong>Languages</strong>: the interface is in English and ten more languages (German, Spanish, French, Italian, Japanese, Korean, Brazilian Portuguese, Russian, Turkish, Simplified Chinese). A person's own language wins, else the platform's default (Sys Config). Emails stay in English for now.</li>
  <li><strong>Time</strong>: on an adventure that runs on WordPress's rules, every time the app records is on that adventure's own clock, as WordPress wrote it; the app's own adventures keep the app's conventions.</li>
</ul>

<h2>Features That Touch the Website</h2>
<ul>
  <li><strong>Legal pages</strong>: the app redirects its <code>/terms</code>, <code>/privacy</code> and <code>/refunds</code> to the addresses in Sys Config, Legal (default: this site), and records the Terms version each person accepts.</li>
  <li><strong>Cooper's documentation</strong>: Cooper answers "how do I" questions from its own copy of <code>bluerabbit.io/docs</code>, refreshed from Sys Config, Cooper, <em>Sync documentation now</em>.</li>
  <li><strong>Play now</strong>: play.bluerabbit.io runs an open demo (Sys Config's Play now setting): visitors play a chosen Adventure as a guest, a throwaway account kept for statistics. Guests can play but cannot talk to anyone, change an account or create content.</li>
</ul>

<h2>Notifications, in One Paragraph</h2>
<p>The bell counts only what the platform did that needs the person's attention: a Game Master's mark or validation (with what it paid), a hand-in sent back, a reply to or the closing of one of their requests, an email sent to them. Their own activity is listed but never counted. It is a read model over tables the app already writes; nothing is copied, and "read" is stored as the last item seen, not as a time.</p>

<h2>Performance</h2>
<p>Every page and the heaviest actions were timed at the volume of the largest programme the platform runs (November 2026): none over one second after the fixes. The one server requirement it produced: the database's buffer pool must hold the whole database with room to spare. The app's <code>tools/server-check.php</code> checks this, among its other lines.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/developer/self-hosting-and-deployment">Self-Hosting &amp; Deployment</a></li>
  <li><a href="/docs/developer/security-model">Security Model: App &amp; Website</a></li>
  <li><a href="/docs/developer/keeping-the-docs-in-sync">Keeping the Docs in Step with the App</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Self-Hosting & Deployment',
                'slug'       => 'self-hosting-and-deployment',
                'section'    => 'developer',
                'sort_order' => 5,
                'body'       => <<<'HTML'
<p>How a BLUERABBIT app server is installed and updated, and the rule that keeps environments from drifting. This describes the app (its own repository), not this website; the website's deploy is on <a href="/docs/developer/start-here">Start Here</a>. The app's own <code>docs/claude/deployment.md</code> and <code>launch-runbook.md</code> are the authority if the two ever disagree.</p>

<h2>The Rule: Structure Travels, Content Doesn't</h2>
<p>Only the <strong>schema</strong> (tables, columns, indexes) is kept in step between environments. <strong>Content</strong> (Adventures, milestones, steps, achievements, skills, encounters, tasks, items, profiles, players) belongs to the environment it was made in and stays there. A local test Adventure is a local test Adventure forever.</p>
<ul>
  <li>Don't build sync tooling, export/import pipelines or "push content to live" features.</li>
  <li>If a report on live data is needed, download the live database and work on that snapshot.</li>
</ul>

<h2>Fresh Install: <code>/install</code></h2>
<p>A new clone builds its own database through the web installer:</p>
<ol>
  <li>Clone the repository, point the web server's document root at <code>public/</code>, and run <code>composer install --no-dev --optimize-autoloader</code>.</li>
  <li>Open the site. Every page redirects to <code>/install</code> until the platform has its first account.</li>
  <li>If the database already connects, the installer skips straight to creating the owner account. If the server is reachable but the database is missing, it creates the database where the MySQL account is allowed to, and otherwise tells you where to create it.</li>
  <li>It builds the full schema and creates the owner account as <strong>God</strong> (only a God can grant God, so an installer that made an Admin would leave nobody able to make the next one).</li>
</ol>
<p>The installer <strong>merges</strong> the few <code>.env</code> keys it needs rather than replacing the file, and reuses an existing <code>encryption.key</code>. If <code>.env</code> isn't writable, it shows the file for you to paste and stops there. "Installed" means the players table has a row, not merely that tables exist; once an account exists, <code>/install</code> redirects to the login page. The installer deliberately doesn't configure Turnstile, SSO or email: those are set afterwards in Sys Config.</p>

<h2>Updating a Server</h2>
<p>The servers are cPanel accounts with a Git checkout per instance. An update:</p>
<ol>
  <li>cPanel &rarr; Git Version Control &rarr; the instance &rarr; <strong>Update from Remote</strong>.</li>
  <li>Straight after, in the Terminal, from the folder that contains <code>public/</code>: <code>php tools/migrate.php</code> (a dry run that lists what is pending and writes nothing), then <code>php tools/migrate.php --apply</code> if it listed anything. Since November 2026 the new code reads new columns, so the migration must not wait.</li>
  <li><code>php tools/server-check.php</code>: read-only, one PASS / WARN / FAIL line per check (PHP and its extensions, folders, <code>.env</code>, the database, the edition, rehearsal mode, the network, the database's memory), each with what to do when it is not PASS. It never prints a secret.</li>
</ol>
<p>Only if a feature ships optional starting content is there another step: a per-Adventure seeder the operator runs deliberately, for example <code>php tools/seed-&lt;thing&gt;.php --adventure=N --apply</code>. Every <code>tools/</code> script prints the database name and host it connected to before it does anything; read it before an <code>--apply</code> on production. <code>tools/</code> sits outside <code>public/</code>, so none of these scripts can be reached by URL.</p>

<h2>A Push Is Not a Deploy</h2>
<p>Pushing to <code>main</code> puts code on GitHub and on <strong>no server</strong>. Automatic deploys are parked. Never report work as "deployed" because it was pushed.</p>

<h2>Before Deploying the November 2026 Release</h2>
<p>A database that was ever imported from WordPress counts as a <strong>rehearsal copy</strong> unless its <code>.env</code> says <code>bluerabbit.rehearsal = off</code>: it then sends no email, runs no prize draws and calls no A.I. Before updating such a server, add that line (the import leaves a <code>wp-import</code> row in <code>br_data_migrations</code>; <code>server-check</code>'s <code>rehearsal.mode</code> line confirms it either way). Servers the app built itself are not affected.</p>

<h2>The Production <code>.env</code></h2>
<ul>
  <li><code>CI_ENVIRONMENT = production</code> (it also turns off the debug toolbar, which lists every route), <code>app.baseURL</code>, <code>app.forceGlobalSecureRequests = true</code>, <code>cookie.secure = true</code> (on by default in production since October 2026), and the database lines.</li>
  <li><strong>The edition</strong>: only a corporate server sets <code>bluerabbit.edition = corporate</code>, before the deploy that needs it. A public server leaves it unset.</li>
  <li><strong>The switches</strong>: a public server leaves <code>bluerabbit.menuDefault</code>, <code>bluerabbit.extrasDefault</code> and <code>bluerabbit.wpRulesDefault</code> unset (New view, extras on, the app's own rules). Only a server taking over a WordPress install sets them to WordPress's answers. See <a href="/docs/developer/app-architecture-editions-and-switches">editions and switches</a>.</li>
  <li><code>.env</code> is gitignored and never part of a deploy; keep it readable by the web server only.</li>
</ul>

<h2>The Encryption Key</h2>
<p>Every stored secret (the email provider key, Stripe's secret and webhook keys, the Turnstile secret, the SSO private key, Tremendous and Claude keys) is encrypted under <code>encryption.key</code>. <strong>Never regenerate that key on a database that already holds secrets</strong>, and carry it across when a database moves between servers: a new key leaves every stored secret decrypting to nothing, silently, and email, Cooper, Turnstile, SSO and gift cards simply stop. A server built from a WordPress import is the one exception: it makes its key once, before the first import, and keeps it from then on.</p>

<h2>Files Git Doesn't Own</h2>
<p><code>.env</code>, <code>writable/</code> and the upload folders (media, QR codes, SCORM) are all gitignored, so updating the code never touches what users uploaded or the server's credentials. Keep it that way.</p>

<h2>Production Checklist</h2>
<ul>
  <li>The document root is <code>public/</code> and <code>tools/</code> sits outside it on every instance. The repository's own <code>.htaccess</code> refuses everything outside <code>public/</code> as a backstop, not a substitute.</li>
  <li>Cloudflare in front with SSL/TLS on Full (strict); HSTS switched on at Cloudflare (the app cannot send it from behind the proxy); the origin firewalled so only Cloudflare's address ranges can reach it.</li>
  <li><code>php tools/check-production.php https://host --save</code> from outside after every launch or <code>.env</code> change: the HTTPS redirect, HSTS, the hardening headers, the cookie flags and the edition, as the world sees them.</li>
  <li><code>composer audit</code>, then a sign-in, an email send and one purchase.</li>
</ul>

<h2>Related</h2>
<ul>
  <li><a href="/docs/developer/app-architecture-editions-and-switches">The BLUERABBIT App: Architecture, Editions &amp; Switches</a></li>
  <li><a href="/docs/developer/security-model">Security Model: App &amp; Website</a></li>
  <li><a href="/docs/developer/start-here">Start Here</a></li>
</ul>
HTML,
            ],
            [
                'title'      => 'Security Model: App & Website',
                'slug'       => 'security-model',
                'section'    => 'developer',
                'sort_order' => 6,
                'body'       => <<<'HTML'
<p>How the app and this website protect their users, in general terms. No keys, no server details and no open findings are written here; the app's repository keeps the detailed review.</p>

<h2>Two Systems, Two Sets of Accounts</h2>
<p>The app and this website share no sign-in, session or user table, by rule. An account on this site exists only to manage its blog and documentation; it cannot reach the app, and an app account cannot reach this site's admin.</p>

<h2>The App</h2>
<h3>Who may do what</h3>
<ul>
  <li><strong>Protected by default.</strong> Every page needs a signed-in account unless it is on the public list. Every action goes through one dispatcher with a fixed table; an action a player or a non-player character may take must be on that role's allowed list, and every write checks that the person may edit the adventure, cohort or row they name.</li>
  <li><strong>Editions are enforced on the server.</strong> A public server refuses the corporate-only features in the dispatcher, in a page filter and at each feature's own entry point, for every account, administrators included.</li>
  <li><strong>Guests</strong> of an open demo can play but are refused every person-to-person tool, every account change and all content creation.</li>
</ul>
<h3>Signing in</h3>
<ul>
  <li>Passwords of 12 to 50 characters on every path that sets one, stored as one-way hashes.</li>
  <li>Five failed sign-ins in fifteen minutes for one account from one address lock that pair for fifteen minutes; a completed password reset clears it. The address comes only from Cloudflare's own header, so it cannot be forged.</li>
  <li>Every sign-in, failure, lock-out and reset is logged with its address and browser, downloadable by administrators, and deleted after twelve months.</li>
  <li>Public sign-ups confirm their email address through a button on a page (not a bare link, which corporate mail filters open by themselves). Every form a signed-out person can send is checked by Cloudflare Turnstile.</li>
  <li>Entra single sign-on, on corporate servers, keeps a password route for the platform's top administrators so an identity-provider outage never locks everyone out.</li>
</ul>
<h3>Data</h3>
<ul>
  <li><strong>Secrets at rest</strong> (email, payment, Turnstile, SSO, gift-card and A.I. keys) are encrypted under the server's encryption key.</li>
  <li><strong>Personal data</strong>: each person can download everything held about them as one file, and delete their account, which anonymises their identity everywhere, deletes their messages and uploads, and keeps their scores under an anonymous name so leaderboards stay correct. Administrators can do the same for someone.</li>
  <li><strong>Uploads</strong>: size ceilings per role; SCORM packages are unpacked without anything a server could run; SVG images are cleaned; a file's stored type never comes from its name.</li>
  <li><strong>Exports</strong>: every CSV cell that a spreadsheet could read as a formula is neutralised.</li>
  <li><strong>Payments and webhooks</strong>: Stripe holds the cards; incoming webhooks are verified before anything is stored.</li>
  <li><strong>Copies of real data</strong> run in rehearsal mode, which holds every email and stops every outside call (see <a href="/docs/developer/app-architecture-editions-and-switches">the app's architecture</a>).</li>
</ul>
<h3>Reviews</h3>
<p>In November 2026 the whole range of the app's recent work was reviewed as an attacker would: no critical findings, four high-severity findings (all fixed and proven with real requests), one more found and fixed afterwards, and a list of medium and low items tracked in the app's repository. Ask Gauden for the current state of that list before launch.</p>

<h2>This Website</h2>
<ul>
  <li>CSRF tokens on every form, checked by a global filter.</li>
  <li>Cloudflare Turnstile on the forms a signed-out visitor sends, when both keys are set; a wrong secret is logged as critical, because it would refuse every form.</li>
  <li>Passwords hashed; password resets by a single-use link valid for 60 minutes, of which only a hash is stored, with the same answer for known and unknown addresses.</li>
  <li>Admin image uploads store the type detected from the file's content, never the name it arrived with.</li>
  <li>No analytics, no advertising cookies, no third-party trackers; the cookie panel records the visitor's choice and asks again after twelve months.</li>
  <li>Secrets live in the server's <code>.env</code> (database, Turnstile) or in <em>Admin &rarr; Settings</em> (Resend), never in the repository. The document root is <code>public/</code>; the repository's <code>.htaccess</code> refuses everything else if a server is ever set up on the repository's root instead.</li>
</ul>

<h2>Reporting a Problem</h2>
<p>Send security reports through the <a href="/contact">contact page</a> marked "Security", or to Gauden directly. Don't post details in a public channel.</p>

<h2>Related</h2>
<ul>
  <li><a href="/docs/developer/self-hosting-and-deployment">Self-Hosting &amp; Deployment</a></li>
  <li><a href="/docs/developer/architecture-overview">Website Architecture</a></li>
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
