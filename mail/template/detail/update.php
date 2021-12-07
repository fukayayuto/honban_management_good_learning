<?php

ini_set('display_errors', "On");
require_once "../../../db/mail_template.php"; 

$title = $_POST['title'];
$text = $_POST['text'];
$id = $_POST['id'];



$res = updateMailTemplate($title,$text,$id);

if(!$res){
    header('Location: http://localhost:8888/management/mail/template/');
}

?>
