<?php					
        include '../properties.php';
        $dados = new Constant;
	$host = getProperty($dados->DB_HOST);
	$user = getProperty($dados->DB_USER);
	$pass = getProperty($dados->DB_PASS);
	$pltc = getProperty($dados->DB_PLTC);
        echo "<div class='divisao'>Outros Dados</div>";
	$config = array(
	  'db_host' => $host,//'localhost', 
	  'db_name' => $pltc,
	  'db_user' => $user,//'root',
	  'db_pwd' => $pass,
	  'store_name' => 'arc_tests',
	  'max_errors' => 100,
            
	);
        
	$store = ARC2::getStore($config);
	if (!$store->isSetUp()) {
	  $store->setUp();
	}
	
	while ($row_outros = mysql_fetch_array($sql_outros)){
		$uri = $row_outros['uri'];
	}
					
	$store->query('LOAD <'.$uri.'>');

	$q = '
	  PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
	  PREFIX dbpedia-owl: <http://dbpedia.org/ontology/> .
	  SELECT ?comment ?abstract WHERE {
		<'.$uri.'> rdfs:comment ?comment .
		<'.$uri.'> dbpedia-owl:abstract ?abstract .
	  }
	';
	echo "<ul>";
	if ($rows = $store->query($q, 'rows')) {
	  foreach ($rows as $row) {
		echo '<li>' . $row['comment'] . '</li>';
		echo '<li>' . $row['abstract'] . '</li>';
	  }
	}
	echo "</ul>";
?>

