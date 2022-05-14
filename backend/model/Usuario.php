<?php

 class Usuario {

    protected $id;
    protected $usuario;
    protected $cpf;
    protected $email;
    protected $telefone_celular;

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