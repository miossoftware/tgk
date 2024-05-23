<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>RANDEVU TAKVİMİ</div>
        </div>
        <div class="col-md-12 row mt-5">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "tr",
            header: {
                left: 'next today', // Burada "today" yerine "Bu Gün" kullanıyoruz
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 'auto',
            aspectRatio: 1.5,
            contentHeight: 600,
            buttonText: {
                today: 'Bu Gün', // Takvimdeki "Today" butonunun metnini değiştiriyoruz
                next: 'İleri', // Takvimdeki "Next" butonunun metnini değiştiriyoruz
                prev: 'Geri' // Takvimdeki "Prev" butonunun metnini değiştiriyoruz
            },
            events: "../controller/randevular_controller/sql.php?islem=randevulari_getir_sql"
        });

        calendar.render();
    });

</script>