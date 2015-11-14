<?php 
     include ('../properties.php');
     include ('../consultasSPARQL.php');
     include '../config.php';
     $recurso = 18924;
   $sql10 = mysql_query("SELECT * FROM missao WHERE id_politico = '$recurso'");
				$cont10 = mysql_num_rows($sql10);
				if ($cont10 > 0){
					include("politico_html_missoes.inc.php");
				}
     ?>