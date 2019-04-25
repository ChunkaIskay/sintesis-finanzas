<?php 
/*error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', false);
error_reporting(E_ERROR);
*/

require_once 'Setup.class.php';


class listCommerce extends Setup
{
	
	function __construct()
	{
		//$this->loadDataReport();

	}

	public function restComercios(){

		//$siaf = "http://199.14.10.107:8081/SIIApp-rest/comelec/comercios";
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
        $conectDB = $obj1->conectDataB(3);
        
        $sql = "SELECT * FROM pagos_net_client ORDER BY codigo_unico_empresa";

        $rs = $this->recordSet($conectDB,$sql);
        
        $listReportsCommerce = array();

        $fechaDesde = str_replace("-", "", $dateFrom);
        $fechaHasta = str_replace("-", "", $dateTo);  

        foreach($rs as $k => $rsValue){
           
                $url = "http://199.14.10.109:9090/SIIApp-rest/comelec/reporte/cobro/comercio";
                
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
                    curl_setopt($ch, CURLOPT_PORT, '8081');
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
                        echo "cURL Error #:00001";
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
print_r($listReportsCommerce);exit;
        $this->saveloadDataReport($listReportsCommerce);              

    }

    private function saveloadDataReport($rs2){
        
        $obj1 = new Setup();
        $conectDB = $obj1->conectDataB(2);
        $query = "";
        
        foreach($rs2 as $krs => $dataR){

            $montoTotal = ($dataR['montoTotal'] != null)? $dataR['montoTotal']:0;
            $monto = ($dataR['monto'] != null)? $dataR['monto']:0;
            $cantidadTransacciones = ($dataR['cantidadTransacciones'] != null)? $dataR['cantidadTransacciones']:0;
      
            $query .= "INSERT INTO pagos_net_client_import(codigo_unico_empresa, razon_social, monto_total_comision, monto, cantidad_transacciones, nombre_comercio, error, mensaje, id_client, fecha_referencial)VALUES(
                            ".$dataR['codigo_unico_empresa'].",
                            '".$dataR['razon_social']."',
                            ".$montoTotal.",
                            ".$monto.",
                            ".$cantidadTransacciones.",
                            '".$dataR['nombreComercio']."',
                            '".$dataR['error']."',
                            '".$dataR['mensaje']."',
                            ".$dataR['id_client'].",
                            '".date('Y-m-d', strtotime($dataR['fecha_referencial']))."'
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

}