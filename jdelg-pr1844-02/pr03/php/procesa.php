<?php
    if ( empty($_POST) ) { 
 
    } elseif ( ( ($_POST['fnombre'] == '') || ($_POST['fdireccion'] == '') || ($_POST['horas'] == '') ) ) {
        // No devuelvo nada, entonces el ajax dará error de comunicación        
    } else {


        if ( ($_POST['observaciones'] == '') ) {

            echo json_encode( array($_POST['fnombre'],
                                $_POST['fdireccion'],
                                $_POST['horas'],
                            )
            );

        } else {

            echo json_encode( array($_POST['fnombre'],
                                $_POST['fdireccion'],
                                $_POST['horas'],
                                $_POST['observaciones']
                            )
            );

        }
    }

?>