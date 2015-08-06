<?php

$conexao = mysql_connect("localhost","root","123");
if(!$conexao){
    		die('Não foi possível conectar: ' . mysql_error());
	}
	
	mysql_select_db("politicos_brasileiros", $conexao);
	mysql_set_charset("utf8");

header ("content-type: application/rdf+xml");

$site = 'http://ligadonospoliticos.com.br';
$recurso = $_SERVER ['REQUEST_URI'];
$parte_endereco = explode('/',$recurso);
$id_politico = $parte_endereco[3];
echo '<?xml version="1.0"?>'; 
echo '<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" 
			   xmlns:rdfs="http://www.w3.org/2000/01-rdf-schema#"
			   xmlns:foaf="http://xmlns.com/foaf/0.1/" 
			   xmlns:bio="http://purl.org/vocab/bio/0.1/"
			   xmlns:person="http://models.okkam.org/ENS-core-vocabulary#"
			   xmlns:dbpprop="http://dbpedia.org/property/"
			   xmlns:vcard="http://www.w3.org/2006/vcard/ns#"
			   xmlns:being="http://purl.org/ontomedia/ext/common/being#"
			   xmlns:biblio="http://purl.org/ontology/bibo/"
			   xmlns:dcterms="http://purl.org/dc/terms/" 
			   xmlns:pol="http://www.rdfabout.com/rdf/schema/politico/" 
			   xmlns:dc="http://purl.org/dc/elements/1.1/" 
			   xmlns:cc="http://creativecommons.org/ns#"
			   xmlns:timeline="http://motools.sourceforge.net/timeline/timeline.html#"
			   xmlns:polbr="http://ligadonospoliticos.com.br/politicobr/"
			   xmlns:owl="http://www.w3.org/2002/07/owl#"
			   xmlns:skos="http://www.w3.org/2004/02/skos/core#"
			   xmlns:rdfmoney="http://www.purl.org/net/rdf-money/"
			   xmlns:geospecies="http://rdf.geospecies.org/ont/geospecies#"
			   xmlns:earl="http://www.w3.org/ns/earl#"
			   xmlns:spinrdf="http://spinrdf.org/sp#"
			   xmlns:event="http://purl.org/NET/c4dm/event.owl#"
			   xmlns:po="http://purl.org/ontology/po"
		>';
echo '<rdf:Description rdf:about="http://ligadonospoliticos.com.br/politico/'.$id_politico.'" >';
	
