<?php

$islem = $_GET["islem"];

if ($islem == "randevu_al_modal") {
    ?>
    <div class="modal fade" id="randevu_al_modal" data-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-sm"
             style="width: 50%; max-width: 50%;">
            <div class="modal-content">
                <div class="modal-header text-white p-2">
                    <button type="button" class="btn-close btn-close-white modal_kapali" id="modal_kapat"
                            aria-label="Close"></button>
                </div>
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-head" style='background-color:#9DB2BF'>
                            <div class="ibox-title" style='color:white; font-weight:bold;'>ÖĞRENCİ BİLGİLERİ GİRİŞ</div>
                        </div>
                        <div class="modal-body" style="max-height: 75vh; overflow: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function (){

        });

    </script>
    <?php
}