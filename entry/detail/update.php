
<?php

ini_set('display_errors', "On");
require_once "../../db/reservation_settings.php";
require_once "../../db/reservation.php";
require_once "../../db/entries.php";
require_once "../../db/accounts.php";

if (empty($_POST['id'])) {
    header('Location: http://localhost:8888/management/entry');
}


$entry_id = $_POST['id'];
$status = $_POST['status'];

$res = updateEntry($entry_id,$status);

header('Location: http://localhost:8888/management/entry/detail?id=' . $entry_id);



?>