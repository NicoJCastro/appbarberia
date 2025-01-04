<?php 

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios); // Convierte el array en un JSON para que pueda ser leído por la API 
    }
}

?>