<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   
    protected $table = 'contracts';
    protected $primaryKey = 'contract_id';

    public static $messages =[
            'codigo_carpeta.required' => 'Ingrese el código de la carpeta',
            'codigo.required' => 'Ingrese el código del contrato.',
            'codigo.between' => 'El nombre del contrato debe tener entre 2 y 10 caracteres.',
            'description.max' => 'La descripción solo admite hasta 150 caracteres.',
            'entidad.max' => 'Verifique el campo de entidad por favor!',
            'servicio.max' => 'Verifique el campo del servicio por favor!',
            'numero_mes.required_if' => 'Ingrese la cantidad de Meses consecutivos',
            'cate_general.max' => 'Verifique el campo categoría general por favor!',
            'cate_especifica.max' => 'Verifique el campo categoría especifica por favor!',
            'tipo.max' => 'Verifique el campo tipo de contrato por favor!'
    
    ];

    public static $rules = [
            'codigo_carpeta' => 'required|between:2,10',
            'codigo' => 'required|between:2,10',
            'entidad' => 'max:3',
            'servicio' => 'max:3',
            'numero_mes' => 'required_if:automatica,yes',
            'cate_general' => 'max:2',
            'cate_especifica' => 'max:2',
            'tipo' => 'max:2',
            'description' => 'max:150'
    ];
    
    public function entities(){
    	return $this->hasMany('App\Entity', 'entity_id');
    }
    
    public function services(){
    	return $this->hasMany('App\Service','service_id');
    }

    public function categorizations(){
        return $this->hasMany('App\Categorization','categorization_id');
    }

    public function typeContracts(){
        return $this->hasMany('App\TypeContract','type_id');
    }

    public function operationalManagement(){
        
         return $this->belongsTo('App\Contract');
    }
    
    public function getServiceNameAttribute()
    {
        if($this->service)
            return $this->service->name;

        return "Otros";

    }


}
