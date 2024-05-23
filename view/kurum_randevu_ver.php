<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>KULLANICI OLUŞTURMA İSTEKLERİ</div>
        </div>
        <div class="col-md-12 row">
            <div class="mt-2"></div>
            <div class="col">
                <input type="text" class="form-control form-control-sm" placeholder="Başlangıç Tarih"
                       onfocus="(this.type='date')" id="bas_tarih">
            </div>
            <div class="col">
                <input type="text" class="form-control form-control-sm" placeholder="Bitiş Tarih"
                       onfocus="(this.type='date')" id="bit_tarih">
            </div>
            <div class="col">
                <input type="text" class="form-control form-control-sm" placeholder="Yetkili Adı" id="yetkili_adi">
            </div>
            <div class="col">
                <input type="text" class="form-control form-control-sm" placeholder="Cep No" id="cep_no">
            </div>
            <div class="col">
                <input type="text" class="form-control form-control-sm" placeholder="Kurum Adı" id="kurum_adi">
            </div>
            <div class="col">
                <select class="custom-select custom-select-sm" id="arac_istegi">
                    <option value="">Araç İsteği...</option>
                    <option value="">Ulaşım İstiyorum</option>
                    <option value="">Ulaşım İstemiyorum</option>
                </select>
            </div>
            <div class="col">
                <button class="btn btn-secondary btn-sm" id="kullanici_talep_filtrele"><i class="fa fa-filter"></i>
                    Hazırla
                </button>
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="col-md-2">
            <button class="btn btn-success btn-sm" id="export_excel"><i class="fa fa-file"></i> Excel'e Aktar</button>
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
            searching: false,
            columnDefs: [
                {targets: 1, type: "date-eu"}
            ],
            order: [[1, 'desc']],
            columns: [
                {"data": "talep_tarihi"},
                {"data": "yetkili_adi"},
                {"data": "cep_no"},
                {"data": "kurum_adi"},
                {"data": "arac_istegi"},
                {"data": "islem"},
            ],
            rowCallback: function (row, data) {
                if (data.status == 2) {
                    $(row).find("td").css("background-color", "#A1DD70");
                }
                if (data.status == 0) {
                    $(row).find("td").css("background-color", "#EE4E4E");
                    $(row).find("td").css("color", "white");
                }
                $(row).attr("data-id", data.id);
                $(row).addClass("randevu_select");
            },
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
            }
        });

        $.get("../controller/randevular_controller/sql.php?islem=randevu_taleplerini_getir_sql", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                $(".arac_istekleri").html(json[0]["arac_istekleri"]);
                $(".tot_kisi").html(json[0]["toplam_kisi"]);
                $(".tot_okul").html(json[0]["toplam_kurum"]);
                table.rows.add(json).draw(false);
            }
        });

        $("body").off("click", "#kullanici_talep_filtrele").on("click", "#kullanici_talep_filtrele", function () {
            let bas_tarih = $("#bas_tarih").val();
            let bit_tarih = $("#bit_tarih").val();
            let yetkili_adi = $("#yetkili_adi").val();
            let cep_no = $("#cep_no").val();
            let kurum_adi = $("#kurum_adi").val();
            let arac_istegi = $("#arac_istegi").val();

            $.get("../controller/randevular_controller/sql.php?islem=randevu_taleplerini_getir_sql", {
                bas_tarih: bas_tarih,
                yetkili_adi: yetkili_adi,
                cep_no: cep_no,
                bit_tarih: bit_tarih,
                kurum_adi: kurum_adi,
                arac_istegi: arac_istegi
            }, function (res) {
                if (res != 2) {
                    var json = JSON.parse(res);
                    table.clear().draw(false);
                    $(".arac_istekleri").html(json[0]["arac_istekleri"]);
                    $(".tot_kisi").html(json[0]["toplam_kisi"]);
                    $(".tot_okul").html(json[0]["toplam_kurum"]);
                    table.rows.add(json).draw(false);
                }
            });
        });

    });

    $("body").off("click", "#export_excel").on("click", "#export_excel", function () {
        const table = document.getElementById("ziyaretci_listesi_table");
        const wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
        XLSX.writeFile(wb, "KULLANICILIK İSTEKLERİ.xlsx");
    });

    $("body").off("click", ".talebi_reddet").on("click", ".talebi_reddet", function () {
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
                    url: "../controller/randevular_controller/sql.php?islem=gelen_talebi_reddet",
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
                                url: "../controller/send_sms.php?islem=tekil_sms_yolla_sql",
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

    $("body").off("click", ".kullaniciyi_olustur_button").on("click", ".kullaniciyi_olustur_button", function () {
        let id = $(this).attr("data-id");
        const {value: formValues} = Swal.fire({
            title: "Kullanıcı Bilgileri",
            html: `
    <input id="swal-input1" placeholder="Kullanıcı Adı" class="swal2-input">
    <input id="swal-input2" placeholder="Şifre" class="swal2-input">`,
            focusConfirm: false,
            preConfirm: () => {
                let kullanici_adi = $("#swal-input1").val();
                let sifre = $("#swal-input2").val();
                $.ajax({
                    url: "../controller/randevular_controller/sql.php?islem=kullanici_adi_sifreleri_olustur_sql",
                    type: "POST",
                    data: {
                        id: id,
                        username: kullanici_adi,
                        password: sifre
                    },
                    success: function (res) {
                        if (res == 1) {
                            Swal.fire(
                                "Başarılı!",
                                "Kullanıcı Oluşturuldu",
                                "success"
                            );
                            $.ajax({
                                url: "../controller/send_sms.php?islem=kullanici_sms_yolla_sql",
                                type: "POST",
                                data: {
                                    id: id,
                                    kullanici_adi: kullanici_adi,
                                    sifre: sifre
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