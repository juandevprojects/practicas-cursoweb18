

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pr1844-02-PR07 Resolución de Incidencias</title>

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
                    Resolución de incidencias
                </div>

                <div class="card-body">    

                    <?php                        

                       if ( empty($_GET) ) {
                        //    echo "El get está vacío";
                       } else {
                            //    echo "El saludo enviado en el get es {$_GET['saludo']}";
                            include_once '../../../../conexion.php'; // Agrego todas las credenciales de la base de datos
                            include_once 'funciones.php';

                            # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
                            $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
                            mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos

                            if (mysqli_connect_errno()) {
                                echo '<option value="1">Error al conectar con la base de datos</option>';
                            } else {

                                # Si el GET existe y la BD conectó entonces chequeo cada variable para que no me rompan el código 
                                

                                if ( isset($_GET['id_incidencia']) ){  
                                    // Obtengo los detalles de la incidencia                          
                                    $incidencia= dame_una_incidencia($_GET['id_incidencia'], $conn);

                                    // Obtengo los id's de cada campo de la incidencia
                                    $id_solicitante= $incidencia['id_solicitante'];
                                    $id_ambito= $incidencia['id_ambito'];
                                    $id_aula= $incidencia['id_aula'];
                                    $id_categoria= $incidencia['id_categoria'];
                                    $id_subcategoria= $incidencia['id_subcategoria']; 
                                    $prioridad= $incidencia['prioridad'];                              

                                    // Después de obtener los id's de todos los campos de la incidencia busco sus nombre para escribir el correo
                                    $nombre= dame_un_campo("nombre_solicitante", "solicitantes", $id_solicitante, $conn);
                                    $ambito= dame_un_campo("ambito", "ambitos", $id_ambito, $conn);
                                    $aula= dame_un_campo("aula", "aulas", $id_aula, $conn);
                                    $categoria= dame_un_campo("categoria", "categorias", $id_categoria, $conn);
                                    $subcategoria= dame_un_campo("sub_categoria", "sub_categorias", $id_subcategoria, $conn);

                                    // Chequeo si la incidencia tiene todos sus campos full
                                    if (isset($nombre) && isset($ambito) && isset($aula) && isset($categoria) && isset($subcategoria) && isset($prioridad) && isset($incidencia['descrip_incidencia']) ) {
                                        // Le doy un valor categórico a la prioridad
                                        if ($prioridad==1){
                                            $prio= "ALTA";
                                        } elseif ($prioridad==0){
                                            $prio= "baja";
                                        } else {
                                            $prio= "Sin prioridad";
                                        }
                                        //construir este php. Revisando el html de las options

                                        $descripcion= $incidencia['descrip_incidencia'];
                                        $observaciones= $incidencia['observaciones'];
                                    }

                                } else {
                                    // No hago nada
                                }                             
                 
                                // Cierro la conexión
                                mysqli_close($conn); 


                                // http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr07/php/resolucion_incidencia.php?id_solicitante=3&id_ambito=3&id_aula=2&id_categoria=1&id_sub_cat=4&id_prioridad=1&id_incidencia=18
                                
                            }                                   
                       }
                    ?>
                    <h4 class="card-title">Datos de la incidencia <?php echo ''.isset($_GET['id_incidencia']) ?  $_GET['id_incidencia'] : ''; ?></h4>


                    <table class="table">
                         <tr>
                            <td>Solicitante:</td>
                            <td><?php echo ''.isset($nombre) ?  $nombre : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Ambito:</td>
                            <td><?php echo ''.isset($ambito) ?  $ambito : ''; ?></td>
                        </tr> 

                        <tr>
                            <td>Aula:</td>
                            <td><?php echo ''.isset($aula) ?  $aula : ''; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Categoría:</td>
                            <td><?php echo ''.isset($categoria) ?  $categoria : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Sub-categoría:</td>
                            <td><?php echo ''.isset($subcategoria) ?  $subcategoria : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Prioridad:</td>
                            <td><?php echo ''.isset($prio) ?  $prio : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Descripción:</td>
                            <td><?php echo ''.isset($descripcion) ?  $descripcion : ''; ?></td>
                        </tr>

                        <tr>
                            <td>Observaciones:</td>
                            <td><?php echo ''.isset($observaciones) ?  $observaciones : ''; ?></td>
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

                                <textarea name="fid_incidencia" hidden ><?php echo $_GET['id_incidencia']; ?></textarea>
                                <textarea name="fresolucion"  hidden ><?php echo "SI"; ?></textarea>

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



