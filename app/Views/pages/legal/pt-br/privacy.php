<?php
/*
 * Portuguese (Brazil) translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /pt-br/privacy.
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
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>O operador do BLUERABBIT<?php endif ?> opera o BLUERABBIT e é responsável pelos dados pessoais que mantém sobre você. Esta política abrange dois lugares:</p>
    <ul>
      <li><strong>O app BLUERABBIT</strong> em <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>, onde ficam as aventuras, as contas de jogador e as assinaturas (Parte 1).</li>
      <li><strong>Este site</strong>, bluerabbit.io: as páginas de apresentação, o blog, a documentação, a lista de espera e o formulário de contato (Parte 2).</li>
    </ul>
    <p>São sistemas separados, com contas separadas: uma conta do site aqui não é uma conta do app lá, e nenhuma das duas permite entrar na outra. As organizações que usam o BLUERABBIT em seu próprio endereço web, com um acordo separado conosco, são regidas por esse acordo.</p>

    <h2>Parte 1: O app BLUERABBIT</h2>

    <h3>O que guardamos</h3>
    <ul>
      <li><strong>Sua conta:</strong> endereço de e-mail, apelido, o nome que você informa e uma senha armazenada apenas como hash irreversível. Dados opcionais do perfil (foto, biografia, empresa, links), se você os adicionar.</li>
      <li><strong>O que você faz nas aventuras:</strong> progresso, XP, níveis, conquistas e itens, suas respostas e envios de arquivos, mensagens, publicações no mural e pedidos de ajuda, e a atividade que compõe o seu histórico.</li>
      <li><strong>Pagamentos:</strong> seu plano, o status da assinatura e as faturas. A Stripe guarda o seu cartão; nós guardamos apenas uma referência ao seu cadastro de cliente na Stripe.</li>
      <li><strong>Segurança:</strong> um registro de acessos (cada login, falha, bloqueio e redefinição de senha, com o endereço de internet e o navegador de origem) e a confirmação do seu endereço de e-mail.</li>
      <li><strong>Cookies:</strong> apenas os que o serviço precisa: um cookie de sessão que mantém você conectado e outro que protege seus formulários contra falsificação. A Cloudflare e a verificação Turnstile dela, que barram cadastros automatizados, podem definir seus próprios cookies de segurança. Não usamos cookies de publicidade.</li>
    </ul>

    <h3>Por que guardamos</h3>
    <ul>
      <li>Para operar o serviço que você contratou: sua conta, suas aventuras, seu plano (nosso contrato com você).</li>
      <li>Para manter as contas e o serviço seguros: o registro de acessos, os bloqueios e as verificações contra abuso (nosso legítimo interesse em segurança).</li>
      <li>Para cumprir obrigações legais, como guardar as faturas pelo tempo que a legislação tributária exige.</li>
      <li>Para enviar e-mails sobre a sua conta: confirmações, redefinições de senha, avisos do período de teste e de pagamento. Os e-mails das aventuras podem ser desativados pelo link que eles contêm.</li>
    </ul>
    <p>Não vendemos os seus dados e não os usamos para publicidade.</p>

    <h3>Quem tem acesso</h3>
    <ul>
      <li><strong>Em uma aventura</strong>, os Mestres do jogo e a equipe que a conduzem veem o seu progresso e os trabalhos que você entrega. Os outros jogadores veem o seu nome, nível, XP e conquistas nos rankings e nas listas de guildas, nunca o seu e-mail.</li>
      <li><strong>Empresas que trabalham para nós</strong>, cada uma apenas para a sua parte: Stripe (pagamentos), Resend (envio de e-mails), Cloudflare (entrega do site e proteção contra ataques), Anthropic (os recursos de I.A., quando uma aventura os ativa) e o nosso provedor de hospedagem. Elas tratam os seus dados conforme as nossas instruções.</li>
      <li><strong>Autoridades</strong>, somente quando a lei exigir.</li>
    </ul>

    <h3>Por quanto tempo guardamos</h3>
    <ul>
      <li>Sua conta e o que você criou: até você excluir a conta.</li>
      <li>O registro de acessos: 12 meses; depois ele é apagado automaticamente.</li>
      <li>Faturas e registros de pagamento: pelo tempo que a legislação tributária e contábil exigir.</li>
      <li>Depois que você exclui a conta, suas pontuações podem permanecer nas estatísticas e nos rankings de uma aventura sob um nome anônimo, para que os resultados dos outros jogadores continuem corretos. Nada nelas identifica você.</li>
    </ul>

    <h3>Seus direitos no app</h3>
    <ul>
      <li><strong>Ver e levar os seus dados:</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>Minha conta → Seus dados → Baixar</em></a> entrega tudo o que guardamos sobre você em um único arquivo.</li>
      <li><strong>Excluir a sua conta:</strong> <em>Minha conta → Seus dados → Excluir minha conta</em> remove a sua identidade de todos os lugares, apaga as suas conversas e arquivos enviados e encerra todas as sessões. Cancele antes qualquer assinatura ativa.</li>
      <li><strong>Corrigir:</strong> edite o seu perfil a qualquer momento.</li>
      <li><strong>Opor-se, pedir limitação ou tirar uma dúvida:</strong> <?php if ($legal['email'] !== ''): ?>escreva para <?= $emailLink ?><?php else: ?>escreva para nós pela <a href="<?= site_url('contact') ?>">nossa página de contato</a><?php endif ?>.</li>
    </ul>

    <h2>Parte 2: Este site</h2>

    <h3>O que coletamos</h3>
    <p>Apenas o que a página que você está usando realmente precisa. A lista completa é esta:</p>
    <ul>
      <li><strong>Inscrições na lista de espera</strong> — seu endereço de e-mail e a página em que você se inscreveu. Nada mais.</li>
      <li><strong>Formulário de contato</strong> — seu nome, seu endereço de e-mail, o assunto e a mensagem que você escreve.</li>
      <li><strong>Contas do site</strong> — se você criar uma conta neste site, seu nome, seu endereço de e-mail e uma versão da sua senha protegida por um hash seguro. Nunca armazenamos a senha em si e não conseguimos lê-la.</li>
      <li><strong>Cookie de sessão</strong> — um único cookie que mantém você conectado enquanto usa o site.</li>
      <li><strong>Registros do servidor</strong> — registros padrão das solicitações web (endereço IP, agente de usuário do navegador, página solicitada, data e hora), mantidos para segurança e depuração.</li>
    </ul>

    <h3>O que não fazemos</h3>
    <p>Vale dizer com todas as letras, porque é incomum o bastante para valer a pena conferir:</p>
    <ul>
      <li>Nenhum script de análise ou de rastreamento. Não há Google Analytics, nem gerenciador de tags, nem gravação de sessões, nem mapas de calor.</li>
      <li>Nenhum cookie de publicidade, nenhum pixel de redirecionamento de anúncios, nenhum rastreador de terceiros, de nenhum tipo.</li>
      <li>Nenhuma venda, aluguel ou troca das suas informações pessoais. Para ninguém, por preço nenhum.</li>
      <li>Nenhuma criação de perfil nem decisão automatizada sobre você.</li>
    </ul>

    <h3>Cookies</h3>
    <ul>
      <li><strong>Essenciais (sempre ativos).</strong> Um cookie de sessão que mantém você conectado, um token de segurança que impede que outros sites enviem nossos formulários em seu nome, um cookie que registra a sua escolha descrita logo abaixo e um cookie definido pela Cloudflare que distingue visitantes reais de bots. Eles são estritamente necessários para o funcionamento do site, por isso não exigem consentimento e não podem ser desativados — mas não carregam dados de publicidade e não são usados para traçar o seu perfil.</li>
      <li><strong>Análise (você escolhe).</strong> Estatísticas anônimas sobre quais páginas são lidas. <strong>No momento, não usamos nenhum tipo de análise.</strong> Se passarmos a usar, ela só será carregada para quem tiver concordado ativamente — a sua escolha fica registrada com antecedência e é respeitada automaticamente.</li>
    </ul>
    <p><strong>Para mudar de ideia.</strong> Use o link <em>Configurações de cookies</em> no rodapé de qualquer página para rever ou mudar a sua escolha a qualquer momento. Retirar o consentimento é tão fácil quanto foi dá-lo, e vale imediatamente. Também perguntamos de novo depois de doze meses, em vez de tratar uma resposta antiga como permanente. Recusar a análise não custa nada — todas as partes deste site funcionam exatamente da mesma forma nos dois casos.</p>

    <h3>Por que usamos</h3>
    <ul>
      <li><strong>Para responder a você</strong> — as mensagens do formulário de contato existem para que uma pessoa possa responder à sua pergunta.</li>
      <li><strong>Para falar sobre o BLUERABBIT</strong> — se você entrou na lista de espera, enviamos e-mails sobre a disponibilidade e as novidades do lançamento. Esse é o único motivo pelo qual a lista existe.</li>
      <li><strong>Para operar a sua conta</strong> — autenticar você e manter você conectado.</li>
      <li><strong>Para manter o site funcionando e seguro</strong> — registros, prevenção de abuso e depuração.</li>
    </ul>
    <p>Quando a lei exige uma base legal (por exemplo, o RGPD do Reino Unido ou da UE), nos baseamos no seu consentimento para os e-mails da lista de espera e no nosso legítimo interesse em responder a contatos, operar o site e mantê-lo seguro para todo o resto.</p>

    <h3>Quem mais lida com os seus dados</h3>
    <ul>
      <li><strong>Resend</strong> — envia os nossos e-mails transacionais e da lista de espera. Recebe o seu endereço de e-mail e o conteúdo da mensagem.</li>
      <li><strong>Cloudflare</strong> — fica na frente do site para segurança, proteção contra ataques DDoS e desempenho. Processa metadados das solicitações, incluindo o seu endereço IP.</li>
      <li><strong>Nosso provedor de hospedagem</strong> — armazena o site e o banco de dados dele.</li>
      <li><strong>jsDelivr</strong> — fornece a biblioteca do editor de texto formatado, mas apenas nas páginas de administração, com sessão iniciada. Visitantes comuns nunca a carregam.</li>
    </ul>

    <h3>Por quanto tempo guardamos</h3>
    <ul>
      <li><strong>E-mails da lista de espera</strong> — até você cancelar a inscrição ou pedir para ser removido.</li>
      <li><strong>Mensagens de contato</strong> — até o assunto ser resolvido e não ser mais necessário para os nossos registros.</li>
      <li><strong>Contas do site</strong> — enquanto a conta existir. Exclua a conta e o registro vai junto.</li>
      <li><strong>Registros do servidor</strong> — por um curto período, renovado continuamente; depois são descartados.</li>
    </ul>

    <h3>Suas opções neste site</h3>
    <p>Para cancelar a inscrição nos e-mails da lista de espera, use o link de cancelamento no final de qualquer e-mail que enviamos — ele funciona imediatamente e não precisa de resposta nossa. Para ver, corrigir, excluir ou obter uma cópia de qualquer outra coisa que guardamos aqui, <?php if ($legal['email'] !== ''): ?>escreva para <?= $emailLink ?><?php else: ?>escreva para nós pela <a href="<?= site_url('contact') ?>">nossa página de contato</a><?php endif ?>. Não cobramos nada por isso e não pediremos que você justifique o pedido.</p>

    <h2>Para ambos</h2>

    <h3>Seus direitos</h3>
    <p>Você pode nos pedir para mostrar o que guardamos sobre você, corrigir, excluir ou enviar uma cópia em formato portátil. Você também pode se opor à forma como usamos esses dados ou retirar um consentimento que tenha dado. Se você está no Reino Unido ou na UE e acha que fizemos algo errado, tem o direito de reclamar à autoridade nacional de proteção de dados.</p>

    <h3>Segurança</h3>
    <p>Os dois sites são servidos via HTTPS. As senhas são armazenadas como hash irreversível, nunca em formato legível. O app bloqueia uma conta após repetidas falhas de login e mantém um registro de acessos; as áreas administrativas dos dois sites exigem autenticação. Tomamos medidas razoáveis para proteger as suas informações, embora nenhum site possa prometer segurança perfeita.</p>

    <h3>Crianças</h3>
    <p>O BLUERABBIT não se destina a crianças abaixo da idade de consentimento digital do lugar onde vivem, a menos que uma escola, um instrutor ou uma organização que tenha o consentimento exigido por lei faça a inscrição delas. Este site é voltado a organizações e profissionais; se você acredita que uma criança enviou informações aqui, entre em contato conosco e as excluiremos.</p>

    <h3>Transferências internacionais</h3>
    <p>Algumas das empresas que trabalham para nós estão fora do seu país, inclusive nos Estados Unidos. Quando a lei exige, as transferências são cobertas por cláusulas contratuais padrão.</p>

    <h3>Alterações desta política</h3>
    <p>Quando esta política mudar de forma relevante, publicaremos aqui a nova versão com uma nova data e avisaremos os titulares de contas.</p>

    <h3>Contato</h3>
    <p>Dúvidas sobre esta política ou sobre os dados que guardamos: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">nossa página de contato</a><?php endif ?><?php if ($legal['address'] !== ''): ?>, ou por correio para <?= esc($legal['address']) ?><?php endif ?>.</p>
