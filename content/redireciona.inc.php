<?php
 $recurso = $_SERVER ['REQUEST_URI'];
 $parte_endereco = explode('/',$recurso);
 $id_politico = $parte_endereco[2];

 $redireciona = '';
 $redireciona = $_SERVER['HTTP_ACCEPT'];
 $redireciona =  strstr($redireciona,'rdf');
	if ($redireciona <> '')
		header("Location: http://ligadonospoliticos.com.br/politico/$id_politico/rdf");
	else
		header("Location: http://ligadonospoliticos.com.br/politico/$id_politico/html");
		
?>
