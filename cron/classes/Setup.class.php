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

    /**
     *
     * @var getMessage array 
     */
  //  var $getMessage = array();
    
   
    public function __contruct()
    {   
        echo "hola9";
        
        $usuario = "ivana";
        $contrasena = "ivana123";  
        $servidor = "199.14.10.105";
        $basededatos = "Dataw";
               
        $conectDB = mysqli_connect( $servidor, $usuario, $contrasena, $basededatos ) or die ("No se pudo conectar a la db");
        
        if ($conectDB->connect_errno){
            echo "Erro al conectarse a la DB: (" . $conectDB->connect_errno . ") " . $conectDB->connect_error;
        }

        return $conectDB;

        
        
    }
}

?>