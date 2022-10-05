<?php
//セッション維持
session_start();

//ライブラリ呼び出し
require('lib/library.php');

//変数の初期化
$error = [];

//初期画面、前質問アクセスチェック
if (!isset($_SESSION['start']) || !isset($_SESSION['diagnosis1']) || !isset($_SESSION['diagnosis2'])) {
    header('Location: .');
    exit();
}

//post処理時のsql操作
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //diagnosis3.phpアクセスチェック
    $_SESSION['diagnosis3'] = 'ok';

    //formのvalue格納
    $cosmetics = h($_POST['cosmetics']);

    //空欄チェック
    if ($cosmetics === '') {
        $error['ratio'] = 'blank';
    } else {
        //セッション変数にラジオボタンのvalueを格納
        $_SESSION['cosmetics'] = $cosmetics;

        //結果画面へリダイレクト
        header('Location: result.php');

        unset($_SESSION['start']);
        exit();
    }
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
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="."><img src="images/lip_diagnosis_header.png" alt=""></a>
        </div>
        <div class="<?php if (isset($error['ratio']) && $error['ratio'] === 'blank') {
            echo h('content_error');
         } else {
            echo h('content_question');
         } ?>">
            <form action="" method="post" class="lip_questions">
                <?php if (isset($error['ratio']) && $error['ratio'] === 'blank') { ?>
                    <div class="error">
                        <p>選択されていない項目があります</p>
                    </div>
                <?php } ?>
                <div class="question_wrapper">
                    <div class="question">
                        <div class="question_text">
                           <p>Q3.探したいコスメの種類</p>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="cosmetics" value="デパコス" id="cosmetics_1">
                            <label for="cosmetics_1">デパコス</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="cosmetics" value="プチプラ" id="cosmetics_2">
                            <label for="cosmetics_2">プチプラ</label>
                        </div>
                    </div>
                </div>
                <div class="<?php if (isset($error['ratio']) && $error['ratio'] === 'blank') {
                    echo h('question_submit_error');
                 } else {
                    echo h('question_submit');
                 } ?>">
                    <button type="submit" class="submit_btn">
                      <p>診断！</p>
                    </button>
                </div>
            </form>
            <div class="<?php if (isset($error['ratio']) && $error['ratio'] === 'blank') {
                   echo h('home_error');
                } else {
                   echo h('home');
                } ?>">
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