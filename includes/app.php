<?php

require_once 'funciones.php';
require_once 'config/databases.php';
require_once __DIR__ . '/../vendor/autoload.php';

//conectar la db

$db = conectar();

use App\ActiveRecord;

ActiveRecord::setDB($db);