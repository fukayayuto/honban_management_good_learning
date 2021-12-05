<?php

ini_set('display_errors', "On");
require_once "../db/accounts.php"; 


if(!empty($_POST)){
    $check_list = $_POST['check'];
    $data = array();

    foreach ($check_list as $k => $val) {
        $tmp = array();

        $accountData = getAccount($val['id']);
   
        $tmp['id'] = $accountData[0]['id'];
        $tmp['name'] = $accountData[0]['name'];
        $tmp['email'] = $accountData[0]['email'];

        $data[$k] = $tmp; 
    }

}else{

    $account_data = getAccountAll();
    $data = array();

    foreach ($account_data as $k => $val) {
        $tmp = array();
        $tmp['id'] = $val['id'];
        $tmp['name'] = $val['name'];
        $tmp['email'] = $val['email'];

        $data[$k] = $tmp;
    }

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
        <table class="table">

        <form action="form.php" method="POST">
            <button type="submit">確認する</button>

          　<thead>
              <tr>
                  <td></td>
                  <td>顧客名</td>
                  <td>Email</td>
              </tr>

           </thead>

            <tbody>               
                <?php foreach ($data as $val):?>
                        <tr>
                            <td><input type="checkbox" id="check" name="check[]" value="<?php echo $val['id'];?>" checked></td>
                            <td><?php echo $val['name'];?></td>
                            <td><?php echo $val['email'];?></td>
                        </tr>
                <?php endforeach;?>
              
            </tbody>
        </form>
        </table>
    </div>
</body>

</html>