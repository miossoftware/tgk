<?php

$islem = $_GET["islem"];

if ($islem == "randevu_tanimlari_modal") {
    ?>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <div class="modal fade" id="kullanici_olustur_modal" data-backdrop="static"
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
                            <div class="ibox-title" style='color:white; font-weight:bold;'>RANDEVU TANIMLARI</div>
                        </div>
                        <div class="modal-body" style="max-height: 75vh; overflow: auto;">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Yıl / Ay</label>
                                </div>
                                <div class="col-md-7 row no-gutters">
                                    <div class="col">
                                        <input type="number" class="form-control form-control-sm" id="yil">
                                    </div>
                                    <div class="col">
                                        <select class="custom-select custom-select-sm" id="ay">
                                            <option value="Ocak">Ocak</option>
                                            <option value="Şubat">Şubat</option>
                                            <option value="Mart">Mart</option>
                                            <option value="Nisan">Nisan</option>
                                            <option value="Mayıs">Mayıs</option>
                                            <option value="Haziran">Haziran</option>
                                            <option value="Temmuz">Temmuz</option>
                                            <option value="Ağustos">Ağustos</option>
                                            <option value="Eylül">Eylül</option>
                                            <option value="Ekim">Ekim</option>
                                            <option value="Kasım">Kasım</option>
                                            <option value="Aralık">Aralık</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-sm table-bordered w-100 display nowrap" id="randevu_tanim_listesi"
                                   style="font-size: 13px;padding: 0">
                                <thead>
                                <tr>
                                    <th id="saat_click1">Saat Aralık</th>
                                    <th>Kapasite</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <select class="custom-select custom-select-sm col-3"
                                                        style="width: 30% !important;" id="">
                                                    <option value="00:00">00:00</option>
                                                    <option value="01:00">01:00</option>
                                                    <option value="02:00">02:00</option>
                                                    <option value="03:00">03:00</option>
                                                    <option value="04:00">04:00</option>
                                                    <option value="05:00">05:00</option>
                                                    <option value="06:00">06:00</option>
                                                    <option value="07:00">07:00</option>
                                                    <option value="08:00">08:00</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="22:00">22:00</option>
                                                    <option value="23:00">23:00</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="custom-select custom-select-sm col-9"
                                                        style="width: 30% !important;" id="">
                                                    <option value="00:00">00:00</option>
                                                    <option value="01:00">01:00</option>
                                                    <option value="02:00">02:00</option>
                                                    <option value="03:00">03:00</option>
                                                    <option value="04:00">04:00</option>
                                                    <option value="05:00">05:00</option>
                                                    <option value="06:00">06:00</option>
                                                    <option value="07:00">07:00</option>
                                                    <option value="08:00">08:00</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="22:00">22:00</option>
                                                    <option value="23:00">23:00</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input type="number" class="form-control  col-9"></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm randevu_seans_sil"><i
                                                    class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm randevu_seans_ekle"
                                                style="color:white;background-color: #2C7865"><i
                                                    class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" id="modal_kapat"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="seans_kaydet_button"><i
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
            $("#kullanici_olustur_modal").modal("show");

            setTimeout(function () {
                $("#saat_click1").trigger("click");
            }, 500);

            var table = $('#randevu_tanim_listesi').DataTable({
                paging: false,
                scrollY: "35vh",
                scrollX: true,
                searching: false,
                "info": false,
                columns: [
                    {'data': 'saat_aralik'},
                    {'data': 'seans'},
                    {'data': 'islem'},
                ],
                createdRow: function (row) {
                    $(row).addClass("randevu_seans_list");
                },
                "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"},
            });

            $("body").off("click", ".randevu_seans_ekle").on("click", ".randevu_seans_ekle", function () {
                let arr = [];
                let today = new Date();
                today = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
                let newRow = {
                    saat_aralik: "" +
                        "<div class='row no-gutters'>" +
                        "<div class='col'>" +
                        "<select class='custom-select custom-select-sm col-9' style='width: 30% !important;'>" +
                        "<option value='00:00'>00:00</option>" +
                        "<option value='01:00'>01:00</option>" +
                        "<option value='02:00'>02:00</option>" +
                        "<option value='03:00'>03:00</option>" +
                        "<option value='04:00'>04:00</option>" +
                        "<option value='05:00'>05:00</option>" +
                        "<option value='06:00'>06:00</option>" +
                        "<option value='07:00'>07:00</option>" +
                        "<option value='08:00'>08:00</option>" +
                        "<option value='09:00'>09:00</option>" +
                        "<option value='10:00'>10:00</option>" +
                        "<option value='11:00'>11:00</option>" +
                        "<option value='12:00'>12:00</option>" +
                        "<option value='13:00'>13:00</option>" +
                        "<option value='14:00'>14:00</option>" +
                        "<option value='15:00'>15:00</option>" +
                        "<option value='16:00'>16:00</option>" +
                        "<option value='17:00'>17:00</option>" +
                        "<option value='18:00'>18:00</option>" +
                        "<option value='19:00'>19:00</option>" +
                        "<option value='20:00'>20:00</option>" +
                        "<option value='21:00'>21:00</option>" +
                        "<option value='22:00'>22:00</option>" +
                        "<option value='23:00'>23:00</option>" +
                        "</select></div>" +
                        "<div class='col'>" +
                        "<select class='custom-select custom-select-sm col-9' style='width: 30% !important;'>" +
                        "<option value='00:00'>00:00</option>" +
                        "<option value='01:00'>01:00</option>" +
                        "<option value='02:00'>02:00</option>" +
                        "<option value='03:00'>03:00</option>" +
                        "<option value='04:00'>04:00</option>" +
                        "<option value='05:00'>05:00</option>" +
                        "<option value='06:00'>06:00</option>" +
                        "<option value='07:00'>07:00</option>" +
                        "<option value='08:00'>08:00</option>" +
                        "<option value='09:00'>09:00</option>" +
                        "<option value='10:00'>10:00</option>" +
                        "<option value='11:00'>11:00</option>" +
                        "<option value='12:00'>12:00</option>" +
                        "<option value='13:00'>13:00</option>" +
                        "<option value='14:00'>14:00</option>" +
                        "<option value='15:00'>15:00</option>" +
                        "<option value='16:00'>16:00</option>" +
                        "<option value='17:00'>17:00</option>" +
                        "<option value='18:00'>18:00</option>" +
                        "<option value='19:00'>19:00</option>" +
                        "<option value='20:00'>20:00</option>" +
                        "<option value='21:00'>21:00</option>" +
                        "<option value='22:00'>22:00</option>" +
                        "<option value='23:00'>23:00</option>" +
                        "</select></div>" +
                        "</div>",
                    seans: "<input type='number' class='form-control col-9' />",
                    islem: "<button class='btn btn-danger btn-sm randevu_seans_sil'><i class='fa fa-trash'></i></button> <button class='btn btn-sm randevu_seans_ekle' style='color:white;background-color: #2C7865'><i class='fa fa-plus'></i></button>"
                };
                arr.push(newRow);
                table.rows.add(arr).draw(false);

                let newlyAddedRow = $('#randevu_tanim_listesi tbody tr:last');
                newlyAddedRow.find('select').first().focus();
            });


            $("body").off("click", ".randevu_seans_sil").on("click", ".randevu_seans_sil", function () {
                var row = table.row($(this).parents('tr'));
                let number = 0;
                $(".student_list_selected").each(function () {
                    number++;
                });
                if (number <= 1) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: 'Son Satırı Silemezsiniz...'
                    });
                } else {
                    row.remove().draw(false);
                }
            });

        });

        $("body").off("click", "#modal_kapat").on("click", "#modal_kapat", function () {
            $("#kullanici_olustur_modal").modal("hide");
        });

        $("body").off("click", "#seans_kaydet_button").on("click", "#seans_kaydet_button", function () {
            let yil = $("#yil").val();
            let ay = $("#ay").val();

            let gidecek_arr = [];
            $(".randevu_seans_list").each(function () {
                let selects = $(this).find("td:eq(0) select");
                let first_select = selects[0];
                let first_time = $(first_select).find("option:selected").text();
                let second_select = selects[1];
                let second_time = $(second_select).find("option:selected").text();
                let kapasite = $(this).find("td:eq(1) input").val();
                let newRow = {
                    bas_saat: first_time,
                    bit_saat: second_time,
                    kapasite: kapasite
                };
                gidecek_arr.push(newRow);
            });

            if (yil == "") {
                Swal.fire(
                    "Uyarı!",
                    "Lütfen Yıl Belirtiniz...",
                    "warning"
                );
            } else if (ay == "") {
                Swal.fire(
                    "Uyarı!",
                    "Lütfen Ay Belirtiniz...",
                    "warning"
                );
            } else {
                $.ajax({
                    url: "../controller/tanim_controller/sql.php?islem=randevu_tanim_kaydet_sql",
                    type: "POST",
                    data: {
                        yil: yil,
                        ay: ay,
                        gidecek_arr: gidecek_arr
                    },
                    success: function (res) {
                        if (res == 1) {
                            Swal.fire(
                                "Başarılı!",
                                "Seans Başarı İle Kaydedildi",
                                "success"
                            );
                            $("#kullanici_olustur_modal").modal("hide");
                            $.get("../view/randevu_tanimlari.php", function (getList) {
                                $(".modal-icerik").html("");
                                $(".modal-icerik").html(getList);
                            });
                        }
                    }
                });
            }

        });
    </script>
    <?php
}