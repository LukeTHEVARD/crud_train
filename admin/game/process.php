<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

if (isset ($_FILES['game_image'])){
    var_dump($_FILES['game_image']);
    move_uploaded_file($_FILES['game_image']['tmp_name'],
    $_SERVER['DOCUMENT_ROOT']."/upload/".$_FILES['game_image']['name']);
}

exit();
if (isset($_POST['sent']) && $_POST['sent'] == "1"){
    if($_POST["game_id"] == 0){
        $stmt = $db->prepare("INSERT INTO table_game(game_name, game_price, game_editor, game_date, game_description, game_stock) VALUES(:name, :price, :editor, :date, :description, :stock, :image)");
        $stmt -> execute([":name" =>$_POST['game_name'], ":price" =>$_POST['game_price'], ":editor"=> $_POST['game_editor'], ":date"=> $_POST['game_date'], ":description"=> $_POST['game_description'], ":stock"=> $_POST['game_stock'], ":image"=> $_POST['game_image']]);
    }else{
        $stmt = $db->prepare("UPDATE table_game SET game_name=:game_name, game_price=:game_price, game_editor=:game_editor, game_date=:game_date, game_description=:game_description, game_stock=:game_stock, game_image=:game_image WHERE game_id=:game_id");
        $stmt->bindValue(":game_name", trim($_POST['game_name']));
        $stmt->bindValue(":game_price", trim($_POST['game_price']));
        $stmt->bindValue(":game_editor", trim($_POST['game_editor']));
        $stmt->bindValue(":game_date", trim($_POST['game_date']));
        $stmt->bindValue(":game_description", trim($_POST['game_description']));
        $stmt->bindValue(":game_stock", trim($_POST['game_stock']));
        $stmt->bindValue(":game_image", trim($_POST['game_image']));
        $stmt->bindValue(":game_id", trim($_POST["game_id"]));
        $stmt->execute();
       }};
    

redirect("index.php");
?>