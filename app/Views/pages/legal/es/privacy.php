<?php
/*
 * Spanish (Mexico) translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /es/privacy.
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
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>El operador de BLUERABBIT<?php endif ?> opera BLUERABBIT y es responsable de los datos personales que guarda sobre ti. Esta política cubre dos lugares:</p>
    <ul>
      <li><strong>La app de BLUERABBIT</strong> en <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, donde están las aventuras, las cuentas de jugador y las suscripciones (Parte 1).</li>
      <li><strong>Este sitio web</strong>, bluerabbit.io: las páginas promocionales, el blog, la documentación, la lista de espera y el formulario de contacto (Parte 2).</li>
    </ul>
    <p>Son sistemas separados, con cuentas separadas: una cuenta de este sitio no es una cuenta de la app, y ninguna de las dos te permite iniciar sesión en la otra. Las organizaciones que usan BLUERABBIT en su propia dirección web con un acuerdo aparte con nosotros se rigen por ese acuerdo.</p>

    <h2>Parte 1: La app de BLUERABBIT</h2>

    <h3>Qué guardamos</h3>
    <ul>
      <li><strong>Tu cuenta:</strong> correo electrónico, apodo, el nombre que nos das y una contraseña guardada solo como hash de un solo sentido. Datos opcionales del perfil (foto, biografía, empresa, enlaces) si los agregas.</li>
      <li><strong>Lo que haces en las aventuras:</strong> progreso, XP, niveles, logros y objetos, tus respuestas y archivos subidos, mensajes, publicaciones en el muro y solicitudes de ayuda, y la actividad que forma tu historial.</li>
      <li><strong>Pagos:</strong> tu plan, el estado de tu suscripción y tus facturas. Stripe guarda tu tarjeta; nosotros solo guardamos una referencia a tu cliente de Stripe.</li>
      <li><strong>Seguridad:</strong> un registro de inicios de sesión (cada inicio de sesión, intento fallido, bloqueo y restablecimiento de contraseña, con la dirección de internet y el navegador de origen) y la confirmación de tu correo electrónico.</li>
      <li><strong>Cookies:</strong> solo las que el servicio necesita: una cookie de sesión que mantiene tu sesión iniciada y otra que protege tus formularios contra falsificaciones. Cloudflare y su verificación Turnstile, que frenan los registros automatizados, pueden colocar sus propias cookies de seguridad. No usamos cookies publicitarias.</li>
    </ul>

    <h3>Por qué lo guardamos</h3>
    <ul>
      <li>Para prestar el servicio que contrataste: tu cuenta, tus aventuras, tu plan (nuestro contrato contigo).</li>
      <li>Para mantener seguras las cuentas y el servicio: el registro de inicios de sesión, los bloqueos y los controles contra abusos (nuestro interés legítimo en la seguridad).</li>
      <li>Para cumplir obligaciones legales, como conservar las facturas durante el tiempo que exige la ley fiscal.</li>
      <li>Para escribirte sobre tu cuenta: confirmaciones, restablecimientos de contraseña, avisos de la prueba y de pagos. Los correos de las aventuras se pueden desactivar desde el enlace que incluyen.</li>
    </ul>
    <p>No vendemos tus datos ni los usamos con fines publicitarios.</p>

    <h3>Quién los ve</h3>
    <ul>
      <li><strong>En una aventura</strong>, los Game Masters y el personal que la dirigen ven tu progreso y los trabajos que entregas. Los demás jugadores ven tu nombre, nivel, XP y logros en las tablas de clasificación y en las listas de gremios, nunca tu correo electrónico.</li>
      <li><strong>Las empresas que trabajan para nosotros</strong>, cada una solo para su parte: Stripe (pagos), Resend (envío de correos), Cloudflare (entrega del sitio y protección contra ataques), Anthropic (las funciones de I.A., cuando una aventura las activa) y nuestro proveedor de alojamiento. Tratan tus datos siguiendo nuestras instrucciones.</li>
      <li><strong>Las autoridades</strong>, solo cuando la ley lo exige.</li>
    </ul>

    <h3>Cuánto tiempo los conservamos</h3>
    <ul>
      <li>Tu cuenta y lo que creaste: hasta que elimines tu cuenta.</li>
      <li>El registro de inicios de sesión: 12 meses; después se borra automáticamente.</li>
      <li>Facturas y registros de pago: el tiempo que exijan las leyes fiscales y contables.</li>
      <li>Después de eliminar tu cuenta, tus puntuaciones pueden permanecer en las estadísticas y tablas de clasificación de una aventura bajo un nombre anónimo, para que los resultados de los demás jugadores sigan siendo correctos. Nada en ellas te identifica.</li>
    </ul>

    <h3>Tus derechos en la app</h3>
    <ul>
      <li><strong>Consultar y llevarte tus datos:</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>Mi Cuenta → Tus datos → Descargar</em></a> te da en un solo archivo todo lo que guardamos sobre ti.</li>
      <li><strong>Eliminar tu cuenta:</strong> <em>Mi Cuenta → Tus datos → Eliminar mi cuenta</em> elimina tu identidad en todas partes, borra tus conversaciones y archivos subidos y cierra todas tus sesiones. Primero cancela cualquier suscripción activa.</li>
      <li><strong>Corregirlos:</strong> edita tu perfil en cualquier momento.</li>
      <li><strong>Oponerte, pedir una limitación o hacer una pregunta:</strong> <?php if ($legal['email'] !== ''): ?>escribe a <?= $emailLink ?><?php else: ?>escríbenos a través de <a href="<?= site_url('contact') ?>">nuestra página de contacto</a><?php endif ?>.</li>
    </ul>

    <h2>Parte 2: Este sitio web</h2>

    <h3>Qué recopilamos</h3>
    <p>Solo lo que realmente necesita la página que estás usando. La lista completa es esta:</p>
    <ul>
      <li><strong>Inscripciones en la lista de espera</strong>: tu correo electrónico y la página desde la que te registraste. Nada más.</li>
      <li><strong>Formulario de contacto</strong>: tu nombre, tu correo electrónico, el asunto y el mensaje que escribes.</li>
      <li><strong>Cuentas del sitio</strong>: si registras una cuenta en este sitio, tu nombre, tu correo electrónico y una versión de tu contraseña protegida con un hash seguro. Nunca guardamos la contraseña en sí y no podemos leerla.</li>
      <li><strong>Cookie de sesión</strong>: una sola cookie que mantiene tu sesión iniciada mientras usas el sitio.</li>
      <li><strong>Registros del servidor</strong>: registros estándar de las solicitudes web (dirección IP, agente de usuario del navegador, página solicitada, fecha y hora), que se conservan por seguridad y para depurar errores.</li>
    </ul>

    <h3>Lo que no hacemos</h3>
    <p>Lo decimos sin rodeos, porque es lo bastante poco común como para que valga la pena comprobarlo:</p>
    <ul>
      <li>Sin scripts de analítica ni de rastreo. No hay Google Analytics, ni gestor de etiquetas, ni grabación de sesiones, ni mapas de calor.</li>
      <li>Sin cookies publicitarias, sin píxeles de reorientación publicitaria, sin rastreadores de terceros de ningún tipo.</li>
      <li>Sin venta, renta ni intercambio de tu información personal. A nadie, a ningún precio.</li>
      <li>Sin elaboración de perfiles ni decisiones automatizadas sobre ti.</li>
    </ul>

    <h3>Cookies</h3>
    <ul>
      <li><strong>Esenciales (siempre activas).</strong> Una cookie de sesión que mantiene tu sesión iniciada, un token de seguridad que impide que otros sitios envíen nuestros formularios en tu nombre, una cookie que guarda la elección que se explica a continuación y una cookie de Cloudflare que distingue a los visitantes reales de los bots. Son estrictamente necesarias para que el sitio funcione, así que no requieren consentimiento y no se pueden desactivar, pero no contienen datos publicitarios y no se usan para elaborar tu perfil.</li>
      <li><strong>Analítica (tú eliges).</strong> Estadísticas anónimas sobre qué páginas se leen. <strong>Actualmente no usamos analítica de ningún tipo.</strong> Si la introducimos, solo se cargará para quienes la hayan aceptado expresamente: tu elección queda registrada de antemano y se respeta automáticamente.</li>
    </ul>
    <p><strong>Si cambias de opinión.</strong> Usa el enlace <em>Configuración de cookies</em> del pie de cualquier página para revisar o cambiar tu elección en cualquier momento. Retirar tu consentimiento es exactamente igual de fácil que darlo, y surte efecto de inmediato. Además, volvemos a preguntarte a los doce meses en lugar de dar por permanente una respuesta antigua. Rechazar la analítica no te cuesta nada: todo este sitio funciona exactamente igual en ambos casos.</p>

    <h3>Para qué lo usamos</h3>
    <ul>
      <li><strong>Para responderte</strong>: los mensajes del formulario de contacto existen para que una persona pueda contestar tu pregunta.</li>
      <li><strong>Para contarte sobre BLUERABBIT</strong>: si te uniste a la lista de espera, te escribimos sobre la disponibilidad y las novedades del lanzamiento. Es la única razón por la que existe la lista.</li>
      <li><strong>Para gestionar tu cuenta</strong>: autenticarte y mantener tu sesión iniciada.</li>
      <li><strong>Para que el sitio funcione y sea seguro</strong>: registros, prevención de abusos y depuración de errores.</li>
    </ul>
    <p>Cuando la ley exige una base jurídica (por ejemplo, el RGPD del Reino Unido o de la UE), nos basamos en tu consentimiento para los correos de la lista de espera, y en nuestro interés legítimo en responder consultas, operar el sitio y mantenerlo seguro para todo lo demás.</p>

    <h3>Quién más maneja tus datos</h3>
    <ul>
      <li><strong>Resend</strong>: envía nuestros correos transaccionales y los de la lista de espera. Recibe tu correo electrónico y el contenido del mensaje.</li>
      <li><strong>Cloudflare</strong>: está delante del sitio para la seguridad, la protección contra ataques DDoS y el rendimiento. Procesa metadatos de las solicitudes, incluida tu dirección IP.</li>
      <li><strong>Nuestro proveedor de alojamiento</strong>: guarda el sitio y su base de datos.</li>
      <li><strong>jsDelivr</strong>: sirve la biblioteca del editor de texto enriquecido, pero solo en las páginas de administración, con la sesión iniciada. Los visitantes comunes nunca la cargan.</li>
    </ul>

    <h3>Cuánto tiempo los conservamos</h3>
    <ul>
      <li><strong>Correos de la lista de espera</strong>: hasta que te des de baja o nos pidas que te quitemos de la lista.</li>
      <li><strong>Mensajes de contacto</strong>: hasta que la consulta se resuelva y ya no los necesitemos para nuestros registros.</li>
      <li><strong>Cuentas del sitio</strong>: mientras exista la cuenta. Si eliminas la cuenta, el registro se elimina con ella.</li>
      <li><strong>Registros del servidor</strong>: se conservan por un periodo corto y luego se descartan, de forma continua.</li>
    </ul>

    <h3>Tus opciones en este sitio web</h3>
    <p>Para darte de baja de los correos de la lista de espera, usa el enlace para darte de baja que está al final de cualquier correo que te enviemos: funciona de inmediato y no necesita respuesta nuestra. Para consultar, corregir, eliminar u obtener una copia de cualquier otra cosa que guardemos aquí, <?php if ($legal['email'] !== ''): ?>escribe a <?= $emailLink ?><?php else: ?>escríbenos a través de <a href="<?= site_url('contact') ?>">nuestra página de contacto</a><?php endif ?>. No cobramos nada por esto y no te pediremos que justifiques tu solicitud.</p>

    <h2>Para ambos</h2>

    <h3>Tus derechos</h3>
    <p>Puedes pedirnos que te mostremos lo que guardamos sobre ti, que lo corrijamos, que lo eliminemos o que te enviemos una copia en un formato portátil. También puedes oponerte a cómo lo usamos o retirar un consentimiento que nos hayas dado. Si estás en el Reino Unido o en la UE y crees que hicimos algo mal, tienes derecho a presentar una queja ante la autoridad de protección de datos de tu país.</p>

    <h3>Seguridad</h3>
    <p>Ambos sitios se sirven por HTTPS. Las contraseñas se guardan como hash de un solo sentido, nunca de forma legible. La app bloquea una cuenta después de varios inicios de sesión fallidos y lleva un registro de los inicios de sesión; las áreas de administración de ambos sitios requieren autenticación. Tomamos medidas razonables para proteger tu información, aunque ningún sitio puede prometer una seguridad perfecta.</p>

    <h3>Menores</h3>
    <p>BLUERABBIT no está pensado para menores que no hayan alcanzado la edad de consentimiento digital del lugar donde viven, salvo que los inscriba una escuela, un formador o una organización que cuente con el consentimiento que exige la ley. Este sitio web está dirigido a organizaciones y profesionales; si crees que un menor nos envió información aquí, contáctanos y la eliminaremos.</p>

    <h3>Transferencias internacionales</h3>
    <p>Algunas de las empresas que trabajan para nosotros están fuera de tu país, entre ellas algunas en Estados Unidos. Cuando la ley lo pide, las transferencias están cubiertas por cláusulas contractuales tipo.</p>

    <h3>Cambios en esta política</h3>
    <p>Cuando esta política cambie de forma importante, publicaremos aquí la nueva versión con una nueva fecha y avisaremos a los titulares de cuentas.</p>

    <h3>Contacto</h3>
    <p>Preguntas sobre esta política o sobre los datos que guardamos: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">nuestra página de contacto</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, o por correo postal a <?= esc($legal['address']) ?><?php endif ?>.</p>
