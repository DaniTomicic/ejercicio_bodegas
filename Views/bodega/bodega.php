<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Una sola bodega</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
<body>

    <div id="app" class="container">
        <header class="header">
            <h1 class="title">Datos de Bodega</h1>
        </header>

        <nav class="actions">
            <a class="btn" href="index.php?controller=BodegaController&action=edit&id=<?= $bodega->getIdBodega() ?>">Editar</a>
            <a class="btn" href="index.php?controller=BodegaController&action=index">Volver</a>
            <a class="btn btn-danger" href="index.php?controller=BodegaController&action=delete&id=<?= $bodega->getIdBodega() ?>">Eliminar</a>
        </nav>

        <section class="card">
            <form class="form">
                <label class="label" for="nombre">Nombre</label>
                <input class="input" type="text" name="nombre" value="<?= $bodega->getNombre() ?>" disabled>

                <label class="label" for="Localizacion">Localización</label>
                <input class="input" type="text" name="Localizacion" value="<?= $bodega->getLocalizacion() ?>" disabled>

                <label class="label" for="email">Email</label>
                <input class="input" type="text" name="email" value="<?= $bodega->getEmail() ?>" disabled>

                <label class="label" for="telefono">Teléfono</label>
                <input class="input" type="text" name="telefono" value="<?= $bodega->getTelefono() ?>" disabled>

                <label class="label" for="contacto">Contacto</label>
                <input class="input" type="text" name="contacto" value="<?= $bodega->getContacto() ?>" disabled>

                <label class="label" for="fundacion">Año de fundación</label>
                <input class="input" type="text" name="fundacion" value="<?= $bodega->getFechaFundacion()->format('Y-m-d') ?>" disabled>

                <div class="radio-row">
                    <label class="label">Dispone de restaurante?</label>
                    No<input type="radio" name="tieneRestaurante" value="No" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?> disabled>
                    Si<input type="radio" name="tieneRestaurante" value="Si" <?= $bodega->tieneRestaurante() ? 'checked' : '' ?> disabled>
                </div>

                <div class="radio-row">
                    <label class="label">Dispone de Hotel?</label>
                    No<input type="radio" name="tieneHotel" value="No" <?= $bodega->tieneHotel() ? 'checked' : '' ?> disabled>
                    Si<input type="radio" name="tieneHotel" value="Si" <?= $bodega->tieneHotel() ? 'checked' : '' ?> disabled>
                </div>
                <input type="text" id="idBodega" value="<?= $bodega->getIdBodega() ?>" hidden disabled>
            </form>
        </section>


        <section class="card wines">
            <h2>Vinos disponibles</h2>
            <a class="btn btn-primary" href="index.php?controller=VinoController&action=addVino&idBodega=<?= $bodega->getIdBodega() ?>">+ Añadir Vino</a>
            <?php if($bodega->getVinos()): ?>
                <table id="vinos-table" class="table">
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
                                <td><input class="input" type="text" name="nombre[]" value="<?= $vino->getNombre() ?>" disabled></td>
                                <td><input class="input" type="text" name="tipo[]" value="<?= $vino->getTipo() ?>" disabled></td>
                                <td>
                                    <a class="link" href="index.php?controller=VinoController&action=edit&id=<?= $vino->getIdVino() ?>">Editar</a>
                                    <button class="btn btn-danger eliminar-vino" data-id="<?= $vino->getIdVino() ?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </div>
    <script src="scripts/deleteVino.js" defer></script>
</body>
</html>