<?php 

require_once  __DIR__ . '/ConexionModel.php';
require_once  __DIR__ . '/ConexionPDOModel.php';
require_once  __DIR__ . '/ApiSoapService.php';

class AgendaModel {
    
    private $conexionAPI;
    private $conexionPDO;

    public function __construct() {
        $this->conexionAPI = ApiSoapService::connect();
        $this->conexionPDO = ConexionPDOModel::connect();
    }

    public function createUser($nombre,$email,$tlf,$direccion){

        try{
            return $this->conexionAPI->createUser($nombre,$email,$tlf,$direccion);
        }catch(Exception $ex){
            // echo $ex->getMessage();
            try{
                $this->conexionPDO->beginTransaction();
                $consulta = 'INSERT INTO contactos (nombre,email,tlf,direccion) VALUES (?,?,?,?)';
                $stmt = $this->conexionPDO->prepare($consulta);
                $stmt->execute([$nombre, $email, $tlf, $direccion]);
                $this->conexionPDO->commit();
                return true;
            }catch(PDOException | Exception $ex){
                $this->conexionPDO->rollBack();
                echo "Error al ejecutar la consulta " . $ex->getMessage();
            }
        }

    }

    public function updateUser($nombre,$email,$tlf,$direccion,$userID){

        try{
            return $this->conexionAPI->updateUser($nombre,$email,$tlf,$direccion,$userID);
        }catch(Exception $ex){
            // echo $ex->getMessage();
           try{
            $this->conexionPDO->beginTransaction();
            $consulta = 'UPDATE contactos SET nombre = ?, email = ?, tlf = ?, direccion = ? where id_contacto = ? ';
            $stmt = $this->conexionPDO->prepare($consulta);
            $stmt->execute([$nombre, $email, $tlf, $direccion, $userID]);
        $this->conexionPDO->commit();
           }catch(PDOException | Exception $ex){
            $this->conexionPDO->rollBack();
            echo "Error al ejecutar la consulta " . $ex->getMessage();
           }
  
        }
    }

    public function deleteUser($userID){

        try{
            return $this->conexionAPI->deleteUser($userID);
        }catch(Exception $ex){
            // echo $ex->getMessage();
            try{
            $this->conexionPDO->beginTransaction();
                $consulta = 'DELETE FROM contactos WHERE id_contacto = ?';
                $stmt =  $this->conexionPDO->prepare($consulta);
                $stmt->execute([$userID]);
            $this->conexionPDO->commit();
            }catch(PDOException | Exception $ex){
                $this->conexionPDO->rollBack();
                echo "Error al ejecutar la consulta " . $ex->getMessage();
            }
        }


    }

    public function getAllUsers(){
        
        try{
            return $this->conexionAPI->getAllUsers();
        }catch(Exception $ex){
            echo "Error en el acceso a API " . "(" . $ex->getMessage() . ") ";
          	echo " Usando conexión PDO...";
            try{
            $this->conexionPDO->beginTransaction();
                $consulta = 'SELECT * FROM contactos';
                $stmt =  $this->conexionPDO->prepare($consulta);
                $stmt->execute();
            $this->conexionPDO->commit();
            return $stmt->fetchAll();
            }catch(PDOException | Exception $ex){
                $this->conexionPDO->rollBack();
                echo "Error al ejecutar la consulta " . $ex->getMessage();  
            }
        }

    }
    public function getUser($userID){

        try{
            return $this->conexionAPI->getUser($userID);
        }catch(Exception $ex){
            // echo $ex->getMessage();
            $this->conexionPDO->beginTransaction();
                $consulta = 'SELECT nombre,email,tlf,direccion FROM contactos WHERE id_contacto = ?';
                $stmt =  $this->conexionPDO->prepare($consulta);
                $stmt->execute([$userID]);
            $this->conexionPDO->commit();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException | Exception $ex){
            $this->conexionPDO->rollBack();
            echo "Error al ejecutar la consulta " . $ex->getMessage();  
        }

    }

}














?>