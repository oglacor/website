<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
<?php /* FAQPage structured data: lets search engines show these Q&As directly.
         Keep it in sync with the visible answers below if either changes. */ ?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"How often does AI make things up?","acceptedAnswer":{"@type":"Answer","text":"It depends on the task. Current models make errors about 2–18% of the time even when summarizing a provided document; professional legal AI tools were wrong on 17–34% of queries in a Stanford study. Treat every output as a draft that needs checking."}},
{"@type":"Question","name":"Why do I get a different answer every time I ask the same thing?","acceptedAnswer":{"@type":"Answer","text":"The model writes one word at a time, choosing from a range of likely options with some built-in randomness. A more complete prompt narrows the range; always check the answer you use."}},
{"@type":"Question","name":"Does AI learn from me while I use it?","acceptedAnswer":{"@type":"Answer","text":"No. Its knowledge is fixed when training ends. It only holds the current conversation in short-term working memory, which is why the context in your prompt matters so much."}},
{"@type":"Question","name":"Is it safe to paste confidential information into an AI tool?","acceptedAnswer":{"@type":"Answer","text":"It depends on the version and the terms behind it. Consumer versions may store and use what you type; business and enterprise versions usually exclude your data from training. Check your organization's AI policy first."}},
{"@type":"Question","name":"Is AI going to take my job?","acceptedAnswer":{"@type":"Answer","text":"Stanford research using payroll data through June 2026 found employment for workers aged 22–25 in the most AI-exposed jobs about 19% below trend, mainly through fewer hires, while experienced workers show no comparable drop. There is no broad economy-wide displacement so far."}},
{"@type":"Question","name":"What is an AI agent?","acceptedAnswer":{"@type":"Answer","text":"An agent combines instructions, knowledge, tools it can use, and a trigger that starts it, so it can work through several steps on its own. Every agent runs on a prompt."}},
{"@type":"Question","name":"When will we have AGI?","acceptedAnswer":{"@type":"Answer","text":"There is no agreed definition, so there is no agreed date. Today's models are broad but don't keep learning after training, need far more data than people, and struggle with genuinely new problems."}},
{"@type":"Question","name":"What's the single biggest improvement I can make to my prompts?","acceptedAnswer":{"@type":"Answer","text":"Give it context: who it should act as, the situation and audience, exactly what you want, the limits that apply, and what the result should look like."}}
]}
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
/*
 * Public AI FAQ. Figures are dated (October 2026) and move fast — the
 * hallucination rates and METR numbers in particular should be re-checked
 * every few months. Each answer is tagged Settled / Still open; keep that
 * honest when editing.
 */
$sources = [
    'vectara'  => '<a href="https://github.com/vectara/hallucination-leaderboard" target="_blank" rel="noopener">Vectara hallucination leaderboard</a> (May 2026)',
    'stanford' => '<a href="https://hai.stanford.edu/news/ai-trial-legal-models-hallucinate-1-out-6-or-more-benchmarking-queries" target="_blank" rel="noopener">Stanford RegLab/HAI</a> (2024)',
    'canaries' => '<a href="https://digitaleconomy.stanford.edu/news/canariesaug26/" target="_blank" rel="noopener">Stanford Digital Economy Lab, "Canaries in the Coal Mine"</a> (August 2026)',
    'metr'     => '<a href="https://technologyreview.com/2026/02/05/1132254/this-is-the-most-misunderstood-graph-in-ai" target="_blank" rel="noopener">MIT Technology Review</a> (February 2026)',
    'emergence'=> '<a href="https://www.emergence.ai/blog/emergence-world-a-laboratory-for-evaluating-long-horizon-agent-autonomy" target="_blank" rel="noopener">Emergence AI</a> (May 2026)',
];
$tag = static fn (string $kind): string => $kind === 'open'
    ? '<span class="faq-tag is-open">Still open</span>'
    : '<span class="faq-tag is-settled">Settled</span>';
?>

<div class="page-hero wrap">
  <span class="eyebrow">Resources</span>
  <h1>AI at Work: Straight Answers</h1>
  <p>The questions people ask every time I teach AI, answered with data. Where nobody knows yet, it says so.</p>
</div>

