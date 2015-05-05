<html>
 <head>
  <meta  charset=utf-8 />
  <title> TSE Raspagem </title>
 </head>
 <body>
    <?php
        //http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/UF/MG/candidatos/cargo/3
        //http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/idEleicao/143/cargo/3/UF/AL/candidato/20000000026
    
        include("simple_html_dom/simple_html_dom.php");
        $url = "http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/UF/BR/candidatos/cargo/1";
        $html= file_get_html($url);
        echo $html->plaintext;
        
    ?>
 </body>
</html> 
