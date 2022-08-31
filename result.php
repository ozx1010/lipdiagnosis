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
$stmt = $db->prepare('select maker, name, product_name, product_id, product_jpg, product_info1, product_info2, msmaflink_id from lips where cosmetics=? and texture=? and type=?');
if (!$stmt) {
    die($db->error);
}
 //sql実行
$stmt->bind_param('sss', $_SESSION['cosmetics'], $_SESSION['texture'], $_SESSION['type']);
$success = $stmt->execute();
if (!$success) {
    die($db->error);
}
 //対象のメーカー、リップ名とurlの格納
$stmt->bind_result($maker, $name, $product_name, $product_id, $product_jpg, $product_info1, $product_info2, $msmaflink_id);

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
            <div class="result_str">
                <p>あなたに合うリップは・・・</p>
            </div>
            <?php while ($stmt->fetch()) { ?>
            <div class="lip_result">
                <div class="lip_result_name">
                    <p>▼ <?php echo h($maker); ?> 『<?php echo h($name); ?>』</p>
                </div>
                <!-- START MoshimoAffiliateEasyLink -->
                <script type="text/javascript">
                (function(b,c,f,g,a,d,e){b.MoshimoAffiliateObject=a;
                b[a]=b[a]||function(){arguments.currentScript=c.currentScript
                ||c.scripts[c.scripts.length-2];(b[a].q=b[a].q||[]).push(arguments)};
                c.getElementById(a)||(d=c.createElement(f),d.src=g,
                d.id=a,e=c.getElementsByTagName("body")[0],e.appendChild(d))})
                (window,document,"script","//dn.msmstatic.com/site/cardlink/bundle.js?20220329","msmaflink");
                msmaflink({"n":"<?php echo h($product_name); ?>","b":"","t":"","d":"https:\/\/thumbnail.image.rakuten.co.jp","c_p":"<?php echo h($product_info1); ?>","p":["<?php echo escape_white_list($product_jpg); ?>"],"u":{"u":"<?php echo h($product_info2); ?>","t":"rakuten","r_v":""},"v":"2.1","b_l":[{"id":1,"u_tx":"楽天市場で見る","u_bc":"#f76956","u_url":"<?php echo h($product_info2); ?>","a_id":<?php echo h($product_id); ?>,"p_id":54,"pl_id":27059,"pc_id":54,"s_n":"rakuten","u_so":1}],"eid":"<?php echo h($msmaflink_id); ?>","s":"s"});
                </script>
                <div id="msmaflink-<?php echo h($msmaflink_id); ?>">リンク</div>
                <!-- MoshimoAffiliateEasyLink END -->
            </div>
            <?php } ?>
            <div class="back_home">
                <a href=".">スタート画面に戻る</a>
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