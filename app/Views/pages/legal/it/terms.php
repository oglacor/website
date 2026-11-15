<?php
/*
 * Italian translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /it/terms.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>Questi termini sono l’accordo tra te e <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>il gestore di BLUERABBIT<?php endif ?> («noi») per l’uso di BLUERABBIT, la piattaforma su <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> per creare e giocare avventure di apprendimento gamificate. Creando un account o usando BLUERABBIT li accetti. Se usi BLUERABBIT per un’organizzazione, li accetti anche per suo conto.</p>

    <h2>1. Il tuo account</h2>
    <ul>
      <li>Fornisci dati veritieri e non condividere la tua password. Tutto ciò che viene fatto con il tuo account è sotto la tua responsabilità.</li>
      <li>Devi avere almeno 16 anni, o l’età del consenso digitale del luogo in cui vivi se è più alta. Un insegnante, un formatore o un’organizzazione che iscrive giocatori più giovani è responsabile di avere il consenso richiesto dalla legge.</li>
      <li>Una persona per account. Gli account che un Game Master o un’organizzazione crea per i giocatori rientrano nell’accordo tra quell’organizzazione e noi.</li>
    </ul>

    <h2>2. Piani</h2>
    <p>Basic è gratuito. BLUERABBIT Pro è un abbonamento a pagamento, mensile o annuale, al prezzo indicato al momento della sottoscrizione, comprese le imposte che dobbiamo applicare. I pagamenti sono gestiti da Stripe; non vediamo né conserviamo mai il numero della tua carta.</p>

    <h2>3. La prova gratuita</h2>
    <p>Il tuo primo abbonamento Pro inizia con una prova gratuita di 30 giorni. Ti chiediamo una carta all’inizio della prova. Al termine della prova, sulla carta viene addebitato il piano scelto, mensile o annuale, a meno che tu non annulli prima. Ti inviamo un’email qualche giorno prima della fine della prova.</p>

    <h2>4. Rinnovo e annullamento</h2>
    <p>Pro si rinnova automaticamente alla fine di ogni mese o anno finché non lo annulli. Puoi annullare in qualsiasi momento da <a href="<?= PLAY_APP_URL ?>/subscription"><em>Abbonamento → Gestisci fatturazione</em></a> nell’app. L’annullamento blocca il rinnovo successivo: mantieni Pro fino alla fine del periodo già pagato, poi il tuo account torna a Basic. Le tue avventure e i tuoi dati restano; le funzioni che richiedono Pro si interrompono.</p>

    <h2>5. Rimborsi</h2>
    <ul>
      <li>Il mese in corso non viene mai rimborsato una volta incassato il relativo pagamento.</li>
      <li>Un piano annuale può essere rimborsato per i mesi non utilizzati: l’importo pagato, meno il prezzo mensile di ogni mese iniziato da quel pagamento (compreso il mese in corso), e mai meno di zero. Ad esempio, con Pro a 80 $ l’anno e 8 $ al mese, un rinnovo annuale che volevi annullare e che ci segnali nel primo mese viene rimborsato con 72 $. Il rimborso di un piano annuale lo termina immediatamente.</li>
      <li>Un piano mensile non viene rimborsato; annullarlo blocca il rinnovo successivo.</li>
      <li>Per chiedere un rimborso, <?php if ($legal['email'] !== ''): ?>scrivi a <?= $emailLink ?><?php else: ?>scrivici tramite la <a href="<?= site_url('contact') ?>">nostra pagina dei contatti</a><?php endif ?> dall’indirizzo email del tuo account. I rimborsi vengono riaccreditati sulla carta con cui hai pagato.</li>
    </ul>
    <p>La <a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">Politica di rimborso</a> lo spiega con altri esempi. Se la legge del luogo in cui vivi ti riconosce più diritti di questa sezione, li hai.</p>

    <h2>6. Variazioni di prezzo</h2>
    <p>Possiamo modificare il prezzo di Pro. Una variazione non riguarda mai un periodo già pagato, e ti avvisiamo almeno 30 giorni prima del tuo primo rinnovo al nuovo prezzo, così puoi annullare prima.</p>

    <h2>7. I tuoi contenuti</h2>
    <p>Ciò che crei o carichi (avventure, tappe, immagini, risposte, messaggi) resta tuo. Ci concedi l’autorizzazione necessaria per conservarlo, mostrarlo alle persone con cui lo condividi e far funzionare il servizio, e nient’altro. Sei responsabile di avere i diritti su ciò che carichi e di ciò che pubblichi per i tuoi giocatori.</p>

    <h2>8. Uso corretto di BLUERABBIT</h2>
    <p>Non usare BLUERABBIT per violare la legge, molestare o danneggiare qualcuno, caricare malware, attaccare o sovraccaricare il servizio, leggere dati che non sono tuoi o aggirare un limite del tuo piano. Non rivendere BLUERABBIT senza il nostro accordo scritto. Possiamo rimuovere contenuti o sospendere un account che lo fa, e ti diremo perché, a meno che la legge o la sicurezza di altre persone non ce lo impedisca.</p>

    <h2>9. Funzioni di I.A.</h2>
    <p>Alcune funzioni (l’assistente Cooper e la valutazione delle risposte con I.A., quando un’avventura le attiva) inviano il testo interessato ad Anthropic, il nostro fornitore di I.A., per produrre una risposta. I risultati dell’I.A. possono essere sbagliati: il Game Master resta responsabile delle decisioni prese con essi.</p>

    <h2>10. Il servizio</h2>
    <p>Lavoriamo per mantenere BLUERABBIT disponibile e i tuoi dati al sicuro, e lo miglioriamo continuamente, il che a volte significa modificare o ritirare una funzione. Se ritiriamo qualcosa da cui dipende un piano a pagamento, te lo diciamo prima. Non siamo responsabili delle perdite causate da eventi al di fuori del nostro ragionevole controllo.</p>

    <h2>11. Fine dell’accordo</h2>
    <p>Puoi smettere di usare BLUERABBIT e cancellare il tuo account in qualsiasi momento da <a href="<?= PLAY_APP_URL ?>/my-account"><em>Il mio account → I tuoi dati</em></a> nell’app, dopo aver annullato qualsiasi abbonamento. Possiamo chiudere o sospendere un account che violi questi termini in modo grave o ripetuto. Cosa succede ai tuoi dati quando un account viene cancellato è spiegato nell’<a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">Informativa sulla privacy</a>.</p>

    <h2>12. Responsabilità</h2>
    <p>BLUERABBIT è fornito così com’è. Nei limiti consentiti dalla legge, non rispondiamo di perdite indirette o consequenziali, e la nostra responsabilità complessiva nei tuoi confronti è limitata a quanto ci hai pagato nei 12 mesi precedenti la richiesta. Nulla di quanto qui previsto limita una responsabilità che la legge non consente di limitare.</p>

    <h2>13. Modifiche a questi termini</h2>
    <p>Quando modifichiamo questi termini in modo rilevante, pubblichiamo qui la nuova versione con una nuova data e lo comunichiamo ai titolari degli account prima che entri in vigore. Se continui a usare BLUERABBIT dopo, si applica la nuova versione; se non sei d’accordo, annulla e cancella il tuo account.</p>

    <h2>14. Legge applicabile e contatti</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>Questi termini sono regolati dalle leggi di <?= esc($legal['jurisdiction']) ?>.<?php else: ?>Questi termini sono regolati dalle leggi del luogo in cui abbiamo sede.<?php endif ?> Domande: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">la nostra pagina dei contatti</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, oppure per posta a <?= esc($legal['address']) ?><?php endif ?>.</p>
