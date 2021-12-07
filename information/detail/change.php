<?php
ini_set('display_errors', "On");
require "../../db/reservation_settings.php"; 
require "../../db/entries.php"; 
require "../../db/accounts.php"; 
require "../../db/mail.php"; 
require "../../db/information.php"; 


$id = $_POST['id'];
$title = $_POST['title'];
$link = $_POST['link'];
$link_part = $_POST['link_part'];
$display_flg = $_POST['display_flg'];

$res = updateInformation($title,$link,$link_part,$display_flg,$id);

if(!$res){
    die('更新に失敗しました');
}

header('Location: http://localhost:8888/management/information/');



?>
