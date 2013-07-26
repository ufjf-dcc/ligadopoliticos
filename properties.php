<?php	
	class Constant{
  
		public $DB_HOST = "db.host=";
		public $DB_USER = "db.user=";
		public $DB_PASS = "db.pass=";
		public $DB_PLTC = "db.pltc=";

	}	

	function getProperty($string){

		$dados = fopen("application.properties","r");
		
		while (!feof($dados)) {

			$linha = fgets($dados, 4096);

			$pos = stripos($linha, $string);
			

			if($pos !== false) {
				
				$db= trim(str_replace($string,"",$linha));
				
			}
		
		}
			
		fclose($dados);
		

		return $db;	
	}

	
?>
