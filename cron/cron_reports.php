<?php
    //Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);
	
    date_default_timezone_set('America/La_Paz');
    
    require_once 'classes/Sql.class.php';

    $obj = new Sql();	
    
    $fecha = date('Y-m-j');

    $calcularFecha5 = strtotime('-5 day',strtotime($fecha));
    $fechaAntes5 = date('Y-m-j',$calcularFecha5);
    $fechaHasta = date('Y-m-d');

    if(date('d') == '02' || date('d') == '03' || date('d') == '04' || date('d') == '05'){ 
        
        $fechaDesde = date('Y').'-'.date("m").'-01'; 
    
    }else{
        $fechaDesde = $fechaAntes5;
      
    }

    $obj->importData($fechaDesde, $fechaHasta); 
    //resto 1 mes
    //date("m",strtotime($fecha."- 1 month"));

?>