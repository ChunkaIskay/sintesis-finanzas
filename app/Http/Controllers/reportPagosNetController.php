<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Curls;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\reportPagosNet;

class reportPagosNetController extends Controller
{
  
	//public function get_detail(){
	public function index(){
//		$pin_code = $_REQUEST['pin_code'];
		$url = "http://postalpincode.in/api/pincode/110001";
		$ch= curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		echo "<pre>";print_r($output); echo"</pre>";
	}
}
