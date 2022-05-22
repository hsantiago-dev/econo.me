<?php

/* require('backend\services\sessao.controller.php');
require('backend\conexao\conexao.php');
require('backend\model\usuario.php');
require('backend\excecao\MinhaExcexao.php'); */

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$bd = Conexao::get();
$json = file_get_contents('php://input');
$body = json_decode($json);


if ($metodo == 'POST') {

    try {

        $usuario = new Usuario();
        $usuario = $usuario->getUserEmail($body->email, $bd);

        $enviar = new EnviarEmail();
        $novaSenha = uniqid();
        $usuario->updateSenha($bd, $usuario, $novaSenha, $body->email, $body->nome_mae);
        $enviar->EnviarEmail($usuario, $novaSenha);
    } catch (MinhaExcecao $e) {

        header("HTTP/1.0 400 Bad Request");
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
