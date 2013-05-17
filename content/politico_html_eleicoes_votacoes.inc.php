<?php
	$sql_eleicao_voto_cargo = mysql_query("SELECT cargo, cargo_uf FROM eleicao WHERE id_politico = '$recurso'");
	while($row_eleicao_voto_cargo = mysql_fetch_array($sql_eleicao_voto_cargo)){
		$eleicao_cargo = $row_eleicao_voto_cargo[0];
		$eleicao_cargo_uf = $row_eleicao_voto_cargo[1];
	}
	
	if ($eleicao_cargo_uf == 'BR')
		$eleicao_cargo_uf = 'AC';

	if ($eleicao_cargo == 'Presidente')
	{
		echo
		"<form name='form' action='' method='post' 	style = 'float: left;'>
			<input type='hidden' name='include' value='Eleições - Votações' />
			Estado: <select name = 'estado'>
					<option value='' />
					<option value='AC'> Acre </option>
					<option value='AL'> Alagoas </option>
					<option value='AM'> Amazonas </option>
					<option value='AP'> Amapá </option>
					<option value='BA'> Bahia </option>
					<option value='CE'> Ceará </option>
					<option value='DF'> Distrito Federal </option>
					<option value='ES'> Espírito Santo </option>
					<option value='GO'> Goiás </option>
					<option value='MA'> Maranhão </option>
					<option value='MG'> Minas Gerais </option>
					<option value='MS'> Mato Grosso do Sul </option>
					<option value='MT'> Mato Grosso </option>
					<option value='PA'> Pará </option>
					<option value='PB'> Paraíba </option>
					<option value='PE'> Pernambuco </option>
					<option value='PI'> Piauí </option>
					<option value='PR'> Paraná </option>
					<option value='RJ'> Rio de Janeiro </option>
					<option value='RN'> Rio Grande do Norte </option>
					<option value='RO'> Rondônia </option>
					<option value='RR'> Roraima </option>
					<option value='RS'> Rio Grande do Sul </option>
					<option value='SC'> Santa Catarina </option>
					<option value='SE'> Sergipe </option>
					<option value='SP'> São Paulo </option>
					<option value='TO'> Tocantins </option>		
					<option value='VT'> Votos em Trânsito </option>	
					<option value='ZZ'> Exterior </option>	
			</select>
			<input type='submit' value = 'OK' />
		</form>";	
	}

	if (isset ($_POST['estado']))
		$eleicao_cargo_uf = $_POST['estado'];

	$sql_eleicao_voto_politico = mysql_query("SELECT c.nome_cidade, e.quantidade, c.id_cidade, e.id_coleta FROM cidade c JOIN eleicao_voto_politico e ON c.id_cidade = e.id_cidade WHERE e.id_politico = '$recurso' AND e.id_estado = '$eleicao_cargo_uf' ORDER BY c.nome_cidade");
	$cont_eleicao_voto = mysql_num_rows($sql_eleicao_voto_politico);
	if ($cont_eleicao_voto > 0){
					
		echo "<div class='divisao'>Eleições - Votações</div>";
		echo "<table border=1 class='tabelas'>
		<tr>
			<td class='topo_tabela'>Cidade</td>
			<td class='topo_tabela'>Votos Válidos</td>
			<td class='topo_tabela'>Votos do Candidato - 1o Turno</td>	
			<td class='topo_tabela'>% Votos Válidos</td>
		</tr>";	

		$soma_eleicao_voto_politico = 0;
		$soma_eleicao_voto_municipio = 0;

		while($row_eleicao_voto_politico = mysql_fetch_array($sql_eleicao_voto_politico)){
			$cidade = $row_eleicao_voto_politico[0];
			$votos_candidato = $row_eleicao_voto_politico[1];
			$id_cidade = $row_eleicao_voto_politico[2];
			$id_coleta1 = $row_eleicao_voto_politico[3];
			
			$sql_eleicao_voto_municipio = mysql_query("SELECT e.votos_validos, e.id_coleta FROM eleicao_voto_municipio e JOIN cargo c ON c.id_cargo = e.id_cargo WHERE c.nome_cargo LIKE '$eleicao_cargo' AND e.id_cidade = '$id_cidade'");
			while($row_eleicao_voto_municipio = mysql_fetch_array($sql_eleicao_voto_municipio)){
				$votos_validos = $row_eleicao_voto_municipio[0];
				$id_coleta2 = $row_eleicao_voto_municipio[1];
			}
			
			$soma_eleicao_voto_politico += $votos_candidato;
			$soma_eleicao_voto_municipio += $votos_validos;
			
			$percentagem_votos = $votos_candidato*100/$votos_validos;
			//$percentagem_votos2 = $votos_candidato*100/$soma_eleicao_voto_politico;
			$percentagem_votos = number_format($percentagem_votos,3);
			//$percentagem_votos2 = number_format($percentagem_votos2,3);
				
			echo 
				"<tr>
					<td>".$cidade."</td>
					<td>".$votos_validos."</td>						
					<td>".$votos_candidato."</td>
					<td>".$percentagem_votos."%</td>
				</tr>";
		}

		$percentagem_soma_eleicao_voto_politico = $soma_eleicao_voto_politico*100/$soma_eleicao_voto_municipio;		
		$percentagem_soma_eleicao_voto_politico = number_format($percentagem_soma_eleicao_voto_politico,3);
		echo "
			<tr>
				<td colspan = '0' class='topo_tabela'>TOTAL</td>
				<td class='topo_tabela'>".$soma_eleicao_voto_municipio."</td>
				<td class='topo_tabela'>".$soma_eleicao_voto_politico."</td>
				<td class='topo_tabela'>".$percentagem_soma_eleicao_voto_politico."%</td>							
			</tr>";
		echo "</table>";
		
		escreve_coleta_html($id_coleta1);
		escreve_coleta_html($id_coleta2);
		
		echo "<br />";
	}
	else
		echo "Dados não encontrados."
?>