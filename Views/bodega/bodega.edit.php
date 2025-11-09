<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Una sola bodega</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>

    <div id="app" class="container form-page">
        <header class="header">
            <h1 class="title">Editar bodega</h1>
        </header>

        <nav class="actions">
            <a class="link" href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>">&larr; Volver</a>
            <a class="link link-danger" href="index.php?controller=BodegaController&action=delete&id=<?= $bodega->getIdBodega() ?>">Eliminar</a>
        </nav>

        <section class="card">
            <form id="bodega-edit-form" class="form" method="POST" action="index.php?controller=BodegaController&action=update">
                <input type="hidden" name="id" value="<?= $bodega->getIdBodega() ?>">

                <label class="label" for="nombre">Nombre</label>
                <input class="input" type="text" name="nombre" value="<?= $bodega->getNombre() ?>">

                <label class="label" for="Localizacion">Localización</label>
                <input class="input" type="text" name="localizacion" value="<?= $bodega->getLocalizacion() ?>">

                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" value="<?= $bodega->getEmail() ?>">

                <label class="label" for="telefono">Teléfono</label>
                <input class="input" type="text" name="telefono" value="<?= $bodega->getTelefono() ?>">

                <label class="label" for="contacto">Contacto</label>
                <input class="input" type="text" name="contacto" value="<?= $bodega->getContacto() ?>">

                <label class="label" for="fundacion">Año de fundación</label>
                <input class="input" type="date" name="fecha_fundacion" value="<?= $bodega->getFechaFundacion()->format('Y-m-d') ?>">

                <div class="radio-row">
                    <label class="label">Dispone de restaurante?</label>
                    <label><input type="radio" name="tiene_restaurante" value="false" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?>> No</label>
                    <label><input type="radio" name="tiene_restaurante" value="true" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?>> Sí</label>
                </div>

                <div class="radio-row">
                    <label class="label">Dispone de hotel?</label>
                    <label><input type="radio" name="tieneHotel" value="false" <?= $bodega->tieneHotel() ? 'checked' : '' ?>> No</label>
                    <label><input type="radio" name="tieneHotel" value="true" <?= $bodega->tieneHotel() ? 'checked' : '' ?>> Sí</label>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Guardar cambios</button>
                </div>
            </form>
        </section>
    </div>
    
</body>
</html>