<?php
    error_reporting(E_ERROR | E_PARSE);
    
    function console_log( $data ){
      echo '<script>';
      echo 'console.log('. json_encode( $data ) .')';
      echo '</script>';
    }
    //turkce karaktere ceviren fonksiyon
    function turkce($key){
        $turkish= array("ı","ğ","ü","ş","ö","ç","İ","Ü","Ö","Ğ","Ç" );
        $ingilizce= array("i","g","u","s","o","c","I","U","O","G","C" );
        $final_title=str_replace($turkish, $ingilizce, $key);
        
        return $final_title;
    }
    //skorları karşılaştıran fonksiyon
    function cmp($a, $b)
    {
        return strcmp($b->skor, $a->skor);
    }


    //url içeriği çekiliyor
    $urlListesi;
    $kelimeListesi;
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['urlListesi'] != null && $_POST['kelimeListesi'] != null)
    {
        //girilen url kümesi ve anahtar kelime kümesi listelere konuyor
        $urlListesi=$_POST['urlListesi'];
        $kelimeListesi=$_POST['kelimeListesi'];

        //virgül karakterine göre küme elemanları ayrılıyor url ve kelime listesi icin
        $urlListesiElemanlari=explode(',', $urlListesi);
        $kelimeListesiElemanlari=explode(',', $kelimeListesi);

        //sonuc dizisi olusturuldu
        $sonuc = array();
        $urlSayac = 0;
        //1.foreach dongusu url listesinde her url geldiginde dönüyor
        foreach ($urlListesiElemanlari as $url) {    
            $sonuc[$urlSayac]->skor = 0;
            //sonuc dizisinde url tutuluyor
            $sonuc[$urlSayac]->url = $url;
            //her bir url icin arama sonuc dizisi olusturuluyor
            $sonuc[$urlSayac]->aramaSonuclari = array();
            $kelimeSayac = 0;
            //urldeki bosluklar siliniyor
            $url = trim($url);
            //2.foreach dongusu kelime listesinde her kelime geldiginde dönüyor
            foreach ($kelimeListesiElemanlari as $kelime) {
                //kelimedeki bosluklar siliniyor
                $kelime = trim($kelime);
                //kelime turkceye cevriliyor
                $kelime = turkce($kelime);  
                //kelime kucuk harfe cevriliyor
                $kelime = strtolower($kelime);

                // o adresteki html icerigini string olarak okuyor
                $veri = file_get_contents($url);
                //url taglarını cıkarma
                $veri = strip_tags($veri);  
                //url icerigini turkceye cevirme 
                $veri = turkce($veri);   
                //url icerigini kucuk harfe cevirme
                $veri = strtolower($veri);   
                //urle iceriginde kac tane anahtar kelime gectigi hesaplanıyor
                $sayac = substr_count($veri, $kelime);
                //her bir url için hesaplanan kelime sayısı sonuc dizisinin skorunda birikiyor
                $sonuc[$urlSayac]->skor +=  $sayac;
                //her bir url gecen kelime isimleri
                $sonuc[$urlSayac]->aramaSonuclari[$kelimeSayac]->kelime = $kelime;
                //her bir url o kelimeden kac tane oldugu bilgisi
                $sonuc[$urlSayac]->aramaSonuclari[$kelimeSayac]->adet = $sayac;
                $kelimeSayac++;
            }

            $urlSayac++;
        }

        //Skor Algoritması
        for ($i=0; $i < count($sonuc) - 1 ; $i++) { 
            for ($j=0; $j < count($sonuc[$i]->aramaSonuclari); $j++) { 
                if($sonuc[$i]->aramaSonuclari[$j]->adet > $sonuc[$i + 1]->aramaSonuclari[$j]->adet){
                    $sonuc[$i]->skor*=2;
                }
                else if($sonuc[$i]->aramaSonuclari[$j]->adet < $sonuc[$i + 1]->aramaSonuclari[$j]->adet){
                    $sonuc[$i+1]->skor*=2;
                }
            }
        }

        usort($sonuc, "cmp");
    }
?>
<!DOCTYPE html>
<html class="mdc-typography">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>YAM</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
</head>

<body>
    <header class="mdc-toolbar" style="height:50px  ">
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
            <a class="mdc-tab mdc-tab--with-icon-and-text mdc-tab--active" href="sayfaUrlSiralama.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Sayfa Url Sıralama</span>
            </a>
            <a class="mdc-tab mdc-tab--with-icon-and-text" href="siteSiralama.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Site Sıralama</span>
            </a>
            <a class="mdc-tab mdc-tab--with-icon-and-text" href="semanticAnaliz.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Semantik Analiz</span>
            </a>
        </nav>
    </div>
       
     <form action="" method="POST" style="margin-top: 20px; margin: 10px;">
        <div style="width: 100%;" class="mdc-text-field mdc-text-field--textarea">
            <textarea id="textarea" name="urlListesi" class="mdc-text-field__input" rows="8" cols="40"><?=$urlListesi?></textarea>
        </div>

        <div style="width: 100%;" class="mdc-text-field mdc-text-field--textarea">
            <textarea id="textarea" name=kelimeListesi class="mdc-text-field__input" rows="4" cols="40"><?=$kelimeListesi?></textarea>
        </div>

        <button class="mdc-button mdc-button--unelevated" type="submit" style="width: 100%; margin-top:20px;">
            Ara
        </button>
    </form>

    <div style="margin: 10px; margin-top:20px;">
        <table style="width:100%">
            <caption>Sonuç</caption>
            <tr>
                <th>Web Sitesi</th>
                <th>Anahtar Kelime</th>
                <th>Skor</th>
            </tr>
            <?php
                for ($i=0; $i < count($sonuc); $i++) { 
                    echo "
                        <tr>
                            <td>" . $sonuc[$i]->url  . "</td>
                            <td>
                                <table>";
                                    for ($j=0; $j < count($sonuc[$i]->aramaSonuclari); $j++) { 
                    echo "
                                            <tr>
                                                <td>" . $sonuc[$i]->aramaSonuclari[$j]->kelime . "</td>
                                                <td>" . $sonuc[$i]->aramaSonuclari[$j]->adet . "</td>
                                            </tr>";
                                    }
                    echo        "</table>
                            </td>
                            <td>" . $sonuc[$i]->skor  . "</td>
                        </tr>";
                    }
            ?>
        </table>
    </div>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
</body>

</html>