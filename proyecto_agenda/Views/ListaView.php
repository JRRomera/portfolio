<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<style>
    table,
    td,
    tr,
    th {
        border: solid 3px black;
        border-collapse: collapse;
        text-align: center;
    }
</style>

<body>

    <?php
    require_once __DIR__ . '/../Controllers/AgendaController.php';

    $AgendaControler = new AgendaController();

    $contactos = $AgendaControler->listaAgenda();


    ?>

    <h1>Listado de contactos</h1>

    <fieldset>
        <legend>Agenda</legend>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $contacto) { ?>
                    <tr>

                        <td> <?php echo $contacto[1] ?></td>
                        <td> <?php echo $contacto[2] ?></td>
                        <td> <?php echo $contacto[3] ?></td>
                        <td> <?php echo $contacto[4] ?></td>
                        <?php $id = $contacto[0]; ?>
                        <td>
                            <a href="./ModificarView.php?id=<?php echo $id ?>">Modificar</a>
                        </td>
                        <td>
                            <form action="./borrar.php" method="POST">
                                <input type="text" name="id" value="<?php echo $contacto[0]?>" hidden>
                                <button type="submit">Borrar</button>
                            </form>
                        </td>

                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
    </fieldset>
    <form action="../index.php">
        <button type="submit"> Volver </button>
    </form>




</body>

</html>