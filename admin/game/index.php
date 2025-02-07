<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

$stmt = $db -> prepare("SELECT*FROM table_game ORDER BY game_id ASC");
$stmt -> execute();
$recordset = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/admin/CSS/bootstrap.css">
    <link rel="stylesheet" href="/admin/CSS/style.css">
    <title>produit | Royal Pixels Gaming</title>
</head>
<body>
    <div class="container">
        <button type="button" class="btn btn-danger" onclick="window.location.href='/admin/logout.php'">logout</button>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead class>
                <tr>
                    <th scope="col">image</th>
                    <th scope="col">jeu</th>
                    <th scope="col">editeur</th>
                    <th scope="col">prix</th>
                    <th scope="col">date</th>
                    <th scope="col">supprimer</th>
                    <th scope="col">modifier</th>        
                    <th scope="col"><a href="form.php">➕</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($recordset as $row){
                    $item = new Game ($row);
                    ?>
                <tr scope="row">
                    <td> <img src="/upload/xs_<?= $item->getImage();?>"></td>
                    <td> <?= $item->getName();?></td>
                    <td> <?= $item->getEditor();?></td>
                    <td> <?= $item->getPrice();?></td>
                    <td> <?= date_adapt($item->getDate());?></td>
                    <td><a href="delete.php?id=<?= htmlspecialchars($item->getId());?>">🗑️</td>            
                    <td><a href="form.php?id=<?= htmlspecialchars($item->getId());?>">📝</td> 
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>