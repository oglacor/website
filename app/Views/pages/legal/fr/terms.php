<?php
/*
 * French translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /fr/terms.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>Les présentes conditions constituent l’accord entre vous et <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>l’exploitant de BLUERABBIT<?php endif ?> (« nous ») pour l’utilisation de BLUERABBIT, la plateforme disponible sur <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> pour créer et jouer des aventures d’apprentissage ludiques. En créant un compte ou en utilisant BLUERABBIT, vous les acceptez. Si vous utilisez BLUERABBIT pour le compte d’une organisation, vous les acceptez également en son nom.</p>

    <h2>1. Votre compte</h2>
    <ul>
      <li>Fournissez-nous des informations exactes et gardez votre mot de passe pour vous. Tout ce qui est fait avec votre compte relève de votre responsabilité.</li>
      <li>Vous devez avoir au moins 16 ans, ou l’âge du consentement numérique applicable là où vous vivez s’il est plus élevé. Un enseignant, un formateur ou une organisation qui inscrit des joueurs plus jeunes doit disposer du consentement exigé par la loi.</li>
      <li>Une personne par compte. Les comptes qu’un maître du jeu ou une organisation crée pour des joueurs relèvent de l’accord conclu entre cette organisation et nous.</li>
    </ul>

    <h2>2. Formules</h2>
    <p>Basic est gratuit. BLUERABBIT Pro est un abonnement payant, mensuel ou annuel, au prix affiché lors de la souscription, toutes taxes que nous devons percevoir comprises. Les paiements sont traités par Stripe ; nous ne voyons ni ne conservons jamais le numéro de votre carte.</p>

    <h2>3. L’essai gratuit</h2>
    <p>Votre premier abonnement Pro commence par un essai gratuit de 30 jours. Nous vous demandons une carte au début de l’essai. À la fin de l’essai, la carte est débitée pour la formule choisie, mensuelle ou annuelle, sauf si vous résiliez avant. Nous vous envoyons un e-mail quelques jours avant la fin de l’essai.</p>

    <h2>4. Renouvellement et résiliation</h2>
    <p>Pro se renouvelle automatiquement à la fin de chaque mois ou de chaque année jusqu’à ce que vous le résiliiez. Vous pouvez résilier à tout moment depuis <a href="<?= PLAY_APP_URL ?>/subscription"><em>Abonnement → Gérer la facturation</em></a> dans l’application. La résiliation empêche le renouvellement suivant : vous conservez Pro jusqu’à la fin de la période déjà payée, puis votre compte repasse à Basic. Vos aventures et vos données sont conservées ; les fonctions qui nécessitent Pro s’arrêtent.</p>

    <h2>5. Remboursements</h2>
    <ul>
      <li>Le mois en cours n’est jamais remboursé une fois son paiement encaissé.</li>
      <li>Une formule annuelle peut être remboursée pour ses mois non utilisés : le montant payé, moins le prix mensuel de chaque mois commencé depuis ce paiement (mois en cours compris), sans jamais descendre sous zéro. Par exemple, avec Pro à 80 $ par an et 8 $ par mois, un renouvellement annuel que vous vouliez résilier et que vous nous signalez dans son premier mois est remboursé à hauteur de 72 $. Le remboursement d’une formule annuelle y met fin immédiatement.</li>
      <li>Une formule mensuelle n’est pas remboursée ; sa résiliation empêche le renouvellement suivant.</li>
      <li>Pour demander un remboursement, <?php if ($legal['email'] !== ''): ?>écrivez à <?= $emailLink ?><?php else: ?>écrivez-nous via <a href="<?= site_url('contact') ?>">notre page de contact</a><?php endif ?> depuis l’adresse e-mail de votre compte. Les remboursements sont versés sur la carte utilisée pour le paiement.</li>
    </ul>
    <p>La <a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">Politique de remboursement</a> l’explique avec davantage d’exemples. Si la loi de votre lieu de résidence vous accorde plus de droits que la présente section, vous en bénéficiez.</p>

    <h2>6. Changements de prix</h2>
    <p>Nous pouvons modifier le prix de Pro. Un changement n’affecte jamais une période déjà payée, et nous vous prévenons au moins 30 jours avant votre premier renouvellement au nouveau prix, afin que vous puissiez résilier avant.</p>

    <h2>7. Votre contenu</h2>
    <p>Ce que vous créez ou envoyez (aventures, étapes, images, réponses, messages) reste à vous. Vous nous accordez l’autorisation nécessaire pour le stocker, le montrer aux personnes avec qui vous le partagez et faire fonctionner le service, et rien de plus. Vous êtes responsable de détenir les droits sur ce que vous envoyez et de ce que vous publiez pour vos joueurs.</p>

    <h2>8. Utiliser BLUERABBIT loyalement</h2>
    <p>N’utilisez pas BLUERABBIT pour enfreindre la loi, harceler ou nuire à quiconque, envoyer des logiciels malveillants, attaquer ou surcharger le service, consulter des données qui ne sont pas les vôtres ou contourner une limite de votre formule. Ne revendez pas BLUERABBIT sans notre accord écrit. Nous pouvons retirer un contenu ou suspendre un compte qui le fait, et nous vous en dirons la raison, sauf si la loi ou la sécurité d’autrui nous en empêche.</p>

    <h2>9. Fonctions d’I.A.</h2>
    <p>Certaines fonctions (l’assistant Cooper et la correction des réponses par I.A., lorsqu’une aventure les active) envoient le texte concerné à Anthropic, notre fournisseur d’I.A., pour produire une réponse. Les résultats de l’I.A. peuvent être erronés : le maître du jeu reste responsable des décisions prises à partir de ceux-ci.</p>

    <h2>10. Le service</h2>
    <p>Nous nous efforçons de garder BLUERABBIT disponible et vos données en sécurité, et nous l’améliorons en permanence, ce qui implique parfois de modifier ou de retirer une fonction. Si nous retirons quelque chose dont dépend une formule payante, nous vous prévenons d’abord. Nous ne sommes pas responsables des pertes causées par des événements échappant à notre contrôle raisonnable.</p>

    <h2>11. Fin de l’accord</h2>
    <p>Vous pouvez cesser d’utiliser BLUERABBIT et supprimer votre compte à tout moment depuis <a href="<?= PLAY_APP_URL ?>/my-account"><em>Mon compte → Vos données</em></a> dans l’application, après avoir résilié tout abonnement. Nous pouvons résilier ou suspendre un compte qui enfreint gravement ou de manière répétée les présentes conditions. Ce qu’il advient de vos données lors de la suppression d’un compte est décrit dans la <a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">Politique de confidentialité</a>.</p>

    <h2>12. Responsabilité</h2>
    <p>BLUERABBIT est fourni en l’état. Dans les limites permises par la loi, nous ne sommes pas responsables des pertes indirectes ou consécutives, et notre responsabilité totale envers vous est limitée aux sommes que vous nous avez payées au cours des 12 mois précédant la réclamation. Rien dans les présentes ne limite une responsabilité que la loi ne permet pas de limiter.</p>

    <h2>13. Modification des présentes conditions</h2>
    <p>Lorsque nous modifions ces conditions de manière significative, nous publions ici la nouvelle version avec une nouvelle date et en informons les titulaires de compte avant son entrée en vigueur. Si vous continuez à utiliser BLUERABBIT ensuite, la nouvelle version s’applique ; si vous ne l’acceptez pas, résiliez et supprimez votre compte.</p>

    <h2>14. Droit applicable et contact</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>Les présentes conditions sont régies par le droit de <?= esc($legal['jurisdiction']) ?>.<?php else: ?>Les présentes conditions sont régies par le droit du lieu où nous sommes établis.<?php endif ?> Questions : <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">notre page de contact</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, ou par courrier à <?= esc($legal['address']) ?><?php endif ?>.</p>
