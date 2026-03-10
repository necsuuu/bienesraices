<?php 

    //validar url por id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('location: /admin');
    }

    // db

    require '../../includes/config/databases.php';
    $db = conectar();

    //obtener ls datos de la propiedad

    $consulta = "SELECT * FROM propiedades WHERE id={$id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedades = mysqli_fetch_assoc($resultado);





    //consultar para los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //arreglo con msj de errores

    $error = [];

    $titulo = $propiedades['titulo'];
    $precio = $propiedades['precio'];
    $descripcion = $propiedades['descripcion'];
    $habitaciones = $propiedades['habitaciones'];
    $wc = $propiedades['wc'];
    $estacionamiento = $propiedades['estacionamiento'];
    $vendedor = $propiedades['vendedores_id'];
    $creado = date('Y/m/d');
    $imagenPropiedad = $propiedades['imagen'];

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

        // //validar por tamaño

         $medida = 1000 * 5000;

         if($imagen['size'] > $medida){
             $error[] = "la imagen debe ser de menos de 100kb";
        }
        
        //revisar errores

        if(empty($error)){

            //crear carpeta

            $carpetaImg = '../../imagenes/';



            if(!is_dir($carpetaImg)){
                mkdir($carpetaImg);
            }        
            
            $nombreImg = '';

            // SUBIDA DE ARCHIVOS

            if($imagen['name']){
                //eliminar img previa
                unlink($carpetaImg . $propiedades['imagen']);
                //generacion de nombre unico

                $nombreImg = md5( uniqid( rand(), true )) . ".jpg";

                //subir la img

                move_uploaded_file($imagen['tmp_name'], $carpetaImg . $nombreImg);
            }else{
                $nombreImg = $propiedades['imagen'];
            }


            //generacion de nombre unico

            $nombreImg = md5( uniqid( rand(), true )) . ".jpg";

            //subir la img

            move_uploaded_file($imagen['tmp_name'], $carpetaImg . $nombreImg);


            //insertar db
            $query = "UPDATE propiedades SET titulo = '{$titulo}',precio = '{$precio}', imagen = '{$nombreImg}',descripcion = '{$descripcion}',habitaciones = {$habitaciones},wc = {$wc},
            estacionamiento = {$estacionamiento},vendedores_id = {$vendedor} WHERE id = {$id}";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('location: /admin?resultado=2'); 
            }else{
                echo "hubo error";
            }
        }

        

    }



    require '../../includes/funciones.php';
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

        <form class="formulario" action="" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="Titulo">Titulo:</label>
            <input type="text" id="Titulo" name="Titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">precio:</label>
            <input type="number" id="precio" name="Precio" placeholder="Precio de la Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small" alt="">

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

        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
        </form>

    </main>

<?php incluirTemplate('footer'); ?>    