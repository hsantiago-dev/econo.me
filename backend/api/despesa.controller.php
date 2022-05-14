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
          

            if ($metodo == 'GET' && (!isset($_GET["id"]))) {  //busca geral, todos os items

                try{

                $query = $bd->prepare('SELECT * FROM despesa');
                if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Não existem Despesas Cadastradas');
            }
                $despesas[] = new Despesa();
                $despesas = $query->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($despesas);
                return;

                } catch (MinhaExcecao $e) {

                    $temp = [
        
                        "errMsg" => $e->getMessage()
                    ];
                    echo json_encode($temp);
                }
                
            } elseif ($metodo == 'GET') {  // buscar por id

                try {

                $query = $bd->prepare('SELECT * FROM despesa where id = :id');
                $query->bindParam(':id', $_GET["id"]);

                if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                    throw new MinhaExcecao('Despesa não encontrada');
                }
                $despesas[] = new Despesa();
                $despesas = $query->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($despesas);
                return;

                }catch (MinhaExcecao $e) {

                    $temp = [
        
                        "errMsg" => $e->getMessage()
                    ];
                    echo json_encode($temp);
                }

            } elseif ($metodo == 'POST') {

                try{

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
                if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                    throw new MinhaExcecao('Despesa já Cadastrada!');
                }
                echo '{"errMsg": "Cadastrado com Sucesso"}'; // variável da msg só mudar o nome
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

                    $query = $bd->prepare("UPDATE despesa SET  
                    (admin_despesa, tipo_despesa, data_vencimento, titulo, valor_total, data_criacao)
                    =
                    (:admin_despesa, :tipo_despesa, :data_vencimento, :titulo, :valor_total, :data_criacao)
                     where id = :id");

                    $query->bindParam(':id', $body->id);

                  

                    $query->bindParam(':admin_despesa', $body->usuario);
                    $query->bindParam(':tipo_despesa', $body->tipo);
                    $query->bindParam(':data_vencimento', $body->vencimento);
                    $query->bindParam(':titulo', $body->titulo);
                    $query->bindParam(':valor_total', $body->valor);
                    $query->bindParam(':data_criacao', $body->data_criacao);
                    
                    if ($query->rowCount(($query->execute()))==0) {   //só para testar a forma de captura de erros

                        throw new MinhaExcecao('ID INEXISTENTE');
                    }
                    echo '{"errMsg": "Cadastro Alterado com Sucesso"}';
                    return;
                } catch (MinhaExcecao $e) {

                    $temp = [
                        
                        "errMsg" =>$e->getMessage()
                    ];
                    echo json_encode($temp);   //só para testar a forma de captura de erros
                    // usar a variável dessa forma permite retornar o jason
                  
               

                }
            } elseif ($metodo == 'DELETE') {

                try {

                    $query = $bd->prepare(" Delete FROM despesa where id = :id");
                    $query->bindParam(':id', $_GET['id']);
                    if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                        throw new MinhaExcecao('Essa Despesa não existe!');
                    }
                    echo '{"errMsg": "Registro Deletado com Sucesso"}';

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
