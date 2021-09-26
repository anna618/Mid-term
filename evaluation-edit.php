<?php
require_once("pdo_connect.php");
//if (!isset($_POST["name"])) {
//    echo "沒有資料喔";
//    exit();
//}
$id = $_POST["id"];
$order_id = $_POST["order_id"];
$content = $_POST["content"];
//$images = $_POST["images"];
$star = $_POST["star"];
$created_time = $_POST["created_time"];


try {
    $sql = "UPDATE db_evaluation SET order_id=?, content=?,  star=?, created_time=?  WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$order_id, $content, $star, $created_time, $id]);
    var_dump($id);
//    $id = $db_host->lastInsertId();


    if ($_FILES["file"]["error"] === 0) {
//    var_dump($_FILES['file']);
//    $file_name=$_FILES["file"]["name"];

        $path_parts = pathinfo($_FILES["file"]["name"]);
        $extension = $path_parts['extension'];
        $file_name = time() . "." . $extension;
//        $id = $db_host->lastInsertId();
//        var_dump($id);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "evaluation-images/" . $file_name)) {
//    echo $_FILES["file"]["name"]."upload success";
            $sql = "UPDATE db_evaluation SET  images=? WHERE id=?";
            $stmt = $db_host->prepare($sql);
            $stmt->execute([$file_name, $id]);
//            var_dump($id);
            $id = $db_host->lastInsertId();
//            var_dump($id);

//            header("location:file-upload.php");
        } else {
            echo "fall";
        }
    }
    echo "修改成功<br>";

} catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-evaluation.php");