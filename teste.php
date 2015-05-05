<?php
    error_reporting(E_ALL);
	//Login:Senha
	$login = "marcos:123" ; 
        include ("upgrade.database.php");
        $resposta = existePoli("ANTONIO DA CRUZ DA ROCHA ALVES", "22/04/1974");
        echo gettype ($resposta);
        
        //declaracao_bens("22641", "2014", "HONDA FIT 2002 DMB 7786 ADQUIRIDO NA HONDA", "CARRO", "30000,00");
    /*$situacao ="Registro de Candidatura Governador | Situação pós-pleito: Renúncia";
    $cargo = explode ("|",$situacao);
    $cargo_parte = explode(' ',$cargo[0]);
    echo $cargo_parte[3];*/
    /*//$id = existePoli("MARIA OSMARINA MARINA DA SILVA VAZ DE LIMA", "08/02/1958");
    //echo $id;
    //$resposta = foto_politico("http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/UF/BR/foto/280000000121.jpg?x=1414180049000280000000121", $id);
    //$resposta = eleicao("22641", "2014", "EDUARDO JORGE", "43", "Partido Verde", "Presidente", null, "Não eleito", null, "PV", "Não eleito", "157592014", "701-64.2014.6.00.0000", "20558032000114");
    $nome_civil = "EDUARDO JORGE MARTINS ALVES SOBRINHO";
    $nome_parlamentar = "EDUARDO JORGE";
    $nome_pai = null;
    $nome_mae = null;
    $foto = null;
    $sexo = "MASCULINO";
    $cor = "Branca";
    $data_nascimento = "26/10/1949";
    $estado_civil = "Casado(a)";
    $ocupacao = "Médico";
    $grau_instrucao = "Superior completo";
    $nacionalidade = "Brasileira nata";
    $cidade_nascimento = "BA-SALVADOR";
    $estado_nascimento = "BA-SALVADOR";
    $cidade_eleitoral = null;
    $estado_eleitoral = null;
    $site = "www.eduardojorgepv.com.br";
    $email = null;
    $cargo = "Presidente";
    $cargo_uf = null;
    $partido = "Partido Verde";
    $situacao = "Não eleito";
    $resposta1 = politico($nome_civil, $nome_parlamentar, $nome_pai, $nome_mae, $foto, $sexo, $cor, $data_nascimento, $estado_civil, $ocupacao, $grau_instrucao, $nacionalidade, $cidade_nascimento, $estado_nascimento, $cidade_eleitoral, $estado_eleitoral, $site, $email, $cargo, $cargo_uf, $partido, $situacao);
    
    //$resposta = declaracao_bens("22641", "2014", "HONDA FIT 2003 DMB 7786 ADQUIRIDO NA HONDA", "CARRO", "30000,00");
    */
         
        
        
        
        
        
        /*
        function endereco_parlamentar_politico($id_politico, $anexo, $ala, $gabinete, $email, $telefone, $fax, $tipo, $rua, $bairro, $cidade, $estado, $CEP, $CNPJ, $telefone_parlamento, $disque, $site){
		$format = 'application/sparql-results+json';
		$politico = "<http://ligadonospoliticos.com.br/politico/".$id_politico.">";
                echo $politico;

		$endereco = "select ?gabinete ?email ?fax ?tipo ?rua ?bairro ?cidade ?estado ?CEP ?CNPJ ?telefone_parlamento ?disque ?site {  
					 $politico polbr:annex \"$anexo\" .
					 $politico  polbr:wing \"$ala\" .
					 $politico foaf:phone \"$telefone\" .
					 OPTIONAL { $politico polbr:cabinet ?gabinete}
					 OPTIONAL { $politico biblio:Email ?email }
					 OPTIONAL { $politico vcard:fax ?fax }
					 OPTIONAL { $politico po:Place ?tipo }
					 OPTIONAL { $politico vcard:street-address ?rua }
					 OPTIONAL { $politico polbr:district ?bairro }
					 OPTIONAL { $politico vcard:locality ?cidade }
					 OPTIONAL { $politico geospecies:State ?estado }
					 OPTIONAL { $politico vcard:postal-code ?CEP }
					 OPTIONAL { $politico polbr:CNPJ ?CNPJ }
					 OPTIONAL { $politico foaf:phone ?telefone_parlamento }
					 OPTIONAL { $politico foaf:phone ?disque }
					 OPTIONAL { $politico foaf:homepage ?site }
					 FILTER ( ?telefone != ?telefone_parlamento )
  					 FILTER ( ?telefone != ?disque )
  					 FILTER ( ?disque != ?telefone_parlamento )
					 FILTER regex(?disque, \"0800\")

           			}";
                
                echo $endereco."----------<br>";
		$url = urlencode($endereco);
		$sparqlURL = 'http://localhost:10035/repositories/politicos_brasileiros?query='.$url.'+limit+1';

		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
	    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
	    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
	    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
	    	$resposta = curl_exec( $curl );
	    	curl_close($curl);


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


			if (!empty($objects[0]->gabinete)){ $NewGabinete = $objects[0]->gabinete ;}else{ $NewGabinete = null;}
			if (!empty($objects[0]->email)){ $NewEmail = $objects[0]->email ;}else{ $NewEmail = null;}
			if (!empty($objects[0]->fax)){ $NewFax = $objects[0]->fax ;}else{ $NewFax = null;}
			if (!empty($objects[0]->tipo)){ $NewTipo = $objects[0]->tipo ;}else{ $NewTipo = null;}
			if (!empty($objects[0]->rua)){ $NewRua = $objects[0]->rua ;}else{ $NewRua = null;}
			if (!empty($objects[0]->bairro)){ $NewBairro = $objects[0]->bairro ;}else{ $NewBairro = null;}
			if (!empty($objects[0]->cidade)){ $NewCidade = $objects[0]->cidade ;}else{ $NewCidade = null;}
			if (!empty($objects[0]->estado)){ $NewEstado  = $objects[0]->estado ;}else{ $NewEstado  = null;}
			if (!empty($objects[0]->CEP)){ $NewCEP = $objects[0]->CEP ;}else{ $NewCEP = null;}
			if (!empty($objects[0]->CNPJ)){ $NewCNPJ = $objects[0]->CNPJ ;}else{ $NewCNPJ = null;}
			if (!empty($objects[0]->telefone_parlamento)){ $NewTelefoneParl = $objects[0]->telefone_parlamento ;}else{ $NewTelefoneParl = null;}
			if (!empty($objects[0]->disque)){ $NewDisque = $objects[0]->disque ;}else{ $NewDisque = null;}
			if (!empty($objects[0]->site)){ $NewSite = $objects[0]->site ;}else{ $NewSite = null;}
	
			
			$format = 'application/sparql-results+xml';

			//deletando dados para inserir dados novos
			$where = "WHERE {  $politico polbr:annex \"$anexo\" .
					   $politico  polbr:wing \"$ala\" .
					   $politico foaf:phone \"$telefone\" .
};";			
		
			$endereco = "DELETE { $politico polbr:cabinet \"$NewGabinete\" } $where
				     DELETE { $politico biblio:Email \"$NewEmail\" } $where
				     DELETE { $politico vcard:fax \"$NewFax\" } $where
				     DELETE { $politico po:Place \"$NewTipo\" } $where
				     DELETE { $politico vcard:street-address \"$NewRua\" } $where
				     DELETE { $politico polbr:district \"$NewBairro\" } $where
				     DELETE { $politico vcard:locality \"$NewCidade\" } $where
				     DELETE { $politico geospecies:State \"$NewEstado\" } $where
				     DELETE { $politico vcard:postal-code \"$NewCEP\" } $where
				     DELETE { $politico polbr:CNPJ \"$NewCNPJ\" } $where
				     DELETE { $politico foaf:phone \"$NewTelefoneParl\" } $where
				     DELETE { $politico foaf:phone \"$NewDisque\" } $where
				     DELETE { $politico foaf:homepage \"$NewSite\" } $where

				";
			echo $endereco."----------<br>";
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



			if ($gabinete != null ){ $NewGabinete = $gabinete ;}else{ $NewGabinete= $objects[0]->gabinete ;}
			if ($email != null){ $NewEmail = $email ;}else{ $NewEmail = $objects[0]->email;}
			if ($fax != null ){ $NewFax = $fax ;}else{ $NewFax= $objects[0]->fax ;}
			if ($tipo != null ){ $NewTipo = $tipo ;}else{ $NewTipo= $objects[0]->tipo ;}
			if ($rua != null){ $NewRua = $rua ;}else{ $NewRua = $objects[0]->rua;}
			if ($bairro != null ){ $NewBairro = $bairro ;}else{ $NewBairro= $objects[0]->bairro ;}
			if ($cidade != null){ $NewCidade = $cidade ;}else{ $NewCidade = $objects[0]->cidade;}
			if ($estado != null){ $NewEstado = $estado ;}else{ $NewEstado = $objects[0]->estado;}
			if ($CEP != null ){ $NewCEP = $CEP ;}else{ $NewCEP= $objects[0]->CEP ;}
			if ($CNPJ != null){ $NewCNPJ = $CNPJ ;}else{ $NewCNPJ = $objects[0]->CNPJ;}
			if ($telefone_parlamento != null ){ $NewTelefoneParl = $telefone_parlamento ;}else{ $NewTelefoneParl= $objects[0]->telefone_parlamento ;}
			if ($disque != null){ $NewDisque = $disque ;}else{ $NewDisque = $objects[0]->disque;}
			if ($site != null ){ $NewSite = $site ;}else{ $NewSite= $objects[0]->site ;}


			//inserindo os novos
			$endereco = "insert {  
						  $politico polbr:cabinet \"$NewGabinete\".
				   		  $politico biblio:Email \"$NewEmail\" .
				     		  $politico vcard:fax \"$NewFax\" .
				     		  $politico po:Place \"$NewTipo\" .
				    		  $politico vcard:street-address \"$NewRua\" .
				     		  $politico polbr:district \"$NewBairro\" .
				     		  $politico vcard:locality \"$NewCidade\" .
				    		  $politico geospecies:State \"$NewEstado\" .
				     		  $politico vcard:postal-code \"$NewCEP\" .
				     		  $politico polbr:CNPJ \"$NewCNPJ\" .
				     		  $politico foaf:phone \"$NewTelefoneParl\" .
				     		  $politico foaf:phone \"$NewDisque\" .
				     		  $politico foaf:homepage \"$NewSite\" .

		   			} where{ $politico polbr:annex \"$anexo\" .
					 	 $politico  polbr:wing \"$ala\" .
					 	 $politico foaf:phone \"$telefone\" .}"; 
			

                        echo $endereco."----------<br>";
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
                        return $resposta;
		}
		else{

			$format = 'application/sparql-results+xml';
		
			$endereco = "insert data {  
						 $politico polbr:annex \"$anexo\" .
					 	 $politico  polbr:wing \"$ala\" .
					 	 $politico foaf:phone \"$telefone\"
						 $politico polbr:cabinet \"$NewGabinete\".
				   		 $politico biblio:Email \"$NewEmail\" .
				     		 $politico vcard:fax \"$NewFax\" .
				     		 $politico po:Place \"$NewTipo\" .
				    		 $politico vcard:street-address \"$NewRua\" .
				     		 $politico polbr:district \"$NewBairro\" .
				     		 $politico vcard:locality \"$NewCidade\" .
				    		 $politico geospecies:State \"$NewEstado\" .
				     		 $politico vcard:postal-code \"$NewCEP\" .
				     		 $politico polbr:CNPJ \"$NewCNPJ\" .
				     		 $politico foaf:phone \"$NewTelefoneParl\" .
				     		 $politico foaf:phone \"$NewDisque\" .
				     		 $politico foaf:homepage \"$NewSite\" .
		   			}";

                        echo $endereco."----------<br>";
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
                        return $resposta;
		}

		
	}
	

	
	
	function lideranca($id_politico, $descricao, $tipo, $data_inicio, $data_fim){

		$format = 'application/sparql-results+json';
		
		$endereco = "select ?data_fim ?tipo {  
					 <http://ligadonospoliticos.com.br/politico/$id_politico>  polbr:leadership ?leadership.
					 ?leadership timeline:beginsAtDateTime \"$data_inicio\".
					 ?leadership dcterms:description \"$descricao\" . 
					 OPTIONAL { ?leadership  timeline:endsAtDateTime ?data_fim}
					 OPTIONAL { ?leadership  dcterms:type ?tipo }

           			}";

		

		$url = urlencode($endereco);
		$sparqlURL = 'http://localhost:10035/repositories/ligados?query='.$url.'+limit+1';

		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
	    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
	    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
	    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
	    	$resposta = curl_exec( $curl );
	    	curl_close($curl);


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


			if (!empty($objects[0]->data_fim)){ $NewDataFim = $objects[0]->data_fim ;}else{ $NewDataFim = null;}
			if (!empty($objects[0]->tipo)){ $NewTipo = $objects[0]->tipo ;}else{ $NewTipo = null;}

			
			$format = 'application/sparql-results+xml';

			//deletando dados para inserir dados novos
			$where = "WHERE { <http://ligadonospoliticos.com.br/politico/$id_politico> polbr:leadership ?S .
					?S timeline:beginsAtDateTime \"$data_inicio\".
					?S dcterms:description \"$descricao\" . 
};";			


			$endereco = "DELETE { ?S timeline:endsAtDateTime \"$NewDataFim\" } $where
				    DELETE { ?S dcterms:type \"$NewTipo\" }  $where
				";
			
			$url = urlencode($endereco);
			$sparqlURL = 'http://localhost:10035/repositories/ligados?query='.$url.'';		

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_USERPWD, $GLOBALS['login']);	
		    	curl_setopt($curl, CURLOPT_URL, $sparqlURL);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); // Delete precisa ser feito por POST
		    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o output da url como uma string
		    	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format ));
		    	$resposta = curl_exec( $curl );

		    	curl_close($curl);

			

			if ($data_fim != null ){ $NewDataFim = $data_fim ;}else{ $NewDataFim= $objects[0]->data_fim ;}
			if ($tipo != null){ $NewTipo = $tipo ;}else{ $NewTipo = $objects[0]->tipo;}
			

			//inserindo os novos
			$endereco = "insert {  
						 ?S timeline:endsAtDateTimee \"$NewDataFim\".
					         ?S dcterms:type \"$NewTipo\" .

		   			} where{ <http://ligadonospoliticos.com.br/politico/$id_politico> polbr:leadership ?S. 
					 ?S timeline:beginsAtDateTime \"$data_inicio\".
					 ?S dcterms:description \"$descricao\" .  }"; 
			


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

			//é feita uma contagem de quantas comissões ele tem, para saber qual numero da proxima

			$format = 'text/integer';
			$endereco = "select ?leadership {  
						 <http://ligadonospoliticos.com.br/politico/$id_politico>  polbr:leadership ?leadership.
	
		   			}";

			$url = urlencode($endereco);
			$sparqlURL = 'http://localhost:10035/repositories/ligados?query='.$url.'';
		
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
						 <http://ligadonospoliticos.com.br/politico/$id_politico> polbr:leadership _:blank .
						 _:blank biblio:number \"$contador\" .
					         _:blank dcterms:description \"$descricao\" .
					         _:blank timeline:beginsAtDateTime \"$data_inicio\" .
				                 _:blank timeline:endsAtDateTime \"$data_fim\" .
				                 _:blank dcterms:type \"$tipo\" .
		   			}";


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

	}
	
	*/
                
?>
