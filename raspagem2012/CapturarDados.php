<?php

include '../upgrade.database.php';
include '../properties.php';
include '../consultasSPARQL.php';

function capturaDadosCandidatos($urlDadosCandidato, $codigoMunicipio, $codigoCargo) {
    echo $urlDadosCandidato.'</br>';
    $urlDadosCandidato = urldecode($urlDadosCandidato);
    //$html = new simple_html_dom;
    //$html->load_file($urlDadosCandidato);
    $html = file_get_html($urlDadosCandidato);
    
    //cria array onde o indice é o nome do campo do site
    $formulario = array();
    $formulario["Nome para urna eletrônica:"] = "nomeUrna";
    $formulario["Número:"] = "numero";
    $formulario["Nome completo:"] = "nomeCompleto";
    $formulario["Sexo:"] = "sexo";
    $formulario["Data de nascimento:"] = "dataNascimento";
    $formulario["Estado civil:"] = "estadoCivil";
    $formulario["Nacionalidade:"] = "nacionalidade";
    $formulario["Naturalidade:"] = "naturalidade";
    $formulario["Grau de instrução:"] = "grauInstrucao";
    $formulario["Ocupação:"] = "ocupacao";
    $formulario["Partido:"] = "partido";
    $formulario["Coligação:"] = "coligacao";
    $formulario["Composição da coligação:"] = "composicaoColigacao";
    $formulario["No. processo:"] = "nProcesso";
    $formulario["No. protocolo:"] = "nProtocolo";
    $formulario["CNPJ de campanha:"] = "cnpj";
    $formulario["Limite de gastos:"] = "limiteGasto";
    $formulario["Endereço do site do candidato:"] = "endSite";

    //array para guardar os dados
    $dados = array();
    //instancia o vetor
    foreach ($formulario as $form){
        $dados[$form] = NULL;
    }

    //codigo para capturar a situação e o link da imagem do candidato
    $tabelaSituacao = $html->find("table", 0);
    $texto = $tabelaSituacao->find("td", 4);
    $texto = iconv("ISO-8859-1", "UTF-8", $texto->plaintext);
    $texto = html_entity_decode($texto);
    $dados['situacao'] = limpaPalavra($texto);
    $imagem = $tabelaSituacao->find("img", 0);
    $dados['img'] = 'http://divulgacand2012.tse.jus.br/divulgacand2012/' . $imagem->src;


    //pega a tabela com os dados do prefeito
    $tabelaDados = $tabelaSituacao->find("table", 1);

    //pega a tag com o registro de candidatura e sepera a cidade e o estado
    $cidade_estado = $tabelaDados->find("td", 0);
    $pedacos = explode("(", $cidade_estado->plaintext);
    $tamanho = count($pedacos);
    $pedacos[$tamanho - 1] = str_replace("&nbsp;/&nbsp;", "||", $pedacos[$tamanho - 1]);
    $pedacos[$tamanho - 1] = str_replace(")", "", $pedacos[$tamanho - 1]);
    $pedacos[$tamanho - 1] = iconv("ISO-8859-1", "UTF-8", $pedacos[$tamanho - 1]);
    $pedacos[$tamanho - 1] = html_entity_decode($pedacos[$tamanho - 1]);
    $cidade_estado = explode("||", $pedacos[$tamanho - 1]);
    $dados['cidade_cand'] = limpaPalavra($cidade_estado[0]);
    $dados['estado_cand'] = limpaPalavra($cidade_estado[1]);

    //guarda o cargo do candidato de acordo com o codigo do site
    if ($codigoCargo == 11)
        $dados['cargo'] = 'Prefeito';
    else if ($codigoCargo == 13)
        $dados['cargo'] = 'Vereador';
    else
        $dados['cargo'] = 'Vice-prefeito';

    //variavel para contar a posição da tag td
    $dtNumero = 0;
    //pega todas as tags td da tabela dados
    $tds = $tabelaDados->find("td");

    //busca todos os tds dentro tabela com os dados do prefeito e confere a informação de
    //cada um
    foreach ($tds as $td) {

        //pega o conteudo do td
        $label = $td->plaintext;

        //passa de ISO para UTF-8
        $label = iconv("ISO-8859-1", "UTF-8", $label);
        //Tira o html encode
        $label = html_entity_decode($label);

        //caso exista um label no formulario que deve ser pego, pega seu input
        if (isset($formulario[$label])) {

            $output = $tds[$dtNumero + 1]->plaintext;
            $output = str_replace("&nbsp;", " ", $output);
            $output = iconv("ISO-8859-1", "UTF-8", $output);
            $output = html_entity_decode($output);
            $output = limpaPalavra($output);

            $dados[$formulario[$label]] = $output;
        }

        $dtNumero++;
    }

    //confere se o candidato possui site
    if ($dados['endSite'] == "")
        $dados['endSite'] = NULL;

    //pega a cidade e o estado de nascimento do candidato
    $cid_est_nasc = explode("/", $dados["naturalidade"]);
    $tam = count($cid_est_nasc);
    $dados['estado_nascimento'] = limpaPalavra($cid_est_nasc[$tam - 1]);
    $cidade_nas;
    for ($ind = 0; $ind < $tam - 1; $ind ++)
        $cidade_nas = $cid_est_nasc[$ind] . " ";
    $dados['cidade_nascimento'] = limpaPalavra($cidade_nas);

    //pega a sigla do partido
    $patido = explode('-', $dados['partido']);
    $siglaPartido = $patido[count($patido) - 2];
    $dados['partido'] = limpaPalavra($siglaPartido);

    //array para guardas a descrição sobre o bem do candidato
    $bens = array();
    //variavel para contar os bens do candidato
    $numeroBens = 0;
    //retorna um array mesmo só existindo uma tabela
    $tabelaBens = $html->find('table[id="bemCandidato"]');

    foreach ($tabelaBens as $t1) {
        $bens = $t1->find('tr[class="odd"] , tr[class="even"]');
        foreach ($bens as $t2) {

            $palavra = $t2->find("td", 1)->plaintext;
            $palavra = iconv("ISO-8859-1", "UTF-8", $palavra);
            $palavra = html_entity_decode($palavra);
            $bens["DescricaoBem"][$numeroBens] = $palavra;

            $palavra = $t2->find("td", 2)->plaintext;
            $palavra = iconv("ISO-8859-1", "UTF-8", $palavra);
            $palavra = html_entity_decode($palavra);
            $bens["TipoBem"][$numeroBens] = $palavra;

            $palavra = $t2->find("td", 3)->plaintext;
            $palavra = iconv("ISO-8859-1", "UTF-8", $palavra);
            $palavra = html_entity_decode($palavra);
            $palavra = str_replace(".", "", $palavra);
            $palavra = str_replace(",", ".", $palavra);
            $bens["ValorBem"][$numeroBens] = $palavra;

            $numeroBens++;
        }
    }

    //Chama a função que salva os dados no banco de dados
    salvarDadosNoAllegro($dados, $bens, $numeroBens);
    //função que salva os dados em um arquivo txt
    //salvaDadosTxt($dados, $bens, $numeroBens);

    //Confere se existe vice-prefeito
    $vicesPrefeito = $tabelaDados->find('img[src="img/icones/vice.png"]');
    //Caso exista vice-prefeito, é criado um link que leva ao(s) vice-prefeito e chama
    //a função captura dados novamente para cada vice-prefeito existente 
    foreach ($vicesPrefeito as $vicePrefeito) {

        //limpa os dados da tag que contém os dados do vice-prefeio até deixar apenas os numeros
        $vicePrefeito = str_replace('visualizarDadosVice(', '', $vicePrefeito->onclick);
        $vicePrefeito = str_replace(',', '', $vicePrefeito);
        $vicePrefeito = str_replace('"', '', $vicePrefeito);
        $vicePrefeito = str_replace('\'', '', $vicePrefeito);
        $vicePrefeito = str_replace(');', '', $vicePrefeito);

        $espaco = strripos($vicePrefeito, ' ');
        $codigoVice = substr($vicePrefeito, 0, $espaco);
        $codigoUltAtulizacao = substr($vicePrefeito, $espaco + 1);

        //Cria o link que leva até o vice-prefeito
        $urlVicePrefeito = "http://divulgacand2012.tse.jus.br/divulgacand2012/mostrarFichaCandidato.action?sqCandSuperior=" . $codigoVice . "&codigoMunicipio=" . $codigoMunicipio . "&dtUltimaAtualizacao=" . $codigoUltAtulizacao;

        capturaDadosCandidatos($urlVicePrefeito, $codigoMunicipio, 15);
    }
}

