<?php

    $logado = true;

    $headers = getallheaders();

    if (empty($headers['Authorization'])) {

        header("HTTP/1.0 401 unauthorized");
        $logado = false;
    } else {

        session_id($headers['Authorization']);
        session_start();
    }

    