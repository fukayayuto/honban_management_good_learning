<?php
ini_set('display_errors', "On");
require_once "../db/mail.php"; 
require_once "../db/accounts.php"; 

$account_id_list = $_POST['account_id'];

foreach ($account_id_list as $k => $account_id) {
    var_dump($account_id);
    die();
}



?>