<?php
// Chequeo de archivos php en caso de que se invoque desde el root o desde la carpeta php
if (!file_exists('../mail/PHPMailerAutoload.php') && !file_exists('funciones.php')) {
    // echo "entré en el try </br>";
    require_once "./mail/PHPMailerAutoload.php";
    require_once './php/funciones.php';
}else{
    // echo "entré en el catch </br>";
    require "../mail/PHPMailerAutoload.php";
    require 'funciones.php'; 
}

function envia_mail($asunto, $mensaje, $mensaje_plano, $email_destinatario, $nombre_destinatario) {
    
    // Instantiation and passing `true` enables exceptions
    global $mailusername, $mailpassw;
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = 1;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        // $mail->Host       = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication        
        $mail->Username   = $mailusername;            // SMTP username
        $mail->Password   = $mailpassw;                        // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('juandevprojects@gmail.com', 'Juan Developer');
        // $mail->addAddress('mat633@outlook.es', 'JDS');     // Add a recipient
        if (isset($nombre_destinatario)){
            $mail->addAddress($email_destinatario, $nombre_destinatario);            
        } else {
            $mail->addAddress($email_destinatario);               // Name is optional
        }
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        // $mail->Subject = 'Here is the subject';
        // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->Subject = $asunto;
        $mail->Body    = $mensaje;
        $mail->AltBody = $mensaje_plano;

        // Format
        $mail->CharSet = 'UTF-8';

        $mail->send();
        // echo 'Message has been sent';

        // echo json_encode(array('resultado' => 'BIEN','msjrespuesta'=> 'Message has been sent' ));
        return array('resultado' => 'BIEN','mensaje'=> 'e-mail has been sent' );
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // echo json_encode(array('resultado' => 'MAL','msjrespuesta'=> "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" ));
        return array('resultado' => 'MAL','mensaje'=> "e-mail could not be sent. Mailer Error: {$mail->ErrorInfo}" );
    }
}

