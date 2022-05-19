<?php

function validarUsuario($usuario)
{

    if (preg_match('/^@[a-zA-Z ]+$/', $usuario)) {

        if ((((strlen($usuario)) > 5) && ((strlen($usuario)) < 20))) {

            return true;
            
        } else {

            throw new MinhaExcecao('O usuário deverá ter entre 5 até 20 caracteres!');
        }
    } else {


        throw new MinhaExcecao('Formato incorreto!');
    }
}
