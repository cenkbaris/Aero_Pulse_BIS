<?php
    session_start();
    ob_start();
    include_once 'baglan.php';
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
    <title>Login</title>

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
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo1.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>TC Kimlik No:</label>
                                    <input class="au-input au-input--full" type="text" name="tc" placeholder="TC Kimlik No">
                                </div>
                                <div class="form-group">
                                    <label>Şifre</label>
                                    <input class="au-input au-input--full" type="password" name="sifre" placeholder="Şifre">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">Giriş Yap</button>
                                <?php
                                if(isset($_POST['submit'])){
                                    $tc = $_POST['tc'];
                                    $sifre = $_POST['sifre'];
                                    $hashli_sifre = md5($sifre);
                                    if($tc && $hashli_sifre)
                                    {
                                        $sorgu = mysqli_query($baglan,"SELECT * FROM kullanici WHERE tc_no = '$tc' AND sifre='$hashli_sifre'");
                                        $numrow = mysqli_num_rows($sorgu);
                                        if($numrow > 0)
                                        {
                                            $row = mysqli_fetch_array($sorgu);
                                            $_SESSION["tc_no"] = $row["tc_no"];
                                            $_SESSION["ad"] = $row["ad"];
                                            $_SESSION["soyad"] = $row["soyad"];
                                            $_SESSION["kullanici_id"] = $row["kullanici_id"];
                                            $_SESSION["kullanici_tip_id"] = $row["kullanici_tip_id"];
                                            $_SESSION["giris_tarih_saat"] = date("Y-m-d H:i:s");
                                            if($row['kullanici_tip_id']==1)
                                            {
                                                header('Location:index.php');
                                            }
                                            elseif($row['kullanici_tip_id']==2)
                                            {
                                                header('Location:normalindex.php');    
                                            }
                                            else
                                            {
                                                exit("User group ID bulunamadı");
                                            }
                                        }
                                        else
                                        {
                                            echo '<script>Swal.fire({
                                                title: "Hata!",
                                                text: "Hatalı değer girişi.",
                                                icon: "error"})</script>';
                                        }
                                    }
                                        
                                    
                                    
                                }
                                ?>
                            </form>
                            <div class="register-link">
                                <p>
                                    Hesabınız Yok Mu?
                                    <a href="register.php">Buradan Kayıt Olun</a>
                                </p>
                            </div>
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
    <script src="vendor/select2/select2.min.js">

    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->