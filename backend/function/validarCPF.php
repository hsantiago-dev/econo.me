
<?php

function validadorCPF($cpf)
{
      if (preg_match('/[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}/', $cpf)) {

       $temp = (preg_replace('/[^0-9]/', '', $cpf));

       if (strlen($temp) == 11) {

         return true;
       } else {
         return false;
       }
}
}
