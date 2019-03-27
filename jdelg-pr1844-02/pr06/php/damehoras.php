<?php

    if ( empty($_POST) ) { 
 
    } elseif ( ($_POST['chequeo'] == 'verdadero') ) {
        $horas= array( 'Introduzca hora', '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00' );
        echo json_encode($horas);
        // echo json_encode(array('0'=>'9:00 - 10:00','1'=>'10:00 - 11:00','2'=>'11:00 - 12:00','3'=>'12:00 - 13:00'));
    } else {
        echo json_encode("No hay hora disponible");
    }


?>