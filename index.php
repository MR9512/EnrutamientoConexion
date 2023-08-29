<?php
//Incluye el archivo de configuración 
require_once "config/config.php";
// Incluye el archivo que contiene la lógica del enrutador
require_once "router/router.php";
//Crea una instancia de la clase router para manejar las rutas y controladores
$router = new router();
//Inicia el proceso de enrutamiento y ejecuta el controlador y la acción en función de la URL solicitada
$router->run();    
?>
