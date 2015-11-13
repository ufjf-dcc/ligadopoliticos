<?php

$fp = fopen("./politicos.rdf", "w");
$conexao = mysql_connect("localhost","root","123"); 
if(!$conexao){
    		die('Não foi possível conectar: ' . mysql_error());
	}
	
	mysql_select_db("politicos_brasileiros", $conexao);
	mysql_set_charset("utf8");

header ("content-type: application/rdf+xml");

$site = 'http://ligadonospoliticos.com.br';
//$recurso = $_SERVER ['REQUEST_URI'];
//$parte_endereco = explode('/',$recurso);
//$tamanho = count($parte_endereco);
//$id_politico = $parte_endereco[$tamanho-3];
//$id_politico = $parte_endereco[3];

fwrite($fp,'<?xml version="1.0"?>'); 
fwrite($fp,'<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" 
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
			   xmlns:polbr="http://ligadonospoliticos.com.br/politicobr#"
			   xmlns:owl="http://www.w3.org/2002/07/owl#"
			   xmlns:skos="http://www.w3.org/2004/02/skos/core#"
			   xmlns:rdfmoney="http://www.purl.org/net/rdf-money/"
			   xmlns:geospecies="http://rdf.geospecies.org/ont/geospecies#"
			   xmlns:earl="http://www.w3.org/ns/earl#"
			   xmlns:spinrdf="http://spinrdf.org/sp#"
			   xmlns:event="http://purl.org/NET/c4dm/event.owl#"
			   xmlns:po="http://purl.org/ontology/po"
		>');
$id_politicos_validos = mysql_query("select p.id_politico as ids from politico p");
while ($ids_politicos = mysql_fetch_array($id_politicos_validos))
{ 
    //quantidade total de politicos
   //if($ids_politicos['ids'] >=  0 && $ids_politicos['ids'] < 500){
$id_politico = $ids_politicos['ids'];

fwrite($fp,'<rdf:Description rdf:about="http://ligadonospoliticos.com.br/politico/'.$id_politico.'" >');
	
$sql1 = mysql_query("SELECT * FROM politico WHERE id_politico = '$id_politico'");
while($row = mysql_fetch_array($sql1)){
	fwrite($fp,'<rdfs:label>Descrição RDF de '.$row['nome_civil'].'</rdfs:label>');
	fwrite($fp,'<dc:creator rdf:resource="'.$site.'/content/foaf.rdf" />');
	fwrite($fp,'<dc:publisher rdf:resource="'.$site.'/content/foaf.rdf" />');
	fwrite($fp,'<dc:created>2010-12-02</dc:created>');
	fwrite($fp,'<dc:rights rdf:resource="'.$site.'" />');
	fwrite($fp,'<dcterms:language>pt-br</dcterms:language>');
	fwrite($fp,'<foaf:primaryTopic rdf:resource="'.$site.'/resource/'.$id_politico.'/html " />');

	fwrite($fp,"<foaf:name>".$row['nome_civil']."</foaf:name>");
	
	if ($row['foto'] <> '' || $row['foto'] <> NULL)	
		fwrite($fp,'<foaf:img rdf:resource="'.$site.'/'.$row['foto'].'"/>');
		
	if ($row['nome_parlamentar'] <> '' AND $row['nome_parlamentar'] <> NULL)					
		fwrite($fp,'<polbr:governmentalName>'.$row['nome_parlamentar'].'</polbr:governmentalName>');		
		
	if ($row['situacao'] <> '' AND $row['situacao'] <> NULL)	
		fwrite($fp,'<polbr:situation>'.$row['situacao'].'</polbr:situation>');
		
	if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)	
		fwrite($fp,'<pol:Office>'.$row['cargo'].'</pol:Office>');
		
	if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL AND $row['cargo_uf'] <> 'BR')
		fwrite($fp,'<polbr:officeState>'.$row['cargo_uf'].'</polbr:officeState>');
		
	if ($row['partido'] <> '' AND $row['partido'] <> NULL){
		fwrite($fp,'<pol:party>'.$row['partido'].'</pol:party>');	
		$sql20 = mysql_query("SELECT * FROM linkrdf_partido WHERE partido = '$row[partido]'");
		$cont20 = mysql_numrows($sql20);
		if ($cont20 > 0){
			while ($row20 = mysql_fetch_array($sql20))
				fwrite($fp,'<pol:party rdf:resource="'.$row20['uri'].'" />');
		}
	
	}
	if ($row['data_nascimento'] <> '' AND $row['data_nascimento'] <> NULL){		
		$data_nascimento = date('d/m/Y', strtotime($row['data_nascimento']));
		fwrite($fp,'<foaf:birthday>'.$data_nascimento.'</foaf:birthday>');
	}
	
	if ($row['nome_pai'] <> '' AND $row['nome_pai'] <> NULL)	
		fwrite($fp,'<bio:father>'.$row['nome_pai'].'</bio:father>');
		
	if ($row['nome_mae'] <> '' AND $row['nome_mae'] <> NULL)	
		fwrite($fp,'<bio:mother>'.$row['nome_mae'].'</bio:mother>');
		
	if ($row['sexo'] <> '' AND $row['sexo'] <> NULL)		
		fwrite($fp,'<foaf:gender>'.strtoupper($row['sexo']).'</foaf:gender>');
		
	if ($row['cor'] <> '' AND $row['cor'] <> NULL)	
		fwrite($fp,'<person:complexion>'.$row['cor']."</person:complexion>");
		
	if ($row['estado_civil'] <> '' AND $row['estado_civil'] <> NULL)	
		fwrite($fp,'<polbr:maritalStatus>'.$row['estado_civil'].'</polbr:maritalStatus>');
		
	if ($row['ocupacao'] <> '' AND $row['ocupacao'] <> NULL){	
                fwrite($fp,'<person:occupation>'.$row['ocupacao'].'</person:occupation>');
		$sql18 = mysql_query("SELECT * FROM linkrdf_occupation WHERE ocupacao = '$row[ocupacao]'");
		$cont18 = mysql_numrows($sql18);
		if ($cont18 > 0){
			while ($row18 = mysql_fetch_array($sql18))
				fwrite($fp,'<person:occupation rdf:resource="'.$row18['uri'].'" />');
		}
	}
	if ($row['grau_instrucao'] <> '' AND $row['grau_instrucao'] <> NULL)	
		fwrite($fp,'<dcterms:educationLevel>'.$row['grau_instrucao'].'</dcterms:educationLevel>');
		
	if ($row['nacionalidade'] <> '' AND $row['nacionalidade'] <> NULL)	
		fwrite($fp,'<dbpprop:nationality>'.$row['nacionalidade'].'</dbpprop:nationality>');
		
	if ($row['cidade_nascimento'] <> '' AND $row['cidade_nascimento'] <> NULL){
		fwrite($fp,'<being:place-of-birth>'.$row['cidade_nascimento'].'</being:place-of-birth>');
		$sql15 = mysql_query("SELECT * FROM linkrdf_cidades WHERE cidade = '$row[cidade_nascimento]'");
		$cont15 = mysql_numrows($sql15);
		if ($cont15 > 0){
			while ($row15 = mysql_fetch_array($sql15))
				fwrite($fp,'<being:place-of-birth rdf:resource="'.$row15['uri'].'" />');
		}
	}
	if ($row['estado_nascimento'] <> '' AND $row['estado_nascimento'] <> NULL){	
                fwrite($fp,'<polbr:state-of-birth>'.$row['estado_nascimento'].'</polbr:state-of-birth>');
		$sql20 = mysql_query("SELECT * FROM linkrdf_cidades WHERE cidade = '$row[estado_nascimento]'");
		$cont20 = mysql_numrows($sql20);
		if ($cont20 > 0){
			while ($row20 = mysql_fetch_array($sql20))
				fwrite($fp,'<polbr:state-of-birth rdf:resource="'.$row20['uri'].'" />');
		}
	}
	if (($row['cidade_eleitoral'] <> '' AND $row['cidade_eleitoral'] <> NULL) || ($row['estado_eleitoral'] <> '' AND $row['estado_eleitoral'] <> NULL))	 
		fwrite($fp,'<polbr:place-of-vote>'.$row['cidade_eleitoral'].' - '.$row['estado_eleitoral'].'</polbr:place-of-vote>');
		
	if ($row['email'] <> '' AND $row['email'] <> NULL)	
		fwrite($fp,'<biblio:Email>'.$row['email'].'</biblio:Email>');
		
	if ($row['site'] <> '' AND $row['site'] <> NULL)
		fwrite($fp,'<foaf:homepage rdf:resource="'.$row['site'].'" />'); 

}

