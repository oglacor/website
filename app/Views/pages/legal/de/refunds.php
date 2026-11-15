<?php
/*
 * German translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /de/refunds.
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
    <p>BLUERABBIT Pro wird monatlich oder jährlich verkauft. Diese Seite erklärt, was passiert, wenn du kündigst, und wann du Geld zurückbekommst.</p>

    <h2>Das Wichtigste in Kürze</h2>
    <ul>
      <li><strong>Deine ersten 30 Tage sind kostenlos.</strong> Wir fragen zu Beginn des Testzeitraums nach einer Karte und belasten sie erst, wenn der Testzeitraum endet. Kündigst du vorher, zahlst du nichts.</li>
      <li><strong>Der laufende Monat wird nie erstattet.</strong> Sobald eine Zahlung eingezogen wurde, kannst du diesen Monat bis zu seinem Ende nutzen.</li>
      <li><strong>Ungenutzte Monate eines Jahrestarifs können erstattet werden.</strong> Du bekommst zurück, was du gezahlt hast, abzüglich des Monatspreises für jeden begonnenen Monat.</li>
      <li><strong>Ein Monatstarif wird nicht erstattet.</strong> Kündige ihn, und er endet einfach am Ende des bereits bezahlten Monats.</li>
    </ul>

    <h2>Jahrestarife, durchgerechnet</h2>
    <p>Die Erstattung ist der gezahlte Jahresbetrag abzüglich des Monatspreises für jeden seit dieser Zahlung begonnenen Monat, einschließlich des laufenden. Sie ist nie weniger als null.</p>
    <p>Bei Pro zu 80 $ im Jahr und 8 $ im Monat:</p>
    <ul>
      <li>Dein Testzeitraum endet, die Jahresgebühr von 80 $ wird eingezogen, weil du das Kündigen vergessen hast, und du schreibst uns im selben Monat: <strong>Du bekommst 72 $ zurück</strong> (80 $ − ein Monat zu 8 $).</li>
      <li>Du fragst im dritten Monat: <strong>56 $ zurück</strong> (80 $ − drei Monate zu 8 $).</li>
      <li>Du fragst im zehnten Monat oder später: Es bleibt nichts zu erstatten.</li>
    </ul>
    <p>Die Erstattung eines Jahrestarifs beendet diesen Tarif außerdem sofort, und dein Konto kehrt zum kostenlosen Tarif zurück.</p>

    <h2>So kündigst du</h2>
    <p>Melde dich in der App an, öffne <a href="<?= PLAY_APP_URL ?>/subscription">Abonnement</a> und wähle <em>Abrechnung verwalten</em>. Die Kündigung stoppt die nächste Verlängerung; du behältst Pro bis zum Ende des bezahlten Zeitraums. Niemand muss zustimmen, und du kannst es jederzeit tun.</p>

    <h2>So bittest du um eine Erstattung</h2>
    <p><?php if ($legal['email'] !== ''): ?>Schreib an <?= $emailLink ?><?php else: ?>Schreib uns über <a href="<?= site_url('contact') ?>">unsere Kontaktseite</a><?php endif ?>, und zwar von der E-Mail-Adresse deines Kontos, und nenne den Tarif, der erstattet werden soll. Wir berechnen den Betrag wie oben beschrieben und überweisen ihn auf die Karte zurück, mit der du bezahlt hast. Banken brauchen meist 5 bis 10 Tage, bis er sichtbar ist.</p>
    <p>Wenn auf unserer Seite etwas schiefgelaufen ist, etwa eine doppelte Belastung oder wenn du den Dienst nicht nutzen konntest, sag uns Bescheid: Wir bringen es in Ordnung, unabhängig von der obigen Regel.</p>
    <p>Diese Richtlinie ist Teil unserer <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">Nutzungsbedingungen</a>. Wenn dir das Recht deines Wohnorts mehr gibt, hast du mehr.</p>
