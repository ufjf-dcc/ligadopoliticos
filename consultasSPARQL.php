<?php
function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
        
function consultaSPARQL($sparql){
error_reporting(E_ALL);
ini_set("display_errors", 1);
$dados = new Constant;
$login = getProperty($dados->DB_LOGIN_SPARQL);
$url_sparql = getProperty($dados->DB_URL_SPARQL);

      //definindo o formato de retorno dos dados
       $format = 'application/sparql-results+json';
       //definindo a consulta
$consulta = $sparql;
//codificando a consulta
       $url = urlencode($consulta);
       //concatenando as string para formar a url de consulta
$sparqlURL = $url_sparql.'?query='.$url;

/*Setando o cabecalho da requisicao */
//usando a fun����o curl para conectar com o allegrograph
$curl = curl_init();//inicializando o curl
   curl_setopt($curl, CURLOPT_USERPWD, $login); //usuario e senha do banco
       curl_setopt($curl, CURLOPT_URL, $sparqlURL);//definindo a url de consulta
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o retorno da consulta como uma string
       curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format));//definido o formato de retorno desejado
       $resposta = curl_exec( $curl );//executando o curl e armazenando a resposta numa variavel
       curl_close($curl);//fechando o curl
       
     
       ///////// come��ando a manipula����o de dados/////////////
       $objects = array();
       $resultado = json_decode($resposta);//Decodificando o objecto json

       
       //pegando o valor de interesse no array//
       foreach($resultado->results->bindings as $reg){// primeiro loop
           $obj = new stdClass();
            foreach($reg as $field => $value){
                $obj->$field = $value->value;
            }
            $objects[] = $obj;
}//sai do segundo loop
           
         $row =  objectToArray($objects);
        return $row;
}   
?>