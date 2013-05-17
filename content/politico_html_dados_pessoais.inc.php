<?php
	$nome_parlamentar = '';
	$sql1 = mysql_query("SELECT * FROM politico WHERE id_politico = '$recurso'");
	while($row = mysql_fetch_array($sql1)){
		$nome_civil = $row['nome_civil'];
		$nome_parlamentar = $row['nome_parlamentar'];
		$foto = $row['foto'];	
		
		echo "<h2>".$nome_civil."&nbsp;&nbsp;<a href='http://ligadonospoliticos.com.br/politico/$recurso/rdf' style='decoration:none;'><img src='../../../images/rdf_icon.gif' border=0 height='18px' /></a><iframe src='http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fligadonospoliticos.com.br%2Fpolitico%2F".$recurso."%2Fhtml%2F&action=like' scrolling='no' frameborder='0' style='height: 62px; width: 100%' allowTransparency='true'></iframe></h2>";
		
		if ($row['foto'] <> '' || $row['foto'] <> NULL)	
			echo "<div id='foto' style='float:right;'> <img src=../../../images/politicos/".$foto." /></div>";
		echo "<div id='dados_atuais' style='float:left;'>"; 

		if ($nome_parlamentar  <> '' AND $nome_parlamentar  <> NULL)					
			echo "<b>Nome Parlamentar:</b> ".$nome_parlamentar."<br />";					
		if ($row['situacao'] <> '' AND $row['situacao'] <> NULL)	
			echo "<b>Situação:</b> <a href='../../../?pag=resultadobusca&situacao=".$row['situacao']."'>".$row['situacao']."</a><br />";
		if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)	
			echo "<b>Cargo:</b> <a href='../../../?pag=resultadobusca&cargo=".$row['cargo']."'>".$row['cargo']."</a><br />";
		if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL)
			echo "<b>Estado:</b> <a href='../../../?pag=resultadobusca&estado=".$row['cargo_uf']."'>".$row['cargo_uf']."</a><br />";
		if ($row['partido'] <> '' AND $row['partido'] <> NULL)
			echo "<b>Partido:</b> <a href='../../../?pag=resultadobusca&partido=".$row['partido']."'>".$row['partido']."</a><br />";			
		if ($row['data_nascimento'] <> '' AND $row['data_nascimento'] <> NULL){		
			$data_nascimento = date('d/m/Y', strtotime($row['data_nascimento']));
			echo "<b>Data de Nascimento:</b> ".$data_nascimento."<br />";
		}
		if ($row['nome_pai'] <> '' AND $row['nome_pai'] <> NULL)	
			echo "<b>Nome do Pai:</b> ".$row['nome_pai']."<br />";
		if ($row['nome_mae'] <> '' AND $row['nome_mae'] <> NULL)	
			echo "<b>Nome da Mãe:</b> ".$row['nome_mae']."<br />";
		if ($row['sexo'] <> '' AND $row['sexo'] <> NULL)		
			echo "<b>Sexo:</b> <a href='../../../?pag=resultadobusca&sexo=".$row['sexo']."'>".$row['sexo']."</a><br />";
		if ($row['cor'] <> '' AND $row['cor'] <> NULL)	
			echo "<b>Cor:</b> <a href='../../../?pag=resultadobusca&cor=".$row['cor']."'>".$row['cor']."</a><br />";
		if ($row['estado_civil'] <> '' AND $row['estado_civil'] <> NULL)	
			echo "<b>Estado Civil:</b> <a href='../../../?pag=resultadobusca&estado_civil=".$row['estado_civil']."'>".$row['estado_civil']."</a><br />";
		if ($row['ocupacao'] <> '' AND $row['ocupacao'] <> NULL)	
			echo "<b>Ocupação:</b> <a href='../../../?pag=resultadobusca&ocupacao=".$row['ocupacao']."'>".$row['ocupacao']."</a><br />";
		if ($row['grau_instrucao'] <> '' AND $row['grau_instrucao'] <> NULL)	
			echo "<b>Grau de Instrução:</b> <a href='../../../?pag=resultadobusca&grau_instrucao=".$row['grau_instrucao']."'>".$row['grau_instrucao']."</a><br />";
		if ($row['nacionalidade'] <> '' AND $row['nacionalidade'] <> NULL)	
			echo "<b>Nacionalidade:</b> <a href='../../../?pag=resultadobusca&nacionalidade=".$row['nacionalidade']."'>".$row['nacionalidade']."</a><br />";
		if ($row['cidade_nascimento'] <> '' AND $row['cidade_nascimento'] <> NULL)	
			echo "<b>Cidade de Nascimento:</b> <a href='../../../?pag=resultadobusca&cidade_nascimento=".$row['cidade_nascimento']."'>".$row['cidade_nascimento']."</a><br />";
		if ($row['estado_nascimento'] <> '' AND $row['estado_nascimento'] <> NULL)	
			echo "<b>Estado de Nascimento:</b> <a href='../../../?pag=resultadobusca&estado_nascimento=".$row['estado_nascimento']."'>".$row['estado_nascimento']."</a><br />";
		if ($row['cidade_eleitoral'] <> '' AND $row['cidade_eleitoral'] <> NULL)	
			echo "<b>Cidade Eleitoral:</b> <a href='../../../?pag=resultadobusca&cidade_eleitoral=".$row['cidade_eleitoral']."'>".$row['cidade_eleitoral']."</a><br />";
		if ($row['estado_eleitoral'] <> '' AND $row['estado_eleitoral'] <> NULL)	
			echo "<b>Estado-Eleitoral:</b> <a href='../../../?pag=resultadobusca&estado_eleitoral=".$row['estado_eleitoral']."'>".$row['estado_eleitoral']."</a><br />";
		if ($row['email'] <> '' AND $row['email'] <> NULL)	
			echo "<b>E-mail:</b> ".$row['email']."<br />";
		if ($row['site'] <> '' AND $row['site'] <> NULL)
			echo "<b>Site:</b> <a href='".$row['site']."'>".$row['site']."</a><br />"; 
		
		
		if ($nome_parlamentar <> '' AND $nome_parlamentar <> NULL)
		{	
			$parte_nome_parlamentar = explode (" ", $nome_parlamentar);
			$teste = sizeof($parte_nome_parlamentar);
			$q = '';
			for ($i=0;$i < sizeof($parte_nome_parlamentar); $i++)
				$q = $q.$parte_nome_parlamentar[$i]."+";
		}
		else
		{
			$parte_nome_civil = explode (" ", $nome_civil);
			$q = $parte_nome_civil[0]."+".$parte_nome_civil[sizeof($parte_nome_civil)-1];	
		}
	}
	echo "</div>";
?>
