<?php
escreve ("<h3>Resultado da Busca</h3>", "<h3>Search Result</h3>");

$conta_selecao = 0;
$nome = '';
$estado = '';
$situacao = '';
$cargo = '';
$partido = '';
$sexo = '';
$cor = '';
$estado_civil = '';
$ocupacao = '';
$grau_instrucao = '';
$nacionalidade = '';
$cidade_nascimento = '';
$estado_nascimento = '';
$cidade_eleitoral = '';
$estado_eleitoral = '';

if (isset($_GET['nome']))
	$nome = $_GET['nome'];
if (isset($_GET['partido']))
	$partido = $_GET['partido'];
if (isset($_GET['estado']))
	$estado = $_GET['estado'];
if (isset($_GET['situacao']))
	$situacao = $_GET['situacao'];
if (isset($_GET['cargo1']) AND ($_GET['cargo1'] <> ''))
	$cargo = $_GET['cargo1'];
if (isset($_GET['cargo2']) AND ($_GET['cargo2'] <> ''))
	$cargo = $_GET['cargo2'];
if (isset($_GET['sexo']))
	$sexo = $_GET['sexo'];
if (isset($_GET['cor']))
	$cor = $_GET['cor'];
if (isset($_GET['estado_civil']))
	$estado_civil = $_GET['estado_civil'];
if (isset($_GET['ocupacao']))
	$ocupacao = $_GET['ocupacao'];
if (isset($_GET['estado_civil']))
	$estado_civil = $_GET['estado_civil'];
if (isset($_GET['grau_instrucao']))
	$grau_instrucao = $_GET['grau_instrucao'];
if (isset($_GET['nacionalidade']))
	$nacionalidade = $_GET['nacionalidade'];
if (isset($_GET['cidade_nascimento']))
	$cidade_nascimento = $_GET['cidade_nascimento'];
if (isset($_GET['estado_nascimento']))
	$estado_nascimento = $_GET['estado_nascimento'];
if (isset($_GET['cidade_eleitoral']))
	$cidade_eleitoral = $_GET['cidade_eleitoral'];
if (isset($_GET['estado_eleitoral']))
	$estado_eleitoral = $_GET['estado_eleitoral'];
	
$consulta=("SELECT p.id_politico, p.nome_civil, p.situacao, p.partido, p.cargo, p.cargo_uf FROM politico p");

if (($situacao == 'Candidato Eleito') || ($situacao == 'Candidato Nao-Eleito') || ($situacao == 'Candidato') || ($nome <> '')){
	$consulta_eleicao = " JOIN eleicao e ON p.id_politico=e.id_politico";
	$consulta= $consulta.$consulta_eleicao;
}

$consulta=$consulta." WHERE 1";

if ($situacao == 'Candidato Eleito'){
	$consulta_resultado = " AND e.resultado = 'Eleito'";
	$consulta= $consulta.$consulta_resultado;
}
elseif ($situacao == 'Candidato Nao-Eleito'){
	$consulta_resultado = " AND e.resultado <> 'Eleito'";
	$consulta= $consulta.$consulta_resultado;
}
elseif ($situacao == 'Em Exercicio' || $situacao == 'Fora de Exercicio'){
	$consulta_situacao = " AND p.situacao = '$situacao'";
	$consulta= $consulta.$consulta_situacao;
}

if ($nome <> ''){
	$consulta_nome = " AND p.nome_civil LIKE '%$nome%' OR p.nome_parlamentar LIKE '%$nome%' OR e.nome_urna LIKE '%$nome%'";
	$consulta= $consulta.$consulta_nome;
}

if ($partido <> ''){
	$consulta_partido = " AND p.partido = '$partido'";
	$consulta= $consulta.$consulta_partido;
}

if ($estado <> ''){
	$consulta_estado = " AND p.cargo_uf = '$estado'";
	$consulta= $consulta.$consulta_estado;
}

