<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de bodegas</title>
</head>
<body>
    <h1>Gestión de Bodegas</h1>
    <p>Este proyecto muestra como hacer una aplicacion web MVC con PHO</p>
    <p>El objetico es mostrar como realizar una aplicación utilizanod el patrón de diseño</p>

    <a href="index.php?controller=BodegaController&action=createView">+ Añadir Bodega</a>

        <table border="1" cellpadding="8" cellspacing="0">
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
                        <a href="index.php?controller=BodegaController&action=verBodega&id=<?= $bodega['id_bodega'] ?>">Entrar</a>
                        <a href="index.php?controller=BodegaController&action=delete&id=<?= $bodega['id_bodega'] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>