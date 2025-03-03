<?php


require_once __DIR__ . '/../Models/AgendaModel.php';


class AgendaController
{

    private $agendaModel;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel;
    }

    public function listaAgenda()
    {

        return $this->agendaModel->getAllUsers();
    }

    public function agregarContacto($nombre, $email, $tlf, $direccion)
    {

        return $this->agendaModel->createUser($nombre, $email, $tlf, $direccion);
        
    }

    public function borrarUsuario($id)
    {

        try {
            $this->agendaModel->deleteUser($id);
        } catch (Exception $ex) {
            echo $ex->getMessage() . "Error al borrar usuario <br>";
        }
    }


    public function obtenerDatosUsuario($id)
    {

        $datos_usuario = $this->agendaModel->getUser($id);
        $nombre = $datos_usuario['nombre'];
        $email = $datos_usuario['email'];
        $tlf = $datos_usuario['tlf'];
        $direccion = $datos_usuario['direccion'];

        return [$nombre, $email, $tlf, $direccion];
    }

    public function modificarDatosUsuario($nombre, $email, $tlf, $direccion, $userID)
    {

        return $this->agendaModel->updateUser($nombre, $email, $tlf, $direccion, $userID);
    }
}
