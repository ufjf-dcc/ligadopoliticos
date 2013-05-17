<h2> Continue Ligado! </h2><br />

Para receber as informações das novidades e atualizações no site cadastre o seu e-mail abaixo.<br /><br />
<?php
if (!$_POST){

echo "
<form id='form2' name='form2' method='post' action=''>

  <table align=center width='500' border='0' cellspacing='2' cellpadding='5'>
    <tr>
      <td>Nome:</td>
      <td><input name='nome' type='text' id='nome' size='40'/></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><input name='email' type='text' id='email' size='40'/></td>
    </tr>
    <tr>
      <td>Cidade:</td>
      <td>
        <input name='cidade' type='text' id='cidade' size='22'/>
        Estado:
        <input name='estado' type='text' id='estado' size='2'/>
      </td>
    </tr>
    <tr>
      <td> </td>
      <td><input type='submit' name='Submit' value='Realizar Cadastro' /></td>
    </tr>
  </table>
</form>

";

}else{
   $corpo = "Cidade: ".$_POST["cidade"]."<br />"."Estado: ".$_POST["estado"]."<br />";

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
   mail("lucas.ufjf@gmail.com","[LIGADOnosPOLITICOS] Cadastro",$corpo, $headers);

   //agradeço pelo envio
   echo "<br /><center>O cadastro foi realizado corretamente.<br /><br />Agradeçemos sua visita e o seu cadastro.<br /><br /><a href='?pag=contato'>Voltar</a></center><br />";
}
?> 