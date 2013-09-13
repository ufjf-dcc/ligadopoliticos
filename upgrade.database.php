<?php


	/* Funções referentes as tabelas do bando de dados.
	 * Encontra um certo dado e o atualiza ou
	 * Insere um novo dado no banco.
	*/

	 
	// returna o id do politico se o mesmo existir	
	function existePoli($nome, $data, $cidade){

		$result = mysql_query("SELECT * FROM politico");

		while($row = mysql_fetch_assoc($result)){
			
		// Verifica se os nomes são iguais
		if(strcasecmp($nome, $row['nome_civil']) == 0){

			// Verifica se a data são iguais
			if(strcasecmp($data, $row['data_nascimento']) == 0){

				//returna id se o nome e data forem iguais
				return $row['id_policio'];		
		
			}else{

				$similar_cidade = similar_text($cidade,$row['cidade_nascimento']);
				$tamCidade = strlen($row['cidade_nascimento']);
				
				if( ((100* $similar_cidade)/ $tamCidade) >= 85){
					
					//retorna id se nome e cidade(85%) forem iguais
					return $row['id_politico'];

					}

				}
			}
		}
		}


	function afastamento($id_politico, $id_mandato, $cargo, $cargo_uf, $data, $tipo, $motivo, $pagina_ficha_limpa, $pagina_senado){

		$result = mysql_query("SELECT * FROM afastamento WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['data'] == $data){
					$k = -1;
					break;
				}
			}
		}
		if($k == -1){
			$idafast = $row['id_afastamento'];
			if($row['id_mandato'] == NULL && $id_mandato != null){ mysql_query("UPDATE afastamento SET id_mandato='$id_mandato' WHERE id_afastamento = '$idafast'");}
			if($row['cargo'] == NULL && $cargo != null){ mysql_query("UPDATE afastamento SET cargo='$cargo' WHERE id_afastamento = '$idafast'");}
			if($row['cargo_uf'] == NULL && $cargo_uf != null){ mysql_query("UPDATE afastamento SET cargo_uf='$cargo_uf' WHERE id_afastamento = '$idafast'");}
			if($row['tipo'] == NULL && $tipo != null){ mysql_query("UPDATE afastamento SET tipo='$tipo' WHERE id_afastamento = '$idafast'");}
			if($row['motivo'] == NULL && $motivo != null){ mysql_query("UPDATE afastamento SET motivo='$motivo' WHERE id_afastamento = '$idafast'");}
			if($row['pagina_ficha_limpa'] == NULL && $pagina_ficha_limpa != null){ mysql_query("UPDATE afastamento SET pagina_ficha_limpa='$pagina_ficha_limpa' WHERE id_afastamento = '$idafast'");}
			if($row['pagina_senado'] == NULL && $pagina_senado != null){ mysql_query("UPDATE afastamento SET pagina_senado='$pagina_senado' WHERE id_afastamento = '$idafast'");}
		}	
		
		if($k == 0){
			mysql_query("INSERT INTO afastamento (id_politico, id_mandato, cargo, cargo_uf,data,tipo,motivo,pagina_ficha_limpa, pagina_senado) values ('$id_politico', '$id_mandato', '$cargo', '$cargo_uf','$data','$tipo','$motivo','$pagina_ficha_limpa', '$pagina_senado')");		
		}
		
	}

	
	function coleta($id_fonte, $url_coleta, $data_coleta, $hora_coleta){

		$result = mysql_query("SELECT * FROM coleta WHERE id_fonte = '$id_fonte'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['url_coleta'] == $url_coleta){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idcole = $row['id_coleta'];
			if($row['data_coleta'] == NULL && $data_coleta != null){ mysql_query("UPDATE coleta SET data_coleta='$data_coleta' WHERE id_coleta = '$idcole'");}
			if($row['hora_coleta'] == NULL && $hora_coleta != null){ mysql_query("UPDATE coleta SET hora_coleta='$hora_coleta' WHERE id_coleta = '$idcole'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO coleta (id_fonte, url_coleta, data_coleta, hora_coleta) values ('$id_fonte', '$url_coleta', '$data_coleta', '$hora_coleta')");		
		}
		
	}
	
	
	function comissao($descricao, $data_inicio, $data_fim, $pagina_senado, $numero_pagina){

		$result = mysql_query("SELECT * FROM comissao WHERE data_inicio = '$data_inicio'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['descricao'] == $descricao){
					$k = -1;
					break;
				}
			}
		}
		if($k == -1){
			$idcomi = $row['id_comissao'];
			if(($row['data_fim'] == NULL && $data_fim != null) || ($row['data_fim'] == 0 && $data_fim != null)){ mysql_query("UPDATE comissao SET data_fim='$data_fim' WHERE id_comissao = '$idcomi'");}
			if($row['pagina_senado'] == NULL && $pagina_senado != null){ mysql_query("UPDATE comissao SET pagina_senado='$pagina_senado' WHERE id_comissao = '$idcomi'");}
			if($row['numero_pagina'] == NULL && $numero_pagina != null){ mysql_query("UPDATE comissao SET numero_pagina='$numero_pagina' WHERE id_comissao = '$idcomi'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO afastamento (id_politico, id_mandato, cargo, cargo_uf,data,tipo,motivo,pagina_ficha_limpa, pagina_senado) values ('$id_politico', '$id_mandato', '$cargo', '$cargo_uf','$data','$tipo','$motivo','$pagina_ficha_limpa', '$pagina_senado')");		
		}
		
	}
	
		
	function comissao_politico($id_comissao, $id_politico, $participacao){

		$result = mysql_query("SELECT * FROM comissao WHERE id_comissao = '$id_comissao' AND id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			$row = mysql_fetch_assoc($result);
			$k = -1;
			break;
				
		}
		
		if($k == -1){
			if($row['participacao'] == NULL && $participacao != null){ mysql_query("UPDATE comissao_politico SET participacao='$participacao' WHERE id_comissao = '$id_comissao' AND id_politico = '$id_politico'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO comissao_politico (id_comissao, id_politico, participacao) values ('$id_comissao', '$id_politico', '$participacao')");		
		}
		
	}
	
		
	function declaracao_bens($id_politico, $ano, $descricao, $tipo, $valor, $pagina){

		$result = mysql_query("SELECT * FROM declaracao_bens WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['ano'] == $ano && $row['valor'] == $valor && $row['tipo'] == $tipo){
					$k = -1;
					break;
				}
			}
		}
		if($k == -1){
				
			$iddecla = $row['id_declaracao_bens'];
			if($row['descricao'] == NULL && $descricao != null){ mysql_query("UPDATE declaracao_bens SET descricao='$descricao' WHERE id_declaracao_bens = '$iddecla'");}
			if($row['pagina'] == NULL && $pagina != null){ mysql_query("UPDATE declaracao_bens SET pagina='$pagina' WHERE id_declaracao_bens = '$iddecla'");}
								
		}

		if($k == 0){
			mysql_query("INSERT INTO declaracao_bens (id_politico,ano,descricao,tipo,valor,pagina) values ('$id_politico','$ano', '$descricao', '$tipo', '$valor', '$pagina')");
		}
	
	}


	function eleicao($id_politico, $ano, $nome_urna, $numero_candidato, $situacao_candidatura, $partido, $nome_coligacao, $partidos_coligacao, $cargo, $cargo_uf, $prestacao_contas, $resultado, $numero_protocolo, $numero_processo, $cnpj_campanha){

		$result = mysql_query("SELECT * FROM eleicao WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['ano'] == $ano){
					$k = -1;
					break;
				}
			}
			}
		if($k ==  -1){
			
			if($row['nome_urna'] == NULL && $nome_urna != null){ mysql_query("UPDATE eleicao SET nome_urna='$nome_urna' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['numero_candidato'] == NULL && $numero_candidato != null){ mysql_query("UPDATE eleicao SET numero_candidato='$numero_candidato' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['situacao_candidatura'] == NULL && $situacao_candidatura != null){ mysql_query("UPDATE eleicao SET situacao_candidatura='$situacao_candidatura' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['partido'] == NULL && $partido != null){ mysql_query("UPDATE eleicao SET partido='$partido' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['nome_coligacao'] == NULL && $nome_coligacao != null){ mysql_query("UPDATE eleicao SET nome_coligacao='$nome_coligacao' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['partidos_coligacao'] == NULL && $partidos_coligacao != null){ mysql_query("UPDATE eleicao SET partidos_coligacao='$partidos_coligacao' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['cargo'] == NULL && $cargo != null){ mysql_query("UPDATE eleicao SET cargo='$cargo' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['cargo_uf'] == NULL && $cargo_uf != null){ mysql_query("UPDATE eleicao SET cargo_uf='$cargo_uf' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['prestacao_contas'] == NULL && $prestacao_contas != null){ mysql_query("UPDATE eleicao SET prestacao_contas='$prestacao_contas' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['resultado'] == NULL && $resultado != null){ mysql_query("UPDATE eleicao SET resultado='$resultado' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['numero_protocolo'] == NULL && $numero_protocolo != null){ mysql_query("UPDATE eleicao SET numero_protocolo='$numero_protocolo' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['numero_processo'] == NULL && $numero_processo != null){ mysql_query("UPDATE eleicao SET numero_processo='$numero_processo' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}
			if($row['cnpj_campanha'] == NULL && $cnpj_campanha != null){ mysql_query("UPDATE eleicao SET cnpj_campanha='$cnpj_campanha' WHERE id_politico = '$id_politico' AND ano = '$ano' ");}

		}	
		
		if($k === 0){

			mysql_query("INSERT INTO eleicao (id_politico, ano, nome_urna, numero_candidato, situacao_candidatura, partido, nome_coligacao, partidos_coligacao, cargo, cargo_uf, prestacao_contas, resultado, numero_protocolo, numero_processo, cnpj_campanha) values ('$id_politico', '$ano', '$nome_urna', '$numero_candidato', '$situacao_candidatura', '$partido', '$nome_coligacao', '$partidos_coligacao', '$cargo', '$cargo_uf', '$prestacao_contas', '$resultado', '$numero_protocolo', '$numero_processo', '$cnpj_campanha')");		

		}
		
	}


	function eleicao_ano($data, $descricao, $id_coleta){

		$result = mysql_query("SELECT * FROM eleicao_ano WHERE data = '$data'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			$row = mysql_fetch_assoc($result);
			$k = -1;
		}
		
		if($k == -1){
			$idelei = $row['id_eleicao_ano'];
			if($row['descricao'] == NULL && $descricao != null){ mysql_query("UPDATE eleicao_ano SET descricao='$descricao' WHERE id_eleicao_ano = '$idelei'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO eleicao_ano (data, descricao, id_coleta) values ('$data', '$descricao', '$id_coleta')");		
		}
		
	}
	
	
	function eleicao_tipo_votavel($tipo_votavel){

		$result = mysql_query("SELECT * FROM eleicao_tipo_votavel WHERE tipo_votavel = '$tipo_votavel'");
		
		if($result == null){
			mysql_query("INSERT INTO eleicao_tipo_votavel (tipo_votavel) values ('$tipo_votavel')");		
		}
				
	}

	
	function eleicao_voto_municipio( $id_eleicao_ano, $turno, $id_estado, $id_cidade, $id_cargo, $aptos, $aptos_totalizados, $secoes, $secoes_agregadas, $secoes_totalizadas, $comparecimentos, $abstencoes, $votos_nominais, $votos_brancos, $votos_nulos, $votos_legenda, $votos_validos, $votos_anulados, $impugnacoes, $recursos, $data_ultima_totalizacao, $hora_ultima_totalizacao, $id_coleta){

		$result = mysql_query("SELECT * FROM eleicao_voto_municipio WHERE turno = '$turno AND 'id_eleicao_ano = '$id_eleicao_ano' AND id_estado = '$id_estado' AND id_cidade = '$id_cidade' AND id_cargo = '$id_cargo'");
		$k = 0;
		$row = null;
			
		if($result != null){	
			$row = mysql_fetch_assoc($result);
			$k = -1;
		}
		
		if($k == -1){
			$idelei = $row['id_eleicao_voto_municipio'];
			if($row['aptos'] == NULL && $aptos != null){ mysql_query("UPDATE eleicao_voto_municipio SET aptos='$aptos' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['aptos_totalizados'] == NULL && $aptos_totalizados != null){ mysql_query("UPDATE eleicao_voto_municipio SET aptos_totalizados='$aptos_totalizados' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['secoes'] == NULL && $secoes != null){ mysql_query("UPDATE eleicao_voto_municipio SET secoes='$secoes' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['secoes_agregadas'] == NULL && $secoes_agregadas != null){ mysql_query("UPDATE eleicao_voto_municipio SET secoes_agregadas='$secoes_agregadas' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['secoes_totalizadas'] == NULL && $secoes_totalizadas != null){ mysql_query("UPDATE eleicao_voto_municipio SET secoes_totalizadas='$secoes_totalizadas' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['comparecimentos'] == NULL && $comparecimentos != null){ mysql_query("UPDATE eleicao_voto_municipio SET comparecimentos='$comparecimentos' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['abstencoes'] == NULL && $abstencoes != null){ mysql_query("UPDATE eleicao_voto_municipio SET abstencoes='$abstencoes' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['votos_nominais'] == NULL && $votos_nominais != null){ mysql_query("UPDATE eleicao_voto_municipio SET votos_nominais='$votos_nominais' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['votos_brancos'] == NULL && $votos_brancos != null){ mysql_query("UPDATE eleicao_voto_municipio SET votos_brancos='$votos_brancos' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['votos_nulos'] == NULL && $votos_nulos != null){ mysql_query("UPDATE eleicao_voto_municipio SET votos_nulos='$votos_nulos' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['votos_legenda'] == NULL && $votos_legenda != null){ mysql_query("UPDATE eleicao_voto_municipio SET votos_legenda='$votos_legenda' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['votos_validos'] == NULL && $votos_validos != null){ mysql_query("UPDATE eleicao_voto_municipio SET votos_validos='$votos_validos' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['votos_anulados'] == NULL && $votos_anulados != null){ mysql_query("UPDATE eleicao_voto_municipio SET votos_anulados='$votos_anulados' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['impugnacoes'] == NULL && $impugnacoes != null){ mysql_query("UPDATE eleicao_voto_municipio SET impugnacoes='$impugnacoes' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['recursos'] == NULL && $recursos != null){ mysql_query("UPDATE eleicao_voto_municipio SET recursos='$recursos' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['data_ultima_totalizacao'] == NULL && $data_ultima_totalizacao != null){ mysql_query("UPDATE eleicao_voto_municipio SET data_ultima_totalizacao='$data_ultima_totalizacao' WHERE id_eleicao_voto_municipio = '$idelei'");}
			if($row['hora_ultima_totalizacao'] == NULL && $hora_ultima_totalizacao != null){ mysql_query("UPDATE eleicao_voto_municipio SET hora_ultima_totalizacao='$hora_ultima_totalizacao' WHERE id_eleicao_voto_municipio = '$idelei'");}
		
		}	
		
		if($k == 0){
			mysql_query("INSERT INTO eleicao_voto_municipio ( id_eleicao_ano, turno, id_estado, id_cidade, id_cargo, aptos, aptos_totalizados, secoes, secoes_agregadas, secoes_totalizadas, comparecimentos, abstencoes, votos_nominais, votos_brancos, votos_nulos, votos_legenda, votos_validos, votos_anulados, impugnacoes, recursos, data_ultima_totalizacao, hora_ultima_totalizacao, id_coleta) values ('$id_eleicao_ano', '$turno', '$id_estado', '$id_cidade', '$id_cargo', '$aptos', '$aptos_totalizados', '$secoes', '$secoes_agregadas', '$secoes_totalizadas', '$comparecimentos', '$abstencoes', '$votos_nominais', '$votos_brancos', '$votos_nulos', '$votos_legenda', '$votos_validos', '$votos_anulados', '$impugnacoes', '$recursos', '$data_ultima_totalizacao', '$hora_ultima_totalizacao', '$id_coleta')");		
		}
		
	}
	
 
	function eleicao_voto_politico($id_politico, $id_eleicao_ano, $turno, $id_estado, $id_cidade, $quantidade, $id_eleicao_tipo_votavel, $data_ultima_totalizacao, $hora_ultima_totalizacao, $id_coleta){

		$result = mysql_query("SELECT * FROM eleicao_voto_politico WHERE id_politico = '$id_politico' AND id_cidade = '$id_cidade'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['turno'] == $turno){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idelei = $row['id_eleicao_voto_politico'];
			if(($row['data_ultima_totalizacao'] == NULL && $data_ultima_totalizacao != null) || ($row['data_ultima_totalizacao'] == 0 && $data_ultima_totalizacao != null)){ mysql_query("UPDATE eleicao_voto_politico SET data_ultima_totalizacao= '$data_ultima_totalizacao' WHERE id_eleicao_voto_politico = '$idelei'");}
			if(($row['hora_ultima_totalizacao'] == NULL && $hora_ultima_totalizacao != null) || ($row['hora_ultima_totalizacao'] == 0 && $hora_ultima_totalizacao != null)){ mysql_query("UPDATE eleicao_voto_politico SET hora_ultima_totalizacao= '$hora_ultima_totalizacao' WHERE id_eleicao_voto_politico = '$idelei'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO eleicao_voto_politico (id_politico, id_eleicao_ano, turno, id_estado, id_cidade, quantidade, id_eleicao_tipo_votavel, data_ultima_totalizacao, hora_ultima_totalizacao, id_coleta) values ('$id_politico', '$id_eleicao_ano', '$turno', '$id_estado', '$id_cidade', '$quantidade', '$id_eleicao_tipo_votavel', '$data_ultima_totalizacao', '$hora_ultima_totalizacao', '$id_coleta')");		
		}
		
	}
	
	
	function email_partido($partido, $estado, $cidade, $email, $pagina){

		$result = mysql_query("SELECT * FROM email_partido WHERE partido = '$partido' AND cidade = '$cidade'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['pagina'] == $pagina){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idemail = $row['id_email_partido'];
			if($row['estado'] == NULL && $estado != null){ mysql_query("UPDATE email_partido SET estado='$estado' WHERE id_email_partido = '$idemail'");}
			if(($row['email'] == NULL && $email != null) || $row['email'] != $email){ mysql_query("UPDATE email_partido SET email='$email' WHERE id_email_partido = '$idemail'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO email_partido (partido, estado, cidade, email, pagina) values ('$partido', '$estado', '$cidade', '$email', '$pagina')");		
		}
		
	}
	
	
	function endereco_parlamentar($tipo, $rua, $bairro, $cidade, $estado, $CEP, $CNPJ, $telefone, $disque, $site){

		$result = mysql_query("SELECT * FROM endereco_parlamentar WHERE tipo = '$tipo'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['CEP'] == $CEP){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idend = $row['id_endereco_parlamentar'];
			if($row['disque'] == NULL && $disque != null){ mysql_query("UPDATE endereco_parlamentar SET disque='$disque' WHERE id_endereco_parlamentar = '$idend'");}
			if(($row['telefone'] == NULL && $telefone != null) || $row['telefone'] != $telefone  ){ mysql_query("UPDATE endereco_parlamentar SET telefone='$telefone' WHERE id_endereco_parlamentar = '$idend'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO endereco_parlamentar (tipo, rua, bairro, cidade, estado, CEP, CNPJ, telefone, disque, site) values ('$tipo', '$rua', '$bairro', '$cidade', '$estado', '$CEP', '$CNPJ', '$telefone', '$disque', '$site')");		
		}
		
	}
	
		
	function endereco_parlamentar_politico($id_endereco_parlamentar, $id_politico, $anexo, $ala, $gabinete, $email, $telefone, $fax){

		$result = mysql_query("SELECT * FROM endereco_parlamentar_politico WHERE id_endereco_parlamentar = '$id_endereco_parlamentar' AND id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			$row = mysql_fetch_assoc($result);		
			$k = -1;
		}
		
		if($k == -1){
			$idendpoli = $row['id_endereco_parlamentar_politico'];
			if(($row['anexo'] == NULL && $anexo != null) || $row['anexo'] != $anexo){ mysql_query("UPDATE endereco_parlamentar_politico SET anexo='$anexo' WHERE id_endereco_parlamentar_politico = '$idendpoli'");}
			if(($row['ala'] == NULL && $ala != null) || $row['ala'] != $ala){ mysql_query("UPDATE endereco_parlamentar_politico SET ala='$ala' WHERE id_endereco_parlamentar_politico = '$idendpoli'");}
			if(($row['gabinete'] == NULL && $gabinete != null) || $row['gabinete'] != $gabinete){ mysql_query("UPDATE endereco_parlamentar_politico SET gabinete='$gabinete' WHERE id_endereco_parlamentar_politico = '$idendpoli'");}
			if(($row['email'] == NULL && $email != null) || $row['email'] != $email){ mysql_query("UPDATE endereco_parlamentar_politico SET email='$email' WHERE id_endereco_parlamentar_politico = '$idendpoli'");}
			if(($row['telefone'] == NULL && $telefone != null) || $row['telefone'] != $telefone){ mysql_query("UPDATE endereco_parlamentar_politico SET telefone='$telefone' WHERE id_endereco_parlamentar_politico = '$idendpoli'");}
			if(($row['fax'] == NULL && $fax != null) || $row['fax'] != $fax){ mysql_query("UPDATE endereco_parlamentar_politico SET fax='$fax' WHERE id_endereco_parlamentar_politico = '$idendpolo'");}
			
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO endereco_parlamentar_politico (id_endereco_parlamentar, id_politico, anexo, ala, gabinete, email, telefone, fax) values ('$id_endereco_parlamentar', '$id_politico', '$anexo', '$ala', '$gabinete', '$email', '$telefone', '$fax')");		
		}
		
	}
	
	
	function fonte($nome_fonte, $url_fonte){

		$result = mysql_query("SELECT * FROM fonte");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['url_fonte'] == $url_fonte){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idfonte = $row['id_fonte'];
			if($row['nome_fonte'] == NULL && $nome_fonte != null){ mysql_query("UPDATE fonte SET nome_fonte='$nome_fonte' WHERE id_fonte = '$idfonte'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO fonte (nome_fonte, url_fonte) values ('$nome_fonte', '$url_fonte')");		
		}
		
	}
	
	
	function lideranca($id_politico, $descricao, $tipo, $data_inicio, $data_fim){

		$result = mysql_query("SELECT * FROM lideranca WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['tipo'] == $tipo && $row['data_inicio'] == $data_inicio){
					$k = -1;
					break;
				}
			}
		}
		if($k == -1){
			$idlider = $row['id_lideranca'];
			if($row['descricao'] == NULL && $descricao != null){ mysql_query("UPDATE lideranca SET descricao='$descricao' WHERE id_lideranca = '$idlider'");}
			if($row['data_fim'] == NULL && $data_fim != null){ mysql_query("UPDATE lideranca SET data_fim='$data_fim' WHERE id_lideranca = '$idlider'");}
			
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO lideranca (id_politico, descricao, tipo, data_inicio, data_fim) values ('$id_politico', '$descricao', '$tipo', '$data_inicio', '$data_fim')");		
		}
		
	}
	
	
	function mandato($id_politico, $cargo, $data_inicio, $data_fim){

		$result = mysql_query("SELECT * FROM mandato WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['cargo'] == $cargo && $row['data_inicio'] == $data_inicio){
					$k = -1;
					break;
				}
			}
		}
		if($k == -1){
			$idmand = $row['id_mandato'];
			if($row['data_fim'] == NULL && $data_fim != null){ mysql_query("UPDATE mandato SET data_fim='$data_fim' WHERE id_mandato = '$idmand'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO mandato (id_politico, cargo, data_inicio, data_fim) values ('$id_politico', '$cargo', '$data_inicio', '$data_fim')");		
		}
		
	}
		
	
	function missao($id_politico, $descricao, $tipo, $data_inicio, $data_fim, $documento){

		$result = mysql_query("SELECT * FROM missao WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['tipo'] == $tipo && $row['data_inicio'] == $data_inicio){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idmis = $row['id_missao'];
			if($row['descricao'] == NULL && $descricao != null){ mysql_query("UPDATE missao SET descricao='$descricao' WHERE id_missao = '$idmis'");}
			if($row['data_fim'] == NULL && $data_fim != null){ mysql_query("UPDATE missao SET data_fim='$data_fim' WHERE id_missao = '$idmis'");}
			if($row['documento'] == NULL && $documento != null){ mysql_query("UPDATE missao SET documento='$documento' WHERE id_missao = '$idmis'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO missao (id_politico, descricao, tipo, data_inicio, data_fim, documento) values ('$id_politico', '$descricao', '$tipo', '$data_inicio', '$data_fim', '$documento')");		
		}
		
	}
	
	
	function politico($nome_civil, $nome_parlamentar, $nome_pai, $nome_mae, $foto, $sexo, $cor, $data_nascimento, $estado_civil, $ocupacao, $grau_instrucao, $nacionalidade, $cidade_nascimento, $estado_nascimento, $cidade_eleitoral, $estado_eleitoral, $site, $email, $cargo, $cargo_uf, $partido, $situacao, $atuacao, $chaveTSE, $chaveFichaLimpa, $pagina_senado){

		$result = null;
		$result = existePoli($nome_civil, $data_nascimento, $cidade_nascimento);
		$row = null;
		
		if($result != null){
			if($row['nome_parlamentar'] == NULL && $nome_parlamentar != null){ mysql_query("UPDATE politico SET nome_parlamentar='$nome_parlamentar' WHERE id_politico = '$result'");}
			if($row['nome_pai'] == NULL && $nome_pai != null){ mysql_query("UPDATE politico SET nome_pai='$nome_pai' WHERE id_politico = '$result'");}
			if($row['nome_mae'] == NULL && $nome_mae != null){ mysql_query("UPDATE politico SET nome_mae='$nome_mae' WHERE id_politico = '$result'");}
			if($row['foto'] == NULL && $foto != null){ mysql_query("UPDATE politico SET foto='$foto' WHERE id_politico = '$result'");}
			if($row['sexo'] == NULL && $sexo != null){ mysql_query("UPDATE politico SET sexo='$sexo' WHERE id_politico = '$result'");}
			if($row['cor'] == NULL && $cor != null){ mysql_query("UPDATE politico SET cor='$cor' WHERE id_politico = '$result'");}
			if($row['estado_civil'] == NULL && $estado_civil != null){ mysql_query("UPDATE politico SET estado_civil='$estado_civil' WHERE id_politico = '$result'");}
			if($row['ocupacao'] == NULL && $ocupacao != null){ mysql_query("UPDATE politico SET ocupacao='$ocupacao' WHERE id_politico = '$result'");}
			if($row['grau_instrucao'] == NULL && $grau_instrucao != null){ mysql_query("UPDATE politico SET grau_instrucao='$grau_instrucao' WHERE id_politico = '$result'");}
			if($row['nacionalidade'] == NULL && $nacionalidade != null){ mysql_query("UPDATE politico SET nacionalidade='$nacionalidade' WHERE id_politico = '$result'");}
			if($row['cidade_nascimento'] == NULL && $cidade_nascimento != null){ mysql_query("UPDATE politico SET cidade_nascimento='$cidade_nascimento' WHERE id_politico = '$result'");}
			if($row['estado_nascimento'] == NULL && $estado_nascimento != null){ mysql_query("UPDATE politico SET estado_nascimento='$estado_nascimento' WHERE id_politico = '$result'");}
			if($row['cidade_eleitoral'] == NULL && $cidade_eleitoral != null){ mysql_query("UPDATE politico SET cidade_eleitoral='$cidade_eleitoral' WHERE id_politico = '$result'");}
			if($row['estado_eleitoral'] == NULL && $estado_eleitoral != null){ mysql_query("UPDATE politico SET estado_eleitoral='$estado_eleitoral' WHERE id_politico = '$result'");}
			if($row['site'] == NULL && $site != null){ mysql_query("UPDATE politico SET site='$site' WHERE id_politico = '$result'");}
			if($row['email'] == NULL && $email != null){ mysql_query("UPDATE politico SET email='$email' WHERE id_politico = '$result'");}
			if($row['cargo'] == NULL && $cargo != null){ mysql_query("UPDATE politico SET cargo='$cargo' WHERE id_politico = '$result'");}
			if($row['cargo_uf'] == NULL && $cargo_uf != null){ mysql_query("UPDATE politico SET cargo_uf='$cargo_uf' WHERE id_politico = '$result'");}
			if($row['partido'] == NULL && $partido != null){ mysql_query("UPDATE politico SET partido='$partido' WHERE id_politico = '$result'");}
			if($row['situacao'] == NULL && $situacao != null){ mysql_query("UPDATE politico SET situacao='$situacao' WHERE id_politico = '$result'");}
			if($row['atuacao'] == NULL && $atuacao != null){ mysql_query("UPDATE politico SET atuacao='$atuacao' WHERE id_politico = '$result'");}
			if($row['chaveTSE'] == NULL && $chaveTSE != null){ mysql_query("UPDATE politico SET chaveTSE='$chaveTSE' WHERE id_politico = '$result'");}
			if($row['chaveFichaLimpa'] == NULL && $chaveFichaLimpa != null){ mysql_query("UPDATE politico SET chaveFichaLimpa='$chaveFichaLimpa' WHERE id_politico = '$result'");}
			if($row['pagina_senado'] == NULL && $pagina_senado != null){ mysql_query("UPDATE politico SET pagina_senado='$pagina_senado' WHERE id_politico = '$result'");}
			
			
			}

		if($result == null){
			mysql_query("INSERT INTO politico (nome_civil, nome_parlamentar, nome_pai, nome_mae, foto, sexo, cor, data_nascimento, estado_civil, ocupacao, grau_instrucao, nacionalidade, cidade_nascimento, estado_nascimento, cidade_eleitoral, estado_eleitoral, site, email, cargo, cargo_uf, partido, situacao, atuacao, chaveTSE, chaveFichaLimpa, pagina_senado) values (('$nome_civil', '$nome_parlamentar', '$nome_pai', '$nome_mae', '$foto', '$sexo', '$cor', '$data_nascimento', '$estado_civil', '$ocupacao', '$grau_instrucao', '$nacionalidade', '$cidade_nascimento', '$estado_nascimento', '$cidade_eleitoral', '$estado_eleitoral', '$site', '$email', '$cargo', '$cargo_uf', '$partido', '$situacao', '$atuacao', '$chaveTSE', '$chaveFichaLimpa', '$pagina_senado')");		
		}
	}


	function pronunciamento($id_politico, $tipo, $data, $casa, $partido, $uf, $resumo, $pagina_senado, $numero_pagina){

		$result = mysql_query("SELECT * FROM pronunciamento WHERE id_politico = '$id_politico'");
		$k = 0;
		$row = null;
		
		if($result != null){
			while($row = mysql_fetch_assoc($result)){
				if($row['data'] == $data && $row['tipo'] == $tipo){
					$k = -1;
					break;
				}
			}
		}
		if($k == -1){
				
				$idpronun = $row['id_pronunciamento'];
				if($row['casa'] == NULL && $casa != null){ mysql_query("UPDATE pronunciamento SET casa='$casa' WHERE id_pronunciamento = '$idpronun'");}
				if($row['partido'] == NULL && $partido != null){ mysql_query("UPDATE pronunciamento SET partido='$partido' WHERE id_pronunciamento = '$idpronun'");}
				if($row['uf'] == NULL && $uf != null){ mysql_query("UPDATE pronunciamento SET uf='$uf' WHERE id_pronunciamento = '$idpronun'");}
				if($row['resumo'] == NULL && $resumo != null){ mysql_query("UPDATE pronunciamento SET resumo='$resumo' WHERE id_pronunciamento = '$idpronun'");}								
				if($row['pagina_senado'] == NULL && $pagina_senado != null){ mysql_query("UPDATE pronunciamento SET pagina_senado='$pagina_senado' WHERE id_pronunciamento = '$idpronun'");}
				if($row['numero_pagina'] == NULL && $numero_pagina != null){ mysql_query("UPDATE pronunciamento SET numero_pagina='$numero_pagina' WHERE id_pronunciamento = '$idpronun'");}

		}
			if($k == 0){
				mysql_query("INSERT INTO pronunciamento (id_politico, tipo, data, casa, partido, uf, resumo, pagina_senado, numero_pagina) values ('$id_politico', '$tipo', '$data', '$casa', '$partido', '$uf', '$resumo', '$pagina_senado', '$numero_pagina')");
			}
	
	}
	
	
	function proposicao($id_politico, $titulo, $data, $ano, $casa, $numero, $tipo, $descricao_tipo, $ementa, $pagina_senado, $numero_pagina, $id_coleta){

		$result = mysql_query("SELECT * FROM proposicao WHERE id_coleta = '$id_coleta'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['titulo'] == $titulo && $row['casa'] == $casa){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idpropo = $row['id_proposicao'];
			
			if($row['id_politico'] == NULL && $id_politico != null){ mysql_query("UPDATE proposicao SET id_politico='$id_politico' WHERE id_proposicao = '$idpropo'");}
			if($row['data'] == NULL && $data != null){ mysql_query("UPDATE proposicao SET data='$data' WHERE id_proposicao = '$idpropo'");}
			if(($row['ano'] == NULL || $row['ano'] == 0) && $ano != null){ mysql_query("UPDATE proposicao SET ano='$ano' WHERE id_proposicao = '$idpropo'");}
			if($row['numero'] == NULL && $numero != null){ mysql_query("UPDATE proposicao SET numero='$numero' WHERE id_proposicao = '$idpropo'");}
			if($row['tipo'] == NULL && $tipo != null){ mysql_query("UPDATE proposicao SET tipo='$tipo' WHERE id_proposicao = '$idpropo'");}
			if($row['descricao_tipo'] == NULL && $descricao_tipo != null){ mysql_query("UPDATE proposicao SET descricao_tipo='$descricao_tipo' WHERE id_proposicao = '$idpropo'");}
			if($row['ementa'] == NULL && $ementa != null){ mysql_query("UPDATE proposicao SET ementa='$ementa' WHERE id_proposicao = '$idpropo'");}
			if($row['pagina_senado'] == NULL && $pagina_senado != null){ mysql_query("UPDATE proposicao SET pagina_senado='$pagina_senado' WHERE id_proposicao = '$idpropo'");}
			if($row['numero_pagina'] == NULL && $numero_pagina != null){ mysql_query("UPDATE proposicao SET numero_pagina='$numero_pagina' WHERE id_proposicao = '$idpropo'");}			
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO proposicao(id_politico, titulo, data, ano, casa, numero, tipo, descricao_tipo, ementa, pagina_senado, numero_pagina, id_coleta) values ('$id_politico', '$titulo', '$data', '$ano', '$casa', '$numero', '$tipo', '$descricao_tipo', '$ementa', '$pagina_senado', '$numero_pagina', '$id_coleta')");		
		}
		
	}
	
	
	function votacao($id_proposicao, $numero, $data, $descricao, $resultado, $id_coleta){

		$result = mysql_query("SELECT * FROM votacao WHERE id_proposicao = '$id_proposicao' AND id_coleta = '$id_coleta'");
		$k = 0;
		$row = null;
		
		if($result != null){	
			while($row = mysql_fetch_assoc($result)){
				if($row['numero'] == $numero && $row['descricao'] == $descricao){
					$k = -1;
					break;
				}
			}
		}
		
		if($k == -1){
			$idvota = $row['id_votacao'];
			if($row['data'] == NULL && $data != null){ mysql_query("UPDATE votacao SET data='$data' WHERE id_votacao = '$idvota'");}
			if($row['resultado'] == NULL && $resultado != null){ mysql_query("UPDATE votacao SET resultado='$resultado' WHERE id_votacao = '$idvota'");}
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO votacao (id_proposicao, numero, data, descricao, resultado, id_coleta) values ('$id_proposicao', '$numero', '$data', '$descricao', '$resultado', '$id_coleta')");		
		}
		
	}	

	
	function voto($id_votacao, $id_politico, $id_voto_tipo, $id_coleta){

		$result = mysql_query("SELECT * FROM voto WHERE id_politico = '$id_politico' AND id_coleta = '$id_coleta'");
		
		if($result == null){
				
			mysql_query("INSERT INTO voto (id_votacao, id_politico, id_voto_tipo, id_coleta) values ('$id_votacao', '$id_politico', '$id_voto_tipo', '$id_coleta')");		
		
		}
		
	}
	
	
	function voto_tipo($id_voto_tipo, $descricao_voto_tipo, $artigo){

		$result = mysql_query("SELECT * FROM voto_tipo WHERE id_voto_tipo = '$id_voto_tipo'");
		$k = 0;
		$row = null;
		
		if($result != null){
			$row = mysql_fetch_assoc($result);	
			$k = -1;
		}
		
		if($k == -1){
		
			if($row['descricao_voto_tipo'] == NULL && $descricao_voto_tipo != null){ mysql_query("UPDATE voto_tipo SET descricao_voto_tipo='$descricao_voto_tipo' WHERE id_voto_tipo = '$id_voto_tipo'");}
			if($row['artigo'] == NULL && $artigo != null){ mysql_query("UPDATE voto_tipo SET artigo='$artigo' WHERE id_voto_tipo = '$id_voto_tipo'");}
		
			}	
		
		if($k == 0){
			mysql_query("INSERT INTO voto_tipo (id_voto_tipo, descricao_voto_tipo, artigo) values ('$id_voto_tipo', '$descricao_voto_tipo', '$artigo'))");		
		}
		
	}
		


?>



