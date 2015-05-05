<html>
 <head>
  <meta  charset=utf-8 />
  <title> Senado Raspagem </title>
 </head>
 <body>
    <?php
        // raspagem do site http://www.pm.sc.gov.br/desaparecidos/
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
            echo $politico[$j]."<br>";
            $j = $j + 1;
        }
    ?>
 </body>
</html> 
