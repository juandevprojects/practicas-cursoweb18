<?php
$destinatario = "juanalbertodelgado@gmail.com, amulatero@yahoo.es";

$asunto = "Confirmación de incidencia desde PHP";

$mensaje = "Esta es una confirmación de la incidencia hecha en el problema 5 enviada desde PHP";
mail($destinatario, $asunto, $mensaje);

echo "correo enviado";

?>