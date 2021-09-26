<?php
require_once("pdo_connect.php");
if (!isset($_POST["title"]) || !isset($_POST["content"])) {
    echo "請輸入資料";
    exit();
}
$id = $_POST["id"];
$title = $_POST["title"];
$content = $_POST["content"];
$created_time = date('Y-m-d H:i:s');
$author_id = $_POST["author_id"];
$petSitter_id = $_POST["petSitter_id"];
//更新資料
try {
    $sql = "UPDATE db_message_board SET user_id=?, petSitter_id=?, title=?, content=?, created_time=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$author_id, $petSitter_id, $title, $content, $created_time, $id]);
//    echo "修改成功<br>";
} catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}

//判斷是否有選擇檔案
if ($_FILES["file"]["error"] === 0) {
    //刪除舊圖
    $search_oldImage_sql = "SELECT image_name FROM db_message_board_images WHERE id=?";
    $stmt_oldImage = $db_host->prepare($search_oldImage_sql);
    $stmt_oldImage->execute([$id]);
    $rows_oldImage = $stmt_oldImage->fetchAll(PDO::FETCH_ASSOC);
    $delete_oldImage = "messageBoard-images/" . $rows_oldImage[0]["image_name"];

    if (file_exists($delete_oldImage)) {
        unlink($delete_oldImage);
    }
    //新增圖片
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $ext = $path_parts["extension"];
    $file_name = time() . "." . $ext;
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "messageBoard-images/" . $file_name)) {
        $sql = "UPDATE db_message_board_images SET image_name=?, created_time=? WHERE message_board_id=?";
        $stmt = $db_host->prepare($sql);
        $stmt->execute([$file_name, $created_time, $id]);
    } else {
        echo "upload failed!";
    }
}

$db_host = NULL;
header("location:list-messageBoard.php");
