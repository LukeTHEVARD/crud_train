<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

$game_id=0;
$game_name="";
$game_price="";
$game_editor="";
$game_date="";
$game_description="";
$game_stock="";

if (isset($_GET['id']) && is_numeric($_GET['id'])){
    $stmt = $db -> prepare("SELECT*FROM table_game ORDER BY game_id DESC");
    $stmt -> execute();
        if($row = $stmt->fetch()){
            $game_name=$row['game_name'];
            $game_price=$row['game_price'];
            $game_editor=$row['game_editor'];
            $game_date=$row['game_date'];
            $game_description=$row['game_description'];
            $game_stock=$row['game_stock'];
            $game_id=$row['game_id'];
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/admin/CSS/bootstrap.css">
    <title>nouveau produit | Royal Pixels Gaming</title>
</head>
<body>
    <form method="POST" action="process.php">

        <div class="form-group">
            <label for="game_name">Nom du jeu</label>
            <input type="text" name="game_name" class="form-control" id="game_name" aria-describedby="emailHelp" placeholder="Entre le Nom du jeu" value="<?= htmlspecialchars($game_name);?>">
        </div>

        <div class="form-group">
            <label for="game_price">Prix</label>
            <input type="text" name="game_price" class="form-control" id="game_price" aria-describedby="price" placeholder="entre le prix en €" value="<?= htmlspecialchars($game_price);?>">
        </div>
        
        <div class="form-group">
            <label for="game_editor">editeur</label>
            <input type="text" name="game_editor" class="form-control" id="game_editor" aria-describedby="editeur" placeholder="Entre l'editeur du jeu" value="<?= htmlspecialchars($game_editor);?>">
        </div>

        <div class="form-group">
            <label for="game_date">Date de Sortie</label>
            <input type="date" name="game_date" class="form-control" id="game_date" aria-describedby="Date" placeholder="" value="<?= htmlspecialchars($game_date);?>">
        </div>

        <div class="form-group">
            <label for="game_description">description</label>
            <input type="text" name="game_description" class="form-control" id="game_description" aria-describedby="description" placeholder="Entre la description du jeu" value="<?= htmlspecialchars($game_description);?>">
        </div>

        <div class="form-group">
            <label for="game_stock">stock</label>
            <input type="text" name="game_stock" class="form-control" id="game_stock" aria-describedby="stock" placeholder="Entre le nombre restant en stock" value="<?= htmlspecialchars($game_stock);?>">
        </div>


        <input type="hidden" name="game_id" value="<?= htmlspecialchars($game_id);?>">
        <button type="submit" value="ok" class="btn btn-primary">Submit</button>

        <input type="hidden" name="sent" value="1">
        
    </form>
</body>
</html>