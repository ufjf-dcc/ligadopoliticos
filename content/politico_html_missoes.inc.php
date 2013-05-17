<?php	
	echo "<div class='divisao'>Missões</div>";					
	$conta_missao = 1;
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Descrição</td>
		<td>Casa</td>
		<td>Data Início</td>	
		<td>Data Fim</td>
		<td>Documento</td>							
	</tr>";
	while($row = mysql_fetch_array($sql10)){
		$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
		$data_fim = date('d/m/Y', strtotime($row['data_fim']));
		if ($data_fim == '01/01/1970')
			$data_fim = '-';
	
		echo "
		<tr>
			<td>$conta_missao</td>
			<td>".$row['descricao']."</td>
			<td>".$row['tipo']."</td>
			<td>".$data_inicio."</td>
			<td>".$data_fim."</td>
			<td>".$row['documento']."</td>
		</tr>";
		$conta_missao++;
	}
	echo "</table>";
	echo "<br />";
?>