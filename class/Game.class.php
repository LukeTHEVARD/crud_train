<?php 


class Game{

    private int $id;
    private ?string $name;
    private ?float $price;
    private ?string $description = "";
    private ?string $editor = "";
    private ?int $stock = 0;
    private ?string $image = "";
    private ?string $date = "";



    public function __construct($data = NULL){
            $this->setId(0);
            $this->setName("no_name");
            $this->setPrice(0);
            $this->hydrate($data);
    }

    public function hydrate($data= NULL){
        if (!is_null($data) and is_array($data)) {
            foreach ($data as $key => $value) {
                $methodName = "set" . ucfirst(str_replace("game_", "", $key));
                if (method_exists($this,$methodName)){
                    $this->{$methodName}($value);
                }
            }
        }}

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
    public function setImage(?string $value){
        if ($value != NULL){
            $this -> image = $value;
        }else{
            $this -> image = "bug_image";
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
        return htmlspecialchars($this -> price);
    }
    public function getEditor(){
        return htmlspecialchars($this -> editor);
    }
    public function getDate(){
        return htmlspecialchars($this -> date);
    }
    public function getDescription(){
        return htmlspecialchars($this -> description);
    }
    public function getStock(){
        return htmlspecialchars($this -> stock);
    }
    public function getImage(){
        return htmlspecialchars($this -> image);
    }
    

}
?>