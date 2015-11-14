<?php
	include("resultado_filtro_sql.php");
?>

<br />
<form name="formbusca" method="GET" class="formfiltro" onSubmit="return validaLimite();">
	<input type="hidden" name="pag" value= "<?php echo $_GET['pag']; ?>" />
	<input type="hidden" name="id_grafico" value= "<?php echo $_GET['id_grafico']; ?>" />
	<?php escreve("Situação:","Status:"); ?>
	<br />
	<select name="situacao" class="filtro"> 
		<option value="" /> 
		<option value="Em Exercicio"> <?php escreve("Em Exercício","In Office"); ?> </option>
		<option value="Fora de Exercicio"> <?php escreve("Fora de Exercício","Out of Office"); ?> </option>
		<option value="Candidato"> <?php escreve("Candidato","Candidate"); ?> </option>
		<option value="Candidato Eleito"> <?php escreve("Candidato Eleito","Elected Candidate"); ?> </option>
		<option value="Candidato Nao-Eleito"> <?php escreve("Candidato Não-Eleito","Non-Elected Candidate"); ?> </option>
	</select>
	
	<br />
	<?php escreve("Cargo:","Office:"); ?>
	<br />
	<select name="cargo" class="filtro"> 
		<option value="" /> 
		<option value="Presidente"> <?php escreve("Presidente","President"); ?> </option>
		<option value="Vice-Presidente"> <?php escreve("Vice-Presidente","Vice President"); ?>  </option>
		<option value="Governador"> <?php escreve("Governador","Governor"); ?>  </option>
		<option value="Vice-Governador"> <?php escreve("Vice-Governador","Vice Governor"); ?>  </option>
		<option value="Senador"> <?php escreve("Senador","Senator"); ?>  </option>
		<option value="1º Suplente Senador"> <?php escreve("1º Suplente Senador","1st Alternate Senator"); ?> </option>
		<option value="2º Suplente Senador"> <?php escreve("2º Suplente Senador","2nd Alternate Senator"); ?> </option>
		<option value="Deputado Federal"> <?php escreve("Deputado Federal","Congressman"); ?> </option>
		<option value="Deputado Estadual"> <?php escreve("Deputado Estadual","State Representative"); ?> </option>
		<option value="Deputado Distrital"> <?php escreve("Deputado Distrital","District Representative"); ?> </option>
	</select>

	<br />
	<?php escreve("Estado:","State:"); ?>
	<br />
	<select name="id_estado" class="filtro"> 
		<option value="" /> 
		<option value="AC"> Amazonas </option>
		<option value="AL"> Alagoas </option>
		<option value="AM"> Amazonas </option>
		<option value="AP"> Amapá </option>
		<option value="BA"> Bahia </option>
		<option value="CE"> Ceará </option>
		<option value="DF"> Distrito Federal </option>
		<option value="ES"> Espírito Santo </option>
		<option value="GO"> Goiás </option>
		<option value="MA"> Maranhão </option>
		<option value="MG"> Minas Gerais </option>
		<option value="MS"> Mato Grosso do Sul </option>
		<option value="MT"> Mato Grosso </option>
		<option value="PA"> Pará </option>
		<option value="PB"> Paraíba </option>
		<option value="PE"> Pernambuco </option>
		<option value="PI"> Piauí </option>
		<option value="PR"> Paraná </option>
		<option value="RJ"> Rio de Janeiro </option>
		<option value="RN"> Rio Grande do Norte </option>
		<option value="RO"> Rondônia </option>
		<option value="RR"> Roraima </option>
		<option value="RS"> Rio Grande do Sul </option>
		<option value="SC"> Santa Catarina </option>
		<option value="SE"> Sergipe </option>
		<option value="SP"> São Paulo </option>
		<option value="TO"> Tocantins </option>
	</select>

	<br />
	<?php escreve("Partido:","Party:"); ?>
	<br />
	<select name="partido" class="filtro"> 
		<option value="" /> 
		<option value="DEM">DEM</option>
		<option value="PAN">PAN</option>
		<option value="PC do B">PC do B</option>
		<option value="PCB">PCB</option>
		<option value="PCO">PCO</option>
		<option value="PDT">PDT</option>
		<option value="PHS">PHS</option>
		<option value="PMDB">PMDB</option>
		<option value="PMN">PMN</option>
		<option value="PP">PP</option>
		<option value="PPB">PPB</option>
		<option value="PPS">PPS</option>
		<option value="PR">PR</option>
		<option value="PRB">PRB</option>
		<option value="PRP">PRP</option>
		<option value="PRTB">PRTB</option>
		<option value="PSB">PSB</option>
		<option value="PSC">PSC</option>
		<option value="PSDB">PSDB</option>
		<option value="PSDC">PSDC</option>
		<option value="PSL">PSL</option>
		<option value="PSOL">PSOL</option>
		<option value="PST">PST</option>
		<option value="PSTU">PSTU</option>
		<option value="PT">PT</option>
		<option value="PT do B">PT do B</option>
		<option value="PTB">PTB</option>
		<option value="PTC">PTC</option>
		<option value="PTN">PTN</option>
		<option value="PV">PV</option>
		<option value="S/Partido">S/Partido</option>
	</select>
	
	<br />
	<?php escreve("Sexo:","Gender:"); ?>
	<br />
	<select name="sexo" class="filtro"> 
		<option value="" /> 
		<option value="Masculino"><?php escreve("Maculino","Male"); ?></option>
		<option value="Feminino"><?php escreve("Feminino","Female"); ?></option>
	</select>

	<br />
	<?php escreve("Cidade de Nascimento:","City of birth:"); ?>
	<br />
	<input type="text" name="cidade_nascimento" class="filtro" value="<?php echo $cidade_nascimento; ?>" />
	
	<br />
	<?php escreve("Estado de Nascimento:","State of birth:"); ?>
	<br />
	<select name="estado_nascimento" class="filtro"> 
		<option value="" /> 
		<option value="AC"> Amazonas </option>
		<option value="AL"> Alagoas </option>
		<option value="AM"> Amazonas </option>
		<option value="AP"> Amapá </option>
		<option value="BA"> Bahia </option>
		<option value="CE"> Ceará </option>
		<option value="DF"> Distrito Federal </option>
		<option value="ES"> Espírito Santo </option>
		<option value="GO"> Goiás </option>
		<option value="MA"> Maranhão </option>
		<option value="MG"> Minas Gerais </option>
		<option value="MS"> Mato Grosso do Sul </option>
		<option value="MT"> Mato Grosso </option>
		<option value="PA"> Pará </option>
		<option value="PB"> Paraíba </option>
		<option value="PE"> Pernambuco </option>
		<option value="PI"> Piauí </option>
		<option value="PR"> Paraná </option>
		<option value="RJ"> Rio de Janeiro </option>
		<option value="RN"> Rio Grande do Norte </option>
		<option value="RO"> Rondônia </option>
		<option value="RR"> Roraima </option>
		<option value="RS"> Rio Grande do Sul </option>
		<option value="SC"> Santa Catarina </option>
		<option value="SE"> Sergipe </option>
		<option value="SP"> São Paulo </option>
		<option value="TO"> Tocantins </option>
	</select>

	<br />
	<?php escreve("Gráfico:","Chart:"); ?>
	<br />
	<select name="grafico" class="filtro"> 
		<option value="FCF_Area2D"> <?php escreve("Área","Area"); ?> </option>
		<option value="FCF_Bar2D" selected> <?php escreve("Barra","Bar"); ?> </option>
		<option value="FCF_Column2D"> <?php escreve("Coluna 2D","Column 2D"); ?> </option>
		<option value="FCF_Column3D"> <?php escreve("Coluna 3D","Column 3D"); ?> </option>		
		<option value="FCF_Funnel"> <?php escreve("Funil","Funnel"); ?> </option>
		<option value="FCF_Line"> <?php escreve("Linha","Line"); ?> </option>
		<option value="FCF_Pie2D"> <?php escreve("Pizza 2D","Pie 2D"); ?> </option>
		<option value="FCF_Pie3D"> <?php escreve("Pizza 3D","Pie 3D"); ?> </option>
		<option value="FCF_Doughnut2D"> <?php escreve("Rosca","Doughnut"); ?> </option>
	</select>

	<br />
	<?php escreve("Ordem:","Order:"); ?>
	<br />
	<select name="ordem" class="filtro"> 
		<option value="nome ASC"> <?php escreve("Alfabética (A-Z)","Alphabetical (A-Z)"); ?> </option>
		<option value="nome DESC"> <?php escreve("Alfabética (Z-A)","Alphabetical (Z-A)"); ?> </option>
		<option value="valor DESC" selected> <?php escreve("Valor (Maior-Menor)","Value (Desc)"); ?> </option>
		<option value="valor ASC"> <?php escreve("Valor (Menor-Maior)","Value (Asc)"); ?> </option>
	</select>

	<br />
	<?php escreve("Limite:","Limit:"); ?>
	<br />
	<input type="text" name="limite1" style="width:55px;" align="center" value="<?php echo $limite1; ?>" />	-
	<input type="text" name="limite2" style="width:55;" align="center" value="<?php echo $limite2; ?>" /> 
	<br /><br />
	<input type="submit" value="OK" />
</form>

<?php
echo "
<script language='javascript'>

	
	function selecionaCampo()
	{
		document.formbusca.situacao.value = '". $situacao ."';
		document.formbusca.cargo.value = '". $cargo ."';
		document.formbusca.id_estado.value = '". $id_estado ."';
		document.formbusca.partido.value = '". $partido ."';
		document.formbusca.sexo.value = '". $sexo ."';
		document.formbusca.cidade_nascimento.value = '". $cidade_nascimento ."';
		document.formbusca.estado_nascimento.value = '". $estado_nascimento ."';
		document.formbusca.grafico.value = '". $grafico ."';
		document.formbusca.ordem.value = '". $ordem ."';
	}
	selecionaCampo();
	

</script>
";
?>