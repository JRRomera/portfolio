<?php

require_once __DIR__ . "/../Controllers/AgendaController.php";

$controller = New AgendaController();
$id = $_GET['id'];
$datos_contacto = $controller->obtenerDatosUsuario($id);
$exito = false;

if($_POST){
    if($controller->modificarDatosUsuario($_POST['nombre'],$_POST['email'], $_POST['tlf'], $_POST['direccion'], $id)){
        $exito = true;
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>


<fieldset>
<legend>Modificar contacto</legend>

    <form action= "<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required placeholder="<?php echo $datos_contacto[0]?>">
        <br><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="<?php echo $datos_contacto[1]?>">
        <br><br>
        <label for="tlf">Teléfono</label>
        <input type="numeric" id="tlf" name="tlf" required placeholder="<?php echo $datos_contacto[2]?>">
        <br><br>
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" required placeholder="<?php echo $datos_contacto[3]?>">
        <br>
        <button type="submit">Enviar</button>
        <?php if($exito){  echo "Contacto modificado con éxito."; }?>
    </form>

</fieldset>
<form action="../index.php">
    <button type="submit"> Volver </button>
</form>


</body>

</html>
