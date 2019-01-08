<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Service;




class ServiceController extends Controller
{
    

	public function index(){
	
		$services = Service::paginate(5);

		return view('service.index')->with(compact('services'));

	}

    public function createService(){
    	$services = Service::orderBy('service_id','desc')->get();
    	$serviceId = $services[0]['service_id']+1;
    	return view('service.createService')->with(array( 'serviceId' =>$serviceId ));

    }

    public function saveService(Request $request){

		$this->validate($request, Service::$rules, Service::$messages);

		$service = new Service();
    	$services = Service::orderBy('service_id','desc')->get();
    	$serviceId = $services[0]['service_id']+1;

    	if($request->input('serviceId') == $serviceId){

	        $service->service_id= $serviceId;
	    	$service->name = $request->input('name');
	    	$service->description = $request->description;
	    	$service->status = $request->status;
	    	$service->save(); 
    	
    	}else{
    			return back()->with(array(
			    		'message' => 'Error intente nuevamente por favor!!'
			   ));
    	}

    	return redirect()->route('listService')->with(array(
    		'message' => 'El servicio se ha creado correctamente!!'
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
		$Service->name = $request->input('name');
    	$Service->description = $request->description;
    	$Service->status = $request->status;
		$Service->save();  

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
