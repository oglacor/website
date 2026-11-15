# Legal pages in eleven languages: status and notes for the reviewers

Added 2026-11-15 (batch W1). Gauden, 2026-11-15: "The legal pages you can
translate. But those should live in bluerabbit.io, not in the app itself."

## Status: MACHINE TRANSLATIONS, NOT REVIEWED, APPROVED FOR PUBLISHING

- **Every translation was made by an AI (Claude) on 2026-11-15.** No lawyer and
  no native speaker has reviewed any of them. Each translated page shows its
  reader a notice saying so, in its language, with a link to the English, which
  is the reference text. Each view's header comment says the same.
- **Gauden approved publishing them on 2026-11-15, before review.** They go live
  with the next deploy of this site. The legal and native review is still to
  follow; the notice stays on each page until its language is reviewed.
- The English itself is a draft "for a lawyer to review"; that review is planned
  for January 2027. Review the English first, then each language against it.
- To take a language off the site, remove its code from
  `App\Libraries\Legal::LANGUAGES` (its routes and its link in the language strip
  go with it).
- Once a language is reviewed: correct its three views, stop showing the notice
  for it (`app/Views/pages/legal/page.php` shows it on every translation today;
  make it skip the reviewed codes) and record the review here and in
  BUILD-STATUS.md.

## Where everything is

| What | Where |
|---|---|
| English (the original) | `app/Views/pages/{terms,privacy,refunds}.php` |
| Translations | `app/Views/pages/legal/{code}/{terms,privacy,refunds}.php`, inside `app/Views/pages/legal/page.php` |
| Interface words (tabs, notice, version line) | `app/Language/{code}/Legal.php` (`en` included) |
| Languages, addresses, business details | `App\Libraries\Legal` (`LANGUAGES`, `url()`, `languageFor()`, `details()`) |
| Routes | `app/Config/Routes.php`, built from `Legal::LANGUAGES` |

