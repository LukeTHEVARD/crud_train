<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/function.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protection.php";

$path = $_SERVER['DOCUMENT_ROOT']."/upload/";

$img_format = Game::IMG_FORMAT;

if(isset($_POST['sent']) && $_POST['sent'] == 1){
    if (isset($_POST['game_id']) && ($_POST['game_id']) > 0){
        $stmt = $db -> prepare("SELECT * FROM table_game WHERE game_id=:game_id");
        $stmt -> execute([":game_id" => $_POST['game_id']]);
            if($row = $stmt->fetch()){
                $game = new Game ($row);
            }
    }else{
        $game=new Game();
    }
    $game->hydrate($_POST); 
    if (isset ($_FILES['game_image']) && $_FILES['game_image']['error'] == 0){
        $extensions = ["jpg", 'jpeg', "png", "gif", "webp"];
        $extension = strtolower(pathinfo($_FILES['game_image']['name'], PATHINFO_EXTENSION));
        if (str_replace("jpg", "jpeg", $extension) != str_replace("image/", "", $_FILES['game_image']['type'])){
            rickRoll(); # version très drôle
            #exit(); # (vrai version) y'a mieux a faire car c'est une version pour les hackeurs et pas caroline de la compta
        };
    
        if(!in_array($extension, $extensions)){
            #rickRoll();
        };
    
        if ($game->getImage() != "") {
            foreach (Game::IMG_FORMAT as $prefix => $data){
                if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage())) {
                    unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage());
                }
            }
        }
        $game_image = $_POST['game_name'];
        $game_image = cleanFilename($game_image);
        $game_image = checkFilename($game_image);
        
        $file = $game_image.".".$extension;
        $src_file = $file;
    
        move_uploaded_file($_FILES['game_image']['tmp_name'], $path.$file);
    
        $sizes = getimagesize($path.$file);
    
        foreach($img_format as $prefix => $info){
            $dest_height = $info["height"];
            $dest_width = $info["width"];
            $crop = $info["crop"];
            if ($sizes = getimagesize($path.$src_file)){
                $src_width = $sizes[0];
                $src_height = $sizes[1];
            }else{
                exit();
            }
            
            if ($src_width > $dest_width || $src_height > $dest_height) {
                if (!$crop){
                    if ($src_width > $src_height){  
                        # format paysage
                        $dest_height = round($src_height * $dest_width / $src_width);
    
                    }else{  
                        # format portrait 
                        $dest_width = round($src_width * $dest_height / $src_height);
                    }
                }
            }else{
                $dest_height = $src_height;
                $dest_width = $src_width;
                $crop = false;
            }
            $dest = imagecreatetruecolor($dest_width, $dest_height);
            switch($extension){
                case "jpeg":
                case "jpg":
                    $src = imagecreatefromjpeg($path.$src_file);
                    break;
                case "gif":
                    $src = imagecreatefromgif($path.$src_file);
                    break;
                case "png":
                    $src = imagecreatefrompng($path.$src_file);
                    break;
                case "webp":
                    $src = imagecreatefromwebp($path.$src_file);
                    break;
                default:
                    exit();
            }
                
            imagecopyresampled($dest, $src, 0, 0, 
            ($crop ? ($src_width > $src_height ? round(($src_width-$src_height)/2) : 0 ): 0 ), /* paysage  */
            ($crop ? ($src_width > $src_height ? 0 : round(($src_height-$src_width)/2)): 0 ), /* portrait */ $dest_width, $dest_height,
            ($crop ? ($src_width > $src_height ? $src_height : $src_width) : $src_width),
            ($crop ? ($src_width > $src_height ? $src_height : $src_width) : $src_height),);
            
            imagewebp($dest, $path.$prefix.$game_image.".webp", 100);
            if(!$crop){$src_file = $prefix.$game_image.".webp";
            $extension = "webp";}
        }
        if (file_exists($path.$file)){
            unlink($path.$file);
        }
        
        $game->setImage($game_image.".webp");
    }

    if (!$_FILES['game_image']['error'] == 0){
        #rickRoll();
    }
    $manager = new GameManager();
    $manager->save($game);
}

redirect("index.php");
?>