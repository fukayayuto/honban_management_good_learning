<?php

ini_set('display_errors', "On");
require_once "../db/mail.php";
require_once "../db/accounts.php";

$emailData = getEmailAll();

$data = array();
foreach ($emailData as $k => $val) {
    $tmp = array();

    $tmp['id'] = $val['id'];

    switch ($val['type']) {
        case 1:
            $tmp['type'] = 'メール';
            break;
        case 2:
            $tmp['type'] = 'SMS';
            break;
        default:
            break;
    }

    $date_string = substr($val['created_at'], 0, 10);


    $date = new DateTime($date_string);
    $tmp['created_at'] = $date->format('Y年m月d日');

    $email_content_id = $val['email_content_id'];
    $emailContentData = getEmailContent($email_content_id);
    $tmp['content_id'] = $emailContentData[0]['id'];
    $tmp['title'] =  mb_substr($emailContentData[0]['title'], 0, 30);
    $tmp['mail_text'] = mb_substr($emailContentData[0]['mail_text'], 0, 100);


    $adress_id = $emailContentData[0]['adress_id'];
    $account_list = getAccountList($adress_id);

    $tmp['account_list'] = '';
    foreach ($account_list as $key => $item) {
        $account_data = getAccount($item['account_id']);
        if (!empty($account_data)) {
            $tmp['account_list'] .= ',' . $account_data[0]['name'];
        }
    }
    $tmp['account_list'] = mb_substr($tmp['account_list'], 1);

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
                </div>

                <div class="container">
                    <form action="#" method="POST">

                        <h2>メール履歴一覧</h2><br>

                        <table class="table">
                            <thead>
                                <tr class="success">
                                　　<td>ID</td>
                                    <td>種類</td>
                                    <td>日付</td>
                                    <td>宛先</td>
                                    <td>本文</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($data as $k => $val) : ?>
                                    <tr>
                                        　　　<td><?php echo $val['id']; ?></td>
                                        <td><?php echo $val['type']; ?></td>
                                        <td><?php echo $val['created_at']; ?></td>
                                        <td><?php echo $val['account_list']; ?></td>
                                        <td><a href="/management/mail/detail/?id=<?php echo $val['content_id']; ?>"><?php echo $val['title']; ?></a></td>
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