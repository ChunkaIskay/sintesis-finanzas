<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Entity;
use App\Country;


class EntityController extends Controller
{
    
    public function index(){

        $entities = DB::table('entities')
        ->join('countries','countries.country_id', '=' , 'entities.city')
        ->select('entities.entity_id','entities.name','entities.bank_name','entities.bank_account','entities.address','countries.city')
        ->paginate(5);
        $entity_id = DB::table('countries')->get();
        return view('entity.index',  array('entities' => $entities));

	}

    public function createEntity(){
    	$entities = Entity::orderBy('entity_id','desc')->get();
    	$entityId = $entities[0]['entity_id']+1;
        $countries = Country::orderBy('city')->get();
    	return view('entity.createEntity')->with(array( 'entityId' =>$entityId, 'countries' => $countries));

    }

    public function saveEntity(Request $request){

		$this->validate($request, Entity::$rules, Entity::$messages);

		$entity = new Entity();
    	$entities = Entity::orderBy('entity_id','desc')->get();
    	$entityId = $entities[0]['entity_id']+1;

    	if($request->input('entityId') == $entityId){

	        $entity->entity_id= $entityId;
	    	$entity->name = $request->input('name');
            $entity->bank_name = $request->input('bank_name');
            $entity->bank_account = $request->input('bank_account');
            $entity->address = $request->input('address');        
            $entity->description = $request->description;
            $entity->city = $request->city;
            $entity->save(); 
    	
    	}else{
    			return back()->with(array(
			    		'message' => 'Error intente nuevamente por favor!!'
			   ));
    	}

    	return redirect()->route('listEntity')->with(array(
    		'message' => 'La entidad se ha creado correctamente!!'
    	));
    }


	public function editEntity(Entity $entity){

        $entety = Entity::find($entity);
        $countries = Country::orderBy('country_id','desc')->get();
        
        return view('entity.editEntity')->with(compact('entity','countries'));
    }

    public function updateEntity(Request $request, $id){
	    
		$this->validate($request, Entity::$rules, Entity::$messages);
		$entity = Entity::find($id);
	    $entity->name = $request->input('name');
        $entity->bank_name = $request->input('bank_name');
        $entity->bank_account = $request->input('bank_account');
        $entity->address = $request->input('address');        
        $entity->description = $request->description;
        $entity->city = $request->city;
        $entity->save();  
		
    	return redirect()->route('listEntity')->with(array(
    		'message' => 'La entidad se modifico correctamente!!'
    	));
    }

    public function destroyEntity($id){
    
		$entity = Entity::find($id);
        $entity->delete(); 
        
        return back()->with(array(
            'message' => 'La entidad fue eliminado correctamente!!'
		));
    }
}
