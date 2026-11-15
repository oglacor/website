<?php
/*
 * Italian translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /it/refunds.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15, NOT REVIEWED by a lawyer
 * or by a native speaker. Gauden approved publishing it before review on
 * 2026-11-15; the legal and native review is still to follow. The page tells
 * its reader it is an unreviewed A.I. translation.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>BLUERABBIT Pro si acquista al mese o all’anno. Questa pagina spiega cosa succede quando annulli e quando puoi riavere i tuoi soldi.</p>

    <h2>In breve</h2>
    <ul>
      <li><strong>I tuoi primi 30 giorni sono gratuiti.</strong> Ti chiediamo una carta all’inizio della prova e la addebitiamo solo quando la prova termina. Annulla prima e non paghi nulla.</li>
      <li><strong>Il mese in corso non viene mai rimborsato.</strong> Una volta incassato il pagamento, quel mese è tuo fino alla fine.</li>
      <li><strong>I mesi non utilizzati di un piano annuale possono essere rimborsati.</strong> Riavrai quanto hai pagato, meno il prezzo mensile di ogni mese iniziato.</li>
      <li><strong>Un piano mensile non viene rimborsato.</strong> Annullalo e terminerà semplicemente alla fine del mese già pagato.</li>
    </ul>

    <h2>Piani annuali, con i conti</h2>
    <p>Il rimborso è l’importo annuale pagato, meno il prezzo mensile di ogni mese iniziato da quel pagamento, compreso il mese in corso. Non è mai inferiore a zero.</p>
    <p>Con Pro a 80 $ l’anno e 8 $ al mese:</p>
    <ul>
      <li>La tua prova finisce, l’addebito annuale di 80 $ va a buon fine perché hai dimenticato di annullare, e ci scrivi nello stesso mese: <strong>riavrai 72 $</strong> (80 $ − un mese a 8 $).</li>
      <li>Lo chiedi nel terzo mese: <strong>56 $ di rimborso</strong> (80 $ − tre mesi a 8 $).</li>
      <li>Lo chiedi dal decimo mese in poi: non resta nulla da rimborsare.</li>
    </ul>
    <p>Il rimborso di un piano annuale termina anche quel piano immediatamente, e il tuo account torna al piano gratuito.</p>

    <h2>Come annullare</h2>
    <p>Accedi all’app, apri <a href="<?= PLAY_APP_URL ?>/subscription">Abbonamento</a> e scegli <em>Gestisci fatturazione</em>. L’annullamento blocca il rinnovo successivo; mantieni Pro fino alla fine del periodo pagato. Nessuno deve approvarlo, e puoi farlo in qualsiasi momento.</p>

    <h2>Come chiedere un rimborso</h2>
    <p><?php if ($legal['email'] !== ''): ?>Scrivi a <?= $emailLink ?><?php else: ?>Scrivici tramite la <a href="<?= site_url('contact') ?>">nostra pagina dei contatti</a><?php endif ?> dall’indirizzo email del tuo account e indica quale piano vuoi farti rimborsare. Calcoliamo l’importo come sopra e lo riaccreditiamo sulla carta con cui hai pagato. Di solito le banche impiegano da 5 a 10 giorni per mostrarlo.</p>
    <p>Se qualcosa è andato storto da parte nostra, ad esempio un doppio addebito o l’impossibilità di usare il servizio, faccelo sapere: rimediamo, qualunque cosa dica la regola qui sopra.</p>
    <p>Questa politica fa parte dei nostri <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">Termini di servizio</a>. Se la legge del luogo in cui vivi ti riconosce di più, hai di più.</p>
