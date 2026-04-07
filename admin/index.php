    <?php 

        require '../includes/app.php';
        estaAuth();

        use App\Propiedad;
        use App\Vendedor;

        // implementar un metodo para obtener todas las propiedades
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        //mensaje condicional
        $resultado = $_GET['resultado'] ?? null;   
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){

                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
                
            }
            
        }

        //incluir template
        incluirTemplate('header');
    ?>
        <main class="contenedor seccion">
            <h1>Administrador de Bienes Raices</h1>
            <?php if($resultado == 1):?>
                <p class="alerta exito">Propiedad Publicada Correctamente</p>
            <?php elseif($resultado == 2):?>
                <p class="alerta exito">Propiedad Actualizada Correctamente</p>
            <?php elseif($resultado == 3):?>
                <p class="alerta exito">Propiedad Se Elimino Correctamente</p>
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

                    <?php foreach($propiedades as $propiedad): ?>

                    <tr>
                        <td> <?php echo $propiedad->id; ?> </td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                        <td><?php echo $propiedad->precio; ?></td>
                        <td>
                            <form method="POST"  class="w-100">

                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">

                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </main>

    <?php 
    mysqli_close($db);
    incluirTemplate('footer'); ?>    