function salvarDadosNoAllegro($dados, $bens, $numeroBens) {
    //Condições para verificar a existencia de dados basicos que juntos permitem identificar o politico e podem ajudar
    //ajudar a resolver inconsistencia caso o html do site mude
    if($dados['nomeCompleto'] != NULL && $dados['dataNascimento'] != NULL && $dados['cargo'] != NULL && 
        $dados['partido'] != NULL && $dados['nProtocolo'] != NULL && $dados['cnpj'] != NULL && strcmp($dados['cnpj'], "Visualizar processo de atribuição de CNPJ") != 0
        && $dados['nProtocolo'] != '')
    {
        //confere se o politico já existe no banco
        $id = existePoli($dados['nomeCompleto'], $dados['dataNascimento']);
        //Confere se o politico já existe no banco, com uma eleição posterior a de 2012
        //evitando assim de apagar dados dessa eleição
        $anosEleicoes = NULL;
        $naoConcorreuDepois2012 = TRUE;
        if($id != 0){
            $consulta ='select ?ano
                    where{
                     <http://ligadonospoliticos.com.br/politico/'.$id.'> polbr:election ?election.
                     ?election timeline:atYear ?ano                                                    
                    }
                    group by ?ano';
            $anosEleicoes = consultaSPARQL($consulta);
            
            foreach ($anosEleicoes as $ano)
                if($ano['ano'] > 2012)
                    $naoConcorreuDepois2012 = FALSE;
        }
  
        //caso o candidadto ainda não esteja cadastrado no banco
        //Ou caso o candidato tenha concorrido só em 2010 ou antes
        if($id == 0 || $naoConcorreuDepois2012){
            $id = politico_Prefeito_Vereador($dados['nomeCompleto'], $dados['img'], $dados['sexo'], $dados['dataNascimento'], $dados['estadoCivil'], $dados['ocupacao'], $dados['grauInstrucao'], $dados['nacionalidade'], $dados['cidade_nascimento'], $dados['estado_nascimento'], $dados['endSite'], $dados['cargo'], $dados['cidade_cand'], $dados['estado_cand'], $dados['partido'], NULL);
        }
        
        eleicao_Prefeito_Vereador($id, "2012", $dados['nomeUrna'], $dados['numero'], $dados['partido'], $dados['cargo'], $dados['cidade_cand'], $dados['estado_cand'], NULL, $dados['coligacao'], $dados['composicaoColigacao'], $dados['situacao'], $dados['nProtocolo'], $dados['nProcesso'], $dados['cnpj']);

        $num = 0;
        while ($num < $numeroBens) {
            declaracao_bens($id, "2012", $bens["DescricaoBem"][$num], $bens["TipoBem"][$num], $bens["ValorBem"][$num]);
            $num++;
        }
    }
}

