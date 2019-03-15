<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 7 jdelg-pr1844-01</title>

    <!-- bootstrap 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<h1>Problema7</h1>
<h3>Realiza un programa que calcule la suma de los 100 primeros números impares y nos la muestre por pantalla</h3>

<?php
$con= 0;  // comprobar que contó 100 veces
$numero = 0;
$suma = 0;

while ( $con < 100 ) {
    $numero++;

    if ( ( $numero % 2 ) != 0) {              
        $con++;
        $suma = $suma + $numero;
    }
}


echo "<h4>Desde el número 0 hasta el número $numero </h4>";
echo "<h4>La suma de los primeros 100 números impares es: $suma </h4>";

?>



<!-- ********* scripts de bootstrap 4 ****** -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    
</body>
</html>