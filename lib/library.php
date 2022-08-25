<?php
// header('Location: ../start.php');
// exit();

//エスケープ処理
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}

//db接続
function dbconnect() {
    $db = new mysqli('localhost', 'xs425403_ozx1010', 'zpzw5951', 'xs425403_lipdiagnosis');
    if(!$db) {
        die($db->error);
    }

    return $db;
}
?>