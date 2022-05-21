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
            $body = json_decode($json, true);
          

            if ($metodo == 'GET' && (isset($_GET["usuario"]))) {  //busca geral, todos os items

                $query = $bd->prepare("SELECT 
                                        des.id
                                        , des.admin_despesa
                                        , des.titulo
                                        , des.valor_total
                                        , TO_CHAR(des.data_criacao, 'DD/MM/YYYY') data_criacao
                                        , rat.valor
                                        , TO_CHAR(rat.data_pagamento, 'DD/MM/YYYY') data_pagamento
                                    FROM despesa des
                                    INNER JOIN rateio rat
                                    ON des.id = rat.id_despesa
                                    WHERE rat.id_usuario = :id_usuario");
                $query->bindParam(':id_usuario', $_GET["usuario"]);
                $query->execute();
                // $despesas[] = new Despesa();
                $despesas = $query->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($despesas);
                return;
            } elseif ($metodo == 'GET' && (isset($_GET["id"]))) {  // buscar por id

                try {

                $query = $bd->prepare('SELECT * FROM despesa where id = :id');
                $query->bindParam(':id', $_GET["id"]);
                $query->execute();
                // $despesas[] = new Despesa();
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

                $query = $bd->prepare("INSERT INTO despesa
                (admin_despesa, tipo_despesa, data_vencimento, titulo, valor_total, data_criacao)
                VALUES     
                (:admin_despesa, :tipo_despesa, :data_vencimento, :titulo, :valor_total, current_date)");
                $query->bindParam(':admin_despesa', $body['id_admin']);
                $query->bindParam(':tipo_despesa', $body['tipo_despesa']);
                $query->bindParam(':data_vencimento', $body['data_vencimento']);
                $query->bindParam(':titulo', $body['titulo']);
                $query->bindParam(':valor_total', $body['valor_total']);
                $query->execute();

                $idDespesa = $bd->lastInsertId();

                for ($i = 0; $i < sizeof($body['rateio']); $i++) {

                    $insertRateios = $bd->prepare("INSERT INTO rateio (id_despesa, id_usuario, valor) VALUES (:id_despesa, :id_usuario, :valor)");
                    $insertRateios->bindParam(':id_despesa', $idDespesa);
                    $insertRateios->bindParam(':id_usuario', $body['rateio'][$i]['idUsuario']);
                    $insertRateios->bindParam(':valor', $body['rateio'][$i]['valorRateio']);
                    $insertRateios->execute();
                }

                echo '{"errMsg": "Cadastrado com Sucesso"}'; // variável da msg só mudar o nome
                return;
                
                   
        
                
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
