<HTML>
<head>
	<title>LIGADO nos POL�TICOS</title>
	<meta name="author" content="Lucas de Ramos Ara�jo">
	<meta name="description" content="">
	<meta name="keywords" content="pol�ticos brasileiros dados governamentais abertos governo eletronico transparencia dados ligados web semantica">
	<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="http://ligadonospoliticos.com.br/estilo.css" type="text/css" />
	<link rel="meta" type="application/rdf+xml" title="FOAF" href="http://ligadonospoliticos.com.br/content/foaf.rdf" /> 
	<script language="javascript" src="http://ligadonospoliticos.com.br/fusioncharts/FusionCharts.js"></script>
</head>
<body>
	<?php 
		include("../../../config.php");
		include("../../../functions.php");
		include("../../../content/idioma.inc.php");
	?>

<div id="tudo">
		<div id="topo">
  			<?php include("topo.inc.php"); 	 ?>		
		</div>
		<div id="menu">
      			<?php include("menu.inc.php"); ?>
		</div>
		<div id="navegacao">
			<div id="conteudo">
				<?php
				include_once("../../../sparql/ARC2.php");
				
				$endereco = $_SERVER ['REQUEST_URI'];
				$parte_endereco = explode('/',$endereco);
				$recurso = $parte_endereco[2];
				
				include("politico_html_dados_pessoais.inc.php");

				$url_facebook = $_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI'];
				echo 
				'
				    <meta property="og:title" content="'.$nome_civil.'"/>
				    <meta property="og:type" content="politician"/>
				    <meta property="og:url" content="http://'.$url_facebook.'"/>
				    <meta property="og:image" content="http://ligadonospoliticos.com.br/'.$foto.'"/>
				';

				echo "<div style='clear:both;'> &nbsp; </div>";

				echo "<div class = aba_linha> &nbsp;" ;

				aba_politico_html('No Facebook');
	
				$sql2 = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$recurso'");
				$cont_declaracao_bens = mysql_num_rows($sql2);
				if ($cont_declaracao_bens > 0){	
					aba_politico_html('Declaração de Bens');	
				}
				
				$sql6 = mysql_query("SELECT * FROM endereco_parlamentar_politico WHERE id_politico = '$recurso'");
				$cont_endereco_parlamentar = mysql_num_rows($sql6);
				if ($cont_endereco_parlamentar > 0){	
					aba_politico_html('Endereço Parlamentar');
				}
	
				$sql3 = mysql_query("SELECT * FROM eleicao WHERE id_politico = '$recurso'");
				$cont_eleicoes = mysql_num_rows($sql3);
				if ($cont_eleicoes > 0){
					aba_politico_html('Eleições');
					aba_politico_html('Eleições - Votações');
				}
				
				$sql4 = mysql_query("SELECT * FROM afastamento WHERE id_politico = '$recurso'");
				$cont4 = mysql_num_rows($sql4);
				if ($cont4 > 0){
					aba_politico_html('Afastamentos');
				}

				$sql5 = mysql_query("SELECT c.descricao, c.data_inicio, c.data_fim, cp.participacao FROM comissao c JOIN comissao_politico cp ON c.id_comissao = cp.id_comissao WHERE cp.id_politico = '$recurso'");
				$cont5 = mysql_num_rows($sql5);
				if ($cont5 <> ''){
					aba_politico_html('Comissões');	
				}

				$sql8 = mysql_query("SELECT descricao, tipo, data_inicio, data_fim FROM lideranca WHERE id_politico = '$recurso'");
				$cont8 = mysql_num_rows($sql8);
				if ($cont8 > 0){
					aba_politico_html('Lideranças');				
				}
				
				$sql9 = mysql_query("SELECT * FROM mandato WHERE id_politico = '$recurso'");
				$cont9 = mysql_num_rows($sql9);
				if ($cont9 > 0){
					aba_politico_html('Mandatos');
				}

				$sql10 = mysql_query("SELECT * FROM missao WHERE id_politico = '$recurso'");
				$cont10 = mysql_num_rows($sql10);
				if ($cont10 > 0){
					aba_politico_html('Missões');
				}

				$sql11 = mysql_query("SELECT * FROM proposicao WHERE id_politico = '$recurso'");
				$cont11 = mysql_num_rows($sql11);
				if ($cont11 <> ''){
					aba_politico_html('Proposições');
				}		

				$sql_voto = mysql_query("SELECT * FROM voto WHERE id_politico = '$recurso'");
				$cont_voto = mysql_num_rows($sql_voto);		
				if ($cont_voto <> ''){
					aba_politico_html('Votações');
				}
				
				$sql12 = mysql_query("SELECT * FROM pronunciamento WHERE id_politico = '$recurso'");
				$cont12 = mysql_num_rows($sql12);		
				if ($cont12 <> ''){
					aba_politico_html('Pronunciamentos');
				}

				$sql_outros = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$recurso' AND tipo='sameas' AND uri LIKE '%dbpedia%'");
				$cont_outros = mysql_numrows($sql_outros);

				aba_politico_html('No Twitter');

				if ($cont_outros > 0){
					aba_politico_html('Outros Dados');
				}
				
				echo "</div>";
				echo "<br />";
				$include = '';
				
				$include = 'No Facebook';					
					
				if (isset ($_POST['include']))
					$include = $_POST['include'];
				
				switch ($include){
					case 'Eleições': include("politico_html_eleicoes.inc.php"); break;
					case 'Eleições - Votações': include("politico_html_eleicoes_votacoes.inc.php"); break;
					case 'Declaração de Bens': include("politico_html_declaracao_bens.inc.php"); break;
					case 'Endereço Parlamentar': include("politico_html_endereco_parlamentar.inc.php"); break;
					case 'Afastamentos': include("politico_html_afastamentos.inc.php"); break;
					case 'Pronunciamentos': include("politico_html_pronunciamentos.inc.php"); break;
					case 'Proposições': include("politico_html_proposicoes.inc.php"); break;
					case 'Votações': include("politico_html_votacoes.inc.php"); break;
					case 'Missões': include("politico_html_missoes.inc.php"); break;
					case 'Mandatos': include("politico_html_mandatos.inc.php"); break;
					case 'Lideranças': include("politico_html_liderancas.inc.php"); break;
					case 'Comissões': include("politico_html_comissoes.inc.php"); break;
					case 'Outros Dados': include("politico_html_outros.inc.php"); break;
					case 'No Twitter': include("politico_html_twitter.inc.php"); break;
					case 'No Facebook': include("politico_html_facebook.inc.php"); break;
				}
				
				echo "<div style='clear:both;'> &nbsp; </div>";
					
				echo "<a href='http://ligadonospoliticos.com.br/politico/$recurso/rdf' style='decoration:none;'><img src='../../../images/rdf_icon.gif' border=0 height='18px' /></a>";				
				
				function aba_politico_html($valor)
				{
					echo
					"<form name='form_aba_politico_html' action='' method='post' 	style = 'float: left;'>
						<input type='hidden' name='include' value='$valor' />
						<input type='submit' value = '$valor' class= 'aba' />
					</form>";					
				}
				
				
				function escreve_coleta_html($id_coleta){
					$sql_coleta = mysql_query("SELECT * FROM coleta WHERE id_coleta = '$id_coleta'");
					while($row_coleta = mysql_fetch_array($sql_coleta)){
						$url_coleta = $row_coleta['url_coleta'];	
						$data_coleta = $row_coleta['data_coleta'];	
						$hora_coleta = $row_coleta['hora_coleta'];	
					}	
					echo "<font style='font-size: 10px;'><b>Fonte:</b> ".$url_coleta.", ".$data_coleta.", ".$hora_coleta."</font><br />";
				}

						
				?>
			</div>
		</div>
		<? include("../../../content/base.inc.php"); ?>  
	</div>
</body>
	
</HTML>




