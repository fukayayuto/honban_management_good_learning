<?php

ini_set('display_errors', "On");
require_once "../../db/mail.php"; 
require_once "../../db/accounts.php"; 

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
}

$data = array();
$email_content_data = getEmailContent($id);
$data['title'] = $email_content_data[0]['title'];
$data['mail_text'] = $email_content_data[0]['mail_text'];
$data['created_at'] = $email_content_data[0]['created_at'];

$account_list = getAccountList($email_content_data[0]['adress_id']);

$data['account_list'] = '';
    foreach ($account_list as $key => $item) {
        $account_data = getAccount($item['account_id']);
        $data['account_list'] = $data['account_list'] . $account_data[0]['name'];
}


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理画面</title>
</head>

<body>

    <a href="/management/"><button>管理画面一覧へ戻る</button></a><br>

    <div class="container">
    <a href="/management/mail/select/index"><button> 全員に一斉メールを送信する</button></a>


        <h2>インフォメーション詳細変更画面</h2><br>

        <div class="form-group">
            <label>宛先</label><br>
            <label><?php echo $data['account_list'];?></label>
        </div>

        <div class="form-group">
            <label>タイトル</label><br>
            <label><?php echo $data['title'];?></label>
        </div>

        <div class="form-group">
            <label>メール本文</label><br>
            <label style="white-space:pre-wrap;"><?php echo $data['mail_text'];?></label>
        </div>
        <div class="form-group">
            <label>送信日時</label><br>
            <label><?php echo $data['created_at'];?></label>
        </div>
   
    </div>
</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
    <script>
        var options = {
          valueNames: [ 'id', 'name']
        };
        
        var userList = new List('users', options);
        
        // 初期状態はidで昇順ソートする
        userList.sort( 'id', {order : 'asc' });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"> --}}


</html>
