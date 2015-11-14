<?php
$conexao = mysql_connect("localhost","root","123");
//$conexao = mysql_connect("localhost","root","");
mysql_select_db("politicos_brasileiros", $conexao);
mysql_set_charset("utf8");
?>