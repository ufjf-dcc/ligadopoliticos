<HTML>
<head>
	<title>LIGADO nos POLÍTICOS</title>
	<meta name="author" content="Lucas de Ramos Araújo">
    <meta name="description" content="">
    <meta name="keywords" content="políticos brasileiros dados governamentais abertos governo eletronico transparencia dados ligados web semantica">
	<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="estilo.css" type="text/css" />
	<link rel="meta" type="application/rdf+xml" title="FOAF" href="content/foaf.rdf" /> 
  <script language="javascript" type="text/javascript">
  
  function visibilidadeCargo(){
      if (document.formbusca.situacao.value == 'Em Exercicio' || document.formbusca.situacao.value == 'Fora de Exercicio')
      {
        document.getElementById('cargo1').style.display = 'none';
        document.getElementById('cargo2').style.display = 'block';
        document.getElementById('cargo1').style.visibility = 'hidden';
        document.getElementById('cargo2').style.visibility = 'visible';
      }
      else
      {
        document.getElementById('cargo1').style.display = 'block';
        document.getElementById('cargo2').style.display = 'none';
        document.getElementById('cargo1').style.visibility = 'visible';
        document.getElementById('cargo2').style.visibility = 'hidden';    
      }
  }
      
  </script>
</head>
<body onLoad="visibilidadeCargo()">

<?php

include("config.php");

$pag = '';

if (isset($_GET['pag']))
	$pag = $_GET['pag'];

switch($pag) {
	case "home":							$pag = "content/home.inc.php"; 	 	 	    				break;
	case "visualizacoes":					$pag = "content/visualizacoes.inc.php";						break;
	case "downloads":						$pag = "content/downloads.inc.php";							break;
	case "dadosgovernamentaisabertos":		$pag = "content/dadosgovernamentaisabertos.inc.php";		break;
	case "dadosligados": 					$pag = "content/dadosligados.inc.php";						break;
	case "sobre": 							$pag = "content/sobre.inc.php";		        				break;
	case "contato": 						$pag = "content/contato.inc.php";		        			break;
	case "links": 						$pag = "content/links.inc.php";		        			break;
	case "noticias": 						$pag = "content/noticias.inc.php";		        			break;
	case "resultadobusca": 					$pag = "content/resultadobusca.inc.php";		        	break;
	case "visualizacao1": 					$pag = "content/visualizacao1.inc.php";		        		break;
	case "visualizacao2": 					$pag = "content/visualizacao2.inc.php";		        		break;
	case "visualizacao3": 					$pag = "content/visualizacao3.inc.php";		        		break;
	case "visualizacao4": 					$pag = "content/visualizacao4.inc.php";		        		break;
	case "visualizacao5": 					$pag = "content/visualizacao5.inc.php";		        		break;
	case "visualizacao6": 					$pag = "content/visualizacao6.inc.php";		        		break;
	default: 								$pag = "content/home.inc.php";              				break;
 }

$endereco = $_SERVER ['REQUEST_URI'];
$parte_endereco = explode('&',$endereco);
$endereco = $parte_endereco[0];
				
$url = '';
if ($endereco == '/')
  $endereco = '/?pag=home';
$url = 'http://ligadonospoliticos.com.br'.$endereco;

if (!isset($_COOKIE['idioma'])){
  $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  if ($lang == 'pt')
    setcookie("idioma","pt");
	else
	  setcookie("idioma","en");
  header("location:$url");
}


echo $lang;

if (isset($_GET['idioma']))
{
	$idioma = $_GET['idioma'];
	setcookie("idioma",$idioma);
	header("location:$url");
}

  echo "
  	<div id='tudo'>
  		<div id='topo'>
  		  <div id='logo'>
  			 <img src='images/logo.png' />
  			</div>
  			<div id='idiomas'>  
          <a href='".$url."&idioma=pt'><img src='images/bandeiras/portugues.gif' /></a>
          <a href='".$url."&idioma=en'><img src='images/bandeiras/ingles.gif' /></a>     
  			</div>
  		</div>
  		<div id='menu'>";
         include("content/menu.inc.php"); 
  echo "
  		</div>
  		<div id='navegacao'>
  			<div id='conteudo'>";
  				include($pag); 
  echo "</div>
  		</div>
  		<div id='rodape'>
  			2010 - Lucas de Ramos Araújo
  		</div>
  	</div>
  </body>
  	
  </HTML>
";

 function escreve($a,$b){
  if ($_COOKIE["idioma"]  == "pt")
    echo $a;
  elseif($_COOKIE["idioma"]  == "en")
    echo $b;
 }

?>