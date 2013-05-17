<?php

 function escreve($a,$b){
  if ($_COOKIE["idioma"]  == "pt")
    echo $a;
  elseif($_COOKIE["idioma"]  == "en")
    echo $b;
 }

 function retorna($a,$b){
  if ($_COOKIE["idioma"]  == "pt")
    return $a;
  elseif($_COOKIE["idioma"]  == "en")
    return $b;
 }
 
 function escreve2($a){
  if ($_COOKIE["idioma"]  == "pt")
    echo $a;
  elseif($_COOKIE["idioma"]  == "en"){
    switch($a){
      case 'Em exercício': echo "In Office"; break;
      case 'Fora de exercício': echo "Out of Oficce"; break;
      case 'Candidato': echo "Candidate"; break;
      case 'Candidato Eleito': echo "Elected Candidate"; break;
      case 'Candidato Não-Eleito': echo "Non-Elected Candidate"; break;
      case 'Presidente': echo "President"; break;
      case 'Vice-Presidente': echo "Vice President"; break;
      case 'Governador': echo "Governor"; break;
      case 'Vice-Governador': echo "Vice Governor"; break;
      case 'Senador': echo "Senator"; break;
      case '1º Suplente Senador': echo "1st Alternate Senator "; break;
      case '2º Suplente Senador': echo "2nd Alternate Senator "; break;
      case 'Deputado': echo "Congressman"; break;
      case 'Deputado Federal': echo "Congressman"; break;
      case 'Deputado Estadual': echo "State Representative"; break;
      case 'Deputado Distrital': echo "District Representative"; break;
      default: echo $a;
    }
  }
 }

class autokeyword {

	//declare variables
	//the site contents
	var $fonts;
	var $classes;
	var $contents;
	var $encoding;
	//the generated keywords
	var $keywords;
	//minimum word length for inclusion into the single word
	//metakeys
	var $wordLengthMin;
	var $wordOccuredMin;
	//minimum word length for inclusion into the 2 word
	//phrase metakeys
	var $word2WordPhraseLengthMin;
	var $phrase2WordLengthMinOccur;
	//minimum word length for inclusion into the 3 word
	//phrase metakeys
	var $word3WordPhraseLengthMin;
	//minimum phrase length for inclusion into the 2 word
	//phrase metakeys
	var $phrase2WordLengthMin;
	var $phrase3WordLengthMinOccur;
	//minimum phrase length for inclusion into the 3 word
	//phrase metakeys
	var $phrase3WordLengthMin;

	function autokeyword($params, $encoding)
	{
		//get parameters
		$this->encoding = $encoding;
		mb_internal_encoding($encoding);
		$this->contents = $this->replace_chars($params['content']);
		$this->fonts = $params['font'];
		$this->classes = $params['class'];
		// single word
		$this->wordLengthMin = $params['min_word_length'];
		$this->wordOccuredMin = $params['min_word_occur'];

		// 2 word phrase
		$this->word2WordPhraseLengthMin = $params['min_2words_length'];
		$this->phrase2WordLengthMin = $params['min_2words_phrase_length'];
		$this->phrase2WordLengthMinOccur = $params['min_2words_phrase_occur'];

		// 3 word phrase
		$this->word3WordPhraseLengthMin = $params['min_3words_length'];
		$this->phrase3WordLengthMin = $params['min_3words_phrase_length'];
		$this->phrase3WordLengthMinOccur = $params['min_3words_phrase_occur'];

		//parse single, two words and three words

	}

	function get_keywords()
	{
		$keywords = $this->parse_words().$this->parse_2words().$this->parse_3words();
		return substr($keywords, 0, -2);
	}

	//turn the site contents into an array
	//then replace common html tags.
	function replace_chars($content)
	{
		//convert all characters to lower case
		$content = mb_strtolower($content);
		//$content = mb_strtolower($content, "UTF-8");
		$content = strip_tags($content);

      //updated in v0.3, 24 May 2009
		$punctuations = array(',', ')', '(', '.', "'", '"',
		'<', '>', '!', '?', '/', 
		'_', '[', ']', ':', '+', '=', '#',
		'$', '&quot;', '&copy;', '&gt;', '&lt;', 
		'&nbsp;', '&trade;', '&reg;', ';', 
		chr(10), chr(13), chr(9));

		$content = str_replace($punctuations, " ", $content);
		// replace multiple gaps
		$content = preg_replace('/ {2,}/si', " ", $content);

		return $content;
	}

