<?php
class Conexao
{

    private static $instancia;

    public static function get()
    {

        try {
            if (!isset(self::$instancia)) {

                self::$instancia = new PDO('pgsql:host=localhost;dbname=econome','postgres','postgres123');
                return self::$instancia;
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
