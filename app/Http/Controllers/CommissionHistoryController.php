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

		$listCommission = DB::table('commission_history')->paginate(10);
		
		return view('commission_history.index')->with(compact('listCommission'));
	}


}