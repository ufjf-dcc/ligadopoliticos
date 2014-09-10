<?php					
	echo "<div class='divisao'>Lideranças</div>";	
	$conta_lideranca = 1;
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Descrição</td>
		<td>Casa</td>
		<td>Data Início</td>	
		<td>Data Fim</td>					
	</tr>";
	foreach ($sparql8 as $row){
		echo "
		<tr>
			<td>$conta_lideranca</td>
			<td>".$row['descricao']."</td>
			<td>".$row['tipo']."</td>
			<td>".$row['data_inicio']."</td>
			<td>".$row['data_fim']."</td>
		</tr>";
		$conta_lideranca++;
	}
	echo "</table>";
	echo "<br />";
?>