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
	$row = 0;
	while ($valores = fgetcsv ($abraArq, 2048, ",")) {
		if ($row >= 0){
			$id_politico = ''; 
			$sql = mysql_query("SELECT id_politico,COUNT(id_politico) FROM politico WHERE nome_civil LIKE '$valores[12]'") or die(mysql_error());
			while($row2 = mysql_fetch_array($sql)){
				$id_politico = $row2[0];
				$quantidade = $row2[1];
			}
				if ($quantidade == 1){
					echo "------ UPDATE: ".$valores[12]."<br />";
					mysql_query("UPDATE politico SET nome_parlamentar = '$valores[0]', situacao = 'Em exercício', atuacao = '$valores[3]', ocupacao = '$valores[11]', partido = '$valores[1]', cargo_uf = '$valores[2]', cargo='Deputado' WHERE id_politico='$id_politico' ") or die(mysql_error());
				}
				elseif ($quantidade == 0)
				{
					echo "****** INSERT: ".$valores[12]."<br />";
					//mysql_query("INSERT INTO politico SET nome_civil = '$valores[12]', nome_parlamentar = '$valores[0]', situacao = '$valores[3]', ocupacao = '$valores[11]', partido = '$valores[1]', cargo_uf = '$valores[2]', cargo='Deputado' WHERE id_politico='$id_politico' ") or die("ERRO NO COMANDO SQL");
				}
				elseif ($quantidade > 1)
				{
					echo "DUPLICADO: ".$valores[12]."<br />";
				}
		}
		$row++;
	}
}
fclose($abraArq);

?>