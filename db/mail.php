<?php

require_once "db.php"; 

function getAdressId(){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT MAX(adress_id) as id FROM adress_lists ");
    $res = $stmt->execute();
    $id = 1;
    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id = $data[0]['id'];
    }
    
    $pdo = null;

    return $id;
}

function adressListStore($adress_id, $account_id){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("INSERT INTO adress_lists (
            account_id, adress_id
        ) VALUES (
           :account_id, :adress_id
         )");
    $stmt->bindValue(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->bindValue(':adress_id', $adress_id, PDO::PARAM_INT);
    $res = $stmt->execute();

    $pdo = null;

    return $res;
}
    
function emailContentStore($title, $mail_text){
    
       $pdo = dbConect();

        $stmt = $pdo->prepare("INSERT INTO email_contents (
                title, mail_text
            ) VALUES (
               :title, :mail_text
             )");
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':mail_text', $mail_text, PDO::PARAM_STR);
        $res = $stmt->execute();

        $id = 1;
        if( $res ) {
            $id = $pdo -> lastInsertId();
        }
        
        $pdo = null;
    
        return $id;
}
    
function emailStore($adress_id, $email_content_id){
    
   $pdo = dbConect();
   
    $stmt = $pdo->prepare("INSERT INTO emails (
            adress_id, email_content_id, type
        ) VALUES (
           :adress_id, :email_content_id,:type
         )");
    $stmt->bindValue(':adress_id', $adress_id, PDO::PARAM_INT);
    $stmt->bindValue(':email_content_id', $email_content_id, PDO::PARAM_INT);
    $stmt->bindValue(':type', 1, PDO::PARAM_INT);
    $res = $stmt->execute();

    $pdo = null;

    return $res;
}




?>
