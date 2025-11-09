<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de bodegas</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
    <div id="app" class="container">
        <header id="main-header" class="header">
            <h1 class="title">Gestión de Bodegas</h1>
            <p class="subtitle">Este proyecto muestra cómo hacer una aplicación web MVC con PHP</p>
            <p class="muted">El objetivo es mostrar cómo realizar una aplicación utilizando el patrón de diseño</p>
        </header>

        <nav id="actions" class="actions">
            <div class="tabs" role="tablist" aria-label="Navegación principal">
                <a role="tab" class="tab active" href="index.php    ">Bodegas</a>
                <a role="tab" class="tab" href="Views/vinos/vinos.php">Vinos disponibles</a>
            </div>
            <div class="actions-right">
                <a class="btn btn-primary" href="index.php?controller=BodegaController&action=createView">+ Añadir Bodega</a>
            </div>
        </nav>

        <main>
            <table id="bodegas-table" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Localización</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bodegas as $bodega): ?>
                <tr>
                    <td><?= $bodega['nombre'] ?></td>
                    <td><?= $bodega['localizacion'] ?></td>
                    <td><?= $bodega['telefono'] ?></td>
                    <td><?= $bodega['email'] ?></td>
                    <td>
                        <!-- Aquí puedes agregar botones para editar/eliminar -->
                        <a class="link" href="index.php?controller=BodegaController&action=verBodega&id=<?= $bodega['id_bodega'] ?>">Entrar</a>
                        <a class="link link-danger" href="index.php?controller=BodegaController&action=delete&id=<?= $bodega['id_bodega'] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </main>

        <footer class="footer">
            <p class="muted">&copy; <?= date('Y') ?> Ejercicio Bodegas</p>
        </footer>
    </div>
    
</body>
</html>