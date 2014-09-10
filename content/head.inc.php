	<title>LIGADO nos POLÍTICOS</title>
	<meta name="author" content="Lucas de Ramos Araújo">
	<meta name="description" content="">
	<meta name="keywords" content="políticos brasileiros dados governamentais abertos governo eletronico transparencia dados ligados web semantica">
	<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
	<meta property="og:title" content="LIGADO nos POLÍTICOS" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://ligadonospoliticos.com.br/" />
	<meta property="og:image" content="http://ligadonospoliticos.com.br/images/mapa.png" />
	<meta property="og:site_name" content="LIGADO nos POLÍTICOS" />
	<meta property="fb:admins" content="570085484" />
	<link rel="stylesheet" href="http://ligadonospoliticos.com.br/estilo.css" type="text/css" />
	<link rel="meta" type="application/rdf+xml" title="FOAF" href="http://ligadonospoliticos.com.br/content/foaf.rdf" /> 
	<script language="javascript" src="http://ligadonospoliticos.com.br/fusioncharts/FusionCharts.js"></script>
	<script language="javascript" type="text/javascript">
		function visibilidadeCargo(){
			if (document.formbusca.situacao.value == 'Em Exercicio' || document.formbusca.situacao.value == 'Fora de Exercicio')
			{
				document.formbusca.cargo1.value = "";
				document.getElementById('cargo1').style.display = 'none';
				document.getElementById('cargo2').style.display = 'block';
				document.getElementById('cargo1').style.visibility = 'hidden';
				document.getElementById('cargo2').style.visibility = 'visible';
			}
			else
			{
				document.formbusca.cargo2.value = "";
				document.getElementById('cargo1').style.display = 'block';
				document.getElementById('cargo2').style.display = 'none';
				document.getElementById('cargo1').style.visibility = 'visible';
				document.getElementById('cargo2').style.visibility = 'hidden';    
			}
		}

		function validaLimite()
		{
			var limite1 = document.formbusca.limite1.value;
			var limite2 = document.formbusca.limite2.value;

			if (limite1 != '' || limite2 != ''){
				if (isNaN(limite1) || limite1 < 0) 
				{
					alert('O valor do início do limite deve ser um número maior ou igual a zero.');
					return false;
				}
				if (isNaN(limite2)  || limite2 <= 0 || limite2 > 1000) 
				{
					alert('O valor da quantidade do limite deve ser um número maior que zero e menor ou igual a 1000.');
					return false;
				}	
			}
			return true;
		}     
	</script>
