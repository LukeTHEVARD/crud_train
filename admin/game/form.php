<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])){
    
    $manager = new GameManager();
    $row = $manager->selectOne($_GET['id']);
    $game = new Game($row);
    
}else{
    
    $game=new Game();

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
    <div class="container">
        <form method="POST" action="process.php" enctype="multipart/form-data">

            <div class="form-group">
                <label for="game_name">Nom du jeu</label>
                <input type="text" name="game_name" class="form-control" id="game_name" aria-describedby="emailHelp" placeholder="Entre le Nom du jeu" value="<?= $game->getName();?>">
            </div>

            <div class="form-group">
                <label for="game_price">Prix</label>
                <input type="text" name="game_price" class="form-control" id="game_price" aria-describedby="price" placeholder="entre le prix en €" value="<?= $game->getPrice();?>">
            </div>
            
            <div class="form-group">
                <label for="game_editor">editeur</label>
                <input type="text" name="game_editor" class="form-control" id="game_editor" aria-describedby="editeur" placeholder="Entre l'editeur du jeu" value="<?= $game->getEditor();?>">
            </div>

            <div class="form-group">
                <label for="game_date">Date de Sortie</label>
                <input type="date" name="game_date" class="form-control" id="game_date" aria-describedby="Date" placeholder="" value="<?= $game->getDate();?>">
            </div>

            <div class="form-group">
                <label for="game_description">description</label>
                <input type="text" name="game_description" class="form-control" id="game_description" aria-describedby="description" placeholder="Entre la description du jeu" value="<?= $game->getDescription();?>">
            </div>

            <div class="form-group">
                <label for="game_stock">stock</label>
                <input type="text" name="game_stock" class="form-control" id="game_stock" aria-describedby="stock" placeholder="Entre le nombre restant en stock" value="<?= $game->getStock();?>">
            </div>

            <div class="form-group">
                <label for="game_image">image</label>
                <input type="file" name="game_image" class="form-control" id="game_image" aria-describedby="image" placeholder="Choisi ton image" value="<?= $game->getImage();?>">
            </div>

            <br>
            <input type="hidden" name="game_id" value="<?= $game->getId();?>">
            <button type="submit" value="ok" class="btn btn-primary">Submit</button>

            <input type="hidden" name="sent" value="1">
            
        </form>
    </div>
</body>
</html>