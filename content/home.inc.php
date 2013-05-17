
<?php

escreve(
  "O site <b>Ligado nos Políticos</b> tem como objetivo fornecer dados de políticos brasileiros usando os conceitos de <a href='?pag=dadosligados'>Dados Ligados</a> e <a href='?pag=dadosgovernamentaisabertos'>Dados Governamentais Abertos</a>.<br />
    Utilize os mecanismos de busca abaixo para encontrar dados sobre os políticos desejados.",
    
  "This website aims to provide data from Brazilian politicians using the concepts of <a href = '? pag dadosligados = '>Linked Data</a> and <a href='?pag=dadosgovernamentaisabertos'>Open Government Data</a>. <br />
    Use the search engine below to find information about the desired politician."
);

?>
<br />
<br />
<?php
$sql1= mysql_query("SELECT COUNT(id_politico) AS quantidade FROM politico");
while ($row = mysql_fetch_array($sql1)) $quantidade = $row['quantidade'];  
{
  echo "<div style='text-align:center;'><div style='background-color:#D7DCE9; width: 230px;margin: 0 auto;'>";
  escreve("Políticos Cadastrados: ","Registered Politicians: ");
  echo"<font color='navy'><b>".$quantidade."</b></font></div></div>";
}
?>
<br />
<?php
	include("form_busca.inc.php");
?>

<div class="fonte">
<?php
escreve(
  "As informações publicadas por esse site são dados públicos coletados das seguintes fontes: <a href='http://www.tse.gov.br/internet/eleicoes/divulg_cand.htm' target='_blank'>TSE - Tribunal Superior Eleitoral</a>, <a href='http://www2.camara.gov.br/' target='_blank'>Câmara dos Deputados</a>, <a href='http://www.senado.gov.br/' target='_blank'>Senado Federal - Brasil</a>, <a href='http://politicosbrasileiros.com.br/' target='_blank'>Políticos Brasileiros</a>, <a href='http://www.fichalimpa.org.br/' target='_blank'>Ficha Limpa</a> e <a href='http://www.excelencias.org.br/' target='_blank'>Excelências</a>",
  "The information provided by this website are public data collected from the following sources: <a href='http://www.tse.gov.br/internet/eleicoes/divulg_cand.htm' target='_blank'>TSE - Tribunal Superior Eleitoral</a>, <a href='http://www2.camara.gov.br/' target='_blank'>Câmara dos Deputados</a>, <a href='http://www.senado.gov.br/' target='_blank'>Senado Federal - Brasil</a>, <a href='http://politicosbrasileiros.com.br/' target='_blank'>Políticos Brasileiros</a>, <a href='http://www.fichalimpa.org.br/' target='_blank'>Ficha Limpa</a> and <a href='http://www.excelencias.org.br/' target='_blank'>Excelências</a>"
);
?>
</div>
