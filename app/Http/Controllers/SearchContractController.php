<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchContractController extends Controller
{
    
    public funciont show(Request $Request){

    $services = Service::where('service_id', '=', $id)->get();

    	$query = $Request->query;
    	$products = Product::where('disable','=','0')
    				-> where('codigo','like',"%$query%")->get();

    	return view('')->with(compact('products','query'));

    }

	public function updateInbox(Request $request){
	      $mId = $request->msgId;

	      $update = DB::table('inbox')
	      ->where('id',$mId)
	      ->update([
	        'status' => 0
	      ]);
	      if($update){
	        echo "Status Update successfully";
	      }
    }

    public function search(Request $Request){
		
		$query = $Request->input('query');
		$contracts = Contract::where('disable','=','0')
					-> where('code','like',"%$query%")->paginate(10);

		return view('management.index')->with(compact('contracts','query'));
		
	}



}




