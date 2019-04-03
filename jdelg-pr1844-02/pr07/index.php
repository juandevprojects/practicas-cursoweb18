<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pr1844-02-PR07 Notificación de incidencias</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jquery confirm CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- mi estilo -->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="container">

        <!-- Este div contiene todo el formulario de pedidos -->
        <div class="row align-items-center justify-content-center" id="contenedor">

            <!-- Este div es para hacer un marco izquierdo con imágenes -->
            <div class="d-none d-md-block col-md-2 col-lg-2" id="izquierdo"></div>

            <!-- Este div contiene el formulario en si -->
            <div class="card col-md-8 col-lg-8">
                <div class="card-header">
                    <!-- <h1>SUPERMERCADOS FACILITO</h1> -->
                    COLEGIOS VIRTUALES
                </div>

                <div class="card-body">    
                    <h4 class="card-title">Notificación de incidencias</h4>

                    <!-- El formulario es para solicitar la entrega en domicilio de la compra del supermercado; pedirá nombre, dirección de entrega, observaciones y en un desplegable (select) las horas de entrega. -->
                    <form action="/action_page.php" class="needs-validation" id="formoid" novalidate>
                        <fieldset>
                            <legend>Solicitante</legend>
                                <div class="form-group">
                                <!-- <label for="sel1">Select list:</label> -->
                                <select class="form-control" id="fsolicitante" required>
                                    <!-- ejecuto código php donde voy a solicitar a la base de datos todos los solicitantes que hay -->
                                    <?php
                                        include_once '../../../conexion.php'; // Agrego todas las credenciales de la base de datos
                                        $tabla= 'solicitantes'; //Establezco la tabla que deseo trabajar de la base de datos

                                        # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
                                        $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
                                        mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos

                                        if (mysqli_connect_errno()) {
                                            echo '<option value="1">Error al conectar con la base de datos</option>';
                                        } else {
                                            # Preparo la query que quiero ejecutar
                                            $sql= 'SELECT id, nombre_solicitante FROM '.$tabla;
                                            # Ejecuto la query
                                            $result= mysqli_query($conn, $sql);                                            
                                            echo '<option value="">Escoja un solicitante</option>'; // inicializo La primera opción a mostrar en el select

                                            while( $fila= mysqli_fetch_array($result) ) {
                                                echo '<option value="'.$fila['id'].'">'.$fila['nombre_solicitante'].'</option>';                 
                                            };                       
                                            // Libero la query
                                            mysqli_free_result($result); 
                                            // Cierro la conexión
                                            // mysqli_close($conn); // No la cierro porque voy a usarla más adelante para seguir 
                                        }                                       
                                    ?>                                  

                                </select>
                                <div class="invalid-feedback">Debe especificar el ámbito</div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Sitio de la incidencia</legend>
                            <div class="form-group">
                                <!-- <label for="sel1">Select list:</label> -->
                                <select class="form-control" id="fambito" required>

                                    <?php
                                        $tabla= 'ambitos';
                                        if (mysqli_connect_errno()) {
                                            echo '<option value="1">Error al conectar con la base de datos</option>';
                                        } else {
                                            # Preparo la query que quiero ejecutar
                                            $sql= 'SELECT id, ambito FROM '.$tabla;
                                            # Ejecuto la query
                                            $result= mysqli_query($conn, $sql);                                            
                                            echo '<option value="">Seleccione el ámbito</option>'; // inicializo La primera opción a mostrar en el select

                                            while( $fila= mysqli_fetch_array($result) ) {
                                                echo '<option value="'.$fila['id'].'">'.$fila['ambito'].'</option>';                 
                                            };                       
                                            // Libero la query
                                            mysqli_free_result($result);    
                                            // Cierro la conexión
                                            // mysqli_close($conn); // No la cierro porque voy a usarla más adelante para seguir 
                                        }          
                                    ?>

                                </select>
                                <div class="invalid-feedback">Debe especificar el ámbito</div>
                            </div>

                            <div class="form-group">
                                <!-- <label for="sel1">Select list:</label> -->
                                <select class="form-control" id="faula" required>
                                   
                                     <?php
                                        $tabla= 'aulas';
                                        if (mysqli_connect_errno()) {
                                            echo '<option value="1">Error al conectar con la base de datos</option>';
                                        } else {
                                            # Preparo la query que quiero ejecutar
                                            $sql= 'SELECT id, aula FROM '.$tabla;
                                            # Ejecuto la query
                                            $result= mysqli_query($conn, $sql);                                            
                                            echo '<option value="">Seleccione el aula</option>'; // inicializo La primera opción a mostrar en el select

                                            while( $fila= mysqli_fetch_array($result) ) {
                                                echo '<option value="'.$fila['id'].'">'.$fila['aula'].'</option>';                 
                                            };                       
                                            // Libero la query
                                            mysqli_free_result($result);    
                                            // Cierro la conexión
                                            // mysqli_close($conn); // No la cierro porque voy a usarla más adelante para seguir 
                                        }          
                                    ?>
                                </select>
                                <div class="invalid-feedback">Debe especificar el aula</div>
                            </div>
                        </fieldset>



                        <fieldset>
                            <legend>Tipo de incidencia</legend>
                            <div class="form-group">
                                <!-- <label for="sel1">Select list:</label> -->
                                <select class="form-control" id="fcategoria" required>

                                    <?php
                                        $tabla= 'categorias';
                                        if (mysqli_connect_errno()) {
                                            echo '<option value="1">Error al conectar con la base de datos</option>';
                                        } else {
                                            # Preparo la query que quiero ejecutar
                                            $sql= 'SELECT id, categoria FROM '.$tabla;
                                            # Ejecuto la query
                                            $result= mysqli_query($conn, $sql);                                            
                                            echo '<option value="">Seleccione la categoría</option>'; // inicializo La primera opción a mostrar en el select

                                            while( $fila= mysqli_fetch_array($result) ) {
                                                echo '<option value="'.$fila['id'].'">'.$fila['categoria'].'</option>';                 
                                            };                       
                                            // Libero la query
                                            mysqli_free_result($result);    
                                            // Cierro la conexión
                                            // mysqli_close($conn); // No la cierro porque voy a usarla más adelante para seguir 
                                        }          
                                    ?>

                                </select>
                                <div class="invalid-feedback">Debe especificar la categoría</div>
                            </div>

                            <div class="form-group">
                                <!-- <label for="sel1">Select list:</label> -->
                                <select class="form-control" id="fsubcat" required>

                                    <?php
                                        $tabla= 'sub_categorias';
                                        if (mysqli_connect_errno()) {
                                            echo '<option value="1">Error al conectar con la base de datos</option>';
                                        } else {
                                            # Preparo la query que quiero ejecutar
                                            $sql= 'SELECT id, sub_categoria FROM '.$tabla;
                                            # Ejecuto la query
                                            $result= mysqli_query($conn, $sql);                                            
                                            echo '<option value="">Seleccione la sub-categoría</option>'; // inicializo La primera opción a mostrar en el select

                                            while( $fila= mysqli_fetch_array($result) ) {
                                                echo '<option value="'.$fila['id'].'">'.$fila['sub_categoria'].'</option>';                 
                                            };                       
                                            // Libero la query
                                            mysqli_free_result($result);    
                                            // Cierro la conexión
                                            mysqli_close($conn);
                                        }          
                                    ?>

                                   
                                </select>
                                <div class="invalid-feedback">Debe especificar la categoría</div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Prioridad</legend>
                            
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="fprioalta" name="example"
                                        value="alta" required>
                                    <label class="custom-control-label" for="fprioalta">Prioridad Alta</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="fpriobaja" name="example"
                                       value="baja" required>
                                    <label class="custom-control-label" for="fpriobaja">Prioridad Baja</label>
                                </div>
                        </fieldset>

                        <fieldset>
                            <legend>Descripción de la Incidencia</legend>
                            <div class="form-group">
                                <!-- <label for="comment">Comment:</label> -->
                                <textarea class="form-control" rows="3" id="fincidencia"
                                    placeholder="Escriba la incidencia" required></textarea>
                                <div class="invalid-feedback">Debe especificar la incidencia</div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-dark">Enviar la incidencia</button>
                    </form>

                </div>

            </div>

            <!-- Este div es para hacer un marco derecho con imágenes -->
            <div class="d-none d-md-block col-md-2 col-lg-2" id="derecho"></div>
            

        </div>




         <!-- ********Este código php es necesario para grabar las observaciones de la incidencia hecha con el php constructor  en el dado caso que se acceda a la página un post hecho en -->
        <?php         
        // $fsolicitante= $_POST['fsolicitante'];
        // $fambito= $_POST['fambito'];
        // $faula= $_POST['faula'];
        // $fcategoria= $_POST['fcategoria'];
        // $fsubcat= $_POST['fsubcat'];
        // $fincidencia= $_POST['fincidencia'];
        // $prioridad= $_POST['fprioridad'];

        // echo $fsolicitante."".$prioridad."".$fambito."".$faula."".$fcategoria."".$fsubcat."".$fincidencia;


        if ( empty($_POST) ) { 
            echo '<div id="controlador" hidden>3</div>'; // Este es un controlador para javascript
            // no hago nada
        } else {
            include_once '../../../conexion.php'; // Agrego todas las credenciales de la base de datos

             if ( isset($_POST['fsolicitante']) ){  
                 $fsolicitante= $_POST['fsolicitante'];
             }

             if ( isset($_POST['fambito']) ){  
                 $fambito= $_POST['fambito'];
             }

             if ( isset($_POST['faula']) ){  
                 $faula= $_POST['faula'];
             }

             if ( isset($_POST['fcategoria']) ){  
                 $fcategoria= $_POST['fcategoria'];
             }

             if ( isset($_POST['fsubcat']) ){  
                 $fsubcat= $_POST['fsubcat'];
             }

             if ( isset($_POST['fincidencia']) ){  
                 $fincidencia= $_POST['fincidencia'];
             }

             if ( isset($_POST['fprioridad']) ){  
                 $prioridad= $_POST['fprioridad'];
             }           

            // echo $fsolicitante."".$prioridad."".$fambito."".$faula."".$fcategoria."".$fsubcat."".$fincidencia;

            # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
            $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
            mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos

            if (mysqli_connect_errno()) {
                echo '<div id="controlador" hidden>2</div>'; // Este es un controlador para javascript
            } else {

                # Si el POST existe y la BD conectó entonces chequeo cada variable para que no me rompan el código 
                if ( isset($_POST['fobservaciones']) ){                            
                    # Establezco la tabla que deseo trabajar de la base de datos
                    $tabla= 'incidencias'; 

                    # Preparo la sentencia con los comodines ?  para insertar datos de la incidencia              
                    $sql = 'UPDATE '.$tabla.' SET observaciones=(?) WHERE id='.intval($_POST['fincidencia']); // Esta es para insertar la incidencia en la tabla incidencia
                        
                    # Preparo los datos que voy a insertar de la incidencia
                    if (isset($_POST['fresolucion'])) {
                        date_default_timezone_set('UTC');

                        # Preparo la query que quiero ejecutar
                        $sql2= 'SELECT observaciones FROM '.$tabla.' WHERE id='.$_POST['fincidencia'];
                        # Ejecuto la query
                        $result= mysqli_query($conn, $sql2); 

                        while( $fila= mysqli_fetch_array($result) ) {
                            $observacion_vieja= $fila['observaciones'];           
                        };                         
                        // Libero la query
                        mysqli_free_result($result);  

                        // Establezco lo que voy a actualizar el campo observaciones    
                        $uno= date(DATE_RFC2822)." ".$_POST['fobservaciones']."</br>&nbsp;&nbsp;&nbsp;&nbsp;". " " .$observacion_vieja;

                        // $uno= "Modificada";
                        // echo $uno;

                    }else {
                        $uno= date(DATE_RFC2822)." ".$_POST['fobservaciones'];  
                        // $uno= "NO Modificada"; 
                    }
                          

                    // # Preparo la consulta junto con los parámetros que voy a enviar
                    $pre = mysqli_prepare($conn, $sql);

                    // # indico los datos a reemplazar con su tipo
                    mysqli_stmt_bind_param($pre, "s", $uno);

                    // # Ejecuto la consulta
                    mysqli_stmt_execute($pre);

                    // # PASO OPCIONAL (SOLO PARA CONSULTAS DE INSERCIÓN):
                    // # Obtener el ID del registro insertado
                    $nuevo_id = mysqli_insert_id($conn);

                    // # Cierro la consulta 
                    mysqli_stmt_close($pre);

                   // Enviar correo al solicitante de la incidencia y otro al administrador del sistema

                    # Envío correo de confirmación al solicitante 
                    $email_solicitante= dame_email("email_solicitante", "solicitantes", $_POST['fsolicitante'], $conn); //Obtengo el email del solicitante
                    $email_responsable= dame_email("email_responsable", "configuracion", "1", $conn); //Obtengo el email del responsable de informática
               

                    if (isset($_POST['fresolucion'])) {

                        // Envío el correo al solicitante
                        $destinatario = $email_solicitante;
                        $asunto = "Recepción de incidencia desde PHP número".$_POST['fincidencia'];
                        $mensaje = "Hola, su incidencia ha sido atendida por el responsable de informática";
                        mail($destinatario, $asunto, $mensaje);

                        // Envío el correo al administrador del sistema
                         # Preparo la query que quiero ejecutar
                        $sql= 'SELECT observaciones FROM '.$tabla.' WHERE id='.$_POST['fincidencia'];
                        # Ejecuto la query
                        $result= mysqli_query($conn, $sql); 

                        while( $fila= mysqli_fetch_array($result) ) {
                            $observacion_vieja= $fila['observaciones'];             
                        };                     
                        // Libero la query
                        mysqli_free_result($result);  

                        $destinatario = $email_responsable;
                        $asunto = "Recepción de incidencia desde PHP número".$_POST['fincidencia'];
                        $mensaje= "La incidencia número ".$_POST['fincidencia']." se ha analizado y finalizado con las siguientes observaciones \" ".$observacion_vieja." \"";
                        mail($destinatario, $asunto, $mensaje);                       

                    } else{
                        // Envío el correo al solicitante
                        $destinatario = $email_solicitante;
                        $asunto = "Recepción de incidencia desde PHP número".$_POST['fincidencia'];
                        $mensaje = "Hola, su incidencia ha sido atendida por el responsable de informática";
                        mail($destinatario, $asunto, $mensaje);

                        // Envío el correo al administrador del sistema
                        $destinatario = $email_responsable;
                        $asunto = "Recepción de incidencia desde PHP número".$_POST['fincidencia'];
                        $mensaje= "La incidencia número ".$_POST['fincidencia']." se ha analizado con la siguiente observación ".$_POST['fobservaciones']." Por favor finalice y cierre la incidencia http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr07/php/resolucion_incidencia.php?id_solicitante=".$fsolicitante."&id_ambito=".$fambito."&id_aula=".$faula."&id_categoria=".$fcategoria."&id_sub_cat=".$fsubcat."&id_prioridad=".$prioridad."&id_incidencia=".$fincidencia;
                        mail($destinatario, $asunto, $mensaje);                      


                    }


                    // #Cierro la conexión
                    mysqli_close($conn);

                    echo '<div id="controlador" hidden>1</div>'; // Este es un controlador para javascript

                } else {
                    echo '<div id="controlador" hidden>0</div>'; // Este es un controlador para javascript

                }
            }



        }


    ?>

    </div>

   
    





    <!-- jQuery library -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

    <!-- Popper JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>

    <!-- Latest compiled JavaScript -->
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>

    <!-- jquery confirm js -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js">
    </script>

    <!-- mi js -->
    <script src="js/js.js"></script>
</body>

</html>