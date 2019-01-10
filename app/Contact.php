<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';
    protected $primaryKey = 'contact_id';

    public static $messages =[
            'nombre.required' => 'Ingrese el nombre del contacto.',
            'nombre.between' => 'El nombre del contacto debe tener entre 3 y 30 caracteres.',
            'apellido.required' => 'Ingrese el apellido del contacto.',
            'apellido.between' => 'El apellido debe tener entre 3 y 30 caracteres.',
            'telefono.between' => 'El número de teléfono debe tener entre 7 y 8 digitos.',
            'celular.between' => 'El número de celular debe tener entre 7 y 8 digitos.',
            'email.required' => 'Ingrese nuevamente su correo.',
            'cargo.required' => 'Ingrese el cargo del contacto.',
            'cargo.between' => 'El carog debe tener entre 3 y 45 caracteres.',

            
    ];

    public static $rules = [
            'nombre' => 'required|between:3,30',
            'apellido' => 'required|between:3,30',
            'telefono' => 'required|between:7,8',
            'celular' => 'required|between:7,8',
            'email' => 'required|string|email|max:255',
            'cargo' => 'required|between:3,45'

    ];
    
    public function entities(){
    	return $this->hasMany('App\Entity', 'entity_id');
    }

}
