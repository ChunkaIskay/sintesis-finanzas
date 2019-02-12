<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    protected $primaryKey = 'entity_id';

  
    public static $messages =[
        
            'code.required' => 'Ingrese el código de la entidad.',
            'code.between' => 'El código debe tener entre 1 y 4 caracteres.',
            'name.required' => 'Ingrese el nombre de la entidad.',
            'name.between' => 'El nombre de la entidad debe tener entre 3 y 30 caracteres.',
            'number_account_0.required' => 'Ingrese el número de cuenta del banco.',
            'number_account_0.between' => 'El número de cuenta 1 del bano, debe tener entre 10 y 12 caracteres.',

            'number_account_1.between' => 'El número de cuenta 2, debe tener entre 10 y 12 caracteres.',
            'number_account_2.between' => 'El número de cuenta 3, debe tener entre 10 y 12 caracteres.',
 
            'nombre_cuenta_0.required' => 'Ingrese el nombre de la cuenta.',
            'nombre_cuenta_0.between' => 'El nombre de la cuenta 1, debe tener entre 5 y 60 caracteres.',            

            'bank_0.max' => 'Verifique el campo del banco 1 ingresado por favor!',
            'bank_1.max' => 'Verifique el campo del banco 2 ingresado por favor!',
            'bank_2.max' => 'Verifique el campo del banco 3 ingresado por favor',

            'bank_type_0.between' => 'Verifique el campo Tipo 1 por favor!',
            'bank_type_1.between' => 'Verifique el campo Tipo 2 por favor!',
            'bank_type_2.between' => 'Verifique el campo Tipo 3 por favor!',

            'bank_coin_0.between' => 'Verifique el campo Moneda 1 por favor!',
            'bank_coin_1.between' => 'Verifique el campo Moneda 2 por favor!',
            'bank_coin_2.between' => 'Verifique el campo Moneda 3 por favor!',

            'description.max' => 'La descripción solo admite hasta 150 caracteres.',
            'address.max' => 'La dirección solo admite hasta 120 caracteres.',
            'city.max' => 'Verifique el campo ciudad por favor!.'
  
    ];

    public static $rules = [
            'code' => 'required|between:1,4',
            'name' => 'required|between:3,30',
            'name' => 'required|between:3,30',
            'number_account_0' => 'required|between:10,12',
            'number_account_1' => 'max:12',
            'number_account_2' => 'max:12',

            'nombre_cuenta_0' => 'required|between:10,12',
            'nombre_cuenta_1' => 'max:12',
            'nombre_cuenta_2' => 'max:12',

            'bank_0' => 'max:2',
            'bank_1' => 'max:2',
            'bank_2' => 'max:2',

            'bank_type_0' => 'required|between:13,16',
            'bank_type_1' => 'required|between:13,16',
            'bank_type_2' => 'required|between:13,16',

            'bank_coin_0' => 'required|between:2,5',
            'bank_coin_1' => 'required|between:2,5',
            'bank_coin_2' => 'required|between:2,5',
           
            'description' => 'max:150',
            'address' => 'max:120',
            'city' =>'max:1'
    ];

    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }

    public function countries(){
        return $this->hasMany('App\Country', 'country_id');
    }
    
    public function contacts(){
        
         return $this->belongsTo('App\Contact');
    }

    public function many_bank_account(){
        return $this->hasMany('App\BankAccount', 'account_id');
    }
    

}


