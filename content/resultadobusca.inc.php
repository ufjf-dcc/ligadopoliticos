<?php
include ('../consultasSPARQL.php');
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
$cidade_estado_eleitoral = '';

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
if (isset($_GET['cidade_estado_eleitoral']))
	$cidade_estado_eleitoral = $_GET['cidade_estado_eleitoral'];

	
//$consulta=("SELECT p.id_politico, p.nome_civil, p.situacao, p.partido, p.cargo, p.cargo_uf FROM politico p");
$sparqlConsulta = 'select ?id_politico ?nome_civil ?situacao ?partido ?cargo ?cargo_uf
where{
  OPTIONAL{?id_politico foaf:name ?nome_civil}.
  OPTIONAL{?id_politico polbr:situation ?situacao}.
  OPTIONAL{?id_politico pol:party ?partido.
  FILTER isliteral(?partido)}.
  OPTIONAL{?id_politico pol:Office ?cargo}.
  OPTIONAL{?id_politico polbr:officeState ?cargo_uf}.
  ';

/////////////////////////////////////////////
/*
 if (($situacao == 'Candidato Eleito') || ($situacao == 'Candidato Nao-Eleito') || ($situacao == 'Candidato') || ($nome <> '')){
	$consulta_eleicao = " JOIN eleicao e ON p.id_politico=e.id_politico";
	$consulta= $consulta.$consulta_eleicao;
}
 */


//$consulta=$consulta." WHERE 1";

//ok
if ($situacao == 'Candidato Eleito'){
	/*
        $consulta_resultado = " AND e.resultado = 'Eleito'";
        $consulta= $consulta.$consulta_resultado;
         */
        $sparqlConsulta = $sparqlConsulta.' ?id_politico polbr:election ?blank.
                                            ?blank earl:outcome ?resultado.	
                                            filter(?resultado = " Eleito").
                                            ';
}
//ok
elseif ($situacao == 'Candidato Nao-Eleito'){
	/*
        $consulta_resultado = " AND e.resultado <> 'Eleito'";
	$consulta= $consulta.$consulta_resultado;
         */
        $sparqlConsulta = $sparqlConsulta.'?id_politico polbr:election ?blank.
                                            ?blank earl:outcome ?resultado.	
                                            filter(?resultado != " Eleito").
                                            ';
}
//valor de situação varia se a consulta for feia pelo filtro inicial ou através de politico_html_dados_pessoais.inc.php
elseif ($situacao == 'Em Exercicio' || $situacao == 'Fora de Exercicio' || $situacao == "Em exercício" ||
        $situacao == 'Fora de exercício'){
	/*
        $consulta_situacao = " AND p.situacao = '$situacao'";
	$consulta= $consulta.$consulta_situacao;
         */
        $situacao = str_replace("Exercicio", "exercício", $situacao);
        $sparqlConsulta = $sparqlConsulta.'filter(?situacao = "'.$situacao.'").
                ';
}
//OK
if ($nome <> ''){
	//$consulta_nome = " AND p.nome_civil LIKE '%$nome%' OR p.nome_parlamentar LIKE '%$nome%' OR e.nome_urna LIKE '%$nome%'";
	//$consulta= $consulta.$consulta_nome;
        $nome = mudaNome($nome);
        $sparqlConsulta = $sparqlConsulta.'optional{?id_politico polbr:governmentalName ?nome_parlamentar.}
                                            optional{ ?id_politico polbr:election ?blank.
                                            ?blank foaf:name ?nome_urna.}
                                            FILTER (regex(?nome_civil, "'.$nome.'", "i") || regex(?nome_parlamentar, "'.$nome.'", "i")|| regex(?nome_urna, "'.$nome.'", "i")).
                                            filter (!isblank(?id_politico)).
                                            ';
}
//OK
if ($partido <> ''){
	$consulta_partido = " AND p.partido = '$partido'";
	$consulta= $consulta.$consulta_partido;
        $sparqlConsulta = $sparqlConsulta.'?id_politico pol:party "'.$partido.'".
            ';
}
///OK
if ($estado <> ''){
	$consulta_estado = " AND p.cargo_uf = '$estado'";
	$consulta= $consulta.$consulta_estado;
        $sparqlConsulta = $sparqlConsulta.'?id_politico polbr:officeState "'.$estado.'".
            ';
        
}

/////////////////////////////////////////////
if ($cargo <> ''){
    echo '<h1> entrou </h1>';
  if ($situacao == 'Candidato' || $situacao == 'Candidato Eleito' || $situacao == 'Candidato Nao-Eleito')
	   //$consulta_cargo = " AND e.cargo = '$cargo'";
           $consulta_cargo = '?id_politico polbr:election ?blank.
                              ?blank pol:Office "'.$cargo.'".
                              ';
	else
	   //$consulta_cargo = " AND p.cargo = '$cargo'";
            $consulta_cargo = 'filter(?cargo = "'.$cargo.'")
                 ';
	$consulta= $consulta.$consulta_cargo;
        $sparqlConsulta = $sparqlConsulta.$consulta_cargo;
}

if ($sexo <> ''){
	$consulta_sexo = " AND p.sexo = '$sexo'";
	$consulta= $consulta.$consulta_sexo;
        $sparqlConsulta = $sparqlConsulta.'?id_politico foaf:gender "'.$sexo.'".
            ';
}

if ($cor <> ''){
	$consulta_cor = " AND p.cor = '$cor'";
	$consulta= $consulta.$consulta_cor;
        $sparqlConsulta = $sparqlConsulta.'?id_politico person:complexion "'.$cor.'".
            ';
}

if ($estado_civil <> ''){
	$consulta_estado_civil = " AND p.estado_civil = '$estado_civil'";
	$consulta= $consulta.$consulta_estado_civil;
        $sparqlConsulta = $sparqlConsulta.'?id_politico polbr:maritalStatus "'.$estado_civil.'".
            ';
        
}

if ($ocupacao <> ''){
	$consulta_ocupacao = " AND p.ocupacao = '$ocupacao'";
	$consulta= $consulta.$consulta_ocupacao;
        $sparqlConsulta = $sparqlConsulta.'?id_politico person:occupation "'.$ocupacao.'".
            ';
}

if ($grau_instrucao <> ''){
	$consulta_grau_instrucao = " AND p.grau_instrucao = '$grau_instrucao'";
	$consulta= $consulta.$consulta_grau_instrucao;
        $sparqlConsulta = $sparqlConsulta.'?id_politico dcterms:educationLevel "'.$grau_instrucao.'".
            ';
}
//Brasileira nata ou Brasileira (naturalizada) 
if ($nacionalidade <> ''){
	$consulta_nacionalidade = " AND p.nacionalidade = '$nacionalidade'";
	$consulta= $consulta.$consulta_nacionalidade;
        $sparqlConsulta = $sparqlConsulta.'?id_politico dbpprop:nationality "'.$nacionalidade.'".
            ';
}

if ($cidade_nascimento <> ''){
	$consulta_cidade_nascimento = " AND p.cidade_nascimento = '$cidade_nascimento'";
	$consulta= $consulta.$consulta_cidade_nascimento;
        $cidade_nascimento = mudaNome($cidade_nascimento);
        $sparqlConsulta = $sparqlConsulta.'?id_politico being:place-of-birth ?cidade_nascimento.
                                            filter isliteral(?cidade_nascimento).
                                            filter (regex(?cidade_nascimento,"'.$cidade_nascimento.'","i")).
                                                ';
}

if ($estado_nascimento <> ''){
	$consulta_estado_nascimento = " AND p.estado_nascimento = '$estado_nascimento'";
	$consulta= $consulta.$consulta_estado_nascimento;
        $sparqlConsulta = $sparqlConsulta.'?id_politico polbr:state-of-birth "'.$estado_nascimento.'".
            ';
}
//Cidade eleitoral e estado eleitoral estão juntos no banco 
if ($cidade_estado_eleitoral <> ''){
        $sparqlConsulta = $sparqlConsulta.'?id_politico polbr:place-of-vote "'.$cidade_estado_eleitoral.'"
                 ';
	//$consulta_cidade_eleitoral = " AND p.cidade_eleitoral = '$cidade_eleitoral'";
	//$consulta= $consulta.$consulta_cidade_eleitoral;
}

//$consulta=$consulta." ORDER BY nome_civil";
//$sql = mysql_query($consulta);

$sparqlConsulta = $sparqlConsulta."
  FILTER(!isBlank(?id_politico)).                                   
} ORDER BY ?nome_civil";

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//muda os parametros da consulta pare retornar o total
$sparqlTotal = str_replace("?id_politico ?nome_civil ?situacao ?partido ?cargo ?cargo_uf", "(count(?id_politico) as ?total)", $sparqlConsulta);
$sparqlTotal = consultaSPARQL($sparqlTotal);        
//só possui uma linha
foreach ($sparqlTotal as $row)
    $total = $row['total'];

