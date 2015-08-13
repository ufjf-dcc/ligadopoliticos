<?php
    error_reporting(E_ALL);
    include ('consultasSPARQL.php');
    ini_set("display_errors", 1);
    $login = "marcos:123";

    $format = 'application/sparql-results+json';
    $endereco = "select ?x {
	?x polbr:declarationOfAssets ?y.
  	?y timeline:atYear \"2014\". }";

    $url = urlencode($endereco);
    $sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'+limit+1';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);
    curl_setopt($curl, CURLOPT_URL, $sparqlURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
    curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
    $resposta = curl_exec( $curl );
    curl_close($curl);

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

    $arquivo = "texto.txt";
    $file = fopen("$arquivo","w"); // vc colokou "$arquivo, faltou a aspa final.
    $fp = fwrite($file,$row['y']);
    $string = "O IP / A DATA / E A HORA";
    fclose($file);
?>