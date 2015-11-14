<?php
//http://ligadonospoliticos.com.br/?pag=home

echo "                 
  			<div id='logo'>
  				<a href='http://localhost/ligadopoliticos/' border=0 title='Ligado nos Politicos' alt='Ligado nos Politicos'><img border=0 src='http://localhost/ligadopoliticos/images/logo.png' /></a>
  			</div>
  			<div id='idiomas'>  
				<a href='"."http://localhost/ligadopoliticos/content/idioma.inc/"."&idioma=pt&pais=BR'><img src='http://localhost/ligadopoliticos/images/bandeiras/portugues.gif' /></a>
				<a href='".$url."&idioma=en&pais=EN'><img src='http://localhost/ligadopoliticos/images/bandeiras/ingles.gif' /></a>   
				<br /><br /><br />
				<div id='fb-root'>
				</div>
				<script src='http://connect.facebook.net/en_US/all.js#xfbml=1'>
				</script>
				<fb:like href='http://localhost/ligadopoliticos/' send='true' width='400' show_faces='false' font=''>
				</fb:like>
  			</div>
";
?>
