<?php

$conexao = mysql_connect("localhost","root","123");
if(!$conexao){
    		die('Não foi possível conectar: ' . mysql_error());
	}
	
        $result = mysql_query($sql);
	mysql_select_db("politicos_brasileiros", $conexao);
	mysql_set_charset("utf8");
        
        $sql = "SHOW TABLES FROM politicos_brasileiros";
        if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]} <br>";
    
    $query = mysql_query("SHOW COLUMNS FROM ".$row[0]);
 
    while ($coluna = mysql_fetch_assoc($query)) {
      $coluna = $coluna["Field"];
      mysql_query("UPDATE ".$row[0]." SET ".$coluna ." = REPLACE(".$coluna.",'&','&#38;')");
      echo $coluna." ";
}
echo '<br>';
}
?>