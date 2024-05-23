<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
class DB
{
    private static $db;

    public static function connect() {
        try {
            $config = include 'config.php';
            self::$db = new PDO("mysql:host=" . $config["host"] . ";dbname=" . $config["dbname"] . ";charset=utf8mb4", $config["username"], $config["password"]);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public static function insert($table, $data) {
        $keys = array_keys($data);
        $values = array_values($data);

        $placeholders = implode(',', array_fill(0, count($keys), '?'));

        $query = "INSERT INTO $table (" . implode(',', $keys) . ") VALUES ($placeholders)";

        $stmt = self::$db->prepare($query);
        $insert = $stmt->execute($values);
    }

    public static function delete($tablo, $sutun, $id, $eksorgu = "")
    {

        $sorgu = self::$db->query("delete from $tablo where $eksorgu $sutun='$id'");
        $sil = $sorgu->execute();
        if ($sil)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function arrayislemi($deger)
    {
        $sonuc = implode(",", array_map(function ($deg) {
            return $deg . "=?";
        }, array_keys($deger)));

        return $sonuc;
    }


    public static function update($tablo, $sutun, $id, $deger, $silinecek1 = "", $silinecek2 = "", $ekkosul = "")
    {

        unset($deger["$silinecek1"]);
        unset($deger["$silinecek2"]);
        if (isset($deger['files'])) {
            unset($deger["files"]);
        }
        try {
            $values = self::arrayislemi($deger);
            $sorgu = self::$db->prepare("UPDATE $tablo SET $values WHERE $ekkosul $sutun='" . $id . "'");
            $ekle = $sorgu->execute(array_values($deger));
            if ($ekle) {
                return TRUE;
            } else {
                throw new Exception(implode($sorgu->errorInfo()), 1);
            }
        } catch (Exception $e) {
            $_SESSION['hata'] = $e->getMessage();
            return FALSE;
        }
    }

    public static function single_query($sorgu)
    {
        try {
            $sorgu = self::$db->prepare($sorgu);
            $sorgu->execute();
            $say = $sorgu->rowcount();

            //pre($sorgu->debugDumpParams());
            if ($say == 0) {
                throw new Exception(implode($sorgu->errorInfo()), 1);
                //return ["sonuc"=> FALSE, "hata" => $sorgu->errorInfo()];
            } else {
                return $sorgu->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            $_SESSION['hata'] = $e->getMessage();
            return FALSE;
        }
    }

    public static function all_data($sql){
        $sorgu = self::$db->query($sql);
        $url_array = array();
        while ($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            $url_array[] = $cikti;
        }
        if($url_array){

            return $url_array;
        }else{
            return false;
        }
    }
}