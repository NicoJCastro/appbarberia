<?php 

namespace Model;

use PHPMailer\PHPMailer\PHPMailer;

//Objeto Usuario

class Usuario extends ActiveRecord {
    // Base de datos de Usuarios 

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre','apellido', 'email',  'password','telefono','admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    //Constructor

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de un nueva cuenta

    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = "Debes añadir un nombre";
        }

        if(!$this->apellido){
            self::$alertas['error'][] = "Debes añadir un apellido";
        }

        if(!$this->telefono){
            self::$alertas['error'][] = "Debes añadir un telefono";
        }

        if(!$this->email){
            self::$alertas['error'][] = "Debes añadir un email";
        }

        if(!$this->password){
            self::$alertas['error'][] = "Debes añadir un password";
        }

        if (strlen($this->password) < 6){
            self::$alertas['error'][] = "El password debe ser de al menos 6 caracteres";
        }
       

        return self::$alertas;
    }

    // Validamos el email

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = "Debes añadir un email";
        }

        return self::$alertas;
    }

    // Validar Password
    public function validarPassword() {
        if(!$this->password){
            self::$alertas['error'][] = "Debes añadir un password";
        }

        if (strlen($this->password) < 6){
            self::$alertas['error'][] = "El password debe ser de al menos 6 caracteres";
        }

        return self::$alertas;
    }

    // Verifica si un usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$alertas['error'][] = "El usuario ya existe";
            return;
        }

        return $resultado;
    }

    // Hashear password
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un token
    public function crearToken() {
        $this->token = bin2hex(random_bytes(8)); // Genera exactamente 16 caracteres
    }

    // Comprobar password

    public function verificarPassword($password){
       $resultado = password_verify($password, $this->password);
       if(!$resultado || !$this->confirmado){
           self::$alertas['error'][] = "El password es incorrecto o tu cuenta no ha sido confirmada";
       } else {
         return true;
       }
       return $resultado;
    }

    // Validar el login
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = "Debes añadir un email";
        }

        if(!$this->password){
            self::$alertas['error'][] = "Debes añadir un password";
        }

        return self::$alertas;
    }    

}

?>