<?php

// Definir rutas
define('TEMPLATES_URL', __DIR__ . '/template');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAuth() : bool{
    session_start();

    if(!$_SESSION['login']){
        header('location: /');
        return false;
    }
    return true;
}

function debug($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}