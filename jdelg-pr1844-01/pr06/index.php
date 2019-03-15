<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 6 jdelg-pr1844-01</title>

    <!-- bootstrap 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<h1>Problema6</h1>
<h3>Realizar un programa que genere una tabla de 4 por 4 que muestre las primeras 4 potencias de los números del uno 1 al 4 (hacer una función que las calcule invocando la función pow). En PHP las funciones hay que definirlas antes de invocarlas. Los parámetros se indican con su nombre ($cantidad) si son por valor y antecedidos de & (&$cantidad) si son por referencia</h3>


<table class="table table-bordered text-center">
<tr class="table-dark text-dark">

<?php  // strict requirement

function powermio(&$x, &$y)  {
    return pow($x , $y);
}

$dimension = 4;
$con = 0;
$switcheo = 0;
$total = $dimension * $dimension;

for ($x=1 ; $x <= $dimension ; $x++){

    for ($y=1 ; $y<=$dimension; $y++) {
        $con++;

        if ($con == $dimension) {

            if ($switcheo == 0) {
                echo "<td>".powermio($x,$y)."</td>";
                echo "</tr>";
                echo "<tr class='table-light'>";
                $con = 0;
                $switcheo = 1;
            } else {
                echo "<td>".powermio($x,$y)."</td>";
                echo "</tr>";
                echo "<tr class='table-dark text-dark'>";
                $con = 0;
                $switcheo = 0;
            }

        } else {
            echo "<td>".powermio($x,$y)."</td>";
        }
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