<?php
/**
 *
 * Devices class
 * @package SVPN
 * @author jacinto Alex Olazo Mollo alexo@sintesis.com.bo
 *         (consulta (sql) desarrollado por el Area de Operaciones)
 * @modified by
 * @date 2019-02-28
 */

require_once 'Setup.class.php';

class Sql extends Setup
{
  
    public function __contruct(){
         
    }
    
    public function importData($fecha, $fecha1){
        
        try
        {     
            $obj = new Setup();
            $conectDB = $obj->conectDataB(1);
            $conectDB2 = $obj->conectDataB(2);
            
            $rs1 = array();

          for ($opcion=3;$opcion<=125; $opcion++)
           {
                if( $opcion<>5
                &&$opcion<>6
                &&$opcion<>8
                &&$opcion<>9
                &&$opcion<>10
                &&$opcion<>11
                &&$opcion<>14
                &&$opcion<>15
                &&$opcion<>16
                &&$opcion<>18
                &&$opcion<>19
                &&$opcion<>20
                &&$opcion<>22
                &&$opcion<>23
                &&$opcion<>24
                &&$opcion<>25
                &&$opcion<>26
                &&$opcion<>27
                &&$opcion<>28
                &&$opcion<>30
                &&$opcion<>31
                &&$opcion<>32
                &&$opcion<>33
                &&$opcion<>36
                &&$opcion<>37
                &&$opcion<>38
                &&$opcion<>39
                &&$opcion<>42
                &&$opcion<>45
                &&$opcion<>46
                &&$opcion<>47
                &&$opcion<>49
                &&$opcion<>55
                &&$opcion<>61
                &&$opcion<>63
                &&$opcion<>64
                &&$opcion<>65
                &&$opcion<>75
                &&$opcion<>81
                &&$opcion<>82
                &&$opcion<>86
                &&$opcion<>89
                &&$opcion<>90
                &&$opcion<>92
                &&$opcion<>96
                &&$opcion<>98
                &&$opcion<>99
                &&$opcion<>100
                &&$opcion<>101
                &&$opcion<>103
                &&$opcion<>105
                &&$opcion<>110
                &&$opcion<>111
                &&$opcion<>112
                &&$opcion<>113
                &&$opcion<>114
                &&$opcion<>115
                &&$opcion<>119
                &&$opcion<>120
                &&$opcion<>123
                &&$opcion<>124
                &&$opcion<>125 ){
                if ($opcion=="3")
                {
                 $cliente="mov_telecel";
                 $cli="TELECEL";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="4")
                {
                 $cliente="mov_prevision";
                 $cli="PREVISION";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="7")
                {
                 $cliente="mov_nuevatel";
                 $cli="NUEVATEL";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="12")
                {
                 $cliente="mov_multivision";
                 $cli="MULTIVISION";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="13")
                {
                 $cliente="mov_policia";
                 $cli="POLICIA";
                 $estado="origen2='PAEF'";
                 $estado1="origen2='REEF'";
                }
                if ($opcion=="17")
                {
                 $cliente="mov_avon";
                 $cli="AVON";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="21")
                {
                 $cliente="mov_futuro";
                 $cli="FUTURO";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="29")
                {
                 $cliente="mov_rentdig";
                 $cli="RENTA DIGNIDAD";
                 $estado="estado='P'";
                 $estado1="estado='R'";
                }
                if ($opcion=="34")
                {
                $cliente="mov_axs";
                $cli="AXS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="35")
                {
                $cliente="mov_its";
                $cli="ITS";
                $estado="transaccion='I'";
                $estado1="transaccion='E'";
                }
                if ($opcion=="40")
                {
                $cliente="mov_kantutani";
                $cli="KANTUTANI";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="41")
                {
                $cliente="mov_setar";
                $cli="SETAR";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="41")
                {
                $cliente="mov_setar";
                $cli="SETAR";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="43")
                {
                $cliente="mov_dtv";
                $cli="DIGITAL TV";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="44")
                {
                $cliente="mov_lbc";
                $cli="LBC";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="48")
                {
                $cliente="mov_epsas";
                $cli="EPSAS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="50")
                {
                 $cliente="mov_bja";
                 $cli="BONOS";
                 $estado="estado='P'";
                 $estado1="estado='R'";
                }
                if ($opcion=="51")
                {
                  $cliente="mov_bja";
                  $cli="BONOS";
                  $estado="estado='P'";
                  $estado1="estado='R'";
                }
                if ($opcion=="52")
                {
                  $cliente="mov_bja";
                  $cli="BONOS";
                  $estado="estado='P'";
                  $estado1="estado='R'";
                }
                if ($opcion=="53")
                {
                  $cliente="mov_bja";
                  $cli="BONOS";
                  $estado="estado='P'";
                  $estado1="estado='R'";
                }
                if ($opcion=="57")
                {
                  $cliente="mov_bja";
                  $cli="BONOS";
                  $estado="estado='P'";
                  $estado1="estado='R'";
                }
               if ($opcion=="54")
                {
                $cliente="mov_cinecenter";
                $cli="CINE CENTER";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="56")
                {
                $cliente="mov_bisaseguros";
                $cli="BISA-SEGUROS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="58")
                {
                $cliente="mov_umsa";
                $cli="UMSA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="59")
                {
                $cliente="mov_uagrm";
                $cli="UAGRM";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="60")
                {
                $cliente="mov_transbel";
                $cli="TRANSBEL";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="62")
                {
                $cliente="mov_uab";
                $cli="UAB";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="66")
                {
                $cliente="mov_yanbal";
                $cli="YANBAL";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="67")
                {
                $cliente="mov_megadealers";
                $cli="MEGADEALERS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="68")
                {
                $cliente="mov_pagosnet";
                $cli="PAGOSNET";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="69")
                {
                $cliente="mov_grupones";
                $cli="GRUPONES";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="70")
                {
                $cliente="mov_tuves";
                $cli="TUVES";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="71")
                {
                $cliente="mov_ypfb";
                $cli="YPFB";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="72")
                {
                $cliente="mov_natura";
                $cli="NATURA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="73")
                {
                $cliente="mov_guaracachi";
                $cli="CESAM";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="74")
                {
                $cliente="mov_tsm";
                $cli="SUP. TIA";
                $estado="origen2 like 'CMP%'";
                $estado1="origen2 like 'REP%'";
                }
                if ($opcion=="76")
                {
                $cliente="mov_tupperware";
                $cli="TUPPERWARE";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="77")
                {
                $cliente="mov_navi";
                $cli="NALVIDA";
                $estado="estado='H'";
                $estado1="estado='D'";
                }
                if ($opcion=="78")
                {
                $cliente="mov_bbr";
                $cli="BBR";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="79")
                {
                $cliente="mov_bbr";
                $cli="BBR";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
               if ($opcion=="80")
                {
                $cliente="mov_segip";
                $cli="SEGIP";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="83")
                {
                $cliente="mov_mempark";
                $cli="MEMPARK";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="84")
                {
                $cliente="mov_alianzaseguros";
                $cli="ALIANZA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="85")
                {
                $cliente="mov_egpp";
                $cli="EGPP";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="87")
                {
                $cliente="mov_dnsb";
                $cli="DNSB";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="88")
                {
                $cliente="mov_bdp";
                $cli="BDP";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="91")
                {
                $cliente="mov_emi";
                $cli="EMI";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="93")
                {
                $cliente="mov_boliviatel";
                $cli="BOLIVIATEL";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
               if ($opcion=="94")
                {
                $cliente="mov_soat";
                $cli="SOAT";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="95")
                {
                $cliente="mov_semapa";
                $cli="SEMAPA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="97")
                {
                $cliente="mov_vias";
                $cli="VIAS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="102")
                {
                $cliente="mov_novillo";
                $cli="NOVILLO";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="104")
                {
                $cliente="mov_credinform";
                $cli="CREDINFORM";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="106")
                {
                $cliente="mov_fortaleza";
                $cli="FORTALEZA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="107")
                {
                 $cliente="mov_vitalicia";
                 $cli="LA VITALICIA";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
               if ($opcion=="108")
                {
                 $cliente="mov_segip2";
                 $cli="SEGIP2";
                 $estado="transaccion='H'";
                 $estado1="transaccion='D'";
                }
                if ($opcion=="109")
                {
                $cliente="mov_amaszonas";
                $cli="AMASZONAS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="116")
                {
                $cliente="mov_cessa";
                $cli="CESSA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="117")
                {
                $cliente="mov_gamcb";
                $cli="GAMCB";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="118")
                {
                $cliente="mov_univida";
                $cli="UNIVIDA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="121")
                {
                $cliente="mov_itacamba";
                $cli="ITACAMBA";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if ($opcion=="122")
                {
                $cliente="mov_bisaseg";
                $cli="BISA SEGUROS COBROS";
                $estado="transaccion='H'";
                $estado1="transaccion='D'";
                }
                if($opcion=="50")
                 {
                    $rs = $this->option50($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                if($opcion=="51")
                 {
                    $rs = $this->option51($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                if($opcion=="52")
                 {
                    $rs = $this->option52($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                 if($opcion=="53")
                 {
                    $rs = $this->option53($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                 if($opcion=="54")
                 {
                     $rs = $this->option54($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                 if($opcion=="67")
                 {
                     $rs = $this->option67($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                if($opcion=="68" )
                 {
                    $rs = $this->option68($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                 if($opcion=="78")
                 {  
                    $rs = $this->option78($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                if($opcion=="79")
                 {
                    $rs = $this->option79($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                 if($opcion=="102" )
                 {
                    $rs = $this->option102($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                 }
                 if($opcion<>"50" && $opcion<>"51" && $opcion<>"52" && $opcion<>"53" && $opcion<>"54" && $opcion<>"55" && $opcion<>"57"  && $opcion<>"67" && $opcion<>"68" && $opcion<>"78" && $opcion<>"79" && $opcion<>"102")
                  { 
                  
                    $rs = $this->manyOptions($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB);
                  
                  } //end if option
                
                  $rs1 = array_merge($rs1,$rs);

                
                } // end if <>
              } // end for
             
             mysqli_close($conectDB);
            
             if(count($rs1) <> 0){

                if($this->deleteRows($conectDB2,'transaction_import','fecha',$fecha,$fecha1)){
                    mysqli_close($conectDB2);
                    $this->loadData($rs1);
                
                }else{
                        $error = mysqli_error($conectDB2);
                        mysqli_close($conectDB2);
                        return "Error al eliminar registros: " . $error;
                }

             }
            
       }
        catch(Exception $e)
        {
           return "<br> Se ha producido un error en la ejecuciòn del script:";
        }
        
    }
    
    private function option50($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){
                       
        $sql = "SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli, pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   AND mo.tipo='0001'
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    AND mo.tipo='0001'
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;
    }

    private function option51($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql = "SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   AND mo.tipo='0002'
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo,
                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    AND mo.tipo='0002'
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;

    }
    
    private function option52($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){
                    
        $sql="SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(*) conteo, 
                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   AND mo.tipo='0003'
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(*) conteo,
                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    AND mo.tipo='0003'
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;
    }

    private function option53($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){
                    
        $sql= "SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   AND mo.tipo='0004'
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo,
                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    AND mo.tipo='0004'
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;
    }

    private function option54($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){
         
        $sql="SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                       (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                       (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                        pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
                 FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                       sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                       FROM $cliente mo, facturacion fac, entidad enti
                       WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                       AND mo.codigo_cliente=fac.cod_cliente 
                       AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                       AND mo.cod_ciudad_reserva=fac.cod_servicio
                       GROUP BY cod_entidad, factu) pago 
               left join 
                      (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                        sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                        FROM $cliente mo, facturacion fac, entidad enti
                        WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                        AND mo.codigo_cliente=fac.cod_cliente 
                        AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                        AND mo.cod_ciudad_reserva=fac.cod_servicio
                        GROUP BY cod_entidad, factu) rever 
                on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
            
            $rs = $this->recordSet($conectDB,$sql);

            return $rs;
    }

    private function option67($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql="SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                   sum(monto)  total, mo.servicio, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.servicio=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                    sum(monto) total, mo.servicio, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.servicio=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;

    }


    private function option68($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql="SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                   sum(monto)  total, mo.cliente, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.cliente=fac.cod_servicio
                   AND mo.cod_moneda=fac.moneda
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                    sum(monto) total, mo.cliente, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.cliente=fac.cod_servicio
                    AND mo.cod_moneda=fac.moneda
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;
    }

    private function option78($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql="SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_bs) conteo,
                   sum(monto_bs) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   AND mo.monto_bs<>'0' AND fac.moneda='0001'
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_bs) conteo,
                    sum(monto_bs) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    AND mo.monto_bs<>'0' AND fac.moneda='0001'
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
        
        $rs = $this->recordSet($conectDB,$sql);

        return $rs;
    }

    private function option79($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql="
           SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_us) conteo,
                   sum(monto_us) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   AND mo.monto_us<>'0' AND fac.moneda='0002'
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_us) conteo,
                    sum(monto_us) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    AND mo.monto_us<>'0' AND fac.moneda='0002'
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu ";
        
        $rs = $this->recordSet($conectDB,$sql);
        
        return $rs;                    
    }

    private function option102($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql="SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                   pago.cod_entidad enti, pago.cod_cli cli  , pago.fecha, rever.fecha1
             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                   sum(monto) total, mo.cod_empresa, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                   FROM $cliente mo, facturacion fac, entidad enti
                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                   AND mo.codigo_cliente=fac.cod_cliente AND mo.cod_empresa=fac.cod_servicio
                   AND mo.cod_moneda=fac.moneda
                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                   GROUP BY cod_entidad, factu) pago 
           left join 
                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                    sum(monto) total, mo.cod_empresa, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                    FROM $cliente mo, facturacion fac, entidad enti
                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                    AND mo.codigo_cliente=fac.cod_cliente AND mo.cod_empresa=fac.cod_servicio
                    AND mo.cod_moneda=fac.moneda
                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                    GROUP BY cod_entidad, factu) rever 
          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";

        $rs = $this->recordSet($conectDB,$sql);

        return $rs;
    }  

    private function manyOptions($fecha,$fecha1,$cliente,$cli,$estado,$estado1,$conectDB){

        $sql = "SELECT concat_ws('-','$cli',pago.factu) servicio, pago.desc_enti, 
                       (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                       (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                       pago.cod_entidad enti, pago.cod_cli cli, pago.fecha, rever.fecha1
                 FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                       sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha
                       FROM $cliente mo, facturacion fac, entidad enti
                       WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                       AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                       AND mo.cod_entidad=enti.cod_entidad AND (mo.cod_entidad<>'0000' OR mo.cod_entidad<>'0002')
                       GROUP BY cod_entidad, factu) pago 
               left join 
                      (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                        sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli, mo.fecha fecha1
                        FROM $cliente mo, facturacion fac, entidad enti
                        WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                        AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                        AND mo.cod_entidad=enti.cod_entidad AND (mo.cod_entidad<>'0000' OR mo.cod_entidad<>'0002')
                        GROUP BY cod_entidad, factu) rever 
               on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu"; 
            
            $rs = $this->recordSet($conectDB,$sql);

            return $rs;
    }

    private function loadData($rs1){
        
        $obj1 = new Setup();
        $conectDB = $obj1->conectDataB(2);
        $query = "";
           
        foreach($rs1 as $rs => $data){
            $query .= "INSERT INTO transaction_import(cli,desc_enti,enti,servicio,tot,valTot,fecha, fecha1)VALUES(
                            ".$data['cli'].",
                            '".$data['desc_enti']."',
                            ".$data['enti'].",
                            '".$data['servicio']."',
                            ".$data['tot'].",
                            ".$data['valTot'].",
                           '".$data['fecha']."',
                           '".$data['fecha1']."'
                        );";
        }
     
        $sendquery = mysqli_multi_query($conectDB,$query);
        if($sendquery==1 || $sendquery == true){
            echo"OK";
        }else{ echo "Error00!!";}
       
        mysqli_close($conectDB);
    
    }
    /**
     * @return recordset
     */
    private function recordSet($db,$sql){
        $recordSet = array();
        $result = mysqli_query($db, $sql) or die ("Error 02! no es posible conectarse la base de datos, comuniquese con el administrador");
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
            $recordSet[] = $row;
        }
        // Liberar resultados
        mysqli_free_result($result);
       
        return $recordSet;
    }

    private function deleteRows($db,$tables,$field,$daFrom,$daTo){
        
        $sql = "DELETE from ".$tables." WHERE '".$field."' BETWEEN '".$daFrom ."' AND '".$daTo."' ";
          
        if (mysqli_query($db, $sql)) {
            return true;
        } else {
            return false; 
        }

    }

    
}