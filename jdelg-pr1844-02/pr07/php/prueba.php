<?php
date_default_timezone_set('UTC');
$variable= " Esta es la fecha";
$uno= date(DATE_RFC2822).$variable;
echo $uno;

?>