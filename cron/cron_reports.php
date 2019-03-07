<?php
    //Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);
	echo "Importando datos:"; 

	require_once 'classes/Sql.class.php';


    $obj = new Sql();	
    $obj->pruebas();
	//date_default_timezone_set('America/Argentina/Buenos_Aires');
	
?>