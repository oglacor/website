<?php
/*
 * German translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /de/terms.
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
    <p>Diese Bedingungen sind die Vereinbarung zwischen dir und <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>dem Betreiber von BLUERABBIT<?php endif ?> („wir“, „uns“) über die Nutzung von BLUERABBIT, der Plattform unter <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> zum Erstellen und Spielen spielerischer Lernabenteuer. Wenn du ein Konto erstellst oder BLUERABBIT nutzt, akzeptierst du sie. Wenn du BLUERABBIT für eine Organisation nutzt, akzeptierst du sie auch für diese.</p>

    <h2>1. Dein Konto</h2>
    <ul>
      <li>Mach wahre Angaben und behalte dein Passwort für dich. Für alles, was mit deinem Konto geschieht, bist du verantwortlich.</li>
      <li>Du musst mindestens 16 Jahre alt sein oder das Alter der digitalen Einwilligung deines Wohnorts erreicht haben, falls dieses höher ist. Eine Lehrkraft, ein Trainer oder eine Organisation, die jüngere Spieler anmeldet, ist dafür verantwortlich, die gesetzlich erforderliche Einwilligung einzuholen.</li>
      <li>Eine Person pro Konto. Konten, die ein Spielleiter oder eine Organisation für Spieler anlegt, fallen unter die Vereinbarung dieser Organisation mit uns.</li>
    </ul>

    <h2>2. Tarife</h2>
    <p>Basic ist kostenlos. BLUERABBIT Pro ist ein kostenpflichtiges Abonnement, monatlich oder jährlich, zu dem beim Abschluss angezeigten Preis einschließlich der Steuern, die wir erheben müssen. Zahlungen wickelt Stripe ab; wir sehen oder speichern deine Kartennummer nie.</p>

    <h2>3. Der kostenlose Testzeitraum</h2>
    <p>Dein erstes Pro-Abonnement beginnt mit einem kostenlosen Testzeitraum von 30 Tagen. Zu Beginn des Testzeitraums fragen wir nach einer Karte. Am Ende des Testzeitraums wird die Karte für den gewählten Tarif belastet, monatlich oder jährlich, es sei denn, du kündigst vorher. Wir schicken dir einige Tage vor Ende des Testzeitraums eine E-Mail.</p>

    <h2>4. Verlängerung und Kündigung</h2>
    <p>Pro verlängert sich automatisch am Ende jedes Monats oder Jahres, bis du kündigst. Du kannst jederzeit in der App unter <a href="<?= PLAY_APP_URL ?>/subscription"><em>Abonnement → Abrechnung verwalten</em></a> kündigen. Die Kündigung stoppt die nächste Verlängerung: Du behältst Pro bis zum Ende des bereits bezahlten Zeitraums, danach kehrt dein Konto zu Basic zurück. Deine Abenteuer und Daten bleiben erhalten; Funktionen, die Pro voraussetzen, stehen nicht mehr zur Verfügung.</p>

    <h2>5. Erstattungen</h2>
    <ul>
      <li>Der laufende Monat wird nie erstattet, sobald seine Zahlung eingezogen wurde.</li>
      <li>Ein Jahrestarif kann für seine ungenutzten Monate erstattet werden: der gezahlte Betrag abzüglich des Monatspreises für jeden seit dieser Zahlung begonnenen Monat (einschließlich des laufenden), niemals weniger als null. Beispiel: Bei Pro zu 80 $ im Jahr und 8 $ im Monat wird eine jährliche Verlängerung, die du eigentlich kündigen wolltest und uns in ihrem ersten Monat meldest, mit 72 $ erstattet. Die Erstattung eines Jahrestarifs beendet ihn sofort.</li>
      <li>Ein Monatstarif wird nicht erstattet; seine Kündigung stoppt die nächste Verlängerung.</li>
      <li>Für eine Erstattung <?php if ($legal['email'] !== ''): ?>schreib an <?= $emailLink ?><?php else: ?>schreib uns über <a href="<?= site_url('contact') ?>">unsere Kontaktseite</a><?php endif ?>, und zwar von der E-Mail-Adresse deines Kontos. Erstattungen gehen auf die Karte zurück, mit der du bezahlt hast.</li>
    </ul>
    <p>Die <a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">Erstattungsrichtlinie</a> erklärt das mit weiteren Beispielen. Wenn dir das Recht deines Wohnorts mehr Rechte gibt als dieser Abschnitt, hast du sie.</p>

    <h2>6. Preisänderungen</h2>
    <p>Wir können den Preis von Pro ändern. Eine Änderung betrifft nie einen bereits bezahlten Zeitraum, und wir informieren dich mindestens 30 Tage vor deiner ersten Verlängerung zum neuen Preis, damit du vorher kündigen kannst.</p>

    <h2>7. Deine Inhalte</h2>
    <p>Was du erstellst oder hochlädst (Abenteuer, Meilensteine, Bilder, Antworten, Nachrichten), bleibt deins. Du gibst uns die Erlaubnis, die wir brauchen, um es zu speichern, den Personen zu zeigen, mit denen du es teilst, und den Dienst zu betreiben, und nicht mehr. Du bist dafür verantwortlich, die Rechte an dem zu haben, was du hochlädst, und für das, was du für deine Spieler veröffentlichst.</p>

    <h2>8. Faire Nutzung von BLUERABBIT</h2>
    <p>Nutze BLUERABBIT nicht, um gegen Gesetze zu verstoßen, jemanden zu belästigen oder zu schädigen, Schadsoftware hochzuladen, den Dienst anzugreifen oder zu überlasten, Daten zu lesen, die nicht deine sind, oder eine Grenze deines Tarifs zu umgehen. Verkaufe BLUERABBIT nicht ohne unsere schriftliche Zustimmung weiter. Wir können Inhalte entfernen oder ein Konto sperren, das dies tut, und sagen dir den Grund, es sei denn, das Gesetz oder die Sicherheit anderer hindert uns daran.</p>

    <h2>9. KI-Funktionen</h2>
    <p>Einige Funktionen (der Assistent Cooper und die KI-Bewertung von Antworten, wenn ein Abenteuer sie einschaltet) senden den betreffenden Text an Anthropic, unseren KI-Anbieter, um eine Antwort zu erzeugen. KI-Ergebnisse können falsch sein: Der Spielleiter bleibt für Entscheidungen verantwortlich, die damit getroffen werden.</p>

    <h2>10. Der Dienst</h2>
    <p>Wir arbeiten daran, BLUERABBIT verfügbar und deine Daten sicher zu halten, und verbessern den Dienst ständig. Das bedeutet manchmal, eine Funktion zu ändern oder einzustellen. Wenn wir etwas einstellen, von dem ein kostenpflichtiger Tarif abhängt, sagen wir es dir vorher. Für Verluste durch Ereignisse außerhalb unserer zumutbaren Kontrolle sind wir nicht verantwortlich.</p>

    <h2>11. Beendigung der Vereinbarung</h2>
    <p>Du kannst BLUERABBIT jederzeit nicht mehr nutzen und dein Konto in der App unter <a href="<?= PLAY_APP_URL ?>/my-account"><em>Mein Konto → Deine Daten</em></a> löschen, nachdem du ein etwaiges Abonnement gekündigt hast. Wir können ein Konto beenden oder sperren, das schwer oder wiederholt gegen diese Bedingungen verstößt. Was mit deinen Daten passiert, wenn ein Konto gelöscht wird, steht in der <a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">Datenschutzerklärung</a>.</p>

    <h2>12. Haftung</h2>
    <p>BLUERABBIT wird so bereitgestellt, wie es ist. Soweit gesetzlich zulässig, haften wir nicht für indirekte Schäden oder Folgeschäden, und unsere Gesamthaftung dir gegenüber ist auf den Betrag begrenzt, den du uns in den 12 Monaten vor dem Anspruch gezahlt hast. Nichts hiervon beschränkt eine Haftung, die nach dem Gesetz nicht beschränkt werden darf.</p>

    <h2>13. Änderungen dieser Bedingungen</h2>
    <p>Wenn wir diese Bedingungen wesentlich ändern, veröffentlichen wir die neue Fassung hier mit neuem Datum und informieren die Kontoinhaber, bevor sie wirksam wird. Wenn du BLUERABBIT danach weiter nutzt, gilt die neue Fassung; wenn du nicht einverstanden bist, kündige und lösche dein Konto.</p>

    <h2>14. Anwendbares Recht und Kontakt</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>Diese Bedingungen unterliegen dem Recht von <?= esc($legal['jurisdiction']) ?>.<?php else: ?>Diese Bedingungen unterliegen dem Recht des Ortes, an dem wir niedergelassen sind.<?php endif ?> Fragen: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">unsere Kontaktseite</a><?php endif ?><?php if ($legal['address'] !== ''): ?> oder per Post an <?= esc($legal['address']) ?><?php endif ?>.</p>
