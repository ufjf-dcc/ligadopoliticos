<?php			
	echo "<div class='divisao'>Eleições</div>";
        foreach ($sparql3 as $row){
		echo "<b>Ano: </b>".$row['ano']."<br />";
		echo "<b>Nome para Urna: </b>".$row['nome_urna']."<br />";
		echo "<b>Número do Candidato: </b>".$row['numero_candidato']."<br />";
		echo "<b>Partido: </b>".$row['partido']."<br />";
		echo "<b>Cargo: </b>".$row['cargo']."<br />";
		if (isset($row['cargo_uf']))
                        echo "<b>Estado: </b>".$row['cargo_uf']."<br />";
		if (isset($row['resultado']))					
			echo "<b>Resultado:</b> ".$row['resultado']."<br />";					
		if (isset($row['nome_coligacao']))					
			echo "<b>Nome da Coligação:</b> ".$row['nome_coligacao']."<br />";
		if (isset($row['partidos_coligacao']))					
			echo "<b>Partidos da Coligação:</b> ".$row['partidos_coligacao']."<br />";
		echo "<b>Situação da Candidatura: </b>".$row['situacao_candidatura']."<br />";
		echo "<b>Número do Protocolo: </b>".$row['numero_protocolo']."<br />";
		echo "<b>Número do Processo: </b>".$row['numero_processo']."<br />";
		echo "<b>CNPJ da Campanha: </b>".$row['cnpj_campanha']."<br />";
		echo "<br />";
	}							
?>