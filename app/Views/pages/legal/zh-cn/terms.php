<?php
/*
 * Chinese (Simplified) translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /zh-cn/terms.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>本条款是你与 <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>BLUERABBIT 的运营方<?php endif ?>（“我们”）之间关于使用 BLUERABBIT 的协议。BLUERABBIT 是位于 <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>、用于创建和游玩游戏化学习冒险的平台。创建账号或使用 BLUERABBIT，即表示你接受本条款。如果你代表某个机构使用 BLUERABBIT，你也代表该机构接受本条款。</p>

    <h2>1. 你的账号</h2>
    <ul>
      <li>请提供真实信息，并妥善保管你的密码。使用你的账号进行的一切行为均由你负责。</li>
      <li>你必须年满 16 周岁；如果你所在地的数字同意年龄更高，则须达到该年龄。为更年轻的玩家报名的教师、培训师或机构，有责任取得法律所要求的同意。</li>
      <li>一人一个账号。由游戏管理员或机构为玩家创建的账号，适用该机构与我们之间的协议。</li>
    </ul>

    <h2>2. 方案</h2>
    <p>Basic 免费。BLUERABBIT Pro 是按月或按年付费的订阅，价格以订阅时显示的为准，包括我们必须收取的任何税费。付款由 Stripe 处理；我们从不查看或保存你的银行卡号。</p>

    <h2>3. 免费试用</h2>
    <p>你的首个 Pro 订阅从 30 天免费试用开始。试用开始时，我们会请你提供一张银行卡。试用结束时，除非你在此之前取消，否则将按你选择的方案（按月或按年）从该卡扣款。我们会在试用结束前几天给你发送邮件。</p>

    <h2>4. 续订与取消</h2>
    <p>Pro 会在每月或每年结束时自动续订，直到你取消为止。你可以随时在应用的 <a href="<?= PLAY_APP_URL ?>/subscription"><em>订阅 → 管理账单</em></a> 中取消。取消会停止下一次续订：在已付费的期限结束前你仍可使用 Pro，之后你的账号将恢复为 Basic。你的冒险和数据会保留；需要 Pro 的功能将停止。</p>

    <h2>5. 退款</h2>
    <ul>
      <li>当月的费用一经扣款，概不退还。</li>
      <li>年付方案可以就未使用的月份退款：退款金额为你支付的金额，减去自该次付款以来已开始的每个月（包括当月）的月付价格，且不会低于零。例如，Pro 年付 80 美元、月付 8 美元时，一笔你本打算取消、并在第一个月内告知我们的年度续订，将退款 72 美元。年付方案一经退款即立即终止。</li>
      <li>月付方案不予退款；取消后将停止下一次续订。</li>
      <li>如需退款，请使用你账号的电子邮箱地址<?php if ($legal['email'] !== ''): ?>发送邮件至 <?= $emailLink ?><?php else: ?>通过<a href="<?= site_url('contact') ?>">我们的联系页面</a>联系我们<?php endif ?>。退款将退回到你付款时使用的银行卡。</li>
    </ul>
    <p><a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">退款政策</a>用更多示例对此作了说明。如果你所在地的法律赋予你比本条更多的权利，你将享有这些权利。</p>

    <h2>6. 价格变更</h2>
    <p>我们可能会调整 Pro 的价格。价格变更绝不影响你已付费的期限，并且我们会在你以新价格首次续订前至少 30 天通知你，以便你可以提前取消。</p>

    <h2>7. 你的内容</h2>
    <p>你创建或上传的内容（冒险、里程碑、图片、答案、消息）仍归你所有。你仅授予我们为存储这些内容、向你与之分享的人展示这些内容以及运营服务所需的许可，除此之外别无其他。你须确保对上传的内容拥有相应权利，并对你向玩家发布的内容负责。</p>

    <h2>8. 公平使用 BLUERABBIT</h2>
    <p>请勿利用 BLUERABBIT 违反法律、骚扰或伤害他人、上传恶意软件、攻击服务或使其过载、读取不属于你的数据，或规避你所用方案的限制。未经我们书面同意，请勿转售 BLUERABBIT。对于有上述行为的账号，我们可能会删除其内容或暂停该账号，并会告知你原因，除非法律或他人的安全不允许我们这样做。</p>

    <h2>9. A.I. 功能</h2>
    <p>部分功能（冒险开启时的 Cooper 助手以及 A.I. 答案评审）会将相关文本发送给我们的 A.I. 服务提供商 Anthropic，以生成回复。A.I. 的输出可能有误：游戏管理员仍须对据此作出的决定负责。</p>

    <h2>10. 服务</h2>
    <p>我们致力于让 BLUERABBIT 保持可用、确保你的数据安全，并不断改进服务，这有时意味着更改或停用某项功能。如果我们停用某项付费方案所依赖的功能，会事先通知你。对于超出我们合理控制范围的事件所造成的损失，我们不承担责任。</p>

    <h2>11. 协议终止</h2>
    <p>在取消任何订阅后，你可以随时停止使用 BLUERABBIT，并在应用的 <a href="<?= PLAY_APP_URL ?>/my-account"><em>我的账号 → 你的数据</em></a> 中删除你的账号。对于严重或多次违反本条款的账号，我们可以终止或暂停该账号。删除账号后你的数据将如何处理，请参阅<a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">隐私政策</a>。</p>

    <h2>12. 责任</h2>
    <p>BLUERABBIT 按“现状”提供。在法律允许的范围内，我们不对间接或后果性损失承担责任，且我们对你的全部责任以你在提出索赔前 12 个月内向我们支付的金额为限。本条款的任何内容均不限制法律不允许限制的责任。</p>

    <h2>13. 本条款的变更</h2>
    <p>当我们对本条款作出重要变更时，会在此发布带有新日期的新版本，并在其生效前通知账号持有人。此后如果你继续使用 BLUERABBIT，则适用新版本；如果你不同意，请取消订阅并删除你的账号。</p>

    <h2>14. 适用法律与联系方式</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>本条款受 <?= esc($legal['jurisdiction']) ?> 法律管辖。<?php else: ?>本条款受我们设立地法律管辖。<?php endif ?>如有疑问：<?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">我们的联系页面</a><?php endif ?><?php if ($legal['address'] !== ''): ?>，或邮寄至 <?= esc($legal['address']) ?><?php endif ?>。</p>
