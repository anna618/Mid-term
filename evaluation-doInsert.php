<?php
require_once("pdo_connect.php");
//if(!isset($_POST["name"])){
//    echo "沒有資料喔";
//    exit();
//}


$order_id = $_POST["order_id"];
$content = $_POST["content"];
//$images = $_POST["images"];
$star = $_POST["star"];
$created_time = date('y-m-d H:i:s');

try {
//    $sql = "INSERT INTO db_evaluation(order_id, content, star,created_time)
//	VALUES (?, ?, ?, ?)";
//    $stmt = $db_host->prepare($sql);
//    $stmt->execute([ $order_id, $content,  $star, $created_time]);
//    $id = $db_host->lastInsertId(); //取得最新一筆資料的 id
    if ($_FILES["file"]["error"] > 0) {
        $sql="INSERT INTO db_evaluation (order_id, content, star,created_time) values (?,?,?,?)";
        $stmt=$db_host->prepare($sql);
        $stmt->execute([$order_id, $content,  $star, $created_time]);
        $id = $db_host->lastInsertId();
        echo "no圖片";}

        if ($_FILES["file"]["error"] === 0) {
//    var_dump($_FILES['file']);
//    $file_name=$_FILES["file"]["name"];

        $path_parts = pathinfo($_FILES["file"]["name"]);
        $extension = $path_parts['extension'];
        $file_name=time().".".$extension;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "evaluation-images/" . $file_name)) {
//        echo $_FILES["file"]["name"]."upload success";+
            $sql="INSERT INTO db_evaluation (order_id, content, star,created_time,images) values (?,?,?,?,?)";
            $stmt=$db_host->prepare($sql);
            $stmt->execute([$order_id, $content,  $star, $created_time,$file_name]);
            $id = $db_host->lastInsertId(); //取得最新一筆資料的 id

            header("location:file-upload.php");
        } else {

            echo "錯誤";
        }
    }
    echo "寫入成功<br>";
} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error" . $e->getMessage();
    exit;
}

$db_host = NULL;
header("location: list-evaluation.php");