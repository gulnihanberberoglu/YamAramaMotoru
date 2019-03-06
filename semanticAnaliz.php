<!-- // <?php
// $dbhost ="Localhost";
// //Burasi Genellikle Localhost olur,ve localhostta çalıştıgımız içinde localhost olacak
// $dbkullanici = "root";
// //kullanici adi Localhostta Çalıştıgımız için burasida root olacak,eger bir host kıralasaydınız,Host şirketini verdigi kullanici adini yazacaktınız
// $dbsifre = "";
// //Localhostta Çalıştıgımız İçin burası boş olacak,Sizin Hostinginizde size verilen şifre neyse siz o şifreyi yazacaksınız
// $dbadi = "AramaMotoru";
// //Az once Phpmyadmin'de "SANALKURS" adında bir veritabani oluşturduk ve  burayada onu yazıyoruz
// $baglanti = mysqli_connect($dbhost,$dbkullanici,$dbsifre);
// if(! $baglanti){
// echo "Mysql baglantisi Saglanamadi";
// }else{
// echo "Veritabanina Baglandim";
// }
// $qury = "SELECT * FROM tablo";
// $query =mysqli_query($baglanti, $query);
// $result = $baglanti->query($query);
// $esanlam = array();
// $sozcuk = array();
// if(mysql_num_rows($result)!=0)
// {
// while ($sidemenu = mysqli_fetch_assoc($result)) {

//     $esanlam[] = $sidemenu->col_1;
//     $sozcuk[] = $sidemenu->col_2;
// }
// }
//Yukarida $baglanti adında bir degişken oluşturduk ve mysql_connect dedik ,Yani Mysql'a bağlan dedik,sonra parantezlerimizi açarak içerisine 3 arguman girdik,"$dbhost,$dbuser,$dbpass" bunlar degişmez 3 lüdür biz her kodlamamzıda veritabaina baglanmak için bu 3 argumanlari yazacağız...:)
//Ve if kontrolu oluşturduk,Dedik ki eger veritabanina baglanamazsa "Mysql Baglantisi Sağlanamadi desin"
//else kontrolu ilede eger veritabanina baglanirsa "Veritabanina Baglandim Desin"

?> -->

<!DOCTYPE html>
<html class="mdc-typography">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>YAM</title>
    <link  type="style/css" rel="stylesheet" href="ana.php"/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
</head>

<body>
    <header class="mdc-toolbar">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <span class="mdc-toolbar__title">YAM: Yerli Arama Motoru</span>
            </section>
        </div>
    </header>

    <div>
        <nav id="icon-text-tab-bar" class="mdc-tab-bar mdc-tab-bar--icons-with-text">
            <a class="mdc-tab mdc-tab--with-icon-and-text" href="anahtarKelimeSaydirma.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Anahtar Kelime Saydırma</span>
            </a>
            <a class="mdc-tab mdc-tab--with-icon-and-text" href="sayfaUrlSiralama.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Sayfa Url Sıralama</span>
            </a>
            <a class="mdc-tab mdc-tab--with-icon-and-text" href="siteSiralama.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Site Sıralama</span>
            </a>
            <a class="mdc-tab mdc-tab--with-icon-and-text mdc-tab--active" href="semanticAnaliz.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Semantik Analiz</span>
            </a>
        </nav>
    </div>

    <form style="margin-top: 20px; margin: 10px;">
        <div style="width: 100%;" class="mdc-text-field mdc-text-field--textarea">
            <textarea id="textarea" class="mdc-text-field__input" rows="8" cols="40"></textarea>
            <label for="textarea" class="mdc-text-field__label">Web Sayfası Kümesi:</label>
        </div>

        <div style="width: 100%;" class="mdc-text-field mdc-text-field--textarea">
            <textarea id="textarea" class="mdc-text-field__input" rows="4" cols="40"></textarea>
            <label for="textarea" class="mdc-text-field__label">Anahtar Kelime Kümesi:</label>
        </div>

        <button class="mdc-button mdc-button--unelevated" type="submit" style="width: 100%; margin-top:20px;">
            Ara
        </button>
    </form>

    <div style="margin: 10px; margin-top:20px;">
        <table style="width:100%">
            <caption>Sonuç</caption>
            <tr>
                <th style="width:100px">Sıra No</th>
                <th>Web Sitesi</th>
                <th>Skor</th>
            </tr>
            <tr>
                <td>1</td>
                <td>https://css-tricks.com/fixing-tables-long-strings/</td>
                <td>90</td>
                <td>
                    <table>
                        <tr>
                            <td>https://css-tricks.com/fixing-tables-long-strings/1</td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Test1</td>
                                        <td>Test2</td>
                                        <td>Test3</td>
                                    </tr>
                                    <tr>
                                        <td>120</td>
                                        <td>23</td>
                                        <td>12</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>https://css-tricks.com/fixing-tables-long-strings/2</td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Test1</td>
                                        <td>Test2</td>
                                        <td>Test3</td>
                                    </tr>
                                    <tr>
                                        <td>120</td>
                                        <td>23</td>
                                        <td>12</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>https://css-tricks.com/fixing-tables-long-strings/3</td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Test1</td>
                                        <td>Test2</td>
                                        <td>Test3</td>
                                    </tr>
                                    <tr>
                                        <td>120</td>
                                        <td>23</td>
                                        <td>12</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
</body>

</html>