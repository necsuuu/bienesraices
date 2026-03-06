<?php 
    // db

    require '../../includes/config/databases.php';
    $db = conectar();

    //consultar para los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //arreglo con msj de errores

    $error = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedor = '';
    $creado = date('Y/m/d');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<prev>";
        // var_dump($_POST);
        // echo "</prev>";
        

        $titulo = mysqli_real_escape_string($db, $_POST['Titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['Precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['Descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['Habitacion']);
        $wc = mysqli_real_escape_string($db, $_POST['Wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['Estacionamiento']);
        $vendedor = mysqli_real_escape_string($db, $_POST['Vendedor']);

        //asigna files hacia un variable
        $imagen= $_FILES['imagen'];

        if(!$titulo){
            $error [] = "debe añadir obligatoriamente un titulo";
        }

        if(!$precio){
            $error [] = "debe añadir obligatoriamente un precio";
        }

        if(strlen( $descripcion) < 50 ){
            $error [] = "debe añadir obligatoriamente una descripcion y debe tener almenos 50 caracteres";
        }

        if(!$habitaciones){
            $error [] = "debe añadir obligatoriamente la cantidad de habitaciones";
        }

        if(!$wc){
            $error [] = "debe añadir obligatoriamente la cantidad de baños";
        }

        if(!$estacionamiento){
            $error [] = "debe añadir obligatoriamente la cantidad de lugares de estacionamiento";
        }

        if($imagen['error']){
            $error[] = "debe añadir una imagen obligatoriamente";
        }

        // //validar por tamaño

         $medida = 1000 * 5000;

         if($imagen['size'] > $medida){
             $error[] = "la imagen debe ser de menos de 100kb";
        }
        
        //revisar errores

        if(empty($error)){
            
            // SUBIDA DE ARCHIVOS

            //crear carpeta

            $carpetaImg = '../../imagenes/';

            mkdir($carpetaImg);

            if(!is_dir($carpetaImg)){
                mkdir($carpetaImg);

            
            }

            //generacion de nombre unico

            $nombreImg = md5( uniqid( rand(), true )) . ".jpg";

            //subir la img

            move_uploaded_file($imagen['tmp_name'], $carpetaImg . $nombreImg);


            //insertar db
            $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
            VALUES ( '$titulo', '$precio', '$nombreImg', '$descripcion', '$habitaciones', '$wc', '$estacionamiento','$creado', '$vendedor')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('location: /admin?resultado=1'); 
            }else{
                echo "hubo error";
            }
        }

        

    }



    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($error as $errores):  ?>
            <div class="alerta error">
                <?php echo $errores; ?>
            </div>
            
        <?php endforeach; ?>    

        <form class="formulario" action="" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="Titulo">Titulo:</label>
            <input type="text" id="Titulo" name="Titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">precio:</label>
            <input type="number" id="precio" name="Precio" placeholder="Precio de la Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="Descripcion">Descripcion:</label>
            <textarea name="Descripcion" id="Descripcion"><?php echo $titulo; ?></textarea>

        </fieldset>

        <fieldset>

        <legend>Informacion de la Propiedad</legend>

        <label for="Habitaciones">Habitaciones:</label>
        <input type="number" id="Habitaciones" name="Habitacion" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

        <label for="wc">Baños:</label>
        <input type="number" id="wc" value="<?php echo $wc; ?>" name="Wc" placeholder="Ej: 3" min="1" max="9">

        <label for="Estacionamiento">Estacionamiento:</label>
        <input type="number" id="Estacionamiento" name="Estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">


        </fieldset>


        <fieldset>
            <legend>Vendedor</legend>
            <select name="Vendedor">
                <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear propiedad" class="boton boton-verde">
        </form>

    </main>

<?php incluirTemplate('footer'); ?>    