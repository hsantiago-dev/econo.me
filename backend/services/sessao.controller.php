<?php

    session_start();

    $logado = true;

    $headers = getallheaders();

    if ($headers['Authorization'] != $_SESSION['token']) {

        header("HTTP/1.0 401 unauthorized");
        $logado = false;
    }

    