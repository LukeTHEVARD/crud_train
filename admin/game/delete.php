<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

$manager = new GameManager();
$game = new Game($manager->selectOne($_GET['id']));
$manager->delete($game);


redirect("index.php");

?>
