# Findings in the app (`blue`) from the 2026-11-15 docs sync

Written by the W1 docs sync (website), read-only against `blue@463a356`, for the
app's own sessions to triage. Nothing here was changed in the app. Same purpose
as `BLUE-FINDINGS-FROM-DOCS-SYNC-2026-09-21.md`; that file's still-open items are
repeated below where they were re-checked.

Each line: where, and what. Three research passes found them, one per area of the
documentation; a finding two passes both reported appears once.

## Docs sentences that exist only because of an app bug

Remove the sentence from `app/Database/Seeds/DocsPageSeeder.php` when the fix lands. Fixed by the
app's F4 (`blue@02f0157`) and removed from the docs the same day: a blank item Stock now saves as
unlimited, and a milestone's QR code counts in the cohort the player plays. Fixed by the app's F5
(`blue@7abefa4`, `17eccd0`) and corrected in the docs the same day: the mission credit, Endorsable,
Send to a player and the task QR through sign-in (the rows below are kept struck through).

| Docs page | The sentence | The bug |
|---|---|---|
| ~~`garden-missions`, `running-the-garden-as-a-gm`~~ (fixed, F5) | "Get one of your requests solved" counts as the app counts it today | `HelpModel.php` ~200-206 logs `help_solved` with the helper as the actor, so the mission credits the helper, not the asker (2026-09-21 finding 9, still open) |
| ~~`setting-up-your-skills-catalog`~~ (fixed, F5) | the Endorsable switch has no effect yet | `skill_endorsable` is saved and imported but never read (2026-09-21 finding 29, still open) |
| ~~`random-encounters`~~ (fixed, F5) | "Send to a player" asks for a player ID | `script.js` `brFireEncounter()` still uses a browser prompt for a raw player ID |
| `adventure-templates-and-cohorts` | in a cohort, hand out the typed code or the cohort's QR | achievement Magic Link and unique-code links use `$adv_parent_id`, so they redeem into the template (2026-09-21 finding 13) |

## Player side

Fixed by F5 (`blue@7abefa4`): the Classic menu's Garden rows, the hard-coded currency labels in
encounter choices and Consequences, Cooper offered to guests, the guest on a Choose Avatar step,
missions counting a switched-off Garden action, a held Tabi's missing reason, the signed-out task
scan. Still open below: the Journal explanation, the untranslated strings, the profile-box label.
New, 2026-11-15: `adventures/milestone-unlock.php` 32 and 49 print "Puchase quest for:" (a typo,
and "quest" where the app says milestone).


- `app/Views/layout/nav.php` (Classic player menu): no Garden, Tasks, Missions, Help board, My skills or Starting point rows; a Classic player has no menu route to the Garden (the New menu has them, `StartMenu.php` 145-164). The docs describe them as New-view rows.
- `partials/step-play/encounter-choice.php` 73-74, 104 and `ConsequenceModel.php`'s watch list: "BLOO", "Energy", "Coins (BLOO)", "Energy (EP)" hard-coded instead of the adventure's own currency labels.
- `layout/header.php` ~660, the Classic quick link and the menu's Cooper card: Cooper is offered to guests, who are refused only when they send (`Cooper.php` ~2335); the limit is not said up front.
- Choose Avatar step: `brSaveAvatarStep()` posts `setProfilePicture`, which is in `Access::GUEST_REFUSED`; a guest on an avatar step is refused and the step may not complete.
- `player/journal.php` 281 and `partials/journal-milestones.php` 155: the staff explanation says the Journey Progress bar counts every milestone, optional ones and other paths included; on the app's own rules (`ProgressionModel::ownJourneyIds()`) it counts required milestones on the player's path in switched-on Tabis.
- English not through `t()`: `StartMenu.php` 160, 216, 397; `layout/start-menu.php` 128-129; `PersonalData::refusal()`'s sentences.
- `layout/profile-box.php` 211: the Account settings link says "Picture, nickname, password and language", but the nickname can't be changed there (the display name can).
- `GardenMissionModel` / `GardenMissionController`: missions that count a switched-off Garden action (talk, help, endorse or gift with its switch off) are still listed to players, who cannot complete them.
- `partials/tabi-stage.php` 147-153: a Tabi held only by its own requirements shows no reason in its window.

