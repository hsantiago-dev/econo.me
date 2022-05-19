<?php

    $uri = $_SERVER['REQUEST_URI'];

    // echo $uri;

    $json = file_get_contents('php://input');
    $body = json_decode($json, true);
    
    for ($i = 0; $i < sizeof($body['rateio']); $i++) {

        echo $body['rateio'][$i]['idUsuario'];
        echo $body['rateio'][$i]['valorRateio'];
        // echo "$i";
    }

    // echo sizeof($body['rateio']);