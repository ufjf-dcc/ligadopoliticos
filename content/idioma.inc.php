<?php

$endereco = $_SERVER ['REQUEST_URI'];
$parte_endereco = explode('&',$endereco);
$endereco = $parte_endereco[0];
				
$url = '';
if ($endereco == '/' || $endereco == '/?pag=resultadobusca')
  $endereco = '/?pag=home';
$url = 'http://ligadonospoliticos.com.br'.$endereco;

if (!isset($_COOKIE['idioma'])){
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if ($lang == 'pt')
	{
		setcookie("idioma","pt");
		setcookie("pais","BR");
	}
		else
	{
		setcookie("idioma","en");
		setcookie("pais","US");
	}
  	header("location:$url");
}

if (isset($_GET['idioma']))
{
	$idioma = $_GET['idioma'];
	setcookie("idioma",$idioma);
	$pais = $_GET['pais'];
	setcookie("pais",$pais);
	header("location:$url");
}

?>
