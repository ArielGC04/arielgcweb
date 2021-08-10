<?php
$name = $_POST["nombre"];
$email = $_POST["correo"];
$asunto = $_POST["asunto"];
$message = $_POST["mensaje"];

$body = "Nombre : " . $name . "<br>Email: " . $email . "<br>Asunto: " . $asunto . "<br>Mensaje: " . $message;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'formulariorespuesta@gmail.com';                     //SMTP username
    $mail->Password   = 'contraseñadecorreo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($email, $name);  //desde donde se envia
    $mail->addAddress('info@arielgc.site');     //A quien se le va a enviar


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject =$asunto;
    $mail->Body = $body;
    $mail -> Charset = 'UTF-8';

    // if( $mail->send() ){
    //     echo "Mensaje enviado";
    // }else{
    //     echo"hubo un error: {$mail->ErrorInfo}";
    // }
    // $mail->smtpClose();
    $mail->send();
    echo "<script>alert('Mensaje Enviado')
    window.location.assign('index.html')
    </script>";
 } catch (Exception $e) {
     echo "hubo un error: {$mail->ErrorInfo}";
 }
