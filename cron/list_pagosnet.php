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
	$fechadiaAntes = date('Y-m-j',$calcularFecha);

	if(date('d') == '01'){
		$fechaPrimerDia = date('Y').'-'.date("m",strtotime($fecha."- 1 month")).'-26'; 
	}else{
		$fechaPrimerDia = date('Y').'-'.date("m").'-26';
	}

	$fechaPrimerDia = '2018-06-01';
	$fechaDiaAntes = '2018-06-30';

	$obj->loadDataReport($fechaPrimerDia,$fechaDiaAntes);

//resto 1 mes
//date("m",strtotime($fecha."- 1 month"));
