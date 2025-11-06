<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Una sola bodega</title>
</head>
<body>

    <h1>Datos de Bodega</h1>

    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>">Volver</a>
    <a href="index.php?controller=BodegaController&action=delete&id=<?= $bodega->getIdBodega() ?>">Eliminar</a>

    <form method="POST" action="index.php?controller=BodegaController&action=update">
        <input type="text" name="id" value="<?= $bodega->getIdBodega() ?>" hidden>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $bodega->getNombre() ?>">

        <br>

        <label for="Localizacion">Localizacon</label>
        <input type="text" name="localizacion" value="<?= $bodega->getLocalizacion() ?>">

        <br>

        <label for="email">Email</label>
        <input type="text" name="email" value="<?= $bodega->getEmail() ?>">

        <br>

        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" value="<?= $bodega->getTelefono() ?>">
        
        <br>

        <label for="contacto">Contacto</label>
        <input type="text" name="contacto" value="<?= $bodega->getContacto() ?>">

        <br>

        <label for="fundacion">Año de fundación</label>
        <input type="text" name="fecha_fundacion" value="<?= $bodega->getFechaFundacion()->format('Y-m-d') ?>">

        <br>

        <label for="tiene_restaurante">Dispone de restaurante?</label>
        No<input type="radio" name="tiene_restaurante" value="false" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?>>
        Si<input type="radio" name="tiene_restaurante" value="true" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?>>

        <br>

        <label for="tiene_hotel">Dispone de Hotel?</label>
        No<input type="radio" name="tieneHotel" value="false" <?= $bodega->tieneHotel() ? 'checked' : '' ?>>
        Si<input type="radio" name="tieneHotel" value="true" <?= $bodega->tieneHotel() ? 'checked' : '' ?>>

        <br>
        <input type="submit">

    </form>
    
</body>
</html>