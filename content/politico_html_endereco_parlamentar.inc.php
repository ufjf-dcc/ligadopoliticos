<?php	
	echo "<div class='divisao'>Endereço Parlamentar</div>";					
	foreach ($sparql6 as $row){	
		if (isset($row['anexo']))					
			echo "<b>Anexo:</b> ".$row['anexo']."<br />";					
		if (isset($row['ala']))				
			echo "<b>Ala:</b> ".$row['ala']."<br />";
		if (isset($row['gabinete']))		
			echo "<b>Gabinete:</b> ".$row['gabinete']."<br />";
		if (isset($row['email']))					
			echo "<b>E-mail:</b> ".$row['email']."<br />";
		if (isset($row['telefone']))					
			echo "<b>Telefone:</b> ".$row['telefone']."<br />";
		if (isset($row['fax']))					
			echo "<b>Fax:</b> ".$row['fax']."<br />";
	}	
        $sparql7= consultaSPARQL('SELECT ?tipo ?rua ?bairro ?cidade ?estado ?CEP ?CNPJ ?telefone ?disque ?site
        WHERE	{
                <http://ligadonospoliticos.com.br/politico/10> vcard:adr ?x .
                ?x po:Place ?tipo .
                ?x vcard:street-address ?rua .
                ?x polbr:district ?bairro .
                ?x vcard:locality ?cidade .
                ?x geospecies:State ?estado .
                ?x vcard:postal-code ?CEP .
                ?x polbr:CNPJ ?CNPJ .
                ?x polbr:cabinetphone ?telefone .
                ?x polbr:fax ?disque .
                ?x foaf:homepage ?site .
          }');
	foreach($sparql7 as $row){
                echo "<b>Local: </b>".$row['tipo']."<br />";
		echo "<b>Rua: </b>".$row['rua']."<br />";
		echo "<b>Bairro: </b>".$row['bairro']."<br />";
		echo "<b>Cidade: </b>".$row['cidade']."<br />";
		echo "<b>Estado: </b>".$row['estado']."<br />";
		echo "<b>CEP: </b>".$row['CEP']."<br />";
		echo "<b>CNPJ: </b>".$row['CNPJ']."<br />";
		echo "<b>Telefone: </b>".$row['telefone']."<br />";
		echo "<b>Disque: </b>".$row['disque']."<br />";
		echo "<b>Site: </b>".$row['site']."<br />";
		echo "<br />";
	}
					
?>