<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 1 jdelg-pr1844-01</title>
</head>

<body>
<h1>Problema1</h1>
<p>Crea un programa en PHP que contenga 4 variables. A la primera y a la segunda se les van a asignar una cadena de texto cualquiera, a la tercera un valor numérico cualquiera y a la cuarta un valor booleano. Se tiene que concatenar las dos primeras e imprimir el resultado</p>

<?php
$variable1 = "cualquier cadena de texto";
$variable2 = "otra cadena de texto más";
$variable3 = 5637;
$variable4 = true;

echo '<p>La concatenación de $variable1 con $variable2 es:</p>';
echo "<p>{$variable1}{$variable2}</p>";

// otra forma de hacerlo
// echo $variable1.$variable2;


?>
    
</body>
</html>