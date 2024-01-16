<?php
    function navbar(){
        echo
        '
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/icon/logo.png" alt="CoolAdmin">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Gösterge Paneli</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            </ul>
                        </li>
                        <li>
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>Grafikler</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tablolar</a>
                        </li>
                        <li>
                            <a href="form.php">
                                <i class="far fa-check-square"></i>Formlar</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Sayfalar</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Giriş Yap</a>
                                </li>
                                <li>
                                    <a href="register.html">Kayıt Ol</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Şifreyi Unut</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Kullanıcı Arayüz Öğeleri</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Buton</a>
                                </li>
                                <li>
                                    <a href="badge.html">Rozetler</a>
                                </li>
                                <li>
                                    <a href="tab.html">Sekmeler</a>
                                </li>
                                <li>
                                    <a href="card.html">Cartlar</a>
                                </li>
                                <li>
                                    <a href="alert.html">Uyarılar</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">İlerleme Çubukları</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modeller</a>
                                </li>
                                <li>
                                    <a href="switch.html">Anahtarlar</a>
                                </li>
                                <li>
                                    <a href="grid.html">Izgaralar</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Simgesi</a>
                                </li>
                                <li>
                                    <a href="typo.html">Tipografi</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        ';
        
        
        
        }
        function navbar1()
        {
            echo
        '
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/icon/logo.png" alt="CoolAdmin">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Gösterge Paneli</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            </ul>
                        </li>
                        <li>
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>Grafikler</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tablolar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        ';
        }
    
?>