<?php			
	echo "<div class='divisao'>Eleições</div>";
	while($row = mysql_fetch_array($sql3)){
		echo "<b>Ano: </b>".$row['ano']."<br />";
		echo "<b>Nome para Urna: </b>".$row['nome_urna']."<br />";
		echo "<b>Número do Candidato: </b>".$row['numero_candidato']."<br />";
		echo "<b>Partido: </b>".$row['partido']."<br />";
		echo "<b>Cargo: </b>".$row['cargo']."<br />";
		echo "<b>Estado: </b>".$row['cargo_uf']."<br />";
		if ($row['resultado'] <> '' AND $row['resultado'] <> NULL)					
			echo "<b>Resultado:</b> ".$row['resultado']."<br />";					
		if ($row['nome_coligacao'] <> '' AND $row['nome_coligacao'] <> NULL)					
			echo "<b>Nome da Coligação:</b> ".$row['nome_coligacao']."<br />";
		if ($row['partidos_coligacao'] <> '' AND $row['partidos_coligacao'] <> NULL)					
			echo "<b>Partidos da Coligação:</b> ".$row['partidos_coligacao']."<br />";
		if ($row['prestacao_contas'] <> '' AND $row['prestacao_contas'] <> NULL)					
			echo "<b>Julgamento da Prestação de Contas:</b> ".$row['prestacao_contas']."<br />";
		echo "<b>Situação da Candidatura: </b>".$row['situacao_candidatura']."<br />";
		echo "<b>Número do Protocolo: </b>".$row['numero_protocolo']."<br />";
		echo "<b>Número do Processo: </b>".$row['numero_processo']."<br />";
		echo "<b>CNPJ da Campanha: </b>".$row['cnpj_campanha']."<br />";
		echo "<br />";
	}							
?>