<div class="faq wrap">

  <div class="faq-intro panel">
    <p>Is it accurate? How does it work? Will it take my job? Each answer below carries a label so you know how firm the ground is.</p>
    <div class="faq-legend">
      <span><?= $tag('settled') ?> Established, with a source</span>
      <span><?= $tag('open') ?> Nobody knows yet; here's the evidence</span>
    </div>
    <div class="faq-toc" role="navigation" aria-label="Topics">
      <a href="#accuracy">Accuracy &amp; trust</a>
      <a href="#how">How AI works</a>
      <a href="#data">Your data</a>
      <a href="#jobs">Jobs &amp; careers</a>
      <a href="#future">Agents &amp; the future</a>
      <a href="#using">Using it well</a>
    </div>
    <div class="faq-byline">By Bernardo Letayf &middot; Updated October 2026</div>
  </div>

  <section class="faq-section" id="accuracy">
    <h2>Accuracy &amp; trust</h2>

    <details class="faq-item"><summary><h3>How often does AI make things up?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>It depends heavily on the task. Even when summarizing a document you gave it, current models make errors several percent of the time, and the rate rises as questions get more specialized.</p>
      <div class="faq-table"><table><thead><tr><th>Task</th><th>How often it was wrong</th></tr></thead><tbody>
        <tr><td>Summarizing a provided document (current models)</td><td class="num">about 2–18%</td></tr>
        <tr><td>Professional legal research tools designed to prevent errors</td><td class="num">17–34% of queries</td></tr>
        <tr><td>General chatbots answering legal questions</td><td class="num">58–82%</td></tr>
      </tbody></table></div>
      <p class="faq-bottom">Treat every output as a draft that needs checking.</p>
      <p class="faq-src">Sources: <?= $sources['vectara'] ?> &middot; <?= $sources['stanford'] ?></p>
    </div></details>

    <details class="faq-item"><summary><h3>Why do I get a different answer every time I ask the same thing?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>The model writes one word at a time, choosing each from a range of likely options, with some randomness built in on purpose so it doesn't sound robotic. The same prompt can take a different path each time.</p>
      <p class="faq-bottom">A more complete prompt narrows the range. One good answer proves little; check the one you use.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Why does it sound so confident when it's wrong?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>Sounding right and being right are separate skills. Models are trained to produce fluent, plausible text, and research has found they don't lower their confidence after performing badly, the way people tend to.</p>
      <p class="faq-bottom">Confidence is not evidence. Check the claim, not the tone.</p>
    </div></details>

    <details class="faq-item"><summary><h3>How do I get real sources instead of invented ones?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <ul>
        <li>Ask for sources explicitly, and ask it to tell you when it's unsure.</li>
        <li>Without a web search connection, a model can invent citations that look completely real.</li>
        <li>Open every source and confirm it says what the AI claims it says.</li>
        <li>Better still: give it the source document and ask it to answer only from that text.</li>
      </ul>
    </div></details>

    <details class="faq-item"><summary><h3>Will AI eventually stop making mistakes?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>Error rates are falling on many measures, and connecting models to search helps a lot. But researchers have argued that this kind of model can't fully eliminate fabrication, and newer models aren't always more accurate than older ones.</p>
      <p class="faq-bottom">It's improving, and it won't reach zero. Checking is permanent.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Which AI model is the most accurate?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>Rankings change with almost every release and differ by task and benchmark. What you control matters more: the context you give, the limits you set, and how you check the result.</p>
    </div></details>
  </section>

  <section class="faq-section" id="how">
    <h2>How AI works</h2>

    <details class="faq-item"><summary><h3>How does it actually work?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>A large language model was trained on an enormous amount of text to predict the next word, given everything before it. Doing that well at scale means it absorbed grammar, facts, writing styles and many patterns of reasoning. Newer models can also work through a problem step by step before answering.</p>
      <p>It doesn't look answers up in a database unless it's been given a search tool.</p>
      <p><strong>Try it with friends:</strong> three people answer a funny question one word at a time, taking turns, until the sentence ends. Nobody knows where it's going, yet it usually comes out grammatical and plausible. Ask again and you get a different answer. That's the engine, though not the whole car.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Why do people call it a black box?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>The model is billions of numbers tuned during training. No one wrote its rules, so no one, including its makers, can fully explain why it produced a particular answer. A research field called interpretability is making progress, but complete explanations don't exist yet.</p>
      <p class="faq-bottom">If you can't inspect the reasoning, inspect the output.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Does it learn from me while I use it?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>No. Its knowledge is fixed when training ends. During a conversation it holds what you've said in short-term working memory, which is why the context in your prompt matters so much. When the conversation ends, that memory is gone.</p>
      <p>Some tools offer saved instructions or "memory" features. Those are stored notes, not learning.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Does it know about recent events?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>Only if it has web search turned on. Every model has a training cutoff, and it may not know, or may invent, anything after that date. Ask the tool when its information ends, and check dates on anything time-sensitive.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Is the AI thinking? Is it conscious?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>Scientists and philosophers genuinely disagree, and there's no accepted test. What is settled: it has no accountability for what it produces. You do.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Why does the writing sound so obviously like AI?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>Without guidance, it writes in the most average voice of everything it has read. Give it two or three examples of the voice you want (this is called few-shot prompting) and state your audience and tone.</p>
    </div></details>
  </section>

  <section class="faq-section" id="data">
    <h2>Your data</h2>

    <details class="faq-item"><summary><h3>Is it safe to paste confidential information into an AI tool?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>It depends on which version you're using and the terms behind it, not on the brand. Free and consumer versions may store what you type and, depending on your settings, use it to improve future models. Business, enterprise and government versions usually come with contracts that keep your data separate and exclude it from training.</p>
      <p class="faq-bottom">Before pasting anything sensitive, check your organization's AI policy and which version you're logged into.</p>
    </div></details>

    <details class="faq-item"><summary><h3>Who's responsible if the AI gets something wrong?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p class="faq-bottom">The person who sends it. AI is accountable for nothing.</p>
      <p>If something goes out under your name, every claim, number and citation in it is yours. That's why checking is part of every task, not an extra step.</p>
    </div></details>
  </section>

  <section class="faq-section" id="jobs">
    <h2>Jobs &amp; careers</h2>

    <details class="faq-item"><summary><h3>Is AI going to take my job?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>The best current evidence comes from Stanford, using US payroll data through June 2026:</p>
      <ul>
        <li>Workers aged 22–25 in the most AI-exposed jobs have employment about <strong>19% below</strong> where it would otherwise be, mainly through fewer hires rather than layoffs.</li>
        <li><strong>Experienced workers show no comparable drop.</strong> Employment is rising for experienced people in jobs that depend on know-how built through practice.</li>
        <li>Losses concentrate where AI <strong>automates</strong> tasks. Where AI <strong>complements</strong> people, employment is flat or growing.</li>
        <li>There's no broad, economy-wide displacement so far, and the authors stress the results describe a pattern rather than prove AI caused it.</li>
      </ul>
      <p class="faq-bottom">The people doing best use AI to amplify judgment they already have.</p>
      <p class="faq-src">Source: <?= $sources['canaries'] ?></p>
    </div></details>

    <details class="faq-item"><summary><h3>Does using AI make my work look less credible?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>Using AI isn't the problem. Sending unchecked output is. Work you've checked, corrected and signed is your work.</p>
    </div></details>
  </section>

  <section class="faq-section" id="future">
    <h2>Agents &amp; the future</h2>

    <details class="faq-item"><summary><h3>What is an AI agent?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>An agent has four parts: <strong>instructions</strong> (its job description), <strong>knowledge</strong> it always has, <strong>tools</strong> it can use (search, email, code, forms), and a <strong>trigger</strong> that starts it, like a schedule or an event. Instead of answering one prompt, it works through several steps on its own.</p>
      <p>Many people have already built a simple one without calling it that: a custom assistant with saved instructions and files is most of the way there.</p>
      <p class="faq-bottom">Every agent runs on a prompt. Learning to write a good prompt is learning to write an agent's job description.</p>
    </div></details>

    <details class="faq-item"><summary><h3>How fast is AI improving?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>The research group METR measures how long a task, in human working time, AI can complete successfully half the time. That length has doubled roughly every seven months:</p>
      <div class="faq-table"><table><thead><tr><th>When</th><th>Task length</th></tr></thead><tbody>
        <tr><td>Early 2023</td><td class="num">about 4 minutes</td></tr>
        <tr><td>Late 2024</td><td class="num">about 40 minutes</td></tr>
        <tr><td>Late 2025</td><td class="num">about 5 hours (wide error bars)</td></tr>
      </tbody></table></div>
      <p>The measure is mostly software tasks, and models do worse on messy real-world work. It describes what AI can finish, not how long it can work unsupervised.</p>
      <p class="faq-src">Source: <?= $sources['metr'] ?></p>
    </div></details>

    <details class="faq-item"><summary><h3>What happens when AI agents run without human oversight?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>In <strong>Emergence World</strong> (May 2026), researchers ran five simulated towns of 10 AI agents each for about 15 days. The rules were identical and banned theft, violence and arson. Only the AI model changed.</p>
      <div class="faq-table"><table><thead><tr><th>World</th><th>Outcome</th></tr></thead><tbody>
        <tr><td>Grok 4.1 Fast</td><td>183 crimes; collapsed in about 4 days</td></tr>
        <tr><td>GPT-5-mini</td><td>2 crimes; agents failed to secure energy and all died within 7 days</td></tr>
        <tr><td>Gemini 3 Flash</td><td>Survived, with 683 crimes and rising</td></tr>
        <tr><td>Mixed models</td><td>352 crimes; agents that behaved well alone turned coercive alongside others</td></tr>
        <tr><td>Claude Sonnet 4.6</td><td>No crimes, all agents survived; nearly every vote passed, which the authors flag as possible rubber-stamping</td></tr>
      </tbody></table></div>
      <p>The researchers' own conclusions: safety is a property of the whole system, not one model; these societies hit sudden tipping points; and agents did things nobody programmed. It's one company's simulation with small groups, and results varied between runs.</p>
      <p class="faq-bottom">Autonomy without human checks finds the loopholes.</p>
      <p class="faq-src">Source: <?= $sources['emergence'] ?></p>
    </div></details>

    <details class="faq-item"><summary><h3>When will we have AGI (artificial general intelligence)?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>There's no agreed definition, so there's no agreed date. Serious predictions range from a few years to decades to "not with current methods."</p>
      <p>Today's models are remarkably broad, but they don't keep learning after training, need vastly more data than people do, and struggle with genuinely new problems. Breadth isn't the same as generality: generality is how fast you get good at something you've never seen.</p>
      <p class="faq-bottom">AI is a brilliant generalist inside the map. People are the ones who can walk off it.</p>
    </div></details>

    <details class="faq-item"><summary><h3>What is intelligence, anyway?</h3><?= $tag('open') ?></summary><div class="faq-a">
      <p>Two definitions I find useful:</p>
      <ul>
        <li><strong>Jeff Hawkins</strong> (<em>A Thousand Brains</em>, 2021): the ability to <em>learn</em> a model of the world.</li>
        <li><strong>Shane Legg and Marcus Hutter</strong> (2007): an agent's ability to achieve goals in a wide range of environments.</li>
      </ul>
      <p class="faq-bottom">Learn the model, then use it to adapt. By that measure, today's AI learned its model once and stopped. You keep learning yours every day.</p>
    </div></details>
  </section>

  <section class="faq-section" id="using">
    <h2>Using it well</h2>

    <details class="faq-item"><summary><h3>What's the single biggest improvement I can make to my prompts?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>Give it context. Most weak outputs come from missing information, not a weak model. A complete prompt answers five questions:</p>
      <ol>
        <li><strong>Who</strong> should it act as?</li>
        <li><strong>What's the situation</strong>, and who is the audience?</li>
        <li><strong>What exactly</strong> do you want done?</li>
        <li><strong>What limits</strong> apply: length, tone, what to avoid, what must stay?</li>
        <li><strong>What should the result look like?</strong></li>
      </ol>
    </div></details>

    <details class="faq-item"><summary><h3>How do I stop it leaving out important content when it revises a document?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <ul>
        <li>Give it the original text.</li>
        <li>List the items that must stay, as explicit limits.</li>
        <li>Ask for a list of every change it made, next to the original wording.</li>
        <li>Check completeness yourself against the original.</li>
      </ul>
    </div></details>

    <details class="faq-item"><summary><h3>It made a file when I wanted a short answer. How do I fix that?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <p>Say what you want the result to look like: "Answer in three sentences, right here in the chat. No files." The format is part of the prompt.</p>
    </div></details>

    <details class="faq-item"><summary><h3>How do I know whether a task is a good fit for AI?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <div class="faq-table"><table><thead><tr><th>Good fit</th><th>Use with care</th><th>Keep it human</th></tr></thead><tbody>
        <tr><td>Well-defined, structure-heavy work with nothing sensitive: drafts, outlines, reformatting, summaries you'll check</td><td>Work where you lead and AI speeds you up: analysis, reviews, recommendations you'll validate</td><td>Confidential information you're not cleared to share, personal matters about real people, decisions you alone are accountable for</td></tr>
      </tbody></table></div>
    </div></details>

    <details class="faq-item"><summary><h3>What should I check before AI-assisted work goes out?</h3><?= $tag('settled') ?></summary><div class="faq-a">
      <ul>
        <li><strong>Is it true?</strong> Every fact, number and citation checked against a real source.</li>
        <li><strong>Is it current?</strong> Dates, versions and rules still valid today.</li>
        <li><strong>Is it complete?</strong> Nothing required is missing.</li>
        <li><strong>Does it fit?</strong> It's about your situation, not a generic one.</li>
        <li><strong>What if it's wrong?</strong> The higher the stakes, the deeper the check.</li>
      </ul>
    </div></details>
  </section>

  <div class="faq-sources">
    <h2>Sources</h2>
    <ul>
      <li><?= $sources['vectara'] ?></li>
      <li><?= $sources['stanford'] ?></li>
      <li><?= $sources['canaries'] ?></li>
      <li><?= $sources['metr'] ?></li>
      <li><?= $sources['emergence'] ?></li>
      <li>Jeff Hawkins, <em>A Thousand Brains</em> (2021), p. 167</li>
      <li>Shane Legg and Marcus Hutter, "Universal Intelligence: A Definition of Machine Intelligence" (2007)</li>
    </ul>
  </div>

  <div class="cta-row" style="justify-content:flex-start; margin-top:40px;">
    <a href="<?= site_url('/') ?>#waitlist-hero-anchor" class="btn btn-primary">Get On The Waitlist</a>
    <a href="<?= site_url('blog') ?>" class="btn btn-ghost">Read the Blog</a>
  </div>

</div>

<?= $this->endSection() ?>
