<?php	
	echo "<div class='divisao'>Endereço Parlamentar</div>";					
	while($row = mysql_fetch_array($sql6)){	
		if ($row['anexo'] <> '' AND $row['anexo'] <> NULL)					
			echo "<b>Anexo:</b> ".$row['anexo']."<br />";					
		if ($row['ala'] <> '' AND $row['ala'] <> NULL)				
			echo "<b>Ala:</b> ".$row['ala']."<br />";
		if ($row['gabinete'] <> '' AND $row['gabinete'] <> NULL)		
			echo "<b>Gabinete:</b> ".$row['gabinete']."<br />";
		if ($row['email'] <> '' AND $row['email'] <> NULL)					
			echo "<b>E-mail:</b> ".$row['email']."<br />";
		if ($row['telefone'] <> '' AND $row['telefone'] <> NULL)					
			echo "<b>Telefone:</b> ".$row['telefone']."<br />";
		if ($row['fax'] <> '' AND $row['fax'] <> NULL)					
			echo "<b>Fax:</b> ".$row['fax']."<br />";
		$sql7 = mysql_query("SELECT * FROM endereco_parlamentar WHERE id_endereco_parlamentar = '$row[id_endereco_parlamentar]'");
	}		
	while($row = mysql_fetch_array($sql7)){
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