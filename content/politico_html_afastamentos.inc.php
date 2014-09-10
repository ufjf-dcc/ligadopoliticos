<?php				
	echo "<div class='divisao'>Afastamentos</div>";		
	foreach ($sparql4 as $row){
                if (isset($row['cargo']))					
			echo "<b>Cargo:</b> ".$row['cargo']."<br />";					
		if (isset($row['cargo_uf']))				
			echo "<b>Estado:</b> ".$row['cargo_uf']."<br />";
		if (isset($row['data'])){
			echo "<b>Data:</b> ".$row['data']."<br />";
		}
		if (isset($row['tipo']))					
			echo "<b>Tipo:</b> ".$row['tipo']."<br />";
		if (isset($row['motivo']))					
			echo "<b>Motivo:</b> ".$row['motivo']."<br />";
		echo "<br />";	
	}				
?>