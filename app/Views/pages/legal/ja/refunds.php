<?php
/*
 * Japanese translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /ja/refunds.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15. NOT REVIEWED by a lawyer
 * or by a native speaker: NEEDS LEGAL AND NATIVE REVIEW BEFORE IT IS RELIED ON.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p>BLUERABBIT Pro は月払いまたは年払いで販売しています。このページでは、解約したときにどうなるか、そしていつ返金を受けられるかを説明します。</p>

    <h2>要点</h2>
    <ul>
      <li><strong>最初の 30 日間は無料です。</strong> トライアル開始時にカードの登録をお願いし、請求はトライアル終了時にのみ行います。それまでに解約すれば料金はかかりません。</li>
      <li><strong>当月分は返金されません。</strong> 支払いが完了したら、その月は終わりまでお客様が利用できます。</li>
      <li><strong>年払いプランの未使用の月は返金できます。</strong> お支払いいただいた金額から、始まった各月の月額料金を差し引いた額が戻ります。</li>
      <li><strong>月払いプランは返金されません。</strong> 解約すると、支払い済みの月の終わりにそのまま終了します。</li>
    </ul>

    <h2>年払いプランの計算例</h2>
    <p>返金額は、お支払いいただいた年額から、その支払い以降に始まった各月（当月を含む）の月額料金を差し引いた額です。ゼロを下回ることはありません。</p>
    <p>Pro が年額 80 ドル、月額 8 ドルの場合：</p>
    <ul>
      <li>トライアルが終了し、解約し忘れたために 80 ドルの年額が請求され、同じ月のうちにご連絡いただいた場合：<strong>72 ドルが返金されます</strong>（80 ドル − 8 ドル × 1 か月）。</li>
      <li>3 か月目にご連絡いただいた場合：<strong>56 ドルの返金</strong>（80 ドル − 8 ドル × 3 か月）。</li>
      <li>10 か月目以降にご連絡いただいた場合：返金できる額は残っていません。</li>
    </ul>
    <p>年払いプランを返金すると、そのプランも直ちに終了し、アカウントは無料プランに戻ります。</p>

    <h2>解約の方法</h2>
    <p>アプリにサインインして <a href="<?= PLAY_APP_URL ?>/subscription">サブスクリプション</a> を開き、<em>請求を管理</em> を選択してください。解約すると次回の更新が停止し、支払い済みの期間の終わりまで Pro を利用できます。誰かの承認は必要なく、いつでも手続きできます。</p>

    <h2>返金の依頼方法</h2>
    <p>アカウントのメールアドレスから<?php if ($legal['email'] !== ''): ?> <?= $emailLink ?> まで<?php else: ?>、<a href="<?= site_url('contact') ?>">お問い合わせページ</a>を通じて<?php endif ?>ご連絡いただき、返金をご希望のプランをお知らせください。上記のとおり金額を計算し、お支払いに使用したカードに返金します。通常、銀行に反映されるまで 5〜10 日かかります。</p>
    <p>二重請求やサービスを利用できなかった場合など、当社側に問題があった場合はお知らせください。上記の規定にかかわらず対応いたします。</p>
    <p>このポリシーは当社の<a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">利用規約</a>の一部です。お住まいの地域の法律がより多くの権利を認めている場合、お客様はその権利を有します。</p>
