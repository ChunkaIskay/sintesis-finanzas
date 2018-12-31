<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $primaryKey = 'contract_id';
    
    // relacion one to many
    public function entities(){
    	return $this->hasMany('App\Entity', 'entity_id');
    }
    // relacion one to many
    public function services(){
    	return $this->hasMany('App\Service','service_id');
    }

}
