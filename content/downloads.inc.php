<h2>Downloads</h2>

<?php
    include ("head.inc.php");
include ('../consultasSPARQL.php');
    include('../properties.php');
    include ("../functions.php");
    include ('../config.php');


$fp = fopen("../downloads/afastamento.csv", "w");

$quebra = chr(13).chr(10);
$escrita = "id_afastamento;id_politico;cargo;cargo_uf;data;tipo;motivo;".$quebra;

//$consulta = "SELECT * FROM afastamento";

$sparql = consultaSPARQL('select ?y
                        where {
                                ?y polbr:absence ?x.
                          OPTIONAL {?x pol:Office ?cargo }.
                          OPTIONAL {?x geospecies:State ?cargo_uf }.
                          OPTIONAL {?x timeline:atDate ?data}.
                          OPTIONAL {?x dcterms:type ?type}.
                          OPTIONAL {?x event:fact ?motivo}.
                        }');
//$sql = mysql_query($consulta);

foreach ($sparql as $row)
{
  $escrita = $escrita.$row['cargo'].';'.$row['cargo_uf'].';'.$row['data'].';'.$row['tipo'].';'.$row['motivo'].$quebra;
}

$escreve = fwrite($fp, $escrita);

fclose($fp);

?>
<?php

escreve("
Selecione o arquivo abaixo para fazer o download das informações em formato bruto. Os dados são identificados através da chave primária encontrada em <i>Político</i>. <br />
Para obter os dados mais atualizados, por favor entre em <a href='?pag=contato'>contato</a> conosco. 
",
"
Select the file below to download the information in raw format. The data are identified by the primary key found in <i>Politician</i>. <br />
For the most current data, please <a href='?pag=contato'>contact</a> us.
");

?>
<ul>
	<li><a href="../downloads/afastamento.csv.zip"> <?php escreve("Afastamento","Absence"); ?> </a></li><br />
	<li><a href="../downloads/comissao.csv.zip"> <?php escreve("Comissão","Committee"); ?> </a></li><br />
	<li><a href="../downloads/comissao_politico.csv.zip"> <?php escreve("Comissão_Político","Committee_Politician"); ?> </a></li><br />
	<li><a href="../downloads/declaracao_bens.csv.zip"> <?php escreve("Declaração_Bens","Assets_Declaration"); ?> </a></li><br />
	<li><a href="../downloads/eleicao.csv.zip"> <?php escreve("Eleição","Election"); ?> </a></li><br />
	<li><a href="../downloads/endereco_parlamentar.csv.zip"> <?php escreve("Endereço_Parlamentar","Parliamentary_Address"); ?>  </a></li><br />
	<li><a href="../downloads/enrereco_parlamentar_politico.csv.zip"> <?php escreve("Endereço_Parlamentar_Político","Parliamentary_Address_Politician"); ?> </a></li><br />
	<li><a href="../downloads/lideranca.csv.zip"> <?php escreve("Liderança","Leadership"); ?> </a></li><br />
	<li><a href="../downloads/mandato.csv.zip"> <?php escreve("Mandato","Term"); ?> </a></li><br />
	<li><a href="../downloads/missao.csv.zip"> <?php escreve("Missão","Mission"); ?>  </a></li><br />
	<li><a href="../downloads/ocorrencia.csv.zip"> <?php escreve("Ocorrência","Occurrence"); ?> </a></li><br />
	<li><a href="../downloads/politico.csv.zip"> <?php escreve("Político","Politician"); ?> </a></li><br />
	<li><a href="../downloads/pronunciamento.csv.zip"> <?php escreve("Pronunciamento","Speech"); ?> </a></li><br />
	<li><a href="../downloads/proposicao.csv.zip"> <?php escreve("Proposição","Proposition"); ?> </a></li><br />
</ul>