$sql2 = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$id_politico'");
$cont2 = mysql_num_rows($sql2);

if ($cont2 > 0){	

	$sql2b = mysql_query("SELECT ano FROM declaracao_bens WHERE id_politico = '$id_politico'");

        $row1 = mysql_fetch_array($sql2b);
	// repete o while 12x pois em declação de bens possui 12 declarações de bens teria q pegar apenas 2010 uma vez
        //while($row1 = mysql_fetch_array($sql2b)){	
	
		$ano = $row1['ano'] ;
		$sql2a = mysql_query("SELECT SUM(valor) AS soma FROM declaracao_bens WHERE id_politico = '$recurso' and ano = '$ano'");
		while($row2a = mysql_fetch_array($sql2a))
			$soma = $row2a['soma'];			
		$conta_declaracao = 1;


		fwrite($fp,"<polbr:declarationOfAssets rdf:parseType='Resource'>");
		fwrite($fp,"<timeline:atYear>".$ano."</timeline:atYear>");   	
		fwrite($fp,"<polbr:DeclarationOfAssets>");

		$sql2c = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$id_politico' and ano = '$ano' ");

		while($row = mysql_fetch_array($sql2c)){
		
			fwrite($fp,"

			<being:owns>
				<biblio:number>$conta_declaracao</biblio:number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<dcterms:type>".$row['tipo']."</dcterms:type>
				<rdfmoney:Price>".$row['valor']."</rdfmoney:Price>
			</being:owns>");
			$conta_declaracao++;
		}
		fwrite($fp,"</polbr:DeclarationOfAssets>");
		fwrite($fp,"</polbr:declarationOfAssets>");
	//}
}

$sql3 = mysql_query("SELECT * FROM eleicao WHERE id_politico = '$id_politico'");
$cont3 = mysql_num_rows($sql3);

if ($cont3 > 0){
	while($row = mysql_fetch_array($sql3)){
		fwrite($fp,"<polbr:election rdf:parseType='Resource'>");
			fwrite($fp,"<timeline:atYear>".$row['ano']."</timeline:atYear>");
			fwrite($fp,"<foaf:name>".$row['nome_urna']."</foaf:name>");
			fwrite($fp,"<biblio:number>".$row['numero_candidato']."</biblio:number>");
			fwrite($fp,"<pol:party>".$row['partido']."</pol:party>");
			$sql21 = mysql_query("SELECT * FROM linkrdf_partido WHERE partido = '$row[partido]'");
			$cont21 = mysql_numrows($sql21);
			if ($cont21 > 0){
				while ($row21 = mysql_fetch_array($sql21))
					fwrite($fp,'<pol:party rdf:resource="'.$row21['uri'].'" />');
			}
			fwrite($fp,"<pol:Office>".$row['cargo']."</pol:Office>");
			if ($row['cargo_uf'] <> 'BR' AND $row['cargo_uf'] <> '' AND $row['cargo_uf'] <> 'NULL')	
				fwrite($fp,"<geospecies:State>".$row['cargo_uf']."</geospecies:State>");
			if ($row['resultado'] <> '' AND $row['resultado'] <> NULL)					
				fwrite($fp,"<earl:outcome>".$row['resultado']."</earl:outcome>");					
			if ($row['nome_coligacao'] <> '' AND $row['nome_coligacao'] <> NULL)					
				fwrite($fp,"<spinrdf:Union> ".$row['nome_coligacao']."</spinrdf:Union>");
			if ($row['partidos_coligacao'] <> '' AND $row['partidos_coligacao'] <> NULL)					
				fwrite($fp,"<polbr:unionParties> ".$row['partidos_coligacao']."</polbr:unionParties>");
			fwrite($fp,"<polbr:situation>".$row['situacao_candidatura']."</polbr:situation>");
			fwrite($fp,"<polbr:protocolNumber>".$row['numero_protocolo']."</polbr:protocolNumber>");
			fwrite($fp,"<polbr:processNumber>".$row['numero_processo']."</polbr:processNumber>");
			fwrite($fp,"<polbr:CNPJ>".$row['cnpj_campanha']."</polbr:CNPJ>");
		fwrite($fp,"</polbr:election>");
	}							
}
else if($cont3 == 0){
    $sql1 = mysql_query("SELECT * FROM politico WHERE id_politico = '$id_politico'");
    while($row = mysql_fetch_array($sql1)){
        fwrite($fp,"<polbr:election rdf:parseType='Resource'>");
        fwrite($fp,"<timeline:atYear>2010</timeline:atYear>");
        if($row['partido'] == NULL || $row['partido'] == '')
            $row['partido'] = 'S/ Partido';
        fwrite($fp,"<pol:party>".$row['partido']."</pol:party>");
        if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)
            fwrite($fp,"<pol:Office>".$row['cargo']."</pol:Office>");
        if ($row['cargo_uf'] <> 'BR' AND $row['cargo_uf'] <> '' AND $row['cargo_uf'] <> 'NULL')
                fwrite($fp, "<geospecies:State>" . $row['cargo_uf'] . "</geospecies:State>");
        }
        fwrite($fp,"</polbr:election>");
}

