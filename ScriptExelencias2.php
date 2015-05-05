<html>
 <head>
  <meta  charset=utf-8 />
  <title> Exelencias Raspagem </title>
 </head>
 <body>
    <?php
        include("simple_html_dom/simple_html_dom.php");
        $urlBase = "http://www.excelencias.org.br/@parl.php?id=83028&cs=2";
        $html = file_get_html($urlBase);
        
        foreach($html->find('div[class="fundinho"]') as $fund){
            foreach($fund->find('img[style="vertical-align:top;cursor:pointer"]') as $link){//aux para declaracao de bens
                $idBens = $link->onclick;
                $idBens = str_replace("traz_bens(", "", $idBens);
                $idBens = str_replace(")", "", $idBens);
            }
            echo "Historico de candidaturas <br>";
            foreach($fund->find('span[class="txt_peq"]') as $hist){ //script historico de candidaturas
                echo $hist->plaintext."<br>";
            }
        }
        echo "<br>";
        echo "Declaração de Bens <br>";
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
        echo $total[0]."<br>";
        echo $total[2]."<br>"."<br>";
        for($x=0;$x<$l;$x++){
            
        }
        
        $dado = explode ("⇒",$dados[0]);
        echo $dado[0]."<br>";
        echo $dado[1]."<br>";
    ?>
 </body>
</html>