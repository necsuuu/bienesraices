<?php
// NO vuelvas a incluir app.php aquí si ya lo hiciste en index.php, 
// o usa require_once si es necesario.

function incluirTemplate( string $nombre, $inicio = false) {
    // Nota que ya no ponemos la barra "/" si TEMPLATES_URL ya la tiene o si la manejas con cuidado
    include TEMPLATES_URL . "/${nombre}.php"; 
}