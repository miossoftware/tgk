<div class="modal fade" id="ogr_bilgi_girisi_modal" data-backdrop="static"
     data-bs-keyboard="false" role="dialog">
    <div class="modal-dialog modal-sm"
         style="width: 50%; max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header text-white p-2">
                <button type="button" class="btn-close btn-close-white modal_kapali" id="modal_kapat"
                        aria-label="Close"></button>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head" style='background-color:#9DB2BF'>
                        <div class="ibox-title" style='color:white; font-weight:bold;'>ÖĞRENCİ BİLGİLERİ GİRİŞ</div>
                    </div>
                    <div class="modal-body" style="max-height: 75vh; overflow: auto;">
                        <div class="col-12 row">
                            <table class="table table-sm table-bordered w-100 display nowrap"
                                   style="cursor:pointer;font-size: 13px;"
                                   id="ogr_list">
                                <thead>
                                <tr>
                                    <th id="click12">Öğrenci Adı</th>
                                    <th>Tc Kimlik</th>
                                    <th style="width: 0% !important;">İşlem</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-sm" id="kaydet_button"><i class="fa fa-check"></i> Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var kisi_sayisi = 0;
    var ogr_table = ""

    $("body").off("click", "#kaydet_button").on("click", "#kaydet_button", function () {
        $("#ogr_bilgi_girisi_modal").modal("hide");
    });

    $(document).ready(function () {
        $("#ogr_bilgi_girisi_modal").modal("show");

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
            $("#ogr_bilgi_girisi_modal").modal("hide");
        }

    });

    $("body").off("click", "#modal_kapat").on("click", "#modal_kapat", function () {
        $("#ogr_bilgi_girisi_modal").modal("hide");
    });

    $("body").off("click", ".ogr_sil_button").on("click", ".ogr_sil_button", function () {
        let id = $(this).attr("data-id");
        let closest = $(this).closest("tr");
        $.ajax({
            url: "../controller/randevu_controller/sql.php?islem=ogr_sil_sql",
            type: "POST",
            data: {
                id: id
            },
            success: function (res) {
                if (res == 1) {
                    ogr_table.row(closest).remove().draw(false);
                }
            }
        });
    });

</script>