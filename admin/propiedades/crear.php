<?php 

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManager as image;
use Intervention\Image\Drivers\Gd\Driver;

estaAuth();

// DB
$db = conectar();
Propiedad::setDB($db);

// vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// errores
$errores = Propiedad::getErrores();

// valores
$datos = [
    'titulo' => '',
    'precio' => '',
    'descripcion' => '',
    'habitaciones' => '',
    'wc' => '',
    'estacionamiento' => '',
    'vendedores_id' => ''
];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $propiedad = new Propiedad($_POST);

      // nombre unico
     $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
     if($_FILES['imagen']['tmp_name']) {
        $manager = new image(new Driver());
        $imagen = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
        $propiedad->setImg($nombreImg);
     }

    $error = $propiedad->validar();

    // SI TODO OK
    if(empty($errores)) {

        // carpeta
        if(!is_dir(CARPETA_IMAGENES)){ {
            mkdir(CARPETA_IMAGENES);
        }

        // guardar la imagen
        $imagen->save(CARPETA_IMAGENES . $nombreImg);

        // guardar
        $resultado = $propiedad->guardar();

        if($resultado) {
            header('Location: /admin?resultado=1');
        }
    }
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

        <fieldset>
            <legend>Información General</legend>

            <label>Titulo:</label>
            <input type="text" name="titulo" value="<?php echo $datos['titulo']; ?>">

            <label>Precio:</label>
            <input type="number" name="precio" value="<?php echo $datos['precio']; ?>">

            <label>Imagen:</label>
            <input type="file" name="imagen">

            <label>Descripción:</label>
            <textarea name="descripcion"><?php echo $datos['descripcion']; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Detalles</legend>

            <input type="number" name="habitaciones" placeholder="Habitaciones" value="<?php echo $datos['habitaciones']; ?>">
            <input type="number" name="wc" placeholder="Baños" value="<?php echo $datos['wc']; ?>">
            <input type="number" name="estacionamiento" placeholder="Estacionamiento" value="<?php echo $datos['estacionamiento']; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedores_id">
                <option value="">-- Seleccionar --</option>
                <?php while($v = mysqli_fetch_assoc($resultado)): ?>
                    <option value="<?php echo $v['id']; ?>">
                        <?php echo $v['nombre'] . " " . $v['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>