$sql1 = mysql_query("SELECT * FROM politico WHERE id_politico = '$id_politico'");
while($row = mysql_fetch_array($sql1)){
	echo '<rdfs:label> Descrição RDF de '.$row['nome_civil'].'</rdfs:label>';
	echo '<dc:creator rdf:resource="'.$site.'/content/foaf.rdf" />';
	echo '<dc:publisher rdf:resource="'.$site.'/content/foaf.rdf" />';
	echo '<dc:created>2010-12-02</dc:created>';
	echo '<dc:rights rdf:resource="'.$site.'" />';
	echo '<dcterms:language>pt-br</dcterms:language>';
	echo '<foaf:primaryTopic rdf:resource="'.$site.'/resource/'.$id_politico.'/html " />';

	echo "<foaf:name>".$row['nome_civil']."</foaf:name>";
	
	if ($row['foto'] <> '' || $row['foto'] <> NULL)	
		echo '<foaf:img rdf:resource="'.$site.'/'.$row['foto'].'"/>';
		
	if ($row['nome_parlamentar'] <> '' AND $row['nome_parlamentar'] <> NULL)					
		echo '<polbr:governmentalName>'.$row['nome_parlamentar'].'</polbr:governmentalName>';		
		
	if ($row['situacao'] <> '' AND $row['situacao'] <> NULL)	
		echo '<polbr:situation>'.$row['situacao'].'</polbr:situation>';
		
	if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)	
		echo '<pol:Office>'.$row['cargo'].'</pol:Office>';
		
	if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL AND $row['cargo_uf'] <> 'BR')
		echo '<polbr:officeState>'.$row['cargo_uf'].'</polbr:officeState>';
		
	if ($row['partido'] <> '' AND $row['partido'] <> NULL){
		echo '<pol:party>'.$row['partido'].'</pol:party>';	
		$sql20 = mysql_query("SELECT * FROM linkrdf_partido WHERE partido = '$row[partido]'");
		$cont20 = mysql_numrows($sql20);
		if ($cont20 > 0){
			while ($row20 = mysql_fetch_array($sql20))
				echo '<pol:party rdf:resource="'.$row20['uri'].'" />';
		}
	
	}
	if ($row['data_nascimento'] <> '' AND $row['data_nascimento'] <> NULL){		
		$data_nascimento = date('d/m/Y', strtotime($row['data_nascimento']));
		echo '<foaf:birthday>'.$data_nascimento.'</foaf:birthday>';
	}
	
	if ($row['nome_pai'] <> '' AND $row['nome_pai'] <> NULL)	
		echo '<bio:father>'.$row['nome_pai'].'</bio:father>';
		
	if ($row['nome_mae'] <> '' AND $row['nome_mae'] <> NULL)	
		echo '<bio:mother>'.$row['nome_mae'].'</bio:mother>';
		
	if ($row['sexo'] <> '' AND $row['sexo'] <> NULL)		
		echo '<foaf:gender>'.$row['sexo'].'</foaf:gender>';
		
	if ($row['cor'] <> '' AND $row['cor'] <> NULL)	
		echo '<person:complexion>'.$row['cor']."</person:complexion>";
		
	if ($row['estado_civil'] <> '' AND $row['estado_civil'] <> NULL)	
		echo '<polbr:maritalStatus>'.$row['estado_civil'].'</polbr:maritalStatus>';
		
	if ($row['ocupacao'] <> '' AND $row['ocupacao'] <> NULL){	
		$sql18 = mysql_query("SELECT * FROM linkrdf_occupation WHERE ocupacao = '$row[ocupacao]'");
		$cont18 = mysql_numrows($sql18);
		if ($cont18 > 0){
			while ($row18 = mysql_fetch_array($sql18))
				echo '<person:occupation rdf:resource="'.$row18['uri'].'" />';
		}
		else{
			echo '<person:occupation>'.$row['ocupacao'].'</person:occupation>';
		}
	}
	if ($row['grau_instrucao'] <> '' AND $row['grau_instrucao'] <> NULL)	
		echo '<dcterms:educationLevel>'.$row['grau_instrucao'].'</dcterms:educationLevel>';
		
	if ($row['nacionalidade'] <> '' AND $row['nacionalidade'] <> NULL)	
		echo '<dbpprop:nationality>'.$row['nacionalidade'].'</dbpprop:nationality>';
		
	if ($row['cidade_nascimento'] <> '' AND $row['cidade_nascimento'] <> NULL){
		echo '<being:place-of-birth>'.$row['cidade_nascimento'].'</being:place-of-birth>';
		$sql15 = mysql_query("SELECT * FROM linkrdf_cidades WHERE cidade = '$row[cidade_nascimento]'");
		$cont15 = mysql_numrows($sql15);
		if ($cont15 > 0){
			while ($row15 = mysql_fetch_array($sql15))
				echo '<being:place-of-birth rdf:resource="'.$row15['uri'].'" />';
		}
	}
	if ($row['estado_nascimento'] <> '' AND $row['estado_nascimento'] <> NULL){	
		$sql20 = mysql_query("SELECT * FROM linkrdf_cidades WHERE cidade = '$row[estado_nascimento]'");
		$cont20 = mysql_numrows($sql20);
		if ($cont20 > 0){
			while ($row20 = mysql_fetch_array($sql20))
				echo '<polbr:state-of-birth rdf:resource="'.$row20['uri'].'" />';
		}
		else
			echo '<polbr:state-of-birth>'.$row['estado_nascimento'].'</polbr:state-of-birth>';
	
	}
	if (($row['cidade_eleitoral'] <> '' AND $row['cidade_eleitoral'] <> NULL) || ($row['estado_eleitoral'] <> '' AND $row['estado_eleitoral'] <> NULL))	 
		echo '<polbr:place-of-vote>'.$row['cidade_eleitoral'].' - '.$row['estado_eleitoral'].'</polbr:place-of-vote>';
		
	if ($row['email'] <> '' AND $row['email'] <> NULL)	
		echo '<biblio:Email>'.$row['email'].'</biblio:Email>';
		
	if ($row['site'] <> '' AND $row['site'] <> NULL)
		echo '<foaf:homepage rdf:resource="'.$row['site'].'" />'; 

}

