<?php


 //BUSCA PARA VER SE EXISTE POLITICO A PARTIR DO NOME E DA DATA DE NASCIMENTO
       
       include ("upgrade.database.php");
       
       //$resposta = existePoli("MICHEL MIGUEL ELIAS TEMER LULIA", "23/09/1940");
       //echo $resposta;
       $resposta = prox();
       
       /*error_reporting(E_ALL);
	//Login:Senha
	$login = "marcos:123" ;
        
        function existePolitico ( $nome, $aniversario){
            $aux = '"';
            $format = 'application/sparql-results+xml';
            $i =$aux."i".$aux;
            $endereco = "select ?id {?id foaf:name ?name.
                                    ?id foaf:birthday ?birthday.
                                    FILTER regex(?name, ".$aux.$cont[0].$aux.", ".$i.")
                                    FILTER regex(?birthday, ".$aux.$cont[1].$aux.", ".$i.")
                            }";
            //FILTER regex(?city, ".$cont[3].", ".$i.") ; ?id being:place-of-birth ?city.

            $url = urlencode($endereco);
            $sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'+limit+1';


                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
                    curl_setopt($curl, CURLOPT_URL, $sparqlURL);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
                    curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
                    $resposta = curl_exec( $curl );
                    curl_close($curl);

                    $resposta =  str_replace("http://ligadonospoliticos.com.br/politico/","", $resposta);	//retorna id do politico?!	
                    echo $resposta;
                    if($resposta == null){return 0;}
                    if($resposta != null){return $resposta;}

        }  
        
        function declaracao_bens($id_politico, $ano, $descricao, $tipo, $valor){

		$format = 'application/sparql-results+json';
		$aux = '"';
		$endereco = "select ?tipo ?valor {  
					 <http://ligadonospoliticos.com.br/politico/$id_politico>  polbr:declarationOfAssets ?declarationOfAssets.
					 ?declarationOfAssets timeline:atYear ".$aux.$ano.$aux.".
					 ?declarationOfAssets polbr:DeclarationOfAssets ?DeclarationOfAssets .
					 ?DeclarationOfAssets dcterms:description ".$aux.$descricao.$aux." . 
					 OPTIONAL { ?DeclarationOfAssets dcterms:type ?tipo}
					 OPTIONAL { ?DeclarationOfAssets rdfmoney:Price ?valor }

           			}";

                
		$url = urlencode($endereco);
		$sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'+limit+1';
                echo $sparqlURL."<br>";
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
	    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
	    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
	    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
	    	$resposta = curl_exec( $curl );
	    	curl_close($curl);

                echo $resposta."<br>";
		$achou = false;
		$resposta_decoded = json_decode($resposta);
		
		//verifica se algum valor da consulta é diferente de null
		foreach($resposta_decoded->results->bindings as $reg){
			if($reg != null)
			{
				$achou = true;
			}
		}
	
		
		if($achou){
                    
                    $objects = array();
		        $results = json_decode($resposta);//descodifica o objeto json para um array
			//pega o valor dentro de dois array
			    foreach($results->results->bindings as $reg){
				   $obj = new stdClass();
				   foreach($reg as $field => $value){
				       $obj->$field = $value->value;
				   }
				   $objects[] = $obj;//guarda no array o objeto pretendido
			       }


			if (!empty($objects[0]->tipo)){ $NewTipo = $objects[0]->tipo ;}else{ $NewTipo = null;}
			if (!empty($objects[0]->valor)){ $NewValor = $objects[0]->valor ;}else{ $NewValor = null;}

			
                   $where = "WHERE { <http://ligadonospoliticos.com.br/politico/$id_politico> polbr:declarationOfAssets ?declarationOfAssets.
					 ?declarationOfAssets timeline:atYear ".$aux.$ano.$aux.".
					 ?declarationOfAssets polbr:DeclarationOfAssets ?DeclarationOfAssets .
					 ?DeclarationOfAssets dcterms:description ".$aux.$descricao.$aux." .
                            };";			


			$endereco = "DELETE { ?DeclarationOfAssets dcterms:type ".$aux.$tipo.$aux." } $where
				    DELETE { ?DeclarationOfAssets rdfmoney:Price ".$aux.$valor.$aux."}  $where
				";
			
			$url = urlencode($endereco);
			$sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'';		

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
		    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); // Delete precisa ser feito por POST
		    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
		    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
		    	$resposta = curl_exec( $curl );

		    	curl_close($curl);
                        
                        if ($tipo != null ){ $NewTipo = $tipo ;}else{ $NewTipo= $objects[0]->tipo ;}
			if ($valor != null){ $NewValor = $valor ;}else{ $NewValor = $objects[0]->valor;}
			

			//inserindo os novos
			$endereco = "insert {  
						 ?DeclarationOfAssets dcterms:type \"$NewTipo\".
					        ?DeclarationOfAssets rdfmoney:Price \"$NewValor\".

		   			} where{ <http://ligadonospoliticos.com.br/politico/$id_politico> polbr:declarationOfAssets ?declarationOfAssets.
					 ?declarationOfAssets timeline:atYear \"$ano\".
					 ?declarationOfAssets polbr:DeclarationOfAssets ?DeclarationOfAssets .
					 ?DeclarationOfAssets dcterms:description \"$descricao\" .}"; 
			


			$url = urlencode($endereco);
			$sparqlURL = 'http://localhost:10035/repositories/ligados?query='.$url.'';		

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
		    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
		    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
		    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
		    	$resposta = curl_exec( $curl );

		    	curl_close($curl);


		}
		else{
	
			//é feita uma contagem de quantas declarações ele tem, para saber qual numero da proxima

			$format = 'text/integer';
			$endereco = "select ?DeclarationOfAssets {  
				<http://ligadonospoliticos.com.br/politico/$id_politico>  polbr:declarationOfAssets ?declarationOfAssets.
				?declarationOfAssets timeline:atYear ".$aux.$ano.$aux.".
				?declarationOfAssets polbr:DeclarationOfAssets ?DeclarationOfAssets.
	
		   			}";

			$url = urlencode($endereco);
			$sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'';
		
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
		    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
		    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
		    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
		    	$contador = curl_exec( $curl );
		    	curl_close($curl);



			//agora é feita a inserção

			$contador = $contador + 1 ;
			
			$format = 'application/sparql-results+xml';
		
			$endereco = "insert data {  
						 <http://ligadonospoliticos.com.br/politico/$id_politico> polbr:declarationOfAssets _:declaration .
						 _:declaration timeline:atYear ".$aux.$ano.$aux." .
						 _:declaration polbr:DeclarationOfAssets _:DeclarationOf . 
					         _:DeclarationOf rdf:type being:owns .
					         _:DeclarationOf biblio:number ".$aux.$contador.$aux." .
				                 _:DeclarationOf dcterms:description ".$aux.$descricao.$aux." .
				                 _:DeclarationOf dcterms:type ".$aux.$tipo.$aux." .
						 _:DeclarationOf rdfmoney:Price ".$aux.$valor.$aux.".
		   			}";
			$url = urlencode($endereco);
			$sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'';			

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
		    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
		    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
		    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
		    	$resposta = curl_exec( $curl );
		    	curl_close($curl);
                        
                        echo $resposta."<br>";

		}		

	}*/

        
    ?>