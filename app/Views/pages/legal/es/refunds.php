<?php
/*
 * Spanish (Mexico) translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /es/refunds.
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
    <p>BLUERABBIT Pro se vende por mes o por año. Esta página explica qué pasa cuando cancelas y cuándo puedes recuperar tu dinero.</p>

    <h2>En resumen</h2>
    <ul>
      <li><strong>Tus primeros 30 días son gratis.</strong> Te pedimos una tarjeta al iniciar la prueba y solo se cobra cuando la prueba termina. Si cancelas antes, no pagas nada.</li>
      <li><strong>El mes en curso nunca se reembolsa.</strong> Una vez cobrado el pago, ese mes es tuyo para usarlo hasta que termine.</li>
      <li><strong>Los meses no usados de un plan anual se pueden reembolsar.</strong> Recuperas lo que pagaste, menos el precio mensual de cada mes que haya empezado.</li>
      <li><strong>Un plan mensual no se reembolsa.</strong> Si lo cancelas, simplemente termina al final del mes que ya pagaste.</li>
    </ul>

    <h2>Planes anuales, con cuentas</h2>
    <p>El reembolso es el importe anual que pagaste, menos el precio mensual de cada mes que haya empezado desde ese pago, incluido el mes en curso. Nunca es menor que cero.</p>
    <p>Con Pro a $80 al año y $8 al mes:</p>
    <ul>
      <li>Tu prueba termina, el cargo anual de $80 se cobra porque olvidaste cancelar y nos escribes ese mismo mes: <strong>recuperas $72</strong> ($80 − un mes a $8).</li>
      <li>Lo pides en el tercer mes: <strong>recuperas $56</strong> ($80 − tres meses a $8).</li>
      <li>Lo pides en el décimo mes o después: ya no queda nada por reembolsar.</li>
    </ul>
    <p>El reembolso de un plan anual también termina ese plan de inmediato, y tu cuenta vuelve al plan gratuito.</p>

    <h2>Cómo cancelar</h2>
    <p>Inicia sesión en la app, abre <a href="<?= PLAY_APP_URL ?>/subscription">Suscripción</a> y elige <em>Administrar facturación</em>. Cancelar detiene la siguiente renovación; conservas Pro hasta el final del periodo que pagaste. Nadie tiene que aprobarlo y puedes hacerlo en cualquier momento.</p>

    <h2>Cómo pedir un reembolso</h2>
    <p><?php if ($legal['email'] !== ''): ?>Escribe a <?= $emailLink ?><?php else: ?>Escríbenos a través de <a href="<?= site_url('contact') ?>">nuestra página de contacto</a><?php endif ?> desde el correo electrónico de tu cuenta e indica qué plan quieres que te reembolsemos. Calculamos el importe como se explica arriba y lo devolvemos a la tarjeta con la que pagaste. Los bancos suelen tardar de 5 a 10 días en reflejarlo.</p>
    <p>Si algo salió mal por nuestra parte, por ejemplo un cobro doble o no poder usar el servicio, avísanos: lo corregimos, diga lo que diga la regla anterior.</p>
    <p>Esta política forma parte de nuestros <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">Términos del servicio</a>. Si la ley del lugar donde vives te da más, tienes más.</p>
