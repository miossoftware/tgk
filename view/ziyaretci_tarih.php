<style>
    .randevu_card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #8ECDDD;
        font-weight: bold;
        color: white;
        /* İstediğiniz stil ve içerik özelliklerini ekleyin */
    }

    .flatpickr-day.weekend {
        order: 7; /* 7, yani son sırada görünecektir */
    }
</style>
<div class="card randevu_card" style="width: 100% !important; height: 100% !important;">
    <div class="card-header" style="font-weight: bold; font-size: 20px;color: white">
        Randevu Al
    </div>
    <div class="card-body" id="ziyaretci_randevu_degisken_div">
        <div class="kutu col-10 row">
            <div class="card-header" style="background-color: #053B50">
                Randevu Bilgileri
            </div>
            <div class="card-body">
                <div class="col-12 row">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Uygun Olduğunuz Tarihler</label>
                        </div>
                        <div class="col-md-7">
                            <textarea class="form-control form-control-sm" id="musait_tarihler" style="resize: none" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Kişi Sayısı</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" class="form-control form-control-sm" id="kisi_sayisi">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function disableWeekends(selectedDates, dateStr, instance) {
        var day = selectedDates[0].getDay();

        // Eğer seçilen gün Cumartesi (6) veya Pazar (0) ise, tarih seçimini temizleyin
        if (day === 0 || day === 6) {
            instance.setDate("", true);
            alert("Hafta sonları seçilemez.");
        }
    }

    $("body").off("click", "#randevu_tarihi").on("click", "#randevu_tarihi", function () {
        let alindigi_yer = 1;
        let musait_tarihler = $("#musait_tarihler").val();
        let kisi_sayisi = $("#kisi_sayisi").val();
        let kurum_id = $(this).attr("data-id");

        $.ajax({
            url: "controller/randevu_controller/sql.php?islem=randevu_tarihi_ekle",
            type: "POST",
            data: {
                alindigi_yer: alindigi_yer,
                kisi_sayisi: kisi_sayisi,
                musait_tarihler: musait_tarihler,
                kurum_id: kurum_id
            },
            success: function (res) {
                if (res != 2) {
                    Swal.fire({
                        title: 'Başarılı',
                        text: "RANDEVU TALEBİNİZİN ONAY BİLGİSİ 24 SAAT İÇERİSİNDE KAYILI MAIL ADRESİNİZE BİLDİRİLECEKTİR. ONAY GELMEMESİ DURUMUNDA KURUMLA İLETİŞİME GEÇMENİZİ RİCA EDERİZ.",
                        icon: 'success',
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
        });
    });

</script>