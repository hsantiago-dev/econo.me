<?php

use PHPMailer\PHPMailer\PHPMailer;

class EnviarEmail
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
    }

    public function __get($propriedade)
    {
        return $this->$propriedade;
    }

    public function __set($propriedade, $valor)
    {
        return $this->$propriedade = $valor;
    }

    public function EnviarEmail($usuario, $novaSenha)
    {
        try {
            // Configurações do servidor
            $this->mail->isSMTP();        //Devine o uso de SMTP no envio
            $this->mail->SMTPAuth = true; //Habilita a autenticação SMTP
            $this->mail->Username   = 'utfprdev2019@gmail.com';
            $this->mail->Password   = 'X/753951';
            $this->mail->SMTPSecure = 'tls';
            $this->mail->CharSet = 'UTF-8'; // Incluir caracteres com acento
            // Informações específicadas pelo Google
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->Port = 587;
            // Define o remetente
            $this->mail->setFrom('utfprdev2019@gmail.com', 'Equipe de Suporte Econo.me');
            // Define o destinatário
            $this->mail->addAddress($usuario->email, $usuario->nome);
            // Conteúdo da mensagem
            $this->mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $this->mail->Subject = 'Recuperação de Email Equipe Econo.me';
            $this->mail->Body    = "Sua senha foi Atualizada com Sucesso! <b>Sua nova senha é  : {$novaSenha}</b>";
            $this->mail->AltBody = "Sua nova senha é   : {$novaSenha}";
            // Enviar
            if (!$this->mail->send()) {

                throw new MinhaExcecao('A mensagem não foi enviada. Verifique se o Email foi digitado corretamente! : ' . $this->mail->ErrorInfo);
                
            } else {

                echo 'E-mail de recuperação enviado!';
            }
        } catch (MinhaExcecao $e) {

            throw new MinhaExcecao($e->getMessage());
        }
    }
}
