<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Curls;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\reportPagosNet;

class reportPagosNetController extends Controller
{
  
	//public function get_detail(){
	public function index(){
		
		 date_default_timezone_set('America/La_Paz');

		$query = "";
		$dateTo = date('Y-m-j');
		$calcularFecha = strtotime('-1 day',strtotime($dateTo));
		$dateFrom = date('Y-m-j',$calcularFecha);

		$pagosNet = reportPagosNet::where('error','=','N')
					-> whereBetween('fecha_referencial', [$dateFrom, $dateTo])
					-> whereOr('razon_social','like',"%$query%")->paginate(20);

		return view('commission_pagosnet.index')->with(compact('pagosNet','query','dateTo','dateFrom'));
	}


	public function search(Request $Request){

	  	$query = $Request->input('query');
		$dateFrom = $Request->input('dateFrom');
		$dateTo = $Request->input('dateTo');
		
		$pagosNet = reportPagosNet::where('error','=','N')
					-> whereBetween('fecha_referencial', [$dateFrom, $dateTo])
					-> where('razon_social','like',"%$query%")->paginate(20);
	
		return view('commission_pagosnet.index')->with(compact('pagosNet','query','dateTo','dateFrom'));
	
	}

	public function testRESTFULL(){
		//		$pin_code = $_REQUEST['pin_code'];
		$url = "http://postalpincode.in/api/pincode/110001";
		$ch= curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		echo "<pre>";print_r($output); echo"</pre>";

	}
}
