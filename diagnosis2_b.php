<?php
//セッション維持
session_start();

//ライブラリ呼び出し
require('lib/library.php');

//変数の初期化
$error = [];

//初期画面、前質問アクセスチェック
if (!isset($_SESSION['start']) || !isset($_SESSION['diagnosis1'])) {
    header('Location: .');
    exit();
}

//post処理時のsql操作
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //diagnosis2.phpアクセスチェック
    $_SESSION['diagnosis2'] = 'ok';

    //formのvalue格納
    $texture = h($_POST['texture']);
    // $texture = filter_input(INPUT_POST, 'texture', FILTER_SANITIZE_STRING);

    //空欄チェック
    if ($texture === null) {
        $error['ratio'] = 'blank';
    } else {
        //セッション変数にラジオボタンのvalueを格納
        $_SESSION['texture'] = $texture;

        //Q3画面へリダイレクト
        header('Location: diagnosis3.php');

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
                            <p>Q2.ティントリップの好みの種類</p>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="ウォータータイプ" id="texture_1">
                            <label for="texture_1">ウォータータイプ</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="オイルタイプ" id="texture_2">
                            <label for="texture_2">オイルタイプ</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="バームタイプ" id="texture_3">
                            <label for="texture_3">バームタイプ</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="グロス・リキッドタイプ" id="texture_4">
                            <label for="texture_4">グロス・リキッドタイプ</label>
                        </div>
                        <!-- <div class="question_choice">
                            <input type="radio" name="texture" value="マットタイプ" id="texture_5">
                            <label for="texture_5">マットタイプ</label>
                        </div> -->
                    </div>
                </div>
                <div class="<?php if (isset($error['ratio']) && $error['ratio'] === 'blank') {
                    echo h('question_submit_error');
                 } else {
                    echo h('question_submit');
                 } ?>">
                    <button type="submit" class="submit_btn">
                      <p>次の質問へ</p>
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