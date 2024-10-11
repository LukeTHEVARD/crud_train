<?php 

if (!isset($_SESSION['logged']) || $_SESSION['logged']!="1"){

    redirect("/admin/login.php");

}