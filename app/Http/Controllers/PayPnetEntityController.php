<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Curls;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\PayPnetEntity;

class PayPnetEntityController extends Controller
{
    public function index(){
		
		 date_default_timezone_set('America/La_Paz');

		$query = "";
		$dateTo = date('Y-m-j');
		$calcularFecha = strtotime('-1 day',strtotime($dateTo));
		$dateFrom = date('Y-m-j',$calcularFecha);

		$pagosNet = PayPnetEntity::where('error','=','N')
					-> whereBetween('fecha_referencial', [$dateFrom, $dateTo])
					-> whereOr('razon_social','like',"%$query%")->paginate(20);
		return view('pay_pnet_entity.index')->with(compact('pagosNet','query','dateTo','dateFrom'));
	}


	public function search(Request $Request){

	  	$query = $Request->input('query');
		$dateFrom = $Request->input('dateFrom');
		$dateTo = $Request->input('dateTo');
		
		$pagosNet = PayPnetEntity::where('error','=','N')
					-> whereBetween('fecha_referencial', [$dateFrom, $dateTo])
					-> where('razon_social','like',"%$query%")->paginate(20);
	
		return view('pay_pnet_entity.index')->with(compact('pagosNet','query','dateTo','dateFrom'));
	}
}