if ($cargo <> ''){
  if ($situacao == 'Candidato' || $situacao == 'Candidato Eleito' || $situacao == 'Candidato Nao-Eleito')
	   $consulta_cargo = " AND e.cargo = '$cargo'";
	else
	   $consulta_cargo = " AND p.cargo = '$cargo'";
	$consulta= $consulta.$consulta_cargo;
}

if ($sexo <> ''){
	$consulta_sexo = " AND p.sexo = '$sexo'";
	$consulta= $consulta.$consulta_sexo;
}

if ($cor <> ''){
	$consulta_cor = " AND p.cor = '$cor'";
	$consulta= $consulta.$consulta_cor;
}

if ($estado_civil <> ''){
	$consulta_estado_civil = " AND p.estado_civil = '$estado_civil'";
	$consulta= $consulta.$consulta_estado_civil;
}

if ($ocupacao <> ''){
	$consulta_ocupacao = " AND p.ocupacao = '$ocupacao'";
	$consulta= $consulta.$consulta_ocupacao;
}

if ($grau_instrucao <> ''){
	$consulta_grau_instrucao = " AND p.grau_instrucao = '$grau_instrucao'";
	$consulta= $consulta.$consulta_grau_instrucao;
}

if ($nacionalidade <> ''){
	$consulta_nacionalidade = " AND p.nacionalidade = '$nacionalidade'";
	$consulta= $consulta.$consulta_nacionalidade;
}

if ($cidade_nascimento <> ''){
	$consulta_cidade_nascimento = " AND p.cidade_nascimento = '$cidade_nascimento'";
	$consulta= $consulta.$consulta_cidade_nascimento;
}

if ($estado_nascimento <> ''){
	$consulta_estado_nascimento = " AND p.estado_nascimento = '$estado_nascimento'";
	$consulta= $consulta.$consulta_estado_nascimento;
}

if ($cidade_eleitoral <> ''){
	$consulta_cidade_eleitoral = " AND p.cidade_eleitoral = '$cidade_eleitoral'";
	$consulta= $consulta.$consulta_cidade_eleitoral;
}

if ($estado_eleitoral <> ''){
	$consulta_estado_eleitoral = " AND p.estado_eleitoral = '$estado_eleitoral'";
	$consulta= $consulta.$consulta_estado_eleitoral;
}

$consulta=$consulta." ORDER BY nome_civil";
$sql = mysql_query($consulta);

$cont = mysql_num_rows($sql);

echo "<b>".$cont."</b>";
escreve (" político(s) encontrado(s)."," politician(s) found.");
echo "</br>";

if ($cont > 0){

	echo "
	</br>
	<table width=100% bordercolor=white>
		<tr>
			<td class='topo_tabela'>&nbsp;"; escreve("Nome","Name"); echo "</td>
			<td class='topo_tabela'>&nbsp;"; escreve("Situação","Status"); echo "</td>
			<td class='topo_tabela'>&nbsp;"; escreve("Cargo","Office"); echo "</td>
			<td class='topo_tabela'>&nbsp;"; escreve("Partido","Party"); echo "</td>
			<td class='topo_tabela'>&nbsp;"; escreve("UF","State"); echo "</td>
		</tr>
	";

	while($row = mysql_fetch_array($sql)){
		echo "
		<tr>
			<td>&nbsp;<a href='politico/$row[id_politico]' >$row[nome_civil]</a></td>
			<td>&nbsp;"; escreve2($row[situacao]); echo "</td>
			<td>&nbsp;"; escreve2($row[cargo]); echo "</td>
			<td>&nbsp;$row[partido]</td>
			<td>&nbsp;$row[cargo_uf]</td>
		</tr>
		";
	};
}
else{
	escreve("Por favor, refaça a busca usando outros critérios.","Please, try again using another criteria");
	echo "<br />";
	include("form_busca.inc.php");
}
//echo $consulta;
?>

</table>
