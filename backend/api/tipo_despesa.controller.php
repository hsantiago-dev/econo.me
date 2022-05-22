<?php

    // require('backend\services\sessao.controller.php');
    // require('backend\conexao\conexao.php');
    // require('backend\model\Usuario.php');
    // require('backend\excecao\MinhaExcexao.php');

    $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $bd = Conexao::get();

    // if(!$logado) {

    //     return;
    // }

    if ($metodo == 'GET') {  

        $query = $bd->prepare('SELECT * FROM tipo_despesa');
        $query->execute();
        $tipo_despesa = $query->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($tipo_despesa);
        return;
    }