<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $table = 'contracts';
    protected $primaryKey = 'contract_id';

    public static $messages =[
            'codigo.required' => 'Ingrese el nombre del contrato.',
            'codigo.between' => 'El nombre del contrato debe tener entre 3 y 30 caracteres.',
           
            'description.max' => 'La descripción solo admite hasta 150 caracteres.'
    ];

    public static $rules = [
            'codigo' => 'required|between:3,30',
            'description' => 'max:150'

    ];
    
    
    // relacion one to many
    public function entities(){
    	return $this->hasMany('App\Entity', 'entity_id');
    }
    // relacion one to many
    public function services(){
    	return $this->hasMany('App\Service','service_id');
    }

    public function categorizations(){
        return $this->hasMany('App\Categorization','categorization_id');
    }

    public function typeContracts(){
        return $this->hasMany('App\TypeContract','type_id');
    }
    // 
    public function getServiceNameAttribute()
    {
        if($this->service)
            return $this->service->name;

        return "Otros";

    }


}
