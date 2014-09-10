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
	
	foreach ($sparql9 as $row){	
		echo "
		<tr>
			<td>$conta_mandato</td>
			<td>".$row['cargo']."</td>
			<td>".$row['data_inicio']."</td>
			<td>".$row['data_fim']."</td>
		</tr>";
		$conta_mandato++;
	}
	echo "</table>";
	echo "<br />";
?>