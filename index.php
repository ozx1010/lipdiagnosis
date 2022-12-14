<?php
//セッション維持
session_start();

//初期画面アクセスチェック
$_SESSION['start'] = 'ok';
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
    <meta name="Twitter:card" content="summary_large_image">
    <meta name="Twitter:site" content="@lipdiagnosis">
    <meta name="Twitter:title" content="リップ診断">
    <meta name="Twitter:description" content="あなたにおすすめのリップを見つけましょう！">
    <meta name="Twitter:image" content="https://lipdiagnosis.com/images/twitter_img.png">
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
                    <p>あなたにおすすめのリップを診断します</p>
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