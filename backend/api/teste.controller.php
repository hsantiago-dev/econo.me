<?php

    $uri = $_SERVER['REQUEST_URI'];

    // echo $uri;

    $json = file_get_contents('php://input');
    $body = json_decode($json, true);
    
    echo $body['rateio'][0]['idUsuario'];
    echo $body['rateio'][0]['valorRateio'];
