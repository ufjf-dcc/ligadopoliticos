<html>
 <head>
  <meta  charset=utf-8 />
  <title> TSE Raspagem </title>
 </head>
 <body>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        include("simple_html_dom/simple_html_dom.php");
        include('controleRaspagem.php');
        include('upgrade.database.php');
        $url = "http://divulgacand2014.tse.jus.br/divulga-cand-2014/menu/2014";
        $html= file_get_html($url);
        if($html != null){
            $i=0;
            foreach($html->find('a[class="btn-sm"]') as $est){
                    $estados[$i]=$est->href;
                $i++; 
            }
            $arquivo = file('/var/www/html/ligadopoliticos/controlador.txt');
                $t = (int)$arquivo[0];
                $c = 0;
                $url0="http://divulgacand2014.tse.jus.br".$estados[1];
                $html0= file_get_html($url0);
                foreach($html0->find('div[class="col-md-4"]') as $button){// escolher entre governador, vice, senadors, dep federal e estadual
                    foreach($button->find('ul[class="dropdown-menu"]') as $dropdown){
                        $k=0;
                        foreach($dropdown->find('a') as $cat){
                            if($k>0){
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
                                                    //echo $link."<br>";
                                                    if($c==0){
                                                        $resposta = rasPolitico($link);
                                                    }
                                                    //echo $t."-";
                                                    $t++;
                                                    file_put_contents('/var/www/html/ligadopoliticos/controlador.txt',$t);
                                                }
                                                $c++;
                                            }
                                        }$i++;  
                                    }  
                                } 
                            }
                        $k++;    
                        }
                    }
                } 
        }        
    ?>
 </body>
</html> 
