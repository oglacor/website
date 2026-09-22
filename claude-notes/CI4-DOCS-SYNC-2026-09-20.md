# Docs sync brief: bring `docs_pages` up to the CI4 app as of 2026-09-20

Written 2026-09-20 from the `blue` repo (CI4 app) session, at Bernardo's request, for the
next `website` session to act on. The website docs were last synced to the app around
**2026-08-17** (Quests became Milestones, Tasks vs Missions). Since then `blue` has had
**270 commits**. Many existing pages now describe things that were removed or changed, and
several major features have no page at all.

**Your job:** update `app/Database/Seeds/DocsPageSeeder.php` (and the few marketing
pages listed in section 6) so the docs match what actually ships. This file tells you
**what** changed and **where to verify it**. The prose, the seeder conventions and the
verification are yours.

**Snapshot:** `blue` at commit `741da91` (2026-09-20). If `git log` in `blue` shows newer
commits, read their messages before writing about the same area.

---

## 1. Ground rules for this pass

Most of these are already in your own `CLAUDE.md` or `BUILD-STATUS.md`. They are repeated
here because this pass touches almost every page.

1. **Only document what ships.** Check the dated entries in `C:\xampp\htdocs\blue\CLAUDE.md`
   and the code paths cited below. Where this brief says "flag", ask Bernardo; don't write
   around it.
2. **Retired slugs go into the seeder's delete list** (the `whereIn('slug', [...])->delete()`
   block at the top), exactly as the 2026-08-17 pass did. Otherwise a re-seed leaves stale
   rows live.
3. **`sort_order` must stay unique within each section.** New pages will push later ones
   down. Check the result in the database, not just in the source.
4. **The seeder is LF; `app/Views/**` is CRLF.** Normalise before any multi-line
   find-and-replace (see the gotcha in `BUILD-STATUS.md`).
5. **Enterprise pages** stay in `section = 'setup'` with the title ending in the literal
   ` (Enterprise)`. That suffix is what `Docs::index()` splits on.
6. **No numbers you can't source.** Pricing is flagged in section 7 for exactly this reason.
7. **Every internal `/docs/...` link must resolve**. Run the same programmatic check the
   earlier passes used.
8. **Deploy reminder:** docs live in the database, so going live is
   `git pull` then `php spark db:seed DocsPageSeeder`.

---

## 2. The headline changes (each one touches several pages)

| # | What changed | Pages affected |
|---|---|---|
| H1 | **28 step types in 6 groups**, not 23 in 5. New: a **Profile** group (Weighted Options, Agree/Disagree Scale, Profile Result), plus **Jump to Step** and **Encounter Choice** under Flow. Choose Avatar is now authorable. | overview, completing-milestones, step library, quick reference, how-to-build-a-milestone, product page |
| H2 | **Templates share content live.** A child adventure *reads* the template's milestones, steps, challenges, achievements, items, posts. Editing the template changes every running cohort immediately. Progress, guilds, tasks and Garden missions belong to each child. The existing page says the opposite. | adventure-templates-and-cohorts, gm-toolkit, building-your-first-adventure |
| H3 | **BLOO can no longer buy past a deadline or an unlock.** Deadline Cost and Unlock Cost were removed on 2026-08-30 (they had no working purchase path). | xp-bloo-ep, designing-milestones, journey-map (node states) |
| H4 | **The economy got a setback mechanic.** BLOO can go **negative** (debt), but only through an Encounter Choice a GM authored. The Item Shop still refuses to sell to a player who can't afford it. **XP can go down**: it now has a signed ledger, so a setback can cost a level. EP cannot go below zero. | xp-bloo-ep, random-encounters, item shop pages |
| H5 | **Energy (EP) is its own switch.** The feature toggle is now "Energy Points (EP)" (`use_energy`). Switching it off removes EP from every screen. EP is spent on encounter choices and restored by Garden Tasks, which can now pay EP. "Objectives" no longer exist. | xp-bloo-ep, settings reference, tasks |
| H6 | **NPC is a read-only supervisor role.** An NPC sees everything a GM sees, plays the adventure like a player, and can change nothing, with one exception: appointing a guild leader. It is not "a character in the story". | enrolling-players-and-roles, managing-your-player-roster |
| H7 | **The Hexad quiz is gone.** It was replaced by **Profile Tests**, which are authorable content inside an adventure (see N8). Results live in the player's Journal (Profiles tab), not on My Account. | your-account, my-work, overview |
| H8 | **Retired outright:** Sponsors, the Adventure Report PDF, demo-adventure self-reset, the intro splash ("Adventure Intro"), the Certificate Settings panel, the Cooper slug quick link, Bulk Create, Objectives, the "Blocked" node state. | see section 3 |
| H9 | **Random Encounters were rebuilt from scratch.** Encounters are now card draws with a real economy, not EP-gated pop-up quizzes. | random-encounters (rewrite), plus new pages |
| H10 | **A Conditions engine** now decides auto-grants and eligibility across the app (achievements, certificates, tasks, encounter groups, evolving Tabi scenes). | achievements, branching, tasks, certificates |