function mail_creacion_incidencia_responsable($nuevo_id, $conn) {
    // De acuerdo al número de incidencia, solicito todos los id de cada campo de la incidencia
    // Esto se puede mejorar, haciendo una sola query que te dé tódo en un solo arreglo, pero porqcuestiones de tiempo no lo haré
    // $id_nombre= dame_un_campo("id_solicitante", "incidencias", $nuevo_id, $conn);
    // $id_ambito= dame_un_campo("id_ambito", "incidencias", $nuevo_id, $conn);
    // $id_aula= dame_un_campo("id_aula", "incidencias", $nuevo_id, $conn);
    // $id_categoria= dame_un_campo("id_categoria", "incidencias", $nuevo_id, $conn);
    // $id_subcategoria= dame_un_campo("id_subcategoria", "incidencias", $nuevo_id, $conn);  
    // $prioridad= dame_un_campo("prioridad", "incidencias", $nuevo_id, $conn);    
    // $descripcion= dame_un_campo("descrip_incidencia", "incidencias", $nuevo_id, $conn);
    // $observaciones= dame_un_campo("observaciones", "incidencias", $nuevo_id, $conn);

    $incidencia= dame_una_incidencia($nuevo_id, $conn);

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
    $descripcion= dame_un_campo("descrip_incidencia", "incidencias", $nuevo_id, $conn);
    $observaciones= dame_un_campo("observaciones", "incidencias", $nuevo_id, $conn);

    $email_responsable= dame_email("email_responsable", "configuracion", "1", $conn); //Obtengo el email del responsable de informática
    $nombre_responsable= dame_un_campo("nombre_responsable", "configuracion", "1", $conn);

    // ******************** Activar estos echos, solo para debug si los dejas activados en el ajax, vas a tener errores
    // echo "El nombre es: $nombre)";
    // echo "<p>*****************************</p>";
    // echo "El ambito es: $ambito)";
    // echo "<p>*****************************</p>";
    // echo "El aula es: $aula)";
    // echo "<p>*****************************</p>";
    // echo "El categoria es: $categoria)";
    // echo "<p>*****************************</p>";
    // echo "El subcategoria es: $subcategoria)";
    // echo "<p>*****************************</p>";
    // echo "El prioridad es: $prioridad)";
    // echo "<p>*****************************</p>";
    // echo "El descripcion es: $descripcion)";
    // echo "<p>*****************************</p>";

    // Chequeo si la incidencia tiene todos sus campos full
    if (isset($nombre) && isset($ambito) && isset($aula) && isset($categoria) && isset($subcategoria) && isset($prioridad) && isset($descripcion) ) {
        $enlace= "http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr07/php/atencion_incidencia.php?id_incidencia=".$nuevo_id;

        if ($prioridad==1){
        $prio= "ALTA";
        } elseif ($prioridad==0){
        $prio= "baja";
        } else {
        $prio= "Sin prioridad";
        }

        $asunto= 'Informar Incidencia No '.$nuevo_id;

        $mensaje= "<!DOCTYPE html>
        <html lang='es'>

        <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>       
        <style>table, td, th {border: 1px solid black;}
            table{border-collapse: collapse;}   
        </style>             
        </head>

        <body>
        <p>El solicitante ".$nombre.", acaba de informar una incidencia de ".$ambito." en ".$aula." (".$categoria."-".$subcategoria."), de prioridad ".$prio."</p> 

        <table>
            <caption>Detalles de la Incidencia</caption>
            <thead>
                <tr>
                    <th>id_incidencia</th>
                    <th>id_solicitante</th>
                    <th>id_ambito</th>
                    <th>id_aula</th>
                    <th>id_categoria</th>
                    <th>id_subcategoria</th>
                    <th>prioridad</th>
                    <th>descrip_incidencia</th>
                    <th>observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$nuevo_id."</td>
                    <td>".$id_solicitante."</td>
                    <td>".$id_ambito."</td>
                    <td>".$id_aula."</td>
                    <td>".$id_categoria."</td>
                    <td>".$id_subcategoria."</td>
                    <td>".$prioridad."</td>
                    <td>".$descripcion."</td>
                    <td>".$observaciones."</td>
                </tr>                           
            </tbody>
        </table>

        <p><a href=".$enlace.">Modificar la Incidencia</a></p>


        </body>
        </html>";

        $mensaje_plano= "El solicitante ".$nombre.", acaba de informar una incidencia de ".$ambito." en ".$aula." (".$categoria."-".$subcategoria."), de prioridad ".$prio." Para modificar la incidencia ".$enlace;

        // Envío el e-mail al responsable de informática
        $error_mail= envia_mail($asunto, $mensaje, $mensaje_plano, $email_responsable, $nombre_responsable);

        $email_ok= chequea_error_responsable_dentrode_config_mail_php($error_mail, $nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion, $observaciones);    


        // Envío el e-mail al solicitante de la incidencia
        $email_solicitante= dame_email("email_solicitante", "solicitantes", $id_solicitante, $conn); 
        // Nombre solicitante es

        // Construyo los mensajes que se le enviaran al solicitante de la incidencia
        $mensajes_solicitante= mail_creacion_incidencia_solicitante($nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion);

        
        $error_mail= envia_mail($asunto,$mensajes_solicitante['mensaje'], $mensajes_solicitante['mensaje_plano'], $email_solicitante, $nombre);

        // Chequeo si envió el e-mail correctamente
        $email_ok= chequea_error_solicitante_dentrode_config_mail_php($error_mail, $email_ok, $email_solicitante);
       

        return $email_ok;     

    } else {
        $email_ok['resultado']= 'BAD_SQL';
        $email_ok['mensaje']= 'Falta un campo de la tabla incidencias';
        return $email_ok;
    }    
}
         
