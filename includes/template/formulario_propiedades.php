<fieldset>
            <legend>Información General</legend>

            <label>Titulo:</label>
            <input type="text" name="propiedad[titulo]" value="<?php echo s($propiedad->titulo); ?>">

            <label>Precio:</label>
            <input type="number" name="propiedad[precio]" value="<?php echo s($propiedad->precio); ?>">

            <label>Imagen:</label>
            <input type="file" name="propiedad[imagen]">

            <?php if($propiedad->imagen): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
            <?php endif; ?>

            <label>Descripción:</label>
            <textarea name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Detalles</legend>

            <input type="number" name="propiedad[habitaciones]" placeholder="Habitaciones" value="<?php echo s($propiedad->habitaciones); ?>">
            <input type="number" name="propiedad[wc]" placeholder="Baños" value="<?php echo s($propiedad->wc); ?>">
            <input type="number" name="propiedad[estacionamiento]" placeholder="Estacionamiento" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <label for="vendedor"></label>
            <select name="propiedad[vendedores_id]" id="vendedor">
                <option value="">-- Seleccione --</option>
                <?php foreach($vendedores as $vendedor) : ?>
                    <option value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>