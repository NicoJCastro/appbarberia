<?php 

namespace Controllers;

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

use MVC\Router;
use Model\Usuario;
use ClassesHelper\Email;


class LoginController {
   public static function login(Router $router) {
      $router->render('auth/login');
   }

   public static function logout() {
      echo 'Cerrar sesión';
   }

   public static function forgotPassword(Router $router) {
      $router->render('auth/forgot-password', [
         
      ]);
   }

   public static function recoverPassword() {
      echo 'Recuperar password';
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
      debuguear($usuario);

      $router->render('auth/confirmar-cuenta', [
         'alertas' => $alertas
      ]);
   }

}

?>