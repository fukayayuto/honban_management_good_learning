<?php

require_once "db.php"; 

function entryStore($account_id,$reservation_id,$count){
    
    $pdo = dbConect();


    $stmt = $pdo->prepare("INSERT INTO entries (
                account_id, reservation_id, count
            ) VALUES (
               :account_id, :reservation_id, :count
             )");
    $stmt->bindValue(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->bindValue(':reservation_id', $reservation_id, PDO::PARAM_INT);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $res = $stmt->execute();

    $pdo = null;

    return $res;
}

function getEntry($id){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM entries WHERE reservation_id = :id ");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $res = $stmt->execute();

    $data = null;
    
    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $pdo = null;

    return $data;
}


?>
