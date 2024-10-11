<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";
 
if (isset($_GET['id']) && is_numeric($_GET['id'])){
    $stmt = $db->prepare("DELETE FROM table_game WHERE game_id=:id");
    $stmt->execute([":id"=>$_GET['id']]);
}

redirect("index.php");

?>
