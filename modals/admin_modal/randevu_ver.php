<?php

$islem = $_GET["islem"];

if ($islem == "kuruma_randevu_ver_modal") {
    ?>
    <div class="modal fade" id="kuruma_randevu_ver_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 35%; max-width: 35%; ">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <span>RANDEVU OLUŞTUR</span>
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="modal_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="talepleri_getir_div"></div>
                        <div class="col-12 row">
<!--                            <div class="form-group row">-->
<!--                                <div class="col-md-4">-->
<!--                                    <label>Randevu Talep No</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-7">-->
<!--                                    <div class="input-group">-->
<!--                                        <input type="text" class="form-control form-control-sm"-->
<!--                                               placeholder="Randevu Talebi Seçiniz..." id="randevu_id">-->
<!--                                        <div class="input-group-append">-->
<!--                                            <button class="btn btn-warning btn-sm" id="randevulari_getir_button"><i-->
<!--                                                        class="fa fa-ellipsis-h"></i></button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Kurum Adı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="kurum_adi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Kişi Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="kisi_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Randevu Tarihi</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="datetime-local" value="<?= date("Y-m-d 08:00") ?>"
                                           class="form-control form-control-sm" id="randevu_tarih">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row no-gutters">
<!--                            <div class="col-md-2 mx-3">-->
<!--                                <input type="date" class="form-control form-control-sm" value="--><?//= date("Y-m-d") ?><!--"-->
<!--                                       id="tarih">-->
<!--                            </div>-->
<!--                            <div class="col-md-2 mx-2">-->
<!--                                <button class="btn btn-secondary btn-sm" id="uygun_randevu_filtrele"><i-->
<!--                                            class="fa fa-filter"></i>-->
<!--                                    Hazırla-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <table class="table table-sm table-bordered w-100 display nowrap" id="randevu_list_table"-->
<!--                                   style="font-size: 13px;">-->
<!--                                <thead>-->
<!--                                <tr style="background-color: white">-->
<!--                                    <th class="clickone1">Zaman Aralığı</th>-->
<!--                                    <th>Kişi Sayısı</th>-->
<!--                                </tr>-->
<!--                                </thead>-->
<!--                            </table>-->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm modal_kapali"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="admin_randevu_kaydet"><i class="fa fa-check"></i>
                                Randevu Ver
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("#kuruma_randevu_ver_modal").modal("show");

            setTimeout(function () {
                $(".clickone1").trigger("click");
            }, 500);

            var table = $('#randevu_list_table').DataTable({
                paging: false,
                scrollY: "35vh",
                scrollX: true,
                searching: false,
                order: [0, ["asc"]],
                "info": false,
                createdRow: function (row) {
                    $(row).addClass("stok_list_selected");
                },
                "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"},
            });

            $("body").off("click", "#uygun_randevu_filtrele").on("click", "#uygun_randevu_filtrele", function () {
                table.clear().draw(false);
                $.get("../controller/randevu_controller/sql.php?islem=admin_randevu_infos", {
                    tarih: $("#tarih").val()
                }, function (result) {
                    if (result != 2) {
                        var json = JSON.parse(result);
                        json.forEach(function (item) {
                            let yuzde = item.kisi_sayisi
                            table.row.add([item.saat_araligi, yuzde]).draw(false);
                        })
                    } else {
                        table.row.add(["08:00-10:00", "0"]).draw(false);
                        table.row.add(["10:00-12:00", "0"]).draw(false);
                        table.row.add(["12:00-14:00", "0"]).draw(false);
                        table.row.add(["16:00-16:00", "0"]).draw(false);
                        table.row.add(["16:00-18:00", "0"]).draw(false);
                        table.row.add(["18:00-20:00", "0"]).draw(false);
                        table.row.add(["20:00-22:00", "0"]).draw(false);
                    }
                })
            });
        });

        $("body").off("click", ".modal_kapali").on("click", ".modal_kapali", function () {
            $("#kuruma_randevu_ver_modal").modal("hide");
        });

        $("body").off("click", "#admin_randevu_kaydet").on("click", "#admin_randevu_kaydet", function () {
            let kisi_sayisi = $("#kisi_sayisi").val()
            let kurum_adi = $("#kurum_adi").val();
            let tarih_saat = $("#randevu_tarih").val();
            $.ajax({
                url: "../controller/randevu_controller/sql.php?islem=admin_randevu_versin_sql",
                type: "POST",
                data: {
                    kisi_sayisi: kisi_sayisi,
                    kurum_adi: kurum_adi,
                    tarih_saat: tarih_saat
                },
                success: function (res) {
                    if (res == 1) {
                        Swal.fire(
                            "Başarılı",
                            "Randevu Oluşturuldu",
                            "success"
                        );
                        $("#kuruma_randevu_ver_modal").modal("hide");
                        $.get("../view/kurum_randevu_ver.php", function (getList) {
                            $(".modal-icerik").html("");
                            $(".modal-icerik").html(getList);
                        });
                    } else if (res == 300) {
                        Swal.fire(
                            "Uyarı",
                            "Bu Randevu Belirttiğiniz Saat Aralıklarına Uygun Bir Randevu Değildir",
                            "warning"
                        )
                    } else {
                        Swal.fire(
                            "Oops...",
                            "Bilinmeyen Bir Hata Oluştu",
                            "error"
                        )
                    }
                }
            });
        });

        $("body").off("click", "#randevulari_getir_button").on("click", "#randevulari_getir_button", function () {
            $.get("../modals/admin_modal/randevu_ver.php?islem=talepleri_getir_modal", function (getModal) {
                $(".talepleri_getir_div").html(getModal);
            })
        });

    </script>
    <?php
}
if ($islem == "talepleri_getir_modal") {
    ?>
    <div class="modal fade" id="talepleri_getir_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 70%; max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <span>RANDEVU TALEPLERİ</span>
                    <button type="button" class="btn-close btn-close-white" id="talepleri_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="col-12 row">
                            <table class="table table-sm table-bordered w-100 display"
                                   style="cursor:pointer;font-size: 13px;"
                                   id="ogr_list">
                                <thead>
                                <tr>
                                    <th id="click12">Kurum Adı</th>
                                    <th>Kişi Sayısı</th>
                                    <th>Sınıflar</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $("#talepleri_getir_modal").modal("show");

            setTimeout(function () {
                $("#click12").trigger("click");
            }, 500);

            var ogr_table = $('#ogr_list').DataTable({
                scrollY: '30vh',
                scrollX: true,
                autoWidth: false,
                createdRow: function (row, data) {
                    $(row).addClass("talepler_list_selected");
                    $(row).attr("data-id", data.id);
                },
                columns: [
                    {"data": "okul_adi"},
                    {"data": "kisi_sayisi"},
                    {"data": "siniflar"}
                ],
                "paging": false,
                "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"}
            });

            $.get("../controller/randevu_controller/sql.php?islem=talepleri_getir_sql", function (res) {
                if (res != 2) {
                    var json = JSON.parse(res);
                    ogr_table.rows.add(json).draw(false);
                }
            });
        });

        $("body").off("click", ".talepler_list_selected").on("click", ".talepler_list_selected", function () {
            let id = $(this).attr("data-id");
            let kisi_sayisi = $(this).find("td").eq(1).text();
            let kurum_adi = $(this).find("td").eq(0).text();
            $("#kisi_sayisi").val(kisi_sayisi)
            $("#kurum_adi").val(kurum_adi)
            $("#randevu_id").val(id);
            $("#talepleri_getir_modal").modal("hide");
        });

        $("body").off("click", "#talepleri_kapat").on("click", "#talepleri_kapat", function () {
            $("#talepleri_getir_modal").modal("hide");
        });

    </script>
    <?php
}
if ($islem == "kuruma_randevu_guncelle_modal") {
    ?>
    <div class="modal fade" id="kuruma_randevu_ver_guncelle_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 35%; max-width: 35%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <span>RANDEVU OLUŞTUR</span>
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="modal_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="talepleri_getir_div"></div>
                        <div class="col-12 row">
<!--                            <div class="form-group row">-->
<!--                                <div class="col-md-4">-->
<!--                                    <label>Randevu Talep No</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-7">-->
<!--                                    <div class="input-group">-->
<!--                                        <input type="text" class="form-control form-control-sm"-->
<!--                                               placeholder="Randevu Talebi Seçiniz..." disabled id="randevu_id">-->
<!--                                        <div class="input-group-append">-->
<!--                                            <button class="btn btn-warning btn-sm" disabled-->
<!--                                                    id="randevulari_getir_button"><i-->
<!--                                                        class="fa fa-ellipsis-h"></i></button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Kurum Adı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="kurum_adi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Kişi Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="kisi_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Randevu Tarihi</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="datetime-local" value="<?= date("Y-m-d 08:00") ?>"
                                           class="form-control form-control-sm" id="randevu_tarih">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm modal_kapali"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="admin_randevu_guncelle"><i
                                        class="fa fa-check"></i>
                                Randevu Ver
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("#kuruma_randevu_ver_guncelle_modal").modal("show");

            $.get("../controller/randevu_controller/sql.php?islem=kurum_randevu_bilgileri_getir_sql", {id: "<?=$_GET["id"]?>"}, function (res) {
                if (res != 2) {
                    var item = JSON.parse(res);
                    $("#kisi_sayisi").val(item.kisi_sayisi)
                    $("#kurum_adi").val(item.kurum_adi)
                    $("#randevu_id").val(item.istek_id);
                    $("#randevu_tarih").val(item.tarih_saat);
                }
            })
        });

        $("body").off("click", ".modal_kapali").on("click", ".modal_kapali", function () {
            $("#kuruma_randevu_ver_guncelle_modal").modal("hide");
        });

        $("body").off("click", "#admin_randevu_guncelle").on("click", "#admin_randevu_guncelle", function () {
            let kisi_sayisi = $("#kisi_sayisi").val()
            let kurum_adi = $("#kurum_adi").val()
            let istek_id = $("#randevu_id").val();
            let tarih_saat = $("#randevu_tarih").val();
            $.ajax({
                url: "../controller/randevu_controller/sql.php?islem=admin_randevu_guncelle_sql",
                type: "POST",
                data: {
                    kisi_sayisi: kisi_sayisi,
                    kurum_adi: kurum_adi,
                    istek_id: istek_id,
                    tarih_saat: tarih_saat,
                    id: "<?=$_GET["id"]?>"
                },
                success: function (res) {
                    if (res == 1) {
                        Swal.fire(
                            "Başarılı",
                            "Randevu Oluşturuldu",
                            "success"
                        );
                        $("#kuruma_randevu_ver_guncelle_modal").modal("hide");
                        $.get("../view/kurum_randevu_ver.php", function (getList) {
                            $(".modal-icerik").html("");
                            $(".modal-icerik").html(getList);
                        });
                    }
                }
            });
        });

        $("body").off("click", "#randevulari_getir_button").on("click", "#randevulari_getir_button", function () {
            $.get("../modals/admin_modal/randevu_ver.php?islem=talepleri_getir_modal", function (getModal) {
                $(".talepleri_getir_div").html(getModal);
            })
        });

    </script>
    <?php
}