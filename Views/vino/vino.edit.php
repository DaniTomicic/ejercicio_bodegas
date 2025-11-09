<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vino</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
    <div id="app" class="container form-page">
        <header class="header">
            <h1 class="title">Editar vino</h1>
            <p class="subtitle muted">Modifica los datos del vino y guarda con el botón. La petición se realizará desde JS.</p>
        </header>

        <nav class="actions">
            <a class="link" href="index.php">&larr; Volver</a>
        </nav>

        <section class="card">
            <!-- Form sin action: la intención es manejar submit con JS (await) -->
            <form id="vino-edit-form" class="form" method="POST">

                <input type="hidden" id="id-vino" name="id_vino" value="<?= isset($vino) ? $vino->getIdVino() : '' ?>">
                <?php
                    $idB = '';
                    if(isset($vino) && $vino->getBodega()){
                        $idB = $vino->getBodega()->getIdBodega();
                    } elseif(isset($idBodega)){
                        $idB = $idBodega;
                    } elseif(isset($_GET['idBodega'])){
                        $idB = $_GET['idBodega'];
                    }
                ?>
                <input type="hidden" id="id-bodega" name="id_bodega" value="<?= $idB ?>">

                <label class="label" for="nombre-vino">Nombre del vino</label>
                <input class="input" type="text" id="nombre-vino" name="nombre" value="<?= isset($vino) ? $vino->getNombre() : '' ?>" required>

                <label class="label" for="tipo-vino">Tipo</label>
                <input class="input" type="text" id="tipo-vino" name="tipo" value="<?= isset($vino) ? $vino->getTipo() : '' ?>" required>

                <label class="label" for="anno-vino">Año</label>
                <?php // Corregido: usar null coalescing para evitar warnings/errores si getAnio() es null ?>
                <input class="input" type="number" id="anno-vino" name="anio" min="1900" max="2100" value="<?= isset($vino) ? ($vino->getAnio() ?? '') : '' ?>">

                <label class="label" for="alcohol-vino">Alcohol (%)</label>
                <?php // Usar null coalescing para mostrar valor aunque sea 0.0 ?>
                <input class="input" type="number" id="alcohol-vino" name="alcohol" step="0.1" min="0" max="25" value="<?= isset($vino) ? ($vino->getAlcohol() ?? '') : '' ?>">

                <label class="label" for="desc-vino">Descripción</label>
                <textarea class="textarea" id="desc-vino" name="descripcion"><?= isset($vino) ? $vino->getDescripcion() : '' ?></textarea>

                <div class="form-actions">
                    <button class="btn btn-primary" id="btn-guardar-vino" type="submit">Guardar cambios</button>
                    <span id="msg-vino" class="span-message"></span>
                </div>
            </form>
        </section>
    </div>

    <!-- Script para manejar el submit por await (implementar lógica JS según convenga) -->
    <script src="scripts/editVino.js" defer></script>
</body>
</html>
