<?php
/*
 * French translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /fr/privacy.
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
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>L’exploitant de BLUERABBIT<?php endif ?> exploite BLUERABBIT et est responsable des données personnelles qu’il conserve à votre sujet. Cette politique couvre deux espaces :</p>
    <ul>
      <li><strong>L’application BLUERABBIT</strong> sur <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, où se trouvent les aventures, les comptes des joueurs et les abonnements (partie 1).</li>
      <li><strong>Ce site web</strong>, bluerabbit.io : les pages de présentation, le blog, la documentation, la liste d’attente et le formulaire de contact (partie 2).</li>
    </ul>
    <p>Ce sont des systèmes distincts, avec des comptes distincts : un compte sur ce site n’est pas un compte dans l’application, et aucun des deux ne permet de se connecter à l’autre. Les organisations qui utilisent BLUERABBIT à leur propre adresse dans le cadre d’un accord distinct avec nous relèvent de cet accord.</p>

    <h2>Partie 1 : L’application BLUERABBIT</h2>

    <h3>Ce que nous conservons</h3>
    <ul>
      <li><strong>Votre compte :</strong> adresse e-mail, pseudo, le nom que vous indiquez et un mot de passe stocké uniquement sous forme d’empreinte irréversible (hachage). Des informations de profil facultatives (photo, biographie, entreprise, liens) si vous les ajoutez.</li>
      <li><strong>Ce que vous faites dans les aventures :</strong> progression, XP, niveaux, succès et objets, vos réponses et fichiers envoyés, messages, publications sur le mur et demandes d’aide, ainsi que l’activité qui constitue votre historique.</li>
      <li><strong>Paiements :</strong> votre formule, l’état de votre abonnement et vos factures. Stripe conserve votre carte ; nous ne gardons qu’une référence à votre fiche client Stripe.</li>
      <li><strong>Sécurité :</strong> un journal des connexions (chaque connexion, échec, blocage et réinitialisation de mot de passe, avec l’adresse Internet et le navigateur d’origine) et la confirmation de votre adresse e-mail.</li>
      <li><strong>Cookies :</strong> uniquement ceux dont le service a besoin : un cookie de session qui vous garde connecté et un autre qui protège vos formulaires contre la falsification. Cloudflare et sa vérification Turnstile, qui bloquent les inscriptions automatisées, peuvent déposer leurs propres cookies de sécurité. Nous n’utilisons pas de cookies publicitaires.</li>
    </ul>

    <h3>Pourquoi nous les conservons</h3>
    <ul>
      <li>Pour fournir le service auquel vous vous êtes inscrit : votre compte, vos aventures, votre formule (notre contrat avec vous).</li>
      <li>Pour protéger les comptes et le service : le journal des connexions, les blocages, les contrôles anti-abus (notre intérêt légitime en matière de sécurité).</li>
      <li>Pour respecter nos obligations légales, comme conserver les factures aussi longtemps que l’exige le droit fiscal.</li>
      <li>Pour vous écrire au sujet de votre compte : confirmations, réinitialisations de mot de passe, avis concernant l’essai et les paiements. Les e-mails des aventures peuvent être désactivés depuis le lien qu’ils contiennent.</li>
    </ul>
    <p>Nous ne vendons pas vos données et ne les utilisons pas à des fins publicitaires.</p>

    <h3>Qui y a accès</h3>
    <ul>
      <li><strong>Dans une aventure</strong>, les maîtres du jeu et l’équipe qui l’animent voient votre progression et les travaux que vous remettez. Les autres joueurs voient votre nom, votre niveau, vos XP et vos succès dans les classements et les listes de guildes, jamais votre adresse e-mail.</li>
      <li><strong>Les entreprises qui travaillent pour nous</strong>, chacune uniquement pour sa partie : Stripe (paiements), Resend (envoi des e-mails), Cloudflare (diffusion du site et protection contre les attaques), Anthropic (les fonctions d’I.A., lorsqu’une aventure les active) et notre hébergeur. Elles traitent vos données selon nos instructions.</li>
      <li><strong>Les autorités</strong>, uniquement lorsque la loi l’exige.</li>
    </ul>

    <h3>Combien de temps nous les conservons</h3>
    <ul>
      <li>Votre compte et ce que vous avez créé : jusqu’à la suppression de votre compte.</li>
      <li>Le journal des connexions : 12 mois, puis il est supprimé automatiquement.</li>
      <li>Factures et données de paiement : aussi longtemps que l’exigent les règles fiscales et comptables.</li>
      <li>Après la suppression de votre compte, vos scores peuvent rester dans les statistiques et les classements d’une aventure sous un nom anonyme, afin que les résultats des autres joueurs restent exacts. Rien dans ces données ne permet de vous identifier.</li>
    </ul>

    <h3>Vos droits dans l’application</h3>
    <ul>
      <li><strong>Consulter et récupérer vos données :</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>Mon compte → Vos données → Télécharger</em></a> vous remet en un seul fichier tout ce que nous détenons sur vous.</li>
      <li><strong>Supprimer votre compte :</strong> <em>Mon compte → Vos données → Supprimer mon compte</em> efface votre identité partout, supprime vos conversations et fichiers envoyés et met fin à toutes vos sessions. Résiliez d’abord tout abonnement en cours.</li>
      <li><strong>Rectifier vos données :</strong> modifiez votre profil à tout moment.</li>
      <li><strong>Vous opposer, demander une limitation ou poser une question :</strong> <?php if ($legal['email'] !== ''): ?>écrivez à <?= $emailLink ?><?php else: ?>écrivez-nous via <a href="<?= site_url('contact') ?>">notre page de contact</a><?php endif ?>.</li>
    </ul>

    <h2>Partie 2 : Ce site web</h2>

    <h3>Ce que nous collectons</h3>
    <p>Uniquement ce dont la page que vous utilisez a réellement besoin. En voici la liste complète :</p>
    <ul>
      <li><strong>Inscriptions à la liste d’attente</strong> — votre adresse e-mail et la page depuis laquelle vous vous êtes inscrit. Rien d’autre.</li>
      <li><strong>Formulaire de contact</strong> — votre nom, votre adresse e-mail, l’objet et le message que vous écrivez.</li>
      <li><strong>Comptes du site</strong> — si vous créez un compte sur ce site, votre nom, votre adresse e-mail et une version de votre mot de passe protégée par un hachage sécurisé. Nous ne conservons jamais votre mot de passe lui-même et ne pouvons pas le lire.</li>
      <li><strong>Cookie de session</strong> — un seul cookie qui vous garde connecté pendant que vous utilisez le site.</li>
      <li><strong>Journaux du serveur</strong> — les enregistrements standard des requêtes web (adresse IP, agent utilisateur du navigateur, page demandée, date et heure), conservés pour la sécurité et le débogage.</li>
    </ul>

    <h3>Ce que nous ne faisons pas</h3>
    <p>Cela mérite d’être dit clairement, car c’est assez inhabituel pour valoir la peine d’être vérifié :</p>
    <ul>
      <li>Aucun script de mesure d’audience ni de suivi. Pas de Google Analytics, pas de gestionnaire de balises, pas d’enregistrement de sessions, pas de cartes de chaleur.</li>
      <li>Aucun cookie publicitaire, aucun pixel de reciblage, aucun traceur tiers d’aucune sorte.</li>
      <li>Aucune vente, location ou échange de vos informations personnelles. À personne, à aucun prix.</li>
      <li>Aucun profilage ni aucune prise de décision automatisée vous concernant.</li>
    </ul>

    <h3>Cookies</h3>
    <ul>
      <li><strong>Essentiels (toujours actifs).</strong> Un cookie de session qui vous garde connecté, un jeton de sécurité qui empêche d’autres sites d’envoyer nos formulaires en votre nom, un cookie qui enregistre votre choix décrit ci-dessous et un cookie déposé par Cloudflare qui distingue les vrais visiteurs des robots. Ils sont strictement nécessaires au fonctionnement du site ; ils ne requièrent donc pas de consentement et ne peuvent pas être désactivés — mais ils ne contiennent aucune donnée publicitaire et ne servent pas à vous profiler.</li>
      <li><strong>Mesure d’audience (à vous de choisir).</strong> Des statistiques anonymes sur les pages lues. <strong>Nous n’utilisons actuellement aucune mesure d’audience.</strong> Si nous en mettons une en place, elle ne se chargera que pour les personnes qui l’auront activement acceptée — votre choix est enregistré à l’avance et respecté automatiquement.</li>
    </ul>
    <p><strong>Changer d’avis.</strong> Utilisez le lien <em>Paramètres des cookies</em> en pied de page de n’importe quelle page pour revoir ou modifier votre choix à tout moment. Retirer votre consentement est exactement aussi simple que de le donner, et prend effet immédiatement. Nous vous reposons aussi la question au bout de douze mois plutôt que de considérer une ancienne réponse comme définitive. Refuser la mesure d’audience ne vous coûte rien — chaque partie de ce site fonctionne exactement de la même manière dans les deux cas.</p>

    <h3>Pourquoi nous les utilisons</h3>
    <ul>
      <li><strong>Pour vous répondre</strong> — les messages du formulaire de contact existent pour qu’une personne puisse répondre à votre question.</li>
      <li><strong>Pour vous parler de BLUERABBIT</strong> — si vous vous êtes inscrit sur la liste d’attente, nous vous écrivons au sujet de la disponibilité et des nouvelles du lancement. C’est la seule raison d’être de cette liste.</li>
      <li><strong>Pour gérer votre compte</strong> — vous authentifier et vous garder connecté.</li>
      <li><strong>Pour assurer le bon fonctionnement et la sécurité du site</strong> — journaux, prévention des abus et débogage.</li>
    </ul>
    <p>Lorsque la loi exige une base juridique (par exemple le RGPD de l’UE ou du Royaume-Uni), nous nous appuyons sur votre consentement pour les e-mails de la liste d’attente, et sur notre intérêt légitime à répondre aux demandes, à faire fonctionner le site et à en assurer la sécurité pour tout le reste.</p>

    <h3>Qui d’autre traite vos données</h3>
    <ul>
      <li><strong>Resend</strong> — envoie nos e-mails transactionnels et ceux de la liste d’attente. Reçoit votre adresse e-mail et le contenu du message.</li>
      <li><strong>Cloudflare</strong> — se place devant le site pour la sécurité, la protection contre les attaques DDoS et les performances. Traite les métadonnées des requêtes, y compris votre adresse IP.</li>
      <li><strong>Notre hébergeur</strong> — stocke le site et sa base de données.</li>
      <li><strong>jsDelivr</strong> — fournit la bibliothèque de l’éditeur de texte enrichi, mais uniquement sur les pages d’administration, après connexion. Les visiteurs ordinaires ne la chargent jamais.</li>
    </ul>

    <h3>Combien de temps nous les conservons</h3>
    <ul>
      <li><strong>Adresses de la liste d’attente</strong> — jusqu’à ce que vous vous désinscriviez ou nous demandiez de vous retirer.</li>
      <li><strong>Messages de contact</strong> — jusqu’à ce que la demande soit traitée et ne soit plus nécessaire à nos archives.</li>
      <li><strong>Comptes du site</strong> — aussi longtemps que le compte existe. Supprimez le compte et l’enregistrement disparaît avec lui.</li>
      <li><strong>Journaux du serveur</strong> — pendant une courte période glissante, puis ils sont effacés.</li>
    </ul>

    <h3>Vos choix sur ce site web</h3>
    <p>Pour vous désinscrire des e-mails de la liste d’attente, utilisez le lien de désinscription en bas de n’importe quel e-mail que nous vous envoyons — il fonctionne immédiatement et ne nécessite aucune réponse de notre part. Pour consulter, rectifier, supprimer ou obtenir une copie de toute autre donnée que nous détenons ici, <?php if ($legal['email'] !== ''): ?>écrivez à <?= $emailLink ?><?php else: ?>écrivez-nous via <a href="<?= site_url('contact') ?>">notre page de contact</a><?php endif ?>. Tout cela est gratuit, et nous ne vous demanderons pas de justifier votre demande.</p>

    <h2>Commun aux deux</h2>

    <h3>Vos droits</h3>
    <p>Vous pouvez nous demander de vous montrer ce que nous détenons sur vous, de le rectifier, de le supprimer ou de vous en envoyer une copie dans un format portable. Vous pouvez aussi vous opposer à la manière dont nous l’utilisons, ou retirer un consentement que vous avez donné. Si vous êtes au Royaume-Uni ou dans l’UE et estimez que nous avons commis une erreur, vous avez le droit d’introduire une réclamation auprès de votre autorité nationale de protection des données.</p>

    <h3>Sécurité</h3>
    <p>Les deux sites sont servis en HTTPS. Les mots de passe sont stockés sous forme d’empreinte irréversible (hachage), jamais sous une forme lisible. L’application bloque un compte après plusieurs échecs de connexion et tient un journal des connexions ; les espaces d’administration des deux sites exigent une authentification. Nous prenons des mesures raisonnables pour protéger vos informations, mais aucun site ne peut promettre une sécurité parfaite.</p>

    <h3>Enfants</h3>
    <p>BLUERABBIT n’est pas destiné aux enfants n’ayant pas atteint l’âge du consentement numérique applicable là où ils vivent, sauf s’ils sont inscrits par une école, un formateur ou une organisation disposant du consentement exigé par la loi. Ce site web s’adresse aux organisations et aux professionnels ; si vous pensez qu’un enfant nous a transmis des informations ici, contactez-nous et nous les supprimerons.</p>

    <h3>Transferts internationaux</h3>
    <p>Certaines des entreprises qui travaillent pour nous sont situées hors de votre pays, notamment aux États-Unis. Lorsque la loi l’exige, ces transferts sont encadrés par des clauses contractuelles types.</p>

    <h3>Modifications de cette politique</h3>
    <p>Lorsque cette politique change de manière significative, nous publions ici la nouvelle version avec une nouvelle date et en informons les titulaires de compte.</p>

    <h3>Contact</h3>
    <p>Pour toute question sur cette politique ou sur les données que nous détenons : <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">notre page de contact</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, ou par courrier à <?= esc($legal['address']) ?><?php endif ?>.</p>
