<HTML>
<head>
	<?php include("content/head.inc.php"); ?>
</head>
<body onLoad="visibilidadeCargo()">
	<?php
        include_once ('properties.php');
        include ('consultasSPARQL.php');
	    include("config.php");
	    include("functions.php");
	$pag = '';

	if (isset($_GET['pag']))
		$pag = $_GET['pag'];

	switch($pag) {
		case "home":							$pag = "content/home.inc.php"; 	 	 	    				break;
		case "visualizacoes":					$pag = "content/visualizacoddes.inc.php";						break;
		case "downloads":						$pag = "content/downloads.inc.php";							break;
		case "dadosgovernamentaisabertos":		$pag = "content/dadosgovernamentaisabertos.inc.php";		break;
		case "dadosligados": 					$pag = "content/dadosligados.inc.php";						break;
		case "sobre": 							$pag = "content/sobre.inc.php";		        				break;
		case "contato": 						$pag = "content/contato.inc.php";		        			break;
		case "links": 						$pag = "content/links.inc.php";		        			break;
		case "noticias": 						$pag = "content/noticias.inc.php";		        			break;
		case "termos": 						$pag = "content/termos.inc.php";		        			break;
		case "resultadobusca": 					$pag = "content/resultadobusca.inc.php";		        	break;
		case "visualizacao": 					$pag = "content/visualizacao.inc.php";		        		break;
		case "estado": 					$pag = "content/estado.inc.php";		        		break;
		default: 								$pag = "content/home.inc.php";              				break;
	 }


	include("content/idioma.inc.php");
	?>

	<div id='tudo'>
	  	<div id='topo'>
		 	<?php include("content/topo.inc.php"); ?>	 		
	  	</div>
	  	<div id='menu'>
		 	<?php include("content/menu.inc.php"); ?>
		</div>
	  	<div id='navegacao'>
	  		<div id='conteudo'>
	  			<?php include($pag); ?>
	  		</div>
	  	</div>
		<?php include("content/base.inc.php"); ?>  
	</div>
</body>
</HTML>
