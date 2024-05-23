<?php

$islem = $_GET["islem"];
if ($islem == "yeni_ziyaretci_kaydi_modal") {
    ?>
    <div class="modal fade" id="yeni_ziyaretci_kaydi_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 35%; max-width: 35%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <span>ZİYARETÇİ KAYDI OLUŞTUR</span>
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="ziyartci_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="col-12 row">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>TC</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="tc">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Ad Soyad</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="ad_soyad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Telefon</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="tel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>İl</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="custom-select custom-select-sm" id="il">
                                        <option value="">İl Seçiniz...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>İlçe</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="custom-select custom-select-sm" id="ilce">
                                        <option value="">İlçe Seçiniz...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Yetişkin Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="yetiskin_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Çocuk Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="cocuk_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Adres</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea class="form-control form-control-sm" id="adres" rows="4"
                                              style="resize: none"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" id="ziyartci_kapat"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="anlik_ziyaretci_kaydet_button"><i
                                        class="fa fa-check"></i> Kaydet
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("#yeni_ziyaretci_kaydi_modal").modal("show");
            $.get("../controller/randevu_controller/sql.php?islem=illeri_getir_sql", function (res) {
                if (res != 2) {
                    var json = JSON.parse(res);
                    json.forEach(function (item) {
                        $("#il").append("" +
                            "<option data-id='" + item.id + "' value='" + item.il_adi + "'>" + item.il_adi + "</option>" +
                            "");
                    })
                }
            })
        });


        $("body").off("change", "#il").on("change", "#il", function () {
            let id = $("#il option:selected").attr("data-id");
            $.get("../controller/randevu_controller/sql.php?islem=ilceleri_getir_sql", {id: id}, function (res) {
                var json = JSON.parse(res);
                $("#ilce").html("");
                json.forEach(function (item) {
                    $("#ilce").append("" +
                        "<option value='" + item.ilce_adi + "'>" + item.ilce_adi + "</option>" +
                        "");
                })

            })
        })

        $("body").off("click", "#ziyartci_kapat").on("click", "#ziyartci_kapat", function () {
            $("#yeni_ziyaretci_kaydi_modal").modal("hide");
        });

        $("body").off("click", "#anlik_ziyaretci_kaydet_button").on("click", "#anlik_ziyaretci_kaydet_button", function () {
            let tc = $("#tc").val();
            let ad_soyad = $("#ad_soyad").val();
            let il = $("#il").val();
            let ilce = $("#ilce").val();
            let adres = $("#adres").val();
            let tel = $("#tel").val();
            let yetiskin_sayisi = $("#yetiskin_sayisi").val();
            let cocuk_sayisi = $("#cocuk_sayisi").val();
            $.ajax({
                url: "../controller/randevu_controller/sql.php?islem=anlik_ziyaretci_kaydi_sql",
                type: "POST",
                data: {
                    tc: tc,
                    ad_soyad: ad_soyad,
                    yetiskin_sayisi: yetiskin_sayisi,
                    cocuk_sayisi: cocuk_sayisi,
                    il: il,
                    ilce: ilce,
                    tel: tel,
                    adres: adres
                },
                success: function (res) {
                    if (res == 1) {
                        Swal.fire(
                            "Başarılı",
                            "Kayıt Başarılı",
                            "success"
                        );
                        $("#yeni_ziyaretci_kaydi_modal").modal("hide");
                        $.get("../view/ziyaretci_giris_kaydi.php", function (getList) {
                            $(".modal-icerik").html("");
                            $(".modal-icerik").html(getList);
                        });
                    }
                }
            });
        });

    </script>
    <?php
}
if ($islem == "yeni_ziyaretci_kaydi_guncelle_modal") {
    ?>
    <div class="modal fade" id="yeni_ziyaretci_kaydi_guncelle_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 35%; max-width: 35%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <span>ZİYARETÇİ KAYDI GÜNCELLE</span>
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="ziyartci_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="col-12 row">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>TC</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="tc">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Ad Soyad</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="ad_soyad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Telefon</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="tel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>İl</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="il">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>İlçe</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="ilce">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Yetişkin Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="yetiskin_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Çocuk Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="cocuk_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Adres</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea class="form-control form-control-sm" id="adres" rows="4"
                                              style="resize: none"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" id="ziyartci_kapat"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="anlik_ziyaretci_kaydet_button"><i
                                        class="fa fa-check"></i> Kaydet
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("#yeni_ziyaretci_kaydi_guncelle_modal").modal("show");

            $.get("../controller/randevu_controller/sql.php?islem=anlik_ziyaretci_bilgi_getir_sql", {id: "<?=$_GET["id"]?>"}, function (res) {
                if (res != 2) {
                    var item = JSON.parse(res);
                    $("#tc").val(item.tc);
                    $("#ad_soyad").val(item.ad_soyad);
                    $("#tel").val(item.tel);
                    $("#il").val(item.il);
                    $("#ilce").val(item.ilce);
                    $("#adres").val(item.adres);
                    $("#yetiskin_sayisi").val(item.yetiskin_sayisi);
                    $("#cocuk_sayisi").val(item.cocuk_sayisi);
                }
            })
        });

        $("body").off("click", "#ziyartci_kapat").on("click", "#ziyartci_kapat", function () {
            $("#yeni_ziyaretci_kaydi_guncelle_modal").modal("hide");
        });

        $("body").off("click", "#anlik_ziyaretci_kaydet_button").on("click", "#anlik_ziyaretci_kaydet_button", function () {
            let tc = $("#tc").val();
            let ad_soyad = $("#ad_soyad").val();
            let il = $("#il").val();
            let ilce = $("#ilce").val();
            let adres = $("#adres").val();
            let tel = $("#tel").val();
            let yetiskin_sayisi = $("#yetiskin_sayisi").val();
            let cocuk_sayisi = $("#cocuk_sayisi").val();
            $.ajax({
                url: "../controller/randevu_controller/sql.php?islem=anlik_ziyaretci_kaydi_guncelle_sql",
                type: "POST",
                data: {
                    tc: tc,
                    id: "<?=$_GET["id"]?>",
                    ad_soyad: ad_soyad,
                    yetiskin_sayisi: yetiskin_sayisi,
                    cocuk_sayisi: cocuk_sayisi,
                    il: il,
                    ilce: ilce,
                    tel: tel,
                    adres: adres
                },
                success: function (res) {
                    if (res == 1) {
                        Swal.fire(
                            "Başarılı",
                            "Kayıt Güncellendi",
                            "success"
                        );
                        $("#yeni_ziyaretci_kaydi_guncelle_modal").modal("hide");
                        $.get("../view/ziyaretci_giris_kaydi.php", function (getList) {
                            $(".modal-icerik").html("");
                            $(".modal-icerik").html(getList);
                        });
                    }
                }
            });
        });

    </script>
    <?php
}