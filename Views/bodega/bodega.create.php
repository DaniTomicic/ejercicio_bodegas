<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nueva bodega</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
    <div id="app" class="container form-page">
        <a class="link" href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>">&larr; Volver</a>

        <section class="card">
            <h1 class="title">Crear nueva bodega</h1>

            <form id="bodega-create-form" class="form" method="POST" action="index.php?controller=BodegaController&action=create">
                <label class="label">Nombre</label>
                <input class="input" type="text" name="nombre" placeholder="Nombre de la bodega">

                <label class="label">Localización</label>
                <input class="input" type="text" name="localizacion" placeholder="Localización">

                <label class="label">Correo electrónico</label>
                <input class="input" type="email" name="email" placeholder="Correo electrónico">

                <label class="label">Teléfono</label>
                <input class="input" type="text" name="telefono" placeholder="Teléfono">

                <label class="label">Persona de contacto</label>
                <input class="input" type="text" name="contacto" placeholder="Persona de contacto">

                <label class="label">Fecha de fundación</label>
                <input class="input" type="date" name="fecha_fundacion">

                <div class="radio-row">
                    <label class="label">¿Dispone de restaurante?</label>
                    <label><input type="radio" name="tiene_restaurante" value="false"> No</label>
                    <label><input type="radio" name="tiene_restaurante" value="true"> Sí</label>
                </div>

                <div class="radio-row">
                    <label class="label">¿Dispone de hotel?</label>
                    <label><input type="radio" name="tiene_hotel" value="false"> No</label>
                    <label><input type="radio" name="tiene_hotel" value="true"> Sí</label>
                </div>

                <label class="label">Descripción</label>
                <textarea class="textarea" name="descripcion" placeholder="Descripción"></textarea>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Crear bodega</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>