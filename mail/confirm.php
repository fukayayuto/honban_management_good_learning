<?php

ini_set('display_errors', "On");
require_once "../db/accounts.php"; 

$account_id_list = $_POST['account_id'];
$account_list = '';
$data = array();

foreach ($account_id_list as $k => $val) {
    $tmp = array();
    $tmp['account_id'] = $val;
    $account_data = getAccount($val);
    $account_list .= ',' . $account_data[0]['name'];
    $data[$k] = $tmp;
}
$account_list = mb_substr($account_list,1);
$title = $_POST['title'];
$mail_text = $_POST['mail_text'];

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

    <div class="container">

        <form action="store.php" method="post">

            <?php foreach ($data as $val):?>
                <input type="hidden" name="account_id[]" id="account_id[]" value="<?php echo $val['account_id'];?> ">
            <?php endforeach;?>

            <input type="hidden" name="title" id="title" value="<?php echo $title;?> ">
            <input type="hidden" name="mail_text" id="mail_text" value="<?php echo $mail_text;?> ">


            <div class="form-group">
                <label>宛先</label><br>
                <label><?php echo $account_list;?></label>
            </div>

            <div class="form-group">
                <label>タイトル</label><br>
                <label><?php echo $title;?><</label><br>
            </div>

            <div class="form-group">
                <label>メール本文</label><br>
                <label><?php echo $mail_text;?><</label><br>
            </div>

            <button type="submit">送信する</button>
            
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
