<?php

ini_set('display_errors', "On");
require_once "../db/reservation_settings.php"; 
require_once "../db/reservation.php"; 
require_once "../db/entries.php"; 
require_once "../db/accounts.php"; 

$reservation_id = $_POST['reservation_id'];
$account_id = $_POST['account_id'];
$count = $_POST['count'];

$res = entryStore($account_id,$reservation_id,$count);

if(!$res){
    die('予約登録に失敗しました');
}

header('Location: http://localhost:8888/management/reserve/list/?id=' . $reservation_id);





?>