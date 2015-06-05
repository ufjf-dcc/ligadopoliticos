<html>
 <head>
  <meta  charset=utf-8 />
  <title> Camara Raspagem </title>
 </head>
 <body>
    <?php
        include("simple_html_dom/simple_html_dom.php");
        $html = file_get_html("http://www.camara.gov.br/internet/Deputado/dep_Detalhe.asp?id=178957");
        echo $html;
    
    ?>
 </body>
</html> 