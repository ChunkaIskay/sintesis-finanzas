<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\PayEntityCommission;


class PayEntityCommissionController extends Controller
{
   public function index(){
		
		$query = "";
		$dateFrom = "";
		$dateTo = "";
		$listCommission = array();


		return view('commission_pay_entity.index')->with(compact('query','dateFrom','dateTo','listCommission'));
	}

	public function search(Request $Request){
		
		$listReports = array();
		$listCommission = array();

		$dateFrom = $Request->input('dateFrom');
		$dateTo = $Request->input('dateTo');
		$query = $Request->input('query');
		
		if(isset($dateFrom) && isset($dateTo))
		{ 
			$listReports=array_collapse([$listReports, $this->banco_bisa($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_credito_bolivia($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_economico($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_fassil($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_fie($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_fortaleza($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_ganadero($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_mercantil_santa_cruz($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_prodem($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_pyme_cominidad($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_pyme_ecofuturo($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_solidario($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->banco_union($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_abierta_madre_maestra($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_sarco_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_asuncion_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_educadores_gran_chaco($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_chorolque_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_incahuasi_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_fatima_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_cooprole_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_san_carlos_borromeo($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_san_roque_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_ef_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cac_tri_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->cidre($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->comercializasdora_bolivia($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_a_c_magisterio_rural($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_comarapa_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_empetrol_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_hospicio_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_jesus_nazareno($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_la_cantera_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_la_sagrada_familia($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_mnsr_felix_ganza($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_paulo_VI_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_pio_x_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_progreso_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_quillacollo_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_joaquin_ltda($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_martin_porres($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_francisco_solano($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_la_merced($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_loyola($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_magisterio_tarija($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_bermejo($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_pedro($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_tukuypaj($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_cristo_rey($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_gra_grigota($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_mateo($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_san_pedro_aiquile($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->coop_crecer($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->diaconia_entidad_desarrollo($dateFrom,$dateTo)]);
			$listReports=array_collapse([$listReports, $this->farmacorp_serviexpress($dateFrom,$dateTo)]);

			$listCommission = collect($listReports);
			//dd($listCommission);
		 	// metodo para guardar datos en la tabla historico
		 	//$this->saveCommissionHistory($listReports);

			//	0 => array('entity'=>4, 'desc_enti'=>'BANCO BISA', 'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),

			if(isset($query)){
				
					$arraySearch = array(); 
					$count = 0;

					foreach($listReports as $lKey => $report){
							$queryDesc = trim(strtoupper($query));
							$queryName = trim(ucfirst(strtolower($query)));
					
							if($this->searchStrpos($report['desc_enti'],$queryDesc)){
								if($this->existsCounter($arraySearch,$lKey) == false){
									$arraySearch[$count]=$lKey;
								    $count++;
								}
							}
							
							if($this->searchStrpos($report['servicio'],$queryDesc)){
								if($this->existsCounter($arraySearch,$lKey) == false){
									$arraySearch[$count]=$lKey;
								    $count++;
								}
							}
							if($this->searchStrpos($report['desc'],$queryDesc)){
								if($this->existsCounter($arraySearch,$lKey) == false){
									$arraySearch[$count]=$lKey;
								    $count++;
								}
							}
					}

					$countReport = count($listReports);
					$arrayDel = array();

					for ($i=0; $i < $countReport ; $i++) {
						$arrayDel[$i]=$i;		
					}
				
				
					foreach ($arrayDel as $c => $value) {
						if(in_array($value,$arraySearch,true)){
							 unset($arrayDel[$c]);
						}
					}

					$listReport = array();
					$listReport = $listReports;

					foreach ($listReport as $c => $value) {
						if(in_array($c,$arrayDel,true)){
							 unset($listReport[$c]);
						}
					}
					
					$listCommission = collect($listReport);
			}
		}


  //dd($listCommission);
  	return view('commission_pay_entity.index')->with(compact('listCommission','query','dateFrom','dateTo'));
		
	}

	private function searchStrpos($foo, $query){
					
			if (strpos($foo, $query) !== false) {
				  return true;
				}
			return false;
	}

	private function existsCounter($arraySearch,$k){
     
		return in_array($k,$arraySearch,true);
	}


	public function saveCommissionHistory($dataCommission){
    	//$commission_h = new CommissionHistory();
		//CommissionHistory::insert($dataCommission);
    	DB::table('commission_history')->insert($dataCommission); 
  		//return view('comission.index')->with(compact('listReports'));
    }

	/**
	**SELECT cli,enti,sum(valTot),SUM(tot),desc_enti,servicio, fecha FROM `transaction_import` WHERE 
	**enti=4 and desc_enti like('%BANCO BISA%') and fecha BETWEEN '2018-12-01' and '2018-12-31' GROUP 
	**BY cli, enti
	**
	*/

	private function calculationCommissions($dateFrom, $dateTo, $arrayPrices){
		
		$totalPay = 0;
		$totalPay1 = 0;
		$listPay = array();
		$arrayPut = array();

		foreach($arrayPrices as $kb => $valueb){
				
			$totalTransaction = DB::table('transaction_import')
									->where('enti','=',$valueb['entity'])
									->where('cli','=',$valueb['cli'])
									->whereBetween('fecha', [$dateFrom, $dateTo])
									->where('servicio', 'like', "%".$valueb['servicio']."%")
									->select(DB::raw('sum(valTot) as valTot,SUM(tot) as tot'))
									->get();


			if($valueb['unitCost'] <> 0 && $valueb['percent'] == 0){
					$totalPay = $totalTransaction[0]->tot * $valueb['unitCost'];
			}
				
			if($valueb['percent'] <> 0 && $valueb['unitCost'] == 0){
					$totalPay = ($totalTransaction[0]->valTot * $valueb['percent']) / 100;
			}

			if($valueb['percent'] == 0 && $valueb['unitCost'] == 0){
					$totalPay = 0;
			}
			if($totalPay <> 0 && $totalPay > 0 ){

 					$totalPay1 = round($totalPay,2);
			}


			$arrayPut = array(  'entity'=>$valueb['entity'], 
								'desc_enti'=>$valueb['desc_enti'],
								'cli'=>$valueb['cli'] ,
								'servicio'=>$valueb['servicio'], 
								'valTot'=>$totalTransaction[0]->valTot,   
								'tot'=>$totalTransaction[0]->tot, 
								'total_billing'=>round($totalPay,2),
								'created_at'=>$dateFrom,
								'desc' => $valueb['desc']
							);


			array_push($listPay, $arrayPut);
		}
							
		//return ['entity' => $valueb['entity'], 'desc_enti'=>$valueb['desc_enti'], $listPay];
		return $listPay;
	} 

	/**
	**
	**/
	private function banco_bisa($dateFrom, $dateTo){

		$arrayPrices = array( 

				0 => array('entity'=>4, 'desc_enti'=>'BANCO BISA', 'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
				1 => array('entity'=>4, 'desc_enti'=>'BANCO BISA', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
				2 => array('entity'=>4, 'desc_enti'=>'BANCO BISA', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
				);
	
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_credito_bolivia($dateFrom, $dateTo){

		$arrayPrices = array( 

			0 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA SEGUROS', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'),
			1 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 122 ,'servicio' => 'BISA SEGUROS COBROS-Recaudacion Bisa Seguros', 'unitCost' => 4, 'percent' => 0, 'desc'=>'BISA SEGUROS Y REASEGUROS'),
			2 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 104 ,'servicio' => 'CREDINFORM-CREDINFORM', 'unitCost' => 2, 'percent' => 0, 'desc'=>'CREDINFORM'),
			3 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'EPSAS'),
			4 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 0, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			5 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			6 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 44 ,'servicio' => 'LBC-PAGOS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-PAGOS'),
			7 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			8 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			9 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 121 ,'servicio' => 'ITACAMBA-Recaudacion', 'unitCost' => 2, 'percent' => 0, 'desc'=>'ITACAMBA'),
			10 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'SEMAPA'),
			11 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 0, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function banco_economico($dateFrom, $dateTo){
// sumar prevision y futuro
		$arrayPrices = array( 

			0=> array('entity'=>21, 'desc_enti'=>'BANCO ECONOMICO', 'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			1 => array('entity'=>21, 'desc_enti'=>'BANCO ECONOMICO', 'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 'unitCost' => 3.5, 'percent' => 0, 'desc'=>'SSO FUTURO'),
			2 => array('entity'=>21, 'desc_enti'=>'BANCO ECONOMICO', 'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 'unitCost' => 3.5, 'percent' => 0, 'desc'=>'SSO PREVISION'),
			3 => array('entity'=>21, 'desc_enti'=>'BANCO ECONOMICO', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 2, 'percent' => 0, 'desc'=>'YANBAL'),
			4 => array('entity'=>21, 'desc_enti'=>'BANCO ECONOMICO', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.38, 'desc'=>'SEMAPA')
					
				);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function banco_fassil($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0=> array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA SEGUROS', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'),
			1 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA VIDA', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA VIDA'),
			2 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA VIDA LARGO PLAZO', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA VIDA - LARGO PLAZO'),
			3 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 78 ,'servicio' => 'BBR', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BOLIVIANA BIENES RAICES'),
			4 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 104 ,'servicio' => 'CREDINFORM-CREDINFORM', 'unitCost' => 2, 'percent' => 0, 'desc'=>'CREDINFORM'),
			
			5 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			6 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			7 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 106 ,'servicio' => 'FORTALEZA-FORTALESA', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'SEGUROS Y REASEGUROS FORTALEZA'),
			8 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 'unitCost' => 2, 'percent' => 0, 'desc'=>'SSO FUTURO'),
			9 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 'unitCost' => 2, 'percent' => 0, 'desc'=>'SSO PREVISION'),
			10 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 2, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			11 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			12 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 44 ,'servicio' => 'LBC-PAGOS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-PAGOS'),
			13 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 44 ,'servicio' => 'LBC-FRANQUICIAS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-FRANQUICIAS'),
			14 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 83 ,'servicio' => 'MEMPARK-CMP', 'unitCost' => 2.1, 'percent' => 0, 'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'),
			15 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 83 ,'servicio' => 'MEMPARK-EMI', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'),
			16 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			17 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			18 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			19 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			20 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			21 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.45, 'desc'=>'SEMAPA'),
			22 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),
			23 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'),
			24 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 'unitCost' => 1, 'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'),
			25 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			26 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.9, 'desc'=>'UNIVIDA'),

			27 => array('entity'=>54, 'desc_enti'=>'BANCO FASSIL S.A.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'YANBAL')

				);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function banco_fie($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'EPSAS'),
			1 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 0, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			2 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			3 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 44 ,'servicio' => 'LBC-PAGOS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-PAGOS'),
			4 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 44 ,'servicio' => 'LBC-FRANQUICIAS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-FRANQUICIAS'),
			5 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			6 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			7 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			8 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			9 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			10 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'SEMAPA'),
			11 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'TUVES TV'),
			12 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 'unitCost' => 0, 'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'),
			13 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			14 => array('entity'=>5005, 'desc_enti'=>'BANCO FIE S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0, 'desc'=>'UNIVIDA')

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_fortaleza($dateFrom, $dateTo){
		//sumar pagos y franquicias

		$arrayPrices = array( 

			0 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 104 ,'servicio' => 'CREDINFORM-CREDINFORM', 'unitCost' => 2, 'percent' => 0, 'desc'=>'CREDINFORM'),
			1 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			2 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 107 ,'servicio' => 'LA VITALICIA-LA VITALICIA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA VITALICIA SEGUROS Y REASEGUROS'),
			3 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			4 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			5 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			6 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			7 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.38, 'desc'=>'SEMAPA'),
			8 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 106 ,'servicio' => 'FORTALEZA-FORTALESA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'SEGUROS Y REASEGUROS FORTALEZA'),	
			9 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 1.15, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			10 => array('entity'=>212, 'desc_enti'=>'BANCO FORTALEZA', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.9, 'desc'=>'UNIVIDA')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_ganadero($dateFrom, $dateTo){
		//sumar pagos y franquicias

		$arrayPrices = array( 

			0 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			1 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 121 ,'servicio' => 'ITACAMBA-Recaudacion', 'unitCost' => 2, 'percent' => 0, 'desc'=>'ITACAMBA'),
			2 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			3 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 44 ,'servicio' => 'LBC-PAGOS', 'unitCost' => 3.45, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-PAGOS'),
			4 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 44 ,'servicio' => 'LBC-FRANQUICIAS', 'unitCost' => 3.45, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-FRANQUICIAS'),
			5 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			6 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			7 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 62 ,'servicio' => 'UAB-UAB', 'unitCost' => 1, 'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA DEL BENI JOSE BALLIVIAN'),
			8 => array('entity'=>35, 'desc_enti'=>'BANCO GANADERO', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_mercantil_santa_cruz($dateFrom, $dateTo){
		//sumar pagos y franquicias

		$arrayPrices = array( 

			0 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA SEGUROS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'),
			1 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 93 ,'servicio' => 'BOLIVIATEL-BOLIVIATEL', 'unitCost' => 0, 'percent' => 0, 'desc'=>'BOLIVIATEL COMTECO'),
			2 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			3 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 0, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			4 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			5 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			6 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			7 => array('entity'=>9, 'desc_enti'=>'BANCO MERCANTIL SANTA CRUZ', 'cli' => 106 ,'servicio' => 'FORTALEZA-FORTALESA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'SEGUROS Y REASEGUROS FORTALEZA')

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_nacional_bolivia($dateFrom, $dateTo){
		//sumar pagos y franquicias

		$arrayPrices = array( 

			0 => array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 78 ,'servicio' => 'BBR', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'BOLIVIANA BIENES RAICES'),
			1 =>  array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 2.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			2 =>  array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			3 =>  array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 44 ,'servicio' => 'LBC-PAGOS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-PAGOS'),
			4 =>  array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 44 ,'servicio' => 'LBC-FRANQUICIAS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-FRANQUICIAS'),
			5 =>  array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 0, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			6 =>  array('entity'=>8, 'desc_enti'=>'BANCO NACIONAL DE BOLIVIA', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_prodem($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 2, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.8, 'desc'=>'EPSAS'),
			2 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.7, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			3 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			4 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			5 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			6 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			7 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			8 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			9 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.5, 'desc'=>'SEMAPA'),
			10 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),
			11 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'TUVES TV'),
			12 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 'unitCost' => 1.1, 'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'),
			13 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 1.1, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			14 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 1, 'desc'=>'UNIVIDA'),
			15 => array('entity'=>5007, 'desc_enti'=>'BANCO PRODEM S.A.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 2.5, 'percent' => 0, 'desc'=>'YANBAL')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_pyme_cominidad($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),

			1 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			2 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			3 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			4 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			5 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.43, 'desc'=>'SEMAPA'),
			6 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),
			7 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'TUVES TV'),
			8 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA'),
			9 => array('entity'=>71, 'desc_enti'=>'BANCO PYME DE LA COMUNIDAD S.A.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_pyme_ecofuturo($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 109 ,'servicio' => 'AMASZONAS-AMASZONAS', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'AMASZONAS'),
			2 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 88 ,'servicio' => 'BDP-BDP', 'unitCost' => 2, 'percent' => 0, 'desc'=>'BANCO DE DESARROLLO PRODUCTIVO'),
			3 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 104 ,'servicio' => 'CREDINFORM-CREDINFORM', 'unitCost' => 2, 'percent' => 0, 'desc'=>'CREDINFORM'),
			4 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			5 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			6 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 107 ,'servicio' => 'LA VITALICIA-LA VITALICIA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA VITALICIA SEGUROS Y REASEGUROS'),
			7 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			8 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 102 ,'servicio' => 'NOVILLO-CREDICASAS', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'NOVILLO-CREDICASAS LAFUENTE'),
			9 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 102 ,'servicio' => 'NOVILLO-MI RANCHO', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'NOVILLO - MI RANCHO'),
			10 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 50 ,'servicio' => 'NOVILLO-TIERRA QUINTA', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'NOVILLO - TIERRA QUINTA'),
			11 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			12 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			13 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			14 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			15 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.38, 'desc'=>'SEMAPA'),
			16 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 'unitCost' => 2, 'percent' => 0, 'desc'=>'SSO FUTURO'),
			17 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 'unitCost' => 2, 'percent' => 0, 'desc'=>'SSO PREVISION'),
			18 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 48 ,'servicio' => 'TRANSBEL-TRANSBEL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'TRANSBEL'),
			19 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'TUVES TV'),
			20 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 'unitCost' => 1, 'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'),
			21 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 1.15, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			22 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.9, 'desc'=>'UNIVIDA'),
			23 => array('entity'=>5006, 'desc_enti'=>'BANCO PYME ECOFUTURO S.A.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_solidario($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			
			0 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 109 ,'servicio' => 'AMASZONAS-AMASZONAS', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'AMASZONAS'),
			1 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 78 ,'servicio' => 'BBR', 'unitCost' => 1.73, 'percent' => 0, 'desc'=>'BOLIVIANA BIENES RAICES'),
			2 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.8, 'desc'=>'EPSAS'),
			3 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 2, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			4 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),
			5 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			6 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			7 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			8 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.5, 'desc'=>'SEMAPA'),
			9 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'TUVES TV'),
			10 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 1.15, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			11 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 1, 'desc'=>'UNIVIDA'),
			12 => array('entity'=>1017, 'desc_enti'=>'BANCO SOLIDARIO S.A.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function banco_union($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 2, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 88 ,'servicio' => 'BDP-BDP', 'unitCost' => 3.5, 'percent' => 0, 'desc'=>'BANCO DE DESARROLLO PRODUCTIVO'),
			2 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			3 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			4 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			5 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0, 'percent' => 0, 'desc'=>'SEGIP CI'),
			6 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			7 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 'unitCost' => 3, 'percent' => 0, 'desc'=>'SSO FUTURO'),
			8 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 'unitCost' => 3, 'percent' => 0, 'desc'=>'SSO PREVISION'),
			9 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 0, 'desc'=>'TUVES TV'),
			10 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			11 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 1.2, 'desc'=>'UNIVIDA'),
			12 => array('entity'=>20, 'desc_enti'=>'BANCO UNION S.A.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 3, 'percent' => 0, 'desc'=>'YANBAL')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_abierta_madre_maestra($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			
			0 => array('entity'=>222, 'desc_enti'=>'C.A.C ABIERTA MADRE Y MAESTRA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>222, 'desc_enti'=>'C.A.C ABIERTA MADRE Y MAESTRA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_sarco_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			
			0 => array('entity'=>215, 'desc_enti'=>'C.A.C SARCO LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>215, 'desc_enti'=>'C.A.C SARCO LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			2 => array('entity'=>215, 'desc_enti'=>'C.A.C SARCO LTDA.', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_asuncion_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			
			0 => array('entity'=>9003, 'desc_enti'=>'C.A.C. ASUNCION', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>9003, 'desc_enti'=>'C.A.C. ASUNCION', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			2 => array('entity'=>9003, 'desc_enti'=>'C.A.C. ASUNCION', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			3 => array('entity'=>9003, 'desc_enti'=>'C.A.C. ASUNCION', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_educadores_gran_chaco($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				

			0 => array('entity'=>7005, 'desc_enti'=>'C.A.C. EDUCADORES GRAN CHACO LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>7005, 'desc_enti'=>'C.A.C. EDUCADORES GRAN CHACO LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			2 => array('entity'=>7005, 'desc_enti'=>'C.A.C. EDUCADORES GRAN CHACO LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			3 => array('entity'=>7005, 'desc_enti'=>'C.A.C. EDUCADORES GRAN CHACO LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_chorolque_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				

			0 => array('entity'=>5010, 'desc_enti'=>'C.A.C. EL CHOROLQUE LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>5010, 'desc_enti'=>'C.A.C. EL CHOROLQUE LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_incahuasi_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>9075, 'desc_enti'=>'C.A.C. INCAHUASI LTDA', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_fatima_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>55, 'desc_enti'=>'C.A.C.FATIMA LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			1 => array('entity'=>55, 'desc_enti'=>'C.A.C.FATIMA LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			2 => array('entity'=>55, 'desc_enti'=>'C.A.C.FATIMA LTDA', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_cooprole_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			
			0 => array('entity'=>5011, 'desc_enti'=>'CAC COOPROLE LTDA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>5011, 'desc_enti'=>'CAC COOPROLE LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			2 => array('entity'=>5011, 'desc_enti'=>'CAC COOPROLE LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			3 => array('entity'=>5011, 'desc_enti'=>'CAC COOPROLE LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			4 => array('entity'=>5011, 'desc_enti'=>'CAC COOPROLE LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			5 => array('entity'=>5011, 'desc_enti'=>'CAC COOPROLE LTDA', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function cac_san_carlos_borromeo($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			
			0 => array('entity'=>219, 'desc_enti'=>'CAC SAN CARLOS BORROMEO LTDA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>219, 'desc_enti'=>'CAC SAN CARLOS BORROMEO LTDA', 'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 'unitCost' => 1.2, 'percent' => 0, 'desc'=>'ENROLAMIENTO BIOMETRICO'),
			2 => array('entity'=>219, 'desc_enti'=>'CAC SAN CARLOS BORROMEO LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			3 => array('entity'=>219, 'desc_enti'=>'CAC SAN CARLOS BORROMEO LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			4 => array('entity'=>219, 'desc_enti'=>'CAC SAN CARLOS BORROMEO LTDA', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.38, 'desc'=>'SEMAPA')

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_san_roque_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			1 => array('entity'=>2645, 'desc_enti'=>'CAC SAN ROQUE LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			2 => array('entity'=>2645, 'desc_enti'=>'CAC SAN ROQUE LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			3 => array('entity'=>2645, 'desc_enti'=>'CAC SAN ROQUE LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			4 => array('entity'=>2645, 'desc_enti'=>'CAC SAN ROQUE LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			5 => array('entity'=>2645, 'desc_enti'=>'CAC SAN ROQUE LTDA', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_ef_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>7201, 'desc_enti'=>'CACEF LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>7201, 'desc_enti'=>'CACEF LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cac_tri_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
			
			0 => array('entity'=>3021, 'desc_enti'=>'CACTRI LTDA', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),	
			1 => array('entity'=>3021, 'desc_enti'=>'CACTRI LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			2 => array('entity'=>3021, 'desc_enti'=>'CACTRI LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function cidre($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 'unitCost' => 1.2, 'percent' => 0, 'desc'=>'ENROLAMIENTO BIOMETRICO'),
			1 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			2 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			3 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			4 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			5 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			6 => array('entity'=>214, 'desc_enti'=>'CIDRE', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function comercializasdora_bolivia($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0=> array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA SEGUROS', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'),
			1 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA VIDA', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA VIDA'),
			2 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA VIDA LARGO PLAZO', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA VIDA - LARGO PLAZO'),
			3 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 109 ,'servicio' => 'AMASZONAS-AMASZONAS', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'AMASZONAS'),
			4 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 122 ,'servicio' => 'BISA SEGUROS COBROS-Recaudacion Bisa Seguros', 'unitCost' => 2.5, 'percent' => 0, 'desc'=>'BISA SEGUROS Y REASEGUROS'),
			5 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			6 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),
			7 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 44 ,'servicio' => 'LBC-COBROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'),
			8 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 44 ,'servicio' => 'LBC-PAGOS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA BOLIVIANA CIACRUZ-PAGOS'),
			9 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 107 ,'servicio' => 'LA VITALICIA-LA VITALICIA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'LA VITALICIA SEGUROS Y REASEGUROS'),
			10 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 83 ,'servicio' => 'MEMPARK-CMP', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'),
			11 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 83 ,'servicio' => 'MEMPARK-EMI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'),
			12 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'),
			13 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 'unitCost' => 2, 'percent' => 0, 'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'),
			14 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			15 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			16 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			17 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 48 ,'servicio' => 'TRANSBEL-TRANSBEL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'TRANSBEL'),
			18 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'),
			19 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 'unitCost' => 1, 'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'),
			20 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA'),
			21 => array('entity'=>8940, 'desc_enti'=>'COMERCIALIZADORA ACTION BOLIVIA S.A', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'YANBAL')

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_a_c_magisterio_rural($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>9080, 'desc_enti'=>'COOP. A Y C MAGISTERIO RURAL', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			1 => array('entity'=>9080, 'desc_enti'=>'COOP. A Y C MAGISTERIO RURAL', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_comarapa_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
				
			0 => array('entity'=>5003, 'desc_enti'=>'COOP. COMARAPA LTDA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>5003, 'desc_enti'=>'COOP. COMARAPA LTDA', 'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 'unitCost' => 2, 'percent' => 0, 'desc'=>'ENROLAMIENTO BIOMETRICO'),
			2 => array('entity'=>5003, 'desc_enti'=>'COOP. COMARAPA LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			3 => array('entity'=>5003, 'desc_enti'=>'COOP. COMARAPA LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			4 => array('entity'=>5003, 'desc_enti'=>'COOP. COMARAPA LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			5 => array('entity'=>5003, 'desc_enti'=>'COOP. COMARAPA LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_empetrol_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
		
			0 => array('entity'=>9048, 'desc_enti'=>'COOP. EMPETROL', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>9048, 'desc_enti'=>'COOP. EMPETROL', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			2 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.4, 'desc'=>'SEMAPA'),
			3 => array('entity'=>9048, 'desc_enti'=>'COOP. EMPETROL', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_hospicio_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias

		$arrayPrices = array( 
				
			0 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 'unitCost' => 2.1, 'percent' => 0, 'desc'=>'ENROLAMIENTO BIOMETRICO'),
			1 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
			2 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			3 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			4 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
			5 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
			6 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.38, 'desc'=>'SEMAPA'),
			7 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA'),
			8 => array('entity'=>213, 'desc_enti'=>'COOP. HOSPICIO LTDA.', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
			
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_jesus_nazareno($dateFrom, $dateTo){
		//sumar pagos y franquicias
		//sumar futuro prevision
		$arrayPrices = array( 
						0=> array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
								  'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA SEGUROS', 
								  'unitCost' => 1.9, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'
								),

						1 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
								   'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA VIDA', 
								   'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA VIDA'
								),

						2 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA VIDA LARGO PLAZO', 
									'unitCost' => 1.8, 'percent' => 0, 
									'desc'=>'ALIANZA VIDA - LARGO PLAZO'
								),

						3 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' =>88 ,'servicio' =>'BDP-BDP', 'unitCost' =>2, 
									'percent' =>0, 'desc'=>'BANCO DE DESARROLLO PRODUCTIVO'
								),
						4 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 104 ,'servicio' => 'CREDINFORM-CREDINFORM', 
									'unitCost' => 2, 'percent' => 0, 'desc'=>'CREDINFORM'
								),
						5 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 
									'unitCost' => 2, 'percent' => 0, 'desc'=>'SSO FUTURO'
								),
						6 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 
									'unitCost' => 2, 'percent' => 0, 'desc'=>'SSO PREVISION'
								),
						7 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
									'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'
								),
						8 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 107 ,'servicio' => 'LA VITALICIA-LA VITALICIA', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'LA VITALICIA SEGUROS Y REASEGUROS'
								),
						9 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 83 ,'servicio' => 'MEMPARK-CMP', 
									'unitCost' => 1.8, 'percent' => 0, 
									'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'
								),
						10 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 83 ,'servicio' => 'MEMPARK-EMI', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'
								),
						11 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'
								),
						12 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'
								),
						13 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 102 ,'servicio' => 'NOVILLO-CREDICASAS', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NOVILLO-CREDICASAS LAFUENTE'
								),
						14 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 102 ,'servicio' => 'NOVILLO-MI RANCHO', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NOVILLO - MI RANCHO'
								),
						15 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 50 ,'servicio' => 'NOVILLO-TIERRA QUINTA', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NOVILLO - TIERRA QUINTA'
								),
						16 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES',
									'unitCost' => 1.5, 'percent' => 0,
									'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
								),
						17 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS',
									'unitCost' => 2.2, 'percent' => 0, 
									'desc'=>'RENTA DIGNIDAD PAGOS'
								),
						18 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'
								),
						19 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 'unitCost' => 1, 
									'percent' => 0, 'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'
								),
						20 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA'
								),
						21 => array('entity'=>40, 'desc_enti'=>'COOP. JESUS NAZARENO', 
									'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
									'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL'
								)

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_la_cantera_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 
			
				0 => array('entity'=>216, 'desc_enti'=>'COOP. LA CANTERA LTDA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
				1 => array('entity'=>216, 'desc_enti'=>'COOP. LA CANTERA LTDA', 'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 'unitCost' => 1.2, 'percent' => 0, 'desc'=>'ENROLAMIENTO BIOMETRICO'),
				2 => array('entity'=>216, 'desc_enti'=>'COOP. LA CANTERA LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
				3 => array('entity'=>216, 'desc_enti'=>'COOP. LA CANTERA LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
				
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function coop_la_sagrada_familia($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
			1 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 48 ,'servicio' => 'EPSAS', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'),
			2 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
			3 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			4 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
			5 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 58 ,'servicio' => 'UMSA-UMSA', 'unitCost' => 0.8, 'percent' => 0, 'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'),
			6 => array('entity'=>7004, 'desc_enti'=>'COOP. LA SAGRADA FAMILIA', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function coop_mnsr_felix_ganza($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			
			0 => array('entity'=>3121, 'desc_enti'=>'COOP. MNSR.FELIX GAINZA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
			1 => array('entity'=>3121, 'desc_enti'=>'COOP. MNSR.FELIX GAINZA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_paulo_VI_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			
				0 => array('entity'=>9067, 'desc_enti'=>'COOP. PAULO VI LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
				1 => array('entity'=>9067, 'desc_enti'=>'COOP. PAULO VI LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_pio_x_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

					0 => array('entity'=>311, 'desc_enti'=>'COOP. PIO X LTDA.', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
					1 => array('entity'=>311, 'desc_enti'=>'COOP. PIO X LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
					2 => array('entity'=>311, 'desc_enti'=>'COOP. PIO X LTDA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
					3 => array('entity'=>311, 'desc_enti'=>'COOP. PIO X LTDA.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
					4 => array('entity'=>311, 'desc_enti'=>'COOP. PIO X LTDA.', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA')
					
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_progreso_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		//sumar futuro prevision
		$arrayPrices = array( 

				 0 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
				 1 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'),
				 2 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 72 ,'servicio' => 'NATURA-NATURA', 'unitCost' => 1, 'percent' => 0, 'desc'=>'NATURA - ALTA ESTÉTICA'),
				 3 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
				 4 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
				 5 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 'unitCost' => 0.5, 'percent' => 0, 'desc'=>'SEGIP CI'),
				 6 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 'unitCost' => 0.9, 'percent' => 0, 'desc'=>'SEGIP LICENCIA'),
				 7 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'),
				 8 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA'),
				 9 => array('entity'=>9019, 'desc_enti'=>'COOP. PROGRESO LTDA', 'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL')

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_quillacollo_ltda($dateFrom, $dateTo){
		
		$arrayPrices = array( 

				0 => array('entity'=>3015, 'desc_enti'=>'COOP. QUILLACOLLO LTDA.', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA')
			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function coop_san_antonio_ltda($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

				0 => array('entity'=>56, 'desc_enti'=>'COOP. SAN ANTONIO CBBA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
				1 => array('entity'=>56, 'desc_enti'=>'COOP. SAN ANTONIO CBBA.', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_san_joaquin_ltda($dateFrom, $dateTo){
	
		$arrayPrices = array( 

				 0 => array('entity'=>9047, 'desc_enti'=>'COOP. SAN JOAQUIN LTDA', 'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'),
				 1 => array('entity'=>9047, 'desc_enti'=>'COOP. SAN JOAQUIN LTDA', 'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'),
				 2 => array('entity'=>9047, 'desc_enti'=>'COOP. SAN JOAQUIN LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 'unitCost' => 1.5, 'percent' => 0, 'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
				 3 => array('entity'=>9047, 'desc_enti'=>'COOP. SAN JOAQUIN LTDA', 'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 'unitCost' => 2.2, 'percent' => 0, 'desc'=>'RENTA DIGNIDAD PAGOS'),
				 4 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 'unitCost' => 0, 'percent' => 0.4, 'desc'=>'SEMAPA'),
				 5 => array('entity'=>9047, 'desc_enti'=>'COOP. SAN JOAQUIN LTDA', 'cli' => 70 ,'servicio' => 'TUVES-TUVES', 'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'),
				 6 => array('entity'=>9047, 'desc_enti'=>'COOP. SAN JOAQUIN LTDA', 'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA')

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_san_martin_porres($dateFrom, $dateTo){
		
		$arrayPrices = array(

						0 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES',
									'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY',
									'unitCost' => 1.8, 'percent' => 0, 'desc'=>'BONOS-JUANA AZURDUY'
								), 
						1 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
								  'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA SEGUROS', 
								  'unitCost' => 1.9, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'
								),
						2 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 104 ,'servicio' => 'CREDINFORM-CREDINFORM', 
									'unitCost' => 2, 'percent' => 0, 'desc'=>'CREDINFORM'
								),
						3 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 
									'unitCost' => 1.2, 'percent' => 0, 'desc'=>'ENROLAMIENTO BIOMETRICO'
								),
						4 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 
									'unitCost' => 0, 'percent' => 0.75, 'desc'=>'EPSAS'
								),
						5 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
									'unitCost' => 1.5, 'percent' => 0, 'desc'=>'GRUPO KANTUTANI'
								),
						6 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 
									'unitCost' => 1, 'percent' => 0, 'desc'=>'JHALEA TUPPERWARE'
								),
						7 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'
								),
						8 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'
								),
						9 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 72 ,'servicio' => 'NATURA-NATURA', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'NATURA - ALTA ESTÉTICA'
								),
						10 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES',
									'unitCost' => 1.5, 'percent' => 0,
									'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
								),
						11 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS',
									'unitCost' => 2.2, 'percent' => 0, 
									'desc'=>'RENTA DIGNIDAD PAGOS'
								),
						12 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
									'unitCost' => 0.5, 'percent' => 0, 
									'desc'=>'SEGIP CI'
								),
						13 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
								   'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
								   'unitCost' => 0.9, 'percent' => 0, 
								   'desc'=>'SEGIP LICENCIA'
								),

						14 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
									'unitCost' => 0, 'percent' => 0.35, 'desc'=>'SEMAPA'),

						15 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
								   'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'SSO FUTURO'
								),
						16 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
							   	   'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 
							   	   'unitCost' => 2, 'percent' => 0, 
							   	   'desc'=>'SSO PREVISION'),
						17 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'
								),
						18 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'
								),
						19 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 0.75, 'desc'=>'UNIVIDA'
								),
						20 => array('entity'=>47, 'desc_enti'=>'COOP. SAN MARTIN DE PORRES', 
									'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
									'unitCost' => 1, 'percent' => 0, 'desc'=>'YANBAL'
								)
			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_san_francisco_solano($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

				0 => array('entity'=>3041, 'desc_enti'=>'COOP.A.C.SAN FRANCISCO SOLANO VILLAMONTE', 
							'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
							'unitCost' => 1.5, 'percent' => 0, 
							'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'),
				1 => array('entity'=>3041, 'desc_enti'=>'COOP.A.C.SAN FRANCISCO SOLANO VILLAMONTE', 
							'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
							'unitCost' => 2.2, 'percent' => 0, 
							'desc'=>'RENTA DIGNIDAD PAGOS')
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_la_merced($dateFrom, $dateTo){
		//suma  alianza vida y alianza largo plazo
		$arrayPrices = array( 
						0 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
								  'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA SEGUROS', 
								  'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA SEGUROS'
								),
						1 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
								   'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA VIDA', 
								   'unitCost' => 1.8, 'percent' => 0, 'desc'=>'ALIANZA VIDA'
								),
						2 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA VIDA LARGO PLAZO', 
									'unitCost' => 1.8, 'percent' => 0, 
									'desc'=>'ALIANZA VIDA - LARGO PLAZO'
								),
						3 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' =>88 ,'servicio' =>'BDP-BDP', 
									'unitCost' =>2, 'percent' =>0, 
									'desc'=>'BANCO DE DESARROLLO PRODUCTIVO'
								),
						4 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'GRUPO KANTUTANI'
								),
						5 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'JHALEA TUPPERWARE'
								),
						6 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 44 ,'servicio' => 'LBC-COBROS', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'LA BOLIVIANA CIACRUZ-COBROS'
								),
						7 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 83 ,'servicio' => 'MEMPARK-CMP', 
									'unitCost' => 1.8, 'percent' => 0, 
									'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'
								),
						8 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 83 ,'servicio' => 'MEMPARK-EMI', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'MEMORIAL PARK-MANANTIAL INVERSIONES'
								),
						9 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'
								),
						10 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 
									'unitCost' => 2, 'percent' => 0, 
									'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'
								),
						11 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA',
									'cli' => 72 ,'servicio' => 'NATURA-NATURA', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'NATURA - ALTA ESTÉTICA'
								),
						12 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 102 ,'servicio' => 'NOVILLO-CREDICASAS', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NOVILLO-CREDICASAS LAFUENTE'
								),
						13 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 102 ,'servicio' => 'NOVILLO-MI RANCHO', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NOVILLO - MI RANCHO'
								),
						14 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 50 ,'servicio' => 'NOVILLO-TIERRA QUINTA', 
									'unitCost' => 1.5, 'percent' => 0, 
									'desc'=>'NOVILLO - TIERRA QUINTA'
								),
						15 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES',
									'unitCost' => 1.5, 'percent' => 0,
									'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
								),
						16 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS',
									'unitCost' => 2.2, 'percent' => 0, 
									'desc'=>'RENTA DIGNIDAD PAGOS'
								),
						17 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
									'unitCost' => 0.5, 'percent' => 0, 
									'desc'=>'SEGIP CI'
								),
						18 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
								   'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
								   'unitCost' => 0.9, 'percent' => 0, 
								   'desc'=>'SEGIP LICENCIA'
								),
						19 => array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 48 ,'servicio' => 'TRANSBEL-TRANSBEL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'TRANSBEL'
								),
						20 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'
								),
						21 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'
								),
						22 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 0.75, 
									'desc'=>'UNIVIDA'
								),
						23 =>array('entity'=>42, 'desc_enti'=>'COOP.LA MERCED LTDA', 
									'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'YANBAL'
								)

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_loyola($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

				0 => array('entity'=>3006, 'desc_enti'=>'COOP.LOYOLA LTDA', 
							'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
							'unitCost' => 1.5, 'percent' => 0, 
							'desc'=>'GRUPO KANTUTANI'
						),
				1 => array('entity'=>3006, 'desc_enti'=>'COOP.LOYOLA LTDA', 
							'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
							'unitCost' => 1.5, 'percent' => 0, 
							'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
						),
				2 => array('entity'=>3006, 'desc_enti'=>'COOP.LOYOLA LTDA', 
							'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
							'unitCost' => 2.2, 'percent' => 0, 
							'desc'=>'RENTA DIGNIDAD PAGOS'
						),
				3 => array('entity'=>1005, 'desc_enti'=>'BANCO DE CREDITO', 
							'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
							'unitCost' => 0, 'percent' => 0.4, 
							'desc'=>'SEMAPA'
						)
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_magisterio_tarija($dateFrom, $dateTo){
	
		$arrayPrices = array( 

				 0 => array('entity'=>9085, 'desc_enti'=>'COOP.MAGISTERIO RURAL TARIJA LTDA', 
				 			'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 
				 			'unitCost' => 1.8, 'percent' => 0, 
				 			'desc'=>'BONOS-JUANA AZURDUY'
				 		),
				 1 => array('entity'=>9085, 'desc_enti'=>'COOP.MAGISTERIO RURAL TARIJA LTDA', 
				 			'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
				 			'unitCost' => 1.5, 'percent' => 0, 
				 			'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
				 		),
				 2 => array('entity'=>9085, 'desc_enti'=>'COOP.MAGISTERIO RURAL TARIJA LTDA', 
				 			'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
				 			'unitCost' => 2.2, 'percent' => 0, 
				 			'desc'=>'RENTA DIGNIDAD PAGOS'
				 		),
				
				 4 => array('entity'=>9085, 'desc_enti'=>'COOP.MAGISTERIO RURAL TARIJA LTDA', 
				 			'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
				 			'unitCost' => 0.5, 'percent' => 0, 
				 			'desc'=>'SEGIP CI'
				 		),
				 5 => array('entity'=>9085, 'desc_enti'=>'COOP.MAGISTERIO RURAL TARIJA LTDA', 
							'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
							'unitCost' => 0.9, 'percent' => 0, 
							'desc'=>'SEGIP LICENCIA'
						)
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_san_bermejo($dateFrom, $dateTo){
	
		$arrayPrices = array( 

				0 => array('entity'=>5004, 'desc_enti'=>'COOP.SAN JOSE DE BERMEJO', 
				 			'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
				 			'unitCost' => 1.5, 'percent' => 0, 
				 			'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
				 		),
				 1 => array('entity'=>5004, 'desc_enti'=>'COOP.SAN JOSE DE BERMEJO', 
				 			'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
				 			'unitCost' => 2.2, 'percent' => 0, 
				 			'desc'=>'RENTA DIGNIDAD PAGOS'
				 		)
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_san_pedro($dateFrom, $dateTo){

		$arrayPrices = array( 

				0 => array('entity'=>44, 'desc_enti'=>'COOP.SAN PEDRO', 
							'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 
							'unitCost' => 1.5, 'percent' => 0, 
							'desc'=>'GRUPO KANTUTANI'
						),
				1 => array('entity'=>44, 'desc_enti'=>'COOP.SAN PEDRO', 
							'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
							'unitCost' => 0, 'percent' => 0.38, 
							'desc'=>'SEMAPA'
						)
				
				);
	
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_tukuypaj($dateFrom, $dateTo){
	
		$arrayPrices = array( 

				 0 => array('entity'=>250, 'desc_enti'=>'COOP.TUKUYPAJ Ltda', 
				 			'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 
				 			'unitCost' => 1.8, 'percent' => 0, 
				 			'desc'=>'BONOS-JUANA AZURDUY'
				 		),
				 1 => array('entity'=>250, 'desc_enti'=>'COOP.TUKUYPAJ Ltda', 
				 			'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
				 			'unitCost' => 1.5, 'percent' => 0, 
				 			'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
				 		),
				 2 => array('entity'=>250, 'desc_enti'=>'COOP.TUKUYPAJ Ltda', 
				 			'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
				 			'unitCost' => 2.2, 'percent' => 0, 
				 			'desc'=>'RENTA DIGNIDAD PAGOS'
				 		),
				 3 =>  array('entity'=>250, 'desc_enti'=>'COOP.TUKUYPAJ Ltda', 
							'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
							'unitCost' => 0, 'percent' => 0.38, 
							'desc'=>'SEMAPA'
						)
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_cristo_rey($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA', 
						'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 
						'unitCost' => 1.8, 'percent' => 0, 
						'desc'=>'BONOS-JUANA AZURDUY'
					),
			1 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 
						'unitCost' => 1.2, 'percent' => 0, 
						'desc'=>'ENROLAMIENTO BIOMETRICO'
					),
			2 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'GRUPO KANTUTANI'
					),
			5 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
					),
			6 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
						'unitCost' => 2.2, 'percent' => 0, 
						'desc'=>'RENTA DIGNIDAD PAGOS'
					),
			
			7 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
						'unitCost' => 0.5, 'percent' => 0, 
						'desc'=>'SEGIP CI'
					),
			8 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
						'unitCost' => 0.9, 'percent' => 0, 
						'desc'=>'SEGIP LICENCIA'
					),
			9 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA', 
						'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
						'unitCost' => 0, 'percent' => 0.38, 
						'desc'=>'SEMAPA'
						),
			10 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
						'unitCost' => 0, 'percent' => 1, 
						'desc'=>'TUVES TV'
					),
			11 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
						'unitCost' => 0, 'percent' => 0.75, 
						'desc'=>'UNIVIDA'
					),
			12 => array('entity'=>217, 'desc_enti'=>'COOPERATIVA CRISTO REY CBBA.LTDA',
						'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
						'unitCost' => 1, 'percent' => 0, 
						'desc'=>'YANBAL'
					)
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_gra_grigota($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			
			0 => array('entity'=>9034, 'desc_enti'=>'COOPERATIVA GRAN GRIGOTA LTDA',
						'cli' => 40 ,'servicio' => 'KANTUTANI-KANTUTANI', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'GRUPO KANTUTANI'
					),
			1 => array('entity'=>9034, 'desc_enti'=>'COOPERATIVA GRAN GRIGOTA LTDA',
									'cli' => 72 ,'servicio' => 'NATURA-NATURA', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'NATURA - ALTA ESTÉTICA'
					),
			2 => array('entity'=>9034, 'desc_enti'=>'COOPERATIVA GRAN GRIGOTA LTDA',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
					),
			3 => array('entity'=>9034, 'desc_enti'=>'COOPERATIVA GRAN GRIGOTA LTDA',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
						'unitCost' => 2.2, 'percent' => 0, 
						'desc'=>'RENTA DIGNIDAD PAGOS'
					),
			4 => array('entity'=>9034, 'desc_enti'=>'COOPERATIVA GRAN GRIGOTA LTDA',
						'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
						'unitCost' => 0, 'percent' => 1, 
						'desc'=>'TUVES TV'
					)
		
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_san_mateo($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>3120, 'desc_enti'=>'COOPERATIVA SAN MATEO',
						'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'ENROLAMIENTO BIOMETRICO'
					),
		
			1 => array('entity'=>3120, 'desc_enti'=>'COOPERATIVA SAN MATEO',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
					),
			2 => array('entity'=>3120, 'desc_enti'=>'COOPERATIVA SAN MATEO',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
						'unitCost' => 2.2, 'percent' => 0, 
						'desc'=>'RENTA DIGNIDAD PAGOS'
					),
			
			3 => array('entity'=>3120, 'desc_enti'=>'COOPERATIVA SAN MATEO',
						'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
						'unitCost' => 0.5, 'percent' => 0, 
						'desc'=>'SEGIP CI'
					),
			4 => array('entity'=>3120, 'desc_enti'=>'COOPERATIVA SAN MATEO',
						'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
						'unitCost' => 0.9, 'percent' => 0, 
						'desc'=>'SEGIP LICENCIA'
					)
			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	
	private function coop_san_pedro_aiquile($dateFrom, $dateTo){
		//sumar pagos y franquicias
		$arrayPrices = array( 

			0 => array('entity'=>224, 'desc_enti'=>'COOPERATIVA SAN PEDRO DE AIQUILE',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES', 
						'unitCost' => 1.5, 'percent' => 0, 
						'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
					),
			1 => array('entity'=>224, 'desc_enti'=>'COOPERATIVA SAN PEDRO DE AIQUILE',
						'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS', 
						'unitCost' => 2.2, 'percent' => 0, 
						'desc'=>'RENTA DIGNIDAD PAGOS'
					)

			);
 
		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function coop_crecer($dateFrom, $dateTo){
		//suma  alianza vida y alianza largo plazo
		$arrayPrices = array( 

						0 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 
								   'unitCost' => 2, 'percent' => 0,
								   'desc'=>'BONOS-JUANA AZURDUY'
								),
						1 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA SEGUROS',
									'unitCost' => 1.8, 'percent' => 0, 
									'desc'=>'ALIANZA SEGUROS'
								),
						2 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA VIDA', 
								   'unitCost' => 1.8, 'percent' => 0, 
								   'desc'=>'ALIANZA VIDA'
								),
						3 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								  'cli' => 84 ,'servicio' =>'ALIANZA-ALIANZA VIDA LARGO PLAZO', 
								  'unitCost' => 1.8, 'percent' => 0, 
								  'desc'=>'ALIANZA VIDA - LARGO PLAZO'
								),
						4 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								  'cli' =>88 ,'servicio' =>'BDP-BDP', 
								  'unitCost' =>2, 'percent' =>0, 
								  'desc'=>'BANCO DE DESARROLLO PRODUCTIVO'
								),
						5 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 78 ,'servicio' => 'BBR', 
								   'unitCost' => 1.5, 'percent' => 0, 
								   'desc'=>'BOLIVIANA BIENES RAICES'
								),
						6 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 93 ,'servicio' => 'BOLIVIATEL-BOLIVIATEL', 
								   'unitCost' => 1, 'percent' => 0, 
								   'desc'=>'BOLIVIATEL COMTECO'
								),
						7 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD',
								   'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 
								   'unitCost' => 0, 'percent' => 0, 
								   'desc'=>'ENROLAMIENTO BIOMETRICO'
								),
						8 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 
								   'unitCost' => 0, 'percent' => 0.75, 
								   'desc'=>'EPSAS'
								),
						9 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								  'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
								  'unitCost' => 1.5, 'percent' => 0, 
								  'desc'=>'GRUPO KANTUTANI'
								),
						10 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 
								   'unitCost' => 1, 'percent' => 0, 
								   'desc'=>'JHALEA TUPPERWARE'
								),
						11 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD',
								   'cli' => 107 ,'servicio' => 'LA VITALICIA-LA VITALICIA', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'LA VITALICIA SEGUROS Y REASEGUROS'
								),
						12 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 67 ,'servicio' => 'MEGADEALERS-MEGADEALERS VIVA', 
								   'unitCost' => 0, 'percent' => 3.5, 
								   'desc'=>'MEGADEALERS - MEGADEALERS VIVA'
								),
						13 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD',
									'cli' => 72 ,'servicio' => 'NATURA-NATURA', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'NATURA - ALTA ESTÉTICA'
								),
						14 =>array('entity'=>7018, 'desc_enti'=>'CRECER IFD',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES',
									'unitCost' => 1.5, 'percent' => 0,
									'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
								),
						15 =>array('entity'=>7018, 'desc_enti'=>'CRECER IFD',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS',
									'unitCost' => 2.2, 'percent' => 0, 
									'desc'=>'RENTA DIGNIDAD PAGOS'
								),
						16 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
									'unitCost' => 0.5, 'percent' => 0, 
									'desc'=>'SEGIP CI'
								),
						17 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
								   'unitCost' => 0.9, 'percent' => 0, 
								   'desc'=>'SEGIP LICENCIA'
								),
						18 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
									'unitCost' => 0, 'percent' => 0.4, 
									'desc'=>'SEMAPA'
						),
						18 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 21 ,'servicio' => 'FUTURO-FUTURO', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'SSO FUTURO'
								),
						19 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
								   'cli' => 4 ,'servicio' => 'PREVISION-PREVISION', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'SSO PREVISION'
								),

						20 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 48 ,'servicio' => 'TRANSBEL-TRANSBEL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'TRANSBEL'
								),
						21 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'
								),
						22 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
							       'cli' => 62 ,'servicio' => 'UAB-UAB', 
							       'unitCost' => 1, 'percent' => 0, 
							       'desc'=>'UNIVERSIDAD AUTÓNOMA DEL BENI JOSE BALLIVIAN'
							   ),
						23 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 59 ,'servicio' => 'UAGRM-UAGRM', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENE MORENO'
								),
						24 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
							        'cli' => 58 ,'servicio' => 'UMSA-UMSA', 
							        'unitCost' => 0.8, 'percent' => 0, 
							        'desc'=>'UNIVERSIDAD MAYOR DE SAN ANDRES'
							    ),
						25 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 0.8, 
									'desc'=>'UNIVIDA'
								),
						26 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD', 
									'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'YANBAL'
								)

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}

	private function diaconia_entidad_desarrollo($dateFrom, $dateTo){
		//suma  alianza vida y alianza largo plazo
		$arrayPrices = array( 

						0 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 
								   'unitCost' => 1.8, 'percent' => 0,
								   'desc'=>'BONOS-JUANA AZURDUY'
								),
						1 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								  'cli' =>88 ,'servicio' =>'BDP-BDP', 
								  'unitCost' =>2, 'percent' =>0, 
								  'desc'=>'BANCO DE DESARROLLO PRODUCTIVO'
								),
						2 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 93 ,'servicio' => 'BOLIVIATEL-BOLIVIATEL', 
								   'unitCost' => 1, 'percent' => 0, 
								   'desc'=>'BOLIVIATEL COMTECO'
								),
						3 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
								   'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 
								   'unitCost' => 1.2, 'percent' => 0, 
								   'desc'=>'ENROLAMIENTO BIOMETRICO'
								),
						4 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 48 ,'servicio' => 'EPSAS-EPSAS', 
								   'unitCost' => 0, 'percent' => 0.75, 
								   'desc'=>'EPSAS'
								),
						5 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								  'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
								  'unitCost' => 1.5, 'percent' => 0, 
								  'desc'=>'GRUPO KANTUTANI'
								),
						6 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 
								   'unitCost' => 1, 'percent' => 0, 
								   'desc'=>'JHALEA TUPPERWARE'
								),
						7 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'
								),
						8 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
							       'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 
							       'unitCost' => 2, 'percent' => 0, 
							       'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'
							   ),
						9 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
									'cli' => 72 ,'servicio' => 'NATURA-NATURA', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'NATURA - ALTA ESTÉTICA'
								),
						10 =>array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES',
									'unitCost' => 1.5, 'percent' => 0,
									'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
								),
						11 =>array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS',
									'unitCost' => 2.2, 'percent' => 0, 
									'desc'=>'RENTA DIGNIDAD PAGOS'
								),
						12 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
									'unitCost' => 0.5, 'percent' => 0, 
									'desc'=>'SEGIP CI'
								),
						13 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
								   'unitCost' => 0.9, 'percent' => 0, 
								   'desc'=>'SEGIP LICENCIA'
								),
						14 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 95 ,'servicio' => 'SEMAPA-SEMAPA', 
									'unitCost' => 0, 'percent' => 0.35, 
									'desc'=>'SEMAPA'
								),
						15 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 48 ,'servicio' => 'TRANSBEL-TRANSBEL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'TRANSBEL'
								),
						16 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'
								),
						17 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 0.75, 
									'desc'=>'UNIVIDA'
								),
						18 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'YANBAL'
								)

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


		private function farmacorp_serviexpress($dateFrom, $dateTo){
		//suma  alianza vida y alianza largo plazo
		$arrayPrices = array(

						0 => array('entity'=>9015, 'desc_enti'=>'FARMACORP SERVIEXPRESS', 
							       'cli' => 84 ,'servicio' => 'ALIANZA-ALIANZA SEGUROS', 
							       'unitCost' => 1.8, 'percent' => 0, 
							       'desc'=>'ALIANZA SEGUROS'
							   ), 
						1 => array('entity'=>9015, 'desc_enti'=>'FARMACORP SERVIEXPRESS', 
								   'cli' => 109 ,'servicio' => 'AMASZONAS-AMASZONAS', 
								   'unitCost' => 1.25, 'percent' => 0, 
								   'desc'=>'AMASZONAS'
								),
						2 => array('entity'=>9015, 'desc_enti'=>'FARMACORP SERVIEXPRESS', 
								   'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 
								   'unitCost' => 1, 'percent' => 0, 
								   'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'
								),
						3 => array('entity'=>9015, 'desc_enti'=>'FARMACORP SERVIEXPRESS', 
							       'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 
							       'unitCost' => 2, 'percent' => 0, 
							       'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'
							   ),
						4 => array('entity'=>9015, 'desc_enti'=>'FARMACORP SERVIEXPRESS', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 
									'desc'=>'TUVES TV'
								),
						5 => array('entity'=>9015, 'desc_enti'=>'FARMACORP SERVIEXPRESS', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 1, 
									'desc'=>'UNIVIDA'
								)

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}


	private function fondeco($dateFrom, $dateTo){
		//suma  alianza vida y alianza largo plazo
		$arrayPrices = array( 

						0 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 50 ,'servicio' => 'BONOS-JUANA AZURDUY', 
								   'unitCost' => 1.8, 'percent' => 0,
								   'desc'=>'BONOS-JUANA AZURDUY'
								),
					

						2 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
								   'cli' => 0 ,'servicio' => 'ENROLAMIENTO BIOMETRICO', 
								   'unitCost' => 1.7, 'percent' => 0, 
								   'desc'=>'ENROLAMIENTO BIOMETRICO'
								),
					

						3 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								  'cli' => 40, 'servicio' => 'KANTUTANI-KANTUTANI', 
								  'unitCost' => 1.5, 'percent' => 0, 
								  'desc'=>'GRUPO KANTUTANI'
								),

						11 => array('entity'=>7018, 'desc_enti'=>'CRECER IFD',
								   'cli' => 107 ,'servicio' => 'LA VITALICIA-LA VITALICIA', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'LA VITALICIA SEGUROS Y REASEGUROS'
								),


						4 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 76 ,'servicio' => 'TUPPERWARE-TUPPERWARE', 
								   'unitCost' => 1, 'percent' => 0, 
								   'desc'=>'JHALEA TUPPERWARE'
								),


						7 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL SEGUROS', 
								   'unitCost' => 2, 'percent' => 0, 
								   'desc'=>'NACIONAL SEGUROS PATRIMONIALES Y FIANZAS'
								),
						8 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
							       'cli' => 77 ,'servicio' => 'NALVIDA-NACIONAL VIDA', 
							       'unitCost' => 2, 'percent' => 0, 
							       'desc'=>'NACIONAL VIDA SEGUROS DE PERSONAS'
							   ),


						9 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
									'cli' => 72 ,'servicio' => 'NATURA-NATURA', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'NATURA - ALTA ESTÉTICA'
								),




						10 =>array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-ACTUALIZACIONES',
									'unitCost' => 1.5, 'percent' => 0,
									'desc'=>'ACTUALIZACIONES - RENTA DIGNIDAD'
								),
						11 =>array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE',
									'cli' => 29 ,'servicio' => 'RENTA DIGNIDAD-PAGOS',
									'unitCost' => 2.2, 'percent' => 0, 
									'desc'=>'RENTA DIGNIDAD PAGOS'
								),
						12 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 CI', 
									'unitCost' => 0.5, 'percent' => 0, 
									'desc'=>'SEGIP CI'
								),
						13 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
								   'cli' => 108 ,'servicio' => 'SEGIP2-SEGIP2 LICENCIA', 
								   'unitCost' => 0.9, 'percent' => 0, 
								   'desc'=>'SEGIP LICENCIA'
								),
						
					
						14 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 70 ,'servicio' => 'TUVES-TUVES', 
									'unitCost' => 0, 'percent' => 1, 'desc'=>'TUVES TV'
								),
						15 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 118 ,'servicio' => 'UNIVIDA-Recaudacion', 
									'unitCost' => 0, 'percent' => 0.75, 
									'desc'=>'UNIVIDA'
								),
						16 => array('entity'=>9065, 'desc_enti'=>'DIACONIA-ENTIDAD FINANCIERA DE', 
									'cli' => 66 ,'servicio' => 'YANBAL-YANBAL', 
									'unitCost' => 1, 'percent' => 0, 
									'desc'=>'YANBAL'
								)

			);

		return $this->calculationCommissions($dateFrom, $dateTo, $arrayPrices);
	}



}


