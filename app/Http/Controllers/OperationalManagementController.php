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
use App\Country;
use App\Contact;
use App\Bank;
use App\BankAccount;



class OperationalManagementController extends Controller
{
  	
  	public function index(){

	 	return view('management.index');
    }

    public function search(Request $Request){
		
		$query = $Request->input('query');
		$contracts = Contract::where('disable','=','0')
					-> where('code','like',"%$query%")->paginate(10);

		return view('management.index')->with(compact('contracts','query'));
	}

	public function managementContract($id){

		$management = Contract::where('contract_id','=',$id)->get();
		$contract = Contract::find($id);
	
		if(!empty($contract))
	   	{ 
	   		
	   		if(count($contract->service_id) != 0){
	   			
	   			$services = Service::orderBy('name')->get(); 
	   			$coin =  collect(['BS','Dolar']);
	   		}else{

	   			return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos del servicio, por favor!!'
    				));
	   		}
	   		
	   		if(count($contract->entity_id) != 0){

		        $entities = Entity::orderBy('name')->get();
		   		$entity2 = Entity::find($contract->entity_id); 
				$bank = Bank::orderBy('short_name')->get();
				$accounts = BankAccount::where('entity_id','=', $entity2->entity_id )->get();
				$contacts = Contact::orderBy('type')
				->where('entity_id','=',$entity2->entity_id)->get(); //dd($contacts);
                $type = collect(['cuenta_corriente'=>'Cuenta corriente','caja_de_ahorro'=>'Caja de ahorro']);
        		$coin = collect(['bolivianos'=>'M/N en BS','dollar'=>'M/E en Dolares','porcentaje_bolivianos'=>'%  en Bs','porcentaje_dollar'=>'% en dolares']);
				$countries = Country::orderBy('country_id','desc')->get();
				$itfCharge =  collect(['cliente'=>'Cliente','sintesis'=>'Sintesis']);

				$levels =  array('cajas' => array('Cajas', ''), 'portales'=>array('Portales','') , 'web'=> array('Web',''));
		  
		        if(!empty($contract->enable_level)){
		            $level = explode(",", $contract->enable_level);
		        }else{
		                 $level = Array();
		            }
		        $levels = collect($this->addSelected($level, $levels));

	   		}else{

	   			return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos de la entidad, por favor!!'
    				));
	   		}
			
			if(count($contract->type_id) != 0){
				$typeContracts = TypeContract::orderBy('name')->get(); 
	   			//$typeContract = TypeContract::find($contract->type_id);
	   		}else{
	   			return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos tipo de contrato, por favor!!'
    				));
	   		}

	    	$categorizations = Categorization::orderBy('type','name')->get();
	       
			return view('management.index')->with(compact('contract','services','entities','categorizations','typeContracts','countries','contacts','bank','accounts','type','coin','levels','entity2','coin','itfCharge'));
			
	
		
		}else{
				return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos del Contrato, por favor!!'
    				));
			
		}		
	}

}