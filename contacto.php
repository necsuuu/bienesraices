<?php 

    require 'includes/app.php';
    require 'includes/funciones.php';


    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="img webp">
            <source srcset="build/img/destacada3.jpg" type="img jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="img">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="Nombre">Nombre</label>
                <input type="text" name="Tu nombre" id="Nombre" placeholder="Tu nombre">

                <label for="email">E-mail</label>
                <input type="email" name="Tu email" id="email" placeholder="Tu e-mail">

                <label for="telefono">Telefono</label>
                <input type="tel" name="Tu telefono" id="telefono" placeholder="Tu teléfono">

                <label for="mensaje">Mensaje</label>
                <textarea name="" id="mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                <label for="opciones">vende o compra</label>
                <select name="" id="opciones">
                    <option value="" disabled selected>-- seleccione</option>
                    <option value="compra">compra</option>
                    <option value="vende">vende</option>

                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="Tu telefono" id="presupuesto" placeholder="">

            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <p>como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" name="contacto" id="contactar-email" placeholder="">
                </div>

                <p>Si eligio telefono, elija la fecha y la hora</p>

                <label for="fecha">fecha</label>
                <input type="date" id="fecha" >

                <label for="hora">hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>   
            
            <input type="submit" name="" id="" value="Enviar" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>