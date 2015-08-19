<?php
        //include ('../config.php');
        //include ('../consultasSPARQL.php');
	//mysql_select_db("politicos_brasileiros", $conexao);
	mysql_set_charset("utf8");
	$nome_parlamentar = '';
	//$sql1 = mysql_query("SELECT * FROM politico WHERE id_politico = '$recurso'");
        $sparql1 = consultaSPARQL('
            select  ?nome_civil ?nome_parlamentar ?nome_pai ?nome_mae ?foto ?sexo ?cor ?data_nascimento ?estado_civil ?ocupacao ?grau_instrucao ?nacionalidade
            ?cidade_nascimento ?estado_nascimento ?cidade_estado_eleitoral ?site ?email ?cargo ?cargo_uf ?partido ?situacao
            where {
              <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:name ?nome_civil .
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:governmentalName ?nome_parlamentar }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> bio:father ?nome_pai }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> bio:father ?nome_mae }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:img ?foto }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:gender ?sexo }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> person:complexion ?cor }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:birthday ?data_nascimento }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:maritalStatus ?estado_civil }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> person:occupation ?ocupacao }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> dcterms:educationLevel ?grau_instrucao }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> dbpprop:nationality ?nacionalidade }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> being:place-of-birth ?cidade_nascimento }. 
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:state-of-birth ?estado_nascimento }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:place-of-vote ?cidade_estado_eleitoral }
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> foaf:homepage ?site }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> biblio:Email ?email }. 
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> pol:Office ?cargo }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:officeState ?cargo_uf }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> pol:party ?partido }.
              OPTIONAL{ <http://ligadonospoliticos.com.br/politico/'.$recurso.'> polbr:situation ?situacao }.        
              FILTER isliteral(?cidade_nascimento).
              FILTER isliteral(?partido)
                      }LIMIT 1');
        foreach ($sparql1 as $row){
                $nome_civil = $row['nome_civil'];
		//$foto = $row['foto'];	
		
                //echo $row['foto'];
               
		echo "<h2>".$nome_civil."&nbsp;&nbsp;<a href='../../../ligadopoliticos/politico/$recurso/rdf' style='decoration:none;'><img src='../../images/rdf_icon.gif' border=0 height='18px' /></a><iframe src='http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fligadonospoliticos.com.br%2Fpolitico%2F".$recurso."%2Fhtml%2F&action=like' scrolling='no' frameborder='0' style='height: 62px; width: 100%' allowTransparency='true'></iframe></h2>";
		
		//if(isset($row['foto']) )
		//http://ligadonospoliticos.com.br/images/politicos/1.jpeg  
                echo "<div id='foto' style='float:right;'> <img src= ../../images/politicos/".$recurso.".jpeg></div>";
		echo "<div id='dados_atuais' style='float:left;'>"; 
               

		if(isset($row['nome_parlamentar']) )
                    if($row['nome_parlamentar']!= null)
			echo "<b>Nome Parlamentar:</b> ".$row['nome_parlamentar']."<br />";					
		if(isset($row['situacao']) )
                    if($row['situacao']!= null)
			echo "<b>Situação:</b> <a href='../../?pag=resultadobusca&situacao=".$row['situacao']."'>".$row['situacao']."</a><br />";
		if(isset($row['cargo']) )
                    if($row['cargo']!= null)
			echo "<b>Cargo:</b> <a href='../../?pag=resultadobusca&cargo1=".$row['cargo']."'>".$row['cargo']."</a><br />";
		if(isset($row['cargo_uf']) )
                    if($row['cargo_uf']!= null)
			echo "<b>Estado:</b> <a href='../../?pag=resultadobusca&estado=".$row['cargo_uf']."'>".$row['cargo_uf']."</a><br />";
		if(isset($row['partido']) )
                    if($row['partido']!= null)
			echo "<b>Partido:</b> <a href='../../?pag=resultadobusca&partido=".$row['partido']."'>".$row['partido']."</a><br />";			
		if(isset($row['data_nascimento']) )
                    if($row['data_nascimento']!= null)
			//$data_nascimento = date('d/m/Y', strtotime($row['data_nascimento']));
			echo "<b>Data de Nascimento:</b> ".$row['data_nascimento']."<br />";
		
		if(isset($row['nome_pai']) )
                    if($row['nome_pai']!= null)
			echo "<b>Nome do Pai:</b> ".$row['nome_pai']."<br />";
		if(isset($row['nome_mae']) )
                    if($row['nome_mae']!= null)
			echo "<b>Nome da Mãe:</b> ".$row['nome_mae']."<br />";
		if(isset($row['sexo']) )
                    if($row['sexo']!= null)
			echo "<b>Sexo:</b> <a href='../../?pag=resultadobusca&nome=&situacao=&cargo1=&cargo2=&estado=&partido=&sexo=&cidade_nascimento=&estado_nascimento=&sexo=".$row['sexo']."'>".$row['sexo']."</a><br />";
		if(isset($row['cor']) )	
                    if($row['cor']!= null)
			echo "<b>Cor:</b> <a href='../../?pag=resultadobusca&cor=".$row['cor']."'>".$row['cor']."</a><br />";
		if(isset($row['estado_civil']) )
                    if($row['estado_civil']!= null)
			echo "<b>Estado Civil:</b> <a href='../../?pag=resultadobusca&estado_civil=".$row['estado_civil']."'>".$row['estado_civil']."</a><br />";
		if(isset($row['ocupacao']) )
                    if($row['ocupacao']!= null)
			echo "<b>Ocupação:</b> <a href='../../?pag=resultadobusca&ocupacao=".$row['ocupacao']."'>".$row['ocupacao']."</a><br />";
		if(isset($row['grau_instrucao']) )
                    if($row['grau_instrucao']!= null)
			echo "<b>Grau de Instrução:</b> <a href='../../?pag=resultadobusca&grau_instrucao=".$row['grau_instrucao']."'>".$row['grau_instrucao']."</a><br />";
		if(isset($row['nacionalidade']) )
                    if($row['nacionalidade']!= null)
			echo "<b>Nacionalidade:</b> <a href='../../?pag=resultadobusca&nacionalidade=".$row['nacionalidade']."'>".$row['nacionalidade']."</a><br />";
		if(isset($row['cidade_nascimento']) )
                    if($row['cidade_nascimento']!= null)
			echo "<b>Cidade de Nascimento:</b> <a href='../../?pag=resultadobusca&cidade_nascimento=".$row['cidade_nascimento']."'>".$row['cidade_nascimento']."</a><br />";
		if(isset($row['estado_nascimento']) )
                    if($row['estado_nascimento']!= null)
			echo "<b>Estado de Nascimento:</b> <a href='../../?pag=resultadobusca&estado_nascimento=".$row['estado_nascimento']."'>".$row['estado_nascimento']."</a><br />";
		if(isset($row['cidade_estado_eleitoral']) )
                    if($row['cidade_estado_eleitoral']!= null)
			echo "<b>Cidade e Estado Eleitoral:</b> <a href='../../?pag=resultadobusca&cidade_estado_eleitoral=".$row['cidade_estado_eleitoral']."'>".$row['cidade_estado_eleitoral']."</a><br />";
		if(isset($row['email']) )
                    if($row['email']!= null)
			echo "<b>E-mail:</b> ".$row['email']."<br />";
		if(isset($row['site']) )
                    if($row['site']!= null)
			echo "<b>Site:</b> <a href='".$row['site']."'>".$row['site']."</a><br />"; 
		
		
		if ($nome_parlamentar <> '' AND $nome_parlamentar <> NULL)
		{	
			$parte_nome_parlamentar = explode (" ", $nome_parlamentar);
			$teste = sizeof($parte_nome_parlamentar);
			$q = '';
			for ($i=0;$i < sizeof($parte_nome_parlamentar); $i++)
				$q = $q.$parte_nome_parlamentar[$i]."+";
		}
		else
		{
			$parte_nome_civil = explode (" ", $nome_civil);
			$q = $parte_nome_civil[0]."+".$parte_nome_civil[sizeof($parte_nome_civil)-1];	
		}
	}
	echo "</div>";
?>
