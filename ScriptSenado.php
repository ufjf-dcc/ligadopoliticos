<html>
 <head>
  <meta  charset=utf-8 />
  <title> Senado Raspagem </title>
 </head>
 <body>
    <?php
        include("simple_html_dom/simple_html_dom.php");
        include("upgrade.database.php");
        
        $urlBaseT = "http://www.senado.gov.br/senadores/default.asp";
        $html = file_get_html($urlBaseT);
        $l = 0;
        foreach($html->find('div[id="conteudo"]')as $value){
            foreach ($value->find('td[class="colNomeSenador"]') as $valor){
                foreach($valor->find('a') as $id){
                    $pol[$l] = $id->href;
                    //echo $l.":".$id->href . '<br>';
                    $l = $l + 1;
                }   
            }          
        }
        
        for ($k=0 ; $k<81 ; $k++){
            if($k==1){
            $urlBase = "http://www.senado.gov.br".$pol[$k];
            //guarda id do senador
            $id = $urlBase;
            $id=  str_replace("http://www.senado.gov.br/senadores/dinamico/paginst/senador", "", $id);
            $id=  str_replace("a.asp", "", $id);

            $html = file_get_html($urlBase);

            //começa raspagem
            foreach($html->find('div[id="conteudo"]')as $value){
                foreach ($value->find('div[id="conteudoCentral"]') as $valor){
                    $i =0;

                    //foto politico
                    foreach($valor->find('img') as $imagem){
                        $link = "http://www.senado.gov.br".$imagem->src;
                        //echo "<img src ='$link' height='150' width='120'>" . '<br>'; 
                        //echo $link;
                    }

                    //dados pessoais
                    foreach ($valor->find('div[class="dadosSenador"]') as $infor){;
                        $info[$i] = $infor->plaintext;
                        if ( $i == 0){
                            $j = 0;
                            foreach ($infor->find('b') as $teste){
                                $cont[$j] = $teste->plaintext;
                                $j = $j +1;
                            }
                        }
                        $i = $i + 1;  
                    }
                    /*echo "<br>";
                    echo "Nome Civil: ".$cont[0]."<br>";
                    echo "Data de nascimento: ".$cont[1]."<br>";
                    echo "Partido / UF: ".$cont[2]."<br>";
                    echo "Naturalidade: ".$cont[3]."<br>";
                    echo "Endereço Parlamentar: ".$cont[4]."<br>";
                    echo "Telefones: ".$cont[5]."<br>";
                    echo "Faz: ".$cont[6]."<br>";
                    echo "Correio Eletronico: ".$cont[7]."<br>";*/
                    
                    $anexo = null;$ala = null;$gabinete = null;$email = $cont[7];$telefone = $cont[5];
                    $fax = $cont[6];$tipo = null;$rua = null;$bairro= null;$cidade = null;
                    $estado = null; $CEP = null; $CNPJ = null; $telefone_parlamento = null;
                    $disque =null;$site=null;

                    if($k == 1){
                        echo existePoli($cont[0], $cont[1]);
                        $resposta = endereco_parlamentar_politico(existePoli($cont[0], $cont[1]), $anexo, $ala, 
                                $gabinete, $email, $telefone, 
                                $fax, $tipo, $rua, $bairro, $cidade, $estado, 
                                $CEP, $CNPJ, $telefone_parlamento, $disque, $site);
                    }

                    //Mandato
                    $j =0;
                    foreach($valor->find('fieldset[class="fsBox"]') as $mand){
                        foreach($mand->find('li') as $mandato){
                            if($j<2){
                                /*echo $mandato->plaintext."<br>";*/
                                $j++;
                            }
                        }
                    }  
                }
            }
           //MISSOES
            $url = "http://www.senado.gov.br/senadores/dinamico/paginst/senador".$id."b.asp";
            $html = file_get_html($url);
            if ($html != null){
                foreach($html->find('div[id="conteudo"]')as $value){
                    foreach ($value->find('div[id="conteudoCentral"]') as $valor){
                        foreach($valor->find('fieldset[class="fsBox"]') as $miss){
                            foreach($miss->find('li') as $missoes){
                                    //echo $missoes->plaintext."<br>";
                            }
                        }
                    }  
                }
            }        
            //LIDERANCA   
            $url = "http://www.senado.gov.br/senadores/dinamico/paginst/senador".$id."c.asp";
            $html = file_get_html($url);
            if ($html != null){ 
                foreach($html->find('div[id="conteudo"]')as $value){
                    foreach ($value->find('div[id="conteudoCentral"]') as $valor){
                        foreach($valor->find('fieldset[class="fsBox"]') as $lid){
                            foreach($lid->find('li') as $liderancas){
                                    //echo $liderancas->plaintext."<br>";
                            }
                        }

                    }  
                }
            }
            }
        }
        
    ?>
 </body>
</html> 