$sql2 = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$id_politico'");
$cont2 = mysql_num_rows($sql2);

if ($cont2 > 0){	

	$sql2b = mysql_query("SELECT ano FROM declaracao_bens WHERE id_politico = '$id_politico'");

	while($row1 = mysql_fetch_array($sql2b)){	
	
		$ano = $row1['ano'] ;
		$sql2a = mysql_query("SELECT SUM(valor) AS soma FROM declaracao_bens WHERE id_politico = '$recurso' and ano = '$ano'");
		while($row2a = mysql_fetch_array($sql2a))
			$soma = $row2a['soma'];			
		$conta_declaracao = 1;


		echo "<polbr:declarationOfAssets rdf:parseType='Resource'>";
		echo "<timeline:atYear>".$ano."</timeline:atYear>";   	
		echo "<polbr:DeclarationOfAssets>";

		$sql2c = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$id_politico' and ano = '$ano' ");

		while($row = mysql_fetch_array($sql2c)){
		
			echo "

			<being:owns>
				<biblio:number>$conta_declaracao</biblio:number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<dcterms:type>".$row['tipo']."</dcterms:type>
				<rdfmoney:Price>".$row['valor']."</rdfmoney:Price>
			</being:owns>";
			$conta_declaracao++;
		}
		echo "<spinrdf:Sum>$soma</spinrdf:Sum>";
		echo "</polbr:DeclarationOfAssets>";
		echo "</polbr:declarationOfAssets>";
	}
}

$sql3 = mysql_query("SELECT * FROM eleicao WHERE id_politico = '$id_politico'");
$cont3 = mysql_num_rows($sql3);

if ($cont3 > 0){
	while($row = mysql_fetch_array($sql3)){
		echo "<polbr:election rdf:parseType='Resource'>";
			echo "<timeline:atYear>".$row['ano']."</timeline:atYear>";
			echo "<foaf:name>".$row['nome_urna']."</foaf:name>";
			echo "<biblio:number>".$row['numero_candidato']."</biblio:number>";
			echo "<pol:party>".$row['partido']."</pol:party>";
			$sql21 = mysql_query("SELECT * FROM linkrdf_partido WHERE partido = '$row[partido]'");
			$cont21 = mysql_numrows($sql21);
			if ($cont21 > 0){
				while ($row21 = mysql_fetch_array($sql21))
					echo '<pol:party rdf:resource="'.$row21['uri'].'" />';
			}
			echo "<pol:Office>".$row['cargo']."</pol:Office>";
			if ($row['cargo_uf'] <> 'BR' AND $row['cargo_uf'] <> '' AND $row['cargo_uf'] <> 'NULL')	
				echo "<geospecies:State>".$row['cargo_uf']."</geospecies:State>";
			if ($row['resultado'] <> '' AND $row['resultado'] <> NULL)					
				echo "<earl:outcome> ".$row['resultado']."</earl:outcome>";					
			if ($row['nome_coligacao'] <> '' AND $row['nome_coligacao'] <> NULL)					
				echo "<spinrdf:Union> ".$row['nome_coligacao']."</spinrdf:Union>";
			if ($row['partidos_coligacao'] <> '' AND $row['partidos_coligacao'] <> NULL)					
				echo "<polbr:unionParties> ".$row['partidos_coligacao']."</polbr:unionParties>";
			echo "<polbr:situation>".$row['situacao_candidatura']."</polbr:situation>";
			echo "<polbr:protocolNumber>".$row['numero_protocolo']."</polbr:protocolNumber>";
			echo "<polbr:processNumber>".$row['numero_processo']."</polbr:processNumber>";
			echo "<polbr:CNPJ>".$row['cnpj_campanha']."</polbr:CNPJ>";
		echo "</polbr:election>";
	}							
}

