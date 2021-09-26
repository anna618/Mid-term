<?php
require_once ("pdo_connect.php");

$id=$_GET["id"];
$delet_time = date('y-m-d H:i:s');
try {
    $sql = "UPDATE db_evaluation SET  deleted_time=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$delet_time,$id]);
    echo "寫入成功<br>";
}catch (PDOException $e){
    echo "寫入失敗<br>";
    echo "Error".$e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-evaluation.php");