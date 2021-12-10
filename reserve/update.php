<?php

ini_set('display_errors', "On");
require "../db/reservation_settings.php"; 
require "../db/reservation.php"; 

if(empty($_POST['id'])){
    header('Location: http://localhost:8888/management/reserve');
}

$reservation_id = $_POST['id'];
$start_date = $_POST['start_date'];
$place = $_POST['place'];


$res = updateReservation($reservation_id,$start_date,$place);

if(!$res){
    die('更新に失敗しました');
}

header('Location: http://localhost:8888/management/reserve/list/?id=' . $reservation_id);


?>