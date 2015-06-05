<html>
 <head>
  <meta  charset=utf-8 />
  <title> TSE 2014 Raspagem </title>
 </head>
 <body>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        include ("upgrade.database.php");
        include("simple_html_dom/simple_html_dom.php");
        $url = "http://divulgacand2014.tse.jus.br/divulga-cand-2014/menu/2014";
        $html= file_get_html($url);
        $i=0;
        foreach($html->find('a[class="btn-sm"]') as $est){
                $estados[$i]=$est->href;
                //echo $estados[$i];
            $i++; 
        }
        //for($j=1;$j<$i;$j++){
            
            $url0="http://divulgacand2014.tse.jus.br".$estados[1];
            $html0= file_get_html($url0);
            foreach($html0->find('div[class="col-md-4"]') as $button){// escolher entre governador, vice, senadors, dep federal e estadual
            
                foreach($button->find('ul[class="dropdown-menu"]') as $dropdown){
                    $k=0;
                    foreach($dropdown->find('a') as $cat){
                        $categoria[$k] = "http://divulgacand2014.tse.jus.br".$cat->href;
                        $html00 = file_get_html($categoria[$k]);
                        if($k==6){
                            foreach($html00->find('table[id="tbl-candidatos"]') as $candidatos){
                                $i=0;
                                foreach($candidatos->find('tr') as $tbody){
                                    if($i>2){
                                    $pol[$i] = $tbody;
                                        foreach($pol[$i]->find('a') as $li){
                                            $link = "http://divulgacand2014.tse.jus.br".$li->href;
                                            //echo $link."<br>";
                                            $html2 = file_get_html($link);

                                            //RASPAGEM DE DADOS PESSOAIS DO POLITICO
                                            foreach($html2->find('table[class="table table-condensed table-striped"]') as $dados){   
                                                foreach($dados->find('span') as $situ){
                                                    //echo $situ->plaintext."<br>";
                                                    $situacao = $situ->plaintext;
                                                }
                                                $j=0;
                                                foreach($dados->find('td') as $pesso){
                                                    $pessoais[$j]=$pesso;
                                                    if($j == 0){
                                                        $cargo_par = explode("|" , $pessoais[0]);
                                                        $cargo_parte = explode(" ", $cargo_par[0]);
                                                        $cargo = $cargo_parte[4];
                                                        //echo $cargo."<br>";
                                                    }
                                                    else{
                                                        //echo $j."-" ;
                                                        //echo $pessoais[$j]."<br>";
                                                        
                                                    }
                                                    $j++;
                                                    
                                                }
                                                echo $pessoais[1]."-";
                                                $nome_parlamentar = $pessoais[1]->plaintext; $numero = $pessoais[2]->plaintext; 
                                                $nome_civil = $pessoais[3]->plaintext; $sexo ="MASCULINO" /*$pessoais[4]->plaintext*/; $data_nascimento = $pessoais[5]->plaintext;
                                                $estado_civil = $pessoais[6]->plaintext;
                                                $cor = $pessoais[7]->plaintext; $nacionalidade = $pessoais[8]->plaintext; $cidade_nascimento = $pessoais[9]->plaintext;
                                                $grau_instrucao = $pessoais[10]->plaintext; $ocupacao = $pessoais[11]->plaintext; $site = $pessoais[12]->plaintext;
                                                $partido = $pessoais[13]->plaintext; $coligacao = $pessoais[14]->plaintext;$partidos_coligacao = $pessoais[15]->plaintext;
                                                $numero_processo = $pessoais[16]->plaintext; $numero_protocolo = $pessoais[17]->plaintext; $CNPJ = $pessoais[18]->plaintext;
                                                $limite_gastos = $pessoais[19]->plaintext;$nome_pai = null ; $nome_mae = null ; 
                                                $foto = null ; $estado_nascimento = null ; $cidade_eleitoral = null ; 
                                                $estado_eleitoral = null ; $email = null; $cargo_uf = null;
                                                
                                         
                                                /*$resposta = politico($nome_civil, $nome_parlamentar, $nome_pai, 
                                                        $nome_mae, $foto, $sexo, $cor, $data_nascimento, $estado_civil, 
                                                        $ocupacao, $grau_instrucao, $nacionalidade, $cidade_nascimento, 
                                                        $estado_nascimento, $cidade_eleitoral, $estado_eleitoral, $site, 
                                                        $email, $cargo, $cargo_uf, $partido, $situacao);
                                                //echo $resposta;*/
                                            }
                                        }   
                                            
                                            //FOTO
                                            foreach($html2->find('img[class="pull-left foto-candidato"]') as $foto){
                                                $link = "http://divulgacand2014.tse.jus.br".$foto->src;
                                                //echo "<img src ='$link' height='150' width='120'>" . '<br>';
                                                //foto_politico($link, $resposta);
                                            }
                                            //RASPAGEM DE DECLARACAO DE BENS
                                            foreach($html2->find('div[id="tab-bens"]') as $declaracaoBens){
                                                foreach($declaracaoBens->find('table[class="table table-condensed table-bordered table-striped"]') as $decla){
                                                    $k=0;
                                                    foreach($decla->find('tr') as $declara){
                                                        $declaracao[$k] = $declara;
                                                        if($k!=0){
                                                            $l=0;
                                                            foreach($declaracao[$k]->find('td') as $bens){
                                                                $bem[$l]=$bens;
                                                                $l++;
                                                            }
                                                            
                                                            $descricao = $bem[0];
                                                            $valor = $bem[1];
                                                            //echo $descri.": ".$valor."<br>";
                                                        }
                                                        $k++;
                                                    }
                                                    $l=0;
                                                    foreach($decla->find('th[class="text-right"]') as $to){
                                                        if($l!=0){
                                                            $total = $to;
                                                            //echo "Total: ".$total."<br>";
                                                        }
                                                        $l++;
                                                    }
                                                }
                                            }
                                            //echo "-------------<br>";
                                    
                                    }
                                    $i++;
                                    }
                                    
                                }  
                            }       
                        $k++;
                        }
                        
                    }
                }
            echo $i."<br>";
        //}
        
        //CANDIDADOS A PRESIDENCIA E VICES. INDICE 0 
        //PRESIDENCIA
        /*$url1="http://divulgacand2014.tse.jus.br".$estados[0];
        $html1= file_get_html($url1);
        
        foreach($html1->find('table[id="tbl-candidatos"]') as $candidatos){
            $i =0;
            foreach($candidatos->find('tr') as $tbody){
                $pol[$i] = $tbody;
                if($i==3){
                    foreach($pol[$i]->find('a') as $li){
                        $link = "http://divulgacand2014.tse.jus.br".$li->href;
                        $html2 = file_get_html($link);
                        
                        //FOTO
                        foreach($html2->find('img[class="pull-left foto-candidato"]') as $foto){
                            $link = "http://divulgacand2014.tse.jus.br".$foto->src;
                            //echo "<img src ='$link' height='150' width='120'>" . '<br>';
                        }
                        
                        //RASPAGEM DE DADOS PESSOAIS DO POLITICO
                        foreach($html2->find('table[class="table table-condensed table-striped"]') as $dados){
                            foreach($dados->find('span') as $situ){
                                //echo $situ->plaintext."<br>";
                            }
                            $j=0;
                            foreach($dados->find('td') as $pesso){
                                $pessoais[$j]=$pesso;
                                if($j!=0){
                                    //echo $pessoais[$j]."<br>";
                                }
                                $j++;
                            }
                        }
                        //RASPAGEM DE DECLARACAO DE BENS
                        echo "<br>";
                        foreach($html2->find('div[id="tab-bens"]') as $declaracaoBens){
                            foreach($declaracaoBens->find('table[class="table table-condensed table-bordered table-striped"]') as $decla){
                                $k=0;
                                foreach($decla->find('tr') as $declara){
                                    $declaracao[$k] = $declara;
                                    if($k!=0){
                                        $l=0;
                                        foreach($declaracao[$k]->find('td') as $bens){
                                            $bem[$l]=$bens;
                                            $l++;
                                        }
                                        $descri = $bem[0];
                                        $valor = $bem[1];
                                        //echo $descri.": ".$valor."<br>";
                                    }
                                    $k++;
                                }
                                $l=0;
                                foreach($decla->find('th[class="text-right"]') as $to){
                                    if($l!=0){
                                        $total = $to;
                                        //echo "Total: ".$total."<br>";
                                    }
                                    $l++;
                                }
                            }
                        }
                        echo "-------------<br>";
                    }
                }
                $i++;
            }  
        }*/
        
        //VICES
        /*$url11 = str_replace("http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/UF/BR/candidatos/cargo/1","http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/UF/BR/candidatos/cargo/2" , $url1);
        $html11 = file_get_html($url11); 
        foreach($html11->find('table[id="tbl-candidatos"]') as $candidatos){
            $i =0;
            foreach($candidatos->find('tr') as $tbody){
                $pol[$i] = $tbody;
                if($i==3){
                    foreach($pol[$i]->find('a') as $li){
                        $link = "http://divulgacand2014.tse.jus.br".$li->href;
                        $html2 = file_get_html($link);
                        
                        //FOTO
                        foreach($html2->find('img[class="pull-left foto-candidato"]') as $foto){
                            $link = "http://divulgacand2014.tse.jus.br".$foto->src;
                            echo "<img src ='$link' height='150' width='120'>" . '<br>';
                        }
                        
                        //RASPAGEM DE DADOS PESSOAIS DO POLITICO
                        foreach($html2->find('table[class="table table-condensed table-striped"]') as $dados){
                            foreach($dados->find('span') as $situ){
                                echo $situ->plaintext."<br>";
                            }
                            $j=0;
                            foreach($dados->find('td') as $pesso){
                                $pessoais[$j]=$pesso;
                                if($j!=0){
                                    echo $pessoais[$j]."<br>";
                                }
                                $j++;
                            }
                        }
                        //RASPAGEM DE DECLARACAO DE BENS
                        echo "<br>";
                        foreach($html2->find('div[id="tab-bens"]') as $declaracaoBens){
                            foreach($declaracaoBens->find('table[class="table table-condensed table-bordered table-striped"]') as $decla){
                                $k=0;
                                foreach($decla->find('tr') as $declara){
                                    $declaracao[$k] = $declara;
                                    if($k!=0){
                                        $l=0;
                                        foreach($declaracao[$k]->find('td') as $bens){
                                            $bem[$l]=$bens;
                                            $l++;
                                        }
                                        $descri = $bem[0];
                                        $valor = $bem[1];
                                        echo $descri.": ".$valor."<br>";
                                    }
                                    $k++;
                                }
                                $l=0;
                                foreach($decla->find('th[class="text-right"]') as $to){
                                    if($l!=0){
                                        $total = $to;
                                        echo "Total: ".$total."<br>";
                                    }
                                    $l++;
                                }
                            }
                        }
                        echo "-------------<br>";
                    }
                }
                $i++;
            }  
        }*/
        //}
    ?>

 </body>
</html> 