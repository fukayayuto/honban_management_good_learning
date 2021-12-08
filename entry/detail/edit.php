
<?php

ini_set('display_errors', "On");
require_once "../../db/reservation_settings.php";
require_once "../../db/reservation.php";
require_once "../../db/entries.php";
require_once "../../db/accounts.php";

if (empty($_POST['id'])) {
    header('Location: http://localhost:8888/management/entry');
}




$entry_id = $_POST['id'];
$entry_data = selectEntry($entry_id);

$reservation_data = getReservation($entry_data['reservation_id']);

$reserve_data = getReservatinData($reservation_data['place']);

$reservation_id = $reservation_data['id'];
$reservation_name = $reserve_data['name'];
$start_date = $reservation_data['start_date'];
$created_at = $entry_data['created_at'];
$status = $entry_data['status'];

$account = getAccount($entry_data['account_id']);
$account_name = $account[0]['name'];
$email = $account[0]['email'];

$company_name = $account[0]['company_name'];
$sales_office = $account[0]['sales_office'];
$phone = $account[0]['phone'];
$memo = $account[0]['memo'];




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
                </div>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <!-- <h1 class="h2">Dashboard</h1> -->
                    <h1 class="h3">エントリー詳細</h1>
                </div>


                <div class="col-md-8 order-md-1">
                <h4 class="mb-3">予約講座作成</h4>
                <form class="needs-validation" action="update.php" method="post" >
                    <input type="hidden" name="id" id="id" value="<?php echo $entry_id;?>">
                    <div class="row">
                    <div class="col-md-12">
                        <label for="firstName">予約講座名: <?php echo $reservation_name;?></label>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-12">
                        <label for="lastName">予約開始日: <?php echo $start_date;?></label><br>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-12">
                        <label for="lastName">ステータス:</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="0"　<?php if($status == 0){ echo 'selected';}?>>未確定</option>
                            <option value="1" <?php if($status == 1){ echo 'selected';}?>>確定</option>
                            <option value="2" <?php if($status == 2){ echo 'selected';}?>>キャンセル</option>
                        </select>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-12">
                        <label for="lastName">予約申込日:<?php echo $created_at;?></label>
                    </div>
                </div>

        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">変更する</button>
      </form>
    </div>
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