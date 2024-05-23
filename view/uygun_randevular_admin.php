<style>
    .fc-event-main-frame{
        width: 100% !important;
        height: 50px !important;
    }
    .fc-title {
        font-weight: bold; /* Etkinlik başlığını kalın yapar */
    }
</style>
<div class="ibox-container">
    <div class="ibox mt-5">
        <div class="ibox-head">
            <div class="ibox-title" style=' font-weight:bold;'>RANDEVU KATALOĞU</div>
        </div>
        <div class="col-md-12">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script src="../assets/vendors/flatpickr/dist/flatpickr.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/tr.js"></script>
<script>

    $(document).ready(function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'tr',
            buttonText: {
                today: 'Bugün' // "Today" butonunu "Bugün" olarak değiştiriyoruz
            },
            height: 'auto',
            aspectRatio: 1.5,
            contentHeight: 1500,
            selectable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            events:"../controller/randevu_controller/sql.php?islem=gunluk_kisi_sayisi"
        });
        calendar.render();
    });

</script>