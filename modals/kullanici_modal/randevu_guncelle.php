<?php
$islem = $_GET["islem"];


if ($islem == "randevu_guncelle_sql") {
    ?>
    <div class="modal fade" id="randevu_guncelle_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 35%; max-width: 35%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="modal_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-head" style='background-color:#9DB2BF'>
                            <div class="ibox-title" style='color:white; font-weight:bold;'>RANDEVU GÜNCELLE</div>
                        </div>
                        <div class="modal-body" style="max-height: 75vh; overflow: auto;">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Okul Adı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="okul_adi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Öğretmen Adı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="ogrtmn_adi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Kişi Sayısı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="kisi_sayisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Cep No</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control form-control-sm" id="cep_no">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>E-Mail</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="mail_adress">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Tarih</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="date" class="form-control form-control-sm" id="randevu_tarih_main">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Saat Aralığı</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="custom-select custom-select-sm" id="saat_aralik">
                                        <option value="">Saat Aralığını Seçiniz...</option>
                                        <option value="1">09:00 - 11:00</option>
                                        <option value="2">11:00 - 13:00</option>
                                        <option value="3">13:00 - 15:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" id="modal_kapat"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="guncelle_button"><i class="fa fa-check"></i>
                                Kaydet
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/vendors/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        var kisi_sayisi = 0;
        var ogr_table = "";

        $("body").off("focusout", "#kisi_sayisi").on("focusout", "#kisi_sayisi", function () {
            let val = $(this).val();
            if (val > 120) {
                val = 120;
            }
            $(this).val(val);
        });


        $("body").off("click", "#guncelle_button").on("click", "#guncelle_button", function () {
            let okul_adi = $("#okul_adi").val();
            let ogrtmn_adi = $("#ogrtmn_adi").val();
            let kisi_sayisi = $("#kisi_sayisi").val();
            let cep_no = $("#cep_no").val();
            let mail_adress = $("#mail_adress").val();
            let randevu_tarih_main = $("#randevu_tarih_main").val();
            randevu_tarih_main = randevu_tarih_main.split("/");
            let gun = randevu_tarih_main[0];
            let ay = randevu_tarih_main[1];
            let yil = randevu_tarih_main[2];
            let arr = [yil, ay, gun];
            randevu_tarih_main = arr.join("-");
            let saat_aralik = $("#saat_aralik").val();
            if (saat_aralik == "") {
                Swal.fire(
                    "Uyarı",
                    "Lütfen Bir Saat Aralığı Belirtiniz...",
                    "warning"
                );
            } else if (kisi_sayisi == 0 || kisi_sayisi == "") {
                Swal.fire(
                    "Uyarı",
                    "Kişi Sayısı 0 Olamaz",
                    "warning"
                );
            } else {
                $.ajax({
                    url: "../controller/randevu_controller/sql.php?islem=randevuyu_guncelle_sql",
                    type: "POST",
                    data: {
                        okul_adi: okul_adi,
                        ogrtmn_adi: ogrtmn_adi,
                        kisi_sayisi: kisi_sayisi,
                        cep_no: cep_no,
                        mail_adress: mail_adress,
                        randevu_tarih_main: randevu_tarih_main,
                        saat_aralik: saat_aralik,
                        randevu_id: "<?=$_GET["randevu_id"]?>"
                    },
                    success: function (res) {
                        if (res == 1) {
                            Swal.fire(
                                "Başarılı",
                                "Randevu Güncellendi",
                                "success"
                            );
                            $("#randevu_guncelle_modal").modal("hide");
                            $.get("../view/ziyaretci_listesi.php", function (getList) {
                                $(".modal-icerik").html("");
                                $(".modal-icerik").html(getList);
                            });
                        } else if (res == 300) {
                            Swal.fire(
                                "Uyarı",
                                "Bu Seans Uygun Değildir Lütfen Başka Bir Saat Seçiniz..",
                                "warning"
                            );
                        }
                    }
                });
            }
        });

        $(document).ready(function () {

            $.get("../controller/randevu_controller/sql.php?islem=randevu_bilgisi_getir_sql", {id: "<?=$_GET["randevu_id"]?>"}, function (res) {
                if (res != 1) {
                    var item = JSON.parse(res);
                    let randevu_tarih = item.randevu_tarih;
                    randevu_tarih = randevu_tarih.split(" ");
                    randevu_tarih = randevu_tarih[0];
                    randevu_tarih = randevu_tarih.split("-");
                    let gun = randevu_tarih[2];
                    let ay = randevu_tarih[1];
                    let yil = randevu_tarih[0];
                    let arr = [gun, ay, yil];
                    randevu_tarih = arr.join("/");

                    $("#okul_adi").val(item.okul_adi);
                    $("#ogrtmn_adi").val(item.ogretmen_adi);
                    $("#kisi_sayisi").val(item.kisi_sayisi);
                    $("#cep_no").val(item.cep_no);
                    $("#mail_adress").val(item.mail_adress);
                    $("#randevu_tarih_main").val(randevu_tarih);
                    $("#saat_aralik").val(item.saat_aralik);
                }
            });

            flatpickr("#randevu_tarih_main", {
                dateFormat: "d/m/Y",
                minDate: "today",
                locale: {
                    weekdays: {
                        longhand: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                        shorthand: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt']
                    },
                    months: {
                        longhand: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                        shorthand: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara']
                    },
                    today: 'Bugün',
                    clear: 'Temizle'
                },
                disable: [
                    function (date) {
                        return (date.getDay() === 6 || date.getDay() === 0);
                    }
                    // function(date) {
                    //     // Burada randevu durumunu kontrol edin ve devre dışı bırakılacak tarihleri bulun
                    //     const randevuDoluTarihler = ["19/09/2023", "22/09/2023", "25/09/2023"];
                    //
                    //     // Seçilen tarihin formatını oluşturun
                    //     const selectedDate = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
                    //
                    //     // Eğer seçilen tarih randevu dolu tarihler arasında ise, tarihi devre dışı bırakın
                    //     if (randevuDoluTarihler.includes(selectedDate)) {
                    //         return true; // Devre dışı bırakılacak tarihleri döndürün
                    //     }
                    //     return false; // Etkin tarihleri döndürün
                    // }
                ],

            });

            $("#randevu_guncelle_modal").modal("show");

            $.get("controller/randevu_controller/sql.php?islem=randevu_kisi_bilgisi", {randevu_id: "<?=$_GET["randevu_id"]?>"}, function (res) {
                if (res != 2) {
                    var item = JSON.parse(res);
                    kisi_sayisi = item.kisi_sayisi;
                }
            })

            setTimeout(function () {
                $("#click12").trigger("click");
            }, 500);

            ogr_table = $('#ogr_list').DataTable({
                scrollY: '30vh',
                scrollX: true,
                autoWidth: false,
                searching: false,
                createdRow: function (row) {
                    $(row).addClass("ogr_table_selected");
                },
                columns: [
                    {"data": "ogr_adi"},
                    {"data": "ogr_tc"},
                    {"data": "button"},
                ],
                "paging": false,
                "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"},

            });
            $.get("../controller/randevu_controller/sql.php?islem=localdeki_kayitlar_sql", {randevu_id: "<?=$_GET["randevu_id"]?>"}, function (result) {
                if (result != 2) {
                    var json = JSON.parse(result);
                    var basilacak_arr = [];
                    json.forEach(function (item) {

                        let newRow = {
                            ogr_adi: item.ogr_adi,
                            ogr_tc: item.ogr_tc,
                            button: "<button class='btn btn-danger btn-sm ogr_sil_button' data-id='" + item.id + "'><i class='fa fa-trash'></i></button>",
                        };
                        basilacak_arr.push(newRow);
                    });
                    ogr_table.rows.add(basilacak_arr).draw(false);
                }
            })
        });

        $("body").off("change", "#randevu_tarih_main").on("change", "#randevu_tarih_main", function () {
            let val = $(this).val();
            val = val.split("/");
            let gun = val[0];
            let ay = val[1];
            let yil = val[2];
            let arr = [yil, ay, gun];
            val = arr.join("-");

            let kisi_sayisi = $("#kisi_sayisi").val();

            $.get("../controller/randevu_controller/sql.php?islem=uygun_randevu_varmi", {
                randevu_tarih: val,
                kisi_sayisi: kisi_sayisi
            }, function (res) {
                if (res != 1) {
                    Swal.fire(
                        "Uyarı!",
                        "Bu Tarih Uygun Değildir Lütfen Başka Bir Tarih Seçiniz...",
                        "warning"
                    );
                    var nextDay = new Date(val);
                    nextDay.setDate(nextDay.getDate() + 1);

                    // Sonucu y-m-d formatında alın
                    var nextDayFormatted = formatDate(nextDay);
                    $("#randevu_tarih_main").val(nextDayFormatted);
                }
            });
        });

        function formatDate(date) {
            var yyyy = date.getFullYear();
            var mm = String(date.getMonth() + 1).padStart(2, '0'); // Ay 0'dan başlar
            var dd = String(date.getDate()).padStart(2, '0');
            return dd + '/' + mm + '/' + yyyy;
        }

        $("body").off("click", "#listeye_ogr_ekle").on("click", "#listeye_ogr_ekle", function () {
            let ogr_adi = $("#ogr_adi").val();
            let tc = $("#ogr_tc").val();
            let count = ogr_table.rows().count();
            count = count + 1;
            if (count <= kisi_sayisi) {
                $.ajax({
                    url: "../controller/randevu_controller/sql.php?islem=randevuya_ogr_ekle_sql",
                    type: "POST",
                    data: {
                        ogr_adi: ogr_adi,
                        ogr_tc: tc,
                        randevu_id: "<?=$_GET["randevu_id"]?>",
                        saat_aralik: "<?=$_GET["saat_aralik"]?>"
                    },
                    success: function (result) {
                        if (result != 2) {
                            if (result == 300) {
                                Swal.fire(
                                    "Uyarı!",
                                    "Bu Öğrenci Listede Mevcut",
                                    "warning"
                                );
                            } else {
                                var id = result;
                                id = id.split(":");
                                id = id[1];
                                var basilacak = [];
                                let newRow = {
                                    ogr_adi: ogr_adi,
                                    ogr_tc: tc,
                                    button: "<button class='btn btn-danger btn-sm ogr_sil_button' data-id='" + id + "'><i class='fa fa-trash'></i></button>"
                                };
                                basilacak.push(newRow);
                                ogr_table.rows.add(basilacak).draw(false);
                                $("#ogr_adi,#ogr_tc").val("");
                                $("#ogr_adi").focus();
                            }
                        }
                    }
                })
            } else {
                Swal.fire(
                    "Uyarı",
                    "Belirttiğiniz Kişi Sayısından Fazla Kişi Giremezsiniz Randevunuz Kaydedilmiştir...",
                    "warning"
                );
                $("#randevu_guncelle_modal").modal("hide");
            }

        });

        $("body").off("click", "#modal_kapat").on("click", "#modal_kapat", function () {
            $("#randevu_guncelle_modal").modal("hide");
        });

    </script>
    <?php
}