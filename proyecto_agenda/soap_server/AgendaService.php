<?php

class AgendaService
{

    private $conexion;

    public function __construct()
    {
        $server = 'db5017237178.hosting-data.io';
        $username = 'dbu2601731';
        $pass = 'Juanito2345*';
        $db = 'dbs13838421';

        try {
            $this->conexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $username, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            throw new Exception('Error al conectar con la base de datos' . $ex->getMessage());
        }
    }


    public function createUser($nombre, $email, $tlf, $direccion)
    {
        $errores = [0];   // ---> Este array de errores funciona como el returncode de bash. Cada número significa un error a documentar. 
        $nombre = trim($nombre);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $tlf = filter_var($tlf, FILTER_SANITIZE_NUMBER_INT);
        $direccion = trim($direccion);
        try {
            if (empty($nombre) || empty($email) || empty($tlf) || empty($direccion)) {
                $errores[] = 1;
            };
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = 2;
            }
            if (strlen($direccion) > 30) {
                $errores[] = 3;
            }
            if (count($errores) > 1) {
                throw new Exception();
            }

            $this->conexion->beginTransaction();
                $consulta = 'INSERT INTO contactos (nombre,email,tlf,direccion) VALUES (?,?,?,?)';
                $stmt = $this->conexion->prepare($consulta);
                $stmt->execute([$nombre, $email, $tlf, $direccion]);
            $this->conexion->commit();
            return true;
        } catch (PDOException | Exception $ex) {
            $this->conexion->rollBack();
            return $errores;
        }
    }

    public function updateUser($nombre, $email, $tlf, $direccion, $userID)
    {
        $errores = [0];

        try {
            if (empty($nombre) || empty($email) || empty($tlf) || empty($direccion)) {
                $errores[] = 1;
                // REFACTORIZAR ESTA PARTE DEL CÓDIGO EN UNA FUNCIÓN PARA NO REPETIR (DRY) 
            };
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = 2;
            }
            if (strlen($direccion) > 30) {
                $errores[] = 3;
            }
            if (empty($userID) || !is_numeric($userID)) {
                $errores[] = 4;
            }
            if (count($errores) > 1) {
                throw new Exception();
            }
            
            $this->conexion->beginTransaction();
                $consulta = 'UPDATE contactos SET nombre = ?, email = ?, tlf = ?, direccion = ? where id_contacto = ? ';
                $stmt = $this->conexion->prepare($consulta);
                $stmt->execute([$nombre, $email, $tlf, $direccion, $userID]);
            $this->conexion->commit();
            return true;
        } catch (Exception | PDOException $ex) {
            $this->conexion->rollBack();
            return $errores;
        }
    }

    public function deleteUser($userID)
    {
        $errores = [0];
        try {
            if (empty($userID) || !is_numeric($userID) || $userID > 3500) {    // me invento que no puede haber más de 3500 IDs en la BBDD.
                $errores[] = 5;
                throw new Exception ("El parametro ID está vacío");
            };

            $this->conexion->beginTransaction();
                $consulta = 'DELETE FROM contactos WHERE id_contacto = ?';
                $stmt =  $this->conexion->prepare($consulta);
                $stmt->execute([$userID]);
            $this->conexion->commit();
            return true;
        } catch(PDOException | Exception $ex) {
            $this->conexion->rollBack();
            return $errores;
        }
    }

    public function getAllUsers()
    {
        $errores = [0];
        try {
            $this->conexion->beginTransaction();
                $consulta = 'SELECT * FROM contactos';
                $stmt =  $this->conexion->prepare($consulta);
                $stmt->execute();
            $this->conexion->commit();
            return $stmt->fetchAll();
        } catch (PDOException | Exception $ex) {
            $this->conexion->rollBack();
            return $errores;
        }
    }
    public function getUser($userID)
    {
        $errores = [0];
        try {
            if (empty($userID) || !is_numeric($userID) || $userID > 3500) {    // me invento que no puede haber más de 3500 IDs en la BBDD.
                $errores[] = 5;
                throw new Exception ("El parametro ID está vacío");
            };
            $this->conexion->beginTransaction();
                $consulta = 'SELECT nombre,email,tlf,direccion FROM contactos WHERE id_contacto = ?';
                $stmt =  $this->conexion->prepare($consulta);
                $stmt->execute([$userID]);
            $this->conexion->commit();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException | Exception $ex) {
            $this->conexion->rollBack();
            return $errores;
        }
    }
}
