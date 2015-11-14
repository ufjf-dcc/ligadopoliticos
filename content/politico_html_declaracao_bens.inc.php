<?php
    
    if($sparql2a != null)
    {
        $anos = consultaSPARQL('select ?ano
                                where{
                                  <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:declarationOfAssets ?x.
                                  ?x timeline:atYear ?ano.} group by ?ano order by ?ano');
        foreach ($anos as $ano){
            echo "<div class='divisao'>Declarações de Bens ".$ano['ano']."</div>";
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
                
                if($row['ano'] == $ano['ano']){
                    $valor = number_format($row['valor'], 2, ',' , '.') ;
                    $tipo = "";
                    $linha = "
                            <tr>
                                    <td>$conta_declaracao</td>";
                    if(isset($row['tipo']))
                        $linha = $linha."<td>" . $row['descricao'] . "</td>
                                    <td>" . $row['tipo'] . "</td>
                                    <td>" . $valor . "</td>
                            </tr>";
                    else 
                        $linha = $linha."<td>" . $row['descricao'] . "</td>
                                    <td>" . $tipo . "</td>
                                    <td>" . $valor . "</td>
                            </tr>";
                    echo $linha;
                    $conta_declaracao++;
                    $soma += $row['valor'];
                }
            }
                $soma = number_format($soma, 2, ',' , '.') ;
            echo "
                         <tr>
                                <td colspan = '3' class='topo_tabela'>TOTAL</td>
                                <td class='topo_tabela'>" . $soma . "</td>
                         </tr>";
            echo "</table>";
        }
    }
?>