$sql4 = mysql_query("SELECT * FROM afastamento WHERE id_politico = '$id_politico'");
$cont4 = mysql_num_rows($sql4);

if ($cont4 > 0){
	while($row = mysql_fetch_array($sql4)){	
		fwrite($fp,"<polbr:absence rdf:parseType='Resource'>");
			if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)					
				fwrite($fp,"<pol:Office>".$row['cargo']."</pol:Office>");					
			if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL)				
				fwrite($fp,"<geospecies:State>".$row['cargo_uf']."</geospecies:State>");
			if ($row['data'] <> '' AND $row['data'] <> NULL){		
				$data = date('d/m/Y', strtotime($row['data']));
				fwrite($fp,"<timeline:atDate>".$data."</timeline:atDate>");
			}
			if ($row['tipo'] <> '' AND $row['tipo'] <> NULL)					
				fwrite($fp,"<dcterms:type> ".$row['tipo']."</dcterms:type>");
			if ($row['motivo'] <> '' AND $row['motivo'] <> NULL)					
				fwrite($fp,"<event:fact>".$row['motivo']."</event:fact>");
		fwrite($fp,"</polbr:absence>");	
	}
}

$sql5 = mysql_query("SELECT c.descricao, c.data_inicio, c.data_fim, cp.participacao FROM comissao c JOIN comissao_politico cp ON c.id_comissao = cp.id_comissao WHERE cp.id_politico = '$id_politico'");
$cont5 = mysql_num_rows($sql5);

