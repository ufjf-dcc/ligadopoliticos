<?php				
	echo "<div class='divisao'>Afastamentos</div>";	
	while($row = mysql_fetch_array($sql4)){	
		if ($row['cargo'] <> '' AND $row['cargo'] <> NULL)					
			echo "<b>Cargo:</b> ".$row['cargo']."<br />";					
		if ($row['cargo_uf'] <> '' AND $row['cargo_uf'] <> NULL)				
			echo "<b>Estado:</b> ".$row['cargo_uf']."<br />";
		if ($row['data'] <> '' AND $row['data'] <> NULL){		
			$data = date('d/m/Y', strtotime($row['data']));
			echo "<b>Data:</b> ".$data."<br />";
		}
		if ($row['tipo'] <> '' AND $row['tipo'] <> NULL)					
			echo "<b>Tipo:</b> ".$row['tipo']."<br />";
		if ($row['motivo'] <> '' AND $row['motivo'] <> NULL)					
			echo "<b>Motivo:</b> ".$row['motivo']."<br />";
		echo "<br />";	
	}				
?>