## Game Master side

Fixed since (F6 `39336fe5`, the guild fix `f3ab95f4`, F10 `5315392a`): the Choose Display Name
label, the three dead step-editor fields and tries on Puzzle / SCORM, guild auto-assign, the magic
code's cap and path, the encounter Chapter (documented: the draw ignores it), the priced
milestone fields (F4/F5/F7). Still open below: the Tabi row's Picture box, the extras panel
naming WordPress.


- `partials/step-form.php` 229: the Step Type menu says "Choose Nickname"; `step_helper.php`, the jumper and Cooper say "Choose Display Name" (it saves the display name).
- `partials/step-form.php`: "Show results after vote?" (~728) is saved but no `step-play` partial reads it; Open Text's "Rich Text Editor" (`use_wp_editor`) has had no effect since every Open Text box became the rich editor; Mistake Message / Maximum attempts (~1167) are shown on Puzzle and SCORM, where no try is ever spent.
- `TransactionController::payment()` works, but `mech_deadline_cost` / `mech_unlock_cost` had no field in the editors. F4 (`blue@02f0157`) adds the milestone fields; their save lands in a later commit, so the docs leave them out until then.
- `PlayerModel::assignGuild()`: with the app's rules the guild's own "Auto-assign on login" is ignored, though `guilds/new.php` offers it per guild. Left out of the docs.
- `AchievementModel::redeemCode()`: with the app's rules `achievement_max` and `achievement_path` are not checked on a magic code, while a GM's grant checks the cap.
- `partials/tabi-row.php` "Picture" box: `AdventureController::show()` draws the journey picture only where the journey extras are off, so on the app's own adventures the box does nothing.
- `PendingCode.php`: a signed-out `task-qr` scan is not kept through sign-in (enrol, magic link and quest QR are), so a task check-in needs a second scan.
- `adventures/new.php`, Rules & scoring, "This app's extras": its description names WordPress on a public adventure's settings screen.
- `encounters/new.php` "Chapter (Tabi)": no hint says what tying an encounter to a chapter does.

## Admin and platform

Fixed since: the Organization's Remove Player (F7 `def32f81`, a real Remove).


- `organization/player-org-row-extras.php`: "Remove Player" calls `removePlayerFromOrg()`, which exists nowhere (dead button).
- `SettingsRegistry.php` 134: `show_anonimize_button` is still drawn in Sys Config, Profile, but nothing reads it since the 2026-10-30 erase work.
- `config/index.php` Billing tab hint: "Stripe powers the /account subscription page"; the page is `/subscription`.
- `SettingsRegistry.php` `garden_business` description names a client ("Built for LaunchQuest's random encounters"), shown to admins on corporate servers.
- `BillingController::portalConfiguration()`: no `subscription_update` feature, so a subscriber can't move between monthly and yearly themselves (a product gap or intended; asked in BUILD-STATUS).

## Found while documenting the A.I. and single sign-on changes (app through `fb40c22b`)

Fixed by the app's F11 (`blue@46c739bb`, records `84aa881e`) and followed in the docs by W4 the same
day: the first three items below (kept struck through). Still as designed (F11 left it for Gauden):
My Account lists only adventures a person is seated in, so an unseated administrator's switch for an
adventure is the alert's link; the docs say so.

