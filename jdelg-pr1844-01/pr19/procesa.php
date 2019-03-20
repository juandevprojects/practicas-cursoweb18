<?php    
    if ( empty($_POST) ) {
        // ***No coloco nada por si acaso alguién me quiere registrar el código directamente solicitando el archivo PHP        
    } elseif ( in_array("",$_POST) ) { //Chequeo si en $_POST hay algún campo vacío en $_POST
        $resultado = "MAL";
        $texto = "Algún valor no es válido o no ha sido escrito";
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));
    } else {
        $resultado = "BIEN";        
        $texto =  array_sum($_POST) / count($_POST);
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));
    }
?>


