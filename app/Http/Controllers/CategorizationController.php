<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorizationController extends Controller
{
     public function createCategorization(){
    	$categorization = Entity::orderBy('entity_id','desc')->get();
    	$categorizationId = $categorization[0]['categorization_id']+1;
    	return view('categorization.createcategorization')->with(array( 'categorizationId' =>$categorizationId ));

    }

    public function saveCategorization(Request $request){

		$this->validate($request, categorization::$rules, categorization::$messages);

		$categorization = new categorization();
    	$categorization = categorization::orderBy('categorization_id','desc')->get();
    	$categorizationId = $categorization[0]['categorization_id']+1;

    	if($request->input('categorizationId') == $categorizationId){

	        $categorization->categorization_id= $categorizationId;
	    	$categorization->name = $request->input('name');
	    	$categorization->description = $request->description;
	    	$categorization->status = $request->status;
            $categorization->contract = $request->contract;
            $categorization->contract_id = $request->contract_id;
	    	$categorization->save(); 
    	
    	}else{
    			return back()->with(array(
			    		'message' => 'Error intente nuevamente por favor!!'
			   ));
    	}

    	return redirect()->route('listcategorization')->with(array(
    		'message' => 'La categorización se ha creado correctamente!!'
    	));
    }
}