	//single words META KEYWORDS
	function parse_words()
	{
		//list of commonly used words
		// this can be edited to suit your needs
		$common = array("janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro", "sobre", "senado", "federal", "outros", "deputados", "altera", "outras", "para", "estaduais", "dia", "dias", "pelo", "termos", "requer", "pelos", "incluir", "pela", "nacional", "números", "decreto", "das", "dos", "com", "nos", "nas", "que", "pela", "até", "lei", "constituição", "especial", "art", "estabelecer", "projeto", "regimento", "interno", "institui", "especifica", "período", "senador", "senadores", "arts", "aos", "sejam", "seja", "seus", "suas", "seu", "sua", "por", "casa", "como", "entre", "anos", "ata", "país", "sessão", "requerem", "estará", "criação", "alínea", "brasil", "estado", "estados", "município", "municípios", "incidência", "até", "período", "artigo", "voto", "código", "informações", "providências", "presidência", "rio", "inciso", "acrescenta", "dispõe", "redação", "união", "aplauso", "pesar", "decreto-lei", "aplauso", "falecimento", "pesar", "solicitadas", "ministro", "cidade", "brasileira", "brasileiros", "apresentado", "louvor", "congratulações", "bem", "ser", "permitir", "também", "minas", "gerais", "solicitando", "além", "ouvida", "distribuição", "belo", "horizonte", "despacho", "inicial", "realizar-se", "ano", "comissão", "comissões", "ocorrido", "participar", "são", "constante", "constantes", "oficial", "missão", "disposto", "mineiro", "combinado", "ausente", "ausentar-se", "regimentais", "encaminhado", "considerada", "ausencia", "relacionadas", "realizadas", "solicitado", "segundo", "alem", "numero", "prestadas", "apurar", "uma", "pedido", "processo", "paulo", "artigos", "brasileiro", "quando", "josé", "destinada", "ambos", "qualquer", "uso", "uma", "ocorridos", "relacionados", "não", "mesmo", "joão", "fim", "apresentação", "autorizada", "consignado", "caso", "acerca", "nova", "senhor", "iii", "forma", "amazonas", "solicita", "considerado", "espírito", "santo", "nºs", "presidente", "quanto", "concedido", "modifica", "ato", "vii", "qual", "profundo", "grande", "cada", "parlamento", "inserção", "fazenda", "valor", "milhões", "constitucionais", "relação", "tipo", "foi", "daquele", "todo", "desempenhar", "melhor", "esta", "atinentes", "governo", "referentes", "fatos", "menciona", "horas", "copia", "bahia", "foram", "goiás", "publicado", "sem", "geral", "caput", "veja", "será", "todos", "mesa", "mesma", "periodo", "esclarecimentos", "possa", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "total", "senhora", "parte", "inclusive", "trabalhos", "licença", "aprovação", "indicação", "viii", "convite", "providencias", "apreciação", "submete", "escolha", "primeira", "classe", "diplomata", "cargo", "exercer", "cargo", "junto", "corrente", "paragrafo", "transcrição", "anais", "quadro", "permanente", "nome", "vaga", "superior", "decorrente", "departamento", "câmara", "tramitação", "estabelece", "normas", "realização", "condolências", "conjunta", "audiência", "ainda", "dispor", "transcurso", "comunica", "vinte", "mil", "instituir", "resolução", "complementar", "acordo", "casos", "prazos", "disposições", "transitórias", "xviii", "xxiii", "cria", "utilização", "autoriza", "mais", "fato", "aumentar", "tornar", "denominação", "autorizar", "preparo", "decreto-", "determina", "visam", "cessação", "inelegibilidade", "hipóteses", "proteger", "exercício", "separação", "comprovada", "mandato", "emenda", "ten", "than", "thank", "that", "the", "their", "them", "then", "there", "therefore", "these", "they", "this", "those", "though", "through", "till", "to", "today", "told", "tomorrow", "too", "took", "tore", "tought", "toward", "tried", "tries", "trust", "try", "turn", "two", "under", "until", "up", "upon", "us", "use", "usual", "various", "verb", "very", "visit", "want", "was", "we", "well", "went", "were", "what", "when", "where", "whether", "which", "while", "white", "who", "whom", "whose", "why", "will", "with", "within", "without", "would", "yes", "yet", "you", "young", "your", "br", "img", "p","lt", "gt", "quot", "copy");
		//create an array out of the site contents
		$s = explode(" ", $this->contents);
		//initialize array
		$k = array();
		//iterate inside the array
		foreach( $s as $key=>$val ) {
			//delete single or two letter words and
			//Add it to the list if the word is not
			//contained in the common words list.
			if(mb_strlen(trim($val)) >= $this->wordLengthMin  && !in_array(trim($val), $common)  && !is_numeric(trim($val))) {
				$k[] = trim($val);
			}
		}
		//count the words
		$k = array_count_values($k);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($k, $this->wordOccuredMin);

		//release unused variables
		unset($k);
		unset($s);
	}

