# Game Master manual — handoff notes

Written 2026-07-28. This adds a full Game Master manual — designing an Adventure and
using every feature — into the docs system Claude Code already built (`docs_pages` table,
`DocsPageModel`, `Docs` controller, `/docs` views, the admin Docs CRUD).

## What changed

**No schema changes, no new files, no controller/view logic changes.** Both existing docs
mechanisms handle this without modification:

1. **`app/Database/Seeds/DocsPageSeeder.php`** — the existing 6 `setup`-section pages
   (org setup, first adventure, enrolling players, templates, billing, stats) are untouched.
   12 new pages were appended to the same `setup` section, `sort_order` 7–18:

   - Designing Quests: Types, Rewards & Unlock Rules
   - The Full Step Library — Choosing the Right Step for the Moment
   - Achievements, Paths & Ranks — Designing Your Reward Ladder
   - Guilds — Designing Team Play
   - The Item Shop — Building an In-Adventure Economy
   - Branching & Prerequisites — Building Non-Linear Adventures
   - Random Encounters & Blockers — Keeping Players on Their Toes
   - QR Codes — Live & Hybrid Event Checkpoints
   - Grading & AI-Assisted Feedback — Reviewing Player Submissions
   - Announcements — Keeping an Adventure Alive Between Sessions
   - Worked Example — Building a Two-Week Onboarding Adventure End to End
   - Step Type Quick Reference

   All content is grounded in the real domain model from `BLUERABBIT_PROJECT_BRIEF.md`
   (quest types, the 13 step types, achievement types, guild pooling, item types, branching/
   prerequisite rules, encounters/blockers, QR bypass, grading modes) — nothing invented.
   Written in GM-facing product language, not raw column names, matching the voice of the
   existing docs pages.

   The seeder is already upsert-by-slug (re-running it after an edit updates in place,
   doesn't duplicate) — this was already true of the file, unchanged here.

   **Phase 2 (same day, follow-up request):** 9 more pages appended, `sort_order` 19–27,
   adding a running example and the remaining feature areas, split concept/how-to per
   Bernardo's request:

   - Meet "Launch Week" — introduces the fictional adventure now referenced from the
     Designing Quests page onward, tying the manual together with one consistent example
     instead of a new scenario per page
   - Challenges & Surveys — Concept, and its How To companion
   - The Event Schedule (Sessions, Speakers & Sponsors) — Concept, and its How To companion
   - SCORM Packages — Concept, and its How To companion
   - Email Campaigns to Your Players — Concept, and its How To companion (explicitly
     distinguished in the copy from bluerabbit.io's own separate waitlist/Resend emails, so
     the two systems don't get confused later)

   34 pages total in `docs_pages` after both phases (7 `user` + 27 `setup`). Re-verified
   with the same harness described below after phase 2 — all checks still pass.

2. **`app/Views/docs/index.php`** — the "setup" section header changed from "For Org
   Admins" / "Onboarding & Billing" to "For Game Masters & Org Admins" / "Building &
   Running Adventures", since that section now holds a full GM manual, not just onboarding
   and billing. One paragraph of copy updated to match. Nothing structural — same card
   grid, same loop, just handles more cards now (13 setup pages total).

## How to apply

Both files are drop-in replacements for the files already at those paths in the repo:

```
app/Database/Seeds/DocsPageSeeder.php
app/Views/docs/index.php
```

Then re-run the seeder:

```
php spark db:seed DocsPageSeeder
```

## How this was verified

No live copy of your current app was available to me (Claude Code has moved past what
I last delivered — auth, admin, and the docs CMS didn't exist in my last build). So instead
of guessing, I staged your actual `docs_pages` migration, model, controller, and seeder from
your machine and matched the new content to that real schema and pattern exactly.

I then built a small standalone harness (SQLite + a PDO-backed stand-in for CI4's query
builder) that runs the *actual* `DocsPageSeeder::run()` method from the real file — not a
copy — against a table matching your real migration. Ran it twice to confirm the upsert path
doesn't duplicate rows on a second seed. Re-ran the same checks after phase 2. Final state:
34 total rows, no invalid `section` values, no empty titles/bodies, and every internal
`/docs/...` cross-link across all 27 setup pages resolves to a real slug (no broken links).
`php -l` clean on both files.

I did not touch anything else — no auth, no admin CRUD, no migrations, no other docs pages.

## One thing worth deciding later

The `docs_pages.section` column only supports three values (`user`, `setup`, `developer`) —
that's why this manual lives under `setup` alongside the lighter onboarding/billing pages
rather than getting its own section. If the GM manual keeps growing, it might eventually be
worth a fourth section (e.g. `gm`) so it's not sharing a bucket with billing — that would
need a migration to widen the column and update `DocsPageModel`'s validation `in_list`. Not
needed now; flagging it so it's a deliberate choice later, not an accident.
