<?php
/*
 * Spanish (Mexico) translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /es/terms.
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
    <p>Estos términos son el acuerdo entre tú y <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>el operador de BLUERABBIT<?php endif ?> ("nosotros") para usar BLUERABBIT, la plataforma en <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> para crear y jugar aventuras de aprendizaje gamificadas. Al crear una cuenta o usar BLUERABBIT, los aceptas. Si usas BLUERABBIT para una organización, también los aceptas en su nombre.</p>

    <h2>1. Tu cuenta</h2>
    <ul>
      <li>Danos datos verdaderos y no compartas tu contraseña. Todo lo que se haga con tu cuenta es tu responsabilidad.</li>
      <li>Debes tener al menos 16 años, o la edad de consentimiento digital del lugar donde vives si es mayor. Un profesor, formador u organización que inscriba a jugadores más jóvenes es responsable de contar con el consentimiento que exige la ley.</li>
      <li>Una persona por cuenta. Las cuentas que un Game Master o una organización crea para sus jugadores se rigen por el acuerdo de esa organización con nosotros.</li>
    </ul>

    <h2>2. Planes</h2>
    <p>Basic es gratuito. BLUERABBIT Pro es una suscripción de pago, mensual o anual, al precio que se muestra al suscribirte, incluido cualquier impuesto que debamos cobrar. Los pagos los gestiona Stripe; nunca vemos ni guardamos el número de tu tarjeta.</p>

    <h2>3. La prueba gratuita</h2>
    <p>Tu primera suscripción Pro empieza con una prueba gratuita de 30 días. Te pedimos una tarjeta al iniciar la prueba. Cuando la prueba termina, se cobra en la tarjeta el plan que elegiste, mensual o anual, salvo que canceles antes. Te enviamos un correo unos días antes de que termine la prueba.</p>

    <h2>4. Renovación y cancelación</h2>
    <p>Pro se renueva automáticamente al final de cada mes o año hasta que lo canceles. Puedes cancelar en cualquier momento desde <a href="<?= PLAY_APP_URL ?>/subscription"><em>Suscripción → Administrar facturación</em></a> en la app. Cancelar detiene la siguiente renovación: conservas Pro hasta el final del periodo que ya pagaste y después tu cuenta vuelve a Basic. Tus aventuras y datos se conservan; las funciones que requieren Pro dejan de estar disponibles.</p>

    <h2>5. Reembolsos</h2>
    <ul>
      <li>El mes en curso nunca se reembolsa una vez cobrado su pago.</li>
      <li>Un plan anual se puede reembolsar por los meses no usados: el importe que pagaste, menos el precio mensual de cada mes que haya empezado desde ese pago (incluido el mes en curso), y nunca menos de cero. Por ejemplo, con Pro a $80 al año y $8 al mes, una renovación anual que querías cancelar y que nos notificas en su primer mes se reembolsa con $72. Reembolsar un plan anual lo termina de inmediato.</li>
      <li>Un plan mensual no se reembolsa; cancelarlo detiene la siguiente renovación.</li>
      <li>Para pedir un reembolso, <?php if ($legal['email'] !== ''): ?>escribe a <?= $emailLink ?><?php else: ?>escríbenos a través de <a href="<?= site_url('contact') ?>">nuestra página de contacto</a><?php endif ?> desde el correo electrónico de tu cuenta. Los reembolsos se devuelven a la tarjeta con la que pagaste.</li>
    </ul>
    <p>La <a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">Política de reembolsos</a> lo explica con más ejemplos. Si la ley del lugar donde vives te da más derechos que esta sección, los tienes.</p>

    <h2>6. Cambios de precio</h2>
    <p>Podemos cambiar el precio de Pro. Un cambio nunca afecta a un periodo que ya pagaste, y te avisamos al menos 30 días antes de tu primera renovación al nuevo precio, para que puedas cancelar antes.</p>

    <h2>7. Tu contenido</h2>
    <p>Lo que creas o subes (aventuras, hitos, imágenes, respuestas, mensajes) sigue siendo tuyo. Nos das el permiso que necesitamos para guardarlo, mostrarlo a las personas con las que lo compartes y prestar el servicio, y nada más. Eres responsable de tener los derechos sobre lo que subes y de lo que publicas para tus jugadores.</p>

    <h2>8. Uso justo de BLUERABBIT</h2>
    <p>No uses BLUERABBIT para infringir la ley, acosar o dañar a nadie, subir software malicioso, atacar o sobrecargar el servicio, leer datos que no son tuyos o evadir un límite de tu plan. No revendas BLUERABBIT sin nuestro acuerdo por escrito. Podemos retirar contenido o suspender una cuenta que lo haga, y te diremos por qué salvo que la ley o la seguridad de otras personas nos lo impidan.</p>

    <h2>9. Funciones de I.A.</h2>
    <p>Algunas funciones (el asistente Cooper y la revisión de respuestas con I.A., cuando una aventura las activa) envían el texto correspondiente a Anthropic, nuestro proveedor de I.A., para generar una respuesta. Los resultados de la I.A. pueden ser incorrectos: el Game Master sigue siendo responsable de las decisiones que tome con ellos.</p>

    <h2>10. El servicio</h2>
    <p>Trabajamos para mantener BLUERABBIT disponible y tus datos seguros, y lo mejoramos constantemente, lo que a veces implica cambiar o retirar una función. Si retiramos algo de lo que depende un plan de pago, te avisamos antes. No somos responsables de pérdidas causadas por hechos fuera de nuestro control razonable.</p>

    <h2>11. Fin del acuerdo</h2>
    <p>Puedes dejar de usar BLUERABBIT y eliminar tu cuenta en cualquier momento desde <a href="<?= PLAY_APP_URL ?>/my-account"><em>Mi Cuenta → Tus datos</em></a> en la app, después de cancelar cualquier suscripción. Podemos terminar o suspender una cuenta que incumpla estos términos de forma grave o reiterada. Lo que pasa con tus datos cuando se elimina una cuenta está en la <a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">Política de privacidad</a>.</p>

    <h2>12. Responsabilidad</h2>
    <p>BLUERABBIT se ofrece tal como es. En la medida en que la ley lo permita, no somos responsables de pérdidas indirectas o consecuentes, y nuestra responsabilidad total contigo se limita a lo que nos pagaste en los 12 meses anteriores a la reclamación. Nada de esto limita la responsabilidad que la ley no permite limitar.</p>

    <h2>13. Cambios en estos términos</h2>
    <p>Cuando cambiemos estos términos de forma importante, publicaremos aquí la nueva versión con una nueva fecha y avisaremos a los titulares de cuentas antes de que entre en vigor. Si sigues usando BLUERABBIT después, se aplica la nueva versión; si no estás de acuerdo, cancela y elimina tu cuenta.</p>

    <h2>14. Ley aplicable y contacto</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>Estos términos se rigen por las leyes de <?= esc($legal['jurisdiction']) ?>.<?php else: ?>Estos términos se rigen por las leyes del lugar donde estamos establecidos.<?php endif ?> Preguntas: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">nuestra página de contacto</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, o por correo postal a <?= esc($legal['address']) ?><?php endif ?>.</p>
