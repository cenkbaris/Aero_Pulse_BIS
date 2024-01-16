<?php
    require 'baglan.php';
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
    <title>Admin Kaydı</title>

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
        <div class="page-content--bge7">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="index.php">
                                <img src="images/icon/logo1.png">
                            </a>
                        </div>
                        <?php
                                        $ad=$_POST['name'];
                                        $soyad = $_POST['surname'];
                                        $tel = $_POST['telefon'];
                                        $cinsiyet = $_POST['cinsiyet'];
                                        $tc_no = $_POST['TC'];
                                        $sifre = $_POST['password'];
                                        $sifre2 = $_POST['password2'];
                                        $dogum = $_POST['dogum'];
                                        $engelli=$_POST['engel'];
                                        $meslek=$_POST['meslek'];
                                        if($_POST)
                                        {
                                            if(!$ad || !$soyad || !$tel || !$cinsiyet || !$tc_no ||!$sifre || !$sifre2 || !$dogum ||!$engelli || !$meslek){
                                                echo '<script>Swal.fire({
                                                    title: "Hata!",
                                                    text: "Lütfen bütün satırları doldurun.",
                                                    icon: "error"})</script>';
                                            }
                                            else
                                            {
                                                if($sifre != $sifre2){
                                                    echo '<script>Swal.fire({
                                                        title: "Hata!",
                                                        text: "Girdiğiniz şifreler uyuşmuyor.",
                                                        icon: "error"})</script>';
                                                }
                                                else
                                                {
                                                    $sifre = md5($sifre);
                                                    $tc_control = mysqli_query($baglan,"SELECT * FROM kullanici WHERE tc_no = '$tc_no'");
                                                    if ($tc_control) 
                                                    {
                                                        
                                                        if(mysqli_num_rows($tc_control) > 0)
                                                        {
                                                        echo '<script>Swal.fire({
                                                            title: "Hata!",
                                                            text: "Bu TC numarası daha önce kullanılmıştır.",
                                                            icon: "error"})</script>';
                                                        }
                                                        else  
                                                        {
                                                            
                                                            $sql = mysqli_query($baglan,"INSERT INTO kullanici(ad,soyad,tel_no,cinsiyet,tc_no,sifre,dogum_tarihi,engelli,kullanici_tip_id,meslek_id) values('$ad','$soyad','$tel','$cinsiyet','$tc_no','$sifre','$dogum','$engelli','1','$meslek')");
                                                            if ($sql) {
                                                                echo '<script>Swal.fire({
                                                                    title: "Başarılı!",
                                                                    text: "Kayıt başarıyla gerçekleşti.",
                                                                    icon: "success"})</script>';
                                                            } 
                                                            else
                                                            {
                                                                echo '<script>Swal.fire({
                                                                    title: "Hata!",
                                                                    text: "Kayıt eklenirken bir hata oluştu.",
                                                                    icon: "error"})</script>';;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Ad</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Ad" required>
                                </div>
                                <div class="form-group">
                                    <label>Soyad</label>
                                    <input class="au-input au-input--full" type="text" name="surname" placeholder="Soyad"required>
                                </div>
                                <div class="form-group">
                                    <label>Telefon Numarası</label>
                                    <input class="au-input au-input--full" type="tel" name="telefon" placeholder="Tel No"required>
                                </div>
                                <div class="form-group">
                                    <label>Cinsiyet</label>
                                <label>
									<select class="form-control" name="cinsiyet">
                                        <option value = "Erkek">Erkek</option>	
                                        <option value = "Kadın">Kadın</option>														
									</select>
                                </label>
                                </div>
                                <div class="form-group">
                                    <label>TC No</label>
                                    <input class="au-input au-input--full" type="text" name="TC" placeholder="TC No"required>
                                </div>
                                <div class="form-group">
                                    <label>Şifre</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Şifre"required>
                                </div>
                                <div class="form-group">
                                    <label>Şifre Tekrar</label>
                                    <input class="au-input au-input--full" type="password" name="password2" placeholder="Şifre"required>
                                </div>
                                <div class="form-group">
                                    <label>Doğum Tarihi</label>
                                    <input class="au-input au-input--full" type="date" name="dogum" placeholder="Doğum Tarihi"required>
                                </div>
                                <div class="form-group">
                                    <label>Engel Durumu</label>
                                    <select class="form-control" name="engel">
										<option value = "Evet">Engelli</option>
                                        <option value = "Hayır">Engelli Değil</option>													
										
									</select>
                                </div>
                                <div class="form-group">
                                <label for="form-group">Meslek</label>
                                <?php
                                
                                    echo '<select class="form-control" name = meslek>';
                                    $meslek = "SELECT meslek.meslek_id,meslek.meslek_adi FROM meslek";
                                    $meslek_getir = $baglan->query($meslek);
                                    if($meslek_getir->num_rows > 0)
                                    {
                                        while($row = $meslek_getir->fetch_assoc())
                                        {
                                            echo '<option value ="'.$row["meslek_id"].'">'.$row["meslek_adi"].'</option>';
                                        }
                                    } 
                                    echo '</select>';
                                ?>
                                <br><br>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="submit" type="submit">Admin Kaydı Oluştur</button>
                                
                                
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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->