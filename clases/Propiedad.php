<?php

namespace App;

class Propiedad{

    //DB

    protected static $db;

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []) {
        $this->id = ['id'] ?? '';
        $this->titulo = ['titulo'] ?? '';
        $this->precio = ['precio'] ?? '';
        $this->imagen = ['imagen'] ?? '';
        $this->descripcion = ['descripcion'] ?? '';
        $this->habitaciones = ['habitaciones'] ?? '';
        $this->wc = ['wc'] ?? '';
        $this->estacionamiento = ['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = ['vendedores_id'] ?? '';
    }

    public function guardar(){
        //insertar db
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
        VALUES ( 'this->$titulo', 'this->$precio', 'this->$imagen', 'this->$descripcion', 'this->$habitaciones', 'this->$wc', 'this->$estacionamiento','this->$creado', 'this->$vendedor')";

    }

    //definir la conexion a la db

    public static function setDB($database){
        self::$db = $database;
    }
}