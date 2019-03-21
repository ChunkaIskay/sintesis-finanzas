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

		return view('commission.index');
	}


	public function search(Request $Request){

		$listReports = array();
		$listCommission = array();

		$dateFrom = $Request->input('dateFrom');
		$dateTo = $Request->input('dateUntil');
		$query = $Request->input('query');
		
		if(isset($dateFrom) && isset($dateTo))
		{ 
			array_push($listReports, $this->jhalea($dateFrom,$dateTo));
			array_push($listReports, $this->mi_rancho($dateFrom,$dateTo));
			array_push($listReports, $this->tierra($dateFrom,$dateTo));
			array_push($listReports, $this->credicasas($dateFrom,$dateTo));
			array_push($listReports, $this->cmp($dateFrom,$dateTo));
			array_push($listReports, $this->axs($dateFrom,$dateTo));
			array_push($listReports, $this->misiones($dateFrom,$dateTo));
			array_push($listReports, $this->kantutani($dateFrom,$dateTo));
			array_push($listReports, $this->prever($dateFrom,$dateTo));
			array_push($listReports, $this->bbr($dateFrom,$dateTo));
			array_push($listReports, $this->bbr_renacer($dateFrom,$dateTo));
			array_push($listReports, $this->digital($dateFrom,$dateTo));
			array_push($listReports, $this->men_park($dateFrom,$dateTo));
		    array_push($listReports, $this->nvida($dateFrom,$dateTo));
			array_push($listReports, $this->nseguro($dateFrom,$dateTo));
	        array_push($listReports, $this->bisa($dateFrom,$dateTo));
			array_push($listReports, $this->bisa_recaudaciones($dateFrom,$dateTo));
	        array_push($listReports, $this->egpp($dateFrom,$dateTo));
	        array_push($listReports, $this->bdp($dateFrom,$dateTo));
			array_push($listReports, $this->la_vitalicia($dateFrom,$dateTo));
			array_push($listReports, $this->alianza_vida($dateFrom,$dateTo));
			array_push($listReports, $this->boliviatel($dateFrom,$dateTo));
		    array_push($listReports, $this->cessa($dateFrom,$dateTo));
			array_push($listReports, $this->actualizacion($dateFrom,$dateTo));
			array_push($listReports, $this->gamch($dateFrom,$dateTo));
			array_push($listReports, $this->uagrm($dateFrom,$dateTo));
			array_push($listReports, $this->semapa($dateFrom,$dateTo));
			array_push($listReports, $this->setar($dateFrom,$dateTo));
			array_push($listReports, $this->bja($dateFrom,$dateTo));
	
			$listCommission = collect($listReports);
		

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
		
		if(!empty($listCommission)){
			$query="datos";
		}
	
		
		    	
    	// $this->saveCommissionHistory($listReports);
    	//$listCommission = collect($listReports);
    	// $listCommission = DB::table('commission_history')->paginate(10);
    	 //return view('commission.index')->with(compact('listCommission'));

		return view('commission.index')->with(compact('listCommission','query'));
		
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
//SELECT SUM(tot) FROM `transaction_import` WHERE servicio like ('%TUPPERWARE-TUPPERWARE%') ORDER BY enti ASC
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

		$minMonthly = round((10000/3),2);
		$minTrans = round(5000/3);
		
		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 10000, 'unitCost'=>0, 'minimumTransactions' => $minTrans, 'unitCostMin'=>2.00 ),
						1 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.59 )
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

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
		SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE fecha BETWEEN CAST( '$dateFrom' AS DATE) AND CAST('$dateTo' AS DATE) and cli=40 and servicio like ('%KANTUTANI-LAS MISIONES%') GROUP by enti, desc_enti
		) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-LAS MISIONES BS%')) 
		GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC) billingT"));

		if(count($totalBilling1[0]->billT) ==0)
			$totalBilling1[0]->billT=0;

    	$totalBilling2 = round(($totalBilling1[0]->billT * 3)/100, 2 ) + $totalBilling1[0]->billT;
    	$additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	
		if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	     	 $totalBilling3 = $minMonthly;

	    }
	    if ($totalTransaction >= $arrayPrices[1]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	        $totalBilling3 =  $minMonthly + $additonialTransactions;
	    }

	   $totalBilling = $totalBilling2 + $totalBilling3;

	    return array('name'=>'Misiones', 'description'=>'KANTUTANI-LAS MISIONES','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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

	public function kantutani($dateFrom, $dateTo){

		$minMonthly = round((10000/3),2);
		$minTrans = round(5000/3);
		
		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 10000, 'unitCost'=>0, 'minimumTransactions' => $minTrans, 'unitCostMin'=>2.00 ),
						1 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.59 )
						);

		$totalBilling = 0;
		$totalBilling3 = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (
					SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
					SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE fecha BETWEEN CAST( '$dateFrom' AS DATE) AND CAST('$dateTo' AS DATE) and cli=40 and servicio like ('%KANTUTANI-KANTUTANI%') GROUP by enti, desc_enti
					) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-KANTUTANI%')) 
					GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC
					) billingT"));

		if(count($totalBilling1[0]->billT) ==0)
			$totalBilling1[0]->billT=0;

    	$totalBilling2 = round(($totalBilling1[0]->billT * 3)/100, 2 ) + $totalBilling1[0]->billT;
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  		
		if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	     	 $totalBilling3 = $minMonthly;

	    }
	    if ($totalTransaction >= $arrayPrices[1]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	        $totalBilling3 =  $minMonthly + $additonialTransactions;
	    }

	   $totalBilling = $totalBilling2 + $totalBilling3;

	   return array('name'=>'Kantutani', 'description'=>'KANTUTANI-KANTUTANI','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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

		$minMonthly = round((10000/3),2);
		$minTrans = round(5000/3);
		
		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 10000, 'unitCost'=>0, 'minimumTransactions' => $minTrans, 'unitCostMin'=>2.00 ),
						1 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.59 )
						);

		$totalBilling = 0;
		$totalBilling3 = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->select('fecha')
	    ->limit(1)
	    ->get();

	    if(count($firstDate) == 1)
			$dateFrom = $firstDate[0]->fecha;


		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (
					SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
					SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE fecha BETWEEN CAST( '$dateFrom' AS DATE) AND CAST('$dateTo' AS DATE) and cli=40 and servicio like ('%KANTUTANI-PREVER%') GROUP by enti, desc_enti
					) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-PREVER%')) 
					GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC
					) billingT"));

		if(count($totalBilling1[0]->billT) ==0)
			$totalBilling1[0]->billT=0;

    	$totalBilling2 = round(($totalBilling1[0]->billT * 3)/100, 2 ) + $totalBilling1[0]->billT;
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  		
		if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	     	 $totalBilling3 = $minMonthly;

	    }
	    if ($totalTransaction >= $arrayPrices[1]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	        $totalBilling3 =  $minMonthly + $additonialTransactions;
	    }

	   $totalBilling = $totalBilling2 + $totalBilling3;

	    return array('name'=>'Prever', 'description'=>'KANTUTANI-PREVER','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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
	    	  return array('total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
	    	  return array('total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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

	    return array('name'=>'Nvida', 'description'=>'NALVIDA-NACIONAL VIDA','total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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
	    	  return array('total_transaction' => $totalTransaction, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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


	   return array('name'=>'Egpp', 'description'=>'EGPP-CERTIFICADOS-CURSOS-DIPLOMADOS','total_transaction' => $totalTransactionCCD, 'total_billing'=> round($totalBilling,2), 'created_at'=>$dateFrom);
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
				1 => array('from' => 1901 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.00),
				2 => array('from' => 5000 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>2.80),
				3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.60)
			);

		$totalBilling = 0;
		
		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BDP-BDP%")
	    ->where('cli','=',88)
	    ->whereBetween('fecha', [$dateFrom, $dateTo])
	    ->sum('tot');

	    $firstDate = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BDP-BDP%")
	    ->where('cli','=',88)
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
	    if ($totalTransaction > $arrayPrices[2]['from'] && $totalTransaction <= $arrayPrices[2]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
	    if ($totalTransaction > $arrayPrices[3]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[3]['unitCost'];
	    }

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
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost '=>0, 'percent'=>0.82 )
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
				0 => array('from' => 0,'until'=>0, 'monthlyFixed' => 0, 'unitCost '=>0, 'percent'=>0.90 )
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




}