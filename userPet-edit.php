<?php
require_once("pdo_connect.php");
if (!isset($_POST["name"])) {
    echo "請輸入資料";
    exit();
}

$user_id=$_POST["user_id"];
$pet_id=$_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$DOB = $_POST["DOB"];
$content = $_POST["content"];
$images = $_POST["images"];

if(move_uploaded_file($_FILES["image"]["tmp_name"], "pets-images/".$_FILES["image"]["name"])){ // 存入圖片的路徑
    $sql = "UPDATE db_pet SET  images=? WHERE id=?"; // 藉由抓使用者id去確認是哪個image要置換
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$_FILES["image"]["name"], $pet_id]);

}else{
    echo "upload failed!";
}

try {
    $sql="UPDATE db_pet SET name=?, gender=?, DOB=?, content=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$name, $gender, $DOB, $content, $pet_id]);
    echo "修改成功<br>";

}catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-userPet.php?id=".$user_id);