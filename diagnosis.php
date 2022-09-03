<?php
//セッション維持
session_start();

//ライブラリ呼び出し
require('lib/library.php');

//変数の初期化
$error = [];

//初期画面アクセスチェック
if (!isset($_SESSION['start'])) {
    header('Location: .');
    exit();
}


//post処理時のsql操作
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //diagnosis.phpアクセスチェック
    $_SESSION['diagnosis'] = 'ok';

    //formのvalue格納
    $cosmetics = filter_input(INPUT_POST, 'cosmetics', FILTER_SANITIZE_STRING);
    // $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
    $texture = filter_input(INPUT_POST, 'texture', FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

    //空欄チェック
    if ($cosmetics === null | $texture === null | $type === null) {
        $error['ratio'] = 'blank';
    } else {
        //セッション変数にラジオボタンのvalueを格納
        $_SESSION['cosmetics'] = $cosmetics;
        // $_SESSION['color'] = $color;
        $_SESSION['texture'] = $texture;
        $_SESSION['type'] = $type;

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
                           <p>Q1.探したいコスメの種類</p>
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
                <!-- <div class="question_wrapper">
                    <div class="question">
                        <div class="question_text">
                            <p>Q2.好みのリップの色合い</p>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="color" value="赤系" id="color_1">
                            <label for="color_1">赤系</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="color" value="ピンク系" id="color_2">
                            <label for="color_2">ピンク系</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="color" value="オレンジ系" id="color_3">
                            <label for="color_3">オレンジ系</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="color" value="ベージュ系" id="color_4">
                            <label for="color_4">ベージュ系</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="color" value="ブラウン系" id="color_5">
                            <label for="color_5">ブラウン系</label>
                        </div>
                    </div>
                </div> -->
                <div class="question_wrapper">
                    <div class="question">
                        <div class="question_text">
                            <p>Q2.好みのリップの質感</p>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="シアー" id="texture_1">
                            <label for="texture_1">シアー</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="マット" id="texture_2">
                            <label for="texture_2">マット</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="ラメ" id="texture_3">
                            <label for="texture_3">ラメ</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="texture" value="ツヤ" id="texture_4">
                            <label for="texture_4">ツヤ</label>
                        </div>
                    </div>
                </div>
                <div class="question_wrapper">
                    <div class="question">
                        <div class="question_text">
                            <p>Q3.好みのリップの種類</p>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="type" value="リップスティック" id="type_1">
                            <label for="type_1">リップスティック</label>
                        </div>
                        <div class="question_choice">
                            <input type="radio" name="type" value="リップグロス/リキッドルージュ" id="type_2">
                            <label for="type_2">リップグロス/リキッドルージュ</label>
                        </div>
                        <!-- <div class="question_choice">
                            <input type="radio" name="type" value="" id="type_3">
                            <label for="type_3"></label>
                        </div> -->
                        <div class="question_choice">
                            <input type="radio" name="type" value="ティントリップ" id="type_3">
                            <label for="type_3">ティントリップ</label>
                        </div>
                    </div>
                </div>
                <br>
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