- ~~`player/account.php` Emails tab: the switch's words speak only of "automatic reminders about your progress", but the same switch (`br_email_optouts`) also stops the alert that an A.I. check could not run (`AiOutage::deliver()`). The docs say so. An administrator who is not seated in the adventure has no switch for it there, only the link in the alert.~~ (fixed, F11: the rows, a staff sentence above the list and the stop-emails page name the alert for staff)
- ~~`tools/server-check.php` `env.aiCheckModel`: a WARN on every server whose `.env` does not say `claude-opus-5-5`, with advice for one corporate server, so the public server shows a permanent, expected WARN. The developer page says so.~~ (fixed, F11: PASS naming the model; WARN only with `bluerabbit.wpRulesDefault = on` and no line, or an id the check does not offer)
- ~~`email/ai-check-alert.php`: "they went through without the check and wait for a person to review them": on a milestone without Validate, nothing waits; the answer is flagged until someone reviews it.~~ (fixed, F11: `AiCheckFlags::validateShare()` picks one of three sentences)
- Measured, not a bug: the check's prompt forbids naming the rubric's examples in feedback, but AI3's run still found it in 4 of 39 failed answers and 1 of 31 passed ones. The docs say the A.I. is told to keep the rubric private, not that it never slips.

## Found while following F11 (app through `84aa881e`)

Both fixed by the app's F12 (`blue@8684360f`, records `bc753044`) and followed in the docs by W5 the
same day (kept struck through).

- ~~F11's log says the per-adventure switch "also stops the lottery's emails". Only on an adventure that plays by WordPress's rules: `Lottery\Mail::optedOut()` returns nothing unless `WpRules::on()`, so the app's own adventures send the lottery-day emails to everyone, opted out or not (Gauden's choice of 2026-11-14, per its comment). Neither the switch nor the stop-emails page mentions the lottery on either side. The public docs say nothing about it (the imported rules are left out of them); the developer page says both.~~ (fixed, F12: `optedOut()` no longer asks `WpRules` and answers the day's players only, on both rule sets; My Account's row and the stop-emails page name the lottery-day emails where `Lottery\Mail::adventuresFor()` says the adventure sends the person some, with the win that still shows in the notifications. The public docs and the developer page now say so.)
- ~~`tools/server-check.php` is the Unilever server's checklist (its docblock): on a server the app built itself, `env.edition`, `env.menuDefault`, `env.extrasDefault` and `env.wpRulesDefault` FAIL and it exits 1 (seen on this machine, `--offline`), while the developer page's deploy steps had it run on every update. The developer page now says so. If it should serve play.bluerabbit.io too, it could read the server's kind the way F11's `env.aiCheckModel` does.~~ (fixed, F12: `sc_kind()`, `--kind=unilever|app` or the importer's `wp-import` row; on this app's kind the four lines PASS naming the value, the one FAIL the public edition with the extras off; `env.aiCheckModel` keys off the same kind. Seen here, `--offline`: "Kind: this app's own kind", the four PASS.)

## Found while following F12 (app through `bc753044`)

- `tools/server-check.php` `backup.config`: F12 left the `backup.*` lines as they were (its log: whether play.bluerabbit.io runs `tools/backup.sh` or counts on WHM's backups is Gauden's call), so on a server this app made without `/etc/bluerabbit/backup.conf` the check still FAILs and exits 1 (seen here, `--offline`: 4 FAIL, `backup.config` among them, the rest a development box's). The developer page says so.
- F12's proposed developer sentence says that on the takeover kind "`env.aiCheckModel` warns without `claude-opus-5-5`". The code warns only when the `.env` has no `bluerabbit.aiCheckModel` line there (or one naming an id the check doesn't offer); a Haiku 5.5 or Sonnet 5.5 line PASSes, with a note naming Opus 5.5 as that server's. The docs follow the code. The same sentence's "report what is set and PASS" leaves out the WARN for a word the app doesn't know, and its "its database has the importer's row, or `--kind=unilever`" leaves out the database the check can't read (also the takeover kind); the docs say both.
- Seen, as F12 recorded: the lottery-day emails carry no stop link of their own (`Lottery\Mail::render()` passes no opt-out address), so on a server where My Account's Emails panel is off (extras off) a player's only switch for them is the link in another automatic email from that adventure. The developer page says so.