//numero de registro que é exibido por pagina
$registros = 20;
        
//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total / $registros);
        
$inicio = ($registros*$pagina)-$registros;
        
$sparqlConsulta = $sparqlConsulta.'
                    LIMIT '.$registros.'
                    OFFSET '.$inicio;
        
//echo $sparqlConsulta;
$sparqlConsulta = consultaSPARQL($sparqlConsulta);        
//$sparqlConsulta = consultaSPARQL($sparqlConsulta);



$cont = count($sparqlConsulta);
echo "<b>".$total."</b>";
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
                       
     
         foreach ($sparqlConsulta as $row){
            //pega o id do politico que vem no 'sujeito'
            $var = explode('/', $row["id_politico"]);
            $row["id_politico"] = $var[4];
            
            echo "
		<tr>
			<td>&nbsp;<a href='./politico/".$row['id_politico']."' >".$row['nome_civil']."</a></td>
			<td>&nbsp;";
                        if(isset($row["situacao"]))
                            escreve2($row["situacao"]); 
                        echo "</td>
			<td>&nbsp;"; 
                        if(isset($row["cargo"]))
                            escreve2($row["cargo"]); 
                        echo "</td>
			<td>&nbsp;";
                        if(isset($row["partido"]))
                            echo $row["partido"];
                        echo "</td>
			<td>&nbsp;";
                        if(isset($row["cargo_uf"]))
                        echo $row["cargo_uf"];
                        echo "</td>
		</tr>
		";
        }       
}
else{
	escreve("Por favor, refaça a busca usando outros critérios.","Please, try again using another criteria");
	echo "<br />";
	include("form_busca.inc.php");
}
        
