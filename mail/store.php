<?php
ini_set('display_errors', "On");
require_once "../db/mail.php"; 
require_once "../db/accounts.php"; 

$account_id_list = $_POST['account_id'];
$mail_subject = $_POST['title'];
$mail_text = $_POST['mail_text'];

$data = array();

//メール送信処理
mb_language("Japanese");
mb_internal_encoding("UTF-8");

foreach ($account_id_list as $k => $account_id) {
   $account_data = getAccount($account_id);
   $name =  $account_data[0]['name'];
   $email = $account_data[0]['email'];

   $mail_body = $name . "様\n\n";
   $mail_body .= $mail_text;
   $mail_to = $email;
   $mail_header	= "from:yosuke-saito@cab-station.com";
   $mailsousin = true;

   $mailsousin = mb_send_mail($mail_to, $mail_subject, $mail_body, $mail_header);

   if($mailsousin == false){
    die("送信に失敗しました");
}
   $data[$k]['account_id'] = $account_data[0]['id'];
}

$adress_id = getAdressId();
$adress_id++;

foreach ($data as $val){

    $res = adressListStore($adress_id, $val['account_id']);
    
    if(!$res){
        die('アドレスリスト作成に失敗しました');
    }
}

$title = $mail_subject;
$mail_text = $mail_body;

$email_content_id = emailContentStore($title, $mail_text,$adress_id);

if(empty($email_content_id)){
    die('メールコンテンツの作成に失敗しました');
}

$res = emailStore($email_content_id);

if(!$res){
    die('メールの作成に失敗しました');
}
  
header('Location: http://localhost:8888/management/mail');






?>