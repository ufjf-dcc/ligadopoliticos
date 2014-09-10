<?php
 $recurso = $_SERVER ['REQUEST_URI'];
$parte_endereco = explode('/',$recurso);
$tamanho = count($parte_endereco);
$tamanho--;
$id_politico = $parte_endereco[$tamanho];
$novo_recurso;
$i = 0;
while($i < $tamanho)
{
    $novo_recurso = $novo_recurso . $parte_endereco[$i].'/';
    $i++;
}
//echo $novo_recurso.' </br>';
 $novo_recurso = $novo_recurso.$id_politico;
 $redireciona = '';
 $redireciona =  strstr($redireciona,'rdf');
	if ($redireciona <> '')
		header("Location: ".$novo_recurso."rdf");
	else
		header("Location: ".$novo_recurso."html");
		
?>
