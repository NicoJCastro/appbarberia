<?php 

namespace Controllers;

use MVC\Router;

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
      $router->render('auth/crear-cuenta', [
         
      ]);
      
   }
}

?>