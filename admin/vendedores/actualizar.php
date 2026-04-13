<?php

require '../../includes/app.php';

use App\Vendedor;

estaAuth();

//validar que sea un ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

// Obtener los datos del vendedor a actualizar
$vendedor = Vendedor::find($id);

$vendedor = new Vendedor;

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();  

// Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // Asignar los atributos
    $args = $_POST['vendedor'];
    $vendedor->sincronizar($args);

    // Validar que no haya campos vacios
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST"">

        <?php include __DIR__ . '/../../includes/template/formulario_vendedores.php'; ?>
        
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?> 