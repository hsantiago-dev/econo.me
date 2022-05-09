<?php
 class Usuario{
    private $id;
    private $nome;
    private $senha;
    private $cpf;
    private $email;
    private $telefone_celular;
    private $data_criacao;
    private $nome_mae;

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

}