<?php
ini_set('display_errors', "On");
require_once "../../db/accounts.php"; 


if(empty($_POST['id'])){
    header('Location: http://localhost:8888/management/account');
}
$id = $_POST['id'];

$account = getAccount($id);
$name = $_POST['name'];
$email = $_POST['email'];
$company_name = $_POST['company_name'];
$sales_office = $_POST['sales_office'];
$phone = $_POST['phone'];
$memo = $_POST['memo'];

$res = updateAccount($id,$name,$email,$company_name,$sales_office,$phone,$memo);


header('Location: http://localhost:8888/management/account/detail/?id='.$id);

?>