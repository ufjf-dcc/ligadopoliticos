<?php
$conexao = mysql_connect("mysql02.redehost.com.br","lucas.ufjf","99l9m2g1");
//$conexao = mysql_connect("localhost","root","");
mysql_select_db("politicos_brasileiros", $conexao);
mysql_set_charset("utf8");
?>