<?php

require_once "db.php"; 

function accountStore($name,$email,$compnay_name,$phone,$sales_office){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("INSERT INTO accounts (
                name, email, company_name, sales_office, phone
            ) VALUES (
               :name, :email, :company_name,:sales_office, :phone
             )");
    $date = new DateTime();
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':company_name', $compnay_name, PDO::PARAM_STR);
    $stmt->bindValue(':sales_office', $sales_office, PDO::PARAM_STR);
    $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
    $res = $stmt->execute();

    if( $res ) {
        $id = $pdo -> lastInsertId();
    }
    $pdo = null;

    return $id;
}

function getAccount($id){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE id = :id ");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $res = $stmt->execute();

    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $pdo = null;

    return $data;

    
}

function getAccountAll(){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM accounts ORDER BY ID DESC");
    $res = $stmt->execute();

    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $pdo = null;

    return $data;

    
}

function updateAccount($id,$name,$email,$company_name,$sales_office,$phone,$memo){
    
    $pdo = dbConect();

    date_default_timezone_set('Asia/Tokyo');
    $date = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("UPDATE accounts SET  name = :name, email = :email, company_name = :company_name, sales_office = :sales_office, phone = :phone , memo = :memo , updated_at = :updated_at WHERE  id = :id;");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':company_name', $company_name, PDO::PARAM_STR);
        $stmt->bindValue(':sales_office', $sales_office, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
        $stmt->bindValue(':updated_at', $date, PDO::PARAM_STR);
        $res = $stmt->execute();

    $pdo = null;

    return $res;
}






?>
