<?php					
	echo "<div class='divisao'>Votações</div>";	
	$conta_votacao = 1;
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Título</td>
		<td>Número</td>
		<td>Data</td>
		<td>Ementa</td>	
		<td>Descrição</td>	
		<td>Voto</td>
		<td>Resultado</td>		
	</tr>";
	
	while($row_voto = mysql_fetch_array($sql_voto)){
		$id_votacao = $row_voto['id_votacao']; 
		$id_coleta1 = $row_voto['id_coleta'];
		
		$sql_votacao = mysql_query("SELECT * FROM votacao WHERE id_votacao = '$id_votacao'");
		while($row_votacao = mysql_fetch_array($sql_votacao)){
			$numero = $row_votacao['numero'];
			$descricao = $row_votacao['descricao'];
			$resultado = $row_votacao['resultado'];
			$data = date('d/m/Y', strtotime($row_votacao['data']));
			if ($data == '01/01/1970')
				$data = '-';
			$id_proposicao = $row_votacao['id_proposicao'];
			
			$sql_proposicao_voto = mysql_query("SELECT titulo,ementa,id_coleta FROM proposicao WHERE id_proposicao = '$id_proposicao'");
			while($row_proposicao_voto = mysql_fetch_array($sql_proposicao_voto)){
				$titulo = $row_proposicao_voto['titulo'];
				$ementa = $row_proposicao_voto['ementa'];
				$id_coleta2 = $row_proposicao_voto['id_coleta'];
			}
		
		}
		
		echo "
		<tr>
			<td>$conta_votacao</td>
			<td>".$titulo."</td>
			<td>".$numero."</td>
			<td>".$data."</td>
			<td>".$ementa."</td>
			<td>".$descricao."</td>
			<td>".$row_voto['id_voto_tipo']."</td>
			<td>".$resultado."</td>
		</tr>";
		$conta_votacao++;
		
	}
	echo "</table>";
	escreve_coleta_html($id_coleta1);
	echo "<br />";
?>