<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Problema 10 jdelg-pr1844-01</title>

    <!-- bootstrap 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<h1>Problema10</h1>
<h3>Realiza un programa que Imprima los valores del vector asociativo siguiente usando la estructura de control foreach: $v[1]=90; $v[30]=7; $v['e']=99; $v['hola']=43;
</h3>

<p>

    <?php

        // Utilizando el formato del enunciado

        $v[1]=90; $v[30]=7; $v['e']=99; $v['hola']=43;
        foreach ($v as $key => $value) {
            echo "<br> El campo  $key es $value " ;
        }


        // Construyendo el arreglo de otra manera
        $v = array(1 => 90, 30 => 7, "e" => 99, "hola" => 43); // También se puede declarar el  array así
        echo "<br> <br>Otra forma de Construir el arreglo anterior es: ";
        print_r ($v); // Para imprimir el arreglo tal cual como se construye
        foreach ($v as $key => $value) {
            echo "<br> El campo  $key es $value " ;
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