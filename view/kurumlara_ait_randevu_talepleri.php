<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>KURUMLARA AİT RANDEVU TALEPLERİ</div>
        </div>
        <div class="col-md-12 row no-gutters">

            <div class="col-md-12 row ">
                <div class="mt-2"></div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" placeholder="Talep Tarihi" onfocus="(this.type='date')">
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" placeholder="Yetkili Adı">
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" placeholder="Cep No">
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" placeholder="Kurum Adı">
                </div>
                <div class="col">
                    <select class="custom-select custom-select-sm" id="">
                        <option value="">Araç İsteği...</option>
                        <option value="">Ulaşım İstiyorum</option>
                        <option value="">Ulaşım İstemiyorum</option>
                    </select>
                </div>
                <div class="col">
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-filter"></i> Hazırla</button>
                </div>
            </div>
            <div class="mt-3"></div>
            <div class="col-md-2">
                <button class="btn btn-success btn-sm" id="export_excel"><i class="fa fa-file"></i> Excel'e Aktar</button>
            </div>
        </div>
        <div class="col-12 row">
            <div class="col-12 row mt-5">
                <table class="table table-sm table-bordered w-100 display datatable nowrap"
                       style="cursor:pointer;font-size: 13px;"
                       id="ziyaretci_listesi_table">
                    <thead>
                    <tr>
                        <th>Talep Tarihi</th>
                        <th>Yetkili Adı</th>
                        <th>Cep No</th>
                        <th>Kurum Adı</th>
                        <th>Kişi Sayısı</th>
                        <th>Araç İsteği</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $("body").off("click","#export_excel").on("click","#export_excel",function (){
        const table = document.getElementById("ziyaretci_listesi_table");
        const wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
        XLSX.writeFile(wb, "RANDEVU TALEPLERİ.xlsx");
    });

    $(document).ready(function () {
        $.extend($.fn.dataTableExt.oSort, {
            "date-eu-pre": function (dateString) {
                var dateArray = dateString.split('/');
                var formattedDate = dateArray[2] + '-' + dateArray[1] + '-' + dateArray[0];
                return Date.parse(formattedDate) || 0;
            },

            "date-eu-asc": function (a, b) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },

            "date-eu-desc": function (a, b) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        });
        var table = $('#ziyaretci_listesi_table').DataTable({
            scrollX: true,
            scrollY: '50vh',
            "paging": false,
            columnDefs: [
                {targets: 1, type: "date-eu"}
            ],
            order: [[1, 'desc']],
            columns: [
                {"data": "talep_tarihi"},
                {"data": "yetkili_adi"},
                {"data": "cep_no"},
                {"data": "kurum_adi"},
                {"data": "kisi_sayisi"},
                {"data": "arac_istegi"},
                {"data": "islem"},
            ],
            rowCallback: function (row, data) {
                if (data.status == 2) {
                    $(row).find("td").css("background-color", "#A1DD70");
                }
                if (data.status == 0){
                    $(row).find("td").css("background-color", "#EE4E4E");
                    $(row).find("td").css("color", "white");
                }
                $(row).attr("data-id", data.id)
                $(row).addClass("randevu_select");
            },
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
            }
        });

        $.get("../controller/randevular_controller/sql.php?islem=randevu_taleplerini_getir_sql2", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                $(".arac_istekleri").html(json[0]["arac_istekleri"]);
                $(".tot_kisi").html(json[0]["toplam_kisi"]);
                $(".tot_okul").html(json[0]["toplam_kurum"]);
                table.rows.add(json).draw(false);
            }
        })

    });

    $("body").off("click", ".randevu_talebi_reddet").on("click", ".randevu_talebi_reddet", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: 'Red Nedenini Giriniz...',
            input: 'text',
            inputPlaceholder: 'Red Nedeni',
            showCancelButton: true,
            confirmButtonText: 'Tamam',
            cancelButtonText: 'İptal',
            allowOutsideClick: false,
            inputValidator: (value) => {
                if (!value) {
                    return 'Red Nedeni Boş Bırakılamaz';
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const delete_detail = result.value;
                $.ajax({
                    url: "../controller/randevular_controller/sql.php?islem=gelen_randevu_talebi_reddet",
                    type: "POST",
                    data: {
                        id: id,
                        delete_detail: delete_detail
                    },
                    success: function (res) {
                        if (res == 1) {
                            Swal.fire(
                                "Başarılı",
                                "Randevu Talebi Reddedildi",
                                "success"
                            );
                            $.ajax({
                                url: "../controller/send_sms.php?islem=randevu_red_sms_yolla_sql",
                                type: "POST",
                                data: {
                                    id: id
                                }
                            });
                            $.get("../view/kurum_randevu_ver.php", function (getList) {
                                $(".modal-icerik").html("");
                                $(".modal-icerik").html(getList);
                            });
                        }
                    }
                });
            }
        });
    });

    $("body").off("click", ".randevu_kabul_et_button").on("click", ".randevu_kabul_et_button", function () {
        let id = $(this).attr("data-id");
        let closest = $(this).closest("tr");
        let tarih = $(closest).find("td").eq(0).text();
        tarih = tarih.split("/");
        let y = tarih[2];
        let a = tarih[1];
        let g = tarih[0];
        let arr = [y, a, g];
        let saat = "T00:00";
        tarih = arr.join("-");
        let arr2 = [tarih, saat];
        tarih = arr2.join("");
        Swal.fire({
            title: 'Randevu Bilgilerini Giriniz',
            html:
                '<input id="randevu_saat" type="datetime-local" placeholder="Randevu Saati" value="' + tarih + '" class="swal2-input">' +
                '<input id="aciklama" type="text" placeholder="Mesaj Notu" class="swal2-input">',
            inputPlaceholder: 'Randevu Saati',
            inputValue: tarih,
            showCancelButton: true,
            confirmButtonText: 'Tamam',
            cancelButtonText: 'İptal',
            allowOutsideClick: false,
            inputValidator: (value) => {
                if (!value) {
                    return 'Randevu Saati Boş Kalamaz';
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                let randevu_tarih = $("#randevu_saat").val();
                let aciklama = $("#aciklama").val();
                $.ajax({
                    url: "../controller/randevular_controller/sql.php?islem=randevu_talebini_onayla_sql",
                    type: "POST",
                    data: {
                        id: id,
                        randevu_tarih: randevu_tarih
                    },
                    success: function (res) {
                        if (res == 1) {
                            Swal.fire(
                                "Başarılı",
                                "Randevu Talebi Onaylandı",
                                "success"
                            );
                            $.ajax({
                                url: "../controller/send_sms.php?islem=randevu_onay_mesaj_yolla",
                                type: "POST",
                                data: {
                                    id: id,
                                    aciklama:aciklama
                                }
                            });
                            $.get("../view/kurumlara_ait_randevu_talepleri.php", function (getList) {
                                $(".modal-icerik").html("");
                                $(".modal-icerik").html(getList);
                            });
                        }
                    }
                });
            }
        });
    });

    $("body").off("click", "#kurumlara_randevu_ver").on("click", "#kurumlara_randevu_ver", function () {
        $.get("../modals/admin_modal/randevu_ver.php?islem=kuruma_randevu_ver_modal", function (getModal) {
            $(".getModals").html(getModal);
        })
    });

    $("body").off("click", ".kurum_randevu_guncelle_button").on("click", ".kurum_randevu_guncelle_button", function () {
        let id = $(this).attr("data-id");
        $.get("../modals/admin_modal/randevu_ver.php?islem=kuruma_randevu_guncelle_modal", {id: id}, function (getModal) {
            $(".getModals").html(getModal);
        })
    });

</script>