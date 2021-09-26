<?php
require_once("pdo_connect.php");
if (!isset($_POST["title"]) || !isset($_POST["content"])) {
    echo "請輸入資料";
    exit();
}

$title = $_POST["title"];
$content = $_POST["content"];
$created_time = date('Y-m-d H:i:s');
$author_id = $_POST["author_id"];    //使用者於create-MessageBoard.php畫面選定的會員id
$petSitter_id = $_POST["petSitter_id"];  //使用者於create-MessageBoard.php畫面選定的保母id

//寫入使用者填入資料
try {
    $sql = "INSERT INTO db_message_board (user_id, petSitter_id, title, content, created_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$author_id, $petSitter_id, $title, $content, $created_time]);
//    echo "寫入成功<br>";
} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}

//撈db_message_board新建的id
try {
    $sql_newId = "SELECT id FROM db_message_board ORDER BY created_time DESC LIMIT 1";
    $stmt_newId = $db_host->prepare($sql_newId);
    $stmt_newId->execute();
    $rows_newId = $stmt_newId->fetchAll(PDO::FETCH_ASSOC);
    $message_board_id = $rows_newId[0]["id"];
} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}

if ($_FILES["file"]["error"] === 0) {
//    var_dump($_FILES["file"]);
//    exit;
//    $file_name=$_FILES["file"]["name"];
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $ext = $path_parts["extension"];
    $file_name = time() . "." . $ext;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], "messageBoard-images/" . $file_name)) {
//      echo $_FILES["file"]["name"]." upload success!";
        $sql = "INSERT INTO db_message_board_images(message_board_id, image_name, created_time) VALUES (?, ?, ?)";
        $stmt = $db_host->prepare($sql);
        $stmt->execute([$message_board_id, $file_name, $created_time]);
    } else {
        echo "upload failed!";
    }
}

$db_host = NULL;
header("location:list-messageBoard.php");

