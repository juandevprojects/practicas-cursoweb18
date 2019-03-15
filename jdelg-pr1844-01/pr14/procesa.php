<?php  
    // var_dump($_POST);
    if ( in_array("",$_POST) ) {
        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas y a Dolares</a></h1>";
        echo "<h2>Algún valor no es válido o no ha sido escrito</h2>";
    } else {
        $promedio = array_sum($_POST) / count($_POST);
        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas y a Dolares</a></h1>";
        echo "<h2>El prómedio de los 10 números es: $promedio </h2>";        
    }   
?>