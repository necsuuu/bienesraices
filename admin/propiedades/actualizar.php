<?php 
    use App\Propiedad;
    use App\Vendedor;   
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Gd\Driver;
    require '../../includes/app.php';
    $vendedores = Vendedor::all();

  
    estaAuth();

    //validar url por id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('location: /admin');
    }

    //obtener ls datos de la propiedad

    $propiedad = Propiedad::find($id); 

    //consultar para los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //arreglo con msj de errores

    $error = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['propiedad'])) {
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);
    }

    $error = $propiedad->validar();

    // Subida de imagen
    if(isset($_FILES['propiedad']['tmp_name']['imagen']) && $_FILES['propiedad']['tmp_name']['imagen']){
        $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
        $manager = new ImageManager(new Driver());
        $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
        $propiedad->setImg($nombreImg);

        // ✅ Guardar imagen solo si no hay errores y se subió una imagen
        if(empty($error)){
            $imagen->save(CARPETA_IMAGENES . $nombreImg);
        }
    }

    // Guardar propiedad si no hay errores
    if(empty($error)){
        $propiedad->guardar();
    }
}
   
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar  Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($error as $errores):  ?>
            <div class="alerta error">
                <?php echo $errores; ?>
            </div>
            
        <?php endforeach; ?>    

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/template/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
        </form>

    </main>

<?php incluirTemplate('footer'); ?>    