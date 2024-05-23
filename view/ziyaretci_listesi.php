<style>
    .edit_list td {
        text-align: left;
    }

    .excel_alis {
        background-color: #2ecc71 !important;
        border-color: #27ad60 !important;
        color: white !important;
        border-radius: 20px !important;
        font-weight: bold !important;
    }
</style>
<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>RANDEVU TALEPLERİ</div>
        </div>
        <div class="col-12 row">
            <div class="col-12 row mt-5">
                <table class="table table-sm table-bordered w-100 display datatable"
                       style="cursor:pointer;font-size: 13px;"
                       id="ziyaretci_listesi_table">
                    <thead>
                    <tr>
                        <th>İl</th>
                        <th>İlçe</th>
                        <th>Okul Adı</th>
                        <th>Öğretmen Adı</th>
                        <th>Kişi Sayısı</th>
                        <th>Cep No</th>
                        <th>Mail Adresi</th>
                        <th>İstek Tarihleri</th>
                        <th>Sınıflar</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <th>Toplam Okul</th>
                    <th class="tot_okul">0</th>
                    <th></th>
                    <th>Toplam Kişi</th>
                    <th class="tot_kisi">0</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tfoot>
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
            "info": false,
            "paging": false,
            columnDefs: [
                {targets: 1, type: "date-eu"}
            ],
            order: [[1, 'desc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    title: "Ziyaretçi Listesi",
                    text: "<i class='fa fa-download'></i> Excel'e Aktar",
                    className: 'excel_alis', // Sınıfı burada tanımlayabilirsiniz
                }
            ],
            columns: [
                {"data": "il"},
                {"data": "ilce_adi"},
                {"data": "okul_adi"},
                {"data": "ogrtmn_adi"},
                {"data": "kisi_sayisi"},
                {"data": "cep_no"},
                {"data": "mail_adres"},
                {"data": "button"},
                {"data": "siniflar"},
                {"data": "islem"},
            ],
            rowCallback: function (row, data) {
                $(row).attr("data-id", data.id)
                $(row).addClass("randevu_select");
            },
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
            }
        });

        $.get("../controller/randevu_controller/sql.php?islem=tum_randevulari_getir_sql", function (result) {
            if (result != 2) {
                var json = JSON.parse(result);
                var basilacak_arr = [];
                let toplam_kisi_sayisi = 0;
                let toplam_okul = 0;
                json.forEach(function (item) {
                    toplam_okul += 1;
                    let musait_tarihler = item.musait_tarihler;
                    musait_tarihler = musait_tarihler.split("\n");
                    let tarihler = "";
                    musait_tarihler.forEach(function (item2) {
                        tarihler += item2 + "<br>";
                    })
                    let siniflar = item.siniflar;
                    siniflar = siniflar.split(",");
                    let siniflar_bas = "";
                    siniflar.forEach(function (item2) {
                        siniflar_bas += item2 + "<br>";
                    })
                    let kisi_sayisi = item.kisi_sayisi;
                    kisi_sayisi = parseFloat(kisi_sayisi);
                    toplam_kisi_sayisi += kisi_sayisi;
                    let newRow = {
                        il: item.il,
                        ilce_adi: item.ilce_adi,
                        okul_adi: item.okul_adi,
                        ogrtmn_adi: item.ogretmen_adi,
                        kisi_sayisi: item.kisi_sayisi,
                        cep_no: item.cep_no,
                        mail_adres: item.mail_adress,
                        siniflar: siniflar_bas,
                        button: tarihler,
                        islem: "<button class='btn btn-danger btn-sm randevu_iptal_et_list_button' data-id='" + item.id + "'><i class='fa fa-trash'></i></button>",
                        id: item.id
                    };
                    basilacak_arr.push(newRow);
                })
                $(".tot_kisi").html(toplam_kisi_sayisi);
                $(".tot_okul").html(toplam_okul);
                table.rows.add(basilacak_arr).draw(false);
            }
        })
    });

    $("body").off("click", ".randevuyu_onayla").on("click", ".randevuyu_onayla", function () {
        let id = $(this).attr("data-id");
        $.ajax({
            url: "../controller/randevu_controller/sql.php?islem=randevuyu_onayla_sql",
            type: "POST",
            data: {
                id: id,
            },
            success: function (res) {
                if (res == 1) {
                    Swal.fire(
                        "Başarılı",
                        "Randevu Onaylandı",
                        "success"
                    );
                    $.get("../view/ziyaretci_listesi.php", function (getList) {
                        $(".modal-icerik").html(getList);
                    });
                }
            }
        })
    });

    $("body").off("dblclick", ".randevu_select").on("dblclick", ".randevu_select", function () {
        let id = $(this).attr("data-id");
        $(".randevu_select").removeClass("selected");
        $(this).addClass("selected");
        $.get("../modals/kullanici_modal/ogrenci_list.php", {randevu_id: id}, function (getModal) {
            $(".getModals").html("");
            $(".getModals").html(getModal);
        })
    });
    $("body").off("click", ".randevu_guncelle_main_button").on("click", ".randevu_guncelle_main_button", function () {
        let id = $(this).attr("data-id");
        $(".randevu_select").removeClass("selected");
        $(this).addClass("selected");
        $.get("../modals/kullanici_modal/randevu_guncelle.php?islem=randevu_guncelle_sql", {randevu_id: id}, function (getModal) {
            $(".getModals").html("");
            $(".getModals").html(getModal);
        })
    });

    $("body").off("click", ".randevu_iptal_et_list_button").on("click", ".randevu_iptal_et_list_button", function () {
        let id = $(this).attr("data-id");
        $.ajax({
            url: "../controller/randevu_controller/sql.php?islem=randevuyu_iptal_et_sql",
            type: "POST",
            data: {
                randevu_id: id
            },
            success: function (res) {
                if (res == 1) {
                    Swal.fire(
                        "Başarılı",
                        "Randevu İptal Edildi",
                        "success"
                    );
                    $.get("../view/ziyaretci_listesi.php", function (getList) {
                        $(".modal-icerik").html("");
                        $(".modal-icerik").html(getList);
                    });
                }
            }
        })
    });
    $("body").off("click", "#yeni_randevu_ver_button").on("click", "#yeni_randevu_ver_button", function () {
        $.get("../modals/kullanici_modal/randevu_olustur.php?islem=ogr_randevu_ver_modal", function (getModal) {
            $(".getModals").html("");
            $(".getModals").html(getModal);
        })
    });
</script>