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

function selectAccount($account_id){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM entries WHERE account_id = :account_id ");
    $stmt->bindValue(':account_id', $account_id, PDO::PARAM_INT);
    $res = $stmt->execute();

    $data = null;
    
    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $pdo = null;

    return $data;
}

function getEntryAll(){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM entries ORDER BY id DESC ");
    $res = $stmt->execute();

    $data = null;
    
    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $pdo = null;

    return $data;
}

function selectEntry($id){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM entries WHERE id = :id ");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $res = $stmt->execute();

    $data = null;
    
    if( $res ) {
        $data = $stmt->fetch();
    }
    $pdo = null;

    return $data;
}

function updateEntry($entry_id,$status){
    
    $pdo = dbConect();

    date_default_timezone_set('Asia/Tokyo');
    $date = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("UPDATE entries SET  status = :status, updated_at = :updated_at  WHERE  id = :id;");
        $stmt->bindValue(':id', $entry_id, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', $date, PDO::PARAM_STR);
        $res = $stmt->execute();

    
    $pdo = null;

    return $res;
}




?>
