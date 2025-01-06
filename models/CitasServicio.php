<?php 

namespace Model;

class CitasServicio extends ActiveRecord {

    public static $tabla = "citas_servicios";
    public static $columnasDB = ["id", "citas_id", "citas_usuarios_id", "servicios_id"];

    public $id;
    public $citas_id;
    public $citas_usuarios_id;
    public $servicios_id;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->citas_id = $args['citas_id'] ?? '';
        $this->citas_usuarios_id = $args['citas_usuarios_id'] ?? '';
        $this->servicios_id = $args['servicios_id'] ?? '';
    }

}

?>