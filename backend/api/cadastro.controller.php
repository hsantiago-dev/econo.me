<?php

    $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    if ($metodo == 'POST') {

        $json = file_get_contents('php://input');
        $body = json_decode($json);

        require('backend\function\validarCPF.php');

        if (!validadorCPF($body->cpf)) {


            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "CPF Inválido"}';
            return;
        }

        require('backend\function\validarNome.php');

        if (!validarNome($body->nome)) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Nome Inválido"}';
            return;
        }


        if (!validarNome($body->nomeMae)) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Nome Mãe Inválido"}';
            return;
        }



        require('backend\function\validarEmail.php');

        if (!validadorEmail($body->email)) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Email Inválido"}';
            return;
        }

        require('backend\function\validarTelefone.php');

        if (!validadorTelefone($body->telefone)) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Telefone Inválido"}';
            return;
        }

        if (!(((strlen($body->senha)) > 5) && ((strlen($body->senha)) < 13))) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Senha deve ter no mínimo 6 caracteres e no máximo 12"}';
            return;
        }

        require('backend\repository\user-repository.php');

        $temp = false;

        foreach ($usuarios as $chave => $usuario) {


            if ((($usuarios[$chave]['cpf']) == $body->cpf) ||
                (($usuarios[$chave]['email']) == $body->email) ||
                (($usuarios[$chave]['usuario']) == $body->usuario)
            ) {

                $temp = true;
            }
        }

        if ($temp) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Usuário já Cadastrado!"}';
            return;
        }

        require('backend\function\validarDataNascimento');


        if (!ValidadordtNascimento($body->dataNascimento)) {

            header("HTTP/1.0 400 Bad Request");
            echo '{"errMsg": "Data de Nascimento Inválida!"}';
            return;
        }
    } else {

        header("HTTP/1.0 400 Bad Request");
        echo '{"errMsg": "Método não suportado!!"}';
        return;
    }