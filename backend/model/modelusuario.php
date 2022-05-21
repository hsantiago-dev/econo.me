<?php


class Usuario extends BD
{

    protected $id;
    protected $usuario;
    protected $nome;
    protected $senha;
    protected $nomemae;
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

        $query = $bd->prepare("SELECT * FROM {$tabela}");

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Não existem usuários cadastrados');
        }

        $usuarios[] = new Usuario();
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
        return json_encode($usuarios);
        
    }

    public  function get($tabela, $id, $bd)
    {

        $query = $bd->prepare("SELECT * FROM {$tabela} where id = :id");
        $query->bindParam(':id', $id);

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Usuário não encontrado');
        }

         $usuarios[] = new Usuario();
         $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
         return json_encode($usuarios);
                       
    }

    public  function getUserEmail($email, $bd)
    {

        $query = $bd->prepare('SELECT * FROM usuario where email = :email');
        $query->bindParam(':email', $email);

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Usuário não cadastrado');
        }
        return $query->fetchObject('Usuario');
    }


    public  function insert($tabela, $bd, $usuario)
    {

        $query = $bd->prepare("INSERT INTO usuario
        (usuario, nome, senha, cpf, email, telefone_celular, data_criacao,nomemae)
        VALUES     
        (:usuario, :nome, :senha, :cpf, :email, :telefone_celular, :data_criacao,:nomemae)");
        $query->bindParam(':usuario', $usuario->usuario);
        $query->bindParam(':nome', $usuario->nome);
        $query->bindParam(':senha', $usuario->senha);
        $query->bindParam(':cpf', $usuario->cpf); 
        $query->bindParam(':email', $usuario->email);
        $query->bindParam(':telefone_celular', $usuario->telefone_celular);
        $query->bindParam(':data_criacao', $usuario->data_criacao);
        $query->bindParam(':nomemae', $usuario->nomemae);


        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Usuário já Cadastrado Verifique seu email e CPF');
        }
    }

    public function update($tabela, $bd, $usuario)
    {
        $query = $bd->prepare("UPDATE {$tabela} SET  
        (usuario,nome, senha, cpf, email, telefone_celular, data_criacao,nomemae)
        =
        
        (:usuario, :nome, :senha, :cpf, :email, :telefone_celular, :data_criacao,:nomemae)
         where id = :id");

        $query->bindParam(':id', $usuario->id); 

        $query->bindParam(':usuario', $usuario->usuario);
        $query->bindParam(':nome', $usuario->nome);
        $query->bindParam(':senha', $usuario->senha);
        $query->bindParam(':cpf', $usuario->cpf);
        $query->bindParam(':email', $usuario->email);
        $query->bindParam(':telefone_celular', $usuario->telefone_celular);
        $query->bindParam(':data_criacao', $usuario->data_criacao);
        $query->bindParam(':nomemae', $usuario->nomemae);

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Código de Usuário inexistente');
        }
    }

    public function updateSenha($bd, $usuario, $novaSenha,$email,$nomemae)
    {

        if (($usuario->email == $email) && ($usuario->nomemae == $nomemae)) {

            $query = $bd->prepare("UPDATE usuario SET  (senha)=(:senha)
             where email = :email");
            $query->bindParam(':email', $usuario->email);
            $query->bindParam(':senha', $novaSenha);

            if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

                throw new MinhaExcecao('Ocorreu um problema');
            }
        } else {

            throw new MinhaExcecao('Email ou nome da mãe inválidos');
        }
    }

    public  function delete($tabela, $id, $bd)
    {

        $query = $bd->prepare("Delete FROM {$tabela} where id = :id");
        $query->bindParam(':id', $id);

        if ($query->rowCount(($query->execute())) == 0) {   //só para testar a forma de captura de erros

            throw new MinhaExcecao('Esse usuário não existe!');
        }
    }
}
