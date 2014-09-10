<?php
if(isset($_GET['pag']))
	$pag=$_GET['pag'];

$id_grafico ='';
if (isset($_GET['id_grafico']))
	$id_grafico = $_GET['id_grafico'];
		
echo "
<Script Language='JavaScript'>
function getStates() {
      var id_estado = document.getElementById('id_estado').value;
      document.location=('?pag=$pag&id_grafico=$id_grafico&id_estado=' + id_estado);
   
}

function getCidade() {
	  var id_estado = document.getElementById('id_estado').value;
      var id_cidade = document.getElementById('id_cidade').value;
      document.location=('?pag=$pag&id_grafico=$id_grafico&id_estado=' + id_estado + '&id_cidade=' + id_cidade);
   
}

function getPolitico() {
	  var id_estado = document.getElementById('id_estado').value;
      var id_cidade = document.getElementById('id_cidade').value;
	  var id_politico = document.getElementById('id_politico').value;
      document.location=('?pag=$pag&id_grafico=$id_grafico&id_estado=' + id_estado + '&id_cidade=' + id_cidade + '&id_politico=' + id_politico);
   
}

</Script> 
";


$id_cidade= '';
$id_estado= '';
$id_politico='';
if(isset($_GET['id_cidade']))
	$id_cidade=$_GET['id_cidade'];
if(isset($_GET['id_estado']))
	$id_estado=$_GET['id_estado'];
if(isset($_GET['id_politico']))
	$id_politico=$_GET['id_politico'];

$consulta = "SELECT DISTINCT pr.ementa FROM votacao v1 JOIN proposicao pr ON v1.id_proposicao = pr.id_proposicao JOIN voto v2 ON v1.id_votacao = v2.id_votacao";
$tamanho = 1;
$numero = 5;

$query = "select * from estado WHERE id_estado <> 'ZZ' AND id_estado <> 'VT' order by id_estado";
$result = mysql_query($query) or die(mysql_error());

echo "<select name='id_estado' id='id_estado' onChange='getStates();'>
<option value=''>Selecione o estado</option>";
while ($row = mysql_fetch_row($result)){
$id_estado2 = $row[0];
$nome_estado = $row[1];

echo "<option value= $id_estado2";
if ($id_estado==$id_estado2){ 
	echo " SELECTED";
	} 
echo ">$nome_estado</option>";
}
echo "</select>"; 

$query = "select id_cidade, nome_cidade from cidade where id_estado='$id_estado' ORDER BY nome_cidade";
$result= mysql_query($query) or die(mysql_error());

if ($id_estado){
	$tamanho = 2;
	//$consulta = $consulta." JOIN politico p on pr.id_politico = p.id_politico WHERE p.cargo_uf = '$id_estado'";
	echo "<select name='id_cidade' id='id_cidade' onChange='getCidade();'>
	<option value=''>Selecione a cidade</option>"; 
	while ($row = mysql_fetch_row($result)){
	$id_cidade2 = $row[0];
	$nome_cidade = $row[1];
	echo "<option value=$id_cidade2";

	if ($id_cidade==$id_cidade2){ 
		echo " SELECTED";
		} 
	echo ">$nome_cidade</option>";
	}
	echo "</select>";
}

$query3 = "SELECT DISTINCT p.id_politico, p.nome_civil FROM politico p JOIN proposicao pr ON p.id_politico = pr.id_politico WHERE p.cargo_uf='$id_estado' AND p.situacao LIKE 'Em exercicio'";
$result3= mysql_query($query3) or die(mysql_error());

if ($id_cidade){ 
	echo "<select name='id_politico' id='id_politico' onChange='getPolitico();'>
	<option value=''>Selecione o político</option>"; 
	while ($row3 = mysql_fetch_row($result3)){
	$id_politico2 = $row3[0];
	$politician = $row3[1];
	
	$quantidade = '';
	$sql444 = mysql_query("SELECT quantidade FROM eleicao_voto_politico WHERE id_politico = '$id_politico2' AND id_cidade = '$id_cidade'");
	while ($row444 = mysql_fetch_row($sql444))
	{
		$quantidade = '- '.$row444[0].' votos';
	};
	echo "<option value=$id_politico2";

	if ($id_politico==$id_politico2){ 
		echo " SELECTED";
		} 
	echo ">$politician $quantidade</option>";
	}
	echo "</select>";
}

if ($id_politico){
	$tamanho = 3;
	$numero = 3;
	$consulta = $consulta." WHERE v2.id_politico = '$id_politico'";
}
	echo "<br />";	
	
	$input1 = '';
	$consulta1 = $consulta." AND v2.id_voto_tipo = 'Sim'";
	//$consulta =  $consulta." ORDER BY data DESC LIMIT 0,2000";
	$sql_votacao1 = mysql_query($consulta1) or die(mysql_error());
	while($row_votacao1 = mysql_fetch_array($sql_votacao1)){		
		$input1 = $input1.' '.$row_votacao1[0];  
	}
	
	$input2 = '';
	$consulta2 = $consulta." AND v2.id_voto_tipo = 'Não'";
	//$consulta =  $consulta." ORDER BY data DESC LIMIT 0,2000";
	$sql_votacao2 = mysql_query($consulta2) or die(mysql_error());
	while($row_votacao2 = mysql_fetch_array($sql_votacao2)){		
		$input2 = $input2.' '.$row_votacao2[0];  
	}
	echo "<div style='width:50%;float:left;'>";
	echo "<h1 class='verde'>SIM</h1>";
	keywords($input1, 1, 10, 'verde');
	echo "</div>";
	echo "<div style='width:50%;float:right;text-align:right;'>";
	echo "<h1 class='vermelho'>NÃO</h1>";
	keywords($input2, 1, 10,'vermelho');
	echo "</div>";
	echo "<div style='clear:both;'> &nbsp;</div>";
?>