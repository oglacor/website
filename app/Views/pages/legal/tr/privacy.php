<?php
/*
 * Turkish translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /tr/privacy.
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
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?><?php else: ?>BLUERABBIT'in işletmecisi<?php endif ?>, BLUERABBIT'i işletir ve hakkınızda tuttuğu kişisel verilerden sorumludur. Bu politika iki yeri kapsar:</p>
    <ul>
      <li><a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a> adresindeki <strong>BLUERABBIT uygulaması</strong>: maceraların, oyuncu hesaplarının ve aboneliklerin bulunduğu yer (Bölüm 1).</li>
      <li><strong>Bu web sitesi</strong>, bluerabbit.io: tanıtım sayfaları, blog, belgeler, bekleme listesi ve iletişim formu (Bölüm 2).</li>
    </ul>
    <p>Bunlar, hesapları da ayrı olan ayrı sistemlerdir: buradaki bir site hesabı, oradaki bir uygulama hesabı değildir ve hiçbiriyle diğerinde oturum açamazsınız. BLUERABBIT'i bizimle yaptıkları ayrı bir sözleşme kapsamında kendi adreslerinde çalıştıran kuruluşlar o sözleşmeye tabidir.</p>

    <h2>Bölüm 1: BLUERABBIT uygulaması</h2>

    <h3>Neleri saklıyoruz</h3>
    <ul>
      <li><strong>Hesabınız:</strong> e-posta adresi, takma ad, verdiğiniz ad ve yalnızca tek yönlü bir özet (hash) olarak saklanan bir parola. Eklerseniz isteğe bağlı profil bilgileri (fotoğraf, biyografi, şirket, bağlantılar).</li>
      <li><strong>Maceralarda yaptıklarınız:</strong> ilerleme, XP, seviyeler, başarımlar ve eşyalar, yanıtlarınız ve yüklemeleriniz, mesajlar, duvar gönderileri ve yardım istekleri ile geçmişinizi oluşturan etkinlikler.</li>
      <li><strong>Ödemeler:</strong> planınız, abonelik durumunuz ve faturalarınız. Kartınızı Stripe saklar; biz yalnızca Stripe müşteri kaydınıza ait bir referansı tutarız.</li>
      <li><strong>Güvenlik:</strong> bir oturum açma kaydı (her oturum açma, başarısız deneme, kilitleme ve parola sıfırlama, geldiği internet adresi ve tarayıcıyla birlikte) ve e-posta adresinizin doğrulanması.</li>
      <li><strong>Çerezler:</strong> yalnızca hizmetin ihtiyaç duydukları: oturumunuzu açık tutan bir oturum çerezi ve formlarınızı sahteciliğe karşı koruyan bir çerez. Otomatik kayıtları engelleyen Cloudflare ve onun Turnstile doğrulaması kendi güvenlik çerezlerini yerleştirebilir. Reklam çerezi kullanmayız.</li>
    </ul>

    <h3>Neden saklıyoruz</h3>
    <ul>
      <li>Kaydolduğunuz hizmeti sunmak için: hesabınız, maceralarınız, planınız (sizinle olan sözleşmemiz).</li>
      <li>Hesapları ve hizmeti güvende tutmak için: oturum açma kaydı, kilitlemeler, kötüye kullanım kontrolleri (güvenlik konusundaki meşru menfaatimiz).</li>
      <li>Yasal yükümlülükleri yerine getirmek için; örneğin faturaları vergi mevzuatının istediği süre boyunca saklamak.</li>
      <li>Hesabınızla ilgili size e-posta göndermek için: doğrulamalar, parola sıfırlamaları, deneme ve ödeme bildirimleri. Macera e-postaları içlerindeki bağlantıdan kapatılabilir.</li>
    </ul>
    <p>Verilerinizi satmayız ve reklam için kullanmayız.</p>

    <h3>Kimler görür</h3>
    <ul>
      <li><strong>Bir macerada</strong>, onu yürüten oyun yöneticileri ve ekip ilerlemenizi ve teslim ettiğiniz çalışmaları görür. Diğer oyuncular adınızı, seviyenizi, XP'nizi ve başarımlarınızı lider tablolarında ve lonca listelerinde görür; e-posta adresinizi asla görmez.</li>
      <li><strong>Bizim için çalışan şirketler</strong>, her biri yalnızca kendi kısmı için: Stripe (ödemeler), Resend (e-posta gönderimi), Cloudflare (sitenin sunulması ve saldırıların engellenmesi), Anthropic (bir macera açtığında yapay zekâ özellikleri) ve barındırma sağlayıcımız. Verilerinizi bizim talimatlarımızla işlerler.</li>
      <li><strong>Resmî makamlar</strong>, yalnızca yasa gerektirdiğinde.</li>
    </ul>

    <h3>Ne kadar süre saklıyoruz</h3>
    <ul>
      <li>Hesabınız ve oluşturduklarınız: hesabınızı silene kadar.</li>
      <li>Oturum açma kaydı: 12 ay; sonra otomatik olarak silinir.</li>
      <li>Faturalar ve ödeme kayıtları: vergi ve muhasebe mevzuatının gerektirdiği süre boyunca.</li>
      <li>Hesabınızı sildikten sonra puanlarınız, diğer oyuncuların sonuçları doğru kalsın diye bir maceranın istatistiklerinde ve lider tablolarında anonim bir adla kalabilir. Bunlarda sizi tanımlayan hiçbir şey yoktur.</li>
    </ul>

    <h3>Uygulamadaki haklarınız</h3>
    <ul>
      <li><strong>Verilerinizi görmek ve almak:</strong> <a href="<?= PLAY_APP_URL ?>/my-account"><em>Hesabım → Verileriniz → İndir</em></a>, hakkınızda tuttuğumuz her şeyi tek bir dosya olarak verir.</li>
      <li><strong>Hesabınızı silmek:</strong> <em>Hesabım → Verileriniz → Hesabımı sil</em> kimliğinizi her yerden kaldırır, konuşmalarınızı ve yüklemelerinizi siler ve tüm oturumları sonlandırır. Önce devam eden aboneliğinizi iptal edin.</li>
      <li><strong>Düzeltmek:</strong> profilinizi istediğiniz zaman düzenleyin.</li>
      <li><strong>İtiraz etmek, kısıtlama istemek ya da soru sormak:</strong> <?php if ($legal['email'] !== ''): ?><?= $emailLink ?> adresine<?php else: ?><a href="<?= site_url('contact') ?>">iletişim sayfamız</a> üzerinden bize<?php endif ?> yazın.</li>
    </ul>

    <h2>Bölüm 2: Bu web sitesi</h2>

    <h3>Neler topluyoruz</h3>
    <p>Yalnızca kullandığınız sayfanın gerçekten ihtiyaç duyduklarını. Tam liste şöyle:</p>
    <ul>
      <li><strong>Bekleme listesi kayıtları:</strong> e-posta adresiniz ve hangi sayfadan kaydolduğunuz. Başka hiçbir şey.</li>
      <li><strong>İletişim formu:</strong> adınız, e-posta adresiniz, konu ve yazdığınız mesaj.</li>
      <li><strong>Site hesapları:</strong> bu sitede bir hesap açarsanız adınız, e-posta adresiniz ve parolanızın güvenli biçimde özetlenmiş (hash) bir hâli. Parolanızın kendisini asla saklamayız ve okuyamayız.</li>
      <li><strong>Oturum çerezi:</strong> siteyi kullanırken oturumunuzu açık tutan tek bir çerez.</li>
      <li><strong>Sunucu kayıtları:</strong> standart web isteği kayıtları (IP adresi, tarayıcının kullanıcı aracısı, istenen sayfa, zaman damgası); güvenlik ve hata ayıklama için tutulur.</li>
    </ul>

    <h3>Neler yapmıyoruz</h3>
    <p>Açıkça söylemeye değer, çünkü kontrol etmeye değecek kadar alışılmadık bir durum:</p>
    <ul>
      <li>Analiz ya da izleme betiği yok. Google Analytics yok, etiket yöneticisi yok, oturum kaydı yok, ısı haritası yok.</li>
      <li>Reklam çerezi yok, yeniden hedefleme pikseli yok, hiçbir türde üçüncü taraf izleyici yok.</li>
      <li>Kişisel bilgilerinizin satışı, kiralanması ya da takası yok. Hiç kimseye, hiçbir fiyata.</li>
      <li>Hakkınızda profil oluşturma ya da otomatik karar verme yok.</li>
    </ul>

    <h3>Çerezler</h3>
    <ul>
      <li><strong>Zorunlu (her zaman açık).</strong> Oturumunuzu açık tutan bir oturum çerezi, formlarımızın başka siteler tarafından sizin adınıza gönderilmesini engelleyen bir güvenlik belirteci, aşağıdaki seçiminizi kaydeden bir çerez ve gerçek ziyaretçileri botlardan ayırmak için Cloudflare'in yerleştirdiği bir çerez. Bunlar sitenin çalışması için kesinlikle gereklidir; bu yüzden onay gerektirmezler ve kapatılamazlar. Ancak reklam verisi taşımazlar ve profilinizi çıkarmak için kullanılmazlar.</li>
      <li><strong>Analiz (sizin seçiminiz).</strong> Hangi sayfaların okunduğuna dair anonim istatistikler. <strong>Şu anda hiçbir türde analiz çalıştırmıyoruz.</strong> İleride eklersek yalnızca açıkça onay veren kişiler için yüklenir; seçiminiz önceden kaydedilir ve otomatik olarak uygulanır.</li>
    </ul>
    <p><strong>Fikrinizi değiştirirseniz.</strong> Seçiminizi istediğiniz zaman gözden geçirmek ya da değiştirmek için herhangi bir sayfanın alt bilgisindeki <em>Çerez Ayarları</em> bağlantısını kullanın. Onayı geri çekmek, onay vermek kadar kolaydır ve hemen geçerli olur. Ayrıca eski bir yanıtı kalıcı saymak yerine on iki ay sonra yeniden sorarız. Analizi reddetmenin size hiçbir bedeli yoktur; sitenin her bölümü iki durumda da aynı şekilde çalışır.</p>

    <h3>Neden kullanıyoruz</h3>
    <ul>
      <li><strong>Size yanıt vermek için:</strong> iletişim formu gönderimleri, sorunuzu bir insanın yanıtlayabilmesi için vardır.</li>
      <li><strong>Size BLUERABBIT hakkında bilgi vermek için:</strong> bekleme listesine katıldıysanız size kullanıma sunulma ve lansman haberleri hakkında e-posta göndeririz. Listenin var olma nedeni yalnızca budur.</li>
      <li><strong>Hesabınızı yürütmek için:</strong> kimliğinizi doğrulamak ve oturumunuzu açık tutmak.</li>
      <li><strong>Siteyi çalışır ve güvenli tutmak için:</strong> kayıtlar, kötüye kullanımın önlenmesi ve hata ayıklama.</li>
    </ul>
    <p>Yasanın bir hukuki dayanak gerektirdiği durumlarda (örneğin Birleşik Krallık ya da AB GDPR'si), bekleme listesi e-postaları için onayınıza; diğer her şey için ise sorulara yanıt verme, siteyi işletme ve güvenli tutma konusundaki meşru menfaatimize dayanırız.</p>

    <h3>Verilerinize başka kimler dokunur</h3>
    <ul>
      <li><strong>Resend:</strong> işlem e-postalarımızı ve bekleme listesi e-postalarımızı iletir. E-posta adresinizi ve mesaj içeriğini alır.</li>
      <li><strong>Cloudflare:</strong> güvenlik, DDoS koruması ve performans için sitenin önünde durur. IP adresiniz dâhil istek meta verilerini işler.</li>
      <li><strong>Barındırma sağlayıcımız:</strong> siteyi ve veritabanını saklar.</li>
      <li><strong>jsDelivr:</strong> zengin metin düzenleyici kitaplığını sunar, ancak yalnızca oturum açmış yöneticilerin sayfalarında. Sıradan ziyaretçiler onu hiç yüklemez.</li>
    </ul>

    <h3>Ne kadar süre saklıyoruz</h3>
    <ul>
      <li><strong>Bekleme listesi e-posta adresleri:</strong> listeden çıkana ya da sizi listeden çıkarmamızı isteyene kadar.</li>
      <li><strong>İletişim mesajları:</strong> talep çözülene ve kayıtlarımız için artık gerekmeyene kadar.</li>
      <li><strong>Site hesapları:</strong> hesap var olduğu sürece. Hesabı silerseniz kayıt da onunla birlikte silinir.</li>
      <li><strong>Sunucu kayıtları:</strong> kısa ve sürekli yenilenen bir süre boyunca tutulur, sonra silinir.</li>
    </ul>

    <h3>Bu web sitesindeki seçenekleriniz</h3>
    <p>Bekleme listesi e-postalarından çıkmak için size gönderdiğimiz herhangi bir e-postanın altındaki abonelikten çıkma bağlantısını kullanın; hemen işe yarar ve bizden yanıt gerektirmez. Burada tuttuğumuz başka herhangi bir şeyi görmek, düzeltmek, silmek ya da bir kopyasını almak için <?php if ($legal['email'] !== ''): ?><?= $emailLink ?> adresine<?php else: ?><a href="<?= site_url('contact') ?>">iletişim sayfamız</a> üzerinden bize<?php endif ?> yazın. Bunların hiçbiri için ücret almayız ve talebinizi gerekçelendirmenizi istemeyiz.</p>

    <h2>Her ikisi için</h2>

    <h3>Haklarınız</h3>
    <p>Hakkınızda tuttuklarımızı size göstermemizi, düzeltmemizi, silmemizi ya da taşınabilir bir biçimde bir kopyasını size göndermemizi isteyebilirsiniz. Ayrıca bunları nasıl kullandığımıza itiraz edebilir ya da verdiğiniz onayı geri çekebilirsiniz. Birleşik Krallık'ta ya da AB'de bulunuyorsanız ve bir şeyi yanlış yaptığımızı düşünüyorsanız, ulusal veri koruma otoritenize şikâyette bulunma hakkına sahipsiniz.</p>

    <h3>Güvenlik</h3>
    <p>Her iki site de HTTPS üzerinden sunulur. Parolalar tek yönlü bir özet (hash) olarak saklanır, asla okunabilir biçimde saklanmaz. Uygulama, tekrarlanan başarısız oturum açma denemelerinden sonra hesabı kilitler ve oturum açmaların kaydını tutar; her iki sitenin yönetim alanları kimlik doğrulama gerektirir. Bilgilerinizi korumak için makul önlemler alırız, ancak hiçbir site kusursuz güvenlik vaat edemez.</p>

    <h3>Çocuklar</h3>
    <p>BLUERABBIT, yaşadıkları yerdeki dijital rıza yaşının altındaki çocuklar için tasarlanmamıştır; ancak yasanın gerektirdiği rızaya sahip bir okul, eğitmen ya da kuruluş onları kaydederse kullanabilirler. Bu web sitesi kuruluşlara ve profesyonellere yöneliktir; bir çocuğun burada bilgi gönderdiğini düşünüyorsanız bizimle iletişime geçin, bu bilgileri sileriz.</p>

    <h3>Uluslararası aktarımlar</h3>
    <p>Bizim için çalışan şirketlerin bazıları, Amerika Birleşik Devletleri de dâhil olmak üzere ülkeniz dışındadır. Yasanın gerektirdiği durumlarda bu aktarımlar standart sözleşme hükümleriyle güvence altına alınır.</p>

    <h3>Bu politikadaki değişiklikler</h3>
    <p>Bu politika önemli bir şekilde değiştiğinde, yeni sürümü burada yeni bir tarihle yayımlar ve hesap sahiplerine bildiririz.</p>

    <h3>İletişim</h3>
    <p>Bu politika ya da tuttuğumuz veriler hakkındaki sorular: <?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">iletişim sayfamız</a><?php endif ?><?php if ($legal['address'] !== ''): ?> ya da posta yoluyla <?= esc($legal['address']) ?><?php endif ?>.</p>
