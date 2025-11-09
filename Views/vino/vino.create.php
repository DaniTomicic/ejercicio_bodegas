<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Vino</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
    <div id="app" class="container form-page">
        <header class="header">
            <h1 class="title">Añadir nuevo vino</h1>
        </header>

        <nav class="actions">
            <a class="link" href="index.php">&larr; Volver</a>
        </nav>

        <section class="card">
            <!-- Se quita el action al form para interceptarlo desde js -->
            <form id="vino-create-form" class="form" method="POST">

                <label class="label">Nombre del vino</label>
                <input class="input" type="text" name="nombre" placeholder="Nombre del vino" required id="nombre-vino">

                <label class="label">Tipo</label>
                <input class="input" type="text" name="tipo" placeholder="Tinto, Blanco, Rosado..." required id="tipo-vino">


                <label class="label" for="anno-vino">Año</label>
                <input class="input" type="number" name="anio" placeholder="2020" min="1900" max="2100" id="anno-vino">

                <label class="label" for="alcohol-vino">Alcohol (%)</label>
                <input class="input" type="number" name="alcohol" placeholder="13.5%" min="0" max="25" step="0.1" id="alcohol-vino">

                <input class="input" type="number" name="id_bodega" id="id-bodega" value="<?= $idBodega ?>" hidden>

                <label class="label">Descripción</label>
                <textarea class="textarea" name="descripcion" placeholder="Notas del vino" id="desc-vino"></textarea>

                <div class="form-actions">
                    <button class="btn btn-primary" id="btn-annadir-vino">Añadir vino</button>
                </div>
                <span></span>

            </form>
        </section>
    </div>
    <script src="scripts/addVino.js" defer></script>
</body>
</html>
