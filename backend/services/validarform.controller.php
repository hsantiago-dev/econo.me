<?php
class ValidarForm
{

    public function __construct()
    {
    }

    public function ValidarForm()
    {

        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if (($metodo == 'POST') || ($metodo == 'PUT')) {

            $json = file_get_contents('php://input');
            $body = json_decode($json);

            //
            require('backend\function\validarCPF.php');

            if (!validadorCPF($body->cpf)) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('CPF inválido');
            }

            require('backend\function\validarNome.php');

            if (!validarNome($body->nome)) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('Nome Inválido');
            }


            if (!validarNome($body->nomemae)) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('Nome da Mãe Inválido');
            }



            require('backend\function\validarEmail.php');

            if (!validadorEmail($body->email)) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('Email Inválido');
            }




            require('backend\function\validarDataNascimento.php');
            if (!ValidadordtNascimento($body->data_criacao, date_format(new DateTime('now'), 'd-m-Y'))) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('Data de Nascimento Inválida!');
            }


            require('backend\function\validarTelefone.php');


            if (!validadorTelefone($body->telefone_celular)) {


                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('Telefone Inválido');
            }

            require('backend\function\validarUsuario.php');

            if (!validarUsuario($body->usuario)) {

                header("HTTP/1.0 400 Bad Request");
            }


            if (!(((strlen($body->senha)) > 5) && ((strlen($body->senha)) < 13))) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('Senha deve ter no mínimo 6 caracteres e no máximo 12');
            }
        } else {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Método não suportado!!"}';
            return;
        }
    }
}
