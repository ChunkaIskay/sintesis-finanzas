<?php

 	//Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);

    date_default_timezone_set('America/La_Paz');

	require_once 'classes/ListCommerce.class.php';
 
	$obj= new ListCommerce();

	// Guardar listado de nombres y sus id de empresa, se ejecuta una sola vez. 
	//$obj->restComercios();

	$fecha = date('Y-m-j');
	
	$calcularFecha = strtotime('-1 day',strtotime($fecha));
	$fechaDesde = date('Y-m-d',$calcularFecha);
	$fechaHasta = date('Y-m-d',strtotime($fecha));

	$fechaDesde = first_month_day();
	$fechaHasta = last_month_day();

	//$obj->loadDataReport($fechaDesde, $fechaHasta);
	$obj->loadDataReport('2019-05-01', '2019-05-31');

	function last_month_day() { 
	  $month = date('m');
	  $year = date('Y');
	  $day = date("d", mktime(0,0,0, $month, 0, $year));
	  return date('Y-m-d', mktime(0,0,0, $month-1, $day, $year));
	}

	function first_month_day() {
	  $month = date('m');
	  $year = date('Y');
	  return date('Y-m-d', mktime(0,0,0, $month-1, 1, $year));
	}
