
<?php 
class ApiSoapService{

    private static $conexionAPI = null;
    static public function connect() {
        $options = [
            'location' => 'https://jromera.es/AgendaAPI/server.php',
            'uri' => 'https://jromera.es/AgendaAPI/'
        ];
        if (self::$conexionAPI === null){
            try{ 
                self::$conexionAPI = new SoapClient(null, $options);
                return self::$conexionAPI;
            }catch(Exception $ex) {
                echo $ex->getMessage();
                echo "Error al conectar con la API";
                return false;
            }
        } 
    }


}


?>