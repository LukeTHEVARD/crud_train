<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

$path = $_SERVER['DOCUMENT_ROOT']."/upload/";
$prefix = "lg_";
$dest_height = 600;
$dest_width = 800; 

if (isset ($_FILES['game_image']) && $_FILES['game_image']['error'] == 0){
    $extensions = ["jpg", 'jpeg', "png", "gif", "webp"];
    $extension = strtolower(pathinfo($_FILES['game_image']['name'], PATHINFO_EXTENSION));
    if (str_replace("jpg", "jpeg", $extension) != str_replace("image/", "", $_FILES['game_image']['type'])){
        var_dump($_FILES);
        rickRoll(); # version très drôle
        #exit(); # (vrai version) y'a mieux a faire car c'est une version pour les hackeurs et pas caroline de la compta
    };

    if(!in_array($extension, $extensions)){
        rickRoll();
    };

    $game_image = $_POST['game_name'];
    $game_image = cleanFilename($game_image);
    $game_image = checkFilename($game_image);
    
    $file = $game_image.".".$extension;

    move_uploaded_file($_FILES['game_image']['tmp_name'], $path.$file);

    $sizes = getimagesize($path.$file);
    if ($sizes = getimagesize($path.$file)){
        $src_width = $sizes[0];
        $src_height = $sizes[1];
    }else{
        exit();
    }
    
    if ($src_width > $dest_width || $src_height > $dest_height) {
        if ($src_width > $src_height){  
            # format paysage
            $dest_height = round($src_height * $dest_width / $src_width);

        }else{  
            # format portrait 
            $dest_width = round($src_width * $dest_height / $src_height);
        }
        $dest = imagecreatetruecolor($dest_width, $dest_height);
        switch($extension){
            case "jpeg":
            case "jpg":
                $src = imagecreatefromjpeg($path.$file);
                break;
            case "gif":
                $src = imagecreatefromgif($path.$file);
                break;
            case "png":
                $src = imagecreatefrompng($path.$file);
                break;
            case "webp":
                $src = imagecreatefromwebp($path.$file);
                break;
            default:
                exit();
        }
        imagecopyresampled($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
        imagewebp($dest, $path.$prefix.$game_image.".webp", 100);
    }
}
if (!$_FILES['game_image']['error'] == 0){
    var_dump($_FILES);
    #rickRoll();
}

exit();

if (isset($_POST['sent']) && $_POST['sent'] == "1"){
    if($_POST["game_id"] == 0){
        $stmt = $db->prepare("INSERT INTO table_game(game_name, game_price, game_editor, game_date, game_description, game_stock, game_image) VALUES(:name, :price, :editor, :date, :description, :stock, :image)");
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
        $stmt->bindValue(":game_id", trim($_POST['game_id']));
        $stmt->execute();
       }};
    

redirect("index.php");
?>