# Findings for the `blue` repo, from the 2026-09-21 docs sync

Written 2026-09-21 by the `website` session that acted on `CI4-DOCS-SYNC-2026-09-20.md`.
Seven research passes read `blue` (at `6e5a454`) code-first while rewriting the docs, and this
is everything they found that looks wrong in the app. **Nothing here was changed in `blue`**
(the website session can't edit it). File:line references are as of `6e5a454`; verify each one
before fixing, because several are read-only findings that no one has reproduced live.

**For a `blue` session:** work through section 1 first. Section 3 lists the docs sentences that
exist only because of a bug. When you fix one, tell the website session so the caveat comes out.

---

## 1. Player-facing breakage (fix first)

1. **Attempt limits strand players on Multiple Choice and Cryptex.** The server enforces
   Maximum attempts on six step types, but only Keyphrase and Require Backpack Item handle the
   "attempts used up" response. On MC and Cryptex (`script.js` brSubmitMcStep ~6553,
   brSubmitCryptexStep ~6616) it's ignored: even a correct answer is refused and there's no
   route to the fail screen. Either handle it or hide the field on those types (it also shows,
   uselessly, on SCORM and Puzzle: `step-form.php:936-946`).
2. **Choose Avatar may blank the player's picture.** JS posts `player_picture`
   (`script.js:4085`); `PlayerAdventureController::setProfilePicture()` reads `picture` (:324).
3. **The Schedule is empty in cohorts.** `SessionController::update` saves sessions to the
   template (`$ids['parent']`), `index()` reads the cohort's own. `newSessionForm`'s milestone
   and guild lists also query the cohort.
4. **Case Studies and Videos tabs never appear in a cohort.** `adventureHasCaseStudy` /
   `getCaseStudySteps` / `adventureHasVideoStep` / `getVideoSteps` query `br_steps` by the
   child id; steps live on the template.
5. **Review CSV upload fails in a cohort.** `importPlayerPostsCSV` looks up the quest with the
   child's adventure id (`QuestController:466`), so it errors with "This milestone doesn't exist".
6. **GM feedback on step-based milestones is never shown to the player.** It's labelled
   "(visible to player)" but `quest/show.php:53-66` only renders it on classic no-step milestones
   with a non-empty grade.
7. **Blank Stock sells nothing.** On a consumable or gift card, a blank Stock saves as 0 and the
   item shows Sold Out despite the "Unlimited" placeholder (`items/new.php:211`,
   `ItemModel.php:610/627`, `shop.php:57`). Tabi pieces treat blank as unlimited. Their Max per
   Player is shown but always saved as 1 (`ItemModel.php:655`).
8. **Hide Certificates only works with Hide Achievements on.** The filter is gated on
   `$showAll`, which includes `!$hideAchievements` (`AchievementController.php` ~118, 145).
9. **"Get one of your requests solved" credits the helper, not the asker.** `HelpModel.php:206`
   logs from the helper, and the default credit direction is "from" (`GardenModel.php:91-95,114`).
10. **"Make a connection" credits only the person who accepts** (`GardenModel.php:303`). The one
    who asked never progresses. Possibly intended; confirm.
11. **The Garden's first-visit Missions panel never opens.** `br-panels.js:158` looks for
    `data-open-first`, which no view sets (broke at `eb60bd4`).
12. **Milestone QR codes can't be seen or printed in CI4.** The token exists (`QuestModel.php:515`)
    but no view receives it; `quests/new.php:24-26` lists the download as deferred. Also, whole-
    adventure Duplicate sets `quest_qr_token` NULL "regenerates on first real use"
    (`AdventureModel.php:819`), but nothing regenerates it.
13. **Magic links redeem into the template from a cohort.** The Magic Link field, unique-code copy
    links and "Show all links" use the template id (`achievements/new.php:247, 302`,
    `achievement-code-row.php:12`); only the QR image is per cohort (`AchievementController.php:287-293`).
14. **A logged-out QR scan loses its destination.** `AuthFilter.php:68-78` keeps only `?c=` and
    `?enroll_code=`, and login always lands on /adventures (`AuthController.php:62`).
15. **A QR-completed milestone never pays its Skill (Bloom) reward.** Only `registerPost`
    grants it (`BaseController.php:216`), and `scanQR` bypasses it.
16. **A failed SCORM replacement deletes the working package.** `Scorm::installPackage` empties
    the folder before validating the new zip (`Scorm.php:32-35`).
17. **The GM "Password" button on Manage Players fails** with "Unknown action": `loadContent`
    isn't in the AJAX action list (`player/manage.php:95`, `AjaxController.php:438`). The Sys
    Config label says "GMs and NPCs" but NPCs are refused (`PlayerModel.php:591`).
18. **`{{site_name}}` always prints "BlueRabbit"** in campaigns (`Mailer.php:53-54` vs `:325`,
    preview `EmailController.php:228`).
19. **"Items Consumed" without a time window probably never fires.** It counts
    `trnx_type='use'` rows (`ProgressionModel.php:379/488`), which CI4 never writes. Use sets
    `trnx_use=1`; only the windowed count reads that (`ConditionsModel.php:577-582`).
20. **A path-limited encounter milestone could strand a player.** `milestoneRefusal()` checks
    path before the encounter lock (`BaseController.php:139-148`).
21. **A countdown never starts on a QR-reset task.** The card shows the QR block before the Start
    button (`task-card.php:106` vs `116`), and `TaskController::scanQR()` ignores attempts.

## 2. Security / privacy / multi-tenant (need a decision)

22. **DM text is written to the activity log** (`MessageController:103` logs `$content`), so
    staff can read private messages in the Everyone view. The docs don't mention it.
23. **"Connect to Player" lists every god/admin/gm/npc account on the platform**
    (`getOwnerCandidates`), which leaks names across customers.
24. **The Template Library lists every published template platform-wide**, with no org or owner
    filter (`AdventureModel.php:166-191`).
25. **Magic-link redemption doesn't check enrolment** (`magicLinkPage` / `redeemCode`). A logged-in
    non-member still gets the achievement recorded in that adventure.
26. **Rank magic codes skip the level gate** (`redeemCode()`), although a manual grant enforces it.
27. **"Invite Only" doesn't restrict the enrollment link.** `enrollByCode` never checks privacy.
28. **Purchase Permissions is UI-only.** Only "Only Players" does anything, and only to the Buy
    button (`items/shop.php:52`); `buy()` doesn't check it.
29. **The Endorsable flag on skills is never enforced** (`GardenController.php:376-410`). Any
    published skill can be endorsed or gifted.
30. **The activity-log partial calls `br_player_name($log, true)`**, which is staff mode and can
    show an email, although its comment says peer-safe.
31. **Email campaigns silently cap at 1,000 recipients** (`EmailModel.php:44`).

## 3. Docs caveats that exist only because of a bug — remove when fixed

| Docs page (slug) | Sentence | Bug |
| --- | --- | --- |
| full-step-library-choosing-the-right-step, step-type-quick-reference | "For now, set it only on Keyphrase and Require Backpack Item" | 1 |
| item-shop-building-an-economy | "set a number… Enter 99999 or more" | 7 |
| certificates-authoring | "At the moment this only takes effect when Hide Achievements is also switched on" | 8 |
| grading-and-ai-assisted-feedback | "At the moment, that note only appears on milestones submitted as a single written answer" | 6 |
| garden-missions, running-the-garden-as-a-gm | "as the app counts it today…" / "note that as built…" | 9 |
| setting-up-your-skills-catalog | Endorsable "doesn't currently stop players…", "Be careful with gate skills" | 29 |
| qr-codes-live-and-hybrid-events | "The milestone builder doesn't currently display a milestone's QR code" | 12 |
| qr-codes-live-and-hybrid-events, worked-example | "A phone that isn't logged in… has to scan again" (keep as a tip even after) | 14 |
| random-encounters | "It asks for the player's ID" | UI, see 4 below |

**Documented ahead of CI4, at Bernardo's request:** `customizing-taskbar-and-branding`,
`complete-adventure-settings-reference` and `finding-your-way-around` describe the **Classic
navigation** switch (off = no top bar or taskbar, with menu/profile/help in the corners). It exists in
WP (`page-new-adventure.php:1070-1095`, `functions.php` `br_classic_nav()`, `header.php:372-380`,
`footer.php:637`) but **not in CI4**. Bernardo: "If it's not in the CI4 version, we will add it."
Port it (`classic_nav`, per-adventure, default on) so the docs are true on play.bluerabbit.io.

## 4. Smaller oddities

- **Hard-coded client copy shown to everyone:**
  - `footer.php:119` Deadline-extension legend points support at **Microsoft Teams**. Bernardo:
    remove it; support is the adventure's custom quick links.
  - Garden **"The Business" / "Business" dock button / "Coins" / "Work shifts until you are back
    above zero"** (`garden/index.php:195,211`, `garden-standing-panel.php:25,31`).
  - `profile-box.php` and the Encounter Choice step: "Work a shift in the Garden to recover some."
  - The docs describe the panel as "Business" because that's the label. Rename, or make it
    configurable, and tell the website session.
- **Player-facing "quest" wording:**
  - `quest/completed.php:30` "Quest completed!"
  - `step-play/fail.php` "Quest Failed"
  - `failed-quest.php`
  - `qr-scan.php`
  - `task-card.php:83-97` "finish any quest"
  - `task-manager-row.php:107-115`
  - `journey.php:224` and `builder.php:126` "N quests"
  - `milestone-locked.php`
  - `milestone-finished` prints the raw type
  - the Journal "Quests" tab (`journal.php:115`)
  - the Duplicator "Quests" heading (`duplicator/index.php:17`)
  - "Attach to Quest" in the session editor
  - schedule/speaker "View quest"
  - GM bar "Edit Current Quest" (`step-admin-nav.php`)
- **Labels that disagree:**
  - The nav says "Journal", but the page heading defaults to "My Work".
  - The nav says "Secrets and Clues", but the heading says "Secret Messages".
  - The Feedback quick link is described as "Contact admin form" (`SettingsRegistry.php:300`).
  - The Duplicator's task text says "trigger milestone not copied" (`duplicator/index.php:75`),
    which is stale since `6bfcc1f`.
  - The Player Meta CSV hint lists the old nine columns (`meta-manager.php:47`).
  - Roles show as "Gm"/"Npc" (`garden-person-drawer.php:52`).
  - The Choose Nickname builder text says "First and Last names" (`step-form.php:921`).
  - The unique-codes hint says "once per player" (`achievements/new.php:253`), but a unique
    code is single-use for everyone.
  - Max Chances is `min="1"`, but its hint says "0 = infinite" (`challenges/new.php:200-201`).
  - Certificate logo hint: "Leave empty to use the adventure's own logo", but player
    certificates print without one.
  - Certificate Energy hint says "when the adventure uses encounters", but the check is `use_energy`.
- **Encounters:**
  - "One free option" is only an editor warning.
  - Encounter Choice hard-codes "BLOO"/"Energy" rather than the custom labels.
  - The player never sees an option's XP change.
  - The card row still shows card-level conditions (`manage-encounters.php:166`), which are no
    longer read.
  - "Send to a player" asks for a raw numeric Player ID (`script.js:6647`).
  - The "Chapter (Tabi)" and "Order" fields are saved but unused.
- **Retired Unlock/Deadline Cost logic is still live** (`ProgressionModel.php:528,534-535`,
  `milestone-unlock` / `milestone-deadline-cost` templates, `gated.php`, journey-board "Costs N").
  Zero such rows locally, but any leftover value would lock a milestone behind a dead purchase.
- **Cohorts:**
  - Add Mechanics links open the template, so "New Guild" from a cohort creates it on the
    template (`nav.php:525`).
  - `createChild` enrols the creator as NPC (`AdventureModel.php:466`), so a non-admin creator
    gets no Edit link.
  - The cohort admin menu has no links to Email, Player Requests, Manage Content or Stats
    (`nav.php:271-337`).
  - Tremendous config has no template fallback (unlike the AI key).
- **Misc:**
  - EP tile always shown in `player-overview.php`, even with EP off.
  - Challenge time limit is browser-only.
  - Case-study CSV export offsets by on-screen `perPage` but the server returns 50
    (`script.js:4704`).
  - Survey "Show results after vote?" is saved but never read.
  - The Text asset has no Text option in the per-asset type picker.
  - The Tabi row "Map" checkbox writes `tabi_on_journey`, which nothing reads.
  - The Journey tour can't be re-armed (`resetIntro` is unreachable).
  - Posts: `adventure_hide_quests` is cast to bool (`QuestController.php:86`).
  - Speaker picture is "*Required" but not enforced.
  - Transactions tab is shown to players, then redirects them.
  - Currency labels render empty if saved as `''` (`header.php:141-145`).
  - Found items aren't kept out of the shop (`ItemModel.php:79-82`).
  - Guild invite link `join?code=` has no route (`manage-guilds.php:212`).
  - Per-guild "Auto-assign on login" flag is never read.
  - Achievement Max Players is only enforced on single manual grants.
  - NPCs see Garden GM buttons that the server refuses.
  - Global/Individual mission audiences include staff.
  - Draft skills leak into ask-for-help pickers.
  - PA Post sits on the Public composer but publishes to System.
  - Orphan `player-report` route.
