<?php
//Encapsula la lógica de enrutamiento
class router{
    //Almacenaran el nombre del controlador y el método que se ejecutarán en función de la URL solicitada.
    private $controller;
    private $method;
      //Se llama automáticamente cuando se crea una instancia de la clase router para llamar a un metodo
      public function __construct(){
        $this->matchRoute();
      }
      //Analiza la URL para extraer el nombre del controlador y el método a partir de la URL solicitada
      public function matchRoute(){
          //Divide la URL en partes utilizando '/' como separador
          $url = explode("/", URL);
          //El primer segmento después del dominio generalmente representa el controlador
          $this->controller = $url[1];
          //Divide el segundo segmento en caso de que contenga parámetros de consulta (por ejemplo, ?parametro=valor)
          $metodo = explode("?", $url[2]);
          //Verifica si no hay parámetros de consulta en la URL
          if ($url[2] == "") {
              // Si no hay parámetros de consulta, usa "dashboard" como el método por defecto
              $this->method = "dashboard";
          } else {
              //Si hay parámetros de consulta, utiliza el primer segmento como el nombre del método
              $this->method = $metodo[0];
          }
          //Forma el nombre completo del controlador añadiendo "Controller" al final
          $this->controller = $this->controller . "Controller";
           // Verifica si el archivo del controlador existe
        if (file_exists("Controllers/" . $this->controller . ".php")) {
            //Si existe, incluye el archivo del controlador correspondiente
            require_once "Controllers/" . $this->controller . ".php";
        } else {
            // Si el controlador no existe, muestra una página de error 404
            $this->show404Error();
        }
      }
      //Crea una instancia del controlador determinado y ejecuta el método correspondiente basado en la información del método matchRoute
      public function run(){
        //Crea una instancia del controlador correspondiente
        $controller = new $this->controller();
        // Verifica si el método existe en el controlador
        if (method_exists($controller, $this->method)) {
            //Obtiene el nombre del método a ejecutar desde la propiedad $this->method y lo guarda en una variable
            $method = $this->method;
            //Llama al método del controlador con el nombre obtenido
            $controller->$method();
        } else {
            // Si el método no existe, muestra una página de error 404
            $this->show404Error();
        }
    }

    private function show404Error() {
        // Muestra un mensaje de error 404 en caso de no existir la ruta seleccionada
        echo "Error 404 - Página no encontrada";
        exit;
    }
    
}

/*Se encarga de manejar el enrutamiento de solicitudes y controlar cuál controlador y método (acción) 
deben ejecutarse en función de la URL solicitada */
?>