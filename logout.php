<?php
require_once ("pdo_connect.php");
if(isset($_SESSION["user"])){
    session_destroy();
}
header("location:login.php");
