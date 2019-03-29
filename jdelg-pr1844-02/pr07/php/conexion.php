<?php
# además de agregar los datos de la conexión a la base de datos  agrego las funciones que más utilizaré aquí

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
    $result= mysqli_query($conn, $sql);
    
    # Obtengo el resultado en una variable de php
    while( $fila= mysqli_fetch_array($result) ) {
        $nombre_solicitante= $fila[$campo];
    };                       

    // Libero la query
    mysqli_free_result($result); 

    if (isset($nombre_solicitante)){
        return $nombre_solicitante;
    } else {
        return "";
    }
}




# Preparar las variables con los datos de conexión
$host = 'localhost';
$usuario = 'root';
$clave = '';
$db = 'pr1844_02_pr05';
?>