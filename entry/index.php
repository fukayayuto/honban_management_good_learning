<?php

ini_set('display_errors', "On");
require_once "../db/reservation_settings.php";
require_once "../db/reservation.php";
require_once "../db/entries.php";
require_once "../db/accounts.php";

if(!empty($_GET['place'])){
    var_dump($_GET['place']);
    die();
}




$entry_data = getEntryAll();

$data = array();

foreach ($entry_data as $k => $entry) {
    $tmp = array();
    $tmp['id'] = $entry['id'];

    $created_at = new DateTime($entry['created_at']);
    $tmp['created_at'] = $created_at->format('Y年n月j日');
    $tmp['status'] = $entry['status'];
    $tmp['count'] = $entry['count'];

    $reservation_data = getReservation($entry['reservation_id']);

    $reserve_data = getReservatinData($reservation_data['place']);

    $account = getAccount($entry['account_id']);
    $tmp['account_name'] = $account[0]['name'];

    $reservation_name = $reserve_data['name'];
    $tmp['reservation_name'] = mb_substr($reservation_name, 0, 12);

    $start_date = new DateTime($reservation_data['start_date']);
    $tmp['start_date'] = $start_date->format('Y年n月j日');

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
                                予約状況
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
                    <a href="/management/entry/index.php"><button　type="button" class="btn btn-primary">全予約一覧</button></a>
                </div>

                <div class="container">

                <form action="/management/entry/index.php" method="get">
                    <select name="place" id="place" class="form-control">
                        <option value="1">初任者講習(会員)</option>
                        <option value="2">初任者講習(非会員)</option>
                        <option value="11">三重県会場</option>
                    </select>
                    <button type="submit" class="btn btn-secondary">検索</button>
                </form>
                    <table class="table">
                        <thead>
                            <tr class="success">
                                <th></th>
                                    <th>申し込み日時</th>
                                    <th>希望予約</th>
                                    <th>希望予約日時</th>
                                    <th>予約者氏名</th>
                                    <th>人数</th>
                                    <th>お支払い方法</th>
                                    <th>ステータス</th>
                                    <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data as $k => $val) : ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $val['created_at']; ?></td>
                                    <td><?php echo $val['reservation_name']; ?></td>
                                    <td><?php echo $val['start_date']; ?></td>
                                    <td><?php echo $val['account_name']; ?></td>
                                    <td><?php echo $val['count']; ?></td>
                                    <td></td>
                                    <?php if (($val['status']) == 0) : ?>
                                        <td><button　type="button" class="btn btn-warning">未確定</button></td>
                                    <?php elseif (($val['status']) == 1) : ?>
                                        <td><button　type="button" class="btn btn-success">確定</button></td>
                                    <?php elseif (($val['status']) == 2) : ?>
                                        <td><button　type="button" class="btn btn-danger">キャンセル</button></td>
                                    <?php endif; ?>
                                    <td><a href="/management/entry/detail/?id=<?php echo $val['id'];?>"><button　type="button" class="btn btn-primary">詳細</button></a></td>
                                </tr>
                            <?php endforeach; ?>
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