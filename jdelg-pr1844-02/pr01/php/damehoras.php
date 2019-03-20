<?php
    $texto=null;
    if ((isset($_POST['chequeo'])) and ($_POST['chequeo'] == 'meloinvento33')){
        echo json_encode(array('0'=>'9:00 - 10:00','1'=>'10:00 - 11:00','2'=>'11:00 - 12:00','3'=>'12:00 - 13:00'));
    }else{
        echo json_encode(array('algo'=>$texto));
    }

?>