<?php
    //Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);
  	//require_once '/svpn/www/htdocs/reports/classes/Setup.class.php';
	//require_once '/svpn/www/htdocs/reports/classes/Sql.class.php';
	//require_once '/classes/Setup.class.php';
	echo "hola"; 

	require_once 'classes/Sql.class.php';

    $obj = new Sql();	
    $obj->__contruct();
    $obj->pruebas();

exit;
        //usuario 
	$user = "u185305";
	$obj->iusuario = $user;
	
	//obtengo parametros de la sentencia de ejecucion de svpnCron
	$args = $_SERVER['argv'];
        
        
	$strName = $args[1];
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	
    switch($strName)
	{
		case 'cron_latency_single':			
			$daysPeriod = $args[2];
			$strSearch = $args[3];
			$strFrom = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - $daysPeriod, date("Y")));
                        $strUntil = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - ($daysPeriod - 1), date("Y")));
			$oListFullReport = $obj->reportLatencySingle($strFrom, $strUntil, "Reporte", $strSearch, 0, 0, true);
			$date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - $daysPeriod, date("Y")));
			// $filePath = '/svpn/interfaz/reports/latencia/';
			$filePath = '/svpn/interfaz/reports/';
			break;
	}

?>