Codes: `de`, `es` (es-MX), `fr`, `it`, `ja`, `ko`, `pt-br`, `ru`, `tr`, `zh-cn`.
Addresses: `/{code}/terms`, `/{code}/privacy`, `/{code}/refunds`; `/terms?lang=es_MX`
(the app's locale names work) forwards to the translation.

## How they were made

- Terms and Refunds, and Part 1 of the Privacy Policy (the app), reuse the app's
  own machine translations word for word (`blue` repo,
  `docs/claude/website-handover/legal/*.md`, made 2026-11-15 in the app's
  register: du, tu, tú, você; vous, вы, siz; with the app's translated menu
  names). Only what the site's English adds was translated fresh: the opening
  naming play.bluerabbit.io, the links into the app, and the sentences for blank
  settings.
- The Privacy Policy's intro, Part 2 (this website) and "For both" were
  translated fresh, mirroring the site's English section for section.
- The brand is written BLUERABBIT, as on the rest of the site.
- The business details (`{{company}}`, contact email, address, governing law) are
  the same Admin -> Settings -> Legal values as the English. Each language words
  its own sentence for a blank value.

## For every language

- **The governing law** is printed as entered, inside the translated sentence
  ("las leyes de ___", "законодательством ___"). A value that needs an article or
  a grammatical case in a language (French du / de la, Russian genitive, Turkish
  genitive, Spanish "el estado de...") reads wrong there. Enter it so it reads in
  every language, or check each page once it is set.
- **"Cookie Settings"** is named in each language, but the site's footer button
  and cookie panel are English only today.
- Only the legal pages are translated: the site's header, footer and cookie panel
  stay in English around them.

## Notes for each language's reviewer (written by the translating agents)


### es (from es_MX): notes for the reviewer

- Register: tú, as the app's es_MX files. UI names from the app: *Suscripción → Administrar facturación*, *Mi Cuenta → Tus datos → Descargar / Eliminar mi cuenta*. "Game Master" stays in English, as in the app's md. "the app" = "la app" (the app's own word).
- Format: the menu links keep the English's italics inside the link text, `[*Suscripción → Administrar facturación*]({{app_url}}/subscription)`; the converter needs to accept `*...*` inside `[...]`.
- Blank e-mail: the verb moved inside the conditional so both branches read naturally: `{{if email}}escribe a {{email}}{{else}}escríbenos a través de [nuestra página de contacto](/contact){{end}}` (Terms 5, Refunds, Privacy twice). Terms 14 and Privacy Contact keep the English's bare "Preguntas: [nuestra página de contacto]".
- Blank company: "el operador de BLUERABBIT"; in Privacy it gives "El operador de BLUERABBIT opera BLUERABBIT", as repetitive as the English.
- Terms 14: "las leyes de {{jurisdiction}}". A value that starts with "el" (e.g. "el estado de Delaware") would print "de el"; enter it without the article ("Delaware, EE. UU.") or check the wording when the value is set.
- *Cookie Settings* (Privacy, Cookies) is translated as *Configuración de cookies*; the site's footer button is English only today, so the page names a button that does not exist in Spanish yet.
- Legal terms a lawyer should look at: "UK/EU GDPR" = "el RGPD del Reino Unido o de la UE"; "standard contractual safeguards" = "cláusulas contractuales tipo" (the app's wording); "legitimate interest" = "interés legítimo"; "legal basis" = "base jurídica".
- Fresh wording to check first: "retargeting pixels" = "píxeles de reorientación publicitaria"; "Waitlist emails" (how long) = "Correos de la lista de espera" (meaning the addresses); "a short rolling window" = "un periodo corto y luego se descartan, de forma continua"; "For both" = "Para ambos"; "marketing pages" = "páginas promocionales".
- No difference in substance between the app's translation and the site's English beyond the ones the brief lists.

### pt-br (from pt_BR): notes for the reviewer

- Register: você, as the app's pt_BR files. UI names from the app: *Assinatura → Gerenciar cobrança*, *Minha conta → Seus dados → Baixar / Excluir minha conta*. The app's md says "Mestre do jogo" for Game Master; kept. "the app" = "o app" (the app's own word). The brand takes the article: "o BLUERABBIT".
- Blank e-mail: the verb sits inside the conditional, `{{if email}}escreva para {{email}}{{else}}escreva para nós pela [nossa página de contato](/contact){{end}}`. Terms 14 and Privacy Contact keep the English's bare "Dúvidas: [nossa página de contato]".
- Blank company: "o operador do BLUERABBIT".
- Terms 14: "pelas leis de {{jurisdiction}}"; a value that starts with an article ("o Estado de Delaware") would print "de o"; enter it without the article or check the wording when it is set.
- Eyebrow "Legal" is "Jurídico" (in Brazilian Portuguese "Legal" also reads as "cool").
- *Cookie Settings* is translated as *Configurações de cookies*; the site's footer button is English only today.
- Legal terms to check: "UK/EU GDPR" = "o RGPD do Reino Unido ou da UE" (Brazilian readers may know it as GDPR); "legitimate interest" = "legítimo interesse" (the app's wording, as in the LGPD); "standard contractual safeguards" = "cláusulas contratuais padrão" (the app's wording); "legal basis" = "base legal".
- Fresh wording to check first: "retargeting pixels" = "pixel de redirecionamento de anúncios"; "analytics" = "análise"; "a short rolling window" = "por um curto período, renovado continuamente"; "marketing pages" = "páginas de apresentação"; "For both" = "Para ambos".

### fr (from fr_FR): notes for the reviewer

- Register: vous, as the app's fr_FR files. UI names from the app: *Abonnement → Gérer la facturation*, *Mon compte → Vos données → Télécharger / Supprimer mon compte*. "Game Master" is "maître du jeu" as in the app's md.
- "the app" is "l’application", not the app's own short "l’appli": a legal page reads better in full. Change it if the app's word should win.
- Typography follows the app's md: curly apostrophe ’, « guillemets », and an ordinary space before : ; (not a non-breaking one). The converter may want to turn those spaces into non-breaking ones so a colon never starts a line.
- Blank e-mail: the verb sits inside the conditional, `{{if email}}écrivez à {{email}}{{else}}écrivez-nous via [notre page de contact](/contact){{end}}`. Terms 14 and Privacy Contact keep the English's bare "Questions : [notre page de contact]".
- Blank company: "l’exploitant de BLUERABBIT" (Privacy: "L’exploitant de BLUERABBIT exploite BLUERABBIT", as repetitive as the English).
- Terms 14: "par le droit de {{jurisdiction}}"; French needs "du / de la / des" before most place names ("le droit de l’État du Delaware", "le droit français"). The jurisdiction value has to be entered in a form that reads after "de", or this sentence reworded when it is set.
- *Cookie Settings* is translated as *Paramètres des cookies*; the site's footer button is English only today.
- "Analytics" is "mesure d’audience" (the CNIL's term).
- Legal terms to check: "UK/EU GDPR" = "le RGPD de l’UE ou du Royaume-Uni"; "legitimate interest" = "intérêt légitime"; "legal basis" = "base juridique"; "standard contractual safeguards" = "clauses contractuelles types" (the app's wording); "complain to your national data protection authority" = "introduire une réclamation auprès de votre autorité nationale de protection des données".
- Fresh wording to check first: "retargeting pixels" = "pixel de reciblage"; "Waitlist emails" (how long) = "Adresses de la liste d’attente"; "a short rolling window" = "une courte période glissante"; "For both" = "Commun aux deux"; "marketing pages" = "pages de présentation".

### it (from it_IT): notes for the reviewer

- Register: tu, as the app's it_IT files. UI names from the app: *Abbonamento → Gestisci fatturazione*, *Il mio account → I tuoi dati → Scarica / Elimina il mio account*. "Game Master" stays in English, as in the app's md. "the app" = "l’app" (the app's own word).
- Blank e-mail: the verb sits inside the conditional, `{{if email}}scrivi a {{email}}{{else}}scrivici tramite la [nostra pagina dei contatti](/contact){{end}}`. Terms 14 and Privacy Contact keep the English's bare form: "Domande: [la nostra pagina dei contatti]".
- Blank company: "il gestore di BLUERABBIT" (Privacy: "Il gestore di BLUERABBIT gestisce BLUERABBIT", as repetitive as the English).
- Terms 14: "dalle leggi di {{jurisdiction}}"; a value that needs an article in Italian ("dello Stato del Delaware") reads wrong after "di"; check the sentence when the value is set.
- *Cookie Settings* is translated as *Impostazioni cookie*; the site's footer button is English only today.
- Legal terms to check: "UK/EU GDPR" = "il GDPR del Regno Unito o dell’UE" (Italian usage; the other languages of this batch use RGPD / DSGVO); "legitimate interest" = "legittimo interesse" (the app's wording); "legal basis" = "base giuridica"; "standard contractual safeguards" = "clausole contrattuali tipo" (the app's wording); "withdraw consent" = "revocare il consenso".
- Fresh wording to check first: "retargeting pixels" = "pixel per la pubblicità mirata" (paraphrase; "pixel di retargeting" is what Italian marketing writes); "browser user agent" = "identificativo del browser"; "debugging" = "risoluzione dei problemi"; "a short rolling window" = "un breve periodo a scorrimento"; "For both" = "Per entrambi"; "two places" = "due ambiti".

### de (from de_DE): notes for the reviewer

- Register: du, as the app's de_DE files. UI names from the app: *Abonnement → Abrechnung verwalten*, *Mein Konto → Deine Daten → Herunterladen / Mein Konto löschen*. "Game Master" is "Spielleiter" as in the app's md. "the app" = "die App" (the app's own word).
- "in the app" moved before the menu path ("in der App unter [*Abonnement → Abrechnung verwalten*]"), German word order; same facts.
- Blank e-mail: the verb sits inside the conditional, `{{if email}}schreib an {{email}}{{else}}schreib uns über [unsere Kontaktseite](/contact){{end}}`. Terms 14 and Privacy Contact keep the English's bare "Fragen: [unsere Kontaktseite]".
- Blank company: "dem Betreiber von BLUERABBIT" in the Terms (dative after "zwischen dir und"), "Der Betreiber von BLUERABBIT" in Privacy. If {{company}} is set it is printed as is in both places.
- No comma before "oder per Post an {{address}}" (German usage, as in the app's md).
- Terms 14: "dem Recht von {{jurisdiction}}"; fine for a bare place name ("Delaware, USA"), reads wrong for "der Staat Delaware"; check when the value is set.
- *Cookie Settings* is translated as *Cookie-Einstellungen*; the site's footer button is English only today.
- Legal terms to check: "UK/EU GDPR" = "die DSGVO der EU oder die UK-DSGVO"; "legitimate interest" = "berechtigtes Interesse"; "legal basis" = "Rechtsgrundlage"; "standard contractual safeguards" = "Standardvertragsklauseln" (the app's wording); "profiling" = "Profiling" (the DSGVO's own German term); "withdraw consent" = "Einwilligung widerrufen".
- English loan words kept because German uses them: Tag-Manager, Heatmaps, Bots, Token, Hosting-Anbieter, Marketingseiten. "Retargeting pixels" is paraphrased as "Pixel zur erneuten Werbeansprache"; a reviewer may prefer the usual "Retargeting-Pixel".
- Fresh wording to check first: "a short rolling window" = "ein kurzes, rollierendes Zeitfenster"; "For both" = "Für beide"; "two places" = "zwei Bereiche".

### ja (from ja): notes for the reviewer

- Register: です/ます with お客様, as the app's ja files. The app's files use 当社 in the Terms and Refunds but 私たち in the Privacy Policy; each page keeps its own. UI names from the app: *サブスクリプション → 請求を管理*, *マイアカウント → あなたのデータ → ダウンロード / アカウントを削除*. Game Master = ゲームマスター, "the app" = アプリ, "sign in" = サインイン (the app's words).
- Punctuation: the app's ja md uses ASCII `( )` and `:`. I used full-width （ ） and ：, as the app's own ja UI strings do (`app/Language/ci4/ja.php`). Otherwise the words are the app's own. A diff against the app's md will show these changes.
- Format: bold labels end in full-width punctuation and no space follows, e.g. `**アカウント：**メール…` and `**必須（常に有効）。**サインイン…`. The converter must pair `**` by simple matching. CommonMark's flanking rules would not close the bold before a CJK letter. zh-cn has the same issue. I kept one space before an italic menu path (`**アカウントの削除：** *マイアカウント…*`) so the text never contains `***`.
- Blank e-mail: Terms 5 and Refunds read "…から、[お問い合わせページ](/contact)を通じてご連絡ください". Terms 14 and Privacy Contact read "お問い合わせ：[お問い合わせページ](/contact)より", which avoids a bare "お問い合わせ：お問い合わせページ".
- Blank company: the Terms read "BLUERABBIT の運営者（以下「当社」）". The Privacy opening now makes the company the subject, as the English does ("{{company}} は BLUERABBIT を運営し…"). The app's sentence ("BlueRabbit は {{company}} が運営しており…") left unclear who is responsible.
- Terms 14 and Privacy Contact have no closing 。, the label style of the app's md.
- *Cookie Settings* is translated as *Cookie 設定*. The site's footer button exists only in English today.
- Legal terms to check: "UK/EU GDPR" = 英国・EU の GDPR; "legitimate interest" = 正当な利益 (the app's wording); "legal basis" = 法的根拠; "standard contractual safeguards" = 標準契約条項 (the app's wording); "portable format" = ポータブルな形式; "withdraw consent" = 同意を撤回.
- New wording to check first: "waitlist" = ウェイトリスト (事前登録リスト is a softer alternative); "analytics" = アクセス解析; "retargeting pixels" = リターゲティングピクセル; "Waitlist emails" under how long we keep it = ウェイトリストのメールアドレス (the addresses); "a short rolling window" = 短い期間だけ順次保管し、その後破棄; "Part 1 / 2" = 第 1 部 / 第 2 部; "For both" = 両方に共通する事項.
- In substance, the app's translation and the site's English differ only in the ways the brief lists.

### ko (from ko_KR): notes for the reviewer

- Register: -습니다 / -세요 with 회원님 and 저희, as the app's ko_KR files. UI names from the app: *구독 → 결제 관리*, *내 계정 → 내 데이터 → 다운로드 / 내 계정 삭제*. Game Master = 게임 마스터, "the app" = 앱, "sign in" = 로그인 (the app's words). Punctuation is the app's (ASCII, as Korean uses it).
- Particles: BLUERABBIT takes 은/을/이, as in the app (read 블루래빗, which ends in a consonant). In the Privacy opening `{{company}}` takes 은(는), the same placeholder style as the app's 이(가), because the right particle depends on how the name ends.
- Blank e-mail: the branch carries the particle: "{{email}}에 / [문의 페이지](/contact)를 통해 저희에게 연락해 주세요". Terms 14 and Privacy Contact keep the English's bare form, "문의: [문의 페이지](/contact)", which is a little repetitive. A reviewer may prefer "문의하기 페이지".
- Blank company: "BLUERABBIT 운영자". The Privacy opening now makes the company the subject, as the English does. The app's sentence had BLUERABBIT as the topic and left unclear who is responsible.
- *Cookie Settings* is translated as *쿠키 설정*. The site's footer button exists only in English today.
- Legal terms to check: "UK/EU GDPR" = 영국 또는 EU의 GDPR; "legitimate interest" = 정당한 이익 (the app's wording); "legal basis" = 법적 근거; "standard contractual safeguards" = 표준 계약 조항 (the app's wording); "International transfers" = 국외 이전 (the usual Korean privacy-law term); "portable format" = 이동 가능한 형식.
- New wording to check first: "waitlist" = 대기자 명단; "marketing pages" = 홍보 페이지; "retargeting pixels" = 리타기팅 픽셀; "a short rolling window" = 짧은 기간 동안 순차적으로 보관한 뒤 폐기; "Part 1" = 1부; "For both" = 두 곳 공통.
- In substance, the app's translation and the site's English differ only in the ways the brief lists.

### zh-cn (from zh_CN): notes for the reviewer

- Register: 你 (not 您) and 我们, as the app's zh_CN files. UI names from the app: *订阅 → 管理账单*, *我的账号 → 你的数据 → 下载 / 删除我的账号*. Game Master = 游戏管理员, "the app" = 应用, "sign in" = 登录 (the app's words).
- Punctuation: the app's zh md uses ASCII `, ( ) : ;` throughout. That looks like an artefact, because the app's own zh_CN UI strings use full-width punctuation (805 full-width commas in `app/Language/ci4/zh_CN.php`). I replaced all of it with full-width ，（ ）：；. Otherwise the words are the app's own. A diff against the app's md will show these changes.
- Format: as in ja, bold labels are followed directly by text (`**你的账号：**电子邮箱…`, `**前 30 天免费。**开始试用时`, as the app's md already had). The converter must pair `**` by simple matching, not by CommonMark's flanking rules. I kept one space before the italic menu path so the text never contains `***`.
- Blank e-mail: the verb sits in both branches: "{{if email}}发送邮件至 {{email}}{{else}}通过[我们的联系页面](/contact)联系我们{{end}}". Terms 14 and Privacy Contact keep the English's bare form, "如有疑问：[我们的联系页面](/contact)。".
- Blank company: "BLUERABBIT 的运营方". The Privacy opening makes the company the subject ("{{company}} 负责运营 BLUERABBIT，并对…承担责任"), as the English does.
- *Cookie Settings* is translated as *Cookie 设置*. The site's footer button exists only in English today.
- notice: "英文版本为参考原文" (the reference text). I avoided the usual "以英文版本为准", which would claim that the English version prevails legally.
- Legal terms to check: "UK/EU GDPR" = 英国或欧盟的 GDPR; "legitimate interest" = 正当利益 (the app's wording); "legal basis" = 法律依据; "standard contractual safeguards" = 标准合同条款 (the app's wording); "profiling" = 用户画像; "portable format" = 可携带的格式.
- New wording to check first: "waitlist" = 候补名单; "marketing pages" = 营销页面; "retargeting pixels" = 再营销像素; "a short rolling window" = 一个较短的滚动周期; "Part 1" = 第 1 部分; "For both" = 适用于两者. I gave the cookie labels a noun (必要 Cookie, 分析 Cookie) where the English has only "Essential" and "Analytics".
- In substance, the app's translation and the site's English differ only in the ways the brief lists.

### ru (from ru_RU): notes for the reviewer

- Register: вы (lower case), as the app's ru_RU files. UI names from the app: *Подписка → Управлять оплатой*, *Моя учётная запись → Ваши данные → Скачать / Удалить мою учётную запись*. Game Master = ведущий, A.I. = ИИ, "the app" = приложение (the app's words). Typography is the app's: «ёлочки», em dash, ё.
- "in the app" plus a menu link: "в приложении, в разделе [*Подписка → Управлять оплатой*]". In Refunds I wrote "откройте раздел [Подписка]" where the app's md has "откройте [Подписка]" (a menu name in the nominative straight after the verb).
- Blank e-mail: the verb sits in both branches: "напишите на {{email}}" / "напишите нам через [нашу страницу контактов](/contact)". Terms 14 and Privacy Contact keep the English's bare form, "Вопросы: [наша страница контактов](/contact)".
- Blank company: "оператором BLUERABBIT" in the Terms (instrumental, after "между вами и"), "Оператор BLUERABBIT" in Privacy. `{{company}}` is printed as is and treated as an indeclinable Latin-script name, as the app does with BLUERABBIT.
- Terms 14: "законодательством {{jurisdiction}}" needs the value in the genitive ("штата Делавэр (США)"). An English value ("Delaware") would print in Latin letters and without the case ending, so check the sentence when the value is set.
- *Cookie Settings* is translated as *Настройки cookie*. The site's footer button exists only in English today.
- Legal terms to check: "UK/EU GDPR" = GDPR Великобритании или ЕС; "legitimate interest" = законный интерес (the app's wording); "legal basis" = правовое основание; "standard contractual safeguards" = стандартные договорные условия (the app's wording; "стандартные договорные положения" is also used); "profiling" = профилирование; "portable format" = переносимый формат.
- New wording to check first: "waitlist" = список ожидания; "browser user agent" = идентификатор браузера; "retargeting pixels" = пиксели ретаргетинга; "a short rolling window" = короткий скользящий период; "marketing pages" = маркетинговые страницы; "Part 1" = Часть 1.; "For both" = Общее для обоих.
- In substance, the app's translation and the site's English differ only in the ways the brief lists.

### tr (from tr_TR): notes for the reviewer

- Register: siz, as the app's tr_TR files. UI names from the app: *Abonelik → Faturalandırmayı yönet*, *Hesabım → Verileriniz → İndir / Hesabımı sil*. Game Master = oyun yöneticisi, A.I. = yapay zekâ, "the app" = uygulama, "sign in" = oturum açmak (the app's words). BLUERABBIT takes 'in / 'i / 'e, as in the app.
- Blank e-mail: Turkish is verb-final, so the verb stays outside the condition and the branch carries the target: "{{email}} adresine / [iletişim sayfamız](/contact) üzerinden bize … yazın". Terms 14 and Privacy Contact keep the English's bare form, "Sorular: [iletişim sayfamız](/contact)".
- Blank company: "BLUERABBIT'in işletmecisi". `{{company}}` stands where it needs no suffix, so a company name never has to take one.
- Terms 14: "{{jurisdiction}} yasalarına tabidir" works with a bare place name ("Delaware"). A value that needs the genitive ("Delaware eyaletinin") reads wrong, so check it when the value is set. "ya da posta yoluyla {{address}}" is the app's wording.
- "hash" stays in brackets after "özet", as in the app's md.
- "unsubscribe" is "abonelikten çıkma bağlantısı" (the usual e-mail wording), but "listeden çıkmak" under how long we keep it, because "Abonelik" is also the paid plan's menu.
- *Cookie Settings* is translated as *Çerez Ayarları*. The site's footer button exists only in English today.
- Legal terms to check: "UK/EU GDPR" = Birleşik Krallık ya da AB GDPR'si (Turkey's own KVKK is not mentioned, because the English does not mention it); "legitimate interest" = meşru menfaat (the app's wording); "legal basis" = hukuki dayanak; "standard contractual safeguards" = standart sözleşme hükümleri (the app's wording); "portable format" = taşınabilir biçim.
- New wording to check first: "waitlist" = bekleme listesi; "marketing pages" = tanıtım sayfaları; "retargeting pixels" = yeniden hedefleme pikseli; "browser user agent" = tarayıcının kullanıcı aracısı; "a short rolling window" = kısa ve sürekli yenilenen bir süre; "Part 1" = Bölüm 1; "For both" = Her ikisi için.
- In substance, the app's translation and the site's English differ only in the ways the brief lists.
