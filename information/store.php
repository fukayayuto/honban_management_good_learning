<?php

ini_set('display_errors', "On");
require_once "../db/information.php"; 

$title = $_POST['title'];
$link = $_POST['link'];
$link_part = $_POST['link_part'];

$res = informationStore($title,$link,$link_part);

if(!$res){
    die('information失敗しました');
}

header('Location: http://localhost:8888/management/information/');




?>