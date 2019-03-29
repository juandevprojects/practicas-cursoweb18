

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pr1844-02-PR06 Atención de Incidencias</title>

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
                        //    echo "El get está vacío";
                       } else {
                            //    echo "El saludo enviado en el get es {$_GET['saludo']}";
                            include_once '../php/conexion.php'; // Agrego todas las credenciales de la base de datos

                            # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
                            $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
                            mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos

                            if (mysqli_connect_errno()) {
                                echo '<option value="1">Error al conectar con la base de datos</option>';
                            } else {

                                # Si el GET existe y la BD conectó entonces chequeo cada variable para que no me rompan el código 
                                if ( isset($_GET['id_solicitante']) ){                            
                                    $nombre_solicitante= dame_un_campo("nombre_solicitante", "solicitantes", $_GET['id_solicitante'], $conn);
                                }

                                if ( isset($_GET['id_ambito']) ){
                                    $nombre_ambito= dame_un_campo("ambito", "ambitos", $_GET['id_ambito'], $conn);      
                                }

                               
                                if ( isset($_GET['id_aula']) ){
                                    $nombre_aula= dame_un_campo("aula", "aulas", $_GET['id_aula'], $conn);      
                                }

                                if ( isset($_GET['id_categoria']) ){
                                    $nombre_categoria= dame_un_campo("categoria", "categorias", $_GET['id_categoria'], $conn);
                                }
                                
                                if ( isset($_GET['id_sub_cat']) ){
                                    $nombre_subcat= dame_un_campo("sub_categoria", "sub_categorias", $_GET['id_sub_cat'], $conn);
                                }

                                if ( isset($_GET['id_prioridad']) ){
                                   if ($_GET['id_prioridad'] == 0) {
                                       $nombre_prioridad= "baja";
                                   } elseif ($_GET['id_prioridad'] == 1) {
                                       $nombre_prioridad= "ALTA";
                                   } else {

                                   }
                                }

                                if ( isset($_GET['id_incidencia']) ){
                                    $descrip_incidencia= dame_un_campo("descrip_incidencia", "incidencias", $_GET['id_incidencia'], $conn);

                                    // $descrip_incidencia= $_GET['id_incidencia'];

                                    // Aquí debo sustituir por el id de la incidencia
                                } else {
                                    $descrip_incidencia= "no hay incidencia";
                                }
                 
                                // Cierro la conexión
                                mysqli_close($conn); 


                                // http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr06/php/atencion_incidencia.php?id_solicitante=1&id_ambito=3&id_aula=2&id_categoria=1&id_sub_cat=3&id_prioridad=0&id_incidencia=1
                                
                            }                                   
                       }
                    ?>

                    <table class="table">
                        <tr>
                            <td>Solicitante:</td>
                            <td><?php echo ''.isset($nombre_solicitante) ?  $nombre_solicitante : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Ambito:</td>
                            <td><?php echo ''.isset($nombre_ambito) ?  $nombre_ambito : ''; ?></td>
                        </tr> 

                        <tr>
                            <td>Aula:</td>
                            <td><?php echo ''.isset($nombre_aula) ?  $nombre_aula : ''; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Categoría:</td>
                            <td><?php echo ''.isset($nombre_categoria) ?  $nombre_categoria : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Sub-categoría:</td>
                            <td><?php echo ''.isset($nombre_subcat) ?  $nombre_subcat : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Prioridad:</td>
                            <td><?php echo ''.isset($nombre_prioridad) ?  $nombre_prioridad : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Descripción:</td>
                            <td><?php echo ''.isset($descrip_incidencia) ?  $descrip_incidencia : ''; ?></td>
                        </tr>

                    </table>

                    <!-- El formulario es para solicitar la entrega en domicilio de la compra del supermercado; pedirá nombre, dirección de entrega, observaciones y en un desplegable (select) las horas de entrega. -->
                    <form action="../index.php" class="needs-validation" id="formobservaciones" method="POST" novalidate>

                        <fieldset>
                                <legend>Observaciones</legend>
                                <div class="form-group">
                                    <!-- <label for="comment">Comment:</label> -->
                                    <textarea class="form-control" rows="3" id="fobservaciones" name="fobservaciones"
                                        placeholder="Escriba sus observaciones" required></textarea>
                                    <div class="invalid-feedback">Debe escribir las observaciones de la incidencia</div>
                                </div>

                                <textarea name="fincidencia"  hidden ><?php echo $_GET['id_incidencia']; ?></textarea>
                                <textarea name="fsolicitante" hidden ><?php echo $_GET['id_solicitante']; ?></textarea>
                        </fieldset>

                        <button type="submit" class="btn btn-dark">Enviar observaciones</button>
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
    <script src="../js/js.js"></script>
</body>

</html>



