<?php
    include_once '../php/conexion.php'; // Agrego todas las credenciales de la base de datos

    
    
   

    if ( empty($_POST) ) { 
 
    } else {

        $fsolicitante= $_POST['fsolicitante'];
        $fambito= $_POST['fambito'];
        $faula= $_POST['faula'];
        $fcategoria= $_POST['fcategoria'];
        $fsubcat= $_POST['fsubcat'];
        $fincidencia= $_POST['fincidencia'];
        $prioridad= $_POST['prioridad'];
        
        if ((($fsolicitante == '') || ($fambito == '') || ($faula == '') || ($fcategoria == '') || ($fsubcat == '') || ($fincidencia == '') || ($prioridad == ''))) {
            // No devuelvo nada, entonces el ajax dará error de comunicación  
            echo json_encode( array("Hay un gran error"));
        } else {
            // echo json_encode( array("Exitoso"));

            # Establezco la tabla que deseo trabajar de la base de datos
            $tabla= 'incidencias'; 

            # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
            $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
            mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos

            if (mysqli_connect_errno()) {
                echo json_encode( array("No pudo conectarse a la base de datos"));
            } else {
                # Preparo la sentencia con los comodines ?  para insertar datos de la incidencia              
                $sql = 'INSERT INTO '.$tabla.' (id_solicitante, 
                                               id_ambito, 
                                               id_aula, 
                                               id_categoria, 
                                               id_subcategoria, 
                                               prioridad, 
                                               descrip_incidencia)
                VALUES (?, ?, ?, ?, ?, ?, ?)'; // Esta es para insertar la incidencia en la tabla incidencia
                        
                # Preparo los datos que voy a insertar de la incidencia
                $uno= intval($fsolicitante);
                $dos= intval($fambito);
                $tres= intval($faula);
                $cuatro= intval($fcategoria);
                $cinco= intval($fsubcat);
                $seis= intval($prioridad);
               
                // # Preparo la consulta junto con los parámetros que voy a enviar
                $pre = mysqli_prepare($conn, $sql);

                // # indico los datos a reemplazar con su tipo
                mysqli_stmt_bind_param($pre, "iiiiiis", $uno, $dos, $tres, $cuatro, $cinco, $seis, $fincidencia);

                // # Ejecuto la consulta
                mysqli_stmt_execute($pre);

                // # PASO OPCIONAL (SOLO PARA CONSULTAS DE INSERCIÓN):
                // # Obtener el ID del registro insertado
                $nuevo_id = mysqli_insert_id($conn);

                // # Cierro la consulta 
                mysqli_stmt_close($pre);
                
                # Envío correo de confirmación al solicitante 
                $email_solicitante= dame_email("email_solicitante", "solicitantes", $fsolicitante, $conn); //Obtengo el email del solicitante
                $email_responsable= dame_email("email_responsable", "configuracion", "1", $conn); //Obtengo el email del responsable de informática

                // #Cierro la conexión
                mysqli_close($conn);

                // Envío el correo al solicitante
                $destinatario = $email_solicitante;
                $asunto = "Confirmación de incidencia desde PHP";
                $mensaje = "Esta es una confirmación de la incidencia hecha en el problema 5 enviada desde PHP";
                mail($destinatario, $asunto, $mensaje);

                // Envío el correo al administrador del sistema
                $destinatario = $email_responsable;
                $asunto = "Confirmación de incidencia desde PHP";                
                $mensaje = "Esta es una confirmación de la incidencia hecha en el problema 5 enviada desde PHP http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr06/php/atencion_incidencia.php?id_solicitante=".$fsolicitante."&id_ambito=".$fambito."&id_aula=".$faula."&id_categoria=".$fcategoria."&id_sub_cat=".$fsubcat."&id_prioridad=".$prioridad."&id_incidencia=".$nuevo_id;
                mail($destinatario, $asunto, $mensaje);


                // Construye el url con estos parámetros id_solicitante=$fsolicitante id_ambito=$fambito id_aula=$faula id_categoria=$fcategoria id_sub_cat=$fsubcat id_prioridad=$prioridad id_descripcion=$fincidencia     
                

                echo json_encode(array("Exitoso"));
                // $mensaje= 'El registro insertado tiene la id: '.$nuevo_id;
                // echo json_encode( array($mensaje));
            }                    
        }
    }    

?>