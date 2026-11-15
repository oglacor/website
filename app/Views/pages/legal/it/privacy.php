<?php
/*
 * Italian translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /it/privacy.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>Il gestore di BLUERABBIT<?php endif ?> gestisce BLUERABBIT ed è responsabile dei dati personali che conserva su di te. Questa informativa riguarda due ambiti:</p>
    <ul>
      <li><strong>L’app BLUERABBIT</strong> su <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, dove si trovano le avventure, gli account dei giocatori e gli abbonamenti (Parte 1).</li>
      <li><strong>Questo sito web</strong>, bluerabbit.io: le pagine di presentazione, il blog, la documentazione, la lista d’attesa e il modulo di contatto (Parte 2).</li>
    </ul>
    <p>Sono sistemi separati, con account separati: un account del sito qui non è un account dell’app, e nessuno dei due ti permette di accedere all’altro. Le organizzazioni che usano BLUERABBIT su un proprio indirizzo in base a un accordo separato con noi sono coperte da quell’accordo.</p>

    <h2>Parte 1: L’app BLUERABBIT</h2>

    <h3>Cosa conserviamo</h3>
    <ul>
      <li><strong>Il tuo account:</strong> indirizzo email, nickname, il nome che indichi e una password conservata solo come hash irreversibile. Dati facoltativi del profilo (foto, biografia, azienda, link), se li aggiungi.</li>
      <li><strong>Cosa fai nelle avventure:</strong> progressi, XP, livelli, obiettivi e oggetti, le tue risposte e i file caricati, messaggi, post in bacheca e richieste di aiuto, e l’attività che forma la tua cronologia.</li>
      <li><strong>Pagamenti:</strong> il tuo piano, lo stato dell’abbonamento e le fatture. Stripe conserva la tua carta; noi conserviamo solo un riferimento alla tua scheda cliente Stripe.</li>
      <li><strong>Sicurezza:</strong> un registro degli accessi (ogni accesso, tentativo fallito, blocco e reimpostazione della password, con l’indirizzo internet e il browser di provenienza) e la conferma del tuo indirizzo email.</li>
      <li><strong>Cookie:</strong> solo quelli necessari al servizio: un cookie di sessione che ti mantiene connesso e uno che protegge i tuoi moduli dalla falsificazione. Cloudflare e la sua verifica Turnstile, che bloccano le registrazioni automatiche, possono impostare propri cookie di sicurezza. Non usiamo cookie pubblicitari.</li>
    </ul>

    <h3>Perché li conserviamo</h3>
    <ul>
      <li>Per fornire il servizio a cui ti sei iscritto: il tuo account, le tue avventure, il tuo piano (il nostro contratto con te).</li>
      <li>Per mantenere sicuri gli account e il servizio: il registro degli accessi, i blocchi, i controlli contro gli abusi (il nostro legittimo interesse alla sicurezza).</li>
      <li>Per adempiere agli obblighi di legge, come conservare le fatture per il tempo richiesto dalla normativa fiscale.</li>
      <li>Per scriverti riguardo al tuo account: conferme, reimpostazioni della password, avvisi sulla prova e sui pagamenti. Le email delle avventure si possono disattivare dal link che contengono.</li>
    </ul>
    <p>Non vendiamo i tuoi dati e non li usiamo per la pubblicità.</p>

    <h3>Chi li vede</h3>
    <ul>
      <li><strong>In un’avventura</strong>, i Game Master e lo staff che la gestiscono vedono i tuoi progressi e i lavori che consegni. Gli altri giocatori vedono il tuo nome, livello, XP e obiettivi nelle classifiche e negli elenchi delle gilde, mai il tuo indirizzo email.</li>
      <li><strong>Le aziende che lavorano per noi</strong>, ciascuna solo per la propria parte: Stripe (pagamenti), Resend (invio delle email), Cloudflare (distribuzione del sito e protezione dagli attacchi), Anthropic (le funzioni di I.A., quando un’avventura le attiva) e il nostro fornitore di hosting. Trattano i tuoi dati secondo le nostre istruzioni.</li>
      <li><strong>Le autorità</strong>, solo quando la legge lo richiede.</li>
    </ul>

    <h3>Per quanto tempo li conserviamo</h3>
    <ul>
      <li>Il tuo account e ciò che hai creato: finché non cancelli l’account.</li>
      <li>Il registro degli accessi: 12 mesi, poi viene cancellato automaticamente.</li>
      <li>Fatture e dati di pagamento: per il tempo richiesto dalla normativa fiscale e contabile.</li>
      <li>Dopo la cancellazione dell’account, i tuoi punteggi possono restare nelle statistiche e nelle classifiche di un’avventura con un nome anonimo, così che i risultati degli altri giocatori restino corretti. Nulla in essi ti identifica.</li>
    </ul>

    <h3>I tuoi diritti nell’app</h3>
    <ul>
      <li><strong>Vedere e portare con te i tuoi dati:</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>Il mio account → I tuoi dati → Scarica</em></a> ti consegna in un unico file tutto ciò che conserviamo su di te.</li>
      <li><strong>Cancellare il tuo account:</strong> <em>Il mio account → I tuoi dati → Elimina il mio account</em> rimuove la tua identità ovunque, cancella le tue conversazioni e i file caricati e chiude ogni sessione. Prima annulla qualsiasi abbonamento attivo.</li>
      <li><strong>Correggerli:</strong> modifica il tuo profilo in qualsiasi momento.</li>
      <li><strong>Opporti, chiedere una limitazione o fare una domanda:</strong> <?php if ($legal['email'] !== ''): ?>scrivi a <?= $emailLink ?><?php else: ?>scrivici tramite la <a href="<?= site_url('contact') ?>">nostra pagina dei contatti</a><?php endif ?>.</li>
    </ul>

    <h2>Parte 2: Questo sito web</h2>

    <h3>Cosa raccogliamo</h3>
    <p>Solo ciò di cui ha davvero bisogno la pagina che stai usando. Ecco l’elenco completo:</p>
    <ul>
      <li><strong>Iscrizioni alla lista d’attesa</strong> — il tuo indirizzo email e la pagina da cui ti sei iscritto. Nient’altro.</li>
      <li><strong>Modulo di contatto</strong> — il tuo nome, l’indirizzo email, l’oggetto e il messaggio che scrivi.</li>
      <li><strong>Account del sito</strong> — se registri un account su questo sito, il tuo nome, l’indirizzo email e una versione della password protetta da un hash sicuro. Non conserviamo mai la password in sé e non possiamo leggerla.</li>
      <li><strong>Cookie di sessione</strong> — un unico cookie che ti mantiene connesso mentre usi il sito.</li>
      <li><strong>Registri del server</strong> — registrazioni standard delle richieste web (indirizzo IP, identificativo del browser, pagina richiesta, data e ora), conservate per la sicurezza e per la risoluzione dei problemi.</li>
    </ul>

    <h3>Cosa non facciamo</h3>
    <p>Vale la pena dirlo chiaramente, perché è abbastanza insolito da meritare una verifica:</p>
    <ul>
      <li>Nessuno script di analisi o di tracciamento. Niente Google Analytics, niente gestore di tag, niente registrazione delle sessioni, niente mappe di calore.</li>
      <li>Nessun cookie pubblicitario, nessun pixel per la pubblicità mirata, nessuno strumento di tracciamento di terze parti di alcun tipo.</li>
      <li>Nessuna vendita, affitto o scambio delle tue informazioni personali. A nessuno, a nessun prezzo.</li>
      <li>Nessuna profilazione e nessun processo decisionale automatizzato che ti riguardi.</li>
    </ul>

    <h3>Cookie</h3>
    <ul>
      <li><strong>Essenziali (sempre attivi).</strong> Un cookie di sessione che ti mantiene connesso, un token di sicurezza che impedisce ad altri siti di inviare i nostri moduli a tuo nome, un cookie che registra la tua scelta descritta qui sotto e un cookie impostato da Cloudflare che distingue i visitatori reali dai bot. Sono strettamente necessari al funzionamento del sito, quindi non richiedono consenso e non possono essere disattivati — ma non contengono dati pubblicitari e non vengono usati per profilarti.</li>
      <li><strong>Analisi (a tua scelta).</strong> Statistiche anonime su quali pagine vengono lette. <strong>Al momento non usiamo alcun tipo di analisi.</strong> Se la introdurremo, verrà caricata solo per chi l’avrà accettata attivamente — la tua scelta viene registrata in anticipo e rispettata automaticamente.</li>
    </ul>
    <p><strong>Cambiare idea.</strong> Usa il link <em>Impostazioni cookie</em> nel piè di pagina di qualsiasi pagina per rivedere o cambiare la tua scelta in qualsiasi momento. Revocare il consenso è facile esattamente quanto darlo, e ha effetto immediato. Inoltre te lo chiediamo di nuovo dopo dodici mesi, invece di considerare permanente una vecchia risposta. Rifiutare l’analisi non ti costa nulla — ogni parte di questo sito funziona allo stesso identico modo in entrambi i casi.</p>

    <h3>Perché li usiamo</h3>
    <ul>
      <li><strong>Per risponderti</strong> — i messaggi del modulo di contatto esistono perché una persona possa rispondere alla tua domanda.</li>
      <li><strong>Per parlarti di BLUERABBIT</strong> — se ti sei iscritto alla lista d’attesa, ti scriviamo sulla disponibilità e sulle novità del lancio. È l’unico motivo per cui la lista esiste.</li>
      <li><strong>Per gestire il tuo account</strong> — autenticarti e mantenerti connesso.</li>
      <li><strong>Per mantenere il sito funzionante e sicuro</strong> — registri, prevenzione degli abusi e risoluzione dei problemi.</li>
    </ul>
    <p>Dove la legge richiede una base giuridica (ad esempio il GDPR del Regno Unito o dell’UE), ci basiamo sul tuo consenso per le email della lista d’attesa, e sul nostro legittimo interesse a rispondere alle richieste, gestire il sito e mantenerlo sicuro per tutto il resto.</p>

    <h3>Chi altro tratta i tuoi dati</h3>
    <ul>
      <li><strong>Resend</strong> — invia le nostre email transazionali e quelle della lista d’attesa. Riceve il tuo indirizzo email e il contenuto del messaggio.</li>
      <li><strong>Cloudflare</strong> — si trova davanti al sito per la sicurezza, la protezione dagli attacchi DDoS e le prestazioni. Tratta i metadati delle richieste, compreso il tuo indirizzo IP.</li>
      <li><strong>Il nostro fornitore di hosting</strong> — ospita il sito e la sua banca dati.</li>
      <li><strong>jsDelivr</strong> — fornisce la libreria dell’editor di testo formattato, ma solo nelle pagine di amministrazione, ad accesso effettuato. I visitatori comuni non la caricano mai.</li>
    </ul>

    <h3>Per quanto tempo li conserviamo</h3>
    <ul>
      <li><strong>Email della lista d’attesa</strong> — finché non annulli l’iscrizione o ci chiedi di rimuoverti.</li>
      <li><strong>Messaggi di contatto</strong> — finché la richiesta non è risolta e non ci serve più per i nostri archivi.</li>
      <li><strong>Account del sito</strong> — finché l’account esiste. Se elimini l’account, i relativi dati vengono eliminati con esso.</li>
      <li><strong>Registri del server</strong> — per un breve periodo a scorrimento, poi vengono eliminati.</li>
    </ul>

    <h3>Le tue scelte su questo sito web</h3>
    <p>Per annullare l’iscrizione alle email della lista d’attesa, usa il link di disiscrizione in fondo a qualsiasi email che ti inviamo — funziona subito e non richiede alcuna risposta da parte nostra. Per vedere, correggere, cancellare o ottenere una copia di qualsiasi altro dato che conserviamo qui, <?php if ($legal['email'] !== ''): ?>scrivi a <?= $emailLink ?><?php else: ?>scrivici tramite la <a href="<?= site_url('contact') ?>">nostra pagina dei contatti</a><?php endif ?>. Tutto questo è gratuito, e non ti chiederemo di giustificare la richiesta.</p>

    <h2>Per entrambi</h2>

    <h3>I tuoi diritti</h3>
    <p>Puoi chiederci di mostrarti ciò che conserviamo su di te, di correggerlo, di cancellarlo o di inviartene una copia in un formato portabile. Puoi anche opporti al modo in cui lo usiamo, o revocare un consenso che hai dato. Se ti trovi nel Regno Unito o nell’UE e pensi che abbiamo sbagliato qualcosa, hai il diritto di presentare reclamo all’autorità nazionale per la protezione dei dati.</p>

    <h3>Sicurezza</h3>
    <p>Entrambi i siti sono serviti tramite HTTPS. Le password sono conservate come hash irreversibile, mai in forma leggibile. L’app blocca un account dopo ripetuti tentativi di accesso falliti e tiene un registro degli accessi; le aree di amministrazione di entrambi i siti richiedono l’autenticazione. Adottiamo misure ragionevoli per proteggere le tue informazioni, anche se nessun sito può promettere una sicurezza perfetta.</p>

    <h3>Minori</h3>
    <p>BLUERABBIT non è destinato ai minori al di sotto dell’età del consenso digitale del luogo in cui vivono, a meno che non li iscriva una scuola, un formatore o un’organizzazione che disponga del consenso richiesto dalla legge. Questo sito web si rivolge a organizzazioni e professionisti; se ritieni che un minore abbia inviato informazioni qui, contattaci e le cancelleremo.</p>

    <h3>Trasferimenti internazionali</h3>
    <p>Alcune delle aziende che lavorano per noi si trovano fuori dal tuo Paese, anche negli Stati Uniti. Dove la legge lo richiede, i trasferimenti sono coperti da clausole contrattuali tipo.</p>

    <h3>Modifiche a questa informativa</h3>
    <p>Quando questa informativa cambia in modo rilevante, pubblichiamo qui la nuova versione con una nuova data e lo comunichiamo ai titolari degli account.</p>

    <h3>Contatti</h3>
    <p>Domande su questa informativa o sui dati che conserviamo: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">la nostra pagina dei contatti</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, oppure per posta a <?= esc($legal['address']) ?><?php endif ?>.</p>
