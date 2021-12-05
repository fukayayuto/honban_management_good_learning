<?php

ini_set('display_errors', "On");
require_once "../db/mail.php"; 
require_once "../db/accounts.php"; 

$emailData = getEmailAll();

$data = array();
foreach ($emailData as $k => $val) {
    $tmp = array();
   
    $tmp['id'] = $val['id'];

    switch ($val['type']) {
        case 1:
            $tmp['type'] = 'メール';
            break;
        case 2:
            $tmp['type'] = 'SMS';
            break;
        default:
            break;
    }

    $date_string = substr($val['created_at'],0 ,10);
   
  
    $date = new DateTime($date_string);
    $tmp['created_at'] = $date->format('Y年m月d日');

    $email_content_id = $val['email_content_id'];
    $emailContentData = getEmailContent($email_content_id);
    $tmp['content_id'] = $emailContentData[0]['id'];
    $tmp['title'] =  mb_substr($emailContentData[0]['title'], 0, 30);
    $tmp['mail_text'] = mb_substr($emailContentData[0]['mail_text'], 0, 100);


    $adress_id = $emailContentData[0]['adress_id'];
    $account_list = getAccountList($adress_id);

    $tmp['account_list'] = '';
    foreach ($account_list as $key => $item) {
        $account_data = getAccount($item['account_id']);
        $tmp['account_list'] = $tmp['account_list'] . $account_data[0]['name'];
    }


   
    $data[$k] = $tmp;
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
    <form action="#" method="POST">
        <table class="table">
            <thead>
                <tr class="success">
                　 　<td>ID</td>
               　　　<td>種類</td>
                    <td>日付</td>
                    <td>宛先</td>
                    <td>タイトル</td>
                    <td>内容</td>
                </tr>
            </thead>
           
            <tbody>
                 <?php foreach ($data as $k => $val) :?>
                        <tr>
                       　　　<td><?php echo $val['id'];?></td>
                            <td><?php echo $val['type'];?></td>
                            <td><?php echo $val['created_at'];?></td>
                            <td><?php echo $val['account_list'];?></td>
                            <td><a href="/management/mail/detail/?id=<?php echo $val['content_id'];?>"><?php echo $val['title'];?></a></td>
                            <td style="white-space:pre-wrap;"><?php echo $val['mail_text'];?></td>
                        </tr>
                 <?php endforeach;?>
            </tbody>
        </table>
     </form>
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
