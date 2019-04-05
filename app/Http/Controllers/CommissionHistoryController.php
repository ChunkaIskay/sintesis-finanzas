<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Paginator;	
use App\CommissionHistory;



class CommissionHistoryController extends Controller
{
    
	
	public function index(){
		
		 date_default_timezone_set('America/La_Paz');

		$query = "";
		$dateTo = date('Y-m-j');
		$calcularFecha = strtotime('-1 day',strtotime($dateTo));
		$dateFrom = date('Y-m-j',$calcularFecha);

		$listCommission = CommissionHistory::whereBetween('created_at', [$dateFrom, $dateTo])->paginate(20);

		return view('commission_history.index')->with(compact('listCommission','query','dateTo','dateFrom'));
	}

	public function search(Request $Request){

	  	$query = $Request->input('query');
		$dateFrom = $Request->input('dateFrom');
		$dateTo = $Request->input('dateTo');
		
		$listCommission = CommissionHistory::where('name','like',"%$query%")
					->whereOr('description','like',"%$query%")
					-> whereBetween('created_at', [$dateFrom, $dateTo])
					->paginate(20);
	
		return view('commission_history.index')->with(compact('listCommission','query','dateTo','dateFrom'));
	
	}



}