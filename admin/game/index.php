<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

$stmt = $db -> prepare("SELECT*FROM table_game ORDER BY game_id DESC");
$stmt -> execute();
$recordset = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produit | Royal Pixels Gaming</title>
</head>
<body>
    <table border="solid">
        <thead>
            <th>jeu</th>
            <th>editeur</th>
            <th>prix</th>
            <th>date</th>
            <th>supprimer</th>
            <th>modifier</th>
        </thead>
        <?php foreach($recordset as $row){?>
        <tr>
            <td> <?= htmlspecialchars($row['game_name']);?></td>
            <td> <?= htmlspecialchars($row['game_editor']);?></td>
            <td> <?= htmlspecialchars($row['game_price']);?></td>
            <td> <?= htmlspecialchars(date_adapt($row['game_date']));?></td>
            <td><a href="delete.php?id=<?= htmlspecialchars($row['game_id']);?>">🗑️</td>            
            <td><a href="form.php?id=<?= htmlspecialchars($row['game_id']);?>">📝</td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>