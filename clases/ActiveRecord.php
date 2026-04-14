<?php

namespace App;

class ActiveRecord{
    // DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // errores
    protected static $errores = [];

    public function guardar() {
        if(!is_null($this->id)) {
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear() {

    $datos = $this->sanitizarDatos();

    $query = "INSERT INTO " . static::$tabla . " (";
    $query .= join(", ", array_keys($datos));
    $query .= ") VALUES ('";
    $query .= join("', '", array_values($datos));
    $query .= "')";

    $resultado = self::$db->query($query);
    if($resultado){
        header('location: /admin?resultado=1');
    }
}

    public function actualizar() {
        $datos = $this->sanitizarDatos();

        $valores = [];
        foreach($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id='" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        $resultado = self::$db->query($query);
      
        if($resultado){
                header('location: /admin?resultado=2'); 
            }
        
        return $resultado;  
    } 

    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if(!is_null($this->id)){
            $this->eliminarImagen();
            header('location: /admin?resultado=3');
        }
        return $resultado;
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function datos(){
        $datos = [];
        foreach(static::$columnasDB as $columna){
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
        return static::$errores;

    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    public function setImg($imagen){
        // Elimina la imagen previa
        if($this->id) {
            $this->eliminarImagen();
        }
        // asigna el nombre de la imagen al atributo 
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function eliminarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // busca las propiedades con cierta cantidad de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //buscar una propiedad por su id
    public static function find ($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        // consultar a la base de datos
        $resultado = self::$db->query($query);

        // iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);

    }

    $resultado->free();

    return $array;
}
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

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public static function where($columna, $valor) {
    $query = "SELECT * FROM " . static::$tabla . 
             " WHERE {$columna} = '" . self::$db->escape_string($valor) . "'";
    return self::consultarSQL($query);
}
 
}