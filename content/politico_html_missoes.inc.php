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
	foreach ($sparql10 as $row){
		echo "
		<tr>
			<td>$conta_missao</td>
			<td>".$row['descricao']."</td>
			<td>".$row['tipo']."</td>
			<td>".$row['data_inicio']."</td>
			<td>".$row['data_fim']."</td>
			<td>".$row['documento']."</td>
		</tr>";
		$conta_missao++;
	}
	echo "</table>";
	echo "<br />";
?>