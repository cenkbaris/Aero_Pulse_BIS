<?php
    require 'navbar.php';
    require 'sidebar.php';
    require 'header_deskpot.php';
    require 'footer.php';
    require 'baglan.php';
    $sayfa = "Grafikler";
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
    <title><?php echo "$sayfa" ?></title>

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
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Engelli ve Engelsiz Bireylerin Bilet Alım Sayısı</h3>
                                        <div id="container" style="height: 350px;"></div>
                                        <?php
                                            $engel_query = mysqli_query($baglan,"SELECT COUNT(satin_alim.satin_alim_id) as satin_alim_sayisi, kullanici.engelli FROM kullanici,satin_alim WHERE kullanici.kullanici_id = satin_alim.kullanici_id GROUP BY kullanici.engelli;");
                                            $psayilar = "";
                                            if(mysqli_num_rows($engel_query)!=0)
                                            {
                                                while($read_engel = mysqli_fetch_array($engel_query))
                                                {
                                                    $psayilar .= "{ value: " . $read_engel['satin_alim_sayisi'] . ", name: '" . $read_engel['engelli'] . "' }, ";
                                                }
                                            }
                                            $psayilar = rtrim($psayilar,',');
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">En Çok Satılan Koltuk Numaraları</h3>
                                        <canvas id="barrChart" style="width:100%; height: 350px;" ></canvas>
                                        <?php
                                            $koltuklarq = mysqli_query($baglan,"SELECT koltuklar.koltuk_no,COUNT(satin_alim.koltuk_no) AS koltuk_alim_sayisi FROM koltuklar,satin_alim WHERE koltuklar.koltuk_no = satin_alim.koltuk_no GROUP BY koltuklar.koltuk_no ORDER BY koltuk_alim_sayisi DESC LIMIT 10;");
                                            $xdeger ="";
                                            $ydeger ="";
                                            if(mysqli_num_rows($koltuklarq)!=0)
                                            {
                                                while($oku_koltuk = mysqli_fetch_array($koltuklarq))
                                                {
                                                    $xdeger .= "'" . $oku_koltuk['koltuk_no'] . "',";
                                                    $ydeger .= $oku_koltuk['koltuk_alim_sayisi'] . ",";
                                                }
                                            }
                                            $xdeger= rtrim($xdeger,',');
                                            $ydeger= rtrim($ydeger,',');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Hizmetlere Göre Satış Sayıları</h3>
                                        <canvas id="hizmetChart" style="width:100%; height: 325px;"></canvas>
                                        <?php
                                        $hizmet = mysqli_query($baglan,"SELECT hizmetler.hizmet_adi,COUNT(satin_alim.satin_alim_id) AS alim_sayisi FROM hizmetler,satin_alim WHERE satin_alim.hizmet_id = hizmetler.hizmet_id GROUP BY hizmetler.hizmet_adi;");                                          
                                        $hizmetx ="";
                                        $hizmety ="";
                                        if(mysqli_num_rows($hizmet)!=0)
                                        {
                                            while($hizmetread = mysqli_fetch_array($hizmet))
                                            {
                                              $hizmetx .= "'" . $hizmetread['hizmet_adi'] . "',";
                                              $hizmety .= $hizmetread['alim_sayisi'] . ",";
                                            }
                                        }
                                        $hizmetx= rtrim($hizmetx,',');
                                        $hizmety= rtrim($hizmety,',');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Kullanıcı Cinsiyet Oranı</h3>
                                        <canvas id="myChart" style="width:100%;height: 325px;"></canvas>
                                        <?php
                                            $eq = mysqli_query($baglan,"SELECT COUNT(kullanici.cinsiyet) as erkek_kullanici FROM kullanici WHERE kullanici.cinsiyet ='Erkek';");
                                            $kq = mysqli_query($baglan,"SELECT COUNT(kullanici.cinsiyet) as kadin_kullanici FROM kullanici WHERE kullanici.cinsiyet ='Kadın';");                                          
                                            $kqxdeger ="";
                                            
                                            if(mysqli_num_rows($kq)!=0 and mysqli_num_rows($eq)!=0)
                                            {
                                                while($read_kq = mysqli_fetch_array($kq) and $read_eq = mysqli_fetch_array($eq))
                                                {
                                                    $kqydeger .=$read_eq['erkek_kullanici'] . ",".$read_kq['kadin_kullanici'] . ",";
                                                    
                                                }
                                            }
                                            $kqydeger= rtrim($kqydeger,',');
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Koltuk Sınıfına Göre Satış Sayısı</h3>
                                        <canvas id="koltukChart" style="width:100%;height: 350px;"></canvas>
                                        <?php
                                        $koltuk = mysqli_query($baglan,"SELECT koltuklar.koltuk_sinifi,COUNT(satin_alim.satin_alim_id) AS alim_sayisi FROM koltuklar,satin_alim WHERE satin_alim.koltuk_no = koltuklar.koltuk_no GROUP BY koltuklar.koltuk_sinifi;");                                          
                                        $koltukx ="";
                                        $koltuky ="";
                                        if(mysqli_num_rows($koltuk)!=0)
                                        {
                                            while($koltukread = mysqli_fetch_array($koltuk))
                                            {
                                              $koltukx .= "'" . $koltukread['koltuk_sinifi'] . "',";
                                              $koltuky .= $koltukread['alim_sayisi'] . ",";
                                            }
                                        }
                                        $koltukx= rtrim($koltukx,',');
                                        $koltuky= rtrim($koltuky,',');
                                        
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
        <?php footer()?>
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
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"> </script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src='https://cdn.plot.ly/plotly-2.27.0.min.js'></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript">
    var dom = document.getElementById('container');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    top: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        <?php echo $psayilar; ?>
      ]
    }
  ]
};
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>
  <script>
