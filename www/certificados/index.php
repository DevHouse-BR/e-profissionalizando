<!--
//Script desenvolvido por Victor Mangia em 11/09/2010 12:36
//Twitter: @mangiavictor
//-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script language="javascript" type="text/javascript">
<!--
jQuery(function($){   
$("#telefone").mask("(99) 9999-9999");
});
//-->
</script>

<script>
// Inicia o validador ao carregar a página
$(function() {
    // valida o formulário
    $('#commentForm').validate({
        // define regras para os campos
        rules: {
            nome: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
			telefone: {
                required: true
            },
            comment: {
                required: true
            }
			
			
        },
        // define messages para cada campo
        messages: {
            nome: "<br><font style='font-size:11px; color:red; font-family:arial,verdana,tahome'>Preencha o seu nome</font>",
            email: "<br><font style='font-size:11px; color:red; font-family:arial,verdana,tahome'>Preencha seu e-mail de contato</font>",
			telefone: "<br><font style='font-size:11px; color:red; font-family:arial,verdana,tahome'>Preencha seu telefone de contato</font>",
            comment: "<br><font style='font-size:11px; color:red; font-family:arial,verdana,tahome'>Entre com o conte&uacute;do de sua mensagem</font>"
        }
    });
});</script>
<body bgcolor="#FFFFFF">

<form  method="post" class="cmxform" id="commentForm" action="envio_contato.php">

<label><span style="font-size: 11pt">Nome Completo:</span></label><span style="font-size: 11pt"><br />               
<input id="nome" name="nome" class="required" minlength="10" />
<br />
<label>Endereço:</label><br />
<input id="endereco" name="endereco" class="required" minlength="10" />
<br />
<label>Número:</label><br />
<input id="numero" name="numero" class="required" minlength="2" />
<br />
<label>Complemento:</label><br />
<input id="complemento" name="complemento" minlength="0" />
<br />

<label>Cidade:</label><br />
<input id="cidade" name="cidade" class="required" minlength="2" />
<br />
<label>Estado:</label><br />
<input id="estado" name="estado" class="required" minlength="2" />
<br />
<label>Bairro:</label><br />
<input id="bairro" name="bairro" class="required" minlength="2" />
<br />
<label>CEP:</label><br />
<input id="cep" name="cep" class="required" minlength="8" />
<br />
<label>Curso Concluído:</label><br />
<input id="curso" name="curso" class="required" minlength="4" />
<br />
<label>Site do Curso:</label><br />
<input id="site" name="site" class="required" class="required" minlength="8" />
<br />
<label>Carga Horária:</label><br />
<input id="carga_horaria" name="carga_horaria" class="required" minlength="2" />
<br />
<label>Telefone:</label><br />
<input id="telefone" name="telefone" class="required"/>
<br />
<label>E-mail:</label><br />
<input id="email" name="email" class=" class="required" minlength="8" />
<br />
<br />
<label>Email Alternativo:</label><br />
<input id="email2" name="email2" />
<br />
<label>Comentário:</label><br />
<textarea id="comment" name="comment" class="required"></textarea>
</span>
<br />
<input type="submit" value="ENVIAR"/>
</form>