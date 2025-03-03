<?php 

class ConexionPDOModel{
    
    private static $server = "**";
    private static $username = "**";
    private static $pass = "**";
    private static $db = "**";
    private static $conexion;

    static public function connect() {
        if (self::$conexion === null){
            try{
                $server = self::$server;
                $db = self::$db;
                $username = self::$username;
                $pass = self::$pass;

                self::$conexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$username,$pass); 
                return self::$conexion;
            }catch(Exception $ex) {
                echo $ex->getMessage();
                echo "Error al conectar en a la base de datos.";
            }
        } 
    }


}

?>
