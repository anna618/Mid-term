<?php
require_once ("pdo_connect.php");
if(!isset($_POST["email"])){
    header("location:login.php");
    exit;
}
$email=$_POST["email"];
$password=$_POST["password"];
$password=md5($_POST["password"]);
//echo $password;

$sql="SELECT * FROM users WHERE email=? and password=? and  deleted_time IS NULL" ;
$stmt=$db_host->prepare($sql);
$stmt->execute([$email,$password]);
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$logintratus=$stmt->rowCount();
if($logintratus>0):
    $userData=[
        "id"=>$rows[0]["id"],
        "email"=>$rows[0]["email"],
        "name"=>$rows[0]["name"],
        "gender"=>$rows[0]["gender"],
    ];
$_SESSION["user"]=$userData;
unset($_SESSION["login_error"]);
header("location:list-user.php");
else:
    if(isset($_SESSION["login_error"])){
        $_SESSION["login_error"]++;
    }else{
    $_SESSION["login_error"]=1;
}
//    echo "登入失敗";
header("location:login.php");
endif;