<?php
    if($sparql2a != null) {
    echo "<div class='divisao'>Declarações de Bens 2010</div>";
    $conta_declaracao = 1;
    echo "<table border=1 class='tabelas'>
	<tr>
		<td class='topo_tabela'>N</sup></td>
		<td class='topo_tabela'>Descrição</td>
		<td class='topo_tabela'>Tipo</td>	
		<td class='topo_tabela'>Valor(R$)</td>
	</tr>";

    $soma = 0;
    foreach ($sparql2a as $row) {
        $valor = number_format($row['valor'], 2, ',' , '.') ;
        echo "
		<tr>
			<td>$conta_declaracao</td>
			<td>" . $row['descricao'] . "</td>
			<td>" . $row['tipo'] . "</td>
			<td>" . $valor . "</td>
		</tr>";
        $conta_declaracao++;
        $soma += $row['valor'];
    }
        $soma = number_format($soma, 2, ',' , '.') ;
    echo "
		 <tr>
			<td colspan = '3' class='topo_tabela'>TOTAL</td>
			<td class='topo_tabela'>" . $soma . "</td>
		 </tr>";
    echo "</table>";
    }
    if($sparql2b != null){
        echo "<div class='divisao'>Declarações de Bens 2014</div>";
        $conta_declaracao = 1;
        echo "<table border=1 class='tabelas'>
	<tr>
		<td class='topo_tabela'>N</sup></td>
		<td class='topo_tabela'>Descrição</td>
		<td class='topo_tabela'>Tipo</td>
		<td class='topo_tabela'>Valor(R$)</td>
	</tr>";
        //
        $soma = 0;
        foreach ($sparql2b as $row){
            $valor = number_format($row['valor'], 2, ',' , '.') ;
            if(isset($row['tipo'])) $tipo =$row['tipo'] ;
            else $tipo = "";
            echo "
		<tr>
			<td>$conta_declaracao</td>
			<td>".$row['descricao']."</td>
			<td>".$tipo."</td>
			<td>".$valor."</td>
		</tr>";
            $conta_declaracao++;
            $soma += $row['valor'];
        }
        $soma = number_format($soma, 2, ',' , '.') ;
        echo "
		 <tr>
			<td colspan = '3' class='topo_tabela'>TOTAL</td>
			<td class='topo_tabela'>".$soma."</td>
		 </tr>";
        echo "</table>";
    }

?>