<?php

ini_set('display_errors', "On");
require_once "../../db/reservation_settings.php"; 
require_once "../../db/reservation.php"; 

//三重県登録用
$id = 11;
if(!empty($_POST['start_date'])){
    $start_date = $_POST['start_date'];
}

$reserve_data = getReservatinData($id);

$place = $id;
$progress = $reserve_data['progress'];
$count = $reserve_data['count'];

$res = reseveStore($place,$start_date);

if(!$res){
    die('予約の登録に失敗しました。');
}

header('Location: http://localhost:8888/management/reserve/mie');

?>