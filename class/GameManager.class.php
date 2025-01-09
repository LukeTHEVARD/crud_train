<?php

class GameManager {

    private PDO $db;

    public function __construct(){
        $this->connect();
    }

    private function connect(){
        $this->db = new PDO("mysql:host=localhost;dbname=royalpixelgaming;charset=utf8","root","");
    }

    public function selectOne($id){
        $stmt = $this->db->prepare ("SELECT * FROM table_game WHERE game_id=:id");
        $stmt->execute(["id" => $id]);
        if($row = $stmt->fetch()){
            return $row;
        } 
        return false;
    }

    public function delete(Game $game){
        if ($game->getImage() != "") {
            foreach (Game::IMG_FORMAT as $prefix => $data){
                if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage())) {
                    unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage());
                }
            }
        }
        $stmt = $this->db->prepare("DELETE FROM table_game WHERE game_id = :game_id");
        $stmt->execute([":game_id" => $game->getId()]);
    }

    public function save($game){
        if($game->getId()==0){
            $this->insert($game);
        }else{
            $this->update($game);
        }
    }

    private function insert(Game $game) {
        $stmt = $this -> db -> prepare("INSERT INTO table_game (game_name, game_price, game_description, game_image, game_editor, game_stock, game_date) VALUES (:game_name, :game_price, :game_description, :game_image, :game_editor, :game_stock, :game_date)");
        $stmt -> bindValue(":game_name", $game->getName(true));
        $stmt -> bindValue(":game_price", $game->getPrice(true));
        $stmt -> bindValue(":game_description", $game->getDescription(true));
        $stmt -> bindValue(":game_image", $game->getImage(true));
        $stmt -> bindValue(":game_editor", $game->getEditor(true));
        $stmt -> bindValue(":game_date", $game->getDate(true));
        $stmt -> bindValue(":game_stock", $game->getStock(true));
        $stmt -> execute();
    }

    private function update(Game $game){
        $stmt = $this -> db -> prepare("UPDATE table_game SET game_name = :game_name, game_price = :game_price, game_description = :game_description, game_image = :game_image, game_editor = :game_editor, game_stock = :game_stock, game_date = :game_date WHERE game_id = :game_id;");
        $stmt -> bindValue(":game_id", $game->getId(true));
        $stmt -> bindValue(":game_name", $game->getName(true));
        $stmt -> bindValue(":game_price", $game->getPrice(true));
        $stmt -> bindValue(":game_description", $game->getDescription(true));
        $stmt -> bindValue(":game_image", $game->getImage(true));
        $stmt -> bindValue(":game_editor", $game->getEditor(true));
        $stmt -> bindValue(":game_date", $game->getDate(true));
        $stmt -> bindValue(":game_stock", $game->getStock(true));
        $stmt -> execute();
    }

}

?>