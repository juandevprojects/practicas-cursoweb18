<?php
// include_once 'config_mail.php'; icluir en el archivo que se desee usar este archivo
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include_once '../../../../conexion.php'; // Agrego todas las credenciales de la base de datos
include_once 'funciones.php';


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


function mail_atencion_responsable($nuevo_id, $conn ) {
    
    // De acuerdo al número de incidencia, solicito todos los id de cada campo de la incidencia
    // Esto se puede mejorar, haciendo una sola query que te dé tódo en un solo arreglo, pero porqcuestiones de tiempo no lo haré
    $id_nombre= dame_un_campo("id_solicitante", "incidencias", $nuevo_id, $conn);
    $id_ambito= dame_un_campo("id_ambito", "incidencias", $nuevo_id, $conn);
    $id_aula= dame_un_campo("id_aula", "incidencias", $nuevo_id, $conn);
    $id_categoria= dame_un_campo("id_categoria", "incidencias", $nuevo_id, $conn);
    $id_subcategoria= dame_un_campo("id_subcategoria", "incidencias", $nuevo_id, $conn);  
    $prioridad= dame_un_campo("prioridad", "incidencias", $nuevo_id, $conn);    
    $descripcion= dame_un_campo("descrip_incidencia", "incidencias", $nuevo_id, $conn);
    $observaciones= dame_un_campo("observaciones", "incidencias", $nuevo_id, $conn);

    // Después de obtener los id's de todos los campos de la incidencia busco sus nombre para escribir el correo
    $nombre= dame_un_campo("nombre_solicitante", "solicitantes", $id_nombre, $conn);
    $ambito= dame_un_campo("ambito", "ambitos", $id_ambito, $conn);
    $aula= dame_un_campo("aula", "aulas", $id_aula, $conn);
    $categoria= dame_un_campo("categoria", "categorias", $id_categoria, $conn);
    $subcategoria= dame_un_campo("sub_categoria", "sub_categorias", $id_subcategoria, $conn);

    $email_responsable= dame_email("email_responsable", "configuracion", "1", $conn); //Obtengo el email del responsable de informática
    $nombre_responsable= dame_un_campo("nombre_responsable", "configuracion", "1", $conn);

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
                    <td>".$id_nombre."</td>
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
                         'incidencia'=>$descripcion);
        } else {
             $email_ok= array('resultado' => array('responsable' => 'MAL'),
                         'mensaje'=> array('responsable' => 'No se pudo enviar el e-mail al responsable de informática'.$error_mail['mensaje']) );
        }


        // Envío el e-mail al solicitante de la incidencia
        $email_solicitante= dame_email("email_solicitante", "solicitantes", $id_nombre, $conn); 
        // Nombre solicitante es

        // Construyo los mensajes que se le enviaran al solicitante de la incidencia
        $mensajes_solicitante= mail_atencion_solicitante($nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion);

        
        $error_mail= envia_mail($asunto,$mensajes_solicitante['mensaje'], $mensajes_solicitante['mensaje_plano'], $email_solicitante, $nombre);
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

    } else {
        $email_ok['resultado']= 'BAD_SQL';
        $email_ok['mensaje']= 'Falta un campo de la tabla incidencias';
        return $email_ok;
    }    
}
         
function mail_atencion_solicitante($nombre, $ambito, $aula, $categoria, $subcategoria, $prio, $descripcion ) {
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



   
?>