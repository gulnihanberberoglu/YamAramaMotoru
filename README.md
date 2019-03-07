<p><strong><u>GEZİNGE(TRAJECTORY) VERİSİ İŞLEME</u></strong></p>
<p style="text-align: justify;"><strong><span style="font-size: 12.0pt;">&Ouml;zet:</span></strong></p>
<p style="text-autospace: none;"><em><span style="font-family: 'Calibri Light',sans-serif;">Projede yerli arama motoru yapılması hedeflenmektedir. Proje 5 aşamadan oluşmaktadır. İlk olarak </span></em><em><span style="font-family: 'Calibri Light',sans-serif;">anahtar kelimenin URL i&ccedil;eriğinde ka&ccedil; defa yer aldığının buldurulması işlemi ger&ccedil;ekleştirildi. İkinci adımda verilen bir anahtar kelime k&uuml;mesi ve bir URL k&uuml;mesi i&ccedil;in, anahtar kelimelerin i&ccedil;eriklerde yer alma sayısına dayalı bir skor form&uuml;l&uuml; tanımlanması işlemi ger&ccedil;ekleştirildi. &Uuml;&ccedil;&uuml;nc&uuml; adımda verilen bir web sitesi k&uuml;mesi ve bir anahtar kelime k&uuml;mesi i&ccedil;in, URL'de ve t&uuml;m alt URL'lerinde anahtar kelime yer alma sayılarına dayalı bir skor form&uuml;l&uuml; tanımlandı. D&ouml;rd&uuml;nc&uuml; adımda web sitelerini anahtar kelimelerin yer alma sayılarına g&ouml;re sıraladı. Her URL i&ccedil;in, sırasını, skorunu, alt URL'lerin ağa&ccedil; yapısını ve d&uuml;ğ&uuml;mdeki her bir anahtar kelimenin yer alma sayısı ile birlikte yazdırıldı. Beşinci adımda semantik analizde veriler database e y&uuml;klendi. </span></em></p>
<p style="text-align: justify;"><strong><span style="font-size: 12.0pt;">Genel Yapı:</span></strong></p>
<p style="line-height: 115%;"><em><span style="font-family: 'Calibri Light',sans-serif;">Program localhost uygulaması olarak geliştirilmiştir. Anasayfa anahtar kelime saydırma, sayfa (url) sıralama, site sıralama ve semantic analiz kısımları i&ccedil;eren 4 b&ouml;l&uuml;mden oluşmaktadır.</span></em></p>
<p style="line-height: 115%;"><em><span style="font-family: 'Calibri Light',sans-serif;">Anasayfadan anahtar kelime saydırma kısmına gelince bir url kısmı birde anahtar kelime kısmı bulunmaktadır. Url ve anahtar kelime girilince anahtar kelimenin web sitesinde ka&ccedil; tane olduğu bulunuyor.</span></em></p>
<p style="text-autospace: none;"><em><span style="font-family: 'Calibri Light',sans-serif;">Anasayfadan &nbsp;sayfa (URL) sıralama kısmına gelince </span></em><em><span style="font-family: 'Calibri Light',sans-serif;">bir URL k&uuml;mesi i&ccedil;in, anahtar kelimelerin i&ccedil;eriklerde yer alma sayısına dayalı bir skor form&uuml;l&uuml; tanımlandı. Verilen bir web sitesi k&uuml;mesi ve bir anahtar kelime k&uuml;mesi i&ccedil;in, URL'de ve t&uuml;m alt URL'lerinde anahtar kelime yer alma sayılarına dayalı bir skor form&uuml;l&uuml; tanımladı.</span></em></p>
<p style="line-height: 115%;"><em><span style="font-family: 'Calibri Light',sans-serif;">Anasayfadan &nbsp;site sıralama kısmına gelince console ekranın da seviye g&ouml;sterimi (ana sayfa i&ccedil;in derinlik 1, ana sayfadan linklenmiş bir sayfa i&ccedil;in derinlik 2, ana sayfadan linklenmiş bir sayfadan linklenmiş bir sayfa i&ccedil;in derinlik 3)&nbsp; ve skor g&ouml;sterimine yer verildi.</span></em></p>
<p style="line-height: 115%;"><em><span style="font-family: 'Calibri Light',sans-serif;">Gerekli işlemler ger&ccedil;ekleştikten sonra aşağıdaki link ile &ccedil;evrimi&ccedil;i yayınlanan yam arama motoruna ulaşılabilmesi sağlandı.</span></em></p>
<p><a href="http://yamaramamotoru.cleverapps.io/anahtarKelimeSaydirma.php">http://yamaramamotoru.cleverapps.io/anahtarKelimeSaydirma.php</a></p>
<h1 style="text-align: justify; text-indent: 0cm; line-height: 115%; tab-stops: 35.4pt;"><strong><span style="font-size: 12.0pt;">Sonu&ccedil;:</span></strong></h1>
<p style="line-height: 115%;"><em><span style="font-family: 'Calibri Light',sans-serif;">Yerli Arama Motoru Projesi, ile bir url i&ccedil;inde bir kelimenin ge&ccedil;me sayısının bulundurulması ger&ccedil;ekleştirildi. Yani kısmen ctrl+f&nbsp; mantığı, sonra bir&ccedil;ok url k&uuml;mesi i&ccedil;inde ge&ccedil;en kelimeleri buldurup algoritma oluşturulup skor verildi. B&ouml;ylece hangi urlnin en iyi sonu&ccedil; vereceğinin bulunması hedeflendi.</span></em></p>
<p style="line-height: 115%;"><em><span style="font-family: 'Calibri Light',sans-serif;">Sonra bir url k&uuml;mesinin alt dallarını bulup onun i&ccedil;inde kelimeleri aratıp bir skor form&uuml;l&uuml; geliştirildi. Semantik analizde de veri tabanına kelimeler ile eşanlamlı s&ouml;zc&uuml;kleri y&uuml;klendi.</span></em></p>
<p>&nbsp;</p>
<p style="margin-right: 0cm;"><strong><em><span style="font-size: 11.0pt; font-family: 'Calibri Light',sans-serif;">&nbsp;</span></em></strong></p>
<p style="margin-right: 0cm;"><strong><em><span style="font-size: 11.0pt; font-family: 'Calibri Light',sans-serif;">&nbsp;</span></em></strong></p>