function mail_creacion_incidencia_solicitante($nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion ) {
    $mensaje= "<!DOCTYPE html>
    <html lang='es'>

    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>       
    <style>table, td, th {border: 1px solid black;}
        table{border-collapse: collapse;}   
    </style>             
    </head>

    <body>
    <p>Estimado usuario ".$nombre.", acaba de informar una incidencia de ".$ambito." en ".$aula." (".$categoria."-".$subcategoria."), de prioridad ".$prio.".</p>        

    <p>La descripción de la incidencia es: ".$descripcion.".</p>

    <p>El responsable de informática la atenderá brevemente.</p>


    </body>
    </html>";

    $mensaje_plano= "El solicitante ".$nombre.", acaba de informar una incidencia de ".$ambito." en ".$aula." (".$categoria."-".$subcategoria."), de prioridad ".$prio.". El responsable de informática la atenderá brevemente ";

    return array('mensaje'=> $mensaje, 'mensaje_plano' => $mensaje_plano); 

}

function mail_atencion_incidencia_responsable($nuevo_id, $conn) {
    // Obtengo todos los ids de la incidencia
    $incidencia= dame_una_incidencia($nuevo_id, $conn);

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
    $descripcion= dame_un_campo("descrip_incidencia", "incidencias", $nuevo_id, $conn);
    $observaciones= dame_un_campo("observaciones", "incidencias", $nuevo_id, $conn);

    $email_responsable= dame_email("email_responsable", "configuracion", "1", $conn); //Obtengo el email del responsable de informática
    $nombre_responsable= dame_un_campo("nombre_responsable", "configuracion", "1", $conn);
    
    // Chequeo si la incidencia tiene todos sus campos full
    if (isset($nombre) && isset($ambito) && isset($aula) && isset($categoria) && isset($subcategoria) && isset($prioridad) && isset($descripcion) && isset($observaciones) ) {
        $enlace= "http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr07/php/resolucion_incidencia.php?id_incidencia=".$nuevo_id;

        if ($prioridad==1){
        $prio= "ALTA";
        } elseif ($prioridad==0){
        $prio= "baja";
        } else {
        $prio= "Sin prioridad";
        }
        
        $asunto= 'ATENCION Incidencia No '.$nuevo_id;

        $mensaje= "<!DOCTYPE html>
        <html lang='es'>

        <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>       
        <style>table, td, th {border: 1px solid black;}
            table{border-collapse: collapse;}   
        </style>             
        </head>

        <body>
        <p>La incidencia No.".$nuevo_id.", acaba de ser atendida por el responsable de informática <b>".$nombre_responsable."</b>, por favor proceda a resolverla lo más pronto posible</p> 

        <table>
            <caption>Detalles de la Incidencia</caption>
            <thead>
                <tr>
                    <th>id_incidencia</th>
                    <th>id_solicitante</th>
                    <th>id_ambito</th>
                    <th>id_aula</th>
                    <th>id_categoria</th>
                    <th>id_subcategoria</th>
                    <th>prioridad</th>
                    <th>descrip_incidencia</th>
                    <th>observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$nuevo_id."</td>
                    <td>".$id_solicitante."</td>
                    <td>".$id_ambito."</td>
                    <td>".$id_aula."</td>
                    <td>".$id_categoria."</td>
                    <td>".$id_subcategoria."</td>
                    <td>".$prioridad."</td>
                    <td>".$descripcion."</td>
                    <td>".$observaciones."</td>
                </tr>                           
            </tbody>
        </table>

        <p><a href=".$enlace.">Modificar la Incidencia</a></p>


        </body>
        </html>";

        $mensaje_plano= "La incidencia No.".$nuevo_id.", acaba de ser atendida por el responsable de informática".$nombre_responsable.", por favor proceda a resolverla lo más pronto posible. Para modificar la incidencia: ".$enlace; 

        // Envío el e-mail al responsable de informática
        $error_mail= envia_mail($asunto, $mensaje, $mensaje_plano, $email_responsable, $nombre_responsable);

        $email_ok= chequea_error_responsable_dentrode_config_mail_php($error_mail, $nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion, $observaciones);          


        // **** Envío el e-mail al solicitante de la incidencia
        $email_solicitante= dame_email("email_solicitante", "solicitantes", $id_solicitante, $conn);        
        
        $mensajes_solicitante= mail_atencion_incidencia_solicitante($nombre, $nuevo_id, $nombre_responsable);
        // Envío el correo

        $error_mail= envia_mail($asunto,$mensajes_solicitante['mensaje'], $mensajes_solicitante['mensaje_plano'], $email_solicitante, $nombre);   

        $email_ok= chequea_error_solicitante_dentrode_config_mail_php($error_mail, $email_ok, $email_solicitante);

        return $email_ok;     

    } else {
        $email_ok['resultado']= 'BAD_SQL';
        $email_ok['mensaje']= 'Falta un campo de la tabla incidencias';
        return $email_ok;
    }    
}

