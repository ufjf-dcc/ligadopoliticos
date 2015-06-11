
<?php
include ("upgrade.database.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("simple_html_dom/simple_html_dom.php");
$url = "http://divulgacand2014.tse.jus.br/divulga-cand-2014/eleicao/2014/UF/RJ/candidatos/cargo/7";
$html = new simple_html_dom();
$html->load_file($url);
//$html = file_get_html($url);
$c = 0;
$arquivo = file('/var/www/html/ligadopoliticos/controlador.txt');
$t = (int)$arquivo[0];
foreach($html->find('table[id="tbl-candidatos"]') as $candidatos){
    $i=0;
    foreach($candidatos->find('tr') as $tbody){
        if($i>2){
            $pol[$i] = $tbody;
            foreach($pol[$i]->find('a') as $li){
                if($c >= $t){
                    $link= "http://divulgacand2014.tse.jus.br".$li->href;
                    $t++;
                    echo $link;
                    //file_put_contents('/var/www/html/ligadopoliticos/controlador.txt',$t);
                }
                $c++;
            }
        }$i++;
    }
}
?>