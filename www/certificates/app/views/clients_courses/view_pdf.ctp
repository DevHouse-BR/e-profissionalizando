<?php 
App::import('Vendor','xtcpdf');
//App::import('Vendor','class_phpmailer');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));

$tcpdf = new XTCPDF('UTF-8');
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("andersonv.com");
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->setHeaderFont(array($textfont,'',40)); 
$tcpdf->xheadercolor = array(150,0,0); 


// add a page (required with recent versions of tcpdf) 

$tcpdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

$tcpdf->AddPage('L', 'A4');
//$tcpdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');

$tcpdf->Image("pics/" . $course['Course']['imagem'], 0, 0, null, null, 'jpg', '', '', true);

// Now you position and print your page content 
// example: 

$less = 20;
$more = 30;
$tcpdf->SetTextColor(000, 000, 000);

$tcpdf->SetFont($textfont,'B', $less);
$tcpdf->Cell(0,14, '', 0,1,'C');
$tcpdf->Cell(0,14, '', 0,1,'C');
$tcpdf->Cell(0,14, '   Certificamos para fins e efeitos de direito que', 0,1,'C');

$tcpdf->Cell(0,14, '', 0,1,'C');

$tcpdf->SetFont($textfont,'B', $more);
$tcpdf->Cell(0,14, $dados['Client']['nome'], 0,1,'C');



$tcpdf->SetFont($textfont,'B', $less);

$tcpdf->Cell(0,14, utf8_encode('   Concluiu com êxito, através da Inglês Curso Escola de Idiomas Ltda.  '), 0,1,'J');
$tcpdf->Cell(0,14, '      CNPJ: 09.095.740/0001-23, o ' . $course['Course']['nome'],   0,1,'J   ');
$tcpdf->Cell(0,14, utf8_encode('  Curso este criado com base na LEI 9.394/96 (artigo 42) - Lei de  '), 0,1,'J');
$tcpdf->Cell(0,14, utf8_encode('  diretrizes e bases da Educação Nacional, perfazendo uma carga  '), 0,1,'J');
$tcpdf->Cell(0,14, utf8_encode('      horária total de ' . $course['Course']['carga'] . ' horas/aula.  '), 0,1,'L');

$conclusao = explode("-",$ultimo[0]['clients_courses']['conclusao']);

//$tcpdf->Cell(0,14, utf8_encode($conclusao[2]), 0,1,'R');
$tcpdf->Cell(0,14, utf8_encode("                                                                                    Certificado Nº ") . utf8_encode($ultimo[0]['clients_courses']['id'] ."-". $conclusao[0]), 0,1,'R   ');


$tcpdf->Cell(0,14, utf8_encode("                                                       Data de Conclusão: ") . $formatacao->data($ultimo[0]['clients_courses']['conclusao']), 0,1,'C');


// ... 
// etc. 
// see the TCPDF examples

echo $tcpdf->Output('filename.pdf', 'F');
echo $tcpdf->Output('filename.pdf', 'D');

$Email = new PHPMailer();
$Email->SetLanguage("br");
$Email->IsMail();
$Email->IsHTML(true);
$Email->From = "no-reply@inglescurso.net";
$Email->FromName = "Inglês Curso Escola de Idiomas";
$Email->AddAddress($dados['Client']['email']);
$Email->AddAttachment("filename.pdf");
$Email->Subject = "Certificado de conclusão de curso";
$Email->Body .= "<b> Olá, ".$dados['Client']['nome']."</b>, <br /><br />";
$Email->Body .= "Segue em anexo seu certificado de conclusão.<br><br>Informamos que o certificado original com carimbo da escola, e assinatura do diretor.  Caso tenha solicitado o envio por correio, o mesmo já esta sendo enviado para sua residência nesta data.<br><br><br>Atenciosamente,<br><br><b>Samuel de Sousa Santos</b><br>Diretor<br>Inglescurso Escola de Idiomas Ltda";
$Email->Send();

?>