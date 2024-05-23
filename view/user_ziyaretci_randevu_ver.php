<style>
    .randevu_card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-weight: bold;
        color: white;
        /* İstediğiniz stil ve içerik özelliklerini ekleyin */
    }

    :root {
        --fc-border-color: #2C7865;
        --fc-daygrid-event-dot-width: 3px;
    }

    .fc-toolbar-title {
        color: #481E14;
    }

    .fc-day-disabled {
        background-color: #FFAF45 !important;
    }

    .fc-day {
        background-color: #FFF5E0;
        color: #2C7865;
    }

    .fc-day-today {
        background-color: #ED9455;
    }

    .fc-button {
        background-color: #2C7865 !important;
    }
</style>
<div class="card-body" id="ziyaretci_randevu_degisken_div">
    <div class="row">
        <div class="col-6">
            <div class="col-md-12 row mt-5">
                <div id="calendar"></div>
                <div style="background-color: white;opacity: 90% !important;max-width:99% !important;">
                    <span style="font-weight: bold;font-size: 15px;color: black">
                    <button class="btn btn-sm" style="background-color: #FFAF45" disabled></button> RANDEVUYA KAPALI<br>
                </span>
                    <span style="font-weight: bold;font-size: 15px;color: black">
                    <button class="btn btn-sm" style="background-color: #FFF5E0" disabled></button> RANDEVUYA AÇIK
                </span>
                </div>
            </div>
        </div>
        <div class=" col-6 row mt-5" style="background-color: white;opacity: 90% !important;">
            <div class="card-header" style="color: #2C7865;font-weight: bold">
                Kurum Bilgileri
            </div>
            <div class="col-md-12 row mt-5">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>İl</label>
                    </div>
                    <div class="col-md-7">
                        <input disabled type="text" id="iller" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>İlçe</label>
                    </div>
                    <div class="col-md-7">
                        <input disabled type="text" id="ilceler" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Kurum Adı</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" id="kurum_adi" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Cep No</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" id="cep_no" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Yetkili Adı</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" id="yetkili_adi" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>E-Posta</label>
                    </div>
                    <div class="col-md-7">
                        <input type="email" required class="form-control form-control-sm" id="e_posta" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Ulaşım</label>
                    </div>
                    <div class="col-md-7">
                        <select class="custom-select custom-select-sm" id="ulasim_istiyorum">
                            <option value="Ulaşım İstemiyorum">Ulaşım İstemiyorum</option>
                            <option value="Ulaşım İstiyorum">Ulaşım İstiyorum</option>
                        </select>
                    </div>
                </div>
                <!--                <div class="col-md-2">-->
                <!--                    <button class="btn btn-sm" id="excel_button"-->
                <!--                            style="background-color: #2C7865;color: white;font-weight: bold"><i class="fa fa-file"></i>-->
                <!--                        Excel'den Aktar-->
                <!--                    </button>-->
                <!--                    <input type="file" hidden id="hidden_button"/>-->
                <!--                </div>-->
                <div class="col-12 row">
                    <table class="table table-sm table-bordered w-100 display nowrap" id="ogrenci_listesi"
                           style="font-size: 13px;padding: 0">
                        <thead>
                        <tr style="background-color: transparent;color: #2C7865">
                            <th>Ad Soyad</th>
                            <th>TC No</th>
                            <th>Doğum Tarihi</th>
                            <th>Yaş Grubu</th>
                            <th>Cinsiyet</th>
                            <th>Engel Durumu</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" class="form-control form-control-sm"></td>
                            <td><input type="text" class="form-control form-control-sm"></td>
                            <td><input type="date" value="<?= date("Y-m-d") ?>" class="form-control form-control-sm">
                            </td>
                            <td>
                                <select class="custom-select custom-select-sm" id="yas_grubu">
                                    <option value="">Seçiniz...</option>
                                    <option value="0-10">0-10</option>
                                    <option value="10-18">10-18</option>
                                    <option value="18-25">18-25</option>
                                    <option value="25+">25+</option>
                                </select>
                            </td>
                            <td>
                                <select class="custom-select custom-select-sm" id="">
                                    <option value="Erkek">Erkek</option>
                                    <option value="Kadın">Kadın</option>
                                </select>
                            </td>
                            <td>
                                <select class="custom-select custom-select-sm" id="">
                                    <option value="Var">Var</option>
                                    <option value="Yok" selected>Yok</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm remove_student"><i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-sm student_add_row"
                                        style="color:white;background-color: #2C7865"><i
                                            class="fa fa-plus"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="">
            <button class="btn btn-danger" id="randevudan_vazgec"><i class="fa fa-close"></i> Vazgeç
            </button>
        </a>
        <button class="btn btn-success" id="kurum_randevu_talep_olustur_button"
                style="background-color: #2C7865; color:white;" data-id=""><i
                    class="fa fa-arrow-right"></i> Talep Oluştur
        </button>
    </div>