var xValues = ["Erkek","Kadın"];
var yValues = [<?php echo $kqydeger; ?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
    }
  }
});
</script>
<script>
var xValues = [<?php echo $xdeger;?>];
var yValues = [<?php echo $ydeger;?>];
var barColors = ["#b91d47", "#00aba9","purple","green","blue","brown","orange","pink","gray","aqua"];

new Chart("barrChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    }
  }
});
</script>
<script>
	new Chart(document.getElementById("line-chart"), {
		type : 'line',
		data : {
			labels : [ <?php echo $şirketx;?>],
			datasets : [
					{
						data : [ <?php echo $şirkety;?> ],
						label : "Şirketler",
						borderColor : "#3cba9f",
						fill : false
					}]
		},
		options : {
			title : {
				display : true,
			}
		}
	});
</script>
<script>
  let ctx = document.getElementById("hizmetChart").getContext("2d");
let chart = new Chart(ctx, {
  type: "bar",
  data: {
	 labels: [<?php echo $hizmetx; ?>],
	 datasets: [
		{
		  label: "Satın Alım Sayısı",
		  backgroundColor: "#79AEC8",
		  borderColor: "#417690",
		  data: [<?php echo $hizmety; ?>]
		}
	 ]
  },
  options: {
	 title: {
		display: true
    
	 }
  }
});
</script>
<script>
  var birdsCanvas = document.getElementById("koltukChart");

var birdsData = {
  labels: [<?php echo $koltukx;?>],
  datasets: [{
    data: [<?php echo $koltuky;?>],
    backgroundColor: [
      "rgba(255, 0, 0, 0.5)",
      "rgba(100, 255, 0, 0.5)",
      "rgba(200, 50, 255, 0.5)",
      "rgba(0, 100, 255, 0.5)"
    ]
  }]
};

var polarAreaChart = new Chart(birdsCanvas, {
  type: 'polarArea',
  data: birdsData
});
</script>
<script>
var marksCanvas = document.getElementById("myDiv");

var marksData = {
  labels: [<?php echo $spx;?>],
  datasets: [{
    label: "Kabin Memuru",
    backgroundColor: "rgba(200,0,0,0.2)",
    data: [<?php echo $spz;?>]
  }, {
    label: "Uçak Mühendisi",
    backgroundColor: "rgba(0,100,200,0.2)",
    data: [<?php echo $spaa;?>]
  },{
    label: "Pilot",
    backgroundColor: "rgba(50,150,50,0.2)",
    data: [<?php echo $spy;?>]
  },{
    label: "Yardımcı Pilot",
    backgroundColor: "rgba(255,165,0,0.2)",
    data: [<?php echo $spa;?>]
  }
]
};

var radarChart = new Chart(marksCanvas, {
  type: 'radar',
  data: marksData
});
</script>
<script>
new Chart(document.getElementById("mChart"), {
  type: 'line',
  data: {
    labels: [<?php echo $mx;?>],
    datasets: [{ 
        data: [<?php echo $my;?>],
        label: "Kullanıcı Sayısı",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      
    }
  }
});

</script>
</body>

</html>
<!-- end document-->












<?php //SELECT koltuklar.koltuk_no,COUNT(satin_alim.koltuk_no) AS koltuk_alim_sayisi FROM koltuklar,satin_alim WHERE koltuklar.koltuk_no = satin_alim.koltuk_no GROUP BY koltuklar.koltuk_no ORDER BY koltuk_alim_sayisi DESC LIMIT 5;?>