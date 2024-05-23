<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>GELEN ZİYARETÇİLERİN LİSTESİ</div>
        </div>
        <div class="col-12 row">
            <div class="col-12 row mt-5">
                <table class="table table-sm table-bordered w-100 display datatable nowrap"
                       style="cursor:pointer;font-size: 13px;"
                       id="ziyaretci_listesi_table">
                    <thead>
                    <tr>
                        <th>Randevu Tarihi</th>
                        <th>Kurum Adı</th>
                        <th>Kişi Sayısı</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <th>Toplam Okul</th>
                    <th class="tot_okul">0</th>
                    <th>Toplam Kişi <span class="tot_kisi"></span></th>
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
            "paging": false,
            columnDefs: [
                {targets: 1, type: "date-eu"}
            ],
            order: [[1, 'desc']],
            columns: [
                {"data": "randevu_tarih"},
                {"data": "kurum_adi"},
                {"data": "kisi_sayisi"}
            ],
            rowCallback: function (row, data) {
                $(row).attr("data-id", data.id)
                $(row).addClass("randevu_select");
            },
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
            }
        });
        $.get("../controller/randevular_controller/sql.php?islem=gelen_kurumlar_controller", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                let basilacak_arr = [];
                let toplam_kisi_sayisi = 0;
                let toplam_okul = 0;
                json.forEach(function (item) {

                    let tarih = item.talep_tarihi;

                    let kisi_sayisi = item.kisi_sayisi;
                    kisi_sayisi = parseFloat(kisi_sayisi);
                    toplam_kisi_sayisi += kisi_sayisi;
                    toplam_okul += 1;

                    let newRow = {
                        'randevu_tarih': tarih,
                        'kurum_adi': item.kurum_adi,
                        'kisi_sayisi': item.kisi_sayisi,
                    };
                    basilacak_arr.push(newRow);
                });

                $(".tot_kisi").html(toplam_kisi_sayisi);
                $(".tot_okul").html(toplam_okul);
                table.rows.add(basilacak_arr).draw(false);
            }
        })
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