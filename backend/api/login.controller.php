<?php

   $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

   if ($metodo == 'POST') {

      $json = file_get_contents('php://input');
      $body = json_decode($json);
   
      if (trim($body->usuario, " ") == '' || trim($body->senha, " ") == '') {
   
         // header('Content-Type: application/json; charset=utf-8');
         echo 'Campos não preenchidos!';
      } else {
   
         require('backend\repository\user-repository.php');
   
         foreach ($usuarios as $chave => $usuario) {
   
   
            if (($chave == $body->usuario) && (($usuarios[$chave]['Senha']) == $body->senha)) {
   
               $nome = $body->usuario;
               $senhaValida = $body->senha;
            }
         }
   
         // header('Content-Type: application/json; charset=utf-8');
         if (empty($nome) || empty($senhaValida)) {
            echo 'Usuário e/ou senha inválido(s), Tente novamente!';
         } else {
            echo "Usuário $nome, Logado com Sucesso!";
         }
      }
   } else {

      echo 'Método não suportado!';
   }
