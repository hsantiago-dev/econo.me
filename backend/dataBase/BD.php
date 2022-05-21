<?php

abstract class BD{

    public abstract function getAll($tabela,$bd);

    public abstract function get($tabela,$id,$bd);

    public abstract function insert($tabela,$bd,$usuario);

    public abstract function update($tabela,$bd,$usuario);

    public abstract function delete($tabela,$id,$bd);
    

}