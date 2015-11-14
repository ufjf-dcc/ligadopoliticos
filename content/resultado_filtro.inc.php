<?php

$consulta = '';
$nome = '';
$id_estado = '';
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
$grafico = '';
$ordem = '';
$limite1 = '';
$limite2 = '';
$id_grafico = '';

if (isset($_GET['partido']))
	$partido = $_GET['partido'];
if (isset($_GET['id_estado']))
	$id_estado = $_GET['id_estado'];
if (isset($_GET['situacao']))
	$situacao = $_GET['situacao'];
if (isset($_GET['cargo']))
	$cargo = $_GET['cargo'];
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
if (isset($_GET['grafico']))
	$grafico = $_GET['grafico'];
if (isset($_GET['ordem']))
	$ordem = $_GET['ordem'];
if (isset($_GET['limite1']))
	$limite1 = $_GET['limite1'];
if (isset($_GET['limite2']))
	$limite2 = $_GET['limite2'];
if (isset($_GET['id_grafico']))
	$id_grafico = $_GET['id_grafico'];
	
$consulta = $consulta.$select;
$consulta = $consulta.$join;

if ($situacao == 'Em Exercicio' ){
	$consulta_situacao =
        "
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"^Eleito \" , \"i\")
        }
        UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"^2º turno\" , \"i\")
        }
        UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Eleito por média\" , \"i\")
        }UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Eleito por QP\" , \"i\")
        }";

	$consulta= $consulta.$consulta_situacao;
}

if ($situacao == "Fora de Exercicio" ){
        $consulta_situacao =
            "
        ?y <http://ligadonospoliticos.com.br/politicobr#election> ?ele.
        ?ele <http://motools.sourceforge.net/timeline/timeline.html#atYear>	 \"2014\" .
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Não Eleito \" , \"i\")
        }
        UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Suplente\" , \"i\")
        }
        UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Indeferido\" , \"i\")
        }UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Renúncia\" , \"i\")
        }UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Não conhecimento do pedido\" , \"i\")
        }UNION
        {
         ?y <http://ligadonospoliticos.com.br/politicobr#situation> ?situ FILTER regex (?situ , \"Falecido\" , \"i\")
        }";

        $consulta= $consulta.$consulta_situacao;
    }

if ($nome <> ''){
	$consulta_nome = " AND p.nome_civil LIKE '%$nome%' OR p.nome_parlamentar LIKE '%$nome%' OR e.nome_urna LIKE '%$nome%'";
	//$consulta= $consulta.$consulta_nome;
}

if ($partido <> ''){
	$consulta_partido = " ?y <http://ligadonospoliticos.com.br/politicobr#election> ?ele .
                          ?ele <http://motools.sourceforge.net/timeline/timeline.html#atYear> \"2014\"  .
                           ?ele <http://www.rdfabout.com/rdf/schema/politico/party> \"$partido\"  .";
	$consulta= $consulta.$consulta_partido;
}

if ($id_estado <> ''){
	$consulta_estado = "?y <http://ligadonospoliticos.com.br/politicobr#election> ?ele .
                        ?ele <http://motools.sourceforge.net/timeline/timeline.html#atYear> \"2014\"  .
                        ?ele <http://rdf.geospecies.org/ont/geospecies#State> \"$id_estado\" .";
	$consulta= $consulta.$consulta_estado;
}

if ($cargo <> ''){
	$consulta_cargo = "?y <http://www.rdfabout.com/rdf/schema/politico/Office> \"$cargo\" .";
	$consulta= $consulta.$consulta_cargo;
}

if ($sexo <> ''){
	$consulta_sexo = " ?y <http://xmlns.com/foaf/0.1/gender> \"$sexo\" .";
	$consulta= $consulta.$consulta_sexo;
}

if ($cor <> ''){
	$consulta_cor = " ?y <http://models.okkam.org/ENS-core-vocabulary#complexion> \"$cor\" .";
	$consulta= $consulta.$consulta_cor;
}

if ($estado_civil <> ''){
	$consulta_estado_civil = " ?y <http://ligadonospoliticos.com.br/politicobr#maritalStatus> \"$estado_civil\" .";
	$consulta= $consulta.$consulta_estado_civil;
}

if ($ocupacao <> ''){
	$consulta_ocupacao = " ?y <http://models.okkam.org/ENS-core-vocabulary#occupation> \"$ocupacao\" .";
	$consulta= $consulta.$consulta_ocupacao;
}

if ($grau_instrucao <> ''){
	$consulta_grau_instrucao = " ?y <http://purl.org/dc/terms/educationLevel> \"$grau_instrucao\" .";
	$consulta= $consulta.$consulta_grau_instrucao;
}

if ($nacionalidade <> ''){
	$consulta_nacionalidade = "?y <http://dbpedia.org/property/nationality> \"$nacionalidade\" .";
	$consulta= $consulta.$consulta_nacionalidade;
}

if ($cidade_nascimento <> ''){
	$consulta_cidade_nascimento = "?y <http://purl.org/ontomedia/ext/common/being#place-of-birth> \"$cidade_nascimento\" .";
	$consulta= $consulta.$consulta_cidade_nascimento;
}

if ($estado_nascimento <> ''){
	$consulta_estado_nascimento = " ?y <http://ligadonospoliticos.com.br/politicobr#state-of-birth> \"$estado_nascimento\" .";
	$consulta= $consulta.$consulta_estado_nascimento;
}

if ($cidade_eleitoral <> ''){
	$consulta_cidade_eleitoral = " AND p.cidade_eleitoral = '$cidade_eleitoral'";
	//$consulta= $consulta.$consulta_cidade_eleitoral;
}

if ($estado_eleitoral <> ''){
	$consulta_estado_eleitoral = " AND p.estado_eleitoral = '$estado_eleitoral'";
	//$consulta= $consulta.$consulta_estado_eleitoral;
}

$consulta = $consulta.$group_by;

if($ordem = "nome ASC")$ordem = "";

$consulta = $consulta.$ordem;

if ($id_grafico == 'ocupacao' || $id_grafico == 'declaracao_bens' || $id_grafico == 'cidade_nascimento'){
	$limite1 = '0';
	$limite2 = '30';
}

if ($limite1 <> '' AND $limite2 <> '' AND $limite1 >= 0 AND $limite2 > 0 AND is_numeric($limite1) == true AND is_numeric($limite2) == true AND $limite2 <= 1000)
	//$consulta = $consulta." LIMIT ".$limite1.", ".$limite2;

?>