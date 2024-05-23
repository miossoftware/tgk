<!doctype html>
<head>
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet"/>
    <link href="../assets/vendors/DataTables/datatables.min.css" rel="stylesheet"/>
    <link href="../assets/css/main.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css"
          href="../assets/vendors/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet"/>
    <link href="../assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <link href="../assets/css/main.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/vendors/flatpickr/dist/flatpickr.min.css">
    <link rel="icon" href="../assets/img/mbb_ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <title>Bilim Merkezi</title>
</head>
<style>
    .dataTables_scrollHeadInner table {
        width: 100% !important;
    }

    .modal-header {
        background-color: #374f65 !important;
    }

    @media screen and (max-width: 768px) {
        .modal-footer {
            width: 95%;
            height: 95%;
        }
    }

    td {
        text-transform: uppercase;
    }

    table {
        cursor: pointer;
    }

    .modal-header {
        background-color: #87CBB9;
    }

    body {
        background-image: url("../assets/img/tgk_background.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<body>
<style>
    body {
        position: relative;
        height: 100vh;
        margin: 0;
    }

    .kutu {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

</style>
<div class="degiskenli_div">
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    <div class="site-navbar-wrap">
        <div class="site-navbar-top">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="d-flex mr-auto">
                            <a href="" class="d-flex align-items-center mr-4">
                                <span class="icon-envelope mr-2 text-black"></span>
                                <span class="d-none text-black d-md-inline-block">info@mersinbuyuksehiras.com.tr</span>
                            </a>
                            <a href="" class="d-flex align-items-center mr-auto">
                                <span class="icon-phone mr-2 text-black"></span>
                                <span class="d-none text-black d-md-inline-block">+90 324 320 17 70 - 71 - 72</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-navbar site-navbar-target js-sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-4">
                        <h1 class="my-0 site-logo" ><a href="" style="color: #2C7865"><?=$_SESSION["name_surname"]?></a></h1>
                    </div>
                    <div class="col-6 row no-gutters">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                                                                              class="site-menu-toggle js-menu-toggle text-white"><span
                                                class="icon-menu h3"></span></a></div>

                                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                                    <li class="">
                                        <a href="#">
                                            <button class="btn btn-danger btn-sm" style="color:white;" id="cikis_yap_button">
                                                <i class="fa fa-sign-in"></i> Çıkış Yap
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card kutu"
         style="opacity:95% ;background-color: transparent;color: #2C7865;box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;">
        <div class="card-body">
            <section id="hero" class="d-flex align-items-center">
                <div class="container d-flex flex-column align-items-center" data-aos="zoom-in" data-aos-delay="100">
                    <h1 style="font-weight: bold">Tarsus Gençlik Kampı</h1>
                    <h5 style="font-weight: bold">Mersin Büyükşehir Belediyesi</h5>
                    <a class="btn-about">
                        <button id="user_ziyaretci_randevu_ver_button" class="btn"
                                style="background-color: #2C7865; color:white;font-weight: bold"><i
                                    class="fa fa-calendar"></i> Randevu Talebi Oluştur
                        </button>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="getModals"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script src="../assets/js/app.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="../assets/js/app.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="../assets/vendors/flatpickr/dist/flatpickr.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.sticky.js"></script>
<script src="../assets/js/main.js"></script>
<script>

    $("body").off("click", "#cikis_yap_button").on("click", "#cikis_yap_button", function () {
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

    $("body").off("click", "#user_ziyaretci_randevu_ver_button").on("click", "#user_ziyaretci_randevu_ver_button", function () {
        $.get("../view/user_ziyaretci_randevu_ver.php", function (getView) {
            $(".degiskenli_div").html(getView);
        })
    });

    $("body").off("click", "#randevularimi_gor_button").on("click", "#randevularimi_gor_button", function () {
        $.get("../view/randevularimi_gor_button.php", function (getView) {
            $(".degiskenli_div").html(getView);
        })
    });
</script>
</body>
</html>