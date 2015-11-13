<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script>
            function recarregaPagina() {
                location.reload();
            }
        </script>
    </head>
    
    <body onload="recarregaPagina()">
        <?php
        
            //importa a biblioteca de raspagem
            include_once './simple_html_dom.php';
            include './CapturarDados.php';
            
            //variaveis para controlar a raspagem
            $prox_estado = 0;
            $prox_cidade = 0;
            $prox_cand = 0;
            //abre o arquivo de texto com dados de onde continuar a raspagem
            $arquivo = fopen("control.txt", "r");
            $linha =  fgets($arquivo);
            //Quando a linha está vazia é pq o arquivo acabou de ser criado 
            //e a raspagem está iniciando do zero
            if($linha == ''){
                echo "Iniciando Raspagem do zero";
                fclose($arquivo);
                $arquivo = fopen("control.txt", "w");
                fwrite($arquivo, "0 0 0"); 
            }
            else{
                $estado_cidade = explode(" ", $linha);
                $prox_estado = $estado_cidade[0];
                $prox_cidade = $estado_cidade[1];
                $prox_cand =$estado_cidade[2];
                echo 'Reiniciado a raspagem do Estado:'.$prox_estado.' e Cidade:'.(($prox_cidade / 2) + 1).'</br>';
            }
            fclose($arquivo);
            
            //url de que sera feita a raspagem
            $url = "http://divulgacand2012.tse.jus.br/divulgacand2012/ResumoCandidaturas.action";

            //carrega a pagina na variavel $html
            $html = new simple_html_dom();
            $html->load_file($url);

            //Pega as tags que possui informações sobre cada estado
            $estados = $html->find('area[shape="poly"]');

            //limpa dados da variavel $html após seu uso
            $html->clear();
            unset($html);
            
            $contEstado = 0;
            $contCidade = 0;
            foreach ($estados as $estado) {

                //Estado no qual irá fazer a raspagem. Ex: 0 Acre , 1 Alagoas , ... 25 Tocantins
                if ($contEstado == 9) {

                    //pega a url que leva ao estado
                    $urlEstado = $estado->href;
                    
                    //pega a sigla do estado
                    $siglaUF = substr($urlEstado, strlen($urlEstado) - 2);
                    
                    //Codigo abaixo confere se o valor que está em $siglaUF é a sigla do Acre
                    //caso seja é feita uma correção na sigla
                    if(strcmp($siglaUF, "e;") == 0)
                    {   //tira palavras a mais na url do Acre
                        $urlEstado = str_replace("'); return false;", '', $urlEstado);
                        $siglaUF = substr($urlEstado, strlen($urlEstado) - 2);
                    }

                    //junta a url principal com a url que leva ao estado
                    $urlEstado = substr_replace($url, $urlEstado, 50);
                    $htmlEstado = new simple_html_dom();
                    //carrega a pagina do estado atual na variavel $html
                    $htmlEstado->load_file($urlEstado);

                    //pega a tag img que possui a chamada ao java script que exibe os prefeitos ou vereadores de uma cidade
                    $cidades = $htmlEstado->find('table[id="tabMunicipio"] tr td div img');
                    
                    //limpa a variavel
                    $htmlEstado->clear();
                    unset($htmlEstado);
                    
                    //embaralha $cidades shuffle

                    //cada cidade é contada duas vezes, uma para o prefeito e outra para o vereador
                    foreach ($cidades as $cidade) {
                        //confere se a cidade atual é a mesma da lida no arquivo control.txt ou posterior
                        if ($contCidade >= $prox_cidade) {
                            
                            //limpa os elementos do onclick deixando apenas o id do cargo(11 ou 13) e da Cidade 
                            $idCidPoli = str_replace('onPesquisaClick(this, ', '', $cidade->onclick);
                            $idCidPoli = str_replace(',', '', $idCidPoli);
                            $idCidPoli = str_replace('"', '', $idCidPoli);
                            $idCidPoli = str_replace('\'', '', $idCidPoli);
                            $idCidPoli = str_replace(');', '', $idCidPoli);

                            //guarda a posição do espaço que separa o id do prefeito ou vereador do id do municipio
                            $espaco = strripos($idCidPoli, ' ');

                            //guarda o id do prefeito ou do vereador que é 11 ou 13
                            $codigoCargo = substr($idCidPoli, 0, $espaco);

                            //guarda o id da cidade
                            $codigoMunicipio = substr($idCidPoli, $espaco + 1);

                            //modifica a url do ajax que é exibida na tela 
                            $urlAjaxPrefeitoVereador = "http://divulgacand2012.tse.jus.br/divulgacand2012/pesquisarCandidato.action?siglaUFSelecionada=".$siglaUF."&codigoMunicipio=".$codigoMunicipio."&codigoCargo=".$codigoCargo."&codigoSituacao=0";
                            
                            $htmlCidade = new simple_html_dom();
                            //carrega o html que possui todos prefeitos ou vereadores da cidade
                            $htmlCidade->load_file($urlAjaxPrefeitoVereador);
                            
                            //pega os input com o id e a ultima atualização do politico
                            $candidato = $htmlCidade->find('tr[class="odd gradeX"] input');
                            
                            $htmlCidade->clear();
                            unset($htmlCidade);
                            
                            //array para guardar ids dos candidatos e ids da ultima atualização do candidato
                            $array = array("sqCandidato", "dtUltimaAtualizacao");

                            $i = 0;
                            $j = 0;
                            foreach ($candidato as $elemento) {
                                if (strcmp($elemento->name, "sqCandidato") == 0) {
                                    $array["sqCandidato"][$i] = $elemento->value;
                                    $i++;
                                } else {
                                    $array["dtUltimaAtualizacao"][$j] = $elemento->value;
                                    $j++;
                                }
                            }
                            
                            if($i != $j)
                                exit("A variavel \$i deve ter o mesmo valor que \$j");

                            $i = 0;
                            //pega os dados(id prefeito OU vereador e id ult atualização) de cada prefeito OU vereador da cidade
                            for ($i; $i < $j; $i++) {
                                if($i >= $prox_cand){
                                    //monta a url que leva aos dados de cada candidato
                                    $urlDadosCandidato = "http://divulgacand2012.tse.jus.br/divulgacand2012/mostrarFichaCandidato.action?sqCandidato=".$array['sqCandidato'][$i]."&codigoMunicipio=".$codigoMunicipio."&dtUltimaAtualizacao=".$array['dtUltimaAtualizacao'][$i];
                                    //echo $contCidade." ".$i;
                                    capturaDadosCandidatos($urlDadosCandidato , $codigoMunicipio , $codigoCargo);

                                    $arquivo = fopen("control.txt", "w+");    
                                    fwrite($arquivo, $contEstado." ".$contCidade." ".($i + 1));
                                    fclose($arquivo);

                                    $arq = fopen("dados1.txt", "a+");
                                    fwrite($arq, $contEstado." ".$contCidade." ".($i + 1)." -- For do \$i \n");
                                    fclose($arq);
                                
                                }
                            }
                            $prox_cand = 0;
                            
                            
                            $arquivo = fopen("control.txt", "w+");    
                            fwrite($arquivo, $contEstado." ".($contCidade+1)." 0");
                            fclose($arquivo);
                        
                            $arq = fopen("dados1.txt", "a+");
                            fwrite($arq, $contEstado." ".($contCidade+1)." 0 -- foreach de cidades \n");
                            fclose($arq);
                             
                        }
                        $contCidade++;
                    }
                    
                    $contCidade = 0;
                    $prox_cidade = 0;
                }
                
                
                $contEstado++;
            }
            
            

?>
    </body>
    
</html>