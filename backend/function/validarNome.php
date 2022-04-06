<?php

function validarNome($nome)
{

    if (preg_match('/^[a-zA-Z ]+$/', $nome)) {

        return true;
    } else {


        return false;
    }
}
