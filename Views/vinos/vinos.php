<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinos disponibles</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="app" class="container">
        <header class="header">
            <h1 class="title">Vinos disponibles</h1>
            <p class="subtitle muted">Aquí verás la lista de vinos disponibles. La lista será poblada dinámicamente por tu JS.</p>
        </header>

        <a href="/ejercicio_bodegas/index.php?controller=BodegaController&action=index" class="tab active">Volver a Bodegas</a>

        <section class="card">
            <div class="list-controls">

                <input id="filter-vinos" class="input" placeholder="Filtrar por nombre">
            </div>

            <!-- Lista vacía: la idea es que la rellenes con fetch desde el servidor -->
            <ul id="vinos-list" class="list">
                <!-- Ejemplo de item (será generado por JS):
                <li class="list-item">
                    <div class="list-item-main">
                        <strong class="vino-nombre">Nombre del vino</strong>
                        <span class="vino-tipo muted">(Tinto)</span>
                    </div>
                    <div class="list-item-meta">
                        <span class="vino-anio">2021</span>
                        <span class="vino-alcohol">13.5%</span>
                    </div>
                </li>
                 -->
            </ul>
        </section>

        <footer class="footer">
            <p class="muted">&copy; <?= date('Y') ?> Ejercicio Bodegas</p>
        </footer>
    </div>

    <!-- No incluyo JS: serás tú quien implemente la lógica dinámica -->
     <script src="../../scripts/obetnerVinos.js" defer></script>
     <script src="../../scripts/listaDinamica.js" defer></script>
</body>
</html>