function mail_atencion_incidencia_solicitante($nombre, $nuevo_id, $nombre_responsable) {
    $mensaje= "<!DOCTYPE html>
    <html lang='es'>

    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>       
    <style>table, td, th {border: 1px solid black;}
        table{border-collapse: collapse;}   
    </style>             
    </head>

    <body>
    <p>Estimado usuario ".$nombre.", la incidencia No.".$nuevo_id.", acaba de ser atendida por el responsable de informática <b>".$nombre_responsable."</b>. Por favor espere su pronta resolución</p>   

    </body>
    </html>";

    $mensaje_plano= "Estimado usuario ".$nombre.", la incidencia No.".$nuevo_id.", acaba de ser atendida por el responsable de informática ".$nombre_responsable.". Por favor espere su pronta resolución";

    return array('mensaje'=> $mensaje, 'mensaje_plano' => $mensaje_plano); 

}

function mail_resolucion_incidencia_responsable($nuevo_id, $conn) {
    // Obtengo todos los ids de la incidencia
    $incidencia= dame_una_incidencia($nuevo_id, $conn);

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
    $descripcion= dame_un_campo("descrip_incidencia", "incidencias", $nuevo_id, $conn);
    $observaciones= dame_un_campo("observaciones", "incidencias", $nuevo_id, $conn);

    $email_responsable= dame_email("email_responsable", "configuracion", "1", $conn); //Obtengo el email del responsable de informática
    $nombre_responsable= dame_un_campo("nombre_responsable", "configuracion", "1", $conn);
    
    // Chequeo si la incidencia tiene todos sus campos full
    if (isset($nombre) && isset($ambito) && isset($aula) && isset($categoria) && isset($subcategoria) && isset($prioridad) && isset($descripcion) && isset($observaciones) ) {
        $enlace= "http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr07/php/resolucion_incidencia.php?id_incidencia=".$nuevo_id;

        if ($prioridad==1){
        $prio= "ALTA";
        } elseif ($prioridad==0){
        $prio= "baja";
        } else {
        $prio= "Sin prioridad";
        }
        
        $asunto= 'RESOLUCIÓN Incidencia No '.$nuevo_id;

        $mensaje= "<!DOCTYPE html>
        <html lang='es'>

        <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>       
        <style>table, td, th {border: 1px solid black;}
            table{border-collapse: collapse;}   
        </style>             
        </head>

        <body>
        <p>La incidencia No.".$nuevo_id.", acaba de ser resulta por el responsable de informática <b>".$nombre_responsable."</b></p> 

        <p>Descripción Incidencia: ".$descripcion."</p>

        <p>Observaciones:".$observaciones."</p>

        <table>
            <caption>Detalles de la Incidencia</caption>
            <thead>
                <tr>
                    <th>id_incidencia</th>
                    <th>id_solicitante</th>
                    <th>id_ambito</th>
                    <th>id_aula</th>
                    <th>id_categoria</th>
                    <th>id_subcategoria</th>
                    <th>prioridad</th>
                    <th>descrip_incidencia</th>
                    <th>observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$nuevo_id."</td>
                    <td>".$id_solicitante."</td>
                    <td>".$id_ambito."</td>
                    <td>".$id_aula."</td>
                    <td>".$id_categoria."</td>
                    <td>".$id_subcategoria."</td>
                    <td>".$prioridad."</td>
                    <td>".$descripcion."</td>
                    <td>".$observaciones."</td>
                </tr>                           
            </tbody>
        </table>

        <p><a href=".$enlace.">Modificar la Incidencia</a></p>

        </body>
        </html>";


        $mensaje_plano= "La incidencia No.".$nuevo_id.", acaba de ser resulta por el responsable de informática".$nombre_responsable."\n
        Descripción Incidencia: ".$descripcion."\n
        Observaciones:".$observaciones."\n
        Para modificar la incidencia: ".$enlace;
       
        // Envío el e-mail al responsable de informática
        $error_mail= envia_mail($asunto, $mensaje, $mensaje_plano, $email_responsable, $nombre_responsable);

        $email_ok= chequea_error_responsable_dentrode_config_mail_php($error_mail, $nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion, $observaciones);  
        
        // **** Envío el e-mail al solicitante de la incidencia
        $email_solicitante= dame_email("email_solicitante", "solicitantes", $id_solicitante, $conn);        
        
        $mensajes_solicitante= mail_resolucion_incidencia_solicitante($nombre, $nuevo_id, $nombre_responsable, $descripcion, $observaciones);
        // Envío el correo

        $error_mail= envia_mail($asunto,$mensajes_solicitante['mensaje'], $mensajes_solicitante['mensaje_plano'], $email_solicitante, $nombre);   

        $email_ok= chequea_error_solicitante_dentrode_config_mail_php($error_mail, $email_ok, $email_solicitante);

        return $email_ok;     

    } else {
        $email_ok['resultado']= 'BAD_SQL';
        $email_ok['mensaje']= 'Falta un campo de la tabla incidencias';
        return $email_ok;
    }    
}

