<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function addSelected($level, $levels){

        for($i=0; $i<count($level) ; $i++) { 
                foreach ($levels as $key => $value) {
                    if($level[$i] == $key ){
                        $levels[$key][1]= "selected";     
                     }
                }
        }

        return $levels;

    }
}
