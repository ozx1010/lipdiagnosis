<?php
//セッション維持
session_start();

//ライブラリ呼び出し
require('lib/library.php');

//問い合わせメール処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //formのvalue格納
    $from = h($_POST['from']);
    $message = h($_POST['message']);

    //入力内容有無確認
    if ($from === '' || $message === '') {
        $error['inquiry'] = 'blank';
    } else {
        //inquiry.phpアクセスチェック
        $_SESSION['inquiry'] = 'ok';

        //メール送信のための情報準備
        $to = 'lipdiagnosis@gmail.com';
        $subject = $from . '様からのお問い合わせ';
        $headers = 'From: ' . $from;

        //メール送信
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        mb_send_mail($to, $subject, $message, $headers);

        //thanksページへリダイレクト
        header('Location: thanks.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-247562795-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-247562795-1');
    </script>
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
        <div class="header">
            <a href="."><img src="images/lip_diagnosis_header.png" alt=""></a>
        </div>
        <div class="<?php if (isset($error['inquiry']) && $error['inquiry'] === 'blank') {
                    echo h('inquiry_str_error');
                 } else {
                    echo h('inquiry_str');
                 } ?>">
            <?php if (isset($error['inquiry']) && $error['inquiry'] === 'blank') { ?>
                <div class="error">
                    <p class="error_str">入力されていない項目があります</p>
                </div>
            <?php } ?>
            <p class="inquiry_str_main">▼ お問い合わせフォーム</p>
            <p class="inquiry_str_sub">お問い合わせ内容を記載し送信を押してください</p>
        </div>
        <!-- <div class="mail_form"> -->
        <div class="<?php if (isset($error['inquiry']) && $error['inquiry'] === 'blank') {
                    echo h('mail_form_error');
                 } else {
                    echo h('mail_form');
                 } ?>">
            <form action="" method="post">
                <div class="mail_form_address">
                    <p class="mail_form_str">メールアドレス</p><input type="text" name="from" class="mail_text">
                </div>
                <div class="mail_form_content">
                    <p class="mail_form_str">お問い合わせ内容</p><textarea name="message" class="content_text"></textarea>
                </div>
                <button type="submit" class="mail_form_send">
                  <p>送信</p>
                </button>
            </form>
            <div class="back_home">
                <p><a href=".">ホームへ</a></p>
            </div>
        </div>
        <div class="footer_wrapper">
            <div class="footer">
                <p class="footer_twitter_str"><a href="https://twitter.com/lipdiagnosis">twitterはこちら</a></p>
                <p class="footer_mail_str"><a href="./inquiry.php">お問い合わせはこちら</a></p>
                <div class="footer_img">
                    <a href="."><img src="images/lip_diagnosis_footer.png" alt=""></a>
                </div>
                <div class="footer_copyright">
                    <p>Copyright (c) 2022 ozx1010</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>