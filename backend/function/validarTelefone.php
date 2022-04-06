<?php
function validadorTelefone($telefone)
{
    if (preg_match('/^\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$/', $telefone)) {

      
        return true;
    } else {

        return false;
    }
}
