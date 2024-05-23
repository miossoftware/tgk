<table class="table table-sm table-bordered w-100 display nowrap" id="randevu_list_table" style="font-size: 13px;">
    <thead>
    <tr style="background-color: white">
        <th>Zaman Aralığı</th>
        <th>Boş Kontenjan</th>
        <th>Grafik</th>
        <th>İşlem</th>
    </tr>
    </thead>
</table>

<script>
    $(document).ready(function () {
        var table = $('#randevu_list_table').DataTable({
            paging: false,
            scrollY: "35vh",
            scrollX: true,
            searching: false,
            "info": false,
            createdRow: function (row) {
                $(row).addClass("stok_list_selected");
            },
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"},
        });

        $.get("controller/randevu_controller/sql.php?islem=randevu_infos", {
            tarih: "<?=$_GET["randevu_tarih"]?>",
            randevu_id: "<?=$_GET["randevu_id"]?>"
        }, function (result) {
            if (result != 2) {
                var json = JSON.parse(result);
                json.forEach(function (item) {
                    let yuzde = item.kisi_sayisi
                    yuzde = parseFloat(yuzde);
                    let kontenjan = 120 - yuzde;
                    let dis = "";
                    if (kontenjan == 0) {
                        kontenjan = "Dolu";
                        dis = "disabled";
                    }
                    table.row.add([item.konferans_saat, kontenjan, '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuemax="120" style="width: ' + yuzde + '%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' " + dis + " data-time='" + item.saat_aralik + "'><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                })
            } else {
                table.row.add(["08:00-10:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=1><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                table.row.add(["10:00-12:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=2><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                table.row.add(["12:00-14:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=3><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                table.row.add(["16:00-16:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=4><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                table.row.add(["16:00-18:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=5><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                table.row.add(["18:00-20:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=6><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
                table.row.add(["20:00-22:00", "120", '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%"></div></div>', "<button class='btn btn-warning btn-sm randevu_ver' data-time=7><i class='fa fa-calendar'></i> Randevu Al</button>"]).draw(false);
            }
        })
    });

    $("body").off("click", "#kaydet_ve_bitir").on("click", "#kaydet_ve_bitir", function () {
        let randevu_id = $(this).attr("randevu_id");
        $.get("controller/randevu_controller/sql.php?islem=randevu_bilgileri", {randevu_id: randevu_id}, function (res) {
            if (res != 2) {
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

                if (item.saat_aralik == 1) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 08:00 - 10:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (item.saat_aralik == 2) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 10:00 - 12:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (item.saat_aralik == 3) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 12:00 - 14:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (item.saat_aralik == 4) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 14:00 - 16:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (item.saat_aralik == 5) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 16:00 - 18:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (item.saat_aralik == 6) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 18:00 - 20:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (item.saat_aralik == 7) {
                    Swal.fire({
                        title: 'Randevu Bilgileri',
                        text: "Randevunuz Başarı İle Oluşturulmuştur Randevu Bilgileriniz:" +
                            "Randevu Tarih:" + randevu_tarih + "" +
                            "Randevu Saat: 20:00 - 22:00",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'Tamam',
                        cancelButtonText: 'İptal',
                    }).then((result) => {
                        // Check if the user clicked the "Tamam" button
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }

            }
        })
    });

    $("body").off("click", ".randevu_ver").on("click", ".randevu_ver", function () {
        let saat_aralik = $(this).attr("data-time");
        let randevu_id = "<?=$_GET['randevu_id']?>";
        $.get("modals/ziyaretci_modal/ogrenci_randevu_ver_modal.php?islem=ogrenci_bilgi_giris_modal", {
            saat_aralik: saat_aralik,
            randevu_id: randevu_id
        }, function (getModals) {
            $(".getModals").html("");
            $(".getModals").html(getModals);
        })
    });

    $("body").off("click", "#randevudan_vazgec").on("click", "#randevudan_vazgec", function () {
        let randevu_id = "<?=$_GET["randevu_id"]?>";
        if (randevu_id != undefined || randevu_id != ""){
            $.ajax({
                url:"controller/randevu_controller/sql.php?islem=randevuyu_iptal_et_sql",
                type:"POST",
                data:{
                    randevu_id:randevu_id
                }
            });
        }
    });

</script>