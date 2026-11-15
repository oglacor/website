<?php
/*
 * Korean translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /ko/refunds.
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
    <p>BLUERABBIT Pro는 월 단위 또는 연 단위로 판매됩니다. 이 페이지에서는 해지하면 어떻게 되는지, 그리고 언제 환불받을 수 있는지 설명합니다.</p>

    <h2>요약</h2>
    <ul>
      <li><strong>처음 30일은 무료입니다.</strong> 체험을 시작할 때 카드를 등록해 주셔야 하며, 요금은 체험이 끝날 때만 청구됩니다. 그 전에 해지하면 아무것도 내지 않습니다.</li>
      <li><strong>진행 중인 달은 환불되지 않습니다.</strong> 결제가 완료되면 그 달은 끝날 때까지 회원님이 이용할 수 있습니다.</li>
      <li><strong>연간 요금제의 사용하지 않은 달은 환불받을 수 있습니다.</strong> 결제한 금액에서 시작된 각 달의 월 요금을 뺀 금액을 돌려받습니다.</li>
      <li><strong>월간 요금제는 환불되지 않습니다.</strong> 해지하면 이미 결제한 달이 끝날 때 그대로 종료됩니다.</li>
    </ul>

    <h2>연간 요금제 계산 예시</h2>
    <p>환불액은 결제한 연간 금액에서 그 결제 이후 시작된 각 달(현재 달 포함)의 월 요금을 뺀 금액입니다. 0보다 작아지지 않습니다.</p>
    <p>Pro가 연 80달러, 월 8달러일 때:</p>
    <ul>
      <li>체험이 끝나고, 해지를 잊어서 연간 요금 80달러가 청구되었으며, 같은 달에 연락하신 경우: <strong>72달러를 돌려받습니다</strong>(80달러 − 8달러 × 1개월).</li>
      <li>세 번째 달에 요청하신 경우: <strong>56달러 환불</strong>(80달러 − 8달러 × 3개월).</li>
      <li>열 번째 달 이후에 요청하신 경우: 환불할 금액이 남아 있지 않습니다.</li>
    </ul>
    <p>연간 요금제를 환불하면 해당 요금제도 즉시 종료되며, 계정은 무료 요금제로 돌아갑니다.</p>

    <h2>해지 방법</h2>
    <p>앱에 로그인한 후 <a href="<?= PLAY_APP_URL ?>/subscription">구독</a>을 열고 <em>결제 관리</em>를 선택하세요. 해지하면 다음 갱신이 중단되며, 결제한 기간이 끝날 때까지 Pro를 이용할 수 있습니다. 누구의 승인도 필요 없으며 언제든지 할 수 있습니다.</p>

    <h2>환불 요청 방법</h2>
    <p>계정의 이메일 주소로 <?php if ($legal['email'] !== ''): ?><?= $emailLink ?>에<?php else: ?><a href="<?= site_url('contact') ?>">문의 페이지</a>를 통해 저희에게<?php endif ?> 연락하여 환불받고 싶은 요금제를 알려 주세요. 위와 같이 금액을 계산하여 결제에 사용한 카드로 돌려 드립니다. 은행에 반영되기까지 보통 5~10일이 걸립니다.</p>
    <p>이중 청구나 서비스를 이용할 수 없었던 경우처럼 저희 쪽에 문제가 있었다면 알려 주세요. 위 규정과 관계없이 바로잡아 드립니다.</p>
    <p>이 정책은 저희 <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">서비스 약관</a>의 일부입니다. 거주 지역의 법률이 더 많은 권리를 부여한다면 회원님은 그 권리를 가집니다.</p>
