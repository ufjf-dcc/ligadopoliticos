<h2><?php
    include ("../functions.php");
    include ("../config1.php");
    include ("head.inc.php");
    escreve("Visualizações","Visualizations") ?></h2>
<br />	
  <div class="visualizacoes">
	  <a href='../content/visualizacao.inc.php?&id_grafico=cargo&situacao=Em+Exercicio'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/cargo.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Cargo","Office") ?>
	  </a>
	</div>
  <div class="visualizacoes">
	  <a href='../content/visualizacao.inc.php?&id_grafico=cargo_uf&situacao=Em+Exercicio&grafico=FCF_Column3D&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/cargo_uf.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Estado","State") ?>
    </a>
	</div>
  <div class="visualizacoes">	
	  <a href='../content/visualizacao.inc.php?&id_grafico=partido&situacao=Em+Exercicio'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/partido.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Partido","Party") ?> 
    </a>
	</div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=grau_instrucao&situacao=Em+Exercicio&grafico=FCF_Doughnut2D&ordem=valor+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/grau_instrucao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Grau de Instrução","Education Level") ?>
    </a>
  </div>
  <div style="clear: both;">
    <br />
    <br />
  </div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=sexo&situacao=Em+Exercicio&grafico=FCF_Pie2D'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/sexo.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Sexo","Gender") ?>
    </a>
	</div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=ocupacao&situacao=Em+Exercicio'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/ocupacao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Ocupação","Occupation") ?>
    </a>
  </div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=nacionalidade&situacao=Em+Exercicio&grafico=FCF_Pie2D'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/nacionalidade.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Nacionalidade","Nacionality") ?>
    </a>
  </div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=cidade_nascimento&situacao=Em+Exercicio'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/cidade_nascimento.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Cidade de Nascimento","City of Birth") ?>
    </a>
  </div>
  <div style="clear: both;">
    <br />
    <br />
  </div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=estado_nascimento&situacao=Em+Exercicio&grafico=FCF_Column3D&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/estado_nascimento.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Estado de Nascimento","State of Birth") ?>
    </a>
  </div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=comissao&situacao=Em+Exercicio&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/comissao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Comissão","Committee") ?>
    </a>
  </div>  
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=declaracao_bens&situacao=Em+Exercicio'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/declaracao_bens.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Declaração de Bens","Declaration of Assets") ?>
    </a>
  </div> 
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=lideranca&situacao=Em+Exercicio&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/lideranca.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Liderança","Leadership") ?>
    </a>
  </div> 
  <div style="clear: both;">
    <br />
    <br />
  </div>
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=missao&situacao=Em+Exercicio&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/missao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Missão","Mission") ?>
    </a>
  </div> 
  <!--
  <div class="visualizacoes">
    <a href='?pag=visualizacao&id_grafico=ocorrencia&situacao=Em+Exercicio&ordem=nome+ASC'>
      <img src = "images/visualizacoes/ocorrencia.png" border=0 width="160px" height="100px" /><br />
      <php escreve("Ocorrência","Occurrency") ?>
    </a>

  </div> 
 -->
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=pronunciamento&situacao=Em+Exercicio&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/pronunciamento.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Pronunciamento","Speech") ?>
    </a>
  </div> 
  <div class="visualizacoes">
    <a href='../content/visualizacao.inc.php?&id_grafico=proposicao&situacao=Em+Exercicio&ordem=nome+ASC'>
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/proposicao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Proposição","Bill") ?>
    </a>
  </div>  
  <div class="visualizacoes">
    <a href="../content/visualizacao.inc.php?&id_grafico=nuvem_palavra_proposicao">
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/nuvem_proposicao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Nuvem de Palavras - Pronunciamentos","Tagcloud - Bills") ?>
    </a>
  </div>  
  <div style="clear: both;">
    <br />
    <br />
  </div>
  <div class="visualizacoes">
    <a href="../content/visualizacao.inc.php?&id_grafico=nuvem_palavra_votacao">
      <img src = "http://localhost/ligadopoliticos/images/visualizacoes/nuvem_votacao.png" border=0 width="160px" height="100px" /><br />
      <?php escreve("Nuvem de Palavras - Votações","Nuvem de Palavras - Votes") ?>
    </a>
  </div> 


<div style="clear: both;">&nbsp;</div>
	<!--
	<li><a href="?pag=visualizacao10"> Nuvem de Palavras das Ementas das Proposições 1 </a></li><br />
	<li><a href="?pag=visualizacao11"> Nuvem de Palavras das Ementas das Proposições 2 </a></li><br />
	-->