function salvaDadosTxt($dados, $bens, $numeroBens) {
    $arq = fopen("dadosCompletos.txt", "a+");
    fwrite($arq, $dados['estado_cand'] . "\|de|/" . $dados['cidade_cand'] . "\|de|/" . $dados['cargo'] . "\|de|/" . $dados['partido'] . "\|de|/" . $dados['situacao'] . "\|de|/" . $dados['nomeCompleto'] . "\|de|/" . $dados['cidade_nascimento'] . "\|de|/" . $dados['estado_nascimento'] . "\|de|/" . $dados['dataNascimento'] . "\|de|/" . $dados['img'] . "\|de|/" . $dados['nomeUrna'] . "\|de|/" . $dados['numero'] . "\|de|/" . $dados['sexo'] . "\|de|/" . $dados['estadoCivil'] . "\|de|/" . $dados['nacionalidade'] . "\|de|/" . $dados['ocupacao'] . "\|de|/" . $dados['grauInstrucao'] . "\|de|/" . $dados['endSite'] . "\|de|/" . $dados['coligacao'] . "\|de|/" . $dados['composicaoColigacao'] . "\|de|/" . $dados['nProcesso'] . "\|de|/" . $dados['nProtocolo'] . "\|de|/" . $dados['cnpj'] . "\|de|/");

    $num = 0;
    while ($num < $numeroBens) {
        //declaracao_bens($id, "2012", $bens["DescricaoBem"][$num], $bens["TipoBem"][$num], $bens["ValorBem"][$num]);
        fwrite($arq, $bens["DescricaoBem"][$num] . "\|db|/" . $bens["TipoBem"][$num] . "\|db|/" . $bens["ValorBem"][$num] . "\|db|/");
        $num++;
    }
    fwrite($arq, "\n");
    fclose($arq);
}

function limpaPalavra($palavra) {
    //retira quebras de linha e espaços em branco antes e depois da palavra
    $palavra = trim($palavra);
    $palavra = str_replace("\r", "", $palavra);
    $palavra = str_replace("\n", "", $palavra);
    $palavra = str_replace("\r\n", "", $palavra);
    $palavra = str_replace("\t", "", $palavra);
    $palavra = preg_replace("/(<br.*?>)/i", "", $palavra);
    //deixa apenas um espaço entre as palavras
    $palavra = preg_replace('/\s(?=\s)/', '', $palavra);
    return $palavra;
}