$sql4 = mysql_query("SELECT * FROM afastamento WHERE id_politico = '$id_politico'");
$cont4 = mysql_num_rows($sql4);

if ($cont4 > 0){
	while($row = mysql_fetch_array($sql4)){	
		echo "<polbr:absence rdf:parseType='Resource'>";
			if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)					
				echo "<pol:Office>".$row['cargo']."</pol:Office>";					
			if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL)				
				echo "<geospecies:State>".$row['cargo_uf']."</geospecies:State>";
			if ($row['data'] <> '' AND $row['data'] <> NULL){		
				$data = date('d/m/Y', strtotime($row['data']));
				echo "<timeline:atDate>".$data."</timeline:atDate>";
			}
			if ($row['tipo'] <> '' AND $row['tipo'] <> NULL)					
				echo "<dcterms:type> ".$row['tipo']."</dcterms:type>";
			if ($row['motivo'] <> '' AND $row['motivo'] <> NULL)					
				echo "<event:fact>".$row['motivo']."</event:fact>";
		echo "</polbr:absence>";	
	}
}

$sql5 = mysql_query("SELECT c.descricao, c.data_inicio, c.data_fim, cp.participacao FROM comissao c JOIN comissao_politico cp ON c.id_comissao = cp.id_comissao WHERE cp.id_politico = '$id_politico'");
$cont5 = mysql_num_rows($sql5);

if ($cont5 <> ''){				
	$conta_comissao = 1;
	while($row = mysql_fetch_array($sql5)){
		echo "<polbr:committee rdf:parseType='Resource'>";
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			echo "
				<biblio:number>$conta_comissao</biblio:number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>";
				if ($data_fim <> '-' AND $data_fim <> '')
					echo "<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>";
				echo "<vcard:role>".$row['participacao']."</vcard:role>
			";
			$conta_comissao++;
		echo "</polbr:committee>";
	}
}

$sql6 = mysql_query("SELECT * FROM endereco_parlamentar_politico WHERE id_politico = '$id_politico'");
$cont6 = mysql_num_rows($sql6);

if ($cont6 > 0){				
	echo "<vcard:adr rdf:parseType='Resource'>";
	while($row = mysql_fetch_array($sql6)){	
		if ($row['anexo'] <> '' AND $row['anexo'] <> NULL)					
			echo "<polbr:annex>".$row['anexo']."</polbr:annex>";					
		if ($row['ala'] <> '' AND $row['ala'] <> NULL)				
			echo "<polbr:wing>".$row['ala']."</polbr:wing>";
		if ($row['gabinete'] <> '' AND $row['gabinete'] <> NULL)		
			echo "<polbr:cabinet>".$row['gabinete']."</polbr:cabinet>";
		if ($row['email'] <> '' AND $row['email'] <> NULL)					
			echo "<biblio:Email>".$row['email']."</biblio:Email>";
		if ($row['telefone'] <> '' AND $row['telefone'] <> NULL)					
			echo "<foaf:phone>".$row['telefone']."</foaf:phone>";
		if ($row['fax'] <> '' AND $row['fax'] <> NULL)					
			echo "<vcard:fax>".$row['fax']."</vcard:fax>";
		$sql7 = mysql_query("SELECT * FROM endereco_parlamentar WHERE id_endereco_parlamentar = '$row[id_endereco_parlamentar]'");
	}	
		
	while($row = mysql_fetch_array($sql7)){
		echo "<po:Place>".$row['tipo']."</po:Place>";
		echo "<vcard:street-address>".$row['rua']."</vcard:street-address>";
		echo "<polbr:district>".$row['bairro']."</polbr:district>";
		echo "<vcard:locality>".$row['cidade']."</vcard:locality>";
		echo "<geospecies:State>".$row['estado']."</geospecies:State>";
		echo "<vcard:postal-code>".$row['CEP']."</vcard:postal-code>";
		echo "<polbr:CNPJ>".$row['CNPJ']."</polbr:CNPJ>";
		echo "<polbr:cabinetphone>".$row['telefone']."</foaf:phone>";
		echo "<polbr:fax>".$row['disque']."</polbr:phone>";
		echo "<foaf:homepage>".$row['site']."</foaf:homepage>";
	}
	echo "</vcard:adr>";
}

