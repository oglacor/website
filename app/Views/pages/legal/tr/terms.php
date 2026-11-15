<?php
/*
 * Turkish translation of pages/terms.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /tr/terms.
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
    <p>Bu şartlar, oyunlaştırılmış öğrenme maceraları oluşturmak ve oynamak için <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> adresindeki platform olan BLUERABBIT'in kullanımına ilişkin olarak sizinle <?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>BLUERABBIT'in işletmecisi<?php endif ?> ("biz") arasındaki sözleşmedir. Bir hesap oluşturarak ya da BLUERABBIT'i kullanarak bu şartları kabul edersiniz. BLUERABBIT'i bir kuruluş adına kullanıyorsanız, şartları o kuruluş adına da kabul edersiniz.</p>

    <h2>1. Hesabınız</h2>
    <ul>
      <li>Bize doğru bilgiler verin ve parolanızı kimseyle paylaşmayın. Hesabınızla yapılan her şeyden siz sorumlusunuz.</li>
      <li>En az 16 yaşında olmalısınız ya da yaşadığınız yerdeki dijital rıza yaşı daha yüksekse o yaşta olmalısınız. Daha küçük oyuncuları kaydeden bir öğretmen, eğitmen ya da kuruluş, yasanın gerektirdiği rızayı almaktan sorumludur.</li>
      <li>Her hesap bir kişi içindir. Bir oyun yöneticisinin ya da bir kuruluşun oyuncular için oluşturduğu hesaplar, o kuruluşun bizimle yaptığı sözleşmeye tabidir.</li>
    </ul>

    <h2>2. Planlar</h2>
    <p>Basic ücretsizdir. BLUERABBIT Pro, abone olurken gösterilen fiyattan, tahsil etmemiz gereken vergiler dâhil, aylık ya da yıllık ücretli bir aboneliktir. Ödemeleri Stripe yürütür; kart numaranızı asla görmez ve saklamayız.</p>

    <h2>3. Ücretsiz deneme</h2>
    <p>İlk Pro aboneliğiniz 30 günlük ücretsiz bir denemeyle başlar. Deneme başladığında bir kart isteriz. Deneme sona erdiğinde, daha önce iptal etmediyseniz seçtiğiniz plan için, aylık ya da yıllık, karttan ücret alınır. Deneme bitmeden birkaç gün önce size e-posta göndeririz.</p>

    <h2>4. Yenileme ve iptal</h2>
    <p>Pro, siz iptal edene kadar her ayın ya da yılın sonunda otomatik olarak yenilenir. İstediğiniz zaman uygulamadaki <a href="<?= PLAY_APP_URL ?>/subscription"><em>Abonelik → Faturalandırmayı yönet</em></a> bölümünden iptal edebilirsiniz. İptal bir sonraki yenilemeyi durdurur: Pro, ödemesini yaptığınız dönemin sonuna kadar sizde kalır, ardından hesabınız Basic'e döner. Maceralarınız ve verileriniz kalır; Pro gerektiren özellikler durur.</p>

    <h2>5. İadeler</h2>
    <ul>
      <li>İçinde bulunulan ayın ödemesi alındıktan sonra o ay asla iade edilmez.</li>
      <li>Yıllık bir plan, kullanılmayan ayları için iade edilebilir: ödediğiniz tutardan, o ödemeden bu yana başlayan her ay için (içinde bulunulan ay dâhil) aylık fiyatın düşülmesiyle bulunan tutar; asla sıfırın altında değildir. Örneğin Pro yıllık 80 $ ve aylık 8 $ iken, iptal etmeyi düşündüğünüz ve ilk ayında bize bildirdiğiniz bir yıllık yenileme için 72 $ iade edilir. Yıllık bir planın iadesi onu hemen sona erdirir.</li>
      <li>Aylık bir plan iade edilmez; iptal edilmesi bir sonraki yenilemeyi durdurur.</li>
      <li>İade istemek için hesabınızın e-posta adresinden <?php if ($legal['email'] !== ''): ?><?= $emailLink ?> adresine<?php else: ?><a href="<?= site_url('contact') ?>">iletişim sayfamız</a> üzerinden bize<?php endif ?> yazın. İadeler ödeme yaptığınız karta geri yapılır.</li>
    </ul>
    <p><a href="<?= \App\Libraries\Legal::url('refunds', $lang) ?>">İade Politikası</a> bunu daha fazla örnekle açıklar. Yaşadığınız yerin yasası size bu bölümden daha fazla hak tanıyorsa, o haklara sahipsiniz.</p>

    <h2>6. Fiyat değişiklikleri</h2>
    <p>Pro'nun fiyatını değiştirebiliriz. Bir değişiklik, ödemesini yaptığınız bir dönemi asla etkilemez ve yeni fiyattan ilk yenilemenizden en az 30 gün önce size bildiririz; böylece önceden iptal edebilirsiniz.</p>

    <h2>7. İçeriğiniz</h2>
    <p>Oluşturduğunuz ya da yüklediğiniz şeyler (maceralar, kilometre taşları, görseller, yanıtlar, mesajlar) sizin olarak kalır. Bunları saklamamız, paylaştığınız kişilere göstermemiz ve hizmeti yürütmemiz için gereken izni bize verirsiniz, fazlasını değil. Yüklediklerinizin haklarına sahip olmaktan ve oyuncularınız için yayımladıklarınızdan siz sorumlusunuz.</p>

    <h2>8. BLUERABBIT'i adil kullanmak</h2>
    <p>BLUERABBIT'i yasaları çiğnemek, birini taciz etmek ya da zarar vermek, kötü amaçlı yazılım yüklemek, hizmete saldırmak ya da onu aşırı yüklemek, size ait olmayan verileri okumak ya da planınızın bir sınırını aşmak için kullanmayın. BLUERABBIT'i yazılı onayımız olmadan yeniden satmayın. Bunu yapan bir hesabın içeriğini kaldırabilir ya da hesabı askıya alabiliriz; yasa ya da başkalarının güvenliği engellemedikçe nedenini size söyleriz.</p>

    <h2>9. Yapay zekâ özellikleri</h2>
    <p>Bazı özellikler (Cooper asistanı ve bir macera açtığında yanıtların yapay zekâyla değerlendirilmesi) bir yanıt üretmek için ilgili metni yapay zekâ sağlayıcımız Anthropic'e gönderir. Yapay zekâ çıktıları yanlış olabilir: bunlarla verilen kararlardan oyun yöneticisi sorumlu olmaya devam eder.</p>

    <h2>10. Hizmet</h2>
    <p>BLUERABBIT'i erişilebilir ve verilerinizi güvende tutmak için çalışırız ve hizmeti sürekli geliştiririz; bu bazen bir özelliği değiştirmek ya da kaldırmak anlamına gelir. Ücretli bir planın dayandığı bir şeyi kaldırırsak önce size haber veririz. Makul kontrolümüz dışındaki olayların neden olduğu kayıplardan sorumlu değiliz.</p>

    <h2>11. Sözleşmenin sona ermesi</h2>
    <p>Varsa aboneliğinizi iptal ettikten sonra, BLUERABBIT'i kullanmayı istediğiniz zaman bırakabilir ve hesabınızı uygulamadaki <a href="<?= PLAY_APP_URL ?>/my-account"><em>Hesabım → Verileriniz</em></a> bölümünden silebilirsiniz. Bu şartları ciddi ya da tekrarlayan biçimde ihlal eden bir hesabı kapatabilir ya da askıya alabiliriz. Bir hesap silindiğinde verilerinize ne olacağı <a href="<?= \App\Libraries\Legal::url('privacy', $lang) ?>">Gizlilik Politikası</a> içinde yer alır.</p>

    <h2>12. Sorumluluk</h2>
    <p>BLUERABBIT olduğu gibi sunulur. Yasanın izin verdiği ölçüde dolaylı ya da sonuç olarak doğan kayıplardan sorumlu değiliz ve size karşı toplam sorumluluğumuz, talepten önceki 12 ay içinde bize ödediğiniz tutarla sınırlıdır. Buradaki hiçbir şey, yasanın sınırlanmasına izin vermediği sorumluluğu sınırlamaz.</p>

    <h2>13. Bu şartlardaki değişiklikler</h2>
    <p>Bu şartları önemli bir şekilde değiştirdiğimizde, yeni sürümü burada yeni bir tarihle yayımlar ve yürürlüğe girmeden önce hesap sahiplerine bildiririz. Bundan sonra BLUERABBIT'i kullanmaya devam ederseniz yeni sürüm geçerli olur; kabul etmiyorsanız aboneliğinizi iptal edin ve hesabınızı silin.</p>

    <h2>14. Uygulanacak hukuk ve iletişim</h2>
    <p><?php if ($legal['jurisdiction'] !== ''): ?>Bu şartlar <?= esc($legal['jurisdiction']) ?> yasalarına tabidir.<?php else: ?>Bu şartlar, kurulu olduğumuz yerin yasalarına tabidir.<?php endif ?> Sorular: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">iletişim sayfamız</a><?php endif ?><?php if ($legal['address'] !== ''): ?> ya da posta yoluyla <?= esc($legal['address']) ?><?php endif ?>.</p>
