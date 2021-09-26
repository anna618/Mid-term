<?php
require_once("pdo_connect.php");
if (!isset($_POST["name"])) {
    echo "請輸入資料";
    exit();
}
$id=$_POST["id"];
$account = $_POST["account"];
$password = $_POST["password"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$address = $_POST["address"];
$DOB = $_POST["DOB"];
$phone = $_POST["phone"];
$images = $_POST["images"];
$status = $_POST["status"];

if(move_uploaded_file($_FILES["image"]["tmp_name"], "users-images/".$_FILES["image"]["name"])){ // 存入圖片的路徑
    $sql = "UPDATE db_user SET  images=? WHERE id=?"; // 藉由抓寵物的id去確認是哪個image要置換
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$_FILES["image"]["name"], $id]);

}else{
    echo "upload failed!";
}

try {
    $sql="UPDATE db_user SET account=?, password=?, name=?, gender=?, address=?, DOB=?, phone=?, status=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$account, $password, $name, $gender, $address, $DOB, $phone, $status, $id]);
    echo "修改成功<br>";

}catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-user.php?id=".$id);