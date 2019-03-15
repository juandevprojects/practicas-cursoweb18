<?php
    $monto_euros = (float) $_POST["fmonto"];
    $monto_euros = round($monto_euros,2);

    $divisa = $_POST["fdivisa"];

    if ( $monto_euros == "" ) {
        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas y a Dolares</a></h1>";
        echo "<h2>Introduce un monto a convertir</h2>";


    } elseif ($divisa == "PESETAS") {
        $monto_pesetas = $monto_euros * 166.39;
        $monto_pesetas = round($monto_pesetas, 2);

        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas y a Dolares</a></h1>";
        echo "<h2>{$monto_euros} Euros son {$monto_pesetas} pesetas</h2>";

    } elseif ($divisa == "DOLARES") {
        $monto_dolares = $monto_euros * 1.12;
        $monto_dolares = round($monto_dolares, 2);

        echo "<h1><a href=\"index.html\">Convertidor de Euros a Pesetas y a Dolares</a></h1>";
        echo "<h2>{$monto_euros} Euros son {$monto_dolares} Dolares</h2>";

    }
    

?>