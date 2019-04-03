<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pr1844-02-PR05_0</title>

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
                                        include_once '../../../../conexion.php'; // Agrego todas las credenciales de la base de datos
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
                                            mysqli_close($conn); // No la cierro porque voy a usarla más adelante para seguir 
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

                        <button type="submit" class="btn btn-dark">Confirmar pedido</button>
                    </form>

                </div>

            </div>

            <!-- Este div es para hacer un marco derecho con imágenes -->
            <div class="d-none d-md-block col-md-2 col-lg-2" id="derecho"></div>
            

        </div>

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