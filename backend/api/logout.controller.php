<?php

    // require('backend\services\sessao.controller.php');

    // if ($logado) {

        session_start();
        $sessionId = session_id();
        echo "{\"sessionId\": {$sessionId}}";
        session_destroy();
    // }