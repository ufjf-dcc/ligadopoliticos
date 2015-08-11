<?php
    include ("../functions.php");
    include ("head.inc.php");
	$id_estado ='';
	$pag = $_GET['pag'];
	if (isset($_GET['id_estado']))
		$id_estado = $_GET['id_estado'];
?>

<div class='visualizacao_menu'>
	<a href='?pag=<?php echo $pag; ?>&id_grafico=cargo&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio'><?php escreve("Cargo","Office") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=cargo_uf&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&grafico=FCF_Column3D&ordem=nome+ASC'><?php escreve("Estado","State") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=partido&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio'><?php escreve("Partido","Party") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=grau_instrucao&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&grafico=FCF_Doughnut2D&ordem=valor+ASC'><?php escreve("Grau de Instrução","Education Level") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=sexo&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&grafico=FCF_Pie2D'><?php escreve("Sexo","Gender") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=ocupacao&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio'><?php escreve("Ocupação","Occupation") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=nacionalidade&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&grafico=FCF_Pie2D'><?php escreve("Nacionalidade","Nacionality") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=cidade_nascimento&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio'><?php escreve("Cidade de Nascimento","City of Birth") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=estado_nascimento&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&grafico=FCF_Column3D&ordem=nome+ASC'><?php escreve("Estado de Nascimento","State of Birth") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=comissao&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&ordem=nome+ASC'><?php escreve("Comissão","Committee") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=declaracao_bens&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio'><?php escreve("Declaração de Bens","Declaration of Assets") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=lideranca&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&ordem=nome+ASC'><?php escreve("Liderança","Leadership") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=missao&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&ordem=nome+ASC'><?php escreve("Missão","Mission") ?></a> |
<!--<a href='?pag=<?php echo $pag; ?>&id_grafico=ocorrencia&situacao=Em+Exercicio&ordem=nome+ASC'><php escreve("Ocorrência","Occurrency") ?></a> | -->
	<a href='?pag=<?php echo $pag; ?>&id_grafico=pronunciamento&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&ordem=nome+ASC'><?php escreve("Pronunciamento","Speech") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=proposicao&id_estado=<?php echo $id_estado; ?>&situacao=Em+Exercicio&ordem=nome+ASC'><?php escreve("Proposição","Bill") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=nuvem_palavra_proposicao&id_estado=<?php echo $id_estado; ?>'><?php escreve("Nuvem de Palavra - Proposições","Word Cloud - Bills") ?></a> |
	<a href='?pag=<?php echo $pag; ?>&id_grafico=nuvem_palavra_votacao&id_estado=<?php echo $id_estado; ?>'><?php escreve("Nuvem de Palavra - Votações","Word Cloud - Votes") ?></a>
</div>
	
<?php

function geraGrafico($consulta,$grafico, $X1, $X2, $Y1,$Y2){
	include("../fusioncharts/FusionCharts.php");
    include ("../properties.php");
    include("../consultasSPARQL.php");
	$strXML = "<graph decimalPrecision='0' showNames='1' showPercentageInLabel='1' showPercentageValues='0' formatNumberScale='0' thousandSeparator='.' xAxisName= '" . retorna ($X1,$X2) . "' yAxisName='" . retorna ($Y1,$Y2) . "'>";
	$tamanho = '500';
    echo $consulta;
    $row1 = consultaSPARQL($consulta);
	$tamanho = 30 * 15;
	$color = '';
	if ($grafico == '' || $grafico == 'FCF_Bar2D' || $grafico == 'FCF_Area2D' || $grafico == 'FCF_Column2D' || $grafico == 'FCF_Column3D' || $grafico == 'FCF_Line')
		$color = '9C9CDB';
	if ($row1) {
        $i=0;
        foreach ($row1 as $row) {
            $i++;
            //echo $row['x'].$row['count']."-";
            if($row['x']=="MA")$row['x'] = "MARANHAO";
            if($row['x']=="ZZ")$row['x'] = "NAO INFORMADO";
            $partido = explode(":",$row['x']);
            if($partido[0]=="http")$row['x']="partido";
            $strXML .="<set  color='". $color ."' name='" . $row['x'] . "' value='" . (int)$row['count'] . "'/>";
        }
        if($i>=30)$tamanho = $tamanho * 2;
	}
	$strXML .= "</graph>";
	if ($grafico == '')
		$grafico = "FCF_Bar2D";
	echo renderChart("../fusioncharts/".$grafico.".swf", "", $strXML, "", 720,$tamanho);
}

function geraVisualizacao ($select, $join, $group_by, $X1, $X2, $Y1, $Y2) 
{
	echo "<h2>"; escreve ($Y1,$Y2); echo " X "; escreve ($X1,$X2); echo "</h2>";
	echo "<div style='float:right;'>";
	include("form_filtro.inc.php");
	echo "</div>";
	echo "<div style='float:left;'>";
    geraGrafico($consulta,$grafico, $X1, $X2, $Y1, $Y2);
	echo "</div>";	
	echo "<div style='clear:both;'>&nbsp;</div>";
}

$id_grafico = '';
if (isset($_GET['id_grafico']))
	$id_grafico = $_GET['id_grafico'];

