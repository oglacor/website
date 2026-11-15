<?php
/*
 * German translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /de/privacy.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>Der Betreiber von BLUERABBIT<?php endif ?> betreibt BLUERABBIT und ist für die personenbezogenen Daten verantwortlich, die über dich gespeichert werden. Diese Erklärung umfasst zwei Bereiche:</p>
    <ul>
      <li><strong>Die BLUERABBIT-App</strong> unter <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, in der Abenteuer, Spielerkonten und Abonnements liegen (Teil 1).</li>
      <li><strong>Diese Website</strong>, bluerabbit.io: die Marketingseiten, der Blog, die Dokumentation, die Warteliste und das Kontaktformular (Teil 2).</li>
    </ul>
    <p>Es sind getrennte Systeme mit getrennten Konten: Ein Website-Konto hier ist kein App-Konto dort, und mit keinem von beiden kannst du dich beim anderen anmelden. Organisationen, die BLUERABBIT unter ihrer eigenen Adresse im Rahmen einer separaten Vereinbarung mit uns betreiben, fallen unter diese Vereinbarung.</p>

    <h2>Teil 1: Die BLUERABBIT-App</h2>

    <h3>Was wir speichern</h3>
    <ul>
      <li><strong>Dein Konto:</strong> E-Mail-Adresse, Nickname, der Name, den du angibst, und ein Passwort, das nur als Einweg-Hash gespeichert wird. Optionale Profilangaben (Bild, Kurzbiografie, Unternehmen, Links), wenn du sie hinzufügst.</li>
      <li><strong>Was du in Abenteuern tust:</strong> Fortschritt, XP, Level, Erfolge und Gegenstände, deine Antworten und hochgeladenen Dateien, Nachrichten, Beiträge auf der Pinnwand und Hilfeanfragen sowie die Aktivitäten, aus denen dein Verlauf besteht.</li>
      <li><strong>Zahlungen:</strong> dein Tarif, der Status deines Abonnements und deine Rechnungen. Stripe speichert deine Karte; wir speichern nur einen Verweis auf dein Kundenkonto bei Stripe.</li>
      <li><strong>Sicherheit:</strong> ein Anmeldeprotokoll (jede Anmeldung, jeder Fehlversuch, jede Sperre und jedes Zurücksetzen des Passworts, mit der Internetadresse und dem Browser, von dem sie kamen) und die Bestätigung deiner E-Mail-Adresse.</li>
      <li><strong>Cookies:</strong> nur die, die der Dienst braucht: ein Sitzungscookie, das dich angemeldet hält, und eines, das deine Formulare vor Fälschung schützt. Cloudflare und dessen Turnstile-Prüfung, die automatisierte Registrierungen abwehren, können eigene Sicherheitscookies setzen. Wir verwenden keine Werbecookies.</li>
    </ul>

    <h3>Warum wir es speichern</h3>
    <ul>
      <li>Um den Dienst zu erbringen, für den du dich angemeldet hast: dein Konto, deine Abenteuer, dein Tarif (unser Vertrag mit dir).</li>
      <li>Um Konten und den Dienst sicher zu halten: das Anmeldeprotokoll, Sperren, Missbrauchsprüfungen (unser berechtigtes Interesse an Sicherheit).</li>
      <li>Um gesetzliche Pflichten zu erfüllen, etwa Rechnungen so lange aufzubewahren, wie es das Steuerrecht verlangt.</li>
      <li>Um dir E-Mails zu deinem Konto zu schicken: Bestätigungen, Zurücksetzen des Passworts, Hinweise zum Testzeitraum und zu Zahlungen. E-Mails aus Abenteuern lassen sich über den Link darin abbestellen.</li>
    </ul>
    <p>Wir verkaufen deine Daten nicht und verwenden sie nicht für Werbung.</p>

    <h3>Wer sie sieht</h3>
    <ul>
      <li><strong>In einem Abenteuer</strong> sehen die Spielleiter und das Team, die es durchführen, deinen Fortschritt und die Arbeiten, die du abgibst. Andere Spieler sehen deinen Namen, dein Level, deine XP und Erfolge in Bestenlisten und Gildenlisten, niemals deine E-Mail-Adresse.</li>
      <li><strong>Unternehmen, die für uns arbeiten</strong>, jedes nur für seinen Teil: Stripe (Zahlungen), Resend (E-Mail-Versand), Cloudflare (Auslieferung der Website und Abwehr von Angriffen), Anthropic (die KI-Funktionen, wenn ein Abenteuer sie einschaltet) und unser Hosting-Anbieter. Sie verarbeiten deine Daten nach unseren Weisungen.</li>
      <li><strong>Behörden</strong>, nur wenn das Gesetz es verlangt.</li>
    </ul>

    <h3>Wie lange wir sie aufbewahren</h3>
    <ul>
      <li>Dein Konto und was du erstellt hast: bis du dein Konto löschst.</li>
      <li>Das Anmeldeprotokoll: 12 Monate, danach wird es automatisch gelöscht.</li>
      <li>Rechnungen und Zahlungsunterlagen: so lange, wie es das Steuer- und Handelsrecht verlangt.</li>
      <li>Nachdem du dein Konto gelöscht hast, können deine Punktzahlen unter einem anonymen Namen in den Statistiken und Bestenlisten eines Abenteuers bleiben, damit die Ergebnisse anderer Spieler stimmen. Nichts darin identifiziert dich.</li>
    </ul>

    <h3>Deine Rechte in der App</h3>
    <ul>
      <li><strong>Deine Daten einsehen und mitnehmen:</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>Mein Konto → Deine Daten → Herunterladen</em></a> gibt dir alles, was wir über dich speichern, in einer Datei.</li>
      <li><strong>Dein Konto löschen:</strong> <em>Mein Konto → Deine Daten → Mein Konto löschen</em> entfernt deine Identität überall, löscht deine Unterhaltungen und hochgeladenen Dateien und beendet jede Sitzung. Kündige vorher ein laufendes Abonnement.</li>
      <li><strong>Berichtigen:</strong> Bearbeite dein Profil jederzeit.</li>
      <li><strong>Widersprechen, einschränken lassen oder eine Frage stellen:</strong> <?php if ($legal['email'] !== ''): ?>Schreib an <?= $emailLink ?><?php else: ?>Schreib uns über <a href="<?= site_url('contact') ?>">unsere Kontaktseite</a><?php endif ?>.</li>
    </ul>

    <h2>Teil 2: Diese Website</h2>

    <h3>Was wir erheben</h3>
    <p>Nur das, was die Seite, die du gerade nutzt, wirklich braucht. Vollständig ist das:</p>
    <ul>
      <li><strong>Anmeldungen zur Warteliste</strong> — deine E-Mail-Adresse und die Seite, auf der du dich angemeldet hast. Sonst nichts.</li>
      <li><strong>Kontaktformular</strong> — dein Name, deine E-Mail-Adresse, der Betreff und die Nachricht, die du schreibst.</li>
      <li><strong>Website-Konten</strong> — wenn du auf dieser Website ein Konto registrierst, dein Name, deine E-Mail-Adresse und eine sicher als Hash gespeicherte Fassung deines Passworts. Wir speichern nie das Passwort selbst und können es nicht lesen.</li>
      <li><strong>Sitzungscookie</strong> — ein einziges Cookie, das dich angemeldet hält, während du die Website nutzt.</li>
      <li><strong>Serverprotokolle</strong> — übliche Aufzeichnungen der Webanfragen (IP-Adresse, Browserkennung, aufgerufene Seite, Zeitstempel), aufbewahrt für Sicherheit und Fehlersuche.</li>
    </ul>

    <h3>Was wir nicht tun</h3>
    <p>Das sagen wir ausdrücklich, weil es so ungewöhnlich ist, dass es sich lohnt, es zu überprüfen:</p>
    <ul>
      <li>Keine Skripte zur Analyse oder Nachverfolgung. Kein Google Analytics, kein Tag-Manager, keine Aufzeichnung von Sitzungen, keine Heatmaps.</li>
      <li>Keine Werbecookies, keine Pixel zur erneuten Werbeansprache, keine Nachverfolgung durch Drittanbieter jeglicher Art.</li>
      <li>Kein Verkauf, keine Vermietung und kein Tausch deiner personenbezogenen Daten. An niemanden, zu keinem Preis.</li>
      <li>Kein Profiling und keine automatisierte Entscheidungsfindung über dich.</li>
    </ul>

    <h3>Cookies</h3>
    <ul>
      <li><strong>Notwendig (immer aktiv).</strong> Ein Sitzungscookie, das dich angemeldet hält, ein Sicherheitstoken, das verhindert, dass andere Websites unsere Formulare in deinem Namen absenden, ein Cookie, das deine Auswahl weiter unten speichert, und ein Cookie von Cloudflare, das echte Besucher von Bots unterscheidet. Sie sind für das Funktionieren der Website unbedingt erforderlich, brauchen daher keine Einwilligung und lassen sich nicht abschalten — sie enthalten aber keine Werbedaten und werden nicht verwendet, um ein Profil von dir zu erstellen.</li>
      <li><strong>Analyse (deine Wahl).</strong> Anonyme Statistiken darüber, welche Seiten gelesen werden. <strong>Derzeit setzen wir keinerlei Analyse ein.</strong> Falls wir sie einführen, wird sie nur bei Personen geladen, die aktiv zugestimmt haben — deine Wahl wird im Voraus gespeichert und automatisch beachtet.</li>
    </ul>
    <p><strong>Wenn du es dir anders überlegst.</strong> Über den Link <em>Cookie-Einstellungen</em> im Fußbereich jeder Seite kannst du deine Wahl jederzeit prüfen oder ändern. Der Widerruf ist genauso einfach wie die Zustimmung und wirkt sofort. Außerdem fragen wir nach zwölf Monaten erneut, statt eine alte Antwort als dauerhaft zu behandeln. Wenn du die Analyse ablehnst, kostet dich das nichts — jeder Teil dieser Website funktioniert in beiden Fällen genau gleich.</p>

    <h3>Warum wir sie verwenden</h3>
    <ul>
      <li><strong>Um dir zu antworten</strong> — Nachrichten über das Kontaktformular gibt es, damit ein Mensch deine Frage beantworten kann.</li>
      <li><strong>Um dich über BLUERABBIT zu informieren</strong> — wenn du dich auf die Warteliste gesetzt hast, schreiben wir dir zur Verfügbarkeit und zu Neuigkeiten zum Start. Das ist der einzige Grund, warum es die Liste gibt.</li>
      <li><strong>Um dein Konto zu betreiben</strong> — dich zu authentifizieren und angemeldet zu halten.</li>
      <li><strong>Um die Website funktionsfähig und sicher zu halten</strong> — Protokolle, Missbrauchsabwehr und Fehlersuche.</li>
    </ul>
    <p>Wo das Gesetz eine Rechtsgrundlage verlangt (zum Beispiel die DSGVO der EU oder die UK-DSGVO), stützen wir uns bei den Wartelisten-E-Mails auf deine Einwilligung und bei allem anderen auf unser berechtigtes Interesse, Anfragen zu beantworten, die Website zu betreiben und sie sicher zu halten.</p>

    <h3>Wer sonst mit deinen Daten umgeht</h3>
    <ul>
      <li><strong>Resend</strong> — versendet unsere Transaktions- und Wartelisten-E-Mails. Erhält deine E-Mail-Adresse und den Inhalt der Nachricht.</li>
      <li><strong>Cloudflare</strong> — ist der Website für Sicherheit, DDoS-Schutz und Geschwindigkeit vorgeschaltet. Verarbeitet Metadaten der Anfragen, einschließlich deiner IP-Adresse.</li>
      <li><strong>Unser Hosting-Anbieter</strong> — speichert die Website und ihre Datenbank.</li>
      <li><strong>jsDelivr</strong> — liefert die Bibliothek des Editors für formatierten Text aus, aber nur auf Administrationsseiten nach der Anmeldung. Normale Besucher laden sie nie.</li>
    </ul>

    <h3>Wie lange wir sie aufbewahren</h3>
    <ul>
      <li><strong>Wartelisten-E-Mail-Adressen</strong> — bis du dich abmeldest oder uns bittest, dich zu entfernen.</li>
      <li><strong>Kontaktnachrichten</strong> — bis die Anfrage erledigt ist und wir sie für unsere Unterlagen nicht mehr brauchen.</li>
      <li><strong>Website-Konten</strong> — solange das Konto besteht. Löschst du das Konto, wird auch der Datensatz gelöscht.</li>
      <li><strong>Serverprotokolle</strong> — für ein kurzes, rollierendes Zeitfenster, danach werden sie gelöscht.</li>
    </ul>

    <h3>Deine Wahlmöglichkeiten auf dieser Website</h3>
    <p>Um dich von den Wartelisten-E-Mails abzumelden, nutze den Abmeldelink am Ende jeder E-Mail, die wir dir schicken — er wirkt sofort und braucht keine Antwort von uns. Um etwas anderes, das wir hier speichern, einzusehen, zu berichtigen, zu löschen oder eine Kopie davon zu erhalten, <?php if ($legal['email'] !== ''): ?>schreib an <?= $emailLink ?><?php else: ?>schreib uns über <a href="<?= site_url('contact') ?>">unsere Kontaktseite</a><?php endif ?>. Das alles ist kostenlos, und wir verlangen keine Begründung für deine Anfrage.</p>

    <h2>Für beide</h2>

    <h3>Deine Rechte</h3>
    <p>Du kannst uns bitten, dir zu zeigen, was wir über dich speichern, es zu berichtigen, zu löschen oder dir eine Kopie in einem übertragbaren Format zu schicken. Du kannst außerdem der Art, wie wir es verwenden, widersprechen oder eine erteilte Einwilligung widerrufen. Wenn du dich im Vereinigten Königreich oder in der EU befindest und meinst, dass wir etwas falsch gemacht haben, hast du das Recht, dich bei deiner nationalen Datenschutzaufsichtsbehörde zu beschweren.</p>

    <h3>Sicherheit</h3>
    <p>Beide Websites werden über HTTPS ausgeliefert. Passwörter werden als Einweg-Hash gespeichert, nie in lesbarer Form. Die App sperrt ein Konto nach wiederholten fehlgeschlagenen Anmeldungen und führt ein Anmeldeprotokoll; die Verwaltungsbereiche beider Websites erfordern eine Authentifizierung. Wir treffen angemessene Maßnahmen zum Schutz deiner Informationen, doch keine Website kann vollkommene Sicherheit versprechen.</p>

    <h3>Kinder</h3>
    <p>BLUERABBIT ist nicht für Kinder unter dem Alter der digitalen Einwilligung ihres Wohnorts gedacht, es sei denn, eine Schule, ein Trainer oder eine Organisation, die über die gesetzlich erforderliche Einwilligung verfügt, meldet sie an. Diese Website richtet sich an Organisationen und Fachleute; wenn du glaubst, dass ein Kind hier Informationen übermittelt hat, kontaktiere uns, und wir löschen sie.</p>

    <h3>Internationale Übermittlungen</h3>
    <p>Einige der Unternehmen, die für uns arbeiten, sitzen außerhalb deines Landes, auch in den Vereinigten Staaten. Wo das Gesetz es verlangt, sind solche Übermittlungen durch Standardvertragsklauseln abgesichert.</p>

    <h3>Änderungen dieser Erklärung</h3>
    <p>Wenn sich diese Erklärung wesentlich ändert, veröffentlichen wir die neue Fassung hier mit neuem Datum und informieren die Kontoinhaber.</p>

    <h3>Kontakt</h3>
    <p>Fragen zu dieser Erklärung oder zu Daten, die wir speichern: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">unsere Kontaktseite</a><?php endif ?><?php if ($legal['address'] !== ''): ?> oder per Post an <?= esc($legal['address']) ?><?php endif ?>.</p>
