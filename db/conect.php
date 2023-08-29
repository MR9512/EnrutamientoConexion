<?php

//encapsula la funcionalidad relacionada con la conexión a la base de datos
class Conect {
   //Establece la conexión a la base de datos MySQL
   public function Conexion() {
      //Utilizamos un bloque try-catch para capturar excepciones.
       try {
            //Se piden 4 parametros para establecer la conexión a la BD solicitada
           $con = mysqli_connect("localhost", "root", "", "crud");
             //Si la conexión falla, muestra una excepcion de error
           if (!$con) {
               throw new Exception("Error de conexión a la base de datos.");
           }
            //Si la conexión es exitosa, devuelve el objeto de conexión
           return $con;
       } catch (Exception $e) {
           // Captura la excepción y maneja el error aquí
           throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
       }
   }
}


?>