$sql8 = mysql_query("SELECT descricao, tipo, data_inicio, data_fim FROM lideranca WHERE id_politico = '$id_politico'");
$cont8 = mysql_num_rows($sql8);

if ($cont8 > 0){
	$conta_lideranca = 1;
	while($row = mysql_fetch_array($sql8)){
		echo "<polbr:leadership rdf:parseType='Resource'>";
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			echo "
				<biblio:Number>$conta_lideranca</biblio:Number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<dcterms:type>".$row['tipo']."</dcterms:type>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>";
				if ($data_fim <> '-' AND $data_fim <> '')
					echo "<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>";
			$conta_lideranca++;
		echo "</polbr:leadership>";
	}
}	

$sql9 = mysql_query("SELECT * FROM mandato WHERE id_politico = '$id_politico'");
$cont9 = mysql_num_rows($sql9);

if ($cont9 > 0){
	$conta_mandato = 1;
	while($row = mysql_fetch_array($sql9)){
		echo "<pol:Term rdf:parseType='Resource'>";
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			echo "
				<biblio:Number>$conta_mandato</biblio:Number>
				<pol:Office>".$row['cargo']."</pol:Office>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>";
				if ($data_fim <> '-' AND $data_fim <> '')
					echo "<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>";
			$conta_mandato++;
		echo "</pol:Term>";
	}
}

$sql10 = mysql_query("SELECT * FROM missao WHERE id_politico = '$id_politico'");
$cont10 = mysql_num_rows($sql10);

if ($cont10 > 0){
	$conta_missao = 1;
	while($row = mysql_fetch_array($sql10)){
		echo "<polbr:mission rdf:parseType='Resource'>";
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			echo "
				<biblio:Number>$conta_missao</biblio:Number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<dcterms:type>".$row['tipo']."</dcterms:type>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>";
				if ($data_fim <> '-' AND $data_fim <> '')
					echo "<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>";
				echo "<foaf:Document>".$row['documento']."</foaf:Document>";
			$conta_missao++;
		echo "</polbr:mission>";
	}
}

$sql11 = mysql_query("SELECT * FROM proposicao WHERE id_politico = '$id_politico'");
$cont11 = mysql_num_rows($sql11);

if ($cont11 <> ''){
	$conta_proposicao = 1;
	while($row = mysql_fetch_array($sql11)){
		echo "<polbr:proposition rdf:parseType='Resource'>";
			$data = date('d/m/Y', strtotime($row['data']));
			if ($data == '01/01/1970')
				$data = '-';
			echo "
				<dc:title>".$row['titulo']."</dc:title>";
			if ($data <> '' AND $data <> '-')	
				echo "<timeline:atDate>".$data."</timeline:atDate>";
			echo "
				<po:Place>".$row['casa']."</po:Place>
				<biblio:Number>".$row['numero']."</biblio:Number>
				<dcterms:type>".$row['tipo']."</dcterms:type>
                                <polbr:description>".$row['descricao_tipo']."</dcterms:description>
				<dcterms:description>".$row['ementa']."</dcterms:description>";
			$conta_proposicao++;
		echo "</polbr:proposition>";
	}
}		


