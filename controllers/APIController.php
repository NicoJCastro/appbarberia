<?php 

namespace Controllers;

use Model\Cita;
use Model\CitasServicio;
use Model\Servicio;
use MVC\Router;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardarCitas() {
        // Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        
        $id = $resultado['id'];
        $usuarios_id = $_POST['usuarios_id'];

        // Almacena los Servicios con la Cita
        // Convertimos el string de servicios a array si no lo está ya
        $idServicios = is_array($_POST['servicios']) ? $_POST['servicios'] : explode(",", $_POST['servicios']);
        
        foreach($idServicios as $idServicio) {
            $args = [
                'citas_id' => $id,
                'citas_usuarios_id' => $usuarios_id,
                'servicios_id' => $idServicio
            ];
            
            $citaServicio = new CitasServicio($args);
            $citaServicio->guardar();
        }

        // Retornamos una respuesta
        echo json_encode([
            'resultado' => $resultado
        ]);
    }

    public static function eliminar(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $cita = Cita::find($id);
        $cita->eliminar();
        header('Location:' .$_SERVER['HTTP_REFERER']);
      }
    }
}

?>