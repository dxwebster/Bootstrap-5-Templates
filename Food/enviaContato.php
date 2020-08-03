<?php 

// Campos a alterar

$smtp = "smtp.site.com.br";
$remetente = "email@site.com.br";
$remetenteSenha = "Senha do email";
$remetenteNome = "Nome do remetente";
$destinatario = "email@site.com.br";
$assunto = "Assunto do email";

// Recupera os dados do formulário

$nome = $_POST["nome"];
$email = $_POST["email"];
$sexo = $_POST["sexo"];
$estado = $_POST["estado"];
$comentario = $_POST["comentario"];
$newsletter = $_POST["newsletter"];
$msg = "";

$comentario = str_replace(chr(13),"<br>",$comentario);

// Monta o corpo do email

$texto = "<strong>Nome:</strong> $nome <br>
<strong>Email:</strong> $email <br>
<strong>Sexo:</strong> $sexo <br>
<strong>Estado:</strong> $estado <br>
<strong>Newsletter:</strong> $newsletter <br>
<strong>Mensagem:</strong> $comentario";

// Inclui a função phpmailer

require_once('class.phpmailer.php');

// Define os parâmetros de envio 
 
$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->SMTPDebug = 1;
$mailer->Port = 587;                                    // Porta - Usar sempre 587
$mailer->Host = $smtp;                                  // Host ou SMTP
$mailer->SMTPAuth = true;                               // Define se haverá ou não autenticação no SMTP
$mailer->isHTML( true );                                // Envia em HTML
$mailer->Charset = 'UTF-8';                             // Define a codificação
$mailer->Username = $remetente;                         // Informe o e-mai o completo
$mailer->Password = $remetenteSenha;                    // Senha da caixa postal
$mailer->FromName = $remetenteNome;                     // Nome que será exibido para o destinatário
$mailer->From = $remetente;                             // Obrigatório ser a mesma caixa postal indicada em "username"
$mailer->AddAddress($destinatario);                     // Destinatários
$mailer->Subject = $assunto;                            // Assunto
$mailer->Body = $texto;

// Faz o envio do email

if($mailer->Send()){
    header("location: ok.html");
}else{
    header("location: erro.html");
    //echo "Erro: " . $mailer->ErrorInfo; exit; 
}
?>