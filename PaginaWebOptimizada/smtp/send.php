<?php
$mailm= $_POST['mailm'];
$idpa= $_POST['idpa'];
include_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

$phpMailer = new PHPMailer;
# Puede ser ruta relativa o absoluta
$nombreDelDocumento="../reportes/".$idpa.".pdf";

if (!file_exists($nombreDelDocumento)) {
    exit("El archivo $nombreDelDocumento no existe");
}


try {
    $phpMailer->setFrom("contabilidad@lasvinas.mx"); # Correo y nombre del remitente
    $phpMailer->addAddress($mailm); # El destinatario
    $phpMailer->CharSet = 'UTF-8';
    $phpMailer->Encoding = 'base64';
    $phpMailer->Subject = "Recibo de pago Las Viñas"; # Asunto
    $phpMailer->Body = "A continuación, se adjunta el recibo de pago:";
    // Aquí la magia:
    $phpMailer->addAttachment($nombreDelDocumento);
    if (!$phpMailer->send()) {
        echo "Error enviando correo: " . $phpMailer->ErrorInfo;
    }
    # Opcionalmente podrías eliminar el archivo después de enviarlo, si quieres
    // if (file_exists($nombreDelDocumento)) {
    // unlink($nombreDelDocumento);
    // }
    echo "Enviado correctamente";
} catch (Exception $e) {
    echo "Excepción: " . $e->getMessage();
}
