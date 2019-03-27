

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
    <link rel="stylesheet" href="../css/estilos.css">
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
                    Notificación de incidencias
                </div>

                <div class="card-body">    
                    <h4 class="card-title">Datos de la incidencia</h4>

                    <?php
                       if ( empty($_GET) ) {
                           echo "El get está vacío";
                       } else {
                            //    echo "El saludo enviado en el get es {$_GET['saludo']}";
                            include_once '../php/conexion.php'; // Agrego todas las credenciales de la base de datos

                            # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
                            $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
                            mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos

                            if (mysqli_connect_errno()) {
                                echo '<option value="1">Error al conectar con la base de datos</option>';
                            } else {
                                # ****************** Recupero el nombre del solicitante de la incidencia
                                $tabla= 'solicitantes'; //Establezco la tabla que deseo trabajar de la base de datos
                                # Preparo la query que quiero ejecutar
                                $sql= 'SELECT nombre_solicitante FROM '.$tabla.' WHERE id='.$_GET['id_solicitante'];
                                # Ejecuto la query
                                $result= mysqli_query($conn, $sql);
                                
                                while( $fila= mysqli_fetch_array($result) ) {
                                    $nombre_solicitante= $fila['nombre_solicitante'];
                                };                       
                                // Libero la query
                                mysqli_free_result($result); 


                                # ****************** Recupero el ambito de la incidencia
                                $tabla= 'ambitos'; //Establezco la tabla que deseo trabajar de la base de datos
                                # Preparo la query que quiero ejecutar
                                $sql= 'SELECT ambito FROM '.$tabla.' WHERE id='.$_GET['id_ambito'];
                                # Ejecuto la query
                                $result= mysqli_query($conn, $sql);
                                
                                while( $fila= mysqli_fetch_array($result) ) {
                                    $nombre_ambito= $fila['ambito'];
                                };                       
                                // Libero la query
                                mysqli_free_result($result); 


                                // http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr06/php/constructor.php?id_solicitante=1&id_ambito=3

                                // Cierro la conexión
                                mysqli_close($conn); // No la cierro porque voy a usarla más adelante para seguir 
                            }                                   
                       }
                    ?>

                    <table class="table">
                        <tr>
                            <td>Solicitante:</td>
                            <td><?php echo $nombre_solicitante; ?></td>
                        </tr>

                        <tr>
                            <td>Ambito:</td>
                            <td><?php echo $nombre_ambito; ?></td>
                        </tr> 

                        <tr>
                            <td>Aula:</td>
                            <td>NOMBRE DEL AULA QUE VIENE DESDE SQL</td>
                        </tr>

                        <tr>
                            <td>Categoría:</td>
                            <td>NOMBRE DEL CATEGORIA QUE VIENE DESDE SQL</td>
                        </tr>

                        <tr>
                            <td>Sub-categoría:</td>
                            <td>NOMBRE DEL SUB-CATEGORIA QUE VIENE DESDE SQL</td>
                        </tr>

                        <tr>
                            <td>Prioridad:</td>
                            <td>NOMBRE DEL PRIORIDAD QUE VIENE DESDE SQL</td>
                        </tr>

                        <tr>
                            <td>Descripción:</td>
                            <td>NOMBRE DEL PRIORIDAD QUE VIENE DESDE SQL</td>
                        </tr>
                        
                    </table>

                    
                    

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
    <script src="../js/js.js"></script>
</body>

</html>



