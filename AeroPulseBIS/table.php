<?php
session_start();
ob_start();
    require 'navbar.php';
    require 'sidebar.php';
    require 'header_deskpot.php';
    require 'footer.php';
    require_once 'baglan.php';
    $userID = $_SESSION["kullanici_id"];
    $userType = $_SESSION["kullanici_tip_id"];

    if(!isset($_SESSION["kullanici_id"])) {
        header('Location: login.php');
    }

    if($userType != 1 and $userType != 2){ 
        header('Location: login.php');
    }

    if($userType == 2){ 
        $tableStyle = "display:none;";
        $baslik = "Satın Alınmış Koltuklar Tablosu";	
        
    }else{
        $tableStyle = "text-align:right;"; 
        $button = '<button class="au-btn au-btn-icon au-btn--green au-btn--small">
        <a href="biletekle.php" style="color:White"><i class="zmdi zmdi-plus"></i>Bilet Ekle</a></button>';
        $button2 ='<button class="au-btn au-btn-icon au-btn--green au-btn--small">
        <a href="adminRegister.php" style="color:White"><i class="zmdi zmdi-plus"></i>Admin Ekle</a></button>';
        $baslik = "Satılan Biletler Tablosu";
    }

     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Tablolar</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php navbar() ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php 
        if($userType == 2)
        {
            sidebar2();
        }
        else
        {
            sidebar();
        }
         ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php header_deskpot() ?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="top-campaign">
                                <h3 class="title-1" ><?php echo $baslik; ?></h3><br>
                                    <div class="table-responsive table-data"style ="height:100%;">
                                    <div class="table-data__tool-right">
                                            <?php echo $button;?>
                                        </div><br>
                                        <table class="table table-borderless table-data3" id="dinamik">
                                            <thead>
                                                <tr>
                                                    <th style="<?php echo $tableStyle; ?>">Satılış Tarihi</th>
                                                    <th style="<?php echo $tableStyle; ?>">Satın Alım ID</th>
                                                    <th style="<?php echo $tableStyle; ?>">Ad Soyad</th>
                                                    <th style="<?php echo $tableStyle; ?>">Fiyat</th>
                                                    <th>Koltuk No</th>
                                                    <th>Sefer ID</th>
                                                    <th style="<?php echo $tableStyle; ?>">İşlemler</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                            <?php 
                                                    $satilan_bilet_query = mysqli_query($baglan,"SELECT hizmetler.hizmet_id,satin_alim.satin_alim_id,satin_alim.sefer_id,kullanici.ad,kullanici.soyad,satin_alim.koltuk_no,satin_alim.satilis_tarihi, satin_alim.fiyat 
                                                    FROM seferler,satin_alim,kullanici,hizmetler 
                                                    WHERE kullanici.kullanici_id = satin_alim.kullanici_id AND hizmetler.hizmet_id = satin_alim.hizmet_id
                                                    GROUP BY kullanici.ad
                                                    ORDER BY satin_alim.satilis_tarihi");
                                                    while($readBilet = mysqli_fetch_array($satilan_bilet_query)){
                                
                                                        $satinAlimID = $readBilet['satin_alim_id'];
                                                        $satinAlimTarih = $readBilet['satilis_tarihi'];
                                                        $ad = $readBilet['ad'];
                                                        $soyad = $readBilet['soyad'];
                                                        $fiyat = $readBilet['fiyat'];
                                                        $koltukNo = $readBilet['koltuk_no'];
                                                        $seferID = $readBilet['sefer_id'];
                                                        $hizmetid = $readBilet['hizmet_id'];
                                                    
                                                ?>
                                                <tr>
                                                    <td style="<?php echo $tableStyle; ?>"><?php echo $satinAlimTarih; ?></td>
                                                    <td style="<?php echo $tableStyle; ?>"><?php echo $satinAlimID; ?></td>
                                                    <td style="<?php echo $tableStyle; ?>"><?php echo $ad.' '.$soyad;?></td>
                                                    <td style="<?php echo $tableStyle; ?>"><?php echo $fiyat; ?></td>
                                                    <td><?php echo $koltukNo; ?></td>
                                                    <td><?php echo $seferID ?></td>
                                                    
                                                    
                                                    <td style="<?php echo $tableStyle; ?>">
                                                        <a href='biletguncelle.php?satinAlimID=<?php echo $satinAlimID; ?>&user_id=<?php echo $userID; ?>' style='width:40px; font-size:12px;' class='btn btn-info btn-xs'><i class='fa fa-pencil-square-o'></i></a>
                                                        <a href='biletsil.php?satinAlimID=<?php echo $satinAlimID; ?>&user_id=<?php echo $userID; ?>' style='width:40px; font-size:12px;' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>
                                                    </td>
                                                    <?php }?>
                                                    

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                                    </div>
                            <div class="col-lg-12" style="<?php echo $tableStyle; ?>">
                                <!-- USER DATA-->
                                <div class="top-campaign">
                                    <h3 class="title-1 m-b-30">Kullanıcılar Tablosu</h3>
                                    <div class="table-responsive table-data "style="height:100%;">
                                        <table class="table table-borderless table-data3" id="myTable">
                                        <div class="table-data__tool-right">
                                            <?php echo $button2;?>
                                        </div><br>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Ad Soyad</th>
                                                    <th class="text-center">Yetki</th>
                                                    <th class="text-center">Doğum Tarihi</th>
                                                    <th class="text-center">Engel Durumu</th>
                                                    <th class="text-center">Meslek</th>
                                                    <th class="text-center">Telefon No</th>
                                                    <th class="text-center" style="<?php echo $tableStyle; ?>">İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                    $kullanicilar_query = mysqli_query($baglan,"SELECT * FROM kullanici,meslek WHERE meslek.meslek_id = kullanici.meslek_id");
                                                    while($readKullanici = mysqli_fetch_array($kullanicilar_query)){
                                
                                                        $kullaniciID = $readKullanici['kullanici_id'];
                                                        $kullaniciTC = $readKullanici['tc_no'];
                                                        $kullaniciAd = $readKullanici['ad'];
                                                        $kullaniciSoyad = $readKullanici['soyad'];
                                                        $kullaniciDT= $readKullanici['dogum_tarihi'];
                                                        $kullaniciTelNo = $readKullanici['tel_no'];
                                                        $kullaniciengelDurumu = $readKullanici['engelli'];
                                                        $kullaniciTipID = $readKullanici['kullanici_tip_id'];
                                                        $kullaniciMeslekID = $readKullanici['meslek_adi'];
                                                    
                                                ?>
                                                <tr>
                                                    <td><?php echo $kullaniciAd.' '.$kullaniciSoyad;?><hr>
                                                        <span><?php echo 'T.C. No : '.$kullaniciTC;?></span>
                                                    </td>
                                                    <td><?php if($kullaniciTipID==1){
                                                        echo '<span class="text-center role admin">admin</span>';
                                                    } 
                                                    else
                                                    {
                                                        echo '<span class="role user">Normal Kullanıcı</span>';
                                                    }
                                                    ?></td>
                                                    <td><?php echo $kullaniciDT;?></td>
                                                    <td><?php if($kullaniciengelDurumu=='Evet'){
                                                        echo '<i class="fa fa-wheelchair fa-2x m-l-50"style="color:Blue"></i>';
                                                    } 
                                                    ?></td>
                                                    <td><?php echo $kullaniciMeslekID; ?></td>
                                                    <td><?php echo $kullaniciTelNo;?></td>
                                                    
                                                    
                                                    <td style="<?php echo $tableStyle; ?>">
                                                        <a href='profilduzenle.php?kullaniciID=<?php echo $kullaniciID; ?>&user_id=<?php echo $userID; ?>' style='width:40px; font-size:12px;' class='btn btn-info btn-xs'><i class='fa fa-pencil-square-o'></i></a>
                                                        <a href='profilsil.php?kullaniciID=<?php echo $kullaniciID; ?>&user_id=<?php echo $userID; ?>' style='width:40px; font-size:12px;' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>
                                                    </td>
                                                    <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                                </div>
                                <!-- END USER DATA-->
                            </div>
                            <div class="col-md-12">
                                <!-- TOP CAMPAIGN-->
                                <div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Seferler Tablosu</h3>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-data3">
                                            <tbody>
                                                <tr>
                                                    <th>Sefer No</th>
                                                    <th>Kalkış Yeri</th>
                                                    <th>Varış Yeri</th>
                                                    <th class="text-right">Kalkış Tarih / Saat</th>
                                                </tr>       
                                                <?php 
                                                    $sefer_query = mysqli_query($baglan,"SELECT seferler.sefer_id,havalimani.havalimani_adi,havalimani2.havalimani_adi,seferler.kalkis_tarih_saat FROM seferler,havalimani,havalimani AS havalimani2 WHERE havalimani.havalimani_id = seferler.kalkis_yeri_id AND havalimani2.havalimani_id = seferler.varis_yeri_id");
                                                    while($readsefer = mysqli_fetch_array($sefer_query)){
                                
                                                        $seferID = $readsefer['sefer_id'];
                                                        $kalkis = $readsefer[1];
                                                        $varis = $readsefer[2];
                                                        $sefertarih = $readsefer['kalkis_tarih_saat'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $seferID;?></td>
                                                    <td class="text-left"><?php echo $kalkis;?></td>
                                                    <td class="text-left"><?php echo $varis;?></td>
                                                    <td><?php echo $sefertarih;?></td>
                                                </tr>  
                                                <?php }?>     
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  END TOP CAMPAIGN-->
                            </div>
                            <div class="col-md-12">
                                <!-- TOP CAMPAIGN-->
                                <div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Havalimanı Tablosu</h3>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-data3">
                                            <tbody>
                                                <tr>
                                                    <th class="text-lefr">Havalimanı Adı</th> 
                                                    <th>IATA Kodu</th> 
                                                    <th class="text-center">Bulunduğu Şehir</th> 
                                                    <th class="text-right">Havalimanı ID</th> 
                                                </tr>
                                                <?php 
                                                    $havalimani_query = mysqli_query($baglan,"SELECT * FROM havalimani,sehirler WHERE sehirler.sehir_id = havalimani.sehir_id");
                                                    while($readHavalimani = mysqli_fetch_array($havalimani_query)){
                                
                                                        $havalimaniID = $readHavalimani['havalimani_id'];
                                                        $havalimaniAdi = $readHavalimani['havalimani_adi'];
                                                        $IATA = $readHavalimani['IATA_kodu'];
                                                        $sehirAdi = $readHavalimani['sehir_adi'];
                                                ?>
                                                <tr>
                                                    <td class="text-left"><?php echo $havalimaniAdi;?></td>
                                                    <td><?php echo $IATA;?></td>
                                                    <td class="text-center"><?php echo $sehirAdi;?></td>
                                                    <td class="text-right"><?php echo $havalimaniID;?></td>
                                                </tr>  
                                                <?php }?>     
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  END TOP CAMPAIGN-->
                            </div>
                        </div>
                    </div>
                </div>
                        
                            
                                <!-- END DATA TABLE-->
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  FOOTER-->
        <?php footer()?>
        <!-- END FOOTER-->
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="../build/js/custom.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
	
	<script>

	$(document).ready( function () {
    $('#dinamik').DataTable();
    } );

    </script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>
     <script>
        $(document).ready( function () {
    $('#sefer').DataTable();
    } );
    </script>
    <script>
        $(document).ready( function () {
    $('#havalimani').DataTable();
    } );
    </script>
    
</body>

</html>
<!-- end document-->
