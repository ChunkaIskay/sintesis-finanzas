<?php

 	//Memoria maxima de ejecucion
  	ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);

    date_default_timezone_set('America/La_Paz');

	require_once 'classes/ListEntities.class.php';


	$obj= new ListEntities();

	// Guardar listado de nombres de las entidades, se ejecuta una sola vez. 
	// $obj->restEntities();

	$fecha = date('Y-m-j');
	
	$calcularFecha = strtotime('-1 day',strtotime($fecha));
	$fechaDesde = date('Y-m-d',$calcularFecha);
	$fechaHasta = date('Y-m-d',strtotime($fecha));
	//$obj->loadDataReport($fechaDesde, $fechaHasta);
	$obj->loadDataReport('2019-04-01', '2019-04-30');
	//resto 1 mes
	//date("m",strtotime($fecha."- 1 month"));