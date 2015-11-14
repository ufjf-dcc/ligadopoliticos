<h2> <?php escreve("Contato","Contact") ?> </h2><br />


<?php
if (!$_POST){

escreve(
  "Qualquer <b>dúvida</b>, <b>sugestão</b>, <b>crítica</b>, <b>elogio</b> ou <b>erro encontrado</b>, por favor entre em contato através do formulário abaixo.",
  "Any <b>questions</b>, <b>suggestions</b>, <b>criticism</b>, <b>compliment</b> or <b>error found</b>, please contact us using the form below."
);

echo "
<br />
<br />
<form id='form1' name='form1' method='post' action=''>

  <table align=center width='500' border='0' cellspacing='2' cellpadding='5'>
    <tr>
      <td>";
      escreve("Nome:","Name:");
      echo "
      </td>
      <td><input name='nome' type='text' id='nome' size='40'/></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><input name='email' type='text' id='email' size='40'/></td>
    </tr>
    <tr>
      <td>";
      escreve("Cidade:","City:");
      echo "
      </td>
      <td>
        <input name='cidade' type='text' id='cidade' size='22'/>
        ";
        escreve("Estado:","State:");
        echo "
        <input name='estado' type='text' id='estado' size='2'/>
      </td>
    </tr>

    <tr>
      <td>";
      escreve("Mensagem:","Message:");
      echo "
      </td>
      <td><textarea name='mensagem' cols='40' rows='10' id='mensagem'></textarea></td>
    </tr>
    <tr>
      <td> </td>
      <td><input type='submit' name='Submit' value=";
      escreve("Enviar","Send");
      echo " /></td>
    </tr>
  </table>
</form>

";

}else{
   $corpo = "Cidade: ".$_POST["cidade"]."<br />"."Estado: ".$_POST["estado"]."<br /><br />".$_POST["mensagem"]."\n";

$headers ="From: $_POST[nome] <$_POST[email]>\n"; 
$headers.="X-Sender:<$_POST[email]>\n"; //<Endereço do remetente>
$headers.="Return-Path: <$_POST[email]>\n"; //<Endereço do remetente>
$headers.="Bcc:<lucas.ufjf@gmail.com>\n>"; //O mesmo que Cc (cópias)
$headers.="Content-Type: text/html;\n";
$headers.="Content-Type: text/html; charset=iso-8859-1\n";
$headers.="Content-Type: text/html; charset=us-ascii\n";
$headers.="Content-Transfer-Encoding: 8bit\n";

 //  $headers = 'From: webmaster@example.com' . "\r\n" .
  //  'Reply-To: webmaster@example.com' . "\r\n" .
   // 'X-Mailer: PHP/' . phpversion();

   //envio o correio...
   mail("lucas.ufjf@gmail.com","[LIGADOnosPOLITICOS] Contato",$corpo, $headers);

   //agradeço pelo envio
   echo "<br /><br /><br /><br /><br /><center>A mensagem foi enviada corretamente.<br /><br />Agradeçemos sua visita e o seu contato.<br /><br /><a href='?pag=contato'>Voltar</a></center><br /><br /><br /><br /><br /><br /><br />";
}
?> 