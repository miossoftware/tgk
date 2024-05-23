<!doctype html>
<html lang="tr">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="assets/css/style.css">


</head>
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
        /* İstediğiniz stil ve içerik özelliklerini ekleyin */
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
                                <span class="icon-envelope mr-2"></span>
                                <span class="d-none d-md-inline-block">info@mersinbuyuksehiras.com.tr</span>
                            </a>
                            <a href="" class="d-flex align-items-center mr-auto">
                                <span class="icon-phone mr-2"></span>
                                <span class="d-none d-md-inline-block">+90 324 320 17 70 - 71 - 72</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-navbar site-navbar-target js-sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-2">
                        <h1 class="my-0 site-logo"><a href="">Bilim Merkezi</a></h1>
                    </div>
                    <div class="col-10 row no-gutters">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                                                                              class="site-menu-toggle js-menu-toggle text-white"><span
                                                class="icon-menu h3"></span></a></div>

                                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                                    <li class="">
                                        <a href="view/admin_panel.php">
                                            <button class="btn btn-sm" id="personel_giris_button"
                                                    style="background-color: #17594A;color: white">
                                                <i class="fa fa-sign-in"></i> Personel Girişi
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
         style="opacity:95% ;background-color: transparent;color: white;box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;">
        <div class="card-body">

            <section id="hero" class="d-flex align-items-center">
                <div class="container d-flex flex-column align-items-center" data-aos="zoom-in" data-aos-delay="100">
                    <h1 style="font-weight: bold">Mersin Büyükşehir Belediyesi</h1>
                    <h5 style="font-weight: bold">Bilim Merkezi</h5>
                    <a class="btn-about">
                        <button id="ziyaretci_randevu_ver_button" class="btn"
                                style="background-color: #F7C04A;font-weight: bold"><i
                                    class="fa fa-calendar"></i> Randevu Talebi Oluştur
                        </button>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>


<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>
<script src="./assets/js/main.js"></script>

<script>
    $("body").off("click", "#ziyaretci_randevu_ver_button").on("click", "#ziyaretci_randevu_ver_button", function () {
        $.get("view/ziyaretci_randevu_ver.php", function (getView) {
            $(".degiskenli_div").html("");
            $(".degiskenli_div").html(getView);
        })
    });
</script>

</body>
</html>