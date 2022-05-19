<?php

 class Usuario {

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
}