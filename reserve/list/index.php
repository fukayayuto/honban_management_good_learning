<?php

ini_set('display_errors', "On");
require "../../db/reservation_settings.php"; 
require "../../db/reservation.php"; 
require "../../db/entries.php"; 
require "../../db/accounts.php"; 

if($_GET['id']){
    $id = $_GET['id'];
}

$data = array();

$reservation_data = getReservation($id);
$reserve_data = getReservatinData($reservation_data['place']);
$reservation_id = $reservation_data['id'];
$reservation_name = $reserve_data['name'];
$place = $reserve_data['id'];
$reservation_name = mb_substr($reservation_name, 0,25);
$progress = $reserve_data['progress'];
$count = $reserve_data['count'];

$start_date = new DateTime($reservation_data['start_date']);
$start_date = $start_date->format('Y年n月j日');

$entry = getEntry($id);
$left_seat = $count;

$entry_data = array();

if(!empty($entry)){
    foreach ($entry as $k => $item) {
        $tmp = array();
        $account_data = getAccount($item['account_id']);
        $tmp['id'] = $item['id'];
        $tmp['account_id'] = $account_data[0]['id'];
        $tmp['name'] = $account_data[0]['name'];
        $tmp['status'] = $item['status'];
        $tmp['count'] = $item['count'];
        $tmp['created_at'] = $item['created_at'];
        if($item['status'] != 2){
          $left_seat = $left_seat - $item['count'];
        }
        $entry_data[$k] = $tmp;
    }
}



?>


<html lang="ja" >
  <head>
    <title>グットラーニング管理画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
    <link href="../example.css" rel="stylesheet">

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
              予約状況
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="/management/mail">
              <span data-feather="shopping-cart"></span>
              <!-- Products -->
              顧客
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/management/user">
              <span data-feather="users"></span>
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

    <!-- 編集部分 -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">予約状況</h1>

      </div>

      <div class="container">

        <table class="table">
            <thead>
                <tr class="success">
                    <th>講座名</th>
                    <th>開始日</th>
                    <th>所用日数</th>
                    <th>定員枠</th>
                    <th>残り定員枠</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?php echo $reservation_name;?></td>
                    <td><?php echo $start_date;?></td>
                    <td><?php echo $progress;?>日</td>
                    <td><?php echo $count;?>人</td>
                    <td><?php echo $left_seat;?>人</td>
                    <?if($place != 2):?>
                    <td><a href="/management/reserve/edit.php?id=<?php echo $reservation_id;?>"><button　type="button" class="btn btn-primary">予約内容を変更する</button></a></td>
                    <?php else: ?>
                      <td></td>
                    <?php endif;?>
                </tr>
            </tbody>          
        </table>

        <table class="table">
            <thead>
                <tr class="success">
                    <th>申し込み日時</th>
                    <th>予約人数</th>
                    <th>予約者の氏名</th>
                    <th>お支払い方法</th>
                    <th>ステータス</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($entry_data as $val):?>
                <tr>
                    <td><?php echo $val['created_at'];?></td>
                    <td><?php echo $val['count'];?></td>
                    <td><a href="/management/account/detail/?id=<?php echo $val['account_id'];?>"><?php echo $val['name'];?></a></td>
                    <td></td>
                    
                    <?php if(($val['status']) == 0):?>
                        <td><button　type="button" class="btn btn-warning">未確定</button></td>
                    <?php elseif(($val['status']) == 1):?>
                        <td><button　type="button" class="btn btn-success">確定</button></td>
                    <?php elseif(($val['status']) == 2):?>
                      <td><button　type="button" class="btn btn-danger">キャンセル</button></td>
                    <?php endif;?>
                    <td><a href="/management/entry/detail/?id=<?php echo $val['id'];?>"><button　type="button" class="btn btn-primary">詳細</button></a></td>
                    
                </tr>
                <?php endforeach;?>
            </tbody>          
        </table>
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
