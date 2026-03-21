<?php

if(!function_exists('conectar')){
    function conectar(){
        $db = new mysqli('127.0.0.1', 'root', 'root', 'bienesRaices_crud');

        if(!$db){
            echo "no se conecto";
            exit;
        }

        return $db;
    }
}