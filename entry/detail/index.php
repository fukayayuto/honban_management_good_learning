<?php

ini_set('display_errors', "On");
require_once "../../db/reservation_settings.php";
require_once "../../db/reservation.php";
require_once "../../db/entries.php";
require_once "../../db/accounts.php";

if (empty($_GET['id'])) {
    header('Location: http://localhost:8888/management/entry');
}

$entry_id = $_GET['id'];
$entry_data = selectEntry($entry_id);

$reservation_data = getReservation($entry_data['reservation_id']);

$reserve_data = getReservatinData($reservation_data['place']);

$reservation_id = $reservation_data['id'];
$reservation_name = $reserve_data['name'];
$start_date = $reservation_data['start_date'];
$created_at = $entry_data['created_at'];
$status = $entry_data['status'];

$account = getAccount($entry_data['account_id']);
$account_id = $account[0]['id'];
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
                                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">予約詳細を見る</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>



                    <div class="row">
                        <table class="table">
                            <form action="edit.php" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $entry_id;?>">

                        　　<thead>
                                <tr>
                                    <th scope="col">エントリー情報</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                    <td>予約講座名</td>
                                    <td><?php echo $reservation_name; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>予約開始日</td>
                                    <td><?php echo $start_date; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ステータス</td>
                                    <?php if ($status == 0) : ?>
                                        <td><button　type="button" class="btn btn-warning">未確定</button></td>
                                    <?php elseif ($status == 1) : ?>
                                        <td><button　type="button" class="btn btn-success">確定</button></td>
                                    <?php elseif ($status == 2) : ?>
                                        <td><button　type="button" class="btn btn-danger">キャンセル</button></td>
                                    <?php endif; ?>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>予約申込日</td>
                                    <td><?php echo $created_at; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-primary btn-lg btn-block" type="submit">エントリー詳細を変更する</button></a></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                            </form>


                            <thead>
                                <tr>
                                    <th scope="col">顧客情報</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>予約者名</td>
                                    <td><?php echo $account_name; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>予約者メールアドレス</td>
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
                                    <td><a href="/management/account/detail/?id=<?php echo $account_id;?>"><button class="btn btn-primary btn-lg btn-block" type="submit">顧客内容を変更する</button></a></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    
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