<?php 
use App\Propiedad;
require 'includes/app.php';

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('location: /');
}

$propiedad = Propiedad::find($id);

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">

<h1><?php echo $propiedad->titulo; ?></h1>

<img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad">

<div class="resumen-propiedad">

<p class="precio">$<?php echo $propiedad->precio; ?></p>

<ul class="iconos-caracteristicas">

<li>
<img loading="lazy" src="build/img/icono_wc.svg">
<p><?php echo $propiedad->wc; ?></p>
</li>

<li>
<img loading="lazy" src="build/img/icono_estacionamiento.svg">
<p><?php echo $propiedad->estacionamiento; ?></p>
</li>

<li>
<img loading="lazy" src="build/img/icono_dormitorio.svg">
<p><?php echo $propiedad->habitaciones; ?></p>
</li>

</ul>

<p><?php echo $propiedad->descripcion; ?></p>

</div>

</main>

<?php incluirTemplate('footer'); ?>