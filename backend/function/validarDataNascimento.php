<?php

function validadordtNascimento($data, $hoje)
{
   
    $tempData = explode("/", $data);

    $dt1 = ((strtotime($data)));
    $dt2 = ((strtotime($hoje)));

    if (checkdate($tempData[1], $tempData[0], $tempData[2])) {


        if ($dt1 < $dt2) {

            return true;
            // }
        } else {

            return false;
        }
    }
}
