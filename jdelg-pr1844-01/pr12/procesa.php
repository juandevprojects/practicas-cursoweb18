<?php
     $monto_euros = (float) $_POST["fpesetas"];
    $monto_euros = round($monto_euros,2);

    if ( $monto_euros === "" ) {
        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas</a></h1>";
        echo "<h2>Introduce un monto a convertir</h2>";


    } else {
        $monto_pesetas = $monto_euros * 166.39;
        $monto_pesetas = round($monto_pesetas, 2);

        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas</a></h1>";
        echo "<h2>{$monto_euros} Euros son {$monto_pesetas} pesetas</h2>";

    }
    

?>