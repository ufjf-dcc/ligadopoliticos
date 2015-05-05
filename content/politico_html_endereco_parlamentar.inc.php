<?php	
	echo "<div class='divisao'>Endereço Parlamentar</div>";					
	foreach ($sparql6 as $row){	
		if (isset($row['anexo']))
                    if($row['anexo']!= null)
			echo "<b>Anexo:</b> ".$row['anexo']."<br />";					
		if (isset($row['ala']))
                    if($row['ala']!= null)
			echo "<b>Ala:</b> ".$row['ala']."<br />";
		if (isset($row['gabinete']))
                    if($row['gabinete']!= null)
			echo "<b>Gabinete:</b> ".$row['gabinete']."<br />";
		if (isset($row['email']))
                    if($row['email']!= null)
			echo "<b>E-mail:</b> ".$row['email']."<br />";
		if (isset($row['telefone']))	
                    if($row['telefone']!= null)
			echo "<b>Telefone:</b> ".$row['telefone']."<br />";
		if (isset($row['fax']))	
                    if($row['fax']!= null)
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
                if($row['tipo']!= null)echo "<b>Local: </b>".$row['tipo']."<br />";
		if($row['rua']!= null)echo "<b>Rua: </b>".$row['rua']."<br />";
		if($row['bairro']!= null)echo "<b>Bairro: </b>".$row['bairro']."<br />";
		if($row['cidade']!= null)echo "<b>Cidade: </b>".$row['cidade']."<br />";
		if($row['estado']!= null)echo "<b>Estado: </b>".$row['estado']."<br />";
		if($row['CEP']!= null)echo "<b>CEP: </b>".$row['CEP']."<br />";
		if($row['CNPJ']!= null)echo "<b>CNPJ: </b>".$row['CNPJ']."<br />";
		if($row['telefone']!= null)echo "<b>Telefone: </b>".$row['telefone']."<br />";
		if($row['disque']!= null)echo "<b>Disque: </b>".$row['disque']."<br />";
		if($row['site']!= null)echo "<b>Site: </b>".$row['site']."<br />";
		echo "<br />";
	}
					
?>