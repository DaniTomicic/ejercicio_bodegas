<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Una sola bodega</title>
</head>
<body>

    <h1>Datos de Bodega</h1>

    <a href="index.php?controller=BodegaController&action=edit&id=<?= $bodega->getIdBodega() ?>">Editar</a>
    <a href="index.php?controller=BodegaController&action=index">Volver</a>
    <a href="index.php?controller=BodegaController&action=delete&id=<?= $bodega->getIdBodega() ?>">Eliminar</a>

    <form>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $bodega->getNombre() ?>" disabled>

        <br>

        <label for="Localizacion">Localizacon</label>
        <input type="text" name="Localizacion" value="<?= $bodega->getLocalizacion() ?>" disabled>

        <br>

        <label for="email">Email</label>
        <input type="text" name="email" value="<?= $bodega->getEmail() ?>" disabled>

        <br>

        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" value="<?= $bodega->getTelefono() ?>" disabled>
        
        <br>

        <label for="contacto">Contacto</label>
        <input type="text" name="contacto" value="<?= $bodega->getContacto() ?>" disabled>

        <br>

        <label for="fundacion">Año de fundación</label>
        <input type="text" name="fundacion" value="<?= $bodega->getFechaFundacion()->format('Y-m-d') ?>" disabled>

        <br>

        <label for="tiene_restaurante">Dispone de restaurante?</label>
        No<input type="radio" name="tieneRestaurante" value="No" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?> disabled>
        Si<input type="radio" name="tieneRestaurante" value="Si" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?> disabled>

        <br>

        <label for="tiene_hotel">Dispone de Hotel?</label>
        No<input type="radio" name="tieneHotel" value="No" <?= $bodega->tieneHotel() ? 'checked' : '' ?> disabled>
        Si<input type="radio" name="tieneHotel" value="Si" <?= $bodega->tieneHotel() ? 'checked' : '' ?> disabled>

        <br>
        <a href="#">Guardar</a>

    </form>


    <h2>Vinos disponibles</h2>
    <a href="index.php?controller=VinoController&action=addVino">+ Añadir Vino</a>
    <?php if($bodega->getVinos()): ?>
        <form>
        <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre del vino</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bodega->getVinos() as $vino): ?>
                <tr>
                    <td>
                        <input type="text" name="nombre[]" value="<?= $vino->getNombre() ?>" disabled>
                    </td>
                    <td>
                        <input type="text" name="tipo[]" value="<?= $vino->getTipo() ?>" disabled>
                    </td>
                    <td>
                        <!-- Aquí puedes añadir botones de acción si lo deseas -->
                        <a href="index.php?controller=VinoController&action=edit&id=<?= $vino->getIdVino() ?>">Editar</a>
                        <a href="index.php?controller=VinoController&action=delete&id=<?= $vino->getIdVino() ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </form>
    <?php endif; ?>
    
</body>
</html>