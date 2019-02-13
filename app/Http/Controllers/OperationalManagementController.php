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
	   			$service = Service::find($contract->service_id);
	   		}else{

	   			return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos del servicio, por favor!!'
    				));
	   		}
	   		
	   		if(count($contract->entity_id) != 0){
		   		$entity = Entity::find($contract->entity_id);
		   		//$countries = Country::find($entity->city);

		   		$contact = Contact::find($entity->entity_id);
				$bank = Bank::orderBy('short_name')->get();
				$accounts = BankAccount::where('entity_id','=', $entity->entity_id )->get();
                $type =  collect(['cuenta_corriente'=>'Cuenta corriente','caja_de_ahorro'=>'Caja de ahorro']);
        		$coin =  collect(['Dolar','BS']);
				$countries = Country::orderBy('country_id','desc')->get();
	   		}else{

	   			return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos de la entidad, por favor!!'
    				));
	   		}
			
			if(count($contract->type_id) != 0){
	   			$typeContract = TypeContract::find($contract->type_id);
	   		}else{
	   			return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos tipo de contrato, por favor!!'
    				));
	   		}

	    	$categorizations = Categorization::orderBy('type','name')->get();
	       
return view('management.index')->with(compact('contract','service','entity','categorizations','typeContract','countries','contact','bank','accounts','type','coin'));
			/*return view('management.index')->with(type
												array( 'management' => $management,
													   'link' =>$management[0]['contract_id'] ));*/
		}else{
				return redirect()->route('createdManagement')->with(array(
    					'message' => 'Verifique los datos del Contrato, por favor!!'
    				));
			
		}		
	}

}