$anterior = $pagina - 1;
$proximo = $pagina + 1;
//echo '</br>Encrementa priximo:'.$proximo;
//$server = $_SERVER['SERVER_NAME']; 
$endereco = $_SERVER ['REQUEST_URI'];

if ($pagina > 1) {
    $endereco1 = str_replace('&pagina=' . ($anterior + 1), '&pagina=' . $anterior, $endereco);
    echo " <a href='" . $endereco1 . "'><- Anterior</a> ";
}
if ($pagina < $numPaginas) {
    $pos = strripos($endereco, "&pagina");
    //se estiver a primeira pagina
    if ($pos === FALSE)
        echo " <a href='" . $endereco . "&pagina=" . $proximo . "'>Próxima -></a> ";
    else {
        $endereco2 = str_replace('&pagina=' . ($proximo - 1), '&pagina=' . $proximo, $endereco);
        echo " <a href='" . $endereco2 . "'>|Próxima -></a>";
    }
}

function mudaNome($nome){
        //não conta o acento da letra
        $tamanhoPalavra = mb_strlen($nome);
 
        $novaPalavra = "";
        
        for($i = 0 ; $i < $tamanhoPalavra ; $i++)
        {
            $letra =  mb_substr($nome, $i, 1, 'UTF-8');
            if($letra == 'A' || $letra == 'À' || $letra == 'Á' || $letra == 'Â' || $letra == 'Ã' || $letra == 'a' ||
                $letra == 'à' || $letra == 'á' || $letra == 'â' || $letra == 'ã')
                    $letra = str_replace($letra, "[AÀÁÂÃaàáâã]", $letra);
            elseif($letra == 'E' || $letra == 'È' || $letra == 'É' || $letra == 'Ê' || $letra == 'Ẽ' || $letra == 'e' ||
                    $letra == 'è' ||$letra == 'é' || $letra == 'ê' || $letra == 'ẽ')
                        $letra = str_replace($letra, "[EÈÉÊẼeèéêẽ]", $letra);
            elseif($letra == 'I' || $letra == 'Ì' || $letra == 'Í' || $letra == 'Î' || $letra == 'Ĩ' || $letra == 'i' ||
                    $letra == 'ì' || $letra == 'í' || $letra == 'î' || $letra == 'ĩ')
                        $letra = str_replace($letra, "[IÌÍÎĨiìíîĩ]", $letra);
            elseif($letra == 'O' || $letra == 'Ò' || $letra == 'Ó' || $letra == 'Ô' || $letra == 'Õ' || $letra == 'o' ||
                   $letra == 'ò' || $letra == 'ó' || $letra == 'ô' || $letra == 'õ')
                        $letra = str_replace($letra, "[OÒÓÔÕoòóôõ]", $letra);
            elseif($letra == 'U' || $letra == 'Ù' || $letra == 'Ú' || $letra == 'Û' || $letra == 'Ũ' || $letra == 'u' ||
                    $letra == 'ù' || $letra == 'ú' || $letra == 'û' || $letra == 'ũ')
                        $letra = str_replace($letra, "[UÙÚÛŨuùúûũ]", $letra);
                $novaPalavra = $novaPalavra.$letra;
            
        }
        
        return $novaPalavra;
       
    }
?>

</table>
