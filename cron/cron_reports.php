<?php
    //Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);
	
    date_default_timezone_set('America/La_Paz');
    
    require_once 'classes/Sql.class.php';

    $obj = new Sql();	
    
    $fecha = date('Y-m-j');
    $calcularFecha = strtotime('-1 day',strtotime($fecha));
    $fechaAntes = date('Y-m-j',$calcularFecha);
    $fechaPrimerDia = date('Y').'-'.date('m').'-26';
 
    echo "Importando datos:";
    $obj->importData($fechaPrimerDia, $fechaAntes);
 
    	
?>