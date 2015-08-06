<?php  
	$endereco = $_SERVER ['REQUEST_URI'];
	$parte_endereco = explode ('/', $endereco);
	$recurso = $parte_endereco[4];

        if ( $recurso =='html'){
            include('content/politico_html.inc.php');
        }
        else if ($recurso =='rdf'){
            include('content/politico_rdf.inc.php');
        }
        else{
            include('content/redireciona.inc.php');
        }
 ?>
