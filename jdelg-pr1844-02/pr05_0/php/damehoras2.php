<?php
    
    if ( empty($_POST) ) { 
 
    } elseif ( ($_POST['ciudad'] == 'Valencia') ) {
        $horas= array( 'Introduzca hora', '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00' );
        echo json_encode($horas);
        
    } elseif ( ($_POST['ciudad'] == 'Burjasot') ) {
        $horas= array( 'Introduzca hora', '04:00 - 05:00', '05:00 - 06:00', '06:00 - 07:00', '08:00 - 09:00'  );
        echo json_encode($horas);
        
    } elseif ( ($_POST['ciudad'] == 'Paterna') ) {
        $horas= array( 'Introduzca hora', '04:00 - 05:00', '05:00 - 06:00', '06:00 - 07:00', '08:00 - 09:00' );
        echo json_encode($horas);
    } else {
        echo json_encode('MALO');
    }


?>