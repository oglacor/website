# Content questions — answer inline, I'll turn them into docs

**How to use this file:** answer under each question, in whatever form is fastest — bullets,
half-sentences, dictated text, "no idea", "ask X". Don't write prose; that's my job. Anything
you leave blank I'll either leave as-is or flag again rather than invent an answer.

When a batch is answered, tell me and I'll fold it into `DocsPageSeeder.php` and re-seed. New
questions get appended to the bottom over time, so this file is the running backlog rather
than a one-off.

Opened 2026-08-17 after the Quests → Milestones correction pass.

---

## A. Step types

**A1. Gallery and Jump to Step — do they ship?**
WP's builder has 25 step types. The CI4 rebuild has 23; it omits **Gallery** (its image picker
calls WordPress's own media library directly and was never adapted) and **Jump to Step** (the
backend exists, the builder UI was never built). The docs currently say 23 and describe only
the CI4 set. Ship both / ship one / neither?

>

**A2. The word "Survey" is still in three step names.**
Surveys are dead as a content type, but the builder still labels three COLLECT steps
**Survey Choice**, **Rating Scale** and **Poll**. Rating Scale and Poll are fine. "Survey
Choice" is the awkward one. Rename it in the product (to "Choice Question"? "Multi-Select"?),
or keep the label and I just avoid the word "Survey" in the surrounding copy?

>

**A3. Case Study (HTML) — who builds these?**
The step takes a launch URL, a pass score and a question count, and the activity scores itself
and reports back. What I can't tell from the code: is this something BLUERABBIT builds for a
client as a service, something the client's own dev builds, or something bought from a vendor?
It changes whether this reads as a feature or as a professional-services hook.

>

**A4. Open Text AI validation — what do I say publicly?**
I know it runs on Claude, uses criteria the GM writes in plain language, and has a strictness
setting (lenient / standard / strict) in WP. Questions: is the API key customer-supplied per
Adventure, or do you provide it? Is strictness shipping? And is "AI-assisted feedback" the
phrase you want, or something else?

>

**A5. Choose Avatar — where do the avatars come from?**
The CI4 code notes there's no admin UI yet for creating avatar choices, so the step currently
renders an empty state. Is that shipping? If yes, how does a GM add avatars?

>

---

## B. Milestones

**B1. Is "Autoload" the player-facing name?**
It's the setting that drops a player straight into a Milestone on arrival instead of making
them find it on the map. "Autoload" is a developer word. Keep it, or is there a better one?

>

**B2. Grading modes — still completion / percentage / letter grades?**
The old docs claimed all three, plus "when rewards land" (immediately vs. after grading).
Still true?

>

**B3. Pay-BLOO-to-skip-a-deadline — still real?**
The old docs described spending BLOO to get past a deadline or an unlock cost early. I kept
it. Confirm it still works, or I'll cut it.

>

**B4. Can a Challenge contain Steps?**
I've written Challenge as purely a question bank, and Milestone as the thing built from Steps.
If a Challenge can also carry Steps, the "how to build a Challenge" page needs a section.

>

---

## C. Structure and naming

**C1. Tabi — is this definition right?**
I've written: *"a visual region on the Journey Map that holds a set of Milestones; Tabis are
how you chunk an Adventure into 'Week One' or 'Advanced Track', and they can carry their own
prerequisites so a whole region unlocks at once."* Accurate? And is "Tabi" explained anywhere
to a customer who's never seen the product, or does it need an origin/meaning line?

>

**C2. Adventure vs Journey — which is which, publicly?**
The docs use "Adventure" for the container and "Journey Map" for the canvas. Is that the
vocabulary you want customers using, or has it moved?

>

**C3. Encounters — still a real feature?**
Random pop-up quizzes gated by EP. I kept the page (minus the Blockers half). It's now the
only "surprise" mechanic left in the docs, so if it's also dead the page should go entirely.

>

---

## D. Cleanup found while doing this

**D1. `survey` and `social` are still creatable in the CI4 app.**
`AdventureManagementController::QUEST_TYPES` is
`['quest','challenge','survey','social','blog-post','lore']`, and `manage-journey.php`'s
`$typeIcons` still has entries for both. The docs no longer mention them, so right now the app
can create a content type the documentation says doesn't exist. Want those stripped out of the
app? (That's the `blue` repo, which I'm not allowed to edit from here — just flagging it.)

> **ANSWERED 2026-08-17** — Bernardo is fixing this in a `blue` session. Nothing to do here.

**D2. The Garden Missions doc doesn't match the Garden Missions code.**
The docs page says Missions are built from four rule types: *endorsements given, help given,
connections created, re-engagement*. The code (`GardenMissionModel`) has `manual` (player
clicks "Mark done") plus `interaction_count` over **dm / help_given / endorsement / wall_post**
— so "connections created" and "re-engagement" don't exist, and "messages sent" and "wall
posts" aren't documented. You told me the Garden pages were correct, so I've left them alone.
Which one is right — is the doc describing something planned but unbuilt?

> **ANSWERED 2026-08-17.** Rule types are **help given**, **connections created**, and
> **reconnection**. Endorsements are explicitly *not* a Mission rule — endorsing and gifting
> should happen because a player means them, and gift Blooms are a limited personal balance.
> Docs updated. This answer opened D3 below.

---

## E. Things I'd like a paragraph of your own voice on

Not blockers — but these read better in your words than mine, and they're the pages a
prospect actually lands on.

**E1.** Why Milestone/Challenge is the right split — the one-line pitch you'd give in a sales
call for why "provide knowledge or test knowledge" is the whole decision.

>

**E2.** The single best real example of a Milestone you've seen built by a customer. The docs
currently lean on a fictional "Launch Week" onboarding adventure throughout; one real one
would be worth more than the whole worked example.

>

---

## D3. Mission rule types: two of the three don't exist yet

Opened 2026-08-17 by the answer to D2. The builder (`partials/mission-manager-row.php`) offers
five completion rules: `manual`, plus auto-tracked **Send a message**, **Help someone**,
**Endorse someone**, **Post on the Wall**. Against your ruling:

| Your rule | Built? |
| --- | --- |
| Help given | yes |
| Connections created | **no** |
| Reconnection | **no** |
| Endorsements given | built, but you don't want it used |

I've written the player-facing page to your framing (it describes what a Mission asks of you,
which is true either way) and put the build reality on the GM page instead, including an
explicit "don't author endorsement Missions" note — because "Endorse someone" is still in the
dropdown and nothing stops a GM picking it.

**D3a.** Are "connections created" and "reconnection" being built for relaunch? If they're
further out, the player page should soften to the two that work rather than promise three.

>

**D3b.** Should "Endorse someone" be removed from the builder's dropdown in the `blue` repo?
Same class of fix as the `survey`/`social` cleanup you're already doing — the docs now say
don't use it, which is weaker than it not being there.

>

**D3c.** **Send a message** and **Post on the Wall** are built and auto-tracked but you didn't
name either. Are they legitimate Mission rules (a DM is arguably how a connection gets made),
or leftovers to drop alongside endorsements?

>

**D3d.** You said the defining case is a player posting a help request in a Skill, and the
system pointing others at it. The `blue` CLAUDE.md lists that supply/demand generation as
**not started**. Is that on the relaunch path? It's the biggest docs-vs-app gap right now.

>