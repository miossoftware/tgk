<?php
include '../DB.php';
header('Content-Type: text/html; charset=UTF-8');
DB::connect();
date_default_timezone_set('Europe/Istanbul');
session_start();
$islem = $_GET["islem"];

if ($islem == "ziyaretci_randevu_talebi_sql") {
    $arr = [
        'il' => $_POST["il"],
        'ilce' => $_POST["ilce"],
        'kurum_adi' => $_POST["kurum_adi"],
        'cep_no' => $_POST["cep_no"],
        'yetkili_adi' => $_POST["yetkili_adi"],
        'ulasim_istiyorum' => $_POST["ulasim_istiyorum"],
        'e_posta' => $_POST["e_posta"],
        'insert_datetime' => date("Y-m-d h:i:s"),
    ];
    $ana_tabloya_ekle = DB::insert("kurum_kaydi", $arr);
    if ($ana_tabloya_ekle) {
        echo 500;
    } else {
        echo 1;
    }
}
if ($islem == "randevu_taleplerini_getir_sql") {
    $sql = "
SELECT
       kk.*
FROM
     kurum_kaydi as kk";

    if (isset($_GET["bas_tarih"]) && isset($_GET["bit_tarih"])) {
        $bas_tarih = $_GET["bas_tarih"];
        $bit_tarih = $_GET["bit_tarih"];
        if ($bas_tarih != "" && $bit_tarih != "") {
            $sql .= " AND kk.insert_datetime BETWEEN '$bas_tarih 00:00:00' AND '$bit_tarih 23:59:59'";
        }
    }

    $sql .= "  GROUP BY kk.id";
    echo $sql;
    die();
    $tum_randevu_talepleri = DB::all_data($sql);

    if ($tum_randevu_talepleri > 0) {
        $gidecek_arr = [];
        $arac_istekleri = 0;
        $toplam_kisi = 0;
        $toplam_kurum = 0;
        foreach ($tum_randevu_talepleri as $item) {
            $toplam_kurum++;
            $toplam_kisi += $item["kisi_sayisi"];
            if ($item["ulasim_istiyorum"] == "Ulaşım İstiyorum") {
                $arac_istekleri++;
            }
            $disabled = "";
            if ($item["status"] != 1) {
                $disabled = "disabled";
            }
            $arr = [
                'talep_tarihi' => date("d/m/Y", strtotime($item["insert_datetime"])),
                'kurum_adi' => $item["kurum_adi"],
                'arac_istegi' => $item["ulasim_istiyorum"],
                'yetkili_adi' => $item["yetkili_adi"],
                'cep_no' => $item["cep_no"],
                'status' => $item["status"],
                'islem' => "<button class='btn btn-danger btn-sm talebi_reddet' $disabled data-id='" . $item["id"] . "'><i class='fa fa-close'></i></button> <button class='btn btn-sm kullaniciyi_olustur_button' data-id='" . $item["id"] . "' $disabled style='background-color: #2C7865;color: white'><i class='fa fa-check'></i></button>"
            ];
            array_push($gidecek_arr, $arr);
        }
        if (!empty($gidecek_arr)) {
            $gidecek_arr[0]["toplam_kurum"] = $toplam_kurum;
            $gidecek_arr[0]["toplam_kisi"] = $toplam_kisi;
            $gidecek_arr[0]["arac_istekleri"] = $arac_istekleri;
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
if ($islem == "randevu_taleplerini_getir_sql2") {
    $tum_randevu_talepleri = DB::all_data("
SELECT
       kk.*,
       COUNT(ko.id) as kisi_sayisi,
       ko.randevu_id,
       rt.randevu_tarih,
       rt.status as durum
FROM
     kurum_kaydi as kk
INNER JOIN kurum_ogrencileri as ko on ko.kurum_id=kk.id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE kk.status=2 AND ko.status=1  GROUP BY ko.randevu_id");

    if ($tum_randevu_talepleri > 0) {
        $gidecek_arr = [];
        $arac_istekleri = 0;
        $toplam_kisi = 0;
        $toplam_kurum = 0;
        foreach ($tum_randevu_talepleri as $item) {
            $toplam_kurum++;
            $toplam_kisi += $item["kisi_sayisi"];
            if ($item["ulasim_istiyorum"] == "Ulaşım İstiyorum") {
                $arac_istekleri++;
            }
            $disabled = "";
            if ($item["status"] != 1) {
                $disabled = "disabled";
            }
            $arr = [
                'talep_tarihi' => date("d/m/Y", strtotime($item["randevu_tarih"])),
                'kurum_adi' => $item["kurum_adi"],
                'arac_istegi' => $item["ulasim_istiyorum"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'status' => $item["durum"],
                'yetkili_adi' => $item["yetkili_adi"],
                'cep_no' => $item["cep_no"],
                'islem' => "<button class='btn btn-danger btn-sm randevu_talebi_reddet' $disabled data-id='" . $item["randevu_id"] . "'><i class='fa fa-close'></i></button> <button class='btn btn-sm randevu_kabul_et_button' $disabled data-id='" . $item["randevu_id"] . "' style='background-color: #2C7865;color: white'><i class='fa fa-check'></i></button>"
            ];
            array_push($gidecek_arr, $arr);
        }
        if (!empty($gidecek_arr)) {
            $gidecek_arr[0]["toplam_kurum"] = $toplam_kurum;
            $gidecek_arr[0]["toplam_kisi"] = $toplam_kisi;
            $gidecek_arr[0]["arac_istekleri"] = $arac_istekleri;
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
if ($islem == "gelmesi_beklenen_kurumlari_getir_sql") {
    $tum_randevu_talepleri = DB::all_data("
SELECT
       kk.*,
       COUNT(ko.id) as kisi_sayisi,
       ko.randevu_id,
       rt.randevu_tarih,
       rt.geldi,
       rt.gelmedi
FROM
     kurum_kaydi as kk
INNER JOIN kurum_ogrencileri as ko on ko.kurum_id=kk.id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE kk.status=2 AND ko.status=1 AND rt.status=2 GROUP BY ko.randevu_id");

    if ($tum_randevu_talepleri > 0) {
        $gidecek_arr = [];
        $arac_istekleri = 0;
        $toplam_kisi = 0;
        $toplam_kurum = 0;
        foreach ($tum_randevu_talepleri as $item) {
            $toplam_kurum++;
            $toplam_kisi += $item["kisi_sayisi"];
            if ($item["ulasim_istiyorum"] == "Ulaşım İstiyorum") {
                $arac_istekleri++;
            }
            $disabled = "";
            if ($item["geldi"] == 1 || $item["gelmedi"] == 1) {
                $disabled = "disabled";
            }

            $arr = [
                'talep_tarihi' => date("d/m/Y", strtotime($item["randevu_tarih"])),
                'talep_saati' => date("H:i", strtotime($item["randevu_tarih"])),
                'kurum_adi' => $item["kurum_adi"],
                'arac_istegi' => $item["ulasim_istiyorum"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'yetkili_adi' => $item["yetkili_adi"],
                'geldi' => $item["geldi"],
                'gelmedi' => $item["gelmedi"],
                'cep_no' => $item["cep_no"],
                'islem' => "<button class='btn btn-danger btn-sm randevuya_gelmedi' $disabled data-id='" . $item["randevu_id"] . "'><i class='fa fa-close'></i></button> <button class='btn btn-sm randevuya_geldi' $disabled data-id='" . $item["randevu_id"] . "' style='background-color: #2C7865;color: white'><i class='fa fa-check'></i></button>"
            ];
            array_push($gidecek_arr, $arr);
        }
        if (!empty($gidecek_arr)) {
            $gidecek_arr[0]["toplam_kurum"] = $toplam_kurum;
            $gidecek_arr[0]["toplam_kisi"] = $toplam_kisi;
            $gidecek_arr[0]["arac_istekleri"] = $arac_istekleri;
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
if ($islem == "gelen_talebi_reddet") {
    $_POST["status"] = 0;
    $_POST["delete_userid"] = $_SESSION["user_id"];
    $_POST["delete_datetime"] = date("Y-m-d H:i:s");
    $guncelle = DB::update("kurum_kaydi", "id", $_POST["id"], $_POST);
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "kullanici_adi_sifreleri_olustur_sql") {
    $_POST["update_userid"] = $_SESSION["user_id"];
    $_POST["update_datetime"] = date("Y-m-d H:i:s");
    $password = $_POST["password"];
    $_POST["status"] = 2;
    $option = [
        'cost' => 11,
    ];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $option);
    $_POST["password"] = $hashed_password;

    $guncelle = DB::update("kurum_kaydi", "id", $_POST["id"], $_POST);
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "kurum_bilgilerini_getir_sql") {
    $id = $_SESSION["user_id"];

    $bilgiler = DB::single_query("SELECT * FROM kurum_kaydi WHERE id='$id' AND status=2");
    if ($bilgiler > 0) {
        echo json_encode($bilgiler);
    } else {
        echo 2;
    }
}
if ($islem == "user_ziyaretci_randevu_talebi_sql") {
    $durum = false;
    foreach ($_POST["gidecek_arr"] as $item) {
        $tc = $item["tc_no"];
        $single_query = DB::single_query("SELECT * FROM kurum_ogrencileri WHERE (status=1 OR status=2) AND tc_no='$tc'");
        if ($single_query > 0 && $single_query["randevu_tarih"] != "0000-00-00 00:00:00") {
            $tarih1 = $single_query["randevu_tarih"];
            $tarih_yili = date("Y", strtotime($tarih1));
            $tarih = date("Y");
            if ($tarih1 == $tarih) {
                $durum = true;
            }
        } else if ($single_query["randevu_tarih"] == "0000-00-00 00:00:00") {
            $durum = true;
        }
    }

    if ($durum == true) {
        echo 300;
    } else {
        $arr = [
            'randevu_tarih' => $_POST["talep_tarihi"],
            'kurum_id' => $_SESSION["user_id"],
            'ulasim_istiyorum' => $_POST["ulasim_istiyorum"],
            'insert_datetime' => date("Y-m-d H:i:s"),
            'kisi_sayisi' => $_POST["kisi_sayisi"]
        ];
        $randevu_talep = DB::insert("randevu_talepleri", $arr);
        if ($randevu_talep) {
            echo 500;
        } else {
            $son_eklenen = DB::single_query("SELECT id FROM randevu_talepleri WHERE status=1 ORDER BY id DESC LIMIT 1");
            foreach ($_POST["gidecek_arr"] as $item) {
                $item["kurum_id"] = $_SESSION["user_id"];
                $item["insert_datetime"] = date("Y-m-d");
                $item["randevu_id"] = $son_eklenen["id"];

                $ogr_kayit = DB::insert("kurum_ogrencileri", $item);
            }
            if ($ogr_kayit) {
                echo 500;
            } else {
                echo 1;
            }
        }
    }
}
if ($islem == "gelen_randevu_talebi_reddet") {
    $_POST["status"] = 0;
    $_POST["delete_userid"] = $_SESSION["user_id"];
    $id = $_POST["id"];
    $_POST["delete_datetime"] = date("Y-m-d H:i:s");
    $kurum = DB::all_data("SELECT * FROM kurum_ogrencileri WHERE randevu_id='$id'");
    $randevu = DB::update("randevu_talepleri", "id", $_POST["id"], $_POST);
    foreach ($kurum as $item) {
        $arr = [
            'status' => 0,
            'delete_detail' => $_POST["delete_detail"],
            'delete_datetime' => date("Y-m-d H:i:s"),
            'delete_userid' => $_SESSION["user_id"]
        ];
        $guncelle = DB::update("kurum_ogrencileri", "id", $item["id"], $arr);
    }
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "randevu_talebini_onayla_sql") {
    $arr = [
        'onay' => 1,
        'onay_tarihi' => date("Y-m-d H:i:s"),
        'onay_userid' => $_SESSION["user_id"],
        'status' => 2,
        'randevu_tarih' => $_POST["randevu_tarih"]
    ];
    $guncelle = DB::update("randevu_talepleri", "id", $_POST["id"], $arr);
    if ($guncelle) {
        echo 1;
    } else {
        echo 2;
    }
}
if ($islem == "randevuya_gelmedi_olarak_isaretle") {
    $arr = [
        'gelmedi' => 1
    ];
    $update = DB::update("randevu_talepleri", "id", $_POST["id"], $arr);
    if ($update) {
        echo 1;
    } else {
        echo 500;
    }
}
if ($islem == "randevuya_geldi_olarak_isaretle") {
    $arr = [
        'geldi' => 1
    ];
    $update = DB::update("randevu_talepleri", "id", $_POST["id"], $arr);
    if ($update) {
        echo 1;
    } else {
        echo 500;
    }
}
if ($islem == "gelen_kurumlar_controller") {
    $tum_randevu_talepleri = DB::all_data("
SELECT
       kk.*,
       COUNT(ko.id) as kisi_sayisi,
       ko.randevu_id
FROM
     kurum_kaydi as kk
INNER JOIN kurum_ogrencileri as ko on ko.kurum_id=kk.id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE kk.status=2 AND ko.status=1 AND rt.status=2 AND rt.geldi=1 AND rt.gelmedi=0 GROUP BY ko.randevu_id");

    if ($tum_randevu_talepleri > 0) {
        $gidecek_arr = [];
        $arac_istekleri = 0;
        $toplam_kisi = 0;
        $toplam_kurum = 0;
        foreach ($tum_randevu_talepleri as $item) {
            $toplam_kurum++;
            $toplam_kisi += $item["kisi_sayisi"];
            if ($item["ulasim_istiyorum"] == "Ulaşım İstiyorum") {
                $arac_istekleri++;
            }

            $arr = [
                'talep_tarihi' => date("d/m/Y", strtotime($item["insert_datetime"])),
                'kurum_adi' => $item["kurum_adi"],
                'arac_istegi' => $item["ulasim_istiyorum"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'yetkili_adi' => $item["yetkili_adi"],
                'cep_no' => $item["cep_no"],
                'islem' => "<button class='btn btn-danger btn-sm randevuya_gelmedi' data-id='" . $item["randevu_id"] . "'><i class='fa fa-close'></i></button> <button class='btn btn-sm randevuya_geldi' data-id='" . $item["randevu_id"] . "' style='background-color: #2C7865;color: white'><i class='fa fa-check'></i></button>"
            ];
            array_push($gidecek_arr, $arr);
        }
        if (!empty($gidecek_arr)) {
            $gidecek_arr[0]["toplam_kurum"] = $toplam_kurum;
            $gidecek_arr[0]["toplam_kisi"] = $toplam_kisi;
            $gidecek_arr[0]["arac_istekleri"] = $arac_istekleri;
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
if ($islem == "gelmeyen_kurumlar_controller") {
    $tum_randevu_talepleri = DB::all_data("
SELECT
       kk.*,
       COUNT(ko.id) as kisi_sayisi,
       ko.randevu_id
FROM
     kurum_kaydi as kk
INNER JOIN kurum_ogrencileri as ko on ko.kurum_id=kk.id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE kk.status=2 AND ko.status=1 AND rt.status=2 AND rt.geldi=0 AND rt.gelmedi=1 GROUP BY ko.randevu_id");

    if ($tum_randevu_talepleri > 0) {
        $gidecek_arr = [];
        $arac_istekleri = 0;
        $toplam_kisi = 0;
        $toplam_kurum = 0;
        foreach ($tum_randevu_talepleri as $item) {
            $toplam_kurum++;
            $toplam_kisi += $item["kisi_sayisi"];
            if ($item["ulasim_istiyorum"] == "Ulaşım İstiyorum") {
                $arac_istekleri++;
            }

            $arr = [
                'talep_tarihi' => date("d/m/Y", strtotime($item["insert_datetime"])),
                'kurum_adi' => $item["kurum_adi"],
                'arac_istegi' => $item["ulasim_istiyorum"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'yetkili_adi' => $item["yetkili_adi"],
                'cep_no' => $item["cep_no"],
                'islem' => "<button class='btn btn-danger btn-sm randevuya_gelmedi' data-id='" . $item["randevu_id"] . "'><i class='fa fa-close'></i></button> <button class='btn btn-sm randevuya_geldi' data-id='" . $item["randevu_id"] . "' style='background-color: #2C7865;color: white'><i class='fa fa-check'></i></button>"
            ];
            array_push($gidecek_arr, $arr);
        }
        if (!empty($gidecek_arr)) {
            $gidecek_arr[0]["toplam_kurum"] = $toplam_kurum;
            $gidecek_arr[0]["toplam_kisi"] = $toplam_kisi;
            $gidecek_arr[0]["arac_istekleri"] = $arac_istekleri;
            echo json_encode($gidecek_arr);
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
if ($islem == "randevulari_getir_sql") {
    $tum_randevu_talepleri = DB::all_data("
SELECT
       kk.*,
       COALESCE (COUNT(ko.id),0) as kisi_sayisi,
       ko.randevu_id,
       DATE(rt.randevu_tarih) as gun
FROM
     kurum_kaydi as kk
INNER JOIN kurum_ogrencileri as ko on ko.kurum_id=kk.id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE kk.status=2 AND ko.status=1 AND rt.status=2 AND rt.geldi=0 AND rt.gelmedi=0 GROUP BY DATE(rt.randevu_tarih)");
    if ($tum_randevu_talepleri > 0) {
        $gidecek_arr = [];
        foreach ($tum_randevu_talepleri as $item) {
            $arr = [
                'gun' => $item["gun"],
                'kisi_sayisi' => $item["kisi_sayisi"],
                'title' => 'Kişi Sayısı: ' . $item["kisi_sayisi"],
                'start' => $item["gun"],
                'end' => $item["gun"],
                'backgroundColor' => "white",
                'textColor' => "black"
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