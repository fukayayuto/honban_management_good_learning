<?php



$data = array();
$data['id'] = $_POST['id'];
$data['title'] = $_POST['title'];
$data['text'] = $_POST['text'];



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
        <form method="POST" action="update.php">

        <input type="hidden" name="id" value="<?php echo $data['id'];?>">
        <input type="hidden" name="title" value="<?php echo $data['title'];?>">
        <input type="hidden" name="text" value="<?php echo $data['text'];?>">

            <div class="form-group">
                <label><?php echo $data['method'];?></label>
            </div>
           
            <div class="form-group">
                <label>件名</label><br>
                <label><?php echo $_POST['title'];?></label>
            </div>
            <div class="mb-3">
                <label>本文</label><br>
                <label style="white-space:pre-wrap;"><?php echo $data['text'];?></label>
              </div>
            <button type="submit" class="btn btn-primary">編集</button>
        </form>
    </div>

</body>
</html>


