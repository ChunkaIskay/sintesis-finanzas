<?php
/** 
 * 
 * Config    
 * @package SVPN  
 * @author Jacinto Alex Olazo Mollo(alexo@sintesis.com.bo) 
 * @modified by  
 * @date 2019-02-28  
 */
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', true);
//error_reporting(E_ERROR);

//require_once("config.php");

class Setup {

    /**
     * Config array
     *
     * @var array config
     */
    var $config;

    var $conectDB = "";
    var $userDB = "";
    var $passwordDB = "";  
    var $serverDB = "";
    var $dataB = "";

    /**
     *
     * @var getMessage array 
     */
  //  var $getMessage = array();
    
   
    public function __contruct($ht)
    {   

            if($ht == 1){

                $userDB = "ivana";
                $passwordDB = "ivana123";  
                $serverDB = "199.14.10.105";
                $dataB = "Dataw";

            }elseif($ht == 2){

                    $userDB = "finanzas";
                    $passwordDB = "chupete99";  
                    $serverDB = "199.3.0.149";
                    $dataB = "finances";
            }

            $conectDB = mysqli_connect( $serverDB, $userDB, $passwordDB, $dataB ) or die ("Error: No se es posible conectar a la db $ht, comuniquese con el adminstrador");
            
            if ($conectDB->connect_errno){
                echo "Error: no es posible conectarse a la conectarse a la DB $ht, comuniquese con el administrador: (" . $conectDB->connect_errno . ") " . $conectDB->connect_error;
            }

             return $conectDB;
    }
}

?>