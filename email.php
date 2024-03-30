<?php

//Todo obligatorio menos el header
$to = "lr22003@esfe.agape.edu.sv";
/* El título del correo (ASUNTO)*/
$subject = "Este es un mail de prueba";
$message = "Hola, estoy probando el envío de correos";
$headers = "From: mirnarecinos382@gmail.com";

mail($to, $subject, $message, $headers);
echo "Email enviado";

?>