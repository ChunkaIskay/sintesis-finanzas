<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Contact;
use App\Entity;


class ContactController extends Controller
{
    public $arrayServiceEntity = array(); 

	public function index(){
		
		$contacts = DB::table('contacts')
		->join('entities','entities.entity_id', '=' , 'contacts.entity_id')
		->select('contacts.contact_id','contacts.name','contacts.last_name','contacts.phone','contacts.movile','contacts.email','contacts.position','contacts.last_name','entities.name as entity_name','contacts.address')
		->paginate(5);
	
        return view('contact.index',  array('contacts' => $contacts));
	
	}

    public function createContact(){

    	$contacts = Contact::orderBy('name')->get(); 
    	$entities = Entity::orderBy('name')->get();
        $contactType =  collect(['contacto'=>'Contacto','conciliador'=>'Conciliador']);
       
    	return view('contact.createContact')->with(compact('contacts','entities','contactType'));
    }

    public function saveContact(Request $request){
    	
        $this->validate($request, Contact::$rules, Contact::$messages);
        $contact = new Contact();
        $contact = $this->allResquest($request, $contact);
        $contact->save();
        
    	return redirect()->route('listContact')->with(array(
    		'message' => 'El contacto se ha creado correctamente!!'
    	));
    }

	public function editContact($id){

		$contacts = Contact::find($id);
		
    	$entities = Entity::orderBy('name')->get();
        $contactType =  collect(['contacto'=>'Contacto','conciliador'=>'Conciliador']);
        
    	return view('contact.editContact')->with(compact('contacts','entities','contactType'));

    }

    public function updateContact(Request $request, $id){
    	
        $this->validate($request, Contact::$rules, Contact::$messages);

		$contact = Contact::find($id);
    	$contact = $this->allResquest($request, $contact);
    	$contact->save();  // update 

    	return redirect()->route('listContact')->with(array(
    		'message' => 'El contacto se modifico correctamente!!'
    	));
    }

	public function destroyContact($id){
    
		$contact = Contact::find($id);
		//$deletedRows = App\Flight::where('active', 0)->delete();
		$contact->delete(); 
		
    	return back()->with(array(
    		'message' => 'El contrato fue eliminado correctamente!!'
    	));
    }

    public function allResquest($request,$contact)
    {

    	$contact->name = $request->input('nombre');
    	$contact->last_name = $request->input('apellido');
    	$contact->phone = $request->input('telefono');
    	$contact->movile = $request->input('celular');
    	$contact->email = $request->input('email');
    	$contact->position = $request->input('cargo');
        $contact->type = $request->input('tipo_contacto');
    	$contact->entity_id = $request->entidad;

    	return $contact;
    	 
    }
}
