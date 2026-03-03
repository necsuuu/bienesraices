<?php 

    require 'includes/app.php';
    require 'includes/funciones.php';


    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="img webp">
                    <source srcset="build/img/nosotros.jpg" type="img jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti aspernatur quidem neque natus hic facilis blanditiis dignissimos. Necessitatibus officiis sapiente porro, amet earum accusamus laborum minus dolorem dolor consequatur? Aliquam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis facere illum quae. Unde suscipit eaque a, sapiente necessitatibus laboriosam accusantium, quis voluptatibus magnam corporis sequi culpa voluptate quasi voluptates iste.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt sit, deserunt nemo sapiente pariatur nostrum aliquid obcaecati quam libero! Molestias, at ullam saepe minus rem sit. Dignissimos molestiae cupiditate esse.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt sit, deserunt nemo sapiente pariatur nostrum aliquid obcaecati quam libero! Molestias, at ullam saepe minus rem sit. Dignissimos molestiae cupiditate esse.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="tiempo" loading="lazy">
                <h3>A tiempo</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt sit, deserunt nemo sapiente pariatur nostrum aliquid obcaecati quam libero! Molestias, at ullam saepe minus rem sit. Dignissimos molestiae cupiditate esse.</p>
            </div>

        </div>
    </section>

<?php incluirTemplate('footer'); ?>