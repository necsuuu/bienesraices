<?php

    //importar conexion

    require 'includes/app.php';
    $db = conectar();

    //crear email y password

    $email = "correo@correo.com";
    $password = "123456";
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //query para crear al usuario

    $query = "INSERT INTO usuario (email, password) VALUES  ( '{$email}', '{$passwordHash}' )";
    
    //agregarlo a la base de datos

    mysqli_query($db, $query);


?>