$sql12 = mysql_query("SELECT * FROM pronunciamento WHERE id_politico = '$id_politico'");
$cont12 = mysql_num_rows($sql12);

if ($cont12 <> ''){
	$conta_pronunciamento = 1;
	while($row = mysql_fetch_array($sql12)){
		echo "<biblio:Speech rdf:parseType='Resource'>";
			$data = date('d/m/Y', strtotime($row['data']));
			if ($data == '01/01/1970')
				$data = '-';
		
			echo "
				<biblio:Number>$conta_pronunciamento</biblio:Number>
				<dcterms:type>".$row['tipo']."</dcterms:type>";
				if ($data <> '' AND $data <> '-')	
					echo "<timeline:atDate>".$data."</timeline:atDate>";
				echo "
				<po:Place>".$row['casa']."</po:Place>
				<pol:party>".$row['partido']."</pol:party>";
				$sql22 = mysql_query("SELECT * FROM linkrdf_partido WHERE partido = '$row[partido]'");
				$cont22 = mysql_numrows($sql22);
				if ($cont22 > 0){
					while ($row22 = mysql_fetch_array($sql22))
						echo '<pol:party rdf:resource="'.$row22['uri'].'" />';
				}
				echo "<geospecies:State>".$row['uf']."</geospecies:State>
				<biblio:abstract>".$row['resumo']."</biblio:abstract>";
		echo "</biblio:Speech>";
	}
}


echo '<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Thing"/>';

echo '<rdf:type rdf:resource="http://dbpedia.org/class/yago/LivingPeople"/>';
echo '<rdf:type rdf:resource="http://dbpedia.org/ontology/Person"/>';
echo '<rdf:type rdf:resource="http://dbpedia.org/ontology/Politician"/>';
echo '<rdf:type rdf:resource="http://dbpedia.org/class/yago/BrazilianPoliticians"/>';
echo '<skos:subject rdf:resource="http://dbpedia.org/resource/Category:Brazilian_politicians"/>';
echo '<skos:subject rdf:resource="http://dbpedia.org/resource/Category:Living_people"/>';
echo '<skos:subject rdf:resource="http://dbpedia.org/resource/Category:Brazilian_politicians"/>';

echo '<vcard:country-name>Brazil</vcard:country-name>';
echo '<vcard:country-name rdf:resource="http://rdf.freebase.com/ns/en.brazil" />';
echo '<vcard:country-name rdf:resource="http://www4.wiwiss.fu-berlin.de/factbook/resource/Brazil" />';
echo '<vcard:country-name rdf:resource="http://dbpedia.org/resource/Brazil" />';	
	
	
$sql14 = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$id_politico' AND tipo='page'");
$cont14 = mysql_numrows($sql14);

if ($cont14 > 0){
	while ($row14 = mysql_fetch_array($sql14)){
		echo '<foaf:page rdf:resource="'.$row14['uri'].'" />';
	}
}

$sql17 = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$id_politico' AND tipo='seealso'");
$cont17 = mysql_numrows($sql17);

if ($cont14 > 0){
	while ($row17 = mysql_fetch_array($sql17)){
		echo '<rdfs:seeAlso rdf:resource="'.$row17['uri'].'" />';
	}
}

$sql13 = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$id_politico' AND tipo='sameas'");
$cont13 = mysql_num_rows($sql13);

if ($cont13 > 0){
	while ($row13 = mysql_fetch_array($sql13)){
		echo '<owl:sameAs rdf:resource="'.$row13['uri'].'" />'; 
	}
}
echo '</rdf:Description>';
echo '</rdf:RDF>';

?>
