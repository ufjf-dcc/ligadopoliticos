<?php
	include("resultado_filtro.inc.php");
?>

<br />
<form name="formbusca" method="GET" class="formfiltro" onSubmit="return validaLimite();">
	<input type="hidden" name="pag" value= "<?php echo $_GET['pag']; ?>" />
	<input type="hidden" name="id_grafico" value= "<?php echo $_GET['id_grafico']; ?>" />
	<?php escreve("Situação:","Status:"); ?>
	<br />
    <select name="situacao" class="filtro">
        <option value="" />
        <option value="Em Exercicio"> <?php escreve("Eleito","In Office"); ?> </option>
        <option value="Fora de Exercicio"> <?php escreve("Não-Eleito","Out of Office"); ?> </option>
        </select>
    <br />
	<?php escreve("Cargo:","Office:"); ?>
	<br />
	<select name="cargo" class="filtro"> 
		<option value="" /> 
		<option value="Presidente "> <?php escreve("Presidente","President"); ?> </option>
		<option value="Vice-Presidente "> <?php escreve("Vice-Presidente","Vice President"); ?>  </option>
		<option value="Governador "> <?php escreve("Governador","Governor"); ?>  </option>
		<option value="Vice-Governador "> <?php escreve("Vice-Governador","Vice Governor"); ?>  </option>
		<option value="Senador "> <?php escreve("Senador","Senator"); ?>  </option>
		<option value="Senador 1º Suplente "> <?php escreve("1º Suplente Senador","1st Alternate Senator"); ?> </option>
		<option value="Senador2º Suplente "> <?php escreve("2º Suplente Senador","2nd Alternate Senator"); ?> </option>
		<option value="Deputado Federal "> <?php escreve("Deputado Federal","Congressman"); ?> </option>
		<option value="Deputado Estadual "> <?php escreve("Deputado Estadual","State Representative"); ?> </option>
		<option value="Deputado Distrital "> <?php escreve("Deputado Distrital","District Representative"); ?> </option>
	</select>

	<br />
	<?php escreve("Estado:","State:"); ?>
	<br />
	<select name="id_estado" class="filtro"> 
		<option value="" />
		<option value="ACRE"> ACRE </option>
		<option value="ALAGOAS"> ALAGOAS </option>
		<option value="AMAZONAS"> AMAZONAS </option>
		<option value="AMAPA"> AMAPA </option>
		<option value="BAHIA"> BAHIA </option>
		<option value="CEARA"> CEARA </option>
		<option value="DISTRITO FEDERAL"> DISTRITO FEDERAL </option>
		<option value="ESPIRITO SANTO"> ESPIRITO SANTO </option>
		<option value="GOIAS"> GOIAS </option>
		<option value="MARANHAO"> MARANHAO </option>
		<option value="MINAS GERAIS"> MINAS GERAIS </option>
		<option value="MATO GROSSO DO SUL"> MATO GROSSO DO SUL </option>
		<option value="MATO GROSSO"> MATO GROSSO </option>
		<option value="PARA"> PARA </option>
		<option value="PARAIBA"> PARAIBA </option>
		<option value="PERNAMBUCO"> PERNAMBUCO </option>
		<option value="PIAUI"> PIAUI </option>
		<option value="PARANA"> PARANA </option>
		<option value="RIO DE JANEIRO"> RIO DE JANEIRO </option>
		<option value="RIO GRANDE DO NORTE"> RIO GRANDE DO NORTE </option>
		<option value="RONDONIA"> RONDONIA </option>
		<option value="RORAIMA"> RORAIMA </option>
		<option value="RIO GRANDE DO SUL"> RIO GRANDE DO SUL </option>
		<option value="SANTA CATARINA"> SANTA CATARINA </option>
		<option value="SERGIPE"> SERGIPE </option>
		<option value="SAO PAULO"> SAO PAULO </option>
		<option value="TOCANTINS"> TOCANTINS </option>
	</select>

	<br />
	<?php escreve("Partido:","Party:"); ?>
	<br />
	<select name="partido" class="filtro"> 
		<option value="" /> 
		<option value="Democratas">DEM</option>
		<option value="Partido dos Aposentados da Nação">PAN</option>
		<option value="Partido Comunista do Brasil">PC do B</option>
		<option value="Partido Comunista Brasileiro">PCB</option>
		<option value="Partido da Causa Operária">PCO</option>
		<option value="Partido Democrático Trabalhista">PDT</option>
		<option value="Partido Humanista da Solidariedade">PHS</option>
		<option value="Partido do Movimento Democrático Brasileiro">PMDB</option>
		<option value="Partido da Mobilização Nacional">PMN</option>
		<option value="Partido Progressista">PP</option>
		<option value="Partido Pacifista Brasileiro">PPB</option>
		<option value="Partido Popular Socialista">PPS</option>
		<option value="Partido da República">PR</option>
		<option value="Partido Republicano Brasileiro">PRB</option>
		<option value="Partido Republicano Progressista">PRP</option>
		<option value="Partido Renovador Trabalhista Brasileiro">PRTB</option>
		<option value="Partido Socialista Brasileiro">PSB</option>
		<option value="Partido Social Cristão">PSC</option>
		<option value="Partido da Social Democracia Brasileira">PSDB</option>
		<option value="Partido Social Democrata Cristão">PSDC</option>
		<option value="Partido Social Liberal">PSL</option>
		<option value="Partido Socialismo e Liberdade">PSOL</option>
		<option value="Partido Socialismo e Liberdade">PST</option>
		<option value="Partido Socialista dos Trabalhadores Unificado">PSTU</option>
		<option value="Partido dos Trabalhadores">PT</option>
		<option value="Partido Trabalhista do Brasil">PT do B</option>
		<option value="Partido Trabalhista Brasileiro">PTB</option>
		<option value="Partido Trabalhista Cristão">PTC</option>
		<option value="Partido Trabalhista Nacional">PTN</option>
		<option value="Partido Verde">PV</option>
		<option value="S/Partido">S/Partido</option>
	</select>
	
	<br />
	<?php escreve("Sexo:","Gender:"); ?>
	<br />
	<select name="sexo" class="filtro"> 
		<option value="" /> 
		<option value="MASCULINO"><?php escreve("MASCULINO","Male"); ?></option>
		<option value="FEMININO"><?php escreve("FEMININO","Female"); ?></option>
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
        <option value=""> <?php escreve("",""); ?> </option>
		<option value="ORDER BY ASC (?x)"> <?php escreve("Alfabética (A-Z)","Alphabetical (A-Z)"); ?> </option>
		<option value="ORDER BY DESC (?x)"> <?php escreve("Alfabética (Z-A)","Alphabetical (Z-A)"); ?> </option>
		<option value="" selected> <?php escreve("Valor (Maior-Menor)","Value (Desc)"); ?> </option>
		<option value=""> <?php escreve("Valor (Menor-Maior)","Value (Asc)"); ?> </option>
	</select>

	<br />
	<br />
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