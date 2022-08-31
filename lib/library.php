<?php
// header('Location: ../start.php');
// exit();

//エスケープ処理
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}

//エスケープ処理(一部ホワイトリスト化)
function escape_white_list($value) {
    $value = h($value);
    return preg_replace('/&quot;/', '"', $value);
}

// db接続(本番)
function dbconnect() {
    $db = new mysqli('localhost', 'xs425403_ozx1010', 'zpzw5951', 'xs425403_lipdiagnosis');
    if(!$db) {
        die($db->error);
    }

    return $db;
}

// //db接続(検証)
// function dbconnect() {
//     $db = new mysqli('localhost:8889', 'root', 'root', 'lip_diagnosis');
//     if(!$db) {
//         die($db->error);
//     }

//     return $db;
// }
?>