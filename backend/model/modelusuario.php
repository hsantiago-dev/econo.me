<?php


class Usuario extends BD
{

    protected $id;
    protected $usuario;
    protected $nome;
    protected $senha;
    protected $nome_mae;
    protected $cpf;
    protected $email;
    protected $telefone_celular;
    protected $data_criacao;

    public function __construct()
    {
    }

    public function __get($propriedade)
    {
        return $this->$propriedade;
    }

    public function __set($propriedade, $valor)
    {
        return $this->$propriedade = $valor;
    }

    public function getAll($tabela, $bd)
    {

        $query = $bd->prepare("SELECT id, nome, usuario FROM usuario");

        $query->execute();

        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
        return json_encode($usuarios);
        
    }

    public  function get($tabela, $id, $bd)
    {

        $query = $bd->prepare("SELECT * FROM {$tabela} where id = :id");
        $query->bindParam(':id', $id);

        $query->execute();
        if ($query->rowCount() == 0) { 

            header("HTTP/1.0 400 Bad Request");
            throw new MinhaExcecao('Usuário não encontrado');
        }

        //  $usuarios[] = new Usuario();
         $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
         return json_encode($usuarios);
                       
    }

    public  function getUserEmail($email, $bd)
    {

        try {

            $query = $bd->prepare('SELECT * FROM usuario where email = :email');
            $query->bindParam(':email', $email);
            
            $query->execute();

            if ($query->rowCount() != 1) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao('E-mail não cadastrado.');
            }

            return $query->fetchObject('Usuario');
        } catch (PDOException $e) {

            header("HTTP/1.0 400 Bad Request");
            throw new MinhaExcecao('Usuário não cadastrado.');
        }
    }


    public  function insert($tabela, $bd, $usuario)
    {
        try {

            $query = $bd->prepare("INSERT INTO usuario
            (usuario, nome, senha, cpf, email, telefone_celular, data_criacao,nome_mae)
            VALUES     
            (:usuario, :nome, :senha, :cpf, :email, :telefone_celular, current_date,:nome_mae)");
            $query->bindParam(':usuario', $usuario->usuario);
            $query->bindParam(':nome', $usuario->nome);
            $query->bindParam(':senha', $usuario->senha);
            $query->bindParam(':cpf', $usuario->cpf); 
            $query->bindParam(':email', $usuario->email);
            $query->bindParam(':telefone_celular', $usuario->telefone_celular);
            $query->bindParam(':nome_mae', $usuario->nome_mae);

            $query->execute();
        } catch (PDOException $e) {
            
            header("HTTP/1.0 400 Bad Request");
            throw new MinhaExcecao('Usuário já cadastrado! Verifique seu email e CPF.');
        }
    }

    public function update($tabela, $bd, $usuario)
    {
        $query = $bd->prepare("UPDATE {$tabela} SET  
        (usuario,nome, senha, cpf, email, telefone_celular, data_criacao,nome_mae)
        =
        
        (:usuario, :nome, :senha, :cpf, :email, :telefone_celular, :data_criacao,:nome_mae)
         where id = :id");

        $query->bindParam(':id', $usuario->id); 

        $query->bindParam(':usuario', $usuario->usuario);
        $query->bindParam(':nome', $usuario->nome);
        $query->bindParam(':senha', $usuario->senha);
        $query->bindParam(':cpf', $usuario->cpf);
        $query->bindParam(':email', $usuario->email);
        $query->bindParam(':telefone_celular', $usuario->telefone_celular);
        $query->bindParam(':data_criacao', $usuario->data_criacao);
        $query->bindParam(':nome_mae', $usuario->nome_mae);

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            header("HTTP/1.0 400 Bad Request");
            throw new MinhaExcecao('Código de Usuário inexistente');
        }
    }

    public function updateSenha($bd, $usuario, $novaSenha,$email,$nome_mae)
    {

        if (($usuario->email == $email) && ($usuario->nome_mae == $nome_mae)) {

            try {

                $query = $bd->prepare("UPDATE usuario SET  senha=:senha
                                        WHERE email = :email");
                $query->bindParam(':email', $usuario->email);
                $query->bindParam(':senha', $novaSenha);

                $query->execute();
            } catch (PDOException $e) {

                header("HTTP/1.0 400 Bad Request");
                throw new MinhaExcecao($e);
            }
        } else {

            header("HTTP/1.0 400 Bad Request");
            throw new MinhaExcecao('Email ou nome da mãe inválidos');
        }
    }

    public  function delete($tabela, $id, $bd)
    {

        $query = $bd->prepare("Delete FROM {$tabela} where id = :id");
        $query->bindParam(':id', $id);

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            header("HTTP/1.0 400 Bad Request");
            throw new MinhaExcecao('Esse usuário não existe!');
        }
    }
}
