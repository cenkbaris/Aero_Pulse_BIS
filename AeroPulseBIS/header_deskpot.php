<?php
session_start();
function header_deskpot(){
    echo
    '
    <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">'.$_SESSION["ad"].' '.$_SESSION["soyad"].'</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                                <div class="content">
                                                    <center><h5 class="name">
                                                        <br><br>'.$_SESSION["ad"].' '.$_SESSION["soyad"].'
                                                    </h5>
                                                    <span class="email">'.$_SESSION["tc_no"].'</span></center>
                                                </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="profile.php">
                                                        <i class="zmdi zmdi-account"></i>Hesap</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Çıkış Yap</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
    ';
}

?>