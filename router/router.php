<?php
class Router {
    //Almacenaran el nombre del controlador y el método que se ejecutarán en función de la URL solicitada
    private $controller;
    private $method;
     //Se llama automáticamente cuando se crea una instancia de la clase router para llamar a un metodo
    public function __construct() {
        //Llamamos automáticamente a la función matchRoute()
        $this->matchRoute();
    }
    public function matchRoute() {
        //Dividimos la URL en fragmentos usando la constante URL (asumiendo que está definida)
        $url = explode("/", URL);
        //El segundo fragmento de la URL se usa como el nombre del controlador
        $this->controller = $url[1];
        //Dividimos el tercer fragmento de la URL para eliminar cualquier cadena de consulta
        $metodo = explode("?", $url[2]);
        //El primer fragmento del resultado es el nombre del método
        $this->method = $metodo[0];
        //Agregamos "Controller" al nombre del controlador
        $this->controller = $this->controller . "Controller";
        //Requerimos el archivo del controlador desde la carpeta "Controllers/"
        require_once("Controllers/" . $this->controller . ".php");
    }
     //Crea una instancia del controlador determinado y ejecuta el método correspondiente basado en la información del método matchRoute
    public function run() {
        //Creamos una instancia del controlador utilizando el nombre almacenado en $this->controller
        $controller = new $this->controller();
        //Llamamos al método del controlador especificado en $this->method
        $metodo = $this->method;
        $controller->$metodo();
    }
}
?>
