<?php    
   
    if ( in_array("",$_POST) ) { //Chequeo si en $_POST hay algún campo vacío en $_POST
        $resultado = "MAL";
        $texto = "Algún valor no es válido o no ha sido escrito";
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto, 'divisa' => $_POST['fdivisa'], 'euros' => $_POST['feuros']) );
    } else {
        
        if ( empty($_POST) ) { //Chequeo si $_POST hay algún campo vacío en $_POST
            // ***No coloco nada por si acaso alguién me quiere registrar el código directamente solicitando el archivo PHP
            // $resultado = "NO_POST";
            // $texto = "No se ha ejecutado ningun post";
            // echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ) );
        } else { // Si no está vacío y depaso no tiene campos en blanco entonces

            if ($_POST['fdivisa'] === 'PESETAS') { // Ejecuto el cambio en pesetas si el select es pesetas
                $resultado = "BIEN";
                $texto = $_POST['feuros'] * 166.39;
                $texto = round($texto, 2);
                echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto, 'divisa' => $_POST['fdivisa'], 'euros' => $_POST['feuros']) );

            } else {  // Sino calculo en Dólares
                $resultado = "BIEN";
                $texto = $_POST["feuros"] * 1.13;
                $texto = round($texto, 2);
                echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto, 'divisa' => $_POST['fdivisa'], 'euros' => $_POST['feuros']) );
            }

            
        }
        
    }    
     


    
?>