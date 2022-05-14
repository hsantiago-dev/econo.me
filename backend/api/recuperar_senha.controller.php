
<?php

require('backend\services\sessao.controller.php');
require('backend\conexao\conexao.php');
require('backend\model\usuario.php');
require('backend\excecao\MinhaExcexao.php');


$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$bd = Conexao::get();


$json = file_get_contents('php://input');
$body = json_decode($json);


if ($metodo == 'GET') {

    try {

        $query = $bd->prepare('SELECT * FROM usuario where email = :email');
        $query->bindParam(':email', $_GET["email"]);


        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Usuário não cadastrado');
        }
        $usuario = $query->fetchObject('Usuario');

        var_dump($usuario);
        // print($_GET['nome_mae']);


        if (($usuario->email == $_GET['email']) && ($usuario->nome_mae == $_GET['nome_mae'])) {

            $query = $bd->prepare("UPDATE usuario SET  
            (nome, senha, cpf, email, telefone_celular, data_criacao,nome_mae)
            =
            
            (:nome, :senha, :cpf, :email, :telefone_celular, :data_criacao,:nome_mae)
             where email = :email");
            $novaSenha = uniqid(); //colocar uma função hash

            // $query->bindParam(':id', $usuario->id);
            $query->bindParam(':senha', $novaSenha);
            $query->bindParam(':nome', $usuario->nome);
            $query->bindParam(':cpf', $usuario->cpf);
            $query->bindParam(':email', $usuario->email);
            $query->bindParam(':telefone_celular', $usuario->telefone_celular);
            $query->bindParam(':data_criacao', $usuario->data_criacao);
            $query->bindParam(':nome_mae', $usuario->nome_mae);

            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Ocorreu um problema');
            }
       

        } else {

            throw new MinhaExcecao('Email ou nome da mãe inválidos');
        }

        include('backend\services\enviaremail.controller.php');
        echo '{"errMsg": "Senha alterada com sucesso verifique seu e-mail"}';
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

?>