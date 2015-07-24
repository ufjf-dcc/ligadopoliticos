<html>
 <head>
  <meta  charset=utf-8 />
  <title> TSE 2014 Raspagem </title>
 </head>
 <body>
    <?php
    //include ("upgrade.database.php");

    function rasPolitico($link){
        $login = "marcos:123" ;
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        $html2 = file_get_html($link);

            //RASPAGEM DE DADOS PESSOAIS DO POLITICO
            foreach($html2->find('table[class="table table-condensed table-striped"]') as $dados){   
                foreach($dados->find('span') as $situ){
                    $situacao = $situ->plaintext;
                }
                $j=0;
                foreach($dados->find('td') as $pesso){
                    $pessoais[$j]=$pesso;
                    if($j == 0){
                        $cargo_par = explode("|" , $pessoais[0]);
                        $cargo_parte = explode(" ", $cargo_par[0]);
                        $cargo = $cargo_parte[4];
                    }
                    else{
                        //echo $j."-" ;
                        //echo $pessoais[$j]."<br>";
                    }
                    $j++;
                }
                echo $pessoais[1]."-";
                //$decisao = $pessoais[1];
                $nome_parlamentar = $pessoais[1]->plaintext; $numero = $pessoais[2]->plaintext; 
                $nome_civil = $pessoais[3]->plaintext; $sexo =$pessoais[4]->plaintext; $data_nascimento = $pessoais[5]->plaintext;
                $estado_civil = $pessoais[6]->plaintext;
                $cor = $pessoais[7]->plaintext; $nacionalidade = $pessoais[8]->plaintext; $cidade_nascimento = $pessoais[9]->plaintext;
                $grau_instrucao = $pessoais[10]->plaintext; $ocupacao = $pessoais[11]->plaintext; $site = $pessoais[12]->plaintext;
                $partido = $pessoais[13]->plaintext; $coligacao = $pessoais[14]->plaintext;$partidos_coligacao = $pessoais[15]->plaintext;
                $numero_processo = $pessoais[16]->plaintext; $numero_protocolo = $pessoais[17]->plaintext; $CNPJ = $pessoais[18]->plaintext;
                $limite_gastos = $pessoais[19]->plaintext;$nome_pai = null ; $nome_mae = null ; 
                $foto = null ; $estado_nascimento = null ; $cidade_eleitoral = null ; 
                $estado_eleitoral = null ; $email = null; $cargo_uf = null;
                $resposta = politico($nome_civil, $nome_parlamentar, $nome_pai,
                        $nome_mae, $foto, $sexo, $cor, $data_nascimento, $estado_civil, 
                        $ocupacao, $grau_instrucao, $nacionalidade, $cidade_nascimento, 
                        $estado_nascimento, $cidade_eleitoral, $estado_eleitoral, $site, 
                        $email, $cargo, $cargo_uf, $partido, $situacao);

            }


            //FOTO
            foreach($html2->find('img[class="pull-left foto-candidato"]') as $foto){
                $link = "http://divulgacand2014.tse.jus.br".$foto->src;
                //echo "<img src ='$link' height='150' width='120'>" . '<br>';
                foto_politico($link, $resposta);
            }
            /*
            //RASPAGEM DE DECLARACAO DE BENS
            $id = existepoliDecla($pessoais[3]->plaintext);
            echo "POLITICO:".$id."<br>";
            foreach($html2->find('div[id="conteudo-tabs"]') as $declaracaoBens) {
                foreach ($declaracaoBens->find('div[class="tab-pane active"]') as $declaracaoBens1){
                    foreach ($declaracaoBens1->find('table[class="table table-condensed table-bordered table-striped"]') as $decla) {
                        $k = 0;
                        foreach ($decla->find('tr') as $declara) {
                            $declaracao[$k] = $declara;
                            if ($k != 0) {
                                $l = 0;
                                foreach ($declaracao[$k]->find('td') as $bens) {
                                    $bem[$l] = $bens;
                                    if($l==0)$descricao = $bem[0]->plaintext;
                                    if($l==1){
                                        $valor = $bem[1]->plaintext;
                                        $valor = str_replace(".", "", $valor);
                                        $valor = str_replace(",", ".", $valor);
                                        $valor = str_replace("R$ ", "", $valor);
                                        $valor = (double)$valor;
                                        $resposta = declaracao_bens($id, "2014", $descricao, null, $valor);
                                    }
                                    $l++;
                                }
                            }
                            $k++;
                        }
                    }
                }
            }
        return 1;
    
        /*if ($decisao == null){
            return 0;
        }
        else{
            //echo $decisao."-";
            return 1;
        }*/
    } 
    
    ?>

 </body>
</html> 



