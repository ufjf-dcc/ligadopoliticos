<?php
    
include '../upgrade.database.php';
include '../properties.php';
include '../consultasSPARQL.php';

error_reporting(E_ALL);
$arquivo = fopen('dadosCompletos.txt', 'r');
$de = 21500; //Lê os politicos a partir da linha colocada na variavel $de
$ate = 22000; //até a linha colocada na variavel $ate
$atual = 0; //variavel que funciona como contador
while(!feof($arquivo) && $atual <= $ate){
    $linha = fgets($arquivo);
    //Não pega a ultima linha do arquivo
    if($linha != ''){
        if($atual >= $de){
            $dados = explode("\|de|/", $linha);
            foreach ($dados as $dado)
            if ($dado == "")
                $dado = NULL;
            salvaDadosAllegro($dados);
            echo $atual.'</br>';
        }
        $atual++;
    }
}

fclose($arquivo);

function salvaDadosAllegro($dados){
    $nomePol = $dados[5];
    $dataNas = $dados[8];
    $cargo = $dados[2];
    $partido = $dados[3];
    $numProtocolo = $dados[21];
    $cnpj = $dados[22];
        
    //colocar o cargo e o protocolo
    if($nomePol != NULL && $dataNas != NULL && $cargo != NULL && $partido != NULL && $numProtocolo != NULL && $cnpj != NULL && strcmp($cnpj, "Visualizar processo de atribuição de CNPJ") != 0 && $numProtocolo != ''){
        echo "Cargo: ".$cargo."numPro: ".$numProtocolo."Nome: ".$nomePol.'</br>';
        $id = existePoli($nomePol, $dataNas);
        $anosEleicoes = NULL;
        $naoConcorreuDepois2012 = TRUE;
        if($id != 0){
            $consulta ='select ?ano
                    where{
                     <http://ligadonospoliticos.com.br/politico/'.$id.'> polbr:election ?election.
                     ?election timeline:atYear ?ano                                                    
                    }
                    group by ?ano';
            $anosEleicoes = consultaSPARQL($consulta);
            
            foreach ($anosEleicoes as $ano)
                if($ano['ano'] > 2012)
                    $naoConcorreuDepois2012 = FALSE;
        }
        
       //confere se o candidato não possui site
       if(strcmp($dados[17], "NULL") == 0)
                $dados[17] = NULL;
       
       //Se o candidato é novo ou não concorreu depois de 2012
        if($id == 0 || $naoConcorreuDepois2012){
            $id = politico_Prefeito_Vereador($dados[5], $dados[9], strtoupper($dados[12]), $dados[8], $dados[13], $dados[15], $dados[16], $dados[14], $dados[6], $dados[7], $dados[17], $dados[2], $dados[1], $dados[0], $dados[3], $dados[4]);
        }
        eleicao_Prefeito_Vereador($id, "2012", $dados[10], $dados[11], $dados[3], $dados[2], $dados[1], $dados[0], NULL, $dados[18], $dados[19], $dados[4], $dados[21], $dados[20], $dados[22]);
          
        $bensEleicao = $dados[23];
        //confere se o politico possui bens
        if(strcmp($bensEleicao, "\n") != 0){
            $bensEleicao = str_replace("\|db|/\n", "", $bensEleicao);
            $bens = explode("\|db|/", $bensEleicao);
            if(strcmp($bensEleicao, "\n") != 0){
                $i = 0;
                while ($i < count($bens)){
                    if($bens[$i] != "" && $bens[$i+1] != "" && $bens[$i+2] != "")
                        declaracao_bens($id, "2012", $bens[$i++], $bens[$i++], $bens[$i++]);
                    else
                        $i = $i+3;
                } 
            }
        }
    }
}

?>

