<?php

ini_set('display_errors', "On");
require_once "../../../db/accounts.php"; 
require_once "../../../db/mail_template.php"; 

if(!empty($_GET['id'])){
    $id = $_GET['id'];
}

$data = getMailTemplate($id);


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
        <form method="POST" action="confirm.php">

        <input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>">
        <input type="hidden" name="method" id="method" value="<?php echo $data['method'];?>">
           
            <div class="form-group">
                <label><?php echo $data['method'];?></label>
            </div>
           
            <div class="form-group">
                <label>件名</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title'];?>">
            </div>
            <div class="mb-3">
                <label>本文</label>
                <textarea class="form-control" name="text" style="height: 100vh;"><?php echo $data['text'];?></textarea>
              </div>
            <button type="submit" class="btn btn-primary">編集</button>
        </form>
    </div>

</body>
</html>


