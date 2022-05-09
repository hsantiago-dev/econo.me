<?php


function validadordtNascimento($data){
    
    $tempData = explode("/", $data);
    $hoje = date('d/m/Y');
  
    if (checkdate($tempData[1], $tempData[0], $tempData[2]) && (strtotime($data)) < (strtotime($hoje))) {

        return true;
    } else {

        return false;
    }
}
