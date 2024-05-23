<style>
    .kutu {
        position: absolute; /* kartınızın mutlaka 'absolute' pozisyonda olması */
        top: 40%; /* kartınızın üst kenarının yüzde 50'si sayfanın ortasında olacak */
        left: 50%; /* kartınızın sol kenarının yüzde 50'si sayfanın ortasında olacak */
        transform: translate(-50%, -50%); /* kutunun genişliğinin yarısı kadar solda yer alacak */
    }
</style>
<div class="content">
    <div class="brand">
    </div>
    <div class="card kutu">
        <div class="card-body">
            <h2 class="login-title">
                <img src="../assets/img/EPROM_LOGO.png" alt="" width="400" height="100">
            </h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" id="username" placeholder="Kullanıcı Adı">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" id="user_password" placeholder="Şifre">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" id="login" type="submit">Giriş Yap</button>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS -->
<!-- PAGE LEVEL SCRIPTS-->
<script type="text/javascript">
    //
    //    $(document).ready(function (){
    //        $.ajax({
    //            url:"../controller/sql.php?islem=register_user",
    //            type:"POST",
    //            data:{
    //                username:"user",
    //                user_password: "123",
    //                e_mail:"smtkbdy5422@gmail.com"
    //            },
    //            success:function (response){
    //                alert(response);
    //            }
    //        });
    //    });

    $("body").off("click", "#login").on("click", "#login", function () {
        var username = $("#username").val();
        var user_password = $("#user_password").val();
        $.ajax({
            url: "../controller/sql.php?islem=user_authentication",
            type: "POST",
            data: {
                username: username,
                user_password: user_password
            },
            success: function (result) {
                if (result == 1) {
                    Swal.fire(
                        'Başarılı!',
                        'Giriş Başarılı Yönlendiriliyorsunuz',
                        'success'
                    )
                    setTimeout(function () {
                        location.reload();
                    }, 500)
                } else if (result == 3) {
                    Swal.fire(
                        'Oops...',
                        'Hatalı Şifre',
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Oops...',
                        'Hatalı Kullanıcı Adı',
                        'error'
                    )
                }
            }
        });
    });

    $(function () {
        $('#login-form').validate({
            errorClass: "help-block",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            highlight: function (e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function (e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>