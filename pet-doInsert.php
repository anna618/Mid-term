<?php
require_once("pdo_connect.php");
if (!isset($_POST["name"])) {
    echo "請輸入資料";
    exit();
}

$user_id = $_POST["user_id"];  // 對應db_user的id
$name = $_POST["name"];
$gender = $_POST["gender"];
$DOB = $_POST["DOB"];
$content = $_POST["content"];
$now = date('Y-m-d H:i:s');
$deleted_time = NULL;


try {
    move_uploaded_file($_FILES["image"]["tmp_name"], "pets-images/".$_FILES["image"]["name"]); // 存入圖片的路徑
    $sql = "INSERT INTO db_pet(user_id, name, gender, DOB, content, created_time, deleted_time, images)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$user_id, $name, $gender, $DOB, $content, $now, $deleted_time, $_FILES["image"]["name"]]);
    $id=$db_host->lastInsertId(); //取得最新一筆資料的 id
    echo "寫入成功<br>";

} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}

$db_host = NULL;
header("location: list-pet.php?id=".$id);