	function parse_2words()
	{
		//create an array out of the site contents
		$x = explode(" ", $this->contents);
		//initilize array

		//$y = array();
		for ($i=0; $i < count($x)-1; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($x[$i])) >= $this->word2WordPhraseLengthMin ) && (mb_strlen(trim($x[$i+1])) >= $this->word2WordPhraseLengthMin) )
			{
				$y[] = trim($x[$i])." ".trim($x[$i+1]);
			}
		}

		//count the 2 word phrases
		$y = array_count_values($y);

		$occur_filtered = $this->occure_filter($y, $this->phrase2WordLengthMinOccur);

		//release unused variables
		unset($y);
		unset($x);

	}

	function parse_3words()
	{
		//create an array out of the site contents
		$a = explode(" ", $this->contents);
		//initilize array
		$b = array();

		for ($i=0; $i < count($a)-2; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($a[$i])) >= $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i+1])) > $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i+2])) > $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i]).trim($a[$i+1]).trim($a[$i+2])) > $this->phrase3WordLengthMin) )
			{
				$b[] = trim($a[$i])." ".trim($a[$i+1])." ".trim($a[$i+2]);
			}
		}

		//count the 3 word phrases
		$b = array_count_values($b);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($b, $this->phrase3WordLengthMinOccur);

		//release unused variables
		unset($a);
		unset($b);

	}

	function occure_filter($array_count_values, $min_occur)
	{
		$occur_filtered = array();
		foreach ($array_count_values as $word => $occured) {
			
			if ($occured >= $min_occur) {
				$font_size = $array_count_values[$word] * $this->fonts;
				$class = $this->classes;
				echo "<a href='http://www.google.com.br/search?q=$word' class='$class' target='_blank' title='$word, $array_count_values[$word]' style='font-size:$font_size;'>".$word."</a> ";
			}
		}
	}

	function implode($gule, $array)
	{
		$c = "";
		foreach($array as $key=>$val) {
			@$c .= $key.$gule;
		}
		return $c;
	}
}

function keywords($input,$minimo,$fonte,$class){
	$params['content'] = $input; //page content
	$params['font'] = $fonte;
	$params['class'] = $class;
	//set the length of keywords you like
	$params['min_word_length'] = 3;  //minimum length of single words
	$params['min_word_occur'] = $minimo;  //minimum occur of single words

	$params['min_2words_length'] = 5;  //minimum length of words for 2 word phrases
	$params['min_2words_phrase_length'] = 30; //minimum length of 2 word phrases
	$params['min_2words_phrase_occur'] = 20; //minimum occur of 2 words phrase

	$params['min_3words_length'] = 5;  //minimum length of words for 3 word phrases
	$params['min_3words_phrase_length'] = 30; //minimum length of 3 word phrases
	$params['min_3words_phrase_occur'] = 20; //minimum occur of 3 words phrase

	$keyword = new autokeyword($params, "UTF-8");

	echo $keyword->parse_words();
}
?>
