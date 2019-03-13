<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\TransactionImport;

class TransactionImportController extends Controller
{
	public function index(){
		echo "<h2>LISTADO DE PRUEBA </h2>";
		echo "<br> JHALEA:". $this->jhalea();
		echo "<br> MI RACHO:". $this->mi_rancho();
		echo "<br> TIERRA:". $this->tierra();
		echo "<br> CREDICASAS:". $this->credicasas();
		echo "<br> cmp:". $this->cmp();
		echo "<br> AXS:". $this->axs();
		echo "<br> MISIONES:". $this->misiones();
		echo "<br> KANTUTANI:". $this->kantutani();
		echo "<br> PREVER:". $this->prever();
		echo "<br> BBR:". $this->bbr();
		echo "<br> BBR-RENACER:". $this->bbr_renacer();
		echo "<br> BBR-RENACER:". $this->digital();

		

		
		
exit;
	 	//return view('comission.index',  array('contacts' => 'hola'));
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

	public function jhalea(){

		$arrayPrices = array(
						0 => array('from' => 0 ,'until'=>1750, 'monthlyFixed' => 5250, 'unitCost'=>0 ) ,
						1 => array('from' => 1751 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>2.50 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.20 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%TUPPERWARE-TUPPERWARE%")
	    ->where('cli','=',76)
	    ->sum('tot');
		
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

	    return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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

	public function mi_rancho(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1200, 'monthlyFixed' => 3480, 'unitCost'=>0 ) ,
						1 => array('from' => 1201 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.70 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-MI RANCHO%")
	    ->where('cli','=',102)
	    ->sum('tot');
		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling =  $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	   
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }
		
		return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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

	public function tierra(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1200, 'monthlyFixed' => 3480, 'unitCost'=>0 ) ,
						1 => array('from' => 1201 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.70 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-TIERRA QUINTA%")
	    ->where('cli','=',102)
	    ->sum('tot');
		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }

	    return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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

	public function credicasas(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1200, 'monthlyFixed' => 3480, 'unitCost'=>0 ) ,
						1 => array('from' => 1201 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.80 ),
						2 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>2.70 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%NOVILLO-CREDICASAS%")
	    ->where('cli','=',102)
	    ->sum('tot');
		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }

	    return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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

	public function cmp(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 0, 'unitCost'=>4.50, 'additionalCostBilling' =>0.70 ) ,
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%MEMPARK-CMP CREDITO%")
	    ->where('cli','=',83)
	    ->sum('tot');
		
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

	    return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
//SELECT SUM(tot) FROM `transaction_import` WHERE servicio like ('%TUPPERWARE-TUPPERWARE%') ORDER BY enti ASC

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

	public function axs(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 1250, 'unitCost'=>0 ) ,
						1 => array('from' => 5001 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>1.80 ),
						2 => array('from' => 10001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%AXS-AXS%")
	    ->where('cli','=',34)
	    ->sum('tot');
		
	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	$totalBilling = $arrayPrices[0]['monthlyFixed'];
	    }
	    if ($totalTransaction > $arrayPrices[1]['from'] && $totalTransaction <= $arrayPrices[1]['until']){

	    	$totalBilling = $totalTransaction * $arrayPrices[1]['unitCost'];
	    }
	    if ($totalTransaction >= $arrayPrices[2]['from']){

	    	$totalBilling = $totalTransaction * $arrayPrices[2]['unitCost'];
	    }

	    return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
//SELECT SUM(tot) FROM `transaction_import` WHERE servicio like ('%TUPPERWARE-TUPPERWARE%') ORDER BY enti ASC
	}

	 /**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 10,000
	**    5001 en adelante                                    bs. 1.59
	**    
	**    Transaciones minimas    de  1667                    bs. 2.00
	**    Se saca el 3% al total 
	**/

	public function misiones(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 10000, 'unitCost'=>0, 'minimumTransactions' => 1667, 'unitCostMin'=>2.00 ),
						1 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.59 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-LAS MISIONES%")
	    ->where('cli','=',40)
	    ->sum('tot');

		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
		SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE cli=40 and servicio like ('%KANTUTANI-LAS MISIONES%') GROUP by enti, desc_enti
		) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-LAS MISIONES BS%')) 
		GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC) billingT"));

