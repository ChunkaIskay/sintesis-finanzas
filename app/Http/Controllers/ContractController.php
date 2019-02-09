<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Contract;
use App\Entity;
use App\Service;
use App\Categorization;
use App\TypeContract;

class ContractController extends Controller
{
   	public $arrayServiceEntity = array(); 

	public function index(){
		
		$contracts = DB::table('contracts')
		->join('services','services.service_id', '=' , 'contracts.service_id')
		->join('entities','entities.entity_id', '=' , 'contracts.entity_id')
        ->select('contracts.contract_id','contracts.code','services.name','entities.name as nameEntity','contracts.general_category_id','contracts.specific_category_id', 'contracts.type_id')
		->paginate(5);
        $categorizations = DB::table('categorizations')->get();
        $typeContracts = DB::table('type_contracts')->get();
		return view('contract.index',  array(
							'contracts' => $contracts,
                            'categorizations' => $categorizations,
                            'typeContracts' => $typeContracts
						));

	}

    public function createContract(){

    	$services = Service::orderBy('name')->get(); 
    	$entities = Entity::orderBy('name')->get();
        $categorizations = Categorization::orderBy('type','name')->get();
        $typeContracts = TypeContract::orderBy('name')->get();
        $levels =  collect(['cajas'=>'Cajas','portales'=>'Portales','web'=>'Web']);

    	return view('contract.createContract')->with(compact('services','entities','categorizations','typeContracts', 'levels'));

    }

    public function saveContract(Request $request){
    	
        //$this->validate($request, Contract::$rules, Contract::$messages);
        $level="";
		$contract = new Contract();
    	$user = \Auth::user();
    	//$contract-> user_id = $user->id;
        $contract->folder_code = $request->input('codigo_carpeta');
    	$contract->code = $request->input('codigo');

        if($request->automatica == 'yes')
            $contract->number_month = $request->input('numero_mes');
    
    	$contract->description = $request->description;
        $contract->general_category_id = $request->cate_general;
    	$contract->specific_category_id = $request->cate_especifica;
		$contract->type_id = $request->tipo;
		$contract->entity_id = $request->entidad;
    	$contract->service_id = $request->servicio;
        
        if(count($request->enable_level)>0){
            foreach ($request->enable_level as $value) {
               $level .= $value.',';
            }
            $contract->enable_level = trim($level, ',');
        }

        $contract->save(); 

    	return redirect()->route('listContract')->with(array(
    		'message' => 'El contrato se ha creado correctamente!!'
    	));
    }

	public function editContract($id){

		$contracts = Contract::find($id);
		$services = Service::orderBy('name')->get(); 
    	$entities = Entity::orderBy('name')->get();
        $categorizations = Categorization::orderBy('type','name')->get();
        $typeContracts = TypeContract::orderBy('name')->get(); 
    	return view('contract.editContract')->with(compact('contracts','services','entities','categorizations','typeContracts'));

    }

    public function updateContract(Request $request, $id){
    	
        $this->validate($request, Contract::$rules, Contract::$messages);

		$contract = Contract::find($id);
    	$contract->code = $request->input('codigo');
        $contract->description = $request->description;
    	$contract->general_category_id = $request->cate_general;
    	$contract->specific_category_id = $request->cate_especifica;
		$contract->type_id = $request->tipo;
		$contract->entity_id = $request->entidad;
    	$contract->service_id = $request->servicio;
    	$contract->save();  // update 

    	return redirect()->route('listContract')->with(array(
    		'message' => 'El contrato se modifico correctamente!!'
    	));
    }

	public function destroyContract($id){
    
		$contract = Contract::find($id);
		//$deletedRows = App\Flight::where('active', 0)->delete();
		$contract->delete(); 
		
    	return back()->with(array(
    		'message' => 'El contrato fue eliminado correctamente!!'
    	));
    }


}
