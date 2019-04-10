<?php
    if ( empty($_POST) ) {         
 
    } else {     
        // Chequo si el post tiene algún campo de formulario vacío
        if (( !isset($_POST['fsolicitante']) || !isset($_POST['fambito']) || !isset($_POST['faula']) || !isset($_POST['fcategoria']) || !isset($_POST['fsubcat']) || !isset($_POST['fincidencia']) || !isset($_POST['prioridad']) )) {
            echo json_encode(array('resultado'=>'1', 'mensaje'=>'Incidencia no procesada. El formulario tiene campos incompletos'));

        } else {
            include_once '../../../../conexion.php'; // Agrego todas las credenciales de la base de datos           
            include_once 'config_mail.php'; // Agrego todas las funciones para enviar email
             
            $fsolicitante= $_POST['fsolicitante'];
            $fambito= $_POST['fambito'];
            $faula= $_POST['faula'];
            $fcategoria= $_POST['fcategoria'];
            $fsubcat= $_POST['fsubcat']; 
            $prioridad= $_POST['prioridad'];
            $fincidencia= $_POST['fincidencia'];

            # Establezco la tabla que deseo trabajar de la base de datos
            $tabla= 'incidencias'; 

            # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
            $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
            mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos          
           
            if (mysqli_connect_errno()) {
                echo json_encode(array('resultado'=>'2', 'mensaje'=>'Incidencia no procesada. No pudo conectarse a la base de datos'));                
            } else {
                date_default_timezone_set('UTC'); // Establezco el uso horario para utilizar funciones de fecha
                $fincidencia= filtrar_formulario($fincidencia, $conn); // filtro la entrada del formulario textarea para que no me rompan el código.

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
                $siete= date(DATE_RFC2822)." ".$fincidencia;
               
                # Preparo la consulta junto con los parámetros que voy a enviar
                $pre = mysqli_prepare($conn, $sql);

                # indico los datos a reemplazar con su tipo
                mysqli_stmt_bind_param($pre, "iiiiiis", $uno, $dos, $tres, $cuatro, $cinco, $seis, $siete);
                
                # Ejecuto la consulta                          
                if (mysqli_stmt_execute($pre)) {                    
                    // # PASO OPCIONAL (SOLO PARA CONSULTAS DE INSERCIÓN):
                    // # Obtener el ID del registro insertado                    
                    $nuevo_id = mysqli_insert_id($conn);


                    // Envío el email de notificación al responsable de informática y al solicitante de la incidencia
                    $error_email= mail_creacion_incidencia_responsable($nuevo_id, $conn);                  
                    
                    //Chequeo si envió el correo de notificación tanto al solicitante de la incidencia como al responsable de informática
                    if (isset($error_email['resultado'])){
                        

                        if ($error_email['resultado']==='BAD_SQL'){
                            echo json_encode(array('resultado'=>'7', 'mensaje'=>'Incidencia procesada, pero no se envió el email porque a la tabla incidencia le faltan campos')); 
                           
                        } elseif($error_email['resultado']['responsable']==='BIEN') {
                            if ($error_email['resultado']['solicitante']==='BIEN') {
                                echo json_encode(array('resultado'=>'3', 
                                'mensaje'=>'Incidencia procesada y email enviado al responsable de informática, pero NO al solicitante de la incidencia', 
                                'no_incidencia'=> $nuevo_id,
                                'nombre'=> $error_email['solicitante'], 
                                'email_solicitante'=> $error_email['email_solcitante'],
                                'ambito'=> $error_email['ambito'], 
                                'aula'=> $error_email['aula'], 
                                'categoria'=> $error_email['categoria'], 
                                'subcategoria'=> $error_email['sub_cat'], 
                                'prio'=> $error_email['prioridad'], 
                                'descripcion'=>  $error_email['incidencia'] ));  


                            } else {
                                echo json_encode(array('resultado'=>'4', 'mensaje'=>'Incidencia procesada y email enviado al responsable de informático pero NO al solicitante de la incidencia')); 
                            }

                        } elseif ($error_email['resultado']['responsable']==='MAL') {
                            if ($error_email['resultado']['solicitante']==='BIEN') {
                                echo json_encode(array('resultado'=>'5', 'mensaje'=>'Incidencia procesada y email enviado al solicitante de la incidencia, pero NO al responsable de informática'));                            
                            } else {
                                echo json_encode(array('resultado'=>'6', 'mensaje'=>'Incidencia procesada, pero no se pudo enviar el email ni al responsable de informática ni al solicitante de la incidencia'));   
                            } 
                        } else {
                            echo json_encode(array('resultado'=>'8', 'mensaje'=>'Incidencia procesada, y esta es un mensaje de error por si acaso')); 
                        }                                              
                    } else {
                        echo json_encode(array('resultado'=>'9', 'mensaje'=>'Incidencia procesada, pero no se evió el mail porque la función de envío de e-mail no respondió')); 
                    }        
                }
                
                // # Cierro la consulta 
                mysqli_stmt_close($pre);              
                // #Cierro la conexión
                mysqli_close($conn);       
                     
                                           
            }                    
        }
    }    
?>