function mail_resolucion_incidencia_solicitante($nombre, $nuevo_id, $nombre_responsable, $descripcion, $observaciones) {
    $mensaje= "<!DOCTYPE html>
    <html lang='es'>

    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>       
    <style>table, td, th {border: 1px solid black;}
        table{border-collapse: collapse;}   
    </style>             
    </head>

    <body>
    <p>Estimado usuario ".$nombre.", la incidencia No.".$nuevo_id.", acaba de ser resulta por el responsable de informática <b>".$nombre_responsable."</b>.</p> 

    <p>Descripción Incidencia: ".$descripcion."</p>

    <p>Observaciones:".$observaciones."</p>

    <p>Gracias por utilizar nuestros servicios!!</p>

    </body>
    </html>";

    $mensaje_plano= "Estimado usuario ".$nombre.", la incidencia No.".$nuevo_id.", acaba de ser resulta por el responsable de informática".$nombre_responsable."\n
    Descripción Incidencia: ".$descripcion."\n
    Observaciones:".$observaciones."\n";

    return array('mensaje'=> $mensaje, 'mensaje_plano' => $mensaje_plano); 

}

function chequea_error_responsable_dentrode_config_mail_php($error_mail, $nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion, $observaciones){
    # Esta función coge el error de la función que envía la función envia_mail y construye un arreglo $email_ok que servirá para darle los el estatus del envío del correo al responsable de informática.

    // Chequeo si envió el e-mail correctamente
    if ($error_mail['resultado']==='BIEN'){
        $email_ok= array('resultado' => array('responsable' => 'BIEN'),
                    'mensaje'=> array('responsable' => 'Se envió correctamente el e-mail al responsable de informática'),
                    'solicitante'=>$nombre,
                    'ambito'=>$ambito,
                    'aula'=>$aula,
                    'categoria'=>$categoria,
                    'sub_cat'=>$subcategoria,
                    'prioridad'=>$prio,
                    'incidencia'=>$descripcion,
                    'observaciones'=>$observaciones);
    } else {
        $email_ok= array('resultado' => array('responsable' => 'MAL'),
                    'mensaje'=> array('responsable' => 'No se pudo enviar el e-mail al responsable de informática'.$error_mail['mensaje']) );
    }

    return $email_ok;
}

