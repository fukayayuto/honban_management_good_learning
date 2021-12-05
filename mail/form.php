<?php

ini_set('display_errors', "On");
require_once "../db/mail.php"; 
require_once "../db/accounts.php"; 

if(!empty($_POST)){
    $check_list = $_POST['check'];

    $account_list = '';
    $data = array();
    foreach ($check_list as $k => $val) {
        $tmp = array();
        $tmp['account_id'] = $val;
        $accountData = getAccount($val);

        $account_list .= ',' . $accountData[0]['name'];
        $data[$k] = $tmp;
    }
    $account_list = mb_substr($account_list,1);
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

    <div class="container">

        <form action="confirm.php" method="post">
        
        <?php foreach ($data as $val):?>
            <input type="hidden" name="account_id[]" id="account_id[]" value="<?php echo $val['account_id'];?> ">
        <?php endforeach;?>

            <div class="form-group">
                <label>宛先</label><br>
                <label><?php echo $account_list;?></label>
            </div>

            <div class="form-group">
                <label>タイトル</label><br>
                <input type="text" name="title" id="title" class="form-control" require>
            </div>

            <div class="form-group">
                <label>メール本文</label><br>
                <textarea name="mail_text" id="mail_text" rows="10" class="form-control"></textarea>
            </div>

            <button type="submit">確認画面へ</button>
            
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
