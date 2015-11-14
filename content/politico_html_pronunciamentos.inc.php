<?php				
	echo "<div class='divisao'>Pronunciamentos</div>";	
	$conta_pronunciamento = 1;
	$input = '';
	echo "<table border=1 class='tabelas'>
	<tr>
		<td>N<sup>o</sup></td>
		<td>Tipo</td>
		<td>Data</td>
		<td>Casa</td>	
		<td>Partido</td>
		<td>UF</td>	
		<td>Resumo</td>						
	</tr>";
	foreach ($sparql12 as $row){
		echo "
		<tr>
			<td>$conta_pronunciamento</td>
			<td>".$row['tipo']."</td>";
                        if(isset($row['data']))
			echo "<td>".$row['data']."</td>";
                        echo "
			<td>".$row['casa']."</td>
			<td>".$row['partido']."</td>
			<td>".$row['uf']."</td>
			<td>".$row['resumo']."</td>
		</tr>";
		$conta_pronunciamento++;
		$input = $input.' '.$row['resumo']; 
	}
	echo "</table>";
	echo "<br />";
	keywords($input,3,5,'azul');
?>