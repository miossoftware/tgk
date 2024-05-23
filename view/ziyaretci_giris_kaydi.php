<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>ZİYARETÇİ GİRİŞ KAYDI</div>
        </div>
        <div class="col-12 row no-gutters">
            <div class="col-md-2">
                <button class="btn btn-success btn-sm" id="ziyaretci_kaydi_button">
                    <i class="fa fa-check"></i> Ziyaretçi Kaydı
                </button>
            </div>
        </div>
        <div class="col-12 row">
            <table class="table table-sm table-bordered w-100 display nowrap" id="anlik_ziyaretci_list"
                   style="font-size: 13px;">
                <thead>
                <tr style="background-color: white">
                    <th>TC</th>
                    <th>Ad Soyad</th>
                    <th>Tel</th>
                    <th>İl</th>
                    <th>İlçe</th>
                    <th>Yetişkin Sayısı</th>
                    <th>Çocuk Sayısı</th>
                    <th>Adres</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tfoot>
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
<script>

    $(document).ready(function () {
        var table = $('#anlik_ziyaretci_list').DataTable({
            paging: false,
            scrollY: "55vh",
            scrollX: true,
            createdRow: function (row) {
                $(row).addClass("stok_list_selected");
            },
            columns: [
                {'data': "tc"},
                {'data': "ad_soyad"},
                {'data': "tel"},
                {'data': "il"},
                {'data': "ilce"},
                {'data': "yetiskin_sayisi"},
                {'data': "cocuk_sayisi"},
                {'data': "adres"},
                {'data': "islem"}
            ],
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"},
        });
        $.get("../controller/randevu_controller/sql.php?islem=anlik_randevular_sql", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                let basilacak_arr = [];
                let total = 0;
                json.forEach(function (item) {
                    let yetiskin = item.yetiskin_sayisi;
                    yetiskin = parseFloat(yetiskin);
                    let cocuk = item.cocuk_sayisi;
                    cocuk = parseFloat(cocuk);
                    total += yetiskin;
                    total += cocuk;
                    let newRow = {
                        tc: item.tc,
                        ad_soyad: item.ad_soyad,
                        tel: item.tel,
                        il: item.il,
                        ilce: item.ilce,
                        adres: item.adres,
                        yetiskin_sayisi: item.yetiskin_sayisi,
                        cocuk_sayisi: item.cocuk_sayisi,
                        islem: "<button class='btn btn-warning btn-sm ziyaretci_giris_guncelle_button' data-id='" + item.id + "'><i class='fa fa-refresh'></i></button> <button class='btn btn-danger btn-sm anlik_ziyaretci_sil_button' data-id='" + item.id + "'><i class='fa fa-trash'></i></button>"
                    };
                    $(".tot_kisi").html(total);
                    basilacak_arr.push(newRow);
                });
                table.rows.add(basilacak_arr).draw(false);
            }
        })
    });

    $("body").off("click", "#ziyaretci_kaydi_button").on("click", "#ziyaretci_kaydi_button", function () {
        $.get("../modals/admin_modal/ziyaretci_kaydi.php?islem=yeni_ziyaretci_kaydi_modal", function (getModal) {
            $(".getModals").html(getModal);
        })
    });

    $("body").off("click", ".ziyaretci_giris_guncelle_button").on("click", ".ziyaretci_giris_guncelle_button", function () {
        let id = $(this).attr("data-id");
        $.get("../modals/admin_modal/ziyaretci_kaydi.php?islem=yeni_ziyaretci_kaydi_guncelle_modal", {id: id}, function (getModal) {
            $(".getModals").html(getModal);
        })
    });

    $("body").off("click", ".anlik_ziyaretci_sil_button").on("click", ".anlik_ziyaretci_sil_button", function () {
        let id = $(this).attr("data-id");
        $.ajax({
            url: "../controller/randevu_controller/sql.php?islem=anlik_randevu_sil_sql",
            type: "POST",
            data: {
                id: id
            },
            success: function (res) {
                if (res == 1) {
                    Swal.fire(
                        "Başarılı",
                        "Ziyaretçi Girişi Silindi",
                        "success"
                    );
                    $.get("../view/ziyaretci_giris_kaydi.php", function (getList) {
                        $(".modal-icerik").html("");
                        $(".modal-icerik").html(getList);
                    });
                }
            }
        });
    });

</script>