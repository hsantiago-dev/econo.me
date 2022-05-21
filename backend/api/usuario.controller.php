<?php

/* require('backend\services\sessao.controller.php');
require('backend\conexao\conexao.php');
require('backend\model\usuario.php');
require('backend\excecao\MinhaExcexao.php'); */

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$logado = true;
$bd = Conexao::get();


if ($logado) {

    $json = file_get_contents('php://input');
    $body = json_decode($json);
   
    if ($metodo == 'GET' && (!isset($_GET["id"]))) {  //busca geral, todos os items

        try {

            $usuario = new Usuario();
            echo ($usuario->getAll('usuario', $bd));
            return;
            //code...
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);
        }
    } elseif ($metodo == 'GET') {  // buscar por id

        try {

            $usuario = new Usuario();
            echo ($usuario->get('usuario', ($_GET["id"]), $bd));
            return;
            
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);
        }
    } elseif ($metodo == 'POST') {

        try {

            $validar = new ValidarForm();
            $validar->ValidarForm();

            $usuario = new Usuario();
            $usuario->nome = $body->nome;
            $usuario->usuario = $body->usuario;
            $usuario->senha = $body->senha;
            $usuario->cpf = preg_replace('/[^0-9]/', '', $body->cpf);
            $usuario->email = $body->email;
            $usuario->telefone_celular = preg_replace('/[^0-9]/', '', $body->telefone_celular);
            $usuario->data_criacao = $body->data_criacao;
            $usuario->nomemae = $body->nomemae;

            $usuario->insert('usuario', $bd, $usuario);

            echo '{"errMsg": "Usuário Cadastrado com Sucesso"}';
            return;
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);   //só para testar a forma de captura de erros
            // usar a variável dessa forma permite retornar o jason

        }
    } elseif ($metodo == 'PUT') {

        try {

            $validar = new ValidarForm();
            $validar->ValidarForm();

            $usuario = new Usuario();
            $usuario->id = $body->id;
            $usuario->usuario = $body->usuario;
            $usuario->nome = $body->nome;
            $usuario->senha = $body->senha;
            $usuario->cpf = preg_replace('/[^0-9]/', '', $body->cpf);
            $usuario->email = $body->email;
            $usuario->telefone_celular = preg_replace('/[^0-9]/', '', $body->telefone_celular);
            $usuario->data_criacao = $body->data_criacao;
            $usuario->nomemae = $body->nomemae;

            $usuario->update('usuario', $bd, $usuario);
            echo '{"errMsg": "Cadastro Alterado com Sucesso"}';
            return;
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);  

        }
    } elseif ($metodo == 'DELETE') {

        try {

            $usuario = new Usuario();
            $usuario->delete('usuario', ($_GET["id"]), $bd);

            echo '{"errMsg": "Registro Deletado com Sucesso"}';
            return;
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);   
        }
    } else {

        header("HTTP/1.0 400 Bad Request");
        echo '{"errMsg": "Método não suportado!!"}';
        return;
    }
}
