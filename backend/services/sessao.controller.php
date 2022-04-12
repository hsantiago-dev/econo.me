<?php

    session_start();

    $logado = true;

    $headers = getallheaders();

    $tokenSession = $_SESSION['token'] ?? null;
    $sessionId = session_id();

    if ($tokenSession == null || empty($headers['Authorization']) || $headers['Authorization'] != strval($tokenSession)) {

        header("HTTP/1.0 401 unauthorized");
        // echo "{\"sessionId\": {$sessionId}, \"tokenSession\": {$tokenSession}, \"Authorization\": {$headers['Authorization']}}";
        var_dump($headers);
        $logado = false;
    } else {
        
        $aux = $_SESSION['logado'];
        echo "{\"teste\": \"${aux}\"}";
    }

    