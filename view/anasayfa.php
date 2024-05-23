<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>ANASAYFA</div>
        </div>
        <div class="col-12 row">
            <div class="col-3">
                <div class="card" style="box-shadow: 2px 2px 2px 2px gray;background-color: black;color: white">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-user fa-lg"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize" style="font-weight: bold">Aylık Randevu Sayısı</p>
                            <h4 class="mb-0" id="aylik_randevu">0</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="box-shadow: 2px 2px 2px 2px gray;background-color: #FF597B;color: white">
                    <div class="card-header p-3 pt-2" style="font-weight: bold">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-user fa-lg"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Haftalık Randevu</p>
                            <h4 class="mb-0" id="haftalik_randevu">0</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="box-shadow: 2px 2px 2px 2px gray;background-color: #82CD47;color: white">
                    <div class="card-header p-3 pt-2" style="font-weight: bold">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-user fa-lg"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Günlük Ziyaretçi Sayısı</p>
                            <h4 class="mb-0" id="gunluk_kisi">0</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="box-shadow: 2px 2px 2px 2px gray;background-color: #3085C3;color: white">
                    <div class="card-header p-3 pt-2" style="font-weight: bold">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-user fa-lg"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Toplam Ziyaretçi Sayısı:</p>
                            <h4 class="mb-0" id="total_ziyaretci">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 row mt-5">
            <div class="col-6">
                <span style="font-weight: bold; font-size: 15px">Seans Doluluk Oranı</span>
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="my_first_chart" class="chart-canvas" height="212"
                                style="display: block; box-sizing: border-box; height: 170px; width: 352.7px;"
                                width="440"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <span style="font-weight: bold; font-size: 15px">Seans Boşluk Oranı</span>
                <canvas id="my_second_chart"></canvas>
            </div>
        </div>
        <div class="col-12 row">
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
                    <th>İşlem</th>
                </tr>
                </thead>
            </table>
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
                json.forEach(function (item) {
                    let musait_tarihler = item.musait_tarihler;
                    musait_tarihler = musait_tarihler.split("\n");
                    let tarihler = "";
                    musait_tarihler.forEach(function (item2) {
                        tarihler += item2 + "<br>";
                    })
                    let newRow = {
                        il: item.il,
                        ilce_adi: item.ilce_adi,
                        okul_adi: item.okul_adi,
                        ogrtmn_adi: item.ogretmen_adi,
                        kisi_sayisi: item.kisi_sayisi,
                        cep_no: item.cep_no,
                        mail_adres: item.mail_adress,
                        button: tarihler,
                        islem: "<button class='btn btn-danger btn-sm randevu_iptal_et_list_button' data-id='" + item.id + "'><i class='fa fa-trash'></i></button>",
                        id: item.id
                    };
                    basilacak_arr.push(newRow);
                })
                table.rows.add(basilacak_arr).draw(false);
            }
        })
        $.get("../controller/grafik_controller/sql.php?islem=grafikleri_cek_sql", function (result) {
            if (result != 2) {
                var json = JSON.parse(result);
                json.forEach(function (item) {
                    $("#aylik_randevu").html(item.toplam_randevu)
                    $("#haftalik_randevu").html(item.toplam_randevu)
                    $("#gunluk_kisi").html(item.gunluk_kisi)
                    $("#total_ziyaretci").html(item.total_ziyaretci)
                });
            }
        });

        $.get("../controller/grafik_controller/sql.php?islem=gunluk_dolu_seans", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                var arr = json.map(function (item) {
                    return item.toplam_kisi;
                });
                var arr2 = json.map(function (item) {
                    let bos = item.toplam_kisi;
                    bos = parseFloat(bos);
                    bos = 120 - bos;
                    return bos;
                });
                var ctx = document.getElementById("my_first_chart").getContext("2d");
                var data = {
                    labels: ["09:00 - 11:00", "11:00 - 13:00", "13:00 - 15:00"],
                    datasets: [
                        {
                            data: arr,
                            backgroundColor: [
                                '#C63D2F',
                                '#FFB000',
                                '#7091F5'
                            ],
                            borderWidth: 2,
                        },
                    ],
                };
                var myChart = new Chart(ctx, {
                    type: "doughnut",
                    data: data,
                });
                var bosluk_ctx = document.getElementById("my_second_chart").getContext("2d");


                var bosluk_data = {
                    labels: ["09:00 - 11:00", "11:00 - 13:00", "13:00 - 15:00"],
                    datasets: [
                        {
                            data: arr2,
                            backgroundColor: [
                                '#C63D2F',
                                '#FFB000',
                                '#7091F5'
                            ],
                        },
                    ],
                };

                // Create the chart
                var myChart1 = new Chart(bosluk_ctx, {
                    type: "doughnut",
                    data: bosluk_data,
                });
            }
        })


    })
</script>