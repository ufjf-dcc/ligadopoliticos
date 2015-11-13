<html>
 <head>
  <meta  charset=utf-8 />
  <title> TSE Raspagem </title>
 </head>
 <body>
    <?php
        include("simple_html_dom/simple_html_dom.php");
        include('controleRaspagem.php');
        include('upgrade.database.php');
        $url = "http://divulgacand2014.tse.jus.br/divulga-cand-2014/menu/2014";
        //$html= file_get_html($url);
        $html = new simple_html_dom();
        $html->load_file($url);
        if($html != null){
            $i=0;
            foreach($html->find('a[class="btn-sm"]') as $est){
                    $estados[$i]=$est->href;
                $i++; 
            }
            $arquivo = file('/var/www/html/ligadopoliticos/controlador.txt');
                $t = (int)$arquivo[0];
                $c = 0;
                $url0="http://divulgacand2014.tse.jus.br".$estados[0];//cada indice corresponde a um link de um estado
                //$html0= file_get_html($url0);
                $html0 = new simple_html_dom();
                $html0->load_file($url0);
                $k=0;
                foreach($html0->find('div[class="col-md-4"]') as $button){// escolher entre governador, vice, senadors, dep federal e estadual
                    foreach($button->find('ul[class="dropdown-menu"]') as $dropdown){

                        foreach($dropdown->find('a') as $cat){
                            //if($k==0 || $k== 1 || $k ==2 || $k ==3 || $k==4 || $k==5 || $k==6 ){//0gover - 1vicegover - 2senador - 3primeirosuplen - 4segundosuplen - 5depfederal - 6depestadual
                                $categoria[$k] = "http://divulgacand2014.tse.jus.br".$cat->href;
                                //$html00 = file_get_html($categoria[$k]);
                                $html00 = new simple_html_dom();
                                $html00->load_file($categoria[$k]);
                                foreach($html00->find('table[id="tbl-candidatos"]') as $candidatos){
                                    $i=0;
                                    foreach($candidatos->find('tr') as $tbody){
                                        if($i>2){
                                        $pol[$i] = $tbody;
                                            foreach($pol[$i]->find('a') as $li){
                                                if($c >= $t){
                                                    $link= "http://divulgacand2014.tse.jus.br".$li->href;
                                                    $resposta = rasPolitico($link);
                                                    $t++;
                                                    file_put_contents('/var/www/html/ligadopoliticos/controlador.txt',$t);
                                                }
                                                $c++;
                                            }
                                        }$i++;  
                                    }  
                                } 
                            //}
                        $k++;    
                        }
                    }
                } 
        }
    ?>
 </body>
</html> 
