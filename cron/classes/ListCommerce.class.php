<?php 
/*error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', false);
error_reporting(E_ERROR);
*/

require_once 'Setup.class.php';


class ListCommerce extends Setup
{
	
	function __construct()
	{
		//$this->loadDataReport();
	}

	public function restComercios(){

	    $siaf = "http://199.3.0.90:9090/SIIApp-rest/comelec/reporte/comercio";
 
		$siaf_json = file_get_contents($siaf);
		$siaf_array = json_decode($siaf_json, true);

        $this->loadData($siaf_array['empresas']);

	}
	
	private function loadData($rs1){
        
        $obj1 = new Setup();
        $conectDB = $obj1->conectDataB(2);
        $query = "";

        foreach($rs1 as $rs => $data){
            $query .= "INSERT INTO pagos_net_client(codigo_unico_empresa, nombre, reporte, total_cobrar)VALUES(
                            ".$data['codigosUnicoEmpresa'].",
                            '".$data['nombre']."',
                            '".$data['reporte']."',
                            ".$data['totalCobrar']."
                           
                        );";
        }
     
        $sendquery = mysqli_multi_query($conectDB,$query);

        if($sendquery==1 || $sendquery == true){
            echo"OK";
        }else{ echo "Error00!!";}
       
        mysqli_close($conectDB);
    
    }

    public function loadDataReport($dateFrom, $dateTo){

        $obj1 = new Setup();
        $conectDB = $obj1->conectDataB(2);
        
        $sql = "SELECT * FROM pagos_net_client ORDER BY codigo_unico_empresa";

        $rs = $this->recordSet($conectDB,$sql);
        
        $listReportsCommerce = array();

        $fechaDesde = str_replace("-", "", $dateFrom);
        $fechaHasta = str_replace("-", "", $dateTo);  

        foreach($rs as $k => $rsValue){
           
                $url = "http://199.3.0.90:9090/SIIApp-rest/comelec/reporte/cobro/comercio";
                
                $fields = array(
                        "fechaDesde"=> $fechaDesde,
                        "fechaHasta"=> $fechaHasta,
                        "codigoUnicoEmpresa"=> $rsValue['codigo_unico_empresa'],
                        "tipoDeCambioDolar"=> 6.96);

                $header = array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                  );
               
                if($ch = curl_init($url))
                {
                    curl_setopt($ch, CURLOPT_PORT, '9090');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

                    $output = curl_exec($ch);

                    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $err = curl_error($ch);

                    curl_close($ch);

                    $output = json_decode($output, true);

                    if(!$output){
                        //echo "outp:".$output;
                        echo "cURL Error #:00001".$err;
                    }else{ 

                            $output += ["codigo_unico_empresa"=>$rsValue['codigo_unico_empresa'] , "razon_social"=>$rsValue['nombre'], "id_client"=>$rsValue['cli'], "fecha_referencial"=>$fechaDesde ];
                           
                            array_push($listReportsCommerce, $output );
                           
                     }

                    //return (int) $status;
                }
                else
                {  
                  return "Error al intentar conectarse al servicio!. Comuniquese con su  administrador";
                }
        }   

        $this->saveloadDataReport($listReportsCommerce);              

    }

    private function saveloadDataReport($rs2){
        
    

        $obj1 = new Setup();
        $conectDB = $obj1->conectDataB(2);
        $query = "";
        
        foreach($rs2 as $krs => $dataR){

            $intevalosCobro = ($dataR['intervalosDeCobro'] != null)? $dataR['intervalosDeCobro']:0;
      
            $query = "INSERT INTO pagos_net_client_import(codigo_unico_empresa, razon_social, nombre_comercio, intervalos_cobro ,error, mensaje, id_client, fecha_referencial)VALUES(
                            ".$dataR['codigo_unico_empresa'].",
                            '".$dataR['razon_social']."',
                            '".$dataR['nombreComercio']."',
                            ".$intevalosCobro.",
                            '".$dataR['error']."',
                            '".$dataR['mensaje']."',
                            ".$dataR['id_client'].",
                            '".date('Y-m-d', strtotime($dataR['fecha_referencial']))."'
                        );";


            if (mysqli_query($conectDB,$query)) {
            echo "ok";
            } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conectDB);
            }
            $subImportId = mysql_insert_id();
            $codEmpresa = $dataR['codigo_unico_empresa']; 
            $fechaRef = $dataR['fecha_referencial'];

            if(is_array($dataR['intervalos'])){

                foreach($dataR['intervalos'] as $k => $vIntervalo){

                 $query1 .= "INSERT INTO pagos_net_client_import(sub_import_id, descripcion_intervalo,cantidad_transacciones, monto_total, monto_total_cobrar, fecha_referencial)VALUES(
                            ".$subImportId.",
                            '".$vIntervalo['descripcionIntervalo']."',
                            ".$vIntervalo['cantidadTransacciones'].",
                            ".$vIntervalo['montoTotal'].",
                            ".$vIntervalo['montoTotalParaCobrar'].",
                            ".$codEmpresa.",
                            '".date('Y-m-d', strtotime($fechaRef))."'
                        );";
                }

                $insertMulti = mysqli_multi_query($conectDB,$query1);

                if($insertMulti==1 || $insertMulti == true){
                    echo"OK";
                }else{ echo "Error00!!";}
                    }
        }
                
        

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

}