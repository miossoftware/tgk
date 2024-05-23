<?php
include '../DB.php';
header('Content-Type: text/html; charset=UTF-8');
DB::connect();
date_default_timezone_set('Europe/Istanbul');

session_start();

$islem = $_GET["islem"];


if ($islem == "kurumu_kaydet_sql") {
    $_POST["insert_datetime"] = date("Y-m-d H:i:s");
    $kurum_kaydet = DB::insert("kurum_kayit", $_POST);
    if ($kurum_kaydet) {
        echo 2;
    } else {
        $son_eklenen = DB::single_query("SELECT id FROM kurum_kayit WHERE status=1 ORDER BY id DESC LIMIT 1");
        echo "id:" . $son_eklenen["id"];
    }
}
if ($islem == "uygun_randevu_varmi") {
    $kisi_sayi = $_GET["kisi_sayisi"];
    $tarih = $_GET["randevu_tarih"];
    $randevulari_cek = DB::all_data("SELECT *,SUM(kisi_sayisi) as total_kisi FROM randevu_time WHERE status=1 AND randevu_tarih='$tarih 00:00:00' GROUP BY saat_aralik");
    $randevulari_cek2 = DB::single_query("SELECT *,SUM(kisi_sayisi) as total_kisi FROM randevu_time WHERE status=1 AND randevu_tarih='$tarih 00:00:00'");
    if ($randevulari_cek > 0) {
        if ($randevulari_cek2["total_kisi"] >= 360) {
            echo 3;
        } else {
            echo 1;
        }
    } else {
        echo 1;
    }
}
if ($islem == "randevu_tarihi_ekle") {
    $_POST["insert_kurumid"] = $_POST["kurum_id"];
    $_POST["insert_kurum_date"] = date("Y-m-d H:i:s");
    $randevu_tarih_ekle = DB::insert("randevu_time", $_POST);
    if ($randevu_tarih_ekle) {
        echo 2;
    } else {
        $son_eklenen = DB::single_query("SELECT id FROM randevu_time WHERE status=1 ORDER BY id DESC LIMIT 1");
        echo "id:" . $son_eklenen["id"];
    }
}
if ($islem == "randevu_infos") {
    $tarih = $_GET["tarih"];
    $randevu_id = $_GET["randevu_id"];

    $arr = [];

    for ($i = 1; $i < 8; $i++) {
        $randevulari_cek = DB::single_query("SELECT *,SUM(kisi_sayisi) as total_kisi FROM randevu_time WHERE status=1 AND randevu_tarih='$tarih 00:00:00' AND saat_aralik='$i' AND id!='$randevu_id' GROUP BY saat_aralik");
        if ($randevulari_cek > 0) {
            if ($i == 1) {
                $arr2 = [
                    'konferans_saat' => '08:00 - 10:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 2) {
                $arr2 = [
                    'konferans_saat' => '10:00 - 12:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 3) {
                $arr2 = [
                    'konferans_saat' => '12:00 - 14:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 4) {
                $arr2 = [
                    'konferans_saat' => '14:00 - 16:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 5) {
                $arr2 = [
                    'konferans_saat' => '16:00 - 18:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 6) {
                $arr2 = [
                    'konferans_saat' => '18:00 - 20:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 7) {
                $arr2 = [
                    'konferans_saat' => '20:00 - 22:00',
                    'kisi_sayisi' => $randevulari_cek["total_kisi"],
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            }
        } else {
            if ($i == 1) {
                $arr2 = [
                    'konferans_saat' => '08:00 - 10:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 2) {
                $arr2 = [
                    'konferans_saat' => '10:00 - 12:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 3) {
                $arr2 = [
                    'konferans_saat' => '12:00 - 14:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 4) {
                $arr2 = [
                    'konferans_saat' => '14:00 - 16:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 5) {
                $arr2 = [
                    'konferans_saat' => '16:00 - 18:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 6) {
                $arr2 = [
                    'konferans_saat' => '18:00 - 20:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            } else if ($i == 7) {
                $arr2 = [
                    'konferans_saat' => '20:00 - 22:00',
                    'kisi_sayisi' => 0,
                    'saat_aralik' => $i
                ];
                array_push($arr, $arr2);
            }
        }
    }

    if ($arr > 0) {
        echo json_encode($arr);
    } else {
        echo 2;
    }
}
if ($islem == "randevu_kisi_bilgisi") {
    $randevu_id = $_GET["randevu_id"];
    $randevu_info = DB::single_query("SELECT * FROM randevu_time WHERE status=1 AND id='$randevu_id'");
    if ($randevu_info > 0) {
        echo json_encode($randevu_info);
    } else {
        echo 2;
    }
}
if ($islem == "randevuya_ogr_ekle_sql") {
    $saat_aralik = $_POST["saat_aralik"];
    unset($_POST["saat_aralik"]);
    $arr = [
        'saat_aralik' => $saat_aralik
    ];

    $randevu_time = DB::update("randevu_time", "id", $_POST["randevu_id"], $arr);

    $randevu_id = $_POST["randevu_id"];
    $tc_no = $_POST["ogr_tc"];
    $sorgu = DB::single_query("SELECT * FROM randevu_ogrenci WHERE status=1 AND randevu_id='$randevu_id' AND ogr_tc='$tc_no'");
    if ($sorgu > 0) {
        echo 300;
    } else {
        $ogr_ekle = DB::insert("randevu_ogrenci", $_POST);
        if ($ogr_ekle) {
            echo 2;
        } else {
            $son_eklenen = DB::single_query("SELECT id FROM randevu_ogrenci WHERE status=1 ORDER BY id DESC LIMIT 1");
            echo "id:" . $son_eklenen["id"];
        }
    }
}
if ($islem == "localdeki_kayitlar_sql") {
    $randevu_id = $_GET["randevu_id"];
    $randevuya_bagli_ogr = DB::all_data("SELECT * FROM randevu_ogrenci WHERE status=1 AND randevu_id='$randevu_id'");
    if ($randevuya_bagli_ogr > 0) {
        echo json_encode($randevuya_bagli_ogr);
    } else {
        echo 2;
    }
}
if ($islem == "ogr_sil_sql") {
    $_POST["status"] = 0;
    $guncelle = DB::update("randevu_ogrenci", "id", $_POST["id"], $_POST);
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "randevu_bilgileri") {
    $randevu_id = $_GET["randevu_id"];
    $bilgiler = DB::single_query("SELECT * FROM randevu_time WHERE id='$randevu_id'");
    if ($bilgiler > 0) {
        echo json_encode($bilgiler);
    } else {
        echo 2;
    }
}
if ($islem == "tum_randevulari_getir_sql") {
    $tum_randevular_gunluk = DB::all_data("
SELECT 
       rt.*,
       kk.okul_adi,
       kk.il,
       kk.ilce_adi,
       kk.ogretmen_adi,
       kk.cep_no,
       kk.mail_adress,
       kk.siniflar
FROM
     randevu_time as rt
INNER JOIN kurum_kayit as kk on kk.id=rt.kurum_id
WHERE rt.status=1 GROUP BY kk.id");
    if ($tum_randevular_gunluk > 0) {
        echo json_encode($tum_randevular_gunluk);
    } else {
        echo 2;
    }
}
if ($islem == "randevuyu_iptal_et_sql") {
    $arr = [
        'status' => 0
    ];
    $iptal_et = DB::update("randevu_time", "id", $_POST["randevu_id"], $arr);
    if ($iptal_et) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "randevuyu_kaydet_sql") {
    $kurum_arr = [
        'okul_adi' => $_POST["okul_adi"],
        'cep_no' => $_POST["cep_no"],
        'ogretmen_adi' => $_POST["ogrtmn_adi"],
        'mail_adress' => $_POST["mail_adress"],
        'insert_datetime' => date("Y-m-d H:i:s")
    ];
    $kurum_ekle = DB::insert("kurum_kayit", $kurum_arr);
    if ($kurum_ekle) {
        echo 2;
    } else {
        $son_eklenen = DB::single_query("SELECT id FROM kurum_kayit WHERE status=1 ORDER BY id DESC LIMIT 1");
        $saat_aralik = $_POST["saat_aralik"];
        $randevu_tarih = $_POST["randevu_tarih_main"];
        $randevular = DB::single_query("SELECT *,SUM(kisi_sayisi) as total_kisi FROM randevu_time WHERE status=1 AND saat_aralik='$saat_aralik' AND randevu_tarih='$randevu_tarih 00:00:00'");
        if ($randevular["total_kisi"] >= 120) {
            echo 300;
        } else {
            $arr2 = [
                'kurum_id' => $son_eklenen["id"],
                'kisi_sayisi' => $_POST["kisi_sayisi"],
                'randevu_tarih' => $_POST["randevu_tarih_main"],
                'saat_aralik' => $_POST["saat_aralik"],
                'alindigi_yer' => 2
            ];
            $randevu_time_add = DB::insert("randevu_time", $arr2);
            if ($randevu_time_add) {
                echo 2;
            } else {
                echo 1;
            }
        }

    }
}
if ($islem == "randevuyu_guncelle_sql") {
    $id = $_POST["randevu_id"];
    $randevu_info = DB::single_query("SELECT * FROM randevu_time WHERE id='$id'");
    $kurum_arr = [
        'okul_adi' => $_POST["okul_adi"],
        'cep_no' => $_POST["cep_no"],
        'ogretmen_adi' => $_POST["ogrtmn_adi"],
        'mail_adress' => $_POST["mail_adress"],
        'insert_datetime' => date("Y-m-d H:i:s")
    ];
    $kurum_ekle = DB::update("kurum_kayit", "id", $randevu_info["kurum_id"], $kurum_arr);
    if ($kurum_ekle) {
        $son_eklenen = DB::single_query("SELECT id FROM kurum_kayit WHERE status=1 ORDER BY id DESC LIMIT 1");
        $saat_aralik = $_POST["saat_aralik"];
        $randevu_tarih = $_POST["randevu_tarih_main"];
        $randevular = DB::single_query("SELECT *,SUM(kisi_sayisi) as total_kisi FROM randevu_time WHERE status=1 AND saat_aralik='$saat_aralik' AND randevu_tarih='$randevu_tarih 00:00:00' AND id!='$id'");
        if ($randevular["total_kisi"] >= 120) {
            echo 300;
        } else {
            $arr2 = [
                'kurum_id' => $randevu_info["kurum_id"],
                'kisi_sayisi' => $_POST["kisi_sayisi"],
                'randevu_tarih' => $_POST["randevu_tarih_main"],
                'saat_aralik' => $_POST["saat_aralik"]
            ];
            $randevu_time_add = DB::update("randevu_time", "id", $id, $arr2);
            if ($randevu_time_add) {
                echo 1;
            } else {
                echo 2;
            }
        }
    } else {
        echo 2;
    }
}
if ($islem == "randevu_bilgisi_getir_sql") {
    $id = $_GET["id"];
    $tum_randevular_gunluk = DB::single_query("
SELECT 
       rt.*,
       kk.okul_adi,
       kk.ogretmen_adi,
       kk.cep_no,
       kk.mail_adress
FROM
     randevu_time as rt
INNER JOIN kurum_kayit as kk on kk.id=rt.kurum_id
WHERE rt.id='$id'");
    if ($tum_randevular_gunluk > 0) {
        echo json_encode($tum_randevular_gunluk);
    } else {
        echo 2;
    }
}
if ($islem == "illeri_getir_sql") {
    $iller = DB::all_data("SELECT * FROM il");
    if ($iller > 0) {
        echo json_encode($iller);
    } else {
        echo 2;
    }
}
if ($islem == "ilceleri_getir_sql") {
    $id = $_GET["id"];
    $ilceler = DB::all_data("SELECT * FROM ilce WHERE il_id='$id'");
    if ($ilceler > 0) {
        echo json_encode($ilceler);
    } else {
        echo 2;
    }
}
if ($islem == "okullari_getir_sql") {
    $kurum_tipi = $_GET["kurum_tipi"];
    $jsonData = '';
    if ($kurum_tipi == "devlet") {
        $jsonData = file_get_contents("../../resmi_kurumlar.json");
    } else {
        $jsonData = file_get_contents("../../ozel_kurumlar.json");
    }
    $il_id = $_GET["il_id"];
    $ilce_id = $_GET["ilce_id"];
    $il_ve_ilceadi = DB::single_query("
SELECT 
       REPLACE(UPPER(CONVERT(il.il_adi USING utf8)), 'I', 'İ') as il_adi,
       REPLACE(UPPER(CONVERT(ilce.ilce_adi USING utf8)), 'I', 'İ') as ilce_adi
FROM
     il
INNER JOIN ilce on ilce.il_id=il.id
WHERE il.id='$il_id' AND ilce.id='$ilce_id'");
    $data = json_decode($jsonData, true);
    $data = array_map(function ($item) {
        $item['kurum_adi'] = $item['Kurum Adı'];
        unset($item['Kurum Adı']);
        $item['il_adi'] = $item['İl Adı'];
        unset($item['İl Adı']);
        $item['ilce_adi'] = $item['İlçe Adı'];
        unset($item['İlçe Adı']);
        return $item;
    }, $data);

    $filteredData = array_filter($data, function ($item) use ($il_ve_ilceadi) {
        return $item["il_adi"] == $il_ve_ilceadi["il_adi"] && $item['ilce_adi'] == $il_ve_ilceadi["ilce_adi"];
    });
    echo json_encode(array_values($filteredData));
}
if ($islem == "randevuyu_onayla_sql") {
    $arr = [
        'alindigi_yer' => 2
    ];
    $randevuyu_degistir = DB::update("randevu_time", "id", $_POST["id"], $arr);
    if ($randevuyu_degistir) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "talepleri_getir_sql") {
    $tum_randevular_gunluk = DB::all_data("
SELECT 
       rt.*,
       kk.okul_adi,
       kk.il,
       kk.ilce_adi,
       kk.ogretmen_adi,
       kk.cep_no,
       kk.mail_adress,
       kk.siniflar
FROM
     randevu_time as rt
INNER JOIN kurum_kayit as kk on kk.id=rt.kurum_id
WHERE rt.status=1 GROUP BY kk.id");
    if ($tum_randevular_gunluk > 0) {
        echo json_encode($tum_randevular_gunluk);
    } else {
        echo 2;
    }
}
if ($islem == "admin_randevu_versin_sql") {
    $_POST["insert_userid"] = $_SESSION["user_id"];
    $_POST["insert_datetime"] = date("Y-m-d H:i:s");

    $tarih = $_POST["tarih_saat"];
    $sadeceSaat = date("H:i", strtotime($tarih));
    $tarih = date("Y-m-d", strtotime($tarih));
    $saat_araliklari = array(
        '00:00 - 23:59'
    );
    $seciliAralik = "";
    foreach ($saat_araliklari as $aralik) {
        list($baslangic, $bitis) = explode(' - ', $aralik);

        if ($sadeceSaat >= $baslangic && $sadeceSaat <= $bitis) {
            $seciliAralik = $aralik;
            break;
        }
    }
    $toplam_kisi = 0;
    $admin_randevu = DB::single_query("SELECT COALESCE(SUM(kisi_sayisi), 0) AS kisi_sayisi
    FROM admin_randevu
    WHERE status = 1 AND tarih_saat LIKE '%$tarih%'
    AND DATE_FORMAT(tarih_saat, '%H:%i') BETWEEN '" . substr($seciliAralik, 0, 5) . "' AND '" . substr($seciliAralik, -5) . "'");

    $kisi_sayi = !empty($admin_randevu) ? $admin_randevu["kisi_sayisi"] : 0;
    $toplam_kisi = $_POST["kisi_sayisi"] + $kisi_sayi;
    $admin_randevu_ver_sql = DB::insert("admin_randevu", $_POST);
    if ($admin_randevu_ver_sql) {
        echo 2;
    } else {
        echo 1;
        // BURADAKİ KISIM ZİYARETÇİ RANDEVU TALEBİ OLUŞTUĞUNDA OLACAK KISIMDIR
//        $istek_id = $_POST["istek_id"];
//        $arr = [
//            'status' => 2
//        ];
//        $randevu_time = DB::update("randevu_time", "id", $istek_id, $arr);
//        if ($randevu_time) {
//            echo 1;
//        } else {
//            echo 2;
//        }
    }
}
if ($islem == "adminlerin_verdigi_randevu_sql") {
    $admin_randevu = DB::all_data("SELECT * FROM admin_randevu WHERE status=1");
    if ($admin_randevu > 0) {
        echo json_encode($admin_randevu);
    } else {
        echo 2;
    }
}
if ($islem == "admin_randevuyu_iptal_et_sql") {
    $_POST["delete_userid"] = $_SESSION["user_id"];
    $_POST["status"] = 0;
    $_POST["delete_datetime"] = date("Y-m-d H:i:s");
    $sil = DB::update("admin_randevu", "id", $_POST["id"], $_POST);
    if ($sil) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "admin_randevu_infos") {
    $tarih = $_GET["tarih"];
    $saat_araliklari = array(
        '08:30 - 09:59',
        '10:30 - 11:59',
        '12:30 - 12:59',
        '13:30 - 14:59'
    );

    $sonuclar = [];

    foreach ($saat_araliklari as $item) {
        $admin_randevu = DB::single_query("SELECT COALESCE(SUM(kisi_sayisi), 0) AS kisi_sayisi,tarih_saat
        FROM admin_randevu
        WHERE status = 1 AND tarih_saat LIKE '%$tarih%'
        AND DATE_FORMAT(tarih_saat, '%H:%i') BETWEEN '" . substr($item, 0, 5) . "' AND '" . substr($item, -5) . "'");

        $arr = [
            'saat_araligi' => $item,
            'kisi_sayisi' => !empty($admin_randevu) ? $admin_randevu["kisi_sayisi"] : 0
        ];
        $sonuclar[] = $arr;
    }

    if (array_sum(array_column($sonuclar, 'kisi_sayisi')) > 0) {
        echo json_encode($sonuclar);
    } else {
        echo 2;
    }
}
if ($islem == "anlik_ziyaretci_kaydi_sql") {
    $_POST["insert_userid"] = $_SESSION["user_id"];
    $_POST["insert_datetime"] = date("Y-m-d H:i:s");
    $kaydet = DB::insert("anlik_ziyaretci", $_POST);
    if ($kaydet) {
        echo 2;
    } else {
        echo 1;
    }
}
if ($islem == "anlik_randevular_sql") {
    $query = DB::all_data("SELECT * FROM anlik_ziyaretci WHERE status=1");
    if ($query > 0) {
        echo json_encode($query);
    } else {
        echo 2;
    }
}
if ($islem == "anlik_randevu_sil_sql") {
    $_POST["delete_userid"] = $_SESSION["user_id"];
    $_POST["delete_datetime"] = date("Y-m-d H:i:s");
    $_POST["status"] = 0;
    $sil = DB::update("anlik_ziyaretci", "id", $_POST["id"], $_POST);
    if ($sil) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "anlik_ziyaretci_kaydi_guncelle_sql") {
    $_POST["update_userid"] = $_SESSION["user_id"];
    $_POST["update_datetime"] = date("Y-m-d H:i:s");
    $sil = DB::update("anlik_ziyaretci", "id", $_POST["id"], $_POST);
    if ($sil) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "anlik_ziyaretci_bilgi_getir_sql") {
    $id = $_GET["id"];
    $bilgi = DB::single_query("SELECT * FROM anlik_ziyaretci WHERE status=1 AND id='$id'");
    if ($bilgi > 0) {
        echo json_encode($bilgi);
    } else {
        echo 2;
    }
}
if ($islem == "kurum_randevu_bilgileri_getir_sql") {
    $id = $_GET["id"];
    $admin_randevu = DB::single_query("SELECT * FROM admin_randevu WHERE status=1 AND id='$id'");
    if ($admin_randevu > 0) {
        echo json_encode($admin_randevu);
    } else {
        echo 2;
    }
}
if ($islem == "admin_randevu_guncelle_sql") {
    $_POST["update_userid"] = $_SESSION["user_id"];
    $_POST["update_datetime"] = date("Y-m-d H:i:s");
    $guncelle = DB::update("admin_randevu", "id", $_POST["id"], $_POST);
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "admin_kurum_geldi_isaretle_sql") {
    $_POST["delete_userid"] = $_SESSION["user_id"];
    $_POST["status"] = 3;
    $_POST["delete_datetime"] = date("Y-m-d H:i:s");
    $sil = DB::update("admin_randevu", "id", $_POST["id"], $_POST);
    if ($sil) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "gelen_ziyaretcilerin_listesi_sql") {
    $admin_randevu = DB::all_data("SELECT * FROM admin_randevu WHERE status=3");
    if ($admin_randevu > 0) {
        echo json_encode($admin_randevu);
    } else {
        echo 2;
    }
}
if ($islem == "gelmeyen_ziyaretcilerin_listesi_sql") {
    $admin_randevu = DB::all_data("SELECT * FROM admin_randevu WHERE status=0");
    if ($admin_randevu > 0) {
        echo json_encode($admin_randevu);
    } else {
        echo 2;
    }
}
if ($islem == "gunluk_kisi_sayisi") {

    $gunluk_kisi_sayisi = DB::all_data("
SELECT DATE(tarih_saat) AS gun, COALESCE (SUM(kisi_sayisi),0) AS kisi_sayisi
FROM admin_randevu
WHERE status = 1 
GROUP BY DATE(tarih_saat)");
    if ($gunluk_kisi_sayisi > 0) {
        $gidecek_arr = [];
        foreach ($gunluk_kisi_sayisi as $item) {
            $color = "";
            $text_color = "";
            if ($item["kisi_sayisi"] < 200) {
                $color = "white";
                $text_color = "black";
            } else if ($item["kisi_sayisi"] > 200 && $item["kisi_sayisi"] < 400) {
                $color = "yellow";
                $text_color = "black";
            } else {
                $color = "red";
                $text_color = "white";
            }
            $arr = [
                'gun' => $item["gun"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'title' => 'Kişi Sayısı: ' . $item["kisi_sayisi"],
                'start' => $item["gun"],
                'end' => $item["gun"],
                'backgroundColor' => $color,
                'textColor' => $text_color
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