<?php 


class Game{

    private int $id;
    private ?string $name;
    private ?float $price;
    private ?string $description;
    private ?string $editor;
    private ?int $stock;
    private ?string $image;
    private ?string $date;



    function __construct($data){
        if (!is_null($data)){
            foreach($data as $key=>$value){
                $methodName = "set".ucfirst(str_replace("game_","",$key));
                if (method_exists($this, $methodName)){
                    if (!is_null($value)){
                        $this -> {$methodName}($value);
                    }else{
                        $this -> {$methodName}("");
                    }
                }
            }
        }else{
            $this->setName("bug");
        }
    }
    //setter
    public function setId(int $value){
        $this -> id = ($value<0?0:$value);
    }
    public function setName(string $value){
        $this -> name = $value;
    }
    public function setPrice(float $value){
        $this -> price = ($value<0?-$value:$value);
    }
    public function setEditor(string $value){
        $this -> editor = ($value<0?0:$value);
    }
    public function setDate(string $value){
        $this -> date = $value;
    }
    public function setDescription(string $value){
        $this -> description = $value;
    }
    public function setStock(int $value){
        $this -> stock = $value;
    }
    public function setImage(string $value){
        if ($value != NULL){
            $this -> image = $value;
        }else{
            $this -> image = "";
        }
    }
    //getter
    public function getId(){
        return $this -> id;
    }
    public function getName($raw = false){
        if (!is_null ($this->name)){
            return ($raw ? $this -> name : htmlspecialchars($this -> name));
        }else{
            return "corrige_moi";
        }
    }
    public function getPrice(){
        return $this -> price;
    }
    public function getEditor(){
        return $this -> editor;
    }
    public function getDate(){
        return $this -> date;
    }
    public function getDescription(){
        return $this -> description;
    }
    public function getStock(){
        return $this -> stock;
    }
    public function getImage(){
        return $this -> image;
    }
    

}
?>