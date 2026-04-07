<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManager as image;
use Intervention\Image\Drivers\Gd\Driver;
use App\Vendedor;

estaAuth();

// DB
$db = conectar();
Propiedad::setDB($db);

// Obtener vendedores
$vendedores = Vendedor::all();

// errores
$errores = Propiedad::getErrores();

$propiedad = new Propiedad;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $propiedad = new Propiedad($_POST['propiedad']);

      // nombre unico
     $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
     if($_FILES['propiedad']['tmp_name']['imagen']) {
        $manager = new image(new Driver());
        $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
        $propiedad->setImg($nombreImg);
     }

    $errores = $propiedad->validar();

    // SI TODO OK
    if(empty($errores)) {

        // carpeta
        if(!is_dir(CARPETA_IMAGENES)){ 
            mkdir(CARPETA_IMAGENES);
        }

        // guardar la imagen
        if(isset($imagen)) {
            $imagen->save(CARPETA_IMAGENES . $nombreImg);
        }

        // guardar
        $resultado = $propiedad->guardar();

    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php incluirTemplate('formulario_propiedades', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
        ]); ?>
        
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>