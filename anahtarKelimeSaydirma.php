<?php
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

    //url içeriği çekiliyor
    $sayac= 0 ;
    $url="";
    $key="";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['kontrol'] != null && $_POST['kontrol2'] != null)
    {
        $url=$_POST['kontrol'];
        $key=$_POST['kontrol2'];
        //anahtar kelimeyi turkceye cevirme
        $key = turkce($key);  
        //anahtar kelimeyi kucuk harfe cevirme
        $key = strtolower($key);
        // o adresteki html icerigini string olarak okuyor
        $veri = file_get_contents($url);
        //url taglarını cıkarma
        $veri = strip_tags($veri); 
        //url icerigini turkceye cevirme 
        $veri = turkce($veri);   
        //url icerigini kucuk harfe cevirme
        $veri = strtolower($veri);   
        //urle iceriginde kac tane anahtar kelime gectigi hesaplanıyor
        $sayac = substr_count($veri, $key);
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
            <a class="mdc-tab mdc-tab--with-icon-and-text mdc-tab--active" href="anahtarKelimeSaydirma.php">
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
            <a class="mdc-tab mdc-tab--with-icon-and-text" href="semanticAnaliz.php">
                <i class="material-icons mdc-tab__icon" aria-hidden="true">favorite</i>
                <span class="mdc-tab__icon-text">Semantik Analiz</span>
            </a>
        </nav>
    </div>

    <form action="" method="POST" style="margin-top: 20px; margin: 10px;">
        <div style="width: 100%" class="mdc-text-field mdc-text-field--upgraded">
            <input type="text" id="pre-filled" name="kontrol" class="mdc-text-field__input" value=<?=$url?>>
            <label class="mdc-text-field__label mdc-text-field__label--float-above" for="pre-filled">
                Web Sayfası:
            </label>
            <div class="mdc-text-field__bottom-line"></div>
        </div>

        <div style="width: 100%" class="mdc-text-field mdc-text-field--upgraded">
            <input type="text" id="pre-filled" name="kontrol2" class="mdc-text-field__input" value=<?=$key?>>
            <label class="mdc-text-field__label mdc-text-field__label--float-above" for="pre-filled">
                Anahtar Kelime:
            </label>
            <div class="mdc-text-field__bottom-line"></div>
        </div>

        <button class="mdc-button mdc-button--unelevated" type="submit" style="width: 100%; margin-top:20px;">
            Ara
        </button>
    </form>

    <div style="margin: 10px; float:right">
        Sonuc: Anahtar kelime url içerisinde <?=$sayac?> kez geçiyor.
    </div>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
</body>

</html>

