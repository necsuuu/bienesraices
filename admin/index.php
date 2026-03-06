    <?php 

        //importar db

        require '../includes/config/databases.php';
        $db=conectar();

        //query

        $query = "SELECT * FROM propiedades";

        //consultar db

        $resultadoDB =  mysqli_query($db, $query);


        //mensaje condicional
        $resultado = $_GET['resultado'] ?? null;    
        //incluir template
        require '../includes/funciones.php';
        incluirTemplate('header');
    ?>
        <main class="contenedor seccion">
            <h1>Administrador de Bienes Raices</h1>
            <?php if($resultado == 1):?>
                <p class="alerta exito">Propiedad Publicada Correctamente</p>
            <?php endif;?>

            <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

            <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITULO</th>
                        <th>IMAGEN</th>
                        <th>PRECIO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while($propiedad = mysqli_fetch_assoc($resultadoDB)):  ?>

                    <tr>
                        <td> <?php echo $propiedad['id']; ?> </td>
                        <td><?php echo $propiedad['titulo']; ?></td>
                        <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt=""></td>
                        <td><?php echo $propiedad['precio']; ?></td>
                        <td>
                            <a href="#" class="boton-rojo-block">Eliminar</a>
                            <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>

                    <?php endwhile;?>
                </tbody>
            </table>
        </main>

    <?php 
    mysqli_close($db);
    incluirTemplate('footer'); ?>    