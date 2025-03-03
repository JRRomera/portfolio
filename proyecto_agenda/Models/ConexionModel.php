<?php 

class ConexionModel{
    
    private static $server = "db5017237178.hosting-data.io";
    private static $username = "dbu2601731";
    private static $pass = "Juanito2345*";
    private static $db = "dbs13838421";
    private static $conexion;

    static public function connect() {
        if (self::$conexion === null){
            try{
                self::$conexion = mysqli_connect(self::$server,self::$username,self::$pass,self::$db); 
                return self::$conexion;
            }catch(Exception $ex) {
                echo $ex->getMessage();
                echo "Error al conectar en a la base de datos.";
            }
        } 
    }


}











?>