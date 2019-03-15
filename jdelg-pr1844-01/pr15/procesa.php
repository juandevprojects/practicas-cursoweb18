<?php    
    // var_dump($_POST);
    $operacion = $_POST["foperacion"];
    $valor1 = $_POST["fval1"];
    $valor2 = $_POST["fval2"];

    if ( in_array("",$_POST) ) {
        echo "<h1><a href=\"index.html\">Calculadora</a></h1>";
        echo "<h2>Algún valor no es válido o no ha sido escrito</h2>";
    } elseif ( $operacion === "SUMA" ) {
        echo "<h1><a href=\"index.html\">Calculadora</a></h1>";
        echo "<h2>La suma de $valor1 y $valor2 es: ". ($valor1+$valor2). "</h2>";
        
    } elseif ( $operacion === "RESTA" ) {
        echo "<h1><a href=\"index.html\">Calculadora</a></h1>";
        echo "<h2>La RESTA de $valor1 y $valor2 es: ". ($valor1-$valor2). "</h2>";
        
    } elseif ( $operacion === "MULTIPLICACIÓN" ) {
        echo "<h1><a href=\"index.html\">Calculadora</a></h1>";
        echo "<h2>La MULTIPLICACIÓN de $valor1 y $valor2 es: ". ($valor1*$valor2). "</h2>";
        
    } elseif ( $operacion === "DIVISIÓN" ) {
        echo "<h1><a href=\"index.html\">Calculadora</a></h1>";

        if ($valor2==0) {
        echo "<h2>El denominador debe ser distinto de cero</h2>";

        } else {
            echo "<h2>La DIVISIÓN de $valor1 y $valor2 es: ". ($valor1/$valor2). "</h2>";

        }
        
    } 


    
?>