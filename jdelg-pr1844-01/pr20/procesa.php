<?php    
    if ( empty($_POST) ) {
        // ***No coloco nada por si acaso alguién me quiere registrar el código directamente solicitando el archivo PHP        
    } elseif ( in_array("",$_POST) ) { //Chequeo si en $_POST hay algún campo vacío en $_POST
        $resultado = "MAL";
        $texto = "Algún valor no es válido o no ha sido escrito";
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));
    } elseif ( $_POST['foperacion']  === "SUMA" ) {
        $resultado = $_POST['foperacion'];
        $texto = $_POST['fval1'] + $_POST['fval2'];
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));
        
    } elseif ( $_POST['foperacion']  === "RESTA" ) {
        $resultado = $_POST['foperacion'];
        $texto = $_POST['fval1'] - $_POST['fval2'];
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));

    } elseif ( $_POST['foperacion']  === "MULTIPLICACION" ) {
        $resultado = $_POST['foperacion'];
        $texto = $_POST['fval1'] * $_POST['fval2'];
        echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));

    } elseif ( $_POST['foperacion']  === "DIVISION" ) {
        if ($_POST['fval2'] === "0") {
            $resultado = "MAL";
            $texto = "El valor 2 (denominador) de la división debe ser distinto de cero";
            echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));
        } else{
            $resultado = $_POST['foperacion'];
            $texto = $_POST['fval1'] / $_POST['fval2'];
            echo json_encode( array('resultado'=>$resultado, 'mensaje'=> $texto ));
        }        
    }     
    
?>


