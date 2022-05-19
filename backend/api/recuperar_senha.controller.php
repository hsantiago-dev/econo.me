
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
        $query->bindParam(':email', $body->email);


        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Usuário não cadastrado');
        }
        $usuario = $query->fetchObject('Usuario');

        var_dump($usuario);
        // print($_GET['']);


        if (($usuario->email == $body->email) && ($usuario->nomemae == $body->nomemae)) {

            $query = $bd->prepare("UPDATE usuario SET  (senha)=(:senha)
             where email = :email");
            $novaSenha = uniqid(); //colocar uma função hash

            $query->bindParam(':email', $body->email);
            $query->bindParam(':senha', $novaSenha);


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