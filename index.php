<?php
//セッション維持
session_start();

//初期画面アクセスチェック
$_SESSION['start'] = 'ok';

//問い合わせメール処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //formのvalue格納
    $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    //メール送信のための情報準備
    $to = 'lipdiagnosis@gmail.com';
    $subject = $from . '様からのお問い合わせ';
    $headers = 'From: ' . $from;

    //メール送信
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    mb_send_mail($to, $subject, $message, $headers);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <title>リップ診断</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti:wght@500&display=swap" rel="stylesheet">
    <meta name="google-site-verification" content="gGUMV41R7ziv64-16zDY3d5VsUhdAQmNWwQG3yOP0ok" />
</head>
<body>
    <div class="container">
        <div class="header_top">
            <a href="."><img src="images/lip_diagnosis_header.png" alt=""></a>
        </div>
        <div class="content">
            <div class="content_img">
                <div class="img_wrapper">
                    <img class="sp" src="images/NKJ56_ripglosskesyouhin_TP_V4_3.jpg" alt="">
                    <img class="pc" src="images/NKJ56_ripglosskesyouhin_TP_V_6.jpg" alt="">
                </div>
                <div class="content_str">
                    <p>あなたに合うリップを診断します</p>
                </div>
                <div class="content_arrow">
                    <img src="images/arrow_under.png" alt="">
                    <div class="content_arrow_str">
                        <p>start</p>
                    </div>
                </div>
            </div>
            <div class="content_str_btn">
                <div class="content_btn">
                    <a href="diagnosis1.php">診断開始！</a>
                </div>
            </div>
        </div>
        <div class="footer_wrapper">
            <div class="footer_top">
                <div class="footer_mail">
                    <p class="footer_mail_str">▼ お問い合わせはこちら</p>
                    <div class="footer_mail_form">
                        <form action="" method="post">
                            <div class="footer_mail_form_address">
                                <p class="footer_mail_form_str">メールアドレス</p><input type="text" name="from" class="mail_text">
                            </div>
                            <div class="footer_mail_form_content">
                                <p class="footer_mail_form_str">お問い合わせ内容</p><textarea name="message" class="content_text"></textarea>
                            </div>
                            <button type="submit" class="footer_mail_form_send">
                              <p>送信</p>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="footer_img">
                    <a href="."><img src="images/lip_diagnosis_footer.png" alt=""></a>
                </div>
                <div class="footer_copyright">
                    <p>&copy; 2022 Yutaro Ozumi</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>