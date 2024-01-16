<?php
    session_start();
    ob_start();
    require 'navbar.php';
    require 'sidebar.php';
    require 'header_deskpot.php';
    require 'footer.php';
    require_once 'baglan.php';
    
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
    <title>Bilet Güncelle</title>

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        
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
            <br><br><br><br><br>
            <div class="col-lg-6 offset-lg-3">
                <h2 class="title-1">Bilet Düzenle</h2><br>
                                <div class="card">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                        <?php 
                                                $satinAlimID = $_GET["satinAlimID"]; 
                                                
                                                
                                                $yenihizmetid = $_POST['hizmet'];
                                                $yenikoltukNo = $_POST['koltuk'];
                                                $yenifiyatDegeri = $_POST['fiyat'];         
                                                $yeniseferid = $_POST['sefer'];                                          
                                                
                                                
                                                $satinAlimQuery = mysqli_query($baglan,"SELECT * FROM satin_alim WHERE satin_alim_id = $satinAlimID");
                                                $readSatinAlim = mysqli_fetch_array($satinAlimQuery);

                                                if($_POST['updateBilet']){ 
                                                                            
                                                    if(!$yeniseferid || !$yenihizmetid || !$yenikoltukNo || !$yenifiyatDegeri){
                                                        echo "Lütfen boş alan bırakmayınız!<br>";
                                                        
                                                        
                                                        
                                                        echo "$yenihizmetid<br>";
                                                        echo "$yeniseferid<br>";
                                                        echo "$yenikoltukNo<br>";
                                                        echo "$yenifiyatDegeri<br>"; 
                                                    }else{                                                                       
                                                        $updateBiletBilgi = mysqli_query($baglan, "UPDATE satin_alim
                                                        SET hizmet_id='$yenihizmetid',koltuk_no='$yenikoltukNo',fiyat='$yenifiyatDegeri',
                                                        sefer_id='$yeniseferid' 
                                                        WHERE satin_alim_id=$satinAlimID"); 
                                                        
                                                        
                                                        
                                                        if($updateBiletBilgi){
                                                            
                                                            echo '<script>Swal.fire({
                                                                title: "Başarılı!",
                                                                text: "Güncelleme Başarıyla Gerçekleşti.",
                                                                icon: "success"})</script>';
                                                            header("Refresh:1"); 																
                                                            
                                                        }else{
                                                            
                                                            echo '<script>Swal.fire({
                                                                title: "Hata!",
                                                                text: "Güncelleme Yapılırken Bir Hata Oluştu.",
                                                                icon: "error"})</script>';
                                                            
                                                        }
                                                        
                                                    }
                                                    
                                                }else{ 
                                                    
                                                    $hizmetid = $readSatinAlim["hizmet_id"];
                                                    $koltukNo = $readSatinAlim["koltuk_no"];
                                                    $seferid = $readSatinAlim["sefer_id"];
                                                    $fiyatDegeri = $readSatinAlim["fiyat"];
                                                    	
                                                }
                                                
                                                ?>
                                                <?php
							
                                                    $secilikoltuk = mysqli_query($baglan, "SELECT * FROM satin_alim WHERE satin_alim_id = $satinAlimID");
                                                    $readsecilikoltuk = mysqli_fetch_array($secilikoltuk); 
                                                    
                                                ?>
                                    <form method="POST">
                                            <label for="koltuk" class=" form-control-label">Koltuk No</label>
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
                                        <?php
                                            $secilisefer = mysqli_query($baglan, "SELECT satin_alim.sefer_id,havalimani.havalimani_adi AS kalkis_havalimani_adi,havalimani2.havalimani_adi AS varis_havalimani_adi
                                            FROM satin_alim,havalimani,seferler,havalimani AS havalimani2
                                            WHERE havalimani.havalimani_id = seferler.kalkis_yeri_id AND havalimani2.havalimani_id = seferler.varis_yeri_id AND seferler.sefer_id = satin_alim.sefer_id AND satin_alim.satin_alim_id=$satinAlimID
                                            GROUP BY seferler.sefer_id;");
                                            $readsecilisefer = mysqli_fetch_array($secilisefer); 
                                        ?>
                                        <div class="form-group">
                                            <label for="sefer" class=" form-control-label">Sefer Seçimi</label>
                                            <select type="text" name="sefer" class="form-control" value=<?php echo $seferid;?>>
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
                                        <?php
                                            $secilisefer = mysqli_query($baglan, "SELECT satin_alim.hizmet_id,hizmetler.hizmet_adi FROM satin_alim,hizmetler WHERE satin_alim_id = $satinAlimID AND hizmetler.hizmet_id=satin_alim.hizmet_id;");
                                            $readsecilisefer = mysqli_fetch_array($secilisefer); 
                                        ?>
                                        <div class="form-group">
                                            <label for="sefer" class=" form-control-label">Hizmet Seçimi</label>
                                            <select type="text" name="hizmet" class="form-control"value=<?php echo $hizmetid;?>>
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
                                                <div class="form-group">
                                                    <label for="fiyat" class=" form-control-label">Fiyat</label>
                                                    <input type="text" name="fiyat" placeholder="Fiyat Giriniz" class="form-control" value="<?php echo $fiyatDegeri; ?>">
                                                </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 offset-md-4">	
									    <button class="btn btn-danger"><a href="table.php" style="color:white;">Geri</a></button>
									    <input type="submit" name="updateBilet" class="btn btn-success" value="Güncelle">
                                    </form> 
								</div>
                                    </div>
                                </div>
                            </div>
                
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->  
            <!--  FOOTER-->
            <?php footer()?>
            <!-- END FOOTER-->
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
    <script src="vendor/select2/select2.min.js">
    <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    
    </script>

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




