<?php
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
session_start();
$_SESSION['logged']="0";
session_destroy();
redirect("login.php");
?>