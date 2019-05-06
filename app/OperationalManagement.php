<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationalManagement extends Model
{
    protected $table = 'operational_management';
    protected $primaryKey = 'operation_id';

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
    public function contracts(){
    	return $this->hasMany('App\Contract', 'contract_id');
    }

}
