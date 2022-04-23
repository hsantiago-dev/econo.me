

<?php
 class Despesa {
    private $admin_despesa;
    private $tipo_despesa;
    private $data_vencimento;
    private $titulo;
    private $valor_total;
    private $data_criacao;

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