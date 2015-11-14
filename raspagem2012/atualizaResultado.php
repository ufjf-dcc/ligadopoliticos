<?php
     error_reporting(E_ALL);
     include '../consultasSPARQL.php';
     include_once '../properties.php';
     
    //Login:Senha
    $login = "raphael:123" ;
    $caminhoDir = 'Resultado2012';
    leDiretorio($caminhoDir);
    
     $arquivos = array();
     $cont = 0;
    function leDiretorio($caminhoDir){
        
        $diretorio = dir($caminhoDir);
        
        while($arquivo = $diretorio -> read()){ 
            if($arquivo != '.' && $arquivo != '..')
            {
                $caminhoArq = $caminhoDir.'/'.$arquivo; 
                $arquivos[$cont] = $caminhoArq;
                $cont++;
            }
            
        } 
        $diretorio -> close();
       //ordena os arquivos para não inserir o resultado da segunda eleição antes do resultado da primeira
       asort($arquivos);
         
        foreach ($arquivos as $arquivo)
            leArquivoESalvaNoBanco($arquivo);
    }
    
    function leArquivoESalvaNoBanco($caminhoArq){
        
        $handle = fopen ($caminhoArq,"r");
        //zero deixa ilimitado o tamanho da linha
        $data = fgetcsv($handle, 0 ,";");
        $indiceUF = 0;
        $indiceMunicipio =0;
        $indiceNr = 0;
        $indiceQtVotos = 0;
        $indiceSituacao = 0;
        for($col = 0; $col < count($data) ; $col++)
        {
            $data[$col] = iconv("ISO-8859-1", "UTF-8", $data[$col]);
            if(strcmp($data[$col], "UF") == 0)
                $indiceUF = $col;
            else if(strcmp($data[$col], "Município") == 0)
                    $indiceMunicipio = $col;
            else if(strcmp($data[$col], "Nr") == 0)
                    $indiceNr = $col;
            else if(strcmp($data[$col], "Situação") == 0)
                    $indiceSituacao = $col;
        }
        
        while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
            
            $cidade = iconv("ISO-8859-1", "UTF-8", $data[$indiceMunicipio]);
            $estado = iconv("ISO-8859-1", "UTF-8", $data[$indiceUF]);
            $numero_urna = iconv("ISO-8859-1", "UTF-8", $data[$indiceNr]);
            $numero_urna = str_replace(".", "", $numero_urna);
            $resultado = iconv("ISO-8859-1", "UTF-8", $data[$indiceSituacao]);
            selecionaCandidatos ("2012", $cidade, $estado, $numero_urna, $resultado);
        }
        
        fclose ($handle);
         
     }
     
     //seleciona qual resultado colocar para o candidato
     function selecionaCandidatos($ano, $cidade ,$estado, $numero_urna , $resultado){
        
        $consulta = 'select ?id ?situacao
where{ ?id polbr:election ?election.
      ?election timeline:atYear "'.$ano.'".
      ?election biblio:number "'.$numero_urna.'".
      ?election polbr:situation ?situacao.
      ?election geospecies:State ?estado.
      filter (regex(?estado,"'.$estado.'","i"))
      ?election geospecies:City ?cidade.
      filter (regex(?cidade,"'.$cidade.'","i"))
     }';
        $resultado_consulta = consultaSPARQL($consulta);
         foreach ($resultado_consulta as $resultado_cand){
             if(isset($resultado_cand['situacao'])){
                $situacao = $resultado_cand['situacao'];
                $situacao = explode(" (", $situacao);
                //Envia o resultado oficial
                if(strcmp($situacao[0], "APTO") == 0)
                    resultado ($resultado_cand['id'], $resultado, $ano, $numero_urna);
                //Coloca o resultado como Não eleito
                else if(strcmp($situacao[0], "INAPTO") == 0)
                    resultado ($resultado_cand['id'], "Não Eleito", $ano, $numero_urna);
             }
         }
     }
     
     //Caso já exista resultado apaga o mesmo e coloca o novo
     //Caso não exista resultado o novo resultado é colocado em um blank node
    //////////////// 
    //Conferir o caso o candidato tenha mais de um election
     ///////////
     function resultado($id , $resultado ,$ano, $numero_urna){
         $format = 'application/sparql-results+json';
		
		$endereco ='select ?resultado
                            where{
                            <'.$id.'> polbr:election ?election.
                            ?election timeline:atYear "'.$ano.'".
                            ?election biblio:number "'.$numero_urna.'".
                            ?election earl:outcome ?resultado.
                                            }';
                
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
                //O candidato já possui o campo preenchido
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


			if (!empty($objects[0]->resultado)){ $NewResultado = $objects[0]->resultado ;}else{ $NewResultado = null;}
	

			
			$format = 'application/sparql-results+xml';

			//deletando dados para inserir dados novos
			$where = 'WHERE { <'.$id.'>  polbr:election ?election.
					 ?election timeline:atYear "'.$ano.'".
                                         ?election biblio:number ?numero.
                                         filter(?numero = "'.$numero_urna.'")
                                        }';			

			$endereco ='DELETE { ?election earl:outcome "'.$NewResultado.'" }
                                    '.$where;
			
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

			if ($resultado != null ){ $NewResultado = $resultado ;}else{ $NewResultado = $objects[0]->resultado ;}

			

			//inserindo o novo
			$endereco = 'INSERT { ?election earl:outcome "'.$NewResultado.'" }
                                     WHERE { <'.$id.'>  polbr:election ?election.
					 ?election timeline:atYear "'.$ano.'".
                                         ?election biblio:number ?numero.
                                         filter(?numero = "'.$numero_urna.'")
                                        }';
                        
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
		}
                else{
			
			$format = 'application/sparql-results+xml';
		
			$endereco = 'INSERT { ?election earl:outcome "'.$resultado.'" }
                                     WHERE { <'.$id.'>  polbr:election ?election.
					 ?election timeline:atYear "'.$ano.'".
                                         ?election biblio:number ?numero.
                                         filter(?numero = "'.$numero_urna.'")
                                        }';
                        
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


		}
                 
                 
     }
?>
