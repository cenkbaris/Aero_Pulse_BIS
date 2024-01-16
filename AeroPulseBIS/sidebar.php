<?php
    function sidebar(){
        echo 
        '
        <head><link href="css/theme.css" rel="stylesheet" media="all"></head>
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="index.php">
                    <img src="images/icon/logo1.png">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Ana Sayfa</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-gear"></i>Ayarlar</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="form.php">Formlar</a>
                                </li>
                                <li class="has-sub">
                            <a class="js-arrow" href="#">
                                Kullanıcı Arayüz Öğeleri</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="button.php">Buton</a>
                                </li>
                                <li>
                                    <a href="badge.php">Rozetler</a>
                                </li>
                                <li>
                                    <a href="tab.php">Sekmeler</a>
                                </li>
                                <li>
                                    <a href="card.php">Cartlar</a>
                                </li>
                                <li>
                                    <a href="alert.php">Uyarılar</a>
                                </li>
                                <li>
                                    <a href="progress-bar.php">İlerleme Çubuğu</a>
                                </li>
                                <li>
                                    <a href="modal.php">Modeller</a>
                                </li>
                                <li>
                                    <a href="switch.php">Anahtarlar</a>
                                </li>
                                <li>
                                    <a href="grid.php">Izgaralar</a>
                                </li>
                                <li>
                                    <a href="fontawesome.php">Fontawesome Simgesi</a>
                                </li>
                                <li>
                                    <a href="typo.php">Tipokrafi</a>
                                </li>
                            </ul>
                        </li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        ';
    }
    function sidebar2(){
        echo 
        '
        <head><link href="css/theme.css" rel="stylesheet" media="all"></head>
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="normalindex.php">
                    <img src="images/icon/logo1.png">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="normalindex.php">
                                <i class="fas fa-tachometer-alt"></i>Ana Sayfa</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                            </ul>
                        </li>
                        <li>
                            <a href="kullanicichart.php">
                                <i class="fas fa-chart-bar"></i>Grafikler</a>
                        </li>
                        <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tablolar</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        ';
    }
?>