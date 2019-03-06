<?php
    ini_set('max_execution_time', 600);
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

    //url de o kelimeden kac tane oldugunu bulan fonksiyon
    function kelimeSay($veri, $kelime)
    {
        //url taglarını cıkarma
        $veri = strip_tags($veri);  
        $veri = turkce($veri);   
        $veri = strtolower($veri);   
        $sayac = substr_count($veri, $kelime);

        return $sayac;
    }
    //urldeki html dokumanındaki linkleri buluyor
    function altLinkleriBul($veri)
    {

        $altLinkler = array();
        $dom = new DOMDocument();
        $dom->loadHTML($veri);

        foreach ($dom->getElementsByTagName('a') as $node) {
            if(filter_var($node->getAttribute('href'), FILTER_VALIDATE_URL) == true) {
                array_push($altLinkler, $node->getAttribute('href')); 
            }
        }
        return $altLinkler;
    }

    //html dokumanında kac tane kelime geçtigi bilgisini bulup objede biriktiren fonksiyon
    function hesapla($veri, $kelimeListesiElemanlari){
        $kelimeSayac = 0;
        $sonuc->skor = 0;
        foreach ($kelimeListesiElemanlari as $kelime) {
            $sayac = kelimeSay($veri, $kelime);
            $sonuc->aramaSonuclari[$kelimeSayac]->kelime = $kelime;
            $sonuc->aramaSonuclari[$kelimeSayac]->adet = $sayac;
            $sonuc->skor += $sayac;;
            $kelimeSayac++;
        }

        return $sonuc;
    }

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

        $sonuc = array();

        $urlSayac = 0;
        //1.foreach ilk sayfadaki gonderilen url sayfalarını indirip kelime arıyor
        foreach ($urlListesiElemanlari as $url) {
            $veri1 = file_get_contents($url);   
            
            $birinciSeviyeSonuc = hesapla($veri1, $kelimeListesiElemanlari);
            $sonuc[$urlSayac]->birinciSeviyeSonuc = $birinciSeviyeSonuc;
            $sonuc[$urlSayac]->birinciSeviyeSonuc->link = $url;
            //Derinliği 1 skoru 3 ilk sayfa olduğundan
            $sonuc[$urlSayac]->skor = ($birinciSeviyeSonuc->skor * 3);

            $urlSayac2 = 0;
            $sonuc[$urlSayac]->ikinciSeviyeSonuc = array();
            //2.foreach ikinci sayfadaki(birin icindeki alt sayfalar) gonderilen url sayfalarını indirip kelime arıyor
            foreach (altLinkleriBul($veri1) as $altUrl) {
                $veri2 = file_get_contents($altUrl);   

                $ikinciSeviyeSonuc = hesapla($veri2, $kelimeListesiElemanlari);

                $sonuc[$urlSayac]->ikinciSeviyeSonuc[$urlSayac2] = $ikinciSeviyeSonuc;
                $sonuc[$urlSayac]->ikinciSeviyeSonuc[$urlSayac2]->link = $altUrl;
                //Derinliği 2 skoru 2 ilk sayfa olduğundan
                $sonuc[$urlSayac]->skor += ($ikinciSeviyeSonuc->skor * 2);

                $urlSayac3 = 0;
                $sonuc[$urlSayac]->ucuncuSeviyeSonuc = array();
                //3.foreach ucuncu sayfadaki gonderilen url sayfalarını indirip kelime arıyor
                foreach (altLinkleriBul($veri2) as $sonUrl) {
                    $veri3 = file_get_contents($sonUrl);   

                    $ucuncuSeviyeSonuc = hesapla($veri3, $kelimeListesiElemanlari);

                    $sonuc[$urlSayac]->ucuncuSeviyeSonuc[$urlSayac3] = $ucuncuSeviyeSonuc;
                    $sonuc[$urlSayac]->ucuncuSeviyeSonuc[$urlSayac3]->link = $sonUrl;
                    //Derinliği 3 skoru 1 ilk sayfa olduğundan
                    $sonuc[$urlSayac]->skor += ($ucuncuSeviyeSonuc->skor * 1);
                    $urlSayac3++;
                }
                $urlSayac2++;
            }
            $urlSayac++;
        }

        console_log($sonuc);
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
    <header class="mdc-toolbar" style="height:50px">
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
            <a class="mdc-tab mdc-tab--with-icon-and-text mdc-tab--active" href="siteSiralama.php">
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
            <textarea id="textarea" name="kelimeListesi" class="mdc-text-field__input" rows="4" cols="40"><?=$kelimeListesi?></textarea>
        </div>

        <button class="mdc-button mdc-button--unelevated" type="submit" style="width: 100%; margin-top:20px;">
            Ara
        </button>
    </form>

    <div style="margin: 10px; margin-top:20px;">
        <caption>Sonuç</caption>
        <br/>
        <textarea id="textarea" name="kelimeListesi" class="mdc-text-field__input" rows="50" cols="40">
            <?php
                //sonucta biriken veriler yazılıyor ekrana
                echo json_encode($sonuc, JSON_PRETTY_PRINT);
            ?>
        </textarea>
    </div>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
</body>

</html>