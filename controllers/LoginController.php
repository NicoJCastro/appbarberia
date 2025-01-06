<?php 

namespace Controllers;

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

use MVC\Router;
use Model\Usuario;
use ClassesHelper\Email;


class LoginController {
   public static function login(Router $router) {

      $alertas = [];
      $auth = new Usuario;

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $auth = new Usuario($_POST);
        $alertas = $auth->validarLogin();

        if(empty($alertas)) {
            //Comprobar que exista el usuario
            $usuario = Usuario::where('email', $auth->email); // toma la columna que vamos a comparar y el valor que vamos a comparar
            
            if ($usuario) {
               // Verificar si el password es correcto
              if ( $usuario->verificarPassword($auth->password)) {
                  // Autenticar el usuario
                  session_start();
                  $_SESSION['id'] = $usuario->id;
                  $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                  $_SESSION['email'] = $usuario->email;
                  $_SESSION['login'] = true;

                  //Redireccionar segun sus roles
                  if ($usuario->admin === "1") {
                     $_SESSION['admin'] = $usuario->admin ?? null;
                     header('Location: /appbarberia/admin');
                  } else {
                     header('Location: /appbarberia/cita');
                  }                  
              };
            } else {
               Usuario::setAlerta('error', 'El usuario no encontrado');
            }
         }
      
      }

      $alertas = Usuario::getAlertas();

      $router->render('auth/login', [
         'alertas' => $alertas,
         'auth' => $auth
      ]);
   }

   public static function logout() {
      session_start();
      $_SESSION = [];
      
      header('Location: /appbarberia/login');
   }

   public static function forgotPassword(Router $router) {

      $alertas = [];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $auth = new Usuario($_POST);
         $alertas = $auth->validarEmail();

         if (empty($alertas)) {
            $usuario = Usuario::where('email', $auth->email);
           
            if ($usuario && $usuario->confirmado === "1" ){
               //Generar un token
               $usuario->crearToken();
               //Guardar en la base de datos
               $usuario->guardar();
               
               //Enviar el email
               $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
               $email->enviarInstrucciones();
               //Alerta
               Usuario::setAlerta('exito', 'Revisa tu email para cambiar tu password');

            } else {
               Usuario::setAlerta('error', 'Usuario no encontrado o no esta confirmado');
            }
         }
         
      }

      $alertas = Usuario::getAlertas();
      $router->render('auth/forgot-password', [
         'alertas' => $alertas
      ]);
   }

   public static function recoverPassword(Router $router) {

      $alertas = [];
      $error = false;

      $token = s($_GET['token']);
      //Buscar el usuario por el token
      $usuario = Usuario::where('token', $token);

      if (empty($usuario)) {
         Usuario::setAlerta('error', 'Token no válido');
         $error = true;
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $password = new Usuario($_POST);
          $alertas = $password->validarPassword();

          if (empty($alertas)) {
            $usuario->password = null;
            //Guardar en la base de datos
            $usuario->password = $password->password;
            //Hashear el password
            $usuario->hashPassword();
            $usuario->token = null;
            $resultado = $usuario->guardar();
            //Redireccionar
            if ($resultado) {
            header('Location: /appbarberia/login');
            }
          }
          
      }

      $alertas = Usuario::getAlertas();
      $router->render('auth/recover-password', [
         'alertas' => $alertas,
         'error' => $error
      ]);
     
   }

   public static function crear(Router $router) {

      $usuario = new Usuario;
      //Alertas array vacio
      $alertas = [];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         $usuario->sincronizar($_POST);
         $alertas = $usuario->validarNuevaCuenta();

         //Revisar que alertas esté vacío para registrar nuevo usuario
         if (empty($alertas)) {
            //Verificar si el usuario ya existe
            $resultado = $usuario->existeUsuario();
            if ($resultado->num_rows) {
               $alertas = Usuario::getAlertas();
            } else {
               //No esta registrado -- Crear usuario

               // Hashear password
              $usuario->hashPassword();

              //Generar un token
               $usuario->crearToken();

               // Enviar el email
               $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
              
               $email->enviarConfirmacion();

               // Guardar en la base de datos
               $resultado = $usuario->guardar();
               if ($resultado) {
                  header('Location: /appbarberia/mensaje');
               }
             
            }
         }
      }

      $router->render('auth/crear-cuenta', [
         'usuario' => $usuario,
         'alertas' => $alertas

      ]);
      
   }

   public static function mensaje(Router $router) {
      $router->render('auth/mensaje');
   }

   public static function confirmarCuenta(Router $router) {

      $alertas = [];
      $token = s($_GET['token']);
      $usuario = Usuario::where('token', $token);

      if (empty($usuario)) {
         // Mostrar mensaje de error
         Usuario::setAlerta('error', 'Token no válido');
      } else {
         // Modificar a usuario confirmado (en bd confirmado = 1)
         $usuario->confirmado = "1";
         $usuario->token = null;
         $usuario->guardar();
         Usuario::setAlerta('exito', 'Cuenta confirmada exitosamente');
      }

      // if ($usuario->confirmado = "1") {
      //    header('Location: /appbarberia/login');
      // }
     
      $alertas = Usuario::getAlertas();
      $router->render('auth/confirmar-cuenta', [
         'alertas' => $alertas
      ]);
   }

}

?>