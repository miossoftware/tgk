<?php
include 'DB.php';
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Istanbul');
session_start();
DB::connect();
$islem = $_GET["islem"];
if ($islem == "register_user") {
    $password = $_POST["user_password"];
    $_POST["insert_datetime"] = date("Y-m-d H:i:s");
    $option = [
        'cost' => 11,
    ];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $option);
    $_POST["user_password"] = $hashed_password;
    $kullanici_ekle = DB::insert("users", $_POST);
    if ($kullanici_ekle) {
        echo 2;
    } else {
        echo 1;
    }
}
if ($islem == "authentication") {
    $username = $_POST["username"];
    $password = $_POST["user_password"];
    $login = DB::single_query("select * from users where username='$username' and status=1");
    if ($login > 0) {
        $hash_password = $login["user_password"];// VT DEĞERİ
        if (password_verify($password, $hash_password)) {
            $id = $login["id"];
            $root = $login["user_root"];
            $_SESSION["name_surname"] = $login["name_surname"];
            $_SESSION["user_id"] = $id;
            $_SESSION["user_root"] = $root;
            echo 1;
        } else {
            echo 3;
        }
    } else {
        echo 2;
    }
}
if ($islem == "logout") {
    $id = $_SESSION["user_id"];
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    echo 1;
}
if ($islem == "kullanicilari_getir") {
    $veri = DB::all_data("SELECT * FROM users");
    if ($veri > 0) {
        echo json_encode($veri);
    } else {
        echo 2;
    }
}
if ($islem == "get_all_panels_for_root") {
    $paneller = DB::all_data("SELECT * FROM panels");
    if ($paneller > 0) {
        echo json_encode($paneller);
    } else {
        echo 2;
    }
}
if ($islem == "user_authentication"){
    $username = $_POST["username"];
    $password = $_POST["user_password"];
    $login = DB::single_query("select * from kurum_kaydi where username='$username' and status=2");
    if ($login > 0) {
        $hash_password = $login["password"];// VT DEĞERİ
        if (password_verify($password, $hash_password)) {
            $id = $login["id"];
            $_SESSION["name_surname"] = $login["kurum_adi"];
            $_SESSION["user_id"] = $id;
            echo 1;
        } else {
            echo 3;
        }
    } else {
        echo 2;
    }
}