</div>
<script>
    var talep_tarihi = "";
    $(document).ready(function () {
        var ayIsimleri = ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"];

// Ay isimlerini sayısal değerlere dönüştüren fonksiyon
        function ayAdiniSayisalDegerCevir(ayAdi) {
            if (ayAdi == "Ocak") {
                return "01";
            } else if (ayAdi == "Şubat") {
                return "02";
            } else if (ayAdi == "Mart") {
                return "03";
            } else if (ayAdi == "Nisan") {
                return "04";
            } else if (ayAdi == "Mayıs") {
                return "05";
            } else if (ayAdi == "Haziran") {
                return "06";
            } else if (ayAdi == "Temmuz") {
                return "07";
            } else if (ayAdi == "Ağustos") {
                return "08";
            } else if (ayAdi == "Eylül") {
                return "09";
            } else if (ayAdi == "Ekim") {
                return "10";
            } else if (ayAdi == "Kasım") {
                return "1";
            } else if (ayAdi == "Aralık") {
                return "12";
            }
        }

// Belirli bir ayın son gününü döndüren fonksiyon
        function ayinSonGunu(ay, yil) {
            return new Date(yil, ay, 0).getDate();
        }

        var calendarEl = document.getElementById('calendar');
        var lastClickedDayEl = null;
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "tr",
            header: {
                left: 'next today', // Burada "today" yerine "Bu Gün" kullanıyoruz
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Bu Gün', // Takvimdeki "Today" butonunun metnini değiştiriyoruz
                next: 'İleri', // Takvimdeki "Next" butonunun metnini değiştiriyoruz
                prev: 'Geri' // Takvimdeki "Prev" butonunun metnini değiştiriyoruz
            },
            events: function (info, successCallback, failureCallback) {
                // AJAX isteği burada yapılacak
                // Örnek olarak jQuery kullanarak AJAX isteği yapalım
                $.ajax({
                    url: '../controller/tanim_controller/sql.php?islem=uygun_randevulari_getir_sql',
                    type: 'GET',
                    success: function (res) {
                        let start = "";
                        let end = "";
                        start = new Date();
                        if (res != 2) {
                            var json = JSON.parse(res);
                            json.forEach(function (item) {
                                if ('yil' in item) {
                                    let yil = item.yil;
                                    let ay = ayAdiniSayisalDegerCevir(item.ay);
                                    let son_gun = ayinSonGunu(ay, yil);
                                    let tarih = yil + "-" + ay + "-" + son_gun;
                                    end = new Date(tarih);
                                }
                            });
                        }
                        calendar.setOption('validRange', {
                            start: start,
                            end: end
                        });
                    }
                });
            },
            customButtons: {
                prevButton: {
                    text: 'Önceki', // Buton metni
                    id: 'myPrevButton' // Butonun id değeri
                },
                nextButton: {
                    text: 'Sonraki', // Buton metni
                    id: 'myNextButton' // Butonun id değeri
                }
            },
            dateClick: function (info) {
                if (!info.dayEl.classList.contains('fc-disabled')) {
                    let click_date = info.date;
                    click_date = new Date(click_date);
                    let year = click_date.getFullYear();
                    let month = String(click_date.getMonth() + 1).padStart(2, '0');
                    let day = String(click_date.getDate()).padStart(2, '0');
                    click_date = year + '-' + month + '-' + day;
                    if (lastClickedDayEl) {
                        lastClickedDayEl.style.backgroundColor = ''; // Önceki tıklamanın rengini kaldır
                    }
                    info.dayEl.style.backgroundColor = 'lightblue'; // Yeni tıklamanın rengini ayarla
                    lastClickedDayEl = info.dayEl;
                    talep_tarihi = click_date;
                }
            },
        });
        // $.ajax({
        //     url: '../controller/tanim_controller/sql.php?islem=randevulari_getir_sql',
        //     type: 'GET',
        //     success: function (response) {
        //         if (response != 2) {
        //             var hiddenDays = [];
        //             var json = JSON.parse(response);
        //             json.forEach(function (item) {
        //                 var disabledDate = new Date(item.kapanacak_tarih);
        //                 var dayOfWeek = disabledDate.getDay(); // Haftanın gününü al
        //                 if (!hiddenDays.includes(dayOfWeek)) {
        //                     hiddenDays.push(dayOfWeek);
        //                 }
        //             });
        //             calendar.setOption('hiddenDays', hiddenDays);
        //         }
        //     }
        // });


        calendar.render();

        function fetchDataAndDisableDates() {
            $.get("../controller/tanim_controller/sql.php?islem=randevulari_getir_sql", function (res) {
                if (res != 2) {
                    var json = JSON.parse(res);
                    let res_arr = [];
                    json.forEach(function (item) {
                        let newRow = {
                            kapanacak_tarih: item.kapanacak_tarih
                        };
                        res_arr.push(newRow);
                    });
                    res_arr.forEach(function (date) {
                        var disableDate = date.kapanacak_tarih;
                        $('.fc-day').each(function () {
                            var date = $(this).attr('data-date'); // Tarih bilgisini al
                            let this_s = $(this);
                            if (date === disableDate) {
                                $(this_s).addClass('fc-disabled'); // Belirli tarih için devre dışı bırakma sınıfını ekle
                                $(this_s).css("background-color", '#FFAF45'); // Belirli tarih için devre dışı bırakma sınıfını ekle
                            }
                        });
                    })
                }
            });
        }

        $('button').click(function () {
            fetchDataAndDisableDates();
        });

        $.get("../controller/tanim_controller/sql.php?islem=randevulari_getir_sql", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                let res_arr = [];
                json.forEach(function (item) {
                    let newRow = {
                        kapanacak_tarih: item.kapanacak_tarih
                    };
                    res_arr.push(newRow);
                });
                res_arr.forEach(function (date) {
                    var disableDate = date.kapanacak_tarih;
                    $('.fc-day').each(function () {
                        var date = $(this).attr('data-date'); // Tarih bilgisini al
                        let this_s = $(this);
                        if (date === disableDate) {
                            $(this_s).addClass('fc-disabled'); // Belirli tarih için devre dışı bırakma sınıfını ekle
                            $(this_s).css("background-color", '#FFAF45'); // Belirli tarih için devre dışı bırakma sınıfını ekle
                        }
                    });
                })
            }
        });

        $("body").off("click", ".fc-button-primary").on("click", ".fc-button-primary", function () {
            $.get("../controller/tanim_controller/sql.php?islem=randevulari_getir_sql", function (res) {
                if (res != 2) {
                    var json = JSON.parse(res);
                    let res_arr = [];
                    json.forEach(function (item) {
                        let newRow = {
                            kapanacak_tarih: item.kapanacak_tarih
                        };
                        res_arr.push(newRow);
                    });
                    res_arr.forEach(function (date) {
                        var disableDate = date.kapanacak_tarih;
                        $('.fc-day').each(function () {
                            var date = $(this).attr('data-date'); // Tarih bilgisini al
                            let this_s = $(this);
                            if (date === disableDate) {
                                $(this_s).addClass('fc-disabled'); // Belirli tarih için devre dışı bırakma sınıfını ekle
                                $(this_s).css("background-color", '#FFAF45'); // Belirli tarih için devre dışı bırakma sınıfını ekle
                            }
                        });
                    })
                }
            });
        });


        // document.getElementById('hidden_button').addEventListener('change', function (event) {
        //     var file = event.target.files[0];
        //     if (file) {
        //         var fileName = file.name;
        //         if (!fileName.endsWith('.xls') && !fileName.endsWith('.xlsx')) {
        //             const Toast = Swal.mixin({
        //                 toast: true,
        //                 position: 'top-end',
        //                 showConfirmButton: false,
        //                 timer: 5000,
        //                 timerProgressBar: true,
        //                 didOpen: (toast) => {
        //                     toast.addEventListener('mouseenter', Swal.stopTimer)
        //                     toast.addEventListener('mouseleave', Swal.resumeTimer)
        //                 }
        //             });
        //             Toast.fire({
        //                 icon: 'warning',
        //                 title: 'Seçtiğiniz Dosya Bir Excel Dosyası Değildir'
        //             });
        //             this.value = ''; // Dosya seçme kutusunu temizler
        //         }
        //     }
        // });

        $.get("../controller/randevu_controller/sql.php?islem=illeri_getir_sql", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                json.forEach(function (item) {
                    $("#iller").append("" +
                        "<option value='" + item.id + "'>" + item.il_adi + "</option>" +
                        "");
                })
            }
        })
        var table = $('#ogrenci_listesi').DataTable({
            paging: false,
            scrollY: "35vh",
            scrollX: true,
            searching: false,
            "info": false,
            columns: [
                {'data': 'ad_soyad'},
                {'data': 'tc_no'},
                {'data': 'dogum_tarihi'},
                {'data': 'yas_grubu'},
                {'data': 'cinsiyet'},
                {'data': 'engel_durumu'},
                {'data': 'islem'},
            ],
            createdRow: function (row) {
                $(row).addClass("student_list_selected");
            },
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"},
        });

        $("body").off("click", ".remove_student").on("click", ".remove_student", function () {
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

        $("body").off("click", ".student_add_row").on("click", ".student_add_row", function () {
            let arr = [];
            let today = new Date();
            today = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
            let newRow = {
                ad_soyad: "<input type='text' class='form-control form-control-sm' />",
                tc_no: "<input type='text' class='form-control form-control-sm' />",
                dogum_tarihi: "<input type='date' value='" + today + "' class='form-control form-control-sm' />",
                yas_grubu: "<select class='custom-select custom-select-sm'>" +
                    "<option value=''>Seçiniz...</option>" +
                    "<option value='0-10'>0-10</option>" +
                    "<option value='10-18'>10-18</option>" +
                    "<option value='18-25'>18-25</option>" +
                    "<option value='25+'>25+</option>" +
                    "</select>",
                cinsiyet: "<select class='custom-select custom-select-sm'>" +
                    "<option value='Erkek'>Erkek</option>" +
                    "<option value='Kadın'>Kadın</option>" +
                    "</select>",
                engel_durumu: "<select class='custom-select custom-select-sm'>" +
                    "<option value='Var'>Var</option>" +
                    "<option selected value='Yok'>Yok</option>" +
                    "</select>",
                islem: "<button class='btn btn-danger btn-sm remove_student'><i class='fa fa-trash'></i></button> <button class='btn btn-sm student_add_row' style='color:white;background-color: #2C7865'><i class='fa fa-plus'></i></button>"
            };
            arr.push(newRow);
            table.rows.add(arr).draw(false);

            let newlyAddedRow = $('#ogrenci_listesi tbody tr:last');

            // Elemente odaklan
            $('html, body').animate({
                scrollTop: newlyAddedRow.offset().top
            }, 500);

            // İsteğe bağlı olarak bir input alanına odaklanabilirsiniz
            newlyAddedRow.find('input[type="text"]').first().focus();
        });

        // document.getElementById('hidden_button').addEventListener('change', function () {
        //     dosyaOku();
        // });

        // function dosyaOku() {
        //     var fileInput = document.getElementById('hidden_button');
        //     var file = fileInput.files[0];
        //
        //     if (!file) {
        //         Swal.fire(
        //             "Uyarı",
        //             "Herhangi Bir Dosya Seçilmedi"
        //         )
        //         return;
        //     }
        //
        //     var reader = new FileReader();
        //     reader.onload = function (e) {
        //         var data = new Uint8Array(e.target.result);
        //         var workbook = XLSX.read(data, {type: 'array'});
        //
        //         // İlk çalışma sayfasını al
        //         var sheetName = workbook.SheetNames[0];
        //         var worksheet = workbook.Sheets[sheetName];
        //
        //         // Verileri alma
        //         var veri = XLSX.utils.sheet_to_json(worksheet, {header: 1});
        //
        //         // "konteyner_no" sütunundaki verileri al
        //         var scriptTagFound = false;
        //         for (let n = 0; n < veri.length; n++) {
        //             for (let j = 0; j < veri[n].length; j++) {
        //                 if (typeof veri[n][j] === 'string' && veri[n][j].includes('<script>')) {
        //                     scriptTagFound = true;
        //                     break;
        //                 }
        //             }
        //             if (scriptTagFound) {
        //                 break;
        //             }
        //         }
        //
        //         if (scriptTagFound) {
        //             Swal.fire(
        //                 "Uyarı",
        //                 "Excel dosyası içerisinde script bulundu!",
        //                 "warning"
        //             );
        //             $.ajax({
        //                 url: "../controller/sql.php?islem=logout",
        //                 type: "POST",
        //                 data: {},
        //                 success: function () {
        //                     setTimeout(function () {
        //                         location.reload();
        //                     }, 800);
        //                 }
        //             });
        //         } else {
        //             let ad_soyad = veri[0].indexOf('ad_soyad');
        //             let tc = veri[0].indexOf('tc_no');
        //             let dogum_tarihi = veri[0].indexOf('dogum_tarihi');
        //             let yas_grubu = veri[0].indexOf('yas_grubu');
        //             let cinsiyet = veri[0].indexOf('cinsiyet');
        //             let engel_durumu = veri[0].indexOf('engel_durumu');
        //             let arr = [];
        //             for (let i = 1; i < veri.length; i++) {
        //                 let newRow = {
        //                     ad_soyad: ad_soyad,
        //                     tc_no: tc,
        //                     dogum_tarihi: dogum_tarihi,
        //                     yas_grubu: yas_grubu,
        //                     cinsiyet: cinsiyet,
        //                     engel_durumu: engel_durumu
        //                 };
        //                 arr.push(newRow);
        //             }
        //             table.rows.add(arr).draw(false);
        //         }
        //     };
        //
        //     reader.readAsArrayBuffer(file);
        // }

        $.get("../controller/randevular_controller/sql.php?islem=kurum_bilgilerini_getir_sql", function (res) {
            if (res != 2) {
                var item = JSON.parse(res);
                $("#iller").val(item.il);
                $("#ilceler").val(item.ilce);
                $("#kurum_adi").val(item.kurum_adi);
                $("#cep_no").val(item.cep_no);
                $("#yetkili_adi").val(item.yetkili_adi);
                $("#e_posta").val(item.e_posta);
                $("#ulasim").val(item.ulasim_istiyorum)
            }
        });

    });


    // $("body").off("click", "#excel_button").on("click", "#excel_button", function () {
    //     $("#hidden_button").trigger("click");
    // });


    $("body").off("change", "#iller").on("change", "#iller", function () {
        let id = $(this).val();
        $.get("../controller/randevu_controller/sql.php?islem=ilceleri_getir_sql", {id: id}, function (res) {
            var json = JSON.parse(res);
            $("#ilceler").html("");
            json.forEach(function (item) {
                $("#ilceler").append("" +
                    "<option value='" + item.id + "'>" + item.ilce_adi + "</option>" +
                    "");
            })

        })
    })

    $("body").off("change", "#kurum_tipi").on("change", "#kurum_tipi", function () {
        let kurum_tipi = $(this).val();
        let il_id = $("#iller").val();
        let ilce_id = $("#ilceler").val();
        $.get("../controller/randevu_controller/sql.php?islem=okullari_getir_sql", {
            kurum_tipi: kurum_tipi,
            il_id: il_id,
            ilce_id: ilce_id
        }, function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                $("#okul_adi").html("");
                json.forEach(function (item) {
                    $("#okul_adi").append("" +
                        "<option value='" + item.kurum_adi + "'>" + item.kurum_adi + "</option>" +
                        "");
                });
            }
        })
    })

    $("body").off("click", "#kurum_randevu_talep_olustur_button").on("click", "#kurum_randevu_talep_olustur_button", function () {
        let il = $("#iller option:selected").text();
        let ilce = $("#ilceler option:selected").text();
        let kurum_adi = $("#kurum_adi").val();
        let cep_no = $("#cep_no").val();
        let yetkili_adi = $("#yetkili_adi").val();
        let ulasim_istiyorum = $("#ulasim_istiyorum").val();
        let e_posta = $("#e_posta").val();

        let gidecek_arr = [];
        let hata = false;
        let kisi_sayisi = 0;
        $(".student_list_selected").each(function () {
            let ad_soyad = $(this).find("td:eq(0) input").val();
            let tc_no = $(this).find("td:eq(1) input").val();
            let dogum_tarihi = $(this).find("td:eq(2) input").val();
            let yas_grubu = $(this).find("td:eq(3) select").val();
            let cinsiyet = $(this).find("td:eq(4) select").val();
            let engel_durumu = $(this).find("td:eq(5) select").val();
            if (tc_no == "") {
                hata = true;
            }
            kisi_sayisi += 1;
            let newRow = {
                ad_soyad: ad_soyad,
                tc_no: tc_no,
                dogum_tarihi: dogum_tarihi,
                yas_grubu: yas_grubu,
                cinsiyet: cinsiyet,
                engel_durumu: engel_durumu
            };
            gidecek_arr.push(newRow);
        });

        if (cep_no == "") {
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
                title: 'Cep No Boş Kalamaz'
            });
        } else if (hata == true) {
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
                title: 'Boş TC Kalmamalı...'
            });
        } else if (talep_tarihi == "") {
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
                title: 'Lütfen Takvimde Tarih Seçiniz...'
            });
        } else {
            $.ajax({
                url: "../controller/randevular_controller/sql.php?islem=user_ziyaretci_randevu_talebi_sql",
                type: "POST",
                data: {
                    il: il,
                    ilce: ilce,
                    kurum_adi: kurum_adi,
                    ulasim_istiyorum: ulasim_istiyorum,
                    talep_tarihi: talep_tarihi,
                    gidecek_arr: gidecek_arr,
                    kisi_sayisi: kisi_sayisi,
                    cep_no: cep_no,
                    yetkili_adi: yetkili_adi,
                    e_posta: e_posta
                },
                success: function (res) {
                    if (res == 1) {
                        Swal.fire(
                            "Başarılı!",
                            "Randevu Talebiniz Oluşturulmuştur En Kısa Sürede Bilgi Vereceğiz.",
                            "success"
                        );
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else if (res == 300) {
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
                            title: 'Öğrencileriniz Randevu Talebi İçin Uygun Değildir'
                        });
                    }
                }
            });
        }


    });

</script>