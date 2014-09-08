<?php

for ($i = 1; $i <= 22693; $i++)
{
echo $i;
$abre = '../resource/'.$i.'/index.php';
$fp = fopen($abre, "w");

$escrita = "<?php include('../../content/redireciona.inc.php'); ?>";

$escreve = fwrite($fp, $escrita);

fclose($fp);

}
?>