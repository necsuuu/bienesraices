<?php

require_once 'funciones.php';
require_once 'config/databases.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Propiedad;

$propiedad = new Propiedad;

Propiedad::setDB();