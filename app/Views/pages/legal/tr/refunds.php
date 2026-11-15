<?php
/*
 * Turkish translation of pages/refunds.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /tr/refunds.
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
    <p>BLUERABBIT Pro aylık ya da yıllık olarak satılır. Bu sayfa, iptal ettiğinizde ne olduğunu ve paranızı ne zaman geri alabileceğinizi açıklar.</p>

    <h2>Kısaca</h2>
    <ul>
      <li><strong>İlk 30 gününüz ücretsizdir.</strong> Denemeyi başlattığınızda bir kart isteriz ve ücreti yalnızca deneme bittiğinde alırız. Ondan önce iptal ederseniz hiçbir şey ödemezsiniz.</li>
      <li><strong>İçinde bulunduğunuz ay asla iade edilmez.</strong> Bir ödeme alındıktan sonra o ay, bitene kadar sizindir.</li>
      <li><strong>Yıllık bir planın kullanılmayan ayları iade edilebilir.</strong> Ödediğiniz tutardan, başlamış her ay için aylık fiyat düşülerek kalanı geri alırsınız.</li>
      <li><strong>Aylık bir plan iade edilmez.</strong> İptal ederseniz, ödemesini yaptığınız ayın sonunda kendiliğinden sona erer.</li>
    </ul>

    <h2>Yıllık planlar, hesaplanmış hâliyle</h2>
    <p>İade, ödediğiniz yıllık tutardan, o ödemeden bu yana başlayan her ay için (içinde bulunulan ay dâhil) aylık fiyatın düşülmesiyle bulunur. Asla sıfırın altında değildir.</p>
    <p>Pro yıllık 80 $ ve aylık 8 $ iken:</p>
    <ul>
      <li>Denemeniz biter, iptal etmeyi unuttuğunuz için 80 $'lık yıllık ücret alınır ve aynı ay bize yazarsınız: <strong>72 $ geri alırsınız</strong> (80 $ − 8 $'dan bir ay).</li>
      <li>Üçüncü ayda isterseniz: <strong>56 $ geri</strong> (80 $ − 8 $'dan üç ay).</li>
      <li>Onuncu ayda ya da daha sonra isterseniz: iade edilecek bir şey kalmaz.</li>
    </ul>
    <p>Yıllık bir planın iadesi o planı da hemen sona erdirir ve hesabınız ücretsiz plana döner.</p>

    <h2>Nasıl iptal edilir</h2>
    <p>Uygulamada oturum açın, <a href="<?= PLAY_APP_URL ?>/subscription">Abonelik</a> sayfasını açın ve <em>Faturalandırmayı yönet</em> seçeneğini seçin. İptal bir sonraki yenilemeyi durdurur; Pro, ödemesini yaptığınız dönemin sonuna kadar sizde kalır. Kimsenin onaylaması gerekmez ve bunu istediğiniz zaman yapabilirsiniz.</p>

    <h2>Nasıl iade istenir</h2>
    <p>Hesabınızın e-posta adresinden <?php if ($legal['email'] !== ''): ?><?= $emailLink ?> adresine<?php else: ?><a href="<?= site_url('contact') ?>">iletişim sayfamız</a> üzerinden bize<?php endif ?> yazın ve hangi planın iade edilmesini istediğinizi belirtin. Tutarı yukarıdaki gibi hesaplar ve ödeme yaptığınız karta geri göndeririz. Bankaların bunu göstermesi genellikle 5 ila 10 gün sürer.</p>
    <p>Bizim tarafımızda bir şeyler ters gittiyse, örneğin iki kez ücret alındıysa ya da hizmeti kullanamadıysanız, bize bildirin: yukarıdaki kural ne derse desin durumu düzeltiriz.</p>
    <p>Bu politika <a href="<?= \App\Libraries\Legal::url('terms', $lang) ?>">Hizmet Şartları</a> belgemizin bir parçasıdır. Yaşadığınız yerin yasası size daha fazlasını tanıyorsa, daha fazlasına sahipsiniz.</p>
