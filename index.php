<?php 

    require 'includes/app.php';    
    incluirTemplate('header', ['inicio' => true]);
?>

    <main class="contenedor seccion">
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
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        
        <?php
            include 'includes/template/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>

        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis atque amet exercitationem, et esse iusto </p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image webp">
                        <source srcset="build/img/blog1.jpg" type="image jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="img">

                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>23/02/26</span> por: <span>Admin</span></p>

                        <p>
                            consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                        </p>
                    </a>

                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image webp">
                        <source srcset="build/img/blog2.jpg" type="image jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="img">

                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>23/02/26</span> por: <span>Admin</span></p>

                        <p>
                            maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                        </p>
                    </a>

                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus ullam delectus cupiditate
                </blockquote>
                <p>- Andres Benjamin Ruiz</p>
            </div>
        </section>
    </div>

<?php incluirTemplate('footer'); ?>