<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="../styles/style.css">
    
</head>
<body>

<h1>Agenda de contactos</h1>

<fieldset>
<legend>Agenda</legend>

    <form action= "./Views/ListaView.php" >
        <button type="submit">Listar Contactos.</button>
    </form>
    <br>
    <form action="./Views/AgregarView.php" >
        <button type="submit">Agregar nuevo usuario.</button>
    </form>
</fieldset>


</body>
</html>