switch ($id_grafico){

	case 'cargo':

    geraVisualizacao("select ?x (COUNT(?x) AS ?count)
  WHERE
  {
    ?y <http://www.rdfabout.com/rdf/schema/politico/Office> ?x.
  ",
    "",
    " }GROUP BY ?x",
        "Cargo",
	"Office",
	"Número de Políticos",
	"Number of Politicians"
    );
	break;

	case 'cargo_uf':
	geraVisualizacao 
	(
	"select ?x (COUNT(?x) AS ?count)
  WHERE
  {
        ?y <http://ligadonospoliticos.com.br/politicobr#state-of-birth> ?x .
",
	"",
	"} GROUP BY ?x ",
	"Estado (Cargo)",
	"State (Office)",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'partido':
	geraVisualizacao 
	(
	"select ?x (COUNT(?x) AS ?count)
  WHERE
  {
    ?y <http://www.rdfabout.com/rdf/schema/politico/party> ?x .
        FILTER(isLiteral(?x))
    	",
	"",
	"  }GROUP BY ?x",
	"Partido",
	"Party",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;
	
	case 'grau_instrucao':
	geraVisualizacao 
	(
	"select ?x (COUNT(?x) AS ?count)
        WHERE
        {
            ?y <http://purl.org/dc/terms/educationLevel> ?x
    	",
	"",
	" }GROUP BY ?x",
	"Grau de Instrução",
	"Education Level",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'sexo':
	geraVisualizacao 
	(
        "select ?x (COUNT(?x) AS ?count)
        WHERE
        {
            ?y <http://xmlns.com/foaf/0.1/gender> ?x
    	",
        "",
        " }GROUP BY ?x",
	"Sexo",
	"Gender",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'ocupacao':
	geraVisualizacao 
	(
        "select ?x (COUNT(?x) AS ?count)
        WHERE
        {
            ?y <http://models.okkam.org/ENS-core-vocabulary#occupation> ?x
    	",
        "",
        " }GROUP BY ?x",
	"Ocupação",
	"Occupation",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'nacionalidade':
	geraVisualizacao 
	(
        "select ?x (COUNT(?x) AS ?count)
        WHERE
        {
            ?y <http://dbpedia.org/property/nationality> ?x
    	",
        "",
        " }GROUP BY ?x",
	"Nacionalidade",
	"Nacionality",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'cidade_nascimento':
	geraVisualizacao 
	(
        "select ?x (COUNT(?x) AS ?count)
        WHERE
        {
            ?y <http://purl.org/ontomedia/ext/common/being#place-of-birth> ?x
    	",
        "",
        " }GROUP BY ?x",
	"Cidade de Nascimento",
	"City of Birth",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'estado_nascimento':
	geraVisualizacao 
	(
        "select ?x (COUNT(?x) AS ?count)
        WHERE
        {
            ?y <http://ligadonospoliticos.com.br/politicobr#state-of-birth> ?x
    	",
        "",
        " }GROUP BY ?x",
	"Estado de Nascimento",
	"State of Birth",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;

	case 'comissao':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, COUNT(*) AS valor FROM politico p",
	" JOIN comissao_politico cp ON p.id_politico = cp.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Número de Comissões",
	"Number of Committees"
	);
	break;

	case 'declaracao_bens':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, SUM(d.valor) AS valor FROM politico p",
	" JOIN declaracao_bens d ON p.id_politico = d.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Total da Declaração de Bens",
	"Declaration of Assets Total"
	);
	break;	

	case 'lideranca':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, COUNT(*) AS valor FROM politico p",
	" JOIN lideranca l ON p.id_politico = l.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Número de Lideranças",
	"Number of Leaderships"
	);
	break;

	case 'missao':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, COUNT(*) AS valor FROM politico p",
	" JOIN missao m ON p.id_politico = m.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Número de Missões",
	"Number of Missions"
	);
	break;	

	case 'ocorrencia':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, COUNT(*) AS valor FROM politico p",
	" JOIN ocorrencia o ON p.id_politico = o.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Número de Ocorrências",
	"Number of Occurrences"
	);
	break;		

	case 'pronunciamento':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, COUNT(*) AS valor FROM politico p",
	" JOIN pronunciamento pr ON p.id_politico = pr.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Número de Pronunciamentos",
	"Number of Speeches"
	);
	break;
	
	case 'proposicao':
	geraVisualizacao 
	(
	"SELECT UCASE(p.nome_civil) AS nome, COUNT(*) AS valor FROM politico p",
	" JOIN proposicao pr ON p.id_politico = pr.id_politico",
	" GROUP BY p.nome_civil",
	"Político",
	"Politician",
	"Número de Proposições",
	"Number of Propositions"
	);
	break;

	case 'nuvem_palavra_proposicao':
	escreve("<h2>Nuvem de Palavra - Proposições</h2>","<h2>Word Cloud - Propositions</h2>");
	include("visualizacao_proposicao.inc.php");
	break;
	
	case 'nuvem_palavra_votacao':
	escreve("<h2>Nuvem de Palavra - Proposições</h2>","<h2>Word Cloud - Votes</h2>");
	include("visualizacao_votacao.inc.php");
	break;
	
	default:
	geraVisualizacao 
	(
	"SELECT (p.cargo) AS nome, COUNT(*) AS valor FROM politico p",
	"",
	" GROUP BY p.cargo",
	"Cargo",
	"Office",
	"Número de Políticos",
	"Number of Politicians"
	);
	break;
}
?>
