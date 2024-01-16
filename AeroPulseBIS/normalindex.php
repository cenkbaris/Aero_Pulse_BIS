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
    if(!isset($_SESSION["kullanici_id"])) {
        header('Location: login.php');
    }

    if($userType != 1 and $userType != 2){ #kullanıcı tipi 1 ve 2 değilse login sayfasına yönlendir. (sayfa kitleme)
        header('Location: login.php');
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
    <title>Kullanıcı Paneli</title>

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
            <?php header_deskpot(); ?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Hoş Geldiniz !</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            
                                            <div class="text">
                                                <?php 
                                                    $log_sayi1 = "SELECT COUNT(log_kaydi.log_kaydi_id) AS log_kaydi_sayisi FROM log_kaydi where kullanici_id =$userID";
                                                    $log_sayi = $baglan->query($log_sayi1);
                                                    if($log_sayi->num_rows > 0)
                                                    {
                                                        
                                                        while($row = $log_sayi->fetch_assoc())
                                                        {
                                                            echo '<h2>'.$row["log_kaydi_sayisi"] .'</h2>';
                                                        }
                                                    } 
                                                ?>
                                                <span>Log Kaydı Sayınız</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                            <?php                                                
                                                    $satis_sorgu = "SELECT COUNT(satin_alim.satin_alim_id) AS satilan FROM satin_alim WHERE kullanici_id =$userID";
                                                    $satis = $baglan->query($satis_sorgu);
                                                    if($satis->num_rows > 0)
                                                    {
                                                        while($row = $satis->fetch_assoc())
                                                        {
                                                            echo '<h2>'.$row["satilan"] .'</h2>';
                                                        }
                                                    } 
                                                ?>
                                                <span>Toplam Bilet Sayınız</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                            <?php                                                
                                                    $sefer_sorgu = "SELECT COUNT(seferler.sefer_id) AS sefer_sayi FROM seferler";
                                                    $sefer = $baglan->query($sefer_sorgu);
                                                    if($sefer->num_rows > 0)
                                                    {
                                                        while($row = $sefer->fetch_assoc())
                                                        {
                                                            echo '<h2>'.$row["sefer_sayi"] .'</h2>';
                                                        }
                                                    } 
                                                ?>
                                                <span>
                                                    Toplam Sefer Sayısı
                                                </span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                            <?php
                                                        $tarih = date("d/m/y");
                                                        echo '<h2>'.$tarih.'</h2>';
                                                        
                                                    ?>
                                                <span>Tarih</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Sefer Doluluk Tablosu</h3><br>
                                        <h6 style="color:Blue;">Kullanıcı Sayısı</h6>
                                        <div class="recent-report__chart">
                                        <canvas id="myChart" width="800" height="450"></canvas>
                                            <h6 style="padding-left:600px;color:Blue;">Sefer No</h6>
                                            <?php
                                            $satis_query = mysqli_query($baglan,"SELECT COUNT(satin_alim.satin_alim_id) AS satis_sayisi, satin_alim.sefer_id FROM satin_alim GROUP BY satin_alim.sefer_id;");
                                            $satis_sayi = "";
                                            $satis_sefer ="";
                                            if(mysqli_num_rows($satis_query)!=0)
                                            {
                                                while($read_satis = mysqli_fetch_array($satis_query))
                                                {
                                                    $satis_sayi .=$read_satis['satis_sayisi'] . ",";
                                                    $satis_sefer .=$read_satis['sefer_id'] . ",";
                                                }
                                            }
                                            $satis_sefer = rtrim($satis_sefer,',');
                                            $satis_sayi= rtrim($satis_sayi,',');
                                        ?>
                                        </div>
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
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

<script>
const xValues = [<?php echo $satis_sefer;?>];
const yValues = [<?php echo $satis_sayi;?>];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
        label:"Kullanıcı Sayısı",
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:30}}],
    }
  }
});
</script>
<script>
    new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: [<?php echo $log_ad;?>],
      datasets: [
        {
          label: "Log Kaydı Sayısı",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [<?php echo $log_sayi;?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
      }
    }
});
</script>
<script>
    $(document).ready( function () {
    $('#dinamik').DataTable();
    } );
</script>
</body>

</html>
<!-- end document-->

