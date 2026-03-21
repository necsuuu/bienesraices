<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?= $inicio ? 'inicio' : '' ?>">
            <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    
                    <img src="/build/img/logo.svg" alt="logotipo">
                </a>

                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <?php if($auth): ?>
                        <a href="../../admin/index.php">Panel</a>
                        <a href="cerrar-sesion.php">Cerrar Sesion</a>
                    <?php endif; ?>

                </nav>

            </div> <!-- barra -->

            <?php
                if($inicio){
                    echo "<h1>Ventas de casas y Departamentos Exclusivos De Lujo</h1>";
                }
            ?>

        </div>

    </header>