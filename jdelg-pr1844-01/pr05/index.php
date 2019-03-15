<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 5 jdelg-pr1844-01</title>

    <!-- bootstrap 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<h1>Problema5</h1>
<h3>Hacer un programa que muestre en pantalla una tabla de x por x (dónde x es un número almacenado en una variable) con los números del 1 al xporx. En la tabla de colorearán las filas alternando gris y blanco</h3>


<table class="table table-bordered">
<tr class="table-dark text-dark">   <!-- Inicializo el color de la primera fila -->

<?php
$dimension = 11;  // Esto es el número de columnas que deseo que tenga la tabla
$con = 0;         // Este contador va a indicar el final de cada fila de la tabla
$switcheo = TRUE; // Con esta variable alterno el color de las filas entre gris y blanco
$total = $dimension * $dimension; // Este es el número total de elementos que contendrá la tabla

for ($x=1 ; $x <= $total ; $x++) { // x va a ser cada número que contendrá la fila
    $con++; // incremento el número de columna de cada fila en la tabla
    
    if ($con == $dimension) { // Chequeo que ya llego al final de la fila 

        if ($switcheo) { // si ya llegó al final de la fila entonces cambio el color de la fila
            echo "<td>$x</td>"; // Imprimo el último elemento de la fila
            echo "</tr>";      // finalizo la fila actual 
            echo "<tr class='table-light'>"; // establezco el color de la próxima fila
            $con = 0;    // inicializo el número de columna para la próxima fila
            $switcheo = FALSE; // Cambio la condición para el próximo valor de la fila
        } else {
            echo "<td>$x</td>";
            echo "</tr>";
            echo "<tr class='table-dark text-dark'>";
            $con = 0;
            $switcheo = TRUE;
        }

    } else { 
        echo "<td>$x</td>"; 
    }
}
?>



</table>




<!-- ********* scripts de bootstrap 4 ****** -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    
</body>
</html>