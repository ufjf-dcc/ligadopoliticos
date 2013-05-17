<?php
 function escreve($a,$b){
  if ($_COOKIE["idioma"]  == "pt")
    echo $a;
  elseif($_COOKIE["idioma"]  == "en")
    echo $b;
 }
$endereco = $_SERVER ['REQUEST_URI'];

echo $endereco;

				$parte_endereco = explode('&',$endereco);
				$recurso = $parte_endereco[0];

echo '<br />'.$recurso;
?>

<input type="submit" value="<?php escreve("Buscar","Search"); ?>" />

