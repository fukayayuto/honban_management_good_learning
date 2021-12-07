<?php

ini_set('display_errors', "On");
require_once "../../db/accounts.php"; 
require_once "../../db/mail_template.php"; 

$template_data = getMailTemplateAll();


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

            <table class="table">
                <thead>
                    <tr class="success">
                        <th>ID</th>
                        <th>使用箇所</th>
                        <th>件名</th>
                        <th>メール本文</th>
                        <th>更新日時</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($template_data as $k => $val) :?>
                        <tr>
                        　　 <td><?php echo $val['id'];?></td>
                        　　 <td><a href="/management/mail/template/detail/?id=<?php echo $val['id'];?>"><?php echo $val['method'];?></a></td>
                            <td><?php echo $val['title'];?></td>
                            <td style="white-space:pre-wrap;"><?php echo $val['text'];?></td>
                            <td><?php echo $val['updated_at'];?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
    </div>
</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"> --}}


</html>
