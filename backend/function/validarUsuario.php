<?php

function validarUsuario($usuario)
{

    if ((((strlen($usuario)) > 5) && ((strlen($usuario)) < 20))) {

        return true;
            
    } else {

        header("HTTP/1.0 400 Bad Request");
        throw new MinhaExcecao('O usuário deverá ter entre 5 até 20 caracteres!');
    }
}
