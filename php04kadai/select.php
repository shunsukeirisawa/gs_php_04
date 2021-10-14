<?php
// 0. SESSION開始！！
session_start();
//１．関数群の読み込み
if ($_SESSION['chk_ssid'] === session_id()) {
    // ok
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
} else {
    // id持ってない or idがおかしい
    // exit("LOGIN ERROR");
    header("Location: selectbasic.php");
    exit();
    
}

require_once("funcs.php");
// loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

echo ($_SESSION["name"]);

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $r["id"] . '">';
        $view .= $r["id"] . " " . $r["bookTitle"] . " " . $r["bookUrl"] . " " . $r["bookComment"];
        $view .= '</a>';
        $view .= "　";

        // 0 : true;
        // 1 : false;
        if ($_SESSION["kanri_flg"]) {
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r["id"] . '">';
            $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
            $view .= '</a>';
        }

        $view .= '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron"><?= $view ?></div>
    </div>
    <!-- Main[End] -->

</body>

</html>