<?php 

require_once __DIR__  . "/../Controllers/AgendaController.php";

$AgendaControler = new AgendaController();


$id = $_POST['id'];


$AgendaControler->borrarUsuario($id);


echo "<script>
    alert('Contacto borrado con éxito');
    window.location.href = 'https://agenda.jromera.es/Views/ListaView.php';
</script>";

exit;


?>