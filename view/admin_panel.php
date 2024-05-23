<!doctype html>
<html lang="tr">
<head>
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="../assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="../assets/css/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/vendors/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet"/>
    <link href="../assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <link href="../assets/css/main.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="icon" href="../assets/img/mbb_ico.png" type="image/x-icon">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <title>TGK</title>
</head>
<style>
    .dataTables_scrollHeadInner table{
        width:100% !important;
    }
    .modal-header{
        background-color: #374f65 !important;
    }
    @media screen and (max-width: 768px) {
        .modal-footer {
            width: 95%;
            height: 95%;
        }
    }
    td{
        text-transform: uppercase;
    }
    table{
        cursor: pointer;
    }
    .modal-header{
        background-color: #87CBB9;
    }
</style>
<body>
<?php
header('Content-Type: text/html; charset=UTF-8');
include "../controller/DB.php";
DB::connect();
session_start();
$style = "";
if (isset($_SESSION["username"])) {
    $style = "";
} else {
    $style = "background-color: #FDF4F5";
}
?>
<script type="text/javascript" src="../assets/vendors/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<?php
if (isset($_SESSION["name_surname"]) && isset($_SESSION["user_root"])) {
    include "dashboard.php";
} else {
    include 'login.php';
}
?>
<div class="getModals"></div>
<script src="../assets/js/app.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="../assets/js/app.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../assets/vendors/flatpickr/dist/flatpickr.min.css">

</body>
</html>