function chequea_error_solicitante_dentrode_config_mail_php($error_mail, $email_ok, $email_solicitante){
    // Chequeo si envió el e-mail correctamente
    if ($error_mail['resultado']==='BIEN'){
        $email_ok['resultado']['solicitante']= 'BIEN';
        $email_ok['mensaje']['solicitante']= 'Se envió correctamente el e-mail al solicitante de la incidencia';
        $email_ok['email_solcitante']= $email_solicitante;        
    } else {
        $email_ok['resultado']['solicitante']= 'MAL';
        $email_ok['mensaje']['solicitante']= 'No se pudo enviar el e-mail al solicitante de la incidencia'.$error_mail['mensaje'];            
    }

    return $email_ok; 
} 

function chequeo_error_index_resolucion($error_email, $no_incidencia, $observaciones, $conn ){
    /*
    Esta función genera unos elementos div que estan "hidden" para luego el javascript diga el estado del procesamiento de la incidencia y del envío del correo
    */

    if (isset($error_email['resultado'])){
        // Envío el email de notificación al responsable de informática y al solicitante de la incidencia

        if ($error_email['resultado']['responsable']==='BIEN'){
            if ($error_email['resultado']['solicitante']==='BIEN') {
                // **** Seguir haciendo el sistema de error acomodar las comillas en los campos de $error_email
                echo '<div id="controlador" hidden>2</div>                
                        <div id="cont_mensaje" hidden>Incidencia procesada y email enviado al responsable de informática y al solicitante de la incidencia</div>
                        <div id="cont_no_incidencia" hidden>'.$no_incidencia.'</div>
                        <div id="cont_nombre" hidden>'.$error_email['solicitante'].'</div>
                        <div id="cont_email_solicitante" hidden>'.$error_email['email_solcitante'].'</div>
                        <div id="cont_ambito" hidden>'.$error_email['ambito'].'</div>
                        <div id="cont_aula" hidden>'.$error_email['aula'].'</div>
                        <div id="cont_categoria" hidden>'.$error_email['categoria'].'</div>
                        <div id="cont_subcategoria" hidden>'.$error_email['sub_cat'].'</div> 
                        <div id="cont_prio" hidden>'.$error_email['prioridad'].'</div>
                        <div id="cont_accion" hidden>resolucion</div>
                        <div id="cont_descripcion" hidden>'.$error_email['incidencia'].'</div> 
                <div id="cont_observaciones" hidden>'.$observaciones.'</div> ';

            } else {
                echo '<div id="controlador" hidden>3</div>
                <div id="cont_mensaje" hidden>Incidencia procesada y email enviado al responsable de informático pero NO al solicitante de la incidencia</div>';                             
            }
        } elseif ($error_email['resultado']['responsable']==='MAL') {
            if ($error_email['resultado']['solicitante']==='BIEN') {
                echo '<div id="controlador" hidden>4</div>
                <div id="cont_mensaje" hidden>Incidencia procesada y email enviado al solicitante de la incidencia, pero NO al responsable de informática</div>';  
            } else {
                echo '<div id="controlador" hidden>5</div>
                <div id="cont_mensaje" hidden>Incidencia procesada, pero no se pudo enviar el email ni al responsable de informática ni al solicitante de la incidencia</div>'; 
            } 
        } elseif ($error_email['resultado']==='BAD_SQL'){
            echo '<div id="controlador" hidden>6</div>
            <div id="cont_mensaje" hidden>Incidencia procesada, pero no se envió el email porque a la tabla incidencia le faltan campos</div>'; 
        } else {
            echo '<div id="controlador" hidden>7</div>
            <div id="cont_mensaje" hidden>Incidencia procesada, y esta es la notificación que viene después de BAD_SQL</div>'; 
        }

    } else {
        echo '<div id="controlador" hidden>8</div>
        <div id="cont_mensaje" hidden>Incidencia procesada, pero no se evió el mail porque la función de envío de e-mail no respondió</div>'; 
    }   
}  

