<?php
    
    $dia= $_POST['dia'];

    if ( empty($_POST) ) { 
 
    } elseif ( ( ($dia == 'Lunes') || ($dia == 'Miercoles') || ($dia == 'Viernes') )  )  {
        $ciudad= array( 'Introduzca ciudad', 'Valencia', 'Paterna');
        echo json_encode($ciudad);
        
    } elseif ( ( ($dia == 'Martes') || ($dia == 'Jueves') )  )  {
        $ciudad= array( 'Introduzca ciudad', 'Valencia', 'Burjasot');
        echo json_encode($ciudad);
        
    } elseif (  ($dia == 'Sabado')   )  {
        $ciudad= array( 'Introduzca ciudad', 'Valencia');
        echo json_encode($ciudad);

    } else {
        echo json_encode('MALO');
    }

?>