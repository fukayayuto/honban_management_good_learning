<?php

ini_set('display_errors', "On");
require_once "../../db/accounts.php";
require_once "../../db/entries.php";
require_once "../../db/reservation.php";
require_once "../../db/reservation_settings.php";

if (empty($_GET['id'])) {
  header('Location: http://localhost:8888/management/account');
}
$id = $_GET['id'];

$account = getAccount($id);
$name = $account[0]['name'];
$email = $account[0]['email'];
$company_name = $account[0]['company_name'];
$sales_office = $account[0]['sales_office'];
$phone = $account[0]['phone'];
$memo = $account[0]['memo'];
$created_at = $account[0]['created_at'];
$updated_at = $account[0]['updated_at'];

$entry_data = selectAccount($id);

$data = array();

foreach ($entry_data as $k => $val) {
  $tmp = array();
  $tmp['id'] = $val['id'];
  $tmp['count'] = $val['count'];
  $tmp['created_at'] = $val['created_at'];

  $reservation_data = getReservation($val['reservation_id']);

  $start_date = new DateTime($reservation_data['start_date']);
  $tmp['start_date'] = $start_date->format('Y年n月j日');

  $reserve_data = getReservatinData($reservation_data['place']);

  $tmp['name'] = $reserve_data['name'];
  $tmp['progress'] = $reserve_data['progress'];

  $data[$k] = $tmp;
}



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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <!-- <h1 class="h2">Dashboard</h1> -->
          <h1 class="h3">エントリー一覧</h1>
        </div>


        <?php if (!empty($data)) : ?>
          <?php foreach ($data as $val) : ?>
            <div class="card-deck mb-3 text-center">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal"><?php echo $val['name']; ?></h4>
                </div>
                <div class="card-body">
                  <label>受講開始日: <?php echo $val['start_date']; ?></label><br>
                  <label>人数: <?php echo $val['count']; ?>人</label>
                  <a href="/management/entry/detail/?id=<?php echo $val['id'];?>"><button type="button" class="btn btn-lg btn-block btn-outline-primary">予約詳細を見る</button></a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>


        <form class="needs-validation" action="edit.php" method="post">

          <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

          <div class="row">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">顧客情報</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>氏名</td>
                  <td><?php echo $name; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>メールアドレス</td>
                  <td><?php echo $email; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>会社名</td>
                  <td><?php echo $company_name; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>営業所</td>
                  <td><?php echo $sales_office; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>電話番号</td>
                  <td><?php echo $phone; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>顧客メモ</td>
                  <td style="white-space:pre-wrap;"><?php echo $memo; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>登録日時</td>
                  <td><?php echo $created_at; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td>更新日時</td>
                  <td><?php echo $updated_at; ?></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>


          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">顧客内容を変更する</button>
        </form>
    </div>
    </main>
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