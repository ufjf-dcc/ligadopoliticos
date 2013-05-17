<HTML>
<head>
	<title>LIGADO nos POLÍTICOS</title>
	<meta name="author" content="Lucas de Ramos Araújo">
    <meta name="description" content="">
    <meta name="keywords" content="políticos brasileiros dados governamentais abertos governo eletronico transparencia dados ligados web semantica">
	<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="../../../estilo.css" type="text/css" />
</head>
<body>
<?php
 function escreve($a,$b){
  if ($_COOKIE["idioma"]  == "pt")
    echo $a;
  elseif($_COOKIE["idioma"]  == "en")
    echo $b;
 }
?>
<div id="tudo">
		<div id="topo">
			<img src="../../../images/logo.png" />
		</div>
		<div id="menu">
      <?php include("menu.inc.php"); ?>
		</div>
		<div id="navegacao">
			<div id="conteudo">
				<?php
				include("../../../config.php");
				
				$endereco = $_SERVER ['REQUEST_URI'];
				$parte_endereco = explode('/',$endereco);
				$recurso = $parte_endereco[2];
				//$recurso = $parte_endereco[3];
				
				$sql1 = mysql_query("SELECT * FROM politico WHERE id_politico = '$recurso'");
				while($row = mysql_fetch_array($sql1)){
					echo "<h2>".$row['nome_civil']."&nbsp;&nbsp;<a href='http://ligadonospoliticos.com.br/resource/$recurso/rdf' style='decoration:none;'><img src='../../../images/rdf_icon.gif' border=0 height='18px' /></a></h2>";
				    
					if ($row['foto'] <> '' || $row['foto'] <> NULL)	
						echo "<div id='foto' style='float:right;'> <img src=../../../images/politicos/".$row['foto']." /></div>";
					echo "<div id='dados_atuais' style='float:left;'>"; 

					if ($row['nome_parlamentar'] <> '' AND $row['nome_parlamentar'] <> NULL)					
						echo "<b>Nome Parlamentar:</b> ".$row['nome_parlamentar']."<br />";					
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
				}
				echo "</div>";
				echo "<div style='clear:both;'>&nbsp;</div>";

				$sql3 = mysql_query("SELECT * FROM eleicao WHERE id_politico = '$recurso'");
				$cont3 = mysql_num_rows($sql3);
				
				if ($cont3 > 0){
					echo "<div class='divisao'>Eleições</div>";
					
					while($row = mysql_fetch_array($sql3)){
						echo "<b>Ano: </b>".$row['ano']."<br />";
						echo "<b>Nome para Urna: </b>".$row['nome_urna']."<br />";
						echo "<b>Número do Candidato: </b>".$row['numero_candidato']."<br />";
						echo "<b>Partido: </b>".$row['partido']."<br />";
						echo "<b>Cargo: </b>".$row['cargo']."<br />";
						echo "<b>Estado: </b>".$row['cargo_uf']."<br />";
						if ($row['resultado'] <> '' AND $row['resultado'] <> NULL)					
							echo "<b>Resultado:</b> ".$row['resultado']."<br />";					
						if ($row['nome_coligacao'] <> '' AND $row['nome_coligacao'] <> NULL)					
							echo "<b>Nome da Coligação:</b> ".$row['nome_coligacao']."<br />";
						if ($row['partidos_coligacao'] <> '' AND $row['partidos_coligacao'] <> NULL)					
							echo "<b>Partidos da Coligação:</b> ".$row['partidos_coligacao']."<br />";
						if ($row['prestacao_contas'] <> '' AND $row['prestacao_contas'] <> NULL)					
							echo "<b>Julgamento da Prestação de Contas:</b> ".$row['prestacao_contas']."<br />";
						echo "<b>Situação da Candidatura: </b>".$row['situacao_candidatura']."<br />";
						echo "<b>Número do Protocolo: </b>".$row['numero_protocolo']."<br />";
						echo "<b>Número do Processo: </b>".$row['numero_processo']."<br />";
						echo "<b>CNPJ da Campanha: </b>".$row['cnpj_campanha']."<br />";
						echo "<br />";
 	 	 	 	 	}							
				}

				$sql6 = mysql_query("SELECT * FROM endereco_parlamentar_politico WHERE id_politico = '$recurso'");
				$cont6 = mysql_num_rows($sql6);
				
				if ($cont6 > 0){				
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
			
				}

				$sql4 = mysql_query("SELECT * FROM afastamento WHERE id_politico = '$recurso'");
				$cont4 = mysql_num_rows($sql4);
				
				if ($cont4 > 0){
					echo "<div class='divisao'>Afastamentos</div>";
					while($row = mysql_fetch_array($sql4)){	
						if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)					
							echo "<b>Cargo:</b> ".$row['cargo']."<br />";					
						if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL)				
							echo "<b>Estado:</b> ".$row['cargo_uf']."<br />";
						if ($row['data'] <> '' AND $row['data'] <> NULL){		
							$data = date('d/m/Y', strtotime($row['data']));
							echo "<b>Data:</b> ".$data."<br />";
						}
						if ($row['tipo'] <> '' AND $row['tipo'] <> NULL)					
							echo "<b>Tipo:</b> ".$row['tipo']."<br />";
						if ($row['motivo'] <> '' AND $row['motivo'] <> NULL)					
							echo "<b>Motivo:</b> ".$row['motivo']."<br />";
						echo "<br />";	
					}
				}
				
				$sql2 = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$recurso'");
				$cont2 = mysql_num_rows($sql2);
				
				if ($cont2 > 0){		
					$sql2a = mysql_query("SELECT SUM(valor) AS soma FROM declaracao_bens WHERE id_politico = '$recurso'");
					while($row2a = mysql_fetch_array($sql2a))
						$soma = $row2a['soma'];		
					echo "<div class='divisao'>Declarações de Bens</div>";
					$conta_declaracao = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td class='topo_tabela'>N</sup></td>
						<td class='topo_tabela'>Descrição</td>
						<td class='topo_tabela'>Tipo</td>	
						<td class='topo_tabela'>Valor</td>					
					</tr>";
					
					while($row = mysql_fetch_array($sql2)){
						echo "
						<tr>
							<td>$conta_declaracao</td>
							<td>".$row['descricao']."</td>
							<td>".$row['tipo']."</td>
							<td>".$row['valor']."</td>
						</tr>";
						$conta_declaracao++;
					}
					echo "
						 <tr>
							<td colspan = '3' class='topo_tabela'>TOTAL</td>
							<td class='topo_tabela'>".$soma."</td>
						 </tr>";
					echo "</table>";
					echo "<div style='clear:both;'>&nbsp;</div>";
				}		

				$sql5 = mysql_query("SELECT c.descricao, c.data_inicio, c.data_fim, cp.participacao FROM comissao c JOIN comissao_politico cp ON c.id_comissao = cp.id_comissao WHERE cp.id_politico = '$recurso'");
				$cont5 = mysql_num_rows($sql5);
				
				if ($cont5 <> ''){				
					echo "<div class='divisao'>Comissões</div>";
					$conta_comissao = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td>N<sup>o</sup></td>
						<td>Descrição</td>
						<td>Data Início</td>	
						<td>Data Fim</td>
						<td>Participação</td>					
					</tr>";
					while($row = mysql_fetch_array($sql5)){
						$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
						$data_fim = date('d/m/Y', strtotime($row['data_fim']));
						if ($data_fim == '01/01/1970')
							$data_fim = '-';
					
						echo "
						<tr>
							<td>$conta_comissao</td>
							<td>".$row['descricao']."</td>
							<td>".$data_inicio."</td>
							<td>".$data_fim."</td>
							<td>".$row['participacao']."</td>
						</tr>";
						$conta_comissao++;
					}
					echo "</table>";
					echo "<br />";
				}
				
				$sql8 = mysql_query("SELECT descricao, tipo, data_inicio, data_fim FROM lideranca WHERE id_politico = '$recurso'");
				$cont8 = mysql_num_rows($sql8);
				
				if ($cont8 > 0){
					echo "<div class='divisao'>Lideranças</div>";
					$conta_lideranca = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td>N<sup>o</sup></td>
						<td>Descrição</td>
						<td>Casa</td>
						<td>Data Início</td>	
						<td>Data Fim</td>					
					</tr>";
					
					while($row = mysql_fetch_array($sql8)){
						$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
						$data_fim = date('d/m/Y', strtotime($row['data_fim']));
						if ($data_fim == '01/01/1970')
							$data_fim = '-';
					
						echo "
						<tr>
							<td>$conta_lideranca</td>
							<td>".$row['descricao']."</td>
							<td>".$row['tipo']."</td>
							<td>".$data_inicio."</td>
							<td>".$data_fim."</td>
						</tr>";
						$conta_lideranca++;
					}
					echo "</table>";
					echo "<br />";
				}	

				$sql9 = mysql_query("SELECT * FROM mandato WHERE id_politico = '$recurso'");
				$cont9 = mysql_num_rows($sql9);
				
				if ($cont9 > 0){
					echo "<div class='divisao'>Mandatos</div>";
					$conta_mandato = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td>N<sup>o</sup></td>
						<td>Cargo</td>
						<td>Data Início</td>	
						<td>Data Fim</td>					
					</tr>";
					
					while($row = mysql_fetch_array($sql9)){
						$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
						$data_fim = date('d/m/Y', strtotime($row['data_fim']));
						if ($data_fim == '01/01/1970')
							$data_fim = '-';
					
						echo "
						<tr>
							<td>$conta_mandato</td>
							<td>".$row['cargo']."</td>
							<td>".$data_inicio."</td>
							<td>".$data_fim."</td>
						</tr>";
						$conta_mandato++;
					}
					echo "</table>";
					echo "<br />";
				}

				$sql10 = mysql_query("SELECT * FROM missao WHERE id_politico = '$recurso'");
				$cont10 = mysql_num_rows($sql10);
				
				if ($cont10 > 0){
					echo "<div class='divisao'>Missões</div>";
					$conta_missao = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td>N<sup>o</sup></td>
						<td>Descrição</td>
						<td>Casa</td>
						<td>Data Início</td>	
						<td>Data Fim</td>
						<td>Documento</td>							
					</tr>";
					while($row = mysql_fetch_array($sql10)){
						$data_inicio = date('d/m/Y', strtotime($row['data_inicio']));
						$data_fim = date('d/m/Y', strtotime($row['data_fim']));
						if ($data_fim == '01/01/1970')
							$data_fim = '-';
					
						echo "
						<tr>
							<td>$conta_missao</td>
							<td>".$row['descricao']."</td>
							<td>".$row['tipo']."</td>
							<td>".$data_inicio."</td>
							<td>".$data_fim."</td>
							<td>".$row['documento']."</td>
						</tr>";
						$conta_missao++;
					}
					echo "</table>";
					echo "<br />";
				}

				$sql11 = mysql_query("SELECT * FROM proposicao WHERE id_politico = '$recurso'");
				$cont11 = mysql_num_rows($sql11);
				
				if ($cont11 <> ''){
					echo "<div class='divisao'>Proposições</div>";
					$conta_proposicao = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td>N<sup>o</sup></td>
						<td>Título</td>
						<td>Data</td>
						<td>Casa</td>	
						<td>Número</td>
						<td>Tipo</td>	
						<td>Ementa</td>						
					</tr>";
					while($row = mysql_fetch_array($sql11)){
						$data = date('d/m/Y', strtotime($row['data']));
						if ($data == '01/01/1970')
							$data = '-';
					
						echo "
						<tr>
							<td>$conta_proposicao</td>
							<td>".$row['titulo']."</td>
							<td>".$data."</td>
							<td>".$row['casa']."</td>
							<td>".$row['numero']."</td>
							<td>".$row['tipo']." - ".$row['descricao_tipo']."</td>
							<td>".$row['ementa']."</td>
						</tr>";
						$conta_proposicao++;
					}
					echo "</table>";
					echo "<br />";
				}		

				$sql12 = mysql_query("SELECT * FROM pronunciamento WHERE id_politico = '$recurso'");
				$cont12 = mysql_num_rows($sql12);
				
				if ($cont12 <> ''){
					echo "<div class='divisao'>Pronunciamentos</div>";
					$conta_pronunciamento = 1;
					echo "<table border=1 class='tabelas'>
					<tr>
						<td>N<sup>o</sup></td>
						<td>Tipo</td>
						<td>Data</td>
						<td>Casa</td>	
						<td>Partido</td>
						<td>UF</td>	
						<td>Resumo</td>						
					</tr>";
					while($row = mysql_fetch_array($sql12)){
						$data = date('d/m/Y', strtotime($row['data']));
						if ($data == '01/01/1970')
							$data = '-';
					
						echo "
						<tr>
							<td>$conta_pronunciamento</td>
							<td>".$row['tipo']."</td>
							<td>".$data."</td>
							<td>".$row['casa']."</td>
							<td>".$row['partido']."</td>
							<td>".$row['uf']."</td>
							<td>".$row['resumo']."</td>
						</tr>";
						$conta_pronunciamento++;
					}
					echo "</table>";
					echo "<br />";
				}
				echo "<a href='http://ligadonospoliticos.com.br/resource/$recurso/rdf' style='decoration:none;'><img src='../../../images/rdf_icon.gif' border=0 height='18px' /></a>";				
				?>
			</div>
		</div>
		<div id="rodape">
			Copyright © 2010 - Lucas de Ramos Araújo
		</div>
	</div>
</body>
	
</HTML>