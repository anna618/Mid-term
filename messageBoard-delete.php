<?php
require_once("pdo_connect.php");

$id = $_GET["id"];
$deleted_time = date('Y-m-d H:i:s');
try {
    $sql = "UPDATE db_message_board SET deleted_time=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$deleted_time, $id]);
//    echo "修改成功<br>";
} catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}

try {
    $sql = "UPDATE db_message_board_images SET deleted_time=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$deleted_time, $id]);
//    echo "修改成功<br>";
} catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}

$db_host = NULL;
header("location:list-messageBoard.php");
