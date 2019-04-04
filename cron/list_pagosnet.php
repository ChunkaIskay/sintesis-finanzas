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
	$obj->loadDataReport($fechaDesde,$fechaHasta);
	//resto 1 mes
	//date("m",strtotime($fecha."- 1 month"));