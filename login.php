<?php 

    //incluye el header
    require_once 'includes/app.php';
    incluirTemplate('header');

    //conectar db
    $db = conectar();
    //autenticar el usuario

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'    ){

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores [] = "El email es obligatorio o no es valido";
        }

        if(!$password){
            $errores[]="El password es obligatorio"; 
        }

        if(empty($errores)){

            //revisar si el usario existe

            $query = "SELECT * FROM usuario WHERE email= '{$email}'";
            $resultado = mysqli_query($db, $query);

            if($resultado -> num_rows){
                // el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //verifica q el password sea correcto
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    //el usuario esta autenticado
                    session_start();

                    //llenar el arreglo de la sesion
                    $_SESSION['usuario']= $usuario['email'];
                    $_SESSION['login']=true;

                    header('location: /admin');

                }else{
                    $errores[] = "El password es incorrecto";
                }

            }else{
                $errores[] = "El usuario no existe";
            }
        }
    }


?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" action="" novalidate>
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Tu e-mail" requied>

                <label for="pasword">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu password" required>
            </fieldset>
            
            <input type="submit" value="Iniciar Sesion" class="boton-verde-block">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>    