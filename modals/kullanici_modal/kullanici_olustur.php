<?php

$islem = $_GET["islem"];

if ($islem == "kullanici_olustur_modal_getir") {
    ?>
    <div class="modal fade" id="kullanici_olustur_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 35%; max-width: 35%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="modal_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-head" style='background-color:#9DB2BF'>
                            <div class="ibox-title" style='color:white; font-weight:bold;'>Kullanıcı Oluştur</div>
                        </div>
                        <div class="modal-body" style="max-height: 75vh; overflow: auto;">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Ad Soyad</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="ad_soyad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Kullanıcı Adı</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="kullanici_adi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Şifre</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="sifre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>E-Mail</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="mail_adress">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Telefon</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-sm" id="phone_number">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" id="modal_kapat"><i class="fa fa-close"></i> Vazgeç
                            </button>
                            <button class="btn btn-success btn-sm" id="kullanici_kaydet_button"><i
                                        class="fa fa-check"></i> Kaydet
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("#kullanici_olustur_modal").modal("show");
        });

        $("body").off("click", "#modal_kapat").on("click", "#modal_kapat", function () {
            $("#kullanici_olustur_modal").modal("hide");
        });

        $("body").off("click", "#kullanici_kaydet_button").on("click", "#kullanici_kaydet_button", function () {
            let name_surname = $("#ad_soyad").val()
            let phone_number = $("#phone_number").val()
            let username = $("#kullanici_adi").val()
            let user_password = $("#sifre").val()
            let e_mail = $("#mail_adress").val();
            if (user_password == "") {
                Swal.fire(
                    "Uyarı",
                    "Lütfen Bir Şifre Belirtiniz",
                    "warning"
                );
            } else {
                $.ajax({
                    url: "../controller/sql.php?islem=register_user",
                    type: "POST",
                    data: {
                        name_surname: name_surname,
                        phone_number: phone_number,
                        username: username,
                        user_password: user_password,
                        e_mail: e_mail
                    },
                    success:function (res){
                        if (res == 1){
                            Swal.fire(
                                "Başarılı",
                                "Kullanıcı Oluşturuldu",
                                "success"
                            );
                            $("#kullanici_olustur_modal").modal("hide");
                        }
                    }
                });
            }
        });

    </script>
    <?php
}