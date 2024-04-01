<?php

//Todo obligatorio menos el header
$to = "lr22003@esfe.agape.edu.sv";

/* Multiples correos
$to = ["lr22003@esfe.agape.edu.sv", "otrocorreo"]; */

/* El título del correo (ASUNTO)*/
$subject = "RESERVACIONES";

/* $message = "Hola, estoy probando el envío de correos"; */
$message = file_get_contents('./template.html');

$headers = "From: mirnarecinos382@gmail.com";
// Un nuevo valor a la variable
$headers .="MIME-Version: 1.0\r\n";// Protocolo para interpretar el html
$headers.= "Content-Type: text/html; charset=UTF-8\r\n";

/* Para enviar a multiples correos
foreach($to as $recipient){
    // Enviar muchos correos a la misma dirección metemos dentro del for.
    for($i=0; $i < 3; $i++){
    mail($recipient, $subject, $message, $headers);
    }
} */

mail($to, $subject, $message, $headers);
echo "Email enviado";

?>