<?php
$nombre=$_POST['nombre'];
$direccion=$_POST['direccion'];
$hora=$_POST['hora'];
switch ($hora) {
    case "0":
        $horas = '09:00 - 10:00';
        break;
    case "1":
        $horas = '10:00 - 11:00';
        break;
    case "2":
        $horas = '11:00 - 12:00';
        break;
    case "3":
        $horas = '12:00 - 13:00';
        break;
    default:
        $horas = 'No se sabe';
}

if (isset($_POST['observaciones'])){
    $observaciones=$_POST['observaciones'];
} else{
    $observaciones='';
}
echo json_encode(array('nombre'=>$nombre,'direccion'=>$direccion,'hora'=>$horas,'observaciones'=>$observaciones));
// echo json_encode(array('0'=>$nombre,'1'=>$direccion,'2'=>'11:00 - 12:00','3'=>'12:00 - 13:00'));
?>