    	$totalBilling2 = round(($totalBilling1[0]->billT * 3)/100, 2 ) + $totalBilling1[0]->billT;
		//dd($totalBilling2);
	    // T. minimas sea menor a T. total

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  		
		if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }
	    if ($totalTransaction >= $arrayPrices[1]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }

	    $totalBilling3 =  $minimumTransactions + $additonialTransactions; 
	    $totalBilling = $totalBilling2 + $totalBilling3;

	   return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
	}

	/**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 10,000
	**    5001 en adelante                                    bs. 1.59
	**    
	**    Transaciones minimas    de  1667                    bs. 2.00
	**    Se saca el 3% al total 
	**/

	public function kantutani(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 10000, 'unitCost'=>0, 'minimumTransactions' => 1667, 'unitCostMin'=>2.00 ),
						1 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.59 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-KANTUTANI%")
	    ->where('cli','=',40)
	    ->sum('tot');

		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (
					SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
					SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE cli=40 and servicio like ('%KANTUTANI-KANTUTANI%') GROUP by enti, desc_enti
					) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-KANTUTANI%')) 
					GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC
					) billingT"));

    	$totalBilling2 = round(($totalBilling1[0]->billT * 3)/100, 2 ) + $totalBilling1[0]->billT;
		
	    // T. minimas sea menor a T. total

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  
	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }
	    if ($totalTransaction >= $arrayPrices[1]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    $totalBilling3 =  $minimumTransactions + $additonialTransactions; 
	    $totalBilling = $totalBilling2 + $totalBilling3;

	   return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
	}

	/**
	** La retribución y forma de pago
	** l. La retribuciòn de los servicios, considerarà los siguiente:
		Monto minimo
	**    transacciones Mensuales    Cargo Fijo Mensual    Costo Unitario
	**    De 1 a 5000                    bs. 10,000
	**    5001 en adelante                                    bs. 1.59
	**    
	**    Transaciones minimas    de  1667                    bs. 2.00
	**    Se saca el 3% al total 
	**/

	public function prever(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>5000, 'monthlyFixed' => 10000, 'unitCost'=>0, 'minimumTransactions' => 1667, 'unitCostMin'=>2.00 ),
						1 => array('from' => 5001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.59 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%KANTUTANI-PREVER%")
	    ->where('cli','=',40)
	    ->sum('tot');

		$totalBilling1 = DB::select(DB::raw("SELECT SUM(billingT.billingTotal) as billT FROM (
					SELECT totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, ROUND( (transaction_import_fixed.price_fixed * totalEnti.total), 2) billingTotal FROM ( 
					SELECT sum(tot) as total , enti,desc_enti FROM `transaction_import` WHERE cli=40 and servicio like ('%KANTUTANI-PREVER%') GROUP by enti, desc_enti
					) totalEnti inner join transaction_import_fixed on ( totalEnti.enti=transaction_import_fixed.enti and transaction_import_fixed.servicio like('%KANTUTANI-PREVER%')) 
					GROUP BY totalEnti.total, totalEnti.enti, totalEnti.desc_enti, transaction_import_fixed.price_fixed, billingTotal  ORDER BY totalEnti.desc_enti ASC
					) billingT"));

    	$totalBilling2 = round(($totalBilling1[0]->billT * 3)/100, 2 ) + $totalBilling1[0]->billT;
		
	    // T. minimas sea menor a T. total

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction <= $arrayPrices[0]['until']){

	    	if ($additonialTransactions1 >0)
				$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;

	    }
	    if ($totalTransaction >= $arrayPrices[1]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[1]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    $totalBilling3 =  $minimumTransactions + $additonialTransactions; 
	    $totalBilling = $totalBilling2 + $totalBilling3;

	   return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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
	**    
	**/

	public function bbr(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>2.50 ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BBR-BBR%")
	    ->where('cli','=',78)
	    ->sum('tot');

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
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
	    
	    $totalBilling = $minimumTransactions + $additonialTransactions; 
	
	   return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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
	**    
	**/

	public function bbr_renacer(){

		$arrayPrices = array(
						0 => array('from' => 1 ,'until'=>1000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 1000, 'unitCostMin'=>2.50 ),
						1 => array('from' => 1001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>3.90 ),
						2 => array('from' => 5001 ,'until'=>15000, 'monthlyFixed' => 0, 'unitCost'=>3.70 ),
						3 => array('from' => 15000 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>3.50 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%BBR-RENACER%")
	    ->where('cli','=',78)
	    ->sum('tot');

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction >= $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
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
	    
	    $totalBilling = $minimumTransactions + $additonialTransactions; 
	
	   return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
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

	public function digital(){

		$arrayPrices = array(
						0 => array('from' => 0 ,'until'=>2000, 'monthlyFixed' => 5000, 'unitCost'=>0, 'minimumTransactions' => 2000, 'unitCostMin'=>2.50 ),
						1 => array('from' => 2001 ,'until'=>5000, 'monthlyFixed' => 0, 'unitCost'=>2.00 ),
						2 => array('from' => 5001 ,'until'=>10000, 'monthlyFixed' => 0, 'unitCost'=>1.70 ),
						3 => array('from' => 10001 ,'until'=>20000, 'monthlyFixed' => 0, 'unitCost'=>1.60 ),
						4 => array('from' => 20001 ,'until'=>0, 'monthlyFixed' => 0, 'unitCost'=>1.50 )
						);

		$totalTransaction = DB::table('transaction_import')
	    ->where('servicio', 'like', "%DIGITAL TV-DIGITAL TV%")
	    ->where('cli','=',43)
	    ->sum('tot');

	    $minimumTransactions = $arrayPrices[0]['minimumTransactions'] * $arrayPrices[0]['unitCostMin'];
	    $additonialTransactions1 = $totalTransaction - $arrayPrices[0]['minimumTransactions'];
	  

	    if ($totalTransaction > $arrayPrices[0]['from'] && $totalTransaction < $arrayPrices[0]['until']){

	    	 $totalBilling = $arrayPrices[0]['monthlyFixed'];
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

	    if ($totalTransaction > $arrayPrices[4]['from']){

	    	if ($additonialTransactions1 >0)
	    		$additonialTransactions = $additonialTransactions1 * $arrayPrices[4]['unitCost'];
	    	else
	    		$additonialTransactions=0;
	    }
	    
	    $totalBilling = $minimumTransactions + $additonialTransactions; 
	
	   return "Transacciones total: ".$totalTransaction. " total a cobrar: ". $totalBilling;
	}

}
