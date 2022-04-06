<?php

   	$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

  	if ($metodo == 'POST') {

		$json = file_get_contents('php://input');
		$body = json_decode($json);
	
		if ($body->usuario== '' || $body->senha== '') {
	
			header("HTTP/1.0 400 Bad Request");
			echo '{"errMsg": "Ambos os campos devem ser preenchidos"}';
			return;
		} else {
	
			require('backend\repository\user-repository.php');
	
			foreach ($usuarios as $chave => $usuario) {
	
	
				if (($chave == $body->usuario) && (($usuarios[$chave]['Senha']) == $body->senha)) {
	
				$nome = $body->usuario;
				$senhaValida = $body->senha;
				}
			}
	
			if (empty($nome) || empty($senhaValida)) {
				
				header("HTTP/1.0 400 Bad Request");
				echo '{"errMsg": "Usuário e/ou senha inválido(s), Tente novamente!"}';
				return;
			} else {
				
				echo "Usuário $nome, Logado com Sucesso!";
				return;
			}
		}
   	} else {

		header("HTTP/1.0 400 Bad Request");
		return;
   	}
