<?php

ini_set('display_errors', "On");
require_once "db/mail.php";
require_once "db/accounts.php";
require "db/reservation_settings.php";
require "db/reservation.php";
require "db/entries.php";


$date = date("Y-m-d", strtotime('+1 day'));
$reservation_data = getTomorrowData($date);
$err = '';


foreach ($reservation_data as $val) {

    $reserve_data = getReservatinData($val['place']);
    $entry_data = getEntry($val['id']);

    foreach ($entry_data as $data) {

        $reservation_name = $reserve_data['name'];
        $count = $data['count'];

        $start_date = new DateTime($val['start_date']);
        $week = array("日", "月", "火", "水", "木", "金", "土");
        $start_week = $week[$start_date->format("w")];

        $start_date = new DateTime($val['start_date']);
        $start_date = $start_date->format('Y年n月j日');

        $account = getAccount($data['account_id']);
        $account_name = $account[0]['name'];
        $account_id =  $account[0]['id'];

        $mail_subject = "【グッドラーニング！】「初任運転者講習」の受講開始の前日となりました。";

        $mail_body = $account_name . "様\n\n";
        $mail_body .= "【グッドラーニング！】「初任運転者講習」の受講開始の前日となりました。\n";
        $mail_body .= "受講に関するご不明点は、03-6880-1072（コールセンター／平日9:30～12:00 13:00～17:00）または、icts01@cab-station.com までご連絡ください。\n";
        $mail_body .= "----\n";
        $mail_body .= "◆ご予約内容:\n";
        $mail_body .= $reservation_name . "\n";
        $mail_body .= "◆予約人数:\n";
        $mail_body .= $count . "\n";
        $mail_body .= "◆提供者:\n";
        $mail_body .= "◆予約日時:\n";
        $mail_body .= $start_date . '(' . $start_week . ')' . "08:00 ~ 20:00\n";
        $mail_body .= "----\n\n";
        $mail_body .= "◆◆◆グッドラーニング！運営事務局◆◆◆\n";
        $mail_body .= "株式会社キャブステーション　ICTソリューション事業部\n";
        $mail_body .= "TEL：03-6880-1072　FAX：03-6880-1075\n";
        $mail_body .= "Mail：icts01@cab-station.com\n";

        $mail_to = $account[0]['email'];
        $mail_header    = "from:icts01@cab-station.com";

        //メール送信処理
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $res = mb_send_mail($mail_to, $mail_subject, $mail_body, $mail_header);

        if(!$res){

            $mail_to	= "yuto.fukaya@cab-station.com";
            $mail_subject	= "予約前日の自動送信に失敗しました";
            $mail_header	= "from:icts01@cab-station.com" ;
            $mail_body = $account_name . "様へのメール送信に失敗しました";

            mb_send_mail($mail_to, $mail_subject, $mail_body, $mail_header);
        }
    
        $adress_id = getAdressId();
        $adress_id++;

        $res = adressListStore($adress_id, $account_id);

        $title = $mail_subject;
        $mail_text = $mail_body;

        $email_content_id = emailContentStore($title, $mail_text, $adress_id);

        $res = emailStore($email_content_id);

    }

    
}