---

## 3. Existing pages: what is now wrong

Grouped by section. "Source" points at where to verify in `blue`. CLAUDE.md section
headings are quoted so you can search for them.

### User section

**`product-platform-overview`**
- "23 reusable Step types" becomes 28 (H1). Worth one line each on the Garden, Encounters
  and Profile Tests, since they are now the biggest differentiators.

**`getting-started`**
- The role list (`player`, `gm`, `admin`, `npc`) mixes two things. Per-adventure roles
  are player / gm / npc (plus the owner). Admin and god are **account-wide access levels**,
  set in User Management (N15). Rewrite NPC per H6.
- "Basic… 200 players and 3 Adventures" is wrong. Basic is **90 players and 3 adventures**
  (confirmed, section 7).
- New and worth a line: players choose where they **start**, the Journey or the Garden
  (a switch in the menu's Adventure Navigation header, remembered per adventure). A first
  visit asks once.

**`xp-bloo-ep-explained`**
- Remove "use BLOO to unlock a milestone early instead of waiting on a prerequisite" (H3).
- "XP only ever goes up" is false now (H4).
- The EP section needs rewriting (H5). EP no longer gates the encounter draw. It is spent
  on the choice a player makes inside an encounter, and every encounter must offer at least
  one free option, so running dry is a setback rather than a game over.
- Add debt: BLOO can go negative through an encounter choice, and a GM can author a message
  that fires when it does (Consequences, N6).
- Source: "The Random Encounters engine, rebuilt from scratch (2026-08-30, LaunchPad)",
  "XP got a ledger". Also the product rule in memory: *BLOO can go negative, EP is the floor.*

**`journey-map-guide`**
- Node states: remove **Blocked**. Blockers were dropped from the product on 2026-06-30.
- **Map widgets are much richer now.** A GM can place a status panel, journey progress, a
  leaderboard, guild standings, tasks, messages, help requests, achievements and a backpack
  panel, plus nav links, text labels, graphics and a single task drawn as a hexagon
  (see N2).
- New for players:
  - **Map / List view.** A list view groups every milestone under its chapter, and the
    last view you used is remembered.
  - A zoom control with a live percentage.
  - **Depth.** The map has four layers that move at different speeds as you pan (parallax).
  - Tabi chapters open with a **progress bar toward their badge**.
  - **Evolving Tabis:** a chapter's artwork can change as *you* progress (N1).
- Source: "The Journey gets the Garden's zoom, and the List view…", "Journey planes, part
  1-5" (git log), "Evolving Tabis — the scene engine".

**`completing-milestones-and-steps`**
- "Four families" becomes six groups (H1).
- New player-facing behaviour:
  - **Attempt limits.** A GM can cap how many tries a step allows.
  - **Every milestone ends on a win or fail screen**, even if the GM didn't author one.
  - **Failing a milestone clears your answers for that milestone** so you can retry it;
    your other progress and earned rewards stay.
  - **Backpack steps** now ask you to pick the right item off a scrolling rack, rather than
    confirming an item you already hold.
- QR quick-complete still bypasses gating by design (`QuestController::scanQR`, verified
  2026-09-20). QR codes are now **per cohort**, carrying the adventure in the URL.
- Source: "Step navigation v2", "The step system (the ask)" in the 2026-08-30 WP sync
  entry, "The rack (WP adf8295 + 1800cfa)".

**`achievements-and-guilds`**
- The achievements page was rebuilt: a showcase row (your latest badge or rank, and your
  certificate), then grids for **Badges / Paths / Ranks**. Click one to open its detail.
  Players choose which badge represents them (the display badge).
- Guilds: any player can open **any guild's roster** in their adventure. Guilds can have an
  appointed **leader**. The Wall has **one** Guilds tab with a picker, not one tab per guild.
- Guild standings are still a **sum** of members' XP (`GuildModel`, verified), but they now
  exclude GMs and NPCs.
- Source: "Achievements rebuilt: one card component", "Guild rosters open to peers",
  "One Guilds tab, not one per guild".

**`item-shop-and-backpack`**
- Item types: **five**, not three. Consumable, Key, Reward, **Tabi Piece** (collected into a
  chapter's collage) and **Gift Card** (a real emailed gift card, when the adventure has
  Tremendous connected).
- Buying now asks for confirmation and ends on a celebration panel. A gift-card purchase
  says a second email is coming from the rewards partner.
- Only staff can return an item; a player's Use button works (fixed 2026-09-14).
- Source: "Item Shop — Phase 1/2/3", "Every celebration now comes from one partial",
  git log "Backpack: the Use button works".

**`your-account-profile-and-privacy`**
- Remove the **Hexad quiz** section (H7).
- My Account tabs are now **Profile, Security, Billing, Transactions, Danger Zone**:
  - **Security** holds change password, and change email with a confirmation link sent to
    the new address.
  - **Billing** holds subscription status, a Manage billing button and billing history.
  - **Transactions** is in-game purchase history across adventures.
  - **Danger Zone** holds Anonymize Me (only if the platform enables it) and a new
    **Delete Account**, which asks for your password and a typed confirmation.
- Source: "My Account page built (new, 2026-07-19)", "HEXAD retired".

**`my-work-journal-and-history`**
- Tabs are now **Overview, Quests, Challenges, Profiles**, under a Journey Progress panel
  (verified in `app/Views/player/journal.php`). There is no "My Answers" or "Achievements"
  tab any more.
- Overview is the full personal stats dashboard: engagement, XP history chart, completion by
  type.
- **Remove "Reset (Demo Adventures Only)".** Demo mode was removed. Its replacement is a
  staff-only per-milestone reset (see gm-toolkit).
- Source: "Third fix batch… the player dashboard nobody could reach", git log
  "Replace the demo-adventure wipe with a per-milestone reset".

**`getting-help-support-and-chat`**
- "Contact Admin" became a **Deadline extension request** form (with a required date).
  Other support is pointed at Microsoft Teams (confirm with Bernardo whether that line is
  client-specific).
- **Cooper runs inside the app.** Remove any mention of configuring a support-chat slug.
- **Guided tours:** a "?" help button appears on any screen that has a tour (22 of them,
  including the Garden, Tasks, the Journey Builder and each Manage Content tab). Seen-state
  is per player, not per adventure.
- Source: git log "Rebuild the two player-facing overlays", "Tutorials: WP's tour system".

**`certificates-and-secrets-and-clues`**
- Rewrite the certificate half (N7 covers the GM side). A certificate is now content an
  adventure carries. There can be several; each unlocks by its own conditions and is either
  open from the start or locked until those conditions are met. When a certificate is
  locked, the player sees what's missing, for example "Reach level 9, you're at level 5".
  There are guild certificates too. It prints on a fixed, print-safe layout.
- The old "Certificate of Participation with the GM's signature from settings" is gone.
- Secrets and Clues is unchanged.

**Garden pages** (`the-garden-overview`, `skills-and-blooms-explained`,
`giving-blooms-endorsements-and-gifts`, `help-requests-and-messages`, `garden-tasks`,
`garden-missions`)
- **Connections (friending).** Players can mark who matters: send a request, which the other
  person accepts or dismisses, and either side can disconnect. A connection sits in the
  innermost ring with a halo. This is the only signal on the canvas a player *states*;
  everything else is derived.
- **The garden's backdrop reflects your skill standing** against the adventure average
  (5 states). Staleness now runs over **60 days**.
- **Rewards are claimed.** Mission completions, solved help requests and GM awards arrive
  as notifications in a Rewards bell, and the Blooms land when you click Claim. Endorsements
  and gifts are still instant.
- **Help board:** several people can reply to a request, and the asker approves any that
  helped (each approved helper earns Blooms). The first approval closes the request to new
  replies. Replies not acted on close automatically 24h later. A "Ways to help" panel shows
  open requests in *your* strongest skill.
- **Asking for help** pays 1 Bloom, once per skill per day (F30, 2026-09-14).
- **Panels:** everything is minimised to a dock at the bottom right, and each panel can be
  dragged. On a first visit the Missions panel opens if there are missions. DMs and rewards
  open as modals.
- **Missions have audiences:** everyone, specific guilds, named players, holders of an
  achievement, or a branch.
- **Tasks:**
  - can be gated by **Conditions**
  - can carry a personal countdown ("5 days from when *you* start")
  - can pay **EP**
  - have a colour, icon and image
  - can sit on the Journey map as a hexagon
  - a QR-reset task's code can be hidden from players or regenerated
- Source: "Friending (the Garden)", "The Garden — Missions, claim-gated Notifications…",
  "Help Requests become real multi-helper…", "Tasks can be gated by Conditions" (git log),
  "Skills and tasks get a look" (git log), "Journey: place a single task as a hexagon".

### Setup (GM) section

**`setting-up-your-organization`**
- Organizations are created by a platform admin (`new-org`). Plan limits change (section 7):
  Basic 90/3, Pro 250/20, Enterprise unlimited.

**`building-your-first-adventure`**
- Add the **template library** ("From a Template" on My Adventures now works).
- Point placement at the **Journey Builder palette** (N2) and chapter authoring at the
  **Tabi editor** (N3).

**`enrolling-players-and-roles`**
- Roles per H6. Admin and god are account-wide (User Management, N15).
- Adding players:
  - search existing accounts by name or email and add them one at a time, or
  - use the **streaming CSV import**, which handles 1,000+ rows, retries safely, and has a
    Guild column that creates or joins a guild by name.
  - There is also **bulk guild assignment by CSV** into guilds that already exist.
- Source: "Streaming player CSV import", "Every bulk import is batched now".

**`adventure-templates-and-cohorts`**: **rewrite** (H2).
- Content is authored once on the template, and children read it live.
- Guilds, tasks and Garden missions are per cohort. Use the Duplicator to copy them into a
  new child.
- QR codes and magic links resolve to the right cohort.
- For an **independent** copy that doesn't track the template, use Duplicate on Manage
  Adventures.
- Source: git log "Templates: content on the template, progress and guilds on the child",
  "Per-child QR codes, the template library…", "Duplicator: copy guilds and missions".

**`billing-and-plans`**
- The subscription page is **Subscription & Billing** (URL `/subscription`), distinct from
  My Account.
- Plans at a Glance: Basic 90 players and 3 adventures; Pro 250 and 20; Enterprise no
  limits (section 7). The price and trial lines are still unconfirmed. Otherwise accurate.

**`stats-dashboard-guide`**: substantial expansion.
- The Stats page now has:
  - drill-downs for achievements and item purchases
  - **time in app**, from real heartbeats plus a clearly labelled estimate
  - **engagement by segment** (any Player Meta field)
  - encounter choices, split per option with cost
  - **profile cohort results**
  - **Cooper usage**
- The **Milestone Funnel** is its own page, filterable by Tabi or level.
- **Activity logs** moved off the Wall to their own page (N13).

**`designing-milestones-rewards-and-unlocks`**
- **Delete "Paying to Skip the Wait"** (H3).
- **Autoload now works**, with a defined priority. An unresolved encounter comes first, then
  a freshly dealt hand, then autoload. A milestone the player can't play yet is skipped, so
  autoload never traps anyone.
- Rewards and gating moved into **drawers** in the builder. Milestones can award a
  **Skill** (Blooms). Statuses include **hidden** (live, waiting on a code or branch).
- Locked and hidden milestones **count toward chapter completion**; only drafts don't.
- Grading: scale is none / percentage / letters. Rewards can land immediately or
  **after grading**, and that is now enforced for challenges too (fixed 2026-09-13).
- Source: "Finish the journey lock resolver: autoload" (git log), "Count locked and hidden
  milestones" (git log).

**`how-to-build-a-milestone-step-by-step`**
- Steps open in a side **drawer**.
- The builder has **View** and **Review** links.
- Dialogue steps can pick a **speaker from the cast** instead of retyping a character (N11).

**`full-step-library-choosing-the-right-step`** and **`step-type-quick-reference`**
- 28 types (H1). Add:
  - **Jump to Step:** GM-drawn buttons that route to another step.
  - **Encounter Choice:** priced options that spend money and energy (see N5).
  - The three **Profile** skins (see N8).
- Existing types that changed:
  - **Choose Avatar:** the GM now defines the avatars.
  - **Backpack:** now a rack puzzle.
  - **Open Text:** the AI rubric is a private reviewer context plus a per-step strictness
    (lenient / standard / strict).
  - **Case Study:** every attempt is kept and reviewable.
  - **SCORM:** SCORM **1.2** only.
- On attempt-limited types, mention the **max attempts** setting.
- Mention that every milestone guarantees a win and a fail ending.
- The builder still labels one step "Survey Choice". Open question A2 in
  `CONTENT-QUESTIONS.md` still stands.

**`achievements-paths-and-ranks-reward-ladder`**
- Achievements can **auto-grant from Conditions** (N4).
- Ranks come from the adventure's **rank ladder** on Adventure Settings and auto-award on
  level. A manual rank grant is refused below the rank's level.
- Magic codes: a single code and unique one-time codes, a **QR per cohort**, and "show all
  links" for bulk distribution.
- Branch mutual exclusivity is enforced on **every** grant path (a player can never hold two
  achievements from one branch).

**`guilds-designing-team-play`**
- Guild leader (appointed; an NPC may appoint one), open rosters, bulk CSV assignment, bulk
  status actions.
- Averages exclude staff.

**`item-shop-building-an-economy`**
- Five item types (see item-shop-and-backpack).
- A GM can **assign/buy an item on a player's behalf**.
- Stock and caps are race-safe (two players can't both buy the last one).
- Gift cards via Tremendous.

**`branching-and-prerequisites-non-linear-adventures`**
- Add Conditions as the general tool for "unlock when X is true" (N4).

**`random-encounters`**: **rewrite from scratch** (H9). See N5 for the full model. The
current page (EP-gated pop-up quizzes) describes nothing that exists.

**`qr-codes-live-and-hybrid-events`**
- Still bypasses gating by design.
- QR codes are per cohort now.
- Mention **task QR codes** (hide from the app so players must find the printed one, and
  regenerate if a photo leaks).

**`grading-and-ai-assisted-feedback`** and **`reviewing-and-grading-submissions-in-bulk`**
- **AI review** (N10) replaces "manual Validate with A.I.":
  - the same private rubric and strictness are used for the player's instant check and the
    GM's second opinion
  - **Validate All** with a cost estimate, a lock and resume
  - nothing applied on doubt
  - a cohort summary including how often a human **overruled** it
- **CSV round-trip is real now.** The export *is* the import template (grade,
  validation_status, comment). Untouched rows don't count as changes.
- GMs can leave **written feedback** the player sees. Review tables sort and resize.

**`announcements-keeping-an-adventure-alive`**
- Wall channels are **Public, Guilds (one tab with a picker), System (GM only), Messages
  (DMs)**. Activity logs moved off the Wall.

**`worked-example-two-week-onboarding-adventure`** and **`meet-launch-week-example-adventure`**
- Check both for retired features (paying past deadlines, sponsors).
- Consider threading one new feature into the example (an encounter, a certificate, or a
  profile test).

**`challenges-concept`** and **`how-to-build-a-challenge`**
- Add:
  - **Per-question explanations**, shown only for questions the player got right, so a
    retry isn't handed the answers.
  - An **end-of-attempt review pass** instead of a results screen.
  - Attempt cost, max attempts and grading are **enforced server-side**.
- The answer key is never sent to the player.

**`event-schedule-concept`** and **`how-to-build-an-event-schedule`**
- **Remove Sponsors** entirely (retired 2026-08-25).
- Speakers now also drive **dialogue** (N11), and have a Manage Content tab.
- The session detail opens as a modal.

**`scorm-packages-concept`** and **`how-to-add-a-scorm-package`**
- **SCORM 1.2 only.** Remove "or SCORM 2004". The runtime adapter is 1.2
  (`public/assets/js/br-scorm.js`).

**`email-campaigns-to-players-concept`** and **`how-to-send-an-email-campaign`**
- The merge tags are **`{{name}}`, `{{adventure_name}}`, `{{site_name}}`**. The page
  currently says `{{player_name}}` and `{{adventure_title}}`, which don't exist (verified in
  `app/Libraries/Mailer.php`).
- Audience is **all enrolled players or a hand-picked set** (searchable avatar grid). There is
  no "hasn't logged in recently" audience and no test-send; there is a **preview**.
- Sending is **batched and resumable**: 10 at a time, a live progress bar, Resume after a
  closed tab, and Retry failed without resending to anyone who already got it.
- Source: "Bulk email delivery is now resumable and guaranteed".

**`complete-adventure-settings-reference`**
- Settings now use a **left rail**, not a horizontal tab strip.
- **Adventure Intro** became **Cooper Context**. Players never see it; it's Cooper's
  knowledge base. Say so.
- **Remove Certificate Settings** (retired 2026-09-09). Start/End dates moved to General.
- Reset Settings: remove "reset seen-the-intro".
- The Features list now has 20 toggles. The list is in `blue`'s `br_features`; notable
  renames are Energy Points (EP) and Item Shop.
- "Default Journey View" now sets a first visit's Map/List default.

**`customizing-currencies-ranks-and-rewards`**: mostly fine. Check the rank wording
against the rank-ladder note above.

**`managing-your-player-roster`**
- **Player Meta is a per-adventure field catalogue** a GM defines, not nine fixed columns.
  Fields can be segmentable (Stats) and, separately, opted in to show on the
  **leaderboard**. The CSV round-trips.
- Removing a player is a two-click inline confirm.

**`setting-up-ai-grading-and-gift-cards`**
- The Claude key is stored **encrypted**.
- Tremendous:
  - a funding source and campaign dropdown
  - gift cards choose their card source by **campaign** (the adventure default, a per-item
    campaign, or specific products)
  - a pre-flight check refuses a card that can't send before any BLOO is spent
  - an **order log** page
- Source: "Gift cards: campaign first, catalogue as the escape hatch".

**`customizing-taskbar-and-branding`**
- Remove the Cooper slug.
- **Flag:** the bottom taskbar has been redesigned more than once this month. Confirm its
  current state in the app before describing it.

**`gm-toolkit-duplicator-reports-and-bulk-actions`**
- The Duplicator now covers milestones (with all steps and challenge questions),
  achievements, Tabis, items, encounters, speakers, **tasks, guilds and missions**.
- **Remove the Adventure Report PDF** (retired 2026-09-08; Stats covers it).
- **Remove Bulk Create** (no such route in `blue`).
- Add:
  - **whole-adventure duplication**
  - the **per-milestone reset** (staff: clears one player's run of one milestone, with a
    preview of exactly what it removes)
  - Manage Content's shared search and filters on every tab

**`managing-player-support-requests`**
- Cards, search, status filters, an admin note.
- Requests are now mostly deadline extensions.

**`organizations-managing-multiple-adventures` (Enterprise)**: **overclaims**.
- In `blue`, an organization has **General / Players / Adventures** tabs, and an adventure
  belongs to exactly one org.
- The **Stats tab (cross-adventure analytics) is not built.** Neither is Bulk Add from
  Adventure, nor org-level CSV import.
- Rewrite to what exists, or flag it as coming. Source: "Organizations, 2026-08-30
  (second pass)".

**`platform-settings-and-white-label-branding` (Enterprise)**
- **Remove the Sponsors directory.**
- Custom Labels are genuinely wired now.
- Sys Config also has these tabs: **Security** (Turnstile, upload size limits, SVG
  cleaning, login/reset/register rate limits), **SSO** (SAML with Microsoft Entra ID),
  **Email**, **Billing** and **Cooper**. There is also a **Stored Settings** drift report.
- See N15 and N16.

**`understanding-plans-basic-pro-enterprise` (Enterprise)**
- Rewrite the Basic-to-Pro section with the confirmed caps (section 7). The rest of the
  page's framing (Enterprise is sales-assisted and Organizations-centred) still holds.

**`setting-up-your-skills-catalog`**
- Skills now have a colour picker, an icon picker and an image.
- The skill catalogue lives on the template and is shared by its cohorts.

**`personalising-text-with-player-tokens`**
- Still accurate. Add that the rich-text editor has an **Insert token** button that lists
  what the adventure actually offers, including its profile fields.

**`running-the-garden-as-a-gm`**
- Add:
  - **Bulk Bloom awards** (by guild, by individuals, or by a Player Meta field),
    claim-gated
  - Mission audiences
  - GM skill grants
- The mission rule list in the builder is now: Send a message, Help someone, Endorse
  someone, Ask for help, Get a request solved, Gift a Bloom, Post on the Wall, Make a
  connection (verified in `partials/mission-manager-row.php`). **Endorse and Gift are both
  offered, against Bernardo's 2026-08-17 ruling. Flag** (section 7).
- "Reconnection" is still not a rule.

---

## 4. Retired slugs and sections to remove

No existing page is wholly retired, so the delete list doesn't grow unless you rename
slugs. These **sections inside pages** must go:

- Hexad quiz
- Sponsors (schedule and platform pages)
- Adventure Report PDF
- Demo reset
- Paying BLOO to skip deadlines or unlocks
- "Blocked" node state
- Adventure Intro as a player-facing message
- Certificate Settings
- Cooper slug
- Bulk Create
- Objectives
- SCORM 2004
- The wrong email merge tags
- Org cross-adventure stats (unless flagged as coming)

If you rename `random-encounters` (reasonable, given it's a full rewrite), add the old
slug to the delete list.

---

## 5. New pages to add

Suggested slug in brackets; U = user section, S = setup.

- **N1. Evolving Tabis and the Scene Builder** [S `evolving-tabis-scene-builder`], plus a
  short player mention in journey-map-guide.
  - A Tabi's artwork is composed of **rows** (each measures one condition, such as level or
    Blooms in a skill) and **stages** (a value plus artwork). The highest stage the viewing
    player has reached is drawn.
  - "Grow gradually" fills a stage between thresholds.
  - Artwork is composed **inside the Tabi's frame** on a builder that shows the rest of the
    journey as placeholders.
  - Source: "Evolving Tabis — the scene engine", "Evolving scenes are composed INSIDE the
    Tabi's frame", "Scene Builder shows the journey".
- **N2. The Journey Builder: designing the map** [S `journey-builder-design-palette`].
  - The palette of placeable things: graphics, text labels (three fonts), nav links,
    widgets (status, progress, leaderboard, guilds, tasks, messages, help, achievements,
    backpack), and single task hexagons. Each shows only its own options.
  - Widgets are drawn at real size, with an adjustable height and list length.
  - Stacking order, rotation, and a Tabi lock.
  - **Depth planes:** Deep / Back / Base / Front move at different speeds as players pan,
    and only Base is clickable. Per-object blur. A "working layer" ghosts the others while
    you edit.
  - Source: "The Journey Builder gets a design palette", "Widgets get a size and a length",
    git log "Journey planes, part 1-5", "Journey: text as a real asset type".
- **N3. The Tabi editor** [S `tabi-editor`].
  - Settings, prerequisites, attaching milestones, pieces (the collage editor) and scene.
  - "Chapter on the map" vs "collected from pieces".
  - Size is set by dragging on the builder.
  - Source: "A Tabi editor at last".
- **N4. Conditions** [S `conditions-when-things-unlock`].
  - The 17 condition types (`ConditionsModel::CONDITION_TYPES`): level, xp, journey %,
    milestones completed, Tabis completed, Tabi %, transactions, items consumed,
    achievements held, a specific milestone, a specific Tabi, guild level, guild members,
    total Blooms, Blooms in one skill, Blooms received from peers, Blooms given.
  - Counters can carry a **rolling time window**.
  - Where conditions are used: achievements (auto-grant), certificates, tasks, encounter
    groups, scene rows.
  - All conditions on a thing must be met. No conditions means open.
- **N5. Random Encounters, rebuilt** [S rewrite of `random-encounters`; U
  `encounters-the-card-draw`].
  - **Groups** decide *when*. Each group has its own conditions, a schedule (always / every
    N / on certain weekdays), an order, a hand size and a mood colour.
  - **Cards** are crises or opportunities, each pointing at a milestone. When a group is
    ready, the player is dealt face-down cards on the journey and picks one. **The pick
    locks them into that milestone until they finish it.**
  - Inside it, an **Encounter Choice** step offers priced options (BLOO and EP, optionally
    XP up or down). BLOO can go into debt; EP can't. **Every encounter needs one free
    option.**
  - Also: draw weight, date windows, repeatable cards, "Show again" and reset deck, and
    Stats reporting per choice.
  - Source: "The Random Encounters engine, rebuilt…", "Encounters: the trigger moved to the
    GROUP", "Encounter conditions belong to the GROUP", "Encounter groups: conditions AND a
    schedule".
- **N6. Consequences** [S `consequences`].
  - Messages that fire when a state is crossed ("you've gone into debt") or after a specific
    encounter choice.
  - Once, or at most once a day.
  - Delivered on the player's next page load, even if someone else's action triggered it.
- **N7. Certificates, for GMs** [S `certificates-authoring`].
  - Several per adventure, each gated by conditions, with a per-certificate logo and
    signature.
  - Guild certificates read live from members.
  - The player's display badge.
  - Source: "Certificates" (2026-09-08).
- **N8. Profile Tests** [S `profile-tests`; U `your-profile-results`].
  - A **profile** is a scale with traits, and each trait can be allowed or barred from
    being the headline.
  - Questions are **steps inside any milestone**, so a test can be spread invisibly through
    the story.
  - The result is a **Profile Result step** placed wherever it belongs.
  - Retake is optional and off by default.
  - Also: a paste-in bulk question importer, the **official HEXAD** installable in one
    click, player results in the Journal's Profiles tab, and a cohort drill-down on Stats.
  - Weights are never shown to players.
  - Source: "Profile Tests", "The profile moved onto the STEP".
- **N9. Posts and Resources** [S `posts-and-resources`, and a U line].
  - Posts (four presentation styles) and Resources (articles, or downloads when a URL is
    set) are content types the docs never covered.
  - Real reading view; gated like milestones.
  - Source: "Posts and Resources had no reading view at all".
- **N10. AI milestone review** [S `ai-milestone-review`], or fold it into the two grading
  pages. See those entries in section 3.
- **N11. Speakers and the cast** [S `speakers-and-dialogue-cast`].
  - A dialogue step can name a speaker, so the name and portrait follow the cast.
  - Change a portrait once and every line updates.
  - Manage Content has a Speakers tab showing how many lines each speaks.
- **N12. Case study and video reporting** [S].
  - Every case-study attempt kept, with per-question detail and CSV export.
  - Video watch-time per player ("who watched, how much").
- **N13. Activity logs** [S]: a searchable, filterable audit table per adventure.
- **N14. Starting point, List view and help tours** [U `finding-your-way-around`]: can be
  one short page.
- **N15. User Management (Enterprise or admin)** [S].
  - Every account on the platform, searchable and filterable.
  - Access levels (god / admin / user), suspension, direct password set, plan override,
    subscription and invoice history, per-adventure roles.
  - A promotion or suspension takes effect on the user's next page, with no re-login.
- **N16. Security and Single Sign-On (Enterprise)** [S].
  - SAML SSO with Microsoft Entra ID, with a local break-glass login for admins.
  - Cloudflare Turnstile on login, registration and reset.
  - Upload limits, SVG sanitising, and rate limits.
  - **Check with Bernardo what's live** before claiming Turnstile or SSO is on.
- Optional, developer section (gated): `/install`, the portable `tools/migrate.php`, and
  the structure-only deploy rule. Only if Bernardo wants self-hosting documented.

---

## 6. Marketing pages to touch

- `pages/product.php`: "23 step primitives" becomes 28. Consider sections for Encounters
  and Profile Tests.
- `pages/home.php` and `pages/solutions.php`: grep for "23", "Hexad", "Sponsor",
  "Blocker", "report".
- `docs/index.php`: only if you add a new grouping (for example a "Designing the Journey"
  cluster). Otherwise untouched.

---

## 7. Decisions to bring to Bernardo (don't write around them)

1. **Plan limits: ANSWERED by Bernardo, 2026-09-20.** Use these everywhere (the docs pages
   and `/pricing`):

   | Plan | Players | Adventures | Storage |
   |---|---|---|---|
   | Basic | **90** | **3** | **50MB** |
   | Pro | **250** | **20** | **200MB** |
   | Enterprise | no limit | no limit | no limit |

   Correct every page that says 200 players, "unlimited" on Pro, or the old Pro
   description: at least `getting-started`, `setting-up-your-organization`,
   `billing-and-plans`, `understanding-plans-basic-pro-enterprise` and `pages/pricing.php`.
   "How Plan Tiers Actually Differ" can now say plainly that Basic to Pro raises both caps
   and Enterprise removes them.

   **`pages/pricing.php` needs a rewrite, not a tweak.**
   - The Pro card contradicts itself: it lists "40 players per Adventure", "Unlimited
     Adventures" and "Up to 200 players" in one list.
   - Enterprise says "Custom player & storage limits" and should now say no player or
     adventure limits.
   - The hero claims "Pricing here always matches what's actually configured in the
     BLUERABBIT app's billing". That isn't true (see enforcement below), so reword it.

   **Open: per adventure or account-wide?** Bernardo said "Basic gets 90 players and 3
   adventures". Whether that means 90 per adventure or 90 across the account isn't settled.
   The current page mixes both ideas. Ask before choosing wording that implies one.

   **Still NOT confirmed, so don't restate them without asking:** the Pro price
   ($8/mo, $80/yr) and the 30-day trial.

   **Don't promise that the caps are enforced yet.** As of `blue@741da91` the app enforces
   none of them. Bernardo is building plan-limit enforcement in the app in a separate
   session, started 2026-09-20. Check `git log` in `blue` before this pass. If enforcement
   has shipped, document what a user actually sees when they hit each cap (players,
   adventures, storage). If it hasn't, state the limits and leave out what happens at the
   cap.
2. **Mission rules vs his ruling.** "Endorse someone" and "Gift a Bloom" are both offered
   as mission rules in the builder, and his 2026-08-17 ruling says neither should be.
   Either remove them from the app (a `blue` change) or keep the GM page's "don't author
   these" warning. Reconnection still isn't a rule (open question D3a).
3. **Organizations page.** Soften it to what exists, or label the Stats tab "coming".
4. **Contact Admin → Teams.** The request form's legend points support at Microsoft
   Teams. Is that universal or one client's setup?
5. **Taskbar.** Its current design, before it's documented.
6. **Turnstile and SSO.** Are they live on play.bluerabbit.io?
7. **Gift Bloom refill.** Still no automatic rule (GM top-up only). The existing wording is
   still correct.

`CONTENT-QUESTIONS.md` items the build has since answered, so they can be closed:
- **A5** (Choose Avatar): GMs can author the avatar choices now.
- **A1** (Jump to Step): now ships in CI4; Gallery still doesn't.
- **A4** (AI strictness): per step, lenient/standard/strict, key per adventure, stored
  encrypted.
- **B1** (Autoload): it works now. The naming question still stands.
- **B3** (pay BLOO to skip): cut.
- **C3** (Encounters): very much alive, and rebuilt.
- **D1**: done.
- **D3a**: partly. "Make a connection" exists; reconnection doesn't.

---

## 8. Verification checklist

- [ ] `php -l` on the seeder and any touched view.
- [ ] Run `php spark db:seed DocsPageSeeder` twice. The second run must not add rows.
- [ ] Check in the database: row counts per section, no duplicate `sort_order` per section,
      no empty titles or bodies.
- [ ] Programmatic check: every `/docs/...` link in every body resolves to a real slug.
- [ ] Every new and changed route returns 200 via `php spark serve`, with a
      rendered-content assertion (not status alone).
- [ ] Grep the seeder for retired terms: `Hexad`, `Sponsor`, `2004`, `Bulk Create`,
      `player_name}}`, `adventure_title}}`, `Blocked`, `demo`, `skip the wait`, `slug`
      (in the Cooper context), `Objective`.
- [ ] Update `claude-notes/BUILD-STATUS.md` with what changed, and close the answered
      `CONTENT-QUESTIONS.md` items.
- [ ] Commit and push.
