<html>
 <head>
  <meta  charset=utf-8 />
  <title> Senado Raspagem </title>
 </head>
 <body>
    <?php
        include("simple_html_dom/simple_html_dom.php");
        $urlBase = "http://www.senado.gov.br/senadores/default.asp";
        $html = file_get_html($urlBase);
        $i = 0;
        foreach($html->find('div[id="conteudo"]')as $value){
            foreach ($value->find('td[class="colNomeSenador"]') as $valor){
                foreach($valor->find('a') as $id){
                    $pol[$i] = $id->href;
                    //echo $id->href . '<br>';
                    $i = $i + 1;
                    
                }   
            }          
        }
        for ($j=0 ; $j<$i ; $j++){
            echo $pol[$j]."<br>";
        }
    ?>
 </body>
</html> 
