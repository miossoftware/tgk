<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<style>

    @media screen and (max-width: 768px) {
        .container {
            height: auto;
            width: 100%;
            max-width: 720px;
        }
    }

    /* Mobil boyutları için stil kuralları */
    @media screen and (max-width: 480px) {
        .container {
            height: auto;
            width: 100%;
            max-width: 360px;
        }
    }
</style>
<div class="page-wrapper duzenle_body">
    <!-- START HEADER-->
    <header class="header" style="background-color: #374f65">
        <div class="page-brand">
        </div>
        <div class="flexbox flex-1">
            <!-- START TOP-LEFT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li>
                    <a class="nav-link sidebar-toggler js-sidebar-toggler" style="color: white"><i class="ti-menu"></i></a>
                </li>
            </ul>
            <!-- END TOP-LEFT TOOLBAR-->
            <!-- START TOP-RIGHT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li class="dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                        <span style="color: white"><?= $_SESSION["name_surname"] ?><i
                                    class="fa fa-angle-down m-l-5"></i></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" style="cursor: pointer" id="cikis_yap"><i class="fa fa-power-off"></i>Çıkış
                            Yap</a>
                    </ul>
                </li>
            </ul>
            <!-- END TOP-RIGHT TOOLBAR-->
        </div>
    </header>
    <!-- END HEADER-->
    <!-- START SIDEBAR-->
    <nav class="page-sidebar" id="sidebar">
        <div id="sidebar-collapse">
            <div class="admin-block d-flex">
                <div>
                    <img src="../assets/img/admin-avatar.png" width="45px"/>
                </div>
                <div class="admin-info">
                    <div class="font-strong"><?= mb_strtoupper($_SESSION["name_surname"]) ?></div>
                    <small><?php if ($_SESSION["user_root"] == 1) {
                            echo "Yönetici";
                        } else {
                            echo 'Kullanıcı';
                        } ?></small></div>
            </div>
            <ul class="side-menu metismenu">
                <li>
                    <a style="cursor: pointer; color: white" id="anasayfa_getir"><i
                                class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Anasayfa</span>
                    </a>
                </li>
                <li class="heading">Modüller</li>
                <li>
                    <a href="javascript:" id="kurum_randevu_ver"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">Kullanıcı Talepleri</span></a>
                </li>
                <li>
                    <a href="javascript:" id="kurumlara_ait_randevu_talepleri"><i class="sidebar-item-icon fa fa-building"></i>
                        <span class="nav-label">Randevu Talepleri</span></a>
                </li>
                <li>
                    <a href="javascript:" id="randevu_takvimi"><i class="sidebar-item-icon fa fa-calendar"></i>
                        <span class="nav-label">Randevu Takvimi</span></a>
                </li>
                <li>
                    <a href="javascript:" id="gelmesi_beklenen_kurumlar"><i class="sidebar-item-icon fa fa-spinner"></i>
                        <span class="nav-label">Gelmesi Beklenen Kurumlar</span></a>
                </li>
<!--                <li>-->
<!--                    <a href="javascript:" id="gelenler_listesi"><i class="sidebar-item-icon fa fa-check"></i>-->
<!--                        <span class="nav-label">Gelen Kurumlar Listesi</span></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:" id="gelmeyen_ziyaretcilerin_listesi"><i class="sidebar-item-icon fa fa-close"></i>-->
<!--                        <span class="nav-label">Gelmeyenler Listesi</span></a>-->
<!--                </li>-->
                <li>
                    <a href="javascript:" id="randevu_tanimlari"><i class="sidebar-item-icon fa fa-cog"></i>
                        <span class="nav-label">Randevu Tanımları</span></a>
                </li>
                <li>
                    <a href="javascript:" id="kullanıcı_olustur"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">Kullanıcılar</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END SIDEBAR-->
    <div class="content-wrapper" style="background-color: #9DB2BF;">
        <div class="modal-icerik"></div>
    </div>
</div>
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<script src="../assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="../assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="../assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
<script src="../assets/js/app.min.js" type="text/javascript"></script>
<script src="../assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

<script>
    $("body").off("click", "#ziyaretci_listesi").on("click", "#ziyaretci_listesi", function () {
        $.get("../view/ziyaretci_listesi.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#ziyaretci_giris_kaydi").on("click", "#ziyaretci_giris_kaydi", function () {
        $.get("../view/ziyaretci_giris_kaydi.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#gelmeyen_ziyaretcilerin_listesi").on("click", "#gelmeyen_ziyaretcilerin_listesi", function () {
        $.get("../view/gelmeyen_ziyaretcilerin_listesi.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#randevu_tanimlari").on("click", "#randevu_tanimlari", function () {
        $.get("../view/randevu_tanimlari.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#gelenler_listesi").on("click", "#gelenler_listesi", function () {
        $.get("../view/gelenler_listesi.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#gelmesi_beklenen_kurumlar").on("click", "#gelmesi_beklenen_kurumlar", function () {
        $.get("../view/gelmesi_beklenen_kurumlar.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#anasayfa_getir").on("click", "#anasayfa_getir", function () {
        $.get("../view/anasayfa.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#uygun_randevular_admin").on("click", "#uygun_randevular_admin", function () {
        $.get("../view/uygun_randevular_admin.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#kurum_randevu_ver").on("click", "#kurum_randevu_ver", function () {
        $.get("../view/kurum_randevu_ver.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#kurumlara_ait_randevu_talepleri").on("click", "#kurumlara_ait_randevu_talepleri", function () {
        $.get("../view/kurumlara_ait_randevu_talepleri.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });
    $("body").off("click", "#randevu_takvimi").on("click", "#randevu_takvimi", function () {
        $.get("../view/randevu_takvimi.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });

    $("body").off("click", "#cikis_yap").on("click", "#cikis_yap", function () {
        $.ajax({
            url: "../controller/sql.php?islem=logout",
            type: "POST",
            success: function (result) {
                if (result != 2) {
                    Swal.fire(
                        'Başarılı!',
                        'Güvenli Çıkış Sağlanıyor',
                        'success'
                    );
                    setTimeout(function () {
                        location.reload();
                    }, 800);
                }
            }
        });
    });
    $(document).ready(function (){
        $.get("../view/anasayfa.php", function (getList) {
            $(".modal-icerik").html("");
            $(".modal-icerik").html(getList);
        });
    });

    $("body").off("click", "#kullanıcı_olustur").on("click", "#kullanıcı_olustur", function () {
        $.get("../modals/kullanici_modal/kullanici_olustur.php?islem=kullanici_olustur_modal_getir", function (getModal) {
            $(".getModals").html("");
            $(".getModals").html(getModal);
        })
    });

</script>