<?php 
	
	$dados = new Constant;
	$host = getProperty($dados->DB_HOST);
	$user = getProperty($dados->DB_USER);
	$pass = getProperty($dados->DB_PASS);
	$pltc = getProperty($dados->DB_PLTC);
  
	$conexao = mysql_connect($host,$user,$pass);
        if(!$conexao){
    		die('Não foi possível conectar: ' . mysql_error());
	}

	mysql_select_db($pltc, $conexao);
	mysql_set_charset("utf8");

?>
