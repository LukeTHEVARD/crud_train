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
    $results = $str;
    $cpt = 1;
    while(file_exists($_SERVER['DOCUMENT_ROOT']."/upload/".$results.($cpt > 1 ? "_(".$cpt.")": "").".webp")){

        $cpt++;
    }
    return $results.($cpt > 1 ? "_(".$cpt.")": "");
}

function rickRoll(){
    redirect("https://www.youtube.com/watch?v=dQw4w9WgXcQ");
    exit();
}

?>