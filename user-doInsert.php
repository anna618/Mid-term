<?php
require_once("pdo_connect.php");
if (!isset($_POST["name"])) {
    echo "請輸入資料";
    exit();
}
$account = $_POST["account"];
$password = $_POST["password"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$address = $_POST["address"];
$DOB = $_POST["DOB"];
$phone = $_POST["phone"];
$status = 1; // 預設權限1=一般會員，2=保母
$now = date('Y-m-d H:i:s');
$deleted_time =NULL;


try {
    move_uploaded_file($_FILES["image"]["tmp_name"], "users-images/".$_FILES["image"]["name"]); // 存入圖片的路徑
    $sql = "INSERT INTO db_user(account, password, name, gender, address, DOB, phone, status, created_time, deleted_time, images)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$account, $password, $name, $gender, $address, $DOB, $phone, $status, $now, $deleted_time, $_FILES["image"]["name"]]);
    $id=$db_host->lastInsertId(); //取得最新一筆資料的 id
    echo "寫入成功<br>";

} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-user.php?id=".$id);