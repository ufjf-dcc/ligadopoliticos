<?php	
	class Constant{
  
		public $DB_HOST = "db.host=";
		public $DB_USER = "db.user=";
		public $DB_PASS = "db.pass=";
		public $DB_PLTC = "db.pltc=";
                public $DB_LOGIN_SPARQL = "db.login_sparql=";
                public $DB_URL_SPARQL = "db.url_sparql=";
                
	}	

	function getProperty($string){
                $parte= "application.properties";
                while(!file_exists($parte))
                    $parte = "../" . $parte;
                
                
		$dados = fopen($parte,"r");
                
                
                
                
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
