<?php					
	echo "<div class='divisao'>Declarações de Bens</div>";
	$conta_declaracao = 1;
	echo "<table border=1 class='tabelas'>
	<tr>
		<td class='topo_tabela'>N</sup></td>
		<td class='topo_tabela'>Descrição</td>
		<td class='topo_tabela'>Tipo</td>	
		<td class='topo_tabela'>Valor</td>					
	</tr>";
	
	$soma = 0;
	while($row = mysql_fetch_array($sql2)){
		echo "
		<tr>
			<td>$conta_declaracao</td>
			<td>".$row['descricao']."</td>
			<td>".$row['tipo']."</td>
			<td>".$row['valor']."</td>
		</tr>";
		$conta_declaracao++;
		$soma += $row['valor'];
	}
	echo "
		 <tr>
			<td colspan = '3' class='topo_tabela'>TOTAL</td>
			<td class='topo_tabela'>".$soma."</td>
		 </tr>";
	echo "</table>";		
?>