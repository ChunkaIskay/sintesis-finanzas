<?php
    //Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);
	
    date_default_timezone_set('America/La_Paz');
    
    require_once 'classes/Sql.class.php';

    $obj = new Sql();	
    
    $fecha = date('Y-m-j');
    $fecha = date('Y-m-j');
    
    $calcularFecha = strtotime('-1 day',strtotime($fecha));
    $fechaDesde = date('Y-m-d',$calcularFecha);
    $fechaHasta = date('Y-m-d',strtotime($fecha));
$fechaDesde = '2019-07-01';
$fechaHasta = '2019-07-16';
    $obj->importData($fechaDesde, $fechaHasta); 

?>