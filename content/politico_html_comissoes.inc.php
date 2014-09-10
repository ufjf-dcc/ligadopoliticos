<?php					
	echo "<div class='divisao'>Comissões</div>";	
	$conta_comissao = 1;
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Descrição</td>
		<td>Data Início</td>	
		<td>Data Fim</td>
		<td>Participação</td>					
	</tr>";
	foreach($sparql5 as $row){
		echo "
		<tr>
			<td>$conta_comissao</td>
			<td>".$row['descricao']."</td>
			<td>".$row['data_inicio']."</td>
			<td>".$row['data_fim']."</td>
			<td>".$row['participacao']."</td>
		</tr>";
		$conta_comissao++;
	}
	echo "</table>";
	echo "<br />";
?>