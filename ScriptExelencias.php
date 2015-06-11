<html>
 <head>
  <meta  charset=utf-8 />
  <title> Exelencias Raspagem </title>
 </head>
 <body>
    <?php
        $login = "marcos:123" ;
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        include ("upgrade.database.php");
        include("simple_html_dom/simple_html_dom.php");
        $urlBase = "http://www.excelencias.org.br/@busca.php?";
        $html = file_get_html($urlBase);
        foreach($html->find('div[id="contem_busca"]') as $busca){
            $i= 0;
            foreach($busca->find('a') as $pol){
                $politico[$i] = $pol->href;
                $i = $i + 1;
            }
        }
        $j = 0;
        while($j!=$i){
            $i = 5;
            $urlBase = "http://www.excelencias.org.br/$politico[$j]";
            $html = file_get_html($urlBase);

            foreach($html->find('div[class="fundinho"]') as $fund){
                foreach($fund->find('img[style="vertical-align:top;cursor:pointer"]') as $link){//aux para declaracao de bens
                    $idBens = $link->onclick;
                    $idBens = str_replace("traz_bens(", "", $idBens);
                    $idBens = str_replace(")", "", $idBens);
                }
                /* HISTORICO DE CANDIDATURAS
                foreach($fund->find('span[class="txt_peq"]') as $hist){ //script historico de candidaturas
                    //echo $hist->plaintext."<br>";
                }*/
            }

            foreach($html->find('div[id="espaco"]') as $espaco){
                $q=0;
                foreach($espaco->find('p[class="txt"]') as $texto){
                    $textoo[$q]=$texto->plaintext;
                    $q++;
                }
                $nome = mb_strtoupper(str_replace("Nome de batismo: ", "",$textoo[0]), 'UTF-8');
                $id_politico = existePoliDecla($nome);
            }

            //SCRIPT DECLARACAO DE BENS 
            $urlBase2 = "http://www.asclaras.org.br/partes/candidato/@bens.php?id=".$idBens."&orig=exc";
            $html1 = file_get_html($urlBase2);
            $k = 0;
            foreach ($html1->find('table') as $decla){
                $declaracao[$k] = $decla;
                if($k==0){;
                    $l = 0;
                    foreach($declaracao[$k]->find('td') as $data){
                        $dados[$l] = $data->plaintext;
                        $l = $l + 1;
                    }
                    $t =0;
                    foreach($declaracao[$k]->find('th') as $tot){
                        $total[$t] = $tot;
                        $t = $t + 1;
                    }

                }
                $k = $k + 1;

            }
            //echo $total[0]."<br>";
            //echo $total[2]."<br>"."<br>";
            if($id_politico != 0){
                for($x=0;$x<$l;$x++){
                    if($x % 2 == 0){
                        $dado = explode('&#8658;',$dados[$x]);
                        $tipo=$dado[0];
                        $descricao=$dado[1];
                        //echo $dado[0]."<br>";
                        //echo $dado[1]."<br>";
                    }
                    else {
                        //echo $dados[$x]."<br>";
                        $valor = str_replace(".", "", $dados[$x]);
                        $valor = (int)str_replace("R$", "", $valor);
                        //echo $id_politico."1";
                        if ($j == 0 ) {
                            echo $id_politico. "<br>";
                            $resposta = declaracao_bens($id_politico, "2014", $descricao, $tipo, $valor);
                        }
                    }
                    //echo "---------<br>";
                }
            }
        
            $j = $j + 1;
        }
    ?>
 </body>
</html>