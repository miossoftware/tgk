<?php

include '../DB.php';
header('Content-Type: text/html; charset=UTF-8');
DB::connect();
date_default_timezone_set('Europe/Istanbul');

session_start();
$islem = $_GET["islem"];

if ($islem == "grafikleri_cek_sql") {
    $arr = [];
    $bas_tarih = date("Y-m-01");
    $bit_tarih = date("Y-m-t");


    $simdikiTarih = date('Y-m-d');
    $haftaBasiTarih = date('Y-m-d', strtotime('last monday', strtotime($simdikiTarih)));
    $haftaSonuTarih = date('Y-m-d', strtotime('next sunday', strtotime($simdikiTarih)));

    $toplam_gelecek_kisiler = DB::single_query("
SELECT 
COUNT(*) as toplam_gelecek_kisi
FROM 
     admin_randevu
WHERE 
status!=0 
      AND 
tarih_saat BETWEEN '$bas_tarih 00:00:00' AND '$bit_tarih 23:59:59'");
    if ($toplam_gelecek_kisiler > 0) {
        $arr2 = [
            'toplam_randevu' => $toplam_gelecek_kisiler["toplam_gelecek_kisi"]
        ];
        array_push($arr, $arr2);
    } else {
        $arr2 = [
            'toplam_randevu' => 0
        ];
        array_push($arr, $arr2);
    }

    $haftalik_kisiler = DB::single_query("SELECT COUNT(*) as toplam_gelecek_kisi FROM admin_randevu WHERE status=1 AND tarih_saat BETWEEN '$haftaBasiTarih 00:00:00' AND '$haftaSonuTarih 23:59:59'");
    if ($toplam_gelecek_kisiler > 0) {
        $arr2 = [
            'haftalik_kisi' => $toplam_gelecek_kisiler["toplam_gelecek_kisi"]
        ];
        array_push($arr, $arr2);
    } else {
        $arr2 = [
            'haftalik_kisi' => 0
        ];
        array_push($arr, $arr2);
    }

    $haftalik_kisiler = DB::single_query("SELECT SUM(kisi_sayisi) as toplam_gelecek_kisi FROM admin_randevu WHERE status=1 AND tarih_saat LIKE '%$simdikiTarih%'");
    $anlik_giris = DB::single_query("SELECT COUNT(*) as anlik_ziyaretci FROM anlik_ziyaretci WHERE status=1 AND insert_datetime BETWEEN '$haftaBasiTarih 00:00:00' AND '$haftaSonuTarih 23:59:59'");
    if ($haftalik_kisiler > 0) {
        $arr2 = [
            'gunluk_kisi' => $haftalik_kisiler["toplam_gelecek_kisi"] + $anlik_giris["anlik_ziyaretci"]
        ];
        array_push($arr, $arr2);
    } else {
        $arr2 = [
            'gunluk_kisi' => 0
        ];
        array_push($arr, $arr2);
    }

    $tum_ziyaretciler = DB::single_query("SELECT SUM(kisi_sayisi) as toplam_gelecek_kisi FROM admin_randevu WHERE status=1");
    $anlik_giris = DB::single_query("SELECT COUNT(*) as anlik_ziyaretci FROM anlik_ziyaretci WHERE status=1");
    if ($tum_ziyaretciler > 0) {
        $arr2 = [
            'total_ziyaretci' => $tum_ziyaretciler["toplam_gelecek_kisi"] + $anlik_giris["anlik_ziyaretci"]
        ];
        array_push($arr, $arr2);
    } else {
        $arr2 = [
            'total_ziyaretci' => 0
        ];
        array_push($arr, $arr2);
    }

    if ($arr > 0) {
        echo json_encode($arr);
    } else {
        echo 2;
    }
}
if ($islem == "gunluk_dolu_seans") {
    $simdikiTarih = date("Y-m-d");
    $git_arr = [];
    for ($i = 1; $i < 4; $i++) {
        $all_data = DB::single_query("SELECT SUM(kisi_sayisi) as toplam_kisi FROM admin_randevu WHERE status=1 AND tarih_saat LIKE '%$simdikiTarih%' AND saat_aralik='$i' GROUP BY saat_aralik");
        if ($all_data > 0) {
            $arr = [
                'toplam_kisi' => $all_data["toplam_kisi"]
            ];
            array_push($git_arr, $arr);
        } else {
            $arr = [
                'toplam_kisi' => 0
            ];
            array_push($git_arr, $arr);
        }
    }
    if ($git_arr > 0){
        echo json_encode($git_arr);
    }else{
        echo 2;
    }
}