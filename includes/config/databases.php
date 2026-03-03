<?php

function conectar(){
    $db = mysqli_connect('127.0.0.1', 'root', 'root', 'bienesRaices_crud');

    if(!$db){
        echo "no se conecto";
        exit;
    }

    return $db;

}