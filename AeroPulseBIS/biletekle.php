<?php
session_start();
ob_start();
    require 'baglan.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'header_deskpot.php';
    require 'footer.php';
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
    <title>Bilet Ekle</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
    <?php navbar(); ?>
         <?php sidebar(); ?>
        <div class="page-content--bge2">
            <div class="container">
            <?php header_deskpot(); ?>
                <div class="login-wrap">
                    <div class="login-content">
                        <h2 class="title-1">Bilet Ekle</h2>
                        <div class="login-logo">
                        </div>
                        <?php
                                        $ekleSeferID = $_POST['sefer'];
                                        $ekleFiyat = $_POST['fiyat'];
                                        $ekleKoltuk = $_POST['koltuk'];
                                        $ekleHizmet = $_POST['hizmet'];
                                        $ekleTC = $_POST['TC'];
                                        $ekleTarih = date("Y-m-d H:i:s");
                                        
                                        if($_POST)
                                        {
                                            if(!$ekleSeferID || !$ekleFiyat || !$ekleKoltuk || !$ekleHizmet|| !$ekleTC ||!$ekleTarih){
                                                echo '<script>Swal.fire({
                                                    title: "Hata!",
                                                    text: "Lütfen bütün satırları doldurun.",
                                                    icon: "error"})</script>';
                                            }
                                            else
                                            {               
                                                            $sql1 = mysqli_query($baglan,"SELECT kullanici_id FROM kullanici WHERE kullanici.tc_no = $ekleTC");
                                                            if($sql1)
                                                            {
                                                                $sqlOku = mysqli_fetch_array($sql1);
                                                                $kullanici_id = $sqlOku['kullanici_id'];
                                                                $sql = mysqli_query($baglan,"INSERT INTO satin_alim(sefer_id,koltuk_no,fiyat,satilis_tarihi,hizmet_id,kullanici_id) values('$ekleSeferID','$ekleKoltuk','$ekleFiyat','$ekleTarih','$ekleHizmet','$kullanici_id')"); 
                                                                if ($sql) {
                                                                    echo '<script>Swal.fire({
                                                                        title: "Başarılı!",
                                                                        text: "Bilet başarıyla eklendi.",
                                                                        icon: "success"})</script>';
                                                                } 
                                                                else
                                                                {
                                                                    echo '<script>Swal.fire({
                                                                        title: "Hata!",
                                                                        text: "Bilet eklenirken bir hata oluştu.",
                                                                        icon: "error"})</script>';
                                                                }
                                                            } 
                                                            else
                                                            {
                                                                echo '<script>Swal.fire({
                                                                    title: "Hata!",
                                                                    text: "TC kaydı bulunamadı.",
                                                                    icon: "error"})</script>';
                                                            }
                                            }
                                        }
                                   ?>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Sefer Seçiniz</label>
                                    <select type="text" name="sefer" class="form-control">
                                            <option value="<?php echo $readsecilisefer['sefer_id']; ?>" selected><?php echo $readsecilisefer['kalkis_havalimani_adi'].' - '.$readsecilisefer['varis_havalimani_adi'] ?></option>
                                            <?php
                                                $SeferKalkis = 'kalkis_havalimani_adi';
                                                $SeferVaris = 'varis_havalimani_adi';
                                                $SeferNo = 'sefer_id';
                                                $seferQuery = mysqli_query($baglan, "SELECT satin_alim.sefer_id,havalimani.havalimani_adi AS kalkis_havalimani_adi,havalimani2.havalimani_adi AS varis_havalimani_adi
                                                FROM satin_alim,havalimani,seferler,havalimani AS havalimani2
                                                WHERE havalimani.havalimani_id = seferler.kalkis_yeri_id AND havalimani2.havalimani_id = seferler.varis_yeri_id AND seferler.sefer_id = satin_alim.sefer_id
                                                GROUP BY seferler.sefer_id");
                                                if(mysqli_num_rows($seferQuery)!=0)	{

                                                    while($readSeferr = mysqli_fetch_array($seferQuery))	{
                                                        echo "<option value='$readSeferr[$SeferNo]'>$readSeferr[$SeferKalkis] - $readSeferr[$SeferVaris]</option>";
                                                    }
                                                }

										    ?>
                                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Fiyat Giriniz</label>
                                    <input class="au-input au-input--full" type="text" name="fiyat" placeholder="Fiyat"required>
                                </div>
                                <div class="form-group">
                                    <label>Koltuk Seçiniz</label>
                                    <select name="koltuk" class="form-control" value="<?php echo $koltukNo;?>"id="koltuk">
                                            <option value="<?php echo $readsecilikoltuk['koltuk_no']; ?>" selected><?php echo $readsecilikoltuk['koltuk_no']; ?></option>
                                            <?php
                                                $KoltukNo='koltuk_no';
                                                $koltukQuery = mysqli_query($baglan, "SELECT * FROM koltuklar");
                                                if(mysqli_num_rows($koltukQuery)!=0)	{

                                                    while($readKoltuk = mysqli_fetch_array($koltukQuery))	{
                                                        echo "<option value='$readKoltuk[$KoltukNo]'>$readKoltuk[$KoltukNo]</option>";
                                                    }
                                                }

										    ?>
                                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Hizmet Seçiniz</label>
                                    <select type="text" name="hizmet" class="form-control">
                                            <option value="<?php echo $readsecilisefer['hizmet_id']; ?>" selected><?php echo $readsecilisefer['hizmet_adi']; ?></option>
                                            <?php
                                                $HizmetAdi = 'hizmet_adi';
                                                $HizmetNo = 'hizmet_id';
                                                $hizmetQuery = mysqli_query($baglan, "SELECT hizmetler.hizmet_id,hizmetler.hizmet_adi FROM hizmetler");
                                                if(mysqli_num_rows($hizmetQuery)!=0)	{

                                                    while($readHizmet = mysqli_fetch_array($hizmetQuery))	{
                                                        echo "<option value='$readHizmet[$HizmetNo]'>$readHizmet[$HizmetAdi]</option>";
                                                    }
                                                }

										    ?>
                                            </select>
                                </div>
                                <div class="form-group">
                                    <label>TC No</label>
                                    <input class="au-input au-input--full" type="text" name="TC" placeholder="TC No"required>
                                </div>
                                <br><br>
                                <button class="au-btn au-btn-block au-btn--green m-b-20 m-l-130" name="submit" type="submit">Ekle</button>
                                <a href="table.php"><input class="au-btn au-btn-block au-btn--blue m-b-20" name="geri" type="button" value="Geri"></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    <script src="vendor/select2/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script>
		$(document).ready(function() {
		$('#koltuk').select2();
		});
	</script>                                            
</body>

</html>
<!-- end document-->
