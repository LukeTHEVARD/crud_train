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
            return new Game($row);
        } 
        return false;
    }

    public function delete($game){
        if($game->getImage()!=""){
            /* Supp fichiers image */
        }  
        $stmt = $this->db->prepare ("DELETE * FROM table_game WHERE game_id=:id");
        $stmt->execute(["id" => $game->getId()]);
    }

    public function save($game){
        if($game->getId()==0){
            $this->insert($game)
        }else{
            $this->update($game)
        }
    }

    private function insert($game) {
        
    }

}

?>