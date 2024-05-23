<?php
include '../DB.php';
header('Content-Type: text/html; charset=UTF-8');
DB::connect();
date_default_timezone_set('Europe/Istanbul');
session_start();
$islem = $_GET["islem"];

if ($islem == "randevu_tanim_kaydet_sql") {
    $arr = [
        'yil' => $_POST["yil"],
        'ay' => $_POST["ay"],
        'insert_userid' => $_SESSION["user_id"],
        'insert_datetime' => date("Y-m-d H:i:s")
    ];
    $ekle = DB::insert("randevu_tanimlari", $arr);

    if ($ekle) {
        echo 500;
    } else {
        $son_eklenen = DB::single_query("SELECT id FROM randevu_tanimlari WHERE status=1 ORDER BY id DESC LIMIT 1");

        foreach ($_POST["gidecek_arr"] as $item) {
            $item["insert_userid"] = $_SESSION["user_id"];
            $item["insert_datetime"] = date("Y-m-d H:i:s");
            $item["seans_id"] = $son_eklenen["id"];

            $seans_ekle = DB::insert("randevu_seans", $item);
        }
        if ($seans_ekle) {
            echo 500;
        } else {
            echo 1;
        }

    }
}
if ($islem == "tanimlanan_seanslari_getir_sql") {
    $seanslari_getir = DB::all_data("
SELECT
       rt.*,
       rs.id as seans_id,
       CONCAT(rs.bas_saat, ' - ', rs.bit_saat)  as seanslar,
       CONCAT(rs.kapasite) as kisi_sayisi
FROM
     randevu_tanimlari as rt
INNER JOIN randevu_seans as rs on rs.seans_id=rt.id
WHERE rt.status=1 AND rs.status=1
");
    if ($seanslari_getir > 0) {
        $gidecek_arr = [];
        foreach ($seanslari_getir as $item) {
            $arr = [
                'secilen_ayil' => $item["yil"] . " / " . $item["ay"],
                'seanslar' => $item["seanslar"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'islem' => "<button class='btn btn-sm' data-id='" . $item["seans_id"] . "' style='background-color: #F6FA70'><i class='fa fa-refresh'></i></button> <button data-id='" . $item["seans_id"] . "' class='btn btn-danger btn-sm seans_tanimi_sil_button'><i class='fa fa-trash'></i></button>"
            ];
            array_push($gidecek_arr, $arr);
        }
        if (!empty($gidecek_arr)) {
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
if ($islem == "seans_sil_sql") {
    $_POST["status"] = 0;
    $_POST["delete_userid"] = $_SESSION["user_id"];
    $_POST["delete_datetime"] = date("Y-m-d H:i:s");
    $guncelle = DB::update("randevu_seans", "id", $_POST["id"], $_POST);
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "uygun_randevulari_getir_sql") {
    $randevu_tanimlari = DB::all_data("SELECT * FROM randevu_tanimlari WHERE status=1");
    if ($randevu_tanimlari > 0) {
        echo json_encode($randevu_tanimlari);
    } else {
        echo 2;
    }
}
if ($islem == "randevulari_getir_sql") {
    $tum_randevular = DB::all_data("
SELECT 
       SUM(kisi_sayisi) as kisi_sayisi,
       randevu_tarih 
FROM 
     randevu_talepleri 
WHERE status=2 GROUP BY randevu_tarih");
    if ($tum_randevular > 0) {
        $gidecek_arr = [];
        foreach ($tum_randevular as $item) {
            $randevu_ay = date("m", strtotime($item["randevu_tarih"]));
            $randevu_yil = date("Y", strtotime($item["randevu_tarih"]));
            $ay = "";
            if ($randevu_ay == "01") {
                $ay = "Ocak";
            } else if ($randevu_ay = "02") {
                $ay = "Şubat";
            } else if ($randevu_ay = "03") {
                $ay = "Mart";
            } else if ($randevu_ay = "04") {
                $ay = "Nisan";
            } else if ($randevu_ay = "05") {
                $ay = "Mayıs";
            } else if ($randevu_ay = "06") {
                $ay = "Haziran";
            } else if ($randevu_ay = "07") {
                $ay = "Temmuz";
            } else if ($randevu_ay = "08") {
                $ay = "Ağustos";
            } else if ($randevu_ay = "09") {
                $ay = "Eylül";
            } else if ($randevu_ay = "10") {
                $ay = "Ekim";
            } else if ($randevu_ay = "11") {
                $ay = "Kasım";
            } else if ($randevu_ay = "12") {
                $ay = "Aralık";
            }
            $randevu_tanimlari = DB::single_query("
SELECT
       SUM(rs.kapasite) as kisi_sayisi
FROM
     randevu_tanimlari as rt
INNER JOIN randevu_seans as rs on rs.randevu_id=rt.id     
WHERE rt.status=1 AND rs.status=1 AND rt.ay='$ay' AND rt.yil='$randevu_yil' GROUP BY rt.id
");
            if ($randevu_tanimlari["kisi_sayisi"] <= $item["kisi_sayisi"]) {
                $arr = [
                    'kapanacak_tarih' => date("Y-m-d", strtotime($item["randevu_tarih"]))
                ];
                array_push($gidecek_arr, $arr);
            }
        }
        if (!empty($gidecek_arr)) {
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}