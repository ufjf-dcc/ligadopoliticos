<?php

include 'properties.php';
include './consultasSPARQL.php';	
$recurso = 1;	
$sparql1 = consultaSPARQL('
            select  ?nome_civil ?nome_parlamentar ?nome_pai ?nome_mae ?foto ?sexo ?cor ?data_nascimento ?estado_civil ?ocupacao ?grau_instrucao ?nacionalidade
            ?cidade_nascimento ?estado_nascimento ?cidade_eleitoral ?estado_eleitoral ?site ?email ?cargo ?cargo_uf ?partido ?situacao
            where {
              <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:name ?nome_civil .
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:governmentalName ?nome_parlamentar }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> bio:father ?nome_pai }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> bio:father ?nome_mae }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:img ?foto }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:gender ?sexo }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> person:complexion ?cor }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:birthday ?data_nascimento }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:maritalStatus ?estado_civil }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> person:occupation ?ocupacao }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> dcterms:educationLevel ?grau_instrucao }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> dbpprop:nationality ?nacionalidade }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> being:place-of-birth ?cidade_nascimento }. 
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:state-of-birth ?estado_nascimento }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:place-of-vote ?cidade_eleitoral }.  
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:place-of-vote ?estado_eleitoral }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:homepage ?site }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> biblio:Email ?email }. 
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> pol:Office ?cargo }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:officeState ?cargo_uf }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> pol:party ?partido }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:situation ?situacao }.        
              FILTER isliteral(?cidade_nascimento).
              FILTER isliteral(?partido)
                      }');
foreach ($sparql1 as $row)
    echo $row['foto'];
?>