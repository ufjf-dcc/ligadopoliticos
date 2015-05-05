<HTML>
<head>
	<title>LIGADO nos POL�TICOS</title>
	<meta name="author" content="Lucas de Ramos Ara�jo">
	<meta name="description" content="">
	<meta name="keywords" content="pol�ticos brasileiros dados governamentais abertos governo eletronico transparencia dados ligados web semantica">
	<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="http://localhost/ligadopoliticos/estilo.css" type="text/css" />
	<link rel="meta" type="application/rdf+xml" title="FOAF" href="http://localhost/ligadopoliticos/content/foaf.rdf" /> 
	<script language="javascript" src="http://ligadonospoliticos.com.br/fusioncharts/FusionCharts.js"></script>
</head>
<body>
	<?php 
                include("properties.php");
                include("config.php");
		include("functions.php");
		include("content/idioma.inc.php");
                include ("consultasSPARQL.php");
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
				$endereco = $_SERVER ['REQUEST_URI'];
                                $parte_endereco = explode ('/', $endereco);
                                $recurso = $parte_endereco[3];
				include("politico_html_dados_pessoais.inc.php");
				$url_facebook = $_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI'];
				'
				    <meta property="og:title" content="'.$nome_civil.'"/>
				    <meta property="og:type" content="politician"/>
				    <meta property="og:url" content="http://'.$url_facebook.'"/>
				    <meta property="og:image" content="http://ligadonospoliticos.com.br/'.$recurso.'"/>
				';

				echo "<div style='clear:both;'> &nbsp; </div>";

				echo "<div class = aba_linha> &nbsp;" ;

				aba_politico_html('No Facebook');
                                
				$sparql2 = consultaSPARQL(' select ?tipo ?descricao ?valor 
                                where{
                                  <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:declarationOfAssets ?x.
                                  ?x polbr:DeclarationOfAssets ?y.
                                  ?y dcterms:description ?descricao.
                                  ?y dcterms:type ?tipo.
                                  ?y rdfmoney:Price ?valor
                                  }');
                                $cont_declaracao_bens = count($sparql2); 
                                if ($cont_declaracao_bens > 0){	
					aba_politico_html('Declaração de Bens');	
				}
				
				$sparql6 = consultaSPARQL(' SELECT ?anexo ?ala ?gabinete ?email ?telefone ?fax
                                WHERE	{
                                        <http://ligadonospoliticos.com.br/politico/'.$recurso.'> vcard:adr ?x
                                        OPTIONAL{?x polbr:annex ?anexo }.
                                        OPTIONAL{?x polbr:wing ?ala}.
                                        OPTIONAL{?x polbr:cabinet ?gabinete}.
                                        OPTIONAL{?x biblio:Email ?email}.
                                        OPTIONAL{?x foaf:phone ?telefone}.
                                        OPTIONAL{?x vcard:fax ?fax}
                                        }
                                        ');
                                $cont_endereco_parlamentar = count($sparql6); 
				if ($cont_endereco_parlamentar > 0){	
					aba_politico_html('Endereço Parlamentar');
				}
                                
                                $sparql3 = consultaSPARQL('SELECT ?ano ?nome_urna ?numero_candidato ?situacao_candidatura ?partido ?nome_coligacao ?partidos_coligacao ?cargo ?cargo_uf ?resultado
                                    ?numero_protocolo ?numero_processo ?cnpj_campanha
                                    WHERE	{
                                      <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:election ?x.
                                                ?x timeline:atYear ?ano .
                                                ?x foaf:name ?nome_urna . 
                                                ?x biblio:number ?numero_candidato .
                                                ?x pol:party ?partido .
                                                ?x pol:Office ?cargo .
                                                 OPTIONAL{ ?x  geospecies:State ?cargo_uf }.
                                                 OPTIONAL{ ?x earl:outcome ?resultado }.
                                                 OPTIONAL{ ?x spinrdf:Union ?nome_coligacao }.
                                                 OPTIONAL{ ?x polbr:unionParties ?partidos_coligacao }.  
                                                ?x polbr:situation ?situacao_candidatura .
                                                ?x polbr:protocolNumber ?numero_protocolo .
                                                ?x polbr:processNumber ?numero_processo .
                                                ?x polbr:CNPJ ?cnpj_campanha .
                                                 FILTER isliteral(?partido)
                                         }');
                                $cont_eleicoes = count($sparql3);
				if ($cont_eleicoes > 0){
					aba_politico_html('Eleições');
					aba_politico_html('Eleições - Votações');
				}
				
                                $sparql4 = consultaSPARQL('SELECT ?cargo ?cargo_uf ?data ?tipo ?motivo
                                    WHERE	{
                                      <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:absence ?x.
                                            OPTIONAL{ ?x pol:Office ?cargo }.
                                            OPTIONAL{ ?x geospecies:State ?cargo_uf }.
                                            OPTIONAL{ ?x timeline:atDate ?data }.
                                            OPTIONAL{ ?x dcterms:type ?tipo }.
                                            OPTIONAL{ ?x event:fact ?motivo }.
                                    }');
                                $cont4 = count($sparql4);
				if ($cont4 > 0){
					aba_politico_html('Afastamentos');
				}

				$sparql5 = consultaSPARQL('SELECT ?descricao ?data_inicio ?data_fim ?participacao 
                                WHERE{
                                  <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:committee ?x.
                                  ?x dcterms:description ?descricao.
                                  ?x timeline:beginsAtDateTime ?data_inicio .
                                  ?x vcard:role ?participacao.
                                  OPTIONAL{ ?x timeline:endsAtDateTime ?data_fim }.
                                   }');
                                $cont5 = count($sparql5);
                                if ($cont5 <> ''){
					aba_politico_html('Comissões');	
				}

				$sparql8 = consultaSPARQL('select ?descricao ?data_inicio ?data_fim ?tipo
                                where
                                {	<http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:leadership ?z.
                                        ?z dcterms:description ?descricao.
                                        ?z dcterms:type ?tipo.
                                        ?z timeline:beginsAtDateTime ?data_inicio.
                                        ?z timeline:endsAtDateTime ?data_fim.
                                }');
                                $cont8 = count($sparql8);
                                if ($cont8 > 0){
					aba_politico_html('Lideranças');				
				}
				
				$sparql9 = consultaSPARQL('Select ?cargo ?data_inicio ?data_fim
                                Where{
                                  <http://ligadonospoliticos.com.br/politico/'.$recurso.'> pol:Term ?x.
                                  ?x pol:Office ?cargo.
                                  ?x timeline:beginsAtDateTime 	?data_inicio.
                                  Optional {?x timeline:endsAtDateTime ?data_fim}.
                                  }');
                                $cont9 = count($sparql9);
                                if ($cont9 > 0){
					aba_politico_html('Mandatos');
				}

				$sparql10 = consultaSPARQL('Select ?descricao ?data_inicio ?data_fim ?tipo ?documento
                                Where{
                                  <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:mission ?x.
                                  ?x dcterms:description ?descricao.
                                  ?x dcterms:type 	?tipo.
                                  ?x timeline:beginsAtDateTime ?data_inicio.
                                  ?x foaf:Document ?documento.
                                  OPTIONAL{ ?x timeline:endsAtDateTime ?data_fim }.
                                  }');
                                $cont10 = count($sparql10);
                                if ($cont10 > 0){
					aba_politico_html('Missões');
				}

				$sparql11 = consultaSPARQL('select ?data ?titulo ?casa ?numero ?tipo ?descricao_tipo ?ementa
                                where{
                                   <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:proposition ?y.
                                  ?y dc:title ?titulo.
                                  OPTIONAL{ ?y timeline:atDate ?data }.
                                  ?y po:Place ?casa.
                                  ?y biblio:Number ?numero.
                                  ?y dcterms:type ?tipo.
                                  ?y polbr:description ?descricao_tipo.
                                  ?y dcterms:description ?ementa.
                                  }');
                                $cont11 = count($sparql11);
                                if ($cont11 <> ''){
					aba_politico_html('Proposições');
				}		

				$sql_voto = mysql_query("SELECT * FROM voto WHERE id_politico = '$recurso'");
				$cont_voto = mysql_num_rows($sql_voto);		
				if ($cont_voto <> ''){
					aba_politico_html('Votações');
				}
			
				$sparql12 = consultaSPARQL('select ?tipo ?data ?casa ?partido ?uf ?resumo
                                    where{
                                      <http://ligadonospoliticos.com.br/politico/'.$recurso.'> biblio:Speech ?y.
                                      ?y dcterms:type ?tipo.
                                      OPTIONAL{?y timeline:atDate ?data }.
                                      ?y po:Place ?casa .
                                      ?y pol:party ?partido .
                                      ?y geospecies:State ?uf .
                                      ?y biblio:abstract ?resumo .
                                      FILTER isliteral(?partido)
                                      }');
                                $cont12 = count($sparql12);
                                if ($cont12 <> ''){
					aba_politico_html('Pronunciamentos');
				}

				$sql_outros = mysql_query("SELECT * FROM linkrdf_page WHERE id_politico = '$recurso' AND tipo='sameas' AND uri LIKE '%dbpedia%'");
				$cont_outros = mysql_num_rows($sql_outros);

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
				//
                                //
                                //
                                //isso
                                //
                                //
                                //
                                
				echo "<a href='../../../ligadopoliticos/politico/$recurso/rdf' style='decoration:none;'><img src='../../images/rdf_icon.gif' border=0 height='18px' /></a>";				
				
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
		<?php include("base.inc.php"); ?>  
	</div>
</body>
	
</HTML>




