<?php
echo '
	<form name="formbusca" method="GET">
		<input type="hidden" name="pag" value="resultadobusca" />
		Nome: <input type="text" name="nome" size="127" /> 
		<br/>
		Cargo:
		<select name="cargo" /> 
			<option value="" /> 
			<option value="Senador"> Presidente </option>
			<option value="Senador"> Vice-Presidente </option>
			<option value="Senador"> Governador </option>
			<option value="Senador"> Vice-Governador </option>
			<option value="Senador"> Senador </option>
			<option value="Senador"> Primeiro-Suplente Senador </option>
			<option value="Senador"> Segundo-Suplente Senador </option>
			<option value="Senador"> Deputado Federal </option>
			<option value="Senador"> Deputado Estadual </option>
			<option value="Senador"> Deputado Distrital </option>
		</select>
		Situacao:
		<select name="situacao" /> 
			<option value="" /> 
			<option value="Em Exercicio"> Em exerc�cio </option>
			<option value="Fora de Exercicio"> Fora de Exerc�cio </option>
			<option value="Candidato"> Candidato </option>
			<option value="Candidato Eleito"> Candidato Eleito </option>
			<option value="Candidato Nao-Eleito"> Candidato N�o-Eleito </option>
		</select>
		Estado: 
		<select name="estado" /> 
			<option value="" /> 
			<option value="AC"> Amazonas </option>
			<option value="AL"> Alagoas </option>
			<option value="AM"> Amazonas </option>
			<option value="AP"> Amap� </option>
			<option value="BA"> Bahia </option>
			<option value="CE"> Cear� </option>
			<option value="DF"> Distrito Federal </option>
			<option value="ES"> Esp�rito Santo </option>
			<option value="GO"> Goi�s </option>
			<option value="MA"> Maranh�o </option>
			<option value="MG"> Minas Gerais </option>
			<option value="MS"> Mato Grosso do Sul </option>
			<option value="MT"> Mato Grosso </option>
			<option value="PA"> Paran� </option>
			<option value="PB"> Para�ba </option>
			<option value="PE"> Pernambuco </option>
			<option value="PI"> Piau� </option>
			<option value="PR"> Paran� </option>
			<option value="RJ"> Rio de Janeiro </option>
			<option value="RN"> Rio Grande do Norte </option>
			<option value="RO"> Rond�nia </option>
			<option value="RR"> Roraima </option>
			<option value="RS"> Rio Grande do Sul </option>
			<option value="SC"> Santa Catarina </option>
			<option value="SE"> Sear� </option>
			<option value="SP"> S�o Paulo </option>
			<option value="TO"> Tocantins </option>
		</select>
		Partido:
		<select name="partido" /> 
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
		<p align="center">
			<input type="submit" value="Buscar" />
		</p>
	</form>
';
?>