<?php
/*
 * Portuguese (Brazil) translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /pt-br/refunds.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>O BLUERABBIT Pro é vendido por mês ou por ano. Esta página explica o que acontece quando você cancela e quando pode receber dinheiro de volta.</p>

    <h2>Em resumo</h2>
    <ul>
      <li><strong>Seus primeiros 30 dias são grátis.</strong> Pedimos um cartão quando você começa o teste e só cobramos quando o teste termina. Cancele antes disso e você não paga nada.</li>
      <li><strong>O mês em que você está nunca é reembolsado.</strong> Depois que o pagamento é cobrado, esse mês é seu para usar até o fim.</li>
      <li><strong>Os meses não usados de um plano anual podem ser reembolsados.</strong> Você recebe de volta o que pagou, menos o preço mensal de cada mês iniciado.</li>
      <li><strong>Um plano mensal não é reembolsado.</strong> Cancele e ele simplesmente termina no fim do mês já pago.</li>
    </ul>

    <h2>Planos anuais, na prática</h2>
    <p>O reembolso é o valor anual que você pagou, menos o preço mensal de cada mês iniciado desde esse pagamento, incluindo o mês atual. Nunca é menor que zero.</p>
    <p>Com o Pro a $80 por ano e $8 por mês:</p>
    <ul>
      <li>Seu teste termina, a cobrança anual de $80 é feita porque você esqueceu de cancelar e você nos escreve no mesmo mês: <strong>você recebe $72 de volta</strong> ($80 − um mês a $8).</li>
      <li>Você pede no terceiro mês: <strong>$56 de volta</strong> ($80 − três meses a $8).</li>
      <li>Você pede no décimo mês ou depois: não resta nada a reembolsar.</li>
    </ul>
    <p>O reembolso de um plano anual também encerra esse plano imediatamente, e a sua conta volta ao plano gratuito.</p>

    <h2>Como cancelar</h2>
    <p>Entre na sua conta no app, abra <a href="<?= PLAY_APP_URL ?>/subscription">Assinatura</a> e escolha <em>Gerenciar cobrança</em>. O cancelamento interrompe a próxima renovação; você mantém o Pro até o fim do período pago. Ninguém precisa aprovar, e você pode fazer isso a qualquer momento.</p>

    <h2>Como pedir um reembolso</h2>
    <p><?php if ($legal['email'] !== ''): ?>Escreva para <?= $emailLink ?><?php else: ?>Escreva para nós pela <a href="<?= site_url('contact') ?>">nossa página de contato</a><?php endif ?> a partir do e-mail da sua conta e diga qual plano quer reembolsar. Calculamos o valor como acima e o devolvemos ao cartão usado no pagamento. Os bancos costumam levar de 5 a 10 dias para mostrar o crédito.</p>
    <p>Se algo deu errado do nosso lado, como uma cobrança em dobro ou a impossibilidade de usar o serviço, avise-nos: corrigimos, independentemente da regra acima.</p>
    <p>Esta política faz parte dos nossos <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">Termos de serviço</a>. Se a lei do lugar onde você mora lhe der mais, você tem mais.</p>
