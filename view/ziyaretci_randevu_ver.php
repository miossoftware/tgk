<style>
    .randevu_card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: transparent;
        font-weight: bold;
        color: #2C7865;
        /* İstediğiniz stil ve içerik özelliklerini ekleyin */
    }
</style>
<div class="card randevu_card" style="width: 85% !important; height: 90% !important;">
    <div class="card-header" style="font-weight: bold; font-size: 20px;color: #2C7865">
        Talep Oluştur
    </div>
    <div class="card-body" id="ziyaretci_randevu_degisken_div">
        <div class="kutu col-7 row">
            <div class="card-header" style="color: #2C7865">
                Kurum Bilgileri
            </div>
            <div class="col-md-12 row">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>İl</label>
                    </div>
                    <div class="col-md-7">
                        <select class="custom-select custom-select-sm" id="iller">
                            <option value="">İl Seçiniz...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>İlçe</label>
                    </div>
                    <div class="col-md-7">
                        <select class="custom-select custom-select-sm" id="ilceler">
                            <option value="">İlçe Seçiniz...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Kurum Adı</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" id="kurum_adi">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Cep No</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" id="cep_no">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Yetkili Adı</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" id="yetkili_adi">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>E-Posta</label>
                    </div>
                    <div class="col-md-7">
                        <input type="email" required class="form-control form-control-sm" id="e_posta">
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
<!--                <div class="col-12 row">-->
<!--                    <table class="table table-sm table-bordered w-100 display nowrap" id="ogrenci_listesi"-->
<!--                           style="font-size: 13px;padding: 0">-->
<!--                        <thead>-->
<!--                        <tr style="background-color: transparent;color: #2C7865">-->
<!--                            <th>Ad Soyad</th>-->
<!--                            <th>TC No</th>-->
<!--                            <th>Doğum Tarihi</th>-->
<!--                            <th>Yaş Grubu</th>-->
<!--                            <th>Cinsiyet</th>-->
<!--                            <th>Engel Durumu</th>-->
<!--                            <th>İşlem</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td><input type="text" class="form-control form-control-sm"></td>-->
<!--                            <td><input type="text" class="form-control form-control-sm"></td>-->
<!--                            <td><input type="date" value="--><?//= date("Y-m-d") ?><!--" class="form-control form-control-sm">-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <select class="custom-select custom-select-sm" id="yas_grubu">-->
<!--                                    <option value="">Seçiniz...</option>-->
<!--                                    <option value="0-10">0-10</option>-->
<!--                                    <option value="10-18">10-18</option>-->
<!--                                    <option value="18-25">18-25</option>-->
<!--                                    <option value="25+">25+</option>-->
<!--                                </select>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <select class="custom-select custom-select-sm" id="">-->
<!--                                    <option value="Erkek">Erkek</option>-->
<!--                                    <option value="Kadın">Kadın</option>-->
<!--                                </select>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <select class="custom-select custom-select-sm" id="">-->
<!--                                    <option value="Var">Var</option>-->
<!--                                    <option value="Yok">Yok</option>-->
<!--                                </select>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <button class="btn btn-danger btn-sm remove_student"><i class="fa fa-trash"></i>-->
<!--                                </button>-->
<!--                                <button class="btn btn-sm student_add_row"-->
<!--                                        style="color:white;background-color: #2C7865"><i-->
<!--                                            class="fa fa-plus"></i></button>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="">
            <button class="btn btn-danger" id="randevudan_vazgec"><i class="fa fa-close"></i> Vazgeç</button>
        </a>
        <button class="btn btn-success" id="kurum_kaydet" style="background-color: #2C7865; color:white;" data-id=""><i
                    class="fa fa-arrow-right"></i> Talep Oluştur
        </button>
    </div>
</div>
<script>


    $(document).ready(function () {

        $.get("controller/randevu_controller/sql.php?islem=illeri_getir_sql", function (res) {
            if (res != 2) {
                var json = JSON.parse(res);
                json.forEach(function (item) {
                    $("#iller").append("" +
                        "<option value='" + item.id + "'>" + item.il_adi + "</option>" +
                        "");
                })
            }
        })

        $("body").off("click", "#excel_button").on("click", "#excel_button", function () {
            $("#hidden_button").trigger("click");
        });


        $("body").off("change", "#iller").on("change", "#iller", function () {
            let id = $(this).val();
            $.get("controller/randevu_controller/sql.php?islem=ilceleri_getir_sql", {id: id}, function (res) {
                var json = JSON.parse(res);
                $("#ilceler").html("");
                json.forEach(function (item) {
                    $("#ilceler").append("" +
                        "<option value='" + item.id + "'>" + item.ilce_adi + "</option>" +
                        "");
                })

            })
        })
    });

    $("body").off("change", "#kurum_tipi").on("change", "#kurum_tipi", function () {
        let kurum_tipi = $(this).val();
        let il_id = $("#iller").val();
        let ilce_id = $("#ilceler").val();
        $.get("controller/randevu_controller/sql.php?islem=okullari_getir_sql", {
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

    $("body").off("click", "#kurum_kaydet").on("click", "#kurum_kaydet", function () {
        let il = $("#iller option:selected").text();
        let ilce = $("#ilceler option:selected").text();
        let kurum_adi = $("#kurum_adi").val();
        let cep_no = $("#cep_no").val();
        let yetkili_adi = $("#yetkili_adi").val();
        let ulasim_istiyorum = $("#ulasim_istiyorum").val();
        let e_posta = $("#e_posta").val();

         if (cep_no == ""){
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
        } else {
            $.ajax({
                url:"controller/randevular_controller/sql.php?islem=ziyaretci_randevu_talebi_sql",
                type:"POST",
                data:{
                    il:il,
                    ilce:ilce,
                    kurum_adi:kurum_adi,
                    ulasim_istiyorum:ulasim_istiyorum,
                    cep_no:cep_no,
                    yetkili_adi:yetkili_adi,
                    e_posta:e_posta
                },
                success:function (res){
                    if (res == 1){
                        Swal.fire(
                            "Başarılı!",
                            "Randevu Talebiniz Oluşturulmuştur En Kısa Sürede Bilgi Vereceğiz.",
                            "success"
                        );
                        setTimeout(function (){
                            location.reload();
                        },1000);
                    }
                }
            });
        }


    });

</script>