<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nueva bodega</title>
</head>
<body>
    <h1>Crear nueva bodega</h1>

    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>">Volver</a>

    <form method="POST" action="index.php?controller=BodegaController&action=create">
        <input type="text" name="nombre" placeholder="Nombre de la bodega"><br>

        <input type="text" name="localizacion" placeholder="Localización"><br>

        <input type="text" name="email" placeholder="Correo electrónico"><br>

        <input type="text" name="telefono" placeholder="Teléfono"><br>

        <input type="text" name="contacto" placeholder="Persona de contacto"><br>

        <input type="date" name="fecha_fundacion" placeholder="Fecha de fundación"><br>

        <label>¿Dispone de restaurante?</label>
        <input type="radio" name="tiene_restaurante" value="false"> No
        <input type="radio" name="tiene_restaurante" value="true"> Sí
        <br>

        <label>¿Dispone de hotel?</label>
        <input type="radio" name="tiene_hotel" value="false"> No
        <input type="radio" name="tiene_hotel" value="true"> Sí
        <br>
        <textarea name="descripcion" placeholder="Descripcion"></textarea>
        <br>

        <input type="submit">
    </form>
</body>
</html>