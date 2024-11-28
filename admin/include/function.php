<?php

function redirect($chemin){
    header("Location: ".$chemin);
    exit();
}

function date_adapt($date){
    $timestamp = strtotime($date); 
    $new_date = date('d/m/Y', $timestamp);
    return ($new_date);
}   

function cleanFilename($str){

    $results = strtolower($str);

    $tabKO = [" ", "'", "à", "@", "é", "è", "ê", "<", ">"];
    $tabOK = ["_", "_", "a", "a", "e", "e", "e", "(", ")"];

    $results = str_replace($tabKO, $tabOK, $str);

    return $results;
}

function checkFilename ($str){
    global $img_format;
    $results = $str;
    $cpt = 1;
    $prefix = array_key_first($img_format);
    while(file_exists($_SERVER['DOCUMENT_ROOT']."/upload/".$prefix.$results.($cpt > 1 ? "_(".$cpt.")": "").".webp")){

        $cpt++;
    }
    return $results.($cpt > 1 ? "_(".$cpt.")": "");
}

function rickRoll(){
    redirect("https://www.youtube.com/watch?v=dQw4w9WgXcQ");
    exit();
}

spl_autoload_register("loadClass");

function loadClass($className){

    if(file_exists($_SERVER['DOCUMENT_ROOT']."/class/".$className.".class.php")){
        require_once $_SERVER['DOCUMENT_ROOT']."/class/".$className.".class.php";
    }else{
        rickRoll();
    }
}

?>