<?php

function dame_email($campo, $tabla, $id_solicitante, $conn) {
    # Preparo la sentencia con los comodines ?  para obtener 
    // $sql2 = 'SELECT email_solicitante  FROM solicitantes WHERE id='.intval($id_solicitante);
    $sql2 = "SELECT {$campo} FROM {$tabla} WHERE id=".intval($id_solicitante);
    // return $sql2;
    
    # Preparo la consulta junto con los parámetros que voy a enviar
    $pre = mysqli_prepare($conn, $sql2);

    # Ejecuto la consulta
    mysqli_stmt_execute($pre);

    // # asocio los nombres de campo a nombres de variables
    mysqli_stmt_bind_result($pre, $email_solicitante);

    # Capturo los resultados y los guardo en un array
    while(mysqli_stmt_fetch($pre)) {
        $registros[] = $email_solicitante;
    }
    $resultado= $registros[0];

    // # Cierro la consulta 
    mysqli_stmt_close($pre);

    return $resultado;
}

function dame_un_campo($campo, $tabla, $id, $conn) {
    # Preparo la query que quiero ejecutar
    $sql= 'SELECT '.$campo.' FROM '.$tabla.' WHERE id='.$id;

    # Ejecuto la query
    if ( $result= mysqli_query($conn, $sql) ) {
        # Obtengo el resultado en una variable de php
        while( $fila= mysqli_fetch_array($result) ) {
            $contenido_campo= $fila[$campo];
        };        

        if (isset($contenido_campo)){
            return $contenido_campo;
        } else {
            return null;
        }
    } else {
        return null;
    }                   

    // Libero la query
    mysqli_free_result($result);    
}


function filtrar_formulario($input_form, $conn){
    $input_form = strip_tags(htmlspecialchars($input_form));//strip_tags — Retira las etiquetas HTML y PHP de un string
    $input_form = stripslashes($input_form);//htmlspecialchars — Convierte caracteres especiales en entidades HTML
    $input_form = mysqli_real_escape_string($conn,$input_form);//stripslashes — Quita las barras de un string con comillas escapadas
    $input_form = utf8_encode($input_form);//mysqli_real_escape_string — Escapa los caracteres especiales de una cadena para usarla en una sentencia SQL, tomando en cuenta el conjunto de caracteres actual de la conexión
    $input_form = str_replace(array("â‚¬","€",chr(128)),"EUR",iconv("UTF-8", "iso-8859-1//TRANSLIT", $input_form));
    $input_form = utf8_decode($input_form);
    return $input_form;
}
?>