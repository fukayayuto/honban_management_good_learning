<?php

ini_set('display_errors', "On");
require_once "../db/information.php"; 

$information_data = getInformation();


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
        <form action="store.php" method="post">
            <textarea name="link" id="link" cols="30" rows="3" placeholder="URL" required></textarea>
            <textarea name="title" id="title" cols="30" rows="3" placeholder="TITLE" required></textarea>
            <textarea name="link_part" id="link_part" cols="30" rows="3" placeholder="URL部分" required></textarea>
            <button class="submit">新規登録</button>
        </form>
    </div>

    <br>

    <div class="container">
        <table class="table">
            <thead>
                <tr class="success"> 
                   <th>ID</th>
                   <th>URL</th>
                   <th>タイトル</th>
                   <th>URL部分</th>
                   <th>表示フラグ</th>
                   <th>更新日時</th>
                   <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($information_data as $k => $val) :?>
                    <tr>
                        <td><?php echo $val['id'];?></td>
                        <td><a href="<?php echo $val['link'];?>"><?php echo $val['link'];?></a></td>
                        <td><?php echo $val['title'];?></td>
                        <td><?php echo $val['link_part'];?></td>
                        <?php if($val['display_flg'] == 1) :?>
                            <td>表示</td>
                        <?php else :?>
                            <td>非表示</td>
                        <?php endif;?>
                        <td><?php echo $val['updated_at'];?></td>
                        <td><a href="/management/information/detail?id=<?php echo $val['id'];?>"><button>変更</button></a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
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
