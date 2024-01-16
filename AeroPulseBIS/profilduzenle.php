<?php
session_start();
ob_start();
    require 'navbar.php';
    require 'sidebar.php';
    require 'header_deskpot.php';
    require 'footer.php';
    require 'baglan.php';
    $userID = $_SESSION["kullanici_id"];
    $userType = $_SESSION["kullanici_tip_id"];
    
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
    <title>Profil</title>

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
            <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                                                
                <?php                           
                                                $userID=$_GET['kullaniciID'];
                                                $yeniad= $_POST['ad'];
                                                $yenisoyad = $_POST['soyad'];
                                                $yenidogum = $_POST['dogum_tarihi'];         
                                                $yenitelno = $_POST['tel_no'];                                          
                                                $yenimeslek = $_POST['meslek'];                                          
                                                $yeniengel = $_POST['engel'];                                          
                                                
                                                
                                                
                                                if($_POST['updateProfil']){ 
                                                                            
                                                    if(!$yeniad|| !$yenisoyad || !$yenidogum || !$yenitelno || !$yenimeslek ||!$yeniengel){
                                                      echo '<script>Swal.fire({
                                                        title: "Hata!",
                                                        text: "Boş Değer Bırakmayınız.",
                                                        icon: "error"})</script>';
                                                    }else{                                                                       
                                                        $updateProfil = mysqli_query($baglan,"UPDATE kullanici set ad='$yeniad',soyad='$yenisoyad',dogum_tarihi='$yenidogum',
                                                        tel_no='$yenitelno',meslek_id='$yenimeslek',engelli='$yeniengel' WHERE kullanici.kullanici_id = $userID") ;
                                                        
                                                        
                                                        if($updateProfil){
                                                            
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
                                                    
                                                }
                                                else if($_POST['geri'])
                                                {
                                                  header('Location:table.php');
                                                }
                                                
                                                
                                                ?>
              <form method="POST">
                    <h4 class="text-right">Profil Bilgileri</h4>
                </div>
                <div class="row mt-2">
                  <?php
                  $sql =mysqli_query($baglan,"SELECT * FROM kullanici,meslek where kullanici_id = $userID AND meslek.meslek_id = kullanici.meslek_id");
                  if(mysqli_num_rows($sql)!=0)	{

                    while($readSQL = mysqli_fetch_array($sql))	{
                        $ad = $readSQL['ad'];
                        $soyad = $readSQL['soyad'];
                        $tel = $readSQL['tel_no'];
                        $engel = $readSQL['engelli'];
                        $mesleK = $readSQL['meslek_adi'];
                        $dogum = $readSQL['dogum_tarihi'];
                    }
                }                  
                  ?>
                 
                    <div class="col-md-4"><label class="labels">Ad</label>
                      <input type="text" class="form-control" name="ad" placeholder="Ad" value="<?php echo $ad;?>">
                    </div>
                    <div class="col-md-4"><label class="labels">Soyad</label>
                      <input type="text" class="form-control" name="soyad"value="<?php echo $soyad;?>" placeholder="Soyad">
                    </div>
                    <div class="col-md-4"><label class="labels">Doğum tarihi</label><input type="date" class="form-control"name ="dogum_tarihi"placeholder="country" value="<?php echo $dogum;?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4"><label class="labels">Telefon Numarası</label>
                      <input type="text" class="form-control" name ="tel_no"placeholder="Telefon Numarası" value="<?php echo $tel;?>">
                    </div>
                    <div class="col-md-4"><label class="labels">Engelli</label>
                      <select type="text" class="form-control" name="engel">
                      <?php if($engel=="Evet")
                      {
                        echo '<option value="Hayır">Engelli Değil</option>';
                        echo '<option value="'.$cinsiyet.'"selected >Engelli</option>';
                      }
                      else if($engel =="Hayır")
                      {
                        echo '<option value="Evet">Engelli</option>';
                        echo '<option value="'.$cinsiyet.'"selected >Engelli Değil</option>';
                      }
                      ?>
                    </select>
                    </div>
                    <div class="col-md-4"><label class="labels">Meslek</label>
                    
                    <?PHP echo '<select class="form-control" name = "meslek" value"">';
                                    $meslek = "SELECT meslek.meslek_id,meslek.meslek_adi FROM meslek";
                                    $meslek_getir = $baglan->query($meslek);
                                    if($meslek_getir->num_rows > 0)
                                    {
                                        while($row = $meslek_getir->fetch_assoc())
                                        {
                                          $selected = ($row["meslek_adi"] == $mesleK) ? 'selected' : '';
                                          echo '<option value="' . $row["meslek_id"] . '" ' . $selected . '>' . $row["meslek_adi"] . '</option>';
                                        }
                                    } 
                                    echo '</select>';
                                ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 offset-md-5 mt-5">	
									    <button class="btn btn-danger "><a href="table.php" style="color:white;">Geri</a></button>
									    <input type="submit" name="updateProfil" class="btn btn-success" value="Güncelle"></div>
                </div>
                </div>
              </form>
            </div>
                
        </div>
        </div>
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
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script type="text/javascript">
    var dom = document.getElementById('kullanici_meslek');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  title: {
    text: 'Mesleklere Göre Kullanıcı Sayısı',
    
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: '50%',
      data: [
        <?php echo $kullanici_sayilari;?>
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>

</body>

</html>
<!-- end document-->

