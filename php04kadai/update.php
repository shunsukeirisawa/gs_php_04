<?php
//1. POSTデータ取得
$bookTitle   = $_POST["bookTitle"];
$bookUrl  = $_POST["bookUrl"];
$bookComment = $_POST["bookComment"];
$id     = $_POST["id"];

//2. DB接続します
require_once("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET bookTitle=:bookTitle,bookUrl=:bookUrl,bookComment=:bookComment WHERE id=:id");
$stmt->bindValue(':bookTitle',   $bookTitle,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookUrl',  $bookUrl,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookComment', $bookComment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}
