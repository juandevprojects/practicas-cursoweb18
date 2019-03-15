<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 4 jdelg-pr1844-01</title>

    <!-- bootstrap 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<h1>Problema4</h1>
<h3>Hacer un programa que muestre en pantalla una tabla de 10 por 10 con los números del 1 al 100</h3>
<table class="table table-bordered text-center">
<tr>

<?php
    $con = 0;

    for ($x = 1; $x <= 100; $x++) {
        $con++;
        
        if ($con == 10) {
            echo "<td>$x</td>";
            echo "</tr>";
            echo "<tr>";
            $con = 0;
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