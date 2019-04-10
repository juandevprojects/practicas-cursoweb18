<?php 
// // *********** Prueba con la función prueba_demail
// include_once '../php/config_mail.php'; // Agrego todas las funciones para enviar email
// echo "Prueba con la función prueba_demail";
// $cadena= prueba_demail();
// echo $cadena;

// // *************Prueba con la función mail_creacion_incidencia_responsable
// include_once '../../../../conexion.php'; // Agrego todas las credenciales de la base de datos
// include_once '../php/config_mail.php'; // Agrego todas las funciones para enviar email
// // include_once 'funciones.php'; // Agrego funciones varias
// echo "Prueba con la función mail_creacion_incidencia_responsable";

// //   # Me conecto a la base de datos utilizando el conector para mysql mysqli_connect
// $conn = mysqli_connect($host, $usuario, $clave, $db);                                        
// mysqli_set_charset($conn,"utf8"); // Establezco el juego de caracteres de la base de datos
// echo "<p>Conexión a Base de Datos establecida</p>";

// $error_email= mail_creacion_incidencia_responsable("96", $conn ); // Revisar esta función porque me está fallando bello

// echo "<p>**********</p>";
// print_r($error_email);

#Cierro la conexión
mysqli_close($conn);  
echo "<p>Cierro la conexión</p>";


#Cierro la conexión
mysqli_close($conn);  
echo "<p>Cierro la conexión</p>";

#Cierro la conexión
mysqli_close($conn);  
echo "<p>Cierro la conexión</p>";

#Cierro la conexión
mysqli_close($conn);  
echo "<p>Cierro la conexión</p>";
#Cierro la conexión
mysqli_close($conn);  
echo "<p>Cierro la conexión</p>";
#Cierro la conexión
mysqli_close($conn);  
echo "<p>Cierro la conexión</p>";


// echo $mailusername;
// echo "<p>**********</p>";
// echo $mailpassw;
// echo "<p>**********</p>";
// echo "Prueba de funciones del e-mail";
// echo "<p>**********</p>";
// $conn = mysqli_connect($host, $usuario, $clave, $db); 


// $incidencia= dame_una_incidencia("69", $conn);


// print_r($incidencia);
// echo "<p>**********</p>";
// echo $incidencia['id_ambito'];









// if (mysqli_connect_errno()) {
//     echo json_encode( array("No pudo conectarse a la base de datos"));
// } else {
//   $error_mail=mail_creacion_incidencia_responsable("29", $conn) ;

//   print_r($error_mail['resultado']);
//   echo "<p>****************************</p>";
//   print_r($error_mail['mensaje']);
//   echo "<p>****************************</p>";    
// }


// $otra= array('mensaje'=> 'Esto es otra otra otra ');

// $email_ok= array('resultado' => array('responsable' => 'BIEN'), 'mensaje'=> array('responsable' => 'Se envió correctamente el e-mail al responsable de informática'.$otra['mensaje']));
// print_r($email_ok);

// echo "<p></p>";

// $email_ok['resultado']['solicitante']= 'BIEN'; $email_ok['mensaje']['solicitante']= 'Se envió correctamente el e-mail al solicitante de la incidencia'.$otra['mensaje'];
// print_r($email_ok);

// echo "<p></p>";
// print_r($email_ok['resultado']);

// echo "<p></p>";
// print_r($email_ok['mensaje']);

// echo "<p></p>";
// print_r($email_ok['resultado']['solicitante']);

// echo "<p></p>";
// print_r($email_ok['mensaje']['solicitante']);


//*************Para ver como filtra la inyección de código */
// $conn = mysqli_connect($host, $usuario, $clave, $db);
// $fincidencia= "<h1>Hola que tal</h1>";
// echo $fincidencia."</br>";
// $fincidencia= filtrar_formulario($fincidencia, $conn); // filtro la entrada del formulario textarea para que no me rompan el código.
// echo $fincidencia."</br>";
// var_dump($fincidencia);


?>