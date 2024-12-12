<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";


$manager = new GameManager();
var_dump($manager->selectOne(35));

?>