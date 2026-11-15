<?php
/*
 * French translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /fr/refunds.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>BLUERABBIT Pro est vendu au mois ou à l’année. Cette page explique ce qui se passe lorsque vous résiliez, et quand vous pouvez être remboursé.</p>

    <h2>En bref</h2>
    <ul>
      <li><strong>Vos 30 premiers jours sont gratuits.</strong> Nous vous demandons une carte au début de l’essai et ne la débitons qu’à la fin de l’essai. Résiliez avant et vous ne payez rien.</li>
      <li><strong>Le mois en cours n’est jamais remboursé.</strong> Une fois le paiement encaissé, ce mois vous appartient jusqu’à son terme.</li>
      <li><strong>Les mois non utilisés d’une formule annuelle peuvent être remboursés.</strong> Vous récupérez ce que vous avez payé, moins le prix mensuel de chaque mois commencé.</li>
      <li><strong>Une formule mensuelle n’est pas remboursée.</strong> Résiliez-la et elle s’arrête simplement à la fin du mois déjà payé.</li>
    </ul>

    <h2>Formules annuelles : le calcul</h2>
    <p>Le remboursement correspond au montant annuel payé, moins le prix mensuel de chaque mois commencé depuis ce paiement, mois en cours compris. Il n’est jamais inférieur à zéro.</p>
    <p>Avec Pro à 80 $ par an et 8 $ par mois :</p>
    <ul>
      <li>Votre essai se termine, le prélèvement annuel de 80 $ passe parce que vous avez oublié de résilier, et vous nous écrivez le même mois : <strong>vous récupérez 72 $</strong> (80 $ − un mois à 8 $).</li>
      <li>Vous le demandez au troisième mois : <strong>56 $ remboursés</strong> (80 $ − trois mois à 8 $).</li>
      <li>Vous le demandez au dixième mois ou plus tard : il ne reste rien à rembourser.</li>
    </ul>
    <p>Le remboursement d’une formule annuelle met aussi fin à cette formule immédiatement, et votre compte repasse à la formule gratuite.</p>

    <h2>Comment résilier</h2>
    <p>Connectez-vous à l’application, ouvrez <a href="<?= PLAY_APP_URL ?>/subscription">Abonnement</a> et choisissez <em>Gérer la facturation</em>. La résiliation empêche le renouvellement suivant ; vous conservez Pro jusqu’à la fin de la période payée. Personne n’a besoin de l’approuver, et vous pouvez le faire à tout moment.</p>

    <h2>Comment demander un remboursement</h2>
    <p><?php if ($legal['email'] !== ''): ?>Écrivez à <?= $emailLink ?><?php else: ?>Écrivez-nous via <a href="<?= site_url('contact') ?>">notre page de contact</a><?php endif ?> depuis l’adresse e-mail de votre compte, en indiquant la formule à rembourser. Nous calculons le montant comme ci-dessus et le reversons sur la carte utilisée pour le paiement. Les banques mettent généralement 5 à 10 jours pour l’afficher.</p>
    <p>Si quelque chose s’est mal passé de notre côté, par exemple un double prélèvement ou l’impossibilité d’utiliser le service, dites-le-nous : nous corrigeons la situation, quelle que soit la règle ci-dessus.</p>
    <p>Cette politique fait partie de nos <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">Conditions d’utilisation</a>. Si la loi de votre lieu de résidence vous accorde davantage, vous en bénéficiez.</p>
