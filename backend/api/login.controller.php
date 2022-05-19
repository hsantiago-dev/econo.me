<?php

	require('backend\conexao\conexao.php');

   	$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
	$bd = Conexao::get();

  	if ($metodo == 'POST') {

		$json = file_get_contents('php://input');
		$body = json_decode($json);
	
		if ($body->usuario== '' || $body->senha== '') {
	
			header("HTTP/1.0 400 Bad Request");
			echo '{"errMsg": "Ambos os campos devem ser preenchidos"}';
			return;
		} else {
	
			$query = $bd->prepare('SELECT id, nome, usuario FROM usuario
									WHERE usuario = :usuario
									AND senha = :senha
									LIMIT 1');
			$query->bindParam(':usuario', $body->usuario);
			$query->bindParam(':senha', $body->senha);
			$query->execute();

			$usuario = $query->fetchAll(PDO::FETCH_OBJ);
			
			if (empty($usuario[0]->id)) {
				
				header("HTTP/1.0 400 Bad Request");
				echo '{"errMsg": "Usuário e/ou senha inválido(s), Tente novamente!"}';
			} else {
				
				session_start();

				$token = md5(uniqid(microtime(), true));
				$_SESSION['token'] = $token;
				$_SESSION['logado'] = true; 

				$object = new stdClass();
				$object->token = session_id();
				$object->idUsuario = $usuario[0]->id;
				session_write_close();

				echo json_encode($object);
			}
		}
   	} else {

		header("HTTP/1.0 400 Bad Request");
		return;
   	}
