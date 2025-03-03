<?php

require_once __DIR__ . '/../Controllers/AgendaController.php';

$controler =  new AgendaController;

if ($_POST) {

    $nombre = $_POST['nombre'];
    $tlf = $_POST['tlf'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $controler->agregarContacto($nombre,$email,$tlf,$direccion);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <h1>Agregando contacto</h1>

    <fieldset>
    <legend>Agenda</legend>

        <form action= "<?php $_SERVER['PHP_SELF'] ?>" method="POST">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required >
            <br><br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="tlf">Teléfono</label>
            <input type="numeric" id="tlf" name="tlf" required >
            <br><br>
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" required >
                <br>
            <button type="submit">Enviar</button>
        </form>

    </fieldset>
    <form action="../index.php">
        <button type="submit"> Volver </button>
    </form>

</body>

</html>
