<?php					
	echo "<div class='divisao'>Proposições</div>";	
	$conta_proposicao = 1;
	$input = '';
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Título</td>
		<td>Data</td>
		<td>Casa</td>	
		<td>Número</td>
		<td>Tipo</td>	
		<td>Ementa</td>						
	</tr>";
	while($row = mysql_fetch_array($sql11)){
		$data = date('d/m/Y', strtotime($row['data']));
		if ($data == '01/01/1970')
			$data = '-';
	
		echo "
		<tr>
			<td>$conta_proposicao</td>
			<td>".$row['titulo']."</td>
			<td>".$data."</td>
			<td>".$row['casa']."</td>
			<td>".$row['numero']."</td>
			<td>".$row['tipo']." - ".$row['descricao_tipo']."</td>
			<td>".$row['ementa']."</td>
		</tr>";
		$conta_proposicao++;
		$input = $input.' '.$row['ementa']; 
	}
	echo "</table>";
	echo "<br />";
	keywords($input,3,5,'azul');
?>