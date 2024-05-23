<?php

$yol = __DIR__ . "/Sms/SmsApi.php";
require_once($yol);
include 'DB.php';
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Istanbul');
session_start();
DB::connect();
$smsApi = new SmsApi("panel4.ekomesaj.com", "epromnet", "4y8F6lOnuHR4", "9588");

$islem = $_GET["islem"];
if ($islem == "tekil_sms_yolla_sql") {
    $id = $_POST["id"];

    $bilgiler = DB::single_query("SELECT * FROM kurum_kaydi WHERE id='$id'");

    $tel_no = "90" . $bilgiler["cep_no"];

    $request = new SendSingleSms();
    $request->title = "TARSUS GENÇLİK KAMPI";
    $request->content = "TARSUS GENÇLİK KAMPI KULLANICILIK BAŞVURUNUZ REDDEDİLMİŞTİR RED NEDENİ; \n" . $bilgiler["delete_detail"] . " İYİ VE SAĞLIKLI GÜNLER DİLERİZ";
    $request->number = $tel_no;
    $request->encoding = 0;
    $request->type = 1;
    $request->recipientType = 0;
    $request->sendingType = 0;
    $request->sender = "EKOMESAJ";

    $response = $smsApi->sendSingleSms($request);
    if ($response->err == null) {
        echo "MessageId: " . $response->pkgID . "\n";
        $arr = [
            "message_id" => $response->pkgID
        ];
        $guncelle = DB::update("kurum_kaydi", "id", $id, $arr);
    } else {
        echo "Status: " . $response->err->status . "\n";
        echo "Code: " . $response->err->code . "\n";
        echo "Message: " . $response->err->message . "\n";
    }
}
if ($islem == "randevu_red_sms_yolla_sql") {
    $id = $_POST["id"];

    $bilgiler = DB::single_query("
SELECT
       kk.cep_no,
       rt.delete_detail
FROM
     kurum_ogrencileri as ko
INNER JOIN kurum_kaydi as kk on kk.id=ko.kurum_id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE ko.randevu_id='$id'");

    $tel_no = "90" . $bilgiler["cep_no"];

    $request = new SendSingleSms();
    $request->title = "TARSUS GENÇLİK KAMPI";
    $request->content = "TARSUS GENÇLİK KAMPI RANDEVU BAŞVURUNUZ REDDEDİLMİŞTİR RED NEDENİ; \n" . $bilgiler["delete_detail"] . " İYİ VE SAĞLIKLI GÜNLER DİLERİZ";
    $request->number = $tel_no;
    $request->encoding = 0;
    $request->type = 1;
    $request->recipientType = 0;
    $request->sendingType = 0;
    $request->sender = "EKOMESAJ";

    $response = $smsApi->sendSingleSms($request);
    if ($response->err == null) {
        echo "MessageId: " . $response->pkgID . "\n";
        $arr = [
            "message_id" => $response->pkgID
        ];
        $guncelle = DB::update("randevu_talepleri", "id", $id, $arr);
    } else {
        echo "Status: " . $response->err->status . "\n";
        echo "Code: " . $response->err->code . "\n";
        echo "Message: " . $response->err->message . "\n";
    }
}
if ($islem == "kullanici_sms_yolla_sql") {
    $id = $_POST["id"];

    $bilgiler = DB::single_query("SELECT * FROM kurum_kaydi WHERE id='$id'");

    $tel_no = "90" . $bilgiler["cep_no"];

    $request = new SendSingleSms();
    $request->title = "TARSUS GENÇLİK KAMPI";
    $request->content = "TARSUS GENÇLİK KAMPI KULLANICILIĞINIZ OLUŞTURULDU  \n KULLANICI ADINIZ:" . $_POST["kullanici_adi"] . " \n ŞİFRENİZ:" . $_POST["sifre"];
    $request->number = $tel_no;
    $request->encoding = 0;
    $request->type = 1;
    $request->recipientType = 0;
    $request->sendingType = 0;
    $request->sender = "EKOMESAJ";

    $response = $smsApi->sendSingleSms($request);
    if ($response->err == null) {
        echo "MessageId: " . $response->pkgID . "\n";
        $arr = [
            "user_messsageid" => $response->pkgID
        ];
        $guncelle = DB::update("kurum_kaydi", "id", $id, $arr);
    } else {
        echo "Status: " . $response->err->status . "\n";
        echo "Code: " . $response->err->code . "\n";
        echo "Message: " . $response->err->message . "\n";
    }
}
if ($islem == "randevu_onay_mesaj_yolla") {
    $id = $_POST["id"];

    $bilgiler = DB::single_query("
SELECT
       kk.cep_no,
       rt.randevu_tarih
FROM
     kurum_ogrencileri as ko
INNER JOIN kurum_kaydi as kk on kk.id=ko.kurum_id
INNER JOIN randevu_talepleri as rt on rt.id=ko.randevu_id
WHERE ko.randevu_id='$id'");

    $tel_no = "90" . $bilgiler["cep_no"];

    $request = new SendSingleSms();
    $request->title = "TARSUS GENÇLİK KAMPI";
    $request->content = "TARSUS GENÇLİK KAMPI RANDEVUNUZ ONAYLANMIŞTIR  \n RANDEVU TARİHİNİZ:" . $bilgiler["randevu_tarih"]." ".$_POST["aciklama"];
    $request->number = $tel_no;
    $request->encoding = 0;
    $request->type = 1;
    $request->recipientType = 0;
    $request->sendingType = 0;
    $request->sender = "EKOMESAJ";

    $response = $smsApi->sendSingleSms($request);
    if ($response->err == null) {
        echo "MessageId: " . $response->pkgID . "\n";
        $arr = [
            "message_id" => $response->pkgID
        ];
        $guncelle = DB::update("randevu_talepleri", "id", $id, $arr);
    } else {
        echo "Status: " . $response->err->status . "\n";
        echo "Code: " . $response->err->code . "\n";
        echo "Message: " . $response->err->message . "\n";
    }
}
if ($islem == "cogul_mesaj_yolla_sql") {
    $request = new SendMultiSms();
    $request->title = $_POST["baslik"];
    $request->content = $_POST["mesaj_icerigi"];
    $request->numbers = [$_POST["telefonlar"]];
    $request->encoding = 0;
    $request->sender = "EKOMESAJ";

//Kendi sistemindeki id ‘ler ile eşleştirme yapabilmek için kullanılan parametre
//$request->customID = "mesajId101";

//Ticari gönderimlerde true değeri girilmelidir.
//$request->commercial = true;

//Mesajların AHS sorgusuna sokulması istenmiyorsa true değeri girilmelidir.
//$request->skipAhsQuery = true;

//İleri tarihli gönderim için
//$request->sendingDate = "2021-01-10 13:00";

//Rapor push olarak alınmak isteniyorsa ilgili url girilir
//$request->pushUrl = "https://webhook.site/8d7ed0f7"

    $response = $smsApi->sendMultiSms($request);

    if ($response->err == null) {
        echo "MessageId: " . $response->pkgID . "\n";
    } else {
        echo "Status: " . $response->err->status . "\n";
        echo "Code: " . $response->err->code . "\n";
        echo "Message: " . $response->err->message . "\n";
    }
}
