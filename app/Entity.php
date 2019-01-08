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
           
            'description.max' => 'La descripción solo admite hasta 150 caracteres.'
    ];

    public static $rules = [
            'name' => 'required|between:3,30',
            'description' => 'max:150'

    ];

    // relacion one to many
    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }
     public function countries(){
        return $this->hasMany('App\Country', 'country_id');
    }
    
}


