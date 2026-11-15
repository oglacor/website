<?php
/*
 * Chinese (Simplified) translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /zh-cn/refunds.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>BLUERABBIT Pro 按月或按年销售。本页说明你取消订阅后会发生什么，以及何时可以获得退款。</p>

    <h2>简要说明</h2>
    <ul>
      <li><strong>前 30 天免费。</strong>开始试用时我们会请你提供一张银行卡，并且只在试用结束时扣款。在此之前取消，你无需支付任何费用。</li>
      <li><strong>当月费用概不退还。</strong>一旦扣款，该月直到结束都归你使用。</li>
      <li><strong>年付方案未使用的月份可以退款。</strong>你将拿回已支付的金额，减去每个已开始月份的月付价格。</li>
      <li><strong>月付方案不予退款。</strong>取消后，它会在你已付费的月份结束时自动终止。</li>
    </ul>

    <h2>年付方案的计算示例</h2>
    <p>退款金额为你已支付的年费，减去自该次付款以来已开始的每个月（包括当月）的月付价格。退款金额不会低于零。</p>
    <p>以 Pro 年付 80 美元、月付 8 美元为例：</p>
    <ul>
      <li>试用结束，因为你忘记取消，80 美元的年费被扣除，而你在同一个月内联系我们：<strong>你将拿回 72 美元</strong>（80 美元 − 1 个月 × 8 美元）。</li>
      <li>你在第三个月申请：<strong>退款 56 美元</strong>（80 美元 − 3 个月 × 8 美元）。</li>
      <li>你在第十个月或之后申请：已没有可退的金额。</li>
    </ul>
    <p>年付方案退款后，该方案也会立即终止，你的账号将恢复为免费方案。</p>

    <h2>如何取消</h2>
    <p>登录应用后，打开<a href="<?= PLAY_APP_URL ?>/subscription">订阅</a>并选择 <em>管理账单</em>。取消会停止下一次续订；在已付费的期限结束前你仍可使用 Pro。无需任何人批准，你可以随时操作。</p>

    <h2>如何申请退款</h2>
    <p>请使用你账号的电子邮箱地址<?php if ($legal['email'] !== ''): ?>发送邮件至 <?= $emailLink ?><?php else: ?>通过<a href="<?= site_url('contact') ?>">我们的联系页面</a>联系我们<?php endif ?>，并说明你希望退款的方案。我们会按上述方法计算金额，并退回到你付款时使用的银行卡。银行通常需要 5 到 10 天才能显示到账。</p>
    <p>如果是我们这边出了问题，例如重复扣款或无法使用服务，请告诉我们：无论上述规则如何规定，我们都会妥善处理。</p>
    <p>本政策是我们<a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">服务条款</a>的一部分。如果你所在地的法律赋予你更多权利，你将享有更多权利。</p>
