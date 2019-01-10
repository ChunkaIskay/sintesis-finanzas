<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    protected $primaryKey = 'entity_id';

  
    public static $messages =[
            'name.required' => 'Ingrese el nombre de la entidad.',
            'name.between' => 'El nombre de la entidad debe tener entre 3 y 30 caracteres.',
            'bank_account.required' => 'Ingrese el número de cuenta del banco.',
            'bank_account.between' => 'El número de cuenta del bano, debe tener entre 10 y 12 caracteres.',
            'bank_name.required' => 'Ingrese el nombre del banco.',
            'bank_name.between' => 'El nombre del banco debe tener entre 3 y 30 caracteres.',
            'description.max' => 'La descripción solo admite hasta 150 caracteres.',
            'address.max' => 'La dirección solo admite hasta 120 caracteres.'
            
    ];

    public static $rules = [
            'name' => 'required|between:3,30',
            'bank_account' => 'required|between:10,12',
            'bank_name' => 'required|between:3,30',
            'description' => 'max:150',
            'address' => 'max:120'

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
    
}


