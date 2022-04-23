      <?php

        require('backend\services\sessao.controller.php');
        require('backend\conexao\conexao.php');
        require('backend\model\Despesa.php');
        require('backend\excecao\MinhaExcexao.php');

        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $logado = true;
        $bd = Conexao::get();

        if ($logado) {

            $json = file_get_contents('php://input');
            $body = json_decode($json);


            if ($metodo == 'GET' && (!isset($body->id))) {  //busca geral, todos os items

                $query = $bd->prepare('SELECT * FROM despesa');
                $query->execute();
                $despesas[] = new Despesa();
                $despesas = $query->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($despesas);
                return;

            }elseif ($metodo == 'GET' ) {  // buscar por id

                    $query = $bd->prepare('SELECT * FROM despesa where id = :id');
                    $query->bindParam(':id', $body->id);
                    $query->execute();
                    $despesas[] = new Despesa();
                    $despesas = $query->fetchAll(PDO::FETCH_OBJ);
                    echo json_encode($despesas);
                    return;
                
            } elseif ($metodo == 'POST') {


                $query = $bd->prepare("INSERT INTO despesa
                (admin_despesa, tipo_despesa, data_vencimento, titulo, valor_total, data_criacao)
                VALUES     
                (:admin_despesa, :tipo_despesa, :data_vencimento, :titulo, :valor_total, :data_criacao)");
                $query->bindParam(':admin_despesa', $body->usuario);
                $query->bindParam(':tipo_despesa', $body->tipo);
                $query->bindParam(':data_vencimento', $body->vencimento);
                $query->bindParam(':titulo', $body->titulo);
                $query->bindParam(':valor_total', $body->valor);
                $query->bindParam(':data_criacao', $body->data_criacao);
                $query->execute();
                echo '{"errMsg": "Cadastrado com Sucesso"}';// variável da msg só mudar o nome
                return;
            } elseif ($metodo == 'PUT') {

                try {

                    $query = $bd->prepare("UPDATE despesa SET  
                    (admin_despesa, tipo_despesa, data_vencimento, titulo, valor_total, data_criacao)
                    =
                    (:admin_despesa, :tipo_despesa, :data_vencimento, :titulo, :valor_total, :data_criacao)
                     where id = :id");

                    $query->bindParam(':id', $body->id);

                    if (!isset($body->id)){   //só para testar a forma de captura de erros

                        throw new MinhaExcecao(' ID EM BRANCO');
                    }

                    $query->bindParam(':admin_despesa', $body->usuario);
                    $query->bindParam(':tipo_despesa', $body->tipo);
                    $query->bindParam(':data_vencimento', $body->vencimento);
                    $query->bindParam(':titulo', $body->titulo);
                    $query->bindParam(':valor_total', $body->valor);
                    $query->bindParam(':data_criacao', $body->data_criacao);
                    $query->execute();
                    echo '{"errMsg": "Cadastro Alterado com Sucesso"}';
                    return;

                } catch (MinhaExcecao $e) {

                    echo "{\"errMsg\":$e->getMessage()}";   //só para testar a forma de captura de erros
                   
                   
                }
            } elseif ($metodo == 'DELETE') {

                $query = $bd->prepare(" Delete FROM despesa where id = :id");
                $query->bindParam(':id', $body->id);
                $query->execute();
                echo '{"errMsg": "Registro Deletado com Sucesso"}';
            } else {

                header("HTTP/1.0 400 Bad Request");
                echo '{"errMsg": "Método não suportado!!"}';
                return;
            }
        }
