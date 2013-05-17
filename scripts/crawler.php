<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
Class Crawler
{
	var $curl;
	function __construct()
	{		
		$this->curl= curl_init();
	}

	function getContent($url)
	{
		curl_setopt($this->curl, CURLOPT_URL, $url);	
		curl_setopt ($this->curl, CURLOPT_RETURNTRANSFER, 1);
		$content=curl_exec ($this->curl);	
		return $content;
	}
	
	function getDomain($url)
	{
		return substr($url,0,strrpos($url,"/"));
	}

	function crawlDeclaracaoBens($url)
	{
		$content=$this->getContent($url);//pega a pagina inteira
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos1 = $xpath->evaluate("//div[@id='div_bens']//td[2]");//pega todas as tags
		$elementos2 = $xpath->evaluate("//div[@id='div_bens']//td[3]");
		$elementos3 = $xpath->evaluate("//div[@id='div_bens']//td[4]");
		$elementos4 = $xpath->evaluate("//td[@class='clsTitulo01']");

		for ($i = 0; $i < $elementos1->length - 1; $i++) 
		{
			$elemento1 = $elementos1->item($i);			
			$dados['descricao'][$i]=$elemento1->nodeValue;
		}
		
		for ($i = 0; $i < $elementos2->length; $i++)
		{
			$elemento2 = $elementos2->item($i);		
			$dados['tipo'][$i]=$elemento2->nodeValue;
		}	
		
		for ($i = 0; $i < $elementos3->length; $i++)
		{		
			$elemento3 = $elementos3->item($i);	
			$dados['valor'][$i]=$elemento3->nodeValue;
		}
		
		for ($i = 0; $i < $elementos4->length; $i++)
		{		
			$elemento4 = $elementos4->item($i);					
			$dados['chave'][$i]=$elemento4->nodeValue;
		}
		return  $dados;
	}

	function crawlDBPedia($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos1 = $xpath->evaluate("//li//a[@rel='owl:sameAs']");
		$elementos2 = $xpath->evaluate("//li//a[@rev='owl:sameAs']");
		$elementos3 = $xpath->evaluate("//body");

		for ($i = 0; $i < $elementos1->length; $i++) 
		{
			$elemento1 = $elementos1->item($i);			
			$dados['cidade'][$i]=$elemento1->getAttribute('href');
		}
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['cidade2'][$i]=$elemento2->getAttribute('href');
		}
		for ($i = 0; $i < $elementos3->length; $i++) 
		{
			$elemento3 = $elementos3->item($i);			
			$dados['cidade3'][$i]=$elemento3->getAttribute('about');
		}
		return  $dados;
	}
	
	function crawlFichaLimpa($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos1 = $xpath->evaluate("//div[@class='filtro_candidato']");
		$elementos2 = $xpath->evaluate("//td[@id='tabela_conteudo']//a");
		for ($i = 0; $i < $elementos1->length; $i++) 
		{
			$elemento1 = $elementos1->item($i);			
			$dados['pessoais'][$i]=$elemento1->nodeValue;
		}
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['links'][$i]=$elemento2->getAttribute('href');
		}
		return  $dados;
	}

	function crawlPaginasFichaLimpa($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//td[@id='tabela_conteudo']//a");
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['links'][$i]=$elemento->getAttribute('href');
		}
		return  $dados;
	}

	function crawlPoliticosBrasileiros($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//td[@class='clsTitulo01']");
		$elementos2 = $xpath->evaluate("//td[@class='clsItemNormal03']");
		$elementos3 = $xpath->evaluate("//div[@class='ficha-titulo']");
		
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['eleitorais'][$i]=$elemento->nodeValue;
		}
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['pessoais'][$i]=$elemento2->nodeValue;
		}
		for ($i = 0; $i < $elementos3->length; $i++) 
		{
			$elemento3 = $elementos3->item($i);			
			$dados['titulo'][$i]=$elemento3->nodeValue;
		}
		return  $dados;
	}

	function crawlExcelencias($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//p[@id='txt']");

		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['ocorrencia'][$i]=$elemento->nodeValue;
		}
		return  $dados;
	}
	
	function crawlPoliticosBrasileirosImg($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//td//img");
		
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['imagem'][$i]=$elemento->getAttribute('src');
		}
	
		return  $dados;
	}
	
	function crawlPaginasCamaraDeputados($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//select[@id='listaDeputados']//option");
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['links'][$i]=$elemento->getAttribute('value');
		}
		return  $dados;
	}
	
	function crawlXX($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//td");
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['links'][$i]=$elemento->nodeValue;
		}
		return  $dados;
	}
	
	function crawlSenadoFederalA($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//div[@class='dadosSenador']//b");
		$elementos2 = $xpath->evaluate("//div[@class='tituloSenadores']//div[1]");
		
		$elemento2 = $elementos2->item(0);
		$dados['pessoais'][0]=$elemento2->nodeValue;
		
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['pessoais'][$i+1]=$elemento->nodeValue;
		}		
		
		return  $dados;
	}

	function crawlSenadoFederalB($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos3 = $xpath->evaluate("//ul[@id='listaMissoes']//li");
		
		for ($i = 0; $i < $elementos3->length; $i++) 
		{
			$elemento3 = $elementos3->item($i);			
			$dados['liderancas'][$i]=$elemento3->nodeValue;
		}		
		
		return  $dados;
	}	
	
	function crawlPaginasSenado($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//td[@class='colNomeSenador']//a");
		$elementos2 = $xpath->evaluate("//th[@class='colDataLeitura']");
		
		for ($i = 0; $i < $elementos->length; $i++) 
		{
			$elemento = $elementos->item($i);			
			$dados['links'][$i]=$elemento->getAttribute('href');
		}	
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['datas'][$i]=$elemento2->nodeValue;
		}		
		return  $dados;
	}	

	function crawlSenadoFederalProposicoes($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//p[@class='texto']");
		$elementos2 = $xpath->evaluate("//a//b");
		$elementos3 = $xpath->evaluate("//p");
		
		$elemento = $elementos->item(0);			
		$dados['paginas'][0]=$elemento->nodeValue;
		
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['titulos'][$i]=$elemento2->nodeValue;
		}
		for ($i = 0; $i < $elementos3->length; $i++) 
		{
			$elemento3 = $elementos3->item($i);			
			$dados['ementas'][$i]=$elemento3->nodeValue;
		}
		
		return  $dados;
	}	
	
	function crawlSenadoFederalPronunciamentos($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//p[@class='texto']");
		$elementos0 = $xpath->evaluate("//span[@class='texto']//a[1]");
		$elementos1 = $xpath->evaluate("//tbody//td[1]");
		$elementos2 = $xpath->evaluate("//tbody//td[2]");
		$elementos3 = $xpath->evaluate("//tbody//td[3]");
		$elementos4 = $xpath->evaluate("//tbody//td[4]");
		$elementos5 = $xpath->evaluate("//tbody//td[5]");
		$elementos6 = $xpath->evaluate("//tbody//td[6]");
		
		$elemento = $elementos->item(0);			
		$dados['paginas'][0]=$elemento->nodeValue;

		$elemento0 = $elementos0->item(0);			
		$dados['anos'][0]=$elemento0->nodeValue;
		
		for ($i = 0; $i < $elementos1->length; $i++) 
		{
			$elemento1 = $elementos1->item($i);			
			$dados['tipos'][$i]=$elemento1->nodeValue;
		}		
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['datas'][$i]=$elemento2->nodeValue;
		}
		for ($i = 0; $i < $elementos3->length; $i++) 
		{
			$elemento3 = $elementos3->item($i);			
			$dados['casas'][$i]=$elemento3->nodeValue;
		}
		for ($i = 0; $i < $elementos4->length; $i++) 
		{
			$elemento4 = $elementos4->item($i);			
			$dados['partidos'][$i]=$elemento4->nodeValue;
		}		
		for ($i = 0; $i < $elementos5->length; $i++) 
		{
			$elemento5 = $elementos5->item($i);			
			$dados['ufs'][$i]=$elemento5->nodeValue;
		}
		for ($i = 0; $i < $elementos6->length; $i++) 
		{
			$elemento6 = $elementos6->item($i);			
			$dados['resumos'][$i]=$elemento6->nodeValue;
		}		
		return  $dados;
	}	

	function crawlSenadoFederalComissoes($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xpath = new DOMXPath($dom);

		$elementos = $xpath->evaluate("//p[@align='right']");
		$elementos1 = $xpath->evaluate("//tbody//td[1]");
		$elementos2 = $xpath->evaluate("//tbody//td[2]");
		$elementos3 = $xpath->evaluate("//tbody//td[3]");
		$elementos4 = $xpath->evaluate("//tbody//td[4]");
		
		$elemento = $elementos->item(0);			
		$dados['paginas'][0]=$elemento->nodeValue;

		for ($i = 0; $i < $elementos1->length; $i++) 
		{
			$elemento1 = $elementos1->item($i);			
			$dados['comissoes'][$i]=$elemento1->nodeValue;
		}		
		for ($i = 0; $i < $elementos2->length; $i++) 
		{
			$elemento2 = $elementos2->item($i);			
			$dados['inicios'][$i]=$elemento2->nodeValue;
		}
		for ($i = 0; $i < $elementos3->length; $i++) 
		{
			$elemento3 = $elementos3->item($i);			
			$dados['fins'][$i]=$elemento3->nodeValue;
		}
		for ($i = 0; $i < $elementos4->length; $i++) 
		{
			$elemento4 = $elementos4->item($i);			
			$dados['participacoes'][$i]=$elemento4->nodeValue;
		}
		
		return  $dados;
	}	
	
	function crawlImage($url)
	{
		$content=$this->getContent($url);
		$domain=$this->getDomain($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($content);		
		$xdoc = new DOMXPath($dom);	
		//Read the images that is between <a> tag
		$atags = $xdoc ->evaluate("//a");		//Read all a tags	
		$index=0;
		for ($i = 0; $i < $atags->length; $i++) 
		{
			$atag = $atags->item($i);			//select an a tag
			$imagetags=$atag->getElementsByTagName("img");//get img tag
			$imagetag=$imagetags->item(0);
			if(sizeof($imagetag)>0)//if img tag exists
			{
				$imagelinked['src'][$index]=$imagetag->getAttribute('src');//save image src
				$imagelinked['link'][$index]=$atag->getAttribute('href');//save image link		
				$index=$index+1;
			}
		}			
		//Read all image
		//Betweem <img> tag 
		$imagetags = $xdoc ->evaluate("//img");	//Read all img tags	
		$index=0;
		for ($i = 0; $i < $imagetags->length; $i++) 
		{
			$imagetag = $imagetags->item($i);						
			$imageunlinked['src'][$index]=$imagetag->getAttribute('src');//get src						
			$index=$index+1;			
		}
		//Marge Both linked and unlinked image
		for($i=0;$i<sizeof($imagelinked['src']);$i++)
		{
			$index=sizeof($image['src']);
			for(;$index<sizeof($imageunlinked['src']);$index++)
			{
				$image['src'][$index]=$this->convertLink($domain,$url,$imageunlinked['src'][$index]);
				$image['link'][$index]=null;
				if(($imagelinked['src'][$i])==$imageunlinked['src'][$index])
				{
					$image['link'][$index]=$this->convertLink($domain,$url,$imagelinked['link'][$i]);
					break;
				}
			}
			
		}		
		return $image;	
	}
}
?>