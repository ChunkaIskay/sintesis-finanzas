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
   // $obj = "";

    public function __contruct()
    {
        // parent::Setup();
      $obj = new Setup();
      $this->conectDB = $obj->__contruct();
         
    }

    
    public function pruebas()
    {
        try
        {     
  
            $fecha = "2018-12-01";
            $fecha1 = "2018-12-03";
            $rs1 = array();
          for ($opcion=1;$opcion<=125; $opcion++)
           {


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

                 if($opcion<>"50" && $opcion<>"51" && $opcion<>"52" && $opcion<>"53" && $opcion<>"54" && $opcion<>"55" && $opcion<>"57"
                                   && $opcion<>"65" && $opcion<>"67" && $opcion<>"68" && $opcion<>"78" && $opcion<>"79" && $opcion<>"102")
                  { 
                     $sql = "SELECT concat_ws('-','".$cli."',pago.factu) servicio, pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM ".$cliente." mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.'".$estado."'
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND (mo.cod_entidad<>'0000' OR mo.cod_entidad<>'0002')
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM ".$cliente." mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.'".$estado1."'
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND (mo.cod_entidad<>'0000' OR mo.cod_entidad<>'0002')
                                    GROUP BY cod_entidad, factu) rever 
                           on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu";
                        }
                  
                    
                      $rs = $this->recordSet($this->conectDB,$sql);

                      $rs1 = $rs1 + $rs;
                  
                  }
                  
                    

                    //return $rs;

        }
        catch(Exception $e)
        {
           echo "<br> Se ha producido una excepción:".$e->getMessage()."<br/>\n";

          /*  echo "<br>code:".$e->getCode()."<br/>\n";
            echo "<br>file:".$e->getFile()."<br/>\n";
            echo "<br>line:".$e->getLine()."<br/>\n";
            echo "<br>trace string:".$e->getTraceAsString()."<br/>\n";
            echo "<br>trace:<pre>".$e->getTrace()."</pre><br/>\n";*/
        }
         //  mysqli_close($this->conectDB);
    }
    /**
     * @return recordset
     */
    private function recordSet($db,$sql){

        $recordSet = array();
        $result = mysqli_query($db, $sql) or die ( "Erro con la conexión a la base de datos");

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 

        $recordSet[] = $row;
        }
        // Liberar resultados
        mysqli_free_result($result);
        // Cerrar la conexión
     
        return $recordSet;
    }

    public function operations(){

          for ($opcion=1;$opcion<=125; $opcion++)
           {

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
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.tipo='0001'
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.tipo='0001'
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ", $link);

                   }

                if($opcion=="51")
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.tipo='0002'
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.tipo='0002'
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ", $link);

                    }

                if($opcion=="52")
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(*) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.tipo='0003'
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(*) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.tipo='0003'
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ", $link);

                    }

                 if($opcion=="53")
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.tipo='0004'
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(distinct mo.secuencial, mo.carnet_bene) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.tipo='0004'
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ", $link);

                    }

                 if($opcion=="54")
                 {
                    $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                    pago.cod_entidad enti, pago.cod_cli cli     
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente 
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.cod_ciudad_reserva=fac.cod_servicio
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente 
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.cod_ciudad_reserva=fac.cod_servicio
                                    GROUP BY cod_entidad, factu) rever 
                            on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");
                 }
                 if($opcion=="67")
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli  
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                                   sum(monto)  total, mo.servicio, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.servicio=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                                    sum(monto) total, mo.servicio, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.servicio=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");

                   }


                if($opcion=="68" )
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli  
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                                   sum(monto)  total, mo.cliente, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.cliente=fac.cod_servicio
                                   AND mo.cod_moneda=fac.moneda
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                                    sum(monto) total, mo.cliente, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.cliente=fac.cod_servicio
                                    AND mo.cod_moneda=fac.moneda
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");

                   }


                 if($opcion=="78")
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli 
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_bs) conteo,
                                   sum(monto_bs) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.monto_bs<>'0' AND fac.moneda='0001'
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_bs) conteo,
                                    sum(monto_bs) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.monto_bs<>'0' AND fac.moneda='0001'
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");

                   }

                if($opcion=="79")
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_us) conteo,
                                   sum(monto_us) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   AND mo.monto_us<>'0' AND fac.moneda='0002'
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count(mo.monto_us) conteo,
                                    sum(monto_us) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    AND mo.monto_us<>'0' AND fac.moneda='0002'
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");

                   }

                 if($opcion=="102" )
                 {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio,pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli  
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                                   sum(monto) total, mo.cod_empresa, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.cod_empresa=fac.cod_servicio
                                   AND mo.cod_moneda=fac.moneda
                                   AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                                    sum(monto) total, mo.cod_empresa, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.cod_empresa=fac.cod_servicio
                                    AND mo.cod_moneda=fac.moneda
                                    AND mo.cod_entidad=enti.cod_entidad AND mo.cod_entidad<>'0000' 
                                    GROUP BY cod_entidad, factu) rever 
                          on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");

                   }

                  if($opcion<>"50" && $opcion<>"51" && $opcion<>"52" && $opcion<>"53" && $opcion<>"54" && $opcion<>"55" && $opcion<>"57"
                                   && $opcion<>"65" && $opcion<>"67" && $opcion<>"68" && $opcion<>"78" && $opcion<>"79" && $opcion<>"102")
                  {
                        $datos=mysql_query("
                           (SELECT concat_ws('-','$cli',pago.factu) servicio, pago.desc_enti, 
                                   (pago.conteo - CASE WHEN rever.conteo IS NULL THEN 0 ELSE rever.conteo END) as tot,
                                   (pago.total - CASE WHEN rever.total   IS NULL THEN 0 ELSE rever.total END) as valTot,
                                   pago.cod_entidad enti, pago.cod_cli cli
                             FROM (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo, 
                                   sum(monto)  total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                   FROM $cliente mo, facturacion fac, entidad enti
                                   WHERE (fecha >='$fecha'AND fecha <='$fecha1') AND mo.$estado
                                   AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                   AND mo.cod_entidad=enti.cod_entidad AND (mo.cod_entidad<>'0000' OR mo.cod_entidad<>'0002')
                                   GROUP BY cod_entidad, factu) pago 
                           left join 
                                  (Select mo.cod_entidad, fac.servicio_facturar factu, count( * ) conteo,
                                    sum(monto) total, mo.tipo, enti.descripcion desc_enti, mo.codigo_cliente cod_cli
                                    FROM $cliente mo, facturacion fac, entidad enti
                                    WHERE (fecha >='$fecha' AND fecha <='$fecha1') AND mo.$estado1
                                    AND mo.codigo_cliente=fac.cod_cliente AND mo.tipo=fac.cod_servicio
                                    AND mo.cod_entidad=enti.cod_entidad AND (mo.cod_entidad<>'0000' OR mo.cod_entidad<>'0002')
                                    GROUP BY cod_entidad, factu) rever 
                           on pago.cod_entidad=rever.cod_entidad AND pago.factu=rever.factu) ");
                    }
          }          

    }
}
    