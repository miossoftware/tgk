<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>RANDEVU TANIMLARI</div>
        </div>
        <div class="col-md-12 row no-gutters">
            <div class="col-md-2">
                <button class="btn btn-success btn-sm" id="randevu_tanimlari_button"><i class="fa fa-check"></i> Randevu Tanımla</button>
            </div>
        </div>
        <div class="col-12 row">
            <div class="col-12 row mt-5">
                <table class="table table-sm table-bordered w-100 display datatable nowrap"
                       style="cursor:pointer;font-size: 13px;"
                       id="ziyaretci_listesi_table">
                    <thead>
                    <tr>
                        <th>Seçilen Yıl / Ay</th>
                        <th>Seanslar</th>
                        <th>Kişi Sayısı</th>
                        <th style="width: 0% !important;">İşlem</th>
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
            columnDefs: [
                {targets: 1, type: "date-eu"}
            ],
            order: [[1, 'desc']],
            columns: [
                {"data": "secilen_ayil"},
                {"data": "seanslar"},
                {"data": "kisi_sayisi"},
                {"data": "islem"}
            ],
            rowCallback: function (row, data) {
                $(row).attr("data-id", data.id)
                $(row).addClass("randevu_select");
            },
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
            }
        });

        $.get("../controller/tanim_controller/sql.php?islem=tanimlanan_seanslari_getir_sql", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                table.rows.add(json).draw(false);
            }
        })

    });

    $("body").off("click", ".seans_tanimi_sil_button").on("click", ".seans_tanimi_sil_button", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: 'Silme Nedeni Giriniz...',
            input: 'text',
            inputPlaceholder: 'Silme Nedeni',
            showCancelButton: true,
            confirmButtonText: 'Tamam',
            cancelButtonText: 'İptal',
            allowOutsideClick: false,
            inputValidator: (value) => {
                if (!value) {
                    return 'Silme Nedeni Boş Bırakılamaz';
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const delete_detail = result.value;
                $.ajax({
                    url: "../controller/tanim_controller/sql.php?islem=seans_sil_sql",
                    type: "POST",
                    data: {
                        id: id,
                        delete_detail: delete_detail
                    },
                    success: function (res) {
                        if (res == 1) {
                            Swal.fire(
                                "Başarılı",
                                "Seans Silindi",
                                "success"
                            );
                            $.get("../view/randevu_tanimlari.php", function (getList) {
                                $(".modal-icerik").html("");
                                $(".modal-icerik").html(getList);
                            });
                        }
                    }
                });
            }
        });
    });


    $("body").off("click", "#randevu_tanimlari_button").on("click", "#randevu_tanimlari_button", function () {
        $.get("../modals/tanim_modal/randevu_tanimlari.php?islem=randevu_tanimlari_modal", function (getModal) {
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