function chequeo_error_index_atencion($error_email, $no_incidencia, $observaciones, $conn ){
    /*
    Esta función genera unos elementos div que estan "hidden" para luego el javascript diga el estado del procesamiento de la incidencia y del envío del correo
    */
    if (isset($error_email['resultado'])){
        // Envío el email de notificación al responsable de informática y al solicitante de la incidencia

        if ($error_email['resultado']['responsable']==='BIEN'){
            if ($error_email['resultado']['solicitante']==='BIEN') {
                // **** Seguir haciendo el sistema de error acomodar las comillas en los campos de $error_email
                echo '<div id="controlador" hidden>2</div>
                        <div id="cont_mensaje" hidden>Incidencia procesada y email enviado al responsable de informática y al solicitante de la incidencia</div>
                        <div id="cont_no_incidencia" hidden>'.$no_incidencia.'</div>
                        <div id="cont_nombre" hidden>'.$error_email['solicitante'].'</div>
                        <div id="cont_email_solicitante" hidden>'.$error_email['email_solcitante'].'</div>
                        <div id="cont_ambito" hidden>'.$error_email['ambito'].'</div>
                        <div id="cont_aula" hidden>'.$error_email['aula'].'</div>
                        <div id="cont_categoria" hidden>'.$error_email['categoria'].'</div>
                        <div id="cont_subcategoria" hidden>'.$error_email['sub_cat'].'</div> 
                        <div id="cont_prio" hidden>'.$error_email['prioridad'].'</div>
                        <div id="cont_accion" hidden>atencion</div>
                        <div id="cont_descripcion" hidden>'.$error_email['incidencia'].'</div> 
                <div id="cont_observaciones" hidden>'.$observaciones.'</div> ';

            } else {
                echo '<div id="controlador" hidden>3</div>
                <div id="cont_mensaje" hidden>Incidencia procesada y email enviado al responsable de informático pero NO al solicitante de la incidencia</div>';                             
            }
        } elseif ($error_email['resultado']['responsable']==='MAL') {
            if ($error_email['resultado']['solicitante']==='BIEN') {
                echo '<div id="controlador" hidden>4</div>
                <div id="cont_mensaje" hidden>Incidencia procesada y email enviado al solicitante de la incidencia, pero NO al responsable de informática</div>';  
            } else {
                echo '<div id="controlador" hidden>5</div>
                <div id="cont_mensaje" hidden>Incidencia procesada, pero no se pudo enviar el email ni al responsable de informática ni al solicitante de la incidencia</div>'; 
            } 
        } elseif ($error_email['resultado']==='BAD_SQL'){
            echo '<div id="controlador" hidden>6</div>
            <div id="cont_mensaje" hidden>Incidencia procesada, pero no se envió el email porque a la tabla incidencia le faltan campos</div>'; 
        } else {
            echo '<div id="controlador" hidden>7</div>
            <div id="cont_mensaje" hidden>Incidencia procesada, y esta es la notificación que viene después de BAD_SQL</div>'; 
        }

    } else {
        echo '<div id="controlador" hidden>8</div>
        <div id="cont_mensaje" hidden>Incidencia procesada, pero no se evió el mail porque la función de envío de e-mail no respondió</div>'; 
    }   
} 

function prueba_demail(){
    $texto= "Hola Juan estoy funcionando";
    return $texto;
}

   
?>