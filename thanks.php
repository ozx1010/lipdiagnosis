<?php
//セッション維持
session_start();

//ライブラリ呼び出し
require('lib/library.php');

//問い合わせ画面アクセスチェック
if (!isset($_SESSION['inquiry'])) {
    header('Location: .');
    exit();
}

//アクセスチェックのリセット
unset($_SESSION['inquiry']);
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
        <div class="header">
            <a href="."><img src="images/lip_diagnosis_header.png" alt=""></a>
        </div>
        <div class="thanks">
            <div class="thanks_headline">
                <p>お問い合わせが送信されました</p>
            </div>
            <div class="thanks_str">
                <p>お問い合わせいただきありがとうございます。
                <br>
                    後日回答メールをお送りいたします。
                </p>
            </div>
            <div class="back_home">
                <p><a href=".">ホームへ</a></p>
            </div>
        </div>

        <div class="footer_wrapper">
            <div class="footer">
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