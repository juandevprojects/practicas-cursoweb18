<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 9 jdelg-pr1844-01</title>

    <!-- bootstrap 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<h1>Problema9</h1>
<h3>Realiza un programa que almacene en un vector los 10 primeros números pares. Imprímalos cada uno en una línea (recuerde que el salto de línea en HTML es < BR >).</h3>

<p>

<?php
$con= 0;
$numero = 0;
$vector = array();

while ( $con < 10 ) {
    $numero++;

    if ( ( $numero % 2 ) == 0) {              
        $vector[$con] = $numero;
        echo $vector[$con] . "<br>";
        $con++;
    }
}

?>
</p>




<!-- ********* scripts de bootstrap 4 ****** -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    
</body>
</html>