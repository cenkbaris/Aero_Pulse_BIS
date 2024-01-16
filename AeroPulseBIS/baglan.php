<?php
$vt_sunucu= "localhost";
$vt_kullanici= "root";
$vt_sifre= "";
$vt_adi= "ucak_website_veritabani";

$baglan= mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);
mysqli_set_charset($baglan, "UTF8");
?>