<?php

ini_set('display_errors', "On");
require_once "../db/information.php"; 

$title = $_POST['title'];
$link = $_POST['link'];
$link_part = $_POST['link_part'];
$priority = $_POST['priority'];
$display_flg = $_POST['display_flg'];



$res = informationStore($title,$link,$link_part,$priority,$display_flg);

if(!$res){
    die('information失敗しました');
}

header('Location: http://localhost:8888/management/information/');




?>