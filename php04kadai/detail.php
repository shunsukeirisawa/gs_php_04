<?php

session_start();

if ($_SESSION['chk_ssid'] == session_id()){
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
}else{
    //exit("LOGIN ERROR");
    header("Location: detailbasic.php");
    exit();
}




$id = $_GET["id"]; //?id~**を受け取る
require_once("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>書籍タイトル：<input type="text" name="bookTitle" value="<?= $row["bookTitle"] ?>"></label><br>
                <label>書籍URL：<input type="text" name="bookUrl" value="<?= $row["bookUrl"] ?>"></label><br>
                <label>コメント<textArea name="bookComment" rows="4" cols="40"><?= $row["bookComment"] ?></textArea></label><br>
                <input type="submit" value="送信">
                <input type="hidden" name="id" value="<?= $id ?>">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
