<?php
//セッション維持
session_start();

//ライブラリ呼び出し
require('lib/library.php');

//diagnosis.phpアクセスチェック
if (!isset($_SESSION['diagnosis'])) {
    header('Location: .');
    exit();
}

//db接続
$db = dbconnect();
 //sql構文準備
$stmt = $db->prepare('select maker, name, url from lips where cosmetics=? and color=? and texture=? and type=?');
if (!$stmt) {
    die($db->error);
}
 //sql実行
$stmt->bind_param('ssss', $_SESSION['cosmetics'], $_SESSION['color'], $_SESSION['texture'], $_SESSION['type']);
$success = $stmt->execute();
if (!$success) {
    die($db->error);
}
 //対象のメーカー、リップ名とurlの格納
$stmt->bind_result($maker, $name, $url);

//アクセスチェックのリセット
unset($_SESSION['diagnosis']);

// // /テスト
// echo h($_SESSION['cosmetics']);
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
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="."><img src="images/lip_diagnosis_header.png" alt=""></a>
        </div>
        <div class="content">
            <p>あなたに合うリップは・・・</p>
            <?php while ($stmt->fetch()) { ?>
            <div class="lip_example">
                <p>▼<?php echo h($maker); ?> 『<?php echo h($name); ?>』</p>
                <p>https://<?php  echo h($url);?></p>
            </div>
            <?php } ?>
            <a href=".">スタート画面に戻る</a>
        </div>
        <div class="footer_wrapper">
            <div class="footer">
                <div class="footer_img">
                    <a href="."><img src="images/lip_diagnosis_footer.png" alt=""></a>
                </div>
                <!-- <div class="footer_contact">
                    <a href="ozx1010@outlook.jp">お問い合わせ</a>
                </div> -->
                <div class="footer_copyright">
                    <p>&copy; 2022 Yutaro Ozumi</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>