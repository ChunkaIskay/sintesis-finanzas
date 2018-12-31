<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contract;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //querybuilder
        //$contracts = DB::table('contracts')->paginate(5);
        //model
        $contracts = Contract::orderBy('contract_id','desc')->paginate(5);
        
        return view('home', array(
                    'contracts' => $contracts
        ));
    }
}
