<?php
//email para qual irá os dados
$email="certificados@e-profissionalizando.com";

//pego os dados enviados pelo formulario
$nome=$_POST["nome"];
$endereco=$_POST["endereco"];
$cidade=$_POST["cidade"];
$numero=$_POST["numero"];
$complemento=$_POST["complemento"];
$estado=$_POST["estado"];
$bairro=$_POST["bairro"];
$cep=$_POST["cep"];
$curso=$_POST["curso"];
$site=$_POST["site"];
$carga_horaria=$_POST["carga_horaria"];
$telefone=$_POST["telefone"];
$email2=$_POST["email2"];
$assunto="Solicitação de Certificado";
$email_from=$_POST["email"];
$mensagem=$_POST['comment'];

$mensagem_final   = "<h3>De:</h3> ";
$mensagem_final  .= $nome;
$mensagem_final  .= "<BR>";
$mensagem_final  .= "<BR>";
$mensagem_final  .="<BR>";
$mensagem_final  .= "<b>Nome: </b>";
$mensagem_final  .= $nome;
$mensagem_final  .= "<BR>";
$mensagem_final  .= "<b>Endereço: </b> ";
$mensagem_final  .= $endereco;
$mensagem_final  .= "<b>Número: </b> ";
$mensagem_final  .= $numero;
$mensagem_final  .= "<b>Complemento: </b> ";
$mensagem_final  .= $complemento;
$mensagem_final  .= "<b>&nbsp;Cidade: </b>";
$mensagem_final  .= $cidade;
$mensagem_final  .= "<BR>";
$mensagem_final  .= "<b>Estado: </b>";
$mensagem_final  .= $estado;
$mensagem_final  .= "<b>&nbsp;Bairro: </b>";
$mensagem_final  .= $bairro;
$mensagem_final  .= "<b>&nbsp;CEP: </b>";
$mensagem_final  .= $cep;
$mensagem_final  .="<BR>";
$mensagem_final  .= "<b>Curso Concluído: </b>";
$mensagem_final  .= $curso;
$mensagem_final  .="<BR>";
$mensagem_final  .= "<b>Carga horária: </b>";
$mensagem_final  .= $carga_horaria;
$mensagem_final  .="<BR>";
$mensagem_final  .= "<b>Site onde realizei o curso: </b>";
$mensagem_final  .= $site;
$mensagem_final  .="<BR>";

$mensagem_final  .= "<b>E-mail: </b>";
$mensagem_final  .= $email_from;
$mensagem_final  .="<BR>";
$mensagem_final  .= "<b>E-mail Alternativo: </b>";
$mensagem_final  .= $email2;
$mensagem_final  .="<BR>";
$mensagem_final  .= "<b>Telefone: </b>";
$mensagem_final  .= $telefone;
$mensagem_final  .= "<BR>";
$mensagem_final .= "Mensagem:   $mensagem \n\n\n";

//formato o campo da mensagem
$mensagem   = wordwrap( $mensagem_final, 50, "<br>", 1);

//valido os emails
if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email_from))
{
    echo "<center style='font-size:10px; font-family:arial'>Digite um email valido</center>";
    echo "<center><a href='?pg=contato' style='font-size:10px; font-family:arial'><center>Voltar</center></a>";
	exit;
}

if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email_from)){

	    echo "<center style='font-size:10px; font-family:arial'>Digite um email valido</center>";
        echo "<center><a href='?pg=contato' style='font-size:10px; font-family:arial'><center>Voltar</center></a>";
	exit;
	
}
//anexando um arquivo ou não

$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;

if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){

	$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
	$anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));           
	$anexo = base64_encode($anexo); 

fclose($fp);
	
$anexo = chunk_split($anexo); 


$boundary = "XYZ-" . date("dmYis") . "-ZYX"; 
 	
    $mens = "--$boundary\n";
    $mens .= "Content-Transfer-Encoding: 8bits\n";
    $mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n\n"; //plain
    $mens .= "$mensagem_final\n";
    $mens .= "--$boundary\n";
	$mens .= "Content-Type: ".$arquivo["type"]."\n"; 
	$mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n"; 
	$mens .= "Content-Transfer-Encoding: base64\n\n"; 
	$mens .= "$anexo\n"; 
	$mens .= "--$boundary--\r\n"; 

$headers  = "MIME-Version: 1.0\n"; 
$headers .= "From: \"$nome\" <$email_from>\r\n"; 
$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n"; 
$headers .= "$boundary\n";

    if(mail($email,$assunto,$mens,$headers))
    {
    echo "<br><br><br><p class='titulo' align='center' class='texto' style='color:#ffffff; font-family:verdana; font-size:12px'>Obrigado pelo contato, em breve respoderemos!</p>";
    } else {
    echo "<br><br><br><p class='titulo' align='center' class='texto' style='color:#ffffff; font-family:verdana; font-size:12px'>Ocorreu um erro ao enviar o e-mail!</p>";
    }
}

else{
	
 $headers  = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 $headers .= "From: \"$nome\" <$email_from>\r\n";
 
    if(mail($email,$assunto,$mensagem_final, $headers))
    {   
    echo "<br><br><br><p class='texto' align='center'>Sua solicitação foi enviada com sucesso!<br>Aguarde o envio do certificado no prazo de 8 a 15 dias.</p>";
    } else {
    echo "<br><br><br><p class='texto' align='center'>Ocorreu um erro ao enviar o e-mail!</p>";
    }
	echo "<center><a href='index.php' class='linknormal'>&laquo; voltar</a></center>";
	
}
?>
