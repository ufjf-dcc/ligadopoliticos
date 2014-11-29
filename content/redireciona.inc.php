<?php
 $recurso = $_SERVER ['REQUEST_URI'];
$parte_endereco = explode('/',$recurso);
$id_politico = $parte_endereco[3];
$i = 0;
$novo_recurso = '';
while($i <= 3)
{
    $novo_recurso = $novo_recurso . $parte_endereco[$i].'/';
    $i++;
}
 $redireciona = '';
 $redireciona =  strstr($redireciona,'rdf');
	if ($redireciona <> '')
		header("Location: ".$novo_recurso."rdf");
	else
		header("Location: ".$novo_recurso."html");
		
?>
