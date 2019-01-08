<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController eCountrytends Controller
{
    public function indeCountry(){
	
		$countries = Country::paginate(5);

		return view('country.indeCountry')->with(compact('countries'));

	}

    public function createCountry(){
    	$countries = Country::orderBy('country_id','desc')->get();
    	$countryId = $countries[0]['country_id']+1;
    	return view('country.createCountry')->with(array( 'countryId' =>$countryId ));

    }

    public function saveCountry(Request $request){

		$this->validate($request, Country::$rules, Country::$messages);

		$country = new Country();
    	$countries = Country::orderBy('country_id','desc')->get();
    	$countryId = $countries[0]['country_id']+1;

    	if($request->input('countryId') == $countryId){

	        $country->country_id= $countryId;
	    	$country->name = $request->input('name');
	    	$country->description = $request->description;
	    	$country->status = $request->status;
	    	$country->save(); 
    	
    	}else{
    			return back()->with(array(
			    		'message' => 'Error intente nuevamente por favor!!'
			   ));
    	}

    	return redirect()->route('listCountry')->with(array(
    		'message' => 'La ciudad se ha creado correctamente!!'
    	));
    }
}
