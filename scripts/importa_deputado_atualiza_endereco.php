<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
ini_set('max_execution_time','120');
?>

<?php
include("../config.php");
$conta = 0;
$abraArq = fopen("deputado.csv", "r");
if (!$abraArq){
	echo ("<p>Arquivo não encontrado</p>");
}
else{
	$linha = 0;
	while ($valores = fgetcsv ($abraArq, 2048, ",")) {
		if ($linha >= 0){
			$id_politico = ''; 
			
			$sql = mysql_query("SELECT id_politico FROM politico WHERE nome_civil LIKE '$valores[12]'") or die(mysql_error());
			while($row = mysql_fetch_array($sql)){
				$id_politico = $row[0];
			}
			
			$sql2 = mysql_query("SELECT COUNT(id_politico) FROM endereco_parlamentar_politico WHERE id_politico = '$id_politico'") or die(mysql_error());
			while($row2 = mysql_fetch_array($sql2)){
				$quantidade = $row2[0];
			}
			
			if ($quantidade == 1){
				echo "------ UPDATE: ".$valores[12]."<br />";				
				mysql_query("UPDATE endereco_parlamentar_politico SET id_endereco_parlamentar='2', anexo = '$valores[4]', gabinete = '$valores[5]', telefone = '$valores[6]', fax = '$valores[7]', email = '$valores[10]' WHERE id_politico = '$id_politico'") or die("ERRO NO COMANDO SQL");
			}
			elseif ($quantidade == 0)
			{
				echo "****** INSERT: ".$valores[12]."<br />";
				mysql_query("INSERT INTO endereco_parlamentar_politico SET id_endereco_parlamentar='2', id_politico='$id_politico', anexo = '$valores[4]', gabinete = '$valores[5]', telefone = '$valores[6]', fax = '$valores[7]', email = '$valores[10]' ") or die("ERRO NO COMANDO SQL");
			}
			elseif ($quantidade > 1)
			{
				echo "DUPLICADO: ".$valores[12]."<br />";
			}
		}
		$linha++;
	}
}
fclose($abraArq);

?>