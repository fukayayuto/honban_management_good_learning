<?php

define('HOSTNAME', 'localhost');
define('DATABASE', 'e_learning');
define('USERNAME', 'root');
define('PASSWORD', 'root');

function dbConect(){
    try {
    /// DB接続を試みる
    $pdo = null;
    $pdo  = new PDO('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD);
    $msg = "MySQL への接続確認が取れました。";
    } catch (PDOException $e) {
    $isConnect = false;
    $msg       = "MySQL への接続に失敗しました。<br>(" . $e->getMessage() . ")";
    }
    return $pdo;
}


?>
