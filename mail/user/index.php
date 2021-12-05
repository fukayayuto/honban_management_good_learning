<?php

ini_set('display_errors', "On");
require_once "../../db/accounts.php"; 

$account_data = getAccountAll();
$data = array();

foreach ($account_data as $k => $val) {
    $tmp = array();
    $tmp['id'] = $val['id'];
    $tmp['name'] = $val['name'];
    $tmp['email'] = $val['email'];
    $tmp['company_name'] = $val['company_name'];

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

        <form action="/management/mail/check.php" method="post">
            <a href="/management/mail/check.php"><button type="button"> 全員に一斉メールを送信する</button></a>
            <button type="submit"> 選択したユーザーにメールを送信する</button>

            <table class="table">
                <thead>
                    <tr class="success">
                        <th></th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>会社名</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $k => $val) :?>
                        <tr>
                            <td><input type="checkbox" id="check" name="check[][id]" value="<?php echo $val['id'];?>"></td>
                            <td><?php echo $val['name'];?></td>
                            <td><?php echo $val['email'];?></td>
                            <td><?php echo $val['company_name'];?></td>
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
