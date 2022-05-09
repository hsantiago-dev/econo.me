<?php

require('backend\services\sessao.controller.php');
require('backend\conexao\conexao.php');
require('backend\model\usuario.php');
require('backend\excecao\MinhaExcexao.php');



$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$logado = true;
$bd = Conexao::get();


if ($logado) {

    $json = file_get_contents('php://input');
    $body = json_decode($json);
    //var_dump($body);



    if ($metodo == 'GET' && (!isset($_GET["id"]))) {  //busca geral, todos os items

        try {

            $query = $bd->prepare('SELECT * FROM usuario');

            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Não existem usuários cadastrados');
            }

            $usuarios[] = new Usuario();
            $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($usuarios);
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

            $query = $bd->prepare('SELECT * FROM usuario where id = :id');
            $query->bindParam(':id', $_GET["id"]);

            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Usuário não encontrado');
            }

            $usuarios[] = new Usuario();
            $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($usuarios);
            return;
            //code...
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);
        }
    } elseif ($metodo == 'POST') {


        try {

            include('backend\api\cadastro.controller.php');
            $usuario = new Usuario();
            $usuario->nome = $body->nome;
            $usuario->senha = $body->senha;
            $usuario->cpf = preg_replace('/[^0-9]/', '', $body->cpf);
            $usuario->email = $body->email;
            $usuario->telefone_celular = preg_replace('/[^0-9]/', '', $body->telefone_celular);
            $usuario->data_criacao = $body->data_criacao;
            $usuario->nome_mae = $body->nome_mae;


            $query = $bd->prepare("INSERT INTO usuario
        (nome, senha, cpf, email, telefone_celular, data_criacao,nome_mae)
        VALUES     
        (:nome, :senha, :cpf, :email, :telefone_celular, :data_criacao,:nome_mae)");
            $query->bindParam(':nome', $usuario->nome);
            $query->bindParam(':senha', $usuario->senha);
            $query->bindParam(':cpf', $usuario->cpf); //moditicado para body pra testar se o erro continua
            //ERR: IndirectmodificationofoverloadedpropertyUsuario
            //Mesmo com esse erro faz todas as operações no banco
            $query->bindParam(':email', $usuario->email);
            $query->bindParam(':telefone_celular', $usuario->telefone_celular);
            $query->bindParam(':data_criacao', $usuario->data_criacao);
            $query->bindParam(':nome_mae', $usuario->nome_mae);


            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Usuário já Cadastrado Verifique seu email e CPF');
            }
            echo '{"errMsg": "Usuário Castrado com Sucesso"}';
            return;
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);   //só para testar a forma de captura de erros
            // usar a variável dessa forma permite retornar o jason

        } 
        
    } elseif ($metodo == 'PUT') {

        $usuario = new Usuario();
        //$usuario->id = $body->id;
        $usuario->nome = $body->nome;
        $usuario->senha = $body->senha;
        $usuario->cpf = $body->cpf;
        $usuario->email = $body->email;
        $usuario->telefone_celular = $body->telefoneCelular;
        $usuario->data_criacao = $body->data_criacao;
        $usuario->nome_mae = $body->nomeMae;

        try {

            $query = $bd->prepare("UPDATE usuario SET  
            (nome, senha, cpf, email, telefone_celular, data_criacao,nome_mae)
            =
            
            (:nome, :senha, :cpf, :email, :telefone_celular, :data_criacao,:nome_mae)
             where id = :id");

            $query->bindParam(':id', $_GET['id']); //com a global PUT não funcionou
            //Funciona pegando no body e no get



            $query->bindParam(':nome', $usuario->nome);
            $query->bindParam(':senha', $usuario->senha);
            $query->bindParam(':cpf', $usuario->cpf);
            $query->bindParam(':email', $usuario->email);
            $query->bindParam(':telefone_celular', $usuario->telefone_celular);
            $query->bindParam(':data_criacao', $usuario->data_criacao);
            $query->bindParam(':nome_mae', $usuario->nome_mae);
            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Código de Usuário inexistente');
            }
            echo '{"errMsg": "Cadastro Alterado com Sucesso"}';
            return;
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);   //só para testar a forma de captura de erros
            // usar a variável dessa forma permite retornar o jason



        }
    } elseif ($metodo == 'DELETE') {

        try {

            $query = $bd->prepare(" Delete FROM usuario where id = :id");
            $query->bindParam(':id', $_GET["id"]);

            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Esse usuário não existe!');
            }
            echo '{"errMsg": "Registro Deletado com Sucesso"}';
            return;
        } catch (MinhaExcecao $e) {

            $temp = [

                "errMsg" => $e->getMessage()
            ];
            echo json_encode($temp);   //só para testar a forma de captura de erros
            // usar a variável dessa forma permite retornar o jason
        }
    } else {

        header("HTTP/1.0 400 Bad Request");
        echo '{"errMsg": "Método não suportado!!"}';
        return;
    }
}