if ($cont5 <> ''){				
	$conta_comissao = 1;
	while($row = mysql_fetch_array($sql5)){
		fwrite($fp,"<polbr:committee rdf:parseType='Resource'>");
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			fwrite($fp,"
				<biblio:number>$conta_comissao</biblio:number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>");
				if ($data_fim <> '-' AND $data_fim <> '')
					fwrite($fp,"<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>");
				fwrite($fp,"<vcard:role>".$row['participacao']."</vcard:role>
			");
			$conta_comissao++;
		fwrite($fp,"</polbr:committee>");
	}
}

$sql6 = mysql_query("SELECT * FROM endereco_parlamentar_politico WHERE id_politico = '$id_politico'");
$cont6 = mysql_num_rows($sql6);

if ($cont6 > 0){				
	fwrite($fp,"<vcard:adr rdf:parseType='Resource'>");
	while($row = mysql_fetch_array($sql6)){	
		if ($row['anexo'] <> '' AND $row['anexo'] <> NULL)					
			fwrite($fp,"<polbr:annex>".$row['anexo']."</polbr:annex>");					
		if ($row['ala'] <> '' AND $row['ala'] <> NULL)				
			fwrite($fp,"<polbr:wing>".$row['ala']."</polbr:wing>");
		if ($row['gabinete'] <> '' AND $row['gabinete'] <> NULL)		
			fwrite($fp,"<polbr:cabinet>".$row['gabinete']."</polbr:cabinet>");
		if ($row['email'] <> '' AND $row['email'] <> NULL)					
			fwrite($fp,"<biblio:Email>".$row['email']."</biblio:Email>");
		if ($row['telefone'] <> '' AND $row['telefone'] <> NULL)					
			fwrite($fp,"<foaf:phone>".$row['telefone']."</foaf:phone>");
		if ($row['fax'] <> '' AND $row['fax'] <> NULL)					
			fwrite($fp,"<vcard:fax>".$row['fax']."</vcard:fax>");
		$sql7 = mysql_query("SELECT * FROM endereco_parlamentar WHERE id_endereco_parlamentar = ".$row['id_endereco_parlamentar']);
	}	
		
	while($row = mysql_fetch_array($sql7)){
		fwrite($fp,"<po:Place>".$row['tipo']."</po:Place>");
		fwrite($fp,"<vcard:street-address>".$row['rua']."</vcard:street-address>");
		fwrite($fp,"<polbr:district>".$row['bairro']."</polbr:district>");
		fwrite($fp,"<vcard:locality>".$row['cidade']."</vcard:locality>");
		fwrite($fp,"<geospecies:State>".$row['estado']."</geospecies:State>");
		fwrite($fp,"<vcard:postal-code>".$row['CEP']."</vcard:postal-code>");
		fwrite($fp,"<polbr:CNPJ>".$row['CNPJ']."</polbr:CNPJ>");
		fwrite($fp,"<polbr:cabinetphone>".$row['telefone']."</polbr:cabinetphone>");
		fwrite($fp,"<polbr:fax>".$row['disque']."</polbr:fax>");
		fwrite($fp,"<foaf:homepage>".$row['site']."</foaf:homepage>");
	}
	fwrite($fp,"</vcard:adr>");
}

$sql8 = mysql_query("SELECT descricao, tipo, data_inicio, data_fim FROM lideranca WHERE id_politico = '$id_politico'");
$cont8 = mysql_num_rows($sql8);

if ($cont8 > 0){
	$conta_lideranca = 1;
	while($row = mysql_fetch_array($sql8)){
                    fwrite($fp,"<polbr:leadership rdf:parseType='Resource'>");
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			fwrite($fp,"
				<biblio:Number>$conta_lideranca</biblio:Number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<dcterms:type>".$row['tipo']."</dcterms:type>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>");
				if ($data_fim <> '-' AND $data_fim <> '')
					fwrite($fp,"<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>");
			$conta_lideranca++;
		fwrite($fp,"</polbr:leadership>");
	}
}	

$sql9 = mysql_query("SELECT * FROM mandato WHERE id_politico = '$id_politico'");
$cont9 = mysql_num_rows($sql9);

if ($cont9 > 0){
	$conta_mandato = 1;
	while($row = mysql_fetch_array($sql9)){
		fwrite($fp,"<pol:Term rdf:parseType='Resource'>");
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			fwrite($fp,"
				<biblio:Number>$conta_mandato</biblio:Number>
				<pol:Office>".$row['cargo']."</pol:Office>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>");
				if ($data_fim <> '-' AND $data_fim <> '')
					fwrite($fp,"<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>");
			$conta_mandato++;
		fwrite($fp,"</pol:Term>");
	}
}

$sql10 = mysql_query("SELECT * FROM missao WHERE id_politico = '$id_politico'");
$cont10 = mysql_num_rows($sql10);

if ($cont10 > 0){
	$conta_missao = 1;
	while($row = mysql_fetch_array($sql10)){
		fwrite($fp,"<polbr:mission rdf:parseType='Resource'>");
			$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
			$data_fim = date('d/m/Y', strtotime($row['data_fim']));
			if ($data_fim == '01/01/1970')
				$data_fim = '-';
		
			fwrite($fp,"
				<biblio:Number>$conta_missao</biblio:Number>
				<dcterms:description>".$row['descricao']."</dcterms:description>
				<dcterms:type>".$row['tipo']."</dcterms:type>
				<timeline:beginsAtDateTime>".$data_inicio."</timeline:beginsAtDateTime>");
				if ($data_fim <> '-' AND $data_fim <> '')
					fwrite($fp,"<timeline:endsAtDateTime>".$data_fim."</timeline:endsAtDateTime>");
				fwrite($fp,"<foaf:Document>".$row['documento']."</foaf:Document>");
			$conta_missao++;
                fwrite($fp,"</polbr:mission>");
	}
}

$sql11 = mysql_query("SELECT * FROM proposicao WHERE id_politico = '$id_politico'");
$cont11 = mysql_num_rows($sql11);

if ($cont11 <> ''){
	$conta_proposicao = 1;
	while($row = mysql_fetch_array($sql11)){
		fwrite($fp,"<polbr:proposition rdf:parseType='Resource'>");
			$data = date('d/m/Y', strtotime($row['data']));
			if ($data == '01/01/1970')
				$data = '-';
			fwrite($fp,"
				<dc:title>".$row['titulo']."</dc:title>");
			if ($data <> '' AND $data <> '-')	
				fwrite($fp,"<timeline:atDate>".$data."</timeline:atDate>");
			fwrite($fp,"
				<po:Place>".$row['casa']."</po:Place>
				<biblio:Number>".$row['numero']."</biblio:Number>
				<dcterms:type>".$row['tipo']."</dcterms:type>
                                <polbr:description>".$row['descricao_tipo']."</polbr:description>
				<dcterms:description>".$row['ementa']."</dcterms:description>");
			$conta_proposicao++;
		fwrite($fp,"</polbr:proposition>");
	}
}		


$sql12 = mysql_query("SELECT * FROM pronunciamento WHERE id_politico = '$id_politico'");
$cont12 = mysql_num_rows($sql12);

if ($cont12 <> ''){
	$conta_pronunciamento = 1;
	while($row = mysql_fetch_array($sql12)){
                fwrite($fp,"<biblio:Speech rdf:parseType='Resource'>");
			$data = date('d/m/Y', strtotime($row['data']));
			if ($data == '01/01/1970')
				$data = '-';
		
			fwrite($fp,"
				<biblio:Number>$conta_pronunciamento</biblio:Number>
				<dcterms:type>".$row['tipo']."</dcterms:type>");
				if ($data <> '' AND $data <> '-')	
					fwrite($fp,"<timeline:atDate>".$data."</timeline:atDate>");
				fwrite($fp,"
				<po:Place>".$row['casa']."</po:Place>
				<pol:party>".$row['partido']."</pol:party>");
				$sql22 = mysql_query("SELECT * FROM linkrdf_partido WHERE partido = '$row[partido]'");
				$cont22 = mysql_numrows($sql22);
				if ($cont22 > 0){
					while ($row22 = mysql_fetch_array($sql22))
						fwrite($fp,'<pol:party rdf:resource="'.$row22['uri'].'" />');
				}
				fwrite($fp,"<geospecies:State>".$row['uf']."</geospecies:State>
				<biblio:abstract>".$row['resumo']."</biblio:abstract>");
		fwrite($fp,"</biblio:Speech>");
	}
}


fwrite($fp,'<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Thing"/>');

fwrite($fp,'<rdf:type rdf:resource="http://dbpedia.org/class/yago/LivingPeople"/>');
fwrite($fp,'<rdf:type rdf:resource="http://dbpedia.org/ontology/Person"/>');
fwrite($fp,'<rdf:type rdf:resource="http://dbpedia.org/ontology/Politician"/>');
fwrite($fp,'<rdf:type rdf:resource="http://dbpedia.org/class/yago/BrazilianPoliticians"/>');
fwrite($fp,'<skos:subject rdf:resource="http://dbpedia.org/resource/Category:Brazilian_politicians"/>');
fwrite($fp,'<skos:subject rdf:resource="http://dbpedia.org/resource/Category:Living_people"/>');
fwrite($fp,'<skos:subject rdf:resource="http://dbpedia.org/resource/Category:Brazilian_politicians"/>');

fwrite($fp,'<vcard:country-name>Brazil</vcard:country-name>');
fwrite($fp,'<vcard:country-name rdf:resource="http://rdf.freebase.com/ns/en.brazil" />');
fwrite($fp,'<vcard:country-name rdf:resource="http://www4.wiwiss.fu-berlin.de/factbook/resource/Brazil" />');
fwrite($fp,'<vcard:country-name rdf:resource="http://dbpedia.org/resource/Brazil" />');	
	
	
$sql14 = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$id_politico' AND tipo='page'");
$cont14 = mysql_numrows($sql14);

if ($cont14 > 0){
	while ($row14 = mysql_fetch_array($sql14)){
		fwrite($fp,'<foaf:page rdf:resource="'.$row14['uri'].'" />');
	}
}

$sql17 = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$id_politico' AND tipo='seealso'");
$cont17 = mysql_numrows($sql17);

if ($cont14 > 0){
	while ($row17 = mysql_fetch_array($sql17)){
		fwrite($fp,'<rdfs:seeAlso rdf:resource="'.$row17['uri'].'" />');
	}
}

$sql13 = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$id_politico' AND tipo='sameas'");
$cont13 = mysql_num_rows($sql13);

if ($cont13 > 0){
	while ($row13 = mysql_fetch_array($sql13)){
		fwrite($fp,'<owl:sameAs rdf:resource="'.$row13['uri'].'" />'); 
	}
}
fwrite($fp,'</rdf:Description>');
    
        }
fwrite($fp,'</rdf:RDF>');
fclose($fp);

echo "ACABOU";
?>
