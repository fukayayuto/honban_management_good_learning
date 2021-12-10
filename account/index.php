<?php

ini_set('display_errors', "On");
require_once "../db/accounts.php"; 

$count = 0;
$data = array();

$name = '';
$email = '';
$company_name = '';
if(!empty($_GET['name'])){

    $count++;
    $name = $_GET['name'];
    $account_data = getSearchFromName($name);
}

if(!empty($_GET['email'])){

    $count++;
    $email = $_GET['email'];
    var_dump($email);
    die();
    $account_data = getSearchFromEmail($email);

}
if(!empty($_GET['company_name'])){
    $count++;
    $company_name = $_GET['company_name'];
    $account_data = getSearchFromCompanyname($company_name);

}

if($count <= 0){
    $account_data = getAccountAll();
}

foreach ($account_data as $k => $val) {
    $tmp = array();
    $tmp['id'] = $val['id'];
    $tmp['name'] = $val['name'];
    $tmp['email'] = $val['email'];
    $tmp['company_name'] = $val['company_name'];
    $tmp['sales_office'] = '';
    if(!empty($val['sales_office'])){
        $tmp['sales_office'] = $val['sales_office'];
    }
    $tmp['phone'] = $val['phone'];
    $tmp['updated_at'] = $val['updated_at'];
    
    $data[$k] = $tmp;
}


   


?>

<html lang="ja" >
  <head>
    <title>グットラーニング管理画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
    <link href="../example.css" rel="stylesheet">
    <link href='http://localhost:8888/management/fullcalendar-5.10.1/lib/main.css' type="text/css" rel='stylesheet' />
    <link href='http://localhost:8888/management/fullcalendar-5.10.1/lib/main.min.css' type="text/css" rel='stylesheet' />
 
    <script src="http://localhost:8888/management/fullcalendar-5.10.1/lib/main.js"></script>
    <script src="http://localhost:8888/management/fullcalendar-5.10.1/lib/main.min.js"></script>

  </head>
  <body >

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="/management">
              <span data-feather="home"></span>
              <!-- Dashboard <span class="sr-only">(current)</span> -->
              ホーム <span class="sr-only">(現在位置)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/management/reserve">
              <span data-feather="file"></span>
              <!-- Orders -->
              予約講座
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/management/account">
              <span data-feather="users"></span>
              <!-- Products -->
              顧客
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/management/mail">
              <span data-feather="mail"></span>
              <!-- Customers -->
              メール配信
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/management/information">
              <span data-feather="bar-chart-2"></span>
              <!-- Reports -->
              インフォメーション
            </a>
          </li>
        </ul>

       
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">管理画面</h1>
      </div>

      <div class="container">

      <form action="/management/account" method="get">
            <input type="text" name="name" id="name" placeholder="氏名" value="<?php echo $name;?>">
            <input type="text" name="email" id="email" placeholder="メールアドレス" value="<?php echo $email;?>">
            <input type="text" name="company_name" id="company_name" placeholder="会社名" value="<?php echo $company_name;?>">
            <button type="submit" class="btn btn-secondary">検索</button>
        </form>

      <form action="/management/mail/check.php" method="post">
            <a href="/management/mail/check.php"><button type="button" class="btn btn-warning"> 全員に一斉メールを送信する</button></a>
            <button type="submit" class="btn btn-primary"> 選択したユーザーにメールを送信する</button>

            <table class="table">
                <thead>
                    <tr class="success">
                        <th></th>
                        <th>ユーザーID</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>会社名</th>
                        <th>営業所</th>
                        <th>電話番号</th>
                        <th>更新日時</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $k => $val) : ?>
                        <tr>
                            <td><input type="checkbox" id="check" name="check[][id]" value="<?php echo $val['id'];?>"></td>
                            <td><a href="/management/account/detail/?id=<?php echo $val['id']; ?>"><?php echo $val['id']; ?></a></td>
                            <td><?php echo $val['name']; ?></td>
                            <td><?php echo $val['email']; ?></td>
                            <td><?php echo $val['company_name']; ?></td>
                            <td><?php echo $val['sales_office']; ?></td>
                            <td><?php echo $val['phone']; ?></td>
                            <td><?php echo $val['updated_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </form>
   　　</div>

    </main>
  </div>
</div>


<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script><script src="/docs/4.4/assets/js/vendor/anchor.min.js"></script>
<script src="/docs/4.4/assets/js/vendor/clipboard.min.js"></script>
<script src="/docs/4.4/assets/js/vendor/bs-custom-file-input.min.js"></script>
<script src="/docs/4.4/assets/js/src/application.js"></script>
<script src="/docs/4.4/assets/js/src/search.js"></script>
<script src="/docs/4.4/assets/js/src/ie-emulation-modes-warning.js"></script>
  </body>
</html>


<!-- 
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
        <br>
        <a href="/management/reservation/">予約管理画面</a><br>
        <a href="/management/information/">インフォメーション管理画面</a><br>
        <a href="/management/user/">ユーザー管理画面</a><br>
        <a href="/management/mail/">メール管理画面</a><br>
    </div>
</body>

</html> -->