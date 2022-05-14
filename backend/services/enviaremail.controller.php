<?php
// Importar as classes 
use PHPMailer\PHPMailer\PHPMailer;
require('backend\vendor\autoload.php');

//apenas acertar esse caminho, internet falam muita merda inútil

$mail = new PHPMailer();
try
{
    // Configurações do servidor
    $mail->isSMTP();        //Devine o uso de SMTP no envio
    $mail->SMTPAuth = true; //Habilita a autenticação SMTP
    $mail->Username   = 'utfprdev2019@gmail.com';
    $mail->Password   = 'X/753951';
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'UTF-8';// Incluir caracteres com acento
    // Informações específicadas pelo Google
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    // Define o remetente
    $mail->setFrom('utfprdev2019@gmail.com', 'Equipe de Suporte Econo.me');
    // Define o destinatário
    print($usuario->email);
    $mail->addAddress($usuario->email, $usuario->nome);
    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = 'Recuperação de Email Equipe Econo.me';
    $mail->Body    = "Sua senha foi Atualizada com Sucesso! <b>Sua nova senha é  : {$novaSenha}</b>";
    $mail->AltBody = "Sua nova senha é   : {$novaSenha}";
    // Enviar
    if(!$mail->send()){

        
        throw new MinhaExcecao('A mensagem não foi enviada. Verifique se o Email foi digitado corretamente! :'.$mail->ErrorInfo);

    }else{
    
    
    throw new MinhaExcecao('A mensagem foi enviada!'); 
    
    }
    
} catch (MinhaExcecao $e){

    throw new MinhaExcecao($e->getMessage()); 
    
         
}



