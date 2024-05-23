<style>
    .randevu_card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: transparent;
        font-weight: bold;
        color: #2C7865;
    }
    :root {
        --fc-border-color: #2C7865;
        --fc-daygrid-event-dot-width: 3px;
    }
    .fc-toolbar-title{
        color: #2C7865;
    }
    .fc-day{
        background-color: #FFF5E0;
        color: #2C7865;
    }
    .fc-day-today{
        background-color: #ED9455;
    }
    .fc-button{
        background-color: #2C7865 !important;
    }
</style>
<div class="card-body" id="ziyaretci_randevu_degisken_div">
    <div class="kutu col-7 row mt-5">
        <div class="card-header" style="color: #2C7865;font-weight: bold">
            Randevu Ara
        </div>
        <div class="col-md-12 row mt-5">
            <div id="calendar"></div>
            <div class="modal-footer">
                <a href="">
                    <button class="btn btn-danger" id="randevudan_vazgec"><i class="fa fa-close"></i> Vazgeç
                    </button>
                </a>
                <button class="btn btn-success" id="kurum_randevu_talep_olustur_button"
                        style="background-color: #2C7865; color:white;" data-id=""><i
                        class="fa fa-arrow-right"></i> Randevu Al
                </button>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function (){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale:"tr",
            header: {
                left: 'prev,next today', // Burada "today" yerine "Bu Gün" kullanıyoruz
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Bu Gün' // Takvimdeki "Today" butonunun metnini değiştiriyoruz
            },
            dateClick: function(info) {
                let click_date = info.date;
                Swal.fire({
                    title: "Seçmiş Olduğunuz Güne Randevu Almak İstiyormusunuz ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Evet,İstiyorum",
                    cancelButtonText:"Hayır"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Randevu Alındı",
                            text: "Randevu Başarı İle Oluşturuldu",
                            icon: "success"
                        });
                    }
                });
            }
        });
        calendar.render();
    });

</script>