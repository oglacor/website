<?php
/*
 * Portuguese (Brazil) translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /pt-br/terms.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>Estes termos são o acordo entre você e <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>o operador do BLUERABBIT<?php endif ?> ("nós") para o uso do BLUERABBIT, a plataforma em <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> para criar e jogar aventuras de aprendizagem gamificadas. Ao criar uma conta ou usar o BLUERABBIT, você os aceita. Se você usa o BLUERABBIT para uma organização, também os aceita em nome dela.</p>

    <h2>1. Sua conta</h2>
    <ul>
      <li>Informe dados verdadeiros e não compartilhe a sua senha. Tudo o que for feito com a sua conta é de sua responsabilidade.</li>
      <li>Você precisa ter pelo menos 16 anos, ou a idade de consentimento digital do lugar onde mora, se for maior. Um professor, instrutor ou organização que inscreve jogadores mais jovens é responsável por ter o consentimento exigido por lei.</li>
      <li>Uma pessoa por conta. As contas que um Mestre do jogo ou uma organização cria para jogadores são regidas pelo acordo dessa organização conosco.</li>
    </ul>

    <h2>2. Planos</h2>
    <p>O Basic é gratuito. O BLUERABBIT Pro é uma assinatura paga, mensal ou anual, pelo preço exibido no momento da assinatura, incluindo os impostos que tivermos de cobrar. Os pagamentos são processados pela Stripe; nunca vemos nem armazenamos o número do seu cartão.</p>

    <h2>3. O período de teste gratuito</h2>
    <p>Sua primeira assinatura Pro começa com um teste gratuito de 30 dias. Pedimos um cartão quando o teste começa. Quando o teste termina, o cartão é cobrado pelo plano que você escolheu, mensal ou anual, a menos que você cancele antes. Enviamos um e-mail alguns dias antes do fim do teste.</p>

    <h2>4. Renovação e cancelamento</h2>
    <p>O Pro é renovado automaticamente ao fim de cada mês ou ano até você cancelá-lo. Você pode cancelar a qualquer momento em <a href="<?= PLAY_APP_URL ?>/subscription"><em>Assinatura → Gerenciar cobrança</em></a> no app. O cancelamento interrompe a próxima renovação: você mantém o Pro até o fim do período já pago e, depois, a sua conta volta ao Basic. Suas aventuras e dados permanecem; os recursos que exigem o Pro deixam de funcionar.</p>

    <h2>5. Reembolsos</h2>
    <ul>
      <li>O mês em andamento nunca é reembolsado depois que o pagamento foi cobrado.</li>
      <li>Um plano anual pode ser reembolsado pelos meses não usados: o valor que você pagou, menos o preço mensal de cada mês iniciado desde esse pagamento (incluindo o mês atual), e nunca menos que zero. Por exemplo, com o Pro a $80 por ano e $8 por mês, uma renovação anual que você pretendia cancelar e que nos comunica no primeiro mês é reembolsada em $72. O reembolso de um plano anual o encerra imediatamente.</li>
      <li>Um plano mensal não é reembolsado; cancelá-lo interrompe a próxima renovação.</li>
      <li>Para pedir um reembolso, <?php if ($legal['email'] !== ''): ?>escreva para <?= $emailLink ?><?php else: ?>escreva para nós pela <a href="<?= site_url('contact') ?>">nossa página de contato</a><?php endif ?> a partir do e-mail da sua conta. Os reembolsos voltam para o cartão usado no pagamento.</li>
    </ul>
    <p>A <a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">Política de reembolso</a> explica isso com mais exemplos. Se a lei do lugar onde você mora lhe der mais direitos do que esta seção, você os tem.</p>

    <h2>6. Mudanças de preço</h2>
    <p>Podemos mudar o preço do Pro. Uma mudança nunca afeta um período já pago, e avisamos você com pelo menos 30 dias de antecedência da primeira renovação pelo novo preço, para que possa cancelar antes.</p>

    <h2>7. Seu conteúdo</h2>
    <p>O que você cria ou envia (aventuras, marcos, imagens, respostas, mensagens) continua sendo seu. Você nos dá a permissão necessária para armazená-lo, mostrá-lo às pessoas com quem você o compartilha e operar o serviço, e nada além disso. Você é responsável por ter os direitos sobre o que envia e pelo que publica para os seus jogadores.</p>

    <h2>8. Uso justo do BLUERABBIT</h2>
    <p>Não use o BLUERABBIT para infringir a lei, assediar ou prejudicar alguém, enviar malware, atacar ou sobrecarregar o serviço, ler dados que não são seus ou contornar um limite do seu plano. Não revenda o BLUERABBIT sem o nosso acordo por escrito. Podemos remover conteúdo ou suspender uma conta que faça isso, e diremos o motivo, a menos que a lei ou a segurança de outras pessoas nos impeça.</p>

    <h2>9. Recursos de I.A.</h2>
    <p>Alguns recursos (o assistente Cooper e a revisão de respostas por I.A., quando uma aventura os ativa) enviam o texto envolvido à Anthropic, nossa fornecedora de I.A., para gerar uma resposta. Os resultados da I.A. podem estar errados: o Mestre do jogo continua responsável pelas decisões tomadas com eles.</p>

    <h2>10. O serviço</h2>
    <p>Trabalhamos para manter o BLUERABBIT disponível e os seus dados seguros, e o melhoramos o tempo todo, o que às vezes significa mudar ou retirar um recurso. Se retirarmos algo de que um plano pago depende, avisaremos antes. Não somos responsáveis por perdas causadas por eventos fora do nosso controle razoável.</p>

    <h2>11. Encerramento do acordo</h2>
    <p>Você pode parar de usar o BLUERABBIT e excluir a sua conta a qualquer momento em <a href="<?= PLAY_APP_URL ?>/my-account"><em>Minha conta → Seus dados</em></a> no app, depois de cancelar qualquer assinatura. Podemos encerrar ou suspender uma conta que viole estes termos de forma grave ou repetida. O que acontece com os seus dados quando uma conta é excluída está na <a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">Política de privacidade</a>.</p>

    <h2>12. Responsabilidade</h2>
    <p>O BLUERABBIT é oferecido no estado em que se encontra. Na medida permitida por lei, não respondemos por perdas indiretas ou consequenciais, e a nossa responsabilidade total perante você limita-se ao que você nos pagou nos 12 meses anteriores à reclamação. Nada aqui limita a responsabilidade que a lei não permite limitar.</p>

    <h2>13. Alterações destes termos</h2>
    <p>Quando alterarmos estes termos de forma relevante, publicaremos aqui a nova versão com uma nova data e avisaremos os titulares de contas antes que ela entre em vigor. Se você continuar usando o BLUERABBIT depois disso, a nova versão se aplica; se não concordar, cancele e exclua a sua conta.</p>

    <h2>14. Lei aplicável e contato</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>Estes termos são regidos pelas leis de <?= esc($legal['jurisdiction']) ?>.<?php else: ?>Estes termos são regidos pelas leis do lugar onde estamos estabelecidos.<?php endif ?> Dúvidas: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">nossa página de contato</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, ou por correio para <?= esc($legal['address']) ?><?php endif ?>.</p>
