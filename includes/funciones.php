<?php

// Definir rutas
define('TEMPLATES_URL', __DIR__ . '/template');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, array $datos = []) {

    foreach($datos as $key => $value) {
        $$key = $value; // crea variables dinámicamente
    }

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

// escapar el HTML
function s($html) : string {
    $s = htmlspecialchars($html ?? '');
    return $s;
}