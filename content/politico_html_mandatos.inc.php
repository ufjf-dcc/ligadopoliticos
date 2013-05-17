<?php			
	echo "<div class='divisao'>Mandatos</div>";			
	$conta_mandato = 1;
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Cargo</td>
		<td>Data Início</td>	
		<td>Data Fim</td>					
	</tr>";
	
	while($row = mysql_fetch_array($sql9)){
		$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
		$data_fim = date('d/m/Y', strtotime($row['data_fim']));
		if ($data_fim == '01/01/1970')
			$data_fim = '-';
	
		echo "
		<tr>
			<td>$conta_mandato</td>
			<td>".$row['cargo']."</td>
			<td>".$data_inicio."</td>
			<td>".$data_fim."</td>
		</tr>";
		$conta_mandato++;
	}
	echo "</table>";
	echo "<br />";
?>