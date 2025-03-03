<?php 

class ConexionModel{
    
    private static $server = "**";
    private static $username = "**";
    private static $pass = "**";
    private static $db = "**";
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
