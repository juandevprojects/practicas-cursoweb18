<?php
$str = strtolower($_POST['fnombre']);

// $str = strtolower("juan");
// var_dump($str);

if ($str === "") {
    echo json_encode("SN"); // SN = sin nombre
} elseif ( ($str[0] === 'j') or ($str[0] === 'a') )  {
    echo json_encode("BIEN");
} else {
    echo json_encode("MAL");
}


?>