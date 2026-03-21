<?php

namespace App;

class Propiedad {
    // DB
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    // errores
    protected static $errores = [];

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
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y-m-d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function guardar() {

    $datos = $this->sanitizarDatos();

    if(!$this->precio){
        echo "El precio es obligatorio";
        return;
    }

    $query = "INSERT INTO propiedades (";
    $query .= join(", ", array_keys($datos));
    $query .= ") VALUES ('";
    $query .= join("', '", array_values($datos));
    $query .= "')";

    $resultado = self::$db->query($query);
}

    public static function setDB($database) {
        self::$db = $database;
    }

    public function datos(){
        $datos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $datos[$columna] = $this->$columna; 
        }
        return $datos;
    }

    public function sanitizarDatos(){
        $datos = $this->datos();
        $sanitizado = [];

        foreach($datos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;

    }

    // Validación
    public static function getErrores() {

        return self::$errores;

    }

    public function validar() {

        if(!$this->titulo) {
            self::$errores[] = "El título es obligatorio";
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El número de estacionamientos es obligatorio";
        }

        if(!$this->vendedores_id) {
            self::$errores[] = "El vendedor es obligatorio";
        }

        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    public function setImg($imagen){
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query) {
        // consultar a la base de datos
        $resultado = self::$db->query($query);

        // iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
    }
}

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
 
}