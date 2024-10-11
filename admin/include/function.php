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

?>