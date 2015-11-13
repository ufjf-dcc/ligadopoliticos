<div style="float:left;">
<h3><?php escreve("Busca","Search"); ?></h3>
	<form name="formbusca" method="GET">
		<input type="hidden" name="pag" value="resultadobusca" />
		<table>
		<tr>
			<td>
				<?php escreve("Nome:","Name:"); ?>
			</td>
			<td>
				<input type="text" name="nome" size="55" />
			</td>
		</tr>
                <tr>
                    <td>
                        <?php escreve("Ano:","Year:"); ?>
                    </td>
                    <td>
                        <select name="ano">
                            <?php 
                            $consultaAnos ="select ?ano
                                            where{ ?id_politico polbr:election ?election. 
                                                   ?election timeline:atYear ?ano
                                                             }
                                            group by ?ano
                                            order by ?ano";
                            $resultadoAnos = consultaSPARQL($consultaAnos);
                            foreach ($resultadoAnos as $anos){
                                echo '<option value="'.$anos['ano'].'">'.$anos['ano'].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
		<tr>
			<td>
				<?php escreve("Situação:","Status:"); ?>
			</td>
			<td>
				<select name="situacao" onChange="visibilidadeCargo()" /> 
					<option value="" /> 
					<option value="Em Exercicio"> <?php escreve("Em Exercício","In Office"); ?> </option>
					<option value="Fora de Exercicio"> <?php escreve("Fora de Exercício","Out of Office"); ?> </option>
					<option value="Candidato"> <?php escreve("Candidato","Candidate"); ?> </option>
					<option value="Candidato Eleito"> <?php escreve("Candidato Eleito","Elected Candidate"); ?> </option>
					<option value="Candidato Nao-Eleito"> <?php escreve("Candidato Não-Eleito","Non-Elected Candidate"); ?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<?php escreve("Cargo:","Office:"); ?>
			</td>
			<td>
			  <div id='cargo1'>
  				<select name="cargo1" /> 
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
                                        <option value="Prefeito"> <?php escreve("Prefeito","Mayor"); ?> </option>
                                        <option value="Vice-prefeito"> <?php escreve("Vice-prefeito","Deputy mayor"); ?> </option>
                                        <option value="Vereador"> <?php escreve("Vereador","Alderman"); ?> </option>
  				</select>
  			</div>
			  <div id='cargo2'>
  				<select name="cargo2" /> 
  					<option value="" /> 
  					<option value="Presidente"> <?php escreve("Presidente","President"); ?> </option>
  					<option value="Vice-Presidente"> <?php escreve("Vice-Presidente","Vice President"); ?>  </option>
  					<option value="Governador"> <?php escreve("Governador","Governor"); ?>  </option>
  					<option value="Vice-Governador"> <?php escreve("Vice-Governador","Vice Governor"); ?>  </option>
  					<option value="Senador"> <?php escreve("Senador","Senator"); ?>  </option>
  					<option value="Deputado Federal"> <?php escreve("Deputado Federal","Congressman"); ?> </option>
  				</select>
  			</div>
			</td>
		</tr>
		<tr>
			<td>
				<?php escreve("Estado:","State:"); ?>
			</td>
			<td>		
				<select name="estado" /> 
					<option value="" /> 
					<option value="AC"> Acre </option>
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
			</td>
		</tr>
		<tr>
			<td>
				<?php escreve("Partido:","Party:"); ?>
			</td>
			<td>
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
					<option value="S/ Partido">S/Partido</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<?php escreve("Sexo:","Gender:"); ?>
			</td>
			<td>
				<select name="sexo" /> 
					<option value="" /> 
					<option value="MASCULINO"><?php escreve("Maculino","Male"); ?></option>
					<option value="FEMININO"><?php escreve("Feminino","Female"); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<?php escreve("Naturalidade:","Place of birth:"); ?>
			</td>
			<td>
				<input type="text" name="cidade_nascimento" size="45" />
				<select name="estado_nascimento" /> 
					<option value="" /> 
					<option value="AC"> AC </option>
					<option value="AL"> AL </option>
					<option value="AM"> AM </option>
					<option value="AP"> AP </option>
					<option value="BA"> BA </option>
					<option value="CE"> CE </option>
					<option value="DF"> DF </option>
					<option value="ES"> ES </option>
					<option value="GO"> GO </option>
					<option value="MA"> MA </option>
					<option value="MG"> MG </option>
					<option value="MS"> MS </option>
					<option value="MT"> MT </option>
					<option value="PA"> PA </option>
					<option value="PB"> PB </option>
					<option value="PE"> PE </option>
					<option value="PI"> PI </option>
					<option value="PR"> PR </option>
					<option value="RJ"> RJ </option>
					<option value="RN"> RN </option>
					<option value="RO"> RO </option>
					<option value="RR"> RR </option>
					<option value="RS"> RS </option>
					<option value="SC"> SC </option>
					<option value="SE"> SE </option>
					<option value="SP"> SP </option>
					<option value="TO"> TO </option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="<?php escreve("Buscar","Search"); ?>" />
			</td>	
		</tr>
		</table>
	</form>
</div>
<div style="float:right;">
  <h3 align="center"><?php escreve("Estados","States"); ?></h3>
	<?php include("content/mapa.inc.php"); ?>
</div>

<div style="clear:both;">&nbsp;</div>
