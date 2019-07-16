<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Paginator;	
use App\TransactionImport;
use App\CommissionHistory;


class TransactionImportController extends Controller
{
	

	public function index(){
		
		$query = "";
		$dateFrom = "";
		$dateTo = "";

		return view('commission.index')->with(compact('query','dateFrom','dateTo'));
	}

	public function search(Request $Request){

		$listReports = array();
		$listCommission = array();

		$dateFrom = $Request->input('dateFrom');
		$dateTo = $Request->input('dateTo');
		$query = $Request->input('query');
		
		if(isset($dateFrom) && isset($dateTo))
		{ 
			array_push($listReports, $this->actualizacion($dateFrom,$dateTo));
			array_push($listReports, $this->alianza_vida($dateFrom,$dateTo));
			array_push($listReports, $this->alianza_seguros($dateFrom,$dateTo));
			array_push($listReports, $this->axs($dateFrom,$dateTo));
			array_push($listReports, $this->bbr($dateFrom,$dateTo));
			array_push($listReports, $this->bbr_renacer($dateFrom,$dateTo));
			array_push($listReports, $this->bdp($dateFrom,$dateTo));
			array_push($listReports, $this->bja($dateFrom,$dateTo));
			array_push($listReports, $this->bisa($dateFrom,$dateTo));
			array_push($listReports, $this->bisa_recaudaciones($dateFrom,$dateTo));
			array_push($listReports, $this->boliviatel($dateFrom,$dateTo));
			array_push($listReports, $this->digital($dateFrom,$dateTo));
			array_push($listReports, $this->cessa($dateFrom,$dateTo));
			array_push($listReports, $this->cmp($dateFrom,$dateTo));
			array_push($listReports, $this->credicasas($dateFrom,$dateTo));
			array_push($listReports, $this->credinform($dateFrom,$dateTo));
			array_push($listReports, $this->egpp($dateFrom,$dateTo));
			array_push($listReports, $this->epsas($dateFrom,$dateTo));
			array_push($listReports, $this->fortaleza($dateFrom,$dateTo));
			array_push($listReports, $this->futuro($dateFrom,$dateTo));
			array_push($listReports, $this->gamch($dateFrom,$dateTo));
			array_push($listReports, $this->itacamba($dateFrom,$dateTo));
			array_push($listReports, $this->jhalea($dateFrom,$dateTo));
			array_push($listReports, $this->kantutani($dateFrom,$dateTo));
			array_push($listReports, $this->la_vitalicia($dateFrom,$dateTo));
			array_push($listReports, $this->magadealter_viva($dateFrom,$dateTo));
			array_push($listReports, $this->men_park($dateFrom,$dateTo));
			array_push($listReports, $this->mi_rancho($dateFrom,$dateTo));
			array_push($listReports, $this->misiones($dateFrom,$dateTo));
			array_push($listReports, $this->nvida($dateFrom,$dateTo));
			array_push($listReports, $this->nseguro($dateFrom,$dateTo));
			array_push($listReports, $this->semapa($dateFrom,$dateTo));
			array_push($listReports, $this->setar($dateFrom,$dateTo));
			array_push($listReports, $this->segip($dateFrom,$dateTo));
			array_push($listReports, $this->prever($dateFrom,$dateTo));
			array_push($listReports, $this->prevision($dateFrom,$dateTo));
			array_push($listReports, $this->tierra($dateFrom,$dateTo));
			array_push($listReports, $this->transbel($dateFrom,$dateTo));
			array_push($listReports, $this->uagrm($dateFrom,$dateTo));
			array_push($listReports, $this->uab($dateFrom,$dateTo));
			$listCommission = collect($listReports);
		 	//dd($listReports);
		 	// metodo para guardar datos en la tabla historico
		 	//$this->saveCommissionHistory($listReports);

			if(isset($query)){
				
					$arraySearch = array(); 

					$count = 0;

					foreach($listReports as $lKey => $report){
							$queryDesc = trim(strtoupper($query));
							$queryName = trim(ucfirst(strtolower($query)));
				
							if($this->searchStrpos($report['description'],$queryDesc)){
								if($this->existsCounter($arraySearch,$lKey) == false){
									$arraySearch[$count]=$lKey;
								    $count++;
								}
							}
							
							if($this->searchStrpos($report['name'],$queryName)){
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
				
				//	echo "<pre>"; print_r($arraySearch); echo"</pre>";
				
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
  
  	return view('commission.index')->with(compact('listCommission','query','dateFrom','dateTo'));
		
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
	** Clàusula octava: (precio y forma de pago)
	** Precio
	** El Cliente se obliga a pagar al Proveedor por la prestaciòn del servicio, lo siguiente.
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    Menores a 1,750                 bs. 5,250
	**    de 1,751 a 5,000                                    bs. 2.80
	**    de 5,001 a 15,000                                   bs. 2.50 
	**    Mayor a 15,000									  bs. 2.20
	**
	**/

	public function jhalea($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 0 ,'until'=>1750, 'monthlyFixed' => 5250, 'unitCost'=>0 ) ,
						1 => array('from' => 1751 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>2.50 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.20 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TUPPERWARE-TUPPERWARE%")
	    ->where('cli','=',76)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TUPPERWARE-TUPPERWARE%")
	    ->where('cli','=',76)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;    	

	    //dd($dateFrom);
	    //$firstDate = $firstDate[0]->fecha;
		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }

	   /* return array('name'=>'Jhalea', 'description'=>'TUPPERWARE-TUPPERWARE','total_transaction' => $totalTransaction, 'total_billing'=> number_format($totalBilling, 2, ",", "."));*/

	   return array('name'=>'Jhalea', 'description'=>'TUPPERWARE-TUPPERWARE','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);

		//SELECT SUM(tot) FROM `transaction_import` WHERE servicio like ('%TUPPERWARE-TUPPERWARE%') ORDER BY enti ASC

	} 

/**
	** 
	** Precio
	** El Cliente se obliga a pagar al Proveedor por la prestaciòn del servicio, lo siguiente.
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    1-1200                 bs. 3480
	**    de 1201 a 5,000                                    bs. 2.80
	**    de 5,001 en adelante                               bs. 2.70 
	**
	**/

	public function mi_rancho($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1200, 'monthlyFixed' => 3480, 'unitCost'=>0 ) ,
						1 => array('from' => 1201 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.70 )
						);

		$totalBilling = 0;

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-MI RANCHO%")
	    ->where('cli','=',102)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-MI RANCHO%")
	    ->where('cli','=',102)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

		//dd($totalTransaction);
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling =  $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	   
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
		
		  return array('name'=>'Mi Rancho', 'description'=>'NOVILLO-MI RANCHO','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
//SELECT SUM(tot) FROM `transaction_import` WHERE servicio like ('%TUPPERWARE-TUPPERWARE%') ORDER BY enti ASC
	} 


   /**
	** Comisiòn por recaudaciòn
	** Precio
	** El Cliente se obliga a pagar al Proveedor por la prestaciòn del servicio, lo siguiente.
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 1,200                 bs. 3480
	**    de 1,201 a 5,000                                    bs. 2.80
	**    Mayores a 5,001                                     bs. 2.70 
	**
	**/

	public function tierra($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1200, 'monthlyFixed' => 3480, 'unitCost'=>0 ) ,
						1 => array('from' => 1201 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.70 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-TIERRA QUINTA%")
	    ->where('cli','=',102)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-TIERRA QUINTA%")
	    ->where('cli','=',102)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }

	     return array('name'=>'Tierra', 'description'=>'NOVILLO-TIERRA QUINTA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
//SELECT SUM(tot) FROM `transaction_import` WHERE servicio like ('%TUPPERWARE-TUPPERWARE%') ORDER BY enti ASC
	} 

 /**
	** Comisiòn por recaudaciòn
	** a.- Comisiòn fija mensual bs 3480 bolivianos. Que cubre hasta 1200 transacciones, una vez sobrepasadas las 1200 transacciones se cobrarà ùnicamente por transacciòn realizada segùn la siguiente tabla.
	** 
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 1,200                 bs. 3480
	**    de 1,201 a 5,000                                    bs. 2.80
	**    Mayores a 5,001                                     bs. 2.70 
	**
	**/

	public function credicasas($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1200, 'monthlyFixed' => 3480, 'unitCost'=>0 ) ,
						1 => array('from' => 1201 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.70 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-CREDICASAS%")
	    ->where('cli','=',102)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-CREDICASAS%")
	    ->where('cli','=',102)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;
		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }

	     return array('name'=>'Credicasas', 'description'=>'NOVILLO-CREDICASAS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);

	} 

	/**
	** 
	** Precio
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    1-1,000                                              bs. 4,50
	**    de 1,001 a 5,000                                     bs. 3,90
	**    de 5,001 a 15,000                                    bs. 3.70 
	**    15001- Adelante									   bs. 3.50
	**    CONSTO ADICIONAL  IMPRESIÒN DE FACTURA               bs. 0.70
	**/

	public function cmp($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 0, 'unitCost'=>4.50, 'additionalCostBilling' =>0.70 ) ,
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEMPARK-CMP CREDITO%")
	    ->where('cli','=',83)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEMPARK-CMP CREDITO%")
	    ->where('cli','=',83)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling1 =  $totalTransaction * $arrayPrices[0]['unitCost'];
	    	$totalBilling2 =  $totalTransaction * $arrayPrices[0]['additionalCostBilling'] ;
	    	$totalBilling = $totalBilling1 + $totalBilling1;
		}
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling1 =  $totalTransaction * $arrayPrices[1]['unitCost'];
	    	$totalBilling2 =  $totalTransaction * $arrayPrices[0]['additionalCostBilling'] ;
	    	$totalBilling = $totalBilling1 + $totalBilling2;
	    }
	    if ($totalTransaction > $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling1 =  $totalTransaction * $arrayPrices[2]['unitCost'];
	    	$totalBilling2 =  $totalTransaction * $arrayPrices[0]['additionalCostBilling'] ;
	    	$totalBilling = $totalBilling1 + $totalBilling2;
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from']){

	    	$totalBilling1 =  $totalTransaction * $arrayPrices[3]['unitCost'];
	    	$totalBilling2 =  $totalTransaction * $arrayPrices[0]['additionalCostBilling'] ;
	    	$totalBilling = $totalBilling1 + $totalBilling2;
	    }

	     return array('name'=>'CMP', 'description'=>'MEMPARK-CMP CREDITO','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);

	} 


	 /**
	** Comisiòn por recaudaciòn
	** Precio
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 1250
	**    5001-10000                                          bs. 1.80
	**    10001- ADELANTE                                     bs. 1.50 
	**    
	**/

	public function axs($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 1250, 'unitCost'=>0 ) ,
						1 => array('from' => 5001 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>1.80 ),
						2 => array('from' => 10001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%AXS-AXS%")
	    ->where('cli','=',34)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
		
		$firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%AXS-AXS%")
	    ->where('cli','=',34)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }

	     return array('name'=>'AXS', 'description'=>'AXS-AXS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	 /**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 10,000
	**    5001 en adelante                                    bs. 1.59
	**    
	**    Transaciones minimas    de  5000/ 3  = 1667                  
	**    Se saca el 3% 
	**    como son un grupo de tres empresa, el precio fijo se divide en tres.. 10,000 / 3 y 
	**/

	public function misiones($dateFrom, $dateTo){


		/*$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
		SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE fecha BETWEEN CAST( '$dateFrom' AS DATE) AND CAST('$dateTo' AS DATE) and cli=40 and servicio like ('%KANTUTANI-LAS MISIONES%') GROUP by enti, desc_enti
		) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-LAS MISIONES BS%')) 
		GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC) billingT"));*/

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>1.80, 'desc'=>'Transaciones minimas', 'minimumTransactions' => 5000),
						1 => array('from' => 5000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50, 'desc'=>'Transaciones excedentes a las minimas', 'minimumTransactions' => 0 )
						);
	
		$arrayCommission = array(

			'banco_bisa' => array('cli' => 40 ,'enti'=>4, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_credito' => array('cli' => 40 ,'enti'=>1005, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_fassil' => array('cli' => 40 ,'enti'=>54, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),

			'banco_fie' => array('cli' => 40 ,'enti'=>5005, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_bmsc' => array('cli' => 40 ,'enti'=>9, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),

			'banco_bnb' => array('cli' => 40 ,'enti'=>8, 'unitCost'=>2.50, 'desc'=>'comisiones_entidades'),

			'banco_prodem' => array('cli' => 40 ,'enti'=>5007, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_comunidad' => array('cli' => 40 ,'enti'=>71, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_ecofuturo' => array('cli' => 40 ,'enti'=>5006, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_solidario' => array('cli' => 40 ,'enti'=>1017, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),

			'incahuasi' => array('cli' => 40 ,'enti'=>9075, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'action_bolivia' => array('cli' => 40 ,'enti'=>8940, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'jesus_nazareno' => array('cli' => 40 ,'enti'=>40, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'sagrada_familia' => array('cli' => 40 ,'enti'=>7004, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'san_juaquin' => array('cli' => 40 ,'enti'=>9047, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'smartin_porres' => array('cli' => 40 ,'enti'=>47, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'lamerced' => array('cli' => 40 ,'enti'=>42, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'grigota' => array('cli' => 40 ,'enti'=>9034, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'loyola' => array('cli' => 40 ,'enti'=>3006, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'san_pedro' => array('cli' => 40 ,'enti'=>44, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'cristo_rey' => array('cli' => 40 ,'enti'=>217, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'crecer' => array('cli' => 40 ,'enti'=>7018, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'primera_vivienda' => array('cli' => 40 ,'enti'=>88, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'cosmeticos_yovi' => array('cli' => 40 ,'enti'=>9376, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'farmalux' => array('cli' => 40 ,'enti'=>8403, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'fotoco_leo' => array('cli' => 40 ,'enti'=>9368, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),
			'fondeco' => array('cli' => 40 ,'enti'=>9368, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'libreria_caliope' => array('cli' => 40 ,'enti'=>9439, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'myrstore' => array('cli' => 40 ,'enti'=>9124, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'puntoentel_perez' => array('cli' => 40 ,'enti'=>9139, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			's_belleza' => array('cli' => 40 ,'enti'=>8705, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			's_telefonia' => array('cli' => 40 ,'enti'=>8997, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'x_cobrar' => array('cli' => 40 ,'enti'=>9414, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'mutual_promotora' => array('cli' => 40 ,'enti'=>2004, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades')
		);

		$totalBilling = 0;
		$totalBilling3 = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionBISA = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',4)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionCREDITO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',1005)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	    
	    $trasanctionFASSIL = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',54)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionFIE = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',5005)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBMSC = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',9)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBNB = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',8)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionPRODEM = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',5007)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionPCOMUNIDAD = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',71)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		$trasanctionPECOFUTURO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',5006)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSOLIDARIO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',1017)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionACTIONB = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',8940)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionJNazareno = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSanMartinPorres = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',47)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	   
	    $trasanctionLaMerced = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',42)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionGrigota = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',9034)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionCrecer = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',7018)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionFondeco = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',9040)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionPrimeraVivienda = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->where('enti','=',88)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    $billingbisa= $arrayCommission['banco_bisa']['unitCost'] * $trasanctionBISA; 
		$billingcredito = $arrayCommission['banco_credito']['unitCost'] * $trasanctionCREDITO;
		$billingfassil = $arrayCommission['banco_fassil']['unitCost'] * $trasanctionFASSIL; 
		$billingfiel = $arrayCommission['banco_fie']['unitCost'] * $trasanctionFIE;
		$billingbmsc = $arrayCommission['banco_bmsc']['unitCost'] * $trasanctionBMSC;
		$billingbnb = $arrayCommission['banco_bnb']['unitCost'] * $trasanctionBNB; 
		$billingprodem = $arrayCommission['banco_prodem']['unitCost'] * $trasanctionPRODEM;
		$billingcomunidad = $arrayCommission['banco_comunidad']['unitCost'] * $trasanctionPCOMUNIDAD;
		$billingeco = $arrayCommission['banco_ecofuturo']['unitCost'] * $trasanctionPECOFUTURO;
		$billingsoliario = $arrayCommission['banco_solidario']['unitCost'] * $trasanctionSOLIDARIO;
		$billingaction = $arrayCommission['action_bolivia']['unitCost'] * $trasanctionACTIONB;
		$billingjesus = $arrayCommission['jesus_nazareno']['unitCost'] * $trasanctionJNazareno;
	   	$billingporres = $arrayCommission['smartin_porres']['unitCost'] * $trasanctionSanMartinPorres;
	  	$billinglamerced = $arrayCommission['lamerced']['unitCost'] * $trasanctionLaMerced; 
	   	$billinggrigota = $arrayCommission['grigota']['unitCost'] * $trasanctionGrigota;
	    $billingcrecer = $arrayCommission['crecer']['unitCost'] * $trasanctionCrecer; 
 		$billingfondeco = $arrayCommission['fondeco']['unitCost'] * $trasanctionFondeco;
	    $billingprimera = $arrayCommission['primera_vivienda']['unitCost'] * $trasanctionPrimeraVivienda;
 		 
 		$totalBilling1 = $billingbisa + $billingcredito + $billingfassil + $billingfiel + $billingbmsc + $billingbnb + $billingprodem + $billingcomunidad + $billingeco + $billingsoliario + $billingaction + $billingjesus + $billingporres + $billinglamerced + $billinggrigota + $billingcrecer + $billingfondeco + $billingprimera;

			if(count($firstDate) == 1)
				$dateFrom = $firstDate[0]->fecha;

		$additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  		
		if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	     	 $totalBilling3 =$arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCost'];

	    }
	    if ($totalTransaction >= $arrayPrices[0]['minimumTransactions']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	        
	        $totalBilling3 =$arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCost'];
	    }

	    
	   $subBilling1 =  $totalBilling1* 0.03;
	   $entitiesBilling = $totalBilling1 + $subBilling1;
		   
	   $totalBilling2 = $totalBilling3 + $additonialTransactions;
	   
	   $totalBilling = $entitiesBilling + $totalBilling2;

	     return array(
			0 => array('name'=>'Kantutani Las Misiones', 'description'=>'TRANSACCIONES MINIMAS','total_transaction' => $arrayPrices[0]['minimumTransactions'], 'total_billing'=> round($totalBilling3,2),'pu'=> round($arrayPrices[0]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 40000),
			1 => array('name'=>'Kantutani Las Misiones', 'description'=>'TRANSACCIONES ADICIONALES','total_transaction' => $additonialTransactions1, 'total_billing'=> round($additonialTransactions,2),'pu'=> round($arrayPrices[1]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 40000),
			2 => array('name'=>'Kantutani Las Misiones', 'description'=>'COSTO COMISION ENTIDADES FINANCIERAS MAS IT','total_transaction' => 1, 'total_billing'=> round($entitiesBilling,2),'pu'=> round($entitiesBilling,2), 'created_at'=>$dateFrom,'cli' => 40000),
			3 => array('name'=>'Kantutani Las Misiones', 'description'=>'TOTAL','total_transaction' => null, 'total_billing'=> round($totalBilling,2),'pu'=> null, 'created_at'=>$dateFrom,'cli' => 40000)
			);
	
	}

	/**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 10000                                        bs. 1.80
	**    transaccion Adicional                               bs. 1.50
	**    
	**    Transaciones minimas    de  5000/ 3  = 1667                  
	**    Se saca el 3% 
	**    como son un grupo de tres empresa, el precio fijo se divide en tres.. 10,000 / 3 y 
	**/

	public function kantutani($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>1.80, 'desc'=>'Transaciones minimas', 'minimumTransactions' => 10000),
						1 => array('from' => 10000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50, 'desc'=>'Transaciones excedentes a las minimas', 'minimumTransactions' => 0 )
						);
	
		$arrayCommission = array(

			'banco_bisa' => array('cli' => 40 ,'enti'=>4, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_credito' => array('cli' => 40 ,'enti'=>1005, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_fassil' => array('cli' => 40 ,'enti'=>54, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),

			'banco_fie' => array('cli' => 40 ,'enti'=>5005, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_bmsc' => array('cli' => 40 ,'enti'=>9, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),

			'banco_bnb' => array('cli' => 40 ,'enti'=>8, 'unitCost'=>2.50, 'desc'=>'comisiones_entidades'),

			'banco_prodem' => array('cli' => 40 ,'enti'=>5007, 'unitCost'=>1.70, 'desc'=>'comisiones_entidades'),

			'banco_comunidad' => array('cli' => 40 ,'enti'=>71, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_ecofuturo' => array('cli' => 40 ,'enti'=>5006, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'banco_solidario' => array('cli' => 40 ,'enti'=>1017, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),

			'sarco' => array('cli' => 40 ,'enti'=>215, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'incahuasi' => array('cli' => 40 ,'enti'=>9075, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'action_bolivia' => array('cli' => 40 ,'enti'=>8940, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'jesus_nazareno' => array('cli' => 40 ,'enti'=>40, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'sagrada_familia' => array('cli' => 40 ,'enti'=>7004, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'san_juaquin' => array('cli' => 40 ,'enti'=>9047, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'smartin_porres' => array('cli' => 40 ,'enti'=>47, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'loyola' => array('cli' => 40 ,'enti'=>3006, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'san_pedro' => array('cli' => 40 ,'enti'=>44, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'cristo_rey' => array('cli' => 40 ,'enti'=>217, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'crecer' => array('cli' => 40 ,'enti'=>7018, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'primera_vivienda' => array('cli' => 40 ,'enti'=>88, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'cosmeticos_yovi' => array('cli' => 40 ,'enti'=>9376, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'farmalux' => array('cli' => 40 ,'enti'=>8403, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'fotoco_leo' => array('cli' => 40 ,'enti'=>9368, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'libreria_caliope' => array('cli' => 40 ,'enti'=>9439, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'myrstore' => array('cli' => 40 ,'enti'=>9124, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'puntoentel_perez' => array('cli' => 40 ,'enti'=>9139, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			's_belleza' => array('cli' => 40 ,'enti'=>8705, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			's_telefonia' => array('cli' => 40 ,'enti'=>8997, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'x_cobrar' => array('cli' => 40 ,'enti'=>9414, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades'),

			'mutual_promotora' => array('cli' => 40 ,'enti'=>2004, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades')
		);

		$totalBilling = 0;
		$totalBilling3 = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionBISA = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',4)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionCREDITO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',1005)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	    
	    $trasanctionFASSIL = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',54)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionFIE = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',5005)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBMSC = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBNB = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',8)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionPRODEM = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',5007)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionPCOMUNIDAD = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',71)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		$trasanctionPECOFUTURO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',5006)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSOLIDARIO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',1017)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSARCO = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',215)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		$trasanctionINCAHUASI = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9075)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionACTIONB = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',8940)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionJNazareno = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSagradaF = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',7004)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		$trasanctionSanJoaquin = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9047)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSanMartinPorres = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',47)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionLoyola = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',3006)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionSanPedro = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',44)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionCristoRey = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',217)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionCrecer = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',7018)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionPrimeraVivienda = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',88)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionCosmeticos = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9376)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionFarmalux = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',8403)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionFotocoLeon = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9368)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionLibreriaCaliope = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9439)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		 $trasanctionMYRSTORE = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9124)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		 $trasanctionPuntoEPerez = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9139)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		 $trasanctionSBellezaCinthya = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',8705)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		 $trasanctionServicioTeleco = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',8997)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		 $trasanctionXcobrar = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',9414)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $trasanctionMutualPromotora = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->where('enti','=',2004)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');


	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    $billingbisa= $arrayCommission['banco_bisa']['unitCost'] * $trasanctionBISA; 
		$billingcredito = $arrayCommission['banco_credito']['unitCost'] * $trasanctionCREDITO;
		$billingfassil = $arrayCommission['banco_fassil']['unitCost'] * $trasanctionFASSIL; 
		$billingfiel = $arrayCommission['banco_fie']['unitCost'] * $trasanctionFIE;
		$billingbmsc = $arrayCommission['banco_bmsc']['unitCost'] * $trasanctionBMSC;
		$billingbnb = $arrayCommission['banco_bnb']['unitCost'] * $trasanctionBNB; 
		$billingprodem = $arrayCommission['banco_prodem']['unitCost'] * $trasanctionPRODEM;
		$billingcomunidad = $arrayCommission['banco_comunidad']['unitCost'] * $trasanctionPCOMUNIDAD;
		$billingeco = $arrayCommission['banco_ecofuturo']['unitCost'] * $trasanctionPECOFUTURO;
		$billingsoliario = $arrayCommission['banco_solidario']['unitCost'] * $trasanctionSOLIDARIO;
		$billingsarco = $arrayCommission['sarco']['unitCost'] * $trasanctionSARCO; 

		$billinginca = $arrayCommission['incahuasi']['unitCost'] * $trasanctionINCAHUASI;
		$billingaction = $arrayCommission['action_bolivia']['unitCost'] * $trasanctionACTIONB;
		$billingjesus = $arrayCommission['jesus_nazareno']['unitCost'] * $trasanctionJNazareno;
	    $billingsagrada = $arrayCommission['sagrada_familia']['unitCost'] * $trasanctionSagradaF;
	   	$billingjoaquin = $arrayCommission['san_juaquin']['unitCost'] * $trasanctionSanJoaquin;
	   	$billingporres = $arrayCommission['smartin_porres']['unitCost'] * $trasanctionSanMartinPorres;
	  	$billingloyola = $arrayCommission['loyola']['unitCost'] * $trasanctionLoyola; 
	   	$billingpedro = $arrayCommission['san_pedro']['unitCost'] * $trasanctionSanPedro;
	   	$billingrey = $arrayCommission['cristo_rey']['unitCost'] * $trasanctionCristoRey;
	    $billingcrecer = $arrayCommission['crecer']['unitCost'] * $trasanctionCrecer; 
	    $billingprimera = $arrayCommission['primera_vivienda']['unitCost'] * $trasanctionPrimeraVivienda;
	    $billingyovi = $arrayCommission['cosmeticos_yovi']['unitCost'] * $trasanctionCosmeticos;
	    $billingfarmalux = $arrayCommission['farmalux']['unitCost'] * $trasanctionFarmalux;
	   	$billingleo = $arrayCommission['fotoco_leo']['unitCost'] * $trasanctionFotocoLeon;
	   	$billingcaliope = $arrayCommission['libreria_caliope']['unitCost'] * $trasanctionLibreriaCaliope;
	    $billingstore = $arrayCommission['myrstore']['unitCost'] * $trasanctionMYRSTORE; 
	    $billingPerez = $arrayCommission['puntoentel_perez']['unitCost'] * $trasanctionPuntoEPerez;
	    $billingbelleza = $arrayCommission['s_belleza']['unitCost'] * $trasanctionSBellezaCinthya;
	    $billingtelefonia = $arrayCommission['s_telefonia']['unitCost'] * $trasanctionServicioTeleco;
	   	$billingcobrar = $arrayCommission['x_cobrar']['unitCost'] * $trasanctionXcobrar;
	 	$billingmutual = $arrayCommission['mutual_promotora']['unitCost'] * $trasanctionMutualPromotora;

 		 
 		$totalBilling1 = $billingbisa + $billingcredito + $billingfassil + $billingfiel + $billingbmsc + $billingbnb + $billingprodem + $billingcomunidad + $billingeco + $billingsoliario + $billingsarco + $billinginca + $billingaction + $billingjesus + $billingsagrada + $billingjoaquin + $billingporres + $billingloyola + $billingpedro + $billingrey + $billingcrecer + $billingprimera + $billingyovi + $billingfarmalux + $billingleo + $billingcaliope + $billingstore + $billingPerez + $billingbelleza + $billingtelefonia + $billingcobrar + $billingmutual;


	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


		/*$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (
				SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
				SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE fecha BETWEEN CAST( '$dateFrom' AS DATE) AND CAST('$dateTo' AS DATE) and cli=40 and servicio like ('%KANTUTANI-KANTUTANI%') GROUP by enti, desc_enti
				) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-KANTUTANI%')) 
				GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC
				) billingT"));
*/

		$additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  		
		if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	     	 $totalBilling3 =$arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCost'];

	    }
	    if ($totalTransaction > $arrayPrices[0]['minimumTransactions']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	        
	        $totalBilling3 =$arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCost'];
	    }

	    
	   $subBilling1 =  $totalBilling1* 0.03;
	   $entitiesBilling = $totalBilling1 + $subBilling1;
		   
	   $totalBilling2 = $totalBilling3 + $additonialTransactions;
	   
	   $totalBilling = $entitiesBilling + $totalBilling2;

	     return array(
			0 => array('name'=>'Kantutani', 'description'=>'TRANSACCIONES MINIMAS','total_transaction' => $arrayPrices[0]['minimumTransactions'], 'total_billing'=> round($totalBilling3,2),'pu'=> round($arrayPrices[0]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 40),
			1 => array('name'=>'Kantutani', 'description'=>'TRANSACCIONES ADICIONALES','total_transaction' => $additonialTransactions1, 'total_billing'=> round($additonialTransactions,2),'pu'=> round($arrayPrices[1]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 40),
			2 => array('name'=>'Kantutani', 'description'=>'COSTO COMISION ENTIDADES FINANCIERAS MAS IT','total_transaction' => 1, 'total_billing'=> round($entitiesBilling,2),'pu'=> round($entitiesBilling,2), 'created_at'=>$dateFrom,'cli' => 40),
			3 => array('name'=>'Kantutani', 'description'=>'TOTAL','total_transaction' => null, 'total_billing'=> round($totalBilling,2),'pu'=> null, 'created_at'=>$dateFrom,'cli' => 40)
			);
	}

	/**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 10,000
	**    5001 en adelante                                    bs. 1.59
	**    
	**    Transaciones minimas    de  5000/ 3  = 1667                  
	**    Se saca el 3% 
	**    como son un grupo de tres empresa, el precio fijo se divide en tres.. 10,000 / 3 y  
	**/

	public function prever($dateFrom, $dateTo){

/*		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (
					SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
					SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE fecha BETWEEN CAST( '$dateFrom' AS DATE) AND CAST('$dateTo' AS DATE) and cli=40 and servicio like ('%KANTUTANI-PREVER%') GROUP by enti, desc_enti
					) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-PREVER%')) 
					GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC
					) billingT"));*/
		$arrayPrices = array(
			0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.80, 'desc'=>'Transaciones minimas', 'minimumTransactions' => 0)
			);
		$arrayCommission = array(

			'banco_fie' => array('cli' => 40 ,'enti'=>5005, 'unitCost'=>2.00, 'desc'=>'comisiones_entidades'),
			'banco_bnb' => array('cli' => 40 ,'enti'=>8, 'unitCost'=>1.50, 'desc'=>'comisiones_entidades')
		);

		$totalBilling = 0;
		$totalBilling3 = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	   
	    $trasanctionFIE = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->where('enti','=',5005)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBNB = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->where('enti','=',8)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	  
		$billingfiel = $arrayCommission['banco_fie']['unitCost'] * $trasanctionFIE;
		$billingbnb = $arrayCommission['banco_bnb']['unitCost'] * $trasanctionBNB; 
		 
 		$totalBilling1 = $billingfiel + $billingbnb;

		if(count($firstDate) == 1)
				$dateFrom = $firstDate[0]->fecha;
		

	   $totalBilling3 = $totalTransaction * $arrayPrices[0]['unitCost'];
	   $subBilling1 =  $totalBilling1* 0.03;
	   $entitiesBilling = $totalBilling1 + $subBilling1;
		   
	  
	   
	   $totalBilling = $entitiesBilling + $totalBilling3;

	     return array(
			0 => array('name'=>'Kantutani Prever', 'description'=>'TRANSACCIONES','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling3,2),'pu'=> round($arrayPrices[0]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 40001),
			1 => array('name'=>'Kantutani Prever', 'description'=>'COSTO COMISION ENTIDADES FINANCIERAS MAS IT','total_transaction' => 1, 'total_billing'=> round($entitiesBilling,2),'pu'=> round($entitiesBilling,2), 'created_at'=>$dateFrom,'cli' => 40001),
			2 => array('name'=>'Kantutani Prever', 'description'=>'TOTAL','total_transaction' => null, 'total_billing'=> round($totalBilling,2),'pu'=> null, 'created_at'=>$dateFrom,'cli' => 40001)
			);
	}

/**
	** Clùusula Octava  (precio y forma de pago)
	** l. Los CONTRATANTES, se obligan a pagar a Sintesis por los servicios 
	**     prestados las siguientes comisiones:
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    Menores a 1,000                    bs. 5,000
	**    De 1,001 a 5,000                                     bs. 3.90
	**    De 5,001 a  15,000                                   bs. 3.70  
	**    Mayores a 15,000                                     bs. 3.50
	**
	**    Transaciones minimas    de  1000                    bs. 2.50
	**    Como son un grupo de 2 empresas se divide por 2
	**/

	public function bbr($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>2.50 ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BBR-BBR%")
	    ->where('cli','=',78)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BBR-BBR%")
	    ->where('cli','=',78)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed']/2; 
	    	  return array('name'=>'BBR', 'description'=>'BBR-BBR','total_transaction','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }

	     if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[2]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }

	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[3]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	    if($totalTransaction <> 0 && $totalTransaction > 0) 
	    	$totalBilling = $minimumTransactions + $additonialTransactions; 
	
	   return array('name'=>'BBR', 'description'=>'BBR-BBR','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}


	/**
	** Clùusula Octava  (precio y forma de pago)
	** l. Los CONTRATANTES, se obligan a pagar a Sintesis por los servicios 
	**     prestados las siguientes comisiones:
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    Menores a 1,000                    bs. 5,000
	**    De 1,001 a 5,000                                     bs. 3.90
	**    De 5,001 a  15,000                                   bs. 3.70  
	**    Mayores a 15,000                                     bs. 3.50
	**
	**    Transaciones minimas    de  1000                    bs. 2.50
	**    Como son un grupo de 2 empresas se divide por 2
	**/

	public function bbr_renacer($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>2.50 ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BBR-RENACER%")
	    ->where('cli','=',78)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BBR-RENACER%")
	    ->where('cli','=',78)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	 

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed']/2;

	    	 return array('name'=>'BBR Renacer', 'description'=>'BBR-RENACER','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }

	     if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[2]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }

	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[3]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    if($totalTransaction <> 0 && $totalTransaction > 0)
	           $totalBilling = $minimumTransactions + $additonialTransactions; 
		
	    return array('name'=>'BBR Renacer', 'description'=>'BBR-RENACER','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

/**
	** 
	**  
	**    Transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 0 a 2,000                       bs. 5,000
	**    De 2,001 a 5,000                                    bs. 2.00
	**    De 5,001 a  10,000                                  bs. 1.70  
	**    De 10,001 a 20,000                                  bs. 1.60
	**    Mayores a 20,000                                    bs. 1.50
	**
	**    Transaciones minimas    de  2000                    bs. 2.50
	**    
	**/

	public function digital($dateFrom, $dateTo){

		$unitCostMin= round((5000/2000),2);

		$arrayPrices = array(
						0 => array('from' => 0 ,'until'=>2000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 2000, 'unitCostMin'=>$unitCostMin ),
						1 => array('from' => 2001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.00 ),
						2 => array('from' => 5001 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>1.70 ),
						3 => array('from' => 10001 ,'until'=>20000, 'monthlyFixed' => 0, 'unitCost'=>1.60 ),
						4 => array('from' => 20001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%DIGITAL TV-DIGITAL TV%")
	    ->where('cli','=',43)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%DIGITAL TV-DIGITAL TV%")
	    ->where('cli','=',43)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
			
	    	 return array('name'=>'Digital', 'description'=>'DIGITAL TV-DIGITAL TV','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	     if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[2]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from'] && $totalTransaction <= $arrayPrices[3]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[3]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	    if ($totalTransaction >= $arrayPrices[4]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[4]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    if($totalTransaction <> 0 && $totalTransaction > 0) 
	    	$totalBilling = $minimumTransactions + $additonialTransactions; 
	
	    return array('name'=>'Digital', 'description'=>'DIGITAL TV-DIGITAL TV','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}


/**
	** 
	**  
	**    Transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 1000                       bs. 5,000
	**    De 1,001 a 5,000                                    bs. 3.90
	**    De 5,001 a  15,000                                  bs. 3.70  
	**    15,000-Adelante                                     bs. 3.50
	**
	**    Transaciones minimas    de  1000                    
	**    Cargo fijo / transaccion minimas -> 5,000/1,000      bs. 2.50
	**/

	public function men_park($dateFrom, $dateTo){

		$unitCostMin= round((5000/1000),2);

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>$unitCostMin ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEMPARK-EMI MANTENIMIENTO%")
	    ->where('cli','=',83)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEMPARK-EMI MANTENIMIENTO%")
	    ->where('cli','=',83)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
	    	 
	    	   	 return array('name'=>'Men Park', 'description'=>'MEMPARK-EMI MANTENIMIENTO','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	     if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[2]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[3]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    if($totalTransaction <> 0 && $totalTransaction > 0) 
	    	$totalBilling = $minimumTransactions + $additonialTransactions; 
	
	    return array('name'=>'Men Park', 'description'=>'MEMPARK-EMI MANTENIMIENTO','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**  en caso que el servicio se de Recaudación de primas de serguro
	**  
	**    Transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    Menores a 1000                       bs. 5,000
	**    De 1,001 a 5,000                                    bs. 4.90
	**    De 5,001 a  15,000                                  bs. 4.70  
	**    Mayores a 15,000                                    bs. 4.50
	**
	**    Transaciones minimas    de  1000                    
	**    Cargo fijo / transaccion minimas -> 5,000/1,000      bs. 5.00
	**/

	public function nvida($dateFrom, $dateTo){

		$unitCostMin= round((5000/1000),2);

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>$unitCostMin ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>4.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>4.70 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.50 )
						);

		$totalBilling = 0;
		$desctransacciones ='';
		$additonialTransactions = 0;
		$additonialTransactions1 = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NALVIDA-NACIONAL VIDA%")
	    ->where('cli','=',77)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NALVIDA-NACIONAL VIDA%")
	    ->where('cli','=',77)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	$desctransacciones = "TRANSACCIONES MINIMAS";

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
	    	  return array('name'=>'Nvida', 'description'=>'NALVIDA-NACIONAL VIDA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$pu = $arrayPrices[1]['unitCost'];
	    	$desctransacciones = "TRANSACCIONES ADICIONALES";

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	     if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	     	$pu = $arrayPrices[2]['unitCost'];
	     	$desctransacciones = "TRANSACCIONES ADICIONALES";

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[2]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	$pu = $arrayPrices[3]['unitCost'];
	    	$desctransacciones = "TRANSACCIONES ADICIONALES";

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[3]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    if($totalTransaction <> 0 && $totalTransaction > 0) 
	    	$totalBilling = $minimumTransactions + $additonialTransactions; 

	    return array(
					0 => array('name'=>'Nacional Seguros Vida', 'description'=>'TRANSACCIONES MINIMAS','total_transaction' => $arrayPrices[0]['minimumTransactions'], 'total_billing'=> round($arrayPrices[0]['monthlyFixed'],2),'pu'=> round(($arrayPrices[0]['monthlyFixed']/$arrayPrices[0]['minimumTransactions']),2), 'created_at'=>$dateFrom,'cli' => 77),
					1 => array('name'=>'Nacional Seguros Vida', 'description'=>$desctransacciones,'total_transaction' => $additonialTransactions1, 'total_billing'=> round($additonialTransactions,2),'pu'=> round($pu,2), 'created_at'=>$dateFrom,'cli' => 77),
					2 =>array('name'=>'Nacional Seguros Vida', 'description'=>'TOTAL','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2),'pu'=>null, 'created_at'=>$dateFrom,'cli' => 77)
					);
	}

	/**
	**  en caso que el servicio se de Recaudación de primas de serguro
	**  
	**    Transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    Menores a 1000                       bs. 5,000
	**    De 1,001 a 5,000                                    bs. 4.70
	**    De 5,001 a  15,000                                  bs. 4.50  
	**    Mayores a 15,000                                    bs. 4.40
	**
	**    Transaciones minimas    de  1000                    
	**    Cargo fijo / transaccion minimas -> 5,000/1,000      bs. 5.00
	**/

	public function nseguro($dateFrom, $dateTo){

		$unitCostMin= round((5000/1000),2);

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>$unitCostMin ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>4.70 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>4.50 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.40 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NALVIDA-NACIONAL SEGUROS%")
	    ->where('cli','=',77)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NALVIDA-NACIONAL SEGUROS%")
	    ->where('cli','=',77)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];

	    	return array('name'=>'Nseguro', 'description'=>'NALVIDA-NACIONAL SEGUROS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	     if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[2]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[3]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    if($totalTransaction <> 0 && $totalTransaction > 0) 
	    	$totalBilling = $minimumTransactions + $additonialTransactions; 
	
	     return array('name'=>'Nseguro', 'description'=>'NALVIDA-NACIONAL SEGUROS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**  Calculo de la comisiòn
	**  
	**    Rango de facturas generadas       Precio unitario por transacción
	**                                      aplicando Facturación Electrónica
	**    De 0 a 5000 Factura generadas                        0.31
	**     generadas en un mes                                                        
	**    De 50,001 a 100,000 facturas						   0.29
	**     generadas en un mes                                
	**    Mas de 100,000 facturadas                            0.27                               , 
	**     generadas en un mes                                    
	**
	**/

	public function bisa($dateFrom, $dateTo){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>50000, 'monthlyFixed' => 0, 'unitCost'=>0.31),
						1 => array('from' => 50001 ,'until'=>100000, 'monthlyFixed' => 0, 'unitCost'=>0.29 ),
						2 => array('from' => 100000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0.27 )
						);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BISA-SEGUROS-BISA SEGUROS%")
	    ->where('cli','=',56)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BISA-SEGUROS-BISA SEGUROS%")
	    ->where('cli','=',56)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[0]['unitCost'];
	    }

	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }

	    if ($totalTransaction > $arrayPrices[2]['from']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	   return array('name'=>'Bisa', 'description'=>'BISA-SEGUROS-BISA SEGUROS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**  La retribución del servicio lo siguiente.
	**  
	**    Rango de Recaudaciones(Bs)       Precio unitario por transacción
	**                                      en Moneda Nacional (Bs)
	**    1 a 25,000                                        4.10
	**    25,001 a 50,000         						    4.00
	**    50,001 a 100,000                                  3.90                               
	**    100,001 a 200,000                                 3.80   
	**    200,001 o más                                     3.70                              
	**
	**/

	public function bisa_recaudaciones($dateFrom, $dateTo){

		$arrayPrices = array(
					0 => array('from' => 1 ,'until'=>25000, 'monthlyFixed' => 0, 'unitCost'=>4.10),
					1 => array('from' => 25001 ,'until'=>50000, 'monthlyFixed' => 0, 'unitCost'=>4.00 ),
					2 => array('from' => 50001 ,'until'=>100000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
					3 => array('from' => 100001 ,'until'=>200000, 'monthlyFixed' => 0, 'unitCost'=>3.80 ),
					4 => array('from' => 200001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.70 )
				);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BISA SEGUROS COBROS-Recaudacion Bisa Seguro%")
	    ->where('cli','=',122)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BISA SEGUROS COBROS-Recaudacion Bisa Seguro%")
	    ->where('cli','=',122)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[0]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from'] && $totalTransaction <= $arrayPrices[3]['until']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[4]['from']){

	    	 $totalBilling = $totalTransaction * $arrayPrices[4]['unitCost'];
	    }
	    return array('name'=>'Bisa Recaudaciones', 'description'=>'BISA SEGUROS COBROS-Recaudacion Bisa Seguro','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}


/**
	**  Precio y forma de pago.
	**  
	**   Item                                         Precio por registro
	**                                      
	**    Certificados Tele Educación                          Bs. 0.60
	**    Diplomados										   Bs. 2.50
	**	  Cursos  											   Bs. 1.60	
	**
	**/

	public function egpp($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 1 ,'until'=>50000, 'monthlyFixed' => 0, 'unitCost'=>0.60, 'description' =>'Certificados'),
				1 => array('from' => 1 ,'until'=>50000, 'monthlyFixed' => 0, 'unitCost'=>1.60, 'description' =>'Curso' ),
				2 => array('from' => 1 ,'until'=>50000, 'monthlyFixed' => 0, 'unitCost'=>2.50, 'description' =>'Diplomados' )
			);

		$totalBilling = 0;
		
		$totalTransactionCert = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EGPP-EGPP-CERTIFICADOS%")
	    ->where('cli','=',85)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	    $totalTransactionCur = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EGPP-EGPP-CURSOS%")
	    ->where('cli','=',85)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	    $totalTransactionDipl = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EGPP-EGPP-DIPLOMADOS%")
	    ->where('cli','=',85)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EGPP-EGPP-CERTIFICADOS%")
	    ->where('cli','=',85)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    if ($arrayPrices[0]['description'] =='Certificados'){

	    	 $totalBilling1 = $totalTransactionCert * $arrayPrices[0]['unitCost'];
	    }

	    if ($arrayPrices[1]['description'] =='Curso'){

	    	 $totalBilling2 = $totalTransactionCur * $arrayPrices[1]['unitCost'];
	    }

	    if ($arrayPrices[2]['description'] =='Diplomados'){

	    	 $totalBilling3 = $totalTransactionDipl * $arrayPrices[2]['unitCost'];
	    }

	    $totalBilling = $totalBilling1 + $totalBilling2 + $totalBilling3;

	  $totalTransactionCCD = $totalTransactionCert+$totalTransactionCur+$totalTransactionDipl;

	  return array(
					0 => array('name'=>'Egpp', 'description'=>'CERTIFICADOS TELE EDUCACION','total_transaction' => $totalTransactionCert, 'total_billing'=> round($totalBilling1,2),'pu'=> $arrayPrices[0]['unitCost'], 'created_at'=>$dateFrom, 'cli' => 85),
					1 => array('name'=>'Egpp', 'description'=>'DIPLOMADOS','total_transaction' => $totalTransactionDipl, 'total_billing'=> round($totalBilling3,2),'pu'=>$arrayPrices[2]['unitCost'], 'created_at'=>$dateFrom, 'cli' => 85),
					2 => array('name'=>'Egpp', 'description'=>'CURSOS CORTOS','total_transaction' => $totalTransactionCur, 'total_billing'=> round($totalBilling2,2),'pu'=> $arrayPrices[1]['unitCost'], 'created_at'=>$dateFrom, 'cli' => 85),
					3 => array('name'=>'Egpp', 'description'=>'TOTAL','total_transaction' => $totalTransactionCCD, 'total_billing'=> round($totalBilling,2),'pu'=> null, 'created_at'=>$dateFrom, 'cli' => 85)
				);

	  /* return array('name'=>'Egpp', 'description'=>'EGPP-CERTIFICADOS-CURSOS-DIPLOMADOS','total_transaction' => $totalTransactionCCD, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);*/
	}

	/**
	**  
	**    Transacciones Mensuales    Cargo Fijo minimo    Costo Unitario
	**    De 1 a 1900                        bs. 5,000
	**    De 1,901 a 5,000                                    bs. 3.00
	**    De 5,000 a  15,000                                  bs. 2.80  
	**    Mayor 15,000                                        bs. 2.60
	**
	**/

	public function bdp($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 1 ,'until'=>1900, 'monthlyFixed' => 5700, 'unitCost'=>0 ),
				1 => array('from' => 1901 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>1.00),
				2 => array('from' => 5000 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>0.80),
				3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0.60)
			);
		$arrayCost = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.00, 'codEnti' => 0, 'desc_enti' =>'varias entidades'),
				1 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50, 'codEnti' => 20, 'desc_enti' =>'Banco Union S.A.')
			);

		$totalBilling = 0;
		$totalBilling1 = 0;
		$totalCanal = 0;
		$totalCanalBU = 0;

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BDP-BDP%")
	    ->where('cli','=',88)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
		
	    $listTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BDP-BDP%")
	    ->where('cli','=',88)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->get();
	    
	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BDP-BDP%")
	    ->where('cli','=',88)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();
		
		foreach($listTransaction as $csvalue){
			
			if($csvalue->enti == $arrayCost[1]['codEnti']){
				$totalCanalBU = ($csvalue->tot * $arrayCost[1]['unitCost']);
				
			}else{
				$totalCanal += ($csvalue->tot * $arrayCost[0]['unitCost']);
			}
		}

	    

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling1 = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling1 = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling1 = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	$totalBilling1 = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }

	    $totalBilling = $totalBilling1+($totalCanal+$totalCanalBU);
 
	   return array('name'=>'BDP', 'description'=>'BDP-BDP','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**  
	**    Transacciones Mensuales    Cargo Fijo minimo    Costo Unitario
	**    De 0 a 1000                     bs. 5600
	**    De 1,001 a 5,000                                    bs. 5.2
	**    De 5,001 a  10,000                                  bs. 4.8  
	**    Mayor 10,001                                        bs. 4.3
	**
	**/

	public function la_vitalicia($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 1 ,'until'=>1900, 'monthlyFixed' => 5600, 'unitCost'=>0 ),
				1 => array('from' => 1901 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>5.20),
				2 => array('from' => 5001 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>4.80),
				3 => array('from' => 10001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.30)
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%LA VITALICIA-LA VITALICIA%")
	    ->where('cli','=',107)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%LA VITALICIA-LA VITALICIA%")
	    ->where('cli','=',107)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }

	    return array('name'=>'La Vitalicia', 'description'=>'LA VITALICIA-LA VITALICIA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**  
	**    Transacciones Mensuales    Cargo Fijo minimo    Costo Unitario
	**    De 1 a 1000                     bs. 5000
	**    De 1,001 a 5,000                                    bs. 4.1
	**    De 5,001 a  15,000                                  bs. 3.8  
	**    Mayor 15,001                                        bs. 3.5
	**
	**/

	public function alianza_vida($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0 ),
				1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>4.10),
				2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.80),
				3 => array('from' => 15001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50)
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%ALIANZA-ALIANZA VIDA%")
	    ->where('cli','=',84)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%ALIANZA-ALIANZA VIDA%")
	    ->where('cli','=',84)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }

	    return array('name'=>'Alianza Vida', 'description'=>'ALIANZA-ALIANZA VIDA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio unitario 1.95
	**   
	**
	**/

	public function boliviatel($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.95 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "BOLIVIATEL-BOLIVIATE%")
	    ->where('cli','=',93)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "BOLIVIATEL-BOLIVIATE%")
	    ->where('cli','=',93)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;
	    
	  
	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	     return array('name'=>'Boliviatel', 'description'=>'BOLIVIATEL-BOLIVIATE','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio unitario 0.55
	**   
	**
	**/

	public function cessa($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0.55 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "CESSA-CESSA%")
	    ->where('cli','=',116)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "CESSA-CESSA%")
	    ->where('cli','=',116)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	  
	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'Cessa', 'description'=>'CESSA-CESSA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio unitario 4.95
	**   
	**
	**/

	public function actualizacion($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.95 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "RENTA DIGNIDAD-ACTUALIZACIONES RENTA%")
	    ->where('cli','=',29)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "RENTA DIGNIDAD-ACTUALIZACIONES RENTA%")
	    ->where('cli','=',29)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	  
	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'Actualizacion', 'description'=>'RENTA DIGNIDAD-ACTUALIZACIONES RENTA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}
	/**
	**   Por recaudaciòn  0.82% del total de lo recaudado
	**   
	**
	**/
	public function gamch($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0, 'percent'=>0.82 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "GAMCB-GAMCB%")
	    ->where('cli','=',117)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $totalCollected = DB::table('transaction_import')
	    ->where('servicio', 'like', "GAMCB-GAMCB%")
	    ->where('cli','=',117)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('valTot');
	  
		$firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "GAMCB-GAMCB%")
	    ->where('cli','=',117)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $totalBilling = round(($arrayPrices[0]['percent'] * $totalCollected)/100, 2);
	  
	    return array('name'=>'Gamch', 'description'=>'GAMCB-GAMCB','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio unitario 2 bs
	**   
	**
	**/

	public function uagrm($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.00 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "UAGRM-UAGRM%")
	    ->where('cli','=',59)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "UAGRM-UAGRM%")
	    ->where('cli','=',59)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'UAGRM', 'description'=>'UAGRM-UAGRM','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Por recaudaciòn  0.90% del total de lo recaudado
	**   
	**
	**/

	public function semapa($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0, 'percent'=>0.90 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "SEMAPA-SEMAPA%")
	    ->where('cli','=',95)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $totalCollected = DB::table('transaction_import')
	    ->where('servicio', 'like', "SEMAPA-SEMAPA%")
	    ->where('cli','=',95)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('valTot');
	  
	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "SEMAPA-SEMAPA%")
	    ->where('cli','=',95)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $totalBilling = round(($arrayPrices[0]['percent'] * $totalCollected)/100, 2);
	  
	     return array('name'=>'Semapa', 'description'=>'SEMAPA-SEMAPA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio unitario 0.50 bs
	**   
	**
	**/

	public function setar($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0.50 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "SETAR-Recaudacion SETAR%")
	    ->where('cli','=',41)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "SETAR-Recaudacion SETAR%")
	    ->where('cli','=',41)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'Setar', 'description'=>'SETAR-Recaudacion SETAR','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio unitario 3.10 bs
	**   
	**
	**/

	public function bja($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.10 )
			);

		$totalBilling = 0;

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "BONOS-JUANA AZURDUY%")
	    ->where('cli','=',50)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "BONOS-JUANA AZURDUY%")
	    ->where('cli','=',50)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'BJA', 'description'=>'BONOS-JUANA AZURDUY','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	** Clàusula octava: (precio y forma de pago)
	** Precio
	** El Cliente se obliga a pagar al Proveedor por la prestaciòn del servicio, lo siguiente.
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    1 hasta 2,000                 bs. 15,000
	**    2,001 hasta 4,000                                 bs. 10.60
	**    4,001 a 6,000                                   	bs. 9.60 
	**    6001 y màs     									bs. 8.80
	**
	**/

	public function itacamba($dateFrom, $dateTo){

		$arrayPrices = array(
					0 => array('from' => 1 ,'until'=>2000, 'monthlyFixed' => 15000, 'unitCost'=>0 ) ,
					1 => array('from' => 2001 ,'until'=>4000, 'monthlyFixed' => 0, 'unitCost'=>10.60 ),
					2 => array('from' => 4001 ,'until'=>6000, 'monthlyFixed' => 0, 'unitCost'=>9.60 ),
					3 => array('from' => 6001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>8.80 )
					);
		$conciliation = array(
					0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 5000, 'unitCost'=>0, 'amountService'=> 1 )
				);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%ITACAMBA-Recaudacion%")
	    ->where('cli','=',121)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%ITACAMBA-Recaudacion%")
	    ->where('cli','=',121)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;    	

	    //dd($dateFrom);
	    //$firstDate = $firstDate[0]->fecha;
		
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    	$desctransacciones = "TRANSACCIONES";
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    	$desctransacciones = "TRANSACCIONES";
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    	$desctransacciones = "TRANSACCIONES";
	    }
	    if ($totalTransaction >= $arrayPrices[3]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    	$desctransacciones = "TRANSACCIONES";
	    }

		$pu =$arrayPrices[0]['monthlyFixed'] / $totalTransaction;

	   return array(
					0 => array('name'=>'ItaCamba', 'description'=> 'CARGO FIJO MENSUAL POR SERVICIO DE CONCILIACION','total_transaction' => $conciliation[0]['amountService'], 'total_billing'=> round($conciliation[0]['monthlyFixed'],2),'pu'=> round($conciliation[0]['monthlyFixed'],2), 'created_at'=>$dateFrom,'cli' => 121),
					1 => array('name'=>'ItaCamba', 'description'=>$desctransacciones,'total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2),'pu'=> round($pu,2), 'created_at'=>$dateFrom,'cli' => 121),
					2 =>array('name'=>'ItaCamba', 'description'=>'TOTAL','total_transaction' => null, 'total_billing'=> round(($arrayPrices[0]['monthlyFixed']+$conciliation[0]['monthlyFixed']),2),'pu'=> null, 'created_at'=>$dateFrom,'+cli' => 121)
					);

	} 

	/**
	**   Precio unitario 2.50 bs
	**   
	**
	**/

	public function uab($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.50 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%UAB-UAB%")
	    ->where('cli','=',62)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%UAB-UAB%")
	    ->where('cli','=',62)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'Uab', 'description'=>'UAB-UAB','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Porcentaje 0,10 %
	**   
	**
	**/

	public function magadealter_viva($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0, 'percent'=>0.10)
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEGADEALERS-MEGADEALERS VIVA%")
	    ->where('cli','=',67)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $totalCollected = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEGADEALERS-MEGADEALERS VIVA%")
	    ->where('cli','=',67)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('valTot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEGADEALERS-MEGADEALERS VIVA%")
	    ->where('cli','=',67)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $totalBilling = $arrayPrices[0]['percent'] * $totalCollected;
			  
	    return array('name'=>'Magadealers Viva', 'description'=>'MEGADEALERS-MEGADEALERS VIVA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   Precio
	**   
	**
	**/

	public function epsas($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0, 'percent'=>0.01)
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EPSAS-EPSAS%")
	    ->where('cli','=',48)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	     $totalCollected = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EPSAS-EPSAS%")
	    ->where('cli','=',48)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('valTot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%EPSAS-EPSAS%")
	    ->where('cli','=',48)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    $totalBilling = $arrayPrices[0]['percent'] * $totalCollected;
			  
	    return array('name'=>'Epsas', 'description'=>'EPSAS-EPSAS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}



	/**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 10,000
	**    5001 en adelante                                    bs. 1.59
	**    
	**    Transaciones minimas    de  5000/ 3  = 1667                  
	**    Se saca el 3% 
	**    como son un grupo de tres empresa, el precio fijo se divide en tres.. 10,000 / 3 y 
	**/

	public function transbel($dateFrom, $dateTo){

		$totalBilling = 0;
    	$totalBillingBPE = 0;
    	$totalBillingCAB = 0;
    	$totalBillingCML = 0;
    	$totalBillingCI = 0; 
    	$totalBillingPM = 0;
    	$totalBillingDEFD = 0; 

		$arrayPrices = array(
						0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1, 'minimumTransactions' => 0, 'unitCostMin'=>0 )
						);

		$arrayPricesMP = array(
						0 => array('from' => 0 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>1.10, 'minimumTransactions' => 0, 'unitCostMin'=>0 ),
						1 => array('from' => 0 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>1, 'minimumTransactions' => 0, 'unitCostMin'=>0 ),
						2 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0.9, 'minimumTransactions' => 0, 'unitCostMin'=>0, 'additional'=>'si' )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	    
	    // suma de todas las entides con MP
	    $totalTransactionMP = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('desc_enti', 'like', "MP%")
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		// Total transaccion Banco Pyme ecofuturo
	    $totalTransactionBPE = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('enti','=',5006)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    // Comercializadora action Bolivia
	    $totalTransactionCAB = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('enti','=',8940)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
    
	    //Coop la merced LTDA
		$totalTransactionCML = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('enti','=',42)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    // CRECER IFD
	    $totalTransactionCI = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('enti','=',7018)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    // Diacona entidad financiera de desarrollo
	    $totalTransactionDEFD = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('enti','=',9065)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    //Pro mujer
	    $totalTransactionPM = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->where('enti','=',9038)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TRANSBEL-TRANSBEL%")
	    ->where('cli','=',60)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;
//dd($totalTransaction);
    	$totalBilling1 = $totalTransaction * 1;
    	$totalBillingMP = $totalTransactionMP * 1;
    	$totalBillingBPE = $totalTransactionBPE * 1;
    	$totalBillingCAB = $totalTransactionCAB * 1;
    	$totalBillingCML = $totalTransactionCML * 1;
    	$totalBillingCI = $totalTransactionCI * 1; 
    	$totalBillingDEFD = $totalTransactionDEFD * 1;
    	$totalBillingPM = $totalTransactionPM * 1;

	
		$totalTransactionAll = $totalTransactionMP+$totalTransactionBPE+$totalTransactionCAB+$totalTransactionCML+$totalTransactionCI+$totalTransactionDEFD+$totalTransactionPM;

		$totalBillingAll = $totalBillingMP + $totalBillingBPE + $totalBillingCAB + $totalBillingCML + $totalBillingCI + $totalBillingDEFD + $totalBillingPM;

		$totalBilling2 = $totalTransaction * $arrayPrices[0]['unitCost'];

    	$totalBillingMP = 0;
    	$billingMP1   = 0;
    	$billingMP2 = 0;

	   /*if ($totalTransactionMP <= $arrayPricesMP[0]['until']){

	     	 $totalBillingMP = $totalTransactionMP * $arrayPricesMP[0]['unitCost'];
	    }else{
	    		$totalBillingMP = $arrayPricesMP[0]['until'] * $arrayPricesMP[0]['unitCost'];

	    		$billingMP =  $totalTransactionMP - $arrayPricesMP[0]['until'];

	    		if($billingMP <= $arrayPricesMP[1]['until']){
	    			$billingMP1 =  $billingMP * $arrayPricesMP[1]['unitCost'];
	    		}else{
	    				$billingMP1 = $arrayPricesMP[1]['until'] * $arrayPricesMP[1]['unitCost'];
	    				
	    				$billingMP = $billingMP - $arrayPricesMP[1]['until'];

	    				$billingMP2 = $billingMP * $arrayPricesMP[2]['unitCost'];

	    		}
	    }*/

	    $totalBilling = $totalBilling1 + $totalBillingAll;

	    return array(
					0 => array('name'=>'Transbel', 'description'=>'TRANSACCIONES','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling2,2),'pu'=> round($arrayPrices[0]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 60),
					1 => array('name'=>'Transbel', 'description'=>'COSTO COMISION A ENTIDADES FINANCIERAS','total_transaction' => 1, 'total_billing'=> round($totalBillingAll,2),'pu'=> round($totalTransactionAll,2), 'created_at'=>$dateFrom,'cli' => 60),
					2 => array('name'=>'Transbel', 'description'=>'TOTAL','total_transaction' => null, 'total_billing'=> round($totalBilling,2), 'pu'=> null, 'created_at'=>$dateFrom,'cli' => 60)
					);


	}

	/**
	**   Precio unitario 4.1
	**   
	**
	**/

	public function alianza_seguros($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.1, 'percent'=>0 )
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%ALIANZA-ALIANZA SEGUROS%")
	    ->where('cli','=',84)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

		$firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%ALIANZA-ALIANZA SEGUROS%")
	    ->where('cli','=',84)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


	    $totalBilling = $arrayPrices[0]['unitCost'] * $totalTransaction;
	  
	    return array('name'=>'Alianza seguros', 'description'=>'ALIANZA-ALIANZA SEGUROS','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**   precio unitario sintesis y entidades recaudadoras.
	**   
	**/

	public function segip($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0, 'percent'=>0, 'sintesisCI'=>0.35, 'eerrCI'=>0.50, 'sumaCI'=>0.85 ),
				1 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>0, 'percent'=>0, 'sintesisLIC'=>0.92, 'eerrLIC'=>0.90, 'sumaLIC'=>1.82 )
			);

		$totalBilling = 0;
		
		$totalTransactionCI = DB::table('transaction_import')
	    ->where('servicio', 'like', "%SEGIP2-SEGIP2 CI%")
	    ->where('cli','=',108)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $totalTransactionLIC = DB::table('transaction_import')
	    ->where('servicio', 'like', "%SEGIP2-SEGIP2 LICENCIA%")
	    ->where('cli','=',108)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBU_CI = DB::table('transaction_import')
	    ->where('servicio', 'like', "%SEGIP2-SEGIP2 CI%")
	    ->where('cli','=',108)
	    ->where('enti','=',20)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $trasanctionBU_LIC = DB::table('transaction_import')
	    ->where('servicio', 'like', "%SEGIP2-SEGIP2 LICENCIA%")
	    ->where('cli','=',108)
	    ->where('enti','=',20)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	  
	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "SEGIP2-SEGIP2%")
	    ->where('cli','=',95)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

		$transactionNetoCI = $totalTransactionCI - $trasanctionBU_CI;
		$transactionNetoLIC = $totalTransactionLIC - $trasanctionBU_LIC;
		
		$billingSystemCI = $transactionNetoCI * $arrayPrices[0]['sumaCI'];
		$billingSystemLIC = $transactionNetoLIC * $arrayPrices[1]['sumaLIC'];

		$billingBU_CI = $trasanctionBU_CI * $arrayPrices[0]['sintesisCI'];
		$billingBU_LIC = $trasanctionBU_LIC * $arrayPrices[1]['sintesisLIC'];

		$totalCI = $billingSystemCI + $billingBU_CI;
		$totalLIC = $billingSystemLIC + $billingBU_LIC;
		
		$totalBilling = $totalCI + $totalLIC;
	      
	     return array(
					0 => array('name'=>'SEGIP', 'description'=>'TRANSACCIONES PROCESADAS POR EL SISTEMA - CEDULAS DE IDENTIDAD','total_transaction' => $transactionNetoCI, 'total_billing'=> round($billingSystemCI,2),'pu'=> round($arrayPrices[0]['sumaCI'],2), 'created_at'=>$dateFrom,'cli' => 108),
					1 => array('name'=>'SEGIP', 'description'=>'TRANSACCIONES PROCESADAS POR EL SISTEMA - LICENCIA DE CONDUCIR','total_transaction' => $transactionNetoLIC, 'total_billing'=> round($billingSystemLIC,2),'pu'=> round($arrayPrices[1]['sumaLIC'],2), 'created_at'=>$dateFrom,'cli' => 108),
					2 => array('name'=>'SEGIP', 'description'=>'TRANSACCIONES PROCESADAS POR EL BANCO UNION - CEDULAS DE IDENTIDAD','total_transaction' => $trasanctionBU_CI, 'total_billing'=> round($billingBU_CI,2),'pu'=> round($arrayPrices[0]['sintesisCI'],2), 'created_at'=>$dateFrom,'cli' => 108),
					3 => array('name'=>'SEGIP', 'description'=>'TRANSACCIONES PROCESADAS POR EL BANCO UNION - LICENCIA DE CONDUCIR','total_transaction' => $trasanctionBU_LIC, 'total_billing'=> round($billingBU_LIC,2),'pu'=> round($arrayPrices[1]['sintesisLIC'],2), 'created_at'=>$dateFrom,'cli' => 108),
					4 =>array('name'=>'SEGIP', 'description'=>'TOTAL','total_transaction' => $totalTransactionCI + $totalTransactionLIC , 'total_billing'=> round($totalBilling,2),'pu'=>null, 'created_at'=>$dateFrom,'cli' => 108)
					);
	}

	/**
	**  
	**    Esquema de cobro unitario
	**    De 1 a 1000                                         bs. 4.7
	**    De 1001 a 5000                                      bs. 4.7 
	**    De 5001 a 10,000                                    bs. 4.3
	**    Mayor 10,000                                        bs. 4
	**
	**/

	public function credinform($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 0, 'unitCost'=>4.7 ),
				1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>4.7),
				2 => array('from' => 5001 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>4.3),
				3 => array('from' => 10000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4)
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%CREDINFORM-CREDINFORM EN BOLIVIANOS%")
	    ->where('cli','=',104)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%CREDINFORM-CREDINFORM EN BOLIVIANOS%")
	    ->where('cli','=',104)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

	    
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[0]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }

	    return array('name'=>'credinform', 'description'=>'CREDINFORM-CREDINFORM','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

	/**
	**  
	**    Esquema de cobro unitario
	**    De 1 a 600                     bs.3000                     
	**    De 601 a 1000                                      bs. 4.4 
	**    De 1001 a 2,000                                    bs. 4.2
	**    Mayor 2,000                                        bs. 4
	**
	**/

	public function fortaleza($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 1 ,'until'=>600, 'monthlyFixed' => 3000, 'unitCost'=>0 ),
				1 => array('from' => 601 ,'until'=>1000, 'monthlyFixed' => 0, 'unitCost'=>4.4),
				2 => array('from' => 1001 ,'until'=>2000, 'monthlyFixed' => 0, 'unitCost'=>4.2),
				3 => array('from' => 2000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4)
			);
		$arrayPricesBMSC = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.2 )
			);

		$totalBilling = 0;
		$totalBilling1	 = 0;
		$billingBMSC = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FORTALEZA-FORTALESA%")
	    ->where('cli','=',106)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $totalTransactionBMSC = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FORTALEZA-FORTALESA%")
	    ->where('cli','=',106)
	    ->where('enti','=',9)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FORTALEZA-FORTALESA%")
	    ->where('cli','=',106)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

       if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling1 = $arrayPrices[0]['monthlyFixed'];
	    	$pu = $arrayPrices[0]['monthlyFixed'] / $totalTransaction;
	    	$desctransacciones = "TRANSACIONES MINIMAS";
	    }
	    if ($totalTransaction >= $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling1 = $totalTransaction * $arrayPrices[1]['unitCost'];
	    	$pu = $arrayPrices[1]['unitCost'];
	    	$desctransacciones = "TRANSACIONES";
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling1 = $totalTransaction * $arrayPrices[2]['unitCost'];
	    	$pu = $arrayPrices[2]['unitCost'];
	    	$desctransacciones = "TRANSACIONES";
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	$totalBilling1 = $totalTransaction * $arrayPrices[3]['unitCost'];
	    	$pu = $arrayPrices[3]['unitCost'];
	    	$desctransacciones = "TRANSACIONES";
	    }

	    $billingBMSC = $totalTransactionBMSC * $arrayPricesBMSC[0]['unitCost'];
	    $totalBilling = $billingBMSC + $totalBilling1;

	    return array(
					0 => array('name'=>'Fortaleza', 'description'=> $desctransacciones,'total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling1,2),'pu'=> round($pu,2), 'created_at'=>$dateFrom,'cli' => 106),
					1 => array('name'=>'Fortaleza', 'description'=>'TRANSACCIONES PROCESADAS POR EL BANCO MERCANTIL SANTA CRUZ','total_transaction' => $totalTransactionBMSC, 'total_billing'=> round($billingBMSC,2),'pu'=> $arrayPricesBMSC[0]['unitCost'], 'created_at'=>$dateFrom,'cli' => 106),
					2 =>array('name'=>'Fortaleza', 'description'=>'TOTAL','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2),'pu'=> null, 'created_at'=>$dateFrom,'cli' => 106)
				);
	}

/**
	**  
	**    Precios unitario
	**		0.62 * 6.96  +  0.08 
	**      1.00
	**
	**/

	public function prevision($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.34, 'money'=>6.96, 'forms'=>0.08 )
			);
		$arrayPricesBU = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.00 )
			);

		$totalBilling = 0;
		$billingBU = 0;
		$unitCost = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%PREVISION-PREVISION%")
	    ->where('cli','=',4)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $totalTransactionBU = DB::table('transaction_import')
	    ->where('servicio', 'like', "%PREVISION-PREVISION%")
	    ->where('cli','=',4)
	    ->where('enti','=',20)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%PREVISION-PREVISION%")
	    ->where('cli','=',4)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

     	$unitCost = ($arrayPrices[0]['unitCost'] * $arrayPrices[0]['money']) + $arrayPrices[0]['forms'];
	//	$billing = $totalTransaction * $unitCost;
	    $billing = $totalTransaction * $arrayPrices[0]['unitCost'];
	    $billingBU = $totalTransactionBU * $arrayPricesBU[0]['unitCost'];
	 
	    $totalBilling = $billingBU + $billing;

	    return array(
					0 => array('name'=>'Previsión', 'description'=>'TRANSACCIONES ADICIONALES PROCESADAS POR EL BANCO UNION','total_transaction' => $totalTransactionBU, 'total_billing'=> round($billingBU,2),'pu'=> round($arrayPricesBU[0]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 4),
					1 => array('name'=>'Previsión', 'description'=>'TRANSACCIONES','total_transaction' => $totalTransaction, 'total_billing'=> round($billing,2), 'pu'=> round($arrayPrices[0]['unitCost'],2), 'created_at'=>$dateFrom,'cli' => 4),
					2 => array('name'=>'Previsión', 'description'=>'TOTAL','total_transaction' => null, 'pu'=> null, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom, 'cli' => 4)
					);
	}

/**
	**  
	**    Precios unitario
	**	  4.43 	
	**    1.50
	**    1.00
	**/

	public function futuro($dateFrom, $dateTo){

		$arrayPrices = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>4.43 )
			);
		$arrayPricesBE = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50 )
			);
		$arrayPricesBU = array(
				0 => array('from' => 0 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.00 )
			);

		$totalBilling = 0;
		$billingBU = 0;
		$unitCost = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FUTURO-FUTURO%")
	    ->where('cli','=',21)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');
	    $totalTransactionBE = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FUTURO-FUTURO%")
	    ->where('cli','=',21)
	    ->where('enti','=',21)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $totalTransactionBU = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FUTURO-FUTURO%")
	    ->where('cli','=',21)
	    ->where('enti','=',20)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%FUTURO-FUTURO%")
	    ->where('cli','=',21)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;

     	$billing = $totalTransaction * $arrayPrices[0]['unitCost'];
		$billingBE = $totalTransactionBE * $arrayPricesBE[0]['unitCost'];
     	$billingBU = $totalTransactionBU * $arrayPricesBU[0]['unitCost'];
     	
	    $totalBilling = $billing + $billingBE + $billingBU;

	    return array('name'=>'Futuro', 'description'=>'FUTURO-FUTURO','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
	}

}