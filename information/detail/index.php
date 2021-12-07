<?php
ini_set('display_errors', "On");
require "../../db/reservation_settings.php"; 
require "../../db/entries.php"; 
require "../../db/accounts.php"; 
require "../../db/mail.php"; 
require "../../db/information.php"; 

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
}

$information_data = selectInformation($id);


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
      お問い合わせ・受講体験｜トラックドライバー教育のクラウド型eラーニング【グッドラーニング!】
    </title>
    <meta
      name="title"
      content="お問い合わせ・受講体験｜トラックドライバー教育のクラウド型eラーニング【グッドラーニング!】"
    />
    <meta
      name="description"
      content="グッドラーニング！についてのお問い合わせ・受講体験はこちらから受け付けております。お気軽にお問合せください。"
    />
    <meta
      name="keywords"
      content="乗務員,教育,研修,Eラーニング,指導,国交省,トラック,運送業,グッドラーニング"
    />
    <meta
      property="og:title"
      content="お問い合わせ・受講体験｜トラックドライバー教育のクラウド型eラーニング【グッドラーニング!】"
    />
    <meta property="og:type" content="article" />
    <meta
      property="og:url"
      content="https://promote.good-learning.jp/truck/contact/"
    />
    <meta
      property="og:image"
      content="https://promote.good-learning.jp/truck/common/img/shared/og_image.jpg"
    />
    <meta
      property="og:site_name"
      content="トラックドライバー教育のクラウド型eラーニング【グッドラーニング!】"
    />
    <meta
      property="og:description"
      content="グッドラーニング！についてのお問い合わせ・受講体験はこちらから受け付けております。お気軽にお問合せください。"
    />
    <link
      rel="canonical"
      href="https://promote.good-learning.jp/truck/contact/"
    />
    <link rel="stylesheet" href="https://use.typekit.net/hcg7pyj.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700"
      rel="stylesheet"
      media="print"
      onload="this.media='all'"
    />
    <link href="../common/css/default.css" rel="stylesheet" type="text/css" />
    <link href="../common/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../common/css/content.css" rel="stylesheet" type="text/css" />
    <link href="../common/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php @include($_SERVER['DOCUMENT_ROOT']."/truck/common/inc/head_before.inc")?>
  </head>

<body>

<a href="/management/reservation/"><button>管理画面一覧へ戻る</button></a>

    <div class="container">

        <form method="POST" action="change.php">

            <input type="hidden" name="id" value="<?php echo $information_data[0]['id'];?>">
       
            <h2>インフォメーション詳細変更画面</h2><br>

            <div class="form-group">
                <label>タイトル</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $information_data[0]['title'];?>">
            </div>

            <div class="form-group">
                <label>リンク</label>
                <input type="text" class="form-control" id="link" name="link" value="<?php echo $information_data[0]['link'];?>">
            </div>
            <div class="form-group">
                <label>リンク部分</label>
                <input type="text" class="form-control" id="link_part" name="link_part" value="<?php echo $information_data[0]['link_part'];?>">
            </div>
            <div class="form-group">
                <label>表示フラグ</label>
                <select name="display_flg" id="display_flg" class="form-control">
                    <option value="0" <?php if ($information_data[0]['display_flg'] == 0) {echo 'selected';} ?>>非表示</option>
                    <option value="1" <?php if ($information_data[0]['display_flg'] == 1) {echo 'selected';} ?>>表示</option>
                </select>
            </div>
            <div class="form-group">
                <label>作成時間</label><br>
                <label><?php echo $information_data[0]['created_at'];?></label><br>
            </div>
            <div class="form-group">
                <label>更新時間</label><br>
                <label><?php echo $information_data[0]['updated_at'];?></label><br>
            </div>
            <button type="submit" class="btn btn-primary">変更</button>
        </form>
    </div>

    <script src="../common/js/common.js"></script>
    <script src="../common/js/jquery.validationEngine.js"></script>
    <script src="../common/js/jquery.validationEngine-ja.js"></script>
</body>

</html>
