<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuario;

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
               

              debuguear($usuario);
            }
         }
      }

      $router->render('auth/crear-cuenta', [
         'usuario' => $usuario,
         'alertas' => $alertas,
         'resultado' => $resultado

      ]);
      
       }
}

?>