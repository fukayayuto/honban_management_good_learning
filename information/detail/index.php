<?php
ini_set('display_errors', "On");
require "../../db/reservation_settings.php";
require "../../db/entries.php";
require "../../db/accounts.php";
require "../../db/mail.php";
require "../../db/information.php";

if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];
}

$information_data = selectInformation($id);


?>


<html lang="ja">

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

<body>

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

          <form method="POST" action="change.php">

            <input type="hidden" name="id" value="<?php echo $information_data[0]['id']; ?>">

            <h2>インフォメーション詳細変更画面</h2><br>

            <div class="form-group">
              <label>タイトル</label>
              <input type="text" class="form-control" id="title" name="title" value="<?php echo $information_data[0]['title']; ?>">
            </div>

            <div class="form-group">
              <label>リンク</label>
              <input type="text" class="form-control" id="link" name="link" value="<?php echo $information_data[0]['link']; ?>">
            </div>
            <div class="form-group">
              <label>リンク部分</label>
              <input type="text" class="form-control" id="link_part" name="link_part" value="<?php echo $information_data[0]['link_part']; ?>">
            </div>
            <div class="form-group">
              <label>表示フラグ</label>
              <select name="display_flg" id="display_flg" class="form-control">
                <option value="0" <?php if ($information_data[0]['display_flg'] == 0) {
                                    echo 'selected';
                                  } ?>>非表示</option>
                <option value="1" <?php if ($information_data[0]['display_flg'] == 1) {
                                    echo 'selected';
                                  } ?>>表示</option>
              </select>
            </div>
            <div class="form-group">
              <label>優先度</label>
              <select name="priority" id="priority" class="form-control">
                <option value="0" <?php if ($information_data[0]['priority'] == 0) {
                                    echo 'selected';
                                  } ?>>通常</option>
                <option value="1" <?php if ($information_data[0]['priority'] == 1) {
                                    echo 'selected';
                                  } ?>>優先</option>
              </select>
            </div>
            <div class="form-group">
              <label>作成時間</label><br>
              <label><?php echo $information_data[0]['created_at']; ?></label><br>
            </div>
            <div class="form-group">
              <label>更新時間</label><br>
              <label><?php echo $information_data[0]['updated_at']; ?></label><br>
            </div>
            <button type="submit" class="btn btn-primary">変更</button>
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
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="/docs/4.4/assets/js/vendor/anchor.min.js"></script>
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