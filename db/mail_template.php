<?php

require_once "db.php"; 

function getMailTemplateAll(){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("SELECT * FROM mail_template ORDER BY ID DESC");
    $res = $stmt->execute();

    $data = null;
    
    if( $res ) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $pdo = null;

    return $data;
}


function getMailTemplate($id){
    
    $username = 'root';
    $password = 'root';
    $pdo = new PDO("mysql:host=localhost;dbname=e_learning;",  $username,  $password
               ,  array(
                       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                      )
              );

    $stmt = $pdo->prepare("SELECT * FROM mail_template WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $res = $stmt->execute();

    $data = null;
    
    if( $res ) {
        $data = $stmt->fetch();
    }
    $pdo = null;

    return $data;
}

function updateMailTemplate($title,$text,$id){
    
    $pdo = dbConect();

    $stmt = $pdo->prepare("UPDATE mail_template SET  title = :title, text = :text WHERE  id = :id;");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':text', $text, PDO::PARAM_STR);
    $res = $stmt->execute();

    return $res;
}

?>