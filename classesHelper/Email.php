<?php 

namespace ClassesHelper;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    //Constructor

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }


    // Enviar email de confirmación
    public function enviarConfirmacion(){
        // Crear un objeto de la clase Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'tls'; // o 'ssl'
    
        $mail->setFrom('test@appsalon.com'); // Deberia ir el mail de la empresa DOMINIO o cuenta de correo
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com'); // Corregir la dirección de correo
        $mail->Subject = 'Confirma tu cuenta';
    
        //Set the email format to HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
    
        $contenido = "<html>";
        $contenido .= "<p><strong>Por favor " . $this->nombre . ", confirma tu cuenta haciendo click en el siguiente enlace:</strong></p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/appbarberia/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste la creación de una cuenta, ignora este mensaje.</p>";
        $contenido .= "</html>";
    
        $mail->Body = $contenido;
    
        // Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones() {

         // Crear un objeto de la clase Email
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
         $mail->SMTPSecure = 'tls'; // o 'ssl'
     
         $mail->setFrom('test@appsalon.com'); // Deberia ir el mail de la empresa DOMINIO o cuenta de correo
         $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com'); // Corregir la dirección de correo
         $mail->Subject = 'Reestablece tu Password';
     
         //Set the email format to HTML
         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8';
     
         $contenido = "<html>";
         $contenido .= "<p><strong>Por favor " . $this->nombre . ", Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo:</strong></p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/appbarberia/recover-password?token=" . $this->token . "'>Reestablecer Password</a></p>";
         $contenido .= "<p>Si no solicitaste este cambio, ignora este mensaje.</p>";
         $contenido .= "</html>";
     
         $mail->Body = $contenido;
     
         // Enviar el email
         $mail->send();
    }
  

}
  

?>