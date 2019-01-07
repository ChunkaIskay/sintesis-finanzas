<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    
    protected $table = 'services';
    protected $primaryKey = 'service_id';

    public static $messages =[
            'name.required' => 'Ingrese el nombre del servicio.',
            'name.between' => 'El nombre del servicio debe tener entre 3 y 30 caracteres.',
           
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
 

    


}
