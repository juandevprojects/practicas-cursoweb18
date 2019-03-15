<?php    
    
    if ( in_array("",$_POST) ) {
        $resultado = "MAL";
        $texto = "Algún valor no es válido o no ha sido escrito";
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ) );
    } else {
        
        if ( empty($_POST) ) {
            // ***No coloco nada por si acaso alguién me quiere registrar el código directamente solicitando el archivo PHP
            // $resultado = "NO_POST";
            // $texto = "No se ha ejecutado ningun post";
            // echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ) );
        } else {
            $resultado = "BIEN";
            $texto =   $_POST["feuros"] * 166.39;
            $texto = round($texto, 2);
            echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto, 'euros' => $_POST["feuros"]) );
        }
        
    }    
     


    
?>