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
	 	

	 	return view('comission.index',  array('contacts' => 'hola'));
	

	}
	
}
