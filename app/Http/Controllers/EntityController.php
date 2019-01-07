<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Entity;

class EntityController extends Controller
{
    public function index(){
	
		$entities = Entity::paginate(5);

		return view('entity.index')->with(compact('entities'));

	}

    public function createEntity(){
    	$entities = Entity::orderBy('entity_id','desc')->get();
    	$entityId = $entities[0]['entity_id']+1;
    	return view('entity.createEntity')->with(array( 'entityId' =>$entityId ));

    }

    public function saveEntity(Request $request){

		$this->validate($request, Entity::$rules, Entity::$messages);

		$entity = new Entity();
    	$entities = Entity::orderBy('entity_id','desc')->get();
    	$entityId = $entities[0]['entity_id']+1;

    	if($request->input('entityId') == $entityId){

	        $entity->entity_id= $entityId;
	    	$entity->name = $request->input('name');
	    	$entity->description = $request->description;
	    	$entity->status = $request->status;
	    	$entity->save(); 
    	
    	}else{
    			return back()->with(array(
			    		'message' => 'Error intente nuevamente por favor!!'
			   ));
    	}

    	return redirect()->route('listService')->with(array(
    		'message' => 'La entidad se ha creado correctamente!!'
    	));
    }


	public function editService($id){
        
        $services = Service::where('service_id', '=', $id)->get();
        $status =  DB::table('services')
        ->distinct() 
        ->select('services.status')
        ->get();
        
        return view('service.editService')->with(compact('services','status'));
    }

    public function updateService(Request $request, $id){
	    
		$this->validate($request, Service::$rules, Service::$messages);
		$Service = Service::find($id);
		//$service = Service::where('service_id', '=', $id)->get();
		$Service->name = $request->input('name');
    	$Service->description = $request->description;
    	$Service->status = $request->status;
		$Service->save();  // update 

    	return redirect()->route('listService')->with(array(
    		'message' => 'El contrato se modifico correctamente!!'
    	));
    }

    public function destroyService($id){
    
		$service = Service::find($id);
		//$deletedRows = App\Flight::where('active', 0)->delete();
		$service->delete(); //DELETE
		
    	return back()->with(array(
    		'message' => 'El servicio fue eliminado correctamente!!'
    	));
    }
}
