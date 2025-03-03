<?php 

include 'AgendaService.php';
/* 
SOAP (simple object acces protocol) Protocolo de comunicacion entre sistemas.
La comunicación es a través de ficheros XML y puede funcionar en HTTP, SMTP

Exponemos funciones para que puedan ser consumidas o invocadas por terceros 
mediante mensajes XML con una cierta estructura.

XML: para el intercambio de datos
SOAP Envelope: Estructura estandar de los mensajes XML
WSDL: son opcionales y con contratos que describen las operaciones, rutas, parámetros etc.

*/

$uri = '**';
$location = "**";
$options = [
    'uri'=> $uri,
    'exceptions'=> true, // captura de excepciones
    'trace'=>true, //Guarda detalles de las solicitudes y respuestas
];

$server = new SoapServer(null, $options);

$server->setClass('AgendaService');
/* 
Inicia el proceso de escuchar del servidor para que se puedan atender las peticiones.
Llama al método o función correspodiente y devuelve respuestas en formato XML siguiente el protocolo SOAP.
*/

$server->handle();


















?>
