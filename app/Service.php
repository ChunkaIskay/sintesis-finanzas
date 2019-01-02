<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    
    protected $table = 'services';
    protected $primaryKey = 'service_id';

    // relacion one to many
    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }
   
}
