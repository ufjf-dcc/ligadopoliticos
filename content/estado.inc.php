<?php

$sql_todos=mysql_query("SELECT id_estado, nome_estado FROM estado WHERE id_estado <> 'ZZ' AND id_estado <> 'VT'");

while($row_todos = mysql_fetch_array($sql_todos)){
	echo "<a href='?pag=estado&id_estado=$row_todos[0]' title='$row_todos[1]' alt='$row_todos[1]'>".$row_todos[0]."</a> |";
}
echo "<br /><br />";	
$id_estado=$_GET['id_estado'];

$sql_estado=mysql_query("SELECT * FROM estado WHERE id_estado = '$id_estado'");
while($row_estado = mysql_fetch_array($sql_estado)){
	$id_estado = $row_estado[0];
	$nome_estado = $row_estado[1];
	$capital = $row_estado[2];
	$area_km2 = $row_estado[3];
	$populacao = $row_estado[4];
	$populacao_ano = $row_estado[5];
	$densidade = $row_estado[6];
	$densidade_ano = $row_estado[7];
	$pib = $row_estado[8];
	$pib_percentagem = $row_estado[9];
	$pib_ano = $row_estado[10];
	$pib_percapita = $row_estado[11];
	$pib_percabita_ano = $row_estado[12];
	$idh = $row_estado[13];
	$idh_ano = $row_estado[14];
	$alfabetizacao = $row_estado[15];
	$alfabetizacao_ano = $row_estado[16];
	$mortalidade_infantil = $row_estado[17];
	$mortalidade_infantil_ano = $row_estado[18];
	$expectativa_vida = $row_estado[19];
	$expectativa_vida_ano = $row_estado[20];
}

echo "<div id='foto' style='float:right;font-size:12px;'><br /><img src='images/bandeiras/$id_estado.png' width='220px' border='1' />";
		
echo "<br />
<b>Capital: </b>$capital<br />
<b>Área: </b>$area_km2 km2<br />
<b>População: </b>$populacao ($populacao_ano)<br />
<b>Densidade: </b>$densidade ($densidade_ano)<br />
<b>PIB - % total: </b>$pib - $pib_percentagem % ($pib_ano)<br />
<b>PIB per capita: </b>$pib_percapita ($pib_percabita_ano)<br />
<b>IDH: </b>$idh % ($idh_ano)<br />
<b>Alfabetização: </b>$alfabetizacao % ($alfabetizacao_ano)<br />	 	 
<b>Mortalidade infantil: </b>$mortalidade_infantil % ($mortalidade_infantil_ano)<br />
<b>Expectativa de vida: </b>$expectativa_vida % ($expectativa_vida_ano)<br />";

echo "</div>";
echo "<div style='float:left;width:70%;'>"; 

echo "<h2>$nome_estado - $id_estado</h2>";

$sql_governador=mysql_query("SELECT nome_civil, id_politico, foto, sexo FROM politico WHERE situacao LIKE 'Em exercicio' AND cargo LIKE 'Governador' AND cargo_uf = '$id_estado'");
echo "<div class='divisao'>Governador</div>";
while($row_governador = mysql_fetch_array($sql_governador)){
	echo "<a href = 'http://ligadonospoliticos.com.br/politico/$row_governador[1]'>";
	if ($row_governador[2] <> '')
		echo "<img src='images/politicos/$row_governador[2]' align='left' width='80px' />";
	else
		if ($row_governador[3] <> 'Feminino') echo "<img src='http://localhost/ligadonospoliticos/images/politicos/M.jpg' align='left' width='80px' />";
		else echo "<img src='images/politicos/F.jpg' align='left' width='80px' />";
	echo $row_governador[0]."</a><div style = 'clear:both;'>&nbsp;</div>";
}

echo "<div class='divisao'>Vice-Governador</div>";
$sql_vice_governador=mysql_query("SELECT nome_civil, id_politico, foto, sexo FROM politico WHERE situacao LIKE 'Em exercicio' AND cargo LIKE 'Vice-Governador' AND cargo_uf = '$id_estado'");
while($row_vice_governador = mysql_fetch_array($sql_vice_governador)){
	echo "<a href = 'http://ligadonospoliticos.com.br/politico/$row_vice_governador[1]'>";
	if ($row_vice_governador[2] <> '')
		echo "<img src='images/politicos/$row_vice_governador[2]' align='left' width='80px' />";	
	else
		if ($row_vice_governador[3] <> 'Feminino') echo "<img src='images/politicos/M.jpg' align='left' width='80px' />";
		else echo "<img src='images/politicos/F.jpg' align='left' width='80px' />";
	echo $row_vice_governador[0]."</a><div style = 'clear:both;'>&nbsp;</div>";
}

echo "</div>"; 	 	
echo "<div style = 'clear:both;'>&nbsp;</div>";	

echo "<div class='divisao'>Senadores</div>";
$sql_senador=mysql_query("SELECT nome_civil, id_politico, foto, sexo FROM politico WHERE situacao = 'Em exercício' AND cargo LIKE 'Senador' AND cargo_uf = '$id_estado'");
while($row_senador = mysql_fetch_array($sql_senador)){
	echo "<a href = 'http://ligadonospoliticos.com.br/politico/$row_senador[1]'>";
	if ($row_senador[2] <> '')
		echo "<img src='images/politicos/$row_senador[2]' align='left' width='80px' />";
	else
		if ($row_senador[3] <> 'Feminino') echo "<img src='images/politicos/M.jpg' align='left' width='80px' />";
		else echo "<img src='images/politicos/F.jpg' align='left' width='80px' />";		
	echo $row_senador[0]."</a><div style = 'clear:both;'>&nbsp;</div>";
}

echo "<div class='divisao'>Deputados Federais</div>";
$sql_deputado_federal=mysql_query("SELECT nome_civil, id_politico, sexo FROM politico WHERE situacao = 'Em exercício' AND cargo LIKE 'Deputado Federal' AND cargo_uf = '$id_estado'");
while($row_deputado_federal = mysql_fetch_array($sql_deputado_federal)){
	echo "<a href = 'http://ligadonospoliticos.com.br/politico/$row_deputado_federal[1]'>".$row_deputado_federal[0]."</a><br />";
}
echo "<div style = 'clear:both;'>&nbsp;</div>";
echo "<div class='divisao'>Proposições</div>";
echo "<br />";
include("visualizacao_proposicao.inc.php");

echo "<div style = 'clear:both;'>&nbsp;</div>";
echo "<div class='divisao'>Visualizações</div>";
